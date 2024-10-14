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

$srif = $_REQUEST["srif"];
$srazon_social = $_REQUEST["srazon_social"];
$sdenominacion_comercial = $_REQUEST["sdenominacion_comercial"];
$stipo_capital = $_REQUEST["stipo_capital"];
$entidad_nentidad2 = $_REQUEST["entidad_nentidad2"];
$parroquia_nparroquia2 = $_REQUEST["parroquia_nparroquia2"];
$municipio_nmunicipio2 = $_REQUEST["municipio_nmunicipio2"];

$motor_id = $_REQUEST["motor_id"];
$actividad_economica2 = $_REQUEST["actividad_economica2"];
$sdireccion_fiscal = $_REQUEST["sdireccion_fiscal"];
$fecha_actual = date("Y-m-d");
$nusuario_creacion = $_SESSION["id_usuario"];


$sql = "INSERT INTO reporte_ceet.empresa(
 srif, sdenominacion_comercial, srazon_social, tipo_capital_id, estado_id, municipio_id, parroquia_id, motor_id, act_economica4, sdireccion_fiscal, dfecha_creacion, usuario_idcreacion)
VALUES ( '$srif', '$sdenominacion_comercial', '$srazon_social', '$stipo_capital', '$entidad_nentidad2', '$municipio_nmunicipio2', '$parroquia_nparroquia2', '$motor_id', '$actividad_economica2', '$sdireccion_fiscal', '$fecha_actual', '$nusuario_creacion');";
if ($resultado = pg_query($conn, $sql)) {
    echo "1 / Se agregó correctamente";
    die();
} else {
    echo "0 /  " . $sql;
    die();
}
