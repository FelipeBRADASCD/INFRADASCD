<?php
// Iniciar la sesión. si la variable del logueo es verdadera, se inicia la sesión
if (session_status() !== PHP_SESSION_ACTIVE):
    // Configura el tiempo de vida máximo de la sesión en segundos
    //ini_set('session.gc_maxlifetime', 18000);

    // Inicia la sesión
    session_start();
    // Incluir la conexión a la BD
    require "conexion.php";

    $username = $_SESSION['username'];

    // Preparar la consulta SQL con un parámetro
    $sql_user = "SELECT cedula, correo, nombres, apellidos, iddependencia, cargo, rol FROM usuarios WHERE username = ?";
    $stmt = mysqli_prepare($conexionbd, $sql_user);
    
    // Vincular el parámetro con su valor
    mysqli_stmt_bind_param($stmt, "s", $username); // "s" indica que el valor es una cadena (string)
    
    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);
    
    // Vincular variables a los resultados
    mysqli_stmt_bind_result($stmt, $cedula, $correo, $nombres, $apellidos, $dependencia, $cargo, $rol);
    
    // Obtener el resultado de la consulta
    mysqli_stmt_fetch($stmt);
    
    // Cerrar la consulta preparada
    mysqli_stmt_close($stmt);


endif;

// Verifica si existe una variable de sesión para el tiempo de la última actividad y si ha pasado el tiempo de inactividad
/*
if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso'] > ini_get('session.gc_maxlifetime'))) :
    // Redirige al usuario a logout.php para destruir la sesión
    header("Location: logout.php");
    exit();
endif;
*/

// Actualiza la variable de sesión del tiempo de la última actividad del usuario en cada interacción
$_SESSION['ultimo_acceso'] = time();


// Valida si la sesión está vacia
if (!isset($_SESSION['logueo']) && $_SESSION['logueo'] !== true) :

    //Redirigir al Login para iniciar sesión
    header('Location: login.php');
    exit();
endif;
