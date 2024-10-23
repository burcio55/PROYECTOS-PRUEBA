<?php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
ini_set("memory_limit","128M");
ini_set ("max_execution_time","9500000000");
$lenguage = 'es_ES.UTF-8';
putenv("LANG=$lenguage");
setlocale(LC_ALL, $lenguage);
require_once('../../tcpdf/config/lang/spa.php');
require_once('../../tcpdf/tcpdf.php');
include('../../include/header.php');
$conn= getConnDB($db1);
$conn->debug = false; 

// se modifico linea 12757 en tcpdf.php para eliminar subrayado bajo el logo y en footer: se añadio	$color=array(255, 255, 255);


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
/*$pdf->setPrintHeader(false);
$pdf->SetPrintFooter(false);*/
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('MPPPST');
$pdf->SetTitle('Constancia de Trabajo Simple');
$pdf->SetSubject('Constancia de Trabajo Simple');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, 150,"");

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(30, 25, 30);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(false);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// fuente
$pdf->SetFont('helvetica', 'I', 12);

//add a page
$pdf->AddPage();

///////////////// VARIABLES PDF VIEJOs
$_SESSION['recibo_act'];
$cedula										= number_format( $_SESSION['id_usuario'], 0, '', '.');
$nom 										= trim($_SESSION['recibo_act']['txt_nombre1'].' '.$_SESSION['recibo_act']['txt_nombre2']);
$ape			 	 						= $_SESSION['recibo_act']['txt_apellido1'].' '.$_SESSION['recibo_act']['txt_apellido2'];
$fecha_ingreso		 						= strftime('%d/%m/%Y',strtotime($_SESSION['recibo_act']['txt_fecha_ingreso']));
$descripcion_ubicacion_adm  				= $_SESSION['recibo_act']['txt_nombre_dep'];
$descripcion_cargo							= $_SESSION['recibo_act']['txt_descripcion_cargo'];
$dia										= $_SESSION['fecha_solicitud_const']['dia'];
$mes			 							= $_SESSION['fecha_solicitud_const']['mes'];
$ano										= $_SESSION['fecha_solicitud_const']['ano'];
$nacionalidad								= $_SESSION['recibo_act']['txt_nacionalidad'];
$ciudadano									= $_SESSION['ciudadano'];
$adscrito									= $_SESSION['adscrito'];

function generar_codigo($conn){

	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	$codigo_const = "";
	for($i=0;$i<10;$i++) {
		$codigo_const .= substr($str,rand(0,strlen($str)),1);
	} 
	$fecha_hoy=	date('Y-m-d');
	$can_dias_days= 30; 
	$fec_caducidad= date('Y-m-d', strtotime($fecha_hoy) + intval($can_dias_days*24*60*60)); 
	
	 $sql="SELECT recibo_pago.dfecha_creacion,
	personales.cedula, personales.fecha_caducidad_const,scodigo_constancia
	FROM recibos_pagos_constancias.recibo_pago
	inner join personales on personales.cedula= recibos_pagos_constancias.recibo_pago.personales_cedula
	where cedula='".$_SESSION['id_usuario']."' and nestatus='1' 
	order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC LIMIT 1";
	$rs1 = $conn->Execute($sql);
	
	if ($rs1->fields['scodigo_constancia'] == $codigo_const) generar_codigo($conn);
	if ($rs1->RecordCount()>0){
		$condicion=NULL;
		if ($rs1->fields['fecha_caducidad_const']==NULL) {
			$fecha_caducidad_const = 'NULL';
		}else{
			$fecha_caducidad_const = $rs1->fields['fecha_caducidad_const'];
			$condicion= "dfecha_caduc_const_ant='$fecha_caducidad_const',";
		}
		if ($fecha_caducidad_const < $fecha_hoy or $rs1->fields['fecha_caducidad_const'] == NULL)	{
 
			$sql2 = "UPDATE personales
					SET 
					fecha_solicitud_const='".$fecha_hoy."' , 
					fecha_caducidad_const= '".$fec_caducidad."' , 
					scodigo_constancia='".$codigo_const."',
					".$condicion."
					scodigo_const_venc='".$rs1->fields['scodigo_constancia']."'
					WHERE cedula='".$_SESSION['id_usuario']."'";
			$conn->Execute($sql2);
		}
		
	}
	$GLOBALS['fec_caducidad']=	$fec_caducidad;
	return ($rs1->fields['scodigo_constancia']!='') ? $rs1->fields['scodigo_constancia'] : $codigo_const;
}
$codigo_generado 	= generar_codigo($conn);
$_SESSION['txt_codigo_cod']=$codigo_generado;
$fec_caducidad 		= strftime('%d/%m/%Y',strtotime($GLOBALS['fec_caducidad']));

$URL = 'http://app.rnee.minpptrass.gob.ve/minpptrassi/mod_recp_const/mod_consulta_externas/consulta_constancia_certificada.php';

///////////////// FIN VARIABLES PDF VIEJO
$tbl = <<<EOD
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
   <td>&nbsp;</td>
</tr>
<tr>
 <td align="center"><b><h2>CONSTANCIA</h2></b></td>
</tr>
<tr>
   <td>&nbsp;</td>
</tr>
<tr>
		<td align="justify" style="font-size:100%">Quien suscribe, la <b>Directora General</b> de la <b>Oficina de Gesti&oacute;n Humana del Ministerio del Poder Popular para el Proceso Social de Trabajo</b>, por medio de la presente hace constar que $ciudadano <b>$ape, $nom</b>, titular de la c&eacute;dula de identidad nro. <b>$nacionalidad.-$cedula</b>, presta sus servicios en &eacute;ste ministerio desde el <b>$fecha_ingreso</b>, desempe&ntilde;ando el cargo de <b>$descripcion_cargo</b>, $adscrito	<b> $descripcion_ubicacion_adm</b>.</td>
</tr>
<tr>
   <td>&nbsp;</td>
</tr>
<tr>
	  <td align="justify" style="font-size:100%">Constancia que se expide a petici&oacute;n de la parte interesada en Caracas a los $dia días del mes de $mes de $ano.</td>
</tr>
<tr>
   <td>&nbsp;</td>
</tr>
<tr>
   <td>&nbsp;</td>
</tr>
<tr>
   <td align="center" style="font-size:100%">Atentamente,</td>
</tr>
<tr>
   <td>&nbsp;</td>
</tr>
<tr>
	<td align="center"><img src="../img_firmas/firmaAINEE.png" height="130"></td>
</tr>
<tr>
   <td align="center" style="font-size:100%"><b>AINEE VEL&Aacute;SQUEZ SOL&Oacute;RZANO</b></td>
</tr>
<tr>
   <td align="center" style="font-size:78%"><b>DIRECTORA GENERAL DE LA OFICINA DE GESTI&Oacute;N HUMANA</b></td>
</tr>
<tr>
   <td align="center" style="font-size:80%">Seg&uacute;n Resoluci&oacute;n N&deg; 168 de fecha 18/05/2021</td>
</tr>
<tr>
   <td align="center" style="font-size:80%">Gaceta Oficial N&deg; 42.133 de fecha 24/05/2021</td>
</tr>

<tr>
   <td>&nbsp;</td>
</tr>
<tr>
	<td align="right" style="font-size:66%">C&oacute;digo de verificaci&oacute;n:</td>
</tr>
<tr>
  <td align="right" bgcolor="#F0F0F0" color="#1060C8"><FONT SIZE=5><b>$codigo_generado</b></font></td>
</tr>
<tr>
	<td align="center" style="font-size:62%">Esta constancia ha sido impresa electr&oacute;nicamente, los datos reflejados estan sujetos a confirmaci&oacute;n a trav&eacute;s de: <a href="$URL">www.mpppst.gob.ve</a>, Solicitudes en Línea, Consultas, Constancia de Trabajo, Valido hasta el <b>$fec_caducidad</b></td>
</tr>
<tr>
	<td align="center" style="font-size:62%"><b>No requiere sello h&uacute;medo. Seg&uacute;n Ley de Simplificaci&oacute;n de Tr&aacute;mites Administrativos y Ley de Infogobierno.</b></td>
</tr>
<tr >
 <td align="center">----------------------------------------------------------------------------------------------------------</td>
</tr>
<tr>
  <td align="center" style="font-size:66%">Av. Baralt. Edif. Sur, Centro Sim&oacute;n Bolívar, piso 4. Urb. Santa Teresa. Caracas. Distrito Capital. Apartado Postal 1010.</td>
</tr>
<tr>
	  <td align="center" style="font-size:66%">Para Cualquier informaci&oacute;n podrá comunicarse por los teléfonos: (0212)-408 4366, 4374, 4375,4380.</td>
</tr>
</table>
EOD;
//echo $tbl; 
$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document

//echo exec('rm constancia.pdf');
//list($quitar, $ruta)=explode('/var/www',getcwd());
//$pdf->Image('../images/correo.jpg', 180, 260, 5, 5, 'JPG', 'http://'.$_SERVER['SERVER_ADDR'].$ruta.'/enviar_correo_constancia_trab.php', '', true, 150, '', false, false, 0, false, false, false);

$pdf->Output('constancia_trabajo_ssueldo'.$_SESSION['id_usuario'].'_'.date('d/m/y').'.pdf', 'D');