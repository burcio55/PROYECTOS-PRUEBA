 <?php
header("Content-type: text/html; charset=UTF-8");
require_once("include/header.php");

ini_set("display_errors", 0);
error_reporting(-1);
		
$cedula = trim($_REQUEST['cedula']);
$nacionalidadN = trim($_REQUEST['nacionalidad']);

if ($nacionalidadN == 1){$nacionalidad = V;}
if ($nacionalidadN == 2){$nacionalidad = E;}
$cedulan=$nacionalidad.$cedula;
$datos = array();	

$ip_saime = '200.109.236.51';
//La Variable ($ip_saime_cnti_archivo_remoto_) viene de (settings_entes.php)
//$ip_saime =  $ip_saime_cnti_archivo_remoto_;
$json = file_get_contents('http://'.$ip_saime.'/cliente_cnti_saime_remoto_nuevo.php?cedula='.$cedulan);
$json = substr($json,3);
$data = json_decode($json, true);
$dataSaime['estatus'] = $data['ESTATUS_WEBSERVER'];

	if($dataSaime['estatus'] == 1){ //TRAE BIEN LOS DATOS
		$primer_nombre     = trim($data['PRIMERNOMBRE']);
		$segundo_nombre    = trim($data['SEGUNDONOMBRE']);
		$primer_apellido   = trim($data['PRIMERAPELLIDO']);
		$segundo_apellido  = trim($data['SEGUNDOAPELLIDO']);
		$numcedula         = trim($data['NUMCEDULA']);
		
		$apellidonombre = ucwords(strtolower($primer_apellido." ".$segundo_apellido." ".$primer_nombre." ".$segundo_nombre));
	}
	
	if($numcedula == $cedula){
		$datos = array("response"=>"success", "apellidonombre"=>$apellidonombre, "cedulaidentida"=>$numcedula);
		echo json_encode($datos);
	}else{
		if($data['ESTATUS_WEBSERVER'] == -2){
		$datos = array("response"=>"nosuccess", "mensaje"=>"CEDULA NO ENCONTRADA");
		echo json_encode($datos);}
		if($data['ESTATUS_WEBSERVER'] == -1){
		$datos = array("response"=>"nosuccess", "mensaje"=>"WEBSERVER CAIDO");
		echo json_encode($datos);}
	}
			
?>
	