<?php
//-------------------------------

include("../include/header.php");
$conn= getConnDB($db1);
$conn->debug=false;

//---------------Combo Roles Modulos
if ($_POST["combo"]=='Roles'){
	$sSQL="SELECT id, sdescripcion FROM rol WHERE nenabled = 1 AND modulo_id = '".$_POST["elegido"]."' ORDER BY sdescripcion;";	
	//echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$selec=""; 
	 $options.= "<option value=''>Seleccione</option>"; 
	while ( !$rs->EOF ){
	if ($rs->fields['0'] ==$_POST["seleccionado"]) {
		$selec= "selected='selected'";   
	}else{
		$selec= "";
	}
	 $options.= "<option ".$selec." value=".$rs->fields['0'].">".strtoupper($rs->fields['1'])."</option>";    
	 $rs->MoveNext();
	}					
	 echo $options;
}

//---------------Combo Modulos Opciones
if ($_POST["combo"]=='Opciones'){
	$sSQL="SELECT id, sdescripcion FROM opcion WHERE nmodulo = '".$_POST["elegido"]."' AND surl = '#' AND nenabled = 1 ORDER BY norden_salida;";	
	//echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$selec=""; 
	 $options.= "<option value=''>Seleccione</option>"; 
	while ( !$rs->EOF ){
	if ($rs->fields['0'] ==$_POST["seleccionado"]) {
		$selec= "selected='selected'";   
	}else{
		$selec= "";
	}
	 $options.= "<option ".$selec." value=".$rs->fields['0'].">".strtoupper($rs->fields['1'])."</option>";    
	 $rs->MoveNext();
	}					
	 echo $options;
}
?>
