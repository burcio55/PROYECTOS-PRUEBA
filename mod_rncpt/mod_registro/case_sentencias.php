<?php
include("../../include/header.php");
include("../../include/bitacora.php"); 


$settings['debug'] = true;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
debug();
global $esquema; 
//$esquema = 'hcm';

			switch($_POST['opcion']){
					case '1': //GUARDA motor
						
						$sSQL="SELECT sdescripcion FROM rncpt.motor where sdescripcion='".strtoupper($_POST["txt_descripcion"])."' AND nenabled ='1'";	
						$rs = &$conn->Execute($sSQL);
							$tabla = "motor";
							$query = $sSQL;							
						
							if ($rs->RecordCount()>0){
								$valor='existe'; 
							}else{									
								$SQL1="INSERT INTO rncpt.motor
								(sdescripcion,  nenabled,dfecha_creacion, 
								usuario_idcreacion)
								VALUES('".strtoupper($_POST["txt_descripcion"])."', '1','".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."') ";	
								$rs1= &$conn->Execute($SQL1);
								
									$tabla = "motor";
									$query = $SQL1;
									
									if ($rs1){
										$valor='guardado'; 
									}else{
										$valor='error_guardar'; 
									}
							}

					break;
					
					
					case '2': //MODIFICA motor
						
						$SQL1="UPDATE rncpt.motor
						 SET sdescripcion='".strtoupper($_POST["txt_descripcion"])."',
						 dfecha_actualizacion='".date('Y-m-d H:i:s')."',
						 usuario_idactualizacion='".$_SESSION['id_usuario']."' WHERE id='".$_REQUEST['productividad_id']."' ";
						$rs1= &$conn->Execute($SQL1);
						
							$tabla = "motor";
							$query = $SQL1; 
							if ($rs1){
								$valor='modificado'; 
							}else{
								$valor='error_guardar'; 
							}
					break;
					
					
					case '3': //GUARDA registro_cargos
						
						$sSQL="SELECT descripcion_cargo FROM rncpt.cargos where descripcion_cargo='".strtoupper($_POST["txt_descripcion"])."' AND nenabled ='1'";	
						$rs = &$conn->Execute($sSQL);
							$tabla = "cargos";
							$query = $sSQL;							
						
							if ($rs->RecordCount()>0){
								$valor='existe'; 
							}else{									
								$SQL1="INSERT INTO rncpt.cargos
								(descripcion_cargo,  nenabled,dfecha_creacion, 
								usuario_idcreacion)
								VALUES('".strtoupper($_POST["txt_descripcion"])."', '1','".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."') ";	
								$rs1= &$conn->Execute($SQL1);
								
									$tabla = "cargos";
									$query = $SQL1;
									
									if ($rs1){
										$valor='guardado'; 
									}else{
										$valor='error_guardar'; 
									}
							}

					break;
					
					
					case '4': //MODIFICA cargos
						
						$SQL1="UPDATE rncpt.cargos
						 SET descripcion_cargo='".strtoupper($_POST["txt_descripcion"])."',
						 dfecha_actualizacion='".date('Y-m-d H:i:s')."',
						 usuario_idactualizacion='".$_SESSION['id_usuario']."' WHERE id='".$_REQUEST['cargos_id']."' ";
						$rs1= &$conn->Execute($SQL1);
						
							$tabla = "cargos";
							$query = $SQL1; 
							if ($rs1){
								$valor='modificado'; 
							}else{
								$valor='error_guardar'; 
							}
					break;
					
					
						case '5': //HABILITA-INHABILITA 						
						if ($_REQUEST['tipo']==1){ $nenabled='0'; }else{ $nenabled='1';}
						if ($_REQUEST['tabla']==1){ $tabla='motor';$esquema='rncpt';}
						if ($_REQUEST['tabla']==2){ $tabla='cargos';$esquema='rncpt';}
						if ($_REQUEST['tabla']==3){ $tabla='condicion_act';$esquema='rncpt';}
					    if ($_REQUEST['tabla']==4){ $tabla='condicion_laboral';$esquema='rncpt';}
						
						$SQL1="UPDATE ".$esquema.".".$tabla." SET nenabled='".$nenabled."' WHERE nenabled='".$_REQUEST['tipo']."' AND id='".$_REQUEST['id']."' ";	
								$rs1= &$conn->Execute($SQL1);
									
									$tabla = $tabla;
									$query = $SQL1;
								
									if ($rs1){
										$valor=$nenabled; 
									}
					break;
					
					
					case '6': //GUARDA condicion_actual
						
						$sSQL="SELECT sdescripcion FROM rncpt.condicion_act where sdescripcion='".strtoupper($_POST["txt_descripcion"])."' AND nenabled ='1'";	
						$rs = &$conn->Execute($sSQL);
							$tabla = "condicion";
							$query = $sSQL;							
						
							if ($rs->RecordCount()>0){
								$valor='existe'; 
							}else{									
								$SQL1="INSERT INTO rncpt.condicion_act
								(sdescripcion,  nenabled,dfecha_creacion, 
								usuario_idcreacion)
								VALUES('".strtoupper($_POST["txt_descripcion"])."', '1','".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."') ";	
								$rs1= &$conn->Execute($SQL1);
								
									$tabla = "condicion";
									$query = $SQL1;
									
									if ($rs1){
										$valor='guardado'; 
									}else{
										$valor='error_guardar'; 
									}
							}

					break;
					
					case '7': //MODIFICA condicion_actual
						
						$SQL1="UPDATE rncpt.condicion_act
						 SET sdescripcion='".strtoupper($_POST["txt_descripcion"])."',
						 dfecha_actualizacion='".date('Y-m-d H:i:s')."',
						 usuario_idactualizacion='".$_SESSION['id_usuario']."' WHERE id='".$_REQUEST['condicion_id']."' ";
						$rs1= &$conn->Execute($SQL1);
						
							$tabla = "condicion";
							$query = $SQL1; 
							if ($rs1){
								$valor='modificado'; 
							}else{
								$valor='error_guardar'; 
							}
					break;
					
					
		case '8': //GUARDA condicion_laboral
						
						$sSQL="SELECT sdescripcion FROM rncpt.condicion_laboral where sdescripcion='".strtoupper($_POST["txt_descripcion"])."' AND nenabled ='1'";	
						$rs = &$conn->Execute($sSQL);
							$tabla = "laboral";
							$query = $sSQL;							
						
							if ($rs->RecordCount()>0){
								$valor='existe'; 
							}else{									
								$SQL1="INSERT INTO rncpt.condicion_laboral
								(sdescripcion,  nenabled,dfecha_creacion,usuario_creacion)
								VALUES('".strtoupper($_POST["txt_descripcion"])."', '1','".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."') ";	
								$rs1= &$conn->Execute($SQL1);
								
									$tabla = "laboral";
									$query = $SQL1;
									
									if ($rs1){
										$valor='guardado'; 
									}else{
										$valor='error_guardar'; 
									}
							}

					break;
					
					case '9': //MODIFICA condicion_laboral
						
						$SQL1="UPDATE rncpt.condicion_laboral
						 SET sdescripcion='".strtoupper($_POST["txt_descripcion"])."',
						 dfecha_actualizacion='".date('Y-m-d H:i:s')."',
						 usuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id='".$_REQUEST['id']."' ";
						$rs1= &$conn->Execute($SQL1);
						
							$tabla = "laboral";
							$query = $SQL1; 
							if ($rs1){
								$valor='modificado'; 
							}else{
								$valor='error_guardar'; 
							}
					break;
					
					
					
					
					
	}
			
			
echo $valor;	
			
			
			
			
			

?>