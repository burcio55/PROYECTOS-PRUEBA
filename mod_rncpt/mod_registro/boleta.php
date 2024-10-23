<?php
//***version 1.2 fecha:24-04-2020
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
//ini_set("memory_limit","128M");
ini_set ("max_execution_time","9500000000");
require_once('../../tcpdf/config/lang/spa.php');
require_once('../../tcpdf/tcpdf.php');
require_once("../../js/phpqrcode/phpqrcode.php");

//includeJS("../../js/qrcode.min.js");

date_default_timezone_set('America/Caracas');
$lenguage = 'es_VE.UTF-8';
putenv("LANG=$lenguage");
setlocale(LC_ALL, $lenguage, "esp");
session_start();

//var_dump($_SESSION['qr']);
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);
$pdf->SetAuthor('MPPPST');
$pdf->SetTitle('Boleta de Registro RNCPTT');
$pdf->SetSubject('Boleta de Registro RNCPTT');
  
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, 170,"");
  
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
//  //set margins
//  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER); 28092021
//  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);28092021
//  
  
//set margins
$pdf->SetMargins(22, 23, 22);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(false);
    
// remove default header/footer
//$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
  //set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
  
  
  //set some language-dependent strings
  //$pdf->Image('../imagenes/fondo.jpg', '0', '300', '230', '300' ,'JPG','M', false, '', false, '','', false, 0);
  $pdf->Image('../imagenes/fondo.jpg', '0', '26', '548', '812' ,'JPG','M', false, '', false, '','', false, 0);
  $pdf->setLanguageArray($l);
  //$pdf->AddPage();
  $pdf->SetFont('helvetica', '', 11);
  $pdf->setCellHeightRatio(1.4); 


  // ---------------------------------------------------------
  // add a page
//var_dump($_SESSION['aDefaults']);
//SAvar_dump($_SESSION['aDefaults1']);
 if (count($_SESSION['aDefaults'])==0){
	 ?>
		<script>
					parent.document.location='registro_empresa.php';
		</script>
    <?
    }else{
	 
$index=0;

  $i=0;
 $boleta=$_GET['boleta'];
$empresa=htmlentities($_SESSION['aDefaults1']['razon_empresa'], ENT_QUOTES);
$srif=$_SESSION['aDefaults1']['srif'];
$sucursal= htmlentities($_SESSION['aDefaults1']['sucursales'], ENT_QUOTES);
$cedula='';
$nombre_completo='';
for($i=0;$i<count($_SESSION['aDefaults']);$i++){
					$cedula.="V-".number_format($_SESSION['aDefaults'][$i]['ncedula'], 0, '', '.').", ";
					$nombre_completo.=strtoupper($_SESSION['aDefaults'][$i]['apellidonombre_'].", ");
					
}


$tbl = <<<EOD
<table border="0" width="100%" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td align="center"><b><h2>BOLETA DE REGISTRO N° $boleta </h2></b></td>
</tr>

<tr>
<td align="justify" style="font-size:100%">Quien suscribe,<b> Francisco Alejandro Torrealba Ojeda</b>, Ministro del Poder Popular para el Proceso Social de Trabajo, conforme a las atribuciones consagradas en la Ley Orgánica del Trabajo, las trabajadoras y los trabajadores (LOTTT) y lo establecido en el artículo 6 de la Ley Constitucional de los Consejos Productivos de Trabajadores y siendo que esta nueva forma de organización de la clase obrera, ha sido concebida como instrumento para el impulso de la Participación Protagónica de las Trabajadoras y los Trabajadores en la actividad productiva nacional desde las entidades de trabajo; previa constatación de que se han cumplido los requisitos legales que deben concurrir al efecto, <b>DECLARO</b> legalmente constituido a los ciudadanos:<b> $nombre_completo</b> titulares de la cédula de identidad<b> Nº  $cedula </b>respectivamente, como voceros y voceras del Consejo Productivo de Trabajadores de la entidad de trabajo <b>$empresa ($sucursal)</b>, por un período de dos (02) años, contados a partir de la fecha de su elección. En consiguiente los mismo, no podrán ser despedidos, trasladados o desmejorados de su puesto de trabajo, sin justa causa previamente calificada por el Inspector o Inspectora del Trabajo. En tal sentido el Ministerio del Poder Popular para el Proceso Social de Trabajo, como &Oacute;rgano Rector <b> ORDENO </b> el Registro correspondiente, conforme a lo dispuesto en la norma <i>ut supra</i> señalada. </td>    
</tr>

</table>
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

$tbl2 = <<<EOD
<table width="100%" border="0" cellpadding="2" cellspacing="2">

<tr>
   <td align="center" style="font-size:100%"><img src="../img_firmas/firma_torrealba.jpg" height="140"><br/><b>FRANCISCO ALEJANDRO TORREALBA OJEDA</b></td>
</tr>

<tr>
   <td align="center" style="font-size:70%"><b>Ministro del Poder Popular para el Proceso Social de Trabajo</b><br/>Decreto Presidencial N° 4.689 de fecha 16 de Mayo de 2022<br/>Gaceta Oficial Extraordinario Nro. 6.701 de fecha 16 de Mayo de 2022</td>
</tr>
</table>
EOD;
//MOSTRAR EL CODIGO QR
$pdf->writeHTML($tbl2, true, false, false, false, '');

/* ?>
		<script>
		var url=document.URL;
		<?=$url ?> = document.URL ;
	//	alert(url);
		</script>
    <?*/
$url='https://10.46.1.45/minpptrassi/mod_rncpt/mod_registro/boleta_QR.php?boleta='.$boleta;
//$url='https://172.17.1.12/minpptrassi/mod_rncpt/mod_registro/boleta_QR.php?boleta='.$boleta;

QRcode::png($url, "ImagenQR");


$pdf->setAlpha(0.3);
$tbl3 = <<<EOD
<div class="qr" >		
	<tr>
		<td  align="right"><img src="ImagenQR"></td>
	</tr>
	
	<tr>
		<td><label align="right" style="font-size:70%">www.mpppst.gob.ve</label></td>
	</tr>	

</div>
EOD;

$pdf->writeHTML($tbl3, true, false, false, false, '');
//fondo marca de agua



 $pdf->Output('boleta.pdf', 'I');
// $pdf->lastPage(); 
  //============================================================+
  // END OF FILE                                                
  //============================================================+ </p>
 }
