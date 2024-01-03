<?php require 'sesion.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de solicitudes</title>
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <?php
    // Incluir la conexión a la BD
    require "conexion.php";

    // Obtener datos de la tabla usuarios
    $sql_usuarios = "SELECT * FROM usuarios";
    $resultado_usuarios = mysqli_query($conexionbd, $sql_usuarios);

    // Obtener datos de la tabla elementos
    $sql_elementos = "SELECT * FROM elementos";
    $resultado_elementos = mysqli_query($conexionbd, $sql_elementos);

    if ($resultado_usuarios && $resultado_elementos) :

        // Crear el formulario con los valores de la fila
    ?>
    <a href="index.php" class="boton-3">Clic aquí para ir a inicio</a>
       <h2 class="titulo">Añadir nuevo registro</h2>
       <div class="centrar">
        <form method="POST">
            <label>Usuario:</label>
            <select name="idUsuario" required>
                <option value="">Seleccione un usuario...</option>
                <?php

                // Crear ciclo con los resultados de la tabla 2 para las opciones de la lista desplegable
                foreach ($resultado_usuarios as $fila_usuario) : ?>
                    <option value="<?= $fila_usuario['idUsuario'] ?>">
                        <?= $fila_usuario['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br>

            <label>Elemento:</label>
            <select name="idElemento" required>
                <option value="">Seleccione un elemento...</option>
                <?php
                // Crear ciclo con los resultados de la tabla 3 para las opciones de la lista desplegable
                foreach ($resultado_elementos as $fila_elemento) : ?>
                    <option value="<?= $fila_elemento['idElemento'] ?>">
                        <?= $fila_elemento['nombre_elementos'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br>

            <label>Fecha solicitud:</label>
            <input type="date" name="fecha_solicitud" required>

            <br>

            <label>Fecha devolución:</label>
            <input type="date" name="fecha_devolucion" required>

            <br>

            <label>Comentarios:</label>
            <input type="text" name="comentarios">

            <br>

            <input type="submit" class="boton-1" name="agregar" value="Agregar registro">
        </form>
       </div>
    <?php
    else :

        echo "<h3>No es posible agregar datos...</h3>";
    endif;

    if (isset($_POST['agregar'])) :

        // Parametrizando las variables recibidas en el formulario
        $idUsuario = $_POST['idUsuario'];
        $idElemento = $_POST['idElemento'];
        $fecha_solicitud = $_POST['fecha_solicitud'];
        $fecha_devolucion = $_POST['fecha_devolucion'];
        $comentarios = $_POST['comentarios'];

        // Insertar el registro en la BD
        $sql_insert = "INSERT INTO solicitud_prestamo (fecha_solicitud, idElemento, idUsuario, fecha_devolucion, comentarios) VALUES ('$fecha_solicitud', '$idElemento', '$idUsuario', '$fecha_devolucion', '$comentarios')";
        $resultado_insert = mysqli_query($conexionbd, $sql_insert);

        // Validar si se añadió correctamente
        if ($resultado_insert) :
            echo "<h2 class='titulo'>Registro guardado exitosamente!</h2>";
        else :
            echo "Error al insertar el registro: " . mysqli_error($conexionbd);
        endif;
    endif;

    //Cerrar conexión a la BD
    mysqli_close($conexionbd);
    ?>
</body>

</html>