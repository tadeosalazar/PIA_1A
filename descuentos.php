<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!--CSS-->
<link rel="stylesheet" href="css/#">
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

               // Verificación adicional para administrador
               if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                   echo '<li class="nav-item"><a class="nav-link" href="producto.php">Crear producto</a></li>';
                   echo '<li class="nav-item"><a class="nav-link" href="descuentos.php">Crear Descuentos</a></li>';
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
      <!--COntenido-->
      <div class="container mt-5">
        <h2 class="text-center mb-4">Agregar Descuento</h2>
        <form method="post" action="proc_desc.php">
            <div class="mb-3">
                <label for="producto">Producto:</label>
                <select class="form-select" name="id_producto" required>
                    <?php
                    // Obtener productos de la base de datos
                    $result = $conn->query("SELECT * FROM producto");
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_producto'] . '">' . $row['descripcion'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="descuento">Porcentaje de Descuento:</label>
                <input type="number" class="form-control" name="descuento" required>
            </div>
            <button type="submit" class="btn btn-primary">Aplicar Descuento</button>
        </form>
    </div>
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--JS-->

    <!--Bootstrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>