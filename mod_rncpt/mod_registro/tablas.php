<script src="/minpptrassi/datatables/funcion_paginador.js"></script>
<?php
include("../../include/header.php"); 
$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
debug();

			switch($_POST['opcion']){
					case '1': //productividad
				
						$SQL="SELECT id, sdescripcion, nenabled FROM rncpt.motor " ;
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
							<th width="50%" class="sub_titulo"><div align="center">Motor</div></th>
							<th width="20%" class="sub_titulo"><div align="center">Estatus</div></th>
							<th width="30%" class="sub_titulo"><div align="center">Acciones</div></th>
							</tr>
							<tbody id="">';
										
							while (!$rs->EOF ){
								$id=$rs->fields['id'];
								$nenabled=$rs->fields['nenabled'];
							if($rs->fields['nenabled']=='1'){ 
									$status="Habilitado";
									$accion1="<button type='button' class='button_personal btn_eliminar' onclick='javascript:activar(".$id.",".$nenabled.",1);'>Inhabilitar</button>";													
									$accion="<button type='button' class='button_personal btn_editar' onclick='javascript:editar(".$id.");' >Editar</button>";

							}else{ 
									$status="Inhabilitado";
									$accion1="<button type='button' class='button_personal btn_aceptar' onclick='javascript:activar(".$id.",".$nenabled.",1);' >Habilitar</button>";													
									$accion="<button type='button' class='button_personal btn_bloqueado'>Editar</button>";
							}
											

				$tabla.="<tr>
					<td width='30%' class='texto-normal' align='center'>".strtoupper($rs->fields['sdescripcion'])."</td>
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
					
					
					case '2': //cargos
					
						$SQL="SELECT id, descripcion_cargo, nenabled FROM rncpt.cargos " ;
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
							<th width="40%" class="sub_titulo"><div align="center">Cargos</div></th>
							<th width="20%" class="sub_titulo"><div align="left">Estatus</div></th>
							<th width="20%" class="sub_titulo"><div align="center">Acciones</div></th>
							</tr>
							<tbody id="">';
										
							while (!$rs->EOF ){
								$id=$rs->fields['id'];
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
					<td width='40%' class='texto-normal' align='left'>".strtoupper($rs->fields['descripcion_cargo'])."</td>
					
					<td width='20%' class='texto-normal' align='left'>".$status."</td>
					<td width='20%' class='texto-normal' align='center'>".$accion.$accion1."</td>
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
					
					
					case '3': // Condicion_Actual
				
						$SQL="SELECT id, sdescripcion, nenabled FROM rncpt.condicion_act " ;
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
							<th width="50%" class="sub_titulo"><div align="center">Condici&oacute;n Actual</div></th>
							<th width="20%" class="sub_titulo"><div align="center">Estatus</div></th>
							<th width="30%" class="sub_titulo"><div align="center">Acciones</div></th>
							</tr>
							<tbody id="">';
										
							while (!$rs->EOF ){
								$id=$rs->fields['id'];
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
					<td width='30%' class='texto-normal' align='center'>".strtoupper($rs->fields['sdescripcion'])."</td>
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
					
					case '4': //condicion_laboral
					
						$SQL="SELECT id, sdescripcion, nenabled FROM rncpt.condicion_laboral " ;
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
							<th width="50%" class="sub_titulo"><div align="center">Condici&oacute;n Laboral</div></th>
							<th width="20%" class="sub_titulo"><div align="center">Estatus</div></th>
							<th width="30%" class="sub_titulo"><div align="center">Acciones</div></th>
							</tr>
							<tbody id="">';
										
							while (!$rs->EOF ){
								$id=$rs->fields['id'];
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
					<td width='30%' class='texto-normal' align='center'>".strtoupper($rs->fields['sdescripcion'])."</td>
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
					
					case '5': //status_reposos
					
						$SQL="SELECT ncodigo, sdescripcion, nenabled FROM reposos_medicos.status_reposos" ;
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
							<th width="50%" class="sub_titulo"><div align="center">Estatus del reposo</div></th>
							<th width="20%" class="sub_titulo"><div align="center">Status</div></th>
							<th width="30%" class="sub_titulo"><div align="center">Acciones</div></th>
							</tr>
							<tbody id="">';
										
							while (!$rs->EOF ){
								$id=$rs->fields['ncodigo'];
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
					<td width='30%' class='texto-normal' align='left'>".strtoupper($rs->fields['sdescripcion'])."</td>
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