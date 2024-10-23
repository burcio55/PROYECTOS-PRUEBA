<?php 
include("../../header.php"); 

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];

$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();

debug();
doAction($conn);
showForm($conn,$aDefaultForm);

function LoadListyear($anio)
{
	while($anio <= date('Y'))
	{
		print '<option value='.$anio.' selected="selected">'.$anio.'</option>';
		$anio++;
	}
}

function LoadListMonth($month)
{
	while($month <= date('M'))
	{
		print '<option value='.$month.' selected="selected">'.$month.'</option>';
		$month++;
	}
}

function nombremes($mes){
    	setlocale(LC_TIME, 'spanish');
        $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000));
        return $nombre;
}

function loadMes_cb(){
        $GLOBALS[$sHtml_Var] = '';
        $sHtml_Var = "sHtml_mes_cb";

        for ($i=1; $i<=12; $i++) {
                $GLOBALS[$sHtml_Var] .= "<option value={$i}";
                if ($i == $GLOBALS['aDefaultForm']['mes_cb']) {
                        $GLOBALS[$sHtml_Var].= " selected='selected'";
                }
                $GLOBALS[$sHtml_Var] .= ">".nombremes($i)." </option>\n";
        }
}

function loadSemana_cb(){
        $GLOBALS[$sHtml_Var] = '';
        $sHtml_Var = "sHtml_semana_cb";

        for ($i=1; $i<=52; $i++) {
                $GLOBALS[$sHtml_Var] .= "<option value={$i}";
                if ($i == $GLOBALS['aDefaultForm']['semana_cb']) {
                        $GLOBALS[$sHtml_Var].= " selected='selected'";
                }
                $GLOBALS[$sHtml_Var] .= ">".$i." </option>\n";
        }
}

function nombrequincena($quincena){
        $nombre=($quincena==1)?'Primera Quincena' : 'Segunda Quincena';
        return $nombre;
}

function loadQuinc_cb(){
        $GLOBALS[$sHtml_Var] = '';
        $sHtml_Var = "sHtml_quincena_cb";

        for ($i=1; $i<=2; $i++) {
                $GLOBALS[$sHtml_Var] .= "<option value={$i}";
                if ($i == $GLOBALS['aDefaultForm']['quincena_cb']) {
                        $GLOBALS[$sHtml_Var].= " selected='selected'";
                }
                $GLOBALS[$sHtml_Var] .= ">".nombrequincena($i)." </option>\n";
        }
}

function doAction($conn){
	if (isset($_POST['action'])){
				switch($_POST["action"]){
				case 'consultar':
						$bValidateSuccess=true;
					
							if ($_POST['mes']==""){
								//	echo "AQUI MES".$_POST['mes'];
								$GLOBALS['aPageErrors'][]= "- Debe seleccionar el Mes.";
								$GLOBALS['ids_elementos_validar'][]='mes';
								$bValidateSuccess=false;
							}
							
						if ($_POST['txt_tipo_trabajador']!='OBRERO')  $query = $_POST['quincena'];
									else $query = $_POST['semana'];		
																					
							if ($query==""){
								$GLOBALS['aPageErrors'][]= "- Debe seleccionar Semana o quincena.";
								$GLOBALS['ids_elementos_validar'][]=$query;
								$bValidateSuccess=false;
							}
						
					LoadData($conn,false);					
				break;
			}
		}else{
		LoadData($conn,false);
	}
 }

function LoadData($conn,$bPostBack){  
	if (count($GLOBALS['aDefaultForm']) == 0){
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
			$aDefaultForm['mes_cb'] = (date('d')>15) ? date('m') : date('m')-1;
			$aDefaultForm['quincena_cb'] = (date('d')>15) ? 1 : 2;
			$aDefaultForm['semana_cb'] = (date('W')==1) ? 52 : date('W')-1;
					if(isset($_SESSION['id_usuario'])){
						   $SQL="SELECT
								personal.cedula,
								vacacion.anio,
								vacacion.fecha_inicio,
								vacacion.fecha_fin,
								vacacion.dias_disfrute,
								vacacion.dias_pendientes,
								vacacion.fecha_reintegro,
								vacacion.observaciones
								FROM personal
								INNER JOIN vacacion ON personal.id_personal = vacacion.id_personal
								WHERE personal.cedula =  '".$_SESSION['id_usuario']."' 
								order by anio";
					$rs_1=$conn->Execute($SQL);
					if($rs_1->RecordCount()>0){
						$aDefaultForm['anio']				   					= $rs_1->fields['anio'];
					    $aDefaultForm['fecha_inicio']							= $rs_1->fields['fecha_inicio'];
						$aDefaultForm['fecha_fin']								= $rs_1->fields['fecha_fin'];
						$aDefaultForm['dias_disfrute']							= $rs_1->fields['dias_disfrute'];
						$aDefaultForm['dias_pendientes']						= $rs_1->fields['dias_pendientes'];
						$aDefaultForm['fecha_reintegro']						= $rs_1->fields['fecha_reintegro'];						
						$aDefaultForm['txt_estatus']							= $rs_1->fields['observaciones'];
					}			
				}
		if (!$bPostBack){
			if(isset($_SESSION['id_usuario'])){
						$SQL="SELECT
								personal.cedula,
								vacacion.anio,
								vacacion.fecha_inicio,
								vacacion.fecha_fin,
								vacacion.dias_disfrute,
								vacacion.dias_pendientes,
								vacacion.fecha_reintegro,
								vacacion.observaciones
								FROM personal
								INNER JOIN vacacion ON personal.id_personal = vacacion.id_personal
								WHERE personal.cedula =  '".$_SESSION['id_usuario']."' 
								order by anio";							
						
					$rs_1=$conn->Execute($SQL);
  				if($rs_1->RecordCount()>0){
						$aDefaultForm['anio']				   					= $rs_1->fields['anio'];
					    $aDefaultForm['fecha_inicio']							= $rs_1->fields['fecha_inicio'];
						$aDefaultForm['fecha_fin']								= $rs_1->fields['fecha_fin'];
						$aDefaultForm['dias_disfrute']							= $rs_1->fields['dias_disfrute'];
						$aDefaultForm['dias_pendientes']						= $rs_1->fields['dias_pendientes'];
						$aDefaultForm['fecha_reintegro']						= $rs_1->fields['fecha_reintegro'];						
						$aDefaultForm['txt_estatus']							= $rs_1->fields['observaciones'];
					}			
				}
		   }
	}
}
?>


<?php function showForm($conn,$aDefaultForm){ // en esta funcion siempre va el formulario ?>
<?php include('funciones_generales.php'); ?>

	<div id="Contenido" align="center" style="overflow:auto">
	<br>
    
	<table width="95%" class="tabla" height="95%">
	<tbody>
	<tr valign="top">
	<td>
	
	<form name="frm_rec_pago_consulta_ano_act" id="frm_rec_pago_consulta_ano_act" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
		<input name="action" type="hidden" value="" />
		<input name="txt_tipo_trabajador"  id="txt_tipo_trabajador" type="hidden" value="<?= $aDefaultForm['txt_tipo_trabajador']; ?>" />
		<input name="txt_codigo_tipos_trabajadores"  id="txt_codigo_tipos_trabajadores" type="hidden" value="<?= $aDefaultForm['txt_codigo_tipos_trabajadores']; ?>" />
		<input name="txt_apellido1"  id="txt_apellido1" type="hidden" value="<?= $aDefaultForm['txt_apellido1']; ?>" />
		<input name="txt_apellido2"  id="txt_apellido2" type="hidden" value="<?= $aDefaultForm['txt_apellido2']; ?>" />
		<input name="txt_nombre1"  id="txt_nombre1" type="hidden" value="<?= $aDefaultForm['txt_nombre1']; ?>" />
		<input name="txt_nombre2"  id="txt_nombre2" type="hidden" value="<?= $aDefaultForm['txt_nombre2']; ?>" />
		<input name="txt_nacionalidad"  id="txt_nacionalidad" type="hidden" value="<?= $aDefaultForm['txt_nacionalidad']; ?>" />
		<input name="txt_estatus"  id="txt_estatus" type="hidden" value="<?= $aDefaultForm['txt_estatus']; ?>" />
		<script type="text/javascript" src="validar_rec_pago_registro.js"></script>
		<script>
			function send(saction){
					var form = document.frm_rec_pago_consulta_ano_act;
					form.action.value=saction;
					form.submit();
					$("#loader").show();}
		</script>
<table width="95%" border="0" align="center" class="formulario">
			<tr>
				<th colspan="4" class="separacion_10"></th>
			</tr>
			
			<tr>
				<th colspan="4" class="separacion_10"></th>
			</tr>
</table>

<table width="95%" border="0" align="center" class="formulario">

			<tr>
				<th colspan="7" class="sub_titulo_3" align="center"><div align="center">DISFRUTE DE VACACIONES</div></th>
			</tr>
            <tr>
				<td colspan="7" style="background-color:#F0F0F0;" align="center"> </td>	
			</tr>

		
			<tr>
				<th width="10%"  class="sub_titulo_3"><div align="center">Per&iacute;odo</div></th>
                <th width="10%" class="sub_titulo_3"><div align="center">Fecha Inicio</div></th>
				<th width="10%" class="sub_titulo"><div align="center">Fecha Fin</div></th>
				<th width="15%" class="sub_titulo"><div align="center">D&iacute;as Disfrute</div></th>
                <th width="15%" class="sub_titulo"><div align="center">D&iacute;as Pendientes del Per&iacute;odo</div></th>
                <th width="10%" class="sub_titulo"><div align="center">Fecha de Reintegro</div></th>
                <th width="30%" class="sub_titulo"><div align="center">Observaciones</div></th>
			</tr> 

			<tr>
				<th colspan="7" class="separacion_10"></th>
			</tr>
</table>




<?php 
if($_POST['action']=='consultar'){

	if ($_POST['txt_tipo_trabajador']!='OBRERO'){	
		$query = $_POST['quincena'];
	}else{ 
		$query = $_POST['semana']; 
	}
		
	$sql3="SELECT recibos_pagos_constancias.conceptos.scodigo as cod_concepto,
				  recibos_pagos_constancias.conceptos.ncategoria as categoria,
				  nmonto as monto,nmes,nanio,nsemana_quincena,
				  recibos_pagos_constancias.conceptos.sdescripcion as descripcion_concepto
		    FROM recibos_pagos_constancias.recibo_pago
			inner join recibos_pagos_constancias.conceptos on recibos_pagos_constancias.recibo_pago.conceptos_scodigo = recibos_pagos_constancias.conceptos.scodigo
			where personales_cedula= '".$_SESSION['id_usuario']."' 
			and recibo_pago.nenabled='1'
			and recibo_pago.nanio='".date("Y")."'
			and recibo_pago.nmes='".$_POST['mes']."'
			and recibo_pago.nsemana_quincena='".$query."'
			and recibos_pagos_constancias.conceptos.nenabled='1'
			order by conceptos_scodigo";
	$rs=$conn->Execute($sql3);
	
if($rs->RecordCount()>0){

	$total_no_salarial = $total_deduce = $total_asigna = $inter = 0;
	$no_salarial = '';
	
	$aDefaultForm['txt_cod_concepto']									= $rs->fields['cod_concepto'];
	$aDefaultForm['txt_monto']											= $rs->fields['monto'];
	$aDefaultForm['txt_descripcion_concepto']							= $rs->fields['descripcion_concepto'];
	$aDefaultForm['txt_categoria']								        = $rs->fields['categoria'];
	$aDefaultForm['mes']												= $rs->fields['mes'];
	$aDefaultForm['anio']												= $rs->fields['anio'];
	$aDefaultForm['semana_quincena']									= $rs->fields['semana_quincena'];

	if ($_POST['quincena']==1){
		$escribir= "01/".$_POST['mes']."/"."".date("Y").""." AL 15/".$_POST['mes']."/"."".date("Y").""."";
	}else{
		$escribir= "15/01/"."".date("Y").""." AL 31/01/"."".date("Y")."";
		switch ($_POST['mes'])
		{
			case 1:
				$escribir= "16/01/"."".date("Y").""." AL 31/01/"."".date("Y").""; $meses = "ENERO";
			break;
			case 2:
				$escribir= "16/02/"."".date("Y").""." AL 28/02/"."".date("Y").""; $meses = "FEBRERO";
			break;
			case 3:
				$escribir= "16/03/"."".date("Y").""." AL 31/03/"."".date("Y").""; $meses = "MARZO";
			break;
			case 4:
				$escribir= "16/04/"."".date("Y").""." AL 30/04/"."".date("Y").""; $meses = "ABRIL";
			break;
			case 5:
				$escribir= "16/05/"."".date("Y").""." AL 31/05/"."".date("Y").""; $meses = "MAYO";
			break;
			case 6:
				$escribir= "16/06/"."".date("Y").""." AL 30/06/"."".date("Y").""; $meses = "JUNIO";
			break;
			case 7:
				$escribir= "16/07/"."".date("Y").""." AL 31/07/"."".date("Y").""; $meses = "JULIO";
			break;
			case 8:
				$escribir= "16/08/"."".date("Y").""." AL 31/08/"."".date("Y").""; $meses = "AGOSTO";
			break;
			case 9:
				$escribir= "16/09/"."".date("Y").""." AL 30/09/"."".date("Y").""; $meses = "SEPTIEMBRE";
			break;
			case 10:
				$escribir= "16/10/"."".date("Y").""." AL 31/10/"."".date("Y").""; $meses = "OCTUBRE";
			break;
			case 11:
				$escribir= "16/11/"."".date("Y").""." AL 30/11/"."".date("Y").""; $meses = "NOVIEMBRE";
			break;
			case 12:
				$escribir= "16/12/"."".date("Y").""." AL 31/12/"."".date("Y").""; $meses= "DICIEMBRE";
			break;
		}
	}
	
	/*if ($_POST['quincena']!=''){ 
		$quincenaE = "QUINCENA DEL ".$escribir;
	}else{ 
		$quincenaE = " SEMANA N&deg; ".$_POST['semana']." DEL MES DE ".$meses." DEL A&Ntilde;O "."".date("Y")."";
		
		$aDefaultForm['quincena']=$quincenaE;
		
	}*/
	if ($_POST['quincena']!='') $quincenaE = "QUINCENA DEL ".$escribir;
	else $quincenaE = " SEMANA N&deg; ".$_POST['semana']." DEL MES DE ".$meses." DEL A&Ntilde;O "."".date("Y")."";
	
    $aDefaultForm['quincena']=$quincenaE;
	$_SESSION['recibo_act']=$aDefaultForm;
	
	
?>	

<table width="95%" border="0" align="center" class="formulario" >
    <tr>
         <th class="titulo" colspan="5" align="center"><?=$quincenaE;?></th>
    </tr>
    <tr>
         <th colspan="3" class="sub_titulo" width="50%"><div align="left">CONCEPTOS SALARIALES</div></th>
         <th class="sub_titulo" width="25%"><div align="center">ASIGNACIONES</div></th>
         <th class="sub_titulo" width="25%"><div align="center">DEDUCCIONES</div></th>
    </tr>
<?php

while(!$rs->EOF){ 
	if (($inter%2) == 0) $class_name="dataListColumn2";
	else $class_name="dataListColumn";
	if ($rs->fields['categoria']=='1'){ // asignaciones salariales
	     $monto_asigna = $rs->fields['monto'];
		 $monto_asigna_formato = number_format($monto_asigna, 2, ",", ".");
			print
			//<td align="center">'.$rs->fields['cod_concepto'].'</td>
			'<tr class="'.$class_name.'">					
					<td colspan="3">'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
					<td><div align="center">'.$monto_asigna_formato.'</div></td>
					<td><div align="center">&nbsp;</div></td>
			</tr>';
					$total_asigna = $monto_asigna + $total_asigna;
				 }
				 
		if ($rs->fields['categoria']=='3' and  $rs->fields['cod_concepto']=='1600'){ // Asignaciones no salariales
			$no_salarial .=
			'<tr class="'.$class_name.'">					
					<td colspan="3">'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
					<td><div align="center">'.number_format($rs->fields['monto']-(($rs->fields['monto']*5)/1000), 2, ",", ".").'</div></td>
					<td><div align="center">&nbsp;</div></td>
			</tr>';
		$total_no_salarial = $rs->fields['monto'] + $total_no_salarial;
		}elseif ($rs->fields['categoria']=='3'){ 
			$no_salarial .=
			'<tr class="'.$class_name.'">					
					<td colspan="3">'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
					<td><div align="center">'.number_format($rs->fields['monto'], 2, ",", ".").'</div></td>
					<td><div align="center">&nbsp;</div></td>
			</tr>';}
			
			
		if ($rs->fields['categoria']=='2'){  // deducciones
		$monto_deduce = $rs->fields['monto'];
		$monto_deduce_formato = number_format($monto_deduce, 2, ",", ".");
		print
		//<td align="center">'.$rs->fields['cod_concepto'].'</td>
		'<tr class="'.$class_name.'">
				<td colspan="3">'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
				<td>&nbsp;</td>
				<td align="center">'.$monto_deduce_formato.'</td>
		</tr>';
		      $total_deduce = $monto_deduce + $total_deduce;
	}
	$rs->MoveNext();
	$inter++;
}
	$total_neto = $total_asigna - $total_deduce;
?>
	<tr>
		<th colspan="3" class="titulo1"><div align="right" >TOTALES CONCEPTOS SALARIALES:</div></th>
		<th class="dataListColumn"><div align="center"><b><?=number_format($total_asigna, 2, ",", ".");?></b></div></th>
		<th class="dataListColumn"><div align="center"><b><?=number_format($total_deduce, 2, ",", ".");?></b></div></th>
	</tr>
	
	<tr color="#1060C8">
		<th colspan="3" ><div align="right" >NETO N&Oacute;MINA:</div></th>
		<th class="dataListColumn2" align="center"><b>&nbsp;</b></th>
		<th class="dataListColumn2"><div align="center"><b><?=number_format($total_neto, 2, ",", ".");?></b></div></th>
	</tr>
	
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>

<? if ($no_salarial!=''){ ?>
     <tr>
        <th colspan="3" class="sub_titulo" align="left">CONCEPTOS NO SALARIALES</th>
        <th class="sub_titulo" align="center" width="25%">ASIGNACIONES</th>
        <th class="sub_titulo" align="right">&nbsp;</th>
        <th class="dataListColumn"><div align="center"><b><?=number_format($no_salarial, 2, ",", ".");?></b></div></th>
     </tr>
     <?= $no_salarial;?>
     
     <tr>
       <th colspan="3" class="titulo1"><div align="right" >TOTAL CONCEPTOS NO SALARIALES:</div></th>
       
       <th class="dataListColumn"><b><div align="center"><?=number_format($total_no_salarial, 2, ",", ".");?></div></b></th>
       <th class="dataListColumn" align="center"><b>&nbsp;</b></th>
     </tr>
<? } ?>
<? 
	$_quincena =($aDefaultForm['txt_tipo_trabajador']=='OBRERO')? $_POST['semana'] : $_POST['quincena'];
?>
</table>

<table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center">
			<button type="submit"  class="button_personal btn_imprimir"  formaction="pdf_rec_pago_consulta_ano_act.php?sq=<?=$_quincena?>&mes=<?=$_POST['mes']?>" formtarget="_blank" title="Haga Click para Imprimir el Recibo de Pago">Imprimir</button>
		</td>
	</tr>
</table>
<br />
<?php }else{ ?>
<table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
    <tr>
     <td colspan="5" align="center">NO POSE RECIBO DE PAGO PARA EL MES SELECCIONADO</td>
   </tr>
</table>
<?php } ?>
<?php } ?>
<div id="loader" class="loaders" style="display: none;"></div>

	</form>
	
	</td>
	</tr>
	</tbody>
	</table>
    
    
<?php } ?>	


<?php include("../../footer.php"); ?>