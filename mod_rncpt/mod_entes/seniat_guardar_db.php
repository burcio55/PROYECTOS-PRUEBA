<?php
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

/*
 echo 
 "RIF:".."<br>".
 "RAZON:".$_REQUEST['txt_razon_social']."<br>".
 "DENOMINACION:".$_REQUEST['txt_denominacion_comercial']."<br>".
 "DIRECCION:".$_REQUEST['txt_direccion_fiscal']."<br>".
 "ESTADO:".$_REQUEST['txt_estado']."<br>".
 "MUNICIPIO:".$_REQUEST['txt_municipio']."<br>".
 "PARROQUIA:".$_REQUEST['txt_parroquia']."<br>";
*/


include('../../include/header.php');

$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname,$username,$password,$db_settings[1]);
$conn1->debug = FALSE;


 $valor='';

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

$SQL= "select max(id_seniat) as ultimo_id_seniat FROM seniat";

$rs= $conn1->Execute($SQL);
if($rs->RecordCount()>0){
	$id_seniat_ultimo=$rs->fields['ultimo_id_seniat'];
	$id_seniat_ultimo=$id_seniat_ultimo + 1;
}


$SQL= "select srif FROM seniat WHERE srif='".$_REQUEST['txt_rif']."'";


$rs= $conn1->Execute($SQL);
if($rs->RecordCount()>0){

 $valor="existe";
}else{





	$SQL= "INSERT INTO seniat(
	             id_seniat,srif, srazon_social, sdenominacion_comercial, sdireccion_fiscal, 
	            estado, municipio, parroquia, semail)
	    VALUES ('".$id_seniat_ultimo."','".$_REQUEST['txt_rif']."', '".$_REQUEST['txt_razon_social']."','".$_REQUEST['txt_denominacion_comercial']."', '".$_REQUEST['txt_direccion_fiscal']."', '".$_REQUEST['txt_estado']."', '".$_REQUEST['txt_municipio']."', '".$_REQUEST['txt_parroquia']."', '".$_REQUEST['txt_email']."');";


	if($rs= $conn1->Execute($SQL)){
		$valor="registrado";	
	}else{
		$valor="error_registrar";
	}

}

echo $valor;

?>