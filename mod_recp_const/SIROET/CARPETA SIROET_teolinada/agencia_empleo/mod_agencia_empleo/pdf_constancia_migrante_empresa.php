<?php
$lenguage = 'es_VE.UTF-8'; //permite mostrar la fecha en letras
putenv("LANG=$lenguage");
setlocale(LC_ALL, $lenguage, "esp");
require_once('../tcpdf/config/lang/spa.php');
require_once('../tcpdf/tcpdf.php');
ini_set("max_execution_time","28800");
session_start();
        $empresa=$_SESSION['nombre_empresa'];
		$rif=$_SESSION['rif'];	
        $fechahoy=strftime("%e de %B de %Y");
		$id_empresa= $_SESSION['id_empresa'];
		list($tr,$ex)=explode("*", $_SESSION['n_trabajadores_t']);			
			$n_trabajadores= $tr;
			$n_extranjeros= $ex;
		list($es,$mu,$pa)=explode("*", $_SESSION['localidad']);			
			$estado= $es;
			$municipio= $mu;
			$parroquia= $pa;
		
		$aTabla=$_SESSION['aTabla'];
	    for( $i=0; $i<count($aTabla); $i++){
		$nombre=$aTabla[$i]['nombre'];
		$apellido=$aTabla[$i]['apellido'];
		$sdenominacion=$aTabla[$i]['sdenominacion'];
		$cod_nombre=$aTabla[$i]['cod_nombre'];
		$ciudad=$aTabla[$i]['ciudad'];
		$direccion=$aTabla[$i]['direccion'];
		$telefonos=$aTabla[$i]['telefonos'];
		$correo=$aTabla[$i]['correo'];
		}
				
$formato_pdpie='';
$formato_pdpie='
	<tr>
	  <td colspan="4" align="right"><font size="6">FORMA: SILVE-004</font></td>
    </tr>
	<tr>
	  <td colspan="2" ><b>DIRECCI&Oacute;N GENERAL DE EMPLEO </b></td>
      <td colspan="2"></td>
    </tr>
	<tr>
	  <td colspan="4" align="right"><b>Nro. de Oficio: '.$cod_nombre.' '.$id_empresa.'</b></td>
    </tr>
    <tr align="center">
	  <td colspan="4" align="left"><b>'.$sdenominacion.'</b></td>
    </tr>
	<tr align="center">
      <td colspan="4" align="right"><b> '.$ciudad.', '.$fechahoy.'</b></td>
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
      <td colspan="4" align="center" ><b>CONSTANCIA DE REGISTRO DE USUARIO(A) </b></td>
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
      <td colspan="4" align="justify">Por medio de la presente se hace constar que la empresa <b>'.$empresa.'</b>, identificada con el RIF Nro. <b>'.$rif.'</b>; ubicada en el Estado <b>'.$estado.'</b>,  Municipio <b>'.$municipio.'</b>, Parroquia <b>'.$parroquia.'</b>;  y registrado(a) en el Servicio P&uacute;blico de Empleo con el c&oacute;digo Nro. <b>'.$id_empresa.'</b>, acudi&oacute; en esta fecha a fin de hacer uso del servicio de intermediaci&oacute;n laboral para el tr&aacute;mite de Permiso Laboral ante la Direcci&oacute;n de Migraciones Laborales de este Ministerio. Actualizando su data de registro y dejando constancia que para el momento mantiene en n&oacute;mina un total <b>'.$n_trabajadores.'</b> de trabajadores y trabajadoras, de los (las) cuales <b>'.$n_extranjeros.'</b> es(son) de nacionalidad extranjera.
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
      <td colspan="4" align="center">_______________________________________________</td>
    </tr>
	<tr>
      <td colspan="4" align="center"><b>'.$nombre.' '.$apellido.'</b></td>
    </tr>
	<tr>
      <td colspan="4" align="center">Jefe de Agencia </td>
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
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4"></td>
    </tr>
	<tr>
      <td colspan="4" align="center" style="color:#6E6E6E;"><font size="6">Nota: Constancia solo de uso interno que no certifica la condici&oacute;n de desocupado(a) de la persona registrada en la base de datos del Servicio P&uacute;blico de Empleo.
Todos los servicios ofrecidos son absolutamente gratuitos, tanto para los trabajadores y trabajadoras, como para las empresas.</font></td>
    </tr>	
	<tr>
      <td colspan="4" align="center" style="color:#6E6E6E;"><font size="6">'.$sdenominacion.' '.$direccion.'</font> 
    </td>
    </tr>
	<tr>
      <td colspan="4" align="center" style="color:#6E6E6E;"><font size="6">Tel&eacute;fonos: '.$telefonos.' e-mail: '.$correo.'</font> 
    </td>
    </tr>
	';

 // create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('MINPPTRASS');
$pdf->SetTitle('Constancia Empresa');
$pdf->SetSubject('Constancia Empresa');
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
$pdf->Output('Constancia Empresa', 'I'); 

//============================================================+
// END OF FILE                                                
//============================================================+
