<?php
ini_set("display_errors", 1);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include_once('1_Validador.php');
//include('Trazas.class.php');//Verificar que realiza
$conn = getConnDB($db1);
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = false;
doAction($conn);
debug($settings['debug'] = false);
showHeader();
showForm($conn, $aDefaultForm);
showFooter();
//------------------------------------------------------------------------------------------------------------------------------
function debug()
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION);
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn)
{
	if (isset($_POST['action'])) {
		switch ($_POST['action']) {
				/*
			   case 'cbPais_nac_afiliado_changed':
					LoadData($conn,true);
				break;
				
				case 'cbEstado_nac_afiliado_changed':
					LoadData($conn,true);
				break;  
				
				case 'cbPais_afiliado_changed':
					LoadData($conn,true);
				break;
				
				case 'cbEstado_afiliado_changed':
					LoadData($conn,true);
				break;  
	 
				*/
			case 'Cancelar':
				LoadData($conn, false);
				break;

			case 'Continuar':
				//var_dump($_POST);
				//die();
				$bValidateSuccess = true;
				/*
						
						if ($_POST['nombre_afiliado']==""){
								$GLOBALS['aPageErrors'][]= "- El Nombre: es requerido.";
								$bValidateSuccess=false;
								}
						else {
								if(!ereg("([a-z, A-Z])", trim($_POST['nombre_afiliado']))){
								$GLOBALS['aPageErrors'][]= "- El Nombre: es incorrecto.";
								$bValidateSuccess=false;
								}
							} 
						if ($_POST['apellido_afiliado']==""){
								$GLOBALS['aPageErrors'][]= "- El Apellido: es requerido.";
								$bValidateSuccess=false;
								}
						else {
								if(!ereg("([a-z, A-Z])", trim($_POST['apellido_afiliado']))){
								$GLOBALS['aPageErrors'][]= "- El Apellido: es incorrecto.";
								$bValidateSuccess=false;
								}
							}
						if ($_POST['cbSexo_afiliado']=="-1"){
								$GLOBALS['aPageErrors'][]= "- El Sexo: es requerido.";
								$bValidateSuccess=false;
								}
										if ($_POST['fnacimiento_afiliado']==""){
								$GLOBALS['aPageErrors'][]= "- La Fecha de naciemiento: es requerida.";
								$bValidateSuccess=false;
								}
						if  ($_POST['fnacimiento_afiliado']!=''){		
										list($a,$m,$d)=explode("-", $_POST['fnacimiento_afiliado']);
									$_POST['fnacimiento_afiliado']= $a.'-'.str_pad($m,2,'0',STR_PAD_LEFT ).'-'.$d;
										
										if ($_POST['fnacimiento_afiliado']>="2002-01-01"){
										$GLOBALS['aPageErrors'][]= "- La edad: es incorrecta.";
										$bValidateSuccess=false;
										}
							} 
						if ($_POST['cbNacionalidad_afiliado']=="-1"){
								$GLOBALS['aPageErrors'][]= "- La Nacionalidad: es requerido.";
								$bValidateSuccess=false;
								}
						if ($_POST['cbEstado_Civil_afiliado']=="-1"){
								$GLOBALS['aPageErrors'][]= "- Estado Civil: es requerido.";
								$bValidateSuccess=false;
								}
						if ($_POST['cbPais_nac_afiliado']=="-1"){
								$GLOBALS['aPageErrors'][]= "- El País de nacimiento: es requerido.";
								$bValidateSuccess=false;
								}
						if ($_SESSION['tipo_persona']!='P')
						{
							if ($_POST['cbPais_afiliado']=="-1"){
								$GLOBALS['aPageErrors'][]= "- El País de residencia: es requerido.";
								$bValidateSuccess=false;
								}
							if ($_POST['cbEstado_afiliado']=="-1"){
								$GLOBALS['aPageErrors'][]= "- El Estado de residencia: es requerido.";
								$bValidateSuccess=false;
								}
							if ($_POST['cbMunicipio_afiliado']==""){
								$GLOBALS['aPageErrors'][]= "- El Municipio de residencia: es requerido.";
								$bValidateSuccess=false;
								}
							if ($_POST['cbParroquia_afiliado']==""){
								$GLOBALS['aPageErrors'][]= "- La Parroquia de residencia: es requerida.";
								$bValidateSuccess=false;
								}
							if ($_POST['sector_afiliado']==""){
								$GLOBALS['aPageErrors'][]= "- El Sector: es requerido.";
								$bValidateSuccess=false;
								}
							if ($_POST['direccion_afiliado']==""){
								$GLOBALS['aPageErrors'][]= "- La Dirección: es requerida.";
								$bValidateSuccess=false;
								}
							}										
							if ($_POST['telefono_afiliado']==""){
								$GLOBALS['aPageErrors'][]= "- El Teléfono: es requerido.";
								$bValidateSuccess=false;
								}	   
							if ($_POST['email_afiliado']==""){
									$GLOBALS['aPageErrors'][]= "- El Correo Electrónico: es requerido.";
									$bValidateSuccess=false;
									}
							else {
									if(!mb_ereg("^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$",$_POST['email_afiliado'])){
									$GLOBALS['aPageErrors'][]= "- El formato de Correo electrónico : es incorrecto.";
									$bValidateSuccess=false;
									}
								}
							if ($_POST['cbDiscapacidad_afiliado']=="-1"){
									$GLOBALS['aPageErrors'][]= "- Posee discapacidad: es requerido.";
									$bValidateSuccess=false;
									}*/
				if ($_POST['cbJefe_familia'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- Es Jefe de Hogar: es requerido.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbHijos'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- Tiene hijos: es requerido.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbHijos'] == "1") {
					if ($_POST['hijos_menores'] == "" and $_POST['hijos_mayores'] == "") {

						$GLOBALS['aPageErrors'][] = "- Cantidad de hijos: es requerido.";
						$bValidateSuccess = false;
					}
					if ($_POST['hijos_menores'] == "0" and $_POST['hijos_mayores'] == "0") {

						$GLOBALS['aPageErrors'][] = "- Cantidad de hijos: es requerido.";
						$bValidateSuccess = false;
					}
					///ESTO VA AL MOMENTO DE GUARDAR 
					if ($_POST['hijos_menores'] == "") {
						$_POST['hijos_menores'] = 0;
					}
					if ($_POST['hijos_mayores'] == "") {
						$_POST['hijos_mayores'] = 0;
					}
					//OJOJOJOJOJOJOJOJOJOJOJJO
				}
				if ($_POST['cbpais_nac_afiliado1'] == "-1") {

					$GLOBALS['aPageErrors'][] = "- El pais de nacimiento es requerido.";
					$bValidateSuccess = false;
				}
				if ($_POST['carnet_patria'] == "0") {

					$GLOBALS['aPageErrors'][] = "- Posee Carnet de la patria: es requerido.";
					$bValidateSuccess = false;
				} else if ($_POST['carnet_patria'] == "1") {

					if ($_POST['codigo'] == "" and $_POST['serial'] == "") {

						$GLOBALS['aPageErrors'][] = "- Código y Serial: es requerido.";
						$bValidateSuccess = false;
					}
				}


				/*if ($_POST['ingreso_familiar']==""){
									$GLOBALS['aPageErrors'][]= "- Ingreso Familiar Mensual: es requerido."; 
									$bValidateSuccess=false;
									}*/
				/*if ($_POST['cbVehiculo_afiliado']=="-1"){
									$GLOBALS['aPageErrors'][]= "- Posee Vehiculo: es requerido."; 
									$bValidateSuccess=false;
									}	*/

				/*if ($_POST['cbmision_beneficio_educacion']=="-1"){

									$GLOBALS['aPageErrors'][]= "- Ha sido beneficiario de las misiones de educacion?: es requerido.";
									$bValidateSuccess=false;

									}	 
							if ($_POST['cbmision_beneficio_educacion']=="1"){
								if ($_POST['cbMisiones_Educacion']=="-1"){
									$GLOBALS['aPageErrors'][]= "- La mision educacion: es requerida.";
									$bValidateSuccess=false;
								}
							}
							else{
								if ($_POST['cbMisiones_Educacion']="-1"){
									}
								}*/

				/*if ($_POST['cbmision_beneficio_social']=="-1"){
									$GLOBALS['aPageErrors'][]= "- Ha sido beneficiario de las misiones sociales?: es requerido.";
									$bValidateSuccess=false;
									}	 	 
							if ($_POST['cbmision_beneficio_social']=="1"){
									if ($_POST['cbMisiones_social']=="-1"){
									$GLOBALS['aPageErrors'][]= "- La mision social: es requerida.";
									$bValidateSuccess=false;
									}
								}
							else{
								if ($_POST['cbMisiones_social']="-1"){
									}
								}
					*/
				if ($bValidateSuccess) {
					ProcessForm($conn);
				}

				LoadData($conn, true);
				break;
		}
	} else {
		LoadData($conn, false);
	}
}

//------------------------------------------------------------------------------
function LoadData($conn, $bPostBack)
{
	if (count($GLOBALS['aDefaultForm']) == 0) {
		$aDefaultForm = &$GLOBALS['aDefaultForm'];
		//datos personales
		$aDefaultForm['nombre_afiliado'] = '';
		$aDefaultForm['apellido_afiliado'] = '';
		$aDefaultForm['cbSexo_afiliado'] = '-1';
		$aDefaultForm['fnacimiento_afiliado'] = '';
		$aDefaultForm['edad'] = '';
		$aDefaultForm['cbPais_nac_afiliado'] = '-1';
		$aDefaultForm['cbEstado_nac_afiliado'] = '-1';
		$aDefaultForm['cbNacionalidad_afiliado'] = '-1';
		$aDefaultForm['cbEstado_Civil_afiliado'] = '-1';
		$aDefaultForm['cbPais_afiliado'] = '-1';
		$aDefaultForm['cbEstado_afiliado'] = '-1';
		$aDefaultForm['cbMunicipio_afiliado'] = '-1';
		$aDefaultForm['cbParroquia_afiliado'] = '-1';
		$aDefaultForm['sector_afiliado'] = '';
		$aDefaultForm['direccion_afiliado'] = '';
		$aDefaultForm['telefono_afiliado'] = '';
		$aDefaultForm['otro_telefono_afiliado'] = '';
		$aDefaultForm['email_afiliado'] = '';
		$aDefaultForm['twitter'] = '';
		$aDefaultForm['facebook'] = '';
		$aDefaultForm['instagram'] = '';
		$aDefaultForm['tik_tok'] = '';
		$aDefaultForm['cbVehiculo_afiliado'] = '-1';
		$aDefaultForm['observacion_datos_per'] = '';
		$aDefaultForm['cbDiscapacidad_afiliado'] = '-1';
		$aDefaultForm['cbJefe_familia'] = '-1';
		$aDefaultForm['cbHijos'] = '-1';
		//$aDefaultForm['ingreso_familiar']=''; //Se comento por lo que colocaron en las pantallas
		$aDefaultForm['hijos_menores'] = '';
		$aDefaultForm['hijos_mayores'] = '';
		$aDefaultForm['cbMisiones_Educacion'] = '-1';
		//$aDefaultForm['cbmision_beneficio_educacion']='-1'; 
		$aDefaultForm['cbMisiones_social'] = '-1';
		$aDefaultForm['cbmision_beneficio_social'] = '-1';
		$aDefaultForm['codigo'] = '';
		$aDefaultForm['serial'] = '';

		/* ///REVISARRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR
					 if (isset($_SESSION['registro'])){
							 unset($_SESSION['registro']);
				   
						  $SQL="select * From public.personas where cedula='".$_SESSION['ced_afiliado']."'";
						  $rs1 = $conn->Execute($SQL);
						  if ($rs1->RecordCount()>0){ 				
							 $_SESSION['id_afiliado']=$rs1->fields['id']; 
						  }	
	   }*/

		if (!$bPostBack) {
			/*		/// AQUI VALIDA EL ID TRABAJADOR CUANDO VIENE DE CONSULTA
			  if ($_GET['id_po']!='') $_SESSION['id_afiliado']=$_GET['id_po'];	
				  if ($_GET['ced']!='') $_SESSION['ced_afiliado']=$_GET['ced'];*/

			$SQL = "select * From public.personas where id='" . $_SESSION['id_afiliado'] . "'";
			$rs1 = $conn->Execute($SQL);

			if ($rs1->RecordCount() > 0) {
				//var_dump($_SESSION);	
				$_SESSION['id_afiliado'] = $rs1->fields['id'];
				$_SESSION['ced_afiliado'] = $rs1->fields['cedula'];
				$aDefaultForm['nombre_afiliado'] = $rs1->fields['nombres'];
				$aDefaultForm['apellido_afiliado'] = $rs1->fields['apellidos'];
				$aDefaultForm['cbSexo_afiliado'] = $rs1->fields['sexo'];
				$aDefaultForm['fnacimiento_afiliado'] = strftime("%d-%m-%Y", strtotime($rs1->fields['f_nacimiento']));
				$fnacimiento_afiliado = $rs1->fields['f_nacimiento'];
				$dia = date(j);
				$mes = date(n);
				$ano = date(Y);
				//fecha de nacimiento	y edad
				list($anonaz, $mesnaz, $dianaz) = explode("-", $fnacimiento_afiliado);
				if (($mesnaz == $mes) && ($dianaz > $dia)) {
					$ano = ($ano - 1);
				}
				if ($mesnaz > $mes) {
					$ano = ($ano - 1);
				}
				$aDefaultForm['edad'] = ($ano - $anonaz);
				$aDefaultForm['cbPais_nac_afiliado'] = $rs1->fields['pais_nacimiento_id'];
				$Nacionalidad = $rs1->fields['nacionalidad'];
				if ($Nacionalidad == 1) $aDefaultForm['cbNacionalidad_afiliado'] = 'Venezolano';
				if ($Nacionalidad == 2) $aDefaultForm['cbNacionalidad_afiliado'] = 'Extranjero';
				$aDefaultForm['cbEstado_Civil_afiliado'] = $rs1->fields['estado_civil_id'];
				$aDefaultForm['cbPais_afiliado'] = $rs1->fields['pais_residencia_id'];
				$aDefaultForm['sector_afiliado'] = $rs1->fields['sector'];
				$aDefaultForm['direccion_afiliado'] = $rs1->fields['direccion'];
				$aDefaultForm['telefono_afiliado'] = $rs1->fields['telefono'];
				$aDefaultForm['otro_telefono_afiliado'] = $rs1->fields['otro_telefono'];
				$aDefaultForm['email_afiliado'] = $rs1->fields['correo'];
				$aDefaultForm['twitter'] = $rs1->fields['stwitter'];
				$aDefaultForm['facebook'] = $rs1->fields['sfacebook'];
				$aDefaultForm['instagram'] = $rs1->fields['sinstagram'];
				$aDefaultForm['tik_tok'] = $rs1->fields['stiktok'];
				$aDefaultForm['cbVehiculo_afiliado'] = $rs1->fields['tipo_vehiculo_id'];
				$aDefaultForm['observacion_datos_per'] = $rs1->fields['observaciones'];
				$aDefaultForm['cbDiscapacidad_afiliado'] = $rs1->fields['discapacidad'];
				$aDefaultForm['cbJefe_familia'] = $rs1->fields['jefe_fam'];
				$aDefaultForm['cbHijos'] = $rs1->fields['hijos'];
				//$aDefaultForm['ingreso_familiar']=$rs1->fields['ingreso_fam'];
				$aDefaultForm['hijos_menores'] = $rs1->fields['hijos_menores'];
				$aDefaultForm['hijos_mayores'] = $rs1->fields['hijos_mayores'];
				//$aDefaultForm['cbmision_beneficio_educacion']=$rs1->fields['mision_educacion_beneficio'];
				$aDefaultForm['cbMisiones_Educacion'] = $rs1->fields['mision_educacion_id'];
				$aDefaultForm['cbmision_beneficio_social'] = $rs1->fields['mision_social_beneficio'];
				$aDefaultForm['codigo'] = $rs1->fields['codigo_carnet_patria'];
				$aDefaultForm['serial'] = $rs1->fields['serial_carnet_patria'];
				//$aDefaultForm['cbMisiones_social']=$rs1->fields['mision_social_id'];
				$_SESSION['sesiones'] = $rs1->fields['sesiones'];
				//$_SESSION['usuario']=($aDefaultForm['nombre_afiliado'].' '.$aDefaultForm['apellido_afiliado'].'  '.'CI: '.$_SESSION['ced_afiliado']);   
				//bloqueo modulo migracion
				/*if($rs1->fields['estado_nacimiento_id']==$rs1->fields['estado_residencia']){ 
					$_SESSION['migra_bloq']=1; 
				}else{ 
					unset($_SESSION['migra_bloq']);
				}
				if ($_SESSION['tipo_persona']=='P' or $_SESSION['tipo_persona']=='E'){
					unset($_SESSION['migra_bloq']);
				}*/

				//bloqueo modulo dicapacidad
				//if($rs1->fields['discapacidad']==0){ $_SESSION['disc_bloq']=1; }
				//else{ unset($_SESSION['disc_bloq']);}	

?>
				<script language="javascript" src="../js/jquery.js"></script>
				<script>
					$(document).ready(function() {
						combo = "pais_nac";
						$.post("modelo.php", {
								combo: combo
							},
							function(data) {
								$("#cbpais_nac_afiliado").html(data);
							});
					});

					$("#cbpais_nac_afiliado").on("change", function() {
						elegido = $("cbpais_nac_afiliado").val();
						combo = "Estado_nac";
						$.post("modelo.php", {
								elegido: elegido,
								combo: combo,
								seleccionado: "<?php echo $rs1->fields['#cbEstado_nac_afiliado']; ?>"
							},
							function(data) {
								$("#cbEstado_nac_afiliado").html(data);
							});
					});

					/*$(document).ready(function(){
					elegido="<?php echo $rs1->fields['pais_residencia_id']; ?>";
					combo="Estado";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['estado_residencia']; ?>" }, 
					function(data){ $("#cbEstado_afiliado").html(data);
						});            
					});*/

					$(document).ready(function() {
						elegido = "<?php echo $rs1->fields['estado_residencia']; ?>";
						combo = "Municipio";
						$.post("modelo.php", {
								elegido: elegido,
								combo: combo,
								seleccionado: "<?php echo $rs1->fields['municipio_id']; ?>"
							},
							function(data) {
								$("#cbMunicipio_afiliado").html(data);
							});
					});

					$(document).ready(function() {
						elegido = "<?php echo $rs1->fields['municipio_id']; ?>";
						combo = "Parroquia";
						$.post("modelo.php", {
								elegido: elegido,
								combo: combo,
								seleccionado: "<?php echo $rs1->fields['parroquia_id']; ?>"
							},
							function(data) {
								$("#cbParroquia_afiliado").html(data);
							});
					});
				</script>
			<?php

				/*	   //verifica la ultima actualizacion del registro	 
			   			$sql1="select modulo.nombre  as modulo, trazas.fecha
						  from trazas  
						  INNER JOIN modulo ON modulo.id=trazas.modulo
						  where tabla_id='".$_SESSION['id_afiliado']."' 
						  and identi='".$_SESSION['ced_afiliado']."' order by fecha desc  limit 1";
				   $rs1= $conn->Execute($sql1);
				   if ($rs1->RecordCount()>0){
						$_POST['fecha']=strftime("%d/%m/%Y", strtotime($rs1->fields['fecha']));
						$_POST['modulo']=$rs1->fields['modulo'];	 
						} */
			}
		} else {
			$aDefaultForm['nombre_afiliado'] = $_POST['nombre_afiliado'];
			$aDefaultForm['apellido_afiliado'] = $_POST['apellido_afiliado'];
			$aDefaultForm['cbSexo_afiliado'] = $_POST['cbSexo_afiliado'];
			$aDefaultForm['fnacimiento_afiliado'] = $_POST['fnacimiento_afiliado'];
			$aDefaultForm['edad'] = $_POST['edad'];
			$aDefaultForm['cbPais_nac_afiliado'] = $_POST['cbPais_nac_afiliado'];
			$aDefaultForm['cbNacionalidad_afiliado'] = $_POST['cbNacionalidad_afiliado'];
			$aDefaultForm['cbEstado_Civil_afiliado'] = $_POST['cbEstado_Civil_afiliado'];
			$aDefaultForm['cbPais_afiliado'] = $_POST['cbPais_afiliado'];
			$aDefaultForm['sector_afiliado'] = $_POST['sector_afiliado'];
			$aDefaultForm['direccion_afiliado'] = $_POST['direccion_afiliado'];
			$aDefaultForm['telefono_afiliado'] = $_POST['telefono_afiliado'];
			$aDefaultForm['otro_telefono_afiliado'] = $_POST['otro_telefono_afiliado'];
			$aDefaultForm['email_afiliado'] = $_POST['email_afiliado'];
			$aDefaultForm['twitter'] = $_POST['twitter'];
			$aDefaultForm['facebook'] = $_POST['facebook'];
			$aDefaultForm['instagram'] = $_POST['instagram'];
			$aDefaultForm['tik_tok'] = $_POST['tik_tok'];
			$aDefaultForm['cbVehiculo_afiliado'] = $_POST['cbVehiculo_afiliado'];
			$aDefaultForm['observacion_datos_per'] = $_POST['observacion_datos_per'];
			$aDefaultForm['cbDiscapacidad_afiliado'] = $_POST['cbDiscapacidad_afiliado'];
			$aDefaultForm['cbJefe_familia'] = $_POST['cbJefe_familia'];
			$aDefaultForm['cbHijos'] = $_POST['cbHijos'];
			//$aDefaultForm['ingreso_familiar']=$_POST['ingreso_familiar'];
			$aDefaultForm['hijos_menores'] = $_POST['hijos_menores'];
			$aDefaultForm['hijos_mayores'] = $_POST['hijos_mayores'];
			//$aDefaultForm['cbmision_beneficio_educacion']=$_POST['cbmision_beneficio_educacion']; 
			$aDefaultForm['cbMisiones_Educacion'] = $_POST['cbMisiones_Educacion'];
			$aDefaultForm['cbmision_beneficio_social'] = $_POST['cbmision_beneficio_social'];
			$aDefaultForm['cbMisiones_social'] = $_POST['cbMisiones_social'];
			$aDefaultForm['serial'] = $_POST['serial'];
			$aDefaultForm['codigo'] = $_POST['codigo'];
			?>
			<script language="javascript" src="../js/jquery.js">
				$(document).ready(function() {
					combo = "pais_nac";
					$.post("modelo.php", {
							combo: combo
						},
						function(data) {
							$("#cbpais_nac_afiliado1").html(data);
						});
				});

				/*$(document).ready(function(){
				elegido="<?php echo $_POST['cbPais_afiliado']; ?>";
				combo="Estado";
				$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbEstado_afiliado']; ?>" }, 
				function(data){ $("#cbEstado_afiliado").html(data);
				});            
				});*/

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbEstado_afiliado']; ?>";
					combo = "Municipio";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbMunicipio_afiliado']; ?>"
						},
						function(data) {
							$("#cbMunicipio_afiliado").html(data);
						});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbMunicipio_afiliado']; ?>";
					combo = "Parroquia";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbParroquia_afiliado']; ?>"
						},
						function(data) {
							$("#cbParroquia_afiliado").html(data);
						});
				});
			</script>
		<?php

		}
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn)
{
	/*ESTAS VARIABLES NO VAN ES SOLO PARA VERIFICAR EL PROCESO OJOOOOOOO*/
	//$_SESSION['tipo_persona'] = 'P'; P   E

	//$_SESSION['id_afiliado'];// ID único para el usuario y lo identifica
	//$_SESSION['ced_afiliado'];// Cédula del usuario concatenado con la nacionalidad ejem: "V123456789"
	//$_SESSION['sUsuario'];// Cédula sola del usuario

	/*ESTO NOOOOOOO VAAAAAAAA */

	$sfecha = date('Y-m-d');
	if ($_POST['cbEstado_nac_afiliado'] == $_POST['cbEstado_afiliado']) {
		$migrante = 0;
	} else {
		$migrante = 1;
	}

	if ($_SESSION['tipo_persona'] == 'P') {

		$_POST['cbPais_afiliado'] = '-1';
		$_POST['cbEstado_afiliado'] = '-1';
		$_POST['cbMunicipio_afiliado'] = '-1';
		$_POST['cbParroquia_afiliado'] = '-1';
		$_POST['sector_afiliado'] = 'NO POSEE';
		$_POST['direccion_afiliado'] = 'NO POSEE';
	}

	if ($_POST['cbHijos'] == '0') {

		$_POST['hijos_menores'] = 0;
		$_POST['hijos_mayores'] = 0;
	}

	$sql = "UPDATE personas set   
				pais_nacimiento_id = " . $_POST['cbpais_nac_afiliado1'] . ",
				estado_nacimiento_id = '" . $_POST['cbEstado_nac_afiliado'] . "',						  
				estado_civil_id = '" . $_POST['cbEstado_Civil_afiliado'] . "',
				pais_residencia_id = '" . $_POST['cbPais_afiliado'] . "',
				estado_residencia = '" . $_POST['cbEstado_afiliado'] . "',
				municipio_id = '" . $_POST['cbMunicipio_afiliado'] . "',
				parroquia_id = '" . $_POST['cbParroquia_afiliado'] . "',
				sector = '" . $_POST['sector_afiliado'] . "',
				direccion = '" . $_POST['direccion_afiliado'] . "',				  
				telefono = '" . $_POST['telefono_afiliado'] . "',
				otro_telefono = '" . $_POST['otro_telefono_afiliado'] . "',
				correo = '" . $_POST['email_afiliado'] . "',
				stwitter = '" . $_POST['twitter'] . "',
				sfacebook = '" . $_POST['facebook'] . "',
				sinstagram = '" . $_POST['instagram'] . "',
				stiktok = '" . $_POST['tik_tok'] . "',
				tipo_vehiculo_id = '" . $_POST['cbVehiculo_afiliado'] . "',
				discapacidad = '" . $_POST['cbDiscapacidad_afiliado'] . "',
				jefe_fam = '" . $_POST['cbJefe_familia'] . "',
				hijos= '" . $_POST['cbHijos'] . "',
				hijos_menores = '" . $_POST['hijos_menores'] . "', 
				hijos_mayores = '" . $_POST['hijos_mayores'] . "', 
				serial_carnet_patria = '" . $_POST['serial'] . "', 
				codigo_carnet_patria = '" . $_POST['codigo'] . "', 
				 
				migrante =  '" . $migrante . "',
				 
				
				mision_social_beneficio='" . $_POST['cbmision_beneficio_social'] . "', 
				
				observaciones = '" . $_POST['observacion_datos_per'] . "',
				status = 'A',
				updated_at = '" . $sfecha . "',
				id_update = '" . $_SESSION['sUsuario'] . "'
				WHERE cedula='" . $_SESSION['ced_afiliado'] . "'";
	//mision_social_id='".$_POST['cbMisiones_social']."',
	//mision_educacion_id='".$_POST['cbMisiones_Educacion']."',
	//mision_educacion_beneficio='".$_POST['cbmision_beneficio_educacion']."',
	//ingreso_fam = '".$_POST['ingreso_familiar']."',
	$rs = $conn->Execute($sql);

	if ($rs) {

		?><script>
			document.location = 'discapacidad.php'
		</script><?

				}
				// $_SESSION['usuario']=($_POST['nombre_afiliado'].' '.$_POST['apellido_afiliado'].'  '.'CI: '.$_SESSION['ced_afiliado']);
				//Trazas-------------------------------------------------------------------------------------------------------------------------------				
				/*$id=$_SESSION['id_afiliado'];
			$identi=$_SESSION['ced_afiliado'];
			$us=$_SESSION['sUsuario'];
			$mod='1';			    
			$auditoria= new Trazas; 
			$auditoria->auditor($id,$identi,$sql,$us,$mod);*/
				//------------------------------------------------------------------------------------------------------------------				

				//sesiones curriculum
				/*$nNumSeccion = 1;
			$sSQL = "SELECT sesiones FROM personas where id = ".$_SESSION['id_afiliado'];
			$rs = $conn->Execute($sSQL);
	
			if ($rs){
	
				if ($rs->RecordCount() > 0){
					$rs->fields['sesiones'][$nNumSeccion-1] = 1;
					$sSQL = "update personas set sesiones = '".$rs->fields['sesiones']."' where id = ".$_SESSION['id_afiliado'];
					$rs = $conn->Execute($sSQL);			
				}
			}*/

				//mod_migrante
				/*if($_POST['cbEstado_nac_afiliado']==$_POST['cbEstado_afiliado']){
	
				$id_migrante='';			   
				$sSQL = "SELECT id FROM persona_migrante where persona_id = ".$_SESSION['id_afiliado'];
				$rs = $conn->Execute($sSQL);
	
					if ($rs->RecordCount() > 0){
	
						$id_migrante=$rs->fields['id']; 
					   }	
	
					if ($id_migrante!=''){	
	
						$sql="delete  from persona_migrante 
						where id='".$id_migrante."' and persona_id= '".$_SESSION['id_afiliado']."' ";  
						$rs1= $conn->Execute($sql);	
	
						//Trazas---			
						$id=$_SESSION['id_afiliado'];
						$identi=$_SESSION['ced_afiliado'];
						$us=$_SESSION['sUsuario'];
						$mod='1';			    
						$auditoria= new Trazas; 
						$auditoria->auditor($id,$identi,$sql,$us,$mod);
					}
					   $_SESSION['migra_bloq']=1; 
			}else{
					unset($_SESSION['migra_bloq']);
			}*/

				/*if ($_SESSION['tipo_persona']=='P' or $_SESSION['tipo_persona']=='E'){
	
					unset($_SESSION['migra_bloq']);
	
			}*/

				//mod_dicapacidad
				/*if($_POST['cbDiscapacidad_afiliado']==0){
	
				   $_SESSION['disc_bloq']=1;
	
			}else{
	
					unset($_SESSION['disc_bloq']);
	
			}	
					
			if($_SESSION['tipo_usuario']==2){
										
				if($_SESSION['migra_bloq']==1){
					if ($_SESSION['disc_bloq']==1){
						?><script>document.location='1_4agen_trab_ocupacion.php'</script><? 
					}else{
						?><script>document.location='1_3agen_trab_discapacidad.php'</script><? 
					}
				}else{
						?><script>document.location='1_2agen_trab_migrante.php'</script><? 
				}			
					
					
			}else{
						?><script>document.location='1_4agen_trab_ocupacion.php'</script><? 
			}*/
			}
			//FIN ProcessForm
			//------------------------------------------------------------------------------------------------------------------------------
			function showHeader()
			{
				include('header.php');
					?>
	<!-- Select2 -->
	<!--<link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/select2/css/select2.min.css">
	  <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">-->

<?php
				echo '<br>';
				include('menu_trabajador.php');
			}
			//------------------------------------------------------------------------------------------------------------------------------
			function showForm($conn, &$aDefaultForm)
			{
?>
	<!-- Video -->
	<div class="content-video2 video">
		<video src="../videos/video_prueba.mp4" class="video" controls >
			<!-- <source src="videos/video_prueba.mp4" type="video/mp4"> -->
		</video>
	</div>
	<form name="frm_trabajador" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">

		<script>
			//Estado Residencia
			/*$(document).ready(function(){
			   $("#cbPais_afiliado").change(function (){
					   $("#cbPais_afiliado option:selected").each(function () {
						elegido=$(this).val();
						combo='Estado';
						$.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
						//alert(data);
						$("#cbEstado_afiliado").html(data);
						});            
					});
			   })
			});*/
			//Municipio---Parroquia residencia
			$(document).ready(function() {
				$("#cbEstado_afiliado").change(function() {
					$("#cbEstado_afiliado option:selected").each(function() {
						elegido = $(this).val();
						combo = 'Municipio';
						$.post("modelo.php", {
							elegido: elegido,
							combo: combo
						}, function(data) {
							//alert(data);
							$("#cbMunicipio_afiliado").html(data);
						});
					});
				})
			});

			$(document).ready(function() {
				$("#cbMunicipio_afiliado").change(function() {
					$("#cbMunicipio_afiliado option:selected").each(function() {
						elegido = $(this).val();
						combo = 'Parroquia';
						$.post("modelo.php", {
							elegido: elegido,
							combo: combo
						}, function(data) {
							$("#cbParroquia_afiliado").html(data);
						});
					});
				})
			});

			function send(saction) {
				if (saction == 'Continuar') {
					//if(validar_frm_trabajador()==true){
					var form = document.frm_trabajador;
					form.action.value = saction;
					//alert(form.action.value=saction);
					form.submit();
					//}
				} else {
					var form = document.frm_trabajador;
					form.action.value = saction;
					form.submit();
				}
			}
		</script>
		<input type="hidden" name="action" id="action" value="">
		<?/*session_start();
	include("../include/BD.php");
	$conn = Conexion::ConexionBD();

	if(isset($_SESSION['cedula'])){

        $id = $_SESSION['cedula'];

        $consulta = ("SELECT * FROM public.personas WHERE cedula= '".$id."'");
        $row = pg_query($conn, $consulta);
        $persona = pg_fetch_array($row);
        //$persona = $conn->Execute($sentencia);
    }
	include("header.php");
	include('../mod_login/modal.php');*/
				//session_start();
				//var_dump($_SESSION);
		?>
		<!-- Content Wrapper. Contains page content -->
		<!--<div class="content-wrapper">-->
		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<!-- Horizontal Form -->
				<div class="card card-primary" style="border-radius: 30px;">
					<div class="card-header" style="border-radius: 30px ">
						<h3 tabindex="7" class="card-title"> Datos Personales </h3>
					</div>
				</div>
				<div class="card card-info" style="border-radius: 30px;">
					<div class="card-header" style="border-radius: 30px 30px 0 0;">
						<h3 tabindex="8" class="card-title"> Datos Básicos </h3>
					</div>
					<!-- /.card-header -->
					<div style="padding: 10px; text-align: right; margin-bottom: -25px">
						<h4 style="color: #BF1F13; font-size: 15px;"> Campos obligatorios (*) </h4>
					</div>
					<!-- form start -->
					<form class="form-horizontal" id="formulario" name="frm_trabajador" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
						<!--<div class="card-body">
						<div class="form-group row" >
						  <div class="col-sm-6">
							<label class="text-secondary" >Nombre(s) y Apellido(s)</label>
						  </div>	
						  <div class="col-sm-4">
							<label class="text-secondary" >Cédula de Identidad</label>
						  </div>
						</div>							
                    </div>-->
						<!--
					<div class="form-group row" >					
							<div class="col-sm-6">
							<input class="form-control form-control-sm" type="text" id="inputEmail3" placeholder="Nombre y Apellido" value="<?= $aDefaultForm['nombre_afiliado'] . ' ' . $aDefaultForm['apellido_afiliado'] ?>" disabled>
							</div>
						 	<div class="col-sm-4">
							<input class="form-control form-control-sm" type="text" id="inputEmail3" placeholder="Nombre y Apellido" value="<?= $_SESSION['ced_afiliado'] ?>" disabled>
							</div>	
					   </div>	-->

						<div class="card-body">
							<div class="form-group row">

								<!-- Columna 1 Izquierda -->


								<div class="col-sm-6" tabindex="9">
									<label style="color: #312E33">Nacionalidad</label>
									<div>
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 14px; height: auto;" src="../imagenes/nacion.png"></samp>
										</div>
									</div>
									<input style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%;" class="form-control form-control-sm" type="text" id="inputEmail3" onkeypress="mayus(this);" disabled>
								</div>
								<div class="col-sm-6" tabindex="10">
									<label style="color: #312E33">Sexo</label>
									<div>
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 14px; height: auto;" src="../imagenes/genero.png"></samp>
										</div>
									</div>
									<select style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%;" class="form-control form-control-sm" type="text" id="ssexo" onkeyup="mayus(this);" disabled>
										<option>Seleccione...</option>
										<option value="1">Femenino</option>
										<option value="2">Masculino</option>
									</select>
								</div>
								<div class="col-sm-6" tabindex="11">
									<label style="color: #312E33; margin-top: 10px">Fecha de Nacimiento</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img src="../imagenes/calendario.png" style="width: 18px; height: auto; margin-left: -3px"></samp>
										</div>
										<input style="border-radius: 0 15px 15px 0" class="form-control  form-control-sm" type="text" id="fecha_nac" disabled>
									</div>
								</div>
								<div class="col-sm-6" tabindex="12">
									<label style="color: #312E33; margin-top: 10px">Edad</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:30px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px; display: inline-block;">
											<samp><img src="../imagenes/edad.png" style="width: 12px; height: auto;"></samp>
										</div>
									</div>
									<input style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%" class="form-control form-control-sm" id="edad" disabled></p>
								</div>
								<div class="col-sm-6">
									<label style="color: #312E33; margin-top: -2.6px">País dónde nació</label><span style="color: red;"> *</span>
									<div>
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 14px; height: auto;" src="../imagenes/ciudadania.png"></samp>
										</div>
									</div>
									<select tabindex="13" aria-label="Es obligatorio indicar cual es su país dónde nació" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: grey" onchange="cambio_pais(cbpais_nac_afiliado1.value)" name="cbpais_nac_afiliado1" id="cbpais_nac_afiliado1" class="form-control-sm " title="Estado de Nacimiento - Seleccione s&oacute;lo una opci&oacute;n del listado" onkeyup="mayus(this);">
										<option value="-1">Seleccione</option>
									</select>
								</div>
								<!-- <script>
									$("#cbpais_nac_afiliado1").on("change", function() {
										elegido = $("#cbpais_nac_afiliado1").val();
										if (elegido == 239) {
											combo = "Estado_nac";
											$.post("modelo.php", {
													elegido: elegido,
													combo: combo,
													seleccionado: "<?php echo $_POST['cbEstado_nac_afiliado1']; ?>"
												},
												function(data) {
													$("#cbEstado_nac_afiliado").html(data);
												});
										} else {
											document.getElementById("cbEstado_nac_afiliado").disabled = true;
										}
									});

									$("#cbpais_nac_afiliado1").on("change", function() {
										elegido = $("#cbpais_nac_afiliado1").val();
										if (elegido == 239) {
											combo = 'Estado_nac';
											$.post("modelo.php", {
													elegido: elegido,
													combo: combo,
													seleccionado: "<?php echo $_POST['cbEstado_nac_afiliado1']; ?>"
												},
												function(data) {
													//alert(data);
													$("#cbEstado_nac_afiliado").html(data);
												});
										} else {
											document.getElementById("cbEstado_nac_afiliado").disabled = true;
										}
									});

									function slc() {
										var sel = document.getElementById("cbpais_nac_afiliado1").value;
										if (sel == 239) {
											document.getElementById("cbEstado_nac_afiliado").disabled = false;
										} else {
											document.getElementById("cbEstado_nac_afiliado").disabled = true;
										}
									}
								</script> -->
								<div class="col-sm-6">
									<label style="color: #312E33; margin-top: -10px">Estado dónde nació</label><span style="color: red;"> *</span>
									<div>
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 15px; height: auto;" src="../imagenes/venezuela.png"></samp>
										</div>
									</div>
									<select tabindex="14" aria-label="Es obligatorio indicar cual es el Estado en dónde nació" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" name="cbEstado_nac_afiliado" id="cbEstado_nac_afiliado" class="form-control-sm select2" title="Estado de Nacimiento - Seleccione s&oacute;lo una opci&oacute;n del listado" onkeyup="mayus(this);">
										<option value="-1">Seleccione</option>
									</select>
								</div>
								<div class="col-sm-6">
									<label style="color: #312E33; margin-top: 10px">Estado Civil</label>
									<div>
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 15px; height: auto;" src="../imagenes/anillo.png"></samp>
										</div>
									</div>
									<select tabindex="15" aria-label="indique su estado civil" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" name="cbEstado_Civil_afiliado" class="form-control-sm select2" id="cbEstado_Civil_afiliado" title="Estado Civil - Seleccione s&oacute;lo una opci&oacute;n del listado" onkeyup="mayus(this);">
										<option value="-1" selected="selected">Seleccione</option>
									</select>
								</div>
								<div class="col-sm-6" tabindex="16">
									<label style="color: #312E33; margin-top: 10px">Correo Electrónico</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:30px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px; display: inline-block;">
											<samp><img src="../imagenes/edad.png" style="width: 12px; height: auto;"></samp>
										</div>
									</div>
									<input style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%" class="form-control form-control-sm" id="Correo" disabled></p>
								</div>
								<div class="col-sm-6" tabindex="17">
									<label style="color: #312E33; margin-top: 10px">Teléfono Personal</label><span style="color: red;"> *</span>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img src="../imagenes/Telf.png" style="width: 15px; height: auto"></samp>
										</div>
										<input tabindex="18" alt="Este es su teléfono personal" name="telefono_afiliado" id="telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?= $aDefaultForm['telefono_afiliado'] ?>" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="text" maxlength="11">
									</div>
								</div>
								<div class="col-sm-6" tabindex="19">
									<label style="color: #312E33; margin-top: 10px">Teléfono de Habitación</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img src="../imagenes/Telf.png" style="width: 15px; height: auto"></samp>
										</div>
										<input tabindex="20" alt="Este es su teléfono de recuperación" name="otro_telefono_afiliado" id="otro_telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?= $aDefaultForm['otro_telefono_afiliado'] ?>" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="text" maxlength="11">
									</div>
								</div>
								<script src="edad.js"></script>
								<!-- Tabla bootstrap 4
							div class="col-sm-2">
							<center><label class="text-secondary" >Nacionalidad</label></center>
						  </div>	
						  <div class="col-sm-4">
							<input style="border-radius: 15px;" class="form-control form-control-sm" type="text" id="inputEmail3" placeholder="Nombre y Apellido" value="<?= $aDefaultForm['cbNacionalidad_afiliado'] ?>" disabled>
						  </div>
						  <div class="col-sm-2">
							<center><label class="text-secondary" >Estado de Nacimiento</label></center>
						  </div>	
						  <div class="col-sm-4">
							<select style="border-radius: 15px;" name="cbEstado_nac_afiliado" id="cbEstado_nac_afiliado" class=" form-control form-control-sm select2" title="Estado de Nacimiento - Seleccione s&oacute;lo una opci&oacute;n del listado" disabled>
							<option value="-1">Seleccionar</option>
							</select>
						  </div>
						  <div class="col-sm-2">
							<center><label class="text-secondary" >Sexo</label></center>
						  </div>
						  <div class="col-sm-4">
							<select style="border-radius: 15px;" class="form-control form-control-sm" type="text" id="inputEmail3">
								<option>Seleccione...</option>
								<option value="<?/* if (($aDefaultForm['cbSexo_afiliado'])=='1') echo 'Femenino';?>"> Femenino</option>
								<option value="<? if (($aDefaultForm['cbSexo_afiliado'])=='2') echo 'Masculino';*/ ?>">masculino</option>	
							</select>
						   </div>
						   <div style="height:20px" class="col-sm-12"></div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Fecha de Nacimiento</label></center>
						   </div>
						   <div class="col-sm-4">
							<input style="border-radius: 15px;" class="form-control form-control-sm" type="text" id="inputEmail3" placeholder="Nombre y Apellido" value="<?= $aDefaultForm['fnacimiento_afiliado'] ?>" disabled>				
							</div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Edad</label></center>
						   </div>
						   <div class="col-sm-4">
							<input style="border-radius: 15px;" class="form-control form-control-sm" type="number" id="inputEmail3" placeholder="Nombre y Apellido" value="<?= $aDefaultForm['edad'] ?>">				
							</div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Estado Civil</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<select style="border-radius: 15px;" name="cbEstado_Civil_afiliado" class=" form-control form-control-sm select2" id="cbEstado_Civil_afiliado" title="Estado Civil - Seleccione s&oacute;lo una opci&oacute;n del listado">
							<option value="-1" selected="selected">Seleccione...</option>
							<?/* LoadEstado_Civil_afiliado($conn) ; print $GLOBALS['sHtml_cb_Estado_Civil_afiliado']; */ ?>
							</select>
						   </div>
						   <div style="height:20px" class="col-sm-12"></div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Teléfono Personal</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<input name="telefono_afiliado" id="telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?/*=$aDefaultForm['telefono_afiliado']?>" style="border-radius: 15px;" class=" form-control form-control-sm select2" type="number">
						   </div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Teléfono de Habitación</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<input name="otro_telefono_afiliado" id="otro_telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['otro_telefono_afiliado']?>" style="border-radius: 15px;" class=" form-control form-control-sm select2" type="number">
						   </div>
						   <div class="col-sm-2">
							<center><label class="text-secondary">Correo Electrónico</label></center>
						   </div>
						   <div class="col-sm-4">
						   <input name="email_afiliado" id="email_afiliado" value="<?/*=$aDefaultForm['email_afiliado']*/ ?>" style="border-radius: 15px;" class=" form-control form-control-sm select2" type="email"></div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">¿Posee Redes Sociales?</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<select style="border-radius: 15px;" class=" form-control form-control-sm select2">
								<option></option>
								<option value="">Si</option>
								<option value="">No</option>
							</select>
						   </div>
						   <div class="col-sm-4">
						   	<center><label class="text-secondary">Facebook</label></center>
						   </div>
						   <div class="col-sm-8" style="height:20px"></div>
						   <div class="col-dm-1" style="width: 30px"></div>
						   <div style="whidth: 50px; height:31px; border: 1px solid #CCCCCC; padding: 5px 10px; left:20px; border-radius: 3px 0 0 3px; position: absolute; top: 374px; z-index:1" class="col-dm-1">
						   	<div class="fab fa-facebook-f"></div>
						   </div>
						   <div class="col-sm-4">
						   	<input style="border-radius: 3px;%" class=" form-control form-control-sm select2" type="text">
						   </div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Instagram</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<input style="border-radius: 15px;" class=" form-control form-control-sm select2" type="text">
						   </div>
						   <div style="height:20px" class="col-sm-12"></div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Twitter</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<input style="border-radius: 15px;" class=" form-control form-control-sm select2" type="text">
						   </div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">¿Es Jefe de Familia?</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<select name="cbJefe_familia" id="cbJefe_familia" style="border-radius: 15px;" class=" form-control form-control-sm select2">
								<option value="-1" selected="selected">Seleccione</option>
								<option value="1" <?/* if (($aDefaultForm['cbJefe_familia'])=='1') print 'selected="selected"';?>>Si</option>
								<option value="0" <? if (($aDefaultForm['cbJefe_familia'])=='0') print 'selected="selected"';?>>No</option>
							</select>
						   </div>
						   <div style="height:20px" class="col-sm-12"></div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">¿Tiene Hijos?</label></center>
						   </div>
						   <div class="col-sm-4">
						    <select name="cbHijos" id="cbHijos" style="border-radius: 15px;" class=" form-control form-control-sm select2">
								<option value="-1" selected="selected">Seleccione</option>
				<option value="1" <? if (($aDefaultForm['cbHijos'])=='1') print 'selected="selected"';?>>Si</option>
				<option value="0" <? if (($aDefaultForm['cbHijos'])=='0') print 'selected="selected"';?>>No</option>
							 </select>
						   </div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">¿Tiene Vehículos?</label></center>
						   </div>
						   <div class="col-sm-4">
						    <select name="cbVehiculo_afiliado" id="cbVehiculo_afiliado" style="border-radius: 15px;" class=" form-control form-control-sm select2">
								<option value="-1" selected="selected">Seleccione...</option>
								<? LoadVehiculo_afiliado($conn); print $GLOBALS['sHtml_cb_Vehiculo_afiliado'];*/ ?>
							 </select>
						   </div>
						   <div style="height:20px" class="col-sm-12"></div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Ingreso Familiar Mensual(Bs.)</label></center>
						   </div>
						   <div class="col-sm-4">
						    <input name="ingreso_familiar" type="number" class=" form-control form-control-sm select2" style="border-radius: 15px;" id="ingreso_familiar" onKeyPress="return permite(event, 'num')" value="<?= $aDefaultForm['ingreso_familiar'] ?>" size="20" maxlength="8">
						   </div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">¿Posee Carnert de la Patria?</label></center>
						   </div>
						   <div class="col-sm-4">
						    <select style="border-radius: 15px;" class=" form-control form-control-sm select2">
								<option></option>
								<option value="">Si</option>
								<option value="">No</option>
							 </select>
						   </div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Código del Carnet de la Patria</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<input style="border-radius: 15px;" class=" form-control form-control-sm select2" type="text">
						   </div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Serial del Carnet de la Patria</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<input style="border-radius: 15px;" class=" form-control form-control-sm select2" type="text">
						   </div>-->
							</div>
						</div>

						<!--<div class="form-group row" >					
							
						 		
					   </div>
					
					
					
					
					-->
						<!--<div class="card-body">   
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Cédula de Identidad</label>
						   <label class="text-secondary">Sexo</label>							
							<div class="col-sm-10">
							<input class="form-control form-control-sm" type="text" id="inputEmail3" placeholder="Nombre y Apellido" value="<? /*if (($aDefaultForm['cbSexo_afiliado'])=='1') echo 'Femenino';
				if (($aDefaultForm['cbSexo_afiliado'])=='2') echo 'Masculino';*/ ?>" disabled>				
							</div>
						</div>-->

						<!--div class="form-group row">
											<label for="inputEmail3" class="col-sm-2 col-form-label">Cédula de Identidad</label>-->


						<!--/div>
						
						<div class="form-group row">
													<label for="inputEmail3" class="col-sm-2 col-form-label">Cédula de Identidad</label>-->


						<!--</div>
						
						
						<div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label">Estado Civil</label>-->

						<!--<div class="col-sm-10">
										<select name="cbEstado_Civil_afiliado" class=" form-control form-control-sm select2" id="cbEstado_Civil_afiliado" title="Estado Civil - Seleccione s&oacute;lo una opci&oacute;n del listado">
										<option value="-1" selected="selected">Seleccione...</option>
										<?/* LoadEstado_Civil_afiliado($conn) ; print $GLOBALS['sHtml_cb_Estado_Civil_afiliado']; */ ?>
										</select>
									</div>
						</div>-->
						<!-- /.form-group -->

						<!--<div class="form-group row">
							<div class="offset-sm-2 col-sm-10">
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="exampleCheck2">
									<label class="form-check-label" for="exampleCheck2">Remember me</label>
								</div>
							</div>
					 /.card-body -->
						<!--<div class="card-footer">
					<button type="submit" class="btn btn-info">Sign in</button>
					<button type="submit" class="btn btn-default float-right">Cancel</button>
					</div>-->
						<!-- /.card-footer -->
					</form>
				</div>
				<!-- /.card -->
			</div>
			<!-- /.content -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">


					<!-- Sección 2 -->
					<div class="card card-info" style="border-radius: 30px;">
						<!-- Card Header -->
						<div class="card-header" style="border-radius: 30px 30px 0 0;">
							<h3 tabindex="21" class="card-title">Dirección de Habitación</h3>
						</div>
						<!-- /.card-Body -->
						<div class="card-body">
							<div class="form-group row">

								<!-- Columna 1 Izquierda -->

								<div class="col-sm-6 ">
									<label style="color: #312E33">País de Residencia</label><span style="color: red;"> *</span>
									<div>
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 14px; height: auto;" src="../imagenes/ciudadania.png"></samp>
										</div>
									</div>
									<select tabindex="23" alt="Es obligatorio indicar cual es el país en donde se encuentra su redidencia actual" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: grey" onchange="cambios_pais(pais_residencia.value)" class="form-control-sm select2" name="pais_residencia" id="pais_residencia" onkeyup="mayus(this);">
										<option value="-1" selected="selected">Seleccione</option>
										<option value="245">Venezuela</option>
									</select>
								</div>
								<div class="col-sm-6">
									<label style="color: #312E33">Estado</label><span style="color: red;"> *</span>
									<div>
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 15px; height: auto;" src="../imagenes/venezuela.png"></samp>
										</div>
									</div>
									<select tabindex="24" alt="Es obligatorio indicar cual es el estado en donde se encuentra su redidencia actual" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: grey" onchange="cambio_estado(estado_residencia.value)" class="form-control-sm select2" name="estado_residencia" id="estado_residencia" onkeyup="mayus(this);">
										<option value="">Seleccione</option>
									</select>
								</div>
								<div class="col-sm-6">
									<label style="color: #312E33; margin-top: 10px;">Municipio</label><span style="color: red;"> *</span>
									<div>
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 15px; height: auto;" src="../imagenes/municipio.png"></samp>
										</div>
									</div>
									<select tabindex="25" alt="Es obligatorio indicar cual es el municipio en donde se encuentra su redidencia actual" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: grey" onchange="cambio_municipio(municipio_residencia.value)" class="form-control-sm select2" name="municipio_residencia" id="municipio_residencia" onkeyup="mayus(this);">
										<option value="-1">Seleccione</option>
									</select>
								</div>
								<div class="col-sm-6">
									<label style="color: #312E33; margin-top: 10px;">Parroquia</label><span style="color: red;"> *</span>
									<div>
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 15px; height: auto;" src="../imagenes/parroquia.png"></samp>
										</div>
									</div>
									<select tabindex="26" alt="Es obligatorio indicar cual es el parroquia en donde se encuentra su redidencia actual" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: grey" class="form-control-sm select2" name="parroquia_residencia" id="parroquia_residencia" onkeyup="mayus(this);">
										<option value="-1">Seleccione</option>
									</select>
								</div>
								<div class="col-sm-6" tabindex="27">
									<label style="color: #312E33; margin-top: 10px;">Sector</label>
									<div>
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 15px; height: auto;" src="../imagenes/sector.png"></samp>
										</div>
									</div>
									<input tabindex="28" alt="Es obcional indicar cual es el sector de su redidencia actual" name="sector_afiliado" id="sector_afiliado" value="<? /* $aDefaultForm['sector_afiliado'] */ ?>" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%;" class=" form-control form-control-sm select2" onkeypress="mayus(this);">
								</div>
								<div class="col-sm-6" tabindex="29">
									<label style="color: #312E33; margin-top: 10px;">Dirección</label>
									<div>
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 15px; height: auto;" src="../imagenes/direccion.png"></samp>
										</div>
									</div>
									<input tabindex="29" alt="Es obcional indicar cual es el dirección de su redidencia actual" value="<? /* $aDefaultForm['direccion_afiliado'] */ ?>" name="direccion_afiliado" id="direccion_afiliado" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%;" class=" form-control form-control-sm select2" type="text" onkeyup="mayus(this);">
								</div>
								<div class="col-sm-12 " tabindex="30">
									<label style="color: #312E33; margin-top: 10px;">Punto de Referencia</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
									</div>
									<textarea tabindex="30" alt="Es obcional indicar un punto de referencia" class="form-control" id="observacion_datos_per" value="<?/*  $aDefaultForm['observacion_datos_per'] */ ?>" name="referencia" style="border-radius: 30px" onkeyup="mayus(this);"></textarea>
								</div>
								<!--div class="col-sm-2">
								<div class="col-sm-2">
								 <center><label class="text-secondary">País de Residencia</label></center>
								</div>
								<div class="col-sm-4">
								<select style="border-radius: 15px;" class=" form-control form-control-sm select2" name="cbPais_afiliado" id="cbPais_afiliado">
								<option value="-1" selected="selected">Seleccione...</option>
								<? /*LoadPais_nac_afiliado ($conn) ; print $GLOBALS['sHtml_cb_Pais_nac_afiliado']; */ ?>
								</select>
								</div>
								<div class="col-sm-2">
								 <center><label class="text-secondary">Estado</label></center>
								</div>
								<div class="col-sm-4">
								<select style="border-radius: 15px;" class=" form-control form-control-sm select2" name="cbEstado_afiliado" id="cbEstado_afiliado">
									<option value="-1">Seleccionar</option>
								</select>
								</div>
								<div style="height:20px" class="col-sm-12"></div>
								<div class="col-sm-2">
								 <center><label class="text-secondary">Municipio</label></center>
								</div>
								<div class="col-sm-4">
								 <select style="border-radius: 15px;" class=" form-control form-control-sm select2" name="cbMunicipio_afiliado" id="cbMunicipio_afiliado">
									<option value="-1">Seleccionar</option>
								 </select>
								</div>
								<div class="col-sm-2">
								 <center><label class="text-secondary">Parroquia</label></center>
								</div>
								<div class="col-sm-4">
								 <select style="border-radius: 15px;" class=" form-control form-control-sm select2" name="cbParroquia_afiliado" id="cbParroquia_afiliado">
									<option value="-1">Seleccionar</option>
								 </select>
								</div>
								<div style="height:20px" class="col-sm-12"></div>
								<div class="col-sm-2">
								 <center><label class="text-secondary">Sector</label></center>
								</div>
								<div class="col-sm-4">
								 <input name="sector_afiliado" id="sector_afiliado" value="<?/*=$aDefaultForm['sector_afiliado']?>" style="border-radius: 15px;" class=" form-control form-control-sm select2">
								</div>
								<div class="col-sm-2">
								 <center><label class="text-secondary">Dirección</label></center>
								</div> 
								<div class="col-sm-4">
								 <input name="direccion_afiliado" id="direccion_afiliado" value="<?=$aDefaultForm['direccion_afiliado']*/ ?>" style="border-radius: 15px;" class=" form-control form-control-sm select2" type="text">
								</div>
								<div class="col-sm-2"></div>
								<div class="col-sm-4"></div>
								<div class="col-sm-2"></div>
								<div class="col-sm-4"></div>
							</div-->
								<!-- /.row -->
							</div>
						</div>
						<!-- /.card -->

						<!--<div class="card card-default">-->
						<!--<div class="card-header">
							<h3 class="card-title">Bootstrap Duallistbox</h3>

							<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove">
								<i class="fas fa-times"></i>
							</button>
							</div>
						</div>-->
						<!-- /.card-header -->
						<!--<div class="card-body">
							<div class="row">
							<div class="col-12">
								<div class="form-group">
								<label>Multiple</label>
								<select class="duallistbox" multiple="multiple">
									<option selected>Alabama</option>
									<option>Alaska</option>
									<option>California</option>
									<option>Delaware</option>
									<option>Tennessee</option>
									<option>Texas</option>
									<option>Washington</option>
								</select>
								</div>-->
						<!-- /.form-group -->
						<!--</div>-->
						<!-- /.col -->
						<!--</div>-->
						<!-- /.row -->
						<!--</div>-->
						<!-- /.card-body -->
						<!--<div class="card-footer">
							Visit <a href="https://github.com/istvan-ujjmeszaros/bootstrap-duallistbox#readme">Bootstrap Duallistbox</a> for more examples and information about
							the plugin.
						</div>-->
						<!--</div>-->
						<!-- /.card -->




						<!-- /.row -->
					</div>
					<!-- /.container-fluid -->
			</section>
			<div class="content">
				<div class="container-fluid">
					<div class="card card-info" style="border-radius: 30px;">
						<!-- Card Header -->
						<div class="card-header" style="border-radius: 30px 30px 0 0;">
							<h3 id="titulo_redes" tabindex="31" class="card-title">Redes Sociales</h3>
						</div>
						<!-- /.card-Body -->
						<div class="card-body">
							<form class="form-horizontal">
								<div class="form-group row">
									<div style="display: none;"><input type="text" id="id_redes_sociales"></div>
									<div class="col-sm-6">
										<label style="color: #312E33">Indique ¿Qué red social Utiliza?</label>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 15px; height: auto;" src="../imagenes/medios.png"></samp>
											</div>
										</div>
										<select tabindex="32" aria-label="es obligatorio indicar la red social que posee" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" onchange="javascript:sel()" class="form-control-sm select2" id="redes_sociales" name="redes_sociales">
											<option value="">Seleccione</option>
										</select>
										<script>
											function sel() {
												var selec = document.getElementById("redes_sociales").value;
												if (selec == 10) {
													document.getElementById("red2").style.display = 'block';
													document.getElementById("red3").style.display = 'none';
													document.getElementById("red4").style.display = 'none';
													document.getElementById("red5").style.display = 'none';
													document.getElementById("red6").style.display = 'none';
													document.getElementById("twitter").tabIndex = '33';
													document.getElementById("red2").tabIndex = '33';
													document.getElementById("btn").tabIndex = '34';
													document.getElementById("red_social").tabIndex = '34';
													//document.getElementById("informacion_id").tabIndex = '42';
													document.getElementById("red7").style.display = 'none';
													document.getElementById("red8").style.display = 'none';
												} else if (selec == 2) {
													document.getElementById("red2").style.display = 'none';
													document.getElementById("red3").style.display = 'block';
													document.getElementById("red4").style.display = 'none';
													//document.getElementById("informacion_id").tabIndex = '42';
													document.getElementById("facebook").tabIndex = '33';
													document.getElementById("red3").tabIndex = '33';
													document.getElementById("red5").style.display = 'none';
													document.getElementById("red6").style.display = 'none';
													document.getElementById("red7").style.display = 'none';
													document.getElementById("red8").style.display = 'none';
													document.getElementById("btn").tabIndex = '34';
													document.getElementById("red_social").tabIndex = '34';
												} else if (selec == 8) {
													document.getElementById("red2").style.display = 'none';
													document.getElementById("red3").style.display = 'none';
													document.getElementById("red4").style.display = 'block';
													document.getElementById("telegram").tabIndex = '33';
													document.getElementById("red4").tabIndex = '33';
													//document.getElementById("informacion_id").tabIndex = '42';
													document.getElementById("red5").style.display = 'none';
													document.getElementById("red6").style.display = 'none';
													document.getElementById("red7").style.display = 'none';
													document.getElementById("red8").style.display = 'none';
													document.getElementById("btn").tabIndex = '34';
													document.getElementById("red_social").tabIndex = '34';
												} else if (selec == 4) {
													document.getElementById("red2").style.display = 'none';
													document.getElementById("red3").style.display = 'none';
													document.getElementById("red4").style.display = 'none';
													document.getElementById("instagram").tabIndex = '33';
													document.getElementById("red5").tabIndex = '33';
													document.getElementById("red5").style.display = 'block';
													//document.getElementById("informacion_id").tabIndex = '42';													
													document.getElementById("red6").style.display = 'none';
													document.getElementById("red7").style.display = 'none';
													document.getElementById("red8").style.display = 'none';
													document.getElementById("btn").tabIndex = '34';
													document.getElementById("red_social").tabIndex = '34';
												} else if (selec == 15) {
													document.getElementById("red2").style.display = 'none';
													document.getElementById("red3").style.display = 'none';
													document.getElementById("red4").style.display = 'none';
													document.getElementById("red5").style.display = 'none';
													document.getElementById("red6").style.display = 'block';
													document.getElementById("red6").tabIndex = '33';
													document.getElementById("tik_tok").tabIndex = '33';
													//document.getElementById("informacion_id").tabIndex = '42';
													document.getElementById("red7").style.display = 'none';
													document.getElementById("red8").style.display = 'none';
													document.getElementById("btn").tabIndex = '34';
													document.getElementById("red_social").tabIndex = '34';
												} else {
													document.getElementById("red2").style.display = 'none';
													document.getElementById("red3").style.display = 'none';
													document.getElementById("red4").style.display = 'none';
													//document.getElementById("informacion_id").tabIndex = '40';
													document.getElementById("red5").style.display = 'none';
													document.getElementById("red6").style.display = 'none';
													document.getElementById("red7").style.display = 'none';
													document.getElementById("red8").style.display = 'none';
												}
											}
										</script>
									</div>
									<!-- Twitter -->
									<div class="col-sm-6" id="red2" style="display: none;" tabindex="36">
										<label style="color: #312E33">Twitter</label>
										<div class="input-group">
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp style="font-size: 13px;" class="icon-twitter"></samp>
											</div>
											<input tabindex="36" aria-label="debe indicar el nombre de usuario de la red social Twitter" name="twitter" id="twitter" value="<?= $aDefaultForm['twitter'] ?>" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="text">
										</div>
									</div>
									<!-- Facebook -->
									<div class="col-sm-6" id="red3" style="display: none;" tabindex="36">
										<label style="color: #312E33">Facebook</label>
										<div class="input-group">
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp style="font-size: 13px;" class="icon-facebook"></samp>
											</div>
											<input tabindex="36" aria-label="debe indicar el nombre de usuario de la red social facebook" name="facebook" id="facebook" value="<?= $aDefaultForm['facebook'] ?>" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="text">
										</div>
									</div>
									<!-- Telegram -->
									<div class="col-sm-6" id="red4" style="display: none;" tabindex="36">
										<label style="color: #312E33">Telegram</label>
										<div class="input-group">
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp style="font-size: 13px;" class="icon-telegram"></samp>
											</div>
											<input tabindex="36" aria-label="debe indicar el nombre de usuario de la red social telegram" name="telegram" id="telegram" value="" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="text">
										</div>
									</div>
									<!-- Instagram -->
									<div class="col-sm-6" id="red5" style="display: none;" tabindex="36">
										<label style="color: #312E33">Instagram</label>
										<div class="input-group">
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp style="font-size: 13px;" class="icon-instagram"></samp>
											</div>
											<input tabindex="36" aria-label="debe indicar el nombre de usuario de la red social instagram" name="instagram" id="instagram" value="<?= $aDefaultForm['instagram'] ?>" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="text">
										</div>
									</div>
									<!-- Tik Tok -->
									<div class="col-sm-6" id="red6" style="display: none;" tabindex="36">
										<label style="color: #312E33">Tik Tok</label>
										<div class="input-group">
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 12px; height: auto;" src="../imagenes/tik-tok.png"></samp>
											</div>
											<input tabindex="36" aria-label="debe indicar el nombre de usuario de la red social Tik Tok" name="tik_tok" id="tik_tok" value="<?= $aDefaultForm['tik_tok'] ?>" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%" class=" form-control form-control-sm select2" type="text">
										</div>
									</div>
									<!-- Otro -->
									<div class="col-sm-6" id="red7" style="display: none;" tabindex="36">
										<label style="color: #312E33">Nombre de la Red Social</label>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 15px; height: auto;" src="../imagenes/medios.png"></samp>
											</div>
											<input tabindex="36" aria-label="debe indicar el nombre de la red social" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" name="otro" id="name_red" class=" form-control form-control-sm select2" type="text">
										</div>
									</div>
									<div class="col-sm-6" id="red8" style="display: none;" tabindex="36">
										<label style="color: #312E33">Nombre de Usuario</label>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 15px; height: auto;" src="../imagenes/medios.png"></samp>
											</div>
											<input tabindex="36" aria-label="debe indicar el nombre de usuario de la red social" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" name="otro" id="name_user" class=" form-control form-control-sm select2" type="text">
										</div>
									</div>
									<div class="col-7">
										<input aria-label="actualizar red social" type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px; margin-top: 15px;display:none" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" value="Actualizar" id="btn" tabindex="33" onclick="agregar_red(redes_sociales.value,twitter.value,facebook.value,telegram.value,instagram.value,tik_tok.value,id_redes_sociales.value);">
										<input aria-label="agregar red social" type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px; margin-top: 15px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" value="Agregar Red Social" id="red_social" tabindex="33" onclick="agregar_red(redes_sociales.value,twitter.value,facebook.value,telegram.value,instagram.value,tik_tok.value,id_redes_sociales.value);">
									</div>
									<table class="table table-bordered table-striped table-sm hover" style="background-color: white; margin-top: 15px">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Red Social</th>
												<th scope="col">Nombre de usuario</th>
												<th scope="col">Acciones</th>
											</tr>
										</thead>
										<tbody id="tabla_red_social"></tbody>
									</table>
									<!--
									<script src="../js/code.jquery.com_jquery-3.7.0.js"></script>
									<script src="../js/cdn.tailwindcss.com_3.3.3"></script>
									<script src="../js/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script> 
									<script src="../js/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
									-->
									<!-- <script>
										/* var tabla = document.querySelector("#table_red_social");
										var dataTable = new DataTable(tabla); */
										new DataTable("#table_red_social");
									</script> -->
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="container-fluid">
					<div class="card card-info" style="border-radius: 30px;">
						<!-- Card Header -->
						<div class="card-header" style="border-radius: 30px 30px 0 0;">
							<h3 tabindex="34" id="Datos_Familiares" class="card-title">Datos Familiares</h3>
						</div>
						<!-- /.card-Body -->
						<div class="card-body">
							<div class="form-group row">
								<div class="col-sm-6">
									<label style="color: #312E33">¿Es Jefe o Jefa de Hogar?</label><span style="color: red;"> *</span>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp style="font-size: 13px;" class="icon-home"></samp>
										</div>
										<select tabindex="35" alt="Es obligatorio indicar si es jefe de hogar" name="cbJefe_familia" id="cbJefe_familia" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class="form-control-sm select2">
											<option value="-1" selected="selected">Seleccione</option>
											<option value="1" <? if (($aDefaultForm['cbJefe_familia']) == '1') print 'selected="selected"'; ?>>Si</option>
											<option value="0" <? if (($aDefaultForm['cbJefe_familia']) == '0') print 'selected="selected"'; ?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<label style="color: #312E33">¿Tiene Hijos?</label><span style="color: red;"> *</span>
									<div>
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 12px; height: auto;" src="../imagenes/familia.png" alt=""></samp>
										</div>
										<select tabindex="36" alt="Es obligatorio indicar si tiene hijos" name="cbHijos" id="cbHijos" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" onchange="javascript:hijos();" class="form-control-sm select2">
											<option value="-1" selected="selected">Seleccione</option>
											<option value="1" <? if (($aDefaultForm['cbHijos']) == '1') print 'selected="selected"'; ?>>Si</option>
											<option value="0" <? if (($aDefaultForm['cbHijos']) == '0') print 'selected="selected"'; ?>>No</option>
										</select>
									</div>
								</div>
								<script>
									function hijos() {
										var hijos = document.getElementById("cbHijos").value;
										if (hijos == 1) {
											let tab = document.getElementById("cbJefe_familia").tabIndex;
											let tab1 = tab + 2;
											let tab2 = tab + 3;
											let tab3 = tab + 4;
											let tab4 = tab + 5;
											let tab5 = tab + 6;
											document.getElementById("hijos1").style.display = 'block';
											document.getElementById("hijos1").tabIndex = 'tab1';
											document.getElementById("hijos_menores").tabIndex = 'tab1';
											document.getElementById("hijos2").style.display = 'block';
											document.getElementById("hijos2").tabIndex = 'tab2';
											document.getElementById("hijos_mayores").tabIndex = 'tab2';
											document.getElementById("informacion_id").tabIndex = 'tab3';
											document.getElementById("cbVehiculo_afiliado").tabIndex = 'tab4';
											document.getElementById("carnet_patria").tabIndex = 'tab5';
										} else {
											document.getElementById("hijos1").style.display = 'none';
											document.getElementById("hijos2").style.display = 'none';
											document.getElementById("informacion_id").tabIndex = 'tab1';
											document.getElementById("cbVehiculo_afiliado").tabIndex = 'tab1';
											document.getElementById("carnet_patria").tabIndex = 'tab2';
										}
									}
								</script>
								<div class="col-sm-6" id="hijos2" style="display: none;">
									<label style="color: #312E33; margin-top: 10px">¿Cuantos Menores de 18?</label><span style="color: red;"> *</span>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 12px; height: auto;" src="../imagenes/menor.png"></samp>
										</div>
										<input name="hijos_menores" type="number" min="0" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%" class=" form-control form-control-sm select2" id="hijos_menores" onKeyPress="return permite(event, 'num')" value="<?= $aDefaultForm['hijos_menores'] ?>" size="5" maxlength="2">
									</div>
								</div>
								<div class="col-sm-6" id="hijos1" style="display: none;">
									<label style="color: #312E33; margin-top: 10px">¿Cuantos Mayores de 18?</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 12px; height: auto;" src="../imagenes/mayor.png"></samp>
										</div>
										<input name="hijos_mayores" type="number" min="0" class=" form-control form-control-sm select2" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%" id="hijos_mayores" onKeyPress="return permite(event, 'num')" value="<?= $aDefaultForm['hijos_mayores'] ?>" size="5" maxlength="2">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="container-fluid">
					<div class="card card-default" style="border-radius: 30px; ">
						<div class="card card-info" style="border-radius: 30px; margin-top: 8px">
							<div class="card-header" style="border-radius: 30px 30px 0 0;  margin-top:-8px">
								<h3 id="informacion_id" tabindex="37" class="card-title">Otra Información</h3>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group row">
								<div class="col-sm-6">
									<label style="color: #312E33">Tipo de vehículo que posee</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp style="font-size: 13px;" class="icon-card"></samp>
										</div>
										<select aria-label="Obcionalmente puede indicar el tipo de vehículo que posee" name="cbVehiculo_afiliado" id="cbVehiculo_afiliado" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class="form-control-sm select2">
											<option value="-1">Seleccione</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<label style="color: #312E33">¿Posee Carnet de la patria?</label><span style="color: red;"> *</span>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 12px; height: auto;" src="../imagenes/carnet.png"></samp>
										</div>
										<select aria-label="Obligatoriamente debe indicar si Posee Carnet de la patria" class="form-control-sm select2" onchange="javascript:carnet()" name="carnet_patria" id="carnet_patria" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: grey">
											<option value="-1">Seleccione</option>
											<option value="1">Si</option>
											<option value="0">No</option>
										</select>
									</div>
								</div>
								<script>
									function carnet() {
										var car = document.getElementById("carnet_patria").value;
										if (car == 1) {
											let tab = document.getElementById("carnet_patria").tabIndex;
											let tab1 = tab + 1;
											let tab2 = tab + 2;
											let tab3 = tab + 3;
											document.getElementById("car1").tabIndex = 'tab1';
											document.getElementById("codigo").tabIndex = 'tab1';
											document.getElementById("car2").tabIndex = 'tab2';
											document.getElementById("serial").tabIndex = 'tab2';
											document.getElementById("obg").tabIndex = 'tab3';
											document.getElementById("observacion_datos_per_2").tabIndex = 'tab3';
											document.getElementById("car1").style.display = 'block';
											document.getElementById("car2").style.display = 'block';
										} else {
											document.getElementById("obg").tabIndex = 'tab1';
											document.getElementById("observacion_datos_per_2").tabIndex = 'tab1';
											document.getElementById("car1").style.display = 'none';
											document.getElementById("car2").style.display = 'none';
										}
									}
								</script>
								<div class="col-sm-6" id="car1" style="display: none;">
									<label style="color: #312E33; margin-top: 10px">Código del Carnet de la Patria</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp><img style="width: 12px; height: auto;" src="../imagenes/carnet.png"></samp>
										</div>
										<input aria-label="indique su Código del Carnet de la Patria" name="codigo" id="codigo" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%" class=" form-control form-control-sm" type="text" min="10" maxlength="10" onkeypress="return valideKey(event);" />
										<script type="text/javascript">
											function valideKey(evt) {

												// code is the decimal ASCII representation of the pressed key.
												var code = (evt.which) ? evt.which : evt.keyCode;

												if (code == 8) { // backspace.
													return true;
												} else if (code >= 48 && code <= 57) { // is a number.
													return true;
												} else { // other keys.
													return false;
												}
											}
										</script>
									</div>
								</div>
								<div class="col-sm-6" id="car2" style="display: none;">
									<label style="color: #312E33; margin-top: 10px">Serial del Carnet de la Patria</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp style="font-size: 13px;" class="icon-barcode"></samp>
										</div>
										<input aria-label="indique su Serial del Carnet de la Patria" name="serial" id="serial" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%" class=" form-control form-control-sm" type="text" min="10" maxlength="10" onkeypress="return valideKey2(event);" />
										<script type="text/javascript">
											function valideKey2(evt) {

												// code is the decimal ASCII representation of the pressed key.
												var code = (evt.which) ? evt.which : evt.keyCode;

												if (code == 8) { // backspace.
													return true;
												} else if (code >= 48 && code <= 57) { // is a number.
													return true;
												} else { // other keys.
													return false;
												}
											}
										</script>
									</div>
								</div>
								<div class="col-sm-12 " id="obg">
									<label style="color: #312E33; margin-top: 10px">Observaciones Generales</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
									</div>
									<textarea aria-label="en caso de que quiera agregar algo más puede llenar este campo" class="form-control" id="observacion_datos_per_2" value="<?= $aDefaultForm['observacion_datos_per'] ?>" name="Observaciones" style="border-radius: 30px" onkeyup="mayus(this);"></textarea>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-4"></div>
								<div class="col-sm-3">
									<center>
										<!-- <a href="discapacidad.php"> -->
										<input type="button" id='btnContinuar' name='btncontinuar' style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onclick="" data-bs-toggle="tooltip" value="Guardar y Continuar">
										<!-- </a> -->
									</center>
								</div>
								<div class="col-sm-2">
									<div class="col-sm-10">
										<center>
											<!-- <a href="discapacidad.php">
												<input type="button" id='btnContinuar' name='btncontinuar' style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onclick="" data-bs-toggle="tooltip" value="Siguiente">
											</a> -->
											<script src="modificar_dp.js"></script>
										</center>
									</div>
								</div>
								<div class="col-sm-3"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</form>
	<script src="mostrar_datos.js"></script>
	<script src="agregar_rs.js"></script>
	<script src="dp.js">
	</script>
	<!--script>
		function comprobar(){

			var pais_nacimiento = document.getElementById("pais_nacimiento").value;
			var hijos = document.getElementById("hijos").value;
			var carnet_patria = document.getElementById("carnet_patria").value;
			var estado_nacimiento = document.getElementById("estado_nacimiento").value;
			var telefono_personal = document.getElementById("telefono_personal");
			var correo = document.getElementById("correo");
			var jefe_familia = document.getElementById("jefe_familia").value;
			var menores = document.getElementById("menores");
			var pais_recidencia = document.getElementById("pais_recidencia").value;
			var municipio = document.getElementById("municipio").value;
			var estado = document.getElementById("estado").value;
			var parroquia = document.getElementById("parroquia").value;

			var mensaje = window.alert("Debe Rellenar Todos los Campos obligatorios (*)");

			if(pais_nacimiento == "" || hijos == "" || carnet_patria == "" || estado_nacimiento == "" || telefono_personal == "" || correo == "" || jefe_familia == "" || menores == "" || pais_recidencia == "" || municipio == "" || estado == "" || parroquia == ""){
				mensaje;
			}
			else{
				<?php /*
					// Datos Personales
					// Columna izquierda

					$pais_nacimiento = isset($_POST['pais_nacimiento']);
					$estado_civil = isset($_POST['estado_civil']);
					$telefono_habitacion = isset($_POST['telefono_habitacion']);
					$redes_sociales = isset($_POST['redes_sociales']);
					$twitter = isset($_POST['twitter']);
					$telegram = isset($_POST['telegram']);
					$otro = isset($_POST['otro']);
					$hijos = isset($_POST['hijos']);
					$mayores = isset($_POST['mayores']);
					$carnet_patria = isset($_POST['carnet_patria']);
					$serial = isset($_POST['serial']);

					// Columna Derecha 

					$estado_nacimiento = isset($_POST['estado_nacimiento']);
					$telefono_personal = isset($_POST['telefono_personal']);
					$correo = isset($_POST['correo']);
					$facebook = isset($_POST['facebook']);
					$instagram = isset($_POST['instagram']);
					$tik_tok = isset($_POST['tik_tok']);
					$jefe_familia = isset($_POST['jefe_familia']);
					$menores = isset($_POST['menores']);
					$vehiculo = isset($_POST['vehiculo']);
					$codigo = isset($_POST['codigo']);

					// Direccion de Habitacion
					//columna izquierda

					$pais_recidencia = isset($_POST['pais_recidencia']);
					$municipio = isset($_POST['municipio']);
					$sector = isset($_POST['sector']);

					//Columna Derecha

					$estado = isset($_POST['estado']);
					$parroquia = isset($_POST['parroquia']);
					$direccion = isset($_POST['direccion']);

					// Textarea
					// Punto de Referencia

					$referencia = isset($_POST['referencia']);

					// Observaciones Generales

					$observaciones = isset($_POST['observaciones']);

					//boton "Continuar"

					$boton = isset($_POST['boton']);

					$sentencia = "INSERT INTO public.personas ( pais_nacimiento_id, estado_civil_id, otro_telefono, hijos, hijos_mayores, carnet_patria, serial_carnet_patria, estado_nacimiento_id, telefono, correo, jefe_fam, hijos_menores, tipo_vehiculo_id, codigo_carnet_patria, pais_recidencia_id, municipio_id, sector, estado_recidencia, parroquia_id, direccion, observaciones) 
					VALUE (".$pais_nacimiento.", ".$estado_civil.", ".$telefono_habitacion.", ".$hijos.", ".$mayores.", ".$carnet_patria.", ".$serial.", ".$estado_nacimiento.", ".$telefono_personal.", ".$correo.", ".$jefe_familia.", ".$menores.", ".$vehiculo.", ".$codigo."; ".$pais_recidencia.", ".$municipio.", ".$sector.", ".$estado.", ".$parroquia.", ".$direccion.", ".$observaciones.");";
					$insertar = pg_query($conn, $sentencia);

					header("discapacidad.php?cedula=".$persona['cedula']);*/
				?>
			}
		}
	</script>
	<script type="text/javascript" src="../css/bootstrap5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="../js/jquery-3.6.0.min.js"></script>
	<script src="datos.js"></script-->
	</div>
	</div>
	<?/*
}
//------------------------------------------------------------------------------------------------------------------------------
function showFooter(){
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
//var_dump($ids_elementos_validar);

for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.border='1px solid Red'; </script>";
}

$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
*/ ?>

<?php
			}
			//------------------------------------------------------------------------------------------------------------------------------
			function showFooter()
			{
				$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
				//var_dump($ids_elementos_validar);

				for ($i = 0; $i < count($ids_elementos_validar); $i++) {
					echo "<script> document.getElementById('" . $ids_elementos_validar[$i] . "').style.border='1px solid Red'; </script>";
				}

				$aPageErrors = $GLOBALS['aPageErrors'];
				print (isset($aPageErrors) && count($aPageErrors) > 0) ? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '" . '\n' . join('\n', $aPageErrors) . "')</script>" : "";
			}

			include('footer.php'); ?>