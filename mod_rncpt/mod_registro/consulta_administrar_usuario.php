<?php
//-----------------------------------------------------
ini_set('display_errors',0); 
error_reporting(E_ALL | E_STRICT | E_DEPRECATED);
include('../include/header.php');
$conn= getConnDB($db1);
$conn->debug=false;
//-----------------------------------------------------
switch($_POST['opcion']){
					case '1':
													
							$SQL1="SELECT sesion.id, 
													 registrador_id, 
													 sclave, 
													 sesion.nenabled, 
													 ntipo,
													 entidad.sdescripcion as estado,
													 region.sdescripcion as region,
													 registrador.snacionalidad,
													 registrador.ncedula,
													 registrador.sprimer_apellido,
													 registrador.sprimer_nombre,													 													 registrador.fechanac
													 FROM scpt.sesion
										INNER JOIN scpt.registrador ON scpt.registrador.id=sesion.registrador_id
										INNER JOIN public.entidad ON public.entidad.nentidad=sesion.entidad_nentidad
										INNER JOIN public.region ON public.region.id=sesion.region_id 
										ORDER BY region.sdescripcion";
							$rs1=$conn->Execute($SQL1);								
								
									if($rs1->RecordCount()>0){
										
										$numero_miembros=$rs1->RecordCount();
										}else{
											$numero_miembros=0;	
											
										}

							$tabla='';	
							$tabla.='
								<div>
								<table id="tblDetalle" class="listado" align="center" onmousemove="llamar_tooltip();" style="width:100%;">
													<thead>
														<tr>
															<th width="8%">CI</th>
															<th width="18%">Apelllido</th>
															<th width="18%">Nombre</th>
															<th width="16%">Tipo de Usuario</th>
															<th width="15%">Region</th>
															<th width="15%">Estado</th>
															<th width="15%">Estatus</th>
															<th width="5%"></th>
															<th width="1%"></th>
															<th width="1%"></th>
														</tr>
													</thead>
													<tbody>';
																											
										while (!$rs1->EOF ){
											
										if($rs1->fields['snacionalidad']==1)	$nacionalidad="V"; 
										if($rs1->fields['snacionalidad']==2)	$nacionalidad="E";  
										
										if($rs1->fields['ntipo']==3){	$tipo="Responsable Estadal"; }
										if($rs1->fields['ntipo']==5){	$tipo="Responsable Regional";}
										if($rs1->fields['ntipo']==6){	$tipo="Responsable Nacional";}
										if($rs1->fields['ntipo']==4){	$tipo="Administrador"; }
										
										if($rs1->fields['nenabled']==1)	$activo="Habilitado";
										if($rs1->fields['nenabled']==0)	$activo="Inhabilitado";  
										$id=$rs1->fields['id'];
										$estatus=$rs1->fields['nenabled'];
										$imagen="<img src='../imagenes/editar.png' width='16' height='16' alt='Editar' />";	
										$accion="<a title='Editar Registro - Haga click para Editar Usuario' onclick='javascript:editar(".$id.")'>".$imagen."</a>";
										$imagen2="<img src='../imagenes/refrescar.png' width='16' height='16' alt='Restaurar' />";	
										$accion2="<a title='Restaurar Registro - Haga click para Restaurar Contrase&ntilde;a' onclick='javascript:clave(".$rs1->fields['registrador_id'].")'>".$imagen2."</a>";

										if($rs1->fields['nenabled']==0){
										$imagen1="<img src='../imagenes/aceptar.png' width='16' height='16' alt='Habilitar' />";	
										$accion1="<a title='Habilitar Registro - Haga click para Habilitar Usuario' onclick='javascript:estatus(".$id.",".$estatus.")'>".$imagen1."</a>";
										}else{
										$imagen1="<img src='../imagenes/eliminar.png' width='16' height='16' alt='Inhabilitar' />";	
										$accion1="<a title='Inhabilitar Registro - Haga click para Inhabilitar Usuario' onclick='javascript:estatus(".$id.",".$estatus.")'>".$imagen1."</a>";
										}
										
											$tabla.="<tr align='center'>
																			<td>".$nacionalidad.$rs1->fields['ncedula']."</td>
																			<td>".strtoupper($rs1->fields['sprimer_apellido'])."</td>
																			<td>".strtoupper($rs1->fields['sprimer_nombre'])."</td>
																			<td>".strtoupper($tipo)."</td>
																			<td>".utf8_decode(strtoupper($rs1->fields['region']))."</td>
																			<td>".strtoupper($rs1->fields['estado'])."</td>
																			<td>".strtoupper($activo)."</td>
																			<td>".$accion."</td>
																			<td>".$accion1."</td>
																			<td>".$accion2."</td>
																		</tr>
																		";
											$rs1->MoveNext();									
										 }
							$tabla.='
														</tbody>
												</table>
												</div>';
							$valor=$tabla."|".$numero_registros;
					break;
					case '2': //ACTIVO-INACTIVO					
								
						$SQL2="UPDATE scpt.sesion SET 
								nenabled='".$_POST['estatus']."', 
								usuario_idactualizacion='".$_SESSION['usuario_id']."', 
								dfecha_actualizacion='".date('Y-m-d H:i:s')."'
								WHERE id='".$_POST['id']."' " ;								
						$rs2=$conn->Execute($SQL2);
						
									if($rs2){
										$valor="exito"; 
									}else{
										$valor="error_guardar"; 
									}					
					break;	
					case '3': //Editar
							
						$SQL="UPDATE scpt.registrador SET ncedula='".$_POST['cedula']."', 
											snacionalidad='".$_POST['nacionalidad']."', 
											sprimer_apellido='".strtoupper($_POST['apellido1'])."', 
											ssegundo_apellido='".strtoupper($_POST['apellido2'])."', 
											sprimer_nombre='".strtoupper($_POST['nombre1'])."', 
											ssegundo_nombre='".strtoupper($_POST['nombre2'])."',
											fechanac='".$_POST['fechanac']."' ,
											usuario_idactualizacion='".$_SESSION['usuario_id']."',
											dfecha_actualizacion='".date('Y-m-d H:i:s')."' 
									 WHERE id='".$_POST['registrador']."' AND nenabled='1'" ;								
						$rs=$conn->Execute($SQL);
						
						if($_POST['cbo_usuario']==5)$tipo='5';
						if($_POST['cbo_usuario']==3)$tipo='3';
						if($_POST['cbo_usuario']==6)$tipo='6';
						if($_POST['cbo_usuario']==4)$tipo='4';
						
						
						
						$SQL1="UPDATE scpt.sesion SET 
								registrador_id='".$_POST['registrador']."',
								entidad_nentidad='".$_POST['cbo_entidad']."',
								region_id='".$_POST['cbo_region']."',
								ntipo='".$tipo."',
								usuario_idactualizacion='".$_SESSION['usuario_id']."', 
								dfecha_actualizacion='".date('Y-m-d H:i:s')."'
								WHERE id='".$_POST['sesion_id']."' AND registrador_id='".$_POST['registrador']."' AND nenabled='1'" ;								
						$rs1=$conn->Execute($SQL1);
						
									if($rs1){
										$valor="modificado"; 
									}else{
										$valor="error_guardar"; 
									}					
					break;	
					case '4': //Guardar
					
						$SQL="SELECT registrador.id 
										FROM scpt.registrador 
										INNER JOIN scpt.sesion ON scpt.sesion.registrador_id=registrador.id
										WHERE ncedula='".$_POST['cedula']."' AND snacionalidad='".$_POST['nacionalidad']."'
										" ;		
										// AND sesion.nenabled='1' 						
						$rs=$conn->Execute($SQL);
						
						if($rs->RecordCount()>0){
							$valor="existe"; 
						}else{
			
						$SQL="SELECT id FROM scpt.registrador WHERE ncedula='".$_POST['cedula']."' AND snacionalidad='".$_POST['nacionalidad']."' AND nenabled='1' " ;								
						$rs=$conn->Execute($SQL);
						
							if($rs->RecordCount()>0){
								
									$SQL1="UPDATE scpt.registrador SET ncedula='".$_POST['cedula']."', 
														snacionalidad='".$_POST['nacionalidad']."', 
														sprimer_apellido='".strtoupper($_POST['apellido1'])."', 
														ssegundo_apellido='".strtoupper($_POST['apellido2'])."', 
														sprimer_nombre='".strtoupper($_POST['nombre1'])."', 
														ssegundo_nombre='".strtoupper($_POST['nombre2'])."',
														fechanac='".$_POST['fechanac']."', 
														usuario_idactualizacion='".$_SESSION['usuario_id']."',
														dfecha_actualizacion='".date('Y-m-d H:i:s')."' 
												 WHERE id='".$rs->fields['id']."' AND nenabled='1'" ;								
									$rs1=$conn->Execute($SQL1);
									
									if($_POST['cbo_usuario']==5)$tipo='5';
									if($_POST['cbo_usuario']==3)$tipo='3';
									if($_POST['cbo_usuario']==6)$tipo='6';
									if($_POST['cbo_usuario']==4)$tipo='4';
									
									$SQL2="INSERT INTO scpt.sesion(registrador_id,
												sclave,
												entidad_nentidad,
												region_id,
												ntipo,
												usuario_idcreacion,
												dfecha_creacion,
												nenabled)
											 VALUES (
											'".$rs->fields['id']."',
											'".md5($_POST['cedula'])."',
											'".$_POST['cbo_entidad']."',
											'".$_POST['cbo_region']."',
											'".$tipo."',
											'".$_SESSION['usuario_id']."', 
											'".date('Y-m-d H:i:s')."',
											'1')" ;								
									$rs2=$conn->Execute($SQL2);
									
										if($rs2){
												$valor="guardado"; 
											}else{
												$valor="error_guardar"; 
											}

									
							}else{
								
									$SQL1="INSERT INTO scpt.registrador(ncedula,
												snacionalidad,
												sprimer_apellido,
												ssegundo_apellido,
												sprimer_nombre,
												ssegundo_nombre,
												fechanac,
												usuario_idcreacion,
												dfecha_creacion,
												nenabled)
												VALUES (
												'".$_POST['cedula']."', 
												'".$_POST['nacionalidad']."', 
												'".strtoupper($_POST['apellido1'])."', 
												'".strtoupper($_POST['apellido2'])."', 
												'".strtoupper($_POST['nombre1'])."', 
												'".strtoupper($_POST['nombre2'])."',
												'".$_POST['fechanac']."', 
												'".$_SESSION['usuario_id']."',
												'".date('Y-m-d H:i:s')."', 
												 '1')" ;								
									$rs1=$conn->Execute($SQL1);
									
									$SQL2="SELECT id FROM scpt.registrador WHERE ncedula='".$_POST['cedula']."' AND snacionalidad='".$_POST['nacionalidad']."' AND nenabled='1' " ;								
									$rs2=$conn->Execute($SQL2);
									
									if($_POST['cbo_usuario']==5)$tipo='5';
									if($_POST['cbo_usuario']==3)$tipo='3';
									if($_POST['cbo_usuario']==3)$tipo='6';
									if($_POST['cbo_usuario']==4)$tipo='4';

									
									$SQL3="INSERT INTO scpt.sesion(registrador_id,
												sclave,
												entidad_nentidad,
												region_id,
												ntipo,
												usuario_idcreacion,
												dfecha_creacion,
												nenabled)
											 VALUES (
											'".$rs2->fields['id']."',
											'".md5($_POST['cedula'])."',
											'".$_POST['cbo_entidad']."',
											'".$_POST['cbo_region']."',
											'".$tipo."',
											'".$_SESSION['usuario_id']."', 
											'".date('Y-m-d H:i:s')."',
											'1')" ;								
									$rs3=$conn->Execute($SQL3);
																
											if($rs3){
												$valor="guardado"; 
											}else{
												$valor="error_guardar"; 
											}
								
							}
									
						}
					break;			
					case '5': //CLAVE					
								
								
						$SQL="SELECT ncedula FROM scpt.registrador WHERE id='".$_POST['id']."' AND nenabled='1' " ;								
						$rs=$conn->Execute($SQL);
						
						if($rs->RecordCount()>0){	
							
								$SQL1="UPDATE scpt.sesion SET 
										sclave='".md5($rs->fields['ncedula'])."',
										usuario_idactualizacion='".$_SESSION['usuario_id']."', 
										dfecha_actualizacion='".date('Y-m-d H:i:s')."'
										WHERE registrador_id='".$_POST['id']."' AND nenabled='1'" ;								
								$rs1=$conn->Execute($SQL1);
						}
									if($rs1){
										$valor="clave"; 
									}else{
										$valor="error_guardar"; 
									}					
					break;	
}
echo $valor;
?>
