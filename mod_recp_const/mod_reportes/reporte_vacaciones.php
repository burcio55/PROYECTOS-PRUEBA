<?php 
include("../../header.php"); 

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];

$conn2 = &ADONewConnection($target);
//$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh_produccion2');
$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh');
$conn2->debug = false;

$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();

debug();
doAction($conn, $conn2);
showForm($conn, $aDefaultForm);

function doAction($conn, $conn2){
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
									personal.sexo,
									personal.cedula as cedula, 
									trabajador.fecha_ingreso as fecha_ingreso,
									trabajador.estatus as estatus,
									trabajador.cod_tipo_personal,
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
							$aDefaultForm['txt_tipo_trabajador']		=$rs_1->fields['tipo_trabajador'];				
							$aDefaultForm['txt_cod_nom']		   		=$rs_1->fields['cod_nom'];
							$aDefaultForm['txt_cuenta_nom']				=$rs_1->fields['cuenta_nom'];	
							$aDefaultForm['cargo']		                 =$rs_1->fields['cargo'];
							$aDefaultForm['ubicacion_adm']				=$rs_1->fields['ubicacion_adm'];
							$aDefaultForm['cbo_cedulatrabajador']       =$_POST['cbo_cedulatrabajador'];

							
							if ($rs_1->fields['sexo'] == 'M'){
								$_SESSION['ciudadano']  = 'el ciudadano ';
								$_SESSION['adscrito']   = 'adscrito a ';
							}else{
								$_SESSION['ciudadano']  =  'la ciudadana ';
								$_SESSION['adscrito']   = 'adscrita a ';
							}
							$_SESSION['recibo_act']=$aDefaultForm;
							$GLOBALS['mostrar'] = 1;
							
						}else{
							?>
							<script>
							alert("El trabajador no tiene estatus egresado, de ser egresado favor dirigirse a la Oficina de Gesti\u00F3n Humana, Dpto. Registro y Control."); 
							</script>
							<?php
							$aDefaultForm['txt_cedula']					="";
							$aDefaultForm['txt_apellido1']				=""; //ESTO SIGNIFICA QUE BLANQUEA LOS CAMPOS DEL FORMULARIO
							$aDefaultForm['txt_apellido2']				="";
							$aDefaultForm['txt_nombre1']				="";
							$aDefaultForm['txt_nombre2']				="";
							$aDefaultForm['txt_nacionalidad']			="";
							$aDefaultForm['txt_fecha_ingreso']			="";
							$aDefaultForm['txt_estatus']			    ="";
							$aDefaultForm['txt_tipo_trabajador']		="";
							$aDefaultForm['txt_cod_nom']				="";
							$aDefaultForm['txt_cuenta_nom']				="";
							$aDefaultForm['cargo']		                ="";	
							$aDefaultForm['ubicacion_adm']				="";
							$aDefaultForm['cbo_cedulatrabajador']       ="";	
						}						
					}
				break;
//------------------------------------------------------------------------------------------				
				case 'Actualiza': 
				
					
			
				loadData($conn, $conn2, true);
				break;
//------------------------------------------------------------------------------------------	
			}
		}else{
			LoadData($conn, $conn2, false);
		}
//------------------------------------------------------------------------------------------
}
//-----------------------------------------------------------------------------//
function LoadData($bPostBack){  

}
function generar_codigo($conn){
	$fecha_hoy=	date('Y-m-d');
	$can_dias_days= 90;  
	$fec_caducidad= date('Y-m-d', strtotime($fecha_hoy) + intval($can_dias_days*24*60*60)); 
	$sql="SELECT recibo_pago.dfecha_creacion,
	personales.cedula, personales.fecha_caducidad_const,scodigo_constancia
	FROM recibos_pagos_constancias.recibo_pago
	inner join personales on personales.cedula= recibos_pagos_constancias.recibo_pago.personales_cedula
	where cedula='".$_SESSION['id_usuario']."' and nestatus='1' and fecha_caducidad_const is not null
	order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC LIMIT 1";
	$rs1 = $conn->Execute($sql);
} 
?>


<?php function showForm($conn,$aDefaultForm){ // en esta funcion siempre va el formulario ?>


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
			var form = document.frm_constancia_trabajo_egresado;
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
    <th colspan="4"  class="titulo" align="center">DISFRUTE DE VACACIONES</th>
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
<table class="formulario" width="62%" align="center">
 <tr>
     <td></td>
 </tr>
 <tr>
    <td colspan="2" width="50%" height="200%"><font color="#666666"><p align="justify">Quien suscribe, la <b>Directora General(E)</b> de la <b>Oficina de Gesti&oacute;n Humana del Ministerio del Poder Popular para el Proceso Social de Trabajo</b>, hace constar  por medio de la presente que <?php echo $_SESSION['ciudadano'];?> <b><? echo trim($aDefaultForm['txt_apellido1']." ".$aDefaultForm['txt_apellido2']).",  ".trim($aDefaultForm['txt_nombre1']." ".$aDefaultForm['txt_nombre2']);?></b>,  titular de la c&eacute;dula de identidad Nro.  <b><?php echo $aDefaultForm['txt_nacionalidad']; echo '-'.number_format($aDefaultForm['txt_cedula'], 0, '', '.');?></b>, prest&oacute; sus servicios en &eacute;ste Organismo como <b><? echo trim($aDefaultForm['txt_tipo_trabajador']);?></b>, desempe&ntilde;ando el cargo de <b><?= $aDefaultForm['txt_descripcion_cargo'];?></b>, en la <b><?= $aDefaultForm['txt_nombre_dep'];'</b>';
         	    	$b = str_replace(".",",",$monto);//replace para cambiar puntos a coma
					list($pe, $pd) = explode(",",$b);//explode para quitar las comas. pe=parte entera , pd== parte dicimal.
					$BS = ' BOLIVARES CON ';// creando variable  bs para bolivares
					$CN = ' CENTIMOS';// creando variable cn para centimos
		?></b>,<?
					$total_asigna = 0;
//////////////////////////////////////////////////////////
//  estructurando fecha para el reporte
//////////////////////////////////////////////////////////
$fecha_solicitud = date('Y-m-d');
$fecha_nueva= split ("-",$fecha_solicitud);

$dia = $fecha_nueva[2];
$mes= $fecha_nueva[1];
$ano= $fecha_nueva[0];
/* *****************************************************************************
   Dando formato del mes
/* *****************************************************************************/
	if 	(($mes == 1))
	 $nombremes = "Enero";
	if 	(($mes == 2))
	 $nombremes = "Febrero";
	if 	(($mes == 3))
	 $nombremes = "Marzo";
	if 	(($mes == 4))
	 $nombremes = "Abril";
	if 	(($mes == 5))
	 $nombremes = "Mayo";
	if 	(($mes == 6))
	 $nombremes = "Junio";
	if 	(($mes == 7))
	 $nombremes = "Julio";
	if 	(($mes == 8))
	 $nombremes = "Agosto";
	if 	(($mes == 9))
	 $nombremes = "Septiembre";
	if 	(($mes == 10))
	 $nombremes = "Octubre";
	if 	(($mes == 11))
	 $nombremes = "Noviembre";
	if 	(($mes == 12))
	 $nombremes = "Diciembre";
	 $_SESSION['fecha_solicitud_const']['dia']= $dia;
 	 $_SESSION['fecha_solicitud_const']['mes']= $nombremes ;    
	 $_SESSION['fecha_solicitud_const']['ano']= $ano ;
?> desde el <b><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['txt_fecha_ingreso']));?> </b> hasta <b><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['txt_fecha_egreso']));?>.</b></p>
	</font></td>
</tr>
</table>


		<table width="95%" border="0" align="center" class="formulario">
			<tr>
				<th class="titulo"  colspan="4" align="center">DISFRUTE DE VACACIONES</th>
			</tr>
			<tr>
				<th colspan="4">&nbsp;</th>		
			</tr>



<tr class="identificacion_seccion" >
<td></td>
    <td colspan="2" align="center">C&Eacute;DULA DE IDENTIDAD: 
      <select id="cbo_cedulatrabajador" name="cbo_cedulatrabajador" >
        <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>></option>
        <option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>>V-.</option>
        <option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>>E.-</option>
        </select>
      <input name="txt_cedula" id="txt_cedula" type="text"  value="<?= $aDefaultForm['txt_cedula'];?>" title="C&eacute;dula de Identidad - Ingrese s&oacute;lo N&uacute;meros. Acepta 8 Digitos." size="29" maxlength="8" onKeyPress="return isNumberKey(event);" />
      <span>*</span></td>
    <td align="left">
        <button type="button" class="button_personal btn_buscar" onclick="javascript:send('buscar_persona');" title="Haga Click para Buscar">Buscar</button>
    </td>
  </tr>
			<tr class="identificacion_seccion">
				<th colspan="4" class="sub_titulo_3" align="left">DATOS DE IDENTIFICACION</th>
			</tr> 
		
			<tr>
				<th colspan="4">&nbsp;</th>		
			</tr>
		
			<tr>
				<th width="25%"  class="sub_titulo"><div align="center">Estatus</div></th>
				<th width="25%" class="sub_titulo"><div align="center">Fecha de Ingreso</div></th>
				<th width="25%" class="sub_titulo"><div align="center">Tipo de Trabajador</div></th>
				<th width="25%" class="sub_titulo"><div align="center">C&oacute;digo de N&oacute;mina</div></th>
			</tr> 
		
			<tr>
				<td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?php if($aDefaultForm['txt_estatus']==1){echo 'ACTIVO';}else{echo 'EGRESADO';}?></font></td>
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
				<td colspan="4"> </td>
			</tr>
			
<!--			<tr>
				<th colspan="4" class="sub_titulo" align="center"><div align="center">Ubicaci&oacute;n F&iacute;sica</div></th>
			</tr>
			
			<tr>
				<td colspan="4" style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_ubicacion_fisica'];?></font></td>	
			</tr>-->
			
			<tr>
				<th colspan="4" class="separacion_10"></th>
			</tr>
			
			<tr>
				<th colspan="4" class="separacion_10"></th>
			</tr>


			

			<tr>
				<th colspan="4" class="separacion_bottom_10"></th>
			</tr>
		

		
			<tr>
				<th colspan="4" class="separacion_bottom_10"></th>
			</tr>
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