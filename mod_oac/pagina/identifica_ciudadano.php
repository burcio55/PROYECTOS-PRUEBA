
<script> alert( "pagina identifica usuario");</script>
<?php
header("Content-type: text/html; charset=UTF-8");
require_once("include/header.php");

ini_set("display_errors", 0);
error_reporting(-1);

$conn = &ADONewConnection($target);
$conn->PConnect($hostname,$username,$password,$db2);
$conn->debug = true;

$cedula = trim($_REQUEST['cedulaconsulta']);
$nacionalidadN = trim($_REQUEST['nacionalidad']);

if ($nacionalidadN == 1){
$nacionalidad = V;
}
if ($nacionalidadN == 2){
$nacionalidad = E;
}

$datos = array();

//var_dump ($GLOBALS['settings']);
//var_dump ($conn);
    
	$SSQL = "SELECT primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, letra, numcedula FROM entes.public.saime WHERE numcedula = '".$cedula."' AND letra = '".$nacionalidad."'";
    $rs= $conn->Execute($SSQL);

        $primer_nombre     = trim($rs->fields['primer_nombre']);
        $segundo_nombre    = trim($rs->fields['segundo_nombre']);
        $primer_apellido   = trim($rs->fields['primer_apellido']);
        $segundo_apellido  = trim($rs->fields['segundo_apellido']);
		$letra             = trim($rs->fields['letra']);
		$numcedula         = trim($rs->fields['numcedula']);
		
		$apellidonombre = ucwords(strtolower($primer_apellido." ".$segundo_apellido." ".$primer_nombre." ".$segundo_nombre));
		
	if($numcedula == $cedula){
		
		$datos = array("response"=>"success", "apellidonombre"=>$apellidonombre, "cedulaidentida"=>$numcedula);
		echo json_encode($datos);
	}else{
		$datos = array("response"=>"nosuccess", "mensaje"=>"CEDULA NO ENCONTRADA");
		echo json_encode($datos);
	}
	var_dump($datos);
?>