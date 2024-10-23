<?php

/* $host = "10.46.1.93";
$dbname = "minpptrassi";
$user = "postgres";
$pass = "postgres";

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("1 / Error al conectar en la Base de Datos " . $error);
} */
session_start();
include("../../include/header.php");
include("../../include/bitacora.php");
include("../../include/seguridad.php");

$conn= getConnDB($db1);
$conn->debug=false;
//var_dump($_GET);
//var_dump($conn);
$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname,$username,$password,$db_settings[1]);
$conn1->debug = false;
debug();

$SQL2="SELECT personales.cedula
FROM personales
WHERE personales.cedula='".$_REQUEST['cedula']."' and personales.nacionalidad='".$_REQUEST['nacionalidad']."'"; 
$rs2 = $conn->Execute($SQL2);
$registro1 = $registro2 = 0; ///hay que validar si la persona tiene roles u opciones dentro del sistema, por el momento solo quiero que el boton eliminar funcione para los asegurados de la sesion que estoy trabajando
if($rs2->RecordCount()>0){

$datos = array("response"=>"1");  

}else {$datos = array("response"=>"0");}

echo json_encode($datos);

?>