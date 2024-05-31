<?php
session_start(); 
$_SESSION = array();
session_destroy();

// Redirigir a la página de login
header("Location: login.php");
exit();
?>