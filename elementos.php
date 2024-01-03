<?php require "sesion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de elementos</title>
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <a href="index.php" class="boton-3">Clic aquí para ir a inicio</a>
    <h2 class="titulo">Registro de elementos:</h2>
    <div class="centrar">
        <form method="POST" action="">
            <label>Nombre:</label>
            <input type="text" name="nombre" placeholder="Escriba el nombre" required>
            <br>
            <label>Tipo:</label>
            <input type="text" name="tipo" placeholder="Escriba el tipo" required>
            <br>
            <label>Fecha Ingreso:</label>
            <input type="date" name="fecha" required>
            <br>
            <label>Cantidad:</label>
            <input type="number" name="cantidad" placeholder="Digite la cantidad" required>
            <br>
            <input type="submit" class="boton-1" name="ingreso" value="Ingresar">
        </form>
    </div>
    <?php
    if (isset($_POST['ingreso'])) :

        // Incluir la conexión a la BD
        require "conexion.php";

        // Almacenamiento de variables
        $nombre = $_POST['nombre'];
        $tipo = $_POST['tipo'];
        $fecha =  $_POST['fecha'];
        $cantidad = $_POST['cantidad'];

        // Insertar el nuevo registro
        $sql_registro = "INSERT INTO elementos (nombre_elementos, tipo, fecha_ingreso, cantidad) VALUES ('$nombre','$tipo', '$fecha', '$cantidad')";
        $resultado_registro = mysqli_query($conexionbd, $sql_registro);

        // Validar si se guardó correctamente
        if ($resultado_registro) :
            echo "<h2 class='titulo'>Elemento guardado exitosamente!</h2>";
        else :
            echo "Error al insertar el usuario: " . mysqli_error($conexionbd);
        endif;

        //Cerrar conexión a la BD
        mysqli_close($conexionbd);
    endif;
    ?>
</body>

</html>