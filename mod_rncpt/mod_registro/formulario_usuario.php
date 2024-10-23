<?php
//----------------------------------------
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
include("../LoadCombos.php");
$conn= getConnDB($db1);
$conn->debug =false;
//----------------------------------------

$aDefaultForm = array();

							if($_POST['id']){
								
								$SQL="SELECT sesion.id, 
														 registrador_id, 
														 ntipo,
														 entidad_nentidad,
														 region_id,
														 registrador.snacionalidad,
														 registrador.ncedula,
														 registrador.sprimer_apellido,
														 registrador.ssegundo_apellido,
														 registrador.sprimer_nombre,
														 registrador.ssegundo_nombre,
														 registrador.fechanac,
														 entidad.sdescripcion as estado
												FROM scpt.sesion
												INNER JOIN scpt.registrador ON scpt.registrador.id=sesion.registrador_id
												INNER JOIN public.entidad ON public.entidad.nentidad=sesion.entidad_nentidad
												INNER JOIN public.region ON public.region.id=sesion.region_id
												WHERE sesion.id='".$_POST['id']."' ";
								$rs=$conn->Execute($SQL);	
								
									if ($rs->RecordCount()>0){
										$aDefaultForm['sesion_id']=$rs->fields['id'];
										$aDefaultForm['registrador']=$rs->fields['registrador_id'];
										$aDefaultForm['fechanac']=$rs->fields['fechanac'];
										$aDefaultForm['nacionalidad']=$rs->fields['snacionalidad'];
										$aDefaultForm['cedulaconsulta']=$rs->fields['ncedula'];
										$aDefaultForm['primer_apellido']=$rs->fields['sprimer_apellido'];	
										$aDefaultForm['segundo_apellido']=$rs->fields['ssegundo_apellido'];
										$aDefaultForm['primer_nombre']=$rs->fields['sprimer_nombre'];
										$aDefaultForm['segundo_nombre']=$rs->fields['ssegundo_nombre'];
										$aDefaultForm['cbo_region']=$rs->fields['region_id'];
										$aDefaultForm['cbo_entidad']=$rs->fields['entidad_nentidad'];
										$aDefaultForm['cbo_entidad_descripcion']=$rs->fields['estado'];
										if($rs->fields['ntipo']==5)$aDefaultForm['cbo_usuario']='5';
										if($rs->fields['ntipo']==3)$aDefaultForm['cbo_usuario']='3';
										if($rs->fields['ntipo']==6)$aDefaultForm['cbo_usuario']='6';
										if($rs->fields['ntipo']==4)$aDefaultForm['cbo_usuario']='4';
									}
							}
?>
<form name="frm_registro" id="frm_registro" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<input name="sesion_id" id="sesion_id" type="hidden" value="<?=$aDefaultForm["sesion_id"]?>" />
<input name="registrador" id="registrador" type="hidden" value="<?=$aDefaultForm["registrador"]?>" />

<link rel="stylesheet" type="text/css" href="/sistema_cpt/botones/css/botones_IZ.css"/>

<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">

  <tr>
    <th colspan="2" class="sub_titulo_3" align="right">C&eacute;dula de Identidad  </th>
    <td colspan="2" align="left">
    <select id="nacionalidad" name="nacionalidad">
    <option value=""<?php if (!(strcmp('',$aDefaultForm['nacionalidad']))) {echo " selected=\"selected\"";}?>></option>
    <option value="1"<?php if (!(strcmp('1',$aDefaultForm['nacionalidad']))) {echo " selected=\"selected\"";}?>>V-.</option>
    <option value="2"<?php if (!(strcmp('2',$aDefaultForm['nacionalidad']))) {echo " selected=\"selected\"";}?>>E.-</option>
    </select>				
    <input name="cedulaconsulta" id="cedulaconsulta" type="text"  value="<?= $aDefaultForm['cedulaconsulta'];?>" title="C&eacute;dula de Identidad - Ingrese s&oacute;lo N&uacute;meros. Acepta 8 Digitos." maxlength="8" onkeypress="return isNumberKey(event);" onblur="identificaciudadano()" />
    <span>*</span>
    </td>
  </tr>
  
  	<tr>
				<th width="25%"  class="sub_titulo"><div align="center">Primer Apellido</div></th>
				<th width="25%" class="sub_titulo"><div align="center">Segundo Apellido</div></th>
				<th width="25%" class="sub_titulo"><div align="center">Primer Nombre</div></th>
				<th width="25%" class="sub_titulo"><div align="center">Segundo Nombre</div></th>
	</tr> 
    
  <tr>

    <td align="center">
    <input name="primer_apellido" id="primer_apellido" type="text"  value="<?= $aDefaultForm['primer_apellido'];?>" onkeypress="return permite(event,'car')" title="Primer Apellido - Ingrese s&oacute;lo Letras. Acepta m&iacute;nimo 3 y m&aacute;ximo 15 caracteres." maxlength="25" disabled />
    </td>

    <td align="center">
    <input name="segundo_apellido" id="segundo_apellido" type="text"  value="<?=$aDefaultForm['segundo_apellido'];?>" onkeypress="return permite(event,'car')"  title="Segundo Apellido - Ingrese s&oacute;lo Letras. Acepta m&iacute;nimo 3 y m&aacute;ximo 15 caracteres" maxlength="25" disabled />
    </td>

    <td align="center">
    <input name="primer_nombre" id="primer_nombre" type="text"  value="<?=$aDefaultForm['primer_nombre'];?>" onkeypress="return permite(event,'car')" title="Primer Nombre - Ingrese s&oacute;lo Letras. Acepta m&iacute;nimo 3 y m&aacute;ximo 15 caracteres" maxlength="25" disabled />
   </td>

    <td align="center">
    <input name="segundo_nombre" id="segundo_nombre" type="text"  value="<?=$aDefaultForm['segundo_nombre'];?>" onkeypress="return permite(event,'car')" title="Segundo Nombre - Ingrese s&oacute;lo Letras. Acepta m&iacute;nimo 3 y m&aacute;ximo 15 caracteres" maxlength="25" disabled />
    </td>
  </tr>
  
   	<tr>
    	<th width="25%" class="sub_titulo"><div align="center">Fecha De Nacimiento</div></th>
        <th width="25%" class="sub_titulo"><div align="center">Tipo de Usuario</div></th>
        <th width="25%" class="sub_titulo"><div align="center">Regi&oacute;n</div></th>
        <th colspan="25%" class="sub_titulo"><div align="center">Estado</div></th>
	</tr> 
  
    
  <tr>
  <td align="center">
	 <input name="fechanac" id="fechanac" type="text"  size="10"  title="Fecha de Nacimiento - Indique en el calendario la fecha deFecha de Nacimiento del integrante del CPT" value="<?=$aDefaultForm['fechanac'] ?>" />  
   
   <a  id="f_btn4"> <img src="../imagenes/calendario.png" alt="" width="16" height="16" align="top"/></a>
      
      <script>
      var now = new Date();
      var cal = Calendar.setup({
			min       : '1900-01-01',
            max       : '<?=date("Y-m-d");?>',	
        selection : [ Calendar.dateToInt() ],
				inputField : "fechanac",
        trigger    : "f_btn4",
				onSelect   : function() { this.hide() },
				showTime   : false,
				dateFormat : "%Y-%m-%d",
				bottomBar : false
      });
			
     </script> 
   </td>

    <td align="center">
    <select id="cbo_usuario" name="cbo_usuario">
    <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_usuario']))) {echo " selected=\"selected\"";}?>>Seleccione...</option>
    <option value="5"<?php if (!(strcmp('5',$aDefaultForm['cbo_usuario']))) {echo " selected=\"selected\"";}?>>Responsable Regional</option>
    <option value="3"<?php if (!(strcmp('3',$aDefaultForm['cbo_usuario']))) {echo " selected=\"selected\"";}?>>Responsable Estadal</option>
    <option value="6"<?php if (!(strcmp('6',$aDefaultForm['cbo_usuario']))) {echo " selected=\"selected\"";}?>>Responsable Nacional</option>
    <option value="4"<?php if (!(strcmp('4',$aDefaultForm['cbo_usuario']))) {echo " selected=\"selected\"";}?>>Administrador</option>
    </select>				
    <span>*</span>
    </td>

    <td align="center">
    <select id="cbo_region" name="cbo_region" onChange="javascript:estado();" >
	<option value="">Seleccione</option>
    <? LoadRegion ($conn) ; print $GLOBALS['sHtml_cb_Region']; ?>
    </select>
	<span>*</span>	
    </td>

    <td colspan="2" align="center">
    <select id="cbo_entidad" name="cbo_entidad">
		<option value="">Seleccione</option>
    <option <? if($aDefaultForm['cbo_entidad_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_entidad']; ?>"><?= $aDefaultForm['cbo_entidad_descripcion'];?></option>
    </select>
	<span>*</span>	
    </td>
  </tr> 
    <tr>
    <th class="separacion_10"></th>
  </tr>

  <tr>
    <th colspan="4" align="center">
      <button type="button" id="btnAgregar" name="btnAgregar" value="Agregar Junta" class="button" onClick="guardar();" title='Agregar Registro - Haga click para Agregar un Registro'>Agregar
      <img src="../imagenes/add.png" />
      </button>     
   
      <button type="button" id="btnModificar" name="btnModificar" value="Modificar" class="button" onClick="modificar();" title='Editar Registro - Haga click para Editar el Registro'>Editar
      <img src="../imagenes/pencil_16.png" height="16" width="16" />
      </button>
            <button type="button" id="btnLimpiar" name="btnLimpiar" value="Limpiar" class="button" onClick="limpiar_formulario();" title='Limpiar Registro - Haga click para Limpiar el Registro'>Limpiar   
                  <img src="../imagenes/limpiar.png" height="16" width="16" />   
      </button>
    </th>
  </tr>
    <tr>
      <th class="separacion_20"></th>
    </tr>
</table>
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="4" align="center">
        <input type="hidden" id="cant_campos" name="cant_campos" value="<?php echo $aDefaultForm['cant_campos'];  ?>" />
        <div id="tabla_usuario" style=" height:200px;" ></div>
      </td>
    </tr>
    <tr>
      <th class="separacion_20"></th>
    </tr>
    <tr>
      <th class="separacion_20"></th>
    </tr>
</table>
</form>

