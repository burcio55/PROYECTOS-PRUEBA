<?php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
//-------------------------------------------------------------
include('include/header.php');
$conn= getConnDB($db3);
$conn->debug = true;

//---------------Combo Municipio
if ($_POST["combo"]=='Municipio'){
	$sSQL="SELECT nmunicipio, sdescripcion FROM public.municipio where nentidad='".$_POST["elegido"]."' ORDER BY sdescripcion";	
	echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$selec=""; 
	 $options.= "<option value=''>Seleccione</option>"; 
	while ( !$rs->EOF ){
	if ($rs->fields['0'] ==$_POST["seleccionado"]) {
		$selec= "selected='selected'";   
	}else{
		$selec= "";
	}
	 $options.= "<option ".$selec." value=".$rs->fields['0'].">".$rs->fields['1']."</option>";    
	 $rs->MoveNext();
	}					
	 echo $options;
}

//---------------Combo Parroquia
if ($_POST["combo"]=='Parroquia'){
	$sSQL="SELECT nparroquia, sdescripcion FROM public.parroquia where nmunicipio='".$_POST["elegido"]."' ORDER BY sdescripcion";	
//	echo $sSQL;
	$rs = &$conn->Execute($sSQL); 
		$selec=""; 
	 $options.= "<option value=''>Seleccione</option>"; 
	while ( !$rs->EOF ){
	if ($rs->fields['0']==$_POST["seleccionado"]) {
		$selec= "selected='selected'";   
		}else{
		$selec=""; 
		}
	 $options.= "<option ".$selec." value=".$rs->fields['0'].">".$rs->fields['1']."</option>";    
	 $rs->MoveNext();
	}					
	 echo $options;
}

if ($_POST["combo"]=='Ciudad'){
	$sSQL="SELECT nentidad, scapital FROM public.entidad where nentidad='".$_POST["elegido"]."' ORDER BY sdescripcion";	
//	echo $sSQL;
	$rs = &$conn->Execute($sSQL); 
		$selec=""; 
	 $options.= "<option value=''>Seleccione</option>"; 
	while ( !$rs->EOF ){
	if ($rs->fields['0']==$_POST["seleccionado"]) {
		$selec= "selected='selected'";   
		}else{
		$selec=""; 
		}
	 $options.= "<option ".$selec." value=".$rs->fields['0'].">".$rs->fields['1']."</option>";    
	 $rs->MoveNext();
	}					
	 echo $options;
}
?>