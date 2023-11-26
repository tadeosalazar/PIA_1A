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
    $nom_usuario = htmlspecialchars($_POST["nom_usuario"]);
    $correo_usuario = htmlspecialchars($_POST["correo_usuario"]);
    $contraseña_usuario = htmlspecialchars($_POST["contraseña_usuario"]);

    // Asumiendo que también recibes una contraseña en tu formulario
    $contraseña_usuario = password_hash($contraseña_usuario, PASSWORD_DEFAULT);

    // Modificar la consulta SQL para insertar en la tabla "usuarios"
    $sql = "INSERT INTO usuarios (nom_usuario, correo_usuario, contraseña_usuario) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Verificar si la preparación tuvo éxito
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    // Ajustar el tipo de datos para la contraseña a "s" (string)
    $stmt->bind_param("sss", $nom_usuario, $correo_usuario, $contraseña_usuario);

    if ($stmt->execute()) {
        // Registro exitoso
        $response = array("status" => "success", "message" => "Registro exitoso. Te has registrado correctamente.");
        echo json_encode($response);
    } else {
        // Error en el registro
        $response = array("status" => "error", "message" => "Error en el registro. Por favor, inténtalo de nuevo.");
        echo json_encode($response);
    
        // Log de errores
        error_log("Error en la ejecución de la consulta: " . $stmt->error);
    }

        // Agregué esta parte para imprimir mensajes de error en caso de falla
        die("Error en la ejecución de la consulta: " . $stmt->error . " - " . mysqli_error($conn));
    }

    $stmt->close();


$conn->close();
?>
