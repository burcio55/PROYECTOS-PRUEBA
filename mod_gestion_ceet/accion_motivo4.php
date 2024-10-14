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

$motivo = $_REQUEST["motivo"];
$n_nacionalidad = $_REQUEST["n_nacionalidad"];
$personales_cedula = $_REQUEST["personales_cedula"];

// Validaciones

if ($motivo == '-1') {
    echo "1 / Es Obligatorio indicar cuál es el \"Motivo\" a Agregar";
    die();
}
if ($n_nacionalidad == "" || $personales_cedula == "") {
    echo "1 / Es Obligatorio antes buscar a un Trabajador";
    die();
}

/* echo "1 / " . $motivo . " " . $n_nacionalidad . " " . $personales_cedula;
die(); */
$sql = "SELECT * FROM";
$sql .= " reporte_ceet.trabajador_indep";
$sql .= " WHERE";
$sql .= " snacionalidad = '$n_nacionalidad'";
$sql .= " AND";
$sql .= " ncedula = $personales_cedula";
$sql .= " AND";
$sql .= " benabled = 'TRUE'";
$row = pg_query($conn, $sql);
if ($persona = pg_fetch_assoc($row)) {
    $trabajador_indep_id = $persona["id"];
    $_SESSION["trabajador_indep_id"] = $trabajador_indep_id;
    $SQL = "INSERT INTO";
    $SQL .= " reporte_ceet.motivos_vis_trabajador_indep";
    $SQL .= " (";
    $SQL .= " trabajador_indep_id,";
    $SQL .= " motivo_visita_id,";
    $SQL .= " nusuario_creacion";
    $SQL .= ")";
    $SQL .= " VALUES";
    $SQL .= " (";
    $SQL .= "'$trabajador_indep_id',";
    $SQL .= "'$motivo',";
    $SQL .= " 13289657";
    $SQL .= ");";

    if ($resultado = pg_query($conn, $SQL)) {
        $bien = 1;
    } else {
        echo "1 / Falló la inserción, razón: " . $SQL;
        die();
    }
    $PG9 = "SELECT motivos_vis_trabajador_indep.trabajador_indep_id, ";
    $PG9 .= "motivos_vis_trabajador_indep.motivo_visita_id, ";
    $PG9 .= "reporte_ceet.motivo_visita.sdescripcion,";
    $PG9 .= "motivos_vis_trabajador_indep.dfecha_visita, ";
    $PG9 .= "motivos_vis_trabajador_indep.benabled, ";
    $PG9 .= "motivos_vis_trabajador_indep.nusuario_creacion, ";
    $PG9 .= "motivos_vis_trabajador_indep.dfecha_creacion, ";
    $PG9 .= "motivos_vis_trabajador_indep.nusuario_actualizacion, ";
    $PG9 .= "motivos_vis_trabajador_indep.dfecha_actualizacion, ";
    $PG9 .= "motivos_vis_trabajador_indep.id ";
    $PG9 .= "FROM reporte_ceet.motivos_vis_trabajador_indep ";
    $PG9 .= "inner join reporte_ceet.motivo_visita on reporte_ceet.motivo_visita.id = motivos_vis_trabajador_indep.motivo_visita_id ";
    $PG9 .= "WHERE ";
    $PG9 .= "motivos_vis_trabajador_indep.trabajador_indep_id = '" . $_SESSION["trabajador_indep_id"]  . "' ";
    $PG9 .= "AND ";
    $PG9 .= "motivos_vis_trabajador_indep.benabled = 'TRUE' ";
    $PG9 .= "OFFSET 0";

    $row2 = pg_query($conn, $PG9);

    $cosa = " / ";
    while ($persona2 = pg_fetch_assoc($row2)) {

        if ($i != 1) {
            $valor = $persona2["id"];
        }

        $i++;
        $cosa .= "<tr>
                <td>" . $i . "</td>
                <td>" . $persona2['sdescripcion'] . "</td>
                <td id=\"botones\">
                    <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar(" . $valor . ")\">Eliminar </button>
                </td>
            </tr>
        ";
    }
    if ($bien == 1) {
        echo "1 / Se agregó correctamente";
        if ($cosa == "") {
            $cosa = "No hay ningún dato en la tabla";
            echo $cosa;
            die();
        }
        echo $cosa;
    }
} else {
    echo "1 / No Existe";
    die();
}
