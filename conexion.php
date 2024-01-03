<?php
//Definir variables
$host = "localhost";
$user = "root";
$password = "";
$dbname = "bd_infradascd";

//Conexión a la base de datos
$conexionbd = mysqli_connect($host, $user, $password, $dbname) or die ("Error al conectar la base de datos: ". mysqli_connect_error());

//Establecer conjunto de carácteres
mysqli_set_charset($conexionbd, "utf8");
?>