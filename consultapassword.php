<?php require "sesion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Usuarios y Contraseñas</title>
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <a href="index.php" class="boton-3">Clic aquí para ir a inicio</a>
    <h2 class="titulo">Gestor de Usuarios y Contraseñas:</h2>
    <div class="centrar">

        <?php

        // Consulta a la BD
        $sql = "SELECT pt.nombreplataforma, pt.descripcion, pt.enlace, up.nombre_usuario, up.correo, gc.hashclave, gc.fechacreacion, up.idusuarioplataforma
FROM usuarioplataforma as up
INNER JOIN gestorclaves as gc ON up.idusuarioplataforma = gc.idusuarioplataforma
INNER JOIN plataformatecnologica as pt ON up.idplataforma = pt.idplataforma
ORDER BY pt.nombreplataforma ASC";
        $resultado = mysqli_query($conexionbd, $sql);

        if ($resultado) :
            // Pintar la tabla
        ?>

            <div class="centrar">
                <table border="1">
                    <tr>
                        <th>Nombre Plataforma</th>
                        <th>Descripción</th>
                        <th>Enlace</th>
                        <th>Usuario del Sistema</th>
                        <th>Correo de ingreso</th>
                        <th>Contraseña</th>
                        <th>Fecha de Registro</th>
                        <th>Actualizar Datos</th>
                        <th>Actualizar Contraseña</th>
                    </tr>

                    <?php
                    // Repetir fila de acuerdo al resultado del query
                    foreach ($resultado as $fila) : ?>
                        <tr>
                            <td><?= $fila['nombreplataforma'] ?></td>
                            <td><?= $fila['descripcion'] ?></td>
                            <td><a href="<?= $fila['enlace'] ?>" target="_blank"><?= $fila['enlace'] ?></a></td> 
                            <td><?= $fila['nombre_usuario'] ?></td>
                            <td><?= $fila['correo'] ?></td>
                            <td><?= base64_decode($fila['hashclave']) ?></td>
                            <td><?= $fila['fechacreacion'] ?></td>
                            <td><a href="actualizar-datos.php?id=<?= $fila['idusuarioplataforma'] ?>" class="boton-2">Actualizar</a></td>
                            <td><a href="actualizar-clave.php?id=<?= $fila['idusuarioplataforma'] ?>" class="boton-2">Actualizar</a></td>

                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php
        else :
            echo "No se encontraron datos...";

        endif;

        //Cerrar conexión a la BD
        mysqli_close($conexionbd);
        ?>

</body>

</html>