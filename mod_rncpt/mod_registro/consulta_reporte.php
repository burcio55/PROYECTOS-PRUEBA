
<?php
//-----------------------------------------------------
ini_set('display_errors',0); 
error_reporting(E_ALL | E_STRICT | E_DEPRECATED);
include('../include/header.php');
$conn= getConnDB($db1);
$conn->debug=false;
//-----------------------------------------------------
switch($_POST['opcion']){
	
					case '1': //REPORTE POR ESTADO-MOTOR SECTOR-PRODCTOS | NACIONAL-ESTADAL

							if($_SESSION['ntipo']=='3'){ $condicion="AND entidad_nentidad='".$_SESSION['nentidad']."'"; }else{ $condicion="";}	
							if($_SESSION['ntipo']=='5'){ $condicion="AND region_id='".$_SESSION['nregion']."'";}else{ $condicion="";}	
							if($_POST['estado']!=''){  $condicion1="AND entidad_nentidad='".$_POST['estado']."'";}else{ $condicion1="";}	
						
						
							$SQL1="SELECT empresa_id, 
											empresa.nro_boleta,	
											empresa.srazon_social,	
											empresa.norigen,
											motor.sdescripcion as motor,
											sector.sdescripcion as sector,
											productos.sdescripcion as producto,
											entidad.sdescripcion as estado
										FROM scpt.empresa_motor
										LEFT JOIN scpt.empresa ON scpt.empresa.id=empresa_motor.empresa_id
										LEFT JOIN public.entidad ON public.entidad.nentidad=empresa.entidad_nentidad
										LEFT JOIN scpt.motor ON scpt.motor.id=empresa_motor.motor_id
										LEFT JOIN scpt.sector ON scpt.sector.id=empresa_motor.sector_id
										LEFT JOIN scpt.produccion ON scpt.produccion.empresa_motor_id=empresa_motor.id
										LEFT JOIN public.productos ON public.productos.id=produccion.productos_id
										WHERE empresa.nenabled='1' AND produccion.nenabled='1' AND empresa_motor.nenabled='1' ".$condicion." ".$condicion1."
										GROUP BY empresa_id, empresa.srazon_social, motor.sdescripcion,  sector.sdescripcion, productos.sdescripcion, entidad.sdescripcion, norigen,empresa.nro_boleta
										ORDER BY estado";
							$rs1=$conn->Execute($SQL1);								
								
									if($rs1->RecordCount()>0){
										
										$numero_miembros=$rs1->RecordCount();
										}else{
											$numero_miembros=0;	
										}
									
							
							
							$SQL2="SELECT count(*) FROM scpt.empresa WHERE norigen='1' AND nenabled='1' ".$condicion." ".$condicion1." ";
							$rs2=$conn->Execute($SQL2);	//empresas nuevas	
													
							$SQL3="SELECT count(*) FROM scpt.empresa WHERE norigen='2' AND nenabled='1' ".$condicion." ".$condicion1." ";
							$rs3=$conn->Execute($SQL3);	//empresa actaulizadas
							
							//fecha ultima empresa registrada
							$SQL4="SELECT date(max(dfecha_creacion)) as ultimo_registrado  FROM scpt.empresa WHERE nenabled='1' ".$condicion." ".$condicion1." ";
							
							$rs4=$conn->Execute($SQL4);	if($rs4->fields[0]==''){$ultimo_registrado= 'SIN REGISTROS';}else{$ultimo_registrado= $rs4->fields[0];
							
$ultimo_registrado = date("d-m-Y", strtotime($ultimo_registrado));}
						
							
							//fecha ultima empresa actualizada
							$SQL5="SELECT date(max(dfecha_actualizacion))as ultimo_registrado  FROM scpt.empresa WHERE  nenabled='1' ".$condicion." ".$condicion1." ";
							
							$rs5=$conn->Execute($SQL5);	if($rs5->fields[0]==''){$ultimo_actualizado='SIN ACTUALIZACIONES';}else{	$ultimo_actualizado=$rs5->fields[0];
							
$ultimo_actualizado = date("d-m-Y", strtotime($ultimo_actualizado));}	
														
							$tabla='';	
							$tabla.='
								<div>
								<table id="tblDetalle" class="listado" align="center" onmousemove="llamar_tooltip();" style="width:100%;">
													<thead>
														<tr>
															<th width="24%">Entidad de Trabajo</th>
															<th width="10%">Nro. Boleta</th>
															<th width="12%">Estado</th>
															<th width="18%">Motor</th>
															<th width="18%">Sector</th>
															<th width="18%">Producto</th>
														</tr>
													</thead>
														<tbody>';
			
										while (!$rs1->EOF ){
											
										if($rs1->fields['norigen']==1)	$origen="L"; 
										if($rs1->fields['norigen']==2)	$origen="N";  
	
											$tabla.="<tr align='center'>
																			<td>".strtoupper($rs1->fields['srazon_social'])."</td>
																			<td>".strtoupper($rs1->fields['nro_boleta'])."</td>
																			<td>".strtoupper($rs1->fields['estado'])."</td>
																			<td>".utf8_decode(strtoupper($rs1->fields['motor']))."</td>
																			<td>".utf8_decode(strtoupper($rs1->fields['sector']))."</td>
																			<td>".utf8_decode(strtoupper($rs1->fields['producto']))."</td>
																		</tr>
																		";
											$rs1->MoveNext();									
										 }
							$tabla.='
														</tbody>
												</table>
												</div>';
							$suma= 0;
							
									
							$suma= $rs2->fields[0]+$rs3->fields[0];
							
							$tabla1.='
								<div>
								<table id="" class="listado" align="center" onmousemove="llamar_tooltip();" style="width:100%;">
													<thead>
														<tr>
															<th width="40%">TOTAL DE ENTIDADES DE TRABAJO EN LA LISTA</th>
															<th width="40%">FECHA ULT. REGISTRO ENTIDAD DE TRABAJO</th>
															<th width="20%">FECHA ULT. ACTUALIZACION ENTIDAD DE TRABAJO</th>
														</tr>
													</thead>
													<tbody>
													<tr align="center">
													<td>'.$suma.'</td>
													<td>'.$ultimo_registrado.'</td>
													<td>'.$ultimo_actualizado.'</td>													
													</tr>
												</tbody>
											</table>
										</div>';
												
							$valor=$tabla."|".$tabla1."|".$numero_registros ;
					break;
					case '2': //CONSULTA EMPRESA-MIEMBROS | NACIONAL-ESTADO
					
						if($_SESSION['usuario_id']){
							
							if($_SESSION['ntipo']=='3' or $_SESSION['ntipo']=='4' ){ $condicion="AND entidad_nentidad='".$_SESSION['nentidad']."'";} else{ $condicion=""; }	
							if($_SESSION['ntipo']=='5'){ $condicion1="AND region_id='".$_SESSION['nregion']."'";} else{ $condicion1=""; }		
							if($_POST['estado']!=''){ $condicion="AND entidad_nentidad='".$_POST['estado']."'";} else{ $condicion=""; }	
							
							$SQL1="SELECT empresa.id, 
											srazon_social,
											srif,
											nro_boleta,
											entidad.sdescripcion as estado
										FROM scpt.empresa
										LEFT JOIN public.entidad ON public.entidad.nentidad=empresa.entidad_nentidad
										WHERE empresa.nenabled='1' ".$condicion." ".$condicion1." ORDER BY estado";
							$rs1=$conn->Execute($SQL1);								
								
									if($rs1->RecordCount()>0){
										
										$numero_miembros=$rs1->RecordCount();
										}else{
											$numero_miembros=0;	
										}
																					
												
							
							$tabla='';	
							$tabla.='
								<div>
								<table id="tblDetalle_reporte" class="listado" align="center" onmousemove="llamar_tooltip();" style="width:100%;">
													<thead>
														<tr>
															<th width="10%">RIF</th>
															<th width="15%">Entidad de Trabajo</th>
															<th width="5%">Nro. Boleta</th>
															<th width="15%">Estado</th>
															<th width="60%">Integrantes del CPT</th>
														</tr>
													</thead>
													<tbody>';
																								
								if($_SESSION['usuario_id']){
								while (!$rs1->EOF ){
									$SQL2= "SELECT miembros_empresa.id, miembros.ncedula, miembros.sprimer_nombre, 
									miembros.sprimer_apellido, 	
									miembros.nsexo, miembros.stelefono1, miembros.miliciano,
									cedulas.ncedula AS repetida 			
									FROM scpt.miembros_empresa 
									INNER JOIN scpt.miembros ON miembros.id = miembros_empresa.miembros_id 									
									LEFT JOIN public.cedulas ON cedulas.ncedula=miembros.ncedula 
									WHERE miembros_empresa.empresa_id='".$rs1->fields['id']."'  
									AND miembros_empresa.nenabled='1'";
									
									//SE QUITARON LAS SIGUEINTS DOS LINEAS YA NO SE PIDE EL DATO EN EL REGISTRO 29-05-2020
									//--, tipo_comite.sdescripcion as tipo
									//INNER JOIN scpt.tipo_comite-- ON miembros_empresa.tipo_comite_id = tipo_comite.id
									//Y SE QUITO EL TIPO DE TRABAJOR DE LA TABLA
									$rs2=$conn->Execute($SQL2);		
											$tabla1='';	
											$tabla1.='
												<div>
												<table id="" class="listado_1" align="center" onmousemove="llamar_tooltip();" style="width:100%; ">
																	<thead>
																		<tr>
																			<th width="10%">C.I.</th>
																			<th width="20%">Apellido(s)</th>
																			<th width="20%">Nombre(s)</th>
																			<th width="8%">Sexo</th>
																			<th width="12%">Nro. Tel&eacute;fono</th>
																			<th width="12%">Miliciano</th>
																			
																		</tr>
																		<tbody>';
																		
											while (!$rs2->EOF ){

											if($rs2->fields['repetida']!=''){
												$color='style="background-color: #FFCC99"';
											}else{
												$color="";
												}
													if($rs2->fields['nsexo']==1)	$sexo="M"; 
													if($rs2->fields['nsexo']==2)	$sexo="F";  
													if($rs2->fields['miliciano']==1)	$miliciano="Sí"; 
													if($rs2->fields['miliciano']==2)	$miliciano="No";

														$tabla1.='<tr align="center" '.$color.'>
																							<td>'.$rs2->fields['ncedula'].'</td>
																							<td>'.strtoupper($rs2->fields['sprimer_apellido']).'</td>
																							<td>'.strtoupper($rs2->fields['sprimer_nombre']).'</td>
																							<td>'.$sexo.'</td>
																							<td>'.$rs2->fields['stelefono1'].'</td>
																							<td>'.$miliciano.'</td>
																							
																						</tr>';
															$rs2->MoveNext();									
														 }
											$tabla1.='
																		</tbody>
																	</thead>
																</table>
															</div>';	

								
											
											
											
											
											
											
										$tabla.="<tr align='center'>
																			<td>".$rs1->fields['srif']."</td>
																			<td>".strtoupper($rs1->fields['srazon_social'])."</td>
																			<td>".strtoupper($rs1->fields['estado'])."</td>
																			<td>".$tabla1."</td>
																		</tr>
																		";
											$rs1->MoveNext();									
										 }
								}
							$tabla.='
														</tbody>
												</table>
												</div>';									
								}				
							$valor=$tabla."|".$numero_registros;
							
						
						
					break;

					case '3':
						
						if($_SESSION['usuario_id']){
													
							$SQL= "SELECT count(*) FROM scpt.empresa WHERE nenabled='1'";
							$rs=$conn->Execute($SQL);
							
							$SQL2= "SELECT count(motor_id) FROM scpt.empresa_motor 
							right JOIN scpt.empresa ON scpt.empresa.id=empresa_motor.empresa_id WHERE empresa.nenabled='1' AND empresa_motor.nenabled='1' ";
							$rs2=$conn->Execute($SQL2);
							
							$SQL3= "SELECT count(sector_id) FROM scpt.empresa_motor 
							right JOIN scpt.empresa ON scpt.empresa.id=empresa_motor.empresa_id WHERE empresa.nenabled='1'  AND  empresa_motor.nenabled='1' ";
							$rs3=$conn->Execute($SQL3);

							$SQL4= "SELECT count(*) FROM scpt.miembros_empresa 
							INNER JOIN scpt.empresa ON scpt.empresa.id=miembros_empresa.empresa_id WHERE miembros_empresa.nenabled='1'  ";
							$rs4=$conn->Execute($SQL4);
														
							$SQL5= "SELECT count(nsexo) FROM scpt.miembros_empresa 
											INNER JOIN scpt.empresa ON scpt.empresa.id=miembros_empresa.empresa_id 
											INNER JOIN scpt.miembros ON scpt.miembros.id=miembros_empresa.miembros_id 
											WHERE miembros_empresa.nenabled='1' ";
							$rs5=$conn->Execute($SQL5);
							
							$SQL6= "SELECT count(nsexo) FROM scpt.miembros_empresa 
											INNER JOIN scpt.empresa ON scpt.empresa.id=miembros_empresa.empresa_id 
											INNER JOIN scpt.miembros ON scpt.miembros.id=miembros_empresa.miembros_id 
											WHERE miembros_empresa.nenabled='1' AND nsexo='2'";
							$rs6=$conn->Execute($SQL6);
							
							function porcentaje($total, $parte, $redondear = 2) {
    					  return round($parte / $total * 100, $redondear);
							}
 							$porciento =  porcentaje($rs5->fields[0], $rs6->fields[0], 2);
								
							$tabla='';	
							$tabla.='
								<div>
								<table id="tblDetalle_nacional" class="listado" align="center" onmousemove="llamar_tooltip();" style="width:100%;">
													<thead>
														<tr>
															<th width="16%">Total de Entidades de Trabajo</th>
															<th width="16%">Total de Entidades de Trabajo Por Motor</th>
															<th width="16%">Total de Entidades de Trabajo Por Sector</th>
															<th width="16%">Total de Integrantes del CPT</th>
															<th width="16%">Total de Mujeres en el Registro de Integrantes del CPT</th>
															<th width="16%">% del Total de Mujeres en el Registro de Integrantes del CPT</th>
														</tr>
														<tbody>';
																								
								if($_SESSION['usuario_id']){
								
															$tabla.="<tr align='center'>
															         <td>".$rs->fields[0]."</td>
															         <td>".$rs2->fields[0]."</td>
																			 <td>".$rs3->fields[0]."</td>
																			 <td>".$rs4->fields[0]."</td>
																			 <td>".$rs6->fields[0]."</td>
																			 <td>".$porciento.'%'."</td>
																			</tr>";
									}
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>';												
							$valor=$tabla."|".$numero_registros;
						}
					break;
					case '4':
						
						//if($_REQUEST['region']){
							
							if($_REQUEST['region']!=''){ $sql1="AND region_id='".$_REQUEST['region']."'";} else{ $sql1=""; }	
							if($_REQUEST['estado']!=''){ $sql2="AND entidad_nentidad='".$_REQUEST['estado']."'";} else{ $sql2=""; }	
																										
							$SQL= "SELECT count(*) FROM scpt.empresa WHERE nenabled='1' ".$sql1." ".$sql2."";
							$rs=$conn->Execute($SQL);
							
							$SQL2= "SELECT count(motor_id) FROM scpt.empresa_motor 
							INNER JOIN scpt.empresa ON scpt.empresa.id=empresa_motor.empresa_id 
							WHERE empresa.nenabled='1' AND empresa_motor.nenabled='1' ".$sql1." ".$sql2."  ";
							$rs2=$conn->Execute($SQL2);
							
							$SQL3= "SELECT count(sector_id) FROM scpt.empresa_motor 
							right JOIN scpt.empresa ON scpt.empresa.id=empresa_motor.empresa_id WHERE empresa.nenabled='1' AND empresa_motor.nenabled='1' ".$sql1." ".$sql2." ";
							$rs3=$conn->Execute($SQL3);

							$SQL4= "SELECT count(*) FROM scpt.miembros_empresa 
							right JOIN scpt.empresa ON scpt.empresa.id=miembros_empresa.empresa_id WHERE miembros_empresa.nenabled='1' ".$sql1." ".$sql2." ";
							$rs4=$conn->Execute($SQL4);
							
							$SQL5= "SELECT count(nsexo) FROM scpt.miembros_empresa 
							INNER JOIN scpt.empresa ON scpt.empresa.id=miembros_empresa.empresa_id 
							INNER JOIN scpt.miembros ON scpt.miembros.id=miembros_empresa.miembros_id 
							WHERE miembros_empresa.nenabled='1' ".$sql1." ".$sql2."";
							$rs5=$conn->Execute($SQL5);
							
							$SQL5= "SELECT count(nsexo) FROM scpt.miembros_empresa 
											INNER JOIN scpt.empresa ON scpt.empresa.id=miembros_empresa.empresa_id 
											INNER JOIN scpt.miembros ON scpt.miembros.id=miembros_empresa.miembros_id 
											WHERE miembros_empresa.nenabled='1' ".$sql1." ".$sql2." ";
							$rs5=$conn->Execute($SQL5);
							
							$SQL6= "SELECT count(nsexo) FROM scpt.miembros_empresa 
											INNER JOIN scpt.empresa ON scpt.empresa.id=miembros_empresa.empresa_id 
											INNER JOIN scpt.miembros ON scpt.miembros.id=miembros_empresa.miembros_id 
											WHERE miembros_empresa.nenabled='1' AND nsexo='2' ".$sql1." ".$sql2."";
							$rs6=$conn->Execute($SQL6);
							
							function porcentaje($total, $parte, $redondear = 2) {
    					  return round($parte / $total * 100, $redondear);
							}
 							$porciento =  porcentaje($rs5->fields[0], $rs6->fields[0], 2);
						//}
							$tabla='';	
							$tabla.='
								<div>
								<table id="tblDetalle_es_re" class="listado" align="center" onmousemove="llamar_tooltip();" style="width:100%;">
													<thead>
														<tr>
															<th width="16%">Total de Entidades de Trabajo</th>
															<th width="16%">Total de Entidades de Trabajo Por Motor</th>
															<th width="16%">Total de Entidades de Trabajo Por Sector</th>
															<th width="16%">Total de Integrantes del CPT</th>
															<th width="16%">Total de Mujeres en el Registro de Integrantes del CPT</th>
															<th width="16%">% del Total de Mujeres en el Registro ddel CPT</th>
														</tr>
														<tbody>';
																								
							//	if($_REQUEST['region']){
								
															$tabla.="<tr align='center'>
															         <td>".$rs->fields[0]."</td>
															         <td>".$rs2->fields[0]."</td>
																			 <td>".$rs3->fields[0]."</td>
																			 <td>".$rs4->fields[0]."</td>
																			 <td>".$rs6->fields[0]."</td>
																			 <td>".$porciento.'%'."</td>
																			</tr>";
									//}
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>';												
							$valor=$tabla."|".$numero_registros;
						
					break;
					case '5': //REPORTE POR MOTOR Y SECTOR							
					//if($_SESSION['ntipo']=='3'){ 
					//echo "aquiiiii";
						if($_POST['cbo_sector']!=''){  $condicion1="AND empresa_motor.sector_id='".$_POST['cbo_sector']."'";}else{ $condicion="";}	
					
					if($_POST['cbo_motor']!=''){  $condicion1="AND empresa_motor.motor_id='".$_POST['cbo_motor']."'";}else{ $condicion1="";}	
				//	}
						
						
							$SQL1="SELECT empresa_id, 
											empresa.srif,
											empresa.nro_boleta,	
											empresa.srazon_social,	
											empresa.norigen,
											motor.sdescripcion as motor,
											sector.sdescripcion as sector											
										FROM scpt.empresa_motor
										LEFT JOIN scpt.empresa ON scpt.empresa.id=empresa_motor.empresa_id
										LEFT JOIN public.entidad ON public.entidad.nentidad=empresa.entidad_nentidad
										LEFT JOIN scpt.motor ON scpt.motor.id=empresa_motor.motor_id
										LEFT JOIN scpt.sector ON scpt.sector.id=empresa_motor.sector_id
										LEFT JOIN scpt.produccion ON scpt.produccion.empresa_motor_id=empresa_motor.id
										WHERE empresa.nenabled='1' AND produccion.nenabled='1' AND empresa_motor.nenabled='1' ".$condicion." ".$condicion1."
										GROUP BY empresa_id, empresa.srif,empresa.srazon_social, motor.sdescripcion,  sector.sdescripcion,  norigen,empresa.nro_boleta
										ORDER BY empresa.srif,motor,sector";
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
															<th width="24%">RIF</th>
															<th width="24%">Entidad de Trabajo</th>
															<th width="24%">Nro. Boleta</th>
															
															<th width="24%">Motor</th>
															<th width="24%">Sector</th>
														
														</tr>
													</thead>
														<tbody>';
			
										while (!$rs1->EOF ){
									
											$tabla.="<tr align='center'>
																			<td>".strtoupper($rs1->fields['srif'])."</td>
																			<td>".strtoupper($rs1->fields['srazon_social'])."</td>
																			<td>".strtoupper($rs1->fields['nro_boleta'])."</td>
																			
																			<td>".utf8_decode(strtoupper($rs1->fields['motor']))."</td>
																			<td>".utf8_decode(strtoupper($rs1->fields['sector']))."</td>
																			
																		</tr>
																		";
											$rs1->MoveNext();									
										 }
							$tabla.='
														</tbody>
												</table>
												</div>';
							
							$valor=$tabla;
					break;
}
echo $valor;

							
//							$SQL2= "SELECT empresa_id, motor_id, sector_id, SUM (motor_id)
//  FROM scpt.empresa_motor
//INNER JOIN scpt.empresa ON scpt.empresa.id=empresa_motor.empresa_id 
//WHERE empresa.nenabled='1' AND norigen='1' 
//GROUP BY empresa_id, motor_id, sector_id ";
//							$rs2=$conn->Execute($SQL2);	

//SELECT actividades.sdescripcion AS nombre, metas.actividades_id, count (metas.actividades_id) 
//FROM sss.metas
//INNER JOIN sss.actividades ON sss.actividades.id=metas.actividades_id 
//GROUP BY actividades.sdescripcion, metas.actividades_id

?>




