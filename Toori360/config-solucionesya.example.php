<?php
/**
 * Configuración de la integración ServiciosYa -> SolucionesYa360.
 * Copiá este archivo a `config-solucionesya.php` (gitignored) en el server de Hostinger
 * y completá los valores reales. NUNCA commitear el archivo real con los secretos.
 */

return [
    // Endpoint del producto SolucionesYa360 (Vercel).
    'solucionesya_url'   => 'https://solucionesya360.vercel.app',

    // Token de sincronización (generado en SolucionesYa, lado servidor; NO exponer en el browser).
    'marketplace_token'  => 'mkt_REEMPLAZAR',

    // Tenant de SolucionesYa al que se sincronizan los prestadores (la administradora).
    'tenant_id'          => 'a0000000-0000-4000-8000-000000000001',

    // Supabase de ServiciosYa (de donde se LEEN los workers). Solo lectura.
    'supabase_url'       => 'https://dhhhftzdfpqthzvkrqoz.supabase.co',
    // service_role o una key con permiso de lectura sobre `usuarios`.
    'supabase_key'       => 'REEMPLAZAR_SERVICE_OR_ANON_KEY',

    // Secreto para poder ejecutar el script por web (?key=...). Si corrés solo por CLI/cron, podés dejarlo.
    'run_secret'         => 'cambiar-este-secreto',
];
