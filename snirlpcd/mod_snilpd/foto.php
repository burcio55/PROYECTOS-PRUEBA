<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('Trazas.class.php');
$conn = getConnDB('sire');
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = FALSE;
doAction($conn);
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
			document.getElementById("texto").innerText = ("Usted no ha llenado el formulario de Discapacidad");
			document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
			document.getElementById("titulo").style.color = "white";
			document.getElementById("titulo").innerText = ("Atención");
			document.getElementById("alerta").style.display = "Block";
			document.getElementById("link").value = "discapacidad.php";
		</script>
	';
	die();
}/*  else {
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
		var_dump($_SESSION['bloq']);
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
function doAction($conn)
{
	if (isset($_POST['action'])) {
		switch ($_POST['action']) {


			case 'upload':
				$bValidateSuccess = true;

				if ($bValidateSuccess) {
					ProcessForm($conn);
				}
				LoadData($conn, true);
				break;

			case 'Continuar':
				$bValidateSuccess = true;
?><script>
					document.location = '1_14agen_trab_formatos.php'
				</script><?
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
					$SQL9 = "select *  from imagen 
						where persona_id ='" . $_SESSION['id_afiliado'] . "'";
					$rs9 = $conn->Execute($SQL9);
					$_POST['foto'] = $rs9->fields['imagen'];

					if ($rs9->RecordCount() > 0) {
						$_POST['imagen'] = '<img src="imagenes/' . $_POST['foto'] . '" width="100" height="116" border="0"/>';
					} else {
						$_POST['imagen'] = 'FOTO';
					}
				}
			}
			//------------------------------------------------------------------------------------------------------------------------------
			function ProcessForm($conn)
			{

				$max = 9500000;
				$filename = '';
				$ced_afiliado = $_SESSION['ced_afiliado'];
				$filesize = $_FILES['archivo']['size'];
				$type = strtolower($_FILES['archivo']['type']);
				$filename = trim($_FILES['archivo']['name']); // (trim elimina los posibles espacios al final y al principio del nombre del archivo)
				$filename = substr($filename, -10); //(con substr le decimos que coja los últimos 10 caracteres por si el nombre fuera muy largo)
				$filename = ereg_replace(" ", "", $filename); //(con esta función eliminamos posibles espacios entre los caracteres del nombre)
				$filename = $ced_afiliado . $filename;
				//Ahora creamos las condiciones que debe cumplir el archivo antes de ser almacenado en el servidor. Restringimos a .jpg ó .gif (tanto en mayusculas como en minúsculas) y finalmente cambiamos el archivo de la carpeta temporal a la final elegida.

				$status = "";
				if ($_POST["action"] == "upload") {
					if ($filename != "") {
						if ((int)$filesize < (int)$max) {
							if ($filesize != '') {
								if (preg_match('/(jpg|gif|jpeg|zip)/', $type)) {

									$destino =  'imagenes/' . $filename;
									if (copy($_FILES['archivo']['tmp_name'], $destino)) {
										$sfecha = date('Y-m-d');
										$SQL = "SELECT id FROM imagen where persona_id= " . $_SESSION['id_afiliado'];
										$rs = $conn->Execute($SQL);
										$imagen_id = $rs->fields['id'];

										if ($imagen_id != '') {
											$sql = "update imagen set 
								 persona_id='" . $_SESSION['id_afiliado'] . "',
								 imagen='" . $filename . "',
								 status='A',
								 updated_at='" . $sfecha . "',
								 id_update='" . $_SESSION['sUsuario'] . "'
								 where id='" . $imagen_id . "' and persona_id=" . $_SESSION['id_afiliado'];
											$rs = $conn->Execute($sql);
										} else {
											$sql = "insert into public.imagen
						     (persona_id, imagen, status, created_at, id_update) 
					          values 			
							 ('" . $_SESSION['id_afiliado'] . "',
							  '" . $filename . "',
							  'A',
							  '" . $sfecha . "',
							  '" . $_SESSION['sUsuario'] . "')";
											$conn->Execute($sql);
										}
										//Trazas-------------------------------------------------------------------------------------------------------------------------------				
										$id = $_SESSION['id_afiliado'];
										$identi = $_SESSION['ced_afiliado'];
										$us = $_SESSION['sUsuario'];
										$mod = '12';
										$auditoria = new Trazas;
										$auditoria->auditor($id, $identi, $sql, $us, $mod);
										//--------------------------------------------------------------------------------------------------------------------------------------

										//sesiones curriculum
										$nNumSeccion = 7;
										$sSQL = "SELECT sesiones FROM personas where id = " . $_SESSION['id_afiliado'];
										$rs = $conn->Execute($sSQL);

										if ($rs) {
											if ($rs->RecordCount() > 0) {
												$rs->fields['sesiones'][$nNumSeccion - 1] = 1;
												$sSQL = "update personas set sesiones = '" . $rs->fields['sesiones'] . "' where id = " . $_SESSION['id_afiliado'];
												$rs = $conn->Execute($sSQL);
											}
										}

										$GLOBALS['aPageErrors'][] = "- El Archivo subio correctamente";
										$bValidateSuccess = false;
									} else {
										$GLOBALS['aPageErrors'][] = "- Error de al subir el archivo";
										$bValidateSuccess = false;
									}
								} else {
									$GLOBALS['aPageErrors'][] = "- Sólo se permiten imágenes en formato .jpg y .gif, no se ha podido adjuntar";
									$bValidateSuccess = false;
								}
							}
						} else {
							$GLOBALS['aPageErrors'][] = "- La imagen que ha intentado adjuntar es mayor de 1.5 Mb";
							$bValidateSuccess = false;
						}
					} else {
						$GLOBALS['aPageErrors'][] = "- Debe seleccionar alguna imagen";
						$bValidateSuccess = false;
					}
				}
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
	<!--<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data"-->
	<script>
		function send(saction) {
			var form = document.form;
			form.action.value = saction;
			form.submit();
		}
	</script>

	<!-- Código Body Nuevo -->

	<body class="hold-transition sidebar-mini">
		<div class="content-video2 video">
			<video src="../videos/video_foto.mp4" class="video" controls>
				<!-- <source src="videos/video_prueba.mp4" type="video/mp4"> -->
			</video>
		</div>
		<div class="wrapper">
			<section class="content">
				<div class="container-fluid">
					<div class="card card-primary" style="border-radius: 30px;">
						<div class="card-header" style="border-radius: 30px ">
							<h3 tabindex="7" aria-label="Foto" class="card-title"> Foto </h3>
						</div>
					</div>
					<div class="card card-info" style="border-radius: 30px;">
						<div class="card-header" style="border-radius: 30px 30px 0 0;">
							<h3 tabindex="8" aria-label="Foto del (de la) Trabajador(a)" class="card-title"> Foto para el Curriculum Vitae</h3>
						</div>
						<div style="padding: 10px; text-align: right; margin-bottom: -25px">
							<h4 style="color: #BF1F13; font-size: 15px;">Campos obligatorios (*)</h4>
						</div>
						<form class="form-horizontal" method="POST" action="subir_foto.php" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group row">
									<div class="col-sm-12">
										<div class="col-sm-12">
											<p tabindex="9" style="color: #312E33; margin-top: 10px; font-size:15px">La foto que desee adjuntar debe ser menor a 1.5 MB y debe tener un formato .jpg, .jpeg, .png o .gif.</p>
										</div>
										<center>
											<div class="col-sm-6">
												<div class="form-group">
													<?php

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
														$echo = ("Se conectó la Base de Datos ");
													} catch (PDOException $error) {
														$conn = $error;
														echo ("Error al conectar en la Base de Datos " . $error);
													}

													if (isset($_SESSION['cedula'])) {

														$cedula = substr($_SESSION["cedula"], 1);

														$consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
														$row = pg_query($conn, $consulta);
														$persona = pg_fetch_assoc($row);

														$persona_id = $persona["id"];

														$consulta2 = ("SELECT * FROM snirlpcd.persona_foto WHERE persona_id = '" . $persona_id . "';");
														$row2 = pg_query($conn, $consulta2);
														$persona2 = pg_fetch_assoc($row2);
													}
													if ($persona_id2 == $persona_id) {
														echo "Ya hay una foto guardada en el Sistema, de subir otra foto se remplazará la anterior";
													}
													?>
													<label for="formFile" style="color: #312E33">Foto</label><span style="color: red;"> *</span>
													<input tabindex="10" aria-label="Es obligatorio seleccionar una imagen para continuar" class="form-control" type="file" id="formFile" name="archivo_img" style="border-radius: 30px" required>
												</div>
											</div>
										</center>

										<div class="col-sm-7">
											<a href="subir_foto.php">
												<input tabindex="11" aria-label="agregar foto" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px; margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' type="submit" id="archivo" name="archivo_img" value="Agregar Foto">
											</a>
										</div>
										<br><br><br><br>
										<div class="col-sm-9">
											<div class="col-sm-10">
												<div tabindex="13" onclick="continuar()" aria-label="Continuar" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px; margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit">Continuar</div>
												<div tabindex="12" onclick="regresar()" aria-label="Regresar" style="background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px;margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit">Regresar</div>
											</div>
										</div>
										<script>
											function continuar() {
												$(location).attr('href', 'formatos.php');
											}

											function regresar() {
												$(location).attr('href', 'experiencia_laboral.php');
											}
										</script>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</body>

	<!-- Código Viejo -->

	<!--table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        
        <tr>
          <th class="titulo">Foto del (de la) Trabajador(a) </th>
        </tr>
        <tr>
          <th class="sub_titulo">Agregar imagen: </th>
        </tr>
        <tr>
          <td align="center"><?= $_POST['imagen']; ?></td>
        </tr>
        <tr>
          <td><div align="center">
              <input name="archivo" type="file" class="link-info" size="35" />
              <button type="button" name="upload"  id="upload" class="button"  onClick="javascript:send('upload');">Subir Imagen</button>
          </div></td>
        </tr>
        <tr>
          <td align="center" class="link-clave-ruee Estilo12">Las imagenes que desee adjuntar deben ser menor a 1.5 MB y deben tener un formato .jpg .gif </td>
        </tr>
        <tr>
          <td align="center" class="link-clave-ruee Estilo12">de lo contrario deberá cambiar el formato de la imagen para poder subirla. </td>
        </tr>
        
        <tr>
          <td class="link-clave-ruee"><div align="right"></div> <div align="right"></div></td>
        </tr>
        <tr>
          <td colspan="2"><div align="center"><span class="requerido">
              <button type="button" name="Continuar"  id="Continuar" class="button"  onclick="javascript:send('Continuar');">Continuar</button>
              
          </span></div></td>
        </tr>
      </table-->
	<div style="width: 100%;height: 20px;">
	</div>
	</form>
<?php
			}
			function showFooter()
			{
				$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
				//var_dump($ids_elementos_validar);

				for ($i = 0; $i < count($ids_elementos_validar); $i++) {
					echo "<script> document.getElementById('" . $ids_elementos_validar[$i] . "').style.border='1px solid Red'; </script>";
				}

				$aPageErrors = $GLOBALS['aPageErrors'];
				print (isset($aPageErrors) && count($aPageErrors) > 0) ? "<script>  document.getElementById(\"texto\").innerText =('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '" . '\n' . join('\n', $aPageErrors) . "'); document.getElementById(\"titulo\").style.backgroundColor = \"#DC3831\"; //Rojo
				document.getElementById(\"titulo\").style.color = \"white\";
				document.getElementById(\"titulo\").innerText = (\"Atención\");
				document.getElementById(\"alerta\").style.display = \"Block\";</script>" : "";
			}
?>

<?php include('footer.php'); ?>