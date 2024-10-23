<?php 
include("../../header.php"); 

$settings['debug'] = false;
$conn2 = &ADONewConnection($target);
//$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh_produccion2');
$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh');
$conn2->debug = false;

//echo $hostname_sigefirrhh;

$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();

debug();
LoadData(true);
doAction($conn2);
showForm($conn2,$aDefaultForm);

function doAction($conn2){
	$GLOBALS['mostrar'] = '';
//------------------------------------------------------------------------------------------
		if (isset($_POST['action'])){
			switch($_POST['action']){ 						
//------------------------------------------------------------------------------------------				
				case 'buscar_persona':
					
					$GLOBALS['aDefaultForm'] = '';
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
					
					if($bValidateSuccess){
						$aDefaultForm = &$GLOBALS['aDefaultForm'];
						
						$SQL="SELECT personal.id_personal,
									personal.primer_apellido as apellido1,
									personal.segundo_apellido as apellido2,
									personal.primer_nombre as nombre1,
									personal.segundo_nombre as nombre2, 
									personal.nacionalidad,
									personal.cedula as cedula, 
									trabajador.fecha_ingreso as fecha_ingreso,
									trabajador.estatus as estatus,
									trabajador.codigo_nomina as cod_nom,
									trabajador.cuenta_nomina as cuenta_nom,
									cargo.descripcion_cargo as cargo,
									dependencia.nombre as  ubicacion_adm,
									tipopersonal.nombre as tipo_trabajador
									FROM trabajador
									INNER JOIN personal on personal.id_personal = trabajador.id_personal
									INNER JOIN tipopersonal on tipopersonal.cod_tipo_personal = trabajador.cod_tipo_personal
									inner join cargo on trabajador.id_cargo = cargo.id_cargo
									inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia 
									WHERE personal.cedula='".$_POST['txt_cedula']."'";
						$rs_1=$conn2->Execute($SQL);
						
						if($rs_1->RecordCount()>0){
							$aDefaultForm['txt_cedula']					=$rs_1->fields['cedula'];
							$aDefaultForm['txt_apellido1']				=$rs_1->fields['apellido1'];
							$aDefaultForm['txt_apellido2']				=$rs_1->fields['apellido2'];
							$aDefaultForm['txt_nombre1']				=$rs_1->fields['nombre1'];
							$aDefaultForm['txt_nombre2']				=$rs_1->fields['nombre2'];
							$aDefaultForm['txt_nacionalidad']			=$rs_1->fields['nacionalidad'];
							$aDefaultForm['txt_fecha_ingreso']			=$rs_1->fields['fecha_ingreso'];	
							$aDefaultForm['txt_estatus']				=$rs_1->fields['estatus'];	
							$aDefaultForm['txt_cod_nom']		   		=$rs_1->fields['cod_nom'];
							$aDefaultForm['txt_cuenta_nom']				=$rs_1->fields['cuenta_nom'];	
							$aDefaultForm['txt_cargo']		            =$rs_1->fields['cargo'];
							$aDefaultForm['txt_ubicacion_adm']			=$rs_1->fields['ubicacion_adm'];							
							$aDefaultForm['txt_tipo_trabajador']		=$rs_1->fields['tipo_trabajador'];	
							$aDefaultForm['cbo_cedulatrabajador']       =$_POST['cbo_cedulatrabajador'];

							$_SESSION['recibo_act']=$aDefaultForm;
							$GLOBALS['mostrar'] = 1;
						}						
					}
			}
		}//------------------------------------------------------------------------------------------
}
//-----------------------------------------------------------------------------//
function LoadData($bPostBack){  
}

?>


<?php function showForm($conn2,$aDefaultForm){ // en esta funcion siempre va el formulario ?>


	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>
    
    
<form name="frm_reporte_vacaciones" id="frm_reporte_vacaciones" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<input name="action" type="hidden" value="" />
<input name="id" type="hidden" value="" />

    	<input name="txt_tipo_trabajador"  id="txt_tipo_trabajador" type="hidden" value="<?= $aDefaultForm['txt_tipo_trabajador']; ?>" />
		<input name="txt_codigo_tipos_trabajadores"  id="txt_codigo_tipos_trabajadores" type="hidden" value="<?= $aDefaultForm['txt_codigo_tipos_trabajadores']; ?>" />
		<input name="txt_apellido1"  id="txt_apellido1" type="hidden" value="<?= $aDefaultForm['txt_apellido1']; ?>" />
		<input name="txt_apellido2"  id="txt_apellido2" type="hidden" value="<?= $aDefaultForm['txt_apellido2']; ?>" />
		<input name="txt_nombre1"  id="txt_nombre1" type="hidden" value="<?= $aDefaultForm['txt_nombre1']; ?>" />
		<input name="txt_nombre2"  id="txt_nombre2" type="hidden" value="<?= $aDefaultForm['txt_nombre2']; ?>" />
		<input name="txt_nacionalidad"  id="txt_nacionalidad" type="hidden" value="<?= $aDefaultForm['txt_nacionalidad']; ?>" />
		<input name="txt_estatus"  id="txt_estatus" type="hidden" value="<?= $aDefaultForm['txt_estatus']; ?>" />
		<script type="text/javascript" src="validar_rec_pago_registro.js"></script>


<link rel="stylesheet" type="text/css" href="../../css/botones_IZ.css"/>
<link rel="stylesheet" type="text/css" href="../../css/formularios.css"/>
<style type="text/css">
	.loaders {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;	
		background: url('../../imagenes/page-loader.gif') 50% 50% no-repeat rgb(255,255,255);
		opacity: 0.6;
    	filter: alpha(opacity=60);
	}

	</style>
<script type="text/javascript" src="validar_rec_pago_registro.js"></script>
<script>  
function send(saction, txt_cedula){	

	if(saction=='buscar_persona'){
		var msg = '';
			if ($('#cbo_cedulatrabajador').val().trim() == ''){
			msg=msg+'-Bad';
				document.getElementById("cbo_cedulatrabajador").style.border = "1px solid red";
			}else{
				document.getElementById("cbo_cedulatrabajador").style.border = "";
			}
			
			if ($('#txt_cedula').val().trim() == ''){
			msg=msg+'-Bad';
				document.getElementById("txt_cedula").style.border = "1px solid red";
			}else{
				document.getElementById("txt_cedula").style.border = "";
			}
		if (msg != '') { 
			alert ('Debe seleccionar los campos requeridos');
			msg = '';
			return false;
		}else{
			$("#loader").show();
			var form = document.frm_reporte_vacaciones;
			form.action.value=saction;
			form.submit();	
			$("#tablacontenido").show();
		}
	}
} 
</script>
<table width="100%" border="0" align="center" class="formulario" cellpadding="3" cellspacing="0">
  <tr>
     <td></td>
  </tr>
  <tr>
    <th colspan="4"  class="titulo" align="center">SOLICITUD DE VACACIONES</th>
  </tr>
  <tr style="background-color:#FBF0D2;">
     <th colspan="4" class="separacion_10"></th>
  </tr>
  <tr class="identificacion_seccion" >
    <td colspan="2" align="right">C&Eacute;DULA DE IDENTIDAD: 
      <select id="cbo_cedulatrabajador" name="cbo_cedulatrabajador" >
        <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>></option>
        <option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>>V-.</option>
        <option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>>E.-</option>
        </select>
      <input name="txt_cedula" id="txt_cedula" type="text"  value="<?= $aDefaultForm['txt_cedula'];?>" title="C&eacute;dula de Identidad - Ingrese s&oacute;lo N&uacute;meros. Acepta 8 Digitos." size="29" maxlength="8" onKeyPress="return isNumberKey(event);" />
      <span>*</span></td>
    <td colspan="2" align="left">
        <button type="button" class="button_personal btn_buscar" onclick="javascript:send('buscar_persona');" title="Haga Click para Buscar">Buscar</button>
    </td>
  </tr>
  <tr  style="background-color:#FBF0D2;">
         <th colspan="4" class="separacion_10"></th>
  </tr>
  </table>
<? if($GLOBALS['mostrar'] == 1){ ?>

		<table width="95%" border="0" align="center" class="formulario">
			<tr>
				<th colspan="4">&nbsp;</th>		
			</tr>


			<tr class="identificacion_seccion">
				<th colspan="4" class="sub_titulo_3" align="left">DATOS DE IDENTIFICACION</th>
			</tr> 
		
			<tr>
				<th colspan="4">&nbsp;</th>		
			</tr>
		
			<tr>
				<th width="25%"  class="sub_titulo"><div align="center">Primer Apellido</div></th>
				<th width="25%" class="sub_titulo"><div align="center">Segundo Apellido</div></th>
				<th width="25%" class="sub_titulo"><div align="center">Primer Nombre</div></th>
				<th width="25%" class="sub_titulo"><div align="center">Segundo Nombre</div></th>
			</tr> 
		
			<tr>
				<td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_apellido1'];?></font></td>
				<td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_apellido2'];?></font></td> 
				<td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_nombre1'];?></font></td>
				<td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_nombre2'];?></font></td>
			</tr>
            			<tr>
				<th width="25%"  class="sub_titulo"><div align="center">Estatus</div></th>
				<th width="25%" class="sub_titulo"><div align="center">Fecha de Ingreso</div></th>
				<th width="25%" class="sub_titulo"><div align="center">Tipo de Trabajador</div></th>
				<th width="25%" class="sub_titulo"><div align="center">C&oacute;digo de N&oacute;mina</div></th>
			</tr> 
		
			<tr>
				<td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?php if($aDefaultForm['txt_estatus']=='A'){echo 'ACTIVO';}else{echo 'EGRESADO';}?></font></td>
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
				<th colspan="4" class="sub_titulo" align="center"><div align="center">Ubicaci&oacute;n Administrativa</div></th>
			</tr>
		
			<tr>
				<td colspan="4" style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_ubicacion_adm'];?></font></td>
			</tr>
		
     		<tr>
				<th colspan="4" class="separacion_bottom_10"></th>
			</tr>
            <tr>
				<th colspan="4" class="separacion_bottom_10"></th>
			</tr>
		</table>
        
        
        
        <table width="95%" border="0" align="center" class="formulario">

			<tr>
				<th colspan="8" class="sub_titulo_3" align="center"><div align="center">DISFRUTE DE VACACIONES</div></th>
			</tr>
            
            <tr>
				<td colspan="8" style="background-color:#F0F0F0;" align="center"> </td>	
			</tr>

			<tr>
				<th width="10%"  class="sub_titulo"><div align="center">Per&iacute;odo</div></th>
                <th width="10%"  class="sub_titulo"><div align="center">Tipo Vacaci&oacute;n</div></th>
                <th width="10%" class="sub_titulo"><div align="center">Fecha Inicio</div></th>
				<th width="10%" class="sub_titulo"><div align="center">Fecha Fin</div></th>
				<th width="10%" class="sub_titulo"><div align="center">D&iacute;as Disfrute</div></th>
                <th width="10%" class="sub_titulo"><div align="center">D&iacute;as Pendientes del Per&iacute;odo</div></th>
                <th width="10%" class="sub_titulo"><div align="center">Fecha de Reintegro</div></th>
                <th width="30%" class="sub_titulo"><div align="center">Observaciones</div></th>
			</tr> 
					<?php 
                   
					 $SQL2="SELECT
							personal.cedula,
							vacacion.anio as anio,
							vacacion.tipo_vacacion as vac_pen,
							vacacion.fecha_inicio as fec_inicio,
							vacacion.fecha_fin as fec_fin,							
							vacacion.dias_disfrute as dias_disf,
							vacacion.dias_pendientes as dias_pend,
							vacacion.fecha_reintegro as fec_reintegro,
						    vacacion.observaciones as observacion
							FROM personal
							Inner Join vacacion ON personal.id_personal = vacacion.id_personal
							WHERE  personal.cedula = '".$_POST['txt_cedula']."' and vacacion.tipo_vacacion='P' order by anio";
                    
                   $rs2=$conn2->Execute($SQL2);

                  if($rs2->RecordCount()>0){
					  $inter=0;
				   while(!$rs2->EOF){ 
  		                  if (($inter%2) == 0) $class_name="dataListColumn2";
                 			else $class_name="dataListColumn";
					    $aDefaultForm['anio']						  = $rs2->fields['anio'];
						$aDefaultForm['vac_pen']				  	  = $rs2->fields['vac_pen'];
						$aDefaultForm['fec_inicio']				  	  = $rs2->fields['fec_inicio'];
						$aDefaultForm['fec_fin']				  	  = $rs2->fields['fec_fin'];						
						$aDefaultForm['dias_disf']					  = $rs2->fields['dias_disf'];
						$aDefaultForm['dias_pend']					  = $rs2->fields['dias_pend'];
						$aDefaultForm['fec_reintegro']				  = $rs2->fields['fec_reintegro'];
						$aDefaultForm['observacion']				  = $rs2->fields['observacion'];
                 
				 ?>
			<tr <?=$class_name; ?>>
				<td width="10%"><div align="center"><?= $aDefaultForm['anio'];?></div></td>
                <td width="10%"><div align="center"><?= $aDefaultForm['vac_pen'];?></div></td>
                <td width="10%"><div align="center"><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['fec_inicio']));?></div></td>   
				<td width="10%"><div align="center"><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['fec_fin']));?></div></td>
				<td width="10%"><div align="center"><?= $aDefaultForm['dias_disf'];?></div></td>
                <td width="10%"><div align="center"><?= $aDefaultForm['dias_pend'];?></div></td>
                <td width="10%"><div align="center"><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['fec_reintegro']));?></div></td>
                <td width="30%" ><div align="center"><?= $aDefaultForm['observacion'];?></div></td>
			</tr>    
				<?php
                    $rs2->MoveNext();
                    $inter++;
                    }
                  }
                    ?>
</table>
        

</br>
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
     <td colspan="5" align="center">
          <button type="submit"  class="button_personal btn_imprimir"  formaction="pdf_constancia_trabajo_egresado.php" formtarget="_blank" title="Haga Click para Imprimir la Constancia de Trabajo">Imprimir</button></td>
 </tr>
</table>
<? } ?> 
</br>
<div id="loader" class="loaders" style="display: none;"></div>
</form>
       	
	</td>
	</tr>
	</tbody>
	</table>
    
    
<?php } ?>	


<?php include("../../footer.php"); ?>