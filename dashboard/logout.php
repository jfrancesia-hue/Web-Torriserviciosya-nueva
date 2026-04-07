<?php
// logout.php simple
session_start();
session_destroy();
header('Location: index.php');
exit;
?>
