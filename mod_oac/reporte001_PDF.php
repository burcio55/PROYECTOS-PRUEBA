<?php
error_reporting(E_ALL | E_STRICT);
ini_set("memory_limit","128M");
ini_set ("max_execution_time","9500000000");
$lenguage = 'es_ES.UTF-8';
putenv("LANG=$lenguage");
require_once('../tcpdf/config/lang/spa.php');
require_once('../tcpdf/tcpdf.php');
session_start();
ini_set("display_errors",0); 

require_once('../tcpdf/config/lang/spa.php');
require_once('../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('MPPPST');
$pdf->SetTitle('SOLICITUDES REGISTRADAS OAC');
$pdf->SetSubject('SOLICITUDES REGISTRADAS OAC');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, 170,"");

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(24, 23, 22);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(false);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

//add a page
$pdf->AddPage();
$fecha = date('d/m/Y');
$tbl='';
$tbl.='<table width="100%" cellPadding="1" cellSpacing="1">
		<tr color="#1060C8">
			<th align="center"><h2>REPORTE DE CASOS REGISTRADOS EN LA OFICINA DE ATENCI&Oacute;N AL CIUDADANO</h2></th>
		</tr>
		<tr color="#1060C8">
			<th align="center"><h2>ORDENADA POR FECHA DE RECEPCIÓN DEL CASO</h2></th>
		</tr>
</table>';
$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTML($tbl, true, false, false, false, '');

//var_dump($_SESSION['aTabla']);
$aTabla1 = $_SESSION['aTabla'];
$condicion = $_SESSION['condicion'];
$suma = 0;
$Valores = ''; // Inicializar la variable $Valores

for ($i = 0; $i < count($aTabla1); $i++) {	
	$numero = $aTabla1[$i]['caso'];
	$cedula = $aTabla1[$i]['cedula'];
	$fecha = $aTabla1[$i]['dfecha_recepcion'];
	$asistencia = $aTabla1[$i]['tipo_asistencia'];
	$via_recepcion = $aTabla1[$i]['sdecripcion_via_recepcion'];
	$detalle = $aTabla1[$i]['detalle_gestion'];					
	$estatus = $aTabla1[$i]['sdescripcion_status'];
	$observaciones = $aTabla1[$i]['sobservaciones'];
	$beneficiario = $aTabla1[$i]['beneficiario'];		

	if (($i % 2) == 0) {
		$class_name1 = 'bgcolor="#F7F7F7"';
	} else { 
		$class_name1 = 'bgcolor="#E2E2E2"';
	}

	$Valores .= ' 	
	<tr ' . $class_name1 . '>
		<td align="center">' . $numero . '</td>
		<td align="center">' . $fecha . '</td>	
		<td align="center">' . $cedula . '</td>
		<td align="center">' . $beneficiario . '</td>
		<td align="center">' . $asistencia . '</td>
		<td align="center">' . $via_recepcion . '</td>
		<td align="center">' . $detalle . '</td>
		<td align="center">' . $estatus . '</td>
		<td align="center">' . $observaciones . '</td>		
	</tr>';
}
$suma = $i;

// Table with rowspans and THEAD
$tbl = <<<EOD
<table width="100%" border="0" cellPadding="5" cellSpacing="1">
	<thead>
		<tr bgcolor="#999999" color="#FFFFFF">
			<td colspan="9" align="left"><b>CASOS SOLICITADOS EN LA OFICINA DE ATENCI&Oacute;N AL CIUDADANO  $condicion</b></td>
		</tr>  
		<tr bgcolor="#D0E0F4" color="#1060C8">
			<th><div align="center"><b>Nro. Caso</b></div></th>
			<th><div align="center"><b>Fecha de Recepci&oacute;n</b></div></th>
			<th><div align="center"><b>Cédula de Identidad del Beneficiario</b></div></th>
			<th><div align="center"><b>Clase de Beneficiario</b></div></th>
			<th><div align="center"><b>V&iacute;a de Recepci&oacute;n</b></div></th>
			<th><div align="center"><b>Tipo</b></div></th> 
			<th><div align="center"><b>Gestión</b></div></th>
			<th><div align="center"><b>Estatus</b></div></th>
			<th><div align="center"><b>Detalles de la Entrega</b></div></th>
		</tr>
	</thead>
	$Valores
</table>
<table align="center" border="0" align="right" cellPadding="5" cellSpacing="1">
	<tr color="#1060C8">
		<th colspan="6"><div align="right">Total General de Casos Registrados:</div></th>
		<th colspan="3"><div align="left"><strong><font color="#666666">$suma</font></strong></div></th>
	</tr>
</table>
EOD;

$tbl2 = '
<table width="100%" border="0" cellPadding="5" cellSpacing="1">
	<tr>
		<td align="right" color="#1060C8"><b>Fecha de Impresi&oacute;n: ' . $fecha . '</b></td>
	</tr>
</table>
';

$tbl3 = '
<table width="100%" border="0" align="center" cellPadding="5" cellSpacing="1">
	<tr>
		<td align="center" color="#1060C8"><b>Dirección General del Despacho / Oficina de Atención al Ciudadano</b></td>
	</tr>
</table>
';

$pdf->SetFont('helvetica', '', 6);
$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->writeHTML($tbl2, true, false, false, false, '');
$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTML($tbl3, true, false, false, false, '');

// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('Consulta_casos' . $_SESSION['id_usuario'] . '_' . date('d/m/y') . '.pdf', 'D');

//============================================================+
// END OF FILE                                                
//============================================================+