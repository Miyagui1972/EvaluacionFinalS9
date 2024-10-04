// registro.js - Validación del formulario en tiempo real
document.getElementById('registroForm').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value;
    const passwordError = document.getElementById('passwordError');

    const isPasswordSecure = password.length >= 8 && /\d/.test(password);

    if (!isPasswordSecure) {
        event.preventDefault(); // Evita que se envíe el formulario
        passwordError.textContent = "La contraseña debe tener al menos 8 caracteres y contener un número.";
    } else {
        passwordError.textContent = "";
    }
});
