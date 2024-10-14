<?php
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
$conn= getConnDB($db1);
$conn->debug = true;

//include("../evita_injection.php");
//include("../verificar_session_url.php");

if(isset($_REQUEST['cedula'])){
$cedula=str_replace("'","",$_REQUEST['cedula']);
$cedula=str_replace(",","",$cedula);
$cedula=str_replace("-","",$cedula);
$cedula=htmlentities((trim($cedula)));
}

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


$SQL1= "select id from scpt.registrador 
	  WHERE ncedula='".$cedula."'
	  AND nenabled='1'";
$rs1= $conn->Execute($SQL1);
if($rs1->RecordCount() >0){
$id=$rs1->fields['id'];
}

$SQL= "UPDATE scpt.sesion 
	 SET sclave='".trim(md5($clave))."',
			 dfecha_actualizacion='".date('Y-m-d H:i:s')."',
			usuario_idactualizacion='".$id."'
	 WHERE registrador_id='".$id."'
	  AND nenabled='1'";

if($rs= $conn->Execute($SQL)){
	$valor="actualizada";	
}else{
	$valor="error_actualizar";
}
echo $valor;

?>