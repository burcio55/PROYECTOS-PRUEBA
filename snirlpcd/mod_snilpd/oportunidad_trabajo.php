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
    /*if ($persona == '') {
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
	} 

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
    }*/
}
$select = "SELECT";
$select .= " rnee.rnee_empresa.srif,";
$select .= " rnee.rnee_empresa.id,";
$select .= " rnee.rnee_empresa.srazon_social,";
$select .= " public.entidad.sdescripcion AS estado,";
$select .= " snirlpcd.oferta_empleo.id AS oferta_empleo_id,";
$select .= " snirlpcd.oferta_empleo.rnee_condicion_actividad_movimiento_id,";
$select .= " snirlpcd.oferta_empleo.snombre_cargo,";
$select .= " snirlpcd.oferta_empleo.dfecha_creacion AS fecha_publicacion,";
$select .= " snirlpcd.oferta_empleo.benabled,";
$select .= " snirlpcd.oferta_empleo.nvacante,";
$select .= " rnee.rnee_condicion_actividad_movimiento.rnee_empresa_id AS empresa,";
$select .= " rnee.rnee_condicion_actividad_movimiento.rnee_sucursal_id AS sucursal,";
$select .= " rnee.rnee_sucursales.sdenominacion_comercial AS nombre_sucursal";
$select .= " FROM";
$select .= " rnee.rnee_condicion_actividad_movimiento";
$select .= " INNER JOIN snirlpcd.oferta_empleo";
$select .= " ON snirlpcd.oferta_empleo.rnee_condicion_actividad_movimiento_id = rnee.rnee_condicion_actividad_movimiento.id";
$select .= " INNER JOIN rnee.rnee_empresa";
$select .= " ON rnee.rnee_empresa.id = rnee.rnee_condicion_actividad_movimiento.rnee_empresa_id";
$select .= " INNER JOIN rnee.rnee_sucursales";
$select .= " ON rnee.rnee_sucursales.id = rnee.rnee_condicion_actividad_movimiento.rnee_sucursal_id";
$select .= " INNER JOIN public.parroquia";
$select .= " ON public.parroquia.nparroquia = rnee.rnee_empresa.parroquia_id";
$select .= " INNER JOIN public.municipio";
$select .= " ON public.municipio.nmunicipio = parroquia.nmunicipio";
$select .= " INNER JOIN public.entidad";
$select .= " ON public.entidad.nentidad = parroquia.nentidad";
$select .= " WHERE";
$select .= " rnee.rnee_condicion_actividad_movimiento.nenabled='1'";
/* $select .= " AND";
$select .= " rnee.rnee_condicion_actividad_movimiento.rnee_sucursal_id!='0'"; */
$select .= " AND";
$select .= " snirlpcd.oferta_empleo.benabled='TRUE'";
$select .= " AND";
$select .= " snirlpcd.oferta_empleo.nvacante>'0'";
/* $select .= " ORDER BY srazon_social ASD"; */

/* $select2 = ("SELECT * FROM snirlpcd.oferta_empleo WHERE benabled = 'true'");
$row2 = pg_query($conex, $select2);	 */

/* echo $select; */

$row7 = pg_query($conn, $select);

?>
<!-- <th scope="col">#</th>
<th scope="col">Entidad de Trabajo</th>
<th scope="col">Cargo</th>
<th scope="col">Entidad Federal</th>
<th scope="col">Fecha de Publicación</th>
<th scope="col">Acción</th> -->

<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<div class="wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary" style="border-radius: 30px">
                <div class="card-header" style="border-radius: 30px">
                    <h3 tabindex="6" class="card-title"> Consultar Vacantes de Empleo </h3>
                </div>
            </div>
            <div class="card card-info" style="border-radius: 30px">
                <form class="form-horizontal">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12"><br></div>
                            <div class="col-sm-12">
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                        <center>
                                            <tr tabindex="7">
                                                <th tabindex="8" aria-label="número" scope="row" style="text-align: center">#</th>
                                                <th tabindex="9" aria-label="Entidad de trabajo" scope="col" style="text-align: center">Entidad de Trabajo</th>
                                                <th tabindex="10" aria-label="Entidad Federal" scope="col" style="text-align: center">Principal / Sucursal</th>
                                                <th tabindex="11" aria-label="Nombre del cargo" scope="col" style="text-align: center">Nombre del Cargo</th>
                                                <th tabindex="12" aria-label="Fecha de publicación" scope="col" style="text-align: center">Fecha de Públicación</th>
                                                <th tabindex="13" aria-label="Botones" scope="col" style="text-align: center; width: 15%">Acción</th>
                                            </tr>
                                    </thead>
                                    <? $t = 14; ?>
                                    <tbody>
                                        <? while ($persona7 = pg_fetch_assoc($row7)) { ?>
                                            <? $i++ ?>
                                            <tr>
                                                <th scope="row" tabindex="<? echo $t++; ?>" aria-label="<? echo $i; ?>" style="text-align: left">
                                                    <? echo $i; ?>
                                                </th>

                                                <td tabindex="<? echo $t++; ?>" aria-label="<? echo $persona7['srazon_social'] ?>" style="text-align: left">
                                                    <? echo $persona7['srazon_social'] ?>
                                                </td>
                                                <?
                                                /* echo "ID de de la Sucursal: " . $persona7["sucursal"]; */
                                                if ($persona7["rnee_sucursal_id"] != '0') {
                                                    $select4 = ("SELECT * FROM rnee.rnee_sucursales WHERE id = '" . $persona7['sucursal'] . "'");
                                                    $row4 = pg_query($conn, $select4);
                                                    $valor4 = pg_fetch_assoc($row4);
                                                    $nombre = $valor4['sdenominacion_comercial'];
                                                } else {
                                                    $select4 = ("SELECT * FROM rnee.rnee_empresa WHERE id = '" . $persona7['empresa'] . "'");
                                                    $row4 = pg_query($conn, $select4);
                                                    $valor4 = pg_fetch_assoc($row4);
                                                    $nombre = $valor4['nombre_sucursal'];
                                                }
                                                if ($nombre == 's/n') {
                                                    $nombre = 'Sede Principal';
                                                }
                                                ?>
                                                <td tabindex="<? echo $t++; ?>" aria-label="<? echo $nombre; ?>" style="text-align: left">
                                                    <? echo $nombre; ?>

                                                </td>
                                                <td tabindex="<? echo $t++; ?>" aria-label="<? echo $persona7['snombre_cargo'] ?>" style="text-align: left">
                                                    <? echo $persona7['snombre_cargo'] ?>
                                                </td>
                                                <td tabindex="<? echo $t++; ?>" aria-label="<? echo $persona7['fecha_publicacion'] ?>" style="text-align: left">
                                                    <? echo $persona7['fecha_publicacion'] ?>
                                                </td>
                                                <td style="text-align: auto">
                                                    <a href="Detalles_oferta.php?id=<?php echo $persona7['oferta_empleo_id']; ?>&id_sucursal=<?php echo $persona7['sucursal']; ?>&id_empresa=<?php echo $persona7['id']; ?>">
                                                        <div tabindex="<? echo $t++; ?>" aria-label="Ver detalles" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 20px; float: right; border-radius: 30px; font-size:16px; margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit">Ver detalles</div>
                                                    </a>
                                                </td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                    </center>
                                </table>
                            </div>
                            <div class="col-sm-7">
                                <a href="oportunidad.php">
                                    <div tabindex="<? echo $t++; ?>" aria-label="Regresar" style="background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px;margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit">Regresar</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- <script src="oportunidad_trabajo.js"></script> -->
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