<?php
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

include('../../include/header.php');

$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname,$username,$password,$db_settings[1]);
$conn1->debug = false;


$SQL= "select srif,srazon_social, sdenominacion_comercial, sdireccion_fiscal, 
            estado, municipio, parroquia, semail FROM seniat WHERE srif='".$_REQUEST['txt_rif']."'";

$cadena="";
$rs= $conn1->Execute($SQL);
if($rs->RecordCount()>0){
	$cadena.="|".$rs->fields['srif'];
	$cadena.="|".$rs->fields['srazon_social'];
	$cadena.="|".$rs->fields['sdenominacion_comercial'];
	$cadena.="|".$rs->fields['sdireccion_fiscal'];
	$cadena.="|".$rs->fields['estado'];
	$cadena.="|".$rs->fields['municipio'];
	$cadena.="|".$rs->fields['parroquia'];
	$cadena.="|".$rs->fields['semail'];
}else{
	$cadena=0;
}

echo $cadena;

?>
