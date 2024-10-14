<?php
$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

session_start();
include('../include/BD.php');
$conn = Conexion::ConexionBD();

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$cedula = substr($_SESSION["cedula"], 1);

$consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "' and benabled='true';");
$row = pg_query($conn, $consulta);
$persona = pg_fetch_assoc($row);

$persona_id = $persona["id"];
$fecha_nacimiento = $persona["dfecha_nacimiento"];

$discapacidad = $_REQUEST["discapacidad"];

$numero_certificado = "D-".$_REQUEST["numero_certificado"];
$f_emision = $_REQUEST["f_emision"];
$f_vencimiento = $_REQUEST["f_vencimiento"];

$discapacidad_general = $_REQUEST["discapacidad_general"];
$sdiscapacidad_especifica = $_REQUEST["sdiscapacidad_especifica"];
$discapacidad_grado = $_REQUEST["discapacidad_grado"];

$nmision_jose = $_REQUEST["mision_jose"];

// Validaciones

/* if ($nmision_jose == -1) {
    echo "1 / Es Obligatorio especificar sí es beneficiario de la Misión José Gregorio Hernández";
    die();
} else { */
/* } */

/* if ($discapacidad == -1) {
    echo "1 / Es Obligatorio especificar sí posee Certificación de Discapacidad de CONAPDIS";
    die();
} else { */
if ($discapacidad == 1) {
    /* if ($numero_certificado == "") {
        echo "1 / Es obligatorio indicar su Número de Certificado";
        die();
    } else
    if (!ereg("^[D][-][0-9]{6}$", $_REQUEST['numero_certificado'])) {
        echo "
            1 / El Número de Certificación de Discapacidad indicado \"" . $numero_certificado . "\" no tiene un formato acorde,
            ejemplo: D-XXXXXX
        ";
        die();
    } */
    $fecha_actual = date('Y-m-d');
    if ($f_emision != "") {
        if ($f_emision > $f_vencimiento) {
            echo "1 / La Fecha de Emisión no puede ser superior a la Fecha de Vencimiento";
            die();
        } else
        if ($f_emision > $fecha_actual) {
            echo "1 / La Fecha de Emisión no puede ser superior a la Fecha Actual";
            die();
        } else
        if ($f_emision < '1920-01-01') {
            echo "1 / La Fecha de Emisión no puede ser menor al año 1920";
            die();
        } else
        if ($f_vencimiento <= $fecha_actual) {
            echo "1 / Su Carnet de Certificación se ha vencido, se recomienda actualizarlo lo antes posible";
            die();
        }else
        if($f_emision <= $fecha_nacimiento){
            echo "1 / La Fecha de Emisión no puede ser superior a la Fecha de Nacimiento";
            die();
        }
    } else
    if ($f_emision != "" && $f_vencimiento != "") {
        if ($f_emision == $f_vencimiento) {
            echo "1 / La Fecha de Emisión y de Vencimiento no pueden ser iguales";
            die();
        }
    }
    /* if ($discapacidad_general == -1) {
        echo "1 / Debes especificar qué Tipo de Discapacidad tienes";
        die();
    }
    if ($sdiscapacidad_especifica == '') {
        echo "1 / Te faltó seleccionar el campo \"Discapacidad Específica\"";
        die();
    }
    if ($discapacidad_grado == -1) {
        echo "1 / Te faltó seleccionar el campo \"Grado de Discapacidad\"";
        die();
    } */
}

/* Procesos de Inserción */

$SQL = "INSERT INTO";
$SQL .= " snirlpcd.persona_discapacidad";
$SQL .= " (";
$SQL .= " persona_id,";
$SQL .= " tipo_discapacidad_id,";
$SQL .= " snumero_certificado_discp,";
$SQL .= " dfecha_emision_cert,";
$SQL .= " dfecha_vencimiento_cert,";
$SQL .= " sdiscapacidad_especifica,";
$SQL .= " ngrado_discapacidad,";
$SQL .= " nusuario_creacion";
$SQL .= ")";
$SQL .= " VALUES";
$SQL .= " (";
$SQL .= "'$persona_id',";
$SQL .= " '$discapacidad_general',";
$SQL .= " '$numero_certificado',";
$SQL .= " '$f_emision',";
$SQL .= " '$f_vencimiento',";
$SQL .= " '$sdiscapacidad_especifica',";
$SQL .= " '$discapacidad_grado',";
$SQL .= " '$cedula'";
$SQL .= ");";

if ($resultado = pg_query($conn, $SQL)) {
    $actualizar = "UPDATE";
    $actualizar .= " snirlpcd.persona";
    $actualizar .= " SET";
    $actualizar .= " ncertificado = '" . $discapacidad . "',";
    $actualizar .= " nmision_jose = '" . $nmision_jose . "'";
    $actualizar .= " WHERE";
    $actualizar .= " id = '$persona_id'";
    $actualizar .= " AND";
    $actualizar .= " benabled = 'TRUE'";
    /* echo $actualizar . " "; */
    if ($respuesta = pg_query($conn, $actualizar)) {
        echo "2 / Se actualizó con éxito";
    } else {
        echo "1 / Se presentó un error inesperado, por favor intente más tarde";
        die();
    }
} else {
    $actualizar = "UPDATE";
    $actualizar .= " snirlpcd.persona";
    $actualizar .= " SET";
    $actualizar .= " ncertificado = '" . $discapacidad . "',";
    $actualizar .= " nmision_jose = '" . $nmision_jose . "'";
    $actualizar .= " WHERE";
    $actualizar .= " id = '$persona_id'";
    $actualizar .= " AND";
    $actualizar .= " benabled = 'TRUE'";

    if ($respuesta = pg_query($conn, $actualizar)) {
        echo "2 / Usted, debe acudir a la Dirección General de Salud Integral para las Personas con Discapacidad (DIGSIP), adscrita al Ministerio del Poder Popular para la Salud, con la finalidad de tramitar su Calificación y Clasificación de la Discapacidad, para posteriormente ser certificado a través del  Consejo Nacional para las Personas con Discapacidad (CONAPDIS).";
        die();
    } else {
        echo "1 / Se presentó un error inesperado, por favor intente más tarde";
        die();
    }
}

// Inserción en la Base de Datos
/*
    $todo = $discapacidad . " ";
    $todo .= $numero_certificado . " ";
    $todo .= $f_emision . " ";
    $todo .= $f_vencimiento . " ";
    $todo .= $discapacidad_general . " ";
    $todo .= $discapacidad_especifica . " ";
    $todo .= $discapacidad_grado . " ";
    $todo .= $mision_jose . " ";
    echo $todo;
*/