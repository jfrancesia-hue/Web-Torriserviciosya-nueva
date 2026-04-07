<?php
require_once 'config.php';
require_once 'whatsapp.php';

function formatearCel($cel) {
    // solo números
    $cel = preg_replace('/\D/', '', $cel);

    // ya tiene prefijo whatsapp, devolver limpio para procesar
    // (no debería llegar así pero por si acaso)

    // ya internacional completo con 54 (argentino)
    if (strpos($cel, '54') === 0) {
        return 'whatsapp:+' . $cel;
    }

    // números argentinos típicos (10 dígitos)
    if (strlen($cel) == 10) {
        return 'whatsapp:+549' . $cel;
    }

    // número internacional de otro país (ya tiene código de país, más de 10 dígitos)
    if (strlen($cel) > 10) {
        return 'whatsapp:+' . $cel;
    }

    // fallback: devolver con prefijo igual
    return 'whatsapp:+' . $cel;
}

$usuarios = [
    ['cel' => '1126503136',    'nom' => 'Adrián Valente'],
    ['cel' => '1167904248',    'nom' => 'Daniel José pincas'],
    ['cel' => '3513790841',    'nom' => 'Pia'],
    ['cel' => '3196982762',    'nom' => 'Jorge Sarmiento'],
    ['cel' => '1149474825',    'nom' => 'Leonardo Diego Gómez'],
    ['cel' => '3517480277',    'nom' => 'Gabriel Alejandro oliva'],
    ['cel' => '3319471478',    'nom' => 'David Morales'],
    ['cel' => '5392357428',    'nom' => 'Nayib gamarro'],
    ['cel' => '3572550196',    'nom' => 'Alex'],
    ['cel' => '692639003',     'nom' => 'Franklin Mendez'],
    ['cel' => '9221289633',    'nom' => 'Edith Alfonso Jeronimo'],
    ['cel' => '3834346435',    'nom' => 'Santucho Alexandra Vanina'],
    ['cel' => '4141461414',    'nom' => 'Oscar'],
    ['cel' => '3541704059',    'nom' => 'Antonio Barni'],
    ['cel' => '1132184047',    'nom' => 'Yemina'],
    ['cel' => '3513500539',    'nom' => 'Rafael Fernández'],
    ['cel' => '3517357956',    'nom' => 'Isaac Guillermo Joel andino'],
    ['cel' => '3572571212',    'nom' => 'Guillermo'],
    ['cel' => '3512437704',    'nom' => 'Carlos Ezequiel Miranda'],
    ['cel' => '584123370677',  'nom' => 'Iriangel del Carmen López Pacheco'],
    ['cel' => '3516318264',    'nom' => 'Facundo Manuel acosta'],
    ['cel' => '3516255230',    'nom' => 'Michael Alarcon'],
    ['cel' => '3517061756',    'nom' => 'Graciela'],
    ['cel' => '3518624762',    'nom' => 'Diego'],
    ['cel' => '1128680114',    'nom' => 'Ramón Miguel García'],
    ['cel' => '1140264961',    'nom' => 'Juan'],
    ['cel' => '5493835561184', 'nom' => 'Casas Priscila Nair'],
    ['cel' => '67735826',      'nom' => 'Anna Vasileva'],
    ['cel' => '3515996775',    'nom' => 'Miguel'],
    ['cel' => '1128236853',    'nom' => 'Rodrigo'],
    ['cel' => '4074666682',    'nom' => 'Miguel Figueredo Estevez'],
    ['cel' => '3834355348',    'nom' => 'Braian exequiel romero'],
    ['cel' => '598298242180',  'nom' => 'Andrés Arezo'],
    ['cel' => '5431412142218', 'nom' => 'Niquio Martiniano'],
    ['cel' => '3456431161',    'nom' => 'Evelyn'],
    ['cel' => '9356197',       'nom' => 'Javier Eduardo juanico Benítez'],
    ['cel' => '541164548013',  'nom' => 'Costanza Polemann'],
    ['cel' => '2281934892',    'nom' => 'Jorge Garcia Geronimo'],
    ['cel' => '3507739077',    'nom' => 'Limpieza y mantenimiento de acuarios'],
    ['cel' => '504325313',     'nom' => 'Adolfo Rivera'],
    ['cel' => '5493424879301', 'nom' => 'Laura trouchet'],
    ['cel' => '1167281251',    'nom' => 'Esteban Martín Barros'],
    ['cel' => '541161784900',  'nom' => 'Martín'],
    ['cel' => '51915055191',   'nom' => 'Peter'],
    ['cel' => '3515179688',    'nom' => 'Matias'],
    ['cel' => '1139043744',    'nom' => 'Flavia Gisela Bordon'],
    ['cel' => '963932898',     'nom' => 'Felipe Ricardo Farfán Mieles'],
    ['cel' => '3518681059',    'nom' => 'Victor'],
    ['cel' => '3512485620',    'nom' => 'Jorge'],
    ['cel' => '3513148643',    'nom' => 'Samuel'],
    ['cel' => '1167310548',    'nom' => 'Jennifer barros'],
    ['cel' => '541124938408',  'nom' => 'ELECTROSOLUCIONES.SUR'],
    ['cel' => '3517015681',    'nom' => 'Energia Rincón'],
    ['cel' => '2613903800',    'nom' => 'Agustín Fernández'],
    ['cel' => '541134922705',  'nom' => 'Agustina Pra'],
    ['cel' => '528116067799',  'nom' => 'Pablo Humberto Olvera Aguillon'],
    ['cel' => '5491139449945', 'nom' => 'Marcela Lopez'],
    ['cel' => '3834920704',    'nom' => 'Rocio Ortiz'],
    ['cel' => '4448053158',    'nom' => 'Miguel Alvarado'],
    ['cel' => '525646237138',  'nom' => 'Raymundo Jaime Rodríguez Hernández'],
    ['cel' => '3834905448',    'nom' => 'Yohana Micaela Reynoso'],
    ['cel' => '56956983199',   'nom' => 'Jordan Patricio Hernández Hernández'],
    ['cel' => '995932236',     'nom' => 'Alberto'],
    ['cel' => '5546409845',    'nom' => 'Mario Madrid Luna'],
];

$vistos = [];
$logFile = __DIR__ . '/notificar_hardcoded_log.txt';

file_put_contents($logFile, "=== INICIO " . date('Y-m-d H:i:s') . " ===\n", LOCK_EX);

$enviados = 0;
$fallidos = 0;
$saltados = 0;

foreach ($usuarios as $u) {
    $celOriginal = trim($u['cel']);
    $cel = formatearCel($celOriginal);
    $nom = trim($u['nom']);

    if ($cel === '') {
        $saltados++;
        continue;
    }

    if (isset($vistos[$cel])) {
        $saltados++;
        continue;
    }
    $vistos[$cel] = true;

    $msg = ($nom ? "Hola $nom,\n\n" : "Hola,\n\n")
        . "Detectamos que tu perfil en Toori ServiciosYa tiene datos incompletos. "
        . "Por favor ingresá a https://tooriserviciosya.com/ e iniciá sesión: "
        . "verás los campos pendientes para completar.\n\n"
        . "Este es un mensaje de alerta generado por nuestro agente IA.";

    $sent = false;
    try {
        $sent = enviarWhatsApp($cel, $msg);
    } catch (Exception $e) {
        file_put_contents($logFile, "ERROR $cel | " . $e->getMessage() . "\n", FILE_APPEND);
    }

    if ($sent) {
        $enviados++;
        echo "OK: $cel | $nom\n";
        file_put_contents($logFile, "OK: $cel | $nom\n", FILE_APPEND);
    } else {
        $fallidos++;
        echo "FALLO: $cel | $nom (orig: $celOriginal)\n";
        file_put_contents($logFile, "FALLO: $cel | $nom (orig: $celOriginal)\n", FILE_APPEND);
    }

    usleep(300000);
}

$resumen = "\n=== FIN " . date('Y-m-d H:i:s') . " | Enviados=$enviados | Fallidos=$fallidos | Saltados=$saltados ===\n";
echo $resumen;
file_put_contents($logFile, $resumen, FILE_APPEND);