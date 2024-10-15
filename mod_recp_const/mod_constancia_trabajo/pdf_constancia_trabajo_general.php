<?php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
$lenguage = 'es_ES.UTF-8';
putenv("LANG=$lenguage");
ini_set("memory_limit","128M");
ini_set ("max_execution_time","9500000000");

putenv("LANG=$lenguage");
setlocale(LC_ALL, $lenguage, "esp");
require_once('../../tcpdf/config/lang/spa.php');
require_once('../../tcpdf/tcpdf.php');
include('../../include/header.php');
$conn= getConnDB($db1);
$conn->debug = false;  



// se modifico linea 12757 en tcpdf.php para eliminar subrayado bajo el logo y en footer: se añadio	$color=array(255, 255, 255);
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('MPPPST');
$pdf->SetTitle('Constancia de Trabajo Completa');
$pdf->SetSubject('Constancia de Trabajo Completa');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, 160,"");

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(20, 25, 20);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(false);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

//add a page
$pdf->AddPage();
//$pdf->Write(0, 'Ministerio del Poder Popular para el Trabajo y Seguridad Social', '', 0, 'L', true, 0, false, false, 0);
//$pdf->Write(0, 'Departamento de Proveeduria Almacen', '', 0, 'L', true, 0, false, false, 0);
//$pdf->Write(0, '  ', '', 0, 'L', true, 0, false, false, 0);
//$pdf->Write(0, 'Recibo de Pago'.$sfecha.'', '', 0, 'C', true, 0, false, false, 0);
//$pdf->Write(0, '  ', '', 0, 'L', true, 0, false, false, 0);
//$pdf->SetFont('helvetica', 8);
$pdf->SetFont('helvetica', 'I', 13.2);

// NON-BREAKING TABLE (nobr="true")
///////////////// VARIABLES PDF VIEJO
//var_dump ($_SESSION);
//$_SESSION['cedula']='13.289.657';



$_SESSION['recibo_act'];
$cedula						    = number_format( $_SESSION['id_usuario'], 0, '', '.');
$nom 						    = trim($_SESSION['recibo_act']['txt_nombre1'].' '.$_SESSION['recibo_act']['txt_nombre2']);
$ape			 	  		    = $_SESSION['recibo_act']['txt_apellido1'].' '.$_SESSION['recibo_act']['txt_apellido2'];
$fecha_ingreso		 		    = strftime('%d/%m/%Y',strtotime($_SESSION['recibo_act']['txt_fecha_ingreso']));
$descripcion_ubicacion_adm    	= $_SESSION['recibo_act']['txt_nombre_dep'];
$descripcion_cargo				= $_SESSION['recibo_act']['txt_descripcion_cargo'];
$tipo_trabajador				= $_SESSION['recibo_act']['txt_tipo_trabajador'];
$total_asigna					= $_SESSION['total_asigna'];
$totalasigna					= $_SESSION['totalasigna'];
$tickets						= number_format($_SESSION['monto_tickets'], 2, ',', '.');
//$monto_tickets					= number_format($_SESSION['monto_tickets'], 2, ',', '.');
//$tickets						= $_SESSION['tickets'];

$monto_total					= $_SESSION['montos']['monto_total'];
$dia							= $_SESSION['fecha_solicitud_const']['dia'];
$mes			 				= $_SESSION['fecha_solicitud_const']['mes'];
$ano							= $_SESSION['fecha_solicitud_const']['ano'];
$nacionalidad					= $_SESSION['recibo_act']['txt_nacionalidad'];
$ciudadano						= $_SESSION['ciudadano'];
$adscrito						= $_SESSION['adscrito'];
$figura						    = $_SESSION['figura'];

//var_dump ($_SESSION['total_asigna']);

function generar_codigo($conn,$total_asigna,$tickets){
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	$codigo_const = "";
	for($i=0;$i<10;$i++) {
		$codigo_const .= substr($str,rand(0,strlen($str)),1);
	}  
//	$fecha_hoy=	date('Y-m-d');
//	$can_dias_days= 30;  
	$número = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); // 31
	$fec_caducidad= date('Y').'-'.date('m').'-'.$número;
	//= date('Y-m-d', strtotime($fecha_hoy) + intval($can_dias_days*24*60*60)); 
	
	 $sql="SELECT personales_cedula, scodigo_constancia
           FROM recibos_pagos_constancias.constancias_trabajo
	       where personales_cedula='".$_SESSION['id_usuario']."' and tipo_constancias_id=2 and nenabled=1";//COLOCAR VARIABLE OOOOJOOOOOOOOOOOOOOOOOOOOOOOOOOOO
	$rs1 = $conn->Execute($sql);


 $rs1->RecordCount();
	if ($rs1->fields['scodigo_constancia'] == $codigo_const) generar_codigo($conn, $total_asigna,$tickets);
	if ($rs1->RecordCount()<=3){//hasta 3 insert puede hacer al mes 

 $sql2 = "INSERT INTO recibos_pagos_constancias.constancias_trabajo(personales_cedula, tipo_constancias_id, scodigo_constancia, 
            fecha_solicitud_const, fecha_caducidad_const, dfecha_creacion, nusuario_creacion, nmonto, tickets_alimentacion_nmonto)
			VALUES ('".$_SESSION['id_usuario']."',2,'".$codigo_const."', now(), '".$fec_caducidad."', now(),'".$_SESSION['id_usuario']."',
			".$_SESSION['total_asigna'].",'".$_SESSION['monto_tickets']."')";
			$conn->Execute($sql2);
		}
	$GLOBALS['fec_caducidad']=	$fec_caducidad;
	return $codigo_const;
}

$codigo_generado 	= generar_codigo($conn, $total_asigna,$tickets);
$_SESSION['txt_codigo_cod']=$codigo_generado;
$fec_caducidad 		= strftime('%d/%m/%Y',strtotime($GLOBALS['fec_caducidad']));
$URL = 'http://app.rnee.minpptrass.gob.ve/minpptrassi/mod_recp_const/mod_consulta_externas/consulta_constancia_certificada.php';
///////////////// FIN VARIABLES PDF VIEJO
$fechapie = strftime('%d/%m/%Y',strtotime($_SESSION['caducidad']));
$tbl='';
$tbl.= <<<EOD
<table border="0" width="100%" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td align="center"><b><h2>CONSTANCIA</h2></b></td>
</tr>
<tr>
	<td align="justify" style="font-size:100%">Quien suscribe, la <b>Directora General</b> de la <b>Oficina de Gesti&oacute;n Humana del Ministerio del Poder Popular para el Proceso Social de Trabajo</b>, hace constar por medio de la presente que $ciudadano <b>$ape, $nom</b>, titular de la c&eacute;dula de identidad Nro. <b>$nacionalidad.-$cedula</b>, presta sus servicios en &eacute;ste Organismo bajo la figura de <b>$figura</b>, desde el <b>$fecha_ingreso</b>, desempe&ntilde;ando en la actualidad el cargo de <b>$descripcion_cargo</b>, $adscrito	<b> $descripcion_ubicacion_adm</b>, percibiendo un total de ingresos mensuales de Bs.S <b>$totalasigna</b></td>
</tr>
<tr>
     <td>&nbsp;</td>
</tr>

<tr>
	<td align="justify" style="font-size:100%">Adicionalmente, percibe por concepto de Cestaticket Socialista, <b>$tickets</b> mensual.</td>
</tr>
</table>
EOD;

$tbl3='';
$tbl3 .= <<<EOD
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
<tr>
	 <td align="justify" style="font-size:100%">Constancia que se expide a petici&oacute;n de la parte interesada en <b>Caracas</b> a los <b>$dia</b> días del mes de <b>$mes</b> de  <b>$ano</b>.</td>
</tr>
<tr>
     <td>&nbsp;</td>
</tr>
<tr>
     <td align="center" style="font-size:100%">Atentamente,</td>
</tr>
<tr>
	 <td align="center"><img src="../img_firmas/firmaAINEE.png" height="130"></td>
</tr>
<tr>
   <td align="center" style="font-size:100%"><b>AINEE VEL&Aacute;SQUEZ SOL&Oacute;RZANO</b></td>
</tr>
<tr>
   <td align="center" style="font-size:78%"><b>DIRECTORA GENERAL DE LA OFICINA DE GESTI&Oacute;N HUMANAA</b></td>
</tr>
<tr>
   <td align="center" style="font-size:80%">Seg&uacute;n Resoluci&oacute;n N&deg; 168 de fecha 18/05/2021</td>
</tr>
<tr>
   <td align="center" style="font-size:80%">Gaceta Oficial N&deg; 42.133 de fecha 24/05/2021</td>
</tr>

<tr>
	<td align="right" style="font-size:66%">C&oacute;digo de verificaci&oacute;n:</td>
</tr>
<tr>
   <td align="right" bgcolor="#F0F0F0" color="#1060C8"><FONT SIZE=5><b>$codigo_generado</b></font></td>
</tr>
<tr>
		<td align="center" style="font-size:56%">Esta constancia ha sido impresa electr&oacute;nicamente, los datos reflejados estan sujetos a confirmaci&oacute;n a trav&eacute;s de: <a href="$URL">www.mpppst.gob.ve</a>, Solicitudes en Línea, Consultas, Constancia de Trabajo, Valido hasta el <b>$fec_caducidad</b></td>
</tr>
<tr>
	<td align="center" style="font-size:70%"><b>No requiere sello h&uacute;medo. Seg&uacute;n Ley de Simplificaci&oacute;n de Tr&aacute;mites Administrativos</b></td>
</tr>
<tr>
	<td align="center" style="font-size:58%"><b>y Ley de Infogobierno.</b></td>
</tr>
<tr>
  <td>-------------------------------------------------------------------------------------------------------</td>
</tr>
<tr>
   <td align="center" style="font-size:60%">Av. Baralt. Edif. Sur, Centro Sim&oacute;n Bolívar, piso 4. Urb. Santa Teresa. Caracas. Distrito Capital. Apartado Postal 1010.</td>    
</tr>
<tr>
  <td align="center" style="font-size:65%">Rif <b>G-20000012-0</b>. Para Cualquier informaci&oacute;n podrá comunicarse por los números</td>
</tr>
<tr>
  <td align="center" style="font-size:65%">teléfonicos: (0212)-408 4366, 4374, 4375,4380.</td>
</tr>
</table>
EOD;

//echo $tbl; 
//$pdf->writeHTML($tbl, true, false, false, false, '');

// NON-BREAKING TABLE (nobr="true")  
$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->writeHTML($tbl2, true, false, false, false, '');
$pdf->writeHTML($tbl3, true, false, false, false, '');
// -----------------------------------------------------------------------------

//Close and output PDF document

//echo exec('rm constancia.pdf');
//list($quitar, $ruta)=explode('/var/www',getcwd());
//$pdf->Image('../images/correo.jpg', 180, 260, 5, 5, 'JPG', 'http://'.$_SERVER['SERVER_ADDR'].$ruta.'/enviar_correo_constancia_trab.php', '', true, 150, '', false, false, 0, false, false, false);

$pdf->Output('constancia_trabajo_csuel'.$_SESSION['id_usuario'].'_'.date('d/m/y').'.pdf', 'D');
