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


$mes = date('m');

if ($mes == '01' || $mes == '02' || $mes == '03') {
    $periodo = 1;
}
if ($mes == '04' || $mes == '05' || $mes == '06') {
    $periodo = 2;
}
if ($mes == '07' || $mes == '08' || $mes == '09') {
    $periodo = 3;
}
if ($mes == '10' || $mes == '11' || $mes == '12') {
    $periodo = 4;
}

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

$nombre_completo = $apellido1 . " " . $apellido2 . " " . $nombre1 . " " . $nombre2;

$codigo_nom = $persona["codigo_nom"];
$ubicacion_fisica_actual = $persona["ubicacion_fisica_actual"];
$cargo_actual_ejerce = $persona["cargo_actual_ejerce"];
$tipo_trabajador = $persona["tipo_trabajador"];
$cargo = $persona["cargo"];
$cargo_id = $persona["cargo_id"];
$codigo_tipos_trabajadores = $persona["codigo_tipos_trabajadores"];
$ubicacion_adm = $persona["ubicacion_adm"];
$ubicacion_scodigo = $persona["ubicacion_scodigo"];


$SQL2 = "SELECT * FROM
		evaluacion_desemp.evaluacion
		WHERE
		personales_id = '$persona_id'
		AND
        periodo_eval_id = '$periodo'
		AND
        nestatus = '2'
		AND
		benabled = 'TRUE'
		LIMIT 1
";

$row2 = pg_query($conn, $SQL2);
$persona2 = pg_fetch_assoc($row2);
$number = pg_num_rows($row2);
if ($number == 0) { ?>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            document.getElementById("mensaje").style.textAlign = "center";
            document.getElementById("mensaje").textContent = "Este ususario no presenta una evaluación este trimestre";
            document.getElementById("alerta").style.display = "block";
             setTimeout(() => {
                window.location.href = "vista.php";
             },3000);
        });
    </script>
<? }

$id2 = $persona2["id"];

$_SESSION["id_eva"] = $id2;

$personales_id2 = $persona2["personales_id"];
$rol_evaluacion_id2 = $persona2["rol_evaluacion_id"];
$periodo_eval_id2 = $persona2["periodo_eval_id"];
$nanno_evalu2 = $persona2["nanno_evalu"];
$cargos_id2 = $persona2["cargos_id"];
$ubicacion_administrativa_scodigo2 = $persona2["ubicacion_administrativa_scodigo"];
$subicacion_fisica2 = $persona2["subicacion_fisica"];
$scargo_ejerce2 = $persona2["scargo_ejerce"];

$sodi1 = $persona2["sodi1"];
$nodi1_peso = $persona2["nodi1_peso"];
$nodi1_rango = $persona2["nodi1_rango"];
$sodi2 = $persona2["sodi2"];
$nodi2_peso = $persona2["nodi2_peso"];
$nodi2_rango = $persona2["nodi2_rango"];
$sodi3 = $persona2["sodi3"];
$nodi3_peso = $persona2["nodi3_peso"];
$nodi3_rango = $persona2["nodi3_rango"];
$sodi4 = $persona2["sodi4"];
$nodi4_peso = $persona2["nodi4_peso"];
$nodi4_rango = $persona2["nodi4_rango"];
$sodi5 = $persona2["sodi5"];
$nodi5_peso = $persona2["nodi5_peso"];
$nodi5_rango = $persona2["nodi5_rango"];
$sodi6 = $persona2["sodi6"];
$nodi6_peso = $persona2["nodi6_peso"];
$nodi6_rango = $persona2["nodi6_rango"];
$sodi7 = $persona2["sodi7"];
$nodi7_peso = $persona2["nodi7_peso"];
$nodi7_rango = $persona2["nodi7_rango"];
$sodi8 = $persona2["sodi8"];
$nodi8_peso = $persona2["nodi8_peso"];
$nodi8_rango = $persona2["nodi8_rango"];


$sacotacion_supervisor = $persona2["sacotacion_supervisor"];
$sprimer_curso_nombre = $persona2["sprimer_curso_nombre"];
$sprimer_curso_fecha = $persona2["sprimer_curso_fecha"];
$ssegundo_curso_nombre = $persona2["ssegundo_curso_nombre"];
$ssegundo_curso_fecha = $persona2["ssegundo_curso_fecha"];


$sacotacion_supervisor = $persona2["sacotacion_supervisor"];
$sprimer_curso = $persona2["sprimer_curso"];
$ssegundo_curso = $persona2["ssegundo_curso"];

if ($sprimer_curso == "nada" || $sprimer_curso == "") {
    $curso1 = "No adjunto ningún curso";
} else {
    $curso1 = "Curso subido";
}

if ($ssegundo_curso == "nada" || $ssegundo_curso == "") {
    $curso2 = "No adjunto ningún curso";
} else {
    $curso2 = "Curso subido";
}

$result1 = $nodi1_peso * $nodi1_rango;
$result2 = $nodi2_peso * $nodi2_rango;
$result3 = $nodi3_peso * $nodi3_rango;
$result4 = $nodi4_peso * $nodi4_rango;
$result5 = $nodi5_peso * $nodi5_rango;
$result6 = $nodi6_peso * $nodi6_rango;
$result7 = $nodi7_peso * $nodi7_rango;
$result8 = $nodi8_peso * $nodi8_rango;

$peso_total1 = $nodi1_peso + $nodi2_peso + $nodi3_peso + $nodi4_peso + $nodi5_peso + $nodi6_peso + $nodi7_peso + $nodi8_peso;
$result_total1 = $result1 + $result2 + $result3 + $result4 + $result5 + $result6 + $result7 + $result8;

/* Evaluación de Competencias */

/* Competencia 1 */

$comp1 = "SELECT * FROM
        evaluacion_desemp.evaluacion_comp
        WHERE
        evaluacion_id = '$id2'
        AND
        competencias_id = 4
        LIMIT 1
";

$rs1 = pg_query($conn, $comp1);
$eva1 = pg_fetch_assoc($rs1);

$npeso1 = $eva1["npeso"];
$nrango1 = $eva1["nrango"];

$resp1 = $npeso1 * $nrango1;

/* Competencia 2 */

$comp2 = "SELECT * FROM
        evaluacion_desemp.evaluacion_comp
        WHERE
        evaluacion_id = '$id2'
        AND
        competencias_id = 5
        LIMIT 1
";

$rs2 = pg_query($conn, $comp2);
$eva2 = pg_fetch_assoc($rs2);

$npeso2 = $eva2["npeso"];
$nrango2 = $eva2["nrango"];

$resp2 = $npeso2 * $nrango2;

/* Competencia 3 */

$comp3 = "SELECT * FROM
        evaluacion_desemp.evaluacion_comp
        WHERE
        evaluacion_id = '$id2'
        AND
        competencias_id = 8
        LIMIT 1
";

$rs3 = pg_query($conn, $comp3);
$eva3 = pg_fetch_assoc($rs3);

$npeso3 = $eva3["npeso"];
$nrango3 = $eva3["nrango"];

$resp3 = $npeso3 * $nrango3;

/* Competencia 4 */

$comp4 = "SELECT * FROM
        evaluacion_desemp.evaluacion_comp
        WHERE
        evaluacion_id = '$id2'
        AND
        competencias_id = 9
        LIMIT 1
";

$rs4 = pg_query($conn, $comp4);
$eva4 = pg_fetch_assoc($rs4);

$npeso4 = $eva4["npeso"];
$nrango4 = $eva4["nrango"];

$resp4 = $npeso4 * $nrango4;

/* Competencia 5 */

$comp5 = "SELECT * FROM
        evaluacion_desemp.evaluacion_comp
        WHERE
        evaluacion_id = '$id2'
        AND
        competencias_id = 10
        LIMIT 1
";

$rs5 = pg_query($conn, $comp5);
$eva5 = pg_fetch_assoc($rs5);

$npeso5 = $eva5["npeso"];
$nrango5 = $eva5["nrango"];

$resp5 = $npeso5 * $nrango5;

/* Competencia 6 */

$comp6 = "SELECT * FROM
        evaluacion_desemp.evaluacion_comp
        WHERE
        evaluacion_id = '$id2'
        AND
        competencias_id = 11
        LIMIT 1
";

$rs6 = pg_query($conn, $comp6);
$eva6 = pg_fetch_assoc($rs6);

$npeso6 = $eva6["npeso"];
$nrango6 = $eva6["nrango"];

$resp6 = $npeso6 * $nrango6;

/* Competencia 7 */

$comp7 = "SELECT * FROM
        evaluacion_desemp.evaluacion_comp
        WHERE
        evaluacion_id = '$id2'
        AND
        competencias_id = 12
        LIMIT 1
";

$rs7 = pg_query($conn, $comp7);
$eva7 = pg_fetch_assoc($rs7);

$npeso7 = $eva7["npeso"];
$nrango7 = $eva7["nrango"];

$resp7 = $npeso7 * $nrango7;

/* Competencia 8 */

$comp8 = "SELECT * FROM
        evaluacion_desemp.evaluacion_comp
        WHERE
        evaluacion_id = '$id2'
        AND
        competencias_id = 13
        LIMIT 1
";

$rs8 = pg_query($conn, $comp8);
$eva8 = pg_fetch_assoc($rs8);

$npeso8 = $eva8["npeso"];
$nrango8 = $eva8["nrango"];

$resp8 = $npeso8 * $nrango8;

/* Competencia 9 */

$comp9 = "SELECT * FROM
        evaluacion_desemp.evaluacion_comp
        WHERE
        evaluacion_id = '$id2'
        AND
        competencias_id = 14
        LIMIT 1
";

$rs9 = pg_query($conn, $comp9);
$eva9 = pg_fetch_assoc($rs9);

$npeso9 = $eva9["npeso"];
$nrango9 = $eva9["nrango"];

$resp9 = $npeso9 * $nrango9;

/* Competencia 10 */

$comp10 = "SELECT * FROM
        evaluacion_desemp.evaluacion_comp
        WHERE
        evaluacion_id = '$id2'
        AND
        competencias_id = 15
        LIMIT 1
";

$rs10 = pg_query($conn, $comp10);
$eva10 = pg_fetch_assoc($rs10);

$npeso10 = $eva10["npeso"];
$nrango10 = $eva10["nrango"];

$resp10 = $npeso10 * $nrango10;

/* Competencia 11 */

$comp11 = "SELECT * FROM
        evaluacion_desemp.evaluacion_comp
        WHERE
        evaluacion_id = '$id2'
        AND
        competencias_id = 16
        LIMIT 1
";

$rs11 = pg_query($conn, $comp11);
$eva11 = pg_fetch_assoc($rs11);

$npeso11 = $eva11["npeso"];
$nrango11 = $eva11["nrango"];

$resp11 = $npeso11 * $nrango11;

$peso_total2 = $npeso1 + $npeso2 + $npeso3 + $npeso4 + $npeso5 + $npeso6 + $npeso7 + $npeso8 + $npeso9 + $npeso10 + $npeso11;
$result_total2 = $resp1 + $resp2 + $resp3 + $resp4 + $resp5 + $resp6 + $resp7 + $resp8 + $resp9 + $resp10 + $resp11;

$result_total3 = $result_total1 + $result_total2;

if ($result_total3 >= 100 && $result_total3 <= 124) {
    $resultado = "No Cumplió";
} else
if ($result_total3 >= 125 && $result_total3 <= 249) {
    $resultado = "Cumplimiento Ordinario";
} else
if ($result_total3 >= 250 && $result_total3 <= 374) {
    $resultado = "Bueno - Cumplimiento de Proceso de Mejora";
} else
if ($result_total3 >= 375 && $result_total3 <= 499) {
    $resultado = "Muy Bueno - Cumplimiento Destacable";
} else
if ($result_total3 == 500) {
    $resultado = "Excelente - Cumplimiento Emulable";
}

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

$ayo2 = '20' . $ayo;

?>
<input type="text" value="" id="com" style="display: none">
<div style=" display:none; " class="fondo_alerta" id="alerta2">

    <div style="width: 35%; height: auto; padding: 0; border-radius: 30px; position: fixed; margin-top: 30vh; margin-left: 30%; z-index: 50; background-color: white; border: solid 1px gray; ">
        <div class="presion" style="margin-top: -11px;">
            <h4 id="titulo" style="padding: 7px 20px; border-radius: 30px 30px 0 0; background-color: #DC3831; color: white;">Atención</h4>

            <p id="mensaje2" style="text-align: justify; padding: 5px 20px; font-size: 20px; text-align: center;"></p>
            <textarea name="text" id="text" style="min-width: 80%; max-width: 80%; margin: auto; border-radius: 30px" required></textarea>
            <input type="text" value="<? echo $id2; ?>" id="asd" style="display: none" disabled>
            <br>
            <center>

                <button type="submit" style="margin-bottom: 20px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="cerrar2()">Guardar</button>
            </center>

        </div>

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

                    <div class="col-sm-9">
                        <h1 style="font-size:32px; font-weight: normal;">ODI - Evaluación</h1>
                    </div>
                    <div class="col-sm-3"></div>

                    <div class="sep"></div>
                    <hr>
                    <div class="sep"></div>


                </div>


                <!--  -->

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

                            <input class="form-control" style="background: #b6b4b4b2; color: #313131;border-radius:30px ; " disabled name="hasta" id="hasta" type="text" value="<? echo $hasta; ?>" placeholder="" readonly />
                        </div>

                        <!-- ////////////////////////////////////////////////////////////////////////////////////////// -->

                        <div class="sep"></div>
                        <hr>
                        <div class="sep"></div>

                        <div class="col-sm-4">
                            <h2 style="color: rgb(35, 96, 249); font-size:22px;"> DATOS DEL EVALUADO</h2>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"></div>
                        <!--  -->
                        <div class="col-sm-4"> <label for="basic-url" class="form-label" style="margin-top:10px">Cédula de Identidad </label> <span></span>
                            <div class="input-group">

                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>

                                <input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2;" disabled type="text" class="form-control" name="cedula2" id="cedula2" value="<? echo $cedula ?>" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="col-sm-8"> <label for="basic-url" class="form-label" style="margin-top:10px">Apellido(s) y Nombre(s) </label><span></span>
                            <div class="input-group">

                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>

                                <input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2;" disabled type="text" class="form-control" name="nombre_apellido2" id="nombre_apellido2" value="<? echo $nombre_completo ?>" placeholder="" readonly>
                            </div>

                        </div>

                        <div class="col-sm-4"> <label for="basic-url" class="form-label" style="margin-top:10px">Código de Nómina </label><span></span>
                            <div class="input-group">

                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>

                                <input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2;" disabled class="form-control" name="codigo1" id="codigo1" type="text" value="<? echo $codigo_nom ?>" placeholder="" readonly>

                            </div>
                        </div>

                        <div class="col-sm-8"><label for="basic-url" class="form-label" style="margin-top:10px">Tipo de Trabajador </label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>

                                <input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2;" disabled class="form-control" name="tipo_trabajador2" id="tipo_trabajador2" type="text" value="<? echo $cargo_actual_ejerce  ?>" placeholder="" readonly>


                            </div>
                        </div>
                        <!--  -->


                        <div class="sep"></div>
                        <div class="col-sm-6"> <label for="basic-url" class="form-label" style="margin-top:10px">Cargo o Puesto de Trabajo que Ejerce </label><span></span>
                            <div class="input-group">

                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>

                                <input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2;" disabled class="form-control" name="cargo_ejerce2" id="cargo_ejerce2" type="text" value="<? echo $cargo ?>" placeholder="" readonly>

                            </div>
                        </div>
                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px">Cargo o Puesto de Trabajo Titular </label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>

                                <input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2;" disabled class="form-control" name="cargo2" id="cargo2" type="text" value="<? echo $tipo_trabajador ?>" placeholder="" readonly>


                            </div>
                        </div>
                        <!--  -->


                        <div class="col-sm-6"> <label for="basic-url" class="form-label" style="margin-top:10px">Ubicación Administrativa de Adscripción</label><span></span>
                            <div class="input-group">

                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>

                                <input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2;" disabled class="form-control" name="ubicacion_adm2" id="ubicacion_adm2" type="text" value="<? echo $ubicacion_adm  ?>" placeholder="" readonly>

                            </div>
                        </div>
                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px">Ubicación Física </label><span></span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                    <img src="img/co.png" class="input-imagen">
                                </span>

                                <input style="border-radius: 0px 30px 30px 0px;background: #b6b4b4b2;" disabled class="form-control" name="ubicacion_act2" id="ubicacion_act2" type="text" value="<? echo $ubicacion_fisica_actual ?>" placeholder="" readonly>


                            </div>
                        </div>
                        <div class="sep"></div>
                        <hr>
                        <div class="sep"></div>
                        <!-- //////////////////////////////////////////////////////////////////////////////////////// -->

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
                        <!-- //////////////////////////////////////////////////////////////////////////////////////// -->

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
                        <div class="sep"></div>
                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px">
                                <h5>*Asistencia y Puntualidad al Trabajo </h5>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso1" id="peso1" type="text" value="<? echo $nodi1_peso; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango1" id="rango1" type="text" value="<? echo $nodi1_rango; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" type="text" value="<? echo $result1; ?>" disabled placeholder="" />
                            </div>
                        </div>

                        <!--                         <div class="sep"></div>
 -->
                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px">
                                <h5>*Asistencia y Puntualidad a las Reuniones de Trabajo </h5>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso2" id="peso2" type="text" value="<? echo $nodi2_peso; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango2" id="rango2" type="text" value="<? echo $nodi2_rango; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" type="text" value="<? echo $result2; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <!--                         <div class="sep"></div>
 -->
                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px">
                                <h5>*Asistencia y Puntualidad a los Despliegues de Campo </h5>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso3" id="peso3" type="text" value="<? echo $nodi3_peso; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango3" id="rango3" type="text" value="<? echo $nodi3_rango; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" type="text" value="<? echo $result3; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <!--                         <div class="sep"></div>
 -->
                        <div class="col-sm-6">
                            <div class="input-group"><label for="basic-url" class="form-label" style="margin-top:10px">
                                    <h6 style="margin-right: 10px;">4 </h6>
                                </label>

                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso4" id="peso4" type="text" value="<? echo $sodi4; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso4" id="peso4" type="text" value="<? echo $nodi4_peso; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango4" id="rango4" type="text" value="<? echo $nodi4_rango; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" type="text" value="<? echo $result4; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="sep"></div>

                        <div class="col-sm-6">
                            <div class="input-group"><label for="basic-url" class="form-label" style="margin-top:10px">
                                    <h6 style="margin-right: 10px;">5 </h6>
                                </label>

                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" type="text" value="<? echo $sodi5; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso5" id="peso5" type="text" value="<? echo $nodi5_peso; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango5" id="rango5" type="text" value="<? echo $nodi5_rango; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" type="text" value="<? echo $result5; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="sep"></div>

                        <div class="col-sm-6">
                            <div class="input-group"><label for="basic-url" class="form-label" style="margin-top:10px">
                                    <h6 style="margin-right: 10px;">6 </h6>
                                </label>

                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" type="text" value="<? echo $sodi6; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso6" id="peso6" type="text" value="<? echo $nodi6_peso; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango6" id="rango6" type="text" value="<? echo $nodi6_rango; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" type="text" value="<? echo $result6; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="sep"></div>

                        <div class="col-sm-6">
                            <div class="input-group"><label for="basic-url" class="form-label" style="margin-top:10px">
                                    <h6 style="margin-right: 10px;">7 </h6>
                                </label>

                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" type="text" value="<? echo $sodi7; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso7" id="peso7" type="text" value="<? echo $nodi7_peso; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango7" id="rango7" type="text" value="<? echo $nodi7_rango; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" type="text" value="<? echo $result7; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="sep"></div>

                        <div class="col-sm-6">
                            <div class="input-group"><label for="basic-url" class="form-label" style="margin-top:10px">
                                    <h6 style="margin-right: 10px;">8 </h6>
                                </label>

                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" type="text" value="<? echo $sodi8; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso8" id="peso8" type="text" value="<? echo $nodi8_peso; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango8" id="rango8" type="text" value="<? echo $nodi8_rango; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" type="text" value="<? echo $result8; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="sep"></div>

                        <div class="col-sm-6">

                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_total_m1" id="peso_total_m1" type="text" value="<? echo $peso_total1; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">

                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="peso_rango_total_m1" id="peso_rango_total_m1" type="text" value="<? echo $result_total1; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="sep"></div>
                        <hr>
                        <div class="sep"></div>

                        <div class="col-sm-4">
                            <h2 style="color: rgb(35, 96, 249); font-size:22px;"> MÓDULO II: EVALUACIÓN DE LAS COMPETENCIAS</h2>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"></div>
                        <div class="sep"></div>
                        <hr>
                        <div class="sep"></div>
                        <div class="col-sm-6">OBJETIVOS DEL DESEMPEÑO INDIVIDUAL (ODIS)</div>
                        <div class="col-sm-2">PESO</div>
                        <div class="col-sm-2">RANGOS</div>
                        <div class="col-sm-2">PESO X RANGO</div>
                        <div class="sep"></div>

                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px" onclick="descripcion(1)" title="Haga Clic para más información">
                                <h5>1.- Formación, Capacitación y Desarrollo</h5>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso9" id="peso9" type="text" value="<? echo $npeso1; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango9" id="rango9" type="text" value="<? echo $nrango1; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="peso_rango9" id="peso_rango9" type="text" value="<? echo $resp1; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-12"><i style="color: #BF1F13">Si un servidor realiza dos (2) cursos avalados por el Ministerio con competencias en Planificación debe indicar los nombres y duración de los mismos, Módulo "IV" Acotaciones del Supervisor Evaluador.</i></div>
                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px" onclick="descripcion(2)" title="Haga Clic para más información">
                                <h5>2.- Servicio y Valor</h5>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso10" id="peso10" type="text" value="<? echo $npeso2; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango10" id="rango10" type="text" value="<? echo $nrango2; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="peso_rango10" id="peso_rango10" type="text" value="<? echo $resp2; ?>" disabled placeholder="" />
                            </div>
                        </div>

                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px" onclick="descripcion(3)" title="Haga Clic para más información">
                                <h5>3.- Capacidad para Innovar</h5>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso11" id="peso11" type="text" value="<? echo $npeso3; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango11" id="rango11" type="text" value="<? echo $nrango3; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="peso_rango11" id="peso_rango11" type="text" value="<? echo $resp3; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-12"><i style="color: #BF1F13">Si un servidor público realizó un proceso de innovación, se debe exponer el detalle del mismo y a que área de especialización obedece</i></div>
                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px" onclick="descripcion(4)" title="Haga Clic para más información">
                                <h5>4.- Fortalece las Relaciones de Trabajo</h5>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso12" id="peso12" type="text" value="<? echo $npeso4; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango12" id="rango12" type="text" value="<? echo $nrango4; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="peso_rango12" id="peso_rango12" type="text" value="<? echo $resp4; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px" onclick="descripcion(5)" title="Haga Clic para más información">
                                <h5>5.- Entender y Aplicar Normas</h5>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso13" id="peso13" type="text" value="<? echo $npeso5; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango13" id="rango13" type="text" value="<? echo $nrango5; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="peso_rango13" id="peso_rango13" type="text" value="<? echo $resp5; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px" onclick="descripcion(6)" title="Haga Clic para más información">
                                <h5>6.- Alentar Acción Colectiva</h5>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso14" id="peso14" type="text" value="<? echo $npeso6; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango14" id="rango14" type="text" value="<? echo $nrango6; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="peso_rango14" id="peso_rango14" type="text" value="<? echo $resp6; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px" onclick="descripcion(7)" title="Haga Clic para más información">
                                <h5>7.- Hábitos de Seguridad</h5>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso15" id="peso15" type="text" value="<? echo $npeso7; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango15" id="rango15" type="text" value="<? echo $nrango7; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="peso_rango15" id="peso_rango15" type="text" value="<? echo $resp7; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px" onclick="descripcion(8)" title="Haga Clic para más información">
                                <h5>8.- Compromiso Sobre los Recursos</h5>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso16" id="peso16" type="text" value="<? echo $npeso8; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango16" id="rango16" type="text" value="<? echo $nrango8; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="peso_rango16" id="peso_rango16" type="text" value="<? echo $resp8; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px" onclick="descripcion(9)" title="Haga Clic para más información">
                                <h5>9.- Oportunidad y Tiempo</h5>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso17" id="peso17" type="text" value="<? echo $npeso9; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango17" id="rango17" type="text" value="<? echo $nrango9; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="peso_rango17" id="peso_rango17" type="text" value="<? echo $resp9; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px" onclick="descripcion(10)" title="Haga Clic para más información">
                                <h5>10.- Transparencia de la Comunicación</h5>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso18" id="peso18" type="text" value="<? echo $npeso10; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango18" id="rango18" type="text" value="<? echo $nrango10; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="peso_rango18" id="peso_rango18" type="text" value="<? echo $resp10; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-6"><label for="basic-url" class="form-label" style="margin-top:10px" onclick="descripcion(11)" title="Haga Clic para más información">
                                <h5>11.- Cooperación y Trabajo en Colectivo</h5>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso19" id="peso19" type="text" value="<? echo $npeso11; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="rango19" id="rango19" type="text" value="<? echo $nrango11; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="peso_rango19" id="peso_rango19" type="text" value="<? echo $resp11; ?>" disabled placeholder="" />
                            </div>
                        </div>



                        <div class="col-sm-6">

                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;" class="form-control" name="peso_total_m2" id="peso_total_m2" type="text" value="<? echo $peso_total2; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-2">

                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="peso_rango_total_m2" id="peso_rango_total_m2" type="text" value="<? echo $result_total2; ?>" disabled placeholder="" />
                            </div>
                        </div>
                        <div class="sep"></div>
                        <hr>
                        <div class="sep"></div>

                        <div class="col-sm-8">
                            <h2 style="color: rgb(35, 96, 249); font-size:22px;">MÓDULO III: EN ESTE MÓDULO SE OBTENDRÁ EL RANGO DE ACTUACIÓN DEL EVALUADO - TOTAL MÓDULO I + TOTAL MÓDULO II
                            </h2>
                        </div>
                        <div class="col-sm-4"></div>

                        <div class="sep"></div>
                        <hr>
                        <div class="sep"></div>



                        <!-- ------------------------------ módulo II --------------------------------------  -->


                        <!-- ------------------------------ módulo III --------------------------------------  -->
                        <table style="width: 100%" id="modulo3" class="table">
                            <tbody>

                                <tr>
                                    <th style="text-align: center; border-bottom: solid 1px grey" colspan="2">CALIFICACIÓN FINAL </th>
                                    <th style="text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> ESCALA CUANTITATIVA</th>
                                    <th style="text-align: center; border-bottom: solid 1px grey; border-left: solid 1px grey;"> RANGO DE ACTUACIÓN</th>
                                </tr>
                                <tr>
                                    <th style=" border-bottom: solid 1px grey; text-align:center; font-weight: normal">Total Módulo <span style="font-weight: 700; ">"I"</span></th>

                                    <td align="center">
                                        <div class="input-group">
                                            <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="total_modulo1" id="total_modulo1" type="text" value="<? echo $result_total1; ?>" disabled placeholder="" />
                                        </div>

                                    </td>

                                    <th style=" text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 100 - 124 </th>
                                    <th style=" text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700;"> No Cumplió </span></th>
                                </tr>
                                <tr>
                                    <th style=" border-bottom: solid 1px grey; text-align:center; font-weight: normal">Total Módulo <span style="font-weight: 700; ">"II"</span></th>
                                    <td align="center" style="border-radius: 30px; border-bottom: solid 1px grey">
                                        <div class="input-group">
                                            <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="total_modulo2" id="total_modulo2" type="text" value="<? echo $result_total2; ?>" disabled placeholder="" />
                                        </div>

                                    </td>
                                    <th style=" text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 125 - 249 </th>
                                    <th style=" text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700; color:#FF801C;"> Cumplimiento Ordinario </span></th>
                                </tr>
                                <tr>
                                    <th style=" border-bottom: solid 1px grey; text-align:center; font-weight: normal">Total Módulo <span style="font-weight: 700; ">"I"</span> + Total Módulo <span style="font-weight: 700; ">"II"</span></th>
                                    <td align="center" style="border-radius: 30px; border-bottom: solid 1px grey">

                                        <div class="input-group">
                                            <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="total_modulo13" id="total_modulo3" type="text" value="<? echo $result_total3; ?>" disabled placeholder="" />
                                        </div>

                                    </td>
                                    <th style=" text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 250 - 374 </th>
                                    <th style=" text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700; color:#FFD617; "> Bueno</span> - Cumplimiento de Proceso de Mejora </th>
                                </tr>
                                <tr>
                                    <th colspan="2" style=" border-bottom: solid 1px grey; text-align:center; padding: 8px; font-weight: 700">Rango de Actuación</th>
                                    <th style=" text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 375 - 499 </th>
                                    <th style=" text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700; color:#90DB0F "> Muy Bueno</span> - Cumplimiento Destacable </th>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center" style="border-radius: 30px; border-bottom: solid 1px grey; padding: 8px; font-weight: normal;">
                                        <span style="font-weight: 700; ">
                                            <? echo $resultado; ?>
                                        </span>
                                    </td>
                                    <th style=" text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 500 </th>
                                    <th style=" text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700; color:#3BDB0F "> Excelente</span> - Cumplimiento Emulable </th>
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


                        <div class="sep"></div>

                        <div class="col-sm-4">
                            <h2 style="color: rgb(35, 96, 249); font-size:22px;">MÓDULO IV: ACOTACIONES DEL SUPERVISOR</h2>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"></div>
                        <div class="sep"></div>
                        <hr>
                        <div class="sep"></div>
                        <form class="col-md-8 fondo" action="/minpptrassi/mod_evaluacion/files.php" method="POST" enctype="multipart/form-data">

                            <div class="col-sm-12"><label for="basic-url" class="form-label" style="margin-top:10px">Observaciones y acotaciones <span>*</span> </label>

                                <textarea disabled name="sacotacion_supervisor" id="sacotacion_supervisor" cols="0" rows="0" style="border-radius: 30px;  min-width: 99%; max-width: 99%; float:left; height: 70px; padding: 10px;" readonly><? echo $sacotacion_supervisor; ?></textarea>
                            </div>

                            <div class="col-sm-6">
                                <label for="basic-url" class="form-label" style="margin-top:10px">Nombre del 1er Curso <span>*</span> </label>
                                <div class="input-group">

                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                        <img src="img/co.png" class="input-imagen">
                                    </span>

                                    <input type="text" class="form-control" name="sprimer_curso_nombre" id="sprimer_curso_nombre" value="<? echo $sprimer_curso_nombre; ?>" readonly>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <label for="basic-url" class="form-label" style="margin-top:10px">Fecha de Realización <span>*</span> </label>
                                <div class="input-group">
                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                        <img src="img/co.png" class="input-imagen">
                                    </span>

                                    <input type="text" class="form-control" name="sprimer_curso_fecha" id="sprimer_curso_fecha" value="<? echo $sprimer_curso_fecha; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="basic-url" class="form-label" style="margin-top:10px">Nombre del 2do Curso<span>*</span> </label>
                                <div class="input-group">

                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                        <img src="img/co.png" class="input-imagen">
                                    </span>

                                    <input type="text" class="form-control" name="ssegundo_curso_nombre" id="ssegundo_curso_nombre" value="<? echo $ssegundo_curso_nombre; ?>" readonly>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <label for="basic-url" class="form-label" style="margin-top:10px">Fecha de Realización <span>*</span> </label>
                                <div class="input-group">
                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                        <img src="img/co.png" class="input-imagen">
                                    </span>

                                    <input type="text" class="form-control" name="ssegundo_curso_fecha" id="ssegundo_curso_fecha" value="<? echo $ssegundo_curso_fecha; ?>" readonly>
                                </div>
                            </div>




                            <div class="sep"></div>
                            <hr>
                            <div class="sep"></div>

                            <center>
                                <p> ¿Está de acuerdo con la evaluación? </p>
                                <input type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="si()" value="SI">
                                <input type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="no()" value="NO">
                            </center>
                        </form>



                        <!--  -->

                    </div>
            </div>
        </div>
    </div>
</main>
<div class="sep"></div>
<!-- script -->

<script src="evaluado.js"></script>
<?php include("footer.php"); ?>