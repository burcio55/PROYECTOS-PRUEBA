<?php
include("../include/BD.php");
$conn = Conexion::ConexionBD();

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$sql = "SELECT * FROM public.entidad where nenabled = '1' ORDER BY sdescripcion;";
$row = pg_query($conn, $sql);
$estado = pg_fetch_all($row);
$op = "<option value= -1>Seleccionar</option>";
foreach ($estado as $u) {
    $op .= "<option value=" . $u['id'] . ">" . $u['nombre'] . "</option>";
}

echo $op;
    /*$data = $_POST['id'];
    var_dump($data);die($data);*/
