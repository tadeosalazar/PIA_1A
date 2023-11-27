<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: iniciosesion.php");
    exit();
}

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

// Obtener el ID de usuario actual
$id_usuario_actual = $_SESSION['user_id'];

// Consulta para obtener los registros de reporte que coinciden con el usuario actual
$sql = "SELECT r.id_reporte, r.id_pedido, r.parametros, p.fecha, p.direccion
        FROM reporte r
        JOIN pedido p ON r.id_pedido = p.id_pedido
        WHERE p.id_usuario = $id_usuario_actual";

$result = $conn->query($sql);

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Reportes</title>
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/betterware.png" alt="" width="40" height="34" class="d-inline-block align-text-top">
                Betterware
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                    </li>

                    <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '<li class="nav-item"><a class="nav-link" href="cerrar_sesion.php">Cerrar Sesión</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="ver_productos.php">Comprar</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="comprar.php">Carrito</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="ver_reportes.php">Reportes</a></li>';
                        
                        if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                            echo '<li class="nav-item"><a class="nav-link" href="producto.php">Crear producto</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="descuentos.php">Crear Descuentos</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="reporte.php">Crear Reporte</a></li>';
                        }
                    } else {
                        echo '<li class="nav-item"><a class="nav-link" href="registrarse.html">Registrarse</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="iniciosesion.php">Iniciar Sesión</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>Reportes del Usuario</h2>
        <?php
        if ($result->num_rows > 0) {
            echo '<table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Reporte</th>
                            <th>ID Pedido</th>
                            <th>Parámetros</th>
                            <th>Fecha del Pedido</th>
                            <th>Dirección del Pedido</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $row['id_reporte'] . '</td>
                        <td>' . $row['id_pedido'] . '</td>
                        <td>' . $row['parametros'] . '</td>
                        <td>' . $row['fecha'] . '</td>
                        <td>' . $row['direccion'] . '</td>
                    </tr>';
            }
            
            echo '</tbody>
                </table>';
        } else {
            echo '<p>No hay reportes para este usuario.</p>';
        }
        ?>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html
