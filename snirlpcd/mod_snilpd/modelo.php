<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
$conn = getConnDB('sire');
$conn->debug = true;

if ($_GET["combo"] == 'Estado_nac_al_cargar') {
	//echo ('en el modelo.php');
	$param = " and pais_id='239'";
	$sSQL = "SELECT id, nombre, status  FROM public.estado where status ='A' " . $param . " ORDER BY nombre";
	////$sSQL = "SELECT id, nombre, status  FROM public.estado where id ='02' "; // . $param . " ORDER BY nombre";
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$selec = "";
		if ($rs->fields['0'] == $_POST["seleccionado"]) {
			$selec = "selected='selected'";
		}
		$options .= "<option " . $selec . " value=" . $rs->fields['0'] . ">" . ucfirst($rs->fields['1']) . "</option>";
		$rs->MoveNext();
	}
	echo $options;
}

//---------------Combo Estado Nacimiento--------------------------------------------------------------------
if ($_POST["combo"] == 'Estado_nac') {

	if ($_POST["elegido"] == '239') {
		$param = " and pais_id='239'";
	} else {
		$param = " and pais_id='-1'";
	}

	$sSQL = "SELECT id, nombre, status  FROM public.estado where status ='A' " . $param . " ORDER BY nombre";
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$selec = "";
		if ($rs->fields['0'] == $_POST["seleccionado"]) {
			$selec = "selected='selected'";
		}
		$options .= "<option " . $selec . " value=" . $rs->fields['0'] . ">" . ucfirst($rs->fields['1']) . "</option>";
		$rs->MoveNext();
	}
	echo $options;
}

//---------------Combo Estado Residencia--------------------------------------------------------------------
if ($_POST["combo"] == 'Estado') {

	if ($_POST["elegido"] == '239') {
		$param = " and pais_id='239'";
	} else {
		$param = " and pais_id='-1'";
	}

	$sSQL = "SELECT id, nombre, status  FROM public.estado where status ='A' " . $param . " ORDER BY nombre";
	//echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$selec = "";
		if ($rs->fields['0'] == $_POST["seleccionado"]) {
			$selec = "selected='selected'";
		}
		$options .= "<option " . $selec . " value=" . $rs->fields['0'] . ">" . ucfirst($rs->fields['1']) . "</option>";
		$rs->MoveNext();
	}
	echo $options;
}

//---------------Combo Municipio Residencia--------------------------------------------------------------------
if ($_POST["combo"] == 'Municipio') {
	$sSQL = "SELECT id, nombre, status  FROM public.municipio where estado_id='" . $_POST["elegido"] . "' and status='A' ORDER BY nombre";
	//echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$selec = "";
		if ($rs->fields['0'] == $_REQUEST["seleccionado"]) {
			$selec = "selected='selected'";
		}
		$options .= "<option " . $selec . " value=" . $rs->fields['0'] . ">" . $rs->fields['1'] . "</option>";
		$rs->MoveNext();
	}
	echo $options;
}
//---------------Combo Parroquia Residencia--------------------------------------------------------------------
if ($_POST["combo"] == 'Parroquia') {
	$sSQL = "SELECT id, nombre, status  FROM public.parroquia where municipio_id='" . $_POST["elegido"] . "' and status='A' ORDER BY nombre";
	//echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$selec = "";
		if ($rs->fields['0'] == $_REQUEST["seleccionado"]) {
			$selec = "selected='selected'";
		}
		$options .= "<option " . $selec . " value=" . $rs->fields['0'] . ">" . $rs->fields['1'] . "</option>";
		$rs->MoveNext();
	}
	echo $options;
}

//---------------Combo Causa Migrante--------------------------------------------------------------------
if ($_POST["combo"] == 'Causa_mig') {
	$sSQL = "SELECT id, nombre, status  FROM public.causa_migracion where status='A' and padre_id='" . $_POST["elegido"] . "' ORDER BY id";
	//echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$selec = "";
		if ($rs->fields['0'] == $_POST["seleccionado"]) {
			$selec = "selected='selected'";
		}
		$options .= "<option " . $selec . " value=" . $rs->fields['0'] . ">" . $rs->fields['1'] . "</option>";
		$rs->MoveNext();
	}
	echo $options;
}

//---------------Combo ORIGEN DISCAPACIDAD--------------------------------------------------------------------
if ($_POST["combo"] == 'Discapacidad_origen') {
	$sSQL = "SELECT id, nombre, status  FROM public.discapacidad_adquirida where status='A' and discapacidad_origen_id='" . $_POST["elegido"] . "' ORDER BY id";
	//echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$selec = "";
		if ($rs->fields['0'] == $_POST["seleccionado"]) {
			$selec = "selected='selected'";
		}
		$options .= "<option " . $selec . " value=" . $rs->fields['0'] . ">" . $rs->fields['1'] . "</option>";
		$rs->MoveNext();
	}
	echo $options;
}

//---------------Combo carrera y regimen dependen de LoadNivel_academico----------------------------------------------------------
if ($_POST["combo"] == 'Carrera') {
	$sSQL1 = "select regimen_estudio.id, regimen_estudio.nombre, nivel_regimen.status  
	from nivel_regimen
	INNER JOIN nivel_instruccion ON nivel_instruccion.id=nivel_regimen.nivel_id 
	INNER JOIN regimen_estudio ON regimen_estudio.id=nivel_regimen.regimen_id
	where nivel_regimen.nivel_id ='" . $_POST["elegido"] . "' ORDER BY id";
	echo $sSQL;
	$rs1 = &$conn->Execute($sSQL1);
	$options1 .= "<option value=''>Seleccione</option>";
	while (!$rs1->EOF) {
		$selec = "";
		if ($rs1->fields['0'] == $_POST["seleccionado2"]) {
			$selec = "selected='selected'";
		}
		$options1 .= "<option " . $selec . " value=" . $rs1->fields['0'] . ">" . $rs1->fields['1'] . "</option>";
		$rs1->MoveNext();
	}

	//----------------Carrera-----------------------------------------------------------------------------------------------
	$sSQL = "SELECT id, cod, nombre,status FROM public.area_mencion where status='A' and cod_padre='0'
	and nivel_id ='" . $_POST["elegido"] . "' ORDER BY id";
	echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$selec = "";
		if ($rs->fields['1'] == $_POST["seleccionado"]) {
			$selec = "selected='selected'";
		}
		$options .= "<option " . $selec . " value=" . $rs->fields['1'] . ">" . $rs->fields['2'] . "</option>";
		$rs->MoveNext();
	}

	$opcion3 = $options . "|" . $options1;
	echo $opcion3;
}

//---------------Combo carrera1-depende de carrera--------------------------------------------------------------------
if ($_POST["combo"] == 'Carrera1' or $_POST["combo"] == 'Carrera2' or $_POST["combo"] == 'Carrera3') {
	if ($_POST["elegido"] != '-1') {
		$sSQL = "SELECT id, cod, nombre,status  FROM public.area_mencion where status='A' and cod_padre = '" . $_POST["elegido"] . "' ORDER BY id";
		//echo $sSQL;
		$rs = &$conn->Execute($sSQL);
		$options .= "<option value=''>Seleccione</option>";
		while (!$rs->EOF) {
			$selec = "";
			if ($rs->fields['1'] == $_POST["seleccionado"]) {
				$selec = "selected='selected'";
			}
			$options .= "<option " . $selec . " value=" . $rs->fields['1'] . ">" . $rs->fields['2'] . "</option>";
			$rs->MoveNext();
		}
		echo $options;
	}
}
//---------------------Condicion Ocupacion----------------------------------------------------------------
if ($_POST["combo"] == 'condicion') {
	$sSQL = "SELECT id, nombre, status  FROM public.situacion_laboral where status='A' and tipo='" . $_POST["elegido"] . "' ORDER BY id";
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$selec = "";
		if ($rs->fields['0'] == $_POST["seleccionado"]) {
			$selec = "selected='selected'";
		}
		$options .= "<option " . $selec . " value=" . $rs->fields['0'] . ">" . substr($rs->fields['1'], 0, 80) . "</option>";
		$rs->MoveNext();
	}
	echo $options;
}

//---------------------Rif--------------------------------------------------------------------------------------------------------------------
if ($_POST["combo"] == 'rif') {
	$sSQL = "SELECT rif, patrono, sector_empleo_id, telefono, ocupacione_id, f_ingreso, f_egreso FROM persona_experiencia_laboral where rif ='" . $_POST["elegido"] . "';";
	$rs = $conn->Execute($sSQL);
	if (isset($rs)) {
		//Si $rs trae options los muestra en sus respectivos input y select valiendose del javascript
		//$options = $rs->fields["patrono"]." | ".$rs->fields["telefono"];
		$options = $rs->fields["patrono"]; //." | ".$rs->fields["telefono"];
	}
	echo $options;
}

//---------------------Actividad-----------------------------------------------------------------------------------------------------
if ($_POST["combo"] == 'Actividad') {
	//devuelve el cod padre partiendo del cod hijo
	$numero_caracter = strlen($_POST["elegido"]); //cuenta la catidad de caracteres de la cadena		
	if ($numero_caracter >= 4) $rest = substr($_POST["elegido"], 0, 3); // devuelve los 3 primeros caracteres	
	if ($numero_caracter == 3)  $rest = substr($_POST["elegido"], 0, 2); // devuelve los 2 primeros caracteres	
	if ($numero_caracter == 2) {
		if ($_POST["elegido"] >= '01' and $_POST["elegido"] <= '03') $rest = 'A';
		if ($_POST["elegido"] >= '05' and $_POST["elegido"] <= '09') $rest = 'B';
		if ($_POST["elegido"] >= '10' and $_POST["elegido"] <= '33') $rest = 'C';
		if ($_POST["elegido"] == '35') $rest = 'D';
		if ($_POST["elegido"] >= '36' and $_POST["elegido"] <= '39') $rest = 'E';
		if ($_POST["elegido"] >= '41' and $_POST["elegido"] <= '43') $rest = 'F';
		if ($_POST["elegido"] >= '45' and $_POST["elegido"] <= '47') $rest = 'G';
		if ($_POST["elegido"] >= '49' and $_POST["elegido"] <= '53') $rest = 'H';
		if ($_POST["elegido"] >= '55') $rest = 'I';
		if ($_POST["elegido"] >= '56' and $_POST["elegido"] <= '63') $rest = 'J';
		if ($_POST["elegido"] >= '64' and $_POST["elegido"] <= '66') $rest = 'K';
		if ($_POST["elegido"] >= '68') $rest = 'L';
		if ($_POST["elegido"] >= '69' and $_POST["elegido"] <= '75') $rest = 'M';
		if ($_POST["elegido"] >= '77' and $_POST["elegido"] <= '82') $rest = 'N';
		if ($_POST["elegido"] >= '84') $rest = 'O';
		if ($_POST["elegido"] >= '85') $rest = 'P';
		if ($_POST["elegido"] >= '86' and $_POST["elegido"] <= '88') $rest = 'Q';
		if ($_POST["elegido"] >= '90' and $_POST["elegido"] <= '93') $rest = 'R';
		if ($_POST["elegido"] >= '94' and $_POST["elegido"] <= '96') $rest = 'S';
		if ($_POST["elegido"] >= '97' and $_POST["elegido"] <= '98') $rest = 'T';
		if ($_POST["elegido"] >= '99') $rest = 'U';
	}

	$sSQL = "SELECT id, cod, nombre, cod_padre  FROM public.actividad_eco where status='A' and cod ='" . $rest . "' ORDER BY nombre";
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$selec = "";
		if ($rs->fields['1'] == $_POST["seleccionado"]) {
			$selec = "selected='selected'";
		}
		$options .= "<option " . $selec . " value=" . $rs->fields['1'] . ">" . substr($rs->fields['2'], 0, 80) . "</option>";
		$rs->MoveNext();
	}
	echo $options;
}

//---------------------Ocupacion-----------------------------------------------------------------------------------------------------
if ($_POST["combo"] == 'Ocupacion') {
	//devuelve el cod padre partiendo del cod hijo
	$numero_caracter = strlen($_POST["elegido"]);
	if ($numero_caracter >= 5) $rest = substr($_POST["elegido"], 0, 4); // devuelve los 4 primeros caracteres	
	if ($numero_caracter == 4)  $rest = substr($_POST["elegido"], 0, 3); // devuelve los 3 primeros caracteres	
	if ($numero_caracter == 3)  $rest = substr($_POST["elegido"], 0, 2); // devuelve los 2 primeros caracteres	
	if ($numero_caracter == 2)  $rest = substr($_POST["elegido"], 0, 1); // devuelve los 1 primeros caracteres	

	$sSQL = "SELECT id, cod, nombre, cod_padre  FROM public.ocupacion where status='A' and cod ='" . $rest . "' ORDER BY nombre";
	echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$selec = "";
		if ($rs->fields['1'] == $_POST["seleccionado"]) {
			$selec = "selected='selected'";
		}
		$options .= "<option " . $selec . " value=" . $rs->fields['1'] . ">" . substr($rs->fields['2'], 0, 80) . "</option>";
		$rs->MoveNext();
	}
	echo $options;
}

//---------------Combo Curso--------------------------------------------------------------------
if ($_POST["combo"] == 'Curso') {
	$sSQL = "SELECT id, nombre, status FROM public.curso where status='A' and categoria_curso_id = '" . $_POST["elegido"] . "' order by nombre;";
	//echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$options .= "<option value=" . $rs->fields['0'] . ">" . $rs->fields['1'] . "</option>";
		$rs->MoveNext();
	}
	echo $options;


	/*
	 $sSQL="SELECT id, nombre, status  FROM public.estado where status ='A' ".$param." ORDER BY nombre";	
	//echo $sSQL;
	$rs = &$conn->Execute($sSQL); 
	 $options.= "<option value=''>Seleccione</option>"; 
	while (!$rs->EOF ){
	$selec="";
		if ($rs->fields['0']==$_POST["seleccionado"]) {
			$selec= "selected='selected'";   
		}
	 $options.= "<option ".$selec." value=".$rs->fields['0'].">".ucfirst($rs->fields['1'])."</option>";    
	 $rs->MoveNext();
	}					
	 echo $options;
	 
	 */
}

//---------------Combo Curso_1--------------------------------------------------------------------
if ($_POST["combo"] == 'Curso_1') {
	$sSQL = "SELECT id, nombre, status FROM public.categoria_curso where status='A' ORDER BY nombre";
	//echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$selec = "";
		if ($rs->fields['0'] == $_POST["seleccionado"]) {
			$selec = "selected='selected'";
		}
		$options .= "<option " . $selec . " value='" . $rs->fields['0'] . "'>" . $rs->fields['1'] . "</option>";
		$rs->MoveNext();
	}
	echo $options;
}

//---------------Combo Personalidad juridica--------------------------------------------------------------------
if ($_POST["combo"] == 'Per_juridica') {
	$sSQL = "SELECT id, nombre, status  FROM public.p_juridica where sector_empleo_id = '" . $_POST["elegido"] . "' and status='A' ORDER BY id";
	//echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$selec = "";
		if ($rs->fields['0'] == $_POST["seleccionado"]) {
			$selec = "selected='selected'";
		}
		$options .= "<option " . $selec . " value=" . $rs->fields['0'] . ">" . $rs->fields['1'] . "</option>";
		$rs->MoveNext();
	}
	echo $options;
}

//---------------Combomotivo retiro ppie--------------------------------------------------------------------
if ($_POST["combo"] == 'Motivo_retiro') {
	$sSQL = "SELECT id, nombre, status  FROM public.motivo_retiro where status='A' and sector_empleo_id='" . $_POST["elegido"] . "' ORDER BY id";
	//echo $sSQL;
	$rs = &$conn->Execute($sSQL);
	$options .= "<option value=''>Seleccione</option>";
	while (!$rs->EOF) {
		$selec = "";
		if ($rs->fields['0'] == $_POST["seleccionado"]) {
			$selec = "selected='selected'";
		}
		$options .= "<option " . $selec . " value=" . $rs->fields['0'] . ">" . substr($rs->fields['1'], 0, 80) . "</option>";
		$rs->MoveNext();
	}
	echo $options;
}
