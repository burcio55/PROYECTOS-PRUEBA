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

$nombres2 = $_REQUEST["nombres2"];
$apellidos2 = $_REQUEST["apellidos2"];
$telf2 = $_REQUEST["telf2"];

$Ambiente_Formacion2 = $_REQUEST["Ambiente_Formacion2"];
$Experiencia_Productiva2 = $_REQUEST["Experiencia_Productiva2"];
$Formacion_CPTT2 = $_REQUEST["Formacion_CPTT2"];
$Insercion_Laboral2 = $_REQUEST["Insercion_Laboral2"];
$srif = $_REQUEST["srif"];

$fecha = date("d-m-Y");

/* echo " 1 / " . $nombres2 . " " . $apellidos2 . " " . $telf2 . " " . $Ambiente_Formacion2 . " " . $Experiencia_Productiva2 . " " . $Formacion_CPTT2 . " " . $Insercion_Laboral2;
die(); */
/* echo " 1 / Se enviaron correctamente los datos"; */
$r = "SELECT empresa.id, srif,srazon_social,sdenominacion_comercial,tipo_capital_id as ca,
tipo_capital.sdescripcion as capital,estado_id,municipio_id,parroquia_id,
entidad.sdescripcion as estado,
municipio.sdescripcion as minicipio,
parroquia.sdescripcion as parroquia,
act_economica4 as nombre,sdireccion_fiscal 
FROM reporte_ceet.empresa
inner join reporte_ceet.tipo_capital on tipo_capital.id = reporte_ceet.empresa.tipo_capital_id 

LEFT JOIN public.entidad ON entidad.nentidad=empresa.estado_id 
LEFT JOIN public.municipio ON municipio.nmunicipio=empresa.municipio_id 
LEFT JOIN public.parroquia ON parroquia.nparroquia=empresa.parroquia_id 
WHERE srif = '" . $srif . "'  LIMIT 1";
$ra = pg_query($conn, $r);
$persona = pg_fetch_assoc($ra);

/* echo " 1 / " . $r; */

$rnee_empresa_id = $persona["id"];

$_SESSION['empresa_id'] = $rnee_empresa_id;

$_SESSION['nombres2'] = $nombres2;
$_SESSION['apellidos2'] = $apellidos2;
$nusuario_creacion = $_SESSION["id_usuario"];

$sql = "SELECT * FROM";
$sql .= " reporte_ceet.abordaje_rnee_empresa";
$sql .= " WHERE";
$sql .= " rnee_empresa_id = '$rnee_empresa_id'";
$sql .= " AND";
$sql .= " benabled = 'TRUE'";

$row = pg_query($conn, $sql);
if (!$row) {
    echo "Error al ejecutar la consulta: " . pg_last_error($conn);
    exit;
}

$usuario = pg_fetch_assoc($row);
if ($usuario) {

    /* echo "1 /  No existe";
    die(); */

    $id_empresa_abordaje = $usuario["id"];

    if ($Ambiente_Formacion2 == 1) {
        $Ambiente_Formacion = 'TRUE';
    } else {
        $Ambiente_Formacion = 'FALSE';
    }
    if ($Experiencia_Productiva2 == 1) {
        $Experiencia_Productiva = 'TRUE';
    } else {
        $Experiencia_Productiva = 'FALSE';
    }
    if ($Formacion_CPTT2 == 1) {
        $Formacion_CPTT = 'TRUE';
    } else {
        $Formacion_CPTT = 'FALSE';
    }

    if ($Insercion_Laboral2 == '1') {
        $Insercion_Laboral = 'INSERCIÓN';
    } else 
    if ($Insercion_Laboral2 == '2') {
        $Insercion_Laboral = 'POSTULACIÓN';
    } else {
        $Insercion_Laboral = 'OFERTA';
    }

    $SQL = "UPDATE";
    $SQL .= " reporte_ceet.abordaje_rnee_empresa";
    $SQL .= " SET";
    $SQL .= " snombres_resp_form = '$nombres2',";
    $SQL .= " sapellidos_resp_form = '$apellidos2',";
    $SQL .= " stelefono_personal_resp_form = '$telf2',";
    $SQL .= " bambiente_formacion = '$Ambiente_Formacion',";
    $SQL .= " bexp_productiva_detec = '$Experiencia_Productiva',";
    $SQL .= " bformacion_especializada = '$Formacion_CPTT',";
    $SQL .= " sinsercion_laboral = '$Insercion_Laboral',";
    $SQL .= " fecha = '$fecha'";
    $SQL .= " WHERE";
    $SQL .= " rnee_empresa_id = '$rnee_empresa_id'";
    $SQL .= " AND";
    $SQL .= " id = '$id_empresa_abordaje'";
    $SQL .= " AND";
    $SQL .= " benabled = 'TRUE'";

    /*  echo "1 / " . $SQL;
    die(); */

    $_SESSION["nombres2"] = $nombres2;
    $_SESSION["apellidos2"] = $apellidos2;
    $_SESSION["telf2"] = $telf2;

    $_SESSION["Ambiente_Formacion2"] = $Ambiente_Formacion;
    $_SESSION["Experiencia_Productiva2"] = $Experiencia_Productiva;
    $_SESSION["Formacion_CPTT2"] = $Formacion_CPTT;
    $_SESSION["Insercion_Laboral2"] = $Insercion_Laboral;

    $_SESSION["inser_laboral"] = $Insercion_Laboral;

    if ($resultado = pg_query($conn, $SQL)) {

        $S = "UPDATE";
        $S .= " reporte_ceet.abordaje_rnee_empresa";
        $S .= " SET";
        $S .= " snombres_resp_form = '$nombres2',";
        $S .= " sapellidos_resp_form = '$apellidos2',";
        $S .= " stelefono_personal_resp_form = '$telf2',";
        $S .= " bambiente_formacion = '$Ambiente_Formacion',";
        $S .= " bexp_productiva_detec = '$Experiencia_Productiva',";
        $S .= " bformacion_especializada = '$Formacion_CPTT',";
        $S .= " sinsercion_laboral = '$Insercion_Laboral',";
        $S .= " fecha = '$fecha'";
        $S .= " WHERE";
        $S .= " rnee_empresa_id = '$rnee_empresa_id'";
        $S .= " AND";
        $S .= " id = '$id_empresa_abordaje'";
        $S .= " AND";
        $S .= " benabled = 'TRUE'";
        $resultadoa = pg_query($conn, $S);

        echo "1 / Se agregó correctamente el usuario";
        die();
    } else {
        echo "1 / Ocurrió un error inesperado, razón: " . $SQL;
        die();
    }
} else {

    /* echo "1 / " . $sql; */

    echo "1 / Está empresa no está registrada";
    die();
}
