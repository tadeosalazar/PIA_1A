<?php
session_start();
include 'conexion.php';
include 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['id_producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Agregar el producto al carrito
    agregar_producto_al_carrito($id_producto, $descripcion, $precio);

    // Responder al cliente (puedes personalizar el mensaje según tus necesidades)
    echo "Producto agregado al carrito";
} else {
    // Manejar otros casos según sea necesario
}
?>
