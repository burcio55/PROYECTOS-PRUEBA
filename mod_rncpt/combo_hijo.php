<?php
error_reporting(E_ALL | E_STRICT);
include("../include/header.php"); 
ini_set("display_errors",0);
$conn= getConnDB($db1);
//-------------------------------------------------------------
//$conn->debug =true;
//var_dump ($conn);
//---------------Combo Estado--------------------------------------------------------------------
if ($_POST["combo"]=='Estado'){

/*	if ($_SESSION["ntipo"]=='3' || $_SESSION["ntipo"]=='5' || $_SESSION["ntipo"]=='6'){ $condicion="nregion = '".$_POST["elegido"]."' AND nentidad = '".$_SESSION["nentidad"]."'"; }
	if ($_SESSION["ntipo"]=='1' || $_SESSION["ntipo"]=='4' ){ $condicion="nregion = '".$_POST["elegido"]."' "; }*/
	
	
	$sSQL="SELECT nentidad, sdescripcion, nregion FROM public.entidad WHERE nregion = '".$_POST["elegido"]."' AND id<26 and nenabled='1' ORDER BY sdescripcion";	
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
	 $options.= "<option ".$selec." value=".$rs->fields['0'].">".$rs->fields['1']."</option>";    
	 $rs->MoveNext();
	}					
	 echo $options;
}

//---------------Combo Municipio--------------------------------------------------------------------
if ($_POST["combo"]=='Municipio'){

	$sSQL="SELECT nmunicipio, sdescripcion FROM public.municipio where nentidad='".$_POST["elegido"]."' ORDER BY sdescripcion";	
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
	 $options.= "<option ".$selec." value=".$rs->fields['0'].">".$rs->fields['1']."</option>";    
	 $rs->MoveNext();
	}					
	 echo $options;
}

//---------------Combo Parroquia--------------------------------------------------------------------
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

//---------------Combo Registro Mercantil-------------------------------------------------------------------
if ($_POST["combo"]=='Mercantil'){
	$sSQL="SELECT  id, snombre_registro FROM public.rnee_registro_mercantil WHERE entidad_id='".$_POST["elegido"]."' and ntipo_registro='".$_POST["tipo"]."'  ORDER BY snombre_registro";	
	//echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$selec=""; 
	 $options.= "<option value=''>Seleccione</option>"; 
	while ( !$rs->EOF ){
	if ($rs->fields['0'] ==$_POST["seleccionado"]) {
		$selec= "selected='selected'";   
	}else{
	$selec="";	
	}
	 $options.= "<option ".$selec." value=".$rs->fields['0'].">".$rs->fields['1']."</option>";    
	 $rs->MoveNext();
	}					
	 echo $options;
}


//----------------------------------------------------Combo Actividad Economica--------------------------------------------------------------------------------------------
if ($_POST["combo"]=='Actividad'){
    //devuelve el cod padre partiendo del cod hijo
		$_POST["elegido"]=trim($_POST["elegido"]);
    $numero_caracter = strlen($_POST["elegido"]); //cuenta la catidad de caracteres de la cadena  
	//	echo "VALOR=".$_POST["elegido"]."CARACTERES=".$numero_caracter;
		if($numero_caracter >=5) $rest = substr($_POST["elegido"],0,4); // devuelve los 4 primeros caracteres       
    if($numero_caracter ==4) $rest = substr($_POST["elegido"],0,3); // devuelve los 3 primeros caracteres    
    if($numero_caracter==3)  $rest = substr($_POST["elegido"],0,2); // devuelve los 2 primeros caracteres    
    if($numero_caracter==2) {
       if ($_POST["elegido"]>='01' and $_POST["elegido"]<='03') $rest='A';
       if ($_POST["elegido"]>='05' and $_POST["elegido"]<='09') $rest='B';
       if ($_POST["elegido"]>='10' and $_POST["elegido"]<='33') $rest='C';
       if ($_POST["elegido"]=='35') $rest='D';
       if ($_POST["elegido"]>='36' and $_POST["elegido"]<='39') $rest='E';
       if ($_POST["elegido"]>='41' and $_POST["elegido"]<='43') $rest='F';
       if ($_POST["elegido"]>='45' and $_POST["elegido"]<='47') $rest='G';
       if ($_POST["elegido"]>='49' and $_POST["elegido"]<='53') $rest='H';
       if ($_POST["elegido"]>='55' and $_POST["elegido"]<='56') $rest='I';
       if ($_POST["elegido"]>='58' and $_POST["elegido"]<='63') $rest='J';
       if ($_POST["elegido"]>='64' and $_POST["elegido"]<='66') $rest='K';
       if ($_POST["elegido"]>='68') $rest='L';
       if ($_POST["elegido"]>='69' and $_POST["elegido"]<='75') $rest='M';
       if ($_POST["elegido"]>='77' and $_POST["elegido"]<='82') $rest='N';
       if ($_POST["elegido"]>='84' ) $rest='O';
       if ($_POST["elegido"]>='85' ) $rest='P';
       if ($_POST["elegido"]>='86' and $_POST["elegido"]<='88') $rest='Q';
       if ($_POST["elegido"]>='90' and $_POST["elegido"]<='93') $rest='R';
       if ($_POST["elegido"]>='94' and $_POST["elegido"]<='96') $rest='S';
       if ($_POST["elegido"]>='97' and $_POST["elegido"]<='98') $rest='T';
       if ($_POST["elegido"]>='99' ) $rest='U';
       }
//     echo "RESULTADO=".$rest;  
$sSQL="SELECT id, cod, nombre, cod_padre  FROM public.actividad_eco where cod ='".$rest."' ORDER BY nombre";    
    $rs = &$conn->Execute($sSQL); 
     $options.= "<option value=''>Seleccione</option>"; 
    while ( !$rs->EOF ){
    $selec="";
    if ($rs->fields['1'] ==$_POST["seleccionado"]) {
        $selec= "selected='selected'";   
        }
     $options.= "<option ".$selec." value=".$rs->fields['1'].">".substr($rs->fields['2'],0,100)."</option>";    
     $rs->MoveNext();
    }                    
      echo $options; 
 }
 
//COMBO OCUPACION
//----------COMBO PROFESION
if ($_POST["combo"]=='Profesion'){
$numero_caracter = strlen($_POST["elegido"]);
if($numero_caracter >=5) $rest = substr($_POST["elegido"],0,4); // devuelve los 4 primeros caracteres	
if($numero_caracter==4)  $rest = substr($_POST["elegido"],0,3); // devuelve los 3 primeros caracteres	
if($numero_caracter==3)  $rest = substr($_POST["elegido"],0,2); // devuelve los 2 primeros caracteres	
if($numero_caracter==2)  $rest = substr($_POST["elegido"],0,1); // devuelve los 1 primeros caracteres	
$sSQL="SELECT id, cod, snombre, cod_padre  FROM public.ocupacion where cod='".$rest."' and nenabled='1' ORDER BY snombre";	
//echo $sSQL;
$rs = &$conn->Execute($sSQL); 
$options.= "<option value=''>Seleccione</option>"; 
while ( !$rs->EOF ){
$selec="";
if ($rs->fields['1'] ==$_POST["seleccionado"]) {
$selec= "selected='selected'";   
}
$options.= "<option ".$selec." value=".$rs->fields['cod'].">".substr($rs->fields['2'],0,80)."</option>";    
$rs->MoveNext();
}	
 echo $options; 
 }
//FIN COMBO OCUPACION 

//---------------Combo Estado--------------------------------------------------------------------
if ($_POST["combo"]=='Sector'){

	$sSQL="SELECT id, sdescripcion FROM scpt.sector WHERE nenabled = '1' AND motor_id = '".$_POST["elegido"]."' ORDER BY sdescripcion";	
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
	 $options.= "<option ".$selec." value=".$rs->fields['0'].">".$rs->fields['1']."</option>";    
	 $rs->MoveNext();
	}					
	 echo $options;
}


?>