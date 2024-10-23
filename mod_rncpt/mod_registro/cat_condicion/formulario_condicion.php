<?php
include("../../../include/header.php"); 
$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
debug();
				
				if($_REQUEST['id']!=''){
									 $SQL="SELECT id, sdescripcion 
  										   FROM rncpt.condicion_act WHERE id=".$_REQUEST['id']."";
									$rs=$conn->Execute($SQL);
			
									if($rs->RecordCount()>0){
									$aDefaultForm['txt_descripcion']=$rs->fields['sdescripcion'];
									$aDefaultForm['condicion_id']=$rs->fields['id'];																			
									}else{
									$aDefaultForm['txt_descripcion']='';
									$aDefaultForm['id']='';											
									}

				}

?>
<form id="formulario_registro_condicion" name="formulario_registro_condicion" action="registro_data.php" method="post">
<input name="id" id="id" type="hidden" value="<?=$aDefaultForm['condicion_id']?>"/>
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
        <th colspan="4"  class="sub_titulo"><div align="left">MANTENIMIENTO --> Cat&aacute;logos --> Condici&oacute;n Actual </div></th>
    </tr>

    <tr>
        <th colspan="4" class="sub_titulo_2" align="left"> 1.-AGREGAR/EDITAR </th>
    </tr>
      
    <tr> 
        <th width="18%" class="separacion_10"></th>
    </tr>
   
    <tr>
      <td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td> 
    </tr>
       
    <tr>  
        <th width="18%" class="separacion_10"></th>
    </tr> 
      
  	<tr>
      <th colspan="2" class="sub_titulo_3" ><div align="right">Condiciòn Actual</div></th>
        <td width="74%" colspan="2" align="center">
          <input aling ="center" type="text" name="txt_descripcion" id="txt_descripcion" placeholder="Condicion Actual" value="<?= $aDefaultForm['txt_descripcion'];?>" maxlength="60" size="40" style="width:80%"/>
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