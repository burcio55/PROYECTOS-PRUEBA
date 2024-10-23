<?php
//----------------------------------------
session_start();
error_reporting(E_ALL | E_STRICT);
include("../../header.php"); 
ini_set("display_errors",0);
$conn= getConnDB($db1);

//----------------------------------------

$settings['debug'] = false;

$conn->debug = $settings['debug'];


unset($_SESSION['empresa_id']);	
$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();


doAction($conn);
debug();
//showHeader();
showForm($conn,$aDefaultForm);
//showFooter();



function doAction($conn){
	if (isset($_POST['action'])){ 
				switch($_POST["action"]){  
				case 'guardar':
						$bValidateSuccess=true;
						if ($_POST['cbo_region']==""){
								$GLOBALS['aPageErrors'][]= "- Debe seleccionar el campo Region.";
								$GLOBALS['ids_elementos_validar'][]='cbo_region';
								$bValidateSuccess=false;
						}
						if ($_POST['cbo_entidad']==""){
								$GLOBALS['aPageErrors'][]= "- Debe seleccionar el campo Estado.";
								$GLOBALS['ids_elementos_validar'][]='cbo_entidad';
								$bValidateSuccess=false;
						}
						if ($_POST['cbo_municipio']==""){
								$GLOBALS['aPageErrors'][]= "- Debe seleccionar el campo Municipio.";
								$GLOBALS['ids_elementos_validar'][]='cbo_municipio';
								$bValidateSuccess=false;
						}
						if ($_POST['cbo_parroquia']==""){
								$GLOBALS['aPageErrors'][]= "- Debe seleccionar el campo Municipio.";
								$GLOBALS['ids_elementos_validar'][]='cbo_parroquia';
								$bValidateSuccess=false;
						}
						
						if ($_POST['cbo_rif1']==""){
								$GLOBALS['aPageErrors'][]= "- Debe seleccionar la letra del campo Rif.";
								$GLOBALS['ids_elementos_validar'][]='cbo_rif1';
								$bValidateSuccess=false;
						}
						if ($_POST['txt_rif2']=="" or !preg_match("/^[[:digit:]]{9,9}$/", trim($_POST['txt_rif2']))){
								$GLOBALS['aPageErrors'][]= "- El campo Rif:debe contener de 2 a 9 digitos.";
								$GLOBALS['ids_elementos_validar'][]='txt_rif2';
								$bValidateSuccess=false;
						}
						if ($_POST['txt_razonsocial_']==""){
								$GLOBALS['aPageErrors'][]= "- El campo Raz&oacute;n Social:es requerido.";
								$GLOBALS['ids_elementos_validar'][]='txt_razonsocial_';
								$bValidateSuccess=false;
						}
						if ($_POST['txt_denominacion_']==""){
								$GLOBALS['aPageErrors'][]= "- El campo Denominaci&oacute;n Comercial:es requerido.";
								$GLOBALS['ids_elementos_validar'][]='txt_denominacion_';
								$bValidateSuccess=false;
						}
						if ($_POST['txt_denominacion_']==""){
								$GLOBALS['aPageErrors'][]= "- El campo Direcci&oacute;n Fiscal:es requerido.";
								$GLOBALS['ids_elementos_validar'][]='txt_direccion_';
								$bValidateSuccess=false;
						}
						if ($_POST['cbo_motor']==""){
								$GLOBALS['aPageErrors'][]= "- El campo Motor: es requerido.";
								$GLOBALS['ids_elementos_validar'][]='cbo_motor';
								$bValidateSuccess=false;
						}
						if ($_POST['opt_tiporeg']==""){
								$GLOBALS['aPageErrors'][]= "- El campo Tipo de Sector: es requerido.";
								$GLOBALS['ids_elementos_validar'][]='opt_tiporeg';
								$bValidateSuccess=false;
						}
						
					
						if($bValidateSuccess){/*					                        
                            
                            
                            $rif=$_POST['cbo_rif1'].$_POST['txt_rif2'];
			 $pase=base64_encode($_POST['cbo_region'].'/'.$_POST['cbo_entidad'].'/'.$_POST['cbo_municipio'].'/'.$_POST['cbo_parroquia'].'/'.$rif.'/'.$_POST['txt_razonsocial_'].'/'.$_POST['txt_denominacion_'].'/'.$_POST['txt_direccion_'].'/'.$_POST['cbo_motor'].'/'.$_POST['opt_tiporeg'].'/'.$_POST['txt_sucursales']);	
						?><script>    	
							document.location='registro_personal.php?pas=<?=$pase?>';   </script><?
			
						*/
						ProcessForm($conn);
						}
					
					LoadData($conn,true);
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
					$aDefaultForm['cbo_region'] ='';
					$aDefaultForm['cbo_entidad'] ='';
					$aDefaultForm['cbo_municipio'] ='';
					$aDefaultForm['cbo_parroquia'] ='';
					$aDefaultForm['cbo_rif1'] ='';
					$aDefaultForm['txt_rif2'] ='';					
					$aDefaultForm['txt_sucursales'] ='';
					$aDefaultForm['cbo_motor'] ='';				
					$aDefaultForm['opt_tiporeg']='';					

		if ($bPostBack){

					$aDefaultForm['cbo_region'] =$_POST["cbo_region"];
					$aDefaultForm['cbo_entidad'] =$_POST["cbo_entidad"];
					$aDefaultForm['cbo_municipio'] =$_POST["cbo_municipio"];
					$aDefaultForm['cbo_parroquia'] =$_POST["cbo_parroquia"];
					$aDefaultForm['cbo_rif1'] =$_POST["cbo_rif1"];
					$aDefaultForm['txt_rif2'] =$_POST["txt_rif2"];
					$aDefaultForm['txt_razonsocial'] =$_POST["txt_razonsocial_"];
					$aDefaultForm['txt_denominacion'] =$_POST["txt_denominacion_"];
					$aDefaultForm['txt_direccion'] =$_POST["txt_direccion_"];
					$aDefaultForm['txt_sucursales'] =$_POST["txt_sucursales"];
					$aDefaultForm['opt_tiporeg'] =$_POST['opt_tiporeg'];					
					$aDefaultForm['txt_sucursales']=$_POST['txt_sucursales'];	
					$aDefaultForm['cbo_motor'] =$_POST["cbo_motor"];
		
		}
	}
}




function ProcessForm($conn){

$alerta='';

if($_POST['action']=='guardar'){
		$permite_guardra=true;
		/*$_POST['txt_nro_boleta']=$_POST['txt_nro1']."-".$_POST['txt_nro2']."-CPT-".$_POST['txt_nro3'];									
		if($_POST['txt_nro_boleta']!=""){
			$_POST['txt_nro_boleta']=$_POST['txt_nro1']."-".$_POST['txt_nro2']."-CPT-".$_POST['txt_nro3'];									
			//print $_POST['txt_nro_boleta']; 	
			$sql3="SELECT *	FROM rncpt.empresa where nro_boleta='".$_POST['txt_nro_boleta']."' and nenabled='1'";
			$rs3=$conn->Execute($sql3);
			if($rs3->RecordCount()>0){
				?> <script>alert("El Número de la Boleta del CPT ya se encuentra registrado");</script><?
				$permite_guardra=false;
			}
		}*/
		if($permite_guardra)		
		{
			
				$SQL3="SELECT last_value +1 AS id from rncpt.empresa_id_seq;";	
				$rs3 = $conn->Execute($SQL3);
				$id_max = $rs3->fields['id'];
				
			$SQL1= "INSERT INTO rncpt.empresa
				 (region_id,
					entidad_nentidad,
					municipio_nmunicipio,
					srif, 
					srazon_social,
					sdenominacion_comercial,
					sdireccion_fiscal,									
					nenabled,
					dfecha_creacion,
					usuario_idcreacion,
					parroquia_nparroquia,
					sucursales,					
					tipo_registro,
					nestatus 				
					)
				 VALUES('".$_POST['cbo_region']."',
						'".$_POST['cbo_entidad']."',
						'".$_POST['cbo_municipio']."',
						'".$_POST['cbo_rif1'].$_POST['txt_rif2']."',
						'".$_POST['txt_razonsocial_']."',
						'".$_POST['txt_denominacion_']."',
						'".strtoupper($_POST['txt_direccion_'])."',											
						'1',
						'".date('Y-m-d H:i:s')."',
						'".$_SESSION['id_usuario']."',
						'".$_POST['cbo_parroquia']."',
						'".strtoupper($_POST['txt_sucursales'])."',							
						'".$_POST['opt_tiporeg']."',
						1						
						)";
			$rs1=$conn->Execute($SQL1);
			$sql_motor="INSERT INTO rncpt.empresa_motor(
            empresa_id, motor_id, usuario_idcreacion, dfecha_creacion, 
           nenabled)
    VALUES (".$id_max.",'".$_POST['cbo_motor']."', '".$_SESSION['id_usuario']."', '".date('Y-m-d H:i:s')."', 
            1);";
			$rs2=$conn->Execute($sql_motor);
			$_SESSION['empresa_id']=$id_max;
			$_SESSION['entidad']=$_POST['cbo_entidad'];
			
			if($rs1 and $rs2 ){			
			?><script>alert("- LOS DATOS DE LA ENTIDAD DE TRABAJO SE REGISTRARON EXITOSAMENTE");
            	document.location='registro_personal.php?';
            </script><?
			}else{
				?><script>alert("- ERROR AL REGISTRAR LOS DATOS DE LA ENTIDAD DE TRABAJO");  </script><?
				}
	}
}else{
	//ir a la siguiente pagina
	//header('Location:registro_personal.php');
	}
}


function doReport($conn){
	
}

function showHeader(){
 //include('../header.php'); 
}
function LoadRegion($conn){  
	
	
		$sHtml_Var = "sHtml_cb_Region";
		if (!isset($GLOBALS[$sHtml_Var])){
			$GLOBALS[$sHtml_Var] = '';
		}	
		if ($GLOBALS[$sHtml_Var] == ''){
			$sSQL="SELECT region.id,region.sdescripcion FROM public.region WHERE region.nenabled=1  ORDER BY sdescripcion";	
			$rs = &$conn->Execute($sSQL); 
			while ( !$rs->EOF ){
				$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
				if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_region']) {
					$GLOBALS[$sHtml_Var].= " selected='selected'";
				}
				$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
				$rs->MoveNext();
			}		
		}
	
}
/*COMBO MOTOR*/
function LoadMotor($conn){  
	$sHtml_Var = "sHtml_cb_Motor";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, sdescripcion FROM rncpt.motor WHERE nenabled='1' ORDER BY sdescripcion";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_motor']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
function showForm($conn,$aDefaultForm){
?>
<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>
<style type="text/css">

	.loaders {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;	
		background: url('../imagenes/page-loader.gif') 50% 50% no-repeat rgb(255,255,255);
		opacity: 0.6;
    	filter: alpha(opacity=60);
	}
	
	</style>
<form name="frm_registro" id="frm_registro" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<input name="action" type="hidden" value="" />
<input name="txt_razonsocial_" id="txt_razonsocial_" type="hidden" value="<?=$aDefaultForm["txt_razonsocial"]?>" />
<input name="txt_denominacion_" id="txt_denominacion_" type="hidden" value="<?=$aDefaultForm["txt_denominacion"]?>" />
<input name="txt_direccion_" id ="txt_direccion_" type="hidden" value="<?=$aDefaultForm["txt_direccion"]?>" />
<input name="id" id="id" type="hidden" value="<?=$aDefaultForm["id"]; ?>" />

<script type="text/javascript" src="funciones_registro.js"></script>
<script>
	function send(saction){
		if(validar_campos()==true){
			var form = document.frm_registro;
			form.action.value=saction;
			form.submit();
			$("#loader").show();
		}		
	}
</script>
<table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
       <tr>

		<th style="border-radius: 30px; border-color:#999999" colspan="4"  class="sub_titulo"><div align="left">RNCPTT --> Registrar Entidades de Trabajo</div></th>
        </tr>
  

      
      <tr>
          <td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
      </tr>
      
             
    <tr>  
        <th width="18%" class="separacion_10"></th>
    </tr> 
  
<!--  <tr>
    <th class="separacion_10"></th>
  </tr>-->
 <tr>
  <th colspan="2" class="sub_titulo_3"><div align="right">Registro de Informaci&oacute;n Fiscal (RIF)&nbsp;&nbsp;&nbsp;</div></th>		
        <td colspan="2" align="left">
	 <select style="border-radius: 30px; border-color:#999999; width:10%" id="cbo_rif1" name="cbo_rif1" >
      <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>></option>
      <option value="J"<?php if (!(strcmp('J',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>J</option>
      <option value="E"<?php if (!(strcmp('E',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>E</option>
      <option value="G"<?php if (!(strcmp('G',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>G</option>
      <option value="V"<?php if (!(strcmp('V',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>V</option>
      <option value="C"<?php if (!(strcmp('C',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>C</option>
      <option value="R"<?php if (!(strcmp('R',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>R</option>
      </select>
      <input style="border-radius: 30px; border-color:#999999; width:25%" name="txt_rif2" id="txt_rif2" type="text"  value="<?= $aDefaultForm['txt_rif2'];?>" maxlength="9" onkeypress="return isNumberKey(event);"   title="RIF - Ingrese s&oacute;lo N&uacute;meros. Acepta m&aacute;ximo 9 d&iacute;gitos."/>
     <span>*</span>  
     <button type="button" name="cmd_buscar" id="cmd_buscar" class="button_personal btn_buscar"  title="Buscar Registro -  Haga Clic para Buscar" onclick="javascript:consulta_empresa();" >Buscar</button>    
     
    </td>
</tr>
       
    <tr>  
        <th width="18%" class="separacion_10"></th>
    </tr> 
    
<tr class="identificacion_seccion">
       		<!-- <th colspan="4" class="sub_titulo_2" align="left">DATOS BASICOS</th>-->
	<th style="border-radius: 30px; border-color:#999999; width:85%" colspan="4" class="sub_titulo" id="seccBasicos" align="left">DATOS B&Aacute;SICOS</th>
</tr>

 	<tr>
		<td colspan="4"> </td> 
	</tr>
	
<tr>
     <th style="color:#666"  colspan="2"><div align="left">Nombre o Raz&oacute;n Social</div></th>		
     <th style="color:#666"  colspan="2"><div align="left">Denominaci&oacute;n Comercial</div></th>
</tr>
 
  	<tr>
		<td colspan="4"> </td> 
	</tr>
	   
<tr>
    <td colspan="2" align="left"><font color="#666666">
    <textarea style="border-radius: 30px; border-color:#999999; width:95%" name="txt_razonsocial" id="txt_razonsocial"  cols="62" title="Nombre o Raz&oacute;n Social - Ingrese el Nombre o Raz&oacute;n Social del Entidad de Trabajo."  disabled="disabled" /><?= $aDefaultForm['txt_razonsocial'];?></textarea>
    </font>   
    </td>
    
     <td colspan="2" align="left"><font color="#666666">
    <textarea style="border-radius: 30px; border-color:#999999; width:95%" name="txt_denominacion" id="txt_denominacion" cols="62" title="Denominaci&oacute;n Comercial - Ingrese la Denominaci&oacute;n Comercial de la Entidad de Trabajo." disabled="disabled"><?= $aDefaultForm['txt_denominacion'];?></textarea>
    </font>   
    </td>
</tr>

<tr>
    <th style="color:#666" colspan="2"><div align="left">Direcci&oacute;n Fiscal</div></th>		
    <th style="color:#666" colspan="2"><div align="left">Sucursales</div></th>
    <!-- <th colspan="1" class="sub_titulo" align="center">Total de Trabajadores de la Entidad de Trabajo</th>-->
</tr>

 	<tr>
		<td colspan="4"> </td> 
	</tr>
	
<tr>
    <td colspan="2" align="left"><font color="#666666">
    <textarea style="border-radius: 30px; border-color:#999999; width:95%" name="txt_direccion" id="txt_direccion" cols="62" rows="2" title="Direcci&oacute;n Fiscal de la Entidad de Trabajo - Ingrese la Direcci&oacute;n Fiscal de la Entidad de Trabajo." disabled="disabled"><?= $aDefaultForm['txt_direccion'];?></textarea>
   </font> </td>
    <td colspan="2" align="left"><font color="#666666">
    <textarea style="border-radius: 30px; border-color:#999999; width:95%" name="txt_sucursales" id="txt_sucursales" cols="62" rows="2" onkeyup="mayusculas(this);" title="Sucurales - En caso de ser una Sucursal de la Entidad de Trabajo por favor ingresar su nombre."><?= $aDefaultForm['txt_sucursales'];?></textarea><span>*</span>
    </font></td>
</tr>
   
<tr>
    <th style="color:#666"  width="25%"><div align="left">Regi&oacute;n de Desarrollo Integral (REDI)</div></th>		
    <th style="color:#666" width="21%"><div align="left">Estado</div></th>
    <th style="color:#666" width="21%"><div align="left">Municipio</div></th>
    <th style="color:#666" width="21%"><div align="left">Parroquia</div></th>  
</tr>
   
 	<tr>
		<td colspan="4"> </td> 
	</tr>
	
<tr>
    <td align="left"><font color="#666666">
	   <select style="border-radius: 30px; border-color:#999999; width:60%" id="cbo_region" name="cbo_region" onChange="javascript:estado();" >
         <option   value="">Seleccione</option>
<? LoadRegion ($conn) ; print $GLOBALS['sHtml_cb_Region']; ?>
            </select>
            <span>*</span></font>
    </td>
    <td align="left"><font color="#666666">    
	<select style="border-radius: 30px; border-color:#999999; width:70%" id="cbo_entidad" name="cbo_entidad" onchange="javascript:municipio();">
    <?php
			if ($aDefaultForm["cbo_region"]!=''){
			
				$condicion="nregion = '".$aDefaultForm["cbo_region"]."' "; 
				
				
				$sSQL="SELECT nentidad, sdescripcion, nregion FROM public.entidad WHERE ".$condicion." AND id<26 and nenabled='1' ORDER BY sdescripcion";	
				echo $sSQL;
				$rs = &$conn->Execute($sSQL);
				$selec=""; 
				 $options.= "<option value=''>Seleccione</option>"; 
				while ( !$rs->EOF ){
				if ($rs->fields['0'] ==$aDefaultForm['cbo_entidad']) {
					$selec= "selected='selected'";   
				}else{
					$selec= "";
				}
				 $options.= "<option ".$selec." value=".$rs->fields['0'].">".utf8_decode($rs->fields['1'])."</option>";    
				 $rs->MoveNext();
				}					
				 echo $options;
			}else{
			echo '<option value="">Seleccione</option>';
			}
		?>
        <option <? if($aDefaultForm['cbo_entidad_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_entidad']; ?>"><?= $aDefaultForm['cbo_entidad_descripcion'];?></option>
    </select>
	<span>*</span></font>
    </td>
    <td align="left"><font color="#666666">
	<select style="border-radius: 30px; border-color:#999999; width:70%" id="cbo_municipio" name="cbo_municipio" onchange="javascript:parroquia();">
<?php
        if($aDefaultForm["cbo_entidad"]!="" and $aDefaultForm["cbo_municipio"]!=""){
            $sSQL="SELECT nmunicipio, sdescripcion FROM public.municipio where nentidad='".$aDefaultForm["cbo_entidad"]."' ORDER BY sdescripcion";	
            $rs = &$conn->Execute($sSQL); 
                $selec=""; 
             $options.= "<option value=''>Seleccione</option>"; 
            while ( !$rs->EOF ){
            if ($rs->fields['0']==$aDefaultForm['cbo_municipio']) {
                $selec= "selected='selected'";   
                }else{
                $selec=""; 
                }
             $options.= "<option ".$selec." value=".$rs->fields['0'].">".utf8_decode($rs->fields['1'])."</option>";    
             $rs->MoveNext();
            }					
             echo $options;
        }else{
            echo '<option value="">Seleccione</option>';
        }
        ?> 
</select>	
    <span>*</span></font>
    </td>
    <td align="left"><font color="#666666">
	<select style="border-radius: 30px; border-color:#999999; width:70%" id="cbo_parroquia" name="cbo_parroquia">
<?php
        if($aDefaultForm["cbo_municipio"]!="" and $aDefaultForm["cbo_parroquia"]!=""){
            $sSQL="SELECT nparroquia, sdescripcion FROM public.parroquia where nmunicipio='".$aDefaultForm["cbo_municipio"]."' ORDER BY sdescripcion";	
            $rs = &$conn->Execute($sSQL); 
                $selec=""; 
             $options.= "<option value=''>Seleccione</option>"; 
            while ( !$rs->EOF ){
            if ($rs->fields['0']==$aDefaultForm['cbo_parroquia']) {
                $selec= "selected='selected'";   
                }else{
                $selec=""; 
                }
             $options.= "<option ".$selec." value=".$rs->fields['0'].">".utf8_decode($rs->fields['1'])."</option>";    
             $rs->MoveNext();
            }					
             echo $options;
        }else{
            echo '<option value="">Seleccione</option>';
        }
        ?>
</select>	
    <span>*</span>			</font>
    </td>
</tr>
        
	<tr>
		<td colspan="4"> </td> 
	</tr>
	
<tr align="center">
            <th style="color:#666" colspan="2"><div align="left"><strong>Sector</strong></div></th>
            <th style="color:#666" colspan="2"><div align="left">Motor</div></th>		
</tr> 

 	<tr>
		<td colspan="4"> </td> 
	</tr>
	
<tr align="left">      
            <td colspan="2" id="td_empresatipo5"> 
      &nbsp;&nbsp;
      P&uacute;blico:
      <input type="radio" name="opt_tiporeg" id="opt_tiporeg1" title="Tipo Sector - Indique el Tipo Sector de la Entidad de Trabajo." value="1"<?=($aDefaultForm['opt_tiporeg'] == 1) ? 'checked="checked"' :''?> />
      &nbsp;&nbsp;
      Privado:
      <input type="radio" name="opt_tiporeg" id="opt_tiporeg2" title="Tipo Sector - Indique el Tipo Sector de la Entidad de Trabajo." value="2"<?=($aDefaultForm['opt_tiporeg'] == 2) ? 'checked="checked"' :''?> />
      &nbsp;&nbsp;
      Mixto:
      <input type="radio" name="opt_tiporeg" id="opt_tiporeg3" title="Tipo Sector - Indique el Tipo Sector de la Entidad de Trabajo." value="3"<?=($aDefaultForm['opt_tiporeg'] == 3) ? 'checked="checked"' :''?> />
      <span>*</span></td>
      
         <td colspan="2" align="left">
          <select style="border-radius: 30px; border-color:#999999; width:70%" id="cbo_motor" name="cbo_motor" >
		 <option value="">Seleccione</option>
			<? LoadMotor ($conn); print $GLOBALS['sHtml_cb_Motor']; ?>
		  </select>
			<span>*</span>	
          </td>
</tr>

<tr>
    <th class="separacion_20"></th>
</tr>

<tr>
    <th class="separacion_20"></th>
</tr>

<tr>
      <td colspan="4" align="center">
      <button type="button" name="cmd_guardar"  id="cmd_guardar"  class="button_personal btn_siguiente" title="Guardar Registro -  Haga Clic para Guardar" onclick="javascript:send('guardar');">Registrar Voceros
       
      </button>
      </td>
</tr>
    
<tr>
   <th class="separacion_20"></th>
</tr>
</table>
<div id="loader" class="loaders" style="display: none;"></div>
</form>

    		
	</td>
	</tr>
	</tbody>
	</table>
	<?php
}

 
 include('../../footer.php'); ?>

