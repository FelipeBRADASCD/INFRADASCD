<?php require "sesion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infraestructura DASCD</title>
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <h1 class="titulo">¡Bienvenidos <?= $nombres . ' ' . $apellidos; ?>!</h1>
    <h3>Cargo: <?= $cargo ?></h3>
    <div class="centrar">
        <a href="logout.php" target="_self" id="cerrar">Cerrar la sesión</a>
    </div>

    <div class="centrar">
        <a href="usuarios.php" target="_self" class="boton-1">Añadir nuevo usuario</a>
        <a href="sistematecn.php" target="_self" class="boton-1">Añadir Plataforma Tecnológica</a>
        <a href="usuariosist.php" target="_self" class="boton-1">Añadir Usuario de la Plataforma</a>
        <a href="password.php" target="_self" class="boton-1">Añadir Contraseñas</a>
        <a href="consultapassword.php" target="_self" class="boton-1">Gestor de Contraseñas</a>
    </div>
    <?php // include "tabla.php"; //Imprime la tabla ?> 

</body>

</html>