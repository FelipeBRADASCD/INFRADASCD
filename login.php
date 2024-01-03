<?php
// Iniciar la sesión
session_start();

// Valida si ha iniciado sesión
if (isset($_SESSION['logueo']) && $_SESSION['logueo'] === true) :

    //Redirigir al index para iniciar 
    header('Location: index.php');
    exit();
endif;

if (isset($_POST['sesion'])) :

    // Incluir la conexión a la BD
    require "conexion.php";

    // Parametrizar y obtener datos del formulario
    $username = $_POST['usuario'];
    $clave = $_POST['clave'];

    $sql_sesion = "SELECT idusuarios, contrasena, activo FROM usuarios WHERE username = '$username'";
    $resultado_sesion = mysqli_query($conexionbd, $sql_sesion);

    // Validar que el resultado del query genera una sola fila
    if (mysqli_num_rows($resultado_sesion) == 1) :
        // Se asigna dentro de una variable el resultado de una sola fila
        $fila_sesion = mysqli_fetch_assoc($resultado_sesion);

        //Se valida que el usuario esté activo
        if ($fila_sesion['activo'] == 1) :
            // Verifica si la contraseña es correcta con la encriptación guardada en la bd
            if (password_verify($clave, $fila_sesion['contrasena'])) :

                // Almacenar en una sesión el nombre y la cedula del usuario
                $_SESSION['logueo'] = true;
                $_SESSION['username'] = $username;

                //Redirigir al usuario a la página principal
                header('Location: index.php');


            else :
                echo "<h2>Contraseña incorrecta, intente nuevamente!</h2>";
            endif;
        else :
            echo "<h2>Usuario inactivo, contacte al administrador del sistema</h2>";
        endif;
    else :
        echo "<h2>Usuario no registrada en el sistema, contacte al administrador</h2>";
    endif;

    //Cerrar conexión a la BD
    mysqli_close($conexionbd);
endif;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <h1 class="titulo">Iniciar sesión</h1>
    <div class="centrar">
        <form method="POST" action="">
            <label>Usuario:</label>
            <input type="text" name="usuario" placeholder="Ingrese su usuario" required>
            <br>
            <label>Contraseña:</label>
            <input type="password" name="clave" placeholder="Ingrese su clave" required>
            <br>
            <input type="submit" class="boton-1" name="sesion" value="Iniciar sesión">
        </form>
    </div>
</body>

</html>