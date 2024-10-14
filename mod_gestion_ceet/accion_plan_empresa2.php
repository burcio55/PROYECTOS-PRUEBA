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

$plan_formacion2 = $_REQUEST["plan_formacion2"];

$empresa_id = $_REQUEST["empresa_id"];

/* echo "1 / " . $plan_formacion2;
die(); */

$SQL = "UPDATE reporte_ceet.plan_formacion_rnee_empresa SET benabled = 'FALSE' WHERE id = '" . $plan_formacion2 . "'";
if ($resultado = pg_query($conn, $SQL)) {
    /* echo "Se eliminó el registro con éxito ";
    die(); */

    $PG9 = "SELECT plan_formacion_rnee_empresa.rnee_empresa_id, ";
    $PG9 .= "plan_formacion_rnee_empresa.plan_formacion_id, ";
    $PG9 .= "reporte_ceet.plan_formacion.sdescripcion, ";
    $PG9 .= "plan_formacion_rnee_empresa.dfecha_plan_formacion, ";
    $PG9 .= "plan_formacion_rnee_empresa.benabled, ";
    $PG9 .= "plan_formacion_rnee_empresa.nusuario_creacion, ";
    $PG9 .= "plan_formacion_rnee_empresa.dfecha_creacion, ";
    $PG9 .= "plan_formacion_rnee_empresa.nusuario_actualizacion, ";
    $PG9 .= "plan_formacion_rnee_empresa.dfecha_actualizacion, ";
    $PG9 .= "plan_formacion_rnee_empresa.id ";
    $PG9 .= "FROM reporte_ceet.plan_formacion_rnee_empresa ";
    $PG9 .= "inner join reporte_ceet.plan_formacion on reporte_ceet.plan_formacion.id = plan_formacion_rnee_empresa.plan_formacion_id ";
    $PG9 .= "WHERE ";
    $PG9 .= "plan_formacion_rnee_empresa.rnee_empresa_id = '$empresa_id' ";
    $PG9 .= "AND  ";
    $PG9 .= "plan_formacion_rnee_empresa.benabled = 'TRUE'  ";
    $PG9 .= "OFFSET 0";

    $row2 = pg_query($conn, $PG9);

    $cosa = "";

    while ($persona2 = pg_fetch_assoc($row2)) {

        $valor = $persona2["id"];

        $i++;
        $cosa .= "<tr>
                <td>" . $i . "</td>
                <td>" . $persona2['sdescripcion'] . "</td>
                <td id=\"botones\">
                    <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_plan_empresa_del(" . $valor . "," . $empresa_id . ")\">Eliminar </button>
                </td>
            </tr>
        ";
    }
    // En caso de error
    if ($cosa == "") {
        $cosa = "No hay ningún dato en la tabla";
        echo $cosa;
        die();
    }

    echo $cosa;
} else {
    echo "Falló la eliminación por: " . $SQL;
    die();
}
