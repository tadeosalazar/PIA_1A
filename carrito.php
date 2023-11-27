<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo '<h2>Carrito vacío</h2>';
} else {
    echo '<h2>Carrito de Compras</h2>';
    echo '<table border="1">
            <tr>
                <th>ID Producto</th>
                <th>Descripción</th>
                <th>Precio</th>
            </tr>';
    foreach ($_SESSION['carrito'] as $item) {
        echo '<tr>
                <td>' . $item['id_producto'] . '</td>
                <td>' . $item['descripcion'] . '</td>
                <td>$' . number_format($item['precio'], 2) . '</td>
              </tr>';
    }
    echo '</table>';
    echo '<a href="comprar.php">Comprar</a>';
}
?>
