<?php
//-----------------------------------------------------
ini_set('display_errors',0); 
error_reporting(E_ALL | E_STRICT | E_DEPRECATED);
include("../../include/header.php"); 
$conn= getConnDB($db1);
$conn->debug=false;
$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname,$username,$password,$db_settings[1]);
$conn1->debug=false;
$conn2 = &ADONewConnection($target);
$conn2->PConnect($hostname,$username,$password,$db_settings[3]);
$conn2->debug=false;
//-----------------------------------------------------
switch($_POST['opcion']){
			case '1':

				if (isset($_POST['rif'])){
					
						$SQL="SELECT rnee_empresa.srif as rif,
									rnee_empresa.srazon_social as empresa_razon_social,
									rnee_empresa.sdenominacion_comercial as sdenominacion_comercial,
									rnee_empresa.sdireccion_fiscal as sdireccion_fiscal
									FROM rnee.rnee_empresa
									LEFT JOIN rnee.rnee_estatus_movimiento ON rnee_estatus_movimiento.id_rnee_empresa=rnee_empresa.id
									LEFT JOIN rnee.rnee_condicion_actividad_movimiento on rnee_condicion_actividad_movimiento.rnee_empresa_id=rnee_empresa.id
									where rnee_empresa.srif='".$_POST['rif']."' 
									AND rnee_estatus_movimiento.id_rnee_estatus='5'
									AND rnee_estatus_movimiento.nenabled=1
									AND rnee_estatus_movimiento.nenabled=1
									AND rnee_condicion_actividad_movimiento.nenabled=1 limit 1";
						$rs = &$conn2->Execute($SQL);
					
						if ($rs->RecordCount()>0){
						$valor=$rs->fields['empresa_razon_social']."|".
						$rs->fields['sdenominacion_comercial']."|".
						$rs->fields['sdireccion_fiscal'];					
						}else{
							
							$SQL="SELECT * FROM seniat WHERE srif='".$_REQUEST['rif']."' ";
							$rs = &$conn1->Execute($SQL);
							if ($rs->RecordCount()>0){							
								$valor=$rs->fields['srazon_social']."|".
								$rs->fields['sdenominacion_comercial']."|".
								$rs->fields['sdireccion_fiscal'];					
							}else{
							 $valor="ENTIDAD DE TRABAJO NO REGISTRADA EN EL SENIAT";
							}
						}
				}
			break;
			case '2':
			if($_SESSION['id_usuario']){
			/*if($_POST['estado']!=''){$condicion="AND entidad_nentidad='".$_POST['estado']."'";}else{$condicion="";}*/						
				$SQL="SELECT empresa.id, 				
								empresa.entidad_nentidad,
								sdenominacion_comercial, 
								srazon_social, 
								sdireccion_fiscal,
								motor.sdescripcion as motor, 
								entidad.sdescripcion as entidad, 
								municipio.sdescripcion as municipio, 
								region.sdescripcion as region, 
								srif, 
								rncpt.empresa.usuario_idcreacion, 
								empresa.usuario_idactualizacion, 
								empresa.nenabled,empresa.nro_boleta
								FROM rncpt.empresa
								INNER JOIN public.region ON public.region.id=rncpt.empresa.region_id
								INNER JOIN rncpt.empresa_motor ON rncpt.empresa.id=rncpt.empresa_motor.empresa_id
								INNER JOIN rncpt.motor ON rncpt.motor.id=rncpt.empresa_motor.motor_id
								INNER JOIN public.entidad ON public.entidad.nentidad=rncpt.empresa.entidad_nentidad
								INNER JOIN public.municipio ON public.municipio.nmunicipio=rncpt.empresa.municipio_nmunicipio
								WHERE rncpt.empresa.usuario_idcreacion='".$_SESSION['id_usuario']."' AND empresa.nenabled='1' and empresa.nro_boleta IS NULL 
								ORDER BY srazon_social";
								//$conn->debug=true;
								$rs=$conn->Execute($SQL);								
								
										if($rs->RecordCount()>0){
											$numero_registros=$rs->RecordCount();
										}else{
											$numero_registros=0;	
										}
							$tabla_1='
								<div>
								<table id="tblDetalle" align="center" onmousemove="llamar_tooltip();" style="width:100%;">
									<thead>
									<th colspan="9" class="sub_titulo" style="border: none"><div align="left">Listado de CPTT Pendientes por Completar el registro</div></th>
                            </tr>
							
							 	<tr>
									<td colspan="9" style="border: none"> </td> 
								</tr>
	
							<tr>
								<th class="sub_titulo" width="13%" align="center"><div align="center">Raz&oacute;n Social</div></th>
								<th class="sub_titulo" width="12%" align="center"><div align="center">Denominaci&oacute;n Comercial</div></th>
								<th class="sub_titulo" width="14%" align="center"><div align="center">Direcci&oacute;n Fiscal</div></th>
								<th class="sub_titulo" width="14%" align="center"><div align="center">Motor</div></th>
								<th class="sub_titulo" width="10%" align="center"><div align="center">RIF</div></th>
								<th class="sub_titulo" width="12%" align="center"><div align="center">Regi&oacute;n</div></th>
								<th class="sub_titulo" width="12%" align="center"><div align="center">Estado</div></th>
								<th class="sub_titulo" width="12%" align="center"><div align="center">Municipio</div></th>
								<th class="sub_titulo" width="1%"  align="center"></th>
							</tr>
							<tbody>';
										
								if($_SESSION['id_usuario']){
			
					while (!$rs->EOF ){
					unset($_SESSION['empresa_id']);
					$id=$rs->fields['id'];
					$entidad=$rs->fields['entidad_nentidad'];
					$imagen="<img src='../imagenes/agregar.png' width='16' height='16' alt='Agregar' />";	
					$accion="<a title='Completar Registro - Haga clic para Agregar Voceros del CPTT' onclick='javascript:ir_vocero(".$id.",".$entidad.")'>".$imagen."</a>";
					$tabla_2=$tabla_2."<tr align='center'>
																			<td>".$rs->fields['srazon_social']."</td>
																			<td>".$rs->fields['sdenominacion_comercial']."</td>
																			<td>".$rs->fields['sdireccion_fiscal']."</td>
																			<td>".$rs->fields['motor']."</td>
																			<td>".$rs->fields['srif']."</td>
																			<td>".strtoupper($rs->fields['region'])."</td>
																			<td>".strtoupper($rs->fields['entidad'])."</td>
																			<td>".strtoupper($rs->fields['municipio'])."</td>
																			<td>".$accion."</td>
																		</tr>";
											$rs->MoveNext();									
										 }
									}
							$tabla_3='
														</tbody>
													</thead>
												</table>
												</div>
												';
												
								if($_SESSION['id_usuario']){
									$tabla=$tabla_1.$tabla_2.$tabla_3;
								}else{
									$tabla=$tabla_1.$tabla_3;
								}
												
							$valor=$tabla."|".$numero_registros;
						}
					break;
					case '3':
						$SQL="SELECT id ,entidad_nentidad FROM rncpt.empresa WHERE id='".$_POST['id']."' AND usuario_idcreacion='".$_SESSION['id_usuario']."' AND nenabled=1";
						$rs = &$conn->Execute($SQL);
						if ($rs->RecordCount()>0){
						unset($_SESSION['empresa_id']);	
						$_SESSION['empresa_id']=$rs->fields['id'];	
						$_SESSION['entidad']=$rs->fields['entidad_nentidad'];
						$valor="ir";
						}else{
						 $valor="vacio";
						}
					break;
					case '4': //CONSULTA GLOBAL						
						if($_SESSION['id_usuario']){
							
								if($_POST['cbo_region2']!=''){ $sql1="region_id='".$_POST['cbo_region2']."' AND  ";}
								if($_POST['cbo_entidad2']!=''){ $sql2="entidad_nentidad='".$_POST['cbo_entidad2']."' AND ";}
								if($_POST['cbo_estado_consulta']!=''){ $sql3="entidad_nentidad='".$_POST['cbo_estado_consulta']."' AND";}
								if(($_SESSION["ntipo"]=='5') and  $_SESSION["nregion"]!=''){ $sql4="nregion ='".$_SESSION["nregion"]."' AND";}
								if($_SESSION["ntipo"]=='6' and $_POST['valor']=='1' and  $_SESSION["nregion"]!=''){ $sql5="nregion ='".$_SESSION["nregion"]."' AND";}
							
								
								$SQL="SELECT empresa.id as id,
													sdenominacion_comercial, 
													srazon_social, 
													sdireccion_fiscal, 
													sdireccion,
													entidad.sdescripcion as entidad, 
													municipio.sdescripcion as municipio, 
													region.sdescripcion as region, 
													srif,
													norigen, 
													usuario_idcreacion, 
													empresa.usuario_idactualizacion, 
													empresa.nenabled
								FROM rncpt.empresa
								LEFT JOIN public.region ON public.region.id=rncpt.empresa.region_id
								LEFT JOIN public.entidad ON public.entidad.nentidad=rncpt.empresa.entidad_nentidad
								LEFT JOIN public.municipio ON public.municipio.nmunicipio=rncpt.empresa.municipio_nmunicipio
								WHERE ".$sql1." ".$sql2." ".$sql3." ".$sql4." ".$sql5." empresa.nenabled='1' ORDER BY srazon_social";
								$rs=$conn->Execute($SQL);								
								
										if($rs->RecordCount()>0){
											$numero_registros=$rs->RecordCount();
										}else{
											$numero_registros=0;	
										}
							$tabla_1='
								<div>
								<table id="tblDetalle" align="center" onmousemove="llamar_tooltip();" style="width:95%;">
													<thead>
								<tr>
									<td colspan="4"> </td> 
								</tr>
														<tr>
														<tr>
															<th class="sub_titulo"width="12%"><div align="center">Raz&oacute;n Social</div></th>
															<th class="sub_titulo" width="12%"><div align="center">Denominaci&oacute;n Comercial</div></th>
															<th class="sub_titulo" width="13%"><div align="center">Direcci&oacute;n Fiscal</div></th>
															<th class="sub_titulo" width="13%"><div align="center">Otra Direcci&oacute;n</div></th>
															<th class="sub_titulo" width="9%"><div align="center">RIF</div></th>
															<th class="sub_titulo" width="4%"><div align="center">Estatus</div></th>
															<th class="sub_titulo" width="11%"><div align="center">Regi&oacute;n</div></th>
															<th class="sub_titulo" width="11%"><div align="center">Estado</div></th>
															<th class="sub_titulo" width="12%"><div align="center">Municipio</div></th>
															<th class="sub_titulo" width="1%"><div align="center"></div></th>
															<th class="sub_titulo" width="1%"><div align="center"></div></th>
															<th class="sub_titulo" width="1%"><div align="center"></div></th>
														</tr>
														</tr>
														<tbody>';
										
								if($_SESSION['id_usuario']){
			
										while (!$rs->EOF ){
										unset($_SESSION['empresa_id']);
										$id=$rs->fields['id'];
										if($rs->fields['norigen']==1)	$origen="L"; 
										if($rs->fields['norigen']==2)	$origen="N";  
										$imagen="<img src='../imagenes/eye.png' width='16' height='16' alt='Agregar' />";	
										$accion="<a title='Ver Registro - Haga clic para Ver Registro' onclick='javascript:ver_formulario(".$id.")'>".$imagen."</a>";
										if($_SESSION['ntipo']==4){
										$imagen2="<img src='../imagenes/editar.png' width='16' height='16' alt='editar' />";	
										$accion2="<a title='Editar Registro - Haga click para Editar este Registro' onclick='javascript:editar(".$id.",1)'>".$imagen2."</a>";
										$imagen3="<img src='../imagenes/bloqueado.png' width='16' height='16' alt='Inhabilitar' />";	
										$accion3="<a title='Inhabilitar Registro - Haga clic para Inhabilitar este Registro' onclick='javascript:inactivo(".$id.")'>".$imagen3."</a>";

										}
										
											$tabla_2=$tabla_2."<tr align='center'>
																			<td>".$rs->fields['srazon_social']."</td>
																			<td>".$rs->fields['sdenominacion_comercial']."</td>
																			<td>".$rs->fields['sdireccion_fiscal']."</td>
																			<td>".$rs->fields['sdireccion']."</td>
																			<td>".$rs->fields['srif']."</td>
																			<td>".$origen."</td>
																			<td>".strtoupper($rs->fields['region'])."</td>
																			<td>".strtoupper($rs->fields['entidad'])."</td>
																			<td>".strtoupper($rs->fields['municipio'])."</td>
																			<td>".$accion2."</td>
																			<td>".$accion3."</td>
																			<td>".$accion."</td>
																		</tr>";
											$rs->MoveNext();									
										 }
									}
							$tabla_3='
														</tbody>
													</thead>
												</table>
												</div>
												';
												
								if($_SESSION['usuario_id']){
									$tabla=$tabla_1.$tabla_2.$tabla_3;
								}else{
									$tabla=$tabla_1.$tabla_3;
								}
												
							$valor=$tabla."|".$numero_registros;
						}
					break;
					case '5':
						
						if($_REQUEST['id']){
													
							$SQL1= "SELECT miembros_empresa.id, 
											miembros_empresa.nenabled,
											--tipo_comite.sdescripcion,
											miembros.ncedula,
											miembros.sprimer_nombre,
											miembros.ssegundo_nombre,
											miembros.sprimer_apellido,
											miembros.ssegundo_apellido,
											miembros.stelefono1,
											miembros.miliciano,
											miembros.nsexo,
											miembros.semail	
									FROM rncpt.miembros_empresa
									INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
									--INNER JOIN rncpt.tipo_comite ON miembros_empresa.tipo_comite_id = tipo_comite.id
									WHERE miembros_empresa.empresa_id='".$_REQUEST['id']."' 
									AND miembros_empresa.nenabled='1'";
							$rs1=$conn->Execute($SQL1);								
								
									if($rs1->RecordCount()>0){
										
										$numero_miembros=$rs1->RecordCount();
										}else{
											$numero_miembros=0;	
										}
							$tabla='';	
							$tabla.='
								<div>
								<<table id="tblDetalle" align="center" onmousemove="llamar_tooltip();" style="width:95%;">
													<thead>
								<tr>
									<td colspan="4"> </td> 
								</tr>
														<tr>
															<th class="sub_titulo" width="10%"><div align="center">Tipo</div></th>
															<th class="sub_titulo" width="10%"><div align="center">C.I.</div></th>
															<th class="sub_titulo" width="30%"><div align="center">Apellido(s) y Nombre(s)</div></th>
															<th class="sub_titulo" width="10%"><div align="center">Sexo</div></th>
															<th class="sub_titulo" width="12%"><div align="center">Tel&eacute;fono 1</div></th>
															<th class="sub_titulo" width="12%"><div align="center">Miliciano</div></th>
															<th class="sub_titulo" width="20%"><div align="center">Correo Electr&oacute;nico</div></th>
														</tr>
														<tbody>';
																								
								if($_REQUEST['id']){
			
										while (!$rs1->EOF ){
											
											if($rs1->fields['nsexo']=='1') $sexo='M';
											if($rs1->fields['nsexo']=='2') $sexo='F';
											if($rs1->fields['miliciano']=='1') $miliciano='Si';
											if($rs1->fields['miliciano']=='2') $miliciano='No';

											$tabla.="<tr align='center'>
																			<td>".strtoupper($rs1->fields['sdescripcion'])."</td>
																			<td>".$rs1->fields['ncedula']."</td>
																			<td>".strtoupper($rs1->fields['sprimer_apellido']." ".$rs1->fields['ssegundo_apellido']." ".$rs1->fields['sprimer_nombre']." ".$rs1->fields['ssegundo_nombre'])."</td>
																			<td>".strtoupper($sexo)."</td>
																			<td>".$rs1->fields['stelefono1']."</td>
																			<td>".$miliciano."</td>
																			<td>".strtoupper($rs1->fields['semail'])."</td>
																		</tr>";
											$rs1->MoveNext();									
										 }
									}
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>';												
							$valor=$tabla."|".$numero_registros."|".$datos;
						}
					break;
					case '6':
						
						if($_REQUEST['id']){
													
							$SQL1= "SELECT rncpt.motor.sdescripcion as motor_descripcion,
													 rncpt.sector.sdescripcion as sector_descripcion,
													 public.productos.sdescripcion as productos_descripcion,
													 public.medida.sdescripcion as medida_descripcion,
													 rncpt.produccion.ncant_produc_actual_anual as ncant_produc_actual_anual,
													 rncpt.produccion.capacidad_ncant_produc_actual_anual as capacidad_ncant_produc_actual_anual,
													 rncpt.produccion.id as id,
													 rncpt.produccion.scomentario
													FROM rncpt.produccion 
													LEFT JOIN rncpt.empresa_motor ON empresa_motor.id= empresa_motor_id
													LEFT JOIN rncpt.motor ON motor.id= empresa_motor.motor_id
													LEFT JOIN rncpt.sector ON sector.id=empresa_motor.sector_id
													LEFT JOIN public.productos ON productos.id=produccion.productos_id 
													LEFT JOIN public.medida ON medida.id=produccion.medida_id
										WHERE produccion.nenabled='1' AND rncpt.empresa_motor.empresa_id='".$_REQUEST['id']."' ";
							$rs1=$conn->Execute($SQL1);								
								
									if($rs1->RecordCount()>0){
										
										$numero_miembros=$rs1->RecordCount();
										}else{
											$numero_miembros=0;	
										}
							$tabla='';	
							$tabla.='
								<div>
								<table id="tblDetalle" align="center" onmousemove="llamar_tooltip();" style="width:95%;">
													<thead>
								<tr>
									<td colspan="4"> </td> 
								</tr>
														<tr>
															<th class="sub_titulo" width="12%"><div align="center">Motor</div></th>
															<th class="sub_titulo" width="14%"><div align="center">Sector</div></th>
															<th class="sub_titulo" width="35%"><div align="center">Producto</div></th>
															<th class="sub_titulo" width="10%"><div align="center">Unidad de Medida</div></th>
															<th class="sub_titulo" width="11%"><div align="center">Produccion Anual</div></th>
															<th class="sub_titulo" width="11%"><div align="center">Capacidad Producci&oacute;n Anual</div></th>
															<th class="sub_titulo" width="12%"><div align="center">Comentario</div></th>
														</tr>
														<tbody>';
																								
								if($_REQUEST['id']){
			
										while (!$rs1->EOF ){
											$tabla.="<tr align='center'>
																			<td>".strtoupper($rs1->fields['motor_descripcion'])."</td>
																			<td>".strtoupper($rs1->fields['sector_descripcion'])."</td>
																			<td>".utf8_decode(strtoupper($rs1->fields['productos_descripcion']))."</td>
																			<td>".strtoupper($rs1->fields['medida_descripcion'])."</td>
																			<td>".$rs1->fields['ncant_produc_actual_anual']."</td>
																			<td>".$rs1->fields['capacidad_ncant_produc_actual_anual']."</td>
																			<td>".strtoupper($rs1->fields['scomentario'])."</td>
																		</tr>";
											$rs1->MoveNext();									
										 }
									}
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>';												
							$valor=$tabla."|".$numero_registros."|".$datos;
						}
					break;
					case '7': //PRODUCTIVIDAD
						
						if($_REQUEST['valor']<>5){
            
							$SQL1="SELECT ".$_REQUEST['nombre'].".id, sdescripcion, ".$_REQUEST['nombre'].".nenabled, 
							registrador.sprimer_apellido as apellido, registrador.sprimer_nombre as nombre
							FROM ".$_REQUEST['nombre']." 
							LEFT JOIN rncpt.registrador ON registrador.id=".$_REQUEST['nombre'].".usuario_idcreacion
							where ".$_REQUEST['nombre'].".nenabled='1'
							ORDER BY sdescripcion";
							$rs1=$conn->Execute($SQL1);								
								
									if($rs1->RecordCount()>0){
										
										$numero_miembros=$rs1->RecordCount();
										}else{
											$numero_miembros=0;	
										}
							$tabla='';	
							$tabla.='
								<div>
								<table id="tblDetalle" align="center" onmousemove="llamar_tooltip();" style="width:95%;">
													<thead>
								<tr>
									<td colspan="4"> </td> 
								</tr>
														<tr>
															<th class="sub_titulo" width="30%"><div align="center">Descripci&oacute;n</div></th>
															<th class="sub_titulo" width="10%"><div align="center">Estatus</div></th>
															<th class="sub_titulo" width="26%"><div align="center">Usuario Registrador</div></th>
															<th class="sub_titulo" width="4%"><div align="center"></div></th>
															<th class="sub_titulo" width="4%"><div align="center"></div></th>
															<th class="sub_titulo" width="4%"><div align="center"></div></th>
														</tr>
														<tbody>';
																								
								if($_REQUEST['valor']){
			
										while (!$rs1->EOF ){
											
											if($rs1->fields['nenabled']=='1') $descipcion='Activo';
											if($rs1->fields['nenabled']=='0') $descipcion='Inactivo';
											$id=$rs1->fields['id'];
											$estatus=$rs1->fields['nenabled'];
											$imagen="<img src='../imagenes/editar.png' width='16' height='16' alt='Editar' />";	
											$accion="<a title='Editar Registro - Haga clic para Editar Registro' onclick='javascript:editar_datos(".$id.", ".$_REQUEST['valor'].")'>".$imagen."</a>";
											$imagen2="<img src='../imagenes/aceptar.png' width='16' height='16' alt='' />";	
											$accion2="<a title='Habilitar  Registro - Haga clic para Habilitar  Registro' onclick='javascript:activar_datos(".$estatus.", ".$id.", ".$_REQUEST['valor'].")'>".$imagen2."</a>";
											
											$imagen3="<img src='../imagenes/bloqueado.png' width='16' height='16' alt='' />";	
											$accion3="<a title='Inhabilitar Registro - Haga clic para Inhabilitar Registro' onclick='javascript:inactivo(".$estatus.", ".$id.", ".$_REQUEST['valor'].")'>".$imagen3."</a>";
											
											$tabla.="<tr>
																			<td>".strtoupper($rs1->fields['sdescripcion'])."</td>
																			<td align='center'>".strtoupper($descipcion)."</td>
																			<td>".strtoupper($rs1->fields['apellido']." ".$rs1->fields['nombre'])."</td>
																			<td align='center'>".$accion."</td>
																			<td align='center'>".$accion2."</td>
																			<td align='center'>".$accion3."</td>
																		</tr>";
											$rs1->MoveNext();									
										 }
									}
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>';												
							$valor=$tabla."|".$numero_registros;
						}else{
							
							if($_REQUEST['valor']==5){
            
							$SQL1="SELECT ".$_REQUEST['nombre'].".id, descripcion_cargo, ".$_REQUEST['nombre'].".nenabled, 
							registrador.sprimer_apellido as apellido, registrador.sprimer_nombre as nombre
							FROM ".$_REQUEST['nombre']." 
							LEFT JOIN rncpt.registrador ON registrador.id=".$_REQUEST['nombre'].".usuario_idcreacion
							where ".$_REQUEST['nombre'].".nenabled='1'
							ORDER BY descripcion_cargo";
							$rs1=$conn->Execute($SQL1);								
								
									if($rs1->RecordCount()>0){
										
										$numero_miembros=$rs1->RecordCount();
										}else{
											$numero_miembros=0;	
										}
							$tabla='';	
							$tabla.='
								<div>
								<table id="tblDetalle" align="center" onmousemove="llamar_tooltip();" style="width:95%;">
													<thead>
								<tr>
									<td colspan="4"> </td> 
								</tr>
														<tr>
															<th class="sub_titulo" width="30%"><div align="center">Descripci&oacute;n</div></th>
															<th class="sub_titulo" width="10%"><div align="center">Estatus</div></th>
															<th class="sub_titulo" width="26%"><div align="center">Usuario Registrador</div></th>
															<th class="sub_titulo" width="4%"><div align="center"></div></th>
															<th class="sub_titulo" width="4%"><div align="center"></div></th>
															<th class="sub_titulo" width="4%"><div align="center"></div></th>
														</tr>
														<tbody>';
																								
								if($_REQUEST['valor']==5){
			
										while (!$rs1->EOF ){
											
											if($rs1->fields['nenabled']=='1') $descipcion='Activo';
											if($rs1->fields['nenabled']=='0') $descipcion='Inactivo';
											$id=$rs1->fields['id'];
											$estatus=$rs1->fields['nenabled'];
											$imagen="<img src='../imagenes/editar.png' width='16' height='16' alt='Editar' />";	
											$accion="<a title='Editar Registro - Haga clic para Editar Registro' onclick='javascript:editar_datos(".$id.", ".$_REQUEST['valor'].")'>".$imagen."</a>";
											$imagen2="<img src='../imagenes/aceptar.png' width='16' height='16' alt='' />";	
											$accion2="<a title='Habilitar  Registro - Haga clic para Habilitar  Registro' onclick='javascript:activar_datos(".$estatus.", ".$id.", ".$_REQUEST['valor'].")'>".$imagen2."</a>";
											
											$imagen3="<img src='../imagenes/bloqueado.png' width='16' height='16' alt='' />";	
											$accion3="<a title='Inhabilitar Registro - Haga clic para Inhabilitar Registro' onclick='javascript:inactivo(".$estatus.", ".$id.", ".$_REQUEST['valor'].")'>".$imagen3."</a>";
											
											$tabla.="<tr>
																			<td>".strtoupper($rs1->fields['descripcion_cargo'])."</td>
																			<td align='center'>".strtoupper($descipcion)."</td>
																			<td>".strtoupper($rs1->fields['apellido']." ".$rs1->fields['nombre'])."</td>
																			<td align='center'>".$accion."</td>
																			<td align='center'>".$accion2."</td>
																			<td align='center'>".$accion3."</td>
																		</tr>";
											$rs1->MoveNext();									
										 }
									}
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>';												
							$valor=$tabla."|".$numero_registros;
							
											}
							
							
					}
					break;
					case '8':
						$SQL="SELECT id FROM rncpt.empresa WHERE id='".$_POST['id']."' AND usuario_idcreacion='".$_SESSION['usuario_id']."' AND nenabled=1";
						$rs = &$conn->Execute($SQL);
						if ($rs->RecordCount()>0){
						unset($_SESSION['empresa_id']);	
						$_SESSION['empresa_id']=$rs->fields['id'];	
							$valor="ir";
						}else{
						 $valor="vacio";
						}
					break;
					case '9':
					
						$SQL="SELECT id FROM rncpt.miembros_empresa WHERE empresa_id='".$_POST['id']."' AND nenabled='1' ";
						$rs = &$conn->Execute($SQL);
						if ($rs->RecordCount()>0){
								$valor="activo"; 
							
						}else{
					
							$SQL1="UPDATE rncpt.empresa SET nenabled='0', usuario_idactualizacion='".$_SESSION['usuario_id']."', dfecha_actualizacion='".date('Y-m-d H:i:s')."'
							WHERE id='".$_POST['id']."' AND nenabled='1'";
							$rs1 = &$conn->Execute($SQL1);
							if ($rs1){
									$valor="exito"; 
								}else{
									$valor="error_guardar"; 
								}
						}
					break;
					case '10': //CARGOS
						
						if($_REQUEST['valor']){
            
							$SQL1="SELECT ".$_REQUEST['nombre'].".cod_cargos, ".$_REQUEST['nombre'].".descripcion_cargo, ".$_REQUEST['nombre'].".nenabled, 
							registrador.sprimer_apellido as apellido, registrador.sprimer_nombre as nombre
							FROM ".$_REQUEST['nombre']." 
							LEFT JOIN rncpt.registrador ON registrador.id=".$_REQUEST['nombre'].".usuario_idcreacion
							where ".$_REQUEST['nombre'].".nenabled='1'
							ORDER BY descripcion_cargo";
							$rs1=$conn->Execute($SQL1);								
								
									if($rs1->RecordCount()>0){
										
										$numero_miembros=$rs1->RecordCount();
										}else{
											$numero_miembros=0;	
										}
							$tabla='';	
							$tabla.='
								<div>
								<table id="tblDetalle" align="center" onmousemove="llamar_tooltip();" style="width:95%;">
													<thead>
								<tr>
									<td colspan="4"> </td> 
								</tr>
														<tr>
															<th class="sub_titulo" width="30%"><div align="center">Descripci&oacute;n</div></th>
															<th class="sub_titulo" width="10%"><div align="center">Estatus</div></th>
															<th class="sub_titulo" width="26%"><div align="center">Usuario Registrador</div></th>
															<th class="sub_titulo" width="4%"><div align="center"></div></th>
															<th class="sub_titulo" width="4%"><div align="center"></div></th>
															<th class="sub_titulo" width="4%"><div align="center"></div></th>
														</tr>
														<tbody>';
																								
								if($_REQUEST['valor']){
			
										while (!$rs1->EOF ){
											
											if($rs1->fields['nenabled']=='1') $descipcion='Activo';
											if($rs1->fields['nenabled']=='0') $descipcion='Inactivo';
											$id=$rs1->fields['id'];
											$estatus=$rs1->fields['nenabled'];
											$imagen="<img src='../imagenes/editar.png' width='16' height='16' alt='Editar' />";	
											$accion="<a title='Editar Registro - Haga clic para Editar Registro' onclick='javascript:editar_datos(".$id.", ".$_REQUEST['valor'].")'>".$imagen."</a>";
											$imagen2="<img src='../imagenes/aceptar.png' width='16' height='16' alt='' />";	
											$accion2="<a title='Habilitar  Registro - Haga clic para Habilitar  Registro' onclick='javascript:activar_datos(".$estatus.", ".$id.", ".$_REQUEST['valor'].")'>".$imagen2."</a>";
											
											$imagen3="<img src='../imagenes/bloqueado.png' width='16' height='16' alt='' />";	
											$accion3="<a title='Inhabilitar Registro - Haga clic para Inhabilitar Registro' onclick='javascript:inactivo(".$estatus.", ".$id.", ".$_REQUEST['valor'].")'>".$imagen3."</a>";
											
											$tabla.="<tr>
																			<td>".strtoupper($rs1->fields['descripcion_cargo'])."</td>
																			<td align='center'>".strtoupper($descipcion)."</td>
																			<td>".strtoupper($rs1->fields['apellido']." ".$rs1->fields['nombre'])."</td>
																			<td align='center'>".$accion."</td>
																			<td align='center'>".$accion2."</td>
																			<td align='center'>".$accion3."</td>
																		</tr>";
											$rs1->MoveNext();									
										 }
									}
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>';												
							$valor=$tabla."|".$numero_registros;
						}
					break;

					//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

					case '11': //CONSULTA ESTADOS
						
						if($_SESSION['usuario_id']){

							if($_POST['cbo_region2']!=''){ $sql1="region_id='".$_POST['cbo_region2']."' AND  ";}
								if($_POST['cbo_entidad2']!=''){ $sql2="entidad_nentidad='".$_POST['cbo_entidad2']."' AND ";}
								if($_POST['cbo_estado_consulta2']!=''){ $sql3="entidad_nentidad='".$_POST['cbo_estado_consulta2']."' AND";}
								if(($_SESSION["ntipo"]=='5') and  $_SESSION["nregion"]!=''){ $sql4="nregion ='".$_SESSION["nregion"]."' AND";}
								if($_SESSION["ntipo"]=='6' and $_POST['valor']=='2' and  $_SESSION["nregion"]!=''){ $sql5="nregion ='".$_SESSION["nregion"]."' AND";}

								
								$SQL="SELECT empresa.id as id,
													sdenominacion_comercial, 
													srazon_social, 
													sdireccion_fiscal, 
													sdireccion,
													entidad.sdescripcion as entidad, 
													municipio.sdescripcion as municipio, 
													region.sdescripcion as region, 
													srif,
													norigen, 
													usuario_idcreacion, 
													empresa.usuario_idactualizacion, 
													empresa.nenabled
								FROM rncpt.empresa
								LEFT JOIN public.region ON public.region.id=rncpt.empresa.region_id
								LEFT JOIN public.entidad ON public.entidad.nentidad=rncpt.empresa.entidad_nentidad
								LEFT JOIN public.municipio ON public.municipio.nmunicipio=rncpt.empresa.municipio_nmunicipio
								WHERE ".$sql1." ".$sql2." ".$sql3." ".$sql4." ".$sql5." empresa.nenabled='1' ORDER BY srazon_social";
								$rs=$conn->Execute($SQL);								
								
										if($rs->RecordCount()>0){
											$numero_registros=$rs->RecordCount();
										}else{
											$numero_registros=0;	
										}
							$tabla_1='
								<div>
								<table id="tblDetalle" align="center" onmousemove="llamar_tooltip();" style="width:95%;">
													<thead>
								<tr>
									<td colspan="4"> </td> 
								</tr>
														<tr>
														<tr>
															<th class="sub_titulo" width="12%"><div align="center">Raz&oacute;n Social</div></th>
															<th class="sub_titulo" width="12%"><div align="center">Denominaci&oacute;n Comercial</div></th>
															<th class="sub_titulo" width="13%"><div align="center">Direcci&oacute;n Fiscal</div></th>
															<th class="sub_titulo" width="13%"><div align="center">Otra Direcci&oacute;n</div></th>
															<th class="sub_titulo" width="9%"><div align="center">Rif</div></th>
															<th class="sub_titulo" width="4%"><div align="center">Estatus</div></th>
															<th class="sub_titulo" width="11%"><div align="center">Regi&oacute;n</div></th>
															<th class="sub_titulo" width="11%"><div align="center">Estado</div></th>
															<th class="sub_titulo" width="12%"><div align="center">Municipio</div></th>
															<th class="sub_titulo" width="1%"><div align="center"></div></th>
															<th class="sub_titulo" width="1%"><div align="center"></div></th>
															<th class="sub_titulo" width="1%"><div align="center"></div></th>
														</tr>
														</tr>
														<tbody>';
										
								if($_SESSION['id_usuario']){
			
										while (!$rs->EOF ){
										unset($_SESSION['empresa_id']);
										$id=$rs->fields['id'];
										if($rs->fields['norigen']==1)	$origen="L"; 
										if($rs->fields['norigen']==2)	$origen="N";  
										$imagen="<img src='../imagenes/eye.png' width='16' height='16' alt='Agregar' />";	
										$accion="<a title='Ver Registro - Haga clic para Ver Registro' onclick='javascript:ver_formulario(".$id.")'>".$imagen."</a>";
										if($_SESSION['ntipo']==4){
										$imagen2="<img src='../imagenes/editar.png' width='16' height='16' alt='editar' />";	
										$accion2="<a title='Editar Registro - Haga clic para Editar este Registro' onclick='javascript:editar(".$id.",1)'>".$imagen2."</a>";
										$imagen3="<img src='../imagenes/bloqueado.png' width='16' height='16' alt='Inhabilitar' />";	
										$accion3="<a title='Inhabilitar Registro - Haga clic para Inhabilitar este Registro' onclick='javascript:inactivo(".$id.")'>".$imagen3."</a>";

										}
										
											$tabla_2=$tabla_2."<tr align='center'>
																			<td>".$rs->fields['srazon_social']."</td>
																			<td>".$rs->fields['sdenominacion_comercial']."</td>
																			<td>".$rs->fields['sdireccion_fiscal']."</td>
																			<td>".$rs->fields['sdireccion']."</td>
																			<td>".$rs->fields['srif']."</td>
																			<td>".$origen."</td>
																			<td>".strtoupper($rs->fields['region'])."</td>
																			<td>".strtoupper($rs->fields['entidad'])."</td>
																			<td>".strtoupper($rs->fields['municipio'])."</td>
																			<td>".$accion2."</td>
																			<td>".$accion3."</td>
																			<td>".$accion."</td>
																		</tr>";
											$rs->MoveNext();									
										 }
									}
							$tabla_3='
														</tbody>
													</thead>
												</table>
												</div>
												';
												
								if($_SESSION['id_usuario']){
									$tabla=$tabla_1.$tabla_2.$tabla_3;
								}else{
									$tabla=$tabla_1.$tabla_3;
								}
												
							$valor=$tabla."|".$numero_registros;
						}
					break;
					//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
				
}
					
					
echo $valor;

?>

