<script src="/minpptrassi/datatables/funcion_paginador.js"></script>
<?php
include("../include/header.php"); 
$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
//$conn->debug = true;
debug();

			switch($_POST['opcion']){
					case '1': //oac_via_recepcion
				
						$SQL="SELECT id_via_recepcion, sdecripcion_via_recepcion, nenabled FROM  oac.via_recepcion order by sdecripcion_via_recepcion" ;
						$rs=$conn->Execute($SQL);
									
										if($rs->RecordCount()>0){
											$numero_registros=$rs->RecordCount();
										}else{
											$numero_registros=0;	
										}
							$tabla.='
							<div>
							<table class="display" border="0" align="center" id="tblDetalle" width="100%">
							<thead>
							<tr>
							<th width="50%" class="sub_titulo"><div align="left">V&iacute;as de Recepci&oacute;n</div></th>
							<th width="20%" class="sub_titulo"><div align="center">Estatus</div></th>
							<th width="30%" class="sub_titulo"><div align="center">Acciones</div></th>
							</tr>
							<tbody id="">';
										
							while (!$rs->EOF ){
								$id=$rs->fields['id_via_recepcion'];
								$nenabled=$rs->fields['nenabled'];
							if($rs->fields['nenabled']=='1'){ 
									$status="Habilitado";
									$accion1="<button type='button' class='button_personal btn_eliminar' onclick='javascript:activar(".$id.",".$nenabled.",3);'>Inhabilitar</button>";													
									$accion="<button type='button' class='button_personal btn_editar' onclick='javascript:editar(".$id.");' >Editar</button>";

							}else{ 
									$status="Inhabilitado";
									$accion1="<button type='button' class='button_personal btn_aceptar' onclick='javascript:activar(".$id.",".$nenabled.",3);' >Habilitar</button>";													
									$accion="<button type='button' class='button_personal btn_bloqueado'>Editar</button>";
							}
											

				$tabla.="<tr>
					<td width='30%' class='texto-normal' align='left'>".$rs->fields['sdecripcion_via_recepcion']."</td>
					<td width='20%' class='texto-normal' align='center'>".$status."</td>
					<td width='30%' class='texto-normal' align='center'>".$accion.$accion1."</td>
				</tr>";
											$rs->MoveNext();									
										 }
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>
												';												
							$valor=$tabla."|".$numero_registros;
					break;
					
					
					case '2': //Estatus_Caso
					
						$SQL="SELECT id_status, sdescripcion_status, nenabled FROM  oac.status_caso order by sdescripcion_status" ;
						$rs=$conn->Execute($SQL);
									
										if($rs->RecordCount()>0){
											$numero_registros=$rs->RecordCount();
										}else{
											$numero_registros=0;	
										}
							$tabla.='
							<div>
							<table class="display" border="0" align="center" id="tblDetalle" width="100%">
							<thead>
							<tr>
							<th width="50%" class="sub_titulo"><div align="left">Estatus del Caso</div></th>
							<th width="20%" class="sub_titulo"><div align="center">Estatus</div></th>
							<th width="30%" class="sub_titulo"><div align="center">Acciones</div></th>
							</tr>
							<tbody id="">';
										
							while (!$rs->EOF ){
								$id=$rs->fields['id_status'];
								$nenabled=$rs->fields['nenabled'];
							if($rs->fields['nenabled']=='1'){ 
									$status="Habilitado";
									$accion1="<button type='button' class='button_personal btn_eliminar' onclick='javascript:activar(".$id.",".$nenabled.",2);'>Inhabilitar</button>";													
									$accion="<button type='button' class='button_personal btn_editar' onclick='javascript:editar(".$id.");' >Editar</button>";

							}else{ 
									$status="Inhabilitado";
									$accion1="<button type='button' class='button_personal btn_aceptar' onclick='javascript:activar(".$id.",".$nenabled.",2);' >Habilitar</button>";													
									$accion="<button type='button' class='button_personal btn_bloqueado'>Editar</button>";
							}
											

				$tabla.="<tr>
					<td width='30%' class='texto-normal' align='left'>".$rs->fields['sdescripcion_status']."</td>
					<td width='20%' class='texto-normal' align='center'>".$status."</td>
					<td width='30%' class='texto-normal' align='center'>".$accion.$accion1."</td>
				</tr>";
											$rs->MoveNext();									
										 }
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>
												';												
							$valor=$tabla."|".$numero_registros;
					break;
					
					
					
					case '3': // via_recepcion
				
						$SQL="SELECT id_via_recepcion, sdecripcion_via_recepcion, nenabled FROM oac.via_recepcion order by sdecripcion_via_recepcion;
" ;
						$rs=$conn->Execute($SQL);
									
										if($rs->RecordCount()>0){
											$numero_registros=$rs->RecordCount();
										}else{
											$numero_registros=0;	
										}
							$tabla.='
							<div>
							<table class="display" border="0" align="center" id="tblDetalle" width="100%">
							<thead>
							<tr>
							<th width="50%" class="sub_titulo"><div align="left">Recepci&oacute;n</div></th>
							<th width="20%" class="sub_titulo"><div align="center">Estatus</div></th>
							<th width="30%" class="sub_titulo"><div align="center">Acciones</div></th>
							</tr>
							<tbody id="">';
										
							while (!$rs->EOF ){
								$id=$rs->fields['id_via_recepcion'];
								$nenabled=$rs->fields['nenabled'];
							if($rs->fields['nenabled']=='1'){ 
									$status="Habilitado";
									$accion1="<button type='button' class='button_personal btn_eliminar' onclick='javascript:activar(".$id.",".$nenabled.",3);'>Inhabilitar</button>";													
									$accion="<button type='button' class='button_personal btn_editar' onclick='javascript:editar(".$id.");' >Editar</button>";

							}else{ 
									$status="Inhabilitado";
									$accion1="<button type='button' class='button_personal btn_aceptar' onclick='javascript:activar(".$id.",".$nenabled.",3);' >Habilitar</button>";													
									$accion="<button type='button' class='button_personal btn_bloqueado'>Editar</button>";
							}
											

				$tabla.="<tr>
					<td width='30%' class='texto-normal' align='left'>".$rs->fields['sdescripcion']."</td>
					<td width='20%' class='texto-normal' align='center'>".$status."</td>
					<td width='30%' class='texto-normal' align='center'>".$accion.$accion1."</td>
				</tr>";
											$rs->MoveNext();									
										 }
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>
												';												
							$valor=$tabla."|".$numero_registros;
					break;
					
					case '4': //tipo_tipo_asistencia
					
						$SQL="SELECT id_tipo_asistencia, stipo_asistencia, nenabled FROM oac.tipo_asistencia order by stipo_asistencia" ;
						$rs=$conn->Execute($SQL);
									
										if($rs->RecordCount()>0){
											$numero_registros=$rs->RecordCount();
										}else{
											$numero_registros=0;	
										}
							$tabla.='
							<div>
							<table class="display" border="0" align="center" id="tblDetalle" width="100%">
							<thead>
							<tr>
							<th width="50%" class="sub_titulo"><div align="left">Tipo de Asistencia</div></th>
							<th width="20%" class="sub_titulo"><div align="center">Estatus</div></th>
							<th width="30%" class="sub_titulo"><div align="center">Acciones</div></th>
							</tr>
							<tbody id="">';
										
							while (!$rs->EOF ){
								$id=$rs->fields['id_tipo_asistencia'];
								$nenabled=$rs->fields['nenabled'];
							if($rs->fields['nenabled']=='1'){ 
									$status="Habilitado";
									$accion1="<button type='button' class='button_personal btn_eliminar' onclick='javascript:activar(".$id.",".$nenabled.",4);'>Inhabilitar</button>";													
									$accion="<button type='button' class='button_personal btn_editar' onclick='javascript:editar(".$id.");' >Editar</button>";

							}else{ 
									$status="Inhabilitado";
									$accion1="<button type='button' class='button_personal btn_aceptar' onclick='javascript:activar(".$id.",".$nenabled.",4);' >Habilitar</button>";													
									$accion="<button type='button' class='button_personal btn_bloqueado'>Editar</button>";
							}
											

				$tabla.="<tr>
					<td width='30%' class='texto-normal' align='left'>".$rs->fields['stipo_asistencia']."</td>
					<td width='20%' class='texto-normal' align='center'>".$status."</td>
					<td width='30%' class='texto-normal' align='center'>".$accion.$accion1."</td>
				</tr>";
											$rs->MoveNext();									
										 }
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>
												';												
							$valor=$tabla."|".$numero_registros;
					break;
					
					case '5': //organismo
					
						$SQL="SELECT id_organismo, sorganismo, nenabled FROM oac.organismos order by sorganismo" ;
						$rs=$conn->Execute($SQL);
									
										if($rs->RecordCount()>0){
											$numero_registros=$rs->RecordCount();
										}else{
											$numero_registros=0;	
										}
							$tabla.='
							<div>
							<table class="display" border="0" align="center" id="tblDetalle" width="100%">
							<thead>
							<tr>
							<th width="50%" class="sub_titulo"><div align="left">Organismos</div></th>
							<th width="20%" class="sub_titulo"><div align="center">Estatus</div></th>
							<th width="30%" class="sub_titulo"><div align="center">Acciones</div></th>
							</tr>
							<tbody id="">';
										
							while (!$rs->EOF ){
								$id=$rs->fields['id_organismo'];
								$nenabled=$rs->fields['nenabled'];
							if($rs->fields['nenabled']=='1'){ 
									$status="Habilitado";
									$accion1="<button type='button' class='button_personal btn_eliminar' onclick='javascript:activar(".$id.",".$nenabled.",5);'>Inhabilitar</button>";													
									$accion="<button type='button' class='button_personal btn_editar' onclick='javascript:editar(".$id.");' >Editar</button>";

							}else{ 
									$status="Inhabilitado";
									$accion1="<button type='button' class='button_personal btn_aceptar' onclick='javascript:activar(".$id.",".$nenabled.",5);' >Habilitar</button>";													
									$accion="<button type='button' class='button_personal btn_bloqueado'>Editar</button>";
							}
											

				$tabla.="<tr>
					<td width='30%' class='texto-normal' align='left'>".$rs->fields['sorganismo']."</td>
					<td width='20%' class='texto-normal' align='center'>".$status."</td>
					<td width='30%' class='texto-normal' align='center'>".$accion.$accion1."</td>
				</tr>";
											$rs->MoveNext();									
										 }
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>
												';												
							$valor=$tabla."|".$numero_registros;
					break;

					case '6': //detalle gestion
					
						$SQL="SELECT id_gestion, sgestion_detalle, nenabled FROM oac.gestion_detalle order by sgestion_detalle" ;
						$rs=$conn->Execute($SQL);
									
										if($rs->RecordCount()>0){
											$numero_registros=$rs->RecordCount();
										}else{
											$numero_registros=0;	
										}
							$tabla.='
							<div>
							<table class="display" border="0" align="center" id="tblDetalle" width="100%">
							<thead>
							<tr>
							<th width="50%" class="sub_titulo"><div align="left">Detalles de Gesti&oacute;n</div></th>
							<th width="20%" class="sub_titulo"><div align="center">Estatus</div></th>
							<th width="30%" class="sub_titulo"><div align="center">Acciones</div></th>
							</tr>
							<tbody id="">';
										
							while (!$rs->EOF ){
								$id=$rs->fields['id_gestion'];
								$nenabled=$rs->fields['nenabled'];
							if($rs->fields['nenabled']=='1'){ 
									$status="Habilitado";
									$accion1="<button type='button' class='button_personal btn_eliminar' onclick='javascript:activar(".$id.",".$nenabled.",6);'>Inhabilitar</button>";													
									$accion="<button type='button' class='button_personal btn_editar' onclick='javascript:editar(".$id.");' >Editar</button>";

							}else{ 
									$status="Inhabilitado";
									$accion1="<button type='button' class='button_personal btn_aceptar' onclick='javascript:activar(".$id.",".$nenabled.",6);' >Habilitar</button>";													
									$accion="<button type='button' class='button_personal btn_bloqueado'>Editar</button>";
							}
											

				$tabla.="<tr>
					<td width='30%' class='texto-normal' align='left'>".$rs->fields['sgestion_detalle']."</td>
					<td width='20%' class='texto-normal' align='center'>".$status."</td>
					<td width='30%' class='texto-normal' align='center'>".$accion.$accion1."</td>
				</tr>";
											$rs->MoveNext();									
										 }
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>
												';												
							$valor=$tabla."|".$numero_registros;
					break;
					
					
					case '7': //caso_tipo_correccion
					
						$SQL="SELECT id_tipo_caso, sdescripcion_tipo_caso, nenabled FROM  oac.caso_tipo_correccion order by sdescripcion_tipo_caso" ;
						$rs=$conn->Execute($SQL);
									
										if($rs->RecordCount()>0){
											$numero_registros=$rs->RecordCount();
										}else{
											$numero_registros=0;	
										}
							$tabla.='
							<div>
							<table class="display" border="0" align="center" id="tblDetalle" width="100%">
							<thead>
							<tr>
							<th width="50%" class="sub_titulo"><div align="left">Tipo de Caso RNET</div></th>
							<th width="20%" class="sub_titulo"><div align="center">Estatus</div></th>
							<th width="30%" class="sub_titulo"><div align="center">Acciones</div></th>
							</tr>
							<tbody id="">';
										
							while (!$rs->EOF ){
								$id=$rs->fields['id_tipo_caso'];
								$nenabled=$rs->fields['nenabled'];
							if($rs->fields['nenabled']=='1'){ 
									$status="Habilitado";
									$accion1="<button type='button' class='button_personal btn_eliminar' onclick='javascript:activar(".$id.",".$nenabled.",7);'>Inhabilitar</button>";													
									$accion="<button type='button' class='button_personal btn_editar' onclick='javascript:editar(".$id.");' >Editar</button>";

							}else{ 
									$status="Inhabilitado";
									$accion1="<button type='button' class='button_personal btn_aceptar' onclick='javascript:activar(".$id.",".$nenabled.",7);' >Habilitar</button>";													
									$accion="<button type='button' class='button_personal btn_bloqueado'>Editar</button>";
							}
											

				$tabla.="<tr>
					<td width='30%' class='texto-normal' align='left'>".$rs->fields['sdescripcion_tipo_caso']."</td>
					<td width='20%' class='texto-normal' align='center'>".$status."</td>
					<td width='30%' class='texto-normal' align='center'>".$accion.$accion1."</td>
				</tr>";
											$rs->MoveNext();									
										 }
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>
												';												
							$valor=$tabla."|".$numero_registros;
					break;
					
					
					case '8': //caso_detalle_correccion Detalle del Caso RNET
					
						$SQL="SELECT id_detalle_caso, sdescripcion_detalle_caso, nenabled FROM oac.caso_detalle_correccion order by sdescripcion_detalle_caso" ;
						$rs=$conn->Execute($SQL);
									
										if($rs->RecordCount()>0){
											$numero_registros=$rs->RecordCount();
										}else{
											$numero_registros=0;	
										}
							$tabla.='
							<div>
							<table class="display" border="0" align="center" id="tblDetalle" width="100%">
							<thead>
							<tr>
							<th width="50%" class="sub_titulo"><div align="left">Detalle del Caso RNET</div></th>
							<th width="20%" class="sub_titulo"><div align="center">Estatus</div></th>
							<th width="30%" class="sub_titulo"><div align="center">Acciones</div></th>
							</tr>
							<tbody id="">';
										
							while (!$rs->EOF ){
								$id=$rs->fields['id_detalle_caso'];
								$nenabled=$rs->fields['nenabled'];
							if($rs->fields['nenabled']=='1'){ 
									$status="Habilitado";
									$accion1="<button type='button' class='button_personal btn_eliminar' onclick='javascript:activar(".$id.",".$nenabled.",8);'>Inhabilitar</button>";													
									$accion="<button type='button' class='button_personal btn_editar' onclick='javascript:editar(".$id.");' >Editar</button>";

							}else{ 
									$status="Inhabilitado";
									$accion1="<button type='button' class='button_personal btn_aceptar' onclick='javascript:activar(".$id.",".$nenabled.",8);' >Habilitar</button>";													
									$accion="<button type='button' class='button_personal btn_bloqueado'>Editar</button>";
							}
											

				$tabla.="<tr>
					<td width='30%' class='texto-normal' align='left'><div align='left'>".trim(strtoupper($rs->fields['sdescripcion_detalle_caso']))."</div></td>
					<td width='20%' class='texto-normal' align='center'>".$status."</td>
					<td width='30%' class='texto-normal' align='center'>".$accion.$accion1."</td>
				</tr>";
											$rs->MoveNext();									
										 }
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>
												';												
							$valor=$tabla."|".$numero_registros;
					break;
					
					
					case '9': //caso_dato_correccion
					
						$SQL="SELECT id_dato, sdescripcion_dato, nenabled FROM oac.caso_dato_correccion order by sdescripcion_dato" ;
						$rs=$conn->Execute($SQL);
									
										if($rs->RecordCount()>0){
											$numero_registros=$rs->RecordCount();
										}else{
											$numero_registros=0;	
										}
							$tabla.='
							<div>
							<table class="display" border="0" align="center" id="tblDetalle" width="100%">
							<thead>
							<tr>
							<th width="50%" class="sub_titulo"><div align="left">Dato a Corregir RNET</div></th>
							<th width="20%" class="sub_titulo"><div align="center">Estatus</div></th>
							<th width="30%" class="sub_titulo"><div align="center">Acciones</div></th>
							</tr>
							<tbody id="">';
										
							while (!$rs->EOF ){
								$id=$rs->fields['id_dato'];
								$nenabled=$rs->fields['nenabled'];
							if($rs->fields['nenabled']=='1'){ 
									$status="Habilitado";
									$accion1="<button type='button' class='button_personal btn_eliminar' onclick='javascript:activar(".$id.",".$nenabled.",9);'>Inhabilitar</button>";													
									$accion="<button type='button' class='button_personal btn_editar' onclick='javascript:editar(".$id.");' >Editar</button>";

							}else{ 
									$status="Inhabilitado";
									$accion1="<button type='button' class='button_personal btn_aceptar' onclick='javascript:activar(".$id.",".$nenabled.",9);' >Habilitar</button>";													
									$accion="<button type='button' class='button_personal btn_bloqueado'>Editar</button>";
							}
											

				$tabla.="<tr>
					<td width='30%' class='texto-normal' align='left'><div align='left>".trim(strtoupper($rs->fields['sdescripcion_dato']))."</div></td>
					<td width='20%' class='texto-normal' align='center'>".$status."</td>
					<td width='30%' class='texto-normal' align='center'>".$accion.$accion1."</td>
				</tr>";
											$rs->MoveNext();									
										 }
							$tabla.='
														</tbody>
													</thead>
												</table>
												</div>
												';												
							$valor=$tabla."|".$numero_registros;
					break;
	}
			
			
echo $valor;	
			
			
			
			
			

?>