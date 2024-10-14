<?php
include_once('../mod_menu/tblpersonalesModelo.php');
include_once('../mod_menu/tblsesionModelo.php');
include_once('../mod_menu/tblusuariorolModelo.php');
include_once('../mod_menu/tblrolopcionModelo.php');
include_once('../mod_menu/tblopcionModelo.php');
include_once('../mod_menu/tblmoduloModelo.php');

session_start();
$conecto = 1;

$aPageErrors = array();
if (isset($_POST['action'])){
	switch($_POST["action"]){
		case'btentrar':
		if($conecto == 1){
			//$bValidateSuccess=true;
			if($_POST['txt_clave'] == '' or $_POST['txt_usuario'] == '' or $_POST['nnacionalidad'] == '0'){
				$GLOBALS['aPageErrors'][]= "- Ningun campo debe quedar vacio!";
				$bValidateSuccess=false;
			}else{
					$usuario = new tblusuario;
					$usuario->setCedula($_POST['txt_usuario']);
					$usuario->setSnacionalidad($_POST['nnacionalidad']);
					$data = $usuario->validarusuarioexiste();
					if($data){
						if($data[0]['nenabled'] == 1){
							//echo "USUARIO ACTIVO</br>";
							//echo PERSONALES;
							//?????????????????????????????????????????????????
							$sesion = new tblsesion;
							$sesion->setUsuario_id($data[0]['cedula']);
							//echo "USUARIO ACTIVO</br>".$calve;
							$sesion->setClave(md5($_POST['txt_clave']));
							$datasesion = $sesion->validarsesionexiste();
							if($datasesion){
								//echo "SESION ACTIVA</br>";
								//var_dump($datasesion);
								$usuariorol = new tblusuariorol;
								$usuariorol->setUsuario_id($data[0]['cedula']);
								$datausuariorol = $usuariorol->selectidtblusuariorol();//OOOOOOOOOOOJJJJJJJJJJJJJJJJOOOOOOOOOOOOOO
								for($a = 0; $a < count($datausuariorol); $a++){
									if(@$id_rol == ""){
									$id_rol = $datausuariorol[$a]['rol_id'];
									}else{
									$id_rol = $id_rol.",".$datausuariorol[$a]['rol_id'];// $_SESSION['id_opcion'] activos para dicho usuario
									}
								}// ******* FIN ROL
								if($id_rol){
									//echo "ID ROL: ".$id_rol."</br>";
									$rolopcion = new tblrolopcion;
									$rolopcion->setRol_id($id_rol);
									$datarolopcion = $rolopcion->validarrolopcionexiste();
									if($datarolopcion){
										for($e = 0; $e < count($datarolopcion); $e++){
											if(@$id_opcion == ""){
												$id_opcion = $datarolopcion[$e]['opcion_id'];
											}else{
												$id_opcion =$id_opcion.",".$datarolopcion[$e]['opcion_id'];
											}
										}
										if($id_opcion){
											//echo "ID OPCIONES: ".$id_opcion."</br>";
											$modulos = new tblopcion;
											$modulos->setId($id_opcion);
											$dataidmodulos = $modulos->selectidmodulos();//Seleccionamos el ID de los modulos
											if($dataidmodulos){
												for($i = 0; $i < count($dataidmodulos); $i++){
													if(@$idmodulos == ""){
														$idmodulos = $dataidmodulos[$i]['modulos'];
													}else{
														$idmodulos = $idmodulos.",".$dataidmodulos[$i]['modulos'];
													}
												}
												if($idmodulos){
													//echo "ID MODULOS".$idmodulos;
													$modulos->setId($idmodulos);
													$dataurlmodulos = $modulos->selecturlmodulos();//Seleccionamos los url de los modulos
													$logos = new tblmodelo;
													$logos->setOpcion_id($idmodulos);
													$datalogos = $logos->selectidtblmodulo();
													if($dataurlmodulos && $datalogos){
														//var_dump($datalogos);//URL
														$_SESSION['logos'] = $datalogos;
														$_SESSION['modulos'] = $dataurlmodulos;
														$_SESSION['total_opciones'] = $id_opcion;
														//echo "</br>";
														//echo "TOTAL DE OPCIONES".$_SESSION['total_opciones'];
														//echo "</br>";
														//var_dump($_SESSION['modulos'])."</br>";
														$_SESSION['id_usuario'] = $data[0]['cedula'];
														//$_SESSION['nusuario'] = $data[0]['cedula'];
														$_SESSION['nombre1']=$data[0]['primer_nombre'];
														$_SESSION['nombre2']=$data[0]['segundo_nombre'];
														$_SESSION['apellido1'] = $data[0]['primer_apellido'];
														$_SESSION['apellido2'] = $data[0]['segundo_apellido'];
														$_SESSION['nacionalidad'] = $data[0]['nacionalidad'];
														//$_SESSION['rol'] = $data[0]['rol_id'];
														$_SESSION['datasesion'] = $datasesion;
														//VISTA.PHP
														print "<script>document.location='../vista.php'</script>";
														echo "estatus".$datasesion [0]['nestatus'];
													}else{
														$GLOBALS['aPageErrors'][]= "- Comuniquese con el administrador del sistema 1!.";
														$bValidateSuccess=false;
													}
												}else{
													$GLOBALS['aPageErrors'][]= "- Comuniquese con el administrador del sistema 2 !.";
													$bValidateSuccess=false;
												}
											}else{
												$GLOBALS['aPageErrors'][]= "- Comuniquese con el administrador del sistema 3 !.";
												$bValidateSuccess=false;
											}
										}else{
											$GLOBALS['aPageErrors'][]= "- Comuniquese con el administrador del sistema 4 !.";
											$bValidateSuccess=false;
										}
									}else{
									$GLOBALS['aPageErrors'][]= "- Comuniquese con el administrador del sistema 5 !.";
									$bValidateSuccess=false;
									}
								}else{
								$GLOBALS['aPageErrors'][]= "- Comuniquese con el administrador del sistema 6 !.";
								$bValidateSuccess=false;
								}
							}else{
								$GLOBALS['aPageErrors'][]= "- Verificar Usuario y Contraseña1.";
								$bValidateSuccess=false;
							}
						}else{
							$GLOBALS['aPageErrors'][]= "- Comuniquese con el administrador del sistema 7 !.";
							$bValidateSuccess=false;
						}
						
						// ************* FIN SOLO PARA LOS FUNCIONARIOS ACTIVOS
					}else{
						//echo "El usuario no existe1";
						$GLOBALS['aPageErrors'][]= "- Verificar Usuario y Contraseña2.";
						$bValidateSuccess=false;
					}
			
			}
		}else{
			$GLOBALS['aPageErrors'][]= "- Problemas de conexion a la base de datos. Comuniquese con el administrador del sistema.";
			$bValidateSuccess=false;
		}
		break;
		
		case '2':
			$bValidateSuccess=true;
			//LoadData($conn,true);
		break;
	}
}


// Imprimir el arreglo de errores
print (isset($aPageErrors) && count($aPageErrors)> 0)?"<script>alert('".join('\n', $aPageErrors)."')</script>":"";
?>
