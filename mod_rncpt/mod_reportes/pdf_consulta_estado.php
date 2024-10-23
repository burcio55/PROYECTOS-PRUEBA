<?php

error_reporting(E_ALL | E_STRICT);
ini_set("memory_limit","128M");
ini_set ("max_execution_time","9500000000");
$lenguage = 'es_ES.UTF-8';
putenv("LANG=$lenguage");
setlocale(LC_ALL, $lenguage);
require_once('../../tcpdf/config/lang/spa.php');
require_once('../../tcpdf/tcpdf.php');

session_start();
ini_set("display_errors",0); 

// se modifico linea 12757 en tcpdf.php para eliminar subrayado bajo el logo y en footer: se añadio	$color=array(255, 255, 255);
// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('MPPPST');
$pdf->SetTitle('CONSEJOS PRODUCTIVOS DE TRABAJADORES Y TRABAJADORAS');
$pdf->SetSubject('RNCPTT');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, 170,"");
//set margins

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(22, 23, 22);
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
$cadena= $_SESSION['aDefaults']['cadena_pdf'];
$tbl='';
$tbl.='<table width="100%" cellPadding="1" cellSpacing="1">
		<tr color="#1060C8">
			<th align="center"><h2>REPORTE DE LOS CONSEJOS PRODUCTIVOS DE TRABAJADORAS Y TRABAJADORES ACTIVOS</h2></th>
		</tr>

		
</table>';
$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTML($tbl, true, false, false, false, '');


$tbl2='';
$tbl2.='
<table width="100%" border="0" cellPadding="5" cellSpacing="1">

		<td 
			 align="right" color="#1060C8"><b>Fecha de Impresi&oacute;n: '.$fecha.'</b></td>
		</tr>
</table>
';
$tbl3='';
$tbl3.='

';

//echo $formato; 
//$pdf->writeHTML($tbl, true, false, false, false, '');

// NON-BREAKING TABLE (nobr="true")  
$pdf->SetFont('helvetica', '', 6);
$pdf->writeHTML($cadena, true, false, false, false, '');
$pdf->writeHTML($tbl2, true, false, false, false, '');
$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTML($tbl3, true, false, false, false, '');




 //$pdf->setPrintFooter(true);
$pdf->Output('Estado_rncptt'.$_SESSION['id_usuario'].'_'.date('d/m/y').'.pdf', 'I');

