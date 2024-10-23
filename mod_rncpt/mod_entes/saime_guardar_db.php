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





/*include("../evita_injection.php");
include("../verificar_session_url.php");
*/
/*
if(isset($_SESSION['nusuario'])){
$usuario=str_replace("'","",$_SESSION['nusuario']);
$usuario=str_replace(",","",$usuario);
$usuario=str_replace("-","",$usuario);
$usuario=htmlentities((trim($usuario)));
}
*/





$SQL= "select numcedula,letra FROM saime WHERE numcedula='".$cedula."' and letra='".$letra."' ";


$rs= $conn1->Execute($SQL);
if($rs->RecordCount()>0){

 $valor="existe";
}else{




/*

	$SQL= "  INSERT INTO saime(

            numcedula, letra, sexo, fechanac, primer_apellido, segundo_apellido,

            primer_nombre, segundo_nombre, pais_origen, nacionalidad, cod_estadocivil,

            naturalizado, cod_objecion)

    VALUES ('31988328', 'V', 'M', '01-02-2001', 'Garcia', 'Matos',

            'Rodolfo', 'Javier', 'VEN', 'VEN', '1',

            '0', '00');";

*/


	$SQL= "  INSERT INTO saime(

            numcedula, letra, sexo, fechanac, primer_apellido, segundo_apellido,

            primer_nombre, segundo_nombre, pais_origen, nacionalidad, cod_estadocivil,

            naturalizado, cod_objecion)

    VALUES ('".$cedula."', '".$letra."', '".$sexo."', '".$fecha_nacimiento."', '".$primer_apellido."', '".$segundo_apellido."',

            '".$primer_nombre."', '".$segundo_nombre."', '".$pais_origen."', '".$nacionalidad."', '1',

            '0', '00');";



	if($rs= $conn1->Execute($SQL)){
		$valor="registrado";	
	}else{
		$valor="error_registrar";
	}

}

echo $valor;

?>