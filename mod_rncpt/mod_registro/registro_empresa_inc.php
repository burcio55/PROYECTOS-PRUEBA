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
						
					
						if($bValidateSuccess){	              
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
<form name="frm_registro_inc" id="frm_registro_inc" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<input name="action" type="hidden" value="" />


<script type="text/javascript" src="funciones_registro_incompleto.js"></script>
<script>
	function send(saction){
		//if(validar_campos()==true){
			var form = document.frm_registro_inc;
			form.action.value=saction;
			form.submit();
			$("#loader").show();
		//}		
	}
</script>
<table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
         <tr>
		  <th colspan="4"  class="sub_titulo"><div align="left">CPTT --> Registrar Entidades de Trabajo</div></th>
        </tr>
  <tr>
    <th class="separacion_20"></th>
</tr>
  <tr>
    <th class="separacion_20"></th>
</tr>
  <tr>
    <th class="separacion_20"></th>
</tr>
 <tr>
   <td id="empresa_tabla"></td>

</tr>


<tr>
    <th class="separacion_20"></th>
</tr>

<tr>
      <td colspan="4" align="center">
      <button type="button" name="cmd_guardar"  id="cmd_guardar"  class="button_personal btn_siguiente" title="Registrar Nuevo CPTT -  Haga Clic para Registrar" onclick="javascript:ir()">Registrar Nuevo CPTT
       
      </button>
      </td>
</tr>
</div>
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

