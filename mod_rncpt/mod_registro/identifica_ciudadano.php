<?php
ini_set("display_errors", 0);
error_reporting(-1);
header("Content-type: text/html; charset=UTF-8");

require_once("../../include/header.php");

$conn = ADONewConnection($target);
$conn->PConnect($hostname, $username, $password, $db2);
$conn->debug = false;

$cedula = trim($_REQUEST['cedula']);
$nacionalidadN = trim($_REQUEST['nacionalidad']);

$nacionalidad = ($nacionalidadN == 1) ? 'V' : (($nacionalidadN == 2) ? 'E' : '');

$datos = array();

$SSQL = "SELECT primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, letra, numcedula, sexo, fechanac 
         FROM entes.public.saime 
         WHERE numcedula = '" . $cedula . "' AND letra = '" . $nacionalidad . "'";

$rs = $conn->Execute($SSQL);

if ($rs && !$rs->EOF) {
	$primer_nombre   = trim($rs->fields['primer_nombre']);
	$segundo_nombre  = trim($rs->fields['segundo_nombre']);
	$primer_apellido = trim($rs->fields['primer_apellido']);
	$segundo_apellido = trim($rs->fields['segundo_apellido']);
	$numcedula       = trim($rs->fields['numcedula']);
	$sexo            = trim($rs->fields['sexo']);
	$fechanac        = trim($rs->fields['fechanac']);

	$apellidonombre = ucwords(strtolower("$primer_apellido $segundo_apellido $primer_nombre $segundo_nombre"));

	if ($numcedula == $cedula) {
		$fechanac_ = date("Y-m-d", strtotime($fechanac));
		$edad = edad_($fechanac_);
		$fechanac = date("d-m-Y", strtotime($fechanac));

		$datos = array(
			"response" => "success",
			"apellidonombre" => $apellidonombre,
			"cedulaidentida" => $numcedula,
			"primer_nombre" => $primer_nombre,
			"segundo_nombre" => $segundo_nombre,
			"primer_apellido" => $primer_apellido,
			"segundo_apellido" => $segundo_apellido,
			"sexo" => $sexo,
			"fechanac" => $fechanac,
			"edad" => $edad
		);
	} else {
		$datos = array("response" => "nosuccess", "mensaje" => "CEDULA NO ENCONTRADA");
	}
} else {
	$datos = array("response" => "nosuccess", "mensaje" => "Error en la consulta.");
}

print json_encode($datos);

function edad_($fecha)
{
	list($Y, $m, $d) = explode("-", $fecha);
	return (date("md") < $m . $d) ? (date("Y") - $Y - 1) : (date("Y") - $Y);
}
