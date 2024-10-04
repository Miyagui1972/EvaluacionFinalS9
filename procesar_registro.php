<?php
// procesar_registro.php - Procesar el registro de usuarios

// Incluir la conexión a la base de datos
include 'db.php';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    // Validar que el correo no esté registrado previamente
    $email_check_query = $conn->prepare("SELECT email FROM USUARIOS WHERE email = ?");
    $email_check_query->bind_param('s', $email);
    $email_check_query->execute();
    $result = $email_check_query->get_result();

    if ($result->num_rows > 0) {
        echo "Este correo ya está registrado. Intenta con otro.";
    } else {
        // Encriptar la contraseña
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        // Insertar el nuevo usuario en la base de datos
        $query = $conn->prepare("INSERT INTO USUARIOS (nombre, email, password, direccion, telefono) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param('sssss', $nombre, $email, $password_hashed, $direccion, $telefono);

        if ($query->execute()) {
            echo "Registro exitoso. ¡Ahora puedes iniciar sesión!";
        } else {
            echo "Error al registrar. Intenta de nuevo.";
        }
    }

    // Cerrar la conexión
    $conn->close();
}
?>
