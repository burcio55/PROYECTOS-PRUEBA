<?php
include("../../../include/header.php"); 
$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
debug();
				
				if($_REQUEST['id']!=''){
									 $SQL="SELECT id, sdescripcion 
  										   FROM rncpt.motor WHERE id=".$_REQUEST['id']."";
									$rs=$conn->Execute($SQL);
			
									if($rs->RecordCount()>0){
									$aDefaultForm['txt_descripcion']=$rs->fields['sdescripcion'];
									$aDefaultForm['productividad_id']=$rs->fields['id'];																			
									}else{
									$aDefaultForm['txt_descripcion']='';
									$aDefaultForm['id']='';											
									}

				}

?>
<form id="formulario_registro_productividad" name="formulario_registro_productividad" action="registro_data.php" method="post">
<input name="id" id="id" type="hidden" value="<?=$aDefaultForm['productividad_id']?>"/>
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tbody>
  </tr>
           <table width="95%" border="0" align="center" class="formulario">
         
        <tr>
             <th colspan="4"  class="sub_titulo"><div align="left">HCM --> Catalogo --> Tipo de Discapacidad</div></th>
        </tr>
    </table>
    <table width="70%" border="0" align="center" class="formulario">
      <tr>
          <td colspan="4" align="right">
        <tr>
        <th colspan="4" class="sub_titulo_2" align="left"> 1.-AGREGAR/EDITAR </th>
      </tr>
        <th width="18%" class="separacion_10"></th>
    </tr>
    <td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td> 
  	<tr>
      <th colspan="2" class="sub_titulo_3" align="center">Tipo de Discapacidad:</th>
        <td width="50%" colspan="2">
          <input type="text" name="txt_descripcion" id="txt_descripcion" placeholder="Tipo de Discapacidad" value="<?= $aDefaultForm['txt_descripcion'];?>" maxlength="40" size="50"/>
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