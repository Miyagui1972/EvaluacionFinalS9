<?php
// db.php - Archivo para la conexión a MySQL

$host = "localhost";  // Nombre del servidor
$user = "root";       // Nombre de usuario de MySQL
$password = "";       // Contraseña de MySQL (deja vacío si no tienes)
$dbname = "prowebiief"; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
