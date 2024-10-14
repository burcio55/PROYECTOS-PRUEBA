<?php
$host = "10.46.1.93";
$dbname = "minpptrassi";
$user = "postgres";
$pass = "postgres";

session_start();
/* include('include/BD.php');
$conn = Conexion::ConexionBD(); */

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$nombres = $_REQUEST["nombres"];
$apellidos = $_REQUEST["apellidos"];
$telf = $_REQUEST["telf"];


$ope0 = $_REQUEST["ope0"];
$ope2 = $_REQUEST["ope2"];
$ope3 = $_REQUEST["ope3"];
$ope4 = $_REQUEST["ope4"];
$ope5 = $_REQUEST["ope5"];

$Ambiente_Formacion = $_REQUEST["Ambiente_Formacion"];
$Experiencia_Productiva = $_REQUEST["Experiencia_Productiva"];
$Formacion_CPTT = $_REQUEST["Formacion_CPTT"];
$Insercion_Laboral = $_REQUEST["Insercion_Laboral"];

$opciones2 = $ope0 . " " . $ope2 . " " . $ope3 . " " . $ope4 . " " . $ope5;

/* echo " 1 / ". $nombres . " " . $apellidos . " " . $telf . " " . $Ambiente_Formacion . " " . $opciones2 . " " . $Experiencia_Productiva . " " . $Insercion_Laboral; */
/* echo " 1 / Se enviaron correctamente los datos"; */

$tranajador_indep_id = $_SESSION["trabajador_indep_id"];
$_SESSION['nombres'] = $nombres;
$_SESSION['apellidos'] = $apellidos;
$nusuario_creacion = $_SESSION["id_usuario"];

/* $sql = "SELECT * FROM";
$sql .= " reporte_ceet.abordaje_trabaj_indep";
$sql .= " WHERE";
$sql .= " trabajador_indep_id = '" . $_SESSION["trabajador_indep_id"]  . "'";
$sql .= " AND";
$sql .= " snombres_resp_form = '$nombres'";
$sql .= " AND";
$sql .= " sapellidos_resp_form = '$apellidos'";
$sql .= " AND";
$sql .= " benabled = 'TRUE'";

$row = pg_query($conn, $sql);
if (!$row) {
    echo "Error al ejecutar la consulta: " . pg_last_error($conn);
    exit;
}

$usuario = pg_fetch_assoc($row);
if (!$usuario) { */

/* echo "1 /  No existe";
    die(); */

if ($Ambiente_Formacion == '1') {
    $bambiente_formacion = 'TRUE';
} else {
    $bambiente_formacion = 'FALSE';
}

if ($Experiencia_Productiva == '1') {
    $bexp_productiva_detec = 'TRUE';
} else {
    $bexp_productiva_detec = 'FALSE';
}

if ($Formacion_CPTT -= '1') {
    $bformacion_especializada = 'TRUE';
} else {
    $bformacion_especializada = 'FALSE';
}

if ($Insercion_Laboral == '1') {
    $sinsercion_laboral = 'INSERCIÓN';
} else 
    if ($Insercion_Laboral == '2') {
    $sinsercion_laboral = 'POSTULACIÓN';
} else {
    $sinsercion_laboral = 'OFERTA';
}

$fecha02 = date("d-m-Y");

$SQL = "INSERT INTO";
$SQL .= " reporte_ceet.abordaje_trabaj_indep";
$SQL .= " (";
$SQL .= " trabajador_indep_id,";
$SQL .= " snombres_resp_form,";
$SQL .= " sapellidos_resp_form,";
$SQL .= " stelefono_personal_resp_form,";
$SQL .= " bambiente_formacion,";
$SQL .= " bexp_productiva_detec,";
$SQL .= " bformacion_especializada,";
$SQL .= " sinsercion_laboral,";
$SQL .= " nusuario_creacion,";
$SQL .= " fecha";
$SQL .= ")";
$SQL .= " VALUES";
$SQL .= " (";
$SQL .= "'" . $_SESSION["trabajador_indep_id"]  . "',";
$SQL .= "'$nombres',";
$SQL .= "'$apellidos',";
$SQL .= "'$telf',";
$SQL .= "'$bambiente_formacion',";
$SQL .= "'$bexp_productiva_detec',";
$SQL .= "'$bformacion_especializada',";
$SQL .= "'$sinsercion_laboral',";
$SQL .= " $nusuario_creacion,";
$SQL .= " '$fecha02'";
$SQL .= ");";

/* echo "1 / " . $SQL;
    die(); */

if ($resultado = pg_query($conn, $SQL)) {
    echo "1 / Se agregó correctamente el usuario";
    die();
} else {
    echo "1 / Ocurrió un error inesperado, razón: " . $SQL;
    die();
}
/* } else {

    if ($Ambiente_Formacion == '1') {
        $bambiente_formacion = 'TRUE';
    } else {
        $bambiente_formacion = 'FALSE';
    }

    if ($Experiencia_Productiva == '1') {
        $bexp_productiva_detec = 'TRUE';
    } else {
        $bexp_productiva_detec = 'FALSE';
    }

    if ($Formacion_CPTT -= '1') {
        $bformacion_especializada = 'TRUE';
    } else {
        $bformacion_especializada = 'FALSE';
    }

    if ($Insercion_Laboral == '1') {
        $sinsercion_laboral = 'INSERCIÓN';
    } else 
    if ($Insercion_Laboral == '2') {
        $sinsercion_laboral = 'POSTULACIÓN';
    } else {
        $sinsercion_laboral = 'OFERTA';
    }

    $_SESSION["bambiente_formacion"] = $bambiente_formacion;

    $_SESSION["inser_laboral"] = $sinsercion_laboral;

    $SQL2 = "UPDATE";
    $SQL2 .= " reporte_ceet.abordaje_trabaj_indep";
    $SQL2 .= " SET";
    $SQL2 .= " stelefono_personal_resp_form = '$telf',";
    $SQL2 .= " bambiente_formacion='$bambiente_formacion',";
    $SQL2 .= " bexp_productiva_detec='$bexp_productiva_detec',";
    $SQL2 .= " bformacion_especializada='$bformacion_especializada',";
    $SQL2 .= " sinsercion_laboral='$sinsercion_laboral',";
    $SQL2 .= " fecha='$fecha'";
    $SQL2 .= " WHERE";
    $SQL2 .= " trabajador_indep_id = '" . $_SESSION["trabajador_indep_id"]  . "'";
    $SQL2 .= " AND";
    $SQL2 .= " snombres_resp_form = '$nombres'";
    $SQL2 .= " AND";
    $SQL2 .= " sapellidos_resp_form = '$apellidos'";
    $SQL2 .= " AND";
    $SQL2 .= " benabled = 'TRUE'";

    if ($resultado2 = pg_query($conn, $SQL2)) {
        echo "1 / Su registro se realizó exitosamente ";
        die();
    } else {
        echo "1 / Ocurrió un error inesperado, razón: " . $SQL2;
        die();
    }
} */
