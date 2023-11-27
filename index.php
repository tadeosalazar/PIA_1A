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
               echo '<li class="nav-item"><a class="nav-link" href="ver_productos.php">Productos</a></li>';
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
      <!--COntenido-->
      <section class="main-section">
        <div class="container">
          <div class="row">
              <div class="col-md-6">
                  <h1>¿Quienes Somos?</h1>
                  <p>Bienvenido a Betterwere, tu destino para descubrir y adquirir lo mejor en productos BetterWere. Nosotros somos más que una tienda en línea; 
                    somos apasionados por mejorar tu estilo de vida y bienestar a través de productos innovadores y de alta calidad.
                  <br>
                  En Betterwere, nos enorgullece ofrecerte una cuidada selección de productos BetterWere, respaldados por la garantía de calidad que nos distingue. 
                  Nuestra misión es proporcionarte soluciones que no solo cumplen con tus expectativas, 
                  sino que también las superan, transformando tu día a día.</p>
              </div>
              <div class="col-md-6">
                  <img src="img/casa.jpg" alt="Equipos de computo en FIME" class="img-fluid">
              </div>
          </div>
      </div>
      </section>
      <br>
      <br>
      <section class="next-section">
          <div class="container">
              <div class="row">
                  <div class="col-md-6">
                      <img src="img/Familia.jpg" alt="FIME" class="img-fluid">
                  </div>
                  <div class="col-md-6">
                      <h1>Objetivo</h1>
                      <p>En el corazón de Betterwere está nuestro 
                        compromiso de hacer que cada día sea mejor para ti. 
                        Nos esforzamos por ser tu destino confiable para descubrir productos 
                        BetterWere que no solo son funcionales y estéticos, 
                        sino también diseñados para mejorar tu bienestar general.
                          <br>
                          <br>
                          Nuestro objetivo es crear una experiencia de compra única, 
                          donde encuentres no solo productos excepcionales, sino también 
                          información útil y asesoramiento para tomar decisiones informadas. 
                          Queremos ser 
                          tu aliado en el camino hacia un estilo de vida mejor y más saludable.
      
                      </p>
                  </div>
              </div>
          </div>
      </section>
<br>
<br>
      <section class="main-section">
        <div class="container">
          <div class="row">
              <div class="col-md-6">
                  <h1>¿Que Encontraré?</h1>
                  <p>En Betterwere, te invitamos a explorar nuestro extenso 
                    catálogo de productos BetterWere cuidadosamente seleccionados. Desde 
                    innovadores dispositivos tecnológicos hasta accesorios de bienestar 
                    y artículos para el hogar, 
                    ofrecemos una variedad que se adapta a tus necesidades y gustos.
                  <br>
                  Descubre soluciones inteligentes para simplificar tu rutina diaria, 
                  mejora tu bienestar con productos diseñados para tu comodidad y 
                  disfruta de la calidad que solo BetterWere puede ofrecer. 
                  Encontrarás artículos 
                  que no solo cumplen con tus expectativas, sino que las superan.</p>
              </div>
              <div class="col-md-6">
                  <img src="img/servicio-producto.jpg" alt="Equipos de computo en FIME" class="img-fluid">
              </div>
          </div>
      </div>
      </section>
<br>
<br>
      <section class="next-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="img/Felicidad.jpg" alt="FIME" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h1>¿Qué es BetterWere?</h1>
                    <p>BetterWere es más que una marca, es un compromiso con la 
                      excelencia. Representa la convergencia de innovación, calidad y 
                      diseño en cada producto que lleva su nombre. 
                      En BetterWere, nos enorgullece ofrecerte lo mejor en tecnología, bienestar y estilo de vida.
                        <br>
                        <br>
                        Cada producto BetterWere que encuentras en nuestra tienda ha pasado rigurosos estándares de calidad para garantizar un rendimiento excepcional y una durabilidad duradera. Con BetterWere, no solo estás adquiriendo un producto, estás invirtiendo en una mejora significativa en tu vida diaria.
    
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--JS-->

    <!--Bootstrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>