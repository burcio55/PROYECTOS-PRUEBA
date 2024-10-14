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

$SQL = "UPDATE reporte_ceet.ambiente_aprendizaje_trabajador_indep SET benabled = 'FALSE' WHERE id = '" . $id_aprendizaje . "'";
/* echo $id_aprendizaje;
die(); */
if ($resultado = pg_query($conn, $SQL)) {

    $PG9 = "SELECT ambiente_aprendizaje_trabajador_indep.trabajador_indep_id, ";
    $PG9 .= "ambiente_aprendizaje_trabajador_indep.ambiente_aprendizaje_id, ";
    $PG9 .= "reporte_ceet.ambiente_aprendizaje.sdescripcion, ";
    $PG9 .= "ambiente_aprendizaje_trabajador_indep.dfecha_ambiente_aprendizaje, ";
    $PG9 .= "ambiente_aprendizaje_trabajador_indep.benabled, ";
    $PG9 .= "ambiente_aprendizaje_trabajador_indep.nusuario_creacion, ";
    $PG9 .= "ambiente_aprendizaje_trabajador_indep.dfecha_creacion, ";
    $PG9 .= "ambiente_aprendizaje_trabajador_indep.nusuario_actualizacion, ";
    $PG9 .= "ambiente_aprendizaje_trabajador_indep.dfecha_actualizacion, ";
    $PG9 .= "ambiente_aprendizaje_trabajador_indep.id ";
    $PG9 .= "FROM reporte_ceet.ambiente_aprendizaje_trabajador_indep ";
    $PG9 .= "inner join reporte_ceet.ambiente_aprendizaje on reporte_ceet.ambiente_aprendizaje.id = ambiente_aprendizaje_trabajador_indep.ambiente_aprendizaje_id ";
    $PG9 .= "WHERE ";
    $PG9 .= "ambiente_aprendizaje_trabajador_indep.trabajador_indep_id = '" . $_SESSION["trabajador_indep_id"]  . "' ";
    $PG9 .= "AND ";
    $PG9 .= "ambiente_aprendizaje_trabajador_indep.benabled = 'TRUE'";
    $PG9 .= "OFFSET 0";

    $row2 = pg_query($conn, $PG9);

    $cosa = "";

    while ($persona2 = pg_fetch_assoc($row2)) {


        $i++;
        $cosa .= "<tr>
                <td>" . $i . "</td>
                <td>" . $persona2['sdescripcion'] . "</td>
                <td id=\"botones\">
                    <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar4(" . $persona2["id"] . ")\">Eliminar </button>
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
