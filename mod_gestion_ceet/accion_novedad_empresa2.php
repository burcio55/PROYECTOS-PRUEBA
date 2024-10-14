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

$novedades2 = $_REQUEST["novedades2"];

$empresa_id = $_REQUEST["empresa_id"];
/* echo " " . $novedades2 . " " . $empresa_id;
die(); */


$SQL = "UPDATE reporte_ceet.novedades_rnee_empresa SET benabled = 'FALSE' WHERE id = '" . $novedades2 . "'";
if ($resultado = pg_query($conn, $SQL)) {
    /* echo "Se eliminó el registro con éxito ";
    die(); */

    $PG9 = "SELECT novedades_rnee_empresa.rnee_empresa_id, ";
    $PG9 .= "novedades_rnee_empresa.novedades_id, ";
    $PG9 .= "reporte_ceet.novedades.sdescripcion,";
    $PG9 .= "novedades_rnee_empresa.dfecha_visita, ";
    $PG9 .= "novedades_rnee_empresa.benabled, ";
    $PG9 .= "novedades_rnee_empresa.nusuario_creacion, ";
    $PG9 .= "novedades_rnee_empresa.dfecha_creacion, ";
    $PG9 .= "novedades_rnee_empresa.nusuario_actualizacion, ";
    $PG9 .= "novedades_rnee_empresa.dfecha_actualizacion, ";
    $PG9 .= "novedades_rnee_empresa.id ";
    $PG9 .= "FROM reporte_ceet.novedades_rnee_empresa ";
    $PG9 .= "inner join reporte_ceet.novedades on reporte_ceet.novedades.id = novedades_rnee_empresa.novedades_id ";
    $PG9 .= "WHERE ";
    $PG9 .= "novedades_rnee_empresa.rnee_empresa_id = '$empresa_id' ";
    $PG9 .= "AND ";
    $PG9 .= "novedades_rnee_empresa.benabled = 'TRUE' ";
    $PG9 .= "OFFSET 0";

    $row2 = pg_query($conn, $PG9);

    $cosa = "";

    while ($persona2 = pg_fetch_assoc($row2)) {

        $i++;
        $cosa .= "<tr>
                <td>" . $i . "</td>
                <td>" . $persona2['sdescripcion'] . "</td>
                <td id=\"botones\">
                    <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_novedades_empresa_del(" . $persona2["id"] . "," . $empresa_id . ")\">Eliminar </button>
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
