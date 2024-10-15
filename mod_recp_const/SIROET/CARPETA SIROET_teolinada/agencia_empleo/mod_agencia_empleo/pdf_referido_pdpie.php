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

        $usuario=$_SESSION['usuario'];	
        $fechahoy=strftime("%e de %B de %Y");

        $aTabla=$_SESSION['aTabla'];
	    for( $c=0; $c<count($aTabla); $c++){
				    $oficio=$aTabla[$c]['oficio'];
						$cedula=$aTabla[$c]['cedula'];
						$nombres=$aTabla[$c]['nombres'];
						$apellidos=$aTabla[$c]['apellidos'];
			      $nacionalidad=$aTabla[$c]['nacionalidad'];
						$f_nacimiento=$aTabla[$c]['f_nacimiento'];
						$estado=$aTabla[$c]['estado'];					
						$cargo=$aTabla[$c]['cargo'];
						$salario=$aTabla[$c]['salario'];
						$direccion=$aTabla[$c]['direccion'];
						$telefono=$aTabla[$c]['telefono'];
						$correo=$aTabla[$c]['correo'];	
						$motivo=$aTabla[$c]['motivo'];
						$ocupacion=$aTabla[$c]['ocupacion'];
						$nivel=$aTabla[$c]['nivel'];
						
						//empresa
						$empresa=$aTabla[$c]['empresa'];
						$rif=$aTabla[$c]['rif'];	
						$snil=$aTabla[$c]['snil'];	
						$sector=$aTabla[$c]['sector'];
						$ntelefono_local=$aTabla[$c]['ntelefono_local'];	
						$sdireccion_fiscal=$aTabla[$c]['sdireccion_fiscal'];	
						$semail=$aTabla[$c]['semail'];
		}
		
$formato_pdpie='';
$formato_pdpie='
			<tr>
			<td colspan="2" align="right"><b>Nro. de Oficio: '.$oficio.'</b></td>
			</tr>
			
			<tr>
			<td colspan="2" ><b>Viceministerio de Previsi&oacute;n Social </b></td>
			</tr>
			
			<tr>
			<td colspan="2" ><b>Divisi&oacute;n de Previsi&oacute;n Social </b></td>
			</tr>
			
			<tr>
			<td colspan="2" ><b>Servicio de P&eacute;rdida Involuntaria de Empleo  </b></td>
			</tr>
			
			<tr align="center">
			<td colspan="2" align="left"></td>
			</tr>
			
			<tr align="center">
			<td colspan="2" align="right"><b>  '.$fechahoy.'</b></td>
			</tr>
			
			<tr>
			<td colspan="2" align="center" ><b>REFERENCIA</b></td>
			</tr>
			
			<tr>
			<td colspan="2"></td>
			</tr>
			
			<tr>
			<td colspan="2"></td>
			</tr>
			
			<tr>
			<td colspan="2">Para:</td>
			</tr>
			
			<tr>
			<td colspan="2" >De:</td>
			</tr>
						
			<tr>
			<td colspan="2"></td>
			</tr>
			
			<tr>
			<td colspan="2" ><div align="center" class="Estilo21"><b>DATOS DE IDENTIFICACI&Oacute;N DEL USUARIO</b></div></td>
			</tr>
			
			<tr>
			<td colspan="2"></td>
			</tr>
			
			<tr>
			<td>NOMBRES Y APELLIDOS: </td>
			<td>'.htmlspecialchars($nombres, ENT_QUOTES).' '.htmlspecialchars($apellidos, ENT_QUOTES).'</td>
			</tr>
			
			<tr>
			<td>C&Eacute;DULA: </td>
			<td>'.$cedula.'</td>
			</tr>
			
			<tr>
			<td>NACIONALIDAD: </td>
			<td>'.$nacionalidad.'</td>
			</tr>
			
			<tr>
			<td>LUGAR Y FECHA DE NACIMIENTO: </td>
			<td>'.htmlspecialchars($estado, ENT_QUOTES).' '.$f_nacimiento.'</td>
			</tr>
			
			<tr>
			<td>NIVEL EDUCATIVO: </td>
			<td>'.htmlspecialchars($nivel, ENT_QUOTES).'</td>
			</tr>
			
			<tr>
			<td>OCUPACI&Oacute;N: </td>
			<td>'.htmlspecialchars($ocupacion, ENT_QUOTES).'</td>
			</tr>
			
			<tr>
			<td>CARGO QUE DESEMPE&Ntilde;ABA: </td>
			<td>'.htmlspecialchars($cargo, ENT_QUOTES).'</td>
			</tr>
			
			<tr>
			<td>SALARIO MENSUAL: </td>
			<td>'.$salario.'</td>
			</tr>
			
			<tr>
			<td>DIRECCI&Oacute;N DE HABITACI&Oacute;N: </td>
			<td>'.htmlspecialchars($direccion, ENT_QUOTES).'</td>
			</tr>
			
			<tr>
			<td>TEL&Eacute;FONOS: </td>
			<td>'.$telefono.'</td>
			</tr>
			
			<tr>
			<td>CORREO: </td>
			<td>'.$correo.'</td>
			</tr>
			
			<tr>
			<td>MOTIVO DE REFERENCIA: </td>
			<td>'.htmlspecialchars($motivo, ENT_QUOTES).'</td>
			</tr>
			
			<tr>
			<td colspan="2"></td>
			</tr>
			
			<tr>
			<td colspan="2" align="center"><b>DATOS DE IDENTIFICACI&Oacute;N DE LA ENTIDAD DE TRABAJO</b></td>
			</tr>
			
			<tr>
			<td colspan="2"></td>
			</tr>
			
			<tr>
			<td>ENTIDAD DE TRABAJO: </td>
			<td>'.htmlspecialchars($empresa, ENT_QUOTES).'</td>
			</tr>
			
			<tr>
			<td>RIF: </td>
			<td>'.$rif.'</td>
			</tr>
			
			<tr>
			<td>NIL: </td>
			<td>'.$snil.'</td>
			</tr>
			
			<tr>
			<td>SECTOR EMPLEADOR: </td>
			<td>'.htmlspecialchars($sector, ENT_QUOTES).'</td>
			</tr>
			
			<tr>
			<td>DIRECCI&Oacute;N:</td>
			<td>'.htmlspecialchars($sdireccion_fiscal, ENT_QUOTES).'</td>
			</tr>
			
			<tr>
			<td>TEL&Eacute;FONOS: </td>
			<td>'.$ntelefono_local.'</td>
			</tr>
			
			<tr>
			<td>CORREO: </td>
			<td>'.$semail.'</td>
			</tr>
			
			<tr>
			<td colspan="2"></td>
			</tr>
			<tr>
			<td colspan="2"></td>
			</tr>		
			<tr>
			<td colspan="2"></td>
			</tr>
			<tr>
			<td colspan="2"></td>
			</tr>
			<tr>
			<td colspan="2"></td>
			</tr>
			<tr>
			<td colspan="2"></td>
			</tr>
			<tr>
			<td colspan="2" align="center">_______________________________________________</td>
			</tr>
			
			<tr>
			<td colspan="2" align="center"><i>Firma y Sello del Funcionario/a </i></td>
			</tr>
			<tr>
			<td colspan="2"></td>
			</tr>
			<tr>
			<td colspan="2"></td>
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
