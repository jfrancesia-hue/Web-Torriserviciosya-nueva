<?php
/**
 * Config - ServiciosYa
 * 
 * CAMBIO: parse_ini_file() rompe con API keys que tienen caracteres especiales
 * (como las de Anthropic: sk-ant-api03-...). Se reemplaza por un parser manual
 * que lee línea por línea y soporta cualquier valor.
 */

function env($key) {
    static $vars = null;
    if ($vars === null) {
        $vars = [];
        $envFile = __DIR__ . '/.env';
        if (!file_exists($envFile)) {
            error_log('[CONFIG] ERROR: .env no encontrado en ' . $envFile);
            return null;
        }
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            // Saltar comentarios y líneas vacías
            if ($line === '' || $line[0] === '#') continue;
            // Buscar el primer '=' para separar key=value
            $pos = strpos($line, '=');
            if ($pos === false) continue;
            $k = trim(substr($line, 0, $pos));
            $v = trim(substr($line, $pos + 1));
            // Quitar comillas si las tiene
            if ((substr($v, 0, 1) === '"' && substr($v, -1) === '"') ||
                (substr($v, 0, 1) === "'" && substr($v, -1) === "'")) {
                $v = substr($v, 1, -1);
            }
            $vars[$k] = $v;
        }
    }
    return $vars[$key] ?? null;
}

// Tiempo límite para esperar propuestas (en segundos).
// Por defecto 1800 segundos = 30 minutos.
if (!defined('PROPOSAL_TIMEOUT')) {
    define('PROPOSAL_TIMEOUT', 1800);
}