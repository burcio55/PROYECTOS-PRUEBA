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

$id_aprendizaje = $_REQUEST["id_aprendizaje"];
$empresa_id = $_REQUEST["empresa_id"];
/* echo "  " . $id_aprendizaje . " " . $empresa_id;
die(); */

$SQL = "UPDATE reporte_ceet.ambiente_aprendizaje_rnee_empresa SET benabled = 'FALSE' WHERE id = '" . $id_aprendizaje . "'";
if ($resultado = pg_query($conn, $SQL)) {
    /* echo "Se eliminó el registro con éxito ";
    die(); */

    $PG12 = "SELECT ambiente_aprendizaje_rnee_empresa.rnee_empresa_id, ";
    $PG12 .= "ambiente_aprendizaje_rnee_empresa.ambiente_aprendizaje_id, ";
    $PG12 .= "reporte_ceet.ambiente_aprendizaje.sdescripcion, ";
    $PG12 .= "ambiente_aprendizaje_rnee_empresa.dfecha_ambiente_aprendizaje, ";
    $PG12 .= "ambiente_aprendizaje_rnee_empresa.benabled, ";
    $PG12 .= "ambiente_aprendizaje_rnee_empresa.nusuario_creacion, ";
    $PG12 .= "ambiente_aprendizaje_rnee_empresa.dfecha_creacion, ";
    $PG12 .= "ambiente_aprendizaje_rnee_empresa.nusuario_actualizacion, ";
    $PG12 .= "ambiente_aprendizaje_rnee_empresa.dfecha_actualizacion, ";
    $PG12 .= "ambiente_aprendizaje_rnee_empresa.id ";
    $PG12 .= "FROM reporte_ceet.ambiente_aprendizaje_rnee_empresa ";
    $PG12 .= "inner join reporte_ceet.ambiente_aprendizaje on reporte_ceet.ambiente_aprendizaje.id = ambiente_aprendizaje_rnee_empresa.ambiente_aprendizaje_id ";
    $PG12 .= "WHERE ";
    $PG12 .= "ambiente_aprendizaje_rnee_empresa.rnee_empresa_id = '" . $empresa_id  . "' ";
    $PG12 .= "AND ";
    $PG12 .= "ambiente_aprendizaje_rnee_empresa.benabled = 'TRUE'";

    $row5 = pg_query($conn, $PG12);

    $cosa4 = "";

    while ($persona5 = pg_fetch_assoc($row5)) {

        $valor = $persona5["id"];

        $i4++;
        $cosa4 .= "<tr>
            <td>" . $i4 . "</td>
            <td>" . $persona5['sdescripcion'] . "</td>
            <td id=\"botones\">
                <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_aprendizaje_empresa_del(" . $valor . "," . $empresa_id . ")\">Eliminar </button>
            </td>
        </tr>
    ";
    }
    // En caso de error
    if ($cosa4 == "") {
        echo "No hay ningún dato en la Tabla";
    }

    echo $cosa4;
} else {
    echo "Falló la eliminación por: " . $SQL;
    die();
}
