<?php
session_start();
include 'conexion.php';
include 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar formulario de compra (dirección y método de pago)
    $id_usuario = $_SESSION['user_id'];
    $fecha = date("Y-m-d");
    $direccion = $_POST['direccion'];
    $metodo_de_pago = $_POST['metodo_de_pago'];

    // Insertar en la tabla de pedido
    $stmt = $conn->prepare("INSERT INTO pedido (id_usuario, fecha, direccion, metodo_de_pago) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('isss', $id_usuario, $fecha, $direccion, $metodo_de_pago);

    $stmt->execute();
    $stmt->close();

    // Limpiar el carrito después de la compra
    unset($_SESSION['carrito']);

    // Redireccionar a la página de inicio
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS Bootstrap-->
    <link rel="stylesheet" href="css/styles2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Compra</title>
</head>
<body>

 <!--NAVBAR-->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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

    <!-- Contenido del carrito y formulario de compra -->
    <div class="container">
        <h2 class="text-center">Carrito de Compras</h2>
        <ul>
            <?php
            if (isset($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $id_producto => $producto) {
                    echo '<li>' . $producto['descripcion'] . ' - Cantidad: ' . $producto['cantidad'] . ' - Precio Unitario: $' . $producto['precio'] . '</li>';
                }
            }
            ?>
        </ul>

        <p class="text-center">Total: $<?php echo number_format(calcular_total_carrito(), 2); ?></p>

        <h2 class="text-center">Completa tu compra</h2>
        <form method="post" action="comprar.php">
            <div class="form-group">
                <label for="direccion" class="form-label">Dirección de envío:</label>
                <input type="text" name="direccion" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="metodo_de_pago" class="form-label">Método de pago:</label>
                <select name="metodo_de_pago" class="form-select" required>
                    <option value="debito">Tarjeta de Débito</option>
                    <option value="credito">Tarjeta de Crédito</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Confirmar Compra</button>
            </div>
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
