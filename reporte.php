<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Reporte</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/reporte.css">
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
  <div class="container">
        <h2>Registrar Reporte</h2>
        <form action="registrar_reporte.php" method="post">
            <div class="mb-3">
                <label for="id_pedido" class="form-label">ID Pedido:</label>
                <select id="id_pedido" name="id_pedido" class="form-select" required>
                    <!-- Opciones dinámicas de la base de datos -->
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="2">3</option>
                    <option value="2">4</option>
                    <option value="2">5</option>
                    <option value="2">6</option>
                    <option value="2">7</option>
                    <option value="2">8</option>
                    <option value="2">9</option>
                    <option value="2">10</option>

                    <!-- Agrega más opciones según sea necesario -->
                </select>
            </div>

            <div class="mb-3">
                <label for="parametros" class="form-label">Parámetros:</label>
                <textarea id="parametros" name="parametros" rows="4" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Registrar</button>
        </form>
    </div>
        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- JS -->

    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
