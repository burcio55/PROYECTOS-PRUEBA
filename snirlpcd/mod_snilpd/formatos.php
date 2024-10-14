<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
$conn = getConnDB('sire');
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = false;
doAction($conn);
debug($settings['debug'] = false);
showHeader();
showForm($conn, $aDefaultForm);
showFooter();

$cedula = substr($_SESSION["cedula"], 1);

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

if (isset($_SESSION['cedula'])) {

	$cedula = substr($_SESSION["cedula"], 1);

	$consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "' and benabled = 'true';");
	$row = pg_query($conn, $consulta);
	$persona = pg_fetch_assoc($row);

	$persona_id = $persona["id"];
	$bexperiencia_laboral = $persona["bexperiencia_laboral"];
	$ncertificado = $persona["ncertificado"];

	// Validaciones de la tabla "persona" de "Datos Personales"
	if ($persona == '') {
		echo '
			<script>
				document.getElementById("texto").innerText = ("Usted no se ha registrado aún");
				document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
				document.getElementById("titulo").style.color = "white";
				document.getElementById("titulo").innerText = ("Atención");
				document.getElementById("alerta").style.display = "Block";
				document.getElementById("link").value = "../index.php";
			</script>
		';
		die();
	} else {
		if ($persona["snacionalidad"] == '' || $persona["ncedula"] == '' || $persona["sprimer_nombre"] == '' || $persona["sprimer_apellido"] == '' || $persona["ssexo"] == '' || $persona["dfecha_nacimiento"] == '' || $persona["semail"] == '') {
			echo '
				<script>
					document.getElementById("texto").innerText = ("No registró los datos básicos obligatorios");
					document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
					document.getElementById("titulo").style.color = "white";
					document.getElementById("titulo").innerText = ("Atención");
					document.getElementById("alerta").style.display = "Block";
					document.getElementById("link").value = "../index.php";
				</script>
			';
			die(); // $persona["npais_nac_id"] == '' || $persona["entidad_nac_id"] == ''
		} else 
		if ($persona["npais_nac_id"] == '') {
			echo '
				<script>
					document.getElementById("texto").innerText = ("No registró su País de Nacimiento");
					document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
					document.getElementById("titulo").style.color = "white";
					document.getElementById("titulo").innerText = ("Atención");
					document.getElementById("alerta").style.display = "Block";
					document.getElementById("link").value = "datos_personales.php";
				</script>
			';
			die(); // $persona["npais_nac_id"] == '' || $persona["entidad_nac_id"] == ''
		} else 
		if ($persona["entidad_nac_id"] == '') {
			echo '
				<script>
					document.getElementById("texto").innerText = ("No registró su Estado de Nacimiento");
					document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
					document.getElementById("titulo").style.color = "white";
					document.getElementById("titulo").innerText = ("Atención");
					document.getElementById("alerta").style.display = "Block";
					document.getElementById("link").value = "datos_personales.php";
				</script>
			';
			die(); // $persona["npais_nac_id"] == '' || $persona["entidad_nac_id"] == ''
		} else
		if ($persona["stelefono_personal"] == '' && $persona["stelefono_habitacion"] == '') {
			echo '
				<script>
					document.getElementById("texto").innerText = ("Debe guardar al menos un número de contacto");
					document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
					document.getElementById("titulo").style.color = "white";
					document.getElementById("titulo").innerText = ("Atención");
					document.getElementById("alerta").style.display = "Block";
					document.getElementById("link").value = "datos_personales.php";
				</script>
			';
			die();
		} else 
		if ($persona["npais_residencia_id"] == '' || $persona["nentidad_residencia_id"] == '' || $persona["nmunicipio_residencia_id"] == '' || $persona["nparroquia_residencia_id"] == '') {
			echo '
				<script>
					document.getElementById("texto").innerText = ("No llenó todos los requisitos de su residencia");
					document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
					document.getElementById("titulo").style.color = "white";
					document.getElementById("titulo").innerText = ("Atención");
					document.getElementById("alerta").style.display = "Block";
					document.getElementById("link").value = "datos_personales.php";
				</script>
			';
			die();
		} else 
		if ($persona["bjefe_familia"] == '') {
			echo '
				<script>
					document.getElementById("texto").innerText = ("No especificó si es Jefe de Familia");
					document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
					document.getElementById("titulo").style.color = "white";
					document.getElementById("titulo").innerText = ("Atención");
					document.getElementById("alerta").style.display = "Block";
					document.getElementById("link").value = "datos_personales.php";
				</script>
			';
			die();
		} else 
		if ($persona["btiene_hijo"] == '') {
			echo '
				<script>
					document.getElementById("texto").innerText = ("No especificó si tiene hijos o no");
					document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
					document.getElementById("titulo").style.color = "white";
					document.getElementById("titulo").innerText = ("Atención");
					document.getElementById("alerta").style.display = "Block";
					document.getElementById("link").value = "datos_personales.php";
				</script>
			';
			die();
		} else
		if ($persona["btiene_hijo"] == 'true') {
			if ($persona["nhijos_menores18"] == '') {
				echo '
					<script>
						document.getElementById("texto").innerText = ("Es obligatorio decir cuántos hijos menores tiene");
						document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
						document.getElementById("titulo").style.color = "white";
						document.getElementById("titulo").innerText = ("Atención");
						document.getElementById("alerta").style.display = "Block";
						document.getElementById("link").value = "datos_personales.php";
					</script>
				';
				die();
			}
		} else 
		if ($persona["bcarnet_patria"] == '') {
			echo '
				<script>
					document.getElementById("texto").innerText = ("No especificó si tiene Carnet de la Patria o no");
					document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
					document.getElementById("titulo").style.color = "white";
					document.getElementById("titulo").innerText = ("Atención");
					document.getElementById("alerta").style.display = "Block";
					document.getElementById("link").value = "datos_personales.php";
				</script>
			';
			die();
		} else
		if ($persona["bcarnet_patria"] == 'true') {
			if ($persona["scodigo_carnet_patria"] == '') {
				echo '
					<script>
						document.getElementById("texto").innerText = ("Es obligatorio decir el código de tu Carnet de la Patria");
						document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
						document.getElementById("titulo").style.color = "white";
						document.getElementById("titulo").innerText = ("Atención");
						document.getElementById("alerta").style.display = "Block";
						document.getElementById("link").value = "datos_personales.php";
					</script>
				';
				die();
			} else
			if ($persona["sserial_carnet_patria"] == '') {
				echo '
					<script>
						document.getElementById("texto").innerText = ("Es obligatorio decir el serial de tu Carnet de la Patria");
						document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
						document.getElementById("titulo").style.color = "white";
						document.getElementById("titulo").innerText = ("Atención");
						document.getElementById("alerta").style.display = "Block";
						document.getElementById("link").value = "datos_personales.php";
					</script>
				';
				die();
			}
		}
	}

	// Consulta con la tabla "persona_nivel_educativo" de "Educación"

	$query = ("SELECT * FROM snirlpcd.persona_nivel_educativo WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
	$row2 = pg_query($conn, $query);
	$persona2 = pg_fetch_assoc($row2);

	// Validaciones de la tabla "persona_nivel_educativo" de "Educación"

	if ($persona2 == '') {
		echo '
			<script>
				document.getElementById("texto").innerText = ("Usted no ha registrado nada en \"Educación\"");
				document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
				document.getElementById("titulo").style.color = "white";
				document.getElementById("titulo").innerText = ("Atención");
				document.getElementById("alerta").style.display = "Block";
				document.getElementById("link").value = "educacion.php";
			</script>
		';
		die();
	}

	// Consulta con la tabla "persona_capacitacion" de "Capacitación"

	$PG1 = ("SELECT * FROM snirlpcd.persona WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
	$row3 = pg_query($conn, $PG1);
	$persona3 = pg_fetch_assoc($row3);

	if ($persona3['brealizado_curso'] == 'True') {
		$PG = ("SELECT * FROM snirlpcd.persona_capacitacion WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
		$row3 = pg_query($conn, $PG);
		$persona7 = pg_fetch_assoc($row3);

		// Validaciones de la tabla "persona_capacitacion" de "Capacitación"

		if ($persona7 == '') {
			echo '
				<script>
					document.getElementById("texto").innerText = ("Usted no ha registrado nada en \"Capacitación\"");
					document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
					document.getElementById("titulo").style.color = "white";
					document.getElementById("titulo").innerText = ("Atención");
					document.getElementById("alerta").style.display = "Block";
					document.getElementById("link").value = "capacitacion.php";
				</script>
			';
			die();
		}
	}


	// Consulta con la tabla "persona_sit_ocupacional" de "Situación Ocupacional"

	$sql = ("SELECT * FROM snirlpcd.persona_sit_ocupacional WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
	$row4 = pg_query($conn, $sql);
	$persona4 = pg_fetch_assoc($row4);

	// Validaciones de la tabla "persona_sit_ocupacional" de "Situación Ocupacional"

	if ($persona4 == '') {
		echo '
			<script>
				document.getElementById("texto").innerText = ("Usted no ha registrado nada en \"Situación Ocupacional\"");
				document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
				document.getElementById("titulo").style.color = "white";
				document.getElementById("titulo").innerText = ("Atención");
				document.getElementById("alerta").style.display = "Block";
				document.getElementById("link").value = "situacion_ocupacional.php";
			</script>
		';
		die();
	} else {
		if ($persona4["situacion_laboral_id"] == '') {
			echo '
				<script>
					document.getElementById("texto").innerText = ("Faltó mencionar cuál es su situación laboral actual");
					document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
					document.getElementById("titulo").style.color = "white";
					document.getElementById("titulo").innerText = ("Atención");
					document.getElementById("alerta").style.display = "Block";
					document.getElementById("link").value = "situacion_ocupacional.php";
				</script>
			';
			die();
		} else
		if ($persona4["sdescripcion_ocup_det1"] == '') {
			echo '
				<script>
					document.getElementById("texto").innerText = ("Faltó especificar su Primera Opción");
					document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
					document.getElementById("titulo").style.color = "white";
					document.getElementById("titulo").innerText = ("Atención");
					document.getElementById("alerta").style.display = "Block";
					document.getElementById("link").value = "situacion_ocupacional.php";
				</script>
			';
			die();
		} else
		if ($persona4["sexperiencia1"] == '') {
			echo '
				<script>
					document.getElementById("texto").innerText = ("Faltó especificar su nivel de experiencia en su Primera Opción");
					document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
					document.getElementById("titulo").style.color = "white";
					document.getElementById("titulo").innerText = ("Atención");
					document.getElementById("alerta").style.display = "Block";
					document.getElementById("link").value = "situacion_ocupacional.php";
				</script>
			';
			die();
		}
	}

	// Consulta con la tabla "persona_exp_laboral" de "Experiencia Laboral"

	$PG2 = ("SELECT * FROM snirlpcd.persona WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
	$row3 = pg_query($conn, $PG2);
	$persona8 = pg_fetch_assoc($row3);
	if ($persona3['bexperiencia_laboral'] == 't') {
		if ($bexperiencia_laboral == 't') {
			$sqli = ("SELECT * FROM snirlpcd.persona_exp_laboral WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
			$row5 = pg_query($conn, $sqli);
			$persona5 = pg_fetch_assoc($row5);

			// Validaciones de la tabla "persona_exp_laboral" de "Experiencia Laboral"

			if ($persona5 == '') {
				echo '
					<script>
						document.getElementById("texto").innerText = ("No Guardó información en \"Experiencia Laboral\"");
						document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
						document.getElementById("titulo").style.color = "white";
						document.getElementById("titulo").innerText = ("Atención");
						document.getElementById("alerta").style.display = "Block";
						document.getElementById("link").value = "experiencia_laboral.php";
					</script>
				';
				die();
			}
		}
	}

	// Consulta con la tabla "persona_fotos" de "Fotos"

	$select = ("SELECT * FROM snirlpcd.persona_fotos WHERE persona_id = '" . $persona_id . "' and beneabled = 'true';");
	$row6 = pg_query($conn, $select);
	$persona6 = pg_fetch_assoc($row6);

	// Validaciones de la tabla "persona_fotos" de "Fotos"

	if ($persona6 == '') {
		echo '
			<script>
				document.getElementById("texto").innerText = ("No ha subido ninguna Foto");
				document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
				document.getElementById("titulo").style.color = "white";
				document.getElementById("titulo").innerText = ("Atención");
				document.getElementById("alerta").style.display = "Block";
				document.getElementById("link").value = "foto.php";
			</script>
		';
		die();
	}

	// Consulta con la tabla "persona_discapacidad"

	$discp = ("SELECT * FROM snirlpcd.persona_discapacidad WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
	$row7 = pg_query($conn, $discp);
	$persona7 = pg_fetch_assoc($row7);

	// Validaciones de la tabla "persona_discapacidad"

	$id_discapacidad = $persona7["id"];

	/* if ($id_discapacidad == '') {
		echo '
			<script>
				alert ("Usted no ha llenado el formulario de Discapacidad");
				window.location="discapacidad.php";
			</script>
		';
		die();
	} else {
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
}

//------------------------------------------------------------------------------------------------------------------------------
function debug()
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION['bloq']);
	}
}
//------------------------------------------------------------------------------------------------------------------------------
/*function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}*/
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn)
{
	if (isset($_POST['action'])) {
		switch ($_POST['action']) {


			case 'Agregar':
				$bValidateSuccess = true;



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
		$aDefaultForm['foto'] = '';
	}
	$formatos = '';
	$_POST['formatos'] = '';

	$SQL = "select 
					personas.sesiones From public.personas  
				  where cedula='" . $_SESSION['ced_afiliado'] . "'";
	$rs1 = $conn->Execute($SQL);
	if ($rs1->RecordCount() > 0) {
		$formatos = $rs1->fields['sesiones'];
	}
	if ($formatos == '1111111' or $formatos == '1111110') {
		$_POST['formatos'] = '1';
	} else {
?><!-- <script>
			alert('No ha completado toda informacion, por lo tanto no podra imprimir los formatos')
		</script> --><?
					}
				}
				//------------------------------------------------------------------------------------------------------------------------------
				function ProcessForm($conn)
				{
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
	<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
		<input name="action" type="hidden" value="" />
		<script>
			function send(saction) {
				var form = document.form;
				form.action.value = saction;
				form.submit();
			}
		</script>

		<!-- Diseño Nuevo Bootstrap 4 -->

		<body class="hold-transition sidebar-mini">
			<div class="content-video2 video">
				<video src="../videos/video_formato.mp4" class="video" controls>
					<!-- <source src="videos/video_prueba.mp4" type="video/mp4"> -->
				</video>
			</div>
			<div class="wrapper">
				<section class="content">
					<div class="container-fluid">
						<div class="card card-primary" style="border-radius: 30px">
							<div class="card-header" style="border-radius: 30px">
								<h3 tabindex="7" aria-label="Formatos" class="card-title"> Formatos </h3>
							</div>
						</div>
						<div class="card card-info" style="border-radius: 30px">
							<form class="form-horizontal">
								<div class="card-body">
									<div class="form-group row">
										<div class="col-sm-6">
											<div class="card border-primary mb-3" style="height: 400px; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; border-radius: 30px; overflow: hidden">
												<img tabindex="8" aria-label="imagen 1" class="card-img-top" src="../imagenes/curriculum.png" style="height: 280px;">
												<div class="card-body">
													<h4 tabindex="9" aria-label="Curriculum Vitae" class="card-title">Curriculum Vitae</h4><br><br>
													<a href="">
														<a href="../pdf/curriculum.php" target="_blank">
															<div tabindex="10" aria-label="ver curriculum" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px; margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit">Ver curriculum</div>
														</a>
													</a>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="card border-primary mb-3" style="height: 400px; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; border-radius: 30px; overflow: hidden">
												<img tabindex="11" aria-label="imagen 2" class="card-img-top" src="../imagenes/constancia_registro.png" style="height: 280px;">
												<div class="card-body">
													<h4 tabindex="12" aria-label="Certificado de Registro" class="card-title">Certificado de Registro</h4><br><br>
													<a href="">
														<a href="../pdf/registro.php?cedula=<?php echo $cedula = substr($_SESSION["cedula"], 1); ?>" target="_blank">
															<div tabindex="13" aria-label="Ver registro" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px; margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit">Ver certificado</div>
														</a>
													</a>
												</div>
											</div>
										</div>
										<div class="col-sm-7">
											<center>
												<a href="oportunidad.php">
													<div tabindex="15" aria-label="Continuar" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px; margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit">Continuar</div>
												</a>
												<a href="foto.php">
													<div tabindex="14" aria-label="Regresar" style="background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px;margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit">Regresar</div>
												</a>
											</center>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</section>
			</div>
		</body>

		<!-- Diseño Viejo -->

		<!--table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
          <th class="titulo">Formatos</th>
        </tr>
        <tr>
          <th  class="sub_titulo" align="left"> Formatos: </th>
        </tr>
        <tr>
          <td  class="link-clave-ruee"><div align="center"></div></td>
        </tr>
        <tr>
          <td>
          <? if ($_POST['formatos'] == '1') { ?>
                  <table width="50%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
                  <tr>
                  <td width="50%" class="link-clave-ruee" align="center"><a href="1agen_formato_curriculum.php" class="links-menu-izq"><img src="../imagenes/client_account_template.png" width="36" height="36" border="0" /><br>Curriculum Vitae</a></td>
                  
                  <td width="50%" class="link-clave-ruee" align="center"><a href="1agen_formato_constancia_trab.php" class="links-menu-izq"><img src="../imagenes/blue-document-text.png" width="36" height="38" border="0" /><br>
                  Constancia de Registro</a></td>
                  </tr>
                  </table>
                  
             <? } else { ?>   
                  <table width="50%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
                  <tr>
                  <th width="50%" class="titulo" align="center"><img src="../imagenes/client_account_template.png" width="36" height="36" border="0" /><br>Curriculum Vitae</th>
                  <th width="50%" class="titulo" align="center"><img src="../imagenes/blue-document-text.png" width="36" height="38" border="0" /><br>Constancia de Registro</th>
                  </tr>
                  </table>
               <? } ?>
                  
        </td>
        </tr>
        <tr>
          <td class="link-clave-ruee">&nbsp;</td>
        </tr>
      </table-->
	</form>
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
?>

<?php include('footer.php'); ?>