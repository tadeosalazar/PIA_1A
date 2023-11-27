<?php

function agregar_producto_al_carrito($id_producto, $precio) {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    // Obtener información del producto
    $info_producto = obtener_info_producto($id_producto);

    // Verificar si el producto ya está en el carrito
    if (isset($_SESSION['carrito'][$id_producto])) {
        $_SESSION['carrito'][$id_producto]['cantidad'] += 1;
    } else {
        $_SESSION['carrito'][$id_producto] = array(
            'cantidad' => 1,
            'precio' => $precio,
            'descripcion' => $info_producto['descripcion']
        );
    }
}

function calcular_total_carrito() {
    $total = 0;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $id_producto => $producto) {
            // Forzar la conversión a número usando (float)
            $total += (float)$producto['cantidad'] * (float)$producto['precio'];
        }
    }
    return $total;
}

function obtener_info_producto($id_producto) {
    global $conn; // Asegúrate de que $conn esté disponible aquí

    $stmt = $conn->prepare("SELECT descripcion FROM producto WHERE id_producto = ?");
    $stmt->bind_param('i', $id_producto);
    $stmt->execute();
    $stmt->bind_result($descripcion);
    $stmt->fetch();
    $stmt->close();

    return array('descripcion' => $descripcion);
}

?>
