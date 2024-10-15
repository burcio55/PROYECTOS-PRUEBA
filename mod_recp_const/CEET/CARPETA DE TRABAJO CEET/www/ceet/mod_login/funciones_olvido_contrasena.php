<?php

include("../include/header.php");
$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();

function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST["action"]){
		
			case'regresar':				
				print "<script>document.location='/sistema_cpt/mod_login/login.php';</script>";
			break;
			
			case 'guardar':
				$bValidateSuccess=true;
				if($_POST['txt_fecha_nac']==""){
					$GLOBALS['aPageErrors'][]= "- Debe seleccionar la fecha de Nacimiento";
					$GLOBALS['ids_elementos_validar'][]='txt_fecha_nac';
					$bValidateSuccess=false;
				} 
	
				if ($_POST['cbo_cedulatrabajador']==""){
					$GLOBALS['aPageErrors'][]= "- Debe seleccionar la Nacionalidad.";
					$GLOBALS['ids_elementos_validar'][]='cbo_cedulatrabajador';
					$bValidateSuccess=false;
				}
				
				if (!preg_match("/^[[:digit:]]{4,8}+$/", trim($_POST['txt_cedula'])) ){ 
					$GLOBALS['aPageErrors'][]= "- El campo C\u00E9dula de Identidad debe contener de 4 a 8 d\u00EDgitos";
					$GLOBALS['ids_elementos_validar'][]='txt_cedula';
					$bValidateSuccess=false;
				}	
			
				if($bValidateSuccess){  
					ProcessForm($conn);
				}
				break; 											 
			
		}
	}
}

function generar_contrasena(){
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	$cad = "";
	for($i=0;$i<8;$i++) {  
		$cad .= substr($str,rand(0,62),1);
	}	
	return  strtoupper($cad);
}

function ProcessForm($conn){
	//$clave=trim(generar_contrasena()); 
	//$clave=trim('1234');
$valor=false;
$SQL="SELECT registrador.id as usuario_id,
registrador.snacionalidad as nacionalidad,
registrador.ncedula as ncedula,
registrador.sprimer_apellido as apellido,
registrador.sprimer_nombre as nombre,
registrador.fechanac as fechanac,
sesion.region_id nregion,
entidad.nentidad as nentidad_id,
entidad.sdescripcion as estado,
region.id as region_id,
region.sdescripcion as region,
sesion.ntipo
FROM scpt.sesion
INNER JOIN scpt.registrador ON scpt.registrador.id=scpt.sesion.registrador_id
LEFT JOIN public.entidad ON public.entidad.nentidad=scpt.sesion.entidad_nentidad
LEFT JOIN public.region ON public.region.id=scpt.sesion.region_id
WHERE registrador.ncedula='".$_POST['txt_cedula']."' 
AND registrador.snacionalidad='".$_POST['cbo_cedulatrabajador']."' 
AND registrador.nenabled='1' 
AND sesion.nenabled='1'" ;
	$rs=$conn->Execute($SQL);
	if($rs->RecordCount()>0){
		$_POST['txt_apellido1']=$rs->fields['apellido'];
			$_POST['txt_nombre1']=$rs->fields['nombre'];
			//$_POST['txt_clave']=$rs->fields['clave'];
			$cedula=$rs->fields['ncedula'];
			$usuario_id=$rs->fields['usuario_id'];
			$fechanac=$rs->fields['fechanac'];
			if($fechanac==''){
				$SQL1="UPDATE scpt.sesion SET sclave =  md5('".$cedula."'), usuario_idactualizacion = '".$_POST['txt_cedula']."', dfecha_actualizacion = '".date('Y-m-d H:i:s')."' WHERE registrador_id = '".$usuario_id."'";	
				$rs1= $conn->Execute($SQL1);
				
				$SQL2="UPDATE scpt.registrador SET  usuario_idactualizacion = '".$_POST['txt_cedula']."', dfecha_actualizacion = '".date('Y-m-d H:i:s')."',fechanac='".$_POST['txt_fecha_nac']."' WHERE id = '".$usuario_id."'";	
			$rs2= $conn->Execute($SQL2);
		
		$valor=true;
				?>
			<script>
				alert("Su nueva contrase\u00F1a de acceso es: <?=$cedula?> \n y por medida de seguridad debe cambiarla al ingresar al sistema"); 
				window.location="/sistema_cpt/mod_login/login.php";
			</script> 
			<?php
			}else{
				$valor=false;
			?>		
			
	<?		
			}
	}
if(!$valor){	
 	$SQL1="SELECT registrador.id as usuario_id,
registrador.snacionalidad as nacionalidad,
registrador.ncedula as ncedula,
registrador.sprimer_apellido as apellido,
registrador.sprimer_nombre as nombre,
registrador.fechanac as fechanac,
sesion.region_id nregion,
entidad.nentidad as nentidad_id,
entidad.sdescripcion as estado,
region.id as region_id,
region.sdescripcion as region,
sesion.ntipo
FROM scpt.sesion
INNER JOIN scpt.registrador ON scpt.registrador.id=scpt.sesion.registrador_id
LEFT JOIN public.entidad ON public.entidad.nentidad=scpt.sesion.entidad_nentidad
LEFT JOIN public.region ON public.region.id=scpt.sesion.region_id
WHERE registrador.ncedula='".$_POST['txt_cedula']."' 
AND registrador.fechanac ='".$_POST['txt_fecha_nac']."' 
AND registrador.snacionalidad='".$_POST['cbo_cedulatrabajador']."' 
AND registrador.nenabled='1' 
AND sesion.nenabled='1'" ;
	$rs1=$conn->Execute($SQL1);
				
if($rs1->RecordCount()>0){
			
	$SQL11="UPDATE scpt.sesion SET sclave =  md5('".$cedula."'), usuario_idactualizacion = '".$_POST['txt_cedula']."', dfecha_actualizacion = '".date('Y-m-d H:i:s')."' WHERE registrador_id = '".$usuario_id."'";	
			$rs11= $conn->Execute($SQL11);
			$valor=true;
	?>
			<script>
				alert("Su nueva contrase\u00F1a de acceso es: <?=$cedula?> \n y por medida de seguridad debe cambiarla al ingresar al sistema"); 
				window.location="/sistema_cpt/mod_login/login.php";
			</script> 
			<?php
			}else{
			$valor=false;
		?>
			<script>
				alert("- Los datos suministrados no coinciden con los registrados en el sistema;"); 
				window.location="/sistema_cpt/mod_login/login.php";
			</script> 
			
	<?		
		}
}
		
			
	
}

?>
