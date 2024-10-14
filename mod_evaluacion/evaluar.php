<div style=" display:none; " class="fondo_alerta" id="alerta">
    <div class="alerta">
        <h4 id="titulo">Atención</h4>
        <p id="mensaje"></p>
        <center>

            <button type="button" style="margin-bottom: 20px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="cerrar()">Cerrar</button>
        </center>
    </div>
</div>

<?php
include("header.php");
include("BD.php");

$SQL = "SELECT
		personales.id as id,
		personales.cedula as cedula,
		personales.nacionalidad as nacionalidad,
		personales.primer_apellido as apellido1,
		personales.segundo_apellido as apellido2,
		personales.primer_nombre as nombre1,
		personales.segundo_nombre as nombre2,
		recibo_pago.ncodigo_nomina as codigo_nom,
		personales.subicacion_fisica as ubicacion_fisica_actual,
		personales.scargo_actual_ejerce as cargo_actual_ejerce,
		public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
		public.cargos.sdescripcion as cargo,
		public.cargos.id as cargo_id,
		public.tipo_trabajador.ncodigo as codigo_tipos_trabajadores,
		public.ubicacion_administrativa.sdescripcion as ubicacion_adm,
		public.ubicacion_administrativa.scodigo as ubicacion_scodigo
		FROM
		public.personales LEFT JOIN
		recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula LEFT JOIN
		public.cargos on recibo_pago.cargos_id = cargos.id LEFT JOIN
		public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo LEFT JOIN
		public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo LEFT JOIN
		public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo
		WHERE
		personales.cedula ='" . $_SESSION["id_usuario"] . "'
		AND
		recibo_pago.nestatus='1'
		order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC
		LIMIT 1
";

$row = pg_query($conn, $SQL);
$persona = pg_fetch_assoc($row);

$persona_id = $persona["id"];
$cedula = $persona["cedula"];
$nacionalidad = $persona["nacionalidad"];

$_SESSION["Persona_id"] = $persona_id;
$_SESSION["Cedula"] = $cedula;

$apellido1 = $persona["apellido1"];
$apellido2 = $persona["apellido2"];
$nombre1 = $persona["nombre1"];
$nombre2 = $persona["nombre2"];

echo $nombre_completo;

$nombre_completo = $apellido1 . " " . $apellido2 . " " . $nombre1 . " " . $nombre2;

$codigo_nom = $persona["codigo_nom"];
$ubicacion_fisica_actual = $persona["ubicacion_fisica_actual"];
$cargo_actual_ejerce = $persona["cargo_actual_ejerce"];
$tipo_trabajador = $persona["tipo_trabajador"];
$cargo = $persona["cargo"];
$cargo_id = $persona["cargo_id"];
$codigo_tipos_trabajadores = $_SESSION["codigo_tipos_trabajadores"];
$ubicacion_adm = $persona["ubicacion_adm"];
$ubicacion_scodigo = $persona["ubicacion_scodigo"];

$periodo = $_SESSION["Periodo"];
$ayo = date('y');

if ($periodo == 1) {
	$desde = "01/01/" . $ayo;
	$hasta = "31/03/" . $ayo;
} else
if ($periodo == 2) {
	$desde = "01/04/" . $ayo;
	$hasta = "30/06/" . $ayo;
} else
if ($periodo == 3) {
	$desde = "01/7/" . $ayo;
	$hasta = "31/9/" . $ayo;
} else
if ($periodo == 4) {
	$desde = "01/10/" . $ayo;
	$hasta = "31/12/" . $ayo;
}

$_SESSION["Desde"] = $desde;
$_SESSION["Hasta"] = $hasta;

$_SESSION['id_evaluacion']="";

?>
<div style="width: 35%; height: auto; padding: 0; border-radius: 30px; position: fixed; margin-top: 30vh; margin-left: 30%; z-index: 50; background-color: white; border: solid 1px gray; display:none" id="alerta">
<div class="presion" style="margin-top: -11px;">
	<h4 id="titulo" style="padding: 7px 20px; border-radius: 30px 30px 0 0; background-color: rgb(8, 150, 197); color: white;">Atención</h4>
	<p id="mensaje" style="text-align: justify; padding: 5px 20px; font-size: 20px; text-align: center;"></p>
	<button type="button" style="margin-bottom: 20px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" id="cerrar1" onclick="cerrar()">Cerrar</button>
	<button type="button" style="margin-bottom: 20px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; display:none" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" id="cerrar2" onclick="cerrar2()">Cerrar2</button>
</div>
</div>

<main>
	<div class="content-3d">
		<div class="container">
			<?
            include('menu2.php');
            ?>
			<div class="content-login">
				<div class="row">
                    <div class="col-sm-6">
                        <h1 style="font-size:32px; font-weight: normal;">ODI - Evaluación</h1>
                    </div>
                    <div class="col-sm-3"></div>
					<div class="col-sm-3">
                        <h6 class="obligatorio">Datos Obligatorios (*)</h6>
                    </div>
                    <div class="sep"></div>
                    <hr>
                    <div class="sep"></div>
                </div>

				<form name="formulario" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" id="formulario">
					<div class="row">

						<div class="col-sm-4">
                            <h2 style="color: rgb(35, 96, 249); font-size:22px;">PERIODO EVALUADO</h2>
                        </div>
						<div class="col-sm-4"></div>
                        <div class="col-sm-4"></div>

						<div class="col-sm-6">
							<label for="basic-url" class="form-label" style="margin-top:10px">Desde : <span>*</span> </label>
							<input class="form-control" style="background: #b6b4b4b2; color: #313131;border-radius:30px;" disabled name="desde" id="desde" type="text" value="<? echo $desde; ?>" placeholder="" readonly />
						</div>
						<div class="col-sm-6">
							<label for="basic-url" class="form-label" style="margin-top:10px">Hasta : <span>*</span> </label>
							<input class="form-control" style="background: #b6b4b4b2; color: #313131;border-radius:30px;" disabled name="hasta" id="hasta" type="text" value="<? echo $hasta; ?>" placeholder="" readonly />
						</div>

                        <!-- ////////////////////////////////////////////////////////////////////////////////////////// -->

						<div class="sep"></div>
                        <hr>
                        <div class="sep"></div>

                        <div class="col-sm-4">
                            <h2 style="color: rgb(35, 96, 249); font-size:22px;"> DATOS DEL EVALUADOR</h2>
                        </div>

						<div class="col-sm-4"></div>
                        <div class="col-sm-4"></div>

						<div class="col-sm-4">
							<label for="basic-url" class="form-label" style="margin-top:10px">Cédula de Identidad </label> <span></span>
							<div class="input-group">
								<span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
								<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled name="cedula1" id="cedula1" type="text" class="form-control" value="<? echo $cedula; ?>" placeholder="" />
							</div>
						</div>

						<div class="col-sm-8">
							<label for="basic-url" class="form-label" style="margin-top:10px">Apellido(s) y Nombre(s)</label> <span></span>
							<div class="input-group">
								<span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
									<img src="img/co.png" class="input-imagen">
                                </span>
								<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled  name="nombre_apellido1" id="nombre_apellido1" type="text" class="form-control"  value="<? echo $nombre_completo; ?>" placeholder="" readonly />
							</div>
						</div>

						<div class="col-sm-4"> 
							<label for="basic-url" class="form-label" style="margin-top:10px">Código de Nómina</label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
                                <input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled name="codigo1" id="codigo1"  type="text" class="form-control" value="<? echo $codigo_nom; ?>" placeholder="" readonly />
                            </div>
                        </div>

						<div class="col-sm-8">
							<label for="basic-url" class="form-label" style="margin-top:10px">Tipo de Trabajador </label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>

                                <input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled name="tipo_trabajador" id="tipo_trabajador" type="text" class="form-control" value="<? echo $tipo_trabajador; ?>" placeholder="" readonly />
                            </div>
                        </div>

						<div class="sep"></div>
						<div class="col-sm-6"> 
							<label for="basic-url" class="form-label" style="margin-top:10px">Cargo o Puesto de Trabajo que Ejerce</label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
								<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled name="cargo_ejerce1" id="cargo_ejerce1" type="text" class="form-control" value="<? echo $cargo_actual_ejerce; ?>" placeholder="" readonly />
                            </div>
                        </div>

						<div class="col-sm-6">
							<label for="basic-url" class="form-label" style="margin-top:10px">Cargo o Puesto de Trabajo Titular </label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
                                <input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled name="cargo1" id="cargo1" type="text" class="form-control" value="<? echo $cargo; ?>" placeholder="" readonly />
                            </div>
                        </div>

						<div class="col-sm-6"> <label for="basic-url" class="form-label" style="margin-top:10px">Ubicación Administrativa de Adscripción</label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
								<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled name="ubicacion_adm1" id="ubicacion_adm1" type="text" class="form-control" value="<? echo $ubicacion_adm; ?>" placeholder="" readonly />
                            </div>
                        </div>

                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px">Ubicación Física </label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
                                <input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled name="ubicacion_act" id="ubicacion_act" type="text" class="form-control" value="<? echo $ubicacion_fisica_actual; ?>" placeholder="" readonly />
                            </div>
                        </div>

						<div class="sep"></div>
                        <hr>
                        <div class="sep"></div>
						<div class="col-sm-4">
                            <h2 style="color: rgb(35, 96, 249); font-size:22px;"> DATOS DEL EVALUADO</h2>
                        </div>
						<div class="col-sm-4"></div>
                        <div class="col-sm-4"></div>
		
					

						<div class="col-sm-4"> <label for="basic-url" class="form-label" style="margin-top:10px">Cédula de Identidad <span>*</span> </label> <span></span>
                            <div class="input-group">
                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                        <img src="img/co.png" class="input-imagen">
                                    </span>
									<input type="text" class="form-control" placeholder="Ej. 10564238" onkeypress="number(2)" maxlength="8" name="cedula2" id="cedula2" type="text" class="form-control" value="" placeholder="" />
                                <button onclick="buscar(2)" type="button" style="background-color: rgb(70, 162, 253); color: rgb(255, 255, 255); border: 1px solid rgb(70, 162, 253); padding: 7px 22px; border-radius: 0px 30px 30px 0px; width: auto; margin-left: -15px;margin: 0" onmouseout="this.style.color=&quot;#fff&quot;; this.style.backgroundColor=&quot;#46A2FD&quot;; this.style.border=&quot;1px Solid #46A2FD&quot;" onmouseover="this.style.color=&quot;#46A2FD&quot;; this.style.backgroundColor=&quot;#fff&quot;;" data-bs-toggle="tooltip">Buscar</button>
							</div>
                        </div>

						<div class="col-sm-8">
							<label for="basic-url" class="form-label" style="margin-top:10px">Apellido(s) y Nombre(s)</label> <span></span>
							<div class="input-group">
								<span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
									<img src="img/co.png" class="input-imagen">
                                </span>
								<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled name="nombre_apellido2" id="nombre_apellido2" type="text" class="form-control" value="" placeholder="" readonly />
							</div>
						</div>

						<div class="col-sm-4"> 
							<label for="basic-url" class="form-label" style="margin-top:10px">Código de Nómina</label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
								<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled name="codigo2" id="codigo2" type="text" class="form-control" value="" placeholder="" readonly />
                            </div>
                        </div>

						<div class="col-sm-8">
							<label for="basic-url" class="form-label" style="margin-top:10px">Tipo de Trabajador </label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
                                <input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled name="tipo_trabajador2" id="tipo_trabajador2" type="text" class="form-control" value="" placeholder="" readonly />
                            </div>
                        </div>

						<div class="sep"></div>
						<div class="col-sm-6"> 
							<label for="basic-url" class="form-label" style="margin-top:10px">Cargo o Puesto de Trabajo que Ejerce</label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
								<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled name="cargo_ejerce2" id="cargo_ejerce2" type="text" class="form-control" value="" placeholder="" readonly />
                            </div>
                        </div>

						<div class="col-sm-6">
							<label for="basic-url" class="form-label" style="margin-top:10px">Cargo o Puesto de Trabajo Titular </label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
                                <input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled name="cargo2" id="cargo2" type="text" class="form-control" value="" placeholder="" readonly />
                            </div>
                        </div>

						<div class="col-sm-6"> <label for="basic-url" class="form-label" style="margin-top:10px">Ubicación Administrativa de Adscripción</label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
								<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled name="ubicacion_adm2" id="ubicacion_adm2" type="text" class="form-control" value="" placeholder="" readonly />
                            </div>
                        </div>

                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px">Ubicación Física </label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
                                	<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled  name="ubicacion_act2" id="ubicacion_act2" type="text" class="form-control" value="" placeholder="" readonly />
										<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131; display: none;" disabled name="persona_id2" id="persona_id2"type="text" class="form-control" value="" placeholder="" readonly />
										<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131; display: none;" disabled name="rol_evaluacion2" id="rol_evaluacion2" type="text" class="form-control" value="" placeholder="" readonly />
										<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131; display: none;" disabled name="periodo_evaluacion2" id="periodo_evaluacion2" type="text" class="form-control" value="" placeholder="" readonly />
										<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131; display: none;" disabled name="nanno_evalu2" id="nanno_evalu2" type="text" class="form-control" value="" placeholder="" readonly />
										<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131; display: none;" disabled name="cargo_id2" id="cargo_id2" type="text" class="form-control" value="" placeholder="" readonly />
										<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131; display: none;" disabled name="ubicacion_scodigo2" id="ubicacion_scodigo2"type="text" class="form-control" value="" placeholder="" readonly />
										<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131; display: none;" disabled name="codigo_tipos_trabajadores2" id="codigo_tipos_trabajadores2" type="text" class="form-control" value="" placeholder="" readonly />
                            </div>
                        </div>

						<div class="col-sm-6" style="display: none;"> 
							<label for="basic-url" class="form-label" style="margin-top:10px">Incidencia</label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
								<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131; display: none;" disabled name="incidencia" id="incidencia" type="text" class="form-control" value=" " placeholder="" readonly />
                            </div>
                        </div>

						<div class="col-sm-6" style="display: none;"> 
							<label for="basic-url" class="form-label" style="margin-top:10px">Incidencia Fecha</label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
								<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131; display: none;" disabled name="incidencia_fecha" id="incidencia_fecha" type="text" class="form-control" value="1970-01-01" placeholder="" readonly />
                            </div>
                        </div>

						<div class="col-sm-6" style="display: none;"> 
							<label for="basic-url" class="form-label" style="margin-top:10px">Incidencia Observaciones</label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>
								<input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2; color: #313131" disabled name="ubicacion_adm2" id="ubicacion_adm2" type="text" class="form-control" value="" placeholder="" readonly />
                            </div>
                        </div>

						<div class="sep"></div>
                        <hr>
                        <div class="sep"></div>

						<div class="col-sm-4">
                            <h2 style="color: rgb(35, 96, 249); font-size:22px;">PAUTAS DEL PROCEDIMIENTO DE EVALUACIÓN</h2>
                        </div>

						<div class="col-sm-4"></div>
                        <div class="col-sm-4"></div>

						<div class="col-sm-12"><label for="basic-url" class="form-label" style="margin-top:10px">
                                <h5>Módulo I:</h5>
                            </label> <br><i>En este módulo se establecen los Objetivos de Desempeño Individual (O.D.I) que los servidores públicos deben cumplir en el período a evaluar.</i></div>
                        <div class="col-sm-12"><label for="basic-url" class="form-label" style="margin-top:10px">
                                <h5>Módulo II: </h5>
                            </label><br><i>En este módulo se ponderan las competencias con relación al cargo y se evalúan de acuerdo al grado en que estén presentes en el evaluado o evaluada. El Peso asignado a cada competencia no puede ser mayor a siete (7). Y la sumatoria de los pesos no debe superar los cincuenta (50) puntos.</i></div>
                        <div class="col-sm-12"><label for="basic-url" class="form-label" style="margin-top:10px">
                                <h5>Módulo III: </h5>
                            </label><br><i>En este módulo se obtendrá el Rango de Actuación del Evaluado.</i></div>
                        <div class="col-sm-12"><label for="basic-url" class="form-label" style="margin-top:10px">
                                <h5>Módulo IV: </h5>
                            </label><br><i>En este módulo se expresan las acotaciones con respecto a los resultados de la evaluación del servidor público, así como las prácticas a seguir para mejorar el desempeño.</i></div>
                        <div class="sep"></div>
                        <hr>
                        <div class="sep"></div>

						<div class="col-sm-8">
                            <h2 style="color: rgb(35, 96, 249); font-size:22px;"> MÓDULO I: ESTABLECIMIENTO Y EVALUACIÓN DE OBJETIVOS DEL DESEMPEÑO INDIVIDUAL</h2>
                        </div>

						<div class="col-sm-4"></div>

                        <div class="col-sm-12">
                            <h6 style="color: #BF1F13">* ITEM OBLIGATORIOS: Los ODIS establecidos (1-2-3), deben contener las competencias indicadas.</h6>
                        </div>
                        <div class="col-sm-12">
                            <h6 style="color: #BF1F13">Los cinco (5) ODIS faltantes deben ser redactados por el Supervisor Evaluador, colocando un verbo en infinitivo ejemplo ar, er, ir... y un indicador, tales como: calidad, costo y oportunidad.</h6>
                        </div>

						<div class="sep"></div>
                        <hr>
                        <div class="sep"></div>

                        <div class="col-sm-6">OBJETIVOS DEL DESEMPEÑO INDIVIDUAL (ODIS)</div>
                        <div class="col-sm-2">PESO</div>
                        <div class="col-sm-2">RANGOS</div>
                        <div class="col-sm-2">PESO X RANGO</div>

						<div class="col-sm-6">
							<label for="basic-url" class="form-label" style="margin-top:10px">
                                <h5>*Asistencia y Puntualidad al Trabajo </h5>
                            </label>
                        </div>

						<div class="col-sm-2">
                            <div class="input-group">
								<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control"  name="peso1" id="peso1" type="text" value="5" disabled placeholder="" /> <span class="requerido"> * </span>
                            </div>
                        </div>

						<div class="col-sm-2">
							<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(1)" id="rango1" name="rango1">
								<option value="">Seleccione </option>
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
									<option value="4"> 4 </option>
									<option value="5"> 5 </option>
							</select>
							<span class="requerido"> * </span>
						</div>

						<div class="col-sm-2">
                            <div class="input-group">
								<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango1" id="peso_rango1" type="text" value="" disabled placeholder="" />
                            </div>
                        </div>

						<div class="col-sm-6">
							<label for="basic-url" class="form-label" style="margin-top:10px">
                                <h5>*Asistencia y Puntualidad a las Reuniones de Trabajo </h5>
                            </label>
                        </div>

						<div class="col-sm-2">
                            <div class="input-group">
								<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control"  name="peso2" id="peso2" type="text" value="5" disabled placeholder="" /> <span class="requerido"> * </span>
                            </div>
                        </div>

						<div class="col-sm-2">
							<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(2)" id="rango2" name="rango2">
								<option value="">Seleccione </option>
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
									<option value="4"> 4 </option>
									<option value="5"> 5 </option>
							</select>
							<span class="requerido"> * </span>
						</div>

						<div class="col-sm-2">
                            <div class="input-group">
								<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango2" id="peso_rango2" type="text" value="" disabled placeholder="" />
                            </div>
                        </div>

						<div class="col-sm-6">
							<label for="basic-url" class="form-label" style="margin-top:10px">
                                <h5>*Asistencia y Puntualidad a los Despliegues de Campo</h5>
                            </label>
                        </div>

						<div class="col-sm-2">
                            <div class="input-group">
								<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control"  name="peso3" id="peso3" type="text" value="6" disabled placeholder="" />
								<span class="requerido"> * </span>
                            </div>
                        </div>

						<div class="col-sm-2">
							<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(3)" id="rango3" name="rango3">
								<option value="">Seleccione </option>
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
									<option value="4"> 4 </option>
									<option value="5"> 5 </option>
							</select>
							<span class="requerido"> * </span>
						</div>

						<div class="col-sm-2">
                            <div class="input-group">
								<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango3" id="peso_rango3" type="text" value="" disabled placeholder="" />
                            </div>
                        </div>

						<div class="col-sm-6">
                            <div class="input-group"><label for="basic-url" class="form-label" style="margin-top:10px">
                                    <h6 style="margin-right: 10px;">4 </h6>
                                </label>
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="descripcion1" id="descripcion1" cols="30" rows="10"/>
								<span class="requerido"> * </span>
                            </div>
                        </div>

						<div class="col-sm-2">
							<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="suma_modulo1(4)" id="peso4" name="peso4">
								<option value="">Seleccione </option>
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
									<option value="4"> 4 </option>
									<option value="5"> 5 </option>
									<option value="6"> 6 </option>
									<option value="7"> 7 </option>
							</select>
							<span class="requerido"> * </span>
						</div>

						<div class="col-sm-2">
							<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(4)" id="rango4" name="rango4">
								<option value="">Seleccione </option>
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
									<option value="4"> 4 </option>
									<option value="5"> 5 </option>
							</select>
							<span class="requerido"> * </span>
						</div>

						<div class="col-sm-2">
                            <div class="input-group">
								<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango4" id="peso_rango4" type="text" value="" disabled placeholder=""/>
                            </div>
                        </div>

						<div class="sep"></div>
						<div class="col-sm-6">
                            <div class="input-group"><label for="basic-url" class="form-label" style="margin-top:10px">
                                    <h6 style="margin-right: 10px;">5 </h6>
                                </label>
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control"  type="text" name="descripcion2" id="descripcion2" cols="30" rows="10"/>
								<span class="requerido"> * </span>
                            </div>
                        </div>

						<div class="col-sm-2">
							<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="suma_modulo1(5)" id="peso5" name="peso5">
								<option value="">Seleccione </option>
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
									<option value="4"> 4 </option>
									<option value="5"> 5 </option>
									<option value="6"> 6 </option>
									<option value="7"> 7 </option>
							</select>
							<span class="requerido"> * </span>
						</div>

						<div class="col-sm-2">
							<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(5)" id="rango5" name="rango5">
								<option value="">Seleccione </option>
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
									<option value="4"> 4 </option>
									<option value="5"> 5 </option>

							</select>
							<span class="requerido"> * </span>
						</div>

						<div class="col-sm-2">
                            <div class="input-group">
								<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control"  name="peso_rango5" id="peso_rango5" type="text" value="" disabled placeholder=""/>
                            </div>
                        </div>

						<div class="sep"></div>
						<div class="col-sm-6">
                            <div class="input-group"><label for="basic-url" class="form-label" style="margin-top:10px">
                                    <h6 style="margin-right: 10px;">6 </h6>
                                </label>
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control"  type="text" name="descripcion3" id="descripcion3" cols="30" rows="10"/>
								<span class="requerido"> * </span>
                            </div>
                        </div>

						<div class="col-sm-2">
							<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="suma_modulo1(6)" id="peso6" name="peso6">
								<option value="">Seleccione </option>
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
									<option value="4"> 4 </option>
									<option value="5"> 5 </option>
									<option value="6"> 6 </option>
									<option value="7"> 7 </option>
							</select>
							<span class="requerido"> * </span>
						</div>

						<div class="col-sm-2">
							<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(6)" id="rango6" name="rango6">
								<option value="">Seleccione </option>
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
									<option value="4"> 4 </option>
									<option value="5"> 5 </option>
							</select>
							<span class="requerido"> * </span>
						</div>

						<div class="col-sm-2">
                            <div class="input-group">
								<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control"   name="peso_rango6" id="peso_rango6" type="text" value="" disabled placeholder=""/>
                            </div>
                        </div>

						<div class="sep"></div>
						<div class="col-sm-6">
                            <div class="input-group"><label for="basic-url" class="form-label" style="margin-top:10px">
                                    <h6 style="margin-right: 10px;">7 </h6>
                                </label>
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control"  type="text" name="descripcion4" id="descripcion4" cols="30" rows="10"/>
								<span class="requerido"> * </span>
                            </div>
                        </div>

						<div class="col-sm-2">
							<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control"  onchange="suma_modulo1(7)" id="peso7" name="peso7">
								<option value="">Seleccione </option>
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
									<option value="4"> 4 </option>
									<option value="5"> 5 </option>
									<option value="6"> 6 </option>
									<option value="7"> 7 </option>
							</select>
							<span class="requerido"> * </span>
						</div>

						<div class="col-sm-2">
							<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(7)" id="rango7" name="rango7">
								<option value="">Seleccione </option>
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
									<option value="4"> 4 </option>
									<option value="5"> 5 </option>
							</select>
							<span class="requerido"> * </span>
						</div>

						<div class="col-sm-2">
                            <div class="input-group">
								<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango7" id="peso_rango7" type="text" value="" disabled placeholder=""/>
                            </div>
                        </div>

						<div class="sep"></div>
						<div class="col-sm-6">
                            <div class="input-group"><label for="basic-url" class="form-label" style="margin-top:10px">
                                    <h6 style="margin-right: 10px;">8 </h6>
                                </label>
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control"  type="text" name="descripcion5" id="descripcion5" cols="30" rows="10"/>
								<span class="requerido"> * </span>
                            </div>
                        </div>

						<div class="col-sm-2">
							<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control"  onchange="suma_modulo1(8)" id="peso8" name="peso8">
								<option value="">Seleccione </option>
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
									<option value="4"> 4 </option>
									<option value="5"> 5 </option>
									<option value="6"> 6 </option>
									<option value="7"> 7 </option>
							</select>
							<span class="requerido"> * </span>
						</div>

						<div class="col-sm-2">
							<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(8)" id="rango8" name="rango8">
								<option value="">Seleccione </option>
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
									<option value="4"> 4 </option>
									<option value="5"> 5 </option>
							</select>
							<span class="requerido"> * </span>
						</div>

						<div class="col-sm-2">
                            <div class="input-group">
								<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango8" id="peso_rango8" type="text" value="" disabled placeholder=""/>
                            </div>
                        </div>

						<div class="sep"></div>

                        <div class="col-sm-6">
							<label for="basic-url" class="form-label" style="margin-top:10px">
                                <span class="requerido">El Peso Debe ser Igual a 50</span>
                            </label>
                        </div>

						<div class="col-sm-2">
                            <div class="input-group">
								<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_total_m1" id="peso_total_m1" type="text" value="" disabled placeholder="" />
                            </div>
                        </div>

						<div class="col-sm-2">
                        </div>

						<div class="col-sm-2">
                            <div class="input-group">
								<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango_total_m1" id="peso_rango_total_m1" type="text" value="" disabled placeholder=""/>
                            </div>
                        </div>

						<div class="sep"></div>

						<center> <button type="button" style="margin-bottom: 20px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="modulo1()">Completar Módulo I</button> </center>

							<!-- ------------------------------ módulo II ---------------------------------------->
						
						<div  style="display: none;" id="modulo2">
							<div class="row">
								<div class="col-sm-8">
									<h2 style="color: rgb(35, 96, 249); font-size:22px;"> MÓDULO II: EVALUACIÓN DE LAS COMPETENCIAS</h2>
								</div>
	
								<div class="sep"></div>
	
								<div class="col-sm-6">COMPETENCIAS</div>
								<div class="col-sm-2">PESO</div>
								<div class="col-sm-2">RANGOS</div>
								<div class="col-sm-2">PESO X RANGO</div>
	
								<div class="col-sm-6">
									<div class="input-group">
									<label for="basic-url" class="form-label" style="margin-top:10px">
										<p style="color: grey; cursor:pointer" onclick="descripcion(1)" title="Haga Clic para más información">1.- Formación, Capacitación y Desarrollo</p>
									</label>
									</div>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control"  onchange="suma_modulo2(9)" id="peso9" name="peso9">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
											<option value="6"> 6 </option>
											<option value="7"> 7 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(9)" id="rango9" name="rango9">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<div class="input-group">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango9" id="peso_rango9" type="text" value="" disabled placeholder=""/>
									</div>
								</div>

								<div class="col-sm-12">
                            		<h6 style="color: #BF1F13">Si un servidor realiza dos (2) cursos avalados por el Ministerio con competencias en Planificación debe indicar los nombres y duración de los mismos, Módulo "IV" Acotaciones del Supervisor Evaluador.</h6>
                        		</div>

								<div class="col-sm-6">
									<div class="input-group">
									<label for="basic-url" class="form-label" style="margin-top:10px">
										<p style="color: grey; cursor:pointer" onclick="descripcion(2)" title="Haga Clic para más información">2.- Servicio y Valor</p>
									</label>
									</div>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="suma_modulo2(10)" id="peso10" name="peso10">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
											<option value="6"> 6 </option>
											<option value="7"> 7 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(10)" id="rango10" name="rango10">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<div class="input-group">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango10" id="peso_rango10" type="text" value="" disabled placeholder=""/>
									</div>
								</div>

								<div class="col-sm-6">
									<div class="input-group">
									<label for="basic-url" class="form-label" style="margin-top:10px">
										<p style="color: grey; cursor:pointer" onclick="descripcion(3)" title="Haga Clic para más información">3.- Capacidad para Innovar</p>
									</label>
									</div>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="suma_modulo2(11)" id="peso11" name="peso11">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
											<option value="6"> 6 </option>
											<option value="7"> 7 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(11)" id="rango11" name="rango11">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<div class="input-group">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango11" id="peso_rango11" type="text" value="" disabled placeholder="" />
									</div>
								</div>

								<div class="col-sm-12">
                            		<h6 style="color: #BF1F13">Si un servidor público realizó un proceso de innovación, se debe exponer el detalle del mismo y a que área de especialización obedece</h6>
                        		</div>

								<div class="col-sm-6">
									<div class="input-group">
									<label for="basic-url" class="form-label" style="margin-top:10px">
										<p style="color: grey; cursor:pointer" onclick="descripcion(4)" title="Haga Clic para más información">4.- Fortalece las Relaciones de Trabajo</p>
									</label>
									</div>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="suma_modulo2(12)" id="peso12" name="peso12">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
											<option value="6"> 6 </option>
											<option value="7"> 7 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(12)" id="rango12" name="rango12">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<div class="input-group">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango12" id="peso_rango12" type="text" value="" disabled placeholder="" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="input-group">
									<label for="basic-url" class="form-label" style="margin-top:10px">
										<p style="color: grey; cursor:pointer"onclick="descripcion(5)" title="Haga Clic para más información">5.- Entender y Aplicar Normas</p>
									</label>
									</div>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="suma_modulo2(13)" id="peso13" name="peso13">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
											<option value="6"> 6 </option>
											<option value="7"> 7 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(13)" id="rango13" name="rango13">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<div class="input-group">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango13" id="peso_rango13" type="text" value="" disabled placeholder="" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="input-group">
									<label for="basic-url" class="form-label" style="margin-top:10px">
										<p style="color: grey; cursor:pointer" onclick="descripcion(6)" title="Haga Clic para más información">6.- Alentar Acción Colectiva</p>
									</label>
									</div>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="suma_modulo2(14)" id="peso14" name="peso14">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
											<option value="6"> 6 </option>
											<option value="7"> 7 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(14)" id="rango14" name="rango14">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<div class="input-group">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango14" id="peso_rango14" type="text" value="" disabled placeholder=""  />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="input-group">
									<label for="basic-url" class="form-label" style="margin-top:10px">
										<p style="color: grey; cursor:pointer" onclick="descripcion(7)" title="Haga Clic para más información">7.- Hábitos de Seguridad</p>
									</label>
									</div>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="suma_modulo2(15)" id="peso15" name="peso15">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
											<option value="6"> 6 </option>
											<option value="7"> 7 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(15)" id="rango15" name="rango15">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<div class="input-group">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango15" id="peso_rango15" type="text" value="" disabled placeholder="" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="input-group">
									<label for="basic-url" class="form-label" style="margin-top:10px">
										<p style="color: grey; cursor:pointer" onclick="descripcion(8)" title="Haga Clic para más información">8.- Compromiso Sobre los Recursos</p>
									</label>
									</div>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="suma_modulo2(16)" id="peso16" name="peso16">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
											<option value="6"> 6 </option>
											<option value="7"> 7 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(16)" id="rango16" name="rango16">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<div class="input-group">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango16" id="peso_rango16" type="text" value="" disabled placeholder="" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="input-group">
									<label for="basic-url" class="form-label" style="margin-top:10px">
										<p style="color: grey; cursor:pointer" onclick="descripcion(9)" title="Haga Clic para más información">9.- Oportunidad y Tiempo</p>
									</label>
									</div>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="suma_modulo2(17)" id="peso17" name="peso17">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
											<option value="6"> 6 </option>
											<option value="7"> 7 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(17)" id="rango17" name="rango17">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<div class="input-group">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango17" id="peso_rango17" type="text" value="" disabled placeholder="" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="input-group">
									<label for="basic-url" class="form-label" style="margin-top:10px">
										<p style="color: grey; cursor:pointer" onclick="descripcion(10)" title="Haga Clic para más información">10.- Transparencia de la Comunicación</p>
									</label>
									</div>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="suma_modulo2(18)" id="peso18" name="peso18">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
											<option value="6"> 6 </option>
											<option value="7"> 7 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(18)" id="rango18" name="rango18">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<div class="input-group">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control"  name="peso_rango18" id="peso_rango18" type="text" value="" disabled placeholder="" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="input-group">
									<label for="basic-url" class="form-label" style="margin-top:10px">
										<p style="color: grey; cursor:pointer" onclick="descripcion(11)" title="Haga Clic para más información">11.- Cooperación y Trabajo en Colectivo</p>
									</label>
									</div>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="suma_modulo2(19)" id="peso19" name="peso19">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
											<option value="6"> 6 </option>
											<option value="7"> 7 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<select style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" onchange="multiplicar(19)" id="rango19" name="rango19">
										<option value="">Seleccione </option>
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
											<option value="4"> 4 </option>
											<option value="5"> 5 </option>
									</select>
									<span class="requerido"> * </span>
								</div>

								<div class="col-sm-2">
									<div class="input-group">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control"  name="peso_rango19" id="peso_rango19" type="text" value="" disabled placeholder="" />
									</div>
								</div>

								<div class="col-sm-6">
									<label for="basic-url" class="form-label" style="margin-top:10px">
                                		<span class="requerido">El Peso Debe ser Igual a 50</span>
                            		</label>
                        		</div>

								<div class="col-sm-2">
                            		<div class="input-group">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_total_m2" id="peso_total_m2" type="text" value="" disabled placeholder=""/>
                            		</div>
                        		</div>

								<div class="col-sm-2">
                        		</div>

								<div class="col-sm-2">
                            		<div class="input-group">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_rango_total_m2" id="peso_rango_total_m2" type="text" value="" disabled placeholder=""/>
                            		</div>
                        		</div>

								<center> <button type="button" style="margin-bottom: 20px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="modulo2()">Completar Módulo II</button> </center>
							</div>
						</div>
						


						

					</div>			
			</div>
		</div>
	</div>
</main>


	<div id="Contenido" align="center" style="overflow:auto">
		<br>
		<table class="tabla" width="95%" height="95%">
			<tbody>
				<tr valign="top">
					<td>
						<br />
						<table width="95%" border="0" align="center" class="formulario">
							<!-- ------------------------------ datos del supervisor del evaluador --------------------------------------  -->

							<!-- <tr class="identificacion_seccion">
								<th colspan="4" class="sub_titulo_2" width="100%" align="center" style="background-color: #D0E0F4; padding: 5px; border-radius: 30px; color: #1060C8;">
									DATOS DEL SUPERVISOR DEL EVALUADOR
								</th>
							</tr>
							<tr>
								<td colspan="4"> </td>
							</tr>
							<tr style="margin-top: 30px;">
								<th style="color: grey;" width="23%">Cédula de Identidad</th>
								<td align="center" style="border-radius: 30px;">
									<font color="#666666">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:center;" onkeypress="number(3)" maxlength="8" name="cedula3" id="cedula3" type="text" value="" placeholder="" />
										<span class="requerido"> * </span>
									</font>
								</td>
								<td>
									<center>
										<button type="button" style="padding: 5px 10px; border-radius: 20px; border: 1px grey solid;" onclick="buscar(3)">BUSCAR</button>
									</center>
								</td>
							</tr>
							<tr>
								<th style="color: grey" width="23%">Apellidos y Nombres</th>
								<td align="center" style="border-radius: 30px;">
									<font color="#666666">
										<input style="border-radius: 30px; border-color:#999999; width:95%; float:left;" name="nombre_apellido3" id="nombre_apellido3" type="text" value="" placeholder="" />
										<span class="requerido" style="float:left"> * </span>
									</font>
								</td>
								<th style="color: grey; text-align:center">Código</th>
								<td align="center" style="border-radius: 30px;">
									<font color="#666666">
										<input style="border-radius: 30px; border-color:#999999; width:81%; float:left;" name="codigo3" id="codigo3" type="text" value="" placeholder="" />
										<span class="requerido" style="float:left"> * </span>
									</font>
								</td>
							</tr>
							<tr style="margin-top: 30px;">
								<th style="color: grey" width="23%">Cargo o Puesto de Trabajo Titular</th>
								<td align="center" style="border-radius: 30px;" colspan="3">
									<font color="#666666">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" name="cargo3" id="cargo3" type="text" value="" placeholder="" />
										<span class="requerido" style="float:left"> * </span>
									</font>
								</td>
							</tr>
							<tr style="margin-top: 30px;">
								<th style="color: grey" width="23%">Ubicación Administrativa de Adscripción</th>
								<td align="center" style="border-radius: 30px;" colspan="3">
									<font color="#666666">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" name="ubicacion_adm3" id="ubicacion_adm3" type="text" value="" placeholder="" />
										<span class="requerido" style="float:left"> * </span>
									</font>
								</td>
							</tr>
							<tr style="margin-top: 30px;">
								<th style="color: grey" width="23%">Ubicación Física</th>
								<td align="center" style="border-radius: 30px;" colspan="3">
									<font color="#666666">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" name="ubicacion_act3" id="ubicacion_act3" type="text" value="" placeholder="" />
									</font>
								</td>
							</tr>
							<tr style="margin-top: 30px;">
								<th style="color: grey" width="23%">Cargo o Puesto de Trabajo que Ejerce</th>
								<td align="center" style="border-radius: 30px;" colspan="3">
									<font color="#666666">
										<input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" name="cargo_ejerce3" id="cargo_ejerce3" type="text" value="" placeholder="" />
									</font>
								</td>
							</tr>
							<tr>
								<td colspan="4"> </td>
							</tr> -->
							<!-- ------------------------------ módulo III --------------------------------------  -->
							<table style="display: none; width: 100%" id="modulo3" class="formulario">
								<tbody>
									<tr class="identificacion_seccion">
										<th colspan="4" class="sub_titulo_2" width="100%" align="center" style="background-color: #D0E0F4; padding: 5px; border-radius: 30px; color: #1060C8;">
											MÓDULO III: EN ESTE MÓDULO SE OBTENDRÁ EL RANGO DE ACTUACIÓN DEL EVALUADO --> TOTAL MÓDULO I + TOTAL MÓDULO II
										</th>
									</tr>
									<tr>
										<td colspan="4"> </td>
									</tr>
									<tr>
										<th style="color: grey; text-align: center; border-bottom: solid 1px grey" colspan="2">CALIFICACIÓN FINAL </th>
										<th style="color: grey; text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> ESCALA CUANTITATIVA</th>
										<th style="color: grey; text-align: center; border-bottom: solid 1px grey; border-left: solid 1px grey;"> RANGO DE ACTUACIÓN</th>
									</tr>
									<tr>
										<th style="color: grey; border-bottom: solid 1px grey; text-align:center; font-weight: normal">Total Módulo <span style="font-weight: 700; color: grey">"I"</span></th>
										<td align="center" style="border-radius: 30px; border-bottom: solid 1px grey">
											<font color="#666666">
												<input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" name="total_modulo1" id="total_modulo1" type="text" value="" disabled placeholder="" />
											</font>
										</td>
										<th style="color: grey; text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 100 - 124 </th>
										<th style="color: grey; text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700; color:grey"> No Cumplió </span></th>
									</tr>
									<tr>
										<th style="color: grey; border-bottom: solid 1px grey; text-align:center; font-weight: normal">Total Módulo <span style="font-weight: 700; color: grey">"II"</span></th>
										<td align="center" style="border-radius: 30px; border-bottom: solid 1px grey">
											<font color="#666666">
												<input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" name="total_modulo2" id="total_modulo2" type="text" value="" disabled placeholder="" />
											</font>
										</td>
										<th style="color: grey; text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 125 - 249 </th>
										<th style="color: grey; text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700; color:grey"> Cumplimiento Ordinario </span></th>
									</tr>
									<tr>
										<th style="color: grey; border-bottom: solid 1px grey; text-align:center; font-weight: normal">Total Módulo <span style="font-weight: 700; color: grey">"I"</span> + Total Módulo <span style="font-weight: 700; color: grey">"II"</span></th>
										<td align="center" style="border-radius: 30px; border-bottom: solid 1px grey">
											<font color="#666666">
												<input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" name="total_modulo3" id="total_modulo3" type="text" value="" disabled placeholder="" />
											</font>
										</td>
										<th style="color: grey; text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 250 - 374 </th>
										<th style="color: grey; text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700; color: grey"> Bueno</span> - Cumplimiento de Proceso de Mejora </th>
									</tr>
									<tr>
										<th colspan="2" style="color: grey; border-bottom: solid 1px grey; text-align:center; padding: 8px; font-weight: 700">Rango de Actuación</th>
										<th style="color: grey; text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 375 - 499 </th>
										<th style="color: grey; text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700; color:grey"> Muy Bueno</span> - Cumplimiento Destacable </th>
									</tr>
									<tr>
										<td colspan="2" align="center" style="border-radius: 30px; border-bottom: solid 1px grey; padding: 8px; font-weight: normal;color: grey" id="rango_accion"><span style="font-weight: 700; color:grey" id="rango_accion1"></span><span style="font-weight: normal; color:grey" id="rango_accion2"></span></td>
										<th style="color: grey; text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 500 </th>
										<th style="color: grey; text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700; color:grey"> Excelente</span> - Cumplimiento Emulable </th>
									</tr>
									<tr>
										<td colspan="4"></td>
									</tr>
									<!-- <tr id="op1" style="display: none; width: 100%;">
									<th colspan="4" style="color: gray; width: 100%;"> Justifique el Rango de Actuación más los Cursos de Trimestre </th>
								</tr>
								<tr id="op2" style="display: none; width: 100%;">
									<td colspan="4" align="center" style="border-radius: 30px;">
					                	<font color="#666666">
											<textarea style="border-radius: 30px; border-color:#999999; width:99%; float:left; height: 70px; padding: 10px"></textarea>
					                	</font>
					                </td>
								</tr> -->
								</tbody>
							</table>
							<!-- ------------------------------ módulo IV --------------------------------------  -->
							<tr>
								<td colspan="4">
									<table style="display: none; width: 100%" id="modulo4" class="formulario">
										<tbody style="display: none;">
											<form class="col-md-8 fondo" action="/minpptrassi/mod_evaluacion/files.php" method="POST" enctype="multipart/form-data">
												<tr class="identificacion_seccion" width="100%">
													<th colspan="4" class="sub_titulo_2" width="100%" align="center" style="background-color: #D0E0F4; padding: 5px; border-radius: 30px; color: #1060C8;">
														MÓDULO IV: ACOTACIONES DEL SUPERVISOR
													</th>
												</tr>
												<tr>
													<td colspan="4"> </td>
												</tr>
												<tr width="100%">
													<th colspan="4" style="color: grey;">Observaciones y acotaciones (Debe indicar nombre y fecha en que realizó cada curso)</th>
												</tr>
												<tr width="100%">
													<td align="center" style="border-radius: 30px;" colspan="4">
														<font color="#666666">
															<textarea name="sacotacion_supervisor" id="sacotacion_supervisor" cols="30" rows="10" style="border-radius: 30px; border-color:#999999; width:99%; float:left; height: 70px; padding: 10px" required></textarea>
														</font>
													</td>
												</tr>
												<tr id="op3" style="display: none; width: 100%;">
													<th colspan="4" style="color: gray; width: 100%;"> Adjuntar Certificados de los Cursos </th>
												</tr>
												<tr id="op4" style="display: none; width: 100%;">
													<td colspan="2" align="center" style="border-radius: 30px;">
														<font color="#666666">
															<input type="file" style="border-radius: 30px; border-color:#999999; width:90%; padding: 10px" name="sprimer_curso" id="sprimer_curso" required>
														</font>
													</td>
													<td colspan="2" align="center" style="border-radius: 30px;">
														<font color="#666666">
															<input type="file" style="border-radius: 30px; border-color:#999999; width:90%; padding: 10px" name="ssegundo_curso" id="ssegundo_curso" required>
														</font>
													</td>
												</tr>
												<tr width="100%">
													<td colspan="4">
														<center>
															<input type="submit" style="padding: 5px 10px; border-radius: 20px; border: 1px grey solid" value="GUARDAR">
														</center>
													</td>
												</tr>
												<tr width="100%">
													<td colspan="4"> </td>
												</tr>
											</form>
										</tbody>
									</table>
								</td>
							</tr>
				</tr>
		</table>
		</td>
		</tr>
		</tbody>
		</table>
		<!-- script -->

		<script src="funciones.js"></script>
		<?php include("../footer.php"); ?>