<?php
include("header.php");

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

session_start();
include('../include/BD.php');
$conn = Conexion::ConexionBD();

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

if (isset($_SESSION['cedula'])) {

    $id = substr($_SESSION['cedula'], 1);

    $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $id . "' AND benabled='true';");
    $row = pg_query($conn, $consulta);
    $persona = pg_fetch_assoc($row);

    $persona_id = $persona["id"];
    $ncertificado = $persona["ncertificado"];
    $nmision_jose = $persona["nmision_jose"];

    $discp = ("SELECT * FROM snirlpcd.persona_discapacidad WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
    $row2 = pg_query($conn, $discp);
    $persona2 = pg_fetch_assoc($row2);

    $id_discapacidad = $persona2["id"];
    $tipo_discapacidad_id = $persona2["tipo_discapacidad_id"];
    $numero = explode("-", $persona2["snumero_certificado_discp"]);
    $snumero_certificado_discp =  $numero[1];
    $dfecha_emision_cert = $persona2["dfecha_emision_cert"];
    $dfecha_vencimiento_cert = $persona2["dfecha_vencimiento_cert"];
    $sdiscapacidad_especifica = $persona2["sdiscapacidad_especifica"];
    $ngrado_discapacidad = $persona2["ngrado_discapacidad"];
}
?>
<div class="content-video2 video">
    <video src="../videos/video_discapacidad.mp4" class="video" controls>
        <!-- <source src="videos/video_prueba.mp4" type="video/mp4"> -->
    </video>
</div>
<div class="col-md-12">
    <!--<div class="card card-primary"> Original-->
    <div class="card" style="border-radius: 30px;">
        <!-- card-header alert-primary  text-white bg-primary -->
        <div class="card-header text-center alert-primary" style="border-radius: 30px ">
            <h3 class="card-title"> Discapacidad </h3>
        </div>
    </div>
    <div class="card" style="border-radius: 30px;">
        <div class="card-header text-center alert-info" style="border-radius: 30px 30px 0 0;">
            <h3 class="card-title"> Certificación de Discapacidad </h3>
        </div>
        <div style="padding: 10px; text-align: right; margin-bottom: -35px">
            <h4 style="color: #BF1F13; font-size: 15px;">Campos obligatorios (*)</h4>
        </div>

        <!--
            <?
            echo $id_discapacidad;
            ?>
        -->

        <!--<div class="card-body">-->
        <form action="../../../agencia_empleo_VIEJO/mod_agencia_empleo/1_5agen_trab_educacion.php">
            <div class="card-body">
                <!--inicio card-body Información de Experiencia Laboral-->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <center>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="text-secondary">¿Posee Certificación de Discapacidad de CONAPDIS?</label><span style="color: red;"> *</span>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="border-radius: 30px 0 0 30px; height: 30px; font-size: 13px"><i class="icon-low-vision"></i></span>
                                            </div>
                                            <!--  <script>
                                                let valor = <? echo ($ncertificado); ?>;
                                                alert(valor);
                                                alert('hoas');
                                            </script> -->
                                            <select style="border-radius: 0 30px 30px 0; height: 30px; font-size: 13px" type="text" class="form-control" name="discapacidad" id="discapacidad">
                                                <?
                                                if ($ncertificado == "2") {
                                                ?>
                                                    <option value="-1">Seleccione</option>
                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                <?
                                                } else 
                                                if ($ncertificado == "1") {
                                                ?>
                                                    <option value="-1">Seleccione</option>
                                                    <option value="1" selected>Si</option>
                                                    <option value="2">No</option>
                                                <?
                                                } else {
                                                ?>
                                                    <option value="-1">Seleccione</option>
                                                    <option value="1">Si</option>
                                                    <option value="2">No</option>
                                                <?
                                                }
                                                ?>
                                            </select>
                                            <script>
                                                $(document).ready(function() {
                                                    if ($("#discapacidad").val() == "1") {
                                                        $("#content").show();
                                                    } else {
                                                        $("#content").hide();
                                                    }
                                                })
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <!--
                                    <div align="left" class="icheck-gray d-inline">
                                    <input type="radio" id="radioPrimary9" name="r2" value="Si" onclick="aparecer()">
                                    <label for="radioPrimary9" class="text-secondary">SI</label>
                                    </div>
                                    <div align="left" class="icheck-gray d-inline">
                                        <input type="radio" id="radioPrimary0" name="r2" value="No" onclick="desaparecer()">
                                        <label for="radioPrimary0" class="text-secondary">NO</label>
                                    </div>
                                -->
                            </center>
                        </div>
                        <div class="col-sm-12">
                            <div id="content">
                                <div class="col-sm-12">
                                    <center>
                                        <div class="form-group">
                                            <!--
                                                <div>
                                                    <label class="text-secondary">Posee discapacidad?</label><span style="color: red;"> *</span>
                                                    <input type="radio" id="radioPrimary13" onclick="javascript:seleccion()" name="r7" >
                                                    <label for="radioPrimary13" class="text-secondary">SI
                                                    </label>
                                                    <input type="radio" id="radioPrimary14" onclick="javascript:deselecion()" name="r7" checked="">
                                                    <label for="radioPrimary14" class="text-secondary">NO
                                                    </label>
                                                </div>
                                            -->
                                            <script>
                                                function seleccion() {
                                                    document.getElementById("numero_certificado").disabled = false;
                                                    document.getElementById("discapacidad_general").disabled = false;
                                                    document.getElementById("discapacidad_especifica").disabled = false;
                                                    document.getElementById("afectacion").disabled = false;
                                                    document.getElementById("localizacion").disabled = false;
                                                    document.getElementById("origen_discapacidad").disabled = false;
                                                    document.getElementById("nivel_discapacidad").disabled = false;
                                                    document.getElementById("grado_discapacidad").disabled = false;
                                                }

                                                function deselecion() {
                                                    document.getElementById("numero_certificado").disabled = true;
                                                    document.getElementById("discapacidad_general").disabled = true;
                                                    document.getElementById("discapacidad_especifica").disabled = true;
                                                    document.getElementById("afectacion").disabled = true;
                                                    document.getElementById("localizacion").disabled = true;
                                                    document.getElementById("origen_discapacidad").disabled = true;
                                                    document.getElementById("nivel_discapacidad").disabled = true;
                                                    document.getElementById("grado_discapacidad").disabled = true;
                                                }
                                            </script>
                                        </div>
                                    </center>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-secondary">Número de Certificación de Discapacidad</label><span style="color: red;"> * </span>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px; height: 30px; font-size: 13px"><i class="icon-barcode"></i></span>
                                                </div>
                                                <span class="input-group-text" style="padding: 0 10px;">D-</span>
                                                <input style="border-radius: 0 30px 30px 0; height: 30px; font-size: 13px" type="text" class="form-control" maxlength="6" name="numero_certificado" id="numero_certificado" value="<? echo $snumero_certificado_discp; ?>" placeholder="XXXXXX">
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function soloNumeros(e) {
                                            // Permitir solo teclas numéricas, retroceso y tabulación
                                            const permitidos = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 8, 9, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
                                            if (!permitidos.includes(e.keyCode)) {
                                            e.preventDefault();
                                            }
                                        }
                                        document.getElementById("numero_certificado").addEventListener("keydown", soloNumeros);
                                    </script>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-secondary">Fecha de Emisión</label><span style="color: red;"> *</span>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px; height: 30px; font-size: 13px"><i class="icon-barcode"></i></span>
                                                </div>
                                                <input style="border-radius: 0 30px 30px 0; height: 30px; font-size: 13px" type="date" class="form-control" maxlength="10" name="f_emision" id="f_emision" value="<? echo $dfecha_emision_cert; ?>" placeholder="dd-mm-aaaa">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-secondary">Fecha de Vencimiento</label><span style="color: red;"> *</span>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px; height: 30px; font-size: 13px"><i class="icon-barcode"></i></span>
                                                </div>
                                                <input style="border-radius: 0 30px 30px 0; height: 30px; font-size: 13px" type="date" class="form-control" maxlength="10" name="f_vencimiento" id="f_vencimiento" value="<? echo $dfecha_vencimiento_cert; ?>" placeholder="dd-mm-aaaa">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-secondary">Tipo de Discapacidad</label><span style="color: red;"> *</span>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px; height: 30px; font-size: 13px"><i class="icon-cd"></i></span>
                                                </div>
                                                <select style="border-radius: 0 30px 30px 0; height: 30px; font-size: 13px" type="text" class="form-control" name="discapacidad_general" id="discapacidad_general">
                                                    <option value="-1">Seleccione</option>
                                                    <?
                                                    $sql = "SELECT * FROM snirlpcd.tipo_discapacidad WHERE benabled = 'TRUE';";
                                                    $row3 = pg_query($conn, $sql);
                                                    $persona3 = pg_fetch_all($row3);
                                                    foreach ($persona3 as $u) {
                                                        if ($tipo_discapacidad_id == $u["id"]) {
                                                    ?>
                                                            <option value="<? echo $u['id']; ?>" selected><? echo $u['sdescripcion']; ?></option>
                                                        <?
                                                        } else {
                                                        ?>
                                                            <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                    <?
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <!--
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px; height: 30px; font-size: 13px"><i class="icon-accessibility"></i></span>
                                                    </div>
                                                    <input style="border-radius: 0 30px 30px 0; height: 30px; font-size: 13px" type="text" class="form-control" maxlength="15" name="discapacidad_general" id="discapacidad_general" placeholder="Ej. Ceguera">
                                                -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-secondary">Discapacidad Específica</label><span style="color: red;"> * </span>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px; height: 30px; font-size: 13px"><i class="icon-barcode"></i></span>
                                                </div>
                                                <input onkeyup="mayus(this);" style="border-radius: 0 30px 30px 0; height: 30px; font-size: 13px" type="text" class="form-control" name="sdiscapacidad_especifica" id="sdiscapacidad_especifica" value="<? echo $sdiscapacidad_especifica; ?>" placeholder="Ej. Dolor severo en el brazo derecho">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-secondary">Grado de Discapacidad</label><span style="color: red;"> *</span>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px; height: 30px; font-size: 13px"><i class="icon-low-vision"></i></span>
                                                </div>
                                                <select style="border-radius: 0 30px 30px 0; height: 30px; font-size: 13px" type="text" class="form-control" name="discapacidad_grado" id="discapacidad_grado">
                                                    <?
                                                    if ($id_discapacidad != "") {
                                                        if ($ngrado_discapacidad == "1") {
                                                    ?>
                                                            <option value="-1">Seleccione</option>
                                                            <option value="1" selected>Leve</option>
                                                            <option value="2">Moderado</option>
                                                            <option value="3">Grave</option>
                                                            <option value="4">Severo</option>
                                                            <option value="5">Completo</option>
                                                        <?
                                                        } else
                                                        if ($ngrado_discapacidad == "2") {
                                                        ?>
                                                            <option value="-1">Seleccione</option>
                                                            <option value="1">Leve</option>
                                                            <option value="2" selected>Moderado</option>
                                                            <option value="3">Grave</option>
                                                            <option value="4">Severo</option>
                                                            <option value="5">Completo</option>
                                                        <?
                                                        } else
                                                        if ($ngrado_discapacidad == "3") {
                                                        ?>
                                                            <option value="-1">Seleccione</option>
                                                            <option value="1">Leve</option>
                                                            <option value="2">Moderado</option>
                                                            <option value="3" selected>Grave</option>
                                                            <option value="4">Severo</option>
                                                            <option value="5">Completo</option>
                                                        <?
                                                        } else
                                                        if ($ngrado_discapacidad == "4") {
                                                        ?>
                                                            <option value="-1">Seleccione</option>
                                                            <option value="1">Leve</option>
                                                            <option value="2">Moderado</option>
                                                            <option value="3">Grave</option>
                                                            <option value="4" selected>Severo</option>
                                                            <option value="5">Completo</option>
                                                        <?
                                                        } else
                                                        if ($ngrado_discapacidad == "5") {
                                                        ?>
                                                            <option value="-1">Seleccione</option>
                                                            <option value="1">Leve</option>
                                                            <option value="2">Moderado</option>
                                                            <option value="3">Grave</option>
                                                            <option value="4">Severo</option>
                                                            <option value="5" selected>Completo</option>
                                                        <?
                                                        }
                                                        ?>
                                                    <?
                                                    } else {
                                                    ?>
                                                        <option value="-1">Seleccione</option>
                                                        <option value="1">Leve</option>
                                                        <option value="2">Moderado</option>
                                                        <option value="3">Grave</option>
                                                        <option value="4">Severo</option>
                                                        <option value="5">Completo</option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-secondary">Afectación</label><span style="color: red;"> *</span>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px; height: 30px; font-size: 13px"><i class="icon-wheelchair-alt"></i></span>
                                                </div>
                                                <input style="border-radius: 0 30px 30px 0; height: 30px; font-size: 13px" type="text" class="form-control" name="afectacion" placeholder="Por ausencia de la función visual" id="afectacion" disabled>
                                            </div>
                                        </div>
                                        </div>
                                    -->
                                    <!--
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-secondary">Localización</label><span style="color: red;"> *</span>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px; height: 30px; font-size: 13px"><i class="icon-location"></i></span>
                                                    </div>
                                                    <input style="border-radius: 0 30px 30px 0; height: 30px; font-size: 13px" type="text" class="form-control" name="localizacion" placeholder="Ambos ojos" id="localizacion" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    -->
                                    <!--
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-secondary">Origen de Discapacidad</label><span style="color: red;"> *</span>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px; height: 30px; font-size: 13px"><i class="icon-cd"></i></span>
                                                    </div>
                                                    <select style="border-radius: 0 30px 30px 0; height: 30px; font-size: 13px" type="text" class="form-control" name="origen_discapacidad" placeholder="Genética" id="origen_discapacidad" disabled>
                                                        <option value="-1">Seleccione</option>
                                                        <? $sql = "SELECT * FROM public.discapacidad_origen where status = 'A';";
                                                        $discapacidad_origen = pg_query($conn, $sql);
                                                        $discapacidad_origen = pg_fetch_all($discapacidad_origen);
                                                        foreach ($discapacidad_origen as $u) { ?>
                                                            <option value="<? echo $u['id']; ?>"><? echo $u['nombre']; ?></option>
                                                        <? } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    -->
                                    <!--
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-secondary">Nivel de Dependencia</label><span style="color: red;"> *</span>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px; height: 30px; font-size: 13px"><i class="icon-blind"></i></span>
                                                    </div>
                                                    <input style="border-radius: 0 30px 30px 0; height: 30px; font-size: 13px" type="text" class="form-control" name="nivel_discapacidad" placeholder="Poca dependencia" id="nivel_discapacidad" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    -->
                                    <!--
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-secondary">Grado de Discapacidad</label><span style="color: red;"> *</span>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px; height: 30px; font-size: 13px"><i class="icon-cd"></i></span>
                                                    </div>
                                                    <input style="border-radius: 0 30px 30px 0; height: 30px; font-size: 13px" type="text" class="form-control" name="grado_discapacidad" placeholder="Severo" id="grado_discapacidad" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    -->
                                    <!--
                                        <div class="col-sm-12">
                                            <label class="text-secondary">Observaciones</label>
                                            <textarea class="form-control" name="Observaciones" id="Observaciones" placeholder="Observaciones" style="border-radius: 30px"></textarea>
                                        </div>
                                    -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <center>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="text-secondary">¿Es beneficiario de la Misión José Gregorio Hernández?</label><span style="color: red;"> *</span>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="border-radius: 30px 0 0 30px; height: 30px; font-size: 13px"><i class="icon-low-vision"></i></span>
                                            </div>
                                            <select style="border-radius: 0 30px 30px 0; height: 30px; font-size: 13px" type="text" class="form-control" name="mision_jose" id="mision_jose">
                                                <?
                                                if ($nmision_jose == "2") {
                                                ?>
                                                    <option value="-1">Seleccione</option>
                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                <?
                                                } else
                                                if ($nmision_jose == "1") {
                                                ?>
                                                    <option value="-1">Seleccione</option>
                                                    <option value="1" selected>Si</option>
                                                    <option value="2">No</option>
                                                <?
                                                } else {
                                                ?>
                                                    <option value="-1">Seleccione</option>
                                                    <option value="1">Si</option>
                                                    <option value="2">No</option>
                                                <?
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--
                                    <div align="left" class="icheck-gray d-inline">
                                    <input type="radio" id="radioPrimary7" value="Si2" name="r4">
                                    <label for="radioPrimary7" class="text-secondary">SI</label>
                                    </div>
                                    <div align="left" class="icheck-gray d-inline">
                                        <input type="radio" id="radioPrimary8" value="No2" name="r4">
                                        <label for="radioPrimary8" class="text-secondary">NO</label>
                                    </div>
                                -->
                            </center>
                        </div>
                        <!-- <script>
                            function onCheckboxChange(event) {
                                // Obtiene el checkbox que cambió
                                var checkbox = event.target;
                                // Determina qué checkbox seleccionó el usuario
                                if (checkbox.id === "radioPrimary9") {
                                    document.getElementById("radioPrimary9").addEventListener("change", onCheckboxChange);
                                } else
                                if (checkbox.id === "radioPrimary0") {
                                    // El usuario seleccionó discapacidad_no
                                    document.getElementById("radioPrimary0").addEventListener("change", onCheckboxChange);
                                } else
                                if (checkbox.id === "radioPrimary7") {
                                    document.getElementById("radioPrimary7").addEventListener("change", onCheckboxChange);
                                } else
                                if (checkbox.id === "radioPrimary8") {
                                    document.getElementById("radioPrimary8").addEventListener("change", onCheckboxChange);
                                }
                            }
                        </script> -->
                        <div class="form-group row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-2">
                                <center>
                                    <a href="datos_personales.php">
                                        <input style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' value="Regresar">
                                    </a>
                                </center>
                            </div>
                            <div class="col-sm-2">
                                <center>
                                    <?
                                    if ($id_discapacidad != "") {
                                    ?>
                                        <input onclick="accion_discapacidad(discapacidad.value,numero_certificado.value,f_emision.value,f_vencimiento.value,discapacidad_general.value,sdiscapacidad_especifica.value,discapacidad_grado.value,mision_jose.value)" style="background-color: #46A2FD; color: #fff; width: auto; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; font-size: 16px; float: right" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="button" value="Actualizar Registro">
                                    <?
                                    } else {
                                    ?>
                                        <input onclick="accion_discapacidad_actualizar(discapacidad.value,numero_certificado.value,f_emision.value,f_vencimiento.value,discapacidad_general.value,sdiscapacidad_especifica.value,discapacidad_grado.value,mision_jose.value)" style="background-color: #46A2FD; color: #fff; width: auto; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; font-size: 16px; float: right" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="button" value="Continuar">
                                    <?
                                    }
                                    ?>
                                </center>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                        <!--
                            <a href="datos_personales.php">
                                <div style="background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px;margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit">Regresar</div>
                            </a>
                        -->
                    </div>
                    <!--
                        <div class="row" >
                            <div class="col-md-3"> </div>
                                <div class="col-md-3">
                                    <a href="educacion.php?cedula=<? echo $id; ?>" id="redireccion">
                                        <input class="btn btn-outline-primary" onclick="javascript:comprobar()" value="Continuar" style="border-radius: 30px">
                                    </a>  
                                </div>
                                <div class="col-md-2">
                                    <a href="datos_personales.php?cedula=<? echo $id; ?>">
                                        <input class="btn btn-outline-danger" value="Regresar" style="border-radius: 30px">
                                    </a>
                                </div>
                            </div>
                        </div>
                    -->
                </div>
                <!-- <script>
                    // Obtiene el elemento select
                    var discp = document.querySelector("#discapacidad");

                    // Obtiene el valor del select
                    var value = discp.value;

                    // Si el valor es "sí", muestra los inputs adicionales
                    if (value === "1") {
                        document.getElementById("content").style.display = "block";
                    } else {
                        document.getElementById("content").style.display = "none";
                    }
                </script> -->
                <script>
                    window.addEventListener("DOMContentLoaded", function() {
                        const discapacidad = document.getElementById("discapacidad");
                        const content = document.getElementById("content");

                        discapacidad.addEventListener("change", function() {
                            if (discapacidad.value === "-1" || discapacidad.value === "2") {
                                content.style.display = "none";
                            } else {
                                content.style.display = "block";
                            }
                        });
                    });

                    /* function aparecer() {
                        document.getElementById("content").style.display = 'block';
                    }
                    function desaparecer() {
                        document.getElementById("content").style.display = 'none';
                    } */
                    /* document.getElementById("radioPrimary9").onclick = function(){
                        document.getElementById("content").style = 'block';
                    }
                    document.getElementById("radioPrimary0").onclick = function(){
                        document.getElementById("content").style = 'none';
                    } */
                </script>
                <script src="discapacidad.js"></script>
                <script>
                    function comprobar() {
                        var discapacidad = document.getElementById("r7").Value;
                        var mision = document.getElementById("r4").Value;
                        var mensaje = window.alert("Debe Rellenar Todos los Campos obligatorios (*)");
                        if (discapacidad == "" || mision == "") {
                            mensaje;
                        }
                    }
                </script>
            </div>
    </div>
    </form>
    <!----</div>-->
</div>
<!-- /.card-body -->
</div>
<?php
include("footer.php");
?>