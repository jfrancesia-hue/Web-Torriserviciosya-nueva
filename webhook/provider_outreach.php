<?php
/**
 * Provider Outreach - Toori ServiciosYa
 *
 * Maneja notificaciones escalonadas a prestadores:
 * - minuto 0: top 10 mejor rankeados
 * - minuto 10: recordatorio a los notificados que no respondieron
 * - minuto 20: ampliar a otros prestadores compatibles
 *
 * Guarda estado local en provider_outreach_state.json para evitar duplicados.
 */

require_once 'config.php';
require_once 'db.php';
require_once 'whatsapp.php';

function po_log(string $msg): void {
    file_put_contents(__DIR__ . '/provider_outreach.log', '[' . date('Y-m-d H:i:s') . "] $msg\n", FILE_APPEND | LOCK_EX);
}

function po_state_file(): string {
    return __DIR__ . '/provider_outreach_state.json';
}

function po_load_state(): array {
    $file = po_state_file();
    if (!file_exists($file)) return ['offers' => []];
    $data = json_decode(file_get_contents($file), true);
    if (!is_array($data)) return ['offers' => []];
    if (!isset($data['offers']) || !is_array($data['offers'])) $data['offers'] = [];
    return $data;
}

function po_save_state(array $state): void {
    file_put_contents(po_state_file(), json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

function po_norm(string $s): string {
    $s = mb_strtolower(trim($s));
    $s = @iconv('UTF-8', 'ASCII//TRANSLIT', $s) ?: $s;
    return trim(preg_replace('/[^a-z0-9\s]/', ' ', $s));
}

function po_digits(string $telefono): string {
    return preg_replace('/\D/', '', $telefono);
}

function po_wa_from_celular(string $celular): ?string {
    $digits = po_digits($celular);
    if (!$digits) return null;
    return (substr($digits, 0, 2) === '54') ? "whatsapp:+$digits" : "whatsapp:+54$digits";
}

function po_provider_key(array $prof): string {
    if (!empty($prof['id'])) return (string)$prof['id'];
    return po_digits($prof['celular'] ?? 'unknown');
}

function po_get_offer_state(array &$state, string $ofertaId): array {
    if (!isset($state['offers'][$ofertaId]) || !is_array($state['offers'][$ofertaId])) {
        $state['offers'][$ofertaId] = [
            'created_at' => date('c'),
            'providers' => [],
            'stages' => [],
        ];
    }
    if (!isset($state['offers'][$ofertaId]['providers'])) $state['offers'][$ofertaId]['providers'] = [];
    if (!isset($state['offers'][$ofertaId]['stages'])) $state['offers'][$ofertaId]['stages'] = [];
    return $state['offers'][$ofertaId];
}

function po_set_offer_state(array &$state, string $ofertaId, array $offerState): void {
    $state['offers'][$ofertaId] = $offerState;
}

function po_mark_notified(string $ofertaId, array $prof, string $stage, string $wa): void {
    $state = po_load_state();
    $offerState = po_get_offer_state($state, $ofertaId);
    $key = po_provider_key($prof);
    if (!isset($offerState['providers'][$key])) {
        $offerState['providers'][$key] = [
            'provider_id' => $prof['id'] ?? null,
            'phone' => $wa,
            'name' => trim(($prof['nombre'] ?? '') . ' ' . ($prof['apellido'] ?? '')),
            'notified_at' => date('c'),
            'notify_count' => 0,
            'responded' => false,
            'declined' => false,
            'budget_sent' => false,
            'stages' => [],
        ];
    }
    $offerState['providers'][$key]['phone'] = $wa;
    $offerState['providers'][$key]['notify_count'] = intval($offerState['providers'][$key]['notify_count'] ?? 0) + 1;
    $offerState['providers'][$key]['last_notified_at'] = date('c');
    $offerState['providers'][$key]['stages'][$stage] = date('c');
    $offerState['stages'][$stage] = date('c');
    po_set_offer_state($state, $ofertaId, $offerState);
    po_save_state($state);
}

function po_mark_response(string $ofertaId, array $prof, string $type, ?float $monto = null): void {
    $state = po_load_state();
    $offerState = po_get_offer_state($state, $ofertaId);
    $key = po_provider_key($prof);
    if (!isset($offerState['providers'][$key])) {
        $offerState['providers'][$key] = [
            'provider_id' => $prof['id'] ?? null,
            'phone' => po_wa_from_celular($prof['celular'] ?? '') ?? '',
            'name' => trim(($prof['nombre'] ?? '') . ' ' . ($prof['apellido'] ?? '')),
            'notify_count' => 0,
            'stages' => [],
        ];
    }
    $offerState['providers'][$key]['responded'] = true;
    $offerState['providers'][$key]['responded_at'] = date('c');
    if ($type === 'declined') $offerState['providers'][$key]['declined'] = true;
    if ($type === 'budget') {
        $offerState['providers'][$key]['budget_sent'] = true;
        $offerState['providers'][$key]['last_budget_amount'] = $monto;
    }
    po_set_offer_state($state, $ofertaId, $offerState);
    po_save_state($state);
}

function po_provider_already_contacted(array $offerState, array $prof): bool {
    $key = po_provider_key($prof);
    return isset($offerState['providers'][$key]);
}

function po_provider_responded(array $offerState, array $prof): bool {
    $key = po_provider_key($prof);
    return !empty($offerState['providers'][$key]['responded']);
}

function po_provider_score(array $prof, array $oferta, array $globalState): int {
    $score = 0;
    $zona = po_norm($oferta['zona'] ?? '');
    $ciudad = po_norm($prof['ciudad'] ?? '');
    $prov = po_norm($prof['provincia'] ?? '');
    if ($ciudad && strpos($zona, $ciudad) !== false) $score += 50;
    if ($prov && strpos($zona, $prov) !== false) $score += 20;
    if (!empty($prof['celular'])) $score += 10;
    if (!empty($prof['categoria'])) $score += 10;
    if (!empty($prof['nombre'])) $score += 5;

    $providerKey = po_provider_key($prof);
    $responses = 0;
    $declines = 0;
    foreach (($globalState['offers'] ?? []) as $offerState) {
        $p = $offerState['providers'][$providerKey] ?? null;
        if (!$p) continue;
        if (!empty($p['budget_sent'])) $responses += 1;
        if (!empty($p['declined'])) $declines += 1;
    }
    $score += min(30, $responses * 10);
    $score -= min(20, $declines * 5);
    return $score;
}

function po_find_professionals(array $oferta, int $limit = 10, int $offset = 0, bool $excludeContacted = false): array {
    $categoria = trim($oferta['categoria'] ?? '');
    $zonaRaw = trim($oferta['zona'] ?? '');
    if (!$categoria || !$zonaRaw) return [];

    $variantes = array_values(array_unique([
        strtolower($categoria),
        ucfirst(strtolower($categoria)),
        $categoria,
    ]));

    $profesionales = [];
    foreach ($variantes as $v) {
        $enc = urlencode('{' . $v . '}');
        $res = supabaseRequest('GET', "usuarios?categoria=cs.$enc&select=id,nombre,apellido,celular,provincia,ciudad,categoria&limit=200");
        if (is_array($res)) $profesionales = array_merge($profesionales, $res);
    }

    $dedupe = [];
    foreach ($profesionales as $p) {
        if (!empty($p['id'])) $dedupe[$p['id']] = $p;
    }
    $profesionales = array_values($dedupe);

    $zonaNorm = po_norm($zonaRaw);
    $profesionales = array_values(array_filter($profesionales, function($p) use ($zonaNorm) {
        $ciudad = po_norm($p['ciudad'] ?? '');
        $prov = po_norm($p['provincia'] ?? '');
        return (($ciudad && strpos($zonaNorm, $ciudad) !== false) || ($prov && strpos($zonaNorm, $prov) !== false)) && !empty($p['celular']);
    }));

    $state = po_load_state();
    $offerState = po_get_offer_state($state, (string)($oferta['id'] ?? ''));
    if ($excludeContacted) {
        $profesionales = array_values(array_filter($profesionales, function($p) use ($offerState) {
            return !po_provider_already_contacted($offerState, $p);
        }));
    }

    usort($profesionales, function($a, $b) use ($oferta, $state) {
        return po_provider_score($b, $oferta, $state) <=> po_provider_score($a, $oferta, $state);
    });

    return array_slice($profesionales, $offset, $limit);
}

function po_build_message(array $oferta, string $stage): string {
    $ofertaId = $oferta['id'] ?? '';
    $categoria = trim($oferta['categoria'] ?? 'servicio');
    $zona = trim($oferta['zona'] ?? 'tu zona');
    $descripcion = trim($oferta['descripcion'] ?? '');
    $descLinea = $descripcion ? "ðŸ“ Problema: " . mb_substr($descripcion, 0, 180) . "\n" : '';

    if ($stage === 'reminder_10') {
        return "â° *Seguimos necesitando presupuesto para el pedido #$ofertaId*\n\n" .
            "ðŸ“‹ Servicio: $categoria\n" .
            "ðŸ“ Zona: $zona\n" .
            $descLinea . "\n" .
            "Si podÃ©s tomarlo, respondÃ© con monto y horario.\n" .
            "Ejemplo: *$25000 hoy 18hs*.\n" .
            "Si no podÃ©s, respondÃ© *NO*.";
    }

    if ($stage === 'expand_20') {
        return "ðŸ”” *Pedido disponible #$ofertaId*\n\n" .
            "Estamos ampliando la bÃºsqueda de profesionales.\n" .
            "ðŸ“‹ Servicio: $categoria\n" .
            "ðŸ“ Zona: $zona\n" .
            $descLinea . "\n" .
            "RespondÃ© con presupuesto aproximado y horario disponible.\n" .
            "Ejemplo: *$25000 hoy 18hs*.\n" .
            "Si no podÃ©s, respondÃ© *NO*.";
    }

    return "ðŸ”” *Nuevo pedido #$ofertaId disponible*\n\n" .
        "ðŸ“‹ Servicio: $categoria\n" .
        "ðŸ“ Zona: $zona\n" .
        $descLinea . "\n" .
        "RespondÃ© con presupuesto aproximado y horario disponible.\n" .
        "Ejemplo: *$25000 hoy 18hs*.\n" .
        "Si no podÃ©s, respondÃ© *NO*.\n\n" .
        "TambiÃ©n podÃ©s verlo en la web/app:\n" .
        "https://tooriserviciosya.com/ofertas.php";
}

function po_send_to_professionals(array $oferta, array $profesionales, string $stage): int {
    $ofertaId = (string)($oferta['id'] ?? '');
    if (!$ofertaId || count($profesionales) === 0) return 0;
    $msg = po_build_message($oferta, $stage);
    $ok = 0;
    foreach ($profesionales as $prof) {
        $wa = po_wa_from_celular($prof['celular'] ?? '');
        if (!$wa) continue;
        if (enviarWhatsApp($wa, $msg)) {
            $ok++;
            po_mark_notified($ofertaId, $prof, $stage, $wa);
        }
        usleep(250000);
    }
    po_log("stage=$stage oferta=$ofertaId enviados=$ok candidatos=" . count($profesionales));
    return $ok;
}

function po_send_initial(array $oferta, int $limit = 10): int {
    $pros = po_find_professionals($oferta, $limit, 0, true);
    return po_send_to_professionals($oferta, $pros, 'initial_0');
}

function po_send_reminder_nonresponders(array $oferta): int {
    $ofertaId = (string)($oferta['id'] ?? '');
    $state = po_load_state();
    $offerState = po_get_offer_state($state, $ofertaId);
    if (!empty($offerState['stages']['reminder_10'])) return 0;

    $pros = po_find_professionals($oferta, 100, 0, false);
    $pros = array_values(array_filter($pros, function($p) use ($offerState) {
        return po_provider_already_contacted($offerState, $p) && !po_provider_responded($offerState, $p);
    }));
    $pros = array_slice($pros, 0, 15);
    return po_send_to_professionals($oferta, $pros, 'reminder_10');
}

function po_send_expansion(array $oferta, int $limit = 15): int {
    $ofertaId = (string)($oferta['id'] ?? '');
    $state = po_load_state();
    $offerState = po_get_offer_state($state, $ofertaId);
    if (!empty($offerState['stages']['expand_20'])) return 0;

    $pros = po_find_professionals($oferta, $limit, 0, true);
    return po_send_to_professionals($oferta, $pros, 'expand_20');
}

function po_find_provider_by_phone(string $telefono): ?array {
    $digits = po_digits($telefono);
    if (!$digits) return null;
    $last10 = substr($digits, -10);
    if (strlen($last10) < 8) return null;

    $usuarios = supabaseRequest('GET', 'usuarios?select=id,nombre,apellido,celular,categoria,provincia,ciudad&celular=ilike.*' . urlencode($last10) . '&limit=10');
    if (!is_array($usuarios) || count($usuarios) === 0) return null;
    foreach ($usuarios as $u) {
        $cat = $u['categoria'] ?? null;
        $hasCategory = is_array($cat) ? count($cat) > 0 : trim((string)$cat) !== '';
        if ($hasCategory) return $u;
    }
    return null;
}

function po_find_offer_for_provider(array $prof, string $mensaje): ?array {
    if (preg_match('/#\s*(\d+)/', $mensaje, $m)) {
        $ofertas = supabaseRequest('GET', 'nuevaOferta?id=eq.' . urlencode($m[1]) . '&estado=eq.completa&limit=1');
        if (is_array($ofertas) && count($ofertas) > 0) return $ofertas[0];
    }

    $state = po_load_state();
    $key = po_provider_key($prof);
    $candidates = [];
    foreach (($state['offers'] ?? []) as $ofertaId => $offerState) {
        if (!empty($offerState['providers'][$key]) && empty($offerState['providers'][$key]['responded'])) {
            $candidates[] = $ofertaId;
        }
    }
    $candidates = array_reverse($candidates);
    foreach ($candidates as $ofertaId) {
        $ofertas = supabaseRequest('GET', 'nuevaOferta?id=eq.' . urlencode($ofertaId) . '&estado=eq.completa&limit=1');
        if (is_array($ofertas) && count($ofertas) > 0) return $ofertas[0];
    }

    $ofertas = supabaseRequest('GET', 'nuevaOferta?estado=eq.completa&paso=in.(4,98)&order=created_at.desc&limit=20');
    if (!is_array($ofertas)) return null;
    foreach ($ofertas as $oferta) {
        $matches = po_find_professionals($oferta, 50, 0, false);
        foreach ($matches as $m) {
            if (po_provider_key($m) === $key) return $oferta;
        }
    }
    return null;
}

function po_extract_budget_amount(string $mensaje): ?float {
    if (preg_match('/(?:\$|ars\s*)?\s*(\d{2,3}(?:[\.\s]?\d{3})+|\d{4,8})(?:[,\.]\d{1,2})?/iu', trim($mensaje), $match)) {
        $raw = preg_replace('/[^0-9,\.]/', '', $match[1]);
        $raw = str_replace('.', '', $raw);
        $raw = str_replace(',', '.', $raw);
        if (is_numeric($raw) && (float)$raw > 0) return (float)$raw;
    }
    return null;
}
