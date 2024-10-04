<?php
// agregar_al_carrito.php - Añadir un libro al carrito de compras

session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $libro_id = $_POST['libro_id'];
    $cantidad = $_POST['cantidad'];
    $usuario_id = $_SESSION['usuario_id'];

    // Verificar si el libro ya está en el carrito del usuario
    $query = $conn->prepare("SELECT * FROM CARRITO WHERE usuario_id = ? AND libro_id = ?");
    $query->bind_param('ii', $usuario_id, $libro_id);
    $query->execute();
    $result = $query->get_result();

    // Si el libro ya está en el carrito, actualizar la cantidad
    if ($result->num_rows > 0) {
        $carrito_item = $result->fetch_assoc();
        $nueva_cantidad = $carrito_item['cantidad'] + $cantidad;
        $nuevo_monto_total = $nueva_cantidad * $carrito_item['precio'];

        $query_update = $conn->prepare("UPDATE CARRITO SET cantidad = ?, monto_total = ? WHERE id = ?");
        $query_update->bind_param('idi', $nueva_cantidad, $nuevo_monto_total, $carrito_item['id']);
        $query_update->execute();
    } else {
        // Si no está, añadirlo al carrito
        $query_libro = $conn->prepare("SELECT precio FROM LIBROS WHERE id = ?");
        $query_libro->bind_param('i', $libro_id);
        $query_libro->execute();
        $result_libro = $query_libro->get_result();
        $libro = $result_libro->fetch_assoc();

        $precio_libro = $libro['precio'];
        $monto_total = $precio_libro * $cantidad;

        $query_insert = $conn->prepare("INSERT INTO CARRITO (usuario_id, libro_id, cantidad, monto_total) VALUES (?, ?, ?, ?)");
        $query_insert->bind_param('iiid', $usuario_id, $libro_id, $cantidad, $monto_total);
        $query_insert->execute();
    }

    header("Location: carrito.php");
}
$conn->close();
?>
