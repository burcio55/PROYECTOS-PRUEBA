<? include("header.php"); ?>

<?php

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

    $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
    $row = pg_query($conn, $consulta);
    $persona = pg_fetch_assoc($row);

    $persona_id = $persona["id"];

    // Validaciones de la tabla "persona" de "Datos Personales"
    if ($persona == '') {
        echo '
			<script>
				alert ("Usted no se ha registrado aún");
				window.location="../index.php";
			</script>
		';
        die();
    } else {
        if ($persona["snacionalidad"] == '' || $persona["ncedula"] == '' || $persona["sprimer_nombre"] == '' || $persona["sprimer_apellido"] == '' || $persona["ssexo"] == '' || $persona["dfecha_nacimiento"] == '' || $persona["semail"] == '') {
            echo '
				<script>
					alert ("No registró los datos básicos obligatorios");
					window.location="../index.php";
				</script>
			';
            die(); // $persona["npais_nac_id"] == '' || $persona["entidad_nac_id"] == ''
        } else 
		if ($persona["npais_nac_id"] == '') {
            echo '
				<script>
					alert ("No registró su País de Nacimiento");
					window.location="datos_personales.php";
				</script>
			';
            die(); // $persona["npais_nac_id"] == '' || $persona["entidad_nac_id"] == ''
        } else 
		if ($persona["entidad_nac_id"] == '') {
            echo '
				<script>
					alert ("No registró su Estado de Nacimiento");
					window.location="datos_personales.php";
				</script>
			';
            die(); // $persona["npais_nac_id"] == '' || $persona["entidad_nac_id"] == ''
        } else
		if ($persona["stelefono_personal"] == '' && $persona["stelefono_habitacion"] == '') {
            echo '
				<script>
					alert ("Debe guardar al menos un número de contacto");
					window.location="datos_personales.php";
				</script>
			';
            die();
        } else 
		if ($persona["npais_residencia_id"] == '' || $persona["nentidad_residencia_id"] == '' || $persona["nmunicipio_residencia_id"] == '' || $persona["nparroquia_residencia_id"] == '') {
            echo '
				<script>
					alert ("No llenó todos los requisitos de su residencia");
					window.location="datos_personales.php";
				</script>
			';
            die();
        } else 
		if ($persona["bjefe_familia"] == '') {
            echo '
				<script>
					alert ("No especificó si es Jefe de Familia");
					window.location="datos_personales.php";
				</script>
			';
            die();
        } else 
		if ($persona["btiene_hijo"] == '') {
            echo '
				<script>
					alert ("No especificó si tiene hijos o no");
					window.location="datos_personales.php";
				</script>
			';
            die();
        } else
		if ($persona["btiene_hijo"] == 'true') {
            if ($persona["nhijos_menores18"] == '') {
                echo '
					<script>
						alert ("Es obligatorio decir cuántos hijos menores tiene");
						window.location="datos_personales.php";
					</script>
				';
                die();
            }
        } else 
		if ($persona["bcarnet_patria"] == '') {
            echo '
				<script>
					alert ("No especificó si tiene Carnet de la Patria o no");
					window.location="datos_personales.php";
				</script>
			';
            die();
        } else
		if ($persona["bcarnet_patria"] == 'true') {
            if ($persona["scodigo_carnet_patria"] == '') {
                echo '
					<script>
						alert ("Es obligatorio decir el código de tu Carnet de la Patria");
						window.location="datos_personales.php";
					</script>
				';
                die();
            } else
			if ($persona["sserial_carnet_patria"] == '') {
                echo '
					<script>
						alert ("Es obligatorio decir el serial de tu Carnet de la Patria");
						window.location="datos_personales.php";
					</script>
				';
                die();
            }
        }
    }

    // Consulta con la tabla "persona_nivel_educativo" de "Educación"

    $query = ("SELECT * FROM snirlpcd.persona_nivel_educativo WHERE persona_id = '" . $persona_id . "';");
    $row2 = pg_query($conn, $query);
    $persona2 = pg_fetch_assoc($row2);

    // Validaciones de la tabla "persona_nivel_educativo" de "Educación"

    if ($persona2 == '') {
        echo '
			<script>
				alert ("Usted no ha registrado nada en \"Educación\"");
				window.location="educacion.php";
			</script>
		';
        die();
    }

    // Consulta con la tabla "persona_capacitacion" de "Capacitación"

    $PG = ("SELECT * FROM snirlpcd.persona_capacitacion WHERE persona_id = '" . $persona_id . "';");
    $row3 = pg_query($conn, $PG);
    $persona3 = pg_fetch_assoc($row3);

    // Validaciones de la tabla "persona_capacitacion" de "Capacitación"

    if ($persona3 == '') {
        echo '
			<script>
				alert ("Usted no ha registrado nada en \"Capacitación\"");
				window.location="capacitacion.php";
			</script>
		';
        die();
    }

    // Consulta con la tabla "persona_sit_ocupacional" de "Situación Ocupacional"

    $sql = ("SELECT * FROM snirlpcd.persona_sit_ocupacional WHERE persona_id = '" . $persona_id . "';");
    $row4 = pg_query($conn, $sql);
    $persona4 = pg_fetch_assoc($row4);

    // Validaciones de la tabla "persona_sit_ocupacional" de "Situación Ocupacional"

    /* if ($persona4 == '') {
		echo '
			<script>
				alert ("Usted no ha registrado nada en \"Situación Ocupacional\"");
				window.location="situacion_ocupacional.php";
			</script>
		';
		die();
	} else {
		if ($persona4["situacion_laboral_id"] == '') {
			echo '
				<script>
					alert ("Faltó mencionar cuál es su situación laboral actual");
					window.location="situacion_ocupacional.php";
				</script>
			';
			die();
		} else
		if ($persona4["ocupacion1_id"] == '') {
			echo '
				<script>
					alert ("Faltó especificar su Primera Opción");
					window.location="situacion_ocupacional.php";
				</script>
			';
			die();
		} else
		if ($persona4["sexperiencia1"] == '') {
			echo '
				<script>
					alert ("Faltó especificar su nivel de experiencia en su Primera Opción");
					window.location="situacion_ocupacional.php";
				</script>
			';
			die();
		}
	} */

    // Consulta con la tabla "persona_exp_laboral" de "Experiencia Laboral"

    $sqli = ("SELECT * FROM snirlpcd.persona_exp_laboral WHERE persona_id = '" . $persona_id . "';");
    $row5 = pg_query($conn, $sqli);
    $persona5 = pg_fetch_assoc($row5);

    // Validaciones de la tabla "persona_exp_laboral" de "Experiencia Laboral"

    if ($persona5 == '') {
        echo '
			<script>
				alert ("No mencionó sí tiene experiencia laboral o no en \"Experiencia Laboral\"");
				window.location="experiencia_laboral.php";
			</script>
		';
        die();
    }

    // Consulta con la tabla "persona_fotos" de "Experiencia Laboral"

    $select = ("SELECT * FROM snirlpcd.persona_fotos WHERE persona_id = '" . $persona_id . "';");
    $row6 = pg_query($conn, $select);
    $persona6 = pg_fetch_assoc($row6);

    // Validaciones de la tabla "persona_fotos" de "Experiencia Laboral"

    if ($persona6 == '') {
        echo '
			<script>
				alert ("No ha subido ninguna Foto");
				window.location="foto.php";
			</script>
		';
        die();
    }
}
$postulaciones_id = $_REQUEST["postuacion_id"];

$select = ("SELECT * FROM snirlpcd.entrevista WHERE postulaciones_id = '$postulaciones_id' AND benabled = 'TRUE'");
$row7 = pg_query($conn, $select);
$entrevista = pg_fetch_assoc($row7);

$fecha = $entrevista["dfecha_entrevista"];
$hora = $entrevista["shora_entrevista"];
$text = $entrevista["slugar_entrevista"];
$entrevista_id = $entrevista["id"];

?>

<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<div class="wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary" style="border-radius: 30px">
                <div class="card-header" style="border-radius: 30px">
                    <h3 class="card-title"> Entrevista </h3>
                </div>
            </div>
            <div class="card card-info" style="border-radius: 30px">
                <div style="padding: 10px; text-align: right; margin-bottom: -25px">
                    <h4 style="color: #BF1F13; font-size: 15px;"> Campos obligatorios (*) </h4>
                </div>
                <form class="form-horizontal">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-2 text-center" style="margin-top: 20px">
                                <h3> Fecha: </h3>
                            </div>
                            <div class="col-sm-3 text-center" style="margin-top: 20px">
                                <h4><?php echo $fecha; ?></h4>
                            </div>
                            <div class="col-sm-2 text-center" style="margin-top: 20px">
                                <h3> Hora: </h3>
                            </div>
                            <div class="col-sm-3 text-center" style="margin-top: 20px">
                                <h4><?php echo $hora; ?></h4>
                            </div>
                            <hr>
                            <div class="col-sm-12 text-center">
                                <h3 > Ubicación y Contacto:</h3>
                                <h4><?php echo $text; ?></h4>
                            </div>
                            <hr>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10 text-center">
                                <h3> ¿Por qué no podrá asistir a la entrevista?: <span style="color: red;"> *</span></h3>
                                <textarea class="form-control" id="razon" name="razon" style="border-radius: 30px;" onkeyup="mayus(this);"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div onclick="enviar_razon(<?php echo $postulaciones_id; ?>, <?php echo $entrevista_id; ?>, razon.value)" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px; margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit">Enviar</div>
                            <a href="postulaciones.php">
                                <div style="background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px;margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit">Regresar</div>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="postulacion_persona.js"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });
    </script>
</div>
<? include("footer.php"); ?>