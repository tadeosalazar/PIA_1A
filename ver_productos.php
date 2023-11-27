<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/#">
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <!-- NAVBAR -->
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
    <!-- Contenido -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Productos Disponibles</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
                // Obtener productos de la base de datos
                $result = $conn->query("SELECT * FROM producto");
                while ($row = $result->fetch_assoc()) {
                    // Verificar si hay descuento para el producto
                    $descuento_result = $conn->query("SELECT * FROM descuento WHERE id_producto = " . $row['id_producto']);
                    $descuento = ($descuento_result->num_rows > 0) ? $descuento_result->fetch_assoc()['descuento'] : 0;

                    // Calcular el precio con descuento
                    $precio_con_descuento = $row['precio'] - ($row['precio'] * $descuento / 100);

                    // Mostrar la tarjeta del producto
                    echo '
                    <div class="col">
                        <div class="card">
                            <img src="' . $row['url_imagen'] . '" class="card-img-top" alt="Imagen del producto">
                            <div class="card-body">
                                <h5 class="card-title">' . $row['descripcion'] . '</h5>
                                <p class="card-text">Precio: $' . number_format($precio_con_descuento, 2) . '</p>
                                <p class="text-danger">Descuento: ' . $descuento . '%</p>
                                <form onsubmit="event.preventDefault(); agregarAlCarrito(' . $row['id_producto'] . ', ' . $precio_con_descuento . ')">
                                <input type="hidden" name="id_producto" value="' . $row['id_producto'] . '">
                                <button type="submit" class="btn btn-primary">Agregar a Pedido</button>
                            </form>
                            </div>
                        </div>
                    </div>';
                }
            ?>
        </div>
        <!-- Enlace al carrito -->
        <div class="text-center mt-4">
            <a href="comprar.php" class="btn btn-success">Ir al Carrito</a>
        </div>
    </div>
    
    <script>
    // Función para agregar un producto al carrito sin recargar la página
    function agregarAlCarrito(idProducto, descripcion, precio) {
        $.ajax({
            type: "POST",
            url: "agregar_pedido.php",
            data: {
                id_producto: idProducto,
                descripcion: descripcion,
                precio: precio
            },
            success: function (response) {
                alert("Producto agregado al carrito");
            },
            error: function (error) {
                alert("Error al agregar el producto al carrito");
            }
        });
    }
</script>
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- JS -->

    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
