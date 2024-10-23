<?php
//***version 1.2 fecha:07-04-2020

ini_set("display_errors", 1);
error_reporting(E_ALL | E_STRICT);
//ini_set("memory_limit","128M");
ini_set("max_execution_time", "9500000000");
include("../../include/header.php");

require_once('../../tcpdf/config/lang/spa.php');
require_once('../../tcpdf/tcpdf.php');
require_once("../../js/phpqrcode/phpqrcode.php");
session_start();

$conn = getConnDB($db1);
$conn->debug = false;

unset($_SESSION['aDefaults']);
unset($_SESSION['aDefaults1']);
//var_dump($_SESSION['qr']);

// ---------------------------------------------------------

// add a page
$boleta = $_GET['boleta'];

$sql_emp = "Select srif, 
				srazon_social,
				sdenominacion_comercial,
				sucursales,
				id
			from rncpt.empresa where empresa.nro_boleta = '" . $boleta . "' ";
$rs1 = $conn->Execute($sql_emp);
if ($rs1->Recordcount() > 0) {

	$_SESSION['aDefaults1']['razon_empresa'] = $rs1->fields['srazon_social'];
	$_SESSION['aDefaults1']['sdenominacion_comercial'] = $rs1->fields['sdenominacion_comercial'];
	$_SESSION['aDefaults1']['srif'] = $rs1->fields['srif'];
	$_SESSION['aDefaults1']['sucursales'] = $rs1->fields['sucursales'];
	$empresa_id = $rs1->fields['id'];

	$SQL = "SELECT miembros_empresa.id, 
					miembros_empresa.nenabled,
					miembros.ncedula,
					miembros.sprimer_nombre,
					miembros.ssegundo_nombre,
					miembros.sprimer_apellido,
					miembros.ssegundo_apellido,
					miembros.stelefono1,
					miembros.stelefono2,
					miembros.nsexo,
					miembros.semail,
					miembros.fecha_nacimiento,
					condicion_act.sdescripcion as condicion_act,
					cargos.descripcion_cargo	as cargos					
				FROM rncpt.miembros_empresa
				INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
				inner join rncpt.cargos on miembros_empresa.cargos_id=cargos.id
				inner join rncpt.condicion_act on miembros_empresa.condicion_act_id=condicion_act.id
				WHERE miembros_empresa.empresa_id = '" . $empresa_id . "' 
				AND miembros_empresa.nenabled = '1';";
	$rs = $conn->Execute($SQL);
	if ($rs->RecordCount() > 0) {
		while (!$rs->EOF) {
			$aTabla[] = array();
			$c = count($aTabla) - 1;
			$apellidonombre = ucwords(strtolower($rs->fields['sprimer_apellido'] . " " . $rs->fields['ssegundo_apellido'] . " " . $rs->fields['sprimer_nombre'] . " " . $rs->fields['ssegundo_nombre']));
			$apellidonombre_ = ucwords(strtolower($rs->fields['sprimer_apellido'] . " " . $rs->fields['sprimer_nombre']));
			$aTabla[$c]['sdescripcion'] = $rs->fields['condicion_act'];
			$aTabla[$c]['ncedula'] = $rs->fields['ncedula'];
			$aTabla[$c]['apellidonombre'] = $apellidonombre;
			$aTabla[$c]['apellidonombre_'] = $apellidonombre_;
			$aTabla[$c]['stelefono1'] = $rs->fields['stelefono1'];
			$aTabla[$c]['stelefono2'] = $rs->fields['stelefono2'];
			$aTabla[$c]['semail'] = $rs->fields['semail'];
			$sexo = $rs->fields['nsexo'];

			$aTabla[$c]['sexo'] = $sexo == '1' ? 'M' : 'F';

			$aTabla[$c]['condicion_act'] = $rs->fields['condicion_act'];

			$aTabla[$c]['id'] = $rs->fields['id'];

			$aTabla[$c]['fecha_nacimiento'] = $rs->fields['fecha_nacimiento'];

			$aTabla[$c]['cargos'] = $rs->fields['cargos'];

			$rs->MoveNext();
		}

		$_SESSION['aDefaults'] = $aTabla;
	} else {
		?><script>
			alert("EL NRO. DE BOLETA NO EXISTE");
		</script><?
	}
} else {
	?><script>
		alert("EL NRO. DE BOLETA NO EXISTE");
	</script><?
}

if (!isset($_SESSION['aDefaults']) or !isset($_SESSION['aDefaults1'])) {
	?><script>
		parent.document.location = '../../mod_login/login.php';
	</script><?
} else {
	$index = 0;
	$i = 0;

	$empresa = htmlentities($_SESSION['aDefaults1']['razon_empresa'], ENT_QUOTES);
	$srif = $_SESSION['aDefaults1']['srif'];
	$sucursal = htmlentities($_SESSION['aDefaults1']['sucursales'], ENT_QUOTES);
	$cedula = '';
	$nombre_completo = '';
	for ($i = 0; $i < count($_SESSION['aDefaults']); $i++) {
		$cedula .= "V-" . number_format($_SESSION['aDefaults'][$i]['ncedula'], 0, '', '.') . ", ";
		$nombre_completo .= strtoupper($_SESSION['aDefaults'][$i]['apellidonombre_'] . ", ");
	}

	echo "Creó variables";

	echo "Voy a crear la tabla";

	$tbl = <<<EOD
	<table width="100%" border="0" cellpadding="2" cellspacing="2" style=" font-size:10pt; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif">
		<tr>
		<th3><div align="center"><b>BOLETA DE REGISTRO N° $boleta </b></div></th3>
		</tr>
		<tr>
		<td>
		
		<div align="justify">Quien suscribe,<b>JOSÈ RAMÒN RIVERO GONZÀLEZ</b>, Ministro del Poder Popular para el Proceso Social de Trabajo, conforme a las atribuciones consagradas en la ley Orgànica del Trabajo, las trabajadoras y los trabajadores (LOTTT) y lo establecido en el articulo 6 de la ley constitucional de los consejos productivos de Trabajadores y siendo que esta nueva forma de organizaciòn de la clase obrera, ha sido concebida como instrumento para el impulso de la Participaciòn Protagònica de las Trabajadoras y los Trabajadores en el impulso de la actividad productiva nacional desde las entidades de trabajo; previa constataciòn de que se ha cumplido los requisitos legales que deben concurrir al efecto, <b>DECLARO</b> legalmente constituido a los ciudadanos:<b> $nombre_completo</b> titulares de la cedula de identidad Nº <b> $cedula </b>respectivamente, como voceros y voceras del consejo Productivo de Trabajadores de la entidad de trabajo <b>$empresa ($sucursal)</b>, por un periodo de dos años, contados a partir de la fecha de su elecciòn. En consiguiente los mismo. no podràn ser despedidos, trasladados o desmejorados de sus puesto de trabajo, sin justa causa previamente calificada por el Inspector o Inspectora del Trabajo y en nombre del Ministerio del Poder Popular para el Proceso Social de Trabajo, como Òrgano Rector <b> ORDENO </b>el Registro correspondiente, conforme a los dispuesto en la norma ut supra señalada </div></td>    
		</tr>
		<tr><td height="60"> </td>
	</table>
EOD;

	echo "Creó la tabla";

	echo "Voy pa'la segunda tabla";

	$tbl2 = <<<EOD
	<table width="100%" border="0" cellpadding="2" cellspacing="2">
		<tr>
		<td  height="20">

		</td>
		</tr>
		<tr>
		<td  height="20">

		</td>
		</tr>
		<tr>
		<td  height="20">

		</td>
		</tr>
		<tr>
		<td  height="20">

		</td>
		</tr>
		<tr>
		<td align="center"  style=" font-size:10pt; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif" >
			<b> JOSE RAMÒN RIVERO GONZALEZ</b>  
		</td>    
		</tr>

		<tr  align="center">
		<td  style=" font-size:9pt; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif" >Ministro del Poder Popular para el Proceso Social de Trabajo</td>
		</tr>
		<tr  align="center">
		<td  style=" font-size:9pt; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif">Decreto Presidencial N° 4.607 de fecha 04 de Mayo de 2021</td>
		</tr>
		<tr  align="center">
		<td  style=" font-size:9pt; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif">Decreto Oficial N° 42.119 de fecha 04 de Mayo de 2021</td>
		</tr>
	</table>
EOD;

	echo "Creo el QR"
	//MOSTRAR EL CODIGO QR

	?><script>
		<?= $url ?> = document.URL;
	</script><?
	//$url='https://10.46.1.91/minpptrassi/mod_rncpt/mod_registro/boleta_QR.php?boleta='.$boleta;

	QRcode::png($url, "ImagenQR");

	echo "3era. Tabla";

	$tbl3 = <<<EOD
	<div class="qr">	
		<tr  align="center">
			<td align="right" style="font-size:6pt; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif">
				<tr>
					<td>
						<img src="ImagenQR">
					</td>
				</tr>
				<tr>
					<td>
						<label>www.mpppst.gob.ve</label>	
					</td>
				</tr>
				<tr>
					<td>
						<label>Registro Nacional de los <br> Consejos Productivos de <br>las Trabajadoras y Trabajadores</label>	
					</td>
				</tr>
			</td>
		</tr>
	</div>
EOD;

	echo "Ahora creo el pdf";

	echo $tbl . $tbl2 . $tbl3;
	grabaPDF($tbl . $tbl2 . $tbl3);

	//============================================================+
	// END OF FILE                                                
	//============================================================+ </p>
}

function grabaPDF($texto) {
	ob_start();		// Buffer de Salida

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

	// set header and footer fonts
	$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	//set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	// remove default header/footer
	//$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	//set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	//set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	//set some language-dependent strings
	/*
	date_default_timezone_set('America/Caracas');
	$lenguage = 'es_VE.UTF-8';
	putenv("LANG=$lenguage");
	setlocale(LC_ALL, $lenguage, "esp");

	$pdf->setLanguageArray($l);
	*/

	//$pdf->SetFont('helvetica', '', 12);  

	$pdf->AddPage();

	$pdf->writeHTML("Cualquier cosa", true, false, false, false, '');

	//fondo marca de agua
	$pdf->Image('../imagenes/fondo1.png', '10', '25', '230', '300', 'PNG', 'M', false, '', false, '', '', false, 0);
	$pdf->setAlpha(0.3);
	error_reporting(E_ALL);

	$pdf->Output('boleta.pdf', 'I');
	// $pdf->lastPage();

	ob_end_clean();		// Limpia el buffer de salida
}
