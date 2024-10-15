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
	while($month <= date('m'))
	{
		print '<option value='.$month.' selected="selected">'.$month.'</option>';
		$month++;
	}
}

function nombremes($mes){
        $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000));
         return ucwords($nombre);
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

function doAction($conn){
	if (isset($_POST['action'])){
				switch($_POST["action"]){
				case 'consultar_datos':
						$bValidateSuccess=true;				
					
							
									if ($_POST['cbo_cedulatrabajador']==""){
						$GLOBALS['aPageErrors'][]= "- Debe seleccionar la Nacionalidad.";
						$GLOBALS['ids_elementos_validar'][]='cbo_cedulatrabajador';
						$bValidateSuccess=false;
					}
					if (!preg_match("/^[[:digit:]]{4,8}+$/", trim($_POST['txt_cedula'])) ){ 
						$GLOBALS['aPageErrors'][]= "- El campo Cédula de Identidad debe contener de 4 a 8 d\u00EDgitos";
						$GLOBALS['ids_elementos_validar'][]='txt_cedula';
						$bValidateSuccess=false;
					}
					if ($_POST['txt_cedula']==""){ 
						$GLOBALS['aPageErrors'][]= "- Debe indicar la Cédula de Identidad del trabajador.";
						$GLOBALS['ids_elementos_validar'][]='txt_cedula';
						$bValidateSuccess=false;
					}
					if($bValidateSuccess){
						LoadData($conn,false);					
					}
				break;
				case 'consultar':
						$bValidateSuccess=true;				
					
							if ($_POST['mes']==""){
								$GLOBALS['aPageErrors'][]= "- Debe seleccionar el Mes.";
								$GLOBALS['ids_elementos_validar'][]='mes';
								$bValidateSuccess=false;
							}
						
					if($bValidateSuccess){
						LoadData($conn,false);					
					}
				break;
			}
		}else{
		$_SESSION['mostrar']=0;
		LoadData($conn,false);
	}
 }

function LoadData($conn,$bPostBack){  
	if (count($GLOBALS['aDefaultForm']) == 0){
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
			$aDefaultForm['mes_cb'] = (date('d')>15) ? date('m') : date('m')-1;
		if (!$bPostBack){
			if(isset($_POST['txt_cedula'])){
						$SQL="SELECT personales.cedula as cedula,
						personales.nacionalidad,
						personales.primer_apellido as apellido1,
						personales.segundo_apellido as apellido2,
						personales.primer_nombre as nombre1,
						personales.segundo_nombre as nombre2,
						personales.fecha_ingreso as fecha_ingreso,
						recibo_pago.nestatus as estatus,
						recibo_pago.tipo_trabajador_ncodigo,
						public.tipo_trabajador.sdescripcion as tipo_trabajador,
						recibo_pago.ncodigo_nomina as codigo_nom,
						recibo_pago.scuenta_nomina as cuenta_nom,
						public.cargos.sdescripcion as cargo,
						public.ubicacion_administrativa.sdescripcion as ubicacion_adm,		
						public.ubicacion_fisica.sdescripcion as ubicacion_fisica									
						FROM recibos_pagos_constancias.recibo_pago
						INNER JOIN public.personales on personales.cedula = recibo_pago.personales_cedula
						inner join public.cargos on recibo_pago.cargos_id = cargos.id
						inner join public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo
						inner join public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo
						inner join public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo
						where personales.cedula ='".$_POST['txt_cedula']."' and recibo_pago.nestatus ='1'
						order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC LIMIT 1" ;								
						
					$rs_1=$conn->Execute($SQL);
  				if($rs_1->RecordCount()>0){
				$_SESSION['mostrar']=1;
							$aDefaultForm['txt_cedula']				   					=$rs_1->fields['cedula'];
							$aDefaultForm['txt_nacionalidad']				   					=$rs_1->fields['nacionalidad'];
							
							$aDefaultForm['txt_apellido1']										=$rs_1->fields['apellido1'];
							$aDefaultForm['txt_apellido2']										=$rs_1->fields['apellido2'];
							$aDefaultForm['txt_nombre1']										=$rs_1->fields['nombre1'];
							$aDefaultForm['txt_nombre2']										=$rs_1->fields['nombre2'];
							$aDefaultForm['txt_fecha_ingreso']									=$rs_1->fields['fecha_ingreso'];
							$aDefaultForm['txt_estatus']										=$rs_1->fields['estatus'];
							$aDefaultForm['txt_tipo_trabajador']								=$rs_1->fields['tipo_trabajador'];
							$aDefaultForm['txt_codigo_tipos_trabajadores']    					=$rs_1->fields['codigo_tipos_trabajadores'];			              
							$aDefaultForm['txt_codigo_nom']										=$rs_1->fields['codigo_nom'];
							$aDefaultForm['txt_cuenta_nom']										=$rs_1->fields['cuenta_nom'];																		
							$aDefaultForm['txt_cargo']								  			=$rs_1->fields['cargo'];
							$aDefaultForm['txt_ubicacion_adm']									=$rs_1->fields['ubicacion_adm'];						
							$aDefaultForm['txt_ubicacion_fisica']								=$rs_1->fields['ubicacion_fisica'];
					}			
				}
		   }else{
				  	   $aDefaultForm['txt_cedula']										=$_POST['txt_cedula']	;
					    $aDefaultForm['txt_nacionalidad']										=$_POST['txt_nacionalidad']	;
						$aDefaultForm['txt_apellido1']											=$_POST['txt_apellido1'];
						$aDefaultForm['txt_apellido2']											=$_POST['txt_apellido2'];
						$aDefaultForm['txt_nombre1']											=$_POST['txt_nombre1'];
						$aDefaultForm['txt_nombre2']											=$_POST['txt_nombre2'];
					    $aDefaultForm['txt_fecha_ingreso']										=$_POST['txt_fecha_ingreso'];
						$aDefaultForm['txt_estatus']											=$_POST['txt_estatus'];
						$aDefaultForm['txt_tipo_trabajador']									=$_POST['txt_tipo_trabajador'];
						$aDefaultForm['txt_codigo_tipos_trabajadores']							=$_POST['txt_codigo_tipos_trabajadores'];
						$aDefaultForm['txt_codigo_nom']											=$_POST['txt_codigo_nom'];
						$aDefaultForm['txt_cuenta_nom']											=$_POST['txt_cuenta_nom'];
						$aDefaultForm['txt_cargo']												=$_POST['txt_cargo'];
						$aDefaultForm['txt_ubicacion_adm']										=$_POST['txt_ubicacion_adm'];
						$aDefaultForm['txt_ubicacion_fisica']									=$_POST['txt_ubicacion_fisica'];
						$aDefaultForm['mes_cb']													=$_POST['mes_cb'];
						
		}
	}
	$_SESSION['recibo_act']=$aDefaultForm;
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
        <form name="frm_rec_pago_consulta_anio_act_mensual_cedula" id="frm_rec_pago_consulta_anio_act_mensual_cedula" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
        <input name="action" type="hidden" value="" />
        <input name="txt_tipo_trabajador"  id="txt_tipo_trabajador" type="hidden" value="<?= $aDefaultForm['txt_tipo_trabajador']; ?>" />
        <input name="txt_codigo_tipos_trabajadores"  id="txt_codigo_tipos_trabajadores" type="hidden" value="<?= $aDefaultForm['txt_codigo_tipos_trabajadores']; ?>" />
        <input name="txt_apellido1"  id="txt_apellido1" type="hidden" value="<?= $aDefaultForm['txt_apellido1']; ?>" />
        <input name="txt_apellido2"  id="txt_apellido2" type="hidden" value="<?= $aDefaultForm['txt_apellido2']; ?>" />
        <input name="txt_nombre1"  id="txt_nombre1" type="hidden" value="<?= $aDefaultForm['txt_nombre1']; ?>" />
        <input name="txt_nombre2"  id="txt_nombre2" type="hidden" value="<?= $aDefaultForm['txt_nombre2']; ?>" />
        <input name="txt_nacionalidad"  id="txt_nacionalidad" type="hidden" value="<?= $aDefaultForm['txt_nacionalidad']; ?>" />
        <input name="txt_estatus"  id="txt_estatus" type="hidden" value="<?= $aDefaultForm['txt_estatus']; ?>" />
		<!--<script type="text/javascript" src="validar_rec_pago_registro.js"></script>-->
        <script>
            function send(saction){
                    var form = document.frm_rec_pago_consulta_anio_act_mensual_cedula;
                    form.action.value=saction;
                    form.submit();
                    $("#loader").show();}
        </script>

<table width="95%" border="0" align="center" class="formulario">
     <tr>
		<th colspan="4"  class="sub_titulo"><div align="left">RECIBOS DE PAGOS --> Año Actual --> Mensual por Trabajador</div></th>
     </tr>
        
      	<tr>
				<th colspan="4" class="separacion_10"></th>
			</tr>
<!--        <tr>
			<th class="titulo"  colspan="4" align="center">CONSULTA DE RECIBO DE PAGO MENSUAL DEL AÑO ACTUAL</th>
		</tr>-->
 <table width="65%" border="0" align="center" class="formulario">       
<tr class="identificacion_seccion" >
    <td colspan="2" align="right">C&Eacute;DULA DE IDENTIDAD: 
      <select id="cbo_cedulatrabajador" name="cbo_cedulatrabajador" >
        <option value=""<?php if (!(strcmp('',$aDefaultForm['txt_nacionalidad']))) {echo " selected=\"selected\"";}?>></option>
        <option value="1"<?php if (!(strcmp('1',$aDefaultForm['txt_nacionalidad']))) {echo " selected=\"selected\"";}?>>V-.</option>
        <option value="2"<?php if (!(strcmp('2',$aDefaultForm['txt_nacionalidad']))) {echo " selected=\"selected\"";}?>>E.-</option>
        </select>
      <input name="txt_cedula" id="txt_cedula" type="text"  value="<?= $aDefaultForm['txt_cedula'];?>" title="C&eacute;dula de Identidad - Ingrese s&oacute;lo N&uacute;meros. Acepta 8 Digitos." size="29" maxlength="8" onKeyPress="return isNumberKey(event);" />
      <span>*</span></td>
    <td colspan="2" align="left">
        <button type="button" class="button_personal btn_buscar" onclick="javascript:send('consultar_datos');" title="Haga Click para Buscar">Buscar</button>
    </td>
  </tr>

      		<tr>
				<th colspan="4" class="separacion_10"></th>
			</tr>
  </table>

  <table width="95%" border="0" align="center" class="formulario">
    <tr  style="background-color:#FBF0D2;">
         <th colspan="4" class="separacion_10"></th>
  </tr>
  <? if($_SESSION['mostrar']==1){?>
        <tr class="identificacion_seccion">
      	  <th colspan="4" class="sub_titulo_3" align="left">PERFIL LABORAL</th>
        </tr> 

        <tr>
        	<th colspan="4">&nbsp;</th>		
        </tr>
		<tr>
            <th  colspan="2" class="sub_titulo"><div align="center">C&eacute;dula de Identidad</div></th>
            <th width="22%"class="sub_titulo"><div align="center">Apellido(s)</div></th>
            <th width="27%" class="sub_titulo"><div align="center">Nombre(s)</div></th>
            
        </tr>
		<tr>
             <td colspan="2" style="background-color:#F0F0F0;" align="center"><font color="#666666"><? if($aDefaultForm['txt_nacionalidad']=='1')$nacio='V.-'; else $nacio='E.-'; echo $nacio.$aDefaultForm['txt_cedula'];?> </font></td>
           <td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?=$aDefaultForm['txt_apellido1'].' '.$aDefaultForm['txt_apellido2']?></font></td>
            <td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?=$aDefaultForm['txt_nombre1'].' '.$aDefaultForm['txt_nombre2']?></font></td>
            
        </tr> 
 <tr>
        	<th colspan="4">&nbsp;</th>		
        </tr>
        <tr>
            <th width="24%" class="sub_titulo"><div align="center">Estatus</div></th>
            <th width="27%" class="sub_titulo"><div align="center">Fecha de Ingreso</div></th>
            <th width="22%" class="sub_titulo"><div align="center">Tipo de Trabajador</div></th>
            <th width="27%" class="sub_titulo"><div align="center">C&oacute;digo de N&oacute;mina</div></th>
        </tr> 

        <tr>
            <td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?php if($aDefaultForm['txt_estatus']==1){
            echo 'ACTIVO';
            }else{
            echo 'EGRESADO';
            }
            ?></font>
            </td>
            <td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['txt_fecha_ingreso']));?></font></td> 
            <td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_tipo_trabajador'];?></font></td>
            <td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_codigo_nom'];?></font></td>
        </tr>  

        <tr>
        	<td colspan="4"> </td>
        </tr>

        <tr>
            <th class="sub_titulo"><div align="center">Cuenta N&oacute;mina</div></th>
            <th colspan="3" class="sub_titulo"><div align="center">Cargo</div></th>
        </tr> 
        
        <tr>    
            <td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_cuenta_nom'];?></font></td>
            <td colspan="3" style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_cargo'];?></font></td>
        </tr> 

        <tr>
       		 <td colspan="4"> </td>
        </tr>
        
        <tr>
        	<th colspan="4" class="sub_titulo"><div align="center">Ubicaci&oacute;n Administrativa</div></th>
        </tr>
        
        <tr>
        	<td colspan="4" style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_ubicacion_adm'];?></font></td>
        </tr>
        
        <tr>
        	<td colspan="4"> </td>
        </tr>

        <tr>
        	<th colspan="4" class="sub_titulo"><div align="center">Ubicaci&oacute;n F&iacute;sica</div></th>
        </tr>
        
        <tr>
        	<td colspan="4" style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_ubicacion_fisica'];?></font></td>	
        </tr>
        
        <tr>
        	<th colspan="4" class="separacion_10"></th>
        </tr>
        
        <tr>
       		<th colspan="4" class="separacion_10"></th>
        </tr>
        
        <tr align=left>
            <td></td>
            <th colspan="2" class="sub_titulo"><div align="center">MES A CONSULTAR</div></th>
            <td></td>
        </tr>

        <tr>
       		<th colspan="4">&nbsp;</th>		
        </tr>

        <tr align=left>
            <td></td>
            <td colspan="2" align="center"><font color="#666666">
            <select name="mes" class="textbox" id="mes">
            <option value="0" selected="selected">Seleccione</option>
            <? loadMes_cb() ; print $GLOBALS['sHtml_mes_cb']; ?>
            </select></font>
            </td>
        </tr>

        <tr>
       		<th colspan="4" class="separacion_bottom_10"></th>
        </tr>
        
        <tr>
            <td colspan="5" align="center">
          	  <button type="button" class="button_personal btn_buscar" onclick="javascript:send('consultar');" title="Haga Click para buscar">Buscar</button> 
            </td>
        </tr>
  
        <tr>
    	    <th colspan="4" class="separacion_bottom_10"></th>
        </tr>
		    <? 
   }//fin de mostrar
   ?>
</table>
   </table>
  <!-- PARTE 2-->
	<?php if ($_POST['mes']!=='') $escribir= "01/".$_POST['mes']."/".date('Y')." AL 15/".$_POST['mes']."/".date('Y')."";
	else
	//{
	$escribir= "15/01/".date('Y')." AL 31/01/".date('Y');
		switch ($_POST['mes'])
		{
			case 1:
				$escribir= "16/01/".date('Y')." AL 31/01/".date('Y'); $meses = "ENERO";
			break;
			case 2:
				$escribir= "16/02/".date('Y')." AL 28/02/".date('Y'); $meses = "FEBRERO";
			break;
			case 3:
				$escribir= "16/03/".date('Y')." AL 31/03/".date('Y'); $meses = "MARZO";
			break;
			case 4:
				$escribir= "16/04/".date('Y')." AL 30/04/".date('Y'); $meses = "ABRIL";
			break;
			case 5:
				$escribir= "16/05/".date('Y')." AL 31/05/".date('Y'); $meses = "MAYO";
			break;
			case 6:
				$escribir= "16/06/".date('Y')." AL 30/06/".date('Y'); $meses = "JUNIO";
			break;
			case 7:
				$escribir= "16/07/".date('Y')." AL 31/07/".date('Y'); $meses = "JULIO";
			break;
			case 8:
				$escribir= "16/08/".date('Y')." AL 31/08/".date('Y'); $meses = "AGOSTO";
			break;
			case 9:
				$escribir= "16/09/".date('Y')." AL 30/09/".date('Y'); $meses = "SEPTIEMBRE";
			break;
			case 10:
				$escribir= "16/10/".date('Y')." AL 31/10/".date('Y'); $meses = "OCTUBRE";
			break;
			case 11:
				$escribir= "16/11/".date('Y')." AL 30/11/".date('Y'); $meses = "NOVIEMBRE";
			break;
			case 12:
				$escribir= "16/12/".date('Y')." AL 31/12/".date('Y'); $meses= "DICIEMBRE";
			break;
		}
	//}
	if ($_POST['quincena']!='') $quincenaE = "QUINCENA DEL ".$escribir;
	else $quincenaE = $meses." DEL A&Ntilde;O ".date('Y');
$aDefaultForm['quincena']=$quincenaE;
if($_POST['action']=='consultar'){
?>

<table width="95%" border="0" align="center" class="formulario" cellpadding="5" cellspacing="1">
        <tr>
        	<th class="titulo" colspan="5" align="center"><?=$quincenaE;?></th>
        </tr>
        
        <tr>
            <th colspan="3" class="sub_titulo" align="left" width="50%">CONCEPTOS SALARIALES</th>
            <th class="sub_titulo" width="25%"><div align="right">ASIGNACIONES</div></th>
            <th class="sub_titulo" width="25%"><div align="right">DEDUCCIONES</div></th>
        </tr>
     <?php
$total_no_salarial = $total_deduce = $total_asigna = $inter = 0;
$no_salarial = '';
if ($_POST['txt_tipo_trabajador']!='OBRERO')	  $query = $_POST['quincena'];
	else $query = $_POST['semana'];
	$sql3="SELECT recibos_pagos_constancias.conceptos.scodigo as cod_concepto,
			recibos_pagos_constancias.conceptos.ncategoria as categoria,
			sum(nmonto) as monto,
			nmes,
			nanio,
			recibos_pagos_constancias.conceptos.sdescripcion as descripcion_concepto
			FROM recibos_pagos_constancias.recibo_pago
			inner join recibos_pagos_constancias.conceptos on recibos_pagos_constancias.recibo_pago.conceptos_scodigo = recibos_pagos_constancias.conceptos.scodigo
			where personales_cedula= '".$_POST['txt_cedula']."' 
			and recibo_pago.nestatus ='1'
			and recibo_pago.nenabled='1'
			and recibo_pago.nanio='".date('Y')."'
			and recibo_pago.nmes='".$_POST['mes']."'
			and recibos_pagos_constancias.conceptos.nenabled='1'
			Group by cod_concepto, nmes, nanio, recibo_pago.conceptos_scodigo
			order by conceptos_scodigo";
			$rs=$conn->Execute($sql3);
			if($rs->RecordCount()>0){
				$aDefaultForm['txt_cod_concepto']									=$rs->fields['cod_concepto'];
				$aDefaultForm['txt_monto']											=$rs->fields['monto'];
				$aDefaultForm['txt_descripcion_concepto']							=$rs->fields['descripcion_concepto'];
				$aDefaultForm['txt_categoria']								        =$rs->fields['categoria'];
				$aDefaultForm['mes']												=$rs->fields['mes'];
				$aDefaultForm['anio']												=$rs->fields['anio'];
				$aDefaultForm['semana_quincena']									=$rs->fields['semana_quincena'];
			}
$_SESSION['recibo_act_concepto']=&$aDefaultForm;

while(!$rs->EOF){
	if (($inter%2) == 0) $class_name="dataListColumn2";
	else $class_name="dataListColumn";
	if ($rs->fields['categoria']=='1'){ // asignaciones salariales
	     $monto_asigna = $rs->fields['monto'];
		 $monto_asigna_formato = number_format($monto_asigna, 2, ",", ".");
			print
			'<tr class="'.$class_name.'">					
					<td colspan="3">'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
					<td><div align="right">'.$monto_asigna_formato.'</div></td>
					<td><div align="right">&nbsp;</div></td>
			</tr>';
					$total_asigna = $monto_asigna + $total_asigna;
				 }
				 
		if ($rs->fields['categoria']=='3'){ // Asignaciones no salariales
			$no_salarial .=
			'<tr class="'.$class_name.'">					
					<td colspan="3">'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
					<td><div align="right">'.$monto_asigna_formato.'</div></td>
					<td><div align="right">&nbsp;</div></td>
			</tr>';
				$total_no_salarial = $rs->fields['monto'] + $total_no_salarial;
			}
				
		if ($rs->fields['categoria']=='2'){
		$monto_deduce = $rs->fields['monto'];
		$monto_deduce_formato = number_format($monto_deduce, 2, ",", ".");
		print
		'<tr class="'.$class_name.'">
				<td colspan="3">'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
				<td>&nbsp;</td>
				<td align="right">'.$monto_deduce_formato.'</td>
		</tr>';
		      $total_deduce = $monto_deduce + $total_deduce;
	}
	$rs->MoveNext();
	$inter++;
}
	$total_neto = $total_asigna - $total_deduce;
?>
        <tr>
            <th colspan="3" align="right" class="titulo1">TOTALES CONCEPTOS SALARIALES:</th>
            <th class="dataListColumn"><b><div align="right"><?=number_format($total_asigna, 2, ",", ".");?></div></b></th>
            <th class="dataListColumn"><b><div align="right"><?=number_format($total_deduce, 2, ",", ".");?></div></b></th>
        </tr>
        
        <tr color="#1060C8">
            <th colspan="3" align="right" >NETO N&Oacute;MINA:</th>
            <th class="dataListColumn2" align="center"><b>&nbsp;</b></th>
            <th class="dataListColumn2"><b><div align="right"><?=number_format($total_neto, 2, ",", ".");?></div></b></th>
        </tr>
        
        <tr>
       		<td colspan="5">&nbsp;</td>
        </tr>
        
        <tr>
        	<td colspan="5">&nbsp;</td>
        </tr>
<? if ($no_salarial!=''){
?>
        <tr>
            <th colspan="3" class="sub_titulo" align="left">CONCEPTOS NO SALARIALES</th>
            <th class="sub_titulo" align="right" width="25%">ASIGNACIONES</th>
            <th class="sub_titulo" align="right">&nbsp;</th>
        </tr>
        <?=$no_salarial;?>
        <tr>
            <th colspan="3" align="right" class="titulo1">TOTAL CONCEPTOS NO SALARIALES:</th>
            <th class="dataListColumn" align="right"><b><?=number_format($total_no_salarial, 2, ",", ".");?></b></th>
            <th class="dataListColumn" align="right"><b>&nbsp;</b></th>
        </tr>
  <? } 
  
 $_quincena =($aDefaultForm['txt_tipo_trabajador']=='OBRERO')? $_POST['semana'] : $_POST['quincena'];
  ?>
  
</table>

<table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="5" align="center">
            <button type="submit"  class="button_personal btn_imprimir"  formaction="pdf_rec_pago_consulta_ano_act_mens_ced.php?sq=&mes=<?=$_POST['mes']?>" formtarget="_blank" title="Haga Click para Imprimir el Recibo de Pago">Imprimir</button>
            </td>
        </tr>
</table>
<div id="loader" class="loaders" style="display: none;"></div>
   <? } 
  
   ?>    
  <!--FIN PARTE 2-->
</form>

	</td>
	</tr>
	</tbody>
	</table>
 
<?php } ?>	

<?php include("../../footer.php"); ?>