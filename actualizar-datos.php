<?php require "sesion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Datos</title>
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <a href="index.php" class="boton-3">Clic aquí para ir a inicio</a>
    <?php
    // Verificar si se recibe el parámetro ID
    if (isset($_GET['id'])) :
        $id = $_GET['id'];

        if (isset($_POST['editar'])) :
            $nombreplataforma = $_POST['nombreplataforma'];
            $descripcion = $_POST['descripcion'];
            $enlace = $_POST['enlace'];
            $nombre_usuario = $_POST['nombre_usuario'];
            $correo = $_POST['correo'];

            // Actualizar el registro en la BD
            $sql_update = "UPDATE plataformatecnologica 
            inner join usuarioplataforma 
            on plataformatecnologica.idplataforma=usuarioplataforma.idplataforma
            SET nombreplataforma='$nombreplataforma', descripcion='$descripcion', enlace='$enlace', 
            nombre_usuario='$nombre_usuario',  correo='$correo' WHERE WHERE idplataforma=$id";
            $resultado_update = mysqli_query($conexionbd, $sql_update);

            // Validar si se actualizó correctamente
            if ($resultado_update) :
                echo "<h2 class='titulo'>Registro modificado exitosamente!</h2>";
            else :
                echo "Error al modificar el registro: " . mysqli_error($conexionbd);
            endif;

        else :
            // Obtener datos de la tabla que se muestra en el consultapassword
            $sql = "SELECT * FROM plataformatecnologica WHERE idplataforma = $id";
            $resultado = mysqli_query($conexionbd, $sql);

            // Comprobar si se obtienen datos
            if ($resultado) :
                // Se asigna dentro de una variable el resultado de una sola fila
                $fila = mysqli_fetch_assoc($resultado);

                // Obtener datos de la tabla 2
                $sql_plataforma = "SELECT * FROM plataformatecnologica";
                $resultado_plataforma = mysqli_query($conexionbd, $sql_plataforma);

                // Obtener datos de la tabla 3
                $sql_usuario = "SELECT * FROM usuarioplataforma";
                $resultado_elementos = mysqli_query($conexionbd, $sql_usuario);

                // Crear el formulario con los valores de la fila
    ?>

                <h2 class="titulo">Modificar registros</h2>
                <div class="centrar">
                    <form method="POST">
                        <label>Nombre de Plataforma:</label>
                        <select name="nombreplataforma">
                            <?php

                            // Crear ciclo con los resultados de la tabla 2 para las opciones de la lista desplegable
                            foreach ($resultado_plataforma as $fila_plataforma) : ?>
                                <option value="<?= $fila_plataforma['nombreplataforma'] ?>" <?php
                                                                                            // Validar que cuando el id de la tabla 2 sea el mismo al que está llamando en la tabla del index, se agregue el atributo selected
                                                                                            if ($fila_plataforma['nombreplataforma'] == $fila['nombreplataforma']) :
                                                                                                echo "selected";
                                                                                            endif; ?>><?= $fila_plataforma['nombreplataforma'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>

                        <label>Descripción:</label>
                        <input type="text" name="descripcion" value="<?= $fila['descripcion'] ?>">
                        <br>

                        <label>Enlace:</label>
                        <input type="text" name="enlace" value="<?= $fila['enlace'] ?>">
                        <br>

                        <label>Usuario de la Plataforma:</label>
                        <select name="usuarioplataforma">
                            <?php

                            // Crear ciclo con los resultados de la tabla 2 para las opciones de la lista desplegable
                            foreach ($resultado_usuarioplat as $fila_usuarioplat) : ?>
                                <option value="<?= $fila_usuarioplat['usuarioplataforma'] ?>" <?php
                                                                                                // Validar que cuando el id de la tabla 2 sea el mismo al que está llamando en la tabla del index, se agregue el atributo selected
                                                                                                if ($fila_usuarioplat['usuarioplataforma'] == $fila['usuarioplataforma']) :
                                                                                                    echo "selected";
                                                                                                endif; ?>><?= $fila_usuarioplat['usuarioplataforma'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>

                        <label>Correo:</label>
                        <input type="text" name="enlace" value="<?= $fila['enlace'] ?>">
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



</body>

</html>