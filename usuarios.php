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
    <a href="index.php" class="boton-3">Clic aquí para ir a inicio</a>
    <h2 class="titulo">Registro de usuarios:</h2>
    <div class="centrar">
        <form method="POST" action="">
            <label>Nombre de Usuario:</label>
            <input type="text" name="username" placeholder="Escriba el nombre de usuario" required>
            <br>
            <label>Cédula:</label>
            <input type="text" name="cedula" placeholder="Escriba la cedula" required>
            <br>
            <label>Correo:</label>
            <input type="email" name="correo" placeholder="Escriba el correo" required>
            <br>
            <label>Nombres:</label>
            <input type="text" name="nombres" placeholder="Escriba los nombres" required>
            <br>
            <label>Apellidos:</label>
            <input type="text" name="apellidos" placeholder="Escriba los apellidos" required>
            <br>

            <?php
            // Obtener datos de la tabla dependencias
            $sql_dependencias = "SELECT * FROM dependencias";
            $resultado_dependencias = mysqli_query($conexionbd, $sql_dependencias);

            if ($resultado_dependencias) :

            ?>
                <label>Dependencia:</label>
                <select name="dependencia" required>
                    <option value="">Seleccione una dependencia...</option>
                    <?php
                    // Crear ciclo con los resultados de la tabla 3 para las opciones de la lista desplegable
                    foreach ($resultado_dependencias as $fila_dependencia) : ?>
                        <option value="<?= $fila_dependencia['iddependencia'] ?>">
                            <?= $fila_dependencia['nombredependencia'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php
            endif;
            ?>

            <br>
            <label>Contraseña:</label>
            <input type="password" minlength="8" name="clave" placeholder="Escriba la clave" required>
            <br>
            <label>Cargo:</label>
            <input type="text" name="cargo" placeholder="Escriba el cargo" required>
            <br>
            <label>Rol:</label>
            <select name="rol">
                <option value="">Seleccione una opción</option>
                <option value="1">Administrador</option>
                <option value="2">Colaborador</option>
                <option value="3">Consulta</option>
            </select>
            <br>

            <input type="submit" class="boton-1" name="registro" value="Registrar">
        </form>
    </div>
    <?php
    if (isset($_POST['registro'])) :

        // Almacenamiento de variables
        $username = $_POST['username'];
        $cedula = $_POST['cedula'];
        $correo =  $_POST['correo'];
        $nombre = $_POST['nombres'];
        $apellido = $_POST['apellidos'];
        $dependencia = $_POST['dependencia'];
        $clave = $_POST['clave'];
        $cargo = $_POST['cargo'];
        $rol = $_POST['rol'];  
        $activo = 1;

        // Encriptar la contraseña
        $clave_encriptada = password_hash($clave, PASSWORD_BCRYPT);

        // Insertar el nuevo registro
        $sql_registro = "INSERT INTO usuarios (username, cedula, correo, nombres, apellidos, iddependencia, contrasena, cargo, activo, rol) 
        VALUES ('$username','$cedula', '$correo','$nombre','$apellido', '$dependencia', '$clave_encriptada','$cargo','$activo','$rol')";
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