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
								
								$SQL="SELECT empresa.id, 
													sdenominacion_comercial, 
													srazon_social, 
													sdireccion_fiscal, 
													entidad.sdescripcion as entidad, 
													municipio.sdescripcion as municipio, 
													region.sdescripcion as region, 
													srif
											FROM scpt.empresa
											INNER JOIN public.region ON public.region.id=scpt.empresa.region_id
											INNER JOIN public.entidad ON public.entidad.nentidad=scpt.empresa.entidad_nentidad
											INNER JOIN public.municipio ON public.municipio.nmunicipio=scpt.empresa.municipio_nmunicipio
											WHERE empresa.id='".$_POST['id']."' AND empresa.nenabled='1'";
								$rs=$conn->Execute($SQL);	
								
									if ($rs->RecordCount()>0){
										$aDefaultForm['txt_razonsocial']=$rs->fields['srazon_social'];
										$aDefaultForm['txt_denominacion']=$rs->fields['sdenominacion_comercial'];
										$aDefaultForm['txt_direccion']=$rs->fields['sdireccion_fiscal'];	
										$aDefaultForm['txt_rif']=$rs->fields['srif'];
										$aDefaultForm['cbo_region']=$rs->fields['region'];
										$aDefaultForm['cbo_entidad']=$rs->fields['entidad'];
										$aDefaultForm['cbo_municipio']=$rs->fields['municipio'];
									}
							}
?>
<form name="frm_registro" id="frm_registro" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
    <th width="10%" class="separacion_20"></th>
  </tr>
  <tr>
  	<th colspan="4" class="titulo">SISTEMA CONSEJO PRODUCTIVO DE TRABAJADORES</th>
  </tr>
  <tr>
  	<th colspan="4" class="sub_titulo"><div align="left">DATOS DE LA EMPRESA</div></th>
  </tr>
  <tr>
    <th class="separacion_10"></th>
  </tr>
  <tr>
    <td>REGI&Oacute;N:</td>
    <td colspan="3">
    <select id="cbo_region" name="cbo_region" disabled>
		<option value="">Seleccione</option>
    <? LoadRegion ($conn) ; print $GLOBALS['sHtml_cb_Region']; ?>
    </select>
	<span>*</span>	
    </td>
  </tr>
  <tr>
    <td>ESTADO:</td>
    <td colspan="3">
    <select id="cbo_entidad" name="cbo_entidad" disabled>
		<option value="">Seleccione</option>
    </select>
	<span>*</span>	
    </td>
  </tr>
  <tr>
    <td>MUNICIPIO:</td>
    <td colspan="3">
    <select id="cbo_municipio" name="cbo_municipio" disabled>
    <option value="">Seleccione</option>
    </select>	
    <span>*</span>			
    </td>
  </tr>
  <tr>
    <td>RIF:</td>
    <td>
      <input name="txt_rif" id="txt_rif" type="text"  value="<?= $aDefaultForm['txt_rif'];?>" maxlength="9" disabled/>
     <span>*</span>      
    </td>
  </tr>
  <tr>
    <td>NOMBRE O RAZ&Oacute;N SOCIAL:</td>
    <td colspan="3">
    <textarea name="txt_razonsocial" id="txt_razonsocial" cols="100" rows="1" disabled><?= $aDefaultForm['txt_razonsocial'];?></textarea>
    <span>*</span>    
    </td>
  </tr>
  <tr>
    <td>DENOMINACI&Oacute;N COMERCIAL:</td>
    <td colspan="3">
    <textarea name="txt_denominacion" id="txt_denominacion" cols="100" rows="1" maxlength="70" disabled><?= $aDefaultForm['txt_denominacion'];?></textarea>
    <span>*</span>    
    </td>
  </tr>
  <tr>
    <td>DIRECCI&Oacute;N FISCAL:</td>
    <td colspan="3">
    <textarea name="txt_direccion" id="txt_direccion" cols="100" rows="1" disabled><?= $aDefaultForm['txt_direccion'];?></textarea>
    <span>*</span>    
    </td>
  </tr>
  <tr>
    <th class="separacion_20"></th>
  </tr>
  <tr>
  	<th colspan="4" class="sub_titulo"><div align="left">DATOS DE LOS MIEMBROS DEL COMIT&Eacute;</div></th>
  </tr>
  <tr>
    <th class="separacion_10"></th>
  </tr>
    <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="4" align="center">
            <input type="hidden" id="cant_campos" name="cant_campos" value="<?php echo $aDefaultForm['cant_campos'];  ?>" />
            <div id="comite_tabla" style=" height:200px;" ></div>
          </td>
        </tr>
    </table>
  <tr>
    <th class="separacion_20"></th>
  </tr>
  <tr>
  	<th colspan="4" class="sub_titulo"><div align="left">RESUMEN PRODUCTIVO DE LA EMPRESA</div></th>
  </tr>
  <tr>
    <th class="separacion_10"></th>
  </tr>
    <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="4" align="center">
            <input type="hidden" id="cant_campos" name="cant_campos" value="<?php echo $aDefaultForm['cant_campos'];  ?>" />
            <div id="productividad_tabla" style=" height:200px;" ></div>
          </td>
        </tr>
    </table>
    <tr>
      <th class="separacion_20"></th>
    </tr>
</table>
</form>

