<meta charset="UTF-8">
<?php
ini_set("display_errors", 0);
error_reporting(-1);

require_once("../../header.php");


/*$_SESSION["empresa_id"]=2;
$_SESSION["usuario_id"]=1;
$_SESSION["nro_boleta"]='III-2020-CPT-1234';
*/

$settings['debug'] = false;
$conn = getConnDB($db1);
$conn->debug = false;

//$conn->debug = $settings['debug'];

$aDefaultForm = array();

debug();
doAction($conn);


//-------------------- Función debug --------------------//

function doAction($conn)
{
	if (isset($_POST['action'])) {
		switch ($_POST['action']) {

			case 'Redireccionar':
				$_SESSION['disabled'] = '';

				$SQL = "SELECT * FROM rncpt.empresa WHERE id = '" . $_SESSION["empresa_id"] . "' AND nenabled ='1' AND empresa.nestatus='1';";
				$rs = $conn->Execute($SQL);
				if ($rs->RecordCount() > 0) {
					$boleta = $rs->fields['nro_boleta'];
					$pase = $boleta;

					$SQL = "SELECT miembros_id, nestatus_cptt FROM rncpt.miembros_empresa WHERE empresa_id = '" . $_SESSION["empresa_id"] . "' AND   nenabled ='1'   ;";
					$rs = $conn->Execute($SQL);
					$estatus_cptt = $rs->fields['nestatus_cptt'];
					if ($rs->RecordCount() >= 3) {
						if ($estatus_cptt == 1) {
							if ($rs->RecordCount() <= 7) {
								$bValidateSuccess = true;
								$_SESSION['disabled'] = 'disabled="disabled"';
?>
								<script>
									alert;
								</script>
							<?
								echo "<form id='redirectForm' method='POST' action='boleta_QR.php' style='display:none;'>
							<input type='hidden' name='boleta' value='$boleta'>
						</form>
						<script>
							document.getElementById('redirectForm').submit();
						</script>";
							} else {
								$GLOBALS['aPageErrors'][] = "El Máximo de Voceros es siete(7) "; ?>
								<script>
									alert('El Máximo de Voceros es siete(7)');
								</script>
							<?
							}
						} else {
							$GLOBALS['aPageErrors'][] = "El Estatus del CPTT debe estar Vigente";	?>
							<script>
								alert('El Estatus del CPTT debe estar Vigente');
							</script>
						<?
						}
					} else {
						$GLOBALS['aPageErrors'][] = "Debe agregar al menos tres (3) Voceros"; ?>
						<script>
							alert('Debe agregar al menos tres (3) Voceros');
						</script>
					<?
					}
				} else {
					$GLOBALS['aPageErrors'][] = "Debe Registrar los datos del CPTT. La entidad de trabajo puede estar Inactiva"; ?>
					<script>
						alert('Debe Registrar los datos del CPTT. La entidad de trabajo puede estar Inactiva');
					</script>
				<?
				}
				loadData($conn, true);
				break;
			case 'Regresar':
				unset($_SESSION['empresa_id']);
				unset($_SESSION['entidad']);
				unset($_SESSION['aDefaults1']);
				unset($_SESSION['aDefaults']);


				?>
				<script>
					document.location = 'registro_empresa_act.php';
				</script>
				<?
				break;
			case 'Modificar':
				//Pasos:
				//1/5 Ubico los voceros del CPTT en Sesión
				//2/5 Agrego esos voceros en un arreglo
				//3/5 Inhabilito los registros de los voceros de ese CPTT
				//4/5 Incorporo los voceros del arreglo en miembros_empresa
				//5/5 Actualizo los datos del vocero seleccionado

				//Nota:Id del vocero (miembros_id) y el id de miembros_empresa:
				//echo($_POST['id'] . '<br>' . $_POST['id_miembro_empresa']);die();
				if ($_POST['id'] != NULL and $_POST['id_miembro_empresa'] != NULL) {
					//1/5.- Busco todos los voceros con registro activo según el id de la empresa
					//autenticada ($_SESSION["empresa_id"])
					$SQL = " SELECT miembros_empresa.id as miembros_empresa_id, 
						miembros_empresa.nenabled,
						miembros_empresa.total_trabajadores,
						miembros_empresa.dfecha_const_comite,
						miembros_empresa.dfecha_vencimiento,
						miembros_empresa.dfecha_nueva_eleccion,
						miembros_empresa.condicion_act_id,
						miembros_empresa.condicion_laboral_id,
						miembros_empresa.cargos_id,				
						miembros_empresa.nro_votos,
						miembros_empresa.comentarios,
						miembros.ncedula,
						miembros.id as miembros_id,
						miembros.sprimer_nombre,
						miembros.ssegundo_nombre,
						miembros.sprimer_apellido,
						miembros.ssegundo_apellido,
						miembros.stelefono1,
						miembros.stelefono2,
						miembros.nsexo,
						miembros.semail,
						miembros.sdireccion_habitacion,
						miembros.fecha_nacimiento,
						miembros_empresa.condicion_act_id,
						miembros_empresa.condicion_laboral_id,
						cargos.descripcion_cargo	as cargos,
						miembros_empresa.cargos_id,
						miembros_empresa.comentarios,
						miembros_empresa.nestatus_vocero,
						miembros_empresa.nestatus_cptt						
					FROM rncpt.miembros_empresa
					INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
					inner join rncpt.cargos on miembros_empresa.cargos_id=cargos.id
					inner join rncpt.condicion_act on miembros_empresa.condicion_act_id=condicion_act.id
					WHERE miembros_id = " . $_POST['id'] .
						" AND miembros_empresa.nenabled = '1';";
					$rs = $conn->Execute($SQL);

					if ($rs->RecordCount() > 0) {
						$cantidadVoceros = 0;
						$cantidadVoceros = $rs->RecordCount();
						//2/5.- Meto esos voceros, tal cual están, en un arreglo:	
						$f = 0;
						$aVocerosEditados[] = array();  //Arreglo de Voceros
						$aVocerosEditados[$f]['miembros_empresa_id'] = $rs->fields['miembros_empresa_id'];
						$aVocerosEditados[$f]['empresa_id'] = $_SESSION["empresa_id"];
						$aVocerosEditados[$f]['miembros_id'] = $rs->fields['miembros_id'];
						$aVocerosEditados[$f]['usuario_idcreacion'] = $_SESSION["id_usuario"];
						$aVocerosEditados[$f]['condicion_act_id'] = $rs->fields['condicion_act_id'];
						$aVocerosEditados[$f]['cargos_id'] = $rs->fields['cargos_id'];
						$aVocerosEditados[$f]['nro_votos'] = $rs->fields['nro_votos'];
						$aVocerosEditados[$f]['total_trabajadores'] = $rs->fields['total_trabajadores'];
						//$aVocerosEditados[$f]['dfecha_vencimiento']=$rs->fields['dfecha_vencimiento'];
						$aVocerosEditados[$f]['dfecha_vencimiento'] = $_POST['fechavencimiento_'];
						//$aVocerosEditados[$f]['dfecha_const_comite']=$rs->fields['dfecha_const_comite'];
						$aVocerosEditados[$f]['dfecha_const_comite'] = $_POST['fechaconst'];
						$aVocerosEditados[$f]['condicion_laboral_id'] = $rs->fields['condicion_laboral_id'];
						//$aVocerosEditados[$f]['dfecha_nueva_eleccion']=$rs->fields['dfecha_nueva_eleccion'];
						$aVocerosEditados[$f]['dfecha_nueva_eleccion'] = $_POST['fechanueva_eleccion'];
						$hoy = $_POST['hoy'];
						//El Beta el comentario:
						if ($_POST['vocero_estatus'] == 1) {
							if ($rs->fields['nestatus_vocero'] == 3) {
								$aVocerosEditados[$f]['comentarios'] = '';
							} else {
								//$aVocerosEditados[$f]['comentarios']=$rs->fields['comentarios'];
								$aVocerosEditados[$f]['comentarios'] = $_POST['txt_comentarios'];
							}
							if ($_POST['fechavencimiento_'] < $hoy) {
								$aVocerosEditados[$f]['nestatus_vocero'] = 2;
								$aVocerosEditados[$f]['nestatus_cptt']  = 2;
							} else {
								$aVocerosEditados[$f]['nestatus_vocero'] = 1;
								$aVocerosEditados[$f]['nestatus_cptt']  = 1;
							}
						} else if ($_POST['vocero_estatus'] == 2) {
							if ($rs->fields['nestatus_vocero'] == 3) {
								$aVocerosEditados[$f]['comentarios'] = '';
							} else {
								$aVocerosEditados[$f]['comentarios'] = $_POST['txt_comentarios'];
							}
							if ($_POST['fechavencimiento_'] > $hoy) {
								$aVocerosEditados[$f]['nestatus_vocero'] = 1;
								$aVocerosEditados[$f]['nestatus_cptt']  = 1;
							} else {
								$aVocerosEditados[$f]['nestatus_vocero'] = 2;
								$aVocerosEditados[$f]['nestatus_cptt']  = 2;
							}
							/*
							     echo($_POST['fechavencimiento_']);
							     echo('<br>'.$hoy. '<br>');
							     echo($aVocerosEditados[$f]['nestatus_vocero']);
							     echo('<br>' . $aVocerosEditados[$f]['nestatus_cptt']);
							     die();
							      */
						} else if ($_POST['vocero_estatus'] == 3) {
							$aVocerosEditados[$f]['nestatus_vocero'] = 3;
							$aVocerosEditados[$f]['nestatus_cptt']  = 3;
							$aVocerosEditados[$f]['comentarios'] = $_POST['txt_comentarios'];
						}
						$rs->MoveNext();
					}
					//var_dump($aVocerosEditados);
					//3/5.- Aqui deshabilito todos los voceros para ese CPTT, con registro activo
					if ($rs->RecordCount() > 0) {
						if ($_POST['fechanueva_eleccion'] == '') {
							$_POST['fechanueva_eleccion'] = '1900-01-01';
						}
						$SQL = "UPDATE rncpt.miembros_empresa
							 SET						
						   usuario_idactualizacion = '" . $_SESSION["id_usuario"] . "',
						   dfecha_actualizacion = '" . date('Y-m-d H:i:s') . "',
						   nro_votos = '" . $_POST['nro_votos'] . "',
						   total_trabajadores = '" . $_POST['total_trabajadores'] . "',
						   nenabled=0
					       WHERE  miembros_empresa.empresa_id = '" . $_SESSION["empresa_id"] . "' AND nenabled='1' AND miembros_id = '" . $_POST['id'] . "'";
						//echo($SQL);
						//die();
						//Bloquear por ahorita:
						$success1 = $conn->Execute($SQL);   //Habilitar
						$f = 0;
						$SQL = '';


						$SQL .= "INSERT INTO rncpt.miembros_empresa(
						empresa_id, 
						miembros_id, 
						nenabled, 
						usuario_idcreacion,
						dfecha_creacion,
						condicion_act_id,	
						cargos_id,	
						comentarios,
						nro_votos,
						total_trabajadores,
						dfecha_vencimiento,
						dfecha_const_comite,
						condicion_laboral_id,
						dfecha_nueva_eleccion,
						nestatus_cptt,
						nestatus_vocero
						)
						VALUES ('"
							. $aVocerosEditados[$f]['empresa_id'] . "',
						'" . $aVocerosEditados[$f]['miembros_id'] . "',
						'1',
						'" . $aVocerosEditados[$f]['usuario_idcreacion'] . "',
						'" . date('Y-m-d H:i:s') . "',
						'" . $aVocerosEditados[$f]['condicion_act_id'] . "',
						'" . $aVocerosEditados[$f]['cargos_id'] . "',
						'" . $aVocerosEditados[$f]['comentarios'] . "',
						" . $_POST['nro_votos'] . ",
						" . $_POST['total_trabajadores'] . ",
						'" . $aVocerosEditados[$f]['dfecha_vencimiento'] . "',
						'" . $aVocerosEditados[$f]['dfecha_const_comite'] . "',
						'" . $aVocerosEditados[$f]['condicion_laboral_id'] . "',
						'" . $aVocerosEditados[$f]['dfecha_nueva_eleccion'] . "', 
						'" . $aVocerosEditados[$f]['nestatus_cptt'] . "',
						'" . $aVocerosEditados[$f]['nestatus_vocero'] . "');";

						//var_dump($aVocerosEditados);
						//echo($SQL);
						//die();
						//4/5.- Agrego los voceros del arreglo
						$success1 = $conn->Execute($SQL);
						$ta = "UPDATE rncpt.miembros_empresa SET  total_trabajadores='" . $_POST['total_trabajadores'] . "',dfecha_nueva_eleccion='" . $aVocerosEditados[$f]['dfecha_nueva_eleccion'] . "',nestatus_cptt='" . $aVocerosEditados[$f]['nestatus_cptt'] . "',dfecha_vencimiento='" . $aVocerosEditados[$f]['dfecha_vencimiento'] . "',nestatus_vocero='" . $aVocerosEditados[$f]['nestatus_vocero'] . "' WHERE empresa_id='" . $_SESSION["empresa_id"] . "'";
						$ass = $conn->Execute($ta);
						if ($_POST['codigo1'] == '' or $_POST['telefono1'] == '') $ntelefono1 = '';
						else $ntelefono1 = $_POST['codigo1'] . $_POST['telefono1'];
						if ($_POST['codigo2'] == '' or $_POST['telefono2'] == '') $ntelefono2 = '';
						else $ntelefono2 = $_POST['codigo2'] . $_POST['telefono2'];

						if ($_POST['sexo'] == 'M') $sexo = 1;
						if ($_POST['sexo'] == 'F') $sexo = 2;
						/* SQL Original */
						/*
					$SQL="UPDATE rncpt.miembros
									  SET stelefono1 = '".$ntelefono1."', 
										  stelefono2 = '".$ntelefono2."', 
										  semail = '".$_POST['email']."', 
										  fecha_nacimiento='".$_POST['fecha_nacimiento']."', 
										   nsexo='".$sexo."', 
										   sdireccion_habitacion = '".$_POST['txt_direccion_hab']."', 
										  usuario_idactualizacion = '".$_SESSION["id_usuario"]."', 
										  dfecha_actualizacion = '".date('Y-m-d H:i:s')."'
									  WHERE id = '".$rs->fields['id']."';";
					 */
						/* SQL Propuesto */
						//5/5.- Actualizo los datos del vocero seleccionado
						$SQL = "UPDATE rncpt.miembros
						 SET stelefono1 = '" . $ntelefono1 . "', 
					       stelefono2 = '" . $ntelefono2 . "', 
						    semail = '" . $_POST['email'] . "', 
						    fecha_nacimiento='" . $_POST['fecha_nacimiento'] . "', 
						     sdireccion_habitacion = '" . $_POST['txt_direccion_hab'] . "', 
						    usuario_idactualizacion = '" . $_SESSION["id_usuario"] . "', 
						    dfecha_actualizacion = '" . date('Y-m-d H:i:s') . "'
					    WHERE id = '" . $_POST['id'] . "';";
						$success2 = $conn->Execute($SQL);
						if ($success1 and $success2) {
							$GLOBALS['aPageErrors'][] = "Los datos del Vocero fueron modificados.";
						} else {
							$GLOBALS['aPageErrors'][] = "Error al actualizar los datos del Vocero.";
						}
					}
				}

				loadData($conn, FALSE);
				break;

				//----------CASE_ELIMINAR----------//
			case 'Eliminar':

				if ($_POST['id_miembro_empresa'] != NULL) {
					$SQL = "UPDATE rncpt.miembros_empresa
						  SET nenabled = 0,
							  usuario_idactualizacion = '" . $_SESSION["id_usuario"] . "',
							  dfecha_actualizacion = '" . date('Y-m-d H:i:s') . "'
					      WHERE miembros_empresa.id = '" . $_POST['id_miembro_empresa'] . "' 
						  AND miembros_empresa.empresa_id = '" . $_SESSION["empresa_id"] . "'
						   
						  ;";
					$success = $conn->Execute($SQL);

					$GLOBALS['aPageErrors'][] = "El Vocero Fue Eliminado";
				}

				loadData($conn, false);
				break;
				//----------CASE_GUARDAR----------//				
			case 'Guardar': //agregar voceross cptt
				$bValidateSuccess        = true;

				//Verifica la cantidad de voceros para el CPTT sesionado
				$SQL3 = "SELECT count(*) AS voceros from rncpt.miembros_empresa 
				where miembros_empresa.empresa_id='" . $_SESSION["empresa_id"] . "' and miembros_empresa.nenabled='1';";
				$rs3 = $conn->Execute($SQL3);
				$voceros = $rs3->fields['voceros'];
				if ($voceros == 7) {
					$GLOBALS['aPageErrors'][] = "- La cantidad de Voceros debe ser mínimo tres (3) máximo (7).";
					$bValidateSuccess = false;
				}
				//Verifico y comparo el número de votos con el total de trabajadores
				if ($_POST['nro_votos'] > $_POST['total_trabajadores']) {
					$GLOBALS['aPageErrors'][] = "- El N° de Votos por el cuál fue electo	no puede ser mayor al Total de Trabajadores de la Entidad de Trabajo.";
					$bValidateSuccess = false;
				}
				//Verifico y comparo el total de trabajadores con el número de votos
				if ($_POST['total_trabajadores'] < $_POST['nro_votos']) {
					$GLOBALS['aPageErrors'][] = "- El Total de Trabajadores de la Entidad de Trabajo no puede ser menor al N° de Votos por el cuál fue electo.";
					$bValidateSuccess = false;
				}
				//Verifico si pasó la primera validación
				if ($bValidateSuccess) {
					$date = strtotime($_POST['fechaconst']);
					$fechaconst = date('Y-m-d', $date);

					$date__ = strtotime($_POST['fechavencimiento_']);
					$fechavencimiento = date('Y-m-d', $date__);

					if ($_POST['fechanueva_eleccion'] == '') {
						$_POST['fechanueva_eleccion'] = '1900-01-01';
					}

					if ($_POST['nro_votos'] == '') {
						$_POST['nro_votos'] = 0;
					}

					if ($_POST['total_trabajadores'] == '') {
						$_POST['total_trabajadores'] = 0;
					}
					if ($_POST['codigo1'] == '' or $_POST['telefono1'] == '') $ntelefono1 = '';
					else $ntelefono1 = $_POST['codigo1'] . $_POST['telefono1'];
					if ($_POST['codigo2'] == '' or $_POST['telefono2'] == '') $ntelefono2 = '';
					else $ntelefono2 = $_POST['codigo2'] . $_POST['telefono2'];
					//Verifico si el Vocero está en un CPTT
					if ($_POST['cedulaconsulta'] != NULL) {
						$SQL = "SELECT miembros_empresa.miembros_id,
						   miembros_empresa.nenabled,
						   miembros.ncedula
					  FROM rncpt.miembros_empresa
					  INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
					  WHERE miembros_empresa.nenabled = '1'
					  AND miembros.ncedula='" . $_POST['cedulaconsulta'] . "' and miembros_empresa.condicion_laboral_id=1 ";
						$rs = $conn->Execute($SQL);
					}
					$bValidateVoceroExistente = 'false';
					if ($rs->RecordCount() > 0) {
						//$GLOBALS['aPageErrors'][] = "El Vocero ya se encuentra registrado y activo en otro CPTT";
						//El Vocero se encuentra registrado y habilitado en un CPTT";
						$bValidateVoceroExistente = 'true';
					} else {
						$bValidateVoceroExistente = 'false';
					}
					if ($bValidateVoceroExistente == 'true') {
						//Verifico si el vocero, estando activo, si está inoperativo en algún CPTT
						$SQL = "SELECT miembros_empresa.miembros_id,
					       miembros_empresa.nenabled,
					       miembros.ncedula
					       FROM rncpt.miembros_empresa
					           INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
						   WHERE miembros_empresa.nenabled = '1'
						   AND miembros_empresa.nestatus_vocero='3'
					           AND miembros.ncedula='" . $_POST['cedulaconsulta'] . "' and miembros_empresa.condicion_laboral_id=1 ";
						$rs = $conn->Execute($SQL);
						if ($rs->RecordCount() < 1) {
							//Lo Reboto Porque está habilitado en un CPTT pero no no está como inoperativo
							$GLOBALS['aPageErrors'][] = "El Vocero existe en un CPTT y está vencido o vigente, mas no inoperativo";
						} else {
							//die('Esta cedula está inoperativa');
							//Verifico si el vocero ya se encuentra, según cédula, en la tabla de miembros
							$SQL2 = "SELECT id,  
							stelefono1, 
							stelefono2, 
							semail
						  FROM rncpt.miembros
						  WHERE ncedula ='" . $_POST['cedulaconsulta'] . "';";
							//echo($SQL2);
							$rs2 = $conn->Execute($SQL2);
							if ($rs2->RecordCount() > 0) {
								//---SI MIENBRO NO ESTA REGISTRADO PARA LA EMPRESA PERO SI FUE REGISTRADO EN EL PASADO...
								//Si ya está en la tabla de miembros, hago un update de sus datos
								$SQL = "UPDATE rncpt.miembros
								SET stelefono1 = '" . $ntelefono1 . "', 
								stelefono2 = '" . $ntelefono2 . "', 
								semail = '" . $_POST['email'] . "', 
								 sdireccion_habitacion = '" . $_POST['txt_direccion_hab'] . "', 
								usuario_idactualizacion = '" . $_SESSION["id_usuario"] . "', 
								dfecha_actualizacion = '" . date('Y-m-d H:i:s') . "'
								WHERE id = '" . $rs2->fields['id'] . "';";
								//echo($SQL);
								//$success= $conn->Execute($SQL); Habilitar
								////$SQL="SELECT id FROM rncpt.miembros WHERE ncedula = '".$_POST['cedulaconsulta']."'";	
								//// echo($SQL);
								//Obtengo el id que tiene en miembros para hacer insert en miembros_empresa
								//con el id que ya viene arrastrando
								if ($_POST['vocero_estatus'] == 1) {
									$estatus_vocero = 1;
									$estatus_cptt  = 1;
								} elseif ($_POST['vocero_estatus'] == 2) {
									$estatus_vocero = 2;
									$estatus_cptt  = 2;
								}




								$SQL = "INSERT INTO rncpt.miembros_empresa(
								 empresa_id, 
								 miembros_id, 
								 nenabled, 
								 usuario_idcreacion,
								 dfecha_creacion,
								 condicion_act_id,	
								 cargos_id,
								 comentarios,
								nro_votos,
								total_trabajadores,
								dfecha_vencimiento,
								dfecha_const_comite,
								dfecha_nueva_eleccion,
								condicion_laboral_id,
							        nestatus_vocero,
							        nestatus_cptt
								)
								VALUES ('" . $_SESSION["empresa_id"] . "',     
								'" . $rs2->fields['id'] . "',
								'1',
								'" . $_SESSION["id_usuario"] . "',
								'" . date('Y-m-d H:i:s') . "','" . $_POST['condicion'] . "',
								'" . $_POST['cbo_cargos'] . "',														
								'" . $_POST['txt_comentarios'] . "',													
								'" . $_POST['nro_votos'] . "',
								'" . $_POST['total_trabajadores'] . "',
								'" . $fechavencimiento . "',
								'" . $fechaconst . "',
								'" . $_POST['fechanueva_eleccion'] . "',
								'" . $_POST['condicion_laboral'] . "',
								'" . $estatus_vocero . "',
								'" . $estatus_cptt . "'" .
									");";

								//echo($SQL);
								$val = "SELECT id, empresa_id, miembros_id, dfecha_const_comite, nenabled,   nro_votos, total_trabajadores
	FROM rncpt.miembros_empresa where empresa_id='" . $_SESSION["empresa_id"] . "'";
								$rw = pg_query($conn, $val);
								$persona = pg_fetch_all($rw);
								$tlt = 0;
								foreach ($persona as $a) {
									/* $_SESSION['nm_votos'] = $a['nro_votos'];
									$_SESSION['tt_trabajadores'] = $a['total_trabajadores'];
									$tlt = $_SESSION['tt_trabajadores'] - $_SESSION['nm_votos']; */
								}
								if ($tlt == 0) {
									$GLOBALS['aPageErrors'][] = "El número de votantes a llegado al límite de votos";
									$bValidateSuccess = false;
				?><script>
										alert('El número de votantes ha llegado al límite de votos');
									</script><?									/* 									echo "<script>alert('El número de votantes ha llegado al límite de votos');</script>";
 */
											} else {
												if ($_POST['nro_votos'] != $tlt) {
													# code...
													$success = $conn->Execute($SQL);
													$GLOBALS['aPageErrors'][] = "El Vocero Fue Agregado Exitosamente";
													$tt = "UPDATE rncpt.miembros_empresa SET  total_trabajadores='" . $_POST['total_trabajadores'] . "' WHERE empresa_id='" . $_SESSION["empresa_id"] . "'";
													$as = $conn->Execute($tt);
												} else {
													$GLOBALS['aPageErrors'][] = "El número de votantes a llegado al límite de votos";
													$bValidateSuccess = false;
												?><script>
											alert('El número de votantes ha llegado al límite de votos');
										</script><?									}
											}
										}
									}
								} else {
									//echo('El pana no tiene un registro habilitado en ningun CPTT');
									//Como no está con registro habilitado en un CPTT, Lo Verifico en miembros:
									//Verifico si el vocero ya se encuentra, según cédula en la tabla de miembros
									$SQL2 = "SELECT id,  
							stelefono1, 
							stelefono2, 
							semail
						  FROM rncpt.miembros
						  WHERE ncedula ='" . $_POST['cedulaconsulta'] . "';";
									$rs2 = $conn->Execute($SQL2);
									if ($rs2->RecordCount() > 0) {
										//Si ya está en la tabla de miembros, hago un update de sus datos
										$SQL = "UPDATE rncpt.miembros
								SET stelefono1 = '" . $ntelefono1 . "', 
								stelefono2 = '" . $ntelefono2 . "', 
								semail = '" . $_POST['email'] . "', 
								 sdireccion_habitacion = '" . $_POST['txt_direccion_hab'] . "', 
								usuario_idactualizacion = '" . $_SESSION["id_usuario"] . "', 
								dfecha_actualizacion = '" . date('Y-m-d H:i:s') . "'
								WHERE id = '" . $rs2->fields['id'] . "';";
										$success = $conn->Execute($SQL);
										if ($_POST['vocero_estatus'] == 1) {
											$estatus_vocero = 1;
											$estatus_cptt  = 1;
										} elseif ($_POST['vocero_estatus'] == 2) {
											$estatus_vocero = 2;
											$estatus_cptt  = 2;
										}

										$SQL = "";
										$SQL .= "INSERT INTO rncpt.miembros_empresa";
										$SQL .= "(";
										$SQL .= "empresa_id";
										$SQL .= ",miembros_id";
										$SQL .= ",nenabled";
										$SQL .= ",usuario_idcreacion";
										$SQL .= ",dfecha_creacion";
										$SQL .= ",condicion_act_id";
										$SQL .= ",cargos_id";
										$SQL .= ",comentarios";
										$SQL .= ",nro_votos";
										$SQL .= ",total_trabajadores";
										$SQL .= ",dfecha_vencimiento";
										$SQL .= ",dfecha_const_comite";
										$SQL .= ",dfecha_nueva_eleccion";
										$SQL .= ",condicion_laboral_id";
										$SQL .= ",nestatus_vocero";
										$SQL .= ",nestatus_cptt";
										$SQL .= ")";
										$SQL .= " VALUES ";
										$SQL .= "(";
										$SQL .= "'" . $_SESSION['empresa_id'] . "'";
										$SQL .= ",'" . $rs2->fields['id'] . "'";
										$SQL .= ",'1'";
										$SQL .= ",'" . $_SESSION["id_usuario"] . "'";
										$SQL .= ",'" . date('Y-m-d H:i:s') . "'";
										$SQL .= ",'" . $_POST['condicion'] . "'";
										$SQL .= ",'" . $_POST["cbo_cargos"] . "'";
										$SQL .= ",'" . $_POST["txt_comentarios"] . "'";
										$SQL .= ",'" . $_POST["nro_votos"] . "'";
										$SQL .= ",'" . $_POST["total_trabajadores"] . "'";
										$SQL .= ",'" . $fechavencimiento . "'";
										$SQL .= ",'" . $fechaconst . "'";
										$SQL .= ",'" . $_POST["fechanueva_eleccion"] . "'";
										$SQL .= ",'" . $_POST["condicion_laboral"] . "'";
										$SQL .= ",'" . $estatus_vocero . "'";
										$SQL .= ",'" . $estatus_cptt . "'";
										$SQL .= ");";
										//echo($SQL);
										//die();
										//Voy por aqui
										$val = "SELECT id, empresa_id, miembros_id, dfecha_const_comite, nenabled,   nro_votos, total_trabajadores
	FROM rncpt.miembros_empresa where empresa_id='" . $_SESSION["empresa_id"] . "'";
										$rw = pg_query($conn, $val);
										$persona = pg_fetch_all($rw);
										$tlt = 0;
										foreach ($persona as $a) {
											$nro_v = $a['nro_votos'];
											$total_trabajadores = $a['total_trabajadores'];
											$tlt = $total_trabajadores - $nro_v;
										}
										if ($tlt == 0) {
											$GLOBALS['aPageErrors'][] = "El número de votantes a llegado al límite de votos";
											$bValidateSuccess = false;
													?><script>
									alert('El número de votantes ha llegado al límite de votos');
								</script><?								/* 									echo "<script>alert('El número de votantes ha llegado al límite de votos');</script>";
 */
										} else {
											if ($_POST['nro_votos'] != $tlt) {
												# code...
												$success = $conn->Execute($SQL);
												$GLOBALS['aPageErrors'][] = "El Vocero Fue Agregado Exitosamente";
												$tt = "UPDATE rncpt.miembros_empresa SET  total_trabajadores='" . $_POST['total_trabajadores'] . "' WHERE empresa_id='" . $_SESSION["empresa_id"] . "'";
												$as = $conn->Execute($tt);
											} else {
												$GLOBALS['aPageErrors'][] = "El número de votantes a llegado al límite de votos";
												$bValidateSuccess = false;
											?><script>
										alert('El número de votantes ha llegado al límite de votos');
									</script><?								}
										}
									} else {
										//No existe en un cppt con registro habilitado y tampoco está en miembros');
										//---SI EL MIEMBRO NUCA SE HA REGISTRADO...
										if ($_POST['sexo'] == 'M') {
											$nsexo = 1;
										}
										if ($_POST['sexo'] == 'F') {
											$nsexo = 2;
										}

										$date_ = strtotime($_POST['fecha_nacimiento']);
										$fechanac = date('Y-m-d', $date_);

										if ($_POST['vocero_estatus'] == 1) {
											$estatus_vocero = 1;
											$estatus_cptt  = 1;
										} elseif ($_POST['vocero_estatus'] == 2) {
											$estatus_vocero = 2;
											$estatus_cptt  = 2;
										}

										$SQL = "INSERT INTO rncpt.miembros(
							ncedula,
							sprimer_nombre,
							ssegundo_nombre,
							sprimer_apellido,
							ssegundo_apellido,
							stelefono1,
							stelefono2,
							semail,
							usuario_idcreacion,
							dfecha_creacion,
							nsexo,
							fecha_nacimiento,
							sdireccion_habitacion
						     )
						   VALUES (" . $_POST['cedulaconsulta'] . ", 
							      '" . $_POST['primer_nombre'] . "',
							      '" . $_POST['segundo_nombre'] . "',
							      '" . $_POST['primer_apellido'] . "',
							      '" . $_POST['segundo_apellido'] . "',
							      '" . $ntelefono1 . "',
							      '" . $ntelefono2 . "',
							      '" . $_POST['email'] . "',
							      " . $_SESSION["id_usuario"] . ",
							      '" . date('Y-m-d H:i:s') . "',
							      '" . $nsexo . "',
							      '" . $fechanac . "',
							      '" . $_POST['txt_direccion_hab'] . "'
							      );";
										$success = $conn->Execute($SQL);
										$SQL = "SELECT id FROM rncpt.miembros WHERE ncedula = '" . $_POST['cedulaconsulta'] . "'";
										$select = $conn->Execute($SQL);
										if ($select->RecordCount() > 0) {
											$SQL = "INSERT INTO rncpt.miembros_empresa(
								 empresa_id, 
								 miembros_id, 
								 nenabled, 
								 usuario_idcreacion,
								 dfecha_creacion,
								 condicion_act_id,	
								 cargos_id,																comentarios,
								 nro_votos,
								 total_trabajadores,
								 dfecha_vencimiento,
								 dfecha_const_comite,
								 dfecha_nueva_eleccion,
								 condicion_laboral_id,
								 nestatus_vocero,
								 nestatus_cptt
							    )
							    VALUES ('" . $_SESSION["empresa_id"] . "',     												'" . $select->fields['id'] . "',														'1',																	'" . $_SESSION["id_usuario"] . "',
							'" . date('Y-m-d H:i:s') . "',
							'" . $_POST['condicion'] . "',
							'" . $_POST['cbo_cargos'] . "',														'" . $_POST['txt_comentarios'] . "',
							" . $_POST['nro_votos'] . ",
							" . $_POST['total_trabajadores'] . ",
							'" . $fechavencimiento . "',
							'" . $fechaconst . "',
							'" . $_POST['fechanueva_eleccion'] . "',
							'" . $_POST['condicion_laboral'] . "',
							'" . $estatus_vocero . "',
							'" . $estatus_cptt . "'
						);";
										}
										$val = "SELECT id, empresa_id, miembros_id, dfecha_const_comite, nenabled,   nro_votos, total_trabajadores
	FROM rncpt.miembros_empresa where empresa_id='" . $_SESSION["empresa_id"] . "'";
										$rw = pg_query($conn, $val);
										$persona = pg_fetch_all($rw);
										$tlt = 0;
										foreach ($persona as $a) {
											$nro_v = $a['nro_votos'];
											$total_trabajadores = $a['total_trabajadores'];
											$tlt = $total_trabajadores - $nro_v;
										}
										if ($tlt == 0) {
											$GLOBALS['aPageErrors'][] = "El número de votantes a llegado al límite de votos";
											$bValidateSuccess = false;
												?><script>
									alert('El número de votantes ha llegado al límite de votos');
								</script><?

										} else {
											if ($_POST['nro_votos'] != $tlt) {
												# code...
												$success = $conn->Execute($SQL);
												$GLOBALS['aPageErrors'][] = "El Vocero Fue Agregado Exitosamente";
												$tt = "UPDATE rncpt.miembros_empresa SET  total_trabajadores='" . $_POST['total_trabajadores'] . "' WHERE empresa_id='" . $_SESSION["empresa_id"] . "'";
												$as = $conn->Execute($tt);
											} else {
												$GLOBALS['aPageErrors'][] = "El número de votantes a llegado al límite de votos";
												$bValidateSuccess = false;
											?><script>
										alert('El número de votantes ha llegado al límite de votos');
									</script><?

											}
										}
									}
								} //if para saber si el vocero tenia registro activo en un CPTT
							} //if de la validación del formulario
							loadData($conn, false);
							break;
					}
				} else {
					LoadData($conn, false);
				}
			}
			//-------------------- Función LoadData --------------------//
			function LoadData($conn, $bPostBack)
			{
				//	echo "ID_EMPRESA=".$_SESSION["empresa_id"];

				if (count($GLOBALS['aDefaultForm']) == 0) {
					$aDefaultForm = &$GLOBALS['aDefaultForm'];

					if (!$bPostBack) {
						//------------------------------------------------------------------		
						$SQL = "SELECT miembros_empresa.id as id_miembro_empresa, 
						miembros_empresa.nenabled,
						miembros.id,
						miembros.ncedula,
						miembros.sprimer_nombre,
						miembros.ssegundo_nombre,
						miembros.sprimer_apellido,
						miembros.ssegundo_apellido,
						miembros.stelefono1,
						miembros.stelefono2,
						miembros.nsexo,
						miembros.semail,
						miembros.fecha_nacimiento,
						condicion_act.sdescripcion as condicion_act,
						cargos.descripcion_cargo	as cargos					
				FROM rncpt.miembros_empresa
				INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
				inner join rncpt.cargos on miembros_empresa.cargos_id=cargos.id
				inner join rncpt.condicion_act on miembros_empresa.condicion_act_id=condicion_act.id
				WHERE miembros_empresa.empresa_id = '" . $_SESSION["empresa_id"] . "' 
				AND miembros_empresa.nenabled = '1' and miembros_empresa.condicion_laboral_id=1;";
						//echo "<br>".$SQL;

						$rs = $conn->Execute($SQL);

						$_SESSION['EOF'] = $rs->RecordCount();
						if ($rs->RecordCount() > 0) {
							while (!$rs->EOF) {

								$aTabla[] = array();
								$c = count($aTabla) - 1;
								$apellidonombre = ucwords(strtolower($rs->fields['sprimer_apellido'] . " " . $rs->fields['ssegundo_apellido'] . " " . $rs->fields['sprimer_nombre'] . " " . $rs->fields['ssegundo_nombre']));
								$apellidonombre_ = ucwords(strtolower($rs->fields['sprimer_apellido'] . " " . $rs->fields['sprimer_nombre']));

								$aTabla[$c]['ncedula'] = $rs->fields['ncedula'];
								$aTabla[$c]['apellidonombre'] = $apellidonombre;
								$aTabla[$c]['apellidonombre_'] = $apellidonombre_;
								$aTabla[$c]['stelefono1'] = $rs->fields['stelefono1'];
								$aTabla[$c]['stelefono2'] = $rs->fields['stelefono2'];
								$aTabla[$c]['semail'] = $rs->fields['semail'];
								$sexo = $rs->fields['nsexo'];
								if ($sexo == '1') $aTabla[$c]['sexo'] = 'M';
								if ($sexo == '2') $aTabla[$c]['sexo'] = 'F';

								$aTabla[$c]['condicion_act'] = $rs->fields['condicion_act'];

								$aTabla[$c]['id'] = $rs->fields['id'];
								$aTabla[$c]['id_miembro_empresa'] = $rs->fields['id_miembro_empresa'];


								$aTabla[$c]['fecha_nacimiento'] = $rs->fields['fecha_nacimiento'];



								$aTabla[$c]['cargos'] = $rs->fields['cargos'];

								$rs->MoveNext();
							}
							$_SESSION['aTabla_nomina'] = $aTabla;
							$_SESSION['aDefaults']	= $_SESSION['aTabla_nomina'];
						} else {
							unset($_SESSION['aTabla_nomina']);
							unset($_SESSION['aDefaults']);
						}
						//------------------------------------------------------------------
					} else {
						$sql = "Select srif, 
					srazon_social,
					sdenominacion_comercial,
					sucursales
				 from rncpt.empresa where empresa.id = '" . $_SESSION["empresa_id"] . "' ";
						$rs = $conn->Execute($sql);
						if ($rs->Recordcount() > 0) {
							$_SESSION['aDefaults1']['razon_empresa'] = $rs->fields['srazon_social'];
							$_SESSION['aDefaults1']['sdenominacion_comercial'] = $rs->fields['sdenominacion_comercial'];
							$_SESSION['aDefaults1']['srif'] = $rs->fields['srif'];
							$_SESSION['aDefaults1']['sucursales'] = $rs->fields['sucursales'];
						}
						$aDefaultForm['fechaconst'] = '';
						$aDefaultForm['fechavencimiento'] = '';
						$aDefaultForm['total_trabajadores'] = '';
						$aDefaultForm['fechavencimiento_'] = '';
						$aDefaultForm['total_trabajadores_'] = '';


						//------------------------------------------------------------------
					}
				}
			}
			function Loadcondicion_act($conn)
			{
				$sHtml_Var = "sHtml_cb_condicion";
				if (!isset($GLOBALS[$sHtml_Var])) {
					$GLOBALS[$sHtml_Var] = '';
				}
				if ($GLOBALS[$sHtml_Var] == '') {
					$sSQL = "SELECT id, sdescripcion FROM rncpt.condicion_act where nenabled='1' order by sdescripcion ";
					echo $sSQL;
					$rs = &$conn->Execute($sSQL);
					while (!$rs->EOF) {
						$GLOBALS[$sHtml_Var] .= "<option value='" . $rs->fields['0'] . "'";
						if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['condicion']) {
							$GLOBALS[$sHtml_Var] .= " selected='selected'";
						}
						$GLOBALS[$sHtml_Var] .= ">" . $rs->fields['1'] . " </option>\n";
						$rs->MoveNext();
					}
				}
			}
			function Loadcondicion_laboral($conn)
			{
				$sHtml_Var = "sHtml_cb_condicion_laboral";
				if (!isset($GLOBALS[$sHtml_Var])) {
					$GLOBALS[$sHtml_Var] = '';
				}
				if ($GLOBALS[$sHtml_Var] == '') {
					$sSQL = "SELECT id, sdescripcion FROM rncpt.condicion_laboral where nenabled='1' order by sdescripcion ";
					echo $sSQL;
					$rs = &$conn->Execute($sSQL);
					while (!$rs->EOF) {
						$GLOBALS[$sHtml_Var] .= "<option value='" . $rs->fields['0'] . "'";
						if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['condicion_laboral']) {
							$GLOBALS[$sHtml_Var] .= " selected='selected'";
						}
						$GLOBALS[$sHtml_Var] .= ">" . $rs->fields['1'] . " </option>\n";
						$rs->MoveNext();
					}
				}
			}
			function LoadCargos($conn)
			{
				$sHtml_Var = "sHtml_cb_Cargos";
				if (!isset($GLOBALS[$sHtml_Var])) {
					$GLOBALS[$sHtml_Var] = '';
				}
				if ($GLOBALS[$sHtml_Var] == '') {
					$sSQL = "SELECT id, descripcion_cargo FROM rncpt.cargos where nenabled='1' order by descripcion_cargo ";
					echo $sSQL;
					$rs = &$conn->Execute($sSQL);
					while (!$rs->EOF) {
						$GLOBALS[$sHtml_Var] .= "<option value='" . $rs->fields['0'] . "'";
						if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_cargos']) {
							$GLOBALS[$sHtml_Var] .= " selected='selected'";
						}
						$GLOBALS[$sHtml_Var] .= ">" . $rs->fields['1'] . " </option>\n";
						$rs->MoveNext();
					}
				}
			}
			$host = "10.46.1.93";
			$dbname = "minpptrassi";
			$user = "postgres";
			$pass = "postgres";

			try {
				$con = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
			} catch (PDOException $error) {
				$cnn = $error;
				echo ("Error al conectar en la Base de Datos " . $error);
			}
			session_start(); // Ensure the session is started

			$va = "SELECT id, empresa_id, miembros_id, dfecha_const_comite, nenabled, nro_votos, total_trabajadores FROM rncpt.miembros_empresa WHERE empresa_id='" . $_SESSION["empresa_id"] . "' AND nenabled='1' ";
			$r = pg_query($con, $va);

			if (!$r) {
				die("Query failed: " . pg_last_error($con));
			}

			$person = pg_fetch_all($r);
			$mm = 0; // Initialize $mm
			$total_trabajadore = 0; // Ensure this is also initialized

			if ($person) {
				foreach ($person as $ap) {
					$nro_ = $ap['nro_votos'];
					$total_trabajadore = $ap['total_trabajadores'];
					$mm += $nro_; // Summing up the votes
				}

				// Storing results in session variables
				$_SESSION['nm_votos'] = $mm;
				$_SESSION['tt_trabajadores'] = $total_trabajadore;

				// Debugging info

			} else {
				echo "No data found.";
			}


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
							background: url('../imagenes/page-loader.gif') 50% 50% no-repeat rgb(255, 255, 255);
							opacity: 0.6;
							filter: alpha(opacity=60);
						}
					</style>

					<form method="post" id="formularioCPT" name="formularioCPT" action="<?= $_SERVER['PHP_SELF'] ?>">
						<!--Datos Ocultos Información para sumit-->
						<input name="action" type="hidden" value="" />
						<input name="hoy" id="hoy" type="hidden" value="" />
						<input name="id" id="id" type="hidden" value="" /><!--id vocero-->
						<input name="id_miembro_empresa" id="id_miembro_empresa" type="hidden" value="" />
						<!--Datos Ocultos Información para Guardar Trabajador-->
						<input name="cedulaidentida" id="cedulaidentida" type="hidden" value="" />
						<input name="primer_nombre" id="primer_nombre" type="hidden" value="" />
						<input name="segundo_nombre" id="segundo_nombre" type="hidden" value="" />
						<input name="primer_apellido" id="primer_apellido" type="hidden" value="" />
						<input name="segundo_apellido" id="segundo_apellido" type="hidden" value="" />
						<input name="sexo" id="sexo" type="hidden" value="" />

						<input name="fecha_nacimiento" id="fecha_nacimiento" type="hidden" value="" />
						<input name="fechavencimiento_" id="fechavencimiento_" type="hidden" value="" />


						<script>
							function send(saction) {
								//if (confirm("\u00BFDESEA CONTINUAR?") == true) {
								$("#loader").show();
								var form = document.formularioCPT;
								form.action.value = saction;
								form.submit();
								//}	
							}
						</script>

						<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
							<tr>
								<th colspan="4" class="sub_titulo">
									<div align="left">RNCPTT --&gt; Actualizar Entidades de Trabajo</div>
								</th>
							</tr>

							<tr>
								<th colspan="4" class="titulo" align="center"></th>
							</tr>

							<tr>
								<td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
							</tr>

							<tr>
								<th colspan="4" class="titulo" align="center"></th>
							</tr>

							<tr class="identificacion_seccion">
								<th style="border-radius: 30px; border-color:#999999; width:85%" colspan="4" class="sub_titulo" id="seccBasicos" align="left">DATOS DE CONSTITUCI&Oacute;N DEL CPTT</th>
							</tr>

							<tr>
								<td colspan="4"> </td>
							</tr>

							<tr>
								<th style="color:#666" width="21%" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha de Constituci&oacute;n</th>
								<th style="color:#666" width="25%" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha de Nueva Elección</th>
								<th style="color:#666" width="26%" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha de Vencimiento</th>
								<th style="color:#666" width="28%" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estatus del CPTT</th>
							</tr>

							<tr>
								<td colspan="4"> </td>
							</tr>

							<tr>
								<td align="center">
									<input style="border-radius: 30px; border-color:#999999; width:55%" name="fechaconst" id="fechaconst" type="text" size="12" width="22%" title="Fecha de Constitución del CPTT - Indique en el calendario la Fecha de Constitución del CPTT." value="<?= $aDefaultForm['fechaconst'] ?>" readonly />
									<a id="f_btn1"><img src="../imagenes/calendar_16.png" alt="" width="16" height="16" align="top" /></a>
									<script type="text/javascript">
										Calendar.setup({
											inputField: "fechaconst",
											trigger: "f_btn1",
											onSelect: function() {
												vecimiento();
												this.hide()
											},
											showTime: false,

											dateFormat: "%Y-%m-%d",
											disabled: function(date) {
												var today = new Date();
												return (
													date.getDate() == 0 || (date.getTime() > today.getTime() + (24 * 60 * 60 * 1000) - new Date().getHours() * 60 * 60 * 1000)
												) ? true : false;
											}

										});
									</script>
									<span>*</span>
								</td>
								<!--td  align="center"><input name="fechanueva_eleccion" id="fechanueva_eleccion" type="text"title="Fecha de Nueva Elecciòn del CPTT - Indique en el calendario la Fecha de la Nueva Elecciòn del CPTT." size="12" width="22%" value="<?= $aDefaultForm['fechanueva_eleccion'] ?>"  readonly /-->
								<td align="center"><input style="border-radius: 30px; border-color:#999999; width:55%" name="fechanueva_eleccion" id="fechanueva_eleccion" type="text" size="12" width="22%" value="<?= $aDefaultForm['fechanueva_eleccion'] ?>" />
									<a id="f_btn2"><img src="../imagenes/calendar_16.png" alt="" width="16" height="16" align="top" /></a>
									<script type="text/javascript">
										Calendar.setup({
											inputField: "fechanueva_eleccion",
											trigger: "f_btn2",
											onSelect: function() {
												vencimientoPorFechaNuevaEleccion();
												this.hide()
											},
											showTime: false,
											//   dateFormat : "%Y-%m-%d"
										});
									</script>
								</td>
								<td align="center">

									<div align="center"><input style="border-radius: 30px; border-color:#999999; width:55%" name="fechavencimiento" id="fechavencimiento" type="text" size="15" disabled="disabled" title="Fecha de Vencimiento - El vencimiento del CPTT es dos (2) años " value="<?= $aDefaultForm['fechavencimiento']; ?>" />
										<span> *</span>
									</div>
								</td>
								<td rowspan="1" align="center" id="td_estatusvocero">
									Vigente:
									<input type="radio" name="vocero_estatus" id="vocero_estatus1" title="Estatus del Vocero" value="1" />
									Vencido:
									<input type="radio" name="vocero_estatus" id="vocero_estatus2" title="Estatus del Vocero" value="2" />
									Inoperativo:
									<input type="radio" name="vocero_estatus" id="vocero_estatus3" title="Estatus del Vocero" value="3" />
									<span>*</span>
								</td>
							</tr>

							<tr>
								<td colspan="4"> </td>
							</tr>

							<tr>
								<th style="color:#666" colspan="4" align="left">Comentario u Observaci&oacute;n</th>
								<!--th class="sub_titulo" align="center">Fecha de la Nueva Elección</th-->
							</tr>

							<tr>
								<td colspan="4"> </td>
							</tr>

							<tr>
								<td colspan="4" align="left">
									<textarea style="border-radius: 30px; border-color:#999999; width:95%" name="txt_comentarios" id="txt_comentarios" cols="100" size="120%" title="Comentario u  Observaci&oacute;n - Agregue un comentario u observaci&oacute;n de ser necesario para este registro." rows="1"><?= $aDefaultForm['txt_comentarios']; ?></textarea>
								</td>
								<!--td  align="center"><input name="fechanueva_eleccion" id="fechanueva_eleccion" type="text"title="Fecha de Nueva Elecciòn del CPTT - Indique en el calendario la Fecha de la Nueva Elecciòn del CPTT." value="<?= $aDefaultForm['fechanueva_eleccion'] ?>"  readonly />
                <a  id="f_btn2"><img src="../imagenes/calendar_16.png" alt="" width="16" height="16" align="top"/></a>
        <script type="text/javascript">
        Calendar.setup({
        inputField : "fechanueva_eleccion",
        trigger    : "f_btn2",
        onSelect   : function() { this.hide() },
        showTime   : false,
      //   dateFormat : "%Y-%m-%d"
        });
        </script>
            </td-->
							<tr>
								<td colspan="4"> </td>
							</tr>

							<tr class="identificacion_seccion">
								<th style="border-radius: 30px; border-color:#999999; width:85%" colspan="4" class="sub_titulo" id="seccBasicos" align="left">DATOS DE VOCEROS DEL CPTT</th>
							</tr>

							<tr>
								<td colspan="4"> </td>
							</tr>


							<tr>
								<th style="color:#666" align="left">C&eacute;dula de Identidad</th>
								<th style="color:#666" align="left">Apellidos y Nombres</th>
								<th style="color:#666" align="left">Fecha de Nacimiento</th>
								<th style="color:#666" align="left">Edad</th>
							</tr>

							<tr>
								<td colspan="4"> </td>
							</tr>


							<tr>
								<td>
									<select style="border-radius: 30px; border-color:#999999; width:20%" name="nacionalidad" id="nacionalidad">
										<option value="1">V</option>
										<option value="2">E</option>
									</select>
									<input style="border-radius: 30px; border-color:#999999; width:55%" name="cedulaconsulta" id="cedulaconsulta" type="text" maxlength="8" onkeypress="return isNumberKey(event);" onblur="identificaciudadano()" value="<? $aDefaultForm['cedulaconsulta'] ?>">
									<span> * </span>
									</label>
								</td>

								<td>
									<div align="left"><input style="border-radius: 30px; border-color:#999999; width:85%" name="apellidonombre" type="text" id="apellidonombre" value="<? $aDefaultForm['apellidonombre'] ?>" size="35" disabled="disabled"></div>
								</td>

								<td align="left">
									<div align="left">
										<input style="border-radius: 30px; border-color:#999999; width:75%" name="fechanac" id="fechanac" type="text" size="30" value="" disabled="disabled" />
									</div>
								</td>

								<td>
									<div align="left">
										<input style="border-radius: 30px; border-color:#999999; width:85%" name="edad" type="text" id="edad" value="" size="30" disabled="disabled" />
									</div>
								</td>
								<td width="0%"> </td>
							</tr>

							<tr>
								<td colspan="4"> </td>
							</tr>

							<tr>
								<th style="color:#666" align="center">Sexo</th>
								<th style="color:#666" align="center">Tel&eacute;fono Personal</th>
								<th style="color:#666" align="center">Tel&eacute;fono de Habitación</th>
								<th style="color:#666" align="center">Correo Electr&oacute;nico Personal</th>
							</tr>

							<tr>
								<td colspan="4"> </td>
							</tr>

							<tr>
								<td style="" align="center">
									<select style="border-radius: 30px; border-color:#999999; width:85%" id="cbo_sexo" name="cbo_sexo" disabled>
										<option value="">Seleccionar</option>
										<option value="M">Masculino </option>
										<option value="F">Femenino </option>
									</select>
									<span>*</span>
								</td>
								<!--td><div align="left"> <input style="border-radius: 30px; border-color:#999999; width:80%" name="sexo2"  type="text" id="sexo2"  size="30" maxlength="8" disabled="disabled"/> </div> </td-->
								<td align="left"><input style="border-radius: 30px; border-color:#999999; width:25%" name="codigo1" type="text" id="codigo1" onkeypress="return isNumberKey(event);" onblur="" size="6" maxlength="4" autocomplete="off" placeholder="Ej. 0000" />
									<label> - </label>
									<input style="border-radius: 30px; border-color:#999999; width:55%" name="telefono1" type="text" id="telefono1" onblur="" onkeypress="return isNumberKey(event);" size="10" maxlength="7" autocomplete="off" placeholder="Ej. 1234567" />
									</label>
								</td>

								<td align="left">
									<input style="border-radius: 30px; border-color:#999999; width:25%" name="codigo2" type="text" id="codigo2" onkeypress="return isNumberKey(event);" onblur="" size="6" maxlength="4" autocomplete="off" placeholder="Ej. 0000" />
									<label> - </label>
									<input style="border-radius: 30px; border-color:#999999; width:45%" name="telefono2" type="text" id="telefono2" onblur="" onkeypress="return isNumberKey(event);" size="10" maxlength="7" autocomplete="off" placeholder="Ej. 1234567" />
									</label>
								</td>

								<td align="left"><input style="border-radius: 30px; border-color:#999999; width:85%" name="email" type="text" id="email" onBlur="validarEmail()" size="20" autocomplete="off" value="" placeholder="Ej. juancito@gmail.com" />
									<span class="requerido"> * </span>
								</td>
							</tr>

							<tr>
								<td colspan="4"> </td>
							</tr>

							<tr>
								<th style="color:#666" colspan="3" align="left">Direcci&oacute;n de Habitaci&oacute;n</th>
								<th style="color:#666" align="left">Condici&oacute;n Actual</th>
							</tr>

							<tr>
								<td colspan="4"> </td>
							</tr>

							<tr>
								<td colspan="3" align="left">
									<textarea style="border-radius: 30px; border-color:#999999; width:95%" name="txt_direccion_hab" id="txt_direccion_hab" cols="100" size="100" rows="1"><?= $aDefaultForm['txt_direccion_hab']; ?></textarea>
								</td>

								<td align="left">
									<select style="border-radius: 30px; border-color:#999999; width:85%" name="condicion" id="condicion">
										<option value="">Seleccione</option>
										<? Loadcondicion_act($conn);
										print $GLOBALS['sHtml_cb_condicion']; ?>
									</select>
									<span>*</span>
								</td>
							</tr>

							<tr>
								<td colspan="4"> </td>
							</tr>

							<tr>
								<th style="color:#666" align="left" colspan="3">Cargo</th>
								<th style="color:#666" align="left">Condici&oacute;n Laboral</th>
							</tr>

							<tr>
								<td colspan="4"> </td>
							</tr>

							<tr>

								<td align="left" id="td_condicion_laboral" colspan="3"><select style="border-radius: 30px; border-color:#999999; width:85%" id="cbo_cargos" name="cbo_cargos">
										<option value="">Seleccione</option>
										<? LoadCargos($conn);
										print $GLOBALS['sHtml_cb_Cargos']; ?>
									</select>
									<span>*</span>
								</td>
								<td align="left">
									<select style="border-radius: 30px; border-color:#999999; width:85%" name="condicion_laboral" id="condicion_laboral">
										<option value="">Seleccione</option>
										<? Loadcondicion_laboral($conn);
										print $GLOBALS['sHtml_cb_condicion_laboral']; ?>
									</select>
									<span>*</span>
								</td>
							</tr>

							<tr>
								<td colspan="4"> </td>
							</tr>
							<br>
							<tr>
								<!-- <th width="24%" align="center" class="sub_titulo">N&deg; de Boleta o Nomenclatura</th>		
            <th width="22%" align="center"  class="sub_titulo">Estatus o Car&aacute;cter</th>-->
								<th style="color:#666" width="21%" align="center">N&deg; de Votos el cuál fue electo</th>
								<th style="color:#666" width="25%" align="center"><input style="border-radius: 30px; border-color:#999999; width:85%" name="nro_votos" id="nro_votos" type="text" maxlength="8" onkeypress="return isNumberKey(event);" value=""><span>*</span> </th>
								<th style="color:#666" width="26%" align="lfet">Total de Trabajadores de la Entidad de Trabajo</th>
								<th style="color:#666" width="28%" align="left"><input style="border-radius: 30px; border-color:#999999; width:85%" name="total_trabajadores" id="total_trabajadores" type="text" maxlength="8" onkeypress="return isNumberKey(event);" value="<? print $aDefaultForm['total_trabajadores'] ?>"><span>*</span></th>
							</tr>
							<td align="center"></td>

							<td align="center"> </td>
							<td width="26%" align="center"> </td>
			</tr>

			<tr>
				<td colspan="4">



					<input type="text" style="display: none;" id="nm_voto" value="<?php echo $_SESSION['nm_votos']; ?>">
					<input type="text" style="display: none;" id="voto_p">

					<input type="text" style="display: none;" id="nm_total" value="<?php echo $_SESSION['tt_trabajadores']; ?>">


				</td>
			</tr>

			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="4" align="center">
					<button type="button" name="guardar" id="guardar" class="button_personal btn_agregar" onclick="javascript:guardarT('Guardar');" title="Guardar - Haga Clic para Continuar" /> Agregar
					</button>
					<button type="button" name="editar" id="editar" class="button_personal btn_editar" onclick="javascript:modificarT('Modificar');" title="Editar - Haga Clic para Continuar" /> Editar
					</button>
				</td>
			</tr>
	</table>

	<table border="0" align="center" class="listado formulario" id="tblDetalle" style="width:95%; ">

		<thead>
			<tr>
				<th style="border-radius: 30px; border-color:#999999; width:95%" colspan="5" align="left">VOCEROS DEL CPTT</th>

			</tr>

			<tr>
				<td colspan="4"> </td>
			</tr>
			<tr>
				<!--				 <th width="10%" align="left" class="sub_titulo"  ><div align="center">TIPO</div></th>-->
				<th width="10%" align="left" class="sub_titulo">
					<div align="center">Cédula de Identidad</div>
				</th>
				<th width="25%" align="left" class="sub_titulo">
					<div align="center">Apellidos y Nombres</div>
				</th>
				<!--			 <th width="5%" align="left" class="sub_titulo" ><div align="center">SEXO/GENERO</div></th>-->
				<th width="10%" align="left" class="sub_titulo">
					<div align="center">Teléfono Personal</div>
				</th>
				<!--				 <th width="10%" align="left" class="sub_titulo"><div align="center">TELEF. 2.</div></th>-->
				<th width="20%" align="left" class="sub_titulo">
					<div align="center">Correo Electrónico Personal</div>
				</th>
				<th width="5%" align="left" class="sub_titulo">Eliminar</th>
			</tr>
		<tbody>
			<?
			$aTabla = $_SESSION['aTabla_nomina'];
			$aDefaultForm = $GLOBALS['aDefaultForm'];
			for ($c = 0; $c < count($aTabla); $c++) {
				if (($c % 2) == 0) $class_name = "dataListColumn";
				else $class_name = "dataListColumn";
			?>
				<tr class="<?= $class_name ?>">
					<td align="center"><?= $aTabla[$c]['ncedula'] ?></td>
					<td class="texto-normal" align="center"><?= $aTabla[$c]['apellidonombre'] ?></td>
					<td class="texto-normal" align="center"><?= $aTabla[$c]['stelefono1'] ?></td>
					<td class="texto-normal" align="center"><?= $aTabla[$c]['semail'] ?></td>
					<td class="texto-normal" align="center"><a id="editar_trabajador" align="center" onclick="javascript:editarT('Editar','<? echo $aTabla[$c]['id']; ?>','<? echo $aTabla[$c]['id_miembro_empresa']; ?>');"><img src="../imagenes/pencil_16.png" width="16" height="16" title="Editar Vocero - Haga clic para editar los datos del vocero" /></a>

						<a id="elimina_trabajador" align="center" onclick="javascript:eliminarT('Eliminar','<? echo $aTabla[$c]['id_miembro_empresa']; ?>');"><img src="../imagenes/delete_16.png" width="12" height="12" title="Eliminar Vocero - Haga clic para eliminar al Vocero" /></a>
					</td>
				</tr>
			<?
			}
			?>
		</tbody>
		</thead>
	</table>


	<table width="95%" border="0">
		<tr>
			<td colspan="4" align="center">
				<button type="button" name="cmd_guardar" id="cmd_guardar" class="button_personal btn_aceptar" onclick="javascript:send('Redireccionar');" title="Guardar - Haga Click para Continuar">Imprimir Boleta</button>
				<!--      <button type="button" name="regresar"  id="regresar" class="button_personal btn_regresar" onclick="javascript:send('Regresar');"title="Regresar - Haga Click para Ir a la pantalla anterior">Regresar</button>-->
			</td>

		</tr>

		<tr>
			<td width="20" colspan="4">&nbsp;</td>
		</tr>
	</table>

	<div id="loader" class="loaders" style="display: none;"></div>
	</form>
	<script language="JavaScript" type="text/javascript" src="funcion_registro_personal_act.js"></script>
	<script language="JavaScript" type="text/javascript" src="funcion_identifica_ciudadano.js"></script>
	</td>
	</tr>
	</tbody>
	</table>
	<?php

	include('../../footer.php'); ?>