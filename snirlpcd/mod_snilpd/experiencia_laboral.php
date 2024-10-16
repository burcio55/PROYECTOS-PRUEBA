<?
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn = getConnDB('sire');

$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname_recibos, $username_recibos, $password_recibos, $db4);
$conn1->debug = false;

$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = false;
$conn1->debug = false;

doAction($conn, $conn1);
debug($settings['debug'] = false);
showHeader();
showForm($conn, $aDefaultForm);
showFooter();
// DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

//OBTENER DATOS DE LA SESION Y HACER UNA CONSULTA DE LOS DATOS DEL REGUISTRO
//CONEXION CON SIRE

session_start();
include('../include/BD.php');
$conn2 = Conexion::ConexionBD();

//CONEXION CON SNIRLPCD

try {
	$conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
	$conn = $error;
	echo ("Error al conectar en la Base de Datos " . $error);
}

$cedula = substr($_SESSION["cedula"], 1);

$consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "' and benabled = 'true';");
$row = pg_query($conn, $consulta);
$persona = pg_fetch_assoc($row);

$persona_id = $persona["id"];
$ncertificado = $persona["ncertificado"];

// Consulta con la tabla "persona_discapacidad"

$discp = ("SELECT * FROM snirlpcd.persona_discapacidad WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
$row7 = pg_query($conn, $discp);
$persona7 = pg_fetch_assoc($row7);

// Validaciones de la tabla "persona_discapacidad"

$id_discapacidad = $persona7["id"];

if ($id_discapacidad == '') {
	echo '
		<script>
			alert ("Usted no ha llenado el formulario de Discapacidad");
			window.location="discapacidad.php";
		</script>
	';
	die();
} /* else {
	if ($ncertificado == "f") {
		echo '
			<script>
				alert ("Usted no está Certificado por el CONAPDIS");
				window.location="discapacidad.php";
			</script>
		';
		die();
	}
} */
//------------------------------------------------------------------------------------------------------------------------------
function debug()
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION['sesiones']);
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn, $conn1)
{
	if (isset($_POST['action'])) {
		switch ($_POST['action']) {
			case 'cbNo_tiene_changed':
				if ($_POST['cbExperiencia'] == '0') {
					$_POST['cbExperiencia'] = '0';
					$_POST['cbOcupacionG_experiencia'] = '-1';
					$_POST['cbOcupacionE_experiencia'] = '-1';
					$_POST['cbOcupacion3_experiencia'] = '-1';
					$_POST['cbOcupacion4_experiencia'] = '-1';
					$_POST['cbOcupacion5_experiencia'] = '-1';
					$_POST['cbMotivo_retiro'] = '-1';
					$_POST['cbAct_economica1'] = '-1';
					$_POST['cbAct_economica2'] = '-1';
					$_POST['cbAct_economica3'] = '-1';
					$_POST['cbAct_economica4'] = '-1';
					$_POST['patrono'] = 'No aplica';
					$_POST['rif'] = '0';
					$_POST['Telf_patrono'] = '0';
					$_POST['f_ingreso'] = '';
					$_POST['f_egreso'] = '';
					$_POST['sueldo'] = '0';
					$_POST['cbRelacion_trabajo'] = '1';
					$_POST['cbPersonal_supervisado'] = '1';
					$_POST['herramienta_trabajo'] = 'No Aplica';
					$_POST['observaciones_experiencia'] = 'No Aplica';
					$_POST['cbSector_empleo'] = '-1';
				}
				LoadData($conn, $conn1, true);
				break;

				/*case 'btRif':
			$bValidateSuccess= true;	
					
			if ($_POST['rif']!="" and !ereg ("([J?V?G?E]{1}[0-9]{9})", $_POST['rif'])) { 
			   $GLOBALS['aPageErrors'][]= "- El Rif: debe ser Comenzar con J, V, G, E seguido de Nueve digitos numericos.";
			   $bValidateSuccess=false;
			   }
			   else{ // En la BD minpptrasse dentro de rnee
					$SQL = "SELECT sdenominacion_comercial, srazon_social, snil 
						  FROM rnee.rnee_empresa 
						  WHERE srif ='".$_POST['rif']."'";				
				    $rs3 = $conn1->Execute($SQL);										
				    if ($rs3->RecordCount()>0){ 
					//	$_POST['rif']=$rs3->fields['srif'];
						$_POST['patrono']=htmlspecialchars($rs3->fields['srazon_social'], ENT_QUOTES);	
					  }
     				else{				
					$GLOBALS['aPageErrors'][]= "Esta empresa no se encuentra inscrita en el Registro Nacional de Empresas y Establecimientos.";
					$bValidateSuccess=false;
					}
						}
					
			LoadData($conn,$conn1,true);
			break;
					
			case 'cbOcupacion5_experiencia_changed':
			    LoadData($conn,$conn1,true);
				LoadOcupacion5_experiencia($conn, $param);
			break;
						
			case 'cbAct_economica4_changed':
			    LoadData($conn,$conn1,true);
				LoadAct_economica4($conn);
			break;			
			
			case 'Cancelar': 
			  unset($_POST['id_po']);
				unset($_POST['accion']);
				LoadData($conn,$conn1,false);	
			break;
			
			case 'Agregar': 
			$bValidateSuccess=true;	
			if ($_POST['cbExperiencia']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Tiene Experiencia Laboral: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbExperiencia']=="1"){
					 
			if ($_POST['patrono']==""){
					$GLOBALS['aPageErrors'][]= "- Patrono/empleador: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbAct_economica4']=="-1"){
					$GLOBALS['aPageErrors'][]= "- La Actividad Económica: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbSector_empleo']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Sector empleador: es requerido.";
					$bValidateSuccess=false;
					 }
		
			if ($_POST['f_ingreso']==""){
					$GLOBALS['aPageErrors'][]= "- Fecha de ingreso: es requerida.";
					$bValidateSuccess=false;
					 }			
					 
		    if($_POST['f_ingreso']!='' and $_POST['f_egreso']!=''){							 
				if ($_POST['f_ingreso'] > $_POST['f_egreso']){
					$GLOBALS['aPageErrors'][]= "- Fecha de ingreso y egreso: son incorrectas.";
					$bValidateSuccess=false;
				}
			 }
			 
			if ($_POST['cbOcupacionG_experiencia']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Ocupación que ha desempeñado: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbOcupacionE_experiencia']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Ocupación General: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbOcupacion3_experiencia']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Ocupación Específica: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbOcupacion4_experiencia']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Ocupación Sub Específica: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbOcupacion5_experiencia']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Ocupación Detalle: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbRelacion_trabajo']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Tipo de relación de trabajo: es requerida.";
					$bValidateSuccess=false;  
					 }
					 
			if ($_POST['sueldo']==""){  
					$GLOBALS['aPageErrors'][]= "- Sueldo mensual final ó actual (Bsf.): es requerido.";
					$bValidateSuccess=false;
					 }  
			if ($_POST['cbPersonal_supervisado']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Personal supervisado: es requerido.";
					$bValidateSuccess=false;
					 }
				}
				
			if ($bValidateSuccess){				
				ProcessForm($conn,$conn1);
				}
			
			LoadData($conn,$conn1,true);	
			break;*/



			case 'Continuar':
				$bValidateSuccess = true;

				if ($_POST['cbExperiencia'] == "0") {
					$sql = "delete  from persona_experiencia_laboral 
					where persona_id= '" . $_SESSION['id_afiliado'] . "' ";
					$rs = $conn->Execute($sql);
				}


				//sesiones curriculum
				$nNumSeccion = 6;
				$sSQL = "SELECT sesiones FROM personas where id = " . $_SESSION['id_afiliado'];
				$rs = $conn->Execute($sSQL);

				if ($rs) {
					if ($rs->RecordCount() > 0) {
						$rs->fields['sesiones'][$nNumSeccion - 1] = 1;
						$sSQL = "update personas set sesiones = '" . $rs->fields['sesiones'] . "' where id = " . $_SESSION['id_afiliado'];
						$rs = $conn->Execute($sSQL);
					}
				}
				unset($_POST['id_po']);
				unset($_POST['accion']);
?><script>
					document.location = '1_10agen_trab_participacion.php'
				</script><?
							break;
					}
				} else {
					LoadData($conn, $conn1, false);
				}
			}
			//------------------------------------------------------------------------------
			function LoadData($conn, $conn1, $bPostBack)
			{
				if (count($GLOBALS['aDefaultForm']) == 0) {
					$aDefaultForm = &$GLOBALS['aDefaultForm'];

					$_POST['edit'] = '';
					$aDefaultForm['rif'] = '';
					$aDefaultForm['patrono'] = '';
					$_POST['cbAct_economica4'] = '-1';
					$_POST['cbAct_economica3'] = '-1';
					$_POST['cbAct_economica2'] = '-1';
					$_POST['cbAct_economica1'] = '-1';
					$aDefaultForm['cbSector_empleo'] = '-1';
					$aDefaultForm['Telf_patrono'] = '';
					$aDefaultForm['f_ingreso'] = '';
					$aDefaultForm['f_egreso'] = '';
					$aDefaultForm['cbOcupacion5_experiencia'] = '-1';
					$aDefaultForm['cbOcupacion4_experiencia'] = '-1';
					$aDefaultForm['cbOcupacion3_experiencia'] = '-1';
					$aDefaultForm['cbOcupacionE_experiencia'] = '-1';
					$aDefaultForm['cbOcupacionG_experiencia'] = '-1';
					$aDefaultForm['cbRelacion_trabajo'] = '-1';
					$aDefaultForm['cbMotivo_retiro'] = '-1';
					$aDefaultForm['sueldo'] = '';
					$aDefaultForm['cbPersonal_supervisado'] = '-1';
					$aDefaultForm['herramienta_trabajo'] = '';
					$aDefaultForm['observaciones_experiencia'] = '';
					$aDefaultForm['act_eco'] = '';
					$aDefaultForm['ocupacion'] = '';
					$aDefaultForm['cbExperiencia'] = '-1';
					unset($_SESSION['aTabla']);

					if (!$bPostBack) {
						if ($_GET['accion'] != '') $_POST['accion'] = $_GET['accion'];
						if ($_GET['id_po'] != '') $_POST['id_po'] = $_GET['id_po'];

						if ($_POST['accion'] == '1') {
							$_POST['edit'] = '1';
							$SQL2 = "SELECT persona_experiencia_laboral.*,personas.sesiones
						from persona_experiencia_laboral 
						INNER JOIN personas ON personas.id=persona_experiencia_laboral.persona_id 
						INNER JOIN motivo_retiro ON motivo_retiro.id=persona_experiencia_laboral.motivo_retiro_id 
						INNER JOIN sector_empleo ON sector_empleo.id=persona_experiencia_laboral.sector_empleo_id 
where persona_id ='" . $_SESSION['id_afiliado'] . "' and cedula='" . $_SESSION['ced_afiliado'] . "' and persona_experiencia_laboral.id ='" . $_POST['id_po'] . "'";
							$rs = $conn->Execute($SQL2);
							if ($rs->RecordCount() > 0) {
								$aDefaultForm['rif'] = $rs->fields['rif'];
								$aDefaultForm['patrono'] = $rs->fields['patrono'];
								$aDefaultForm['cbSector_empleo'] = $rs->fields['sector_empleo_id'];
								$aDefaultForm['Telf_patrono'] = $rs->fields['telefono'];
								if ($rs->fields['f_ingreso'] == '0000-00-00') {
									$aDefaultForm['f_ingreso'] = '';
								} else {
									$aDefaultForm['f_ingreso'] = $rs->fields['f_ingreso'];
								}
								if ($rs->fields['f_egreso'] == '0000-00-00') {
									$aDefaultForm['f_egreso'] = '';
								} else {
									$aDefaultForm['f_egreso'] = $rs->fields['f_egreso'];
								}

								$aDefaultForm['cbAct_economica4'] = $rs->fields['act_economica4'];
								$aDefaultForm['cbOcupacion5_experiencia'] = $rs->fields['ocupacion5'];

							?>
					<script language="javascript" src="../js/jquery.js"></script>
					<script>
						$(document).ready(function() {
							elegido = "<?php echo $rs->fields['act_economica4']; ?>";
							combo = "Actividad";
							$.post("modelo.php", {
									elegido: elegido,
									combo: combo,
									seleccionado: "<?php echo $rs->fields['act_economica3']; ?>"
								},
								function(data) {
									$("#cbAct_economica3").html(data);
								});
						});

						$(document).ready(function() {
							elegido = "<?php echo $rs->fields['act_economica3']; ?>";
							combo = "Actividad";
							$.post("modelo.php", {
									elegido: elegido,
									combo: combo,
									seleccionado: "<?php echo $rs->fields['act_economica2']; ?>"
								},
								function(data) {
									$("#cbAct_economica2").html(data);
								});
						});

						$(document).ready(function() {
							elegido = "<?php echo $rs->fields['act_economica2']; ?>";
							combo = "Actividad";
							$.post("modelo.php", {
								elegido: elegido,
								combo: combo,
								seleccionado: "<?php echo $rs->fields['act_economica1']; ?>"
							}, function(data) {
								$("#cbAct_economica1").html(data);
							});
						});

						$(document).ready(function() {
							elegido = "<?php echo $rs->fields['ocupacion5']; ?>";
							combo = "Ocupacion";
							$.post("modelo.php", {
									elegido: elegido,
									combo: combo,
									seleccionado: "<?php echo $rs->fields['ocupacion4']; ?>"
								},
								function(data) {
									$("#cbOcupacion4_experiencia").html(data);
								});
						});

						$(document).ready(function() {
							elegido = "<?php echo $rs->fields['ocupacion4']; ?>";
							combo = "Ocupacion";
							$.post("modelo.php", {
									elegido: elegido,
									combo: combo,
									seleccionado: "<?php echo $rs->fields['ocupacion3']; ?>"
								},
								function(data) {
									$("#cbOcupacion3_experiencia").html(data);
								});
						});

						$(document).ready(function() {
							elegido = "<?php echo $rs->fields['ocupacion3']; ?>";
							combo = "Ocupacion";
							$.post("modelo.php", {
									elegido: elegido,
									combo: combo,
									seleccionado: "<?php echo $rs->fields['ocupacione_id']; ?>"
								},
								function(data) {
									$("#cbOcupacionE_experiencia").html(data);
								});
						});

						$(document).ready(function() {
							elegido = "<?php echo $rs->fields['ocupacione_id'] ?>";
							combo = "Ocupacion";
							$.post("modelo.php", {
									elegido: elegido,
									combo: combo,
									seleccionado: "<?php echo $rs->fields['ocupaciong_id']; ?>"
								},
								function(data) {
									$("#cbOcupacionG_experiencia").html(data);
								});
						});
					</script>
			<?php

								$aDefaultForm['cbRelacion_trabajo'] = $rs->fields['relacion_trabajo'];
								$aDefaultForm['cbMotivo_retiro'] = $rs->fields['motivo_retiro_id'];
								$aDefaultForm['sueldo'] = $rs->fields['sueldo_final'];
								$aDefaultForm['cbPersonal_supervisado'] = $rs->fields['personal_supervisado'];
								$aDefaultForm['herramienta_trabajo'] = $rs->fields['equipos_herramientas'];
								$aDefaultForm['observaciones_experiencia'] = $rs->fields['descripcion_empleo'];
								$_SESSION['sesiones'] = $rs1->fields['sesiones'];
							}
						}

						if ($_POST['accion'] == '2') {
							$sql = "delete  from persona_experiencia_laboral 
					where id='" . $_POST['id_po'] . "' and persona_id= '" . $_SESSION['id_afiliado'] . "' ";
							$rs = $conn->Execute($sql);
							unset($_POST['id_po']); //Trazas--------------------------------------------------------------------------------------------------------------------------
							$id = $_SESSION['id_afiliado'];
							$identi = $_SESSION['ced_afiliado'];
							$us = $_SESSION['sUsuario'];
							$mod = '8';
							$auditoria = new Trazas;
							$auditoria->auditor($id, $identi, $sql, $us, $mod);
						}
					} else {
						$aDefaultForm['rif'] = $_POST['rif'];
						$aDefaultForm['patrono'] = $_POST['patrono'];
						$aDefaultForm['cbSector_empleo'] = $_POST['cbSector_empleo'];
						$aDefaultForm['Telf_patrono'] = $_POST['Telf_patrono'];
						$aDefaultForm['f_ingreso'] = $_POST['f_ingreso'];
						$aDefaultForm['f_egreso'] = $_POST['f_egreso'];
						$aDefaultForm['cbRelacion_trabajo'] = $_POST['cbRelacion_trabajo'];
						$aDefaultForm['cbMotivo_retiro'] = $_POST['cbMotivo_retiro'];
						$aDefaultForm['sueldo'] = $_POST['sueldo'];
						$aDefaultForm['cbPersonal_supervisado'] = $_POST['cbPersonal_supervisado'];
						$aDefaultForm['herramienta_trabajo'] = $_POST['herramienta_trabajo'];
						$aDefaultForm['observaciones_experiencia'] = $_POST['observaciones_experiencia'];
						$aDefaultForm['act_eco'] = $_POST['act_eco'];
						$aDefaultForm['ocupacion'] = $_POST['ocupacion'];
						$aDefaultForm['cbExperiencia'] = $_POST['cbExperiencia'];
						$aDefaultForm['cbAct_economica4'] = $_POST['cbAct_economica4'];
						$aDefaultForm['cbOcupacion5_experiencia'] = $_POST['cbOcupacion5_experiencia'];
			?>
			<script language="javascript" src="../js/jquery.js"></script>
			<script>
				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbAct_economica4']; ?>";
					combo = "Actividad";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbAct_economica3']; ?>"
						},
						function(data) {
							$("#cbAct_economica3").html(data);
						});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbAct_economica3']; ?>";
					combo = "Actividad";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbAct_economica2']; ?>"
						},
						function(data) {
							$("#cbAct_economica2").html(data);
						});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbAct_economica2']; ?>";
					combo = "Actividad";
					$.post("modelo.php", {
						elegido: elegido,
						combo: combo,
						seleccionado: "<?php echo $_POST['cbAct_economica1']; ?>"
					}, function(data) {
						$("#cbAct_economica1").html(data);
					});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbOcupacion5_experiencia']; ?>";
					combo = "Ocupacion";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbOcupacion4_experiencia']; ?>"
						},
						function(data) {
							$("#cbOcupacion4_experiencia").html(data);
						});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbOcupacion4_experiencia']; ?>";
					combo = "Ocupacion";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbOcupacion3_experiencia']; ?>"
						},
						function(data) {
							$("#cbOcupacion3_experiencia").html(data);
						});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbOcupacion3_experiencia']; ?>";
					combo = "Ocupacion";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbOcupacionE_experiencia']; ?>"
						},
						function(data) {
							$("#cbOcupacionE_experiencia").html(data);
						});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbOcupacionE_experiencia'] ?>";
					combo = "Ocupacion";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbOcupacionG_experiencia']; ?>"
						},
						function(data) {
							$("#cbOcupacionG_experiencia").html(data);
						});
				});
			</script>
		<?php

					}

					$SQL1 = "select persona_experiencia_laboral.id, persona_experiencia_laboral.patrono, persona_experiencia_laboral.f_ingreso,
					persona_experiencia_laboral.f_egreso, ocupacion.nombre as ocupacione, personas.experiencia_laboral, rif			
					from persona_experiencia_laboral  
					left JOIN personas ON personas.id=persona_experiencia_laboral.persona_id 
					left JOIN ocupacion ON ocupacion.cod=persona_experiencia_laboral.ocupacion5 
					INNER JOIN motivo_retiro ON motivo_retiro.id=persona_experiencia_laboral.motivo_retiro_id 
					INNER JOIN sector_empleo ON sector_empleo.id=persona_experiencia_laboral.sector_empleo_id 
					where persona_id ='" . $_SESSION['id_afiliado'] . "' and cedula='" . $_SESSION['ced_afiliado'] . "'
					order by persona_experiencia_laboral.f_egreso desc";
					$rs1 = $conn->Execute($SQL1);
					$ocupacione_id = $rs1->fields['ocupacione_id'];

					if ($rs1->RecordCount() > 0) {
						$aDefaultForm['cbExperiencia'] = $rs1->fields['experiencia_laboral'];
						$aTabla = array();
						while (!$rs1->EOF) {
							$c = count($aTabla);
							$aTabla[$c]['id'] = $rs1->fields['id'];
							$aTabla[$c]['ocupacione'] = $rs1->fields['ocupacione'];
							$aTabla[$c]['patrono'] = $rs1->fields['patrono'];
							$aTabla[$c]['rif'] = $rs1->fields['rif'];
							$aTabla[$c]['f_ingreso'] = $rs1->fields['f_ingreso'];
							$rs1->MoveNext();
						}
						$_SESSION['aTabla'] = $aTabla;
					}
				}
			}

			//------------------------------------------------------------------------------------------------------------------------------
			function ProcessForm($conn)
			{
				$sfecha = date('Y-m-d');
				if ($_POST['f_ingreso'] == '') $_POST['f_ingreso'] = '0000-00-00';
				if ($_POST['f_egreso'] == '') $_POST['f_egreso'] = '0000-00-00';

				//--------------------------------------------------------------------------actualizar------------------------------------------	
				if ($_POST['edit'] == '1') { //Si Edit tiene el valor de 1 hacer un update en la table persona_experiencia_laboral	

					if ($_POST['f_ingreso'] == '') $_POST['f_ingreso'] = '0000-00-00';
					if ($_POST['f_egreso'] == '') $_POST['f_egreso'] = '0000-00-00';
					$sql = "update persona_experiencia_laboral set 
				  rif='" . $_POST['rif'] . "',
				  patrono='" . $_POST['patrono'] . "',				 
				  sector_empleo_id='" . $_POST['cbSector_empleo'] . "',
				  act_economica4='" . $_POST['cbAct_economica4'] . "',
				  act_economica3='" . $_POST['cbAct_economica3'] . "',
				  act_economica2='" . $_POST['cbAct_economica2'] . "',
				  act_economica1='" . $_POST['cbAct_economica1'] . "',
				  telefono='" . $_POST['Telf_patrono'] . "',
				  f_ingreso='" . $_POST['f_ingreso'] . "',
				  f_egreso='" . $_POST['f_egreso'] . "',
				  ocupacion5='" . $_POST['cbOcupacion5_experiencia'] . "',
				  ocupacion4='" . $_POST['cbOcupacion4_experiencia'] . "',
				  ocupacion3='" . $_POST['cbOcupacion3_experiencia'] . "',
				  ocupacione_id='" . $_POST['cbOcupacionE_experiencia'] . "', 
				  ocupaciong_id='" . $_POST['cbOcupacionG_experiencia'] . "',
				  relacion_trabajo='" . $_POST['cbRelacion_trabajo'] . "',
				  motivo_retiro_id='" . $_POST['cbMotivo_retiro'] . "',				
				  sueldo_final='" . $_POST['sueldo'] . "',
				  personal_supervisado='" . $_POST['cbPersonal_supervisado'] . "',
				  equipos_herramientas='" . $_POST['herramienta_trabajo'] . "',
				  descripcion_empleo='" . $_POST['observaciones_experiencia'] . "',
					updated_at='" . $sfecha . "',
					status='A',
					id_update='" . $_SESSION['sUsuario'] . "'
					WHERE id='" . $_POST['id_po'] . "' and persona_id= '" . $_SESSION['id_afiliado'] . "' ";
					$conn->Execute($sql);
				}

				//--------------------------------------------------agregar---------------------------------------				
				else {

					$existe = ''; // Si existe no vale nada hace un select solo del id con condiciones
					//----------------------------------------------verifica si existe-----------------------------			
					$SQL2 = "SELECT id from persona_experiencia_laboral
						where persona_id  ='" . $_SESSION['id_afiliado'] . "'
							and rif ='" . $_POST['rif'] . "'";

					$rs = $conn->Execute($SQL2);
					if ($rs->RecordCount() > 0) {	 // Cuenta cuantos valores contiene y si supera 0 (Si existe el registro) pasa 
						$existe = '1'; // Le dan el valor de 1 a existe y le dicen que ya hay un registro en el sistema con esos valores
		?><script>
				alert("- Ya Existe un Registro de Experiencia Laboral con este Rif");
			</script><?
					} else { // En caso contrario a lo de arriba 
						?><script>
				alert("- Por favor Registre los Datos de Experinacia Laboral de este Rif");
			</script><?
					}
					// En caso de que Existe le asignaran el valor de 0 hace un Insert de todos los datos
					if ($existe == '') {

						$sql = "insert into public.persona_experiencia_laboral
		 		( persona_id, rif, patrono, sector_empleo_id, act_economica4, act_economica3, act_economica2, act_economica1,telefono,
				  f_ingreso, f_egreso,ocupacion5,ocupacion4,ocupacion3,ocupacione_id,ocupaciong_id,relacion_trabajo,motivo_retiro_id,
				  sueldo_final, personal_supervisado,equipos_herramientas, descripcion_empleo,created_at, status, id_update) 
				  values
			  	('" . $_SESSION['id_afiliado'] . "',
				 '" . $_POST['rif'] . "',
				 '" . $_POST['patrono'] . "',
				 '" . $_POST['cbSector_empleo'] . "',
				 '" . $_POST['cbAct_economica4'] . "', 
				 '" . $_POST['cbAct_economica3'] . "', 
				 '" . $_POST['cbAct_economica2'] . "',  
				 '" . $_POST['cbAct_economica1'] . "',
				 '" . $_POST['Telf_patrono'] . "',
				 '" . $_POST['f_ingreso'] . "',
				 '" . $_POST['f_egreso'] . "',
				 '" . $_POST['cbOcupacion5_experiencia'] . "', 
				 '" . $_POST['cbOcupacion4_experiencia'] . "', 
				 '" . $_POST['cbOcupacion3_experiencia'] . "', 
				 '" . $_POST['cbOcupacionE_experiencia'] . "', 
				 '" . $_POST['cbOcupacionG_experiencia'] . "',
				 '" . $_POST['cbRelacion_trabajo'] . "',
				 '" . $_POST['cbMotivo_retiro'] . "', 
				 '" . $_POST['sueldo'] . "',				
				 '" . $_POST['cbPersonal_supervisado'] . "',	
				 '" . $_POST['herramienta_trabajo'] . "',
				 '" . $_POST['observaciones_experiencia'] . "', 			 
			  	 '$sfecha',
			   	 'A',
			   	 '" . $_SESSION['sUsuario'] . "')";
						$conn->Execute($sql);
					}
				}
				//Trazas------------------------------------------------------------------------------------------------------------------------
				$id = $_SESSION['id_afiliado'];
				$identi = $_SESSION['ced_afiliado'];
				$us = $_SESSION['sUsuario'];
				$mod = '8';
				$auditoria = new Trazas;
				$auditoria->auditor($id, $identi, $sql, $us, $mod);
				//-----------------------------------------------------------------------------------------------------------------------------
				$sql = "update personas set 
				  experiencia_laboral = '" . $_POST['cbExperiencia'] . "',
				  status = 'A',
				  updated_at = '" . $sfecha . "',
				  id_update ='" . $_SESSION['sUsuario'] . "'
				  WHERE id= '" . $_SESSION['id_afiliado'] . "' and cedula='" . $_SESSION['ced_afiliado'] . "'";
				$conn->Execute($sql);

				unset($_POST['id_po']);
				unset($_POST['accion']);
				LoadData($conn, false);
			}
			//-----------------------------------Rif---------------------------------------------------------------------------------------
			function buscar($rif, $conn)
			{ //Se encarga de buscar los datos en la tabla persona_esperincia_laboral (Báse de datos Sire)
				$sql = "SELECT rif, patrono, sector_empleo_id, actividad_economica1, telefono, ocupacione_id, f_ingreso, f_egreso
	 from persona_experiencia_laboral where rif ='" . $rif . "';";
				$rs1 = $conn->Execute($sql); // Ejecuta la consulta
				$GLOBALS['rif'] = 0;
				$GLOBALS['patrono'] = 0;
				if ($rs1->RecordCount() > 0) { //Si $rs1 trae valores los muestra en sus respectivos input y select valiendose del javascript
					$GLOBALS['rif'] = $rs1->fields['0'];
					$GLOBALS['patrono'] = $rs1->fields['1'];
						?>
		<script>
			//document.getElementById("rif").value= "<? //echo $rs1->fields['0'];
														?>"
			//document.getElementById("patrono").value= "<? //echo $rs1->fields['1'];
															?>"
			//document.getElementById("cbSector_empleo").value= <? //echo $rs1->fields['2'];
																?>
			//document.getElementById("cbAct_economica4").value= <? //echo $rs1->fields['3'];
																	?>
			//document.getElementById("Telf_patrono").value= <? //echo $rs1->fields['4'];
																?>
		</script>
	<?
				} else {
	?>
		<script>
			alert(" No se ha encontrado los Datos en la Báse de Datos ");
		</script>
	<?
				} ?>
	<script>
		alert("Entro");
	</script><?
			}
			//------------------------------------------------------------------------------------------------------------------------------
			function showHeader()
			{
				include('header.php');
				echo '<br>';
				include('menu_trabajador.php');
			}
			//------------------------------------------------------------------------------------------------------------------------------
			function showForm($conn, &$aDefaultForm)
			{
				?>
	<!--style type="text/css">
.Estilo12 {color: #030303}
</style>
<form name="frm_experiencia" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" -->
	<script language="javascript">
		//Actividad economica 
		$(document).ready(function() {
			$("#cbAct_economica4").change(function() {
				$("#cbAct_economica4 option:selected").each(function() {
					elegido = $(this).val();
					combo = 'Actividad';
					$.post("modelo.php", {
						elegido: elegido,
						combo: combo
					}, function(data) {
						//alert(data);
						$("#cbAct_economica3").html(data);
					});
				});
			})
		});

		$(document).ready(function() {
			$("#cbAct_economica3").change(function() {
				$("#cbAct_economica3 option:selected").each(function() {
					elegido = $(this).val();
					combo = 'Actividad';
					$.post("modelo.php", {
						elegido: elegido,
						combo: combo
					}, function(data) {
						$("#cbAct_economica2").html(data);
					});
				});
			})
		});

		$(document).ready(function() {
			$("#cbAct_economica2").change(function() {
				$("#cbAct_economica2 option:selected").each(function() {
					elegido = $(this).val();
					combo = 'Actividad';
					$.post("modelo.php", {
						elegido: elegido,
						combo: combo
					}, function(data) {
						$("#cbAct_economica1").html(data);
					});
				});
			})
		});


		$(document).ready(function() {
			$("#cbOcupacion5_experiencia").change(function() {
				$("#cbOcupacion5_experiencia option:selected").each(function() {
					elegido = $(this).val();
					combo = 'Ocupacion';
					$.post("modelo.php", {
						elegido: elegido,
						combo: combo
					}, function(data) {
						//alert(data);
						$("#cbOcupacion4_experiencia").html(data);
					});
				});
			})
		});

		$(document).ready(function() {
			$("#cbOcupacion4_experiencia").change(function() {
				$("#cbOcupacion4_experiencia option:selected").each(function() {
					elegido = $(this).val();
					combo = 'Ocupacion';
					$.post("modelo.php", {
						elegido: elegido,
						combo: combo
					}, function(data) {
						$("#cbOcupacion3_experiencia").html(data);
					});
				});
			})
		});

		$(document).ready(function() {
			$("#cbOcupacion3_experiencia").change(function() {
				$("#cbOcupacion3_experiencia option:selected").each(function() {
					elegido = $(this).val();
					combo = 'Ocupacion';
					$.post("modelo.php", {
						elegido: elegido,
						combo: combo
					}, function(data) {
						$("#cbOcupacionE_experiencia").html(data);
					});
				});
			})
		});

		$(document).ready(function() {
			$("#cbOcupacionE_experiencia").change(function() {
				$("#cbOcupacionE_experiencia option:selected").each(function() {
					elegido = $(this).val();
					combo = 'Ocupacion';
					$.post("modelo.php", {
						elegido: elegido,
						combo: combo
					}, function(data) {
						$("#cbOcupacionG_experiencia").html(data);
					});
				});
			})
		});
	</script>

	<script>
		function send(saction) {
			if (saction == 'Agregar' || saction == 'Actualizar') {
				if (validar_frm_experiencia() == true) {
					var form = document.frm_experiencia;
					form.action.value = saction;
					form.submit();
				}

			} else {
				var form = document.frm_experiencia;
				form.action.value = saction;
				form.submit();
			}
		}
	</script>
	<!--input name="action" type="hidden" value=""/>
	<input name="edit" type="hidden" value="<?= $_POST['edit'] ?>" /> 
	<input name="id_po" type="hidden" value="<?= $_POST['id_po'] ?>" /> 
	<input name="accion" type="hidden" value="<?= $_POST['accion'] ?>" /-->

	<!-- Body nuevo Bootstrap 4 -->

	<body class="hold-transition sidebar-mini">
		<div class="content-video2 video">
			<video src="../videos/video_experinecia_laboral.mp4" class="video" controls>
				<!-- <source src="videos/video_prueba.mp4" type="video/mp4"> -->
			</video>
		</div>
		<div class="wrapper">
			<section class="content">
				<div class="container-fluid">
					<div class="card card-primary" style="border-radius: 30px;">
						<div class="card-header" style="border-radius: 30px;">
							<h3 tabindex="7" aria-label="Experiencia Laboral" class="card-title"> Experiencia Laboral</h3>
						</div>
					</div>
					<div class="card card-info" style="border-radius: 30px;">
						<div class="card-header" style="border-radius: 30px 30px 0 0;">
							<h3 tabindex="8" aria-label="Información de Experiencia Laboral" class="card-title"> Información de Experiencia Laboral </h3>
						</div>
						<div style="padding: 10px; text-align: right; margin-bottom: -25px">
							<h4 style="color: #BF1F13; font-size: 15px;">Campos obligatorios (*)</h4>
						</div>
						<form class="form-horizontal">
							<div class="card-body">
								<div class="form-group row">
									<div class="col-sm-12 ">
										<center>
											<div class="col-sm-7">
												<div class="col-sm-7">
													<label style="color: #312E33">¿Tiene Experiencia Laboral? <span style="color: red;"> *</span></label>
													<div style="flex: 1 1 auto; width: 1%; min-width: 0; position: absolute; margin-right: -40px;">
														<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
															<samp><img style="width: 14px; height: auto;" src="../imagenes/experiencia.png"></samp>
														</div>
													</div>
													<select id="cbExperiencia" tabindex="9" aria-label="es obligatorio seleccionar si Tiene Experiencia Laboral" name="cbExperiencia" onChange="javascript:Selec()" style="border-radius: 0 15px 15px 0; margin: 0 0 0 30px; width: 110%; border: 1px solid #ccc; color: gray" class=" form-control-sm select2">
														<option value="" <? if (($aDefaultForm['cbExperiencia']) == '-1') print 'selected="selected"'; ?>>Seleccione</option>
														<option value="1" <? if (($aDefaultForm['cbExperiencia']) == '1') print 'selected="selected"'; ?>>Si</option>
														<option value="2" <? if (($aDefaultForm['cbExperiencia']) == '2') print 'selected="selected"'; ?>>No</option>
													</select>
												</div>
											</div>
										</center>
									</div>
									<script>
										function Selec() {
											var fader = document.getElementById("cbExperiencia").value;
											if (fader == 1) {
												document.getElementById("b1").style.display = 'none';
												document.getElementById("op1").style.display = 'block';
												document.getElementById("tr_experiencia2").style.display = 'block';
											} else {
												document.getElementById("b1").style.display = 'block';
												document.getElementById("op1").style.display = 'none';
												document.getElementById("tr_experiencia2").style.display = 'none';
											}
										}
									</script>
									<div class="col-sm-8" id="b1" style="display: block;">
										<br>
										<center>
											<div tabindex="11" aria-label="Guardar y continuar" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px; margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit" onclick="agregar(cbExperiencia.value,rif.value,patrono.value,cbSector_empleo.value,cbAct_economica4.value,Telf_patrono.value,ocupacion.value,f_ingreso.value,cbRelacion_trabajo.value,f_egreso.value,Otra_habilidad.value)" onkeypress="agregar(cbExperiencia.value,rif.value,patrono.value,cbSector_empleo.value,cbAct_economica4.value,Telf_patrono.value,ocupacion.value,f_ingreso.value,cbRelacion_trabajo.value,f_egreso.value,Otra_habilidad.value)">Guardar y Continuar</div>
											<a href="situacion_ocupacional.php">
												<div tabindex="10" aria-label="Regresar" style="background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px;margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit">Regresar</div>
											</a>
										</center>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
			<section class="content" id="op1" style="display: none;">
				<div class="container-fluid">
					<div class="card card-info" style="border-radius: 30px;">
						<div class="card-header" style="border-radius: 30px 30px 0 0;">
							<h3 tabindex="10" aria-label="Entidad de Trabajo" class="card-title"> Entidad de Trabajo </h3>
						</div>
						<form class="form-horizontal">
							<div class="card-body">
								<div class="form-group row">
									<div style="display: none;"><input type="text" id="id_esperiencia"></div>
									<div class="col-sm-6" tabindex="11" id="cont_rif">
										<label style="color: #312E33">Registro de Información Fiscal (RIF)</label><!-- <span style="color: red;"> *</span> Toca la BD minpptrasse como srif-->
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 14px; height: auto;" src="../imagenes/i.png"></samp>
											</div>
										</div>
										<span class="form-control form-control-sm select2" style="padding: 0 10px; width: 31px; display: block; margin: -31px 0 0 29px;">V</span>
										<!-- Ejemplo valores JQuery -->
										<!--script>
											$(function(){
												var number = "10552456";
												$('#Telf_patrono') .val(number);
											});
										</script-->
										<input tabindex="11" aria-label="es opcional escribir el rif de la empresa donde trabajó" name="rif" type="text" placeholder="Ej. 123456789" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 59px; width: 89%; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm select2" id="rif" value="" size="20" maxlength="9" onkeyup="mayus(this);">
									</div>
									<div class="col-sm-6" tabindex="12">
										<label style="color: #312E33">Nombre o Razón Social de la Entidad de Trabajo</label><span style="color: red;"> *</span> <!-- Toca la BD minpptrasse como srazon_social -->
										<div class="input-group">
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 7px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp style="font-size: 13px;" class="icon-book-open"></samp>
											</div>
											<input tabindex="12" aria-label="Es obligatorio escribir Nombre de la Entidad de Trabajo" name="patrono" type="text" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="patrono" value="" size="50" maxlength="100" onkeyup="mayus(this);">
										</div>
									</div>
									<!--		<div class="col-sm-12">
										<center>
											<button type="button" name="btRif"  id="btnRif" class="btn btn-outline-primary">Buscar</button>
										</center>
										<script> 
											$("#btnRif").on("click",function()
											{// Si le dan al Boton buscar (3 líneas arriba) ejecuta la función rif(Se encuantra modelo.php)
												elegido = $("#rif").val(),
												combo = 'rif';
												//alert("hola todos");
												data=
												{
													elegido:elegido
													,combo:combo
												}
												$.ajax( 
												{
													url:'modelo.php',
													data:data,
													type:'POST',
													success: function(data)
													{
														if(data == ""){
															alert("No se ha Encontrado Información en la Báse de Datos");
														}else{
															//data=jquery(data.replace('/hr/',''))
															//data=data.replace(/(<([^>]+)>)/ig,'');
															data=data.replace(/.*nbsp;/ig,'');
															data=data.replace(/(<([^>]+)>)/ig,'');
															//data=data.replace(/\W*/ig,'');
															//alert(data);
															$("#patrono").val(data);
															//$("#cbSector_empleo").val() = data[2];
															//$("#cbAct_economica4").val() = data[3];
															//$("#Telf_patrono").val() = data[4];
														}
														//Roberto:Si quieres, genera un arreglo con lo que retorna data
													}
													//alert('data');
													// if(data == "")
													// {
													// 	alert("No se ha Encontrado Información en la Báse de Datos");
													// }else{
													// 	$("#rif").val(data[0]);
													// 	$("#patrono").val(data[1]);
													// 	console.log(data);
													// 	alert(data + " <- Esta es la información de la variable Data");
													// 	//$("#cbSector_empleo").val() = data[2];
													// 	//$("#cbAct_economica4").val() = data[3];
													// 	//$("#Telf_patrono").val() = data[4];
													// }
												});

/* 												$.POST("modelo.php", 
												{ elegido:elegido, combo:combo },function(data)
												{
													//event.preventDefault();
													alert('data');
													// if(data == "")
													// {
													// 	alert("No se ha Encontrado Información en la Báse de Datos");
													// }else{
													// 	$("#rif").val(data[0]);
													// 	$("#patrono").val(data[1]);
													// 	console.log(data);
													// 	alert(data + " <- Esta es la información de la variable Data");
													// 	//$("#cbSector_empleo").val() = data[2];
													// 	//$("#cbAct_economica4").val() = data[3];
													// 	//$("#Telf_patrono").val() = data[4];
													// }
												});
 */											});
										</script>
									</div>-->

									<!-- Columna 1 Izquierda -->

									<div class="col-sm-6 ">
										<div class="col-sm-12">
											<label style="color: #312E33; margin-top: 10px;"> Sector Empleador </label>
											<div>
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp><img style="width: 14px; height: auto;" src="../imagenes/empleo.png"></samp>
												</div>
												<select tabindex="13" aria-label="Es opcional seleccionar el sector empleador" name="cbSector_empleo" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 96%; border: 1px solid #ccc; color: gray" class="form-control-sm select2" id="cbSector_empleo">
													<option value="-1" selected="selected">Seleccione</option>
													<? LoadSector_empleo($conn);
													print $GLOBALS['sHtml_cb_Sector_empleo']; ?>
												</select>
											</div>
										</div>
										<div class="col-sm-12">
											<label style="color: #312E33; margin-top: 10px;"> Actividad Económica</label><!--<span style="color: red;"> *</span>-->
											<div>
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp><img style="width: 14px; height: auto;" src="../imagenes/incrementar.png"></samp>
												</div>
												<select tabindex="15" aria-label="Es opcional seleccionar la actividad económica" name="cbAct_economica4" id="cbAct_economica4" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 96%; border: 1px solid #ccc; color: gray" class="form-control-sm select2">
													<option value="-1" selected="selected">Seleccione</option>
													<? LoadAct_economica4($conn);
													print $GLOBALS['sHtml_cb_Act_economica4']; ?>
												</select>
											</div>
										</div>
										<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Actividad Económica Específica *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
												<select name="cbAct_economica3" id="cbAct_economica3" style="border-radius: 15px;" class=" form-control form-control-sm select2">
													<option value="">Seleccionar</option>
												</select>
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Actividad Económica *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
												<select name="cbAct_economica1" id="cbAct_economica1" style="border-radius: 15px;" class=" form-control form-control-sm select2" title="Actividad economica - Seleccione solo una opcion del listado">
													<option value="-1">Seleccionar</option>
												</select>
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Duración *</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 7px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="far fa-clock"></samp>
												</div>
												<input name="Duracion_curso" type="text" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="Duracion_curso" onKeyPress="return permite(event, 'num')" value="<?= $aDefaultForm['Duracion_curso'] ?>" size="10" maxlength="4">
											</div>
										</div-->
									</div>

									<!-- Columna 2 Derecha -->

									<div class="col-sm-6">
										<div class="col-sm-12" tabindex="14">
											<label style="color: #312E33; margin-top: 10px;">Teléfono de Contacto</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 7px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp style="font-size: 13px;" class="icon-phone"></samp>
												</div>
												<input tabindex="14" aria-label="Es opcional escribir el número de contacto" name="Telf_patrono" type="text" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="Telf_patrono" value="" maxlength="11" onkeypress="return permite(event, 'num')">
											</div>
										</div>
										<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Actividad Económica General *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
												<select name="cbAct_economica2" id="cbAct_economica2" style="border-radius: 15px;" class=" form-control form-control-sm select2" title="Actividad economica General - Seleccione solo una opcion del listado">
													<option value="-1">Seleccionar</option>
												</select>
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Teléfono</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
												<input name="Telf_patrono" type="text" style="border-radius: 15px;" class=" form-control form-control-sm select2" id="Telf_patrono" onkeypress="return permite(event, 'num')" value="<?= $aDefaultForm['Telf_patrono'] ?>" size="15" maxlength="11">
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Fecha de Realización</label>
											<div class="input-group" >
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="far fa-calendar-alt"></samp>
												</div>
												<input name="f_Duracion_curso" type="date" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="f_Duracion_curso" value="<?= $aDefaultForm['f_Duracion_curso'] ?>" size="10">
											</div>
										</div-->
									</div>
									<!--div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px;"> Observaciones Generales</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<textarea class="form-control" id="Observaciones_curso" value="<?= $aDefaultForm['Observaciones_curso'] ?>" type="text" value="<?= $aDefaultForm['Observaciones_educacion'] ?>" size="50" maxlength="100"></textarea>
									</div>
									<div class="col-sm-12">
										<br>
										<center>
											<button type="button" name="Continuar"  id="Continuar" class="btn btn-outline-primary"  onclick="javascript:send('Continuar');">Continuar</button>
										</center>
									</div-->
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
			<section class="content" id="tr_experiencia2" style="display: none;">
				<div class="container-fluid">
					<div class="card card-info" style="border-radius: 30px;">
						<div class="card-header" style="border-radius: 30px 30px 0 0;">
							<h3 tabindex="16" aria-label="Datos del Empleo" class="card-title"> Datos del Empleo </h3>
						</div>
						<form class="form-horizontal">
							<div class="card-body">
								<div class="form-group row">

									<!-- Columna 1 Izquierda -->

									<div class="col-sm-6 ">
										<div class="col-sm-12" tabindex="17">
											<label style="color: #312E33; margin-top: 10px;">Ocupación</label><span style="color: red;"> *</span>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp style="font-size: 13px;"><img style="width: 14px; height: auto;" src="../imagenes/empleo.png"></samp>
												</div>
												<input tabindex="17" aria-label="Es obligatorio escribir la ocupación que tuvo es su trabajo" name="ocupacion" type="text" style="border-radius: 0 15px 15px 0;" class="form-control form-control-sm select2" id="ocupacion" size="10" onkeyup="mayus(this);">
											</div>
										</div>
										<div class="col-sm-12" tabindex="19">
											<label style="color: #312E33; margin-top: 10px;">Fecha de Ingreso</label><span style="color: red;"> *</span>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 7px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp style="font-size: 13px;" class="icon-calendar"></samp>
												</div>
												<input tabindex="19" aria-label="es obligatorio indicar la fecha de ingreso" name="f_ingreso" type="date" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="f_ingreso" value="<?= $aDefaultForm['f_ingreso'] ?>" size="10">
											</div>
										</div>
										<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Ocupación Específica *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbOcupacion3_experiencia" id="cbOcupacion3_experiencia" style="border-radius: 15px;" class=" form-control form-control-sm select2">
												<option value="-1">Seleccionar</option>
											</select>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Ocupación *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbOcupacionG_experiencia" id="cbOcupacionG_experiencia" style="border-radius: 15px;" class=" form-control form-control-sm select2">
												<option value="-1">Seleccionar</option>
											</select>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Tipo de Terminación de Trabajo *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbMotivo_retiro" style="border-radius: 15px;" class=" form-control form-control-sm select2">
												<option value="-1" selected="selected">Seleccionar</option>
												<? /*LoadMotivo_retiro($conn); print $GLOBALS['sHtml_cb_Motivo_retiro'];*/ ?>
											</select>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Personal Supervisado *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbPersonal_supervisado" style="border-radius: 15px;" class=" form-control form-control-sm select2" id="cbPersonal_supervisado">
												<option value="-1" selected="selected">Seleccionar</option>
												<option value="1" <? if (($aDefaultForm['cbPersonal_supervisado']) == '1') print 'selected="selected"'; ?>>0</option>
												<option value="2" <? if (($aDefaultForm['cbPersonal_supervisado']) == '2') print 'selected="selected"'; ?>>1 a 5</option>
												<option value="3" <? if (($aDefaultForm['cbPersonal_supervisado']) == '3') print 'selected="selected"'; ?>>6 a 10</option>
												<option value="4" <? if (($aDefaultForm['cbPersonal_supervisado']) == '4') print 'selected="selected"'; ?>>Más de 10</option>
											</select>
										</div-->
									</div>

									<!-- Columna 2 Derecha -->

									<div class="col-sm-6 ">
										<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Ocupación Específica *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbOcupacion4_experiencia" id="cbOcupacion4_experiencia" style="border-radius: 15px;" class=" form-control form-control-sm select2">
												<option value="-1">Seleccionar</option>
											</select>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Ocupación General *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbOcupacionE_experiencia" id="cbOcupacionE_experiencia" style="border-radius: 15px;" class=" form-control form-control-sm select2">
												<option value="-1">Seleccionar</option>
											</select>
										</div-->
										<div class="col-sm-12">
											<label style="color: #312E33; margin-top: 10px;">Tipo de Relación de Trabajo</label><span style="color: red;"> *</span>
											<div>
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp><img style="width: 14px; height: auto;" src="../imagenes/relacion.png"></samp>
												</div>
											</div>
											<select tabindex="18" aria-label="Es obligatorio seleccionar si la empresa donde trabajo le pertenecía o no" name="cbRelacion_trabajo" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class=" form-control-sm select2" id="cbRelacion_trabajo">
												<option value="-1" selected="selected">Seleccione</option>
												<option value="1" <? if (($aDefaultForm['cbRelacion_trabajo']) == '2') print 'selected="selected"'; ?>>Cuenta propia</option>
												<option value="2" <? if (($aDefaultForm['cbRelacion_trabajo']) == '3') print 'selected="selected"'; ?>>Cuenta ajena</option>
											</select>
										</div>
										<div class="col-sm-12" tabindex="20">
											<label style="color: #312E33; margin-top: 10px;">Fecha de Egreso</label>
											<div class="input-group">

												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 7px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp style="font-size: 13px;" class="icon-calendar"></samp>
												</div>
												<input tabindex="20" aria-label="Es opcional indicar la Fecha de Egreso" name="f_egreso" type="date" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="f_egreso" value="<?= $aDefaultForm['f_egreso'] ?>" size="8" min='01-01-1900' max='31-12-2050'>
											</div>
										</div>
										<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Salario Mensual (Bs.) *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<input name="sueldo" type="number" style="border-radius: 15px;" class=" form-control form-control-sm select2" id="sueldo" onkeypress="return permite(event, 'num')" value="<?= $aDefaultForm['sueldo'] ?>" size="10" maxlength="6">
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Equipos o Herramientas que Maneja *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<textarea name="herramienta_trabajo" cols="28" class="form-control" id="herramienta_trabajo"><?= $aDefaultForm['herramienta_trabajo'] ?></textarea>
										</div-->
									</div>
									<div class="col-sm-12" tabindex="21">
										<label style="color: #312E33; margin-top: 10px;"> Otras Habilidades y Destrezas</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<textarea tabindex="21" aria-label="es opcional indicar Otras Habilidades y Destrezas" name="Otra_habilidad" cols="60" class="form-control" id="Otra_habilidad" style="border-radius: 30px" onkeyup="mayus(this);"><?= $aDefaultForm['Otra_habilidad'] ?></textarea>
									</div>
									<div class="col-sm-7">
										<div tabindex="22" aria-label="Actualizar" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px; margin:5px;display:none" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit" id="actualizar" onclick="agregar(cbExperiencia.value,rif.value,patrono.value,cbSector_empleo.value,cbAct_economica4.value,Telf_patrono.value,ocupacion.value,f_ingreso.value,cbRelacion_trabajo.value,f_egreso.value,Otra_habilidad.value,id_esperiencia.value)">Actualizar</div>
										<div tabindex="22" aria-label="Agregar" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px; margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit" id="agregar" onclick="agregar(cbExperiencia.value,rif.value,patrono.value,cbSector_empleo.value,cbAct_economica4.value,Telf_patrono.value,ocupacion.value,f_ingreso.value,cbRelacion_trabajo.value,f_egreso.value,Otra_habilidad.value,id_esperiencia.value)">Agregar</div>
									</div>

								</div>
								<table class="table table-hover table-bordered table-striped table-sm" style="text-align: left">
									<thead>
										<tr style="color: #312E33">
											<th>Ocupación</th>
											<th>Patrono / Empleador</th>
											<th>N° RIF</th>
											<th>Fecha de Ingreso</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody id="experiencia"></tbody>
								</table>
							</div>
							<div class="col-sm-7">
								<br>
								<center>
									<div tabindex="1001" aria-label="Guardar y continuar" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px; margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit" onclick="agregar2(cbExperiencia.value)">Guardar y Continuar</div>
									<a href="situacion_ocupacional.php">
										<div tabindex="1000" style="background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px;margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit" id="regresar">Regresar</div>
									</a>
								</center>
								<br><br>
							</div>
						</form>
					</div>
				</div>
			</section>
			<section class="content" id="tr_experiencia3">
				<div class="container-fluid">

			</section>
		</div>
		</div>
		</div>
		<script src="experiencia.js"></script>
	</body>

	<script>
		function selec() {
			var abrir = document.getElementById('cbExperiencia').value;

			if (abrir == "si") {
				document.getElementById("tr_esperiencia").style.display = "none";
				document.getElementById("tr_esperiencia1").style.display = "block";
				document.getElementById("tr_esperiencia2").style.display = "block";
				document.getElementById("tr_esperiencia3").style.display = "block";
				document.getElementById("tr_esperiencia4").style.display = "block";
				document.getElementById("tr_esperiencia5").style.display = "block";
			} else {
				document.getElementById("tr_esperiencia").style.display = "block";
				document.getElementById("tr_esperiencia1").style.display = "none";
				document.getElementById("tr_esperiencia2").style.display = "none";
				document.getElementById("tr_esperiencia3").style.display = "none";
				document.getElementById("tr_esperiencia4").style.display = "none";
				document.getElementById("tr_esperiencia5").style.display = "none";
			}
		}

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

	<!-- Código Viejo -->

	<!--table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
          <th colspan="2" class="titulo">Experiencia Laboral</th>
        </tr>
        <tr>
        <th colspan="2" class="sub_titulo" align="left">Informaci&oacute;n de experiencia laboral:</th>
        </tr>
        <tr>
        <td><div align="right">Tiene experiencia laboral?: </div></td>
        <td><select id="cbExperiencia" name="cbExperiencia" class="tablaborde_shadow" onChange="javascript:send('cbNo_tiene_changed');" title="Experiencia Laboral - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <option value="1" <? if (($aDefaultForm['cbExperiencia']) == '1') print 'selected="selected"'; ?>>Si</option>
        <option value="0" <? if (($aDefaultForm['cbExperiencia']) == '0') print 'selected="selected"'; ?>>No</option>
        </select>
        <span class="requerido">*</span></td>
        </tr>
        <tr id="tr_experiencia">
        <th colspan="2" class="sub_titulo" align="left">Datos de (la) patrono(a) &oacute; entidad de trabajo:</th>
        </tr>        
        <tr id="tr_experiencia1">
        <td><div align="right">RIF:</div></td>
        <td><input name="rif" type="text" class="tablaborde_shadow" id="rif" value="<?= $aDefaultForm['rif'] ?>" size="20" maxlength="10" title="RIF - Ingrese J, V, G, E en mayuscula seguido de nueve digitos numericos, Ejm: J123456789, V123456789, E123456789, G123456789 "/>
        <span class="requerido">
        <button type="submit" name="btRif"  id="btRif" class="button"  onclick="javascript:send('btRif');" title="Buscar en el Registro Nacional de Entidades de Trabajo">Buscar en Rnee</button>

        </span></td>
        </tr>
        
        <tr id="tr_experiencia3">
        <td width="38%"><div align="right">Patrono(a) &oacute; entidad de trabajo:</div></td>
        <td width="62%"><input name="patrono" type="text" class="tablaborde_shadow" id="patrono" value="<?= $aDefaultForm['patrono'] ?>" size="50" maxlength="100"  title="Nombre del (de la) patrono(a) o entidad de trabajo - Ingrese solo letras y/o numeros" />
        <span class="requerido"> *</span></td>
        </tr>
        
        <tr id="tr_experiencia4">
        <td><div align="right">Sector empleador: </div></td>
        <td><span class="links-menu-izq">
        <select name="cbSector_empleo" class="tablaborde_shadow" id="cbSector_empleo" title="Sector empleador - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <?/* LoadSector_empleo($conn); print $GLOBALS['sHtml_cb_Sector_empleo'];?>
        </select>
        <span class="requerido"> *</span></span></td>
        </tr>
        
        <tr id="tr_experiencia5">
        <td><div align="right">Actividad econ&oacute;mica sub específica: </div></td>
        <td><span class="links-menu-izq"><span class="requerido">
        <select name="cbAct_economica4" id="cbAct_economica4" class="tablaborde_shadow" title="Actividad economica Sub Especifica - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <? LoadAct_economica4($conn) ; print $GLOBALS['sHtml_cb_Act_economica4']; ?> 
        </select>*</span></span></td>
        </tr>
        
        <tr id="tr_experiencia6">
        <td><div align="right">Actividad econ&oacute;mica específica: </div></td>
        <td><span class="links-menu-izq"><span class="requerido">
        <select name="cbAct_economica3" id="cbAct_economica3" class="tablaborde_shadow" title="Actividad economica Especifica - Seleccione solo una opcion del listado">
        <option value="">Seleccionar</option>
        </select>*</span></span></td>
        </tr>
        
        <tr id="tr_experiencia7">
        <td><div align="right">Actividad econ&oacute;mica general: </div></td>
        <td><span class="links-menu-izq"><span class="requerido">
        <select name="cbAct_economica2" id="cbAct_economica2" class="tablaborde_shadow" title="Actividad economica General - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select>*</span></span></td>
        </tr>
        
        <tr id="tr_experiencia8">
        <td><div align="right">Actividad econ&oacute;mica: </div></td>
        <td><span class="links-menu-izq"><span class="requerido">
        <select name="cbAct_economica1" id="cbAct_economica1" class="tablaborde_shadow" title="Actividad economica - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select>*</span></span></td>
        </tr>
        
        <tr id="tr_experiencia9">
        <td><div align="right">Tel&eacute;fono:</div></td>
        <td><input name="Telf_patrono" type="text" class="tablaborde_shadow" id="Telf_patrono" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['Telf_patrono']?>" size="15" maxlength="11"  title="Telefono - Ingrese solo numeros"/></td>
        </tr>
        <tr id="tr_experiencia0">
        <th colspan="2" class="sub_titulo" align="left">Datos del empleo:</th>
        </tr>
        
        <tr id="tr_experiencia10">
        <td><div align="right">Fecha de ingreso:</div></td>
        <td>
        <input name="f_ingreso" type="text" class="tablaborde_shadow" id="f_ingreso" value="<?=$aDefaultForm['f_ingreso']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "f_ingreso",
        trigger    : "f_rangeStart_trigger",
				
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script>	<span class="requerido">*</span>  </td>
        </tr>
        
        <tr id="tr_experiencia11">
        <td><div align="right">Fecha de egreso:</div></td>
        <td>
        <input name="f_egreso" type="text" class="tablaborde_shadow" id="f_egreso" value="<?=$aDefaultForm['f_egreso']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger_1"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "f_egreso",
        trigger    : "f_rangeStart_trigger_1",
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script>		  </td>
        </tr>
        
        <tr id="tr_experiencia12">
        <td><div align="right">Ocupación detalle:</div></td>
        <td width="62%"><select name="cbOcupacion5_experiencia" id="cbOcupacion5_experiencia" class="tablaborde_shadow" title="Ocupacion detalle - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <? LoadOcupacion5_experiencia ($conn, $param) ; print $GLOBALS['sHtml_cb_Ocupacion5_experiencia']; ?>
        </select>
        <span class="requerido">*</span></td>
        </tr>
        
        <tr id="tr_experiencia13">
        <td><div align="right">Ocupaci&oacute;n sub especifica: </div></td>
        <td><select name="cbOcupacion4_experiencia" id="cbOcupacion4_experiencia" class="tablaborde_shadow" title="Ocupacion sub especifica - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select>
        <span class="requerido">*</span></td>
        </tr>
        
        <tr id="tr_experiencia14">
        <td><div align="right">Ocupaci&oacute;n específica: </div></td>
        <td><select name="cbOcupacion3_experiencia" id="cbOcupacion3_experiencia" class="tablaborde_shadow" title="Ocupacion especifica - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select>
        <span class="requerido">*</span></td>
        </tr>
        
        <tr id="tr_experiencia15">
        <td><div align="right">Ocupaci&oacute;n general: </div></td>
        <td><select name="cbOcupacionE_experiencia" id="cbOcupacionE_experiencia" class="tablaborde_shadow" title="Ocupacion general - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select>
        <span class="requerido">*</span></td>
        </tr>
        
        <tr id="tr_experiencia16">
        <td><div align="right">Ocupación:</div></td>
        <td><select name="cbOcupacionG_experiencia" id="cbOcupacionG_experiencia" class="tablaborde_shadow" title="Ocupacion - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select>
        <span class="requerido">*</span></td>
        </tr>
        
        <tr id="tr_experiencia17">
        <td><div align="right">Tipo de relaci&oacute;n de trabajo: </div></td>
        <td><select name="cbRelacion_trabajo" class="tablaborde_shadow" id="cbRelacion_trabajo" title="Tipo de relacion de trabajo - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <option value="2" <? if (($aDefaultForm['cbRelacion_trabajo'])=='2') print 'selected="selected"';?>>Cuenta propia</option>
        <option value="3" <? if (($aDefaultForm['cbRelacion_trabajo'])=='3') print 'selected="selected"';?>>Cuenta ajena</option>
        </select>
        <span class="requerido"> *</span></td>
        </tr>
        
        <tr id="tr_experiencia18">
        <td><div align="right">Causales de terminaci&oacute;n de la relaci&oacute;n de trabajo:</div></td>
        <td><span class="links-menu-izq">
        <select name="cbMotivo_retiro" class="tablaborde_shadow" title="Causales de terminaci&oacute;n de la relaci&oacute;n de trabajo - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <? LoadMotivo_retiro($conn); print $GLOBALS['sHtml_cb_Motivo_retiro'];?>
        </select>
        </span></td>
        </tr>
        
        <tr id="tr_experiencia19">
        <td><div align="right">Salario mensual final &oacute; actual (Bsf.):</div></td>
        <td><input name="sueldo" type="text" class="tablaborde_shadow" id="sueldo" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['sueldo']?>" size="10" maxlength="6" title="Salario mensual final &oacute; actual - Ingrese solo numeros"/>
        <span class="requerido"> *</span></td>
        </tr>
        
        <tr id="tr_experiencia20">
        <td><div align="right">Personal supervisado:</div></td>
        <td><select name="cbPersonal_supervisado" class="tablaborde_shadow" id="cbPersonal_supervisado" title="Personal supervisado - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <option value="1" <? if (($aDefaultForm['cbPersonal_supervisado'])=='1') print 'selected="selected"';?>>0</option>
        <option value="2" <? if (($aDefaultForm['cbPersonal_supervisado'])=='2') print 'selected="selected"';?>>1 a 5</option>
        <option value="3" <? if (($aDefaultForm['cbPersonal_supervisado'])=='3') print 'selected="selected"';?>>6 a 10</option>
        <option value="4" <? if (($aDefaultForm['cbPersonal_supervisado'])=='4') print 'selected="selected"';?>>Más de 10</option>
        </select>
        <span class="requerido">*</span></td>
        </tr>
        
        <tr id="tr_experiencia21">
        <td><div align="right">Equipos/herramientas que manej&oacute; en este empleo:</div></td>
        <td><textarea name="herramienta_trabajo" cols="28" class="tablaborde_shadow" id="herramienta_trabajo" title="Equipos/herramientas que manej&oacute; en este empleo - Ingrese solo letras y/o numeros" ><?=$aDefaultForm['herramienta_trabajo']?></textarea></td>
        </tr>
        
        <tr id="tr_experiencia22">
        <td><div align="right">Breve descripci&oacute;n del trabajo desempe&ntilde;ado: </div></td>
        <td><textarea name="observaciones_experiencia" cols="28" class="tablaborde_shadow" id="observaciones_experiencia" title="Breve descripci&oacute;n del trabajo desempe&ntilde;ado - Ingrese solo letras y/o numeros"><?=$aDefaultForm['observaciones_experiencia']?></textarea></td>
        </tr>
        
        <tr id="tr_experiencia23">
          <td>&nbsp;</td>
          <td><span class="requerido">
            <? if($_POST['edit']==""){ ?>
            <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Agregar</button>
            <? }
             else{ ?>
            <button type="button" name="Actualizar"  id="Actualizar" class="button"  onClick="javascript:send('Agregar');">Actualizar</button>
          </span>
            <? }?>
            <span class="requerido">
            <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button>
         </span></td>
        </tr>
        <tr id="tr_experiencia25">
        <td height="50" colspan="2">
          
          
              <table  border="0" align="center" class="listado formulario" id="tblDetalle" style="width:99%; ">
              <tr>
              <th width="35%" class="labelListColumn">Ocupación</th>
              <th width="35%" class="labelListColumn">Patrono/Empleador</th>
              <th width="10%" class="labelListColumn">Rif</th>
              <th width="10%" class="labelListColumn">Fecha de Ingreso</th>
              <th width="10%" class="labelListColumn">Acciones</th>
              </tr>
              <?
              $aTabla=$_SESSION['aTabla'];
              $aDefaultForm = $GLOBALS['aDefaultForm'];
              for( $i=0; $i<count($aTabla); $i++){
              if (($i%2) == 0) $class_name = "dataListColumn2";
              else $class_name = "dataListColumn";
              ?>
              <tr class="<?=$class_name?>">
              <td class="texto-normal"><div align="left">
              <?=$aTabla[$i]['ocupacione']?>
              </div></td>
              <td class="texto-normal"><div align="left">
              <?=$aTabla[$i]['patrono']?>
              </div></td>
              <td class="texto-normal"><div align="left">
              <?=$aTabla[$i]['rif']?>
              </div></td>
              <td class="texto-normal"><div align="left">
              <? if ($aTabla[$i]['f_ingreso']=='0000-00-00'){ print '0000-00-00';}
              else { print strftime("%d-%m-%Y", strtotime($aTabla[$i]['f_ingreso']));}
              ?>
              </div></td>
              <td class="texto-normal"><a href="1_8agen_trab_experiencia.php?id_po=<?=$aTabla[$i]['id']?>&accion=1"><img src="../imagenes/pencil_16.png"  border="0" title="Editar" /></a> <a href="1_8agen_trab_experiencia.php?id_po=<?=$aTabla[$i]['id']?>&accion=2"><img src="../imagenes/delete_16.png"  border="0" title="Eliminar" /></a> </td>
              </tr>
              <? } ?>
              </table>	
		  
      </td>
      </tr>
     
      <tr id="tr_experiencia26">
      <td colspan="2" align="center">
      <button type="button" name="Continuar"  id="Continuar" class="button"  onclick="javascript:send('Continuar');">Continuar</button>
      </td>
      </tr>
     
      
      </table-->
      <p></div>
</p>
</form>
<?php*/
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
		?> 

<?php include('footer.php'); ?>