<?php
// logout.php - Cerrar sesión

// Iniciar sesión
session_start();

// Destruir todas las variables de sesión
session_unset();
session_destroy();

// Redirigir al formulario de inicio de sesión
header("Location: login.php");
exit;
?>
