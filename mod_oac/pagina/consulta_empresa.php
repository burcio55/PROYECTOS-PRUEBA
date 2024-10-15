<?php
include('include/header.php');
$conn2 = &ADONewConnection($target);
$conn2->PConnect($hostname,$username,$password,$db_settings[0]);
$conn2->debug = $settings['debug'];
function buscar_entidad_trabajo_rnet($sRif){
	global $conn2;
	$aDatos = array();	
	$sql = "select * from rnee.rnee_empresa where rnee.rnee_empresa.srif='".$sRif."' ";	
	$rs_emp = $conn2->Execute($sql);
	$aDatos['empresa_id'] = $rs_emp->fields['empresa_id'];			
	
	$aDatos['sEmpresa'] = strtoupper($rs_emp->fields['srazon_social']);
	$aDatos['Tel_Emp'] = $rs_emp->fields['ntelefono_local'];	
	$aDatos['Dir_Emp'] = $rs_emp->fields['sdireccion_fiscal'];	
	$aDatos['empresa_email'] = $rs_emp->fields['semail'];	
	$aDatos['sRif'] = $sRif= $rs_emp->fields['srif'];		
	$aDatos['sNil'] = $rs_emp->fields['snil'];
	$aDatos['sInce'] = $rs_emp->fields['nince'];
	$aDatos['sFaov'] = $rs_emp->fields['nbanavih'];

	var_dump($aDatos);
	return $aDatos;	
	
	}
?>