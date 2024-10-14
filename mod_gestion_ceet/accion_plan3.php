<?php
$host = "10.46.1.93";
$dbname = "minpptrassi";
$user = "postgres";
$pass = "postgres";

session_start();
include('include/BD.php');
$conn = Conexion::ConexionBD();

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$id_plan = $_REQUEST["id_plan"];
$sdescripcion = $_REQUEST["plan"];

$SQL = "UPDATE reporte_ceet.plan_formacion SET sdescripcion = '" . $sdescripcion . "' WHERE id = '" . $id_plan . "'";
if ($resultado = pg_query($conn, $SQL)) {
    echo "1 / Se Actualizó con éxito";
    die();
} else {
    echo "1 / Falló la actualización: " . $SQL;
    die();
}
