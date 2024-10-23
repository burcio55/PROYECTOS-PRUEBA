<?php
include("../include/header.php");
include("../include/bitacora.php"); 


$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
debug();
global $esquema;
//$esquema = 'hcm';

			switch($_POST['opcion']){
					case '1': //GUARDA oac_via_recepcion
						
						$sSQL="SELECT sdecripcion_via_recepcion FROM oac.via_recepcion where sdecripcion_via_recepcion='".strtoupper($_POST["txt_descripcion"])."' AND nenabled ='1'";	
						$rs = &$conn->Execute($sSQL);
							$tabla = "via_recepcion";
							$query = $sSQL;							
						
							if ($rs->RecordCount()>0){
								$valor='existe'; 
							}else{									
								$SQL1="INSERT INTO oac.via_recepcion
								(sdecripcion_via_recepcion,  nenabled,dfecha_creacion, 
								nusuario_creacion)
								VALUES('".strtoupper($_POST["txt_descripcion"])."', '1','".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."') ";	
								$rs1= &$conn->Execute($SQL1);
								
									$tabla = "via_recepcion";
									$query = $SQL1;
									
									if ($rs1){
										$valor='guardado'; 
									}else{
										$valor='error_guardar'; 
									}
							}

					break;
					
					
					case '2': //MODIFICA estatus_caso
						
						$SQL1="UPDATE oac.status_caso
						 SET sdescripcion_status='".strtoupper($_POST["txt_descripcion"])."',
						 dfecha_actualizacion='".date('Y-m-d H:i:s')."',
						 nusuario_atualizacion='".$_SESSION['id_usuario']."' WHERE id_status='".$_REQUEST['id']."' ";
						$rs1= &$conn->Execute($SQL1);
						
							$tabla = "status_caso";
							$query = $SQL1;	

							if ($rs1){
								$valor='modificado'; 
							}else{
								$valor='error_guardar'; 
							}
					break;
					
					
					case '3': //GUARDA tipo_asistencia						
						$sSQL="SELECT stipo_asistencia FROM oac.tipo_asistencia where stipo_asistencia='".strtoupper($_POST["txt_descripcion"])."' AND nenabled ='1'";	
						$rs = &$conn->Execute($sSQL);
							$tabla = "tipo_asitencia";
							$query = $sSQL;									
							if ($rs->RecordCount()>0){
								$valor='existe'; 
							}else{									
								$SQL1="INSERT INTO oac.tipo_asistencia
								(stipo_asistencia,  nenabled,dfecha_creacion, 
								nusuario_creacion)
								VALUES('".strtoupper($_POST["txt_descripcion"])."', '1','".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."') ";	
								$rs1= &$conn->Execute($SQL1);								
									$tabla = "tipo_asistencia";
									$query = $SQL1;
									
									if ($rs1){
										$valor='guardado'; 
									}else{
										$valor='error_guardar'; 
									}
							}

					break;
					
					
					case '4': //MODIFICA tipo_asistencia
						
						$SQL1="UPDATE oac.tipo_asistencia
						 SET stipo_asistencia='".strtoupper($_POST["txt_descripcion"])."',
						 dfecha_actualizacion='".date('Y-m-d H:i:s')."',
						 nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id_tipo_asistencia='".$_REQUEST['id']."' ";
						$rs1= &$conn->Execute($SQL1);
						
							$tabla = "tipo_asistencia";
							$query = $SQL1;	

							if ($rs1){
								$valor='modificado'; 
							}else{
								$valor='error_guardar'; 
							}
					break;

					
						case '5': //HABILITA-INHABILITA 						
						if ($_REQUEST['tipo']==1){ $nenabled='0'; }else{ $nenabled='1';}
//						if ($_REQUEST['tabla']==1){ $tabla='discapacidad';$esquema='public';  $id="id";}
						if ($_REQUEST['tabla']==2){ $tabla='status_caso';$esquema='oac';$id="id_status";}
						if ($_REQUEST['tabla']==3){ $tabla='via_recepcion';$esquema='oac';$id="id_via_recepcion";}
						if ($_REQUEST['tabla']==4){ $tabla='tipo_asistencia';$esquema='oac'; $id="id_tipo_asistencia";}
						if ($_REQUEST['tabla']==5){ $tabla='organismos';$esquema='oac'; $id="id_organismo";}
						if ($_REQUEST['tabla']==6){ $tabla='gestion_detalle';$esquema='oac'; $id="id_gestion";}
						if ($_REQUEST['tabla']==7){ $tabla='caso_tipo_correccion';$esquema='oac'; $id="id_tipo_caso";}
						if ($_REQUEST['tabla']==8){ $tabla='caso_detalle_correccion';$esquema='oac'; $id="id_detalle_caso";}
						if ($_REQUEST['tabla']==9){ $tabla='caso_dato_correccion';$esquema='oac'; $id="id_dato";}
						$SQL1="UPDATE ".$esquema.".".$tabla." SET nenabled='".$nenabled."' WHERE nenabled='".$_REQUEST['tipo']."' AND ".$id."='".$_REQUEST['id']."' ";	
								$rs1= &$conn->Execute($SQL1);
									
									$tabla = $tabla;
									$query = $SQL1;
								
									if ($rs1){
										$valor=$nenabled; 
									}
					break;
					
					
					case '6': //GUARDA via_recepcion
						
						$sSQL="SELECT sdecripcion_via_recepcion FROM oac.via_recepcion where sdecripcion_via_recepcion='".strtoupper($_POST["txt_descripcion"])."' AND nenabled ='1'";	
						$rs = &$conn->Execute($sSQL);
							$tabla = "via_recepcion";
							$query = $sSQL;									
							if ($rs->RecordCount()>0){
								$valor='existe'; 
							}else{									
								$SQL1="INSERT INTO oac.via_recepcion
								(sdecripcion_via_recepcion,  nenabled,dfecha_creacion, 
								nusuario_creacion)
								VALUES('".strtoupper($_POST["txt_descripcion"])."', '1','".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."') ";	
								$rs1= &$conn->Execute($SQL1);								
									$tabla = "tipo_asistencia";
									$query = $SQL1;
									
									if ($rs1){
										$valor='guardado'; 
									}else{
										$valor='error_guardar'; 
									}
							}

					break;
					
					case '7': //MODIFICA via_recepcion
						
						$SQL1="UPDATE oac.via_recepcion
						 SET sdecripcion_via_recepcion='".strtoupper($_POST["txt_descripcion"])."',
						 dfecha_actualizacion='".date('Y-m-d H:i:s')."',
						 nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id_via_recepcion='".$_REQUEST['id']."' ";
						$rs1= &$conn->Execute($SQL1);
						
							$tabla = "via_recepcion";
							$query = $SQL1;	

							if ($rs1){
								$valor='modificado'; 
							}else{
								$valor='error_guardar'; 
							}
					break;
					
					case '8': //GUARDA estatus_del_caso
						
						$sSQL="SELECT sdescripcion_status FROM oac.status_caso where sdescripcion_status='".strtoupper($_POST["txt_descripcion"])."' AND nenabled ='1'";	
						$rs = &$conn->Execute($sSQL);
							$tabla = "estatus_del_caso";
							$query = $sSQL;							
						
							if ($rs->RecordCount()>0){
								$valor='existe'; 
							}else{								
								$SQL1="INSERT INTO oac.status_caso(sdescripcion_status, 
																	nusuario_creacion,
																	dfecha_creacion,
																	nenabled)
								VALUES('".strtoupper($_POST["txt_descripcion"])."',
									   '".$_SESSION['id_usuario']."',
									   '".date('Y-m-d H:i:s')."',
									   '1') ";	
								$rs1= &$conn->Execute($SQL1);
								
									$tabla = "estatus_del_caso";
									$query = $SQL1;
									
									if ($rs1){
										$valor='guardado'; 
									}else{
										$valor='error_guardar'; 
									}
							}

					break;
					
					
					case '9': //MODIFICA estatus_del_caso
						
						$SQL1="UPDATE oac.status_caso
							   SET  sdescripcion_status='".strtoupper($_POST["txt_descripcion"])."', 
									nusuario_actualizacion='".$_SESSION['id_usuario']."',
									dfecha_actualizacion='".date('Y-m-d H:i:s')."'
								WHERE id_status='".$_REQUEST['id_status']."' ";	
						$rs1= &$conn->Execute($SQL1);
						
							$tabla = "estatus_del_caso";
							$query = $SQL1;	

							if ($rs1){
								$valor='modificado'; 
							}else{
								$valor='error_guardar'; 
							}
					break;
					
					case '10': //GUARDA organismo
						
						$sSQL="SELECT sorganismo FROM oac.organismos where sorganismo='".strtoupper($_POST["txt_descripcion"])."' AND nenabled ='1'";	
						$rs = &$conn->Execute($sSQL);
							$tabla = "organismo";
							$query = $sSQL;							
						
							if ($rs->RecordCount()>0){
								$valor='existe'; 
							}else{								
								$SQL1="INSERT INTO oac.organismos(sorganismo, 
																	nusuario_creacion,
																	dfecha_creacion,
																	nenabled)
								VALUES('".strtoupper($_POST["txt_descripcion"])."',
									   '".$_SESSION['id_usuario']."',
									   '".date('Y-m-d H:i:s')."',
									   '1') ";	
								$rs1= &$conn->Execute($SQL1);
								
									$tabla = "organismo";
									$query = $SQL1;
									
									if ($rs1){
										$valor='guardado'; 
									}else{
										$valor='error_guardar'; 
									}
							}

					break;
					
					
					case '11': //MODIFICA organismos
						
						$SQL1="UPDATE oac.organismos
						 SET sorganismo='".strtoupper($_POST["txt_descripcion"])."',
						 dfecha_actualizacion='".date('Y-m-d H:i:s')."',
						 nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id_organismo='".$_REQUEST['id']."' ";
						$rs1= &$conn->Execute($SQL1);
						
							$tabla = "organismos";
							$query = $SQL1;	

							if ($rs1){
								$valor='modificado'; 
							}else{
								$valor='error_guardar'; 
							}
					break;
					
					
					case '12': //GUARDA gestion
						
						$sSQL="SELECT sgestion_detalle FROM oac.gestion_detalle where sgestion_detalle='".strtoupper($_POST["txt_descripcion"])."' AND nenabled ='1'";	
						$rs = &$conn->Execute($sSQL);
							$tabla = "gestion";
							$query = $sSQL;							
						
							if ($rs->RecordCount()>0){
								$valor='existe'; 
							}else{								
								$SQL1="INSERT INTO oac.gestion_detalle(sgestion_detalle, 
																	nusuario_creacion,
																	dfecha_creacion,
																	nenabled)
								VALUES('".strtoupper($_POST["txt_descripcion"])."',
									   '".$_SESSION['id_usuario']."',
									   '".date('Y-m-d H:i:s')."',
									   '1') ";	
								$rs1= &$conn->Execute($SQL1);
								
									$tabla = "gestion";
									$query = $SQL1;
									
									if ($rs1){
										$valor='guardado'; 
									}else{
										$valor='error_guardar'; 
									}
							}

					break;
					
					
					case '13': //MODIFICA gestion
						
						$SQL1="UPDATE oac.gestion_detalle
						 SET sgestion_detalle='".strtoupper($_POST["txt_descripcion"])."',
						 dfecha_actualizacion='".date('Y-m-d H:i:s')."',
						 nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id_gestion='".$_REQUEST['id']."' ";
						$rs1= &$conn->Execute($SQL1);
						
							$tabla = "gestion";
							$query = $SQL1;	

							if ($rs1){
								$valor='modificado'; 
							}else{
								$valor='error_guardar'; 
							}
					break;
					
					
					case '14': //GUARDA caso_tipo_correccion
						
						$sSQL="SELECT sdescripcion_tipo_caso FROM oac.caso_tipo_correccion where sdescripcion_tipo_caso='".strtoupper($_POST["txt_descripcion"])."' AND nenabled ='1'";	
						$rs = &$conn->Execute($sSQL);
							$tabla = "caso_tipo_correccion";
							$query = $sSQL;							
						
							if ($rs->RecordCount()>0){
								$valor='existe'; 
							}else{								
								$SQL1="INSERT INTO oac.caso_dato_correccion(sdescripcion_tipo_caso, 
																	nusuario_creacion,
																	dfecha_creacion,
																	nenabled)
								VALUES('".strtoupper($_POST["txt_descripcion"])."',
									   '".$_SESSION['id_usuario']."',
									   '".date('Y-m-d H:i:s')."',
									   '1') ";	
								$rs1= &$conn->Execute($SQL1);
								
									$tabla = "caso_tipo_correccion";
									$query = $SQL1;
									
									if ($rs1){
										$valor='guardado'; 
									}else{
										$valor='error_guardar'; 
									}
							}

					break;
					
					
					case '15': //MODIFICA caso_tipo_correccion
						
						$SQL1="UPDATE oac.caso_tipo_correccion
						 SET sdescripcion_tipo_caso='".strtoupper($_POST["txt_descripcion"])."',
						 dfecha_actualizacion='".date('Y-m-d H:i:s')."',
						 nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id_tipo_caso='".$_REQUEST['id']."' ";
						$rs1= &$conn->Execute($SQL1);
						
							$tabla = "caso_tipo_correccion";
							$query = $SQL1;	

							if ($rs1){
								$valor='modificado'; 
							}else{
								$valor='error_guardar'; 
							}
					break;
					
					case '16': //GUARDA detalle_rnet
						
						$sSQL="SELECT sdescripcion_detalle_caso FROM oac.caso_detalle_correccion where sdescripcion_detalle_caso='".strtoupper($_POST["txt_descripcion"])."' AND nenabled ='1'";	
						$rs = &$conn->Execute($sSQL);
							$tabla = "detalle_caso_rnet";
							$query = $sSQL;							
						
							if ($rs->RecordCount()>0){
								$valor='existe'; 
							}else{								
								$SQL1="INSERT INTO oac.caso_detalle_correccion(sdescripcion_detalle_caso, 
																	nusuario_creacion,
																	dfecha_creacion,
																	nenabled)
								VALUES('".strtoupper($_POST["txt_descripcion"])."',
									   '".$_SESSION['id_usuario']."',
									   '".date('Y-m-d H:i:s')."',
									   '1') ";	
								$rs1= &$conn->Execute($SQL1);
								
									$tabla = "detalle_caso_RNET";
									$query = $SQL1;
									
									if ($rs1){
										$valor='guardado'; 
									}else{
										$valor='error_guardar'; 
									}
							}

					break;
					
					
					case '17': //MODIFICA detalle_rnet
						
						$SQL1="UPDATE oac.caso_detalle_correccion
						 SET sdescripcion_detalle_caso='".strtoupper($_POST["txt_descripcion"])."',
						 dfecha_actualizacion='".date('Y-m-d H:i:s')."',
						 nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id_detalle_caso='".$_REQUEST['id']."' ";
						$rs1= &$conn->Execute($SQL1);
						
							$tabla = "dettale_caso_rnet";
							$query = $SQL1;	

							if ($rs1){
								$valor='modificado'; 
							}else{
								$valor='error_guardar'; 
							}
					break;
					
					
					case '18': //GUARDA caso_dato_correccion
						
						$sSQL="SELECT sdescripcion_dato FROM oac.caso_dato_correccion where sdescripcion_dato='".strtoupper($_POST["txt_descripcion"])."' AND nenabled ='1'";	
						$rs = &$conn->Execute($sSQL);
							$tabla = "caso_dato_correccion";
							$query = $sSQL;							
						
							if ($rs->RecordCount()>0){
								$valor='existe'; 
							}else{								
								$SQL1="INSERT INTO oac.caso_dato_correccion(sdescripcion_dato, 
																	nusuario_creacion,
																	dfecha_creacion,
																	nenabled)
								VALUES('".strtoupper($_POST["txt_descripcion"])."',
									   '".$_SESSION['id_usuario']."',
									   '".date('Y-m-d H:i:s')."',
									   '1') ";	
								$rs1= &$conn->Execute($SQL1);
								
									$tabla = "caso_dato_correccion";
									$query = $SQL1;
									
									if ($rs1){
										$valor='guardado'; 
									}else{
										$valor='error_guardar'; 
									}
							}

					break;
					
					
					case '19': //MODIFICA caso_dato_correccion
						
						$SQL1="UPDATE oac.caso_dato_correccion
						 SET sdescripcion_dato='".strtoupper($_POST["txt_descripcion"])."',
						 dfecha_actualizacion='".date('Y-m-d H:i:s')."',
						 nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id_dato='".$_REQUEST['id']."' ";
						$rs1= &$conn->Execute($SQL1);
						
							$tabla = "caso_dato_correccion";
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