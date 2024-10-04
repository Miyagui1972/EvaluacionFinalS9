<!-- login.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="login.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Iniciar Sesión</h2>
        <form id="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" required>
                <div id="passwordError" class="text-danger"></div>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>

    <script>
        // login.js
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío del formulario
            const password = document.getElementById('password').value;
            const passwordError = document.getElementById('passwordError');

            const isPasswordSecure = password.length >= 8 && /\d/.test(password);

            if (!isPasswordSecure) {
                passwordError.textContent = "La contraseña debe tener al menos 8 caracteres y contener un número.";
            } else {
                passwordError.textContent = "";
                // Aquí puedes procesar el formulario
                alert("Formulario enviado con éxito");
            }
        });
    </script>
</body>
</html>
