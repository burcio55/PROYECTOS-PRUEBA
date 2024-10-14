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
$ncertificado = $persona["discapacidad"];
$nmision_jose = $persona["nmision_jose"];

if ($ncertificado == "1") {
    $ncertificado == "true";
} else {
    $ncertificado == "false";
}

if ($nmision_jose == "1") {
    $nmision_jose == "true";
} else {
    $nmision_jose == "false";
}

/* Proceso de Actualización */

$row2 = pg_query($conn, $select);
$disc = pg_fetch_assoc($row2);

$id_discapacidad = $disc["id"];
