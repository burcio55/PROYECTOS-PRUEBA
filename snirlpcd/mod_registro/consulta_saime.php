<?php
//header('Content-type: text/plain; charset=utf-8');
//version 1.2
//----------------------------------------------------------------------------------
ini_set('display_errors',0);
error_reporting(E_ALL | E_STRICT | E_DEPRECATED);
//-----------------------------------------------------------------------------------

//-------------------------------------------------------------
include('../include/header.php');
include("../evita_injection.php");

$valores="";


$conn2 = &ADONewConnection($target);
$conn2->PConnect($hostname,$username,$password,$db5);


global $conn2;
$conn2->debug = false;

list($letra, $cedula) = explode('|',$_REQUEST['cedula']);

		$sSQL="select * from saime where numcedula=".$cedula." and letra='$letra'"; 
		$rs= $conn2->Execute($sSQL);
	  if ($rs->RecordCount()>0){
	  	$valores=trim($rs->fields['numcedula'])."|";
	  	$valores.=trim($rs->fields['letra'])."|";
		$valores.=trim($rs->fields['primer_nombre'])."|";
		$valores.=trim($rs->fields['segundo_nombre'])."|";
		$valores.=trim($rs->fields['primer_apellido'])."|";
		$valores.=trim($rs->fields['segundo_apellido'])."|";
		$date = date_create($rs->fields['fechanac']);
		$valores.= date_format($date,"d-m-Y")."|";
		$valores.=trim($rs->fields['sexo'])."|";	
		}
		else{
			$valores = "EL NUMERO DE CEDULA NO ESTA REGISTRADO EN EL SAIME POR FAVOR INGRESE UNA CEDULA VALIDA. |";
			$valores .= "MAYOR INFORMACION COMUNIQUESE AL 0800TRABAJO (872-22-56).";
			}	

echo $valores;

?>
