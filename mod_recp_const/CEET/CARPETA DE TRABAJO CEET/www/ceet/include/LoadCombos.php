<?php
function LoadEstado($conn){  
	$sHtml_Var = "sHtml_cb_Estado";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT public.entidad.nentidad, public.entidad.sdescripcion FROM public.entidad  WHERE id<'25' ORDER BY public.entidad.sdescripcion";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_entidad']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}

/*function LoadMunicipio($conn,$parametro){  
	$sHtml_Var = "sHtml_cb_Municipio";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT nmunicipio, sdescripcion FROM public.municipio WHERE nentidad='".$parametro."' ORDER BY sdescripcion";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_municipio']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}*/

function LoadMunicipio($conn, $cbo_municipio){  
	$SQL="SELECT sdescripcion FROM public.municipio WHERE nmunicipio='".$cbo_municipio."'"; 				
	$rs=$conn->Execute($SQL);
	$cbo_municipio_descripcion=ucfirst(strtolower($rs->fields['sdescripcion']));
	return $cbo_municipio_descripcion;
}

function LoadParroquia($conn, $cbo_parroquia){  
	$SQL="SELECT sdescripcion FROM public.parroquia WHERE nparroquia='".$cbo_parroquia."'"; 				
	$rs=$conn->Execute($SQL);
	$cbo_parroquia_descripcion=ucfirst(strtolower($rs->fields['sdescripcion']));
	return $cbo_parroquia_descripcion;
}

function LoadCiudad($conn, $cbo_ciudad){  
	$SQL="SELECT scapital FROM public.entidad WHERE nentidad='".$cbo_ciudad."'"; 				
	$rs=$conn->Execute($SQL);
	$cbo_ciudad_descripcion=ucfirst(strtolower($rs->fields['scapital']));
	return $cbo_ciudad_descripcion;
}
?>