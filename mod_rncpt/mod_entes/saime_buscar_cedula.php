<?php
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

include('../../include/header.php');

$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname,$username,$password,$db_settings[1]);
$conn1->debug = false;


$cedula_completa=$_REQUEST['txt_cedula'];
$cedula=substr($_REQUEST['txt_cedula'],1,8);
$letra=substr($_REQUEST['txt_cedula'],0,1);
$primer_nombre=$_REQUEST['txt_primer_nombre'];
$segundo_nombre=$_REQUEST['txt_segundo_nombre'];
$primer_apellido=$_REQUEST['txt_primer_apellido'];
$segundo_apellido=$_REQUEST['txt_segundo_apellido'];
$fecha_nacimiento=date("Y-m-d",strtotime($_REQUEST['fecha_nacimiento']));
$nacionalidad=$_REQUEST['cbo_nacionalidad'];
$pais_origen=$_REQUEST['cbo_pais_origen'];
$sexo=$_REQUEST['cbo_sexo'];




$SQL= "select numcedula, letra, sexo, fechanac, primer_apellido, segundo_apellido, primer_nombre, segundo_nombre, pais_origen, nacionalidad, cod_estadocivil, naturalizado, cod_objecion 
FROM saime WHERE numcedula='".$cedula."' and letra='".$letra."' ";

$cadena="";
$rs= $conn1->Execute($SQL);
if($rs->RecordCount()>0){
	$cadena.="|".$rs->fields['numcedula'];
	$cadena.="|".$rs->fields['letra'];
	$cadena.="|".$rs->fields['primer_nombre'];
	$cadena.="|".$rs->fields['segundo_nombre'];
	$cadena.="|".$rs->fields['primer_apellido'];
	$cadena.="|".$rs->fields['segundo_apellido'];
	$cadena.="|".$rs->fields['sexo'];
	$cadena.="|".date("d-m-Y",strtotime($rs->fields['fechanac']));
	$cadena.="|".$rs->fields['nacionalidad'];
	$cadena.="|".$rs->fields['pais_origen'];
	


	
	
	
}else{
	$cadena=0;
}

echo $cadena;

?>
