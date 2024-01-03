<?php require "sesion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <?php
    // Incluir la conexión a la BD
    require "conexion.php";

    // Verificar si se recibe el parámetro ID
    if (isset($_GET['id'])) :
        $id = $_GET['id']; ?>

        <script>
            alert("Está eliminando un registro!!");
        </script>

    <?php
        // Eliminar el registro de la BD
        $sql = "DELETE FROM solicitud_prestamo WHERE idSolicitud = $id";
        $resultado = mysqli_query($conexionbd, $sql);

        if ($resultado) :
            echo "<h2 class='titulo'>Solicitud eliminada exitosamente</h2>";
        else :
            echo "Error al eliminar solicitud " . mysqli_error($conexionbd);
        endif;
    else :
        echo "No se recibió el parámetro ID...";
    endif;

    //Cerrar conexión a la BD
    mysqli_close($conexionbd);
    ?>
    <a href="index.php" class="boton-3">Clic aquí para ir a inicio</a>
</body>

</html>