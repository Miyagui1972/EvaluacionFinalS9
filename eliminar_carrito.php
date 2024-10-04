<?php
// eliminar_carrito.php - Eliminar un libro del carrito

session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carrito_id = $_POST['id'];

    // Eliminar el libro del carrito
    $query = $conn->prepare("DELETE FROM CARRITO WHERE id = ?");
    $query->bind_param('i', $carrito_id);
    $query->execute();

    header("Location: carrito.php");
}
$conn->close();
?>
