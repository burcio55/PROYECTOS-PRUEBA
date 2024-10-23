<?php
//***version 1.2 fecha:07-04-2020
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
//ini_set("memory_limit","128M");
ini_set ("max_execution_time","9500000000");
require_once('../../tcpdf/config/lang/spa.php');
require_once('../../tcpdf/tcpdf.php');
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
  
  // set header and footer fonts
 $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
  
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
  $pdf->setLanguageArray($l);
  $pdf->AddPage();
  // ---------------------------------------------------------
  // add a page
//var_dump($_SESSION['aDefaults']);
//var_dump($_SESSION['aDefaults1']);
 if (count($_SESSION['aDefaults'])==0){
	 ?>
		<script>
					parent.document.location='mod_registro_personal.php';
		</script>
    <?
    }else{
	 
$index=0;

//fondo marca de agua
$pdf->Image('../imagenes/fondo1.png', '15', '26', '598', '812' ,'PNG','M', false, '', false, '','', false, 0);
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
$pdf->SetFont('helvetica', '', 12);  

$tbl = <<<EOD
<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr>
<th1><div align="center">BOLETA DE REGISTRO N° $boleta </div></th1>
</tr>
<tr>
 <td>
 
   <div align="justify">Quien suscribe, Josè Ramòn Rivero Gonzàlez, Ministro del Poder Popular para el Proceso Social de Trabajo, conforme a las atribuciones consagradas en la ley Orgànica del Trabajo, las trabajadoras y los trabajadores (LOTTT) y lo establecido en el articulo 6 de la ley constitucional de los consejos productivos de Trabajadores y siendo que esta nueva forma de organizaciòn de la clase obrera, ha sido concebida como instrumento para el impulso de la Participaciòn Protagònica de las Trabajadorasy los Trabajadores en el impulso de la actividad productiva nacional desde las entidades de trabajo; previa constataciòn de que se ha cumplido los requesitos legales que deben concurrir al efecto, DECLARO legalmente constituido a los ciudadanos: $nombre_completo titulares de la cedula de identidad Nº $cedula respectivamente, como voceros y voceras del consejo Productivo de Trabajadores de la entidad de trabajo $empresa ($sucursal), por un periodo de dos años, contados a partir de la fecha de su elecciòn. En consiguiente los mismo. no podràn ser despedidos, trasladados o desmejorados de sus puesto de trabajo, sin justa causa previamente calificada por el Inspector o Inspectora del Trabajo y en nombre del Ministerio del Poder Popular para el Proceso Social de Trabajo, como Òrgano Rector ORDENO el Registro correspondiente, conforme a los dispuesto en la norma ut supra señalada </div></td>    
</tr>

</table>
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
$tbl2 = <<<EOD
<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr>
 <td>
   <div align="center">
     JOSE RAMÒN RIVERO GONZALEZ
   </div></td>    
</tr>
<tr  align="center">
<td>Ministro del Poder Polular para el Proceso Social de Trabajo</td>
</tr>
<tr  align="center">
<td>Decreto Presidencial N° 4.607 de fecha 04 de Mayo de 2021</td>
</tr>
<tr  align="center">
<td>Decreto Oficial N° 42.119 de fecha 04 de Mayo de 2021</td>
</tr>
</table>

EOD;
$pdf->writeHTML($tbl2, true, false, false, false, '');
 $pdf->Output('boleta.pdf', 'I');
// $pdf->lastPage(); 
  //============================================================+
  // END OF FILE                                                
  //============================================================+ </p>
 }
