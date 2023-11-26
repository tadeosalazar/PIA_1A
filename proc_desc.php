<!-- procesar_descuento.php -->

<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['id_producto'];
    $descuento = $_POST['descuento'];

    // Verificar si ya existe un descuento para el producto
    $result = $conn->query("SELECT * FROM descuento WHERE id_producto = $id_producto");
    if ($result->num_rows > 0) {
        // Actualizar el descuento existente
        $conn->query("UPDATE descuento SET descuento = $descuento WHERE id_producto = $id_producto");
    } else {
        // Insertar nuevo descuento
        $conn->query("INSERT INTO descuento (id_producto, descuento) VALUES ($id_producto, $descuento)");
    }

    // Redirigir a la página de productos
    header("Location: ver_productos.php");
    exit();
}
?>
