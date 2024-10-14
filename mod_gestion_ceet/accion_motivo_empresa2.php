<?php
$host = "10.46.1.93";
$dbname = "minpptrassi";
$user = "postgres";
$pass = "postgres";

session_start();

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$id_motivo = $_REQUEST["id_motivo"];
$empresa_id = $_REQUEST["empresa_id"];

/* echo " " . $id_motivo . " " . $empresa_id;
die(); */

$SQL = "UPDATE reporte_ceet.motivos_vis_rnee_empresa SET benabled = 'FALSE' WHERE id = '" . $id_motivo . "'";
/* echo " 0 / " . $SQL;
die(); */
if ($resultado = pg_query($conn, $SQL)) {
    /* echo "Se eliminó el registro con éxito ";
    die(); */

    $PG9 = "SELECT motivos_vis_rnee_empresa.rnee_empresa_id, ";
    $PG9 .= "motivos_vis_rnee_empresa.motivo_visita_id, ";
    $PG9 .= "reporte_ceet.motivo_visita.sdescripcion,";
    $PG9 .= "motivos_vis_rnee_empresa.dfecha_visita, ";
    $PG9 .= "motivos_vis_rnee_empresa.benabled, ";
    $PG9 .= "motivos_vis_rnee_empresa.nusuario_creacion, ";
    $PG9 .= "motivos_vis_rnee_empresa.dfecha_creacion, ";
    $PG9 .= "motivos_vis_rnee_empresa.nusuario_actualizacion, ";
    $PG9 .= "motivos_vis_rnee_empresa.dfecha_actualizacion, ";
    $PG9 .= "motivos_vis_rnee_empresa.id ";
    $PG9 .= "FROM reporte_ceet.motivos_vis_rnee_empresa ";
    $PG9 .= "inner join reporte_ceet.motivo_visita on reporte_ceet.motivo_visita.id = motivos_vis_rnee_empresa.motivo_visita_id ";
    $PG9 .= "WHERE ";
    $PG9 .= "motivos_vis_rnee_empresa.rnee_empresa_id = '" . $empresa_id  . "' ";
    $PG9 .= "AND ";
    $PG9 .= "motivos_vis_rnee_empresa.benabled = 'TRUE' ";
    $PG9 .= "OFFSET 0";

    $row2 = pg_query($conn, $PG9);

    $cosa = "";

    while ($persona2 = pg_fetch_assoc($row2)) {

        $i++;
        $cosa .= "<tr>
                <td>" . $i . "</td>
                <td>" . $persona2['sdescripcion'] . "</td>
                <td id=\"botones\">
                    <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar_empresa(" . $persona2["id"] . "," . $empresa_id . ")\">Eliminar </button>
                </td>
            </tr>
        ";
    }
    // En caso de error
    if ($cosa == "") {
        echo "No hay ningún dato en la tabla";
    }

    echo $cosa;
} else {
    echo "Falló la eliminación por: " . $SQL;
    die();
}
