<?php
     session_start();
     error_reporting(E_ALL | E_STRICT);
     $lenguage = 'es_VE.UTF-8'; //permite mostrar la fecha en letras
     putenv("LANG=$lenguage");
     setlocale(LC_ALL, $lenguage, "esp");
     ini_set("max_execution_time","28800");
     //session_start();
     require_once('../../tcpdf/config/lang/spa.php');
     require_once('../../tcpdf/tcpdf.php');
     include('../../include/header.php');
     $conn= getConnDB($db1);
     $conn->debug=false;
     //$ano= '2017';
     ini_set("display_errors", 0);
     ///////////////////////
     // create new PDF document
     $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

     // set document information
     $pdf->SetCreator(PDF_CREATOR);
     $pdf->SetAuthor('MPPPST');
     $pdf->SetTitle('Recibo de Pago Quincenal Año Actual');
     $pdf->SetSubject('Recibo de Pago Quincenal Año Actual');
     //$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

     // set default header data
     $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_STRING);
     //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

     // set header and footer fonts
     $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
     $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

     // set default monospaced font
     $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

     //set margins
     $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
     $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
     //S$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

     //set auto page breaks
     $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

     //set image scale factor
     $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

     //set some language-dependent strings
     $pdf->setLanguageArray($l);

     // ---------------------------------------------------------
     // set font
     $pdf->SetFont('helvetica', '', 6);
     //$pdf->SetFont("helvetica", "", 8);
	
     // add a page
     $pdf->AddPage();
     // -----------------------------------------------------------------------------

     function cambiarMayusculas($cadena)
     {
	  $cadena = str_ireplace(	'&aacute;','Á',$cadena);
	  $cadena = str_ireplace(	'&eacute;','É',$cadena);
	  $cadena = str_ireplace(	'&iacute;','Í',$cadena);
	  $cadena = str_ireplace(	'&oacute;','Ó',$cadena);
	  $cadena = str_ireplace(	'&uacute;','Ú',$cadena);
	  $cadena = str_ireplace(	'&ntilde;','Ñ',$cadena);
	  $cadena = strtoupper($cadena);
	  return $cadena;
     }
     //Creo un arreglo con el contenido del arreglo recibo_act que monté en sesión:
     $recibos                    =$_SESSION['recibo_act'];
     //$quincena=$_SESSION['quincenaE'];
     $nombres                    =trim($recibos['txt_nombre1'].' '.$recibos['txt_nombre2']);
     $apellidos                  =trim($recibos['txt_apellido1'].' '.$recibos['txt_apellido2']);
     $nacionalidad               =$recibos['txt_nacionalidad'];
     if($recibos['txt_nacionalidad']==1){ $nacionalidad='Venezolana';}
     if($recibos['txt_nacionalidad']==2){ $nacionalidad='Extranjero';}
     $cedula                     =number_format($recibos['txt_cedula'],0,'','.');
     $descripcion_tipo_trabajador=$recibos['txt_tipo_trabajador'];
     $codigo_nom                 =$recibos['txt_codigo_nom'];
     $estatus                    =$recibos['txt_estatus']; 
     if($estatus==1){ $estatus='ACTIVO';}
     if($estatus==2){ $estatus='EGRESADO';}
     $cuenta_nom=$recibos['txt_cuenta_nom'];
     $descripcion_cargo=$recibos['txt_cargo'];
     $descripcion_ubicacion_adm=$recibos['txt_ubicacion_adm'];
     $cod_tipo_trabajador=$recibos['txt_codigo_tipos_trabajadores'];
     $codigo_conceptos		= $recibos['txt_cod_concepto'];
     $descripcion_conceptos	= $recibos['txt_descripcion_concepto'];
		
		//$conceptos 										= $_SESSION['recibo_act_concepto'];
		//$codigo_conceptos					    		    = $conceptos['txt_cod_concepto'];
		//$descripcion_conceptos							= $conceptos['txt_descripcion_concepto'];
		//$quincena 										= str_replace('QUINCENA DEL ','',$conceptos['quincena']);
		////$quincena 										= str_replace('QUINCENA DEL ','',$recibos['quincena_cb']);
		//$quincena=str_replace('QUINCENA DEL ','',$quincena);
		$mes	 										= $recibos['mes_cb'];
		
		$fecha = date('d/m/Y');

	if ($cod_tipo_trabajador!='05')	  $query = $quincena;
	else $query = $_POST['semana'];
	
	$quincena=$_SESSION['quincenaE'];
	$quincena=str_replace('QUINCENA DEL ','',$quincena);
		
		if (!preg_match('/(10|11)/', $mes))
		 $nro_semana="recibo_pago.nsemana_quincena=".$_GET['sq'];
		else
		 $nro_semana="recibo_pago.nnro_nomina=".$_GET['nn'];
		$sql3="SELECT recibos_pagos_constancias.conceptos.scodigo as cod_concepto, 
				recibos_pagos_constancias.conceptos.ncategoria as categoria,
				nmonto,nmes,nanio,nsemana_quincena,
				recibos_pagos_constancias.conceptos.sdescripcion as descripcion_concepto 
				FROM recibos_pagos_constancias.recibo_pago 
				inner join recibos_pagos_constancias.conceptos on recibos_pagos_constancias.recibo_pago.conceptos_scodigo = recibos_pagos_constancias.conceptos.scodigo 
				where personales_cedula = '".$_SESSION['cedula_a_consultar']."'
				and recibos_pagos_constancias.conceptos.nenabled='1'
				and recibo_pago.nanio='".date('Y')."'
				and recibo_pago.nmes='".$_GET['mes']."'
    			and ".$nro_semana."
				order by conceptos_scodigo";	
		$rs=$conn->Execute($sql3);

$tbl.='
<table width="100%" cellPadding="1" cellSpacing="1">
		<tr color="#1060C8">
			<th align="rihgt"><h2>COMPROBANTE DE PAGO</h2></th>
		</tr>
		
		<tr color="#1060C8">
			<th align="rihgt">Semanal/Quincenal</th>
		</tr>
</table>

<table width="100%" border="0" cellPadding="5" cellSpacing="1">
		<tr bgcolor="#D0E0F4" color="#1060C8">
				<td width="50%">NOMBRE(S) Y APELLIDO(S)</td>
				<td width="25%" align="center">C&Eacute;DULA DE IDENTIDAD</td>
				<td width="25%" align="center">STATUS ACTUAL</td>
		</tr>
		
		<tr bgcolor="#F0F0F0">
				<td width="50%">'.$nombres.'  '.$apellidos.'</td>
				<td width="25%" align="center">'.$cedula.'</td>
				<td width="25%" align="center">'.$estatus.'</td>    
		</tr>

		<tr bgcolor="#D0E0F4" color="#1060C8">
				<td align="left">CARGO</td>
				<td align="center">C&Oacute;DIGO DE N&Oacute;MINA</td>
				<td align="center">CUENTA N&Oacute;MINA</td>
		</tr>

		<tr bgcolor="#F0F0F0">
				<td>'.$descripcion_cargo.'</td>
				<td align="center">'.$codigo_nom.'</td>
				<td align="center">'.$cuenta_nom.'</td>
		</tr>

		<tr bgcolor="#D0E0F4" color="#1060C8">
				<td align="left" colspan="2">UBICACI&Oacute;N ADMINISTRATIVA</td>
				<td align="center">PER&Iacute;ODO DE PAGO</td>
		</tr>

		<tr bgcolor="#F0F0F0">
				<td colspan="2">'.$descripcion_ubicacion_adm.'</td>
				<td align="center">'.$quincena.'</td>
		</tr>

</table>
';

$tbl2='';
$tbl2.='
<table width="100%" border="0" cellPadding="5" cellSpacing="1">
		<tr bgcolor="#FBF0D2" color="#1060C8">
				<td align="left" width="50%">CONCEPTOS SALARIALES</td>
				<td align="right" width="25%">ASIGNACIONES</td>
				<td align="right" width="25%">DEDUCCIONES</td>
		</tr>
';

$total_no_salarial = $total_deduce = $total_asigna = $inter = 0;
$inter = 0;
while(!$rs->EOF){
	if (($inter%2) == 0) $class_name='bgcolor="#F7F7F7"';
	else $class_name='bgcolor="#E2E2E2"';
	
	if ($rs->fields['categoria']=='1'){ 
	
			$monto_asigna = $rs->fields['nmonto']; // 5000 = CODIGO NOMINA - NO DEBE APARECER
			//<td>'.$rs->fields['cod_concepto'].'&nbsp;&nbsp;&nbsp;'.trim($rs->fields['descripcion_concepto']).'</td>
$tbl2.='
			<tr '.$class_name.'>
					<td>'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
					<td align="right">'.number_format($rs->fields['nmonto'], 2, ",", ".").'</td>
					<td>&nbsp;</td>
			</tr>';
					$total_asigna = $monto_asigna + $total_asigna;
				 }
				 
//			if ($rs->fields['categoria']=='3'){ // AQUI SE FILTRAN LOS CONCEPTOS NO SALARIALES Y SE GUARDAN PARA IMPRIMIR APARTE
//		//<td>'.$rs->fields['cod_concepto'].'&nbsp;&nbsp;&nbsp;'.trim($rs->fields['descripcion_concepto']).'</td>
//			$no_salarial .='
//			<tr '.$class_name.'>
//					<td>'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
//					<td align="center">'.number_format($rs->fields['nmonto'], 2, ",", ".").'</td>	
//					<td>&nbsp;</td>				
//			</tr>';
//     			$total_no_salarial = $rs->fields['nmonto'] + $total_no_salarial;
//			}
//			
	
			if ($rs->fields['categoria']=='3' and  $rs->fields['cod_concepto']=='1600'){ // Asignaciones no salariales
			$no_salarial .=
			'<tr '.$class_name.'>					
					<td>'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
					<td align="right">'.number_format($rs->fields['nmonto']-(($rs->fields['nmonto']*5)/1000), 2, ",", ".").'</td>
					<td>&nbsp;</td>
			</tr>';
				$total_no_salarial = $rs->fields['nmonto'] + $total_no_salarial;
		}elseif ($rs->fields['categoria']=='3'){ 
			$no_salarial .=
			'<tr '.$class_name.'>					
					<td>'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
					<td align="right">'.number_format($rs->fields['nmonto'], 2, ",", ".").'</td>
					<td>&nbsp;</td>
			</tr>';
			   $total_no_salarial = $rs->fields['nmonto'] + $total_no_salarial;
			}

	if ($rs->fields['categoria']=='2'){
		$monto_deduce = $rs->fields['nmonto'];
		//<td>'.$rs->fields['cod_concepto'].'&nbsp;&nbsp;&nbsp;'.trim($rs->fields['descripcion_concepto']).'</td>
$tbl2 .='
    <tr '.$class_name.'>
			<td>'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
			<td>&nbsp;</td>
			<td align="right">'.number_format($monto_deduce, 2, ",", ".").'</td>
		</tr>
';
		      $total_deduce = $monto_deduce + $total_deduce;
	}
	$rs->MoveNext();
	$inter++;
}
$total_neto = $total_asigna - $total_deduce;

$tbl2.='
  <tr color="#1060C8">
			<td align="right"><b>TOTALES CONCEPTOS SALARIALES:</b></td>
			<td align="right" bgcolor="#E2E2E2"><b>'.number_format($total_asigna, 2, ",", ".").'</b></td>
			<td align="right" bgcolor="#E2E2E2"><b>'.number_format($total_deduce, 2, ",", ".").'</b></td>
	</tr>

	<tr color="#1060C8">
			<td align="right"><b>NETO N&Oacute;MINA:</b></td>
			<td align="right" bgcolor="#F7F7F7">&nbsp;</td>
			<td align="right" bgcolor="#F7F7F7"><b>'.number_format($total_neto, 2, ",", ".").'</b></td>
	</tr> 
';

if ($no_salarial!=''){
$tbl2 .='
 <tr bgcolor="#FBF0D2" color="#1060C8">
		<td align="left"  width="50%">CONCEPTOS NO SALARIALES</td>
		<td align="right" width="25%">ASIGNACIONES</td>
		<td align="center" width="25%">&nbsp;</td>
 </tr>

	'.$no_salarial.'

	<tr color="#1060C8">
			<td align="right"><b>TOTAL CONCEPTOS NO SALARIALES:</b></td>
			<td align="right" bgcolor="#F7F7F7"><b>'.number_format($total_no_salarial, 2, ",", ".").'</b></td>
			<td align="center" bgcolor="#F7F7F7">&nbsp;</td>
	</tr>
	
';
}
else{
}
$tbl2.='
		<tr>
			<td colspan="3" align="right"><b>Fecha de Impresi&oacute;n: '.$fecha.'</b></td>
		</tr>
</table>
';

 
// NON-BREAKING TABLE (nobr="true")  
$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->writeHTML($tbl2, true, false, false, false, '');
// -----------------------------------------------------------------------------

//Close and output PDF document
//$pdf->Output('Planilla Escrito', 'D');
//$pdf->Output("example_048.pdf", "D");  
//$pdf->Output('constancia'.$_SESSION['id_usuario'].'.pdf', "D");

$pdf->Output('recibo_pagqaact'.$_SESSION['id_usuario'].'_'.date('d/m/y').'.pdf', 'D');
//$pdf->Output('constancia'.$_SESSION['sUsuario'].'.pdf', 'FI');
//============================================================+
// END OF FILE                                                
//============================================================+

?>
