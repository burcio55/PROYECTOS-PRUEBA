<?php
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

/*
 echo 
 "CEDULA COMPLETA:".$_REQUEST['txt_cedula']."<br>".
 "CEDULA:".substr($_REQUEST['txt_cedula'],1,8)."<br>".
 "LETRA:".substr($_REQUEST['txt_cedula'],0,1)."<br>".
 "PRIMER NOMBRE:".$_REQUEST['txt_primer_nombre']."<br>".
 "SEGUNDO NOMBRE:".$_REQUEST['txt_segundo_nombre']."<br>".
 "PRIMER APELLIDO:".$_REQUEST['txt_primer_apellido']."<br>".
 "SEGUNDO APELLIDO:".$_REQUEST['txt_segundo_apellido']."<br>".
 "fecha_nacimiento:".$_REQUEST['fecha_nacimiento']."<br>";
*/

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

include('../../include/header.php');

$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname,$username,$password,$db_settings[1]);
$conn1->debug = false;



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



 $SQL= " UPDATE saime
   SET sexo='".$sexo."', fechanac='".$fecha_nacimiento."', primer_apellido='".$primer_apellido."', 
       segundo_apellido='".$segundo_apellido."', primer_nombre='".$primer_nombre."', segundo_nombre='".$segundo_nombre."', pais_origen='".$pais_origen."', nacionalidad='".$nacionalidad."'
 	WHERE numcedula='".$cedula."' and letra='".$letra."' ";


if($rs= $conn1->Execute($SQL)){
	$valor="modificado";	
}else{
	$valor="error_registrar";
}
echo $valor;

?>
