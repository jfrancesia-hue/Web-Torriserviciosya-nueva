<?php
// Cargar variables de entorno para controlar el logging
require_once 'config.php';

function log_debug($msg) {
    if (env('DEBUG') === '1') {
        error_log($msg);
    }
}
// --- TEST DE SALIDA TEMPRANA ---
if (!isset($_GET['action']) && !isset($_POST['action'])) {
    header('Content-Type: application/json');
    echo json_encode(['ok' => true, 'test' => 'api_panel.php responde']);
    flush();
    exit;
}

// --- CABECERAS Y LOGGING ---
log_debug('[DEBUG] INICIO api_panel.php');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Forzar log de errores a archivo local
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error_log.txt');
ini_set('display_errors', 0); // No mostrar errores en pantalla
error_reporting(E_ALL);

// Manejo de errores fatales para evitar pantalla en blanco
set_exception_handler(function($e) {
    error_log('[FATAL][EXCEPTION] ' . $e->getMessage() . "\n" . $e->getTraceAsString());
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Error interno del servidor (ex)']);
    exit;
});
// Este bloque fue eliminado para evitar un error fatal de redeclaración.
// El manejador de errores ya está definido más arriba en el script.
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        error_log('[FATAL][SHUTDOWN] ' . print_r($error, true));
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Error fatal del servidor (shutdown)']);
        exit;
    }
});

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}


//error_log('[DEBUG] require_once config.php');
//require_once 'config.php';
log_debug('[DEBUG] require_once db.php');
require_once 'db.php';
log_debug('[DEBUG] require_once whatsapp.php');
require_once 'whatsapp.php';
//error_log('[DEBUG] require_once OK');

$action = $_GET['action'] ?? $_POST['action'] ?? '';

// --- LOG DE ENTRADA ---
error_log('[API_PANEL] action=' . $action . ' | GET=' . json_encode($_GET) . ' | POST=' . json_encode($_POST));

// Ejecutar acción con manejo de excepciones para capturar trazas
try {
    log_debug('[DEBUG] switch action: ' . $action);
    switch ($action) {
    case 'listar_chats':
        listarChats();
        break;
    case 'obtener_chat':
        $id = $_GET['id'] ?? null;
        if ($id) {
            obtenerChat($id);
        } else {
            responderError('Falta el ID de la conversación');
        }
        break;
    case 'enviar_mensaje':
        $id = $_POST['id'] ?? null;
        $mensaje = $_POST['mensaje'] ?? null;
        if ($id && $mensaje) {
            enviarMensajeAgente($id, $mensaje);
        } else {
            responderError('Faltan parámetros (id, mensaje)');
        }
        break;
    case 'intervenir':
        $id = $_POST['id'] ?? null;
        if ($id) {
            intervenir($id);
        } else {
            responderError('Falta el ID');
        }
        break;
    case 'devolver_ia':
        $id = $_POST['id'] ?? null;
        if ($id) {
            devolverIA($id);
        } else {
            responderError('Falta el ID');
        }
        break;
    case 'notif_profesionales':
        $id = $_GET['id'] ?? null;
        if ($id) {
            obtenerNotifProfesionales($id);
        } else {
            responderError('Falta el ID');
        }
        break;
    default:
        responderError('Acción no válida');
}

} catch (Throwable $e) {
    // Registrar traza completa en el archivo de errores
    $msg = '[UNCAUGHT] ' . get_class($e) . ': ' . $e->getMessage() . " in " . $e->getFile() . ':' . $e->getLine() . "\n" . $e->getTraceAsString();
    error_log($msg);
    // Responder con mensaje genérico (ya habrá traza en el log)
    responderError('Error interno del servidor (ex)');
}

/**
 * Lista todas las conversaciones activas
 */
function listarChats() {
    log_debug('[DEBUG] Entrando a listarChats()');
    log_debug('[DEBUG] listarChats() iniciada');
    try {
        $ofertas = supabaseRequest(
            "GET",
            "nuevaOferta?estado=in.(recolectando,pendiente,completa)&order=created_at.desc&limit=50"
        );
        log_debug('[DEBUG] supabaseRequest result: ' . var_export($ofertas, true));
        if ($ofertas === null || $ofertas === false) {
            error_log('[ERROR] supabaseRequest devolvió null o false');
            responderOK([]);
            return;
        }
        if (!is_array($ofertas)) {
            error_log('[ERROR] supabaseRequest devolvió un tipo no array: ' . gettype($ofertas));
            $ofertas = [];
        }

        $chats = [];
        foreach ($ofertas as $idx => $oferta) {
            if (!is_array($oferta)) {
                error_log('[WARN] oferta no es array en index ' . $idx . ': ' . var_export($oferta, true));
                continue;
            }

            $historial = json_decode($oferta['historial_conversacion'] ?? '[]', true);
            if (!is_array($historial)) {
                error_log('[WARN] historial_conversacion inválido para oferta ' . ($oferta['id'] ?? 'unknown'));
                $historial = [];
            }

            $ultimoMensaje = '';
            $ultimoTimestamp = '';
            if (count($historial) > 0) {
                $ultimo = end($historial);
                $ultimoMensaje = substr($ultimo['content'] ?? '', 0, 50);
                $ultimoTimestamp = $ultimo['timestamp'] ?? '';
            }

            $chats[] = [
                'id' => $oferta['id'] ?? null,
                'telefono' => $oferta['cliente_telefono'] ?? '',
                'nombre' => $oferta['nombre_cliente'] ?: ('ID: ' . ($oferta['id'] ?? '')),
                'estado' => $oferta['estado'] ?? '',
                'modo_agente' => (bool)($oferta['modo_agente'] ?? false),
                'ultimo_mensaje' => $ultimoMensaje,
                'ultimo_timestamp' => $ultimoTimestamp,
                'created_at' => $oferta['created_at'] ?? '',
                'categoria' => $oferta['categoria'] ?? ''
            ];
        }

        log_debug('[DEBUG] Chats construidos: ' . var_export($chats, true));
        responderOK($chats);
    } catch (Exception $e) {
        error_log('[EXCEPTION] listarChats fallo (Exception): ' . $e->getMessage() . "\n" . $e->getTraceAsString());
        responderError('Error al listar conversaciones');
    }
}

/**
 * Obtiene los mensajes de una conversación
 */
function obtenerChat($id) {
    log_debug('[DEBUG] Entrando a obtenerChat() con id=' . $id);
    $oferta = supabaseRequest("GET", "nuevaOferta?id=eq.$id");

    if (!is_array($oferta) || count($oferta) === 0) {
        responderError('Conversación no encontrada');
        return;
    }

    $oferta = $oferta[0];
    $historial = json_decode($oferta['historial_conversacion'] ?? '[]', true);
    if (!is_array($historial)) $historial = [];

    // No se realiza ningún filtrado sobre el historial aquí: devolvemos
    // exactamente lo que está guardado en la oferta para que el panel
    // muestre todos los mensajes sin ocultar ninguno.

    responderOK([
        'id' => $oferta['id'],
        'telefono' => $oferta['cliente_telefono'] ?? '',
        'nombre' => $oferta['nombre_cliente'] ?: ('ID: ' . $oferta['id']),
        'estado' => $oferta['estado'] ?? '',
        'modo_agente' => (bool)($oferta['modo_agente'] ?? false),
        'categoria' => $oferta['categoria'] ?? '',
        'zona' => $oferta['zona'] ?? '',
        'descripcion' => $oferta['descripcion'] ?? '',
        'media_url' => $oferta['media_url'] ?? '',
        'mensajes' => $historial
    ]);
}

/**
 * Guarda un mensaje con la fecha y hora actual
 */
function guardarMensaje($id, $contenido, $role, $agente = false) {
    $oferta = supabaseRequest("GET", "nuevaOferta?id=eq.$id");
    if (!is_array($oferta) || count($oferta) === 0) return;

    $oferta = $oferta[0];
    $historial = json_decode($oferta['historial_conversacion'] ?? '[]', true);
    if (!is_array($historial)) $historial = [];

    $ts = date('c'); // Timestamp actual ISO 8601

    $historial[] = [
        'role' => $role,
        'content' => $contenido,
        'agente' => $agente,
        'timestamp' => $ts
    ];

    supabaseRequest("PATCH", "nuevaOferta?id=eq.$id", [
        'historial_conversacion' => json_encode($historial)
    ]);

    // Llamar a la función externa sin interferir
    enviarALogExterno($id, $contenido, $role, $ts);
}

/**
 * Envía un mensaje como agente humano
 */
function enviarMensajeAgente($id, $mensaje) {
    log_debug('[DEBUG] Entrando a enviarMensajeAgente() con id=' . $id);
    $oferta = supabaseRequest("GET", "nuevaOferta?id=eq.$id");
    if (!is_array($oferta) || count($oferta) === 0) {
        responderError('Conversación no encontrada');
        return;
    }

    $oferta = $oferta[0];
    $telefono = $oferta['cliente_telefono'] ?? '';
    if (empty($telefono)) {
        responderError('No hay teléfono en esta conversación');
        return;
    }

    // Intentar enviar por WhatsApp y registrar resultado
    $sent = enviarWhatsApp($telefono, $mensaje);
    file_put_contents(__DIR__ . "/debug.txt", "[PANEL] enviarMensajeAgente oferta_id=$id telefono=$telefono enviado=" . ($sent ? 'true' : 'false') . " mensaje_preview=" . substr($mensaje,0,200) . "\n", FILE_APPEND);

    // Guardar siempre el mensaje en el historial (registro local), indicando si se envió o no
    $histContent = $mensaje;
    if (!$sent) {
        $histContent = "[INTENTO_NO_ENVIADO] " . $mensaje;
    }
    guardarMensaje($id, $histContent, 'assistant', true);

    // Si el envío fue exitoso, marcar modo_agente y devolver OK
    if ($sent) {
        supabaseRequest("PATCH", "nuevaOferta?id=eq.$id", [
            'modo_agente' => true
        ]);
        responderOK(['enviado' => true, 'mensaje' => $mensaje]);
    }

    // Si no se envió, devolver error al cliente (pero el historial quedó guardado)
    responderError('No se pudo enviar el mensaje por WhatsApp. Revisa debug.txt para más detalles.');
}

/**
 * Intervenir
 */
function intervenir($id) {
    log_debug('[DEBUG] Entrando a intervenir() con id=' . $id);
    supabaseRequest("PATCH", "nuevaOferta?id=eq.$id", ['modo_agente' => true]);
    responderOK(['intervenido' => true]);
}

/**
 * Devolver IA
 */
function devolverIA($id) {
    log_debug('[DEBUG] Entrando a devolverIA() con id=' . $id);
    supabaseRequest("PATCH", "nuevaOferta?id=eq.$id", ['modo_agente' => false]);
    responderOK(['devuelto' => true]);
}

/**
 * Guardar mensaje del cliente
 */
function guardarMensajeCliente($id, $mensajeCliente) {
    log_debug('[DEBUG] Entrando a guardarMensajeCliente() con id=' . $id);
    guardarMensaje($id, $mensajeCliente, 'user', false);
}

/**
 * -------------------------------
 * Función externa simple que guarda mensaje en historial y envía a api_panel.php
 * -------------------------------
 */
function enviarALogExterno($id, $mensaje, $role, $timestamp) {
    log_debug('[DEBUG] Entrando a enviarALogExterno() con id=' . $id);
    // Guardar en archivo local
    file_put_contents('historial_externo.txt', "[$timestamp] ($role) ID:$id -> $mensaje\n", FILE_APPEND);

    // Enviar a api_panel.php
    $url = "https://tuservidor.com/api_panel.php"; // Cambiar a URL real
    $postData = [
        'id' => $id,
        'mensaje' => $mensaje,
        'role' => $role,
        'timestamp' => $timestamp
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 2); // No bloquear
    curl_exec($ch);
    curl_close($ch);
}

/**
 * Respuesta OK
 */
function utf8ize($mixed) {
    if (is_array($mixed)) {
        $ret = [];
        foreach ($mixed as $k => $v) {
            $ret[$k] = utf8ize($v);
        }
        return $ret;
    } elseif (is_string($mixed)) {
        // Convertir a UTF-8 intentando no romper datos
        if (!mb_check_encoding($mixed, 'UTF-8')) {
            $mixed = mb_convert_encoding($mixed, 'UTF-8', 'ISO-8859-1');
        }
        // Normalizar reemplazando caracteres inválidos
        return mb_convert_encoding($mixed, 'UTF-8', 'UTF-8');
    }
    return $mixed;
}

function safe_json_encode($data) {
    $options = defined('JSON_UNESCAPED_UNICODE') ? JSON_UNESCAPED_UNICODE : 0;
    $payload = json_encode($data, $options);
    if ($payload !== false && $payload !== null) return $payload;

    // Try with PARTIAL_OUTPUT if available
    $partial = defined('JSON_PARTIAL_OUTPUT_ON_ERROR') ? JSON_PARTIAL_OUTPUT_ON_ERROR : 0;
    if ($partial) {
        $payload = json_encode($data, $options | $partial);
        if ($payload !== false && $payload !== null) return $payload;
    }

    // Attempt to utf8-encode strings recursively and retry
    $clean = utf8ize($data);
    $payload = json_encode($clean, $options | $partial);
    if ($payload !== false && $payload !== null) return $payload;

    // Still failing: log the error and return false
    error_log('[ERROR] safe_json_encode fallo: ' . json_last_error_msg() . ' code=' . json_last_error());
    return false;
}

function responderOK($data) {
    log_debug('[DEBUG] responderOK ejecutado');
    $payload = safe_json_encode(array(
        'success' => true,
        'data' => $data
    ));
    if ($payload === false) {
        // Fallback mínimo si no podemos codificar
        $fallback = array('success' => false, 'error' => 'JSON encoding error');
        error_log('[ERROR] responderOK json_encode falló, enviando fallback');
        $payload = json_encode($fallback);
    }
    // Log no condicional para confirmar salida al cliente
    error_log('[RESPONSE] responderOK size=' . strlen($payload) . ' items=' . (is_array($data) ? count($data) : 0));
    echo $payload;
    log_debug('[DEBUG] exit en responderOK');
    exit;
}

/**
 * Respuesta de error
 */
function responderError($mensaje) {
    log_debug('[DEBUG] responderError ejecutado');
    $payload = safe_json_encode(array(
        'success' => false,
        'error' => $mensaje
    ));
    if ($payload === false) {
        error_log('[ERROR] responderError json_encode falló, mensaje: ' . substr($mensaje,0,200));
        $payload = json_encode(array('success' => false, 'error' => 'JSON encoding error'));
    }
    // Log no condicional para confirmar salida al cliente
    error_log('[RESPONSE] responderError size=' . strlen($payload) . ' message=' . substr($mensaje,0,200));
    echo $payload;
    log_debug('[DEBUG] exit en responderError');
    exit;
}

/**
 * Lee el debug.txt y devuelve las notificaciones de profesionales para una oferta
 */
function obtenerNotifProfesionales($ofertaId) {
    log_debug('[DEBUG] Entrando a obtenerNotifProfesionales() con id=' . $ofertaId);
    $logFile = __DIR__ . '/debug.txt';
    if (!file_exists($logFile)) { responderOK([]); return; }

    $contenido = file_get_contents($logFile);
    $resultado = [];

    // Partir el log en bloques por oferta
    $patron = '/\[NOTIF-PROFESIONALES\] Oferta ' . $ofertaId . ' \| Categor(?:i|í)a: (.+?)(?=\[NOTIF-PROFESIONALES\] Oferta |\[\d{4}-\d{2}-\d{2}|$)/s';
    
    if (!preg_match_all($patron, $contenido, $bloques)) {
        responderOK([]);
        return;
    }

    foreach ($bloques[0] as $bloque) {
        $categoria = trim($bloques[1][array_search($bloque, $bloques[0])]);
        
        // Buscar todos los "Mensaje enviado a ..."
        preg_match_all('/-> Mensaje enviado a (\S+)/', $bloque, $enviados);
        
        foreach ($enviados[1] as $celular) {
            $resultado[] = [
                'nombre'    => '',
                'celular'   => $celular,
                'categoria' => $categoria,
                'estado'    => 'ok',
                'timestamp' => ''
            ];
        }

        // Buscar errores
        preg_match_all('/WHATSAPP_ERROR.*?To:\s*(\S+)/', $bloque, $errores);
        foreach ($errores[1] as $celular) {
            $resultado[] = [
                'nombre'    => '',
                'celular'   => $celular,
                'categoria' => $categoria,
                'estado'    => 'error',
                'timestamp' => ''
            ];
        }
    }

    responderOK($resultado);
}

// Fallback: si por alguna razón el script llega al final sin responder,
// aseguramos que el cliente reciba un JSON válido en vez de una respuesta vacía.
error_log('[FALLBACK] Fin de api_panel.php sin respuesta previa, enviando responderOK([])');
responderOK([]);

?>