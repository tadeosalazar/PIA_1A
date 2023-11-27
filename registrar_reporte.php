<?php
ob_start(); // Iniciar el búfer de salida

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "betterwere";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$id_pedido = $_POST['id_pedido'];
$parametros = $_POST['parametros'];

// Verificar si el pedido existe en la tabla pedido
$pedido_existente_query = "SELECT * FROM pedido WHERE id_pedido = $id_pedido";
$resultado_pedido_existente = $conn->query($pedido_existente_query);

// Validar si el pedido existe
if ($resultado_pedido_existente->num_rows > 0) {
    // El pedido existe, ahora puedes insertar en la tabla reporte
    $sql = "INSERT INTO reporte (id_pedido, parametros) VALUES ('$id_pedido', '$parametros')";

    if ($conn->query($sql) === TRUE) {
        // Redireccionar a index.php después del registro exitoso
        header("Location: index.php");
        exit(); // Asegurarse de que no se ejecute más código después de la redirección
    } else {
        echo "Error al registrar el reporte: " . $conn->error;
    }
} else {
    echo "Error: El pedido con ID $id_pedido no existe.";
}

// Cerrar la conexión
$conn->close();

ob_end_flush(); // Limpiar el búfer de salida y enviar el contenido al navegador
?>
