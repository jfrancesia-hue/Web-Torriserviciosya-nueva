<?php
/**
 * Claude API Adapter + Utilidades LLM - ServiciosYa / Mica 2.0
 * 
 * Contiene:
 * - llamarClaude(): Adapter para Claude API
 * - llamarLLM(): Función unificada que elige provider según .env
 * - matchearCategoria(): Busca la categoría más cercana en la tabla `categorias` de Supabase
 */

require_once 'config.php';

// ─────────────────────────────────────────────
//  LLAMAR A CLAUDE API
// ─────────────────────────────────────────────
function llamarClaude(array $messages, bool $tieneImagen = false): ?array {
    $apiKey = env('ANTHROPIC_API_KEY');
    if (!$apiKey) {
        _log("Claude | ERROR: ANTHROPIC_API_KEY vacía");
        return null;
    }

    // Separar system prompt de los mensajes
    $systemPrompt = '';
    $claudeMessages = [];

    foreach ($messages as $msg) {
        if ($msg['role'] === 'system') {
            $systemPrompt .= $msg['content'] . "\n";
            continue;
        }

        $content = $msg['content'];

        if (is_array($content)) {
            $claudeContent = [];
            foreach ($content as $block) {
                if ($block['type'] === 'text') {
                    $claudeContent[] = ['type' => 'text', 'text' => $block['text']];
                } elseif ($block['type'] === 'image_url') {
                    $dataUrl = $block['image_url']['url'] ?? '';
                    if (preg_match('/^data:(.*?);base64,(.*)$/', $dataUrl, $matches)) {
                        $claudeContent[] = [
                            'type' => 'image',
                            'source' => [
                                'type' => 'base64',
                                'media_type' => $matches[1],
                                'data' => $matches[2],
                            ],
                        ];
                    }
                }
            }
            $content = $claudeContent;
        }

        $claudeMessages[] = ['role' => $msg['role'], 'content' => $content];
    }

    $model = env('CLAUDE_MODEL') ?: 'claude-sonnet-4-6';

    $payload = [
        'model' => $model,
        'max_tokens' => 1024,
        'system' => trim($systemPrompt),
        'messages' => $claudeMessages,
    ];

    $ch = curl_init('https://api.anthropic.com/v1/messages');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'x-api-key: ' . $apiKey,
            'anthropic-version: 2023-06-01',
        ],
        CURLOPT_POSTFIELDS     => json_encode($payload),
        CURLOPT_TIMEOUT        => 60,
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        _log("Claude | CURL ERROR: $curlError");
        return null;
    }

    _log("Claude | modelo=$model HTTP=$httpCode");

    if ($httpCode !== 200) {
        _log("Claude | ERROR HTTP $httpCode: " . substr($response, 0, 300));
        return null;
    }

    $decoded = json_decode($response, true);
    if (!$decoded || !isset($decoded['content'])) {
        _log("Claude | Respuesta inválida");
        return null;
    }

    $textContent = '';
    foreach ($decoded['content'] as $block) {
        if ($block['type'] === 'text') {
            $textContent .= $block['text'];
        }
    }

    if (!$textContent) {
        _log("Claude | Sin contenido de texto");
        return null;
    }

    // Parsear JSON
    $clean = preg_replace('/```json\s*/', '', $textContent);
    $clean = preg_replace('/```\s*/', '', $clean);
    $clean = trim($clean);

    $parsed = json_decode($clean, true);
    if (!$parsed) {
        // Intentar extraer JSON del texto
        if (preg_match('/\{[\s\S]*\}/', $clean, $jsonMatch)) {
            $parsed = json_decode($jsonMatch[0], true);
        }
        if (!$parsed) {
            _log("Claude | No se pudo parsear JSON: " . substr($clean, 0, 200));
            return null;
        }
    }

    _log("Claude | OK");
    return $parsed;
}

// ─────────────────────────────────────────────
//  FUNCIÓN UNIFICADA: elige provider según .env
// ─────────────────────────────────────────────
function llamarLLM(array $messages, bool $tieneImagen = false): ?array {
    $provider = strtolower(env('LLM_PROVIDER') ?: 'openai');

    _log("LLM | Provider: $provider | imagen: " . ($tieneImagen ? 'SI' : 'NO'));

    if ($provider === 'claude') {
        $result = llamarClaude($messages, $tieneImagen);
        if ($result === null) {
            _log("LLM | Claude falló, fallback a OpenAI...");
            return llamarOpenAI($messages, $tieneImagen);
        }
        return $result;
    }

    // Provider = openai (default)
    $result = llamarOpenAI($messages, $tieneImagen);
    if ($result === null && env('ANTHROPIC_API_KEY')) {
        _log("LLM | OpenAI falló, fallback a Claude...");
        return llamarClaude($messages, $tieneImagen);
    }
    return $result;
}

// ─────────────────────────────────────────────
//  MATCHEAR CATEGORÍA contra tabla `categorias`
//  Busca la categoría más parecida por similitud
// ─────────────────────────────────────────────
function matchearCategoria(string $categoriaIA): ?string {
    require_once 'db.php';

    $categoriaIA = trim($categoriaIA);
    if (empty($categoriaIA)) return null;

    // Cachear categorías en memoria estática (no consultar cada vez)
    static $categoriasCache = null;
    if ($categoriasCache === null) {
        $result = supabaseRequest('GET', 'categorias?select=nombre&limit=500');
        if (!is_array($result) || count($result) === 0) {
            _log("matchearCategoria | No se pudieron obtener categorías de Supabase");
            return $categoriaIA; // Devolver la original si no hay tabla
        }
        $categoriasCache = array_map(function($c) { return $c['nombre'] ?? ''; }, $result);
        $categoriasCache = array_filter($categoriasCache);
        _log("matchearCategoria | Cargadas " . count($categoriasCache) . " categorías");
    }

    // Normalizar para comparación
    $norm = function(string $s): string {
        $s = mb_strtolower(trim($s));
        $s = str_replace(
            ['á','é','í','ó','ú','ñ','ü'],
            ['a','e','i','o','u','n','u'],
            $s
        );
        return $s;
    };

    $inputNorm = $norm($categoriaIA);

    // 1. Buscar coincidencia exacta
    foreach ($categoriasCache as $cat) {
        if ($norm($cat) === $inputNorm) {
            _log("matchearCategoria | Exacta: '$categoriaIA' → '$cat'");
            return $cat;
        }
    }

    // 2. Buscar si la categoría contiene o está contenida en alguna de la tabla
    foreach ($categoriasCache as $cat) {
        $catNorm = $norm($cat);
        if (strpos($catNorm, $inputNorm) !== false || strpos($inputNorm, $catNorm) !== false) {
            _log("matchearCategoria | Parcial: '$categoriaIA' → '$cat'");
            return $cat;
        }
    }

    // 3. Buscar raíz común (ej: "limpiadora" → "limpieza", "plomería" → "plomero")
    // Comparar los primeros N caracteres
    $mejorMatch = null;
    $mejorScore = 0;

    foreach ($categoriasCache as $cat) {
        $catNorm = $norm($cat);

        // similar_text da un porcentaje de similitud
        similar_text($inputNorm, $catNorm, $percent);

        // También probar con la raíz (primeros 4-5 caracteres)
        $raizInput = substr($inputNorm, 0, min(5, strlen($inputNorm)));
        $raizCat   = substr($catNorm, 0, min(5, strlen($catNorm)));
        $bonusRaiz = ($raizInput === $raizCat) ? 20 : 0;

        // soundex para similitud fonética en español (limitado pero útil)
        $bonusSoundex = (soundex($inputNorm) === soundex($catNorm)) ? 15 : 0;

        $score = $percent + $bonusRaiz + $bonusSoundex;

        if ($score > $mejorScore) {
            $mejorScore = $score;
            $mejorMatch = $cat;
        }
    }

    // Umbral mínimo de 45% para aceptar el match
    if ($mejorMatch && $mejorScore >= 45) {
        _log("matchearCategoria | Similitud ($mejorScore%): '$categoriaIA' → '$mejorMatch'");
        return $mejorMatch;
    }

    // 4. No se encontró match aceptable - devolver la original
    _log("matchearCategoria | Sin match para '$categoriaIA' (mejor: '$mejorMatch' $mejorScore%) - usando original");
    return $categoriaIA;
}