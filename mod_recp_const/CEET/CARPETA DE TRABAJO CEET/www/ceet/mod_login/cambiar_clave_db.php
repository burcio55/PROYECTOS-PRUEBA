<?php
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
$conn= getConnDB($db1);
$conn->debug = false;

include("../evita_injection.php");
include("../verificar_session_url.php");

if(isset($_REQUEST['passwd'])){
$clave=str_replace("'","",$_REQUEST['passwd']);
$clave=str_replace(",","",$clave);
$clave=str_replace("-","",$clave);
$clave=htmlentities((trim($clave)));
}
if(isset($_SESSION['nusuario'])){
$usuario=str_replace("'","",$_SESSION['nusuario']);
$usuario=str_replace(",","",$usuario);
$usuario=str_replace("-","",$usuario);
$usuario=htmlentities((trim($usuario)));
}

$SQL= "UPDATE scpt.sesion 
	 SET sclave='".trim(md5($clave))."',
			 dfecha_actualizacion='".date('Y-m-d H:i:s')."',
			usuario_idactualizacion='".$_SESSION['usuario_id']."'
	 WHERE registrador_id='".$_SESSION['usuario_id']."'
	  AND nenabled='1'";

if($rs= $conn->Execute($SQL)){
	$valor="actualizada";	
}else{
	$valor="error_actualizar";
}
echo $valor;

?>