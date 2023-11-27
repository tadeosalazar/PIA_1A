<?php
include 'conexion.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST["descripcion"];
    $codigo = $_POST["codigo"];
    $precio = $_POST["precio"];
    $url_imagen = $_POST["url_imagen"];

    agregarProducto($descripcion, $codigo, $precio, $url_imagen);
}

function agregarProducto($descripcion, $codigo, $precio, $url_imagen) {
    global $conn;

    $sql = "INSERT INTO producto (descripcion, codigo, precio, url_imagen) VALUES ('$descripcion', '$codigo', '$precio', '$url_imagen')";

    if ($conn->query($sql) === TRUE) {
        echo "Producto agregado correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!--CSS-->
    <link rel="stylesheet" href="css/styles.css">
    <!--CSS Bootstrap-->
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
                   session_start();
                   if (isset($_SESSION['user_id'])) {
                       // Usuario autenticado
                       
                       echo '<li class="nav-item"><a class="nav-link" href="cerrar_sesion.php">Cerrar Sesión</a></li>';
                       echo '<li class="nav-item"><a class="nav-link" href="ver_productos.php">Comprar</a></li>';
                       echo '<li class="nav-item"><a class="nav-link" href="comprar.php">Carrito</a></li>';
                       echo '<li class="nav-item"><a class="nav-link" href="ver_reportes.php">Reportes</a></li>';
                       // Verificación adicional para administrador
                       if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                           echo '<li class="nav-item"><a class="nav-link" href="producto.php">Crear producto</a></li>';
                           echo '<li class="nav-item"><a class="nav-link" href="descuentos.php">Crear Descuentos</a></li>';
                           echo '<li class="nav-item"><a class="nav-link" href="reporte.php">Crear Reporte</a></li>';
                       }
                   } else {
                       // Usuario no autenticado
                       echo '<li class="nav-item"><a class="nav-link" href="registrarse.html">Registrarse</a></li>';
                       echo '<li class="nav-item"><a class="nav-link" href="iniciosesion.php">Iniciar Sesión</a></li>';
                   }
                  ?>
              </ul>
          </div>
      </div>
  </nav>

  <br>
  <br>
  <br>
  <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Card para el formulario -->
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Agregar Producto</h2>
                        <!-- Formulario -->
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción:</label>
                                <input type="text" class="form-control" name="descripcion" required>
                            </div>
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Código:</label>
                                <input type="text" class="form-control" name="codigo" required>
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio:</label>
                                <input type="text" class="form-control" name="precio" required>
                            </div>
                            <div class="mb-3">
                                <label for="url_imagen" class="form-label">URL de la imagen:</label>
                                <input type="text" class="form-control" name="url_imagen" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar Producto</button>
                        </form>
                        <!-- Fin del formulario -->
                    </div>
                </div>
                <!-- Fin de la tarjeta -->
            </div>
        </div>
    </div>

  <!--JQUERY-->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <!--JS-->

  <!--Bootstrap-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
