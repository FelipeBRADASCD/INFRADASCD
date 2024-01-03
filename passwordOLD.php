<?php require "sesion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Contraseñas</title>
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <a href="index.php" class="boton-3">Clic aquí para ir a inicio</a>
    <h2 class="titulo">Gestor de Contraseñas:</h2>
    <div class="centrar">
        <form method="POST" action="">
            <label>Nombre de Sistema:</label>
            <input type="text" name="NombreSistema" placeholder="Escriba el sistema asociado" required>
            <br>
            <label>Usuario del Sistema Tecnológico:</label>
            <input type="text" name="UserName" placeholder="Digite el nombre de usuario" required>
            <br>
            <label>Constraseña:</label>
            <input type="text" name="PasswordHash" placeholder="Escriba la constraseña" required>
            <br>
            <label>Fecha de Registro:</label>
            <input type="date" name="UltActualizacion" required>
            <br>
            <input type="submit" class="boton-1" name="ingreso" value="Ingresar">
        </form>
    </div>
    <?php
    
    if (isset($_POST['ingreso'])) :

        // Incluir la conexión a la BD
        require "conexion.php";

        // Almacenamiento de variables
        $sistema = $_POST['NombreSistema'];
        $usuario = $_POST['UserName'];
        $password =  $_POST['PasswordHash'];
        $fecha = $_POST['UltActualizacion'];

        // Insertar el nuevo registro
        $sql_registro = "INSERT INTO passwsistema (NombreSistema, UserName, PasswordHash, UltActualizacion) VALUES ('$sistema','$usuario', '$password', '$fecha')";
        $resultado_registro = mysqli_query($conexionbd, $sql_registro);

        // Validar si se guardó correctamente
        if ($resultado_registro) :
            echo "<h2 class='titulo'>Contraseña guardada exitosamente!</h2>";
        else :
            echo "Error al insertar el registro: " . mysqli_error($conexionbd);
        endif;

        //Cerrar conexión a la BD
        mysqli_close($conexionbd);
    endif;
    ?>
</body>

</html>