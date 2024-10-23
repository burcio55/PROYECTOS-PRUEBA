<?php
include('based.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nacionalidad = htmlspecialchars($_POST['nacionalidad']);
    $cedula = htmlspecialchars($_POST['cedula']);

    // Conexión a la base de datos

    $SQL = "SELECT estatus_id, benabled, nusuario_creacion, reporte_tecnico.reportes_fallas.dfecha_creacion, reporte_tecnico.reportes_fallas.snro_reporte, fecha_insercion, cod_estatus, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido
            FROM reporte_tecnico.reportes_fallas
            LEFT JOIN public.personales ON personales.cedula = nusuario_creacion 
            WHERE reporte_tecnico.reportes_fallas.nusuario_creacion = $1 AND personales.nacionalidad = $2 AND reportes_fallas.benabled = 'TRUE'";

    $result = pg_prepare($conn, "my_query", $SQL);
    $result = pg_execute($conn, "my_query", array($cedula, $nacionalidad));

    if (!$result) {
        echo "Error en la consulta: " . pg_last_error($conn);
        exit;
    }

    $element = "";
    $i = 0;

    while ($persona2 = pg_fetch_assoc($result)) {
        $i++;
        $element .= "
                <tr>
                    <td style='word-wrap: break-word; max-width: 150px; overflow: hidden; text-overflow: ellipsis;'>" . $i . "</td>
                    <td style='word-wrap: break-word; max-width: 150px; overflow: hidden; text-overflow: ellipsis;'>" . htmlspecialchars($persona2['primer_nombre'] . ' ' . $persona2['segundo_nombre'] . ' ' . $persona2['primer_apellido'] . ' ' . $persona2['segundo_apellido']) . "</td>
                    <td style='word-wrap: break-word; max-width: 150px; overflow: hidden; text-overflow: ellipsis;'>" . htmlspecialchars($persona2['dfecha_creacion']) . "</td>
                    <td style='word-wrap: break-word; max-width: 150px; overflow: hidden; text-overflow: ellipsis;'>
                        <a href='imprimir_tecnico.php?reporte=" . htmlspecialchars($persona2["snro_reporte"]) . "' target='_blank'>
                            " . htmlspecialchars($persona2["snro_reporte"]) . "
                        </a>
                    </td>
                </tr>
            ";
    }

    if ($element == '') {
        $element = "
                    <tr>
                        <td colspan='4'> Este Usuario no ha registrado nada </td>
                    </tr>
        ";
    }

    echo $element;
    pg_close($conn);
    exit;
}
?>