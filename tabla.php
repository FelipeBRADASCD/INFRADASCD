<?php require "sesion.php"; ?>
<?php

// Consulta a la BD
$sql = "SELECT solicitud_prestamo.*, usuarios.nombre, elementos.nombre_elementos
FROM solicitud_prestamo 
INNER JOIN usuarios ON solicitud_prestamo.idUsuario = usuarios.idUsuario
INNER JOIN elementos ON solicitud_prestamo.idElemento = elementos.idElemento
ORDER BY idSolicitud ASC";
$resultado = mysqli_query($conexionbd, $sql);

if ($resultado) :
    // Pintar la tabla
?>
    <h2 class="titulo">Tabla de Préstamos:</h2>

    <div class="centrar">
        <table border="1">
            <tr>
                <th>ID Solicitud</th>
                <th>Nombre Usuario</th>
                <th>Nombre Elemento</th>
                <th>Fecha de solicitud</th>
                <th>Fecha de devolución</th>
                <th>Comentarios</th>
                <th>Acción 1</th>
                <th>Acción 2</th>
            </tr>

            <?php
            // Repetir fila de acuerdo al resultado del query
            foreach ($resultado as $fila) : ?>
                <tr>
                    <td><?php echo $fila['idSolicitud'] ?></td>
                    <td><?= $fila['nombre'] ?></td>
                    <td><?= $fila['nombre_elementos'] ?></td>
                    <td><?= $fila['fecha_solicitud'] ?></td>
                    <td><?= $fila['fecha_devolucion'] ?></td>
                    <td><?= $fila['comentarios'] ?></td>
                    <td><a href="eliminar.php?id=<?= $fila['idSolicitud'] ?>" class="boton-2">Eliminar</a></td>
                    <td><a href="editar.php?id=<?= $fila['idSolicitud'] ?>" class="boton-2">Editar</a></td>
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