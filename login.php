<?php
// login.php

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

// Obtener las credenciales del formulario de inicio de sesión
$correo_usuario = $_POST['correo_usuario'];
$contraseña_usuario = $_POST['contraseña_usuario'];

// Consultar la base de datos para verificar las credenciales
$sql = "SELECT id_usuario, correo_usuario, contraseña_usuario FROM usuarios WHERE correo_usuario = '$correo_usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Existen resultados, verificar la contraseña
    $row = $result->fetch_assoc();
    if (password_verify($contraseña_usuario, $row['contraseña_usuario'])) {
        // Contraseña válida, iniciar sesión
        session_start();
        $_SESSION['user_id'] = $row['id_usuario'];

        // Verificación adicional para administrador
        if ($row['correo_usuario'] == 'admin@correo.com' && $contraseña_usuario == 'admin') {
            $_SESSION['admin'] = true;
        }

        // Redirigir al usuario a la página de inicio
        header("Location: index.php");
        exit();
    } else {
        // Contraseña incorrecta
        echo "Contraseña incorrecta. Por favor, inténtalo de nuevo.";
    }
} else {
    // Usuario no encontrado
    echo "Usuario no encontrado. Por favor, verifica tus credenciales.";
}

// Cerrar la conexión
$conn->close();
?>
