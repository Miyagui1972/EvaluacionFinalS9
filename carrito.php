<?php
// carrito.php - Visualizar el carrito de compras

session_start();
include 'db.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

// Obtener los libros que están en el carrito del usuario
$usuario_id = $_SESSION['usuario_id'];
$query = $conn->prepare("
    SELECT CARRITO.id, LIBROS.titulo, CARRITO.cantidad, LIBROS.precio, CARRITO.monto_total 
    FROM CARRITO 
    JOIN LIBROS ON CARRITO.libro_id = LIBROS.id 
    WHERE CARRITO.usuario_id = ?");
$query->bind_param('i', $usuario_id);
$query->execute();
$result = $query->get_result();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Tu Carrito de Compras</h2>

        <!-- Mostrar los libros en el carrito -->
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Monto Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($item = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $item['titulo']; ?></td>
                            <td><?php echo $item['cantidad']; ?></td>
                            <td><?php echo number_format($item['precio'], 2); ?> €</td>
                            <td><?php echo number_format($item['monto_total'], 2); ?> €</td>
                            <td>
                                <!-- Formulario para modificar la cantidad -->
                                <form method="POST" action="modificar_carrito.php" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                    <input type="number" name="cantidad" value="<?php echo $item['cantidad']; ?>" min="1">
                                    <button type="submit" class="btn btn-sm btn-warning">Modificar</button>
                                </form>

                                <!-- Formulario para eliminar el libro del carrito -->
                                <form method="POST" action="eliminar_carrito.php" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">Tu carrito está vacío.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
