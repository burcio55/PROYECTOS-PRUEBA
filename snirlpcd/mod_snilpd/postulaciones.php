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
    $persona4 = pg_fetch_assoc($row4); */

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

    /*  $sqli = ("SELECT * FROM snirlpcd.persona_exp_laboral WHERE persona_id = '" . $persona_id . "';");
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
    } */
}
/* $select = ("SELECT * FROM snirlpcd.postulaciones WHERE benabled = 'true' AND persona_id=" . $persona_id . " ORDER BY id");
$row7 = pg_query($conn, $select); */

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
                    <h3 class="card-title"> Postulaciones </h3>
                </div>
            </div>
            <div class="card card-info" style="border-radius: 30px">
                <form class="form-horizontal">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12"><br></div>
                            <div class="col-sm-12">
                                <?php
                                $id_postulacion = $_SESSION['id_postulacion'];
                                $post_q = "SELECT ";
                                $post_q .= " snirlpcd.postulaciones.id,";
                                $post_q .= " snirlpcd.postulaciones.oferta_empleo_id,";
                                $post_q .= " snirlpcd.postulaciones.persona_id,";
                                $post_q .= " snirlpcd.postulaciones.benabled,";
                                $post_q .= " snirlpcd.persona.snacionalidad,";
                                $post_q .= " snirlpcd.persona.ncedula,";
                                $post_q .= " snirlpcd.persona.sprimer_nombre,";
                                $post_q .= " snirlpcd.persona.ssegundo_nombre,";
                                $post_q .= " snirlpcd.persona.sprimer_apellido,";
                                $post_q .= " snirlpcd.persona.ssegundo_apellido,";
                                $post_q .= " snirlpcd.estatus.sdescripcion,";
                                $post_q .= " snirlpcd.estatus_postulaciones.sobservacion,";
                                $post_q .= " rnee.rnee_empresa.srazon_social,";
                                $post_q .= " rnee.rnee_empresa.sdenominacion_comercial,";
                                $post_q .= " public.entidad.sdescripcion as estado,";
                                $post_q .= " snirlpcd.oferta_empleo.rnee_condicion_actividad_movimiento_id,";
                                $post_q .= " snirlpcd.oferta_empleo.snombre_cargo,";
                                $post_q .= " snirlpcd.oferta_empleo.shora_entrada_trab,";
                                $post_q .= " snirlpcd.oferta_empleo.shora_salida_trab,";
                                $post_q .= " snirlpcd.oferta_empleo.nvacante,";
                                $post_q .= " snirlpcd.oferta_empleo.benabled,";
                                $post_q .= " rnee.rnee_condicion_actividad_movimiento.rnee_empresa_id as empresa,";
                                $post_q .= " rnee.rnee_condicion_actividad_movimiento.rnee_sucursal_id as sucursal,";
                                $post_q .= " rnee.rnee_sucursales.sdenominacion_comercial as nombre_sucursal,";
                                $post_q .= " rnee.rnee_sucursales.sdireccion as dir_sucursal";
                                $post_q .= " FROM";
                                $post_q .= " rnee.rnee_condicion_actividad_movimiento";
                                $post_q .= " INNER JOIN snirlpcd.oferta_empleo";
                                $post_q .= " ON snirlpcd.oferta_empleo.rnee_condicion_actividad_movimiento_id = rnee.rnee_condicion_actividad_movimiento.id";
                                $post_q .= " INNER JOIN rnee.rnee_empresa";
                                $post_q .= " ON rnee.rnee_empresa.id = rnee.rnee_condicion_actividad_movimiento.rnee_empresa_id";
                                $post_q .= " INNER JOIN rnee.rnee_sucursales";
                                $post_q .= " ON rnee.rnee_sucursales.id = rnee.rnee_condicion_actividad_movimiento.rnee_sucursal_id";
                                $post_q .= " INNER JOIN public.parroquia";
                                $post_q .= " ON public.parroquia.nparroquia = rnee.rnee_empresa.parroquia_id";
                                $post_q .= " INNER JOIN public.municipio";
                                $post_q .= " ON public.municipio.nmunicipio = parroquia.nmunicipio";
                                $post_q .= " INNER JOIN public.entidad";
                                $post_q .= " ON public.entidad.nentidad = parroquia.nentidad";
                                $post_q .= " INNER JOIN snirlpcd.postulaciones";
                                $post_q .= " ON snirlpcd.postulaciones.oferta_empleo_id = snirlpcd.oferta_empleo.id ";
                                $post_q .= " INNER JOIN snirlpcd.persona";
                                $post_q .= " ON snirlpcd.persona.id = snirlpcd.postulaciones.persona_id";
                                $post_q .= " INNER JOIN snirlpcd.estatus_postulaciones";
                                $post_q .= " ON snirlpcd.estatus_postulaciones.postulaciones_id=snirlpcd.postulaciones.id";
                                $post_q .= " INNER JOIN snirlpcd.estatus";
                                $post_q .= " ON snirlpcd.estatus.id = snirlpcd.estatus_postulaciones.estatus_id";
                                $post_q .= " WHERE";
                                $post_q .= " snirlpcd.postulaciones.benabled='TRUE' ";
                                $post_q .= " AND snirlpcd.persona.benabled='TRUE'";
                                $post_q .= " AND snirlpcd.estatus.benabled='TRUE'";
                                $post_q .= " AND snirlpcd.estatus_postulaciones.benabled='TRUE'";
                                $post_q .= " AND snirlpcd.postulaciones.persona_id='$persona_id'";
                                $post_q .= " AND rnee.rnee_condicion_actividad_movimiento.nenabled='1'";
                                $post_q .= " ORDER BY snirlpcd.estatus_postulaciones.estatus_id ASC";
                                /* $row8 = pg_query($conn, $post_q); */
                                ?>
                                <table id="myTable" class="table table-striped" style="text-align: left;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Entidad de Trabajo</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Cargo</th>
                                            <th scope="col">Estatus</th>
                                            <th scope="col">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $row8 = pg_query($conn, $post_q);
                                        while ($postulacion = pg_fetch_assoc($row8)) {
                                            if ($postulacion['sdescripcion'] != 'Inhabilitado') {
                                                $i++;
                                        ?>
                                                <tr>
                                                    <th scope="row"><? echo $i ?></th>
                                                    <td><? echo $postulacion['srazon_social']; ?></td>
                                                    <td><? echo $postulacion['estado']; ?></td>
                                                    <td><? echo $postulacion['snombre_cargo']; ?></td>
                                                    <td><? echo $postulacion['sdescripcion']; ?></td>
                                                    <td id="botones">
                                                        <!-- background-color: #008cba;  -->
                                                        <?php
                                                        $estatus_id = $postulacion['sdescripcion'];
                                                        if ($estatus_id == 'Enviado' || $estatus_id == 'Recibido') {
                                                        ?>
                                                            <a href="delete_postulacion.php?id=<? echo $postulacion["id"]; ?>">
                                                                <button type="button" class="btn btn-danger" style="border-radius: 30px;">Eliminar Postulación</button>
                                                            </a>
                                                        <?php
                                                        } else
                                                    if ($estatus_id == 'Admitido') {
                                                        ?>
                                                            <a href="delete_postulacion.php?id=<? echo $postulacion["id"]; ?>">
                                                                <button type="button" class="btn btn-danger" style="border-radius: 30px;">Eliminar Postulación</button>
                                                            </a>
                                                        <?php
                                                        } else
                                                    if ($estatus_id == 'Rechazado') {
                                                        ?>
                                                            <a href="delete_postulacion.php?id=<? echo $postulacion["id"]; ?>">
                                                                <button type="button" class="btn btn-danger" style="border-radius: 30px;">Eliminar Postulación</button>
                                                            </a>
                                                        <?php
                                                        } else
                                                    if ($estatus_id == 'Citado' || $estatus_id == 'Entrevista') {
                                                        ?>
                                                            <a href="entrevista_oferta.php?id=<? echo $postulacion["id"]; ?>">
                                                                <button type="button" class="btn btn-primary" style="border-radius: 30px;">Ver Fecha y Hora</button>
                                                            </a>
                                                        <?php
                                                        } else
                                                    if ($estatus_id == 'Aceptó Entrevista') {
                                                        ?>
                                                            <a href="entrevista_oferta.php?id=<? echo $postulacion["id"]; ?>">
                                                                <button type="button" class="btn btn-primary" style="border-radius: 30px;">Ver Fecha y Hora</button>
                                                            </a>
                                                        <?php
                                                        } else
                                                    if ($estatus_id == 'Rechazó Entrevista') {
                                                        ?>
                                                            <a href="delete_postulacion.php?id=<? echo $postulacion["id"]; ?>">
                                                                <button type="button" class="btn btn-danger" style="border-radius: 30px;">Eliminar Postulación</button>
                                                            </a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                        <? }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-7">
                                <a href="oportunidad.php">
                                    <div style="background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px;margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" title="Registrar Usuario" type="submit">Regresar</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
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