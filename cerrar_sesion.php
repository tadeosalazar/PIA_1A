<?php
// cerrar_sesion.php

// Iniciar sesión si no está iniciada
session_start();

// Desconfigurar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir al usuario al index.php después de cerrar sesión
header("Location: index.php");
exit();
?>
