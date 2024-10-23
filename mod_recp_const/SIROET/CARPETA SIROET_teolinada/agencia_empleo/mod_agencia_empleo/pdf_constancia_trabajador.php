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
	  <td colspan="4" align="right">FORMA: SIPRESOC 004</td>
    </tr>
	<tr>
	  <td colspan="2" ><b>MINISTERIO DEL PODER POPULAR</b></td>
      <td colspan="2"></td>
    </tr>
	<tr>
	  <td colspan="2" ><b>PARA EL PROCESO SOCIAL DE TRABAJO</b></td>
      <td colspan="2"></td>
    </tr>
	<tr>
	  <td colspan="4" align="right"><b>Nro. de Oficio: '.$oficio.'</b></td>
    </tr>
	<tr align="center">
      <td colspan="4" align="right"><b> '.$fechahoy.'</b></td>
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
      <td colspan="4" align="center" ><font size="11"><b>CONSTANCIA DE REGISTRO </b></font></td>
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
      <td colspan="4" align="justify">Por medio de la presente se hace constar que el (la) ciudadano (a) <b>'.htmlspecialchars($nombres, ENT_QUOTES).' '.htmlspecialchars($apellidos, ENT_QUOTES).'</b>, c&eacute;dula <b>'.$cedula.'</b> ha sido registrado (a) en el Sistema de Informaci&oacute;n y  Registro  de Previsi&oacute;n Social con el c&oacute;digo Nro. <b>Nro. '.$oficio.'</b> como  usuario (a)  demandante de los servicios  de informaci&oacute;n y  orientaci&oacute;n   en materia de previsi&oacute;n social.
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
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4" align="center">Atentamente,</td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4" align="center">_______________________________________________</td>
    </tr>
	<tr>
      <td colspan="4" align="center"><i>Coordinador/a de Previsi&oacute;n Social</i></td>
    </tr>
	
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
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4" align="center" style="color:#1060C8;"><p>Nota: Constancia solo de uso interno que  no certifica la condici&oacute;n de desocupado (a) de la persona registrada en la base  de datos Sistema de Informaci&oacute;n y Registro   de Previsi&oacute;n Social.</p><p>Todos los servicios ofrecidos son gratuitos, tanto para los  trabajadores y trabajadoras, como para las Entidades de Trabajo.</p></td>
    </tr>	
	';

 // create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('MINPPTRASS');
$pdf->SetTitle('Constancia Trabajador');
$pdf->SetSubject('Constancia Trabajador');
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
$pdf->Output('Constancia Trabajador', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
