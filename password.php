<?php require 'sesion.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Contraseñas</title>
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <?php
    // Incluir la conexión a la BD
    //require "conexion.php";

    // Obtener datos de la tabla UsuarioSisTecnologico
    $sql_usersistema = "SELECT * FROM usuarioplataforma";
    $resultado_usersistema = mysqli_query($conexionbd, $sql_usersistema);

    // Obtener datos de la tabla SistemaTecnologico
    $sql_plataforma = "SELECT * FROM plataformatecnologica";
    $resultado_plataforma = mysqli_query($conexionbd, $sql_plataforma);

    if ($resultado_usersistema && $resultado_plataforma):

        // Crear el formulario con los valores de la fila
    ?>

    <a href="index.php" class="boton-3">Clic aquí para ir a inicio</a>
       <h2 class="titulo">Añadir nuevo registro</h2>
       <div class="centrar">
        <form method="POST">

        <label>Plataforma Teccológica:</label>
            <select name="idplataforma" required>
                <option value="">Seleccione la plataforma</option>
                <?php
                // Crear ciclo con los resultados de la tabla 2 para las opciones de la lista desplegable
                foreach ($resultado_plataforma as $fila_plataforma) : ?>
                    <option value="<?= $fila_plataforma['idplataforma'] ?>">
                        <?= $fila_plataforma['nombreplataforma'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br>

            <label>Usuario de la Plataforma:</label>
            <select name="idusuarioplataforma" required>
                <option value="">Seleccione el usuario</option>
                <?php
                // Crear ciclo con los resultados de la tabla 3 para las opciones de la lista desplegable
                foreach ($resultado_usersistema as $fila_userplataforma) : ?>
                    <option value="<?= $fila_userplataforma['idusuarioplataforma'] ?>">
                        <?= $fila_userplataforma['nombre_usuario'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>

            <label>Contraseña:</label>
            <input type="text" name="hashclave" required>
            <br>
        <!--
            <label>Fecha de registro:</label>
            <input type="date" name="ultactualizacion" required>
            <br>
        -->
      
            <input type="submit" class="boton-1" name="agregar" value="Agregar registro">
        </form>
       </div>
    <?php
    else :

        echo "<h3>No es posible agregar datos...</h3>";
    endif;

    if (isset($_POST['agregar'])) :

        // Parametrizando las variables recibidas en el formulario
        $idclave = $_POST['idclave'];
        $userplataforma = $_POST['idusuarioplataforma'];
        $plataforma = $_POST['idplataforma'];
        $contrasena = $_POST['hashclave'];
        $hashcontrasena = base64_encode($contrasena);
        //$hashcontrasena = bin2hex($contrasena); Encriptar en Hexadecimal
        //$fecha_actualizacion = $_POST['ultactualizacion'];
        
        // Insertar el registro en la BD
        $sql_insert = "INSERT INTO gestorclaves (idclave, idusuarioplataforma, idplataforma, hashclave) 
        VALUES ('$idclave', '$userplataforma', '$plataforma', '$hashcontrasena')";
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