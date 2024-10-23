<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
$lenguage = 'es_VE.UTF-8'; //permite mostrar la fecha en letras
putenv("LANG=$lenguage");
setlocale(LC_ALL, $lenguage, "esp");
require_once('../tcpdf/config/lang/spa.php');
require_once('../tcpdf/tcpdf.php');
ini_set("max_execution_time","28800");
session_start();

        $cedula=$_SESSION['ced_afiliado'];	
        $fechahoy=strftime("%e de %B de %Y");

        $aTabla=$_SESSION['aTabla'];
	    for( $c=0; $c<count($aTabla); $c++){
				    $oficio=$aTabla[$c]['oficio'];
			      $nombres=$aTabla[$c]['nombres'];
						$apellidos=$aTabla[$c]['apellidos'];
		}
$formato_pdpie='';
$formato_pdpie='
			<tr>
			<td align="right"><b>Nro. de Oficio: '.$oficio.'</b></td>
			</tr>
			
			<tr>
			<td><b>Viceministerio de Previsi&oacute;n Social </b></td>
			</tr>
			
			<tr>
			<td><b>Divisi&oacute;n de Previsi&oacute;n Social </b></td>
			</tr>
			
			<tr>
			<td><b>Servicio de P&eacute;rdida Involuntaria de Empleo  </b></td>
			</tr>
			
			<tr align="center">
			<td align="left"></td>
			</tr>
			
			<tr align="center">
			<td align="right"><b>  '.$fechahoy.'</b></td>
			</tr>
			
			<tr>
			<td align="center" ><b>CONSTANCIA</b></td>
			</tr>
			<tr>
			<td></td>
			</tr>
			<tr>
			<td></td>
			</tr>
			<tr>
			<td></td>
			</tr>
			
			<tr>
      <td align="justify"><p>Yo, <b>'.htmlspecialchars($nombres, ENT_QUOTES).' '.htmlspecialchars($apellidos, ENT_QUOTES).'</b>, c&eacute;dula <b>'.$cedula.'</b> por medio de la presente hago contar que he recibido informaci&oacute;n y orientaci&oacute;n a trav&eacute;s del Servicio de P&eacute;rdida Involuntaria de Empleo y he decidido de manera voluntaria iniciar los tr&aacute;mites administrativos para el cobro de la prestaci&oacute;n dineraria por p&eacute;rdida involuntaria del empleo, ante las oficinas administrativas del IVSS, no aceptando las acciones para el reenganche por inamovilidad o estabilidad laboral, de acuerdo a lo establecido en la Ley Org&aacute;nica del Trabajo Los Trabajadores y Trabajadoras.</p></td>
    </tr>
			
			<tr>
			<td></td>
			</tr>
			<tr>
			<td></td>
			</tr>
			<tr>
			<td></td>
			</tr>			
			<tr>
			<td></td>
			</tr>
			<tr>
			<td></td>
			</tr>
			<tr>
			<td></td>
			</tr>
			<tr>
			<td></td>
			</tr>
			
			<tr>
      <td>Firma  del Usuario/a: _______________________</td>
    </tr>
     <tr>
      <td>C&eacute;dula: ________________________________</td>
    </tr>
    <tr>
      <td>Fecha: _________________________________</td>
    </tr>
    <tr>
      <td></td>
    </tr>
		<tr>
			<td></td>
			</tr>
		<tr>
			<td></td>
			</tr>    
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
			<tr>
			<td colspan="2" align="center" style="color:#6E6E6E;"><font size="8">NOTA: Todos los servicios ofrecidos por las Divisiones de Previsi&oacute;n Social son absolutamente gratuitos.</font></td>
			</tr>	
	';

 // create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('MINPPTRASS');
$pdf->SetTitle('REFERENCIA PPIE');
$pdf->SetSubject('REFERENCIA PPIE');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);
  
  // ---------------------------------------------------------
  
  // set font
  $pdf->SetFont('helvetica', '', 8);
  
  // add a page
  $pdf->AddPage();
    
  // -----------------------------------------------------------------------------
  
  // NON-BREAKING TABLE (nobr="true")  
$tbl = <<<EOD
<table width="100%" border="0" cellpadding="2" cellspacing="2">
$formato_pdpie
</table>	
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------


//Close and output PDF document
$pdf->Output('Referencia de PPIE', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
