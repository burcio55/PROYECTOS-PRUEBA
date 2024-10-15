<?php
ini_set('display_errors',0); 
error_reporting(E_ALL | E_STRICT | E_DEPRECATED);
ini_set("max_execution_time","950000000000");
include('../include/header.php');


$conn= getConnDB($db1);
$conn->debug = false;

//CONEXION CON LA TABLA ENTES
$conn2 = &ADONewConnection($target);
$conn2->PConnect($hostname,$username,$password,$db2);
$conn2->debug = false;



if($_REQUEST['rif']){
 $SQL="SELECT rnee_empresa.srif as srif FROM rnee.rnee_empresa 
	INNER JOIN  rnee.rnee_estatus_movimiento on rnee_estatus_movimiento.id_rnee_empresa=rnee_empresa.id
	WHERE rnee_empresa.srif='".$_REQUEST['rif']."' 
	AND rnee_estatus_movimiento.id_rnee_estatus <> 9 
	AND rnee_estatus_movimiento.id_rnee_estatus <> 14
	AND rnee_estatus_movimiento.id_rnee_estatus <> 15
	AND rnee_estatus_movimiento.id_rnee_estatus <> 16
	AND rnee_estatus_movimiento.id_rnee_estatus <> 17
	AND rnee_estatus_movimiento.nenabled=1 ";
	
	$rs = &$conn->Execute($SQL);
 if ($rs->RecordCount()>0){
	$resultado_['ESTATUS_WEBSERVER']="REPETIDO";
	echo json_encode($resultado_);	
	}else{

			
		 $SQL="SELECT * FROM seniat 
			
			WHERE srif='".$_REQUEST['rif']."' ";
			
			$rs2 = &$conn2->Execute($SQL);
			
			if ($rs2->RecordCount()>0){
				$resultado_['ESTATUS_WEBSERVER']="1";
				$resultado_['NOMBRE']=$rs2->fields['srazon_social'];
				$resultado_['APELLIDO']=$rs2->fields['sdenominacion_comercial'];
				$resultado_['TOMO']='';
				$resultado_['FOLIO']='';
				$resultado_['FECHA_MERCANTIL']='';
				$resultado_['NUMERO_MERCANTIL']='';
				$resultado_['CORREO_EMPRESA']=$rs2->fields['semail'];
				$resultado_['RIF_EMPRESA']='';
				$resultado_['TELEFONO1']='';
				$resultado_['TELEFONO2']='';
				$resultado_['DIRECCION']=$rs2->fields['estado']." ".$rs2->fields['municipio']." ".$rs2->fields['parroquia']." ".$rs2->fields['sdireccion_fiscal'];
			}else{
				$resultado_['ESTATUS_WEBSERVER']="-2";
			}
			
			
		echo json_encode($resultado_);	
	}

}



?>