<?php
session_start();
// Elimina todas las variables de sesión
$_SESSION = array();
// Destruye la sesión
session_destroy();
// Redirige al login o página principal
header('Location: index.php');
exit;
