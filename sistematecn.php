<?php require "sesion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistemas Tecnológicos</title>
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <a href="index.php" class="boton-3">Clic aquí para ir a inicio</a>
    <h2 class="titulo">Sistemas Tecnológicos del DASCD:</h2>
    <div class="centrar">
        <form method="POST" action="">
            <label>Nombre del Sistema:</label>
            <input type="text" name="nombre" placeholder="Escriba el nombre del sistema" required>
            <br>
            <label>Descripción:</label>
            <input type="text" name="descripcion" placeholder="Describa el sistema" required>
            <br>
            <label>Enlace:</label>
            <input type="text" name="config" placeholder="Relacione la configuración" required>
            <br>
            <input type="submit" class="boton-1" name="registro" value="Registrar">
        </form>
    </div>
    <?php
    if (isset($_POST['registro'])) :

        // Incluir la conexión a la BD
        require "conexion.php";

        // Almacenamiento de variables
        $placa = $_POST['placa'];
        $nombre = $_POST['nombre'];
        $descrip =  $_POST['descripcion'];
        $config =  $_POST['config'];
        
       // Insertar el nuevo registro
        $sql_registro = "INSERT INTO sistematecnologico (sistemaid, nombresistema , descripcion, configuracion) VALUES ('$placa','$nombre','$descrip','$config')";
        $resultado_registro = mysqli_query($conexionbd, $sql_registro);

        // Validar si se guardó correctamente
        if ($resultado_registro) :
            echo "<h2 class='titulo'>Sistema guardado exitosamente!</h2>";
        else :
            echo "Error al insertar el Sistema: " . mysqli_error($conexionbd);
        endif;

        //Cerrar conexión a la BD
        mysqli_close($conexionbd);
    endif;
    ?>
</body>

</html>