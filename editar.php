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
        $id = $_GET['id'];

        if (isset($_POST['editar'])) :
            $idUsuario = $_POST['idUsuario'];
            $idElemento = $_POST['idElemento'];
            $fecha_solicitud = $_POST['fecha_solicitud'];
            $fecha_devolucion = $_POST['fecha_devolucion'];

            // Actualizar el registro en la BD
            $sql_update = "UPDATE solicitud_prestamo SET idUsuario='$idUsuario', idElemento='$idElemento', fecha_solicitud='$fecha_solicitud', fecha_devolucion='$fecha_devolucion' WHERE idSolicitud=$id";
            $resultado_update = mysqli_query($conexionbd, $sql_update);

            // Validar si se actualizó correctamente
            if ($resultado_update) :
                echo "<h2 class='titulo'>Registro modificado exitosamente!</h2>";
            else :
                echo "Error al modificar el registro: " . mysqli_error($conexionbd);
            endif;

        else :
            // Obtener datos de la tabla que se muestra en el index
            $sql = "SELECT * FROM solicitud_prestamo WHERE idSolicitud = $id";
            $resultado = mysqli_query($conexionbd, $sql);

            // Comprobar si se obtienen datos
            if ($resultado) :
                // Se asigna dentro de una variable el resultado de una sola fila
                $fila = mysqli_fetch_assoc($resultado);

                // Obtener datos de la tabla 2
                $sql_usuarios = "SELECT * FROM usuarios";
                $resultado_usuarios = mysqli_query($conexionbd, $sql_usuarios);

                // Obtener datos de la tabla 3
                $sql_elementos = "SELECT * FROM elementos";
                $resultado_elementos = mysqli_query($conexionbd, $sql_elementos);

                // Crear el formulario con los valores de la fila
    ?>
                
                <h2 class="titulo">Modificar registro</h2>
                <div class="centrar">
                    <form method="POST">
                        <label>Usuario:</label>
                        <select name="idUsuario">
                            <?php

                            // Crear ciclo con los resultados de la tabla 2 para las opciones de la lista desplegable
                            foreach ($resultado_usuarios as $fila_usuario) : ?>
                                <option value="<?= $fila_usuario['idUsuario'] ?>" <?php
                                                                                    // Validar que cuando el id de la tabla 2 sea el mismo al que está llamando en la tabla del index, se agregue el atributo selected
                                                                                    if ($fila_usuario['idUsuario'] == $fila['idUsuario']) :
                                                                                        echo "selected";
                                                                                    endif; ?>><?= $fila_usuario['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <label>Elemento:</label>
                        <select name="idElemento">
                            <?php

                            // Crear ciclo con los resultados de la tabla 3 para las opciones de la lista desplegable
                            foreach ($resultado_elementos as $fila_elemento) : ?>
                                <option value="<?= $fila_elemento['idElemento'] ?>" <?php
                                                                                    // Validar que cuando el id de la tabla 3 sea el mismo al que está llamando en la tabla del index, se agregue el atributo selected
                                                                                    if ($fila_elemento['idElemento'] == $fila['idElemento']) :
                                                                                        echo "selected";
                                                                                    endif; ?>><?= $fila_elemento['nombre_elementos'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <label>Fecha solicitud:</label>
                        <input type="date" name="fecha_solicitud" value="<?= $fila['fecha_solicitud'] ?>">
                        <br>
                        <label>Fecha devolución:</label>
                        <input type="date" name="fecha_devolucion" value="<?= $fila['fecha_devolucion'] ?>">
                        <br>
                        <label>Comentarios:</label>
                        <input type="text" name="comentarios" value="<?= $fila['comentarios'] ?>" disabled>
                        <br>
                        <input type="submit" class="boton-1" name="editar" value="Actualizar">
                    </form>
                </div>
    <?php
            endif;

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