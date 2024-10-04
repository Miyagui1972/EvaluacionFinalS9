<?php
// procesar_login.php - Procesar el inicio de sesión

// Iniciar sesión
session_start();

// Incluir la conexión a la base de datos
include 'db.php';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Buscar el usuario por email
    $query = $conn->prepare("SELECT * FROM USUARIOS WHERE email = ?");
    $query->bind_param('s', $email);
    $query->execute();
    $result = $query->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $usuario['password'])) {
            // Iniciar sesión guardando los datos del usuario
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            
            // Redireccionar al dashboard o página principal
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Contraseña incorrecta. Intenta de nuevo.";
        }
    } else {
        echo "No existe una cuenta registrada con este correo.";
    }

    // Cerrar la conexión
    $conn->close();
}
?>
