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
	while($anio < date('Y'))
	{
		print '<option value='.$anio.'>'.$anio.'</option>';
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
							
						if ($_POST['txt_tipo_trabajador']!='OBREROS FIJOS')  $query = $_POST['quincena'];
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

//-----------------------------------------------------------------------------//
function LoadData($conn,$bPostBack){
	if (count($GLOBALS['aDefaultForm']) == 0){
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
					if(isset($_SESSION['id_usuario'])){
					$SQL="SELECT personales.cedula as cedula, 
						personales.nacionalidad as nacionalidad, 
						personales.primer_apellido as apellido1, 
						personales.segundo_apellido as apellido2, 
						personales.primer_nombre as nombre1, 
						personales.segundo_nombre as nombre2, 
						personales.fecha_ingreso as fecha_ingreso, 
						recibo_pago.nestatus as estatus,
						recibo_pago.tipo_trabajador_ncodigo,
						recibo_pago.scuenta_nomina as cuenta_nom,
						public.cargos.sdescripcion as cargo,
						public.tipo_trabajador.sdescripcion_anterior_al10102013  as tipo_trabajador,
						recibo_pago.ncodigo_nomina as codigo_nom,
						public.ubicacion_administrativa.sdescripcion as ubicacion_adm,		
						public.ubicacion_fisica.sdescripcion as ubicacion_fisica
						FROM recibos_pagos_constancias.recibo_pago
						INNER JOIN public.personales on personales.cedula = recibo_pago.personales_cedula
						inner join public.cargos on recibo_pago.cargos_id = cargos.id
						inner join public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo
						inner join public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo
						inner join public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo
						where personales.cedula ='".$_SESSION['id_usuario']."' and recibo_pago.nestatus ='1'
						order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC LIMIT 1" ;								
						
					$rs_1=$conn->Execute($SQL);
					if($rs_1->RecordCount()>0){
							$aDefaultForm['txt_nacionalidad']				   					=$rs_1->fields['nacionalidad'];
							$aDefaultForm['txt_apellido1']										=$rs_1->fields['apellido1'];
							$aDefaultForm['txt_apellido2']										=$rs_1->fields['apellido2'];
							$aDefaultForm['txt_nombre1']										=$rs_1->fields['nombre1'];
							$aDefaultForm['txt_nombre2']										=$rs_1->fields['nombre2'];
							$aDefaultForm['txt_fecha_ingreso']									=$rs_1->fields['fecha_ingreso'];
							$aDefaultForm['txt_estatus']										=$rs_1->fields['estatus'];
							$aDefaultForm['txt_tipo_trabajador']								=$rs_1->fields['tipo_trabajador'];
						    $aDefaultForm['txt_codigo_tipos_trabajadores']    				        =$rs_1->fields['codigo_tipos_trabajadores'];
							$aDefaultForm['txt_codigo_nom']										=$rs_1->fields['codigo_nom'];
							$aDefaultForm['txt_cuenta_nom']										=$rs_1->fields['cuenta_nom'];																		
							$aDefaultForm['txt_cargo']								  			=$rs_1->fields['cargo'];
							$aDefaultForm['txt_ubicacion_adm']									=$rs_1->fields['ubicacion_adm'];						
							$aDefaultForm['txt_ubicacion_fisica']								=$rs_1->fields['ubicacion_fisica'];
					}			
				}
		if (!$bPostBack){
			if(isset($_SESSION['id_usuario'])){
						$SQL="SELECT personales.cedula as cedula,
							personales.nacionalidad as nacionalidad,
							personales.primer_apellido as apellido1,
							personales.segundo_apellido as apellido2,
							personales.primer_nombre as nombre1,
							personales.segundo_nombre as nombre2,
							personales.fecha_ingreso as fecha_ingreso,
							historico_recibo_pago.nestatus as estatus,
							historico_recibo_pago.tipo_trabajador_ncodigo,
							public.tipo_trabajador.sdescripcion_anterior_al10102013  as tipo_trabajador,
							historico_recibo_pago.ncodigo_nomina as codigo_nom,
							historico_recibo_pago.scuenta_nomina as cuenta_nom,
							public.cargos.sdescripcion as cargo,
							public.ubicacion_administrativa.sdescripcion as ubicacion_adm,		
							public.ubicacion_fisica.sdescripcion as ubicacion_fisica									
							FROM recibos_pagos_constancias.historico_recibo_pago
							INNER JOIN public.personales on personales.cedula = historico_recibo_pago.personales_cedula
							inner join public.cargos on historico_recibo_pago.cargos_id = cargos.id
							inner join public.tipo_trabajador on historico_recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo
							inner join public.ubicacion_administrativa on historico_recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo
							inner join public.ubicacion_fisica on historico_recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo
							where personales.cedula =".$_SESSION['id_usuario']." and historico_recibo_pago.nestatus ='1'
							order by recibos_pagos_constancias.historico_recibo_pago.dfecha_creacion DESC LIMIT 1 " ;								
		
				   $rs_1=$conn->Execute($SQL);				
				if($rs_1->RecordCount()>0){
							$aDefaultForm['txt_nacionalidad']				   					=$rs_1->fields['nacionalidad'];
							$aDefaultForm['txt_apellido1']										=$rs_1->fields['apellido1'];
							$aDefaultForm['txt_apellido2']										=$rs_1->fields['apellido2'];
							$aDefaultForm['txt_nombre1']										=$rs_1->fields['nombre1'];
							$aDefaultForm['txt_nombre2']										=$rs_1->fields['nombre2'];
							$aDefaultForm['txt_fecha_ingreso']									=$rs_1->fields['fecha_ingreso'];
							$aDefaultForm['txt_estatus']										=$rs_1->fields['estatus'];
							$aDefaultForm['txt_tipo_trabajador']								=$rs_1->fields['tipo_trabajador'];
							$aDefaultForm['txt_codigo_tipos_trabajadores']						=$rs_1->fields['codigo_tipos_trabajadores'];										             				                            $aDefaultForm['txt_codigo_nom']										=$rs_1->fields['codigo_nom'];
							$aDefaultForm['txt_cuenta_nom']										=$rs_1->fields['cuenta_nom'];																		
							$aDefaultForm['txt_cargo']								  			=$rs_1->fields['cargo'];
							$aDefaultForm['txt_ubicacion_adm']									=$rs_1->fields['ubicacion_adm'];						
							$aDefaultForm['txt_ubicacion_fisica']								=$rs_1->fields['ubicacion_fisica'];
					}			
				}
		   }else{
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
						$aDefaultForm['quincena_cb']								    		=$_POST['quincena_cb'];
						$aDefaultForm['mes_cb']													=$_POST['mes_cb'];
						
						
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
<form name="frm_rec_pago_consulta_ano_anteriores" id="frm_rec_pago_consulta_ano_anteriores" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<input name="action" type="hidden" value="" />
<input name="txt_tipo_trabajador"  id="txt_tipo_trabajador" type="hidden" value="<?= $aDefaultForm['txt_tipo_trabajador']; ?>" />
<input name="txt_codigo_tipos_trabajadores"  id="txt_codigo_tipos_trabajadores" type="hidden" value="<?= $aDefaultForm['txt_codigo_tipos_trabajadores']; ?>" />
<script type="text/javascript" src="validar_rec_pago_registro.js"></script>
<script>
	function send(saction){
		    var form = document.frm_rec_pago_consulta_ano_anteriores;
			form.action.value=saction;
			form.submit();
			$("#loader").show();}
</script>

<table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">

		 <tr>
		  <th colspan="4"  class="sub_titulo"><div align="left">RECIBOS DE PAGOS --> Año Anteriores --> Semanal / Quincenal </div></th>
        </tr>
		<tr>
       		  <th colspan="4"  class="titulo" align="center"> </th>
        </tr>
		<tr>
          <td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
      </tr>
	     <tr>
       		  <th colspan="4"  class="titulo" align="center"> </th>
        </tr>

			<tr class="identificacion_seccion">
				<th colspan="4" class="sub_titulo_2" align="left">PERFIL LABORAL</th>
			</tr> 
		
			<tr>
				<th colspan="4">&nbsp;</th>		
			</tr>
		
        <tr>
            <th class="sub_titulo"><div align="center">Estatus</div></th>
            <th class="sub_titulo"><div align="center">Fecha de Ingreso</div></th>
            <th class="sub_titulo"><div align="center">Tipo de Trabajador</div></th>
            <th class="sub_titulo"><div align="center">C&oacute;digo de N&oacute;mina</div></th>
        </tr> 

        <tr>
            <td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?php if($aDefaultForm['txt_estatus']==1){
            echo 'ACTIVO';
            }else{
            echo 'EGRESADO';
            }
            ?></font></td>
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
       		<td colspan="4" style="background-color:#F0F0F0;"align="center"><font color="#666666"><?= $aDefaultForm['txt_ubicacion_adm'];?></font></td>
        </tr>

        <tr>
        	<td colspan="4"> </td>
        </tr>

        <tr>
       		<th colspan="4" class="sub_titulo" align="center"><div align="center">Ubicaci&oacute;n F&iacute;sica</div></th>
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

        <tr>
       		<th colspan="4">&nbsp;</th>		
        </tr>

        <tr>
       		<th colspan="4" class="sub_titulo_2"><div align="center">PERIODO A CONSULTAR</div></th>
        </tr>

        <tr>
       		<th colspan="4">&nbsp;</th>		
        </tr>

        <tr align=left >
            <th width="27%" class="sub_titulo"><div align="center">A&ntilde;o</div></th>
            <th width="26%" class="sub_titulo"><div align="center">Mes</div></th>
            <th colspan="2" align="center" class="sub_titulo"><div align="center">
            <?php if($aDefaultForm['txt_codigo_tipos_trabajadores']!='OBREROS FIJOS'){
            echo 'Quincena';
            }else{
            echo 'Semana';
            }
            ?>
            </div></th>
        </tr>

		<tr align=left>
            <td class="dataListColumn3"><font color="#666666"><div align="center">
                <select name="anio" class="textbox" id="anio">
                <option value="" selected="selected" >Seleccione</option>
                <? LoadListyear(date('Y')-2);?>
                </select><span class="requerido"> * </span></div></font>
            </td>
            <td class="dataListColumn3"><font color="#666666"><div align="center">
                <select name="mes" class="textbox" id="mes">
                <option value="0" selected="selected">Seleccione</option>
                <? loadMes_cb() ; print $GLOBALS['sHtml_mes_cb']; ?>
                </select><span class="requerido"> * </span></div></font>
            </td>
            <?
            if ($aDefaultForm['txt_tipo_trabajador']!='OBREROS FIJOS'){
            ?>
            <td class="dataListColumn3"><font color="#666666"><div align="center">
                <select name="quincena" class="textbox" id="quincena">
                <option value="" selected="selected">Seleccione</option>
                <? loadQuinc_cb() ; print $GLOBALS['sHtml_quincena_cb']; ?>
                </select><span class="requerido"> * </span></div></font>
            </td>
            <?
            }
            else{
            ?>
            <td class="dataListColumn3"><div align="center">
                <select name="semana" class="textbox" id="semana">
                <option value="" selected="selected">Seleccione</option>
                <? loadSemana_cb() ; print $GLOBALS['sHtml_semana_cb']; ?>
                </select><span class="requerido"> * </span>
                </div>
            </td>
        </tr>
  <?php
	}
	?>
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
</table>
 <!-- PARTE 2-->
	<?php if ($_POST['quincena']==1) $escribir= "01/".$_POST['mes']."/".$_POST['anio']." AL 15/".$_POST['mes']."/".$_POST['anio']."";
	else
	{
	$escribir= "15/01/".$_POST['anio']." AL 31/01/".$_POST['anio'];
		switch ($_POST['mes'])
		{
			case 1:                          
				$escribir= "16/01/".$_POST['anio']." AL 31/01/".$_POST['anio']; $meses = "ENERO";
			break;
			case 2:
				$escribir= "16/02/".$_POST['anio']." AL 28/02/".$_POST['anio']; $meses = "FEBRERO";
			break;
			case 3:
				$escribir= "16/03/".$_POST['anio']." AL 31/03/".$_POST['anio']; $meses = "MARZO";
			break;
			case 4:
				$escribir= "16/04/".$_POST['anio']." AL 30/04/".$_POST['anio']; $meses = "ABRIL";
			break;
			case 5:
				$escribir= "16/05/".$_POST['anio']." AL 31/05/".$_POST['anio']; $meses = "MAYO";
			break;
			case 6:
				$escribir= "16/06/".$_POST['anio']." AL 30/06/".$_POST['anio']; $meses = "JUNIO";
			break;
			case 7:
				$escribir= "16/07/".$_POST['anio']." AL 31/07/".$_POST['anio']; $meses = "JULIO";
			break;
			case 8:
				$escribir= "16/08/".$_POST['anio']." AL 31/08/".$_POST['anio']; $meses = "AGOSTO";
			break;
			case 9:
				$escribir= "16/09/".$_POST['anio']." AL 30/09/".$_POST['anio']; $meses = "SEPTIEMBRE";
			break;
			case 10:
				$escribir= "16/10/".$_POST['anio']." AL 31/10/".$_POST['anio']; $meses = "OCTUBRE";
			break;
			case 11:
				$escribir= "16/11/".$_POST['anio']." AL 30/11/".$_POST['anio']; $meses = "NOVIEMBRE";
			break;
			case 12:
				$escribir= "16/12/".$_POST['anio']." AL 31/12/".$_POST['anio']; $meses= "DICIEMBRE";
			break;
		}
	}
	if ($_POST['quincena']!='') $quincenaE = "QUINCENA DEL ".$escribir;
	else $quincenaE = " SEMANA N&deg; ".$_POST['semana']." DEL MES DE ".$meses." DEL A&Ntilde;O ".$_POST['anio']."";
	
$aDefaultForm['quincena']=$quincenaE;

if($_POST['action']=='consultar'){
?>
<table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
       		 <th class="titulo" colspan="5" align="center"><?=$quincenaE;?></th>
        </tr>
        
        <tr>
            <th colspan="3" class="sub_titulo" align="left">CONCEPTOS SALARIALES</th>
            <th class="sub_titulo"><div align="right">ASIGNACIONES</div></th>
            <th class="sub_titulo"><div align="right">DEDUCCIONES</div></th>
        </tr>
     <?php
$total_no_salarial = $total_deduce = $total_asigna = $inter = 0;
$no_salarial = '';
		if ($_POST['txt_tipo_trabajador']!='OBREROS FIJOS')	  $query = $_POST['quincena'];
		else $query = $_POST['semana'];									
		$sql3="SELECT 
				recibos_pagos_constancias.conceptos.scodigo as cod_concepto,
				recibos_pagos_constancias.conceptos.ncategoria as categoria,
				nmonto as monto,nmes,nanio,nsemana_quincena,
				recibos_pagos_constancias.conceptos.sdescripcion as descripcion_concepto
				FROM recibos_pagos_constancias.historico_recibo_pago
				inner join recibos_pagos_constancias.conceptos on recibos_pagos_constancias.historico_recibo_pago.conceptos_scodigo = recibos_pagos_constancias.conceptos.scodigo
				where personales_cedula= '".$_SESSION['id_usuario']."'
				and historico_recibo_pago.nenabled='1'     
				and historico_recibo_pago.nanio='".$_POST['anio']."'
				and historico_recibo_pago.nmes='".$_POST['mes']."'
				and historico_recibo_pago.nsemana_quincena='".$query."'
				and recibos_pagos_constancias.conceptos.nenabled='1'
				order by conceptos_scodigo";	
						$rs=$conn->Execute($sql3);
						if($rs->RecordCount()>0){
							$aDefaultForm['txt_cod_concepto']					=$rs->fields['cod_concepto'];
							$aDefaultForm['txt_monto']							=$rs->fields['monto'];
							$aDefaultForm['txt_descripcion_concepto']			=$rs->fields['descripcion_concepto'];
							$aDefaultForm['txt_descripcion_concepto']			=$rs->fields['categoria'];
							$aDefaultForm['mes']								=$rs->fields['mes'];
							$aDefaultForm['anio']								=$rs->fields['anio'];
							$aDefaultForm['semana_quincena']					=$rs->fields['semana_quincena'];
						}
$_SESSION['recibo_act']=$aDefaultForm;

while(!$rs->EOF){
	if (($inter%2) == 0) $class_name="dataListColumn2";
	else $class_name="dataListColumn";
if ($rs->fields['categoria']=='1'){ // asignaciones salariales
	     $monto_asigna = $rs->fields['monto'];
		 $monto_asigna_formato = number_format($monto_asigna, 2, ",", ".");
			print
			'<tr class="'.$class_name.'">					  
					<td colspan="3">'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
					<td><div align="center">'.$monto_asigna_formato.'</div></td>
					<td><div align="center">&nbsp;</div></td>
			</tr>';
					$total_asigna = $monto_asigna + $total_asigna;
				 }
	if ($rs->fields['categoria']=='3'){ // Asignaciones no salariales
			$no_salarial .=
			'<tr class="'.$class_name.'">
					<td colspan="3">'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
					<td><div align="center">'.number_format($rs->fields['monto'], 2, ",", ".").'</div></td>
					<td><div align="center">&nbsp;</div></td>
			</tr>';
				$total_no_salarial = $rs->fields['monto'] + $total_no_salarial;
			}
	if ($rs->fields['categoria']=='2'){
		$monto_deduce = $rs->fields['monto'];
		print
		'<tr class="'.$class_name.'">
				<td colspan="3">'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
				<td>&nbsp;</td>
				<td align="center">'.number_format($monto_deduce, 2, ",", ".").'</td>
		</tr>';
		      $total_deduce = $monto_deduce + $total_deduce;
	}
	$rs->MoveNext();
	$inter++;
}
	$total_neto = $total_asigna - $total_deduce;
?>
        <tr>
            <th colspan="3" class="titulo"><div align="right">TOTALES CONCEPTOS SALARIALES:</div></th>
            <th class="dataListColumn" ><div align="right"><b><?=number_format($total_asigna, 2, ",", ".");?></b></div></th>
            <th class="dataListColumn" ><div align="right"><b><?=number_format($total_deduce, 2, ",", ".");?></b></div></th>
        </tr>
        
        <tr color="#1060C8">
            <th colspan="3" align="right" class="titulo"><div align="right">NETO N&Oacute;MINA:</div></th>
            <th class="dataListColumn2" >&nbsp;</th>
            <th class="dataListColumn2" ><div align="right"><b><?=number_format($total_neto, 2, ",", ".");?></b></div></th>
        </tr>
<? if ($no_salarial!=''){
?>
        <tr>
            <th colspan="3" class="sub_titulo" align="left">CONCEPTOS NO SALARIALES</th>
            <th class="sub_titulo"><div align="right">ASIGNACIONES</div></th>
            <th class="sub_titulo">&nbsp;</th>
        </tr>
        <?=$no_salarial;?>
        <tr>
            <th colspan="3" align="right" class="titulo"><div align="right">TOTAL CONCEPTOS NO SALARIALES</div></th>
            <th  class="titulo"><div align="right"><?=number_format($total_no_salarial, 2, ",", ".");?></div></th>
            <th>&nbsp;</th>
        </tr>
  <? } 
   $_quincena =($aDefaultForm['txt_tipo_trabajador']=='OBREROS FIJOS')? $_POST['semana'] : $_POST['quincena'];  
  ?>
</table>

<table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
     <td colspan="5" align="center">
        <button type="submit"  class="button_personal btn_imprimir"  formaction="pdf_rec_pago_consulta_ano_anteriores.php?sq=<?=$_quincena?>&mes=<?=$_POST['mes']?>&anio=<?=$_POST['anio']?>" formtarget="_blank" title="Haga Click para Imprimir el Recibo de Pago">Imprimir</button>
       
       </td>
   </tr>
</table>
<div id="loader" class="loaders" style="display: none;"></div>

   <? } ?>  
</form>
 	</td>
	 </tr>
	</tbody>
	</table>
    
<?php } ?>	
<?php include("../../footer.php"); ?>