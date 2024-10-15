<?php
include("../../include/header.php"); 
$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
debug();
				
				if($_REQUEST['id']!=''){
									 $SQL="SELECT id_gestion, sgestion_detalle 
  										   FROM oac.gestion_detalle WHERE id_gestion=".$_REQUEST['id']."";
									$rs=$conn->Execute($SQL);
			
									if($rs->RecordCount()>0){
									$aDefaultForm['txt_descripcion']=$rs->fields['sgestion_detalle'];
									$aDefaultForm['id']=$rs->fields['id_gestion'];	
											
									}else{
									$aDefaultForm['txt_descripcion']='';
									$aDefaultForm['id']='';											
									}

				}

?>
<form id="formulario_gestion" name="formulario_intro_gestion" action="../detalles_de_gestion/registro_data.php" method="post">
<input name="id" id="id" type="hidden" value="<?=$aDefaultForm['id']?>"/>


<table width="70%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tbody>
  </tr>
  
  	  <tr>
		<td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
	</tr> 
	 
	 <tr>
        <th width="32%" class="separacion_10"></th>
    </tr>
	
      <tr class="identificacion_seccion">
          <th style="border-radius: 30px; border-color:#999999; width:90%" colspan="4" class="sub_titulo_2" align="left">1.- AGREGAR/EDITAR</th>
      </tr>
      
    <tr>
        <th width="32%" class="separacion_10"></th>
    </tr>
  	<tr>
      <th class="sub_titulo_3"><div align="right">Detalles de Gestión</div></th>
<td width="2%" class="sub_titulo_3">&nbsp;</td>
<td width="66%" colspan="2" align="left">
<input style="border-radius: 30px; border-color:#999999; width:90%" type="text" name="txt_descripcion" id="txt_descripcion" value="<?php echo trim($aDefaultForm['txt_descripcion']); ?>"> <span>*</span>	
</td>
        
     </tr>   
 
   
      <tr>
          <th width="32%" class="separacion_20"></th>
      </tr>
        <tr>
          <td colspan="4" align="center">
          <button type="button" id="btnAgregar"class="button_personal btn_guardar" onclick="agregar();" >Guardar</button>
          <button type="button" id="btnModificar" class="button_personal btn_editar" onclick="modificar();">Editar</button>
		  <button type="button" id="btn_limpiar" class="button_personal btn_limpiar" onclick="limpiar();" >Limpiar</button>
          </td>
        </tr>
      <tr>
          <th width="32%" class="separacion_20"></th>
      </tr>
  </tbody>
 </table>
</form>
<? function LoadTipoCasoRnet($conn){

	$sHtml_Var = "sHtml_cb_tipo_caso_rnet";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id_tipo_caso, sdescripcion_tipo_caso, nenabled
  FROM oac.caso_tipo_correccion where nenabled=1 ";		
		$rs = &$conn->Execute($sSQL); 
	
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_tipo_caso_rnet']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			
			$rs->MoveNext();
		}		
	}
	}

function LoadDetalleCasoRnet($conn){

	$sHtml_Var = "sHtml_cb_detalle_caso_rnet";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id_detalle_caso, sdescripcion_detalle_caso, nenabled
  FROM oac.caso_detalle_correccion where nenabled=1 order by sdescripcion_detalle_caso";		
		$rs = &$conn->Execute($sSQL); 
	
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_detalle_caso_rnet']) {
				$GLOBALS[$sHtml_Var].= "selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			
			$rs->MoveNext();
		}		
	}
	}
	
function LoaddatoCorregirRnet($conn){

	$sHtml_Var = "sHtml_cb_dato_corregir_rnet";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id_dato, sdescripcion_dato, nenabled
  FROM oac.caso_dato_correccion where nenabled=1 order by sdescripcion_dato";		
		$rs = &$conn->Execute($sSQL); 
	
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_dato_corregir_rnet']) {
				$GLOBALS[$sHtml_Var].= "selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			
			$rs->MoveNext();
		}		
	}
	}	
?>		