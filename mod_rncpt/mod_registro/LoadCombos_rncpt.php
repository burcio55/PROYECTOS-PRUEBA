<?php
//COMBO REGION
function LoadRegion($conn){  
	
	if ($_SESSION["ntipo"]=='4'){ 
		$sHtml_Var = "sHtml_cb_Region";
		if (!isset($GLOBALS[$sHtml_Var])){
			$GLOBALS[$sHtml_Var] = '';
		}	
		if ($GLOBALS[$sHtml_Var] == ''){
			$sSQL="SELECT region.id,region.sdescripcion FROM public.region WHERE region.nenabled=1  ORDER BY sdescripcion";	
			$rs = &$conn->Execute($sSQL); 
			while ( !$rs->EOF ){
				$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
				if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_region']) {
					$GLOBALS[$sHtml_Var].= " selected='selected'";
				}
				$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
				$rs->MoveNext();
			}		
		}
	}else{
		$sHtml_Var = "sHtml_cb_Region";
		if (!isset($GLOBALS[$sHtml_Var])){
			$GLOBALS[$sHtml_Var] = '';
		}	
		if ($GLOBALS[$sHtml_Var] == ''){
			$sSQL="SELECT region.id,region.sdescripcion FROM region INNER JOIN entidad ON region.id::varchar = entidad.nregion AND region.nenabled=1 AND entidad.nenabled=1 AND entidad.nentidad = '".$_SESSION["nentidad"]."'";	
			$rs = &$conn->Execute($sSQL); 
			while ( !$rs->EOF ){
				$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
				if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_region']) {
					$GLOBALS[$sHtml_Var].= " selected='selected'";
				}
				$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
				$rs->MoveNext();
			}		
		}
	}
}

function LoadRegion2($conn){  
	$sHtml_Var = "sHtml_cb_Region2";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT region.id,region.sdescripcion FROM public.region WHERE region.nenabled=1  ORDER BY sdescripcion ";	
		//echo $sSQL;	
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_region2']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}

function LoadEstado($conn){  
	$sHtml_Var = "sHtml_cb_Estado";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT nentidad, sdescripcion FROM public.entidad WHERE nregion ='".$_SESSION["nregion"]."' AND id<25 ORDER BY sdescripcion";
		echo $sSQL;		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_estado_consulta']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}

//______________________________________________________________

function LoadEstado2($conn){  

if($_SESSION['ntipo']=='5'){ $condicion="AND nregion='".$_SESSION['nregion']."'";} else{ $condicion=""; }		

	$sHtml_Var = "sHtml_cb_Estado2";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT nentidad, sdescripcion FROM public.entidad WHERE id<25  ".$condicion." ORDER BY sdescripcion";
		echo $sSQL;		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_estado_consulta2']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//_______________________________________________________________________________



function LoadCargos($conn){  
	$sHtml_Var = "sHtml_cb_Cargos";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT cod_cargos, descripcion_cargo FROM rncpt.cargos where nenabled='1' order by descripcion_cargo ";
		echo $sSQL;		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_cargos']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}









function LoadEstadoReporte($conn){  

if($_SESSION['ntipo']=='5'){ $condicion="AND nregion='".$_SESSION['nregion']."'";} else{ $condicion=""; }		

	$sHtml_Var = "sHtml_cb_Estado_Reporte";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT nentidad, sdescripcion FROM public.entidad WHERE id<25  ".$condicion." ORDER BY sdescripcion";
		echo $sSQL;		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_estado_reporte']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}


/*COMBO MOTOR*/
function LoadMotor($conn){  
	$sHtml_Var = "sHtml_cb_Motor";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, sdescripcion FROM rncpt.motor WHERE nenabled='1' ORDER BY sdescripcion";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_motor']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}


/*COMBO SECTOR*/
function LoadSector($conn){  
	$sHtml_Var = "sHtml_cb_Sector";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, sdescripcion FROM rncpt.sector WHERE nenabled='1' ORDER BY sdescripcion";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_sector']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}


/*COMBO SECTOR*/
function LoadProducto($conn){  
	$sHtml_Var = "sHtml_cb_Producto";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, sdescripcion FROM public.productos WHERE nenabled='1' ORDER BY sdescripcion";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_producto']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".utf8_decode($rs->fields['1'])." </option>\n";
			$rs->MoveNext();
		}		
	}
}


function LoadMedida($conn){  
	$sHtml_Var = "sHtml_cb_Medida";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, sdescripcion FROM public.medida WHERE nenabled='1' ORDER BY sdescripcion";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_medida']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
/*
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
*/







function LoadActividad($conn){  
	$sHtml_Var = "sHtml_cb_actividadEco";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id,nombre,cod FROM public.actividad_eco order by nombre";
		echo $sSQL;		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_actividadEco']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}















function LoadTcomite($conn){  
	$sHtml_Var = "sHtml_cb_Tcomite";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, sdescripcion FROM rncpt.tipo_comite WHERE nenabled='1' ORDER BY sdescripcion";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cb_Tcomite']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}

?>

