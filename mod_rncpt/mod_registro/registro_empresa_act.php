<?php
//----------------------------------------
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../../header.php');

$conn= getConnDB($db1);
$conn->debug =false;
//----------------------------------------

$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();
$settings['debug'] = false;

doAction($conn);
debug();
showForm($conn,$aDefaultForm);


function doAction($conn){
	if (isset($_POST['action1'])){ 
				$_POST['buscar']=0;
				switch($_POST["action1"]){  
				case 'consulta_cpt':	

					$boleta1=$_POST['txt_nro11']; 
					$boleta =$_POST['txt_nro11']."-".$_POST['txt_nro22']."-".$_POST['txt_nro33'];
					//echo 	$boleta;
					
					$sql3="SELECT public.region.sdescripcion as sregion,rncpt.empresa.id,
					public.entidad.sdescripcion as sentidad,public.municipio.sdescripcion as smunicipio,public.
					parroquia.sdescripcion as sparroquia,rncpt.empresa.srif,rncpt.empresa.srazon_social,
					rncpt.empresa.sdireccion_fiscal,
					rncpt.empresa.nro_boleta,rncpt.empresa.sucursales,rncpt.empresa.comentario,
					rncpt.empresa.baporte,
					rncpt.empresa.sdecripcion_aporte,
					rncpt.empresa.binventiva,
					rncpt.empresa.sdescripcion_inventiva,
					rncpt.empresa.srequisitos_inventiva
					FROM rncpt.empresa
					LEFT JOIN public.region ON public.region.id=rncpt.empresa.region_id
					LEFT JOIN public.entidad ON public.entidad.nentidad=rncpt.empresa.entidad_nentidad
					LEFT JOIN public.municipio ON public.municipio.nmunicipio=rncpt.empresa.municipio_nmunicipio
					LEFT JOIN public.parroquia ON public.parroquia.nparroquia=rncpt.empresa.parroquia_nparroquia
					where  rncpt.empresa.nro_boleta='".$boleta."' and rncpt.empresa.nenabled='1' LIMIT 1";
					$rs=$conn->Execute($sql3);
					if($rs->RecordCount()>0){
							$_SESSION['empresa_id']=$rs->fields['id'];	
/*							echo"buscarrrrrr";				
					var_dump($_SESSION['empresa_id']);*/
					LoadData($conn,false);
					$_POST['buscar']=1;
					}else{
						?><script>alert("El N° de Boleta no esta Registrado..");</script><?
						}
				break;
				}
		}else{
				LoadData($conn,true);
	}

	if (isset($_POST['action'])){ 
	
				switch($_POST["action"]){  				
				case 'editar':
/*			echo"guardar actual";				
					var_dump($_SESSION['empresa_id']);*/
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
						
						if ($_POST['txt_razonsocial']==""){
								$GLOBALS['aPageErrors'][]= "- El campo Raz&oacute;n Social:es requerido.";
								$GLOBALS['ids_elementos_validar'][]='txt_razonsocial';
								$bValidateSuccess=false;
						}
						if ($_POST['txt_denominacion']==""){
								$GLOBALS['aPageErrors'][]= "- El campo Denominaci&oacute;n Comercial:es requerido.";
								$GLOBALS['ids_elementos_validar'][]='txt_denominacion2';
								$bValidateSuccess=false;
						}
						if ($_POST['txt_direccion']==""){
								$GLOBALS['aPageErrors'][]= "- El campo Direcci&oacute;n Fiscal:es requerido.";
								$GLOBALS['ids_elementos_validar'][]='txt_direccion';
								$bValidateSuccess=false;
						}
						if ($_POST['opt_empresatipo']==""){
								$GLOBALS['aPageErrors'][]= "- El campo Estatus de la Entidad:es requerido.";
								$GLOBALS['ids_elementos_validar'][]='opt_empresatipo';
								$bValidateSuccess=false;
						}
						if ($_POST['opt_tiporeg']==""){
								$GLOBALS['aPageErrors'][]= "- El campo Tipo de Sector:es requerido.";
								$GLOBALS['ids_elementos_validar'][]='opt_empresatipo';
								$bValidateSuccess=false;
						}
						
		
						if($bValidateSuccess){
							LoadData($conn,true);
							//var_dump($_SESSION['empresa_id']);
									ProcessForm($conn);
								
					
						}
					LoadData($conn,true);
				break;		
				
				
				}
		}else{
		LoadData($conn,true);
	}
 }

//-----------------------------------------------------------------------------//
function LoadData($conn,$bPostBack){
/*	echo"Load data";				
					var_dump($_SESSION['empresa_id']);*/
	if (count($GLOBALS['aDefaultForm']) == 0){
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
			
					$aDefaultForm['cbo_region'] ='';
					$aDefaultForm['cbo_entidad'] ='';
					$aDefaultForm['cbo_municipio'] ='';
					$aDefaultForm['cbo_parroquia'] ='';
					$aDefaultForm['cbo_rif1'] ='';
					$aDefaultForm['txt_rif2'] ='';
					$aDefaultForm['txt_razonsocial'] ='';
					$aDefaultForm['txt_denominacion'] ='';
					$aDefaultForm['txt_direccion'] ='';
					$aDefaultForm['txt_sucursales'] ='';
					$aDefaultForm['opt_empresatipo']='';
					$aDefaultForm['opt_tiporeg']='';
					
					$aDefaultForm['txt_nro_boleta']='';
					$aDefaultForm['txt_nro1']='';
					$aDefaultForm['txt_nro2']='';
					$aDefaultForm['txt_nro3']='';
					$aDefaultForm['txt_comentario']='';

					$aDefaultForm['opt_baporte']='';
					$aDefaultForm['txt_aporte']='';
					$aDefaultForm['opt_binventiva']='';
					$aDefaultForm['txt_binventiva']='';
					$aDefaultForm['txt_req_inventiva']='';

		if (!$bPostBack){	
			
					if(isset($_SESSION['empresa_id'])){				
						
								$SQL="SELECT empresa.id,
                                                   sdenominacion_comercial,
                                                   srazon_social,
                                                   sdireccion_fiscal,
                                                   entidad_nentidad,
                                                   municipio_nmunicipio,
                                                   parroquia_nparroquia,
                                                   entidad.sdescripcion as entidad,
                                                   municipio.sdescripcion as municipio,
                                                   parroquia.sdescripcion as parroquia,
                                                   region_id,                                                 
                                                   srif,
												   sucursales,												  
												   nro_boleta,
												   tipo_registro, 		
												 	motor_id,
													rncpt.motor.sdescripcion as motor,
													comentario,
													baporte,
													sdecripcion_aporte,
													binventiva,
													sdescripcion_inventiva,
													srequisitos_inventiva,

													nestatus												
                                           FROM rncpt.empresa
                                           INNER JOIN public.entidad ON public.entidad.nentidad=rncpt.empresa.entidad_nentidad
                                           INNER JOIN public.municipio ON public.municipio.nmunicipio=rncpt.empresa.municipio_nmunicipio
                                           LEFT OUTER JOIN public.parroquia ON public.parroquia.nparroquia=rncpt.empresa.parroquia_nparroquia
										   inner join rncpt.empresa_motor on rncpt.empresa_motor.empresa_id=rncpt.empresa.id
										   inner join rncpt.motor on rncpt.empresa_motor.motor_id=rncpt.motor.id
											WHERE empresa.id='".$_SESSION['empresa_id']."' AND empresa.nenabled='1' and empresa_motor.nenabled='1'";
								$rs=$conn->Execute($SQL);	
								
									if ($rs->RecordCount()>0){
										$aDefaultForm['id']=$rs->fields['id'];
										$_SESSION['empresa_id']=$rs->fields['id'];
										$aDefaultForm['cbo_rif1']=substr($rs->fields['srif'],0,1);
										$aDefaultForm['txt_rif2']=substr($rs->fields['srif'],1,9);
										$aDefaultForm['txt_razonsocial']=$rs->fields['srazon_social'];
										$aDefaultForm['txt_denominacion']=$rs->fields['sdenominacion_comercial'];
										$aDefaultForm['txt_direccion']=$rs->fields['sdireccion_fiscal'];	
										
										$aDefaultForm['txt_rif']=$rs->fields['srif'];
										$aDefaultForm['cbo_region']=$rs->fields['region_id'];
										$aDefaultForm['cbo_entidad']=$rs->fields['entidad_nentidad'];
										$aDefaultForm['cbo_municipio']=$rs->fields['municipio_nmunicipio'];
										$aDefaultForm['cbo_parroquia']=$rs->fields['parroquia_nparroquia'];
									
										$aDefaultForm['txt_nro_boleta']=$rs->fields['nro_boleta'];
										$aDefaultForm['txt_nro1']=substr ( $rs->fields['nro_boleta'],0,3);
										$aDefaultForm['txt_nro2']=substr( $rs->fields['nro_boleta'],4,4);
										$aDefaultForm['txt_nro3']=substr( $rs->fields['nro_boleta'],13,5);
										$aDefaultForm['txt_sucursales']=$rs->fields['sucursales'];	
										$aDefaultForm['opt_tiporeg']=$rs->fields['tipo_registro'];	
										$aDefaultForm['cbo_motor']=$rs->fields['motor_id'];	
										$aDefaultForm['txt_comentario']=$rs->fields['comentario'];
										if($rs->fields['baporte'] == 't'){ $aDefaultForm['opt_baporte'] = 1;}elseif($rs->fields['baporte'] == 'f'){ $aDefaultForm['opt_baporte'] = 2;}
										//$aDefaultForm['opt_baporte']=$rs->fields['baporte'];
										$aDefaultForm['txt_aporte']=$rs->fields['sdecripcion_aporte'];
										if($rs->fields['binventiva'] == 't'){ $aDefaultForm['opt_binventiva'] = 1; }elseif($rs->fields['binventiva'] == 'f'){ $aDefaultForm['opt_binventiva'] = 2;}
										//$aDefaultForm['opt_binventiva']=$rs->fields['binventiva'];
										$aDefaultForm['txt_binventiva']=$rs->fields['sdescripcion_inventiva'];
										$aDefaultForm['txt_req_inventiva']=$rs->fields['srequisitos_inventiva'];	
										$aDefaultForm['opt_empresatipo']=$rs->fields['nestatus'];	;
									}
						
						}		
			
		}else{
					$aDefaultForm['cbo_region'] =$_POST["cbo_region"];
					$aDefaultForm['cbo_entidad'] =$_POST["cbo_entidad"];
					$aDefaultForm['cbo_municipio'] =$_POST["cbo_municipio"];
					$aDefaultForm['cbo_parroquia'] =$_POST["cbo_parroquia"];
					$aDefaultForm['cbo_rif1'] =$_POST["cbo_rif1"];
					$aDefaultForm['txt_rif2'] =$_POST["txt_rif2"];
					$aDefaultForm['txt_razonsocial'] =$_POST["txt_razonsocial"];
					$aDefaultForm['txt_denominacion'] =$_POST["txt_denominacion"];
					$aDefaultForm['txt_direccion'] =$_POST["txt_direccion"];					
					$aDefaultForm['txt_sucursales'] =$_POST["txt_sucursales"];			

					$aDefaultForm['txt_nro1']= $_POST['txt_nro1'];
					$aDefaultForm['txt_nro2']=$_POST['txt_nro2'];
					$aDefaultForm['txt_nro3']=$_POST['txt_nro3'];
					$aDefaultForm['txt_nro_boleta']= $_POST['txt_nro1'].'-'. $_POST['txt_nro2'].'-'.trim($_POST['txt_nro3']);
					$aDefaultForm['txt_nro_boleta']=$_POST['txt_nro_boleta'];					
					$aDefaultForm['opt_tiporeg']=$_POST['opt_tiporeg'];	
					$aDefaultForm['cbo_motor']=$_POST['cbo_motor'];	
					$aDefaultForm['opt_empresatipo']=$_POST['opt_empresatipo'];	
					$aDefaultForm['txt_comentario']=$_POST['txt_comentario'];	
		}
	}
}
function ProcessForm($conn){
$alerta='';
$_SESSION['empresa_id']=$_POST['id'];
/*echo"update bd";				
var_dump($_SESSION['empresa_id']);*/


	if($_POST['opt_baporte'] == 1){  $opt_baporte = true;}else{ $opt_baporte = 'false';}
	if($_POST['opt_binventiva'] == 1){  $opt_binventiva = true;}else{ $opt_binventiva = 'false';}
	if($_POST['action']=='editar'){	
		$SQL= "UPDATE rncpt.empresa
		SET  sdenominacion_comercial='".$_POST['txt_denominacion']."',
		srazon_social='".$_POST['txt_razonsocial']."',
		sdireccion_fiscal='".strtoupper($_POST['txt_direccion'])."', 
		entidad_nentidad='".$_POST['cbo_entidad']."',
		municipio_nmunicipio='".$_POST['cbo_municipio']."', 
		parroquia_nparroquia='".$_POST['cbo_parroquia']."',
		region_id='".$_POST['cbo_region']."', 		
		usuario_idactualizacion='".$_SESSION['id_usuario']."', 
		dfecha_actualizacion='".date('Y-m-d H:i:s')."',
		comentario='".$_POST['txt_comentario']."',
		sucursales='".$_POST['txt_sucursales']."',
		nestatus=".$_POST['opt_empresatipo'].",
		tipo_registro='".$_POST['opt_tiporeg']."',
		baporte='".$opt_baporte."',
		sdecripcion_aporte='".$_POST['txt_aporte']."',
		binventiva='".$opt_binventiva."',
		sdescripcion_inventiva='".$_POST['txt_binventiva']."',
		srequisitos_inventiva='".$_POST['txt_req_inventiva']."'
		WHERE id='".$_POST['id']."' AND nenabled=1"; 
		$rs=$conn->Execute($SQL);
		
		$SQL_motor= "UPDATE rncpt.empresa_motor
		SET empresa_id='".$_POST['id']."', motor_id='".$_POST['cbo_motor']."', usuario_idactualizacion=".$_SESSION['id_usuario'].", dfecha_actualizacion='".date('Y-m-d H:i:s')."', nenabled='1'
		WHERE empresa_id='".$_POST['id']."' AND nenabled='1';";
		$rs2=$conn->Execute($SQL_motor);
		
		if($rs and $rs2){
			//$_SESSION['empresa_id']=$_REQUEST['id'];			
			//$_SESSION['nro_boleta']=$_POST['txt_nro_boleta'];
			?><script>
			alert("DATOS MODIFICADOS SASTIFACTORIAMENTE..");
			document.location='registro_personal_act.php';
            </script><?
		}else{
			?><script>alert("DATOS INCORRECTOS..");</script><?
			}
		
	}
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
<input name="action1" type="hidden" value="" />
<input name="txt_razonsocial" type="hidden" value="<?=$aDefaultForm["txt_razonsocial"]?>" />
<input name="txt_denominacion" type="hidden" value="<?=$aDefaultForm["txt_denominacion"]?>" />
<input name="txt_direccion" type="hidden" value="<?=$aDefaultForm["txt_direccion"]?>" />
<input name="id" id="id" type="hidden" value="<?=$aDefaultForm["id"]; ?>" />
<input name="txt_nro_boleta" id="txt_nro_boleta" type="hidden"  value="<?=$aDefaultForm["txt_nro_boleta"]; ?>" maxlength="16"  />
      

<script type="text/javascript" src="funciones_registro_act.js"></script>		
<script>
	function send(saction){
		if(validar_campos()==true ){
			var form = document.frm_registro;
			form.action.value=saction;
			form.submit();
			$("#loader").show();
		}	
	}
	
	function send1(saction1){
		if(validar_campos_buscar()==true){
		var form=document.frm_registro;
		form.action1.value=saction1;
		form.submit();
		$("#loader").show();
		}
	}
	
	
</script>
<table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
      <tr>
		  <th colspan="4"  class="sub_titulo"><div align="left">RNCPTT --> Actualizar Entidades de Trabajo</div></th>
        </tr>

	<tr>
		<td colspan="4"> </td> 
	</tr>
        
    <tr>
       <td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
    </tr>
	 
	<tr>
		<td colspan="4"> </td> 
	</tr>
  
    <tr>
      <th width="50%" colspan="2"><div align="right">N&deg; de Boleta del CPTT &nbsp;&nbsp;&nbsp;</div></th>	
    
     <td width="50%" colspan="2" align="left">
     <input style="border-radius: 30px; border-color:#999999; width:10%" name="txt_nro11" id="txt_nro11" type="text"  value="<?= $aDefaultForm['txt_nro11'];?>" maxlength="4"  size="5" /> -
          <input style="border-radius: 30px; border-color:#999999; width:10%" name="txt_nro22" id="txt_nro22" type="text"  value="<?= $aDefaultForm['txt_nro22'];?>" maxlength="3"  size="4"  /> -
          <input style="border-radius: 30px; border-color:#999999; width:10%" name="txt_nro33" id="txt_nro33" type="text"  value="<?= $aDefaultForm['txt_nro33'];?>" maxlength="5"  size="5"   onkeypress="return isNumberKey(event);"/> <button type="button" name="cmd_buscar"  id="cmd_buscar" class="button_personal btn_buscar" title="Buscar Registro -  Haga Clic para Buscar" onclick="javascript:send1('consulta_cpt');">
    Buscar          
      </button> </td>
      </tr>

  	<tr>
		<td colspan="4"> </td> 
	</tr>
  
  
  <tr class="identificacion_seccion">
   		<th style="border-radius: 30px; border-color:#999999; width:85%" colspan="4" class="sub_titulo" id="seccBasicos" align="left">DATOS B&Aacute;SICOS</th>
  </tr>  
  
  <tr>
		<td colspan="4"> </td> 
  </tr>
	
  <tr>    
      <th style="color:#666" align="center"><strong>N° del Registro de Información Fiscal (RIF) </strong></th> 
	  <td style="background-color:#F0F0F0; border-radius: 30px; color:#666" align="center"><strong><? print $aDefaultForm['txt_rif']?></strong></td> 
      <th style="color:#666" align="center"><strong>N° de Boleta del CPTT </strong></th>
		  <td style="background-color:#F0F0F0; border-radius: 30px; color:#666" align="center"><strong><? print $aDefaultForm['txt_nro_boleta'];?></strong></td>
  </tr>  	
	
	  <tr>
		<td colspan="4"> </td> 
  </tr>
	
   <tr>
       <th style="color:#666"  colspan="2" align="left">Nombre o Raz&oacute;n Social</th>		
       <th style="color:#666"  colspan="2"  align="left">Denominaci&oacute;n Comercial</th>
   </tr>
    
	 	<tr>
		<td colspan="4"> </td> 
	</tr>
	
   <tr>  
       <td colspan="2" align="left"><font color="#666666">
    <textarea style="border-radius: 25px; border-color:#999999; width:95%" name="txt_razonsocial" id="txt_razonsocial" cols="70"  disabled="disabled"><?= $aDefaultForm['txt_razonsocial'];?></textarea>
    </font>   
       </td>
    
     <td colspan="2" align="left"><font color="#666666">
    <textarea style="border-radius: 25px; border-color:#999999; width:95%"name="txt_denominacion" id="txt_denominacion" cols="70" disabled="disabled"><?= $aDefaultForm['txt_denominacion'];?></textarea>
    </font>   
    </td>
   </tr>
   	<tr>
		<td colspan="4"> </td> 
	</tr>
   <tr>
        <th style="color:#666"   colspan="2"  align="left">Direcci&oacute;n Fiscal </th>		
        <th style="color:#666"   colspan="2" align="left">Sucursales</th>
        <!-- <th colspan="1" class="sub_titulo" align="center">Total de Trabajadores de la Entidad de Trabajo</th>-->
    </tr>
	 	<tr>
		<td colspan="4"> </td> 
	</tr>
  <tr>
    
    <td colspan="2" align="left">
    <textarea style="border-radius: 25px; border-color:#999999; width:95%" name="txt_direccion" id="txt_direccion" cols="70" rows="2" disabled="disabled"><?= $aDefaultForm['txt_direccion'];?></textarea>
    
    </td>
    <td colspan="2" align="left">
    <textarea style="border-radius: 25px; border-color:#999999; width:95%" name="txt_sucursales" id="txt_sucursales" cols="70" rows="2"><?= $aDefaultForm['txt_sucursales'];?></textarea>
    </td>
  </tr>
   
    	<tr>
		<td colspan="4"> </td> 
	</tr>    
      
      
      
 <tr>
    <th class="separacion_10"></th>
  </tr>
  <div id="daos_cpt">

          <tr>
            <th style="color:#666"  width="25%"><div align="left">Regi&oacute;n de Desarrollo Integral (REDI)</div></th>		
            <th style="color:#666"  width="21%"><div align="left">Estado</div></th>
            <th style="color:#666"  width="21%"><div align="left">Municipio</div></th>
            <th style="color:#666"  width="21%"><div align="left">Parroquia</div></th>  
        </tr>  
   
    	<tr>
		<td colspan="4"> </td> 
	</tr>
       <tr>
         <td align="left"><font color="#666666">
		 <select style="border-radius: 30px; border-color:#999999; width:60%"  id="cbo_region" name="cbo_region" onChange="javascript:estado();" >
            <option value="">Seleccione</option>
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

    <option <? if($aDefaultForm['cbo_municipio_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_municipio']; ?>"><?= $aDefaultForm['cbo_municipio_descripcion'];?></option>
    </select>	
    <span>*</span>			</font></td>

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
    <option <? if($aDefaultForm['cbo_parroquia_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_parroquia']; ?>"><?= $aDefaultForm['cbo_parroquia_descripcion'];?></option>
    </select>	
    <span>*</span>			</font></td>
        </tr>
  
   	<tr>
		<td colspan="4"> </td> 
	</tr>
	
	<tr>
		<td colspan="4"> </td> 
	</tr>
	
	  <tr>
			<th style="color:#666" colspan="2"><div align="left">Sector</div></th>
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
          <select style="border-radius: 30px; border-color:#999999; width:70%" id="cbo_motor" name="cbo_motor" onChange="javascript:sector();">
		 <option value="">Seleccione</option>
			<? LoadMotor ($conn); print $GLOBALS['sHtml_cb_Motor']; ?>
		  </select>
			<span>*</span>	
          </td>
        </tr>

     	<tr>
		  <td colspan="6"> </td> 
	   </tr>
   
	<tr>
		<td colspan="4"> </td> 
	</tr>
		<tr>
		<td colspan="4"> </td> 
	</tr>
        <tr>
	      <th style="color:#666" ><div align="left">Estatus de la Entidad de Trabajo</div></th>
          <th style="color:#666" colspan="3"><div align="left">Comentario(s) u  Observaci&oacute;n(es)</div></th>
        </tr>
  
      <tr>
		<td colspan="4"> </td> 
	  </tr>
  
   <tr>
     <td rowspan="1" align="left" id="td_empresatipo"> 
      &nbsp;&nbsp;
      Activa:
      <input type="radio" name="opt_empresatipo" id="opt_empresatipo1" title="Tipo de registro - Indique el tipo de registro de la Entidad de Trabajo." value="1"<?=($aDefaultForm['opt_empresatipo'] == 1) ? 'checked="checked"' :''?> />
      &nbsp;&nbsp;
      Inactiva:
      <input type="radio" name="opt_empresatipo" id="opt_empresatipo2" title="Tipo de registro - Indique el tipo de registro de la Entidad de Trabajo." value="2"<?=($aDefaultForm['opt_empresatipo'] == 2) ? 'checked="checked"' :''?> />
      <span>*</span></td>
      
    <td colspan="3" align="left">
    <textarea style="border-radius: 30px; border-color:#999999; width:95%" name="txt_comentario" id="txt_comentario" cols="90" rows="1"  onkeyup="mayusculas(this)"><?= $aDefaultForm['txt_comentario'];?></textarea>
    </td>        
    </tr>
    <tr class="identificacion_seccion">
   		<th style="border-radius: 30px; border-color:#999999; width:85%" colspan="4" class="sub_titulo" id="seccBasicos" align="left">DATOS ADCIONALES</th>
  	</tr>
    <tr>
			<th style="color:#666" colspan="4"><div align="left">1.- ¿Ha realizado algún aporte para mejorar la producción de la entidad de trabajo?</div></th>
	</tr>
	<tr>
		<td rowspan="1" align="left" id="td_baporte_value"> 
			&nbsp;&nbsp;
			Si:
			<input type="radio" class="btn_baporte" name="opt_baporte" id="opt_baporte1" title="" value="1"<?=($aDefaultForm['opt_baporte'] == 1) ? 'checked="checked"' :''?> />
			&nbsp;&nbsp;
			No:
			<input type="radio" class="btn_baporte" name="opt_baporte" id="opt_baporte2" title="" value="2"<?=($aDefaultForm['opt_baporte'] == 2) ? 'checked="checked"' :''?> />
			<span>*</span>
		</td>
		<?php // if($aDefaultForm['opt_baporte'] == 1){?>
		<td colspan="3" id="td_baporte" align="left">
			<textarea style="border-radius: 30px; border-color:#999999; width:95%" name="txt_aporte" id="txt_aporte" cols="90" rows="1"  onkeyup="mayusculas(this)"><?= $aDefaultForm['txt_aporte'];?></textarea>
		</td>
		<?php //}else{?>

		
		<?php //} ?>

    </tr>

	<tr>
			<th style="color:#666" colspan="4"><div align="left">2.- ¿Tiene alguna inventiva que permita mejorar la producción de la entidad de Trabajo?</div></th>
	</tr>
	<tr>
		<td rowspan="1" align="left" id="td_binventiva_value"> 
			&nbsp;&nbsp;
			Si:
			<input type="radio" class="btn_binventiva" name="opt_binventiva" id="opt_binventiva1" title="" value="1"<?=($aDefaultForm['opt_binventiva'] == 1) ? 'checked="checked"' :''?> />
			&nbsp;&nbsp;
			No:
			<input type="radio" class="btn_binventiva" name="opt_binventiva" id="opt_binventiva2" title="" value="2"<?=($aDefaultForm['opt_binventiva'] == 2) ? 'checked="checked"' :''?> />
			<span>*</span>
		</td>
      
		<td colspan="3" id="td_binventiva" align="left">
			<textarea style="border-radius: 30px; border-color:#999999; width:95%" name="txt_binventiva" id="txt_binventiva" cols="90" rows="1"  onkeyup="mayusculas(this)"><?= $aDefaultForm['txt_binventiva'];?></textarea>
		</td>        
    </tr>

	<tr id="txt_req_inventiva_value">
			<th style="color:#666" colspan="4"><div align="left">3.- ¿Qué requiere para la ejecución de la inventiva?</div></th>
	</tr>
	<tr>
      
		<td colspan="4" id="td_req_binventiva" align="left">
			<textarea style="border-radius: 30px; border-color:#999999; width:95%" name="txt_req_inventiva" id="txt_req_inventiva" cols="90" rows="1"  onkeyup="mayusculas(this)"><?= $aDefaultForm['txt_req_inventiva'];?></textarea>
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
      <button type="button" name="cmd_editar"  id="cmd_editar" class="button_personal btn_siguiente" title="Editar Registro -  Haga Clic para Guardar datos actualizados"   onclick="javascript:send('editar');">Actualizar Voceros
              <!--onclick="javascript:send('editar');"-->
      </button>
      
      </td>
    </tr>
     <tr>

      <th class="separacion_20"></th>
   </tr>
  </div>
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
