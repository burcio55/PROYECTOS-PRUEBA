<?php
//------------------------------------------------------------------------------------------------------------------------------
function LoadPais_nac_afiliado($conn){  
	$sHtml_Var = "sHtml_cb_Pais_nac_afiliado";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}
/*	if ($GLOBALS['aDefaultForm']['cbNacionalidad_afiliado']=='1'){
		$param= " and id ='239'";
		}
	if ($_POST['cbNacionalidad_afiliado']=='2'){
	    $param= " and id !='239'";
		}	*/
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.pais where status='A' ORDER BY cod";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbPais_nac_afiliado']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function LoadEstado_Civil_afiliado($conn){  
	$sHtml_Var = "sHtml_cb_Estado_Civil_afiliado";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.estado_civil where status='A' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbEstado_Civil_afiliado']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadPais_afiliado($conn){  
	$sHtml_Var = "sHtml_cb_Pais_afiliado";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.pais where status='A' and id='239' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbPais_afiliado']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadEstado_afiliado($conn){  
	$sHtml_Var = "sHtml_cb_Estado_afiliado";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.estado where pais_id='239' and status='A' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['id']."'";
			if ($rs->fields['id'] == $GLOBALS['aDefaultForm']['cbEstado_afiliado']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['nombre']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadVehiculo_afiliado($conn){  
	$sHtml_Var = "sHtml_cb_Vehiculo_afiliado";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre FROM public.tipo_vehiculo where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbVehiculo_afiliado']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadTipo_migrante($conn, $ced){  
    if($ced=='V' or $ced=='E'){
	   $tipo="'V'";
	   }
	if($ced=='P'){
	   $tipo="'P'";	
	}
	$sHtml_Var = "sHtml_cb_Tipo_migrante";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.tipo_migrante where status='A' and tipo_persona=".$tipo." ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbTipo_migrante']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadCausa_migrante($conn){  
	$sHtml_Var = "sHtml_cb_Causa_migrante";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.causa_migracion where status='A' and padre_id='0'ORDER BY id";		
     	$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbCausa_migrante']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}

//-----------------------------------------------------------------------------------------------------------------------------
function LoadPais_migrante($conn){  
	$sHtml_Var = "sHtml_cb_Pais_migrante";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.pais where status='A' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbPais_migrante']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function LoadTipo_discapacidad($conn){  
	$sHtml_Var = "sHtml_cb_Tipo_discapacidad";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.discapacidad where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbTipo_discapacidad']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	} 
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadDiscapacidad_nivel($conn){  
	$sHtml_Var = "sHtml_cb_Discapacidad_nivel";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, descripcion  FROM public.nivel_discapacidad where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbDiscapacidad_nivel']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." - ".$rs->fields['2']." </option>\n";
			$rs->MoveNext();
		}		
	} 
}  

//------------------------------------------------------------------------------------------------------------------------------
function LoadDiscapacidad_origen($conn){  
	$sHtml_Var = "sHtml_cb_Discapacidad_origen";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre  FROM public.discapacidad_origen where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbDiscapacidad_origen']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	} 
} 

//------------------------------------------------------------------------------------------------------------------------------
function LoadcbCertificado($conn){  
	$sHtml_Var = "sHtml_cb_Certificado";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre  FROM public.discapacidad_certificado where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbCertificado']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	} 
} 
//------------------------------------------------------------------------------------------------------------------------------
function LoadTipo_Ayuda_discapacidad($conn){  
	$sHtml_Var = "sHtml_cb_Tipo_Ayuda_discapacidad";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.discapacidad_ayuda where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbTipo_Ayuda_discapacidad']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadReferido_discapacidad($conn){  
	$sHtml_Var = "sHtml_cb_Referido_discapacidad";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.referido_servicio_discapacidad where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbReferido_discapacidad']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadReferido($conn){  
	$sHtml_Var = "sHtml_cb_Referido";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.referido_ppie where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbReferido']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadMotivo_referido($conn){  
	$sHtml_Var = "sHtml_cb_Motivo_referido";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.motivo_referido_ppie where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbMotivo_referido']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadAct_economica4($conn, $param){  
	$sHtml_Var = "sHtml_cb_Act_economica4";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){	
	$sSQL="SELECT id, cod, nombre, cod_padre FROM public.actividad_eco where id >= '348' and status='A' ".$param."  ORDER BY id";  
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['1']."'";
			if ($rs->fields['1'] == $GLOBALS['aDefaultForm']['cbAct_economica4']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".substr($rs->fields['2'],0,80)."  </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadOcupacion5_interes_1($conn, $param){  
	$sHtml_Var = "sHtml_cb_Ocupacion5_interes_1";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
	$sSQL="SELECT id, cod, nombre, cod_padre FROM public.ocupacion where id >= '620' and status='A' ".$param."  ORDER BY nombre";	  
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['1']."'";
			if ($rs->fields['1'] == $GLOBALS['aDefaultForm']['cbOcupacion5_interes_1']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".substr($rs->fields['2'],0,80)."  </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadOcupacion5_interes2($conn, $param){  
	$sHtml_Var = "sHtml_cb_Ocupacion5_interes2";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
	$sSQL="SELECT id, cod, nombre, cod_padre FROM public.ocupacion where id >= '620' and status='A' ".$param."  ORDER BY nombre";	  
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['1']."'";
			if ($rs->fields['1'] == $GLOBALS['aDefaultForm']['cbOcupacion5_interes2']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".substr($rs->fields['2'],0,80)."  </option>\n";
			$rs->MoveNext();
		}		
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function LoadOcupacion5_experiencia($conn, $param){  
	$sHtml_Var = "sHtml_cb_Ocupacion5_experiencia";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
	$sSQL="SELECT id, cod, nombre, cod_padre FROM public.ocupacion where id >= '620' and status='A' ".$param."  ORDER BY nombre";	  
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['1']."'";
			if ($rs->fields['1'] == $GLOBALS['aDefaultForm']['cbOcupacion5_experiencia']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".substr($rs->fields['2'],0,80)."  </option>\n";
			$rs->MoveNext();
		}		
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function LoadJornada_interes($conn){  
	$sHtml_Var = "sHtml_cb_Jornada_interes";
	if (!isset($GLOBALS[$sHtml_Var])){
	   	$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id,  nombre, status  FROM public.turno_jornada where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbJornada_interes']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']."  </option>\n";
			$rs->MoveNext();
		}		
	}
}
//----------------------------------------------------------------------------------------------------------------------------
function LoadNivel_academico($conn){  
	$sHtml_Var = "sHtml_cb_Nivel_academico";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.nivel_instruccion where status='A' ORDER BY orden";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbNivel_academico']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadCentro_capacitacion($conn){  
	$sHtml_Var = "sHtml_cb_Centro_capacitacion";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.centro_capacitacion where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbCentro_capacitacion']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadCurso_categoria($conn){  
	$sHtml_Var = "sHtml_cb_Curso_categoria";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.categoria_curso where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbCurso_categoria']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function LoadComputacion($conn){  
	$sHtml_Var = "sHtml_cb_Computacion";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.computacion where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbComputacion']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadIdioma($conn){  
	$sHtml_Var = "sHtml_cb_Idioma";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.idioma where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbIdioma']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function LoadAct_economica($conn,$param){  
	$sHtml_Var = "sHtml_cb_Act_economica";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, cod, nombre,status  FROM public.actividad_eco where status='A' ".$param."  ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbAct_economica']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." - ".substr($rs->fields['2'],0,60)."  </option>\n";
			$rs->MoveNext();
		}		
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function LoadSector_empleo($conn){  
	$sHtml_Var = "sHtml_cb_Sector_empleo";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.sector_empleo where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbSector_empleo']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".substr($rs->fields['1'],0,50)."  </option>\n";
			$rs->MoveNext();
		}		
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function LoadMotivo_retiro($conn){  
	$sHtml_Var = "sHtml_cb_Motivo_retiro";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.motivo_retiro where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbMotivo_retiro']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".substr($rs->fields['1'],0,80)." </option>\n";
			$rs->MoveNext();
		}		
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function LoadTipo_situacion_familiar($conn){  
	$sHtml_Var = "sHtml_cb_Tipo_situacion_familiar";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.situacion_laboral where status='A' and tipo='".$GLOBALS['aDefaultForm']['cbSituacion_familiar']."' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbTipo_situacion_familiar']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadEstado_org($conn){  //organizacion comunitaria
	$sHtml_Var = "sHtml_cb_Estado_org";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.estado where status='A' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbEstado_org']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadMunicipio_org($conn){   //organizacion comunitaria
	$sHtml_Var = "sHtml_cb_Municipio_org";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.municipio where estado_id='".$GLOBALS['aDefaultForm']['cbEstado_org']."' and status='A' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbMunicipio_org']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadParroquia_org($conn){    //organizacion comunitaria
	$sHtml_Var = "sHtml_cb_Parroquia_org";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.parroquia where municipio_id='".$GLOBALS['aDefaultForm']['cbMunicipio_org']."' and status='A' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbParroquia_org']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}


//------------------------------------------------------------------------------------------------------------------------------
function LoadCapital($conn){    
	$sHtml_Var = "sHtml_cb_Capital";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre  FROM public.capital where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbCapital']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadEstado_empresa($conn){  
	$sHtml_Var = "sHtml_cb_Estado_empresa";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.estado where status='A' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbEstado_empresa']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
/*function LoadMunicipio_empresa($conn){  
	$sHtml_Var = "sHtml_cb_Municipio_empresa";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.municipio where estado_id='".$GLOBALS['aDefaultForm']['cbEstado_empresa']."' and status='A' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbMunicipio_empresa']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadParroquia_empresa($conn){  
	$sHtml_Var = "sHtml_cb_Parroquia_empresa";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.parroquia where municipio_id='".$GLOBALS['aDefaultForm']['cbMunicipio_empresa']."' and status='A' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbParroquia_empresa']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}*/
//------------------------------------------------------------------------------------------------------------------------------
function LoadTipo_contrato($conn){  
	$sHtml_Var = "sHtml_cb_Tipo_contrato";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.tipo_contrato where status='A' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbTipo_contrato']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadTipo_jornada($conn){  
	$sHtml_Var = "sHtml_cb_Tipo_jornada";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.turno_jornada where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbTipo_jornada']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadTipo_salario($conn){  
	$sHtml_Var = "sHtml_cb_Tipo_salario";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.tipo_salario where status='A' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbTipo_salario']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadTipo_colectivo($conn){ 
	$sHtml_Var = "sHtml_cb_Tipo_colectivo";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.colectivos where status='A' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbTipo_colectivo']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadCarreraCon($conn,$param){  
	$sHtml_Var = "sHtml_cb_CarreraCon";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, cod, nombre,status  FROM public.area_mencion where status='A' and id !='-1' ".$param." ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbCarreraCon']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['2']."  </option>\n";
			$rs->MoveNext();
		}		
    }
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadStatus($conn){  
	$sHtml_Var = "sHtml_cb_Status";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre FROM public.status_oferta where status='A' and tipo_status='1' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbStatus']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadStatus1($conn){  
	$sHtml_Var = "sHtml_cb_Status1";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre FROM public.status_oferta where tipo_status='1' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbStatus1']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadStatus3($conn){  
	$sHtml_Var = "sHtml_cb_Status3";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre FROM public.status_oferta where status='A' and tipo_status='2' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbStatus3']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadStatus4($conn){  
	$sHtml_Var = "sHtml_cb_Status4";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre FROM public.status_oferta where tipo_status='2' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbStatus4']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadObjeto_org($conn){  
	$sHtml_Var = "sHtml_cb_Objeto_org";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.tipo_organizacion where status='A' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbObjeto_org']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadAgencia($acceso1){  
	$sHtml_Var = "sHtml_cb_Agencia";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT sunidadsustantiva, sdenominacion, ciudad  FROM public.unidadsustantiva where sdenominacion like '%AGENCIA%' and vigente='S' ORDER BY sdenominacion";		
		$rs = &$acceso1->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbAgencia']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadMisiones_Educacion($conn){  
	$sHtml_Var = "sHtml_cb_Misiones_Educacion";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.misiones where status='A' and tipo='1' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbMisiones_Educacion']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
} 
//------------------------------------------------------------------------------------------------------------------------------
function LoadMisiones_social($conn){  
	$sHtml_Var = "sHtml_cb_Misiones_social";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.misiones where status='A' and tipo='2' ORDER BY nombre";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbMisiones_social']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadNo_cotiza($conn){  
	$sHtml_Var = "sHtml_cb_No_cotiza";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.no_cotiza where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbNo_cotiza']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".substr($rs->fields['1'],0,80)." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadNo_cotiza_anterior($conn){  
	$sHtml_Var = "sHtml_cb_No_cotiza_anterior";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.no_cotiza where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbNo_cotiza_anterior']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".substr($rs->fields['1'],0,80)." </option>\n";
			$rs->MoveNext();
		}		
	}
}   
//------------------------------------------------------------------------------------------------------------------------------
function LoadTipo_pension($conn){  
	$sHtml_Var = "sHtml_cb_Tipo_pension";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.tipo_pension where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbTipo_pension']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadNo_seguir_cotiza($conn){  
	$sHtml_Var = "sHtml_cb_No_seguir_cotiza";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, nombre, status  FROM public.no_seguir_cotiza where status='A' ORDER BY id";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbNo_seguir_cotiza']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".substr($rs->fields['1'],0,80)." </option>\n";
			$rs->MoveNext();
		}		
	}
}
?>