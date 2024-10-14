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

$n_nacionalidad = $_REQUEST["n_nacionalidad"];
$personales_cedula = $_REQUEST["personales_cedula"];
$p_nombre = $_REQUEST["p_nombre"];
$s_nombre = $_REQUEST["s_nombre"];
$p_apellido = $_REQUEST["p_apellido"];
$s_apellido = $_REQUEST["s_apellido"];
$stelefono_personal = $_REQUEST["stelefono_personal"];
$sexo = $_REQUEST["sexo"];

$entidad_nentidad = $_REQUEST["entidad_nentidad"];
$municipio_nmunicipio = $_REQUEST["municipio_nmunicipio"];
$parroquia_nparroquia = $_REQUEST["parroquia_nparroquia"];

$motor_id = $_REQUEST["motor_id"];
$actividad_economica = $_REQUEST["actividad_economica"];

$nusuario_creacion = $_SESSION["id_usuario"];

/* echo " 1 / " . $n_nacionalidad . " " . $personales_cedula . " " . $p_nombre . " " . $s_nombre . " " . $p_apellido . " " . $s_apellido . " " . $sexo . " " . $stelefono_personal . " " . $entidad_nentidad . " " . $municipio_nmunicipio . " " . $parroquia_nparroquia . " " . $motor_id . " " . $actividad_economica;
die(); */

// Validaciones

if ($sexo == '-1') {
    echo "1 / Debe selecionar cuál es su Sexo";
    die();
}

$sql = "SELECT * FROM";
$sql .= " reporte_ceet.trabajador_indep";
$sql .= " WHERE";
$sql .= " snacionalidad = '$n_nacionalidad'";
$sql .= " AND";
$sql .= " ncedula = $personales_cedula";
$sql .= " AND";
$sql .= " sprimer_nombre = '$p_nombre'";
$sql .= " AND";
$sql .= " ssegundo_nombre = '$s_nombre'";
$sql .= " AND";
$sql .= " sprimer_apellido = '$p_apellido'";
$sql .= " AND";
$sql .= " ssegundo_apellido = '$s_apellido'";
$sql .= " AND";
$sql .= " ssexo = '$sexo'";
$sql .= " AND";
$sql .= " benabled = 'TRUE'";
$row = pg_query($conn, $sql);
if (!$persona = pg_fetch_assoc($row)) {

    $motor_id = $_REQUEST["motor_id"];
    $actividad_economica = $_REQUEST["actividad_economica"];

    $SQL = "INSERT INTO";
    $SQL .= " reporte_ceet.trabajador_indep";
    $SQL .= " (";
    $SQL .= " snacionalidad,";
    $SQL .= " ncedula,";
    $SQL .= " sprimer_nombre,";
    $SQL .= " ssegundo_nombre,";
    $SQL .= " sprimer_apellido,";
    $SQL .= " ssegundo_apellido,";
    $SQL .= " ssexo,";
    $SQL .= " stelefono_personal,";
    $SQL .= " entidad_nentidad,";
    $SQL .= " municipio_nmunicipio,";
    $SQL .= " parroquia_nparroquia,";
    $SQL .= " motor_id,";
    $SQL .= " actividad_economica,";
    $SQL .= " nusuario_actualizacion";
    $SQL .= ")";
    $SQL .= " VALUES";
    $SQL .= " (";
    $SQL .= "'$n_nacionalidad',";
    $SQL .= "'$personales_cedula',";
    $SQL .= "'$p_nombre',";
    $SQL .= "'$s_nombre',";
    $SQL .= "'$p_apellido',";
    $SQL .= "'$s_apellido',";
    $SQL .= "'$sexo',";
    $SQL .= "'$stelefono_personal',";
    $SQL .= "'$entidad_nentidad',";
    $SQL .= "'$municipio_nmunicipio',";
    $SQL .= "'$parroquia_nparroquia',";
    $SQL .= "'$motor_id',";
    $SQL .= "'$actividad_economica',";
    $SQL .= " $nusuario_creacion";
    $SQL .= ");";
    if ($resultado = pg_query($conn, $SQL)) {
        echo "1 / Se agregó correctamente el usuario";
        die();
    } else {
        echo "1 / Ocurrió un error inesperado, razón: " . $SQL;
        die();
    }
} else {
    /* $SQL2 = "UPDATE";
    $SQL2 .= " reporte_ceet.trabajador_indep";
    $SQL2 .= " SET";
    $SQL2 .= " ssexo = '$sexo',";
    $SQL2 .= " stelefono_personal = '$stelefono_personal',";
    $SQL2 .= " entidad_nentidad = '$entidad_nentidad',";
    $SQL2 .= " municipio_nmunicipio = '$municipio_nmunicipio',";
    $SQL2 .= " parroquia_nparroquia = '$parroquia_nparroquia',";
    $SQL2 .= " motor_id = '$motor_id',";
    $SQL2 .= " actividad_economica = '$actividad_economica'";
    $SQL2 .= " WHERE";
    $SQL2 .= " snacionalidad = '$n_nacionalidad'";
    $SQL2 .= " AND";
    $SQL2 .= " ncedula = $personales_cedula";
    $SQL2 .= " AND";
    $SQL2 .= " sprimer_nombre = '$p_nombre'";
    $SQL2 .= " AND";
    $SQL2 .= " ssegundo_nombre = '$s_nombre'";
    $SQL2 .= " AND";
    $SQL2 .= " sprimer_apellido = '$p_apellido'";
    $SQL2 .= " AND";
    $SQL2 .= " ssegundo_apellido = '$s_apellido'";
    $SQL2 .= " AND";
    $SQL2 .= " benabled = 'TRUE'"; */

    /* if ($resultado2 = pg_query($conn, $SQL2)) { */
    echo "1 / Esté usuario ya fue registrado, no puede ser cambiado";
    die();
    /* } else {
        echo "1 / Ocurrió un error inesperado, razón: " . $SQL2;
        die();
    } */
}
/* 
if ($motivo == '') {
    echo "1 / Es Obligatorio indicar cuál es el \"Motivo de Visita\" a Agregar";
    die();
} else {
    $SQL = "INSERT INTO";
    $SQL .= " reporte_ceet.motivo_visita";
    $SQL .= " (";
    $SQL .= " sdescripcion,";
    $SQL .= " nusuario_creacion";
    $SQL .= ")";
    $SQL .= " VALUES";
    $SQL .= " (";
    $SQL .= "'$motivo',";
    $SQL .= " 13289657";
    $SQL .= ");";

    if ($resultado = pg_query($conn, $SQL)) {
        echo "1 / Se agregó correctamente el \"Motivo de Visita\"";
        die();
    } else {
        echo "1 / Falló la inserción, razón: " . $SQL;
        die();
    }
} */
