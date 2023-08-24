<?php
session_start(); // Iniciamos la sesión

// Destruimos todas las variables de sesión
session_destroy();

// Redirigir a la página de inicio de sesión
header("Location: login.php");
exit();
?>
