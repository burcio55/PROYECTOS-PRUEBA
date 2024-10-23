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
						$cedula=$aTabla[$c]['cedula'];
			      $nombres=$aTabla[$c]['nombres'];
						$apellidos=$aTabla[$c]['apellidos'];
						$motivo_retiro=$aTabla[$c]['motivo_retiro'];
						$ocupacion=$aTabla[$c]['ocupacion'];
						//empresa
						$empresa=$aTabla[$c]['empresa'];
						$rif=$aTabla[$c]['rif'];	
		}
		
$formato_pdpie='';
$formato_pdpie='
		<tr>
	  <td colspan="4" align="right"><b>Nro. de Oficio: '.$oficio.'</b></td>
    </tr>
		<tr>
	  <td colspan="2" ><b>Viceministerio de Previsi&oacute;n Social </b></td>
      <td colspan="2"></td>
    </tr>
		<tr>
	  <td colspan="2" ><b>Divisi&oacute;n de Previsi&oacute;n Social </b></td>
      <td colspan="2"></td>
    </tr>
		<tr align="center">
	  <td colspan="4" align="left"></td>
    </tr>
	  <tr align="center">
      <td colspan="4" align="right"><b>  '.$fechahoy.'</b></td>
    </tr>
	<tr>
	  <td colspan="4"><b>Se&ntilde;ores</b></td>
    </tr>
	 <tr>
	 <tr>
	  <td colspan="4"><b>Instituto Venezolano de los Seguros Sociales (IVSS)</b></td>
    </tr>
	 <tr>
	 <tr>
	  <td colspan="4"><b>Direcci&oacute;n General de Prestaci&oacute;n por P&eacute;rdida Involuntaria del Empleo</b></td>
    </tr>
	<tr>
      <td colspan="4"><b>Presente.-</b></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4" align="center" ><b>CONSTANCIA DE INSCRIPCI&Oacute;N</b></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
			<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4" align="justify">
			<p>Mediante la presente se hace constar que al ciudadano(a) <b>'.$nombres.' '.$apellidos.'</b>, c&eacute;dula <b>'.$cedula.'</b>,  de ocupaci&oacute;n <b>'.$ocupacion.'</b> se le otorg&oacute; la Constancia de Inscripci&oacute;n en la Divisi&oacute;n de Previsi&oacute;n Social, aceptando cumplir con las obligaciones de este Servicio de Atenci&oacute;n Integral por Perdida Involuntaria de Empleo en concordancia con los Art&iacute;culos 32 y 36 de la Ley del R&eacute;gimen Prestacional de Empleo.</p>
          <p>Una vez verificado que existe la cesaci&oacute;n de la relaci&oacute;n de trabajo, con la entidad de trabajo: <b>'.$empresa.'</b>, Nro. de Rif: <b>'.$rif.'</b>, por la causal: <b>'.$motivo_retiro.'</b>; el/la ciudadano/a queda registrado/a como usuario/a cesante, demandante de los servicios de asesor&iacute;a, informaci&oacute;n, orientaci&oacute;n laboral, formaci&oacute;n e inclusi&oacute;n sociolaborla y socioproductiva.</p>
          <p>Constancia que se expide a los efectos de dar cumplimiento a los derechos sociales contemplados en la normativa legal referida a la Seguridad Social.</p>
      </td>
    </tr>
		<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4" align="center">_______________________________________________</td>
    </tr>

	<tr>
      <td colspan="4" align="center"><i>Coordinador/a de Previsi&oacute;n Social</i></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
		<tr>
      <td colspan="4"></td>
    </tr>
			<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4" align="center" style="color:#6E6E6E;"><font size="8">NOTA: Todos los servicios ofrecidos por las Divisiones de Previsi&oacute;n Social son absolutamente gratuitos.</font></td>
    </tr>	
	';

 // create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('MINPPTRASS');
$pdf->SetTitle('Certificado PPIE');
$pdf->SetSubject('Certificado PPIE');
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
$pdf->Output('Certificado de PPIE', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
