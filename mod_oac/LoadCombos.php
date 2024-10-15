<?php


function LoadEstado($conn){  
global $conn;
	$sHtml_Var = "sHtml_cb_Estado";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT nentidad, sdescripcion, scapital FROM public.entidad  WHERE nenabled=1 ORDER BY sdescripcion";		
		$rs = &$conn->Execute($sSQL); 
		//echo "pase por aqui".$GLOBALS['aDefaultForm']['txt_ciudad']=$rs->fields['2'];
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

function LoadViaRecepcion($conn){
	global $conn;
	$sHtml_Var = "sHtml_cb_recepcion";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id_via_recepcion, sdecripcion_via_recepcion, nenabled
  FROM oac.via_recepcion where nenabled='1' order by sdecripcion_via_recepcion";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_recepcion']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
//			$GLOBALS[$sHtml_Var] .= ">".strtoupper ($rs->fields['1'])." </option>\n";
			$GLOBALS[$sHtml_Var] .= ">".($rs->fields['1'])." </option>\n";
			
			$rs->MoveNext();
		}		
	}
	}

function LoadAsistencia($conn){
	$sHtml_Var = "sHtml_cb_asistencia";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id_tipo_asistencia, stipo_asistencia, nenabled
  FROM oac.tipo_asistencia where nenabled='1' order by stipo_asistencia";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_asistencia']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
//			$GLOBALS[$sHtml_Var] .= ">".strtoupper($rs->fields['1'])." </option>\n";
			$GLOBALS[$sHtml_Var] .= ">".($rs->fields['1'])." </option>\n";
			$rs->MoveNext();
		}		
	}
	}
	
function LoadDetalleGestion($conn,$asistencia){
print" asistencia". $asistencia;
	$sHtml_Var = "sHtml_cb_detalle_gestion";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		if($asistencia<> 2 and $asistencia<> 0){
		$sSQL="SELECT id_gestion, sgestion_detalle, nenabled
  FROM oac.gestion_detalle where nenabled=1 and id_tipo_asistencia in(1,0) order by sgestion_detalle";		
		}
		if($asistencia== 2){
		$sSQL="SELECT id_gestion, sgestion_detalle, nenabled
  FROM oac.gestion_detalle where nenabled=1 and id_tipo_asistencia in(2,0) order by sgestion_detalle";		
		}
		if($asistencia== 0){
		$sSQL="SELECT id_gestion, sgestion_detalle, nenabled
  FROM oac.gestion_detalle where nenabled=1 order by sgestion_detalle";		
		}
		$rs = &$conn->Execute($sSQL); 
	
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_detalle_gestion']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
//			$GLOBALS[$sHtml_Var] .= ">".strtoupper($rs->fields['1'])." </option>\n";
			$GLOBALS[$sHtml_Var] .= ">".($rs->fields['1'])." </option>\n";
			$rs->MoveNext();
		}		
	}
	}
	function LoadTipoCasoRnet($conn){

	$sHtml_Var = "sHtml_cb_tipo_caso_rnet";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id_tipo_caso, sdescripcion_tipo_caso, nenabled
  FROM oac.caso_tipo_correccion where nenabled=1 order by sdescripcion_tipo_caso";		
		$rs = &$conn->Execute($sSQL); 
	
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_tipo_caso_rnet']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
//			$GLOBALS[$sHtml_Var] .= ">".strtoupper($rs->fields['1'])." </option>\n";
			$GLOBALS[$sHtml_Var] .= ">".($rs->fields['1'])." </option>\n";
			
			$rs->MoveNext();
		}		
	}
	}

function LoadDetalleCasoRnet($conn){

	$sHtml_Var = "sHtml_cb_detalle_caso_rnet";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id_detalle_caso, sdescripcion_detalle_caso, nenabled
  FROM oac.caso_detalle_correccion where nenabled=1 order by sdescripcion_detalle_caso";		
		$rs = &$conn->Execute($sSQL); 
	
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_detalle_caso_rnet']) {
				$GLOBALS[$sHtml_Var].= "selected='selected'";
			}
//			$GLOBALS[$sHtml_Var] .= ">".strtoupper($rs->fields['1'])." </option>\n";
			$GLOBALS[$sHtml_Var] .= ">".($rs->fields['1'])." </option>\n";
			
			$rs->MoveNext();
		}		
	}
	}
	
function LoaddatoCorregirRnet($conn){

	$sHtml_Var = "sHtml_cb_dato_corregir_rnet";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id_dato, sdescripcion_dato, nenabled
  FROM oac.caso_dato_correccion where nenabled=1  order by sdescripcion_dato";		
		$rs = &$conn->Execute($sSQL); 
	
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_dato_corregir_rnet']) {
				$GLOBALS[$sHtml_Var].= "selected='selected'";
			}
//			$GLOBALS[$sHtml_Var] .= ">".strtoupper($rs->fields['1'])." </option>\n";
			$GLOBALS[$sHtml_Var] .= ">".($rs->fields['1'])." </option>\n";
			$rs->MoveNext();
		}		
	}
	}	
		
function LoadResultado($conn){

	$sHtml_Var = "sHtml_cb_resultado";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id_status, sdescripcion_status, nenabled
  FROM oac.status_caso where nenabled=1 order by sdescripcion_status";		
		$rs = &$conn->Execute($sSQL); 
	
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_resultado']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			
			$rs->MoveNext();
		}		
	}
	}
	
	function LoadOrganismo($conn){

	$sHtml_Var = "sHtml_cb_organismo";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id_organismo, sorganismo, nenabled
  FROM oac.organismos where nenabled=1 order by sorganismo";		
		$rs = &$conn->Execute($sSQL); 
	
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_organismo']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
//			$GLOBALS[$sHtml_Var] .= ">".strtoupper($rs->fields['1'])." </option>\n";
			$GLOBALS[$sHtml_Var] .= ">".($rs->fields['1'])." </option>\n";
			
			$rs->MoveNext();
		}		
	}
	}
	
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
function cambiarMayusculas($cadena){
	$cadena = str_ireplace(	'&aacute;','Á',$cadena);
	$cadena = str_ireplace(	'&eacute;','É',$cadena);
	$cadena = str_ireplace(	'&iacute;','Í',$cadena);
	$cadena = str_ireplace(	'&oacute;','Ó',$cadena);
	$cadena = str_ireplace(	'&uacute;','Ú',$cadena);
	$cadena = str_ireplace(	'&ntilde;','Ñ',$cadena);
	$cadena = strtoupper($cadena);
	return $cadena;
}

?>



