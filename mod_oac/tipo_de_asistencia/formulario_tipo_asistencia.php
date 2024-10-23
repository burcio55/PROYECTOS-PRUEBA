<?php
include("../../include/header.php"); 
$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
debug();
				
				if($_REQUEST['id']!=''){
									 $SQL="SELECT id_tipo_asistencia, stipo_asistencia
  										   FROM oac.tipo_asistencia WHERE id_tipo_asistencia=".$_REQUEST['id']."";
									$rs=$conn->Execute($SQL);
			
									if($rs->RecordCount()>0){
									$aDefaultForm['txt_descripcion']=$rs->fields['stipo_asistencia'];
									$aDefaultForm['id']=$rs->fields['id_tipo_asistencia'];																			
									}else{
									$aDefaultForm['txt_descripcion']='';
									$aDefaultForm['id']='';											
									}

				}

?>
<form id="formulario_tipo_asistencia" name="formulario_tipo_asistencia" action="../TIPOS DE ASISTENCIA/registro_data.php" method="post">
<input name="id" id="id" type="hidden" value="<?=$aDefaultForm['id']?>"/>
<table width="70%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tbody>
  </tr>
  
   <tr>
		<td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
	</tr> 
	 
	 <tr>
        <th width="18%" class="separacion_10"></th>
    </tr>
	
      <tr class="identificacion_seccion">
        <th style="border-radius: 30px; border-color:#999999; width:90%" colspan="4" class="sub_titulo_2" align="left">1.- AGREGAR/EDITAR</th>
      </tr>
      
    <tr>
        <th width="18%" class="separacion_10"></th>
    </tr>
	
  	<tr>
      <th class="sub_titulo_3"><div align="right">Tipo de Asistencia </div></th>
	  <td width="2%" class="sub_titulo_3" >&nbsp; </td>
      <td width="66%" colspan="2" align="left">
          <input style="border-radius: 30px; border-color:#999999; width:90%" type="text" name="txt_descripcion" id="txt_descripcion" value="<?=$aDefaultForm['txt_descripcion'];?>" maxlength="40" size="50"/>
          <span>*</span>	
        </td>
     </tr>  
  
      <tr>
          <th width="18%" class="separacion_20"></th>
      </tr>
        <tr>
          <td colspan="4" align="center">
          <button type="button" id="btnAgregar"class="button_personal btn_guardar" onclick="agregar();" >Guardar</button>
          <button type="button" id="btnModificar" class="button_personal btn_editar" onclick="modificar();">Editar</button>
					<button type="button" id="btn_limpiar" class="button_personal btn_limpiar" onclick="limpiar();" >Limpiar</button>
          </td>
        </tr>
      <tr>
          <th width="18%" class="separacion_20"></th>
      </tr>
  </tbody>
 </table>
</form>