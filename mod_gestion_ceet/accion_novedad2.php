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

$id_novedad = $_REQUEST["id_novedad"];

$SQL = "UPDATE reporte_ceet.novedades SET benabled = 'FALSE' WHERE id = '" . $id_novedad . "'";
if ($resultado = pg_query($conn, $SQL)) {
    echo "Se eliminó el registro con éxito ";
    die();
} else {
    echo "Falló la eliminación: " . $SQL;
    die();
}
