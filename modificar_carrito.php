<?php
// modificar_carrito.php - Modificar la cantidad de libros en el carrito

session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carrito_id = $_POST['id'];
    $nueva_cantidad = $_POST['cantidad'];

    // Obtener el precio del libro
    $query = $conn->prepare("SELECT libro_id FROM CARRITO WHERE id = ?");
    $query->bind_param('i', $carrito_id);
    $query->execute();
    $result = $query->get_result();
    $carrito_item = $result->fetch_assoc();

    $libro_id = $carrito_item['libro_id'];

    $query_libro = $conn->prepare("SELECT precio FROM LIBROS WHERE id = ?");
    $query_libro->bind_param('i', $libro_id);
    $query_libro->execute();
    $result_libro = $query_libro->get_result();
    $libro = $result_libro->fetch_assoc();

    $precio_libro = $libro['precio'];
    $nuevo_monto_total = $precio_libro * $nueva_cantidad;

    // Actualizar la cantidad y el monto total en el carrito
    $query_update = $conn->prepare("UPDATE CARRITO SET cantidad = ?, monto_total = ? WHERE id = ?");
    $query_update->bind_param('idi', $nueva_cantidad, $nuevo_monto_total, $carrito_id);
    $query_update->execute();

    header("Location: carrito.php");
}
$conn->close();
?>
