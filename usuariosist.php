<?php require "sesion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios de los Sistemas Tecnológicos</title>
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <a href="index.php" class="boton-3">Clic aquí para ir a inicio</a>
    <h2 class="titulo">Usuarios de los Sistemas Tecnológicos:</h2>
    <div class="centrar">
        <form method="POST" action="">
            <label>Nombre de usuario:</label>
            <input type="text" name="nombre" placeholder="Escriba el nombre del usuario" required>
            <br>
            <label>Correo:</label>
            <input type="email" name="correo" placeholder="Escriba el correo asociado" required>
            <br>
            <input type="submit" class="boton-1" name="registro" value="Registrar">
        </form>
    </div>
    <?php
    if (isset($_POST['registro'])) :

        // Incluir la conexión a la BD
        require "conexion.php";

        // Almacenamiento de variables
        $ID = $_POST['ID'];
        $nombre = $_POST['nombre'];
        $correo =  $_POST['correo'];
        
       // Insertar el nuevo registro
        $sql_registro = "INSERT INTO usuariosistecnologico (usertecnid , username, email) VALUES ('$ID', '$nombre','$correo')";
        $resultado_registro = mysqli_query($conexionbd, $sql_registro);

        // Validar si se guardó correctamente
        if ($resultado_registro) :
            echo "<h2 class='titulo'>Usuario guardado exitosamente!</h2>";
        else :
            echo "Error al insertar el usuario: " . mysqli_error($conexionbd);
        endif;

        //Cerrar conexión a la BD
        mysqli_close($conexionbd);
    endif;
    ?>
</body>

</html>