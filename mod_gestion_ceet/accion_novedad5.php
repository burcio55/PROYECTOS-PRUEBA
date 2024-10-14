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

$id_novedad = $_REQUEST["id_novedad"];

$SQL = "UPDATE reporte_ceet.novedades_trabajador_indep SET benabled = 'FALSE' WHERE id = '" . $id_novedad . "'";
/* echo $id_novedad;
die(); */
if ($resultado = pg_query($conn, $SQL)) {

    $PG9 = "SELECT novedades_trabajador_indep.trabajador_indep_id, ";
    $PG9 .= "novedades_trabajador_indep.novedades_id, ";
    $PG9 .= "reporte_ceet.novedades.sdescripcion,";
    $PG9 .= "novedades_trabajador_indep.dfecha_visita, ";
    $PG9 .= "novedades_trabajador_indep.benabled, ";
    $PG9 .= "novedades_trabajador_indep.nusuario_creacion, ";
    $PG9 .= "novedades_trabajador_indep.dfecha_creacion, ";
    $PG9 .= "novedades_trabajador_indep.nusuario_actualizacion, ";
    $PG9 .= "novedades_trabajador_indep.dfecha_actualizacion, ";
    $PG9 .= "novedades_trabajador_indep.id ";
    $PG9 .= "FROM reporte_ceet.novedades_trabajador_indep ";
    $PG9 .= "inner join reporte_ceet.novedades on reporte_ceet.novedades.id = novedades_trabajador_indep.novedades_id ";
    $PG9 .= "WHERE ";
    $PG9 .= "novedades_trabajador_indep.trabajador_indep_id = '" . $_SESSION["trabajador_indep_id"]  . "' ";
    $PG9 .= "AND ";
    $PG9 .= "novedades_trabajador_indep.benabled = 'TRUE' ";
    $PG9 .= "OFFSET 0";

    $row2 = pg_query($conn, $PG9);

    $cosa = "";

    while ($persona2 = pg_fetch_assoc($row2)) {

        if ($i != 1) {
            $valor = $persona2["id"];
        }

        $i++;
        $cosa .= "<tr>
                <td>" . $i . "</td>
                <td>" . $persona2['sdescripcion'] . "</td>
                <td id=\"botones\">
                    <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar3(" . $persona2["id"] . ")\">Eliminar </button>
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