<?php
include("../../include/header.php"); 
$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
$conn->debug = false;
debug();
				
				if($_REQUEST['id']!=''){
									 $SQL="SELECT id_tipo_caso, sdescripcion_tipo_caso 
									 FROM  oac.caso_tipo_correccion 
									 WHERE id_tipo_caso=".$_REQUEST['id']."";
									$rs=$conn->Execute($SQL);
			
									if($rs->RecordCount()>0){
									$aDefaultForm['txt_descripcion']=$rs->fields['sdescripcion_tipo_caso'];
									$aDefaultForm['id']=$rs->fields['id_tipo_caso'];																			
									}else{
									$aDefaultForm['txt_descripcion']='';
									$aDefaultForm['id']='';											
									}

				}

?>
<form id="formulario_caso_rnet" name="formulario_caso_rnet" action="../CASO DEL RNET/registro_data.php" method="post">
<input name="id" id="id" type="hidden" value="<?=$aDefaultForm['id']?>"/>
<table width="70%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tbody>
  </tr>
      <tr  class="identificacion_seccion">
        <th colspan="4" class="sub_titulo_2" align="left">1.- AGREGAR/EDITAR</th>
      </tr>
      
    <tr>
        <th width="18%" class="separacion_10"></th>
    </tr>
  	<tr>
      <th colspan="2" class="sub_titulo_3" align="rigth">Tipo de Caso RNET:</th>
        <td width="50%" colspan="2">
          <input type="text" name="txt_descripcion" id="txt_descripcion" value="<?= $aDefaultForm['txt_descripcion'];?>" maxlength="40" size="50"/>
          <span>*</span>	
        </td>
     </tr>    
  <tr>
<td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
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