<?php
// Registro.php

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "betterwere";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y sanear los datos del formulario
    $nombre = htmlspecialchars($_POST["nombre"]);
    $correo = htmlspecialchars($_POST["correo"]);
    $contraseña = htmlspecialchars($_POST["contraseña"]);

    // Asumiendo que también recibes una contraseña en tu formulario
    $contraseña = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);

    // Modificar la consulta SQL para insertar en la tabla "usuarios"
    $sql = "INSERT INTO usuarios (nom_usuario, correo_usuario, contraseña_usuario) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $contraseña);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Registro exitoso
        $response = array("status" => "success", "message" => "Registro exitoso. Te has registrado correctamente.");
        echo json_encode($response);
    if (!$stmt->execute()) {
        // Error en la ejecución de la consulta
                die("Error en la ejecución de la consulta: " . $stmt->error . " - " . mysqli_error($conn));
        }
        
    } else {
        // Error en el registro
        $response = array("status" => "error", "message" => "Error en el registro. Por favor, inténtalo de nuevo.");
        echo json_encode($response);
    }

    $stmt->close();
}

$conn->close();
?>
