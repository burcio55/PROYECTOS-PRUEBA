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
/* include("../header.php"); */ include("header.php");
/* include("../mod_hcm/general_LoadCombo.php"); */

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


$desde2 = "2024-10-01";
$hasta2 = "2024-12-31";



$_SESSION["Desde"] = $desde;
$_SESSION["Hasta"] = $hasta;

?>

<main>
    <div class="content-3d">

        <div class="container">
            <?
            include('menu2.php');
            ?>

            <div class="content-login">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 style="font-size:32px; font-weight: normal;">MANTENIMIENTO - Incidencias</h1>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <h6 class="obligatorio">Datos Obligatorios (*)</h6>
                    </div>
                    <hr>
                    <form name="formulario" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" id="formulario">
                        <div class="row">
                            <div class="sep"></div>

                            <!-- ------------------------------ Periodo Evaluado --------------------------------------  -->

                            <div class="col-sm-4">
                                <h2 style="color: rgb(35, 96, 249); font-size:22px;">PERIODO EVALUADO</h2>
                            </div>
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4"></div>

                            <div class="col-sm-6">
                                <label for="basic-url" class="form-label" style="margin-top:10px">Desde : <span>*</span> </label>


                                <input class="form-control" style="background: #b6b4b4b2; color: #313131;border-radius:30px;" name="desde" id="desde" type="text" value="<? echo $desde; ?>" placeholder="" readonly />
                            </div>
                            <div class="col-sm-6">
                                <label for="basic-url" class="form-label" style="margin-top:10px">Hasta : <span>*</span> </label>

                                <input class="form-control" style="background: #b6b4b4b2; color: #313131;border-radius:30px ;" name="hasta" id="hasta" type="text" value="<? echo $hasta; ?>" placeholder="" readonly />
                            </div>

                            <div class="sep"></div>
                            <hr>
                            <div class="sep"></div>
                            <!-- ------------------------------ datos del evaluado --------------------------------------  -->
                            <div class="col-sm-4">
                                <h2 style="color: rgb(35, 96, 249); font-size:22px;">DATOS DEL NO EVALUADO</h2>
                            </div>
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4"></div>

                            <div class="sep"></div>

                            <div class="col-sm-6"> <label for="basic-url" class="form-label">Cédula de Identidad <span>*</span> </label> <span></span>
                                <div class="input-group">

                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                        <img src="img/co.png" class="input-imagen">
                                    </span>

                                    <input type="text" class="form-control" placeholder="Ej. 10564238" onkeypress="number(2)" maxlength="8" name="cedula2" id="cedula2" type="text" value="">
                                    <button onclick="buscar(2)" type="button" style="background-color: rgb(70, 162, 253); color: rgb(255, 255, 255); border: 1px solid rgb(70, 162, 253); padding: 7px 22px; border-radius: 0px 30px 30px 0px; width: auto; margin-left: -15px;margin: 0" onmouseout="this.style.color=&quot;#fff&quot;; this.style.backgroundColor=&quot;#46A2FD&quot;; this.style.border=&quot;1px Solid #46A2FD&quot;" onmouseover="this.style.color=&quot;#46A2FD&quot;; this.style.backgroundColor=&quot;#fff&quot;;" data-bs-toggle="tooltip">Buscar</button>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="basic-url" class="form-label">Nombre(s) y Apellido(s) </label>
                                <div class="input-group">
                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                        <img src="img/co.png" class="input-imagen">
                                    </span>
                                    <input class="form-control" style="background: #b6b4b4b2; color: #313131;border-radius: 0 30px 30px 0;" name="nombre_apellido2" id="nombre_apellido2" type="text" value="" placeholder="" readonly />
                                </div>
                            </div>

                            <div class="col-sm-6" style="display:none;">
                                <label for="basic-url" class="form-label">Incidencia</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                        <img src="img/co.png" class="input-imagen">
                                    </span>
                                    <input class="form-control" style="background: #b6b4b4b2; color: #313131;border-radius: 0 30px 30px 0;" name="incidencia" id="incidencia" type="text" value="" placeholder="" readonly />
                                </div>
                            </div>

                            <div class="col-sm-6" style="display:none;" >
                                <label for="basic-url" class="form-label">Incidencia Fecha</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                        <img src="img/co.png" class="input-imagen">
                                    </span>
                                    <input class="form-control" style="background: #b6b4b4b2; color: #313131;border-radius: 0 30px 30px 0;" name="incidencia_fecha" id="incidencia_fecha" type="text" value="" placeholder="" readonly />
                                </div>
                            </div>

                            <div class="col-sm-6" style="display:none;">
                                <label for="basic-url" class="form-label">Incidencia Observaciones</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                        <img src="img/co.png" class="input-imagen">
                                    </span>
                                    <input class="form-control" style="background: #b6b4b4b2; color: #313131;border-radius: 0 30px 30px 0;" name="incidencia_observacion" id="incidencia_observacion" type="text" value="" placeholder="" readonly />
                                </div>
                            </div>



                            <div class="sep"></div>

                            <div class="col-sm-12">
                                <label for="basic-url" class="form-label">Razón o Circunstancia por la cual no fue evaluado<span>*</span></label>


                                <div class="input-group">
                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="addon-wrapping"> <img src="img/co.png" class="input-imagen"> </span>

                                    <select class="form-select" style="border-radius: 0 30px  30px 0;" id="razon" name="razon">
                                        <option value="-1">Seleccione </option>
                                        <?
                                        $sql = "SELECT * FROM evaluacion_desemp.incidencias WHERE benabled = 'TRUE' Order By sdescripcion";
                                        $row = pg_query($conn, $sql);
                                        $persona = pg_fetch_all($row);
                                        foreach ($persona as $u) {
                                        ?>
                                            <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                        <?
                                        }
                                        ?>
                                    </select>

                                </div>



                            </div>



                            <input style="border-radius: 30px; border-color:#999999; width:81%; float:left; display: none" name="codigo2" id="codigo2" type="text" value="" placeholder="" readonly />

                            <input style="border-radius: 30px; border-color:#999999; width:92%; float:left; display: none" name="cargo_ejerce2" id="cargo_ejerce2" type="text" value="" placeholder="" readonly />
                            <input style="border-radius: 30px; border-color:#999999; width:92%; float:left; display: none" name="cargo2" id="cargo2" type="text" value="" placeholder="" readonly />
                            <input style="border-radius: 30px; border-color:#999999; width:92%; float:left; display: none" name="tipo_trabajador2" id="tipo_trabajador2" type="text" value="" placeholder="" readonly />
                            <input style="border-radius: 30px; border-color:#999999; width:92%; float:left; display: none" name="ubicacion_adm2" id="ubicacion_adm2" type="text" value="" placeholder="" readonly />
                            <input style="border-radius: 30px; border-color:#999999; width:92%; float:left; display: none" name="ubicacion_act2" id="ubicacion_act2" type="text" value="" placeholder="" readonly />
                            <input style="border-radius: 30px; border-color:#999999; width:92%; float:left;display: none" name="persona_id2" id="persona_id2" type="text" value="" placeholder="" readonly />
                            <input style="border-radius: 30px; border-color:#999999; width:92%; float:left; display: none" name="rol_evaluacion2" id="rol_evaluacion2" type="text" value="" placeholder="" readonly />
                            <input style="border-radius: 30px; border-color:#999999; width:92%; float:left; display: none" name="periodo_evaluacion2" id="periodo_evaluacion2" type="text" value="" placeholder="" readonly />
                            <input style="border-radius: 30px; border-color:#999999; width:92%; float:left; display: none" name="nanno_evalu2" id="nanno_evalu2" type="text" value="" placeholder="" readonly />
                            <input style="border-radius: 30px; border-color:#999999; width:92%; float:left; display: none" name="cargo_id2" id="cargo_id2" type="text" value="" placeholder="" readonly />
                            <input style="border-radius: 30px; border-color:#999999; width:92%; float:left; display: none" name="ubicacion_scodigo2" id="ubicacion_scodigo2" type="text" value="" placeholder="" readonly />
                            <input style="border-radius: 30px; border-color:#999999; width:92%; float:left; display: none" name="codigo_tipos_trabajadores2" id="codigo_tipos_trabajadores2" type="text" value="" placeholder="" readonly />

                            <div class="sep"></div>
                            <div class="col-sm-6">

                                <label for="basic-url" class="form-label">
                                    ¿Desde cuándo está en esa situación?
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                        <img src="img/co.png" class="input-imagen">
                                    </span>

                                    <input class="form-control" style="color: #313131; border-radius: 0 30px 30px 0;" name="desde2" id="desde2" type="date" />
                                </div>
                                <script>
                                    const dateInput = document.getElementById('desde2');
                                    const currentYear = new Date().getFullYear();
                                    let minDate, maxDate;

                                    const periodo = <?php echo $_SESSION["Periodo"]; ?>;

                                    if (periodo === 1) {
                                        minDate = `${currentYear}-01-01`;
                                        maxDate = `${currentYear}-03-31`;
                                    } else if (periodo === 2) {
                                        minDate = `${currentYear}-04-01`;
                                        maxDate = `${currentYear}-06-30`;
                                    } else if (periodo === 3) {
                                        minDate = `${currentYear}-07-01`;
                                        maxDate = `${currentYear}-09-30`;
                                    } else if (periodo === 4) {
                                        minDate = `${currentYear}-10-01`;
                                        maxDate = `${currentYear}-12-31`;
                                    }

                                    dateInput.min = minDate;
                                    dateInput.max = maxDate;

                                    dateInput.addEventListener('blur', function() { // Cambiado de 'input' a 'blur'
                                        const dateValue = new Date(dateInput.value);
                                        const min = new Date(minDate);
                                        const max = new Date(maxDate);

                                        if (dateValue < min || dateValue > max) {
                                            alert('La fecha ingresada no está dentro del rango permitido.');
                                            dateInput.value = '';
                                        }
                                    });
                                </script>
                            </div>
    
                            <div class="col-sm-6">

                                <label for="basic-url" class="form-label">
                                    ¿Hasta cuándo estará en esa situación?
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                        <img src="img/co.png" class="input-imagen">
                                    </span>
                                    <input class="form-control" style="color: #313131;border-radius: 0 30px 30px 0;" name="hasta2" id="hasta2" type="date" />

                                </div>
                                <script>
                                        const dateInputHasta = document.getElementById('hasta2');
                                        const currentAño = new Date().getFullYear();
                                        let minDateHasta, maxDateHasta;

                                        const periodo2 = <?php echo $_SESSION["Periodo"]; ?>; // Cambia este valor según el periodo deseado

                                        if (periodo2 === 1) {
                                            minDateHasta = `${currentAño}-01-01`;
                                            maxDateHasta = `${currentAño}-03-31`;
                                        } else if (periodo2 === 2) {
                                            minDateHasta = `${currentAño}-04-01`;
                                            maxDateHasta = `${currentAño}-06-30`;
                                        } else if (periodo2 === 3) {
                                            minDateHasta = `${currentAño}-07-01`;
                                            maxDateHasta = `${currentAño}-09-30`;
                                        } else if (periodo2 === 4) {
                                            minDateHasta = `${currentAño}-10-01`;
                                            maxDateHasta = `${currentAño}-12-31`;
                                        }

                                        dateInputHasta.min = minDateHasta;
                                        dateInputHasta.max = maxDateHasta;

                                        dateInputHasta.addEventListener('blur', function() { // Cambiado de 'input' a 'blur'
                                            const dateValueHasta = new Date(dateInputHasta.value);
                                            const minHasta = new Date(minDateHasta);
                                            const maxHasta = new Date(maxDateHasta);

                                            if (dateValueHasta < minHasta || dateValueHasta > maxHasta) {
                                                alert('La fecha ingresada no está dentro del rango permitido.');
                                                dateInputHasta.value = '';
                                            }
                                        });
                                </script>
                            </div>
                            <div class="sep"></div>

                            <div class="col-sm-12">
                                <label for="basic-url" class="form-label">Observaci&oacute;n(es)</label>

                                <center>

                                    <textarea name="obs" id="obs" style="border-radius: 30px; border-color:#999999; width:100%;  height: 70px; text-align: justify">
                                    </textarea>
                                </center>

                            </div>

                            <div class="sep"></div>
                            <hr>
                            <div class="sep"></div>
                            <center>
                                <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="permiso()">GUARDAR</button>
                            </center>


                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- script -->

<script src="permiso.js"></script>
<? include("footer.php"); ?>