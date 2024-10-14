<?php
//1.0
// al descomentar el diplay_errors se visualizan los errores de php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('../header.php');
$conn = getConnDB('rnet');
$conn->debug = false;


/* if (!(isset($_SESSION['actualiza_entes']))) {
    $_SESSION['actualiza_entes'] = 0;
} */

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

session_start();
/* include('../include/BD.php');
$conex = Conexion::ConexionBD(); */

try {
    $conex = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conex = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$query = "SELECT";
$query .= " rnee_sucursales.id,";
$query .= " rnee_sucursales.sdenominacion_comercial,";
$query .= " rnee_sucursales.sdireccion,";
$query .= " entidad.sdescripcion AS estado,";
$query .= " municipio.sdescripcion AS municipio,";
$query .= " parroquia.sdescripcion AS parroquia,";
$query .= " rnee_condicion_actividad_movimiento.rnee_sucursal_id";
$query .= " FROM rnee.rnee_sucursales";
$query .= " INNER JOIN rnee.rnee_condicion_actividad_movimiento ON";
$query .= " rnee_condicion_actividad_movimiento.rnee_sucursal_id = rnee_sucursales.id";
$query .= " INNER JOIN parroquia ON";
$query .= " parroquia.nparroquia = rnee_sucursales.parroquia_id";
$query .= " INNER JOIN municipio ON";
$query .= " municipio.nmunicipio = parroquia.nmunicipio";
$query .= " INNER JOIN entidad ON";
$query .= " entidad.nentidad = parroquia.nentidad";
$query .= " WHERE";
$query .= " rnee_condicion_actividad_movimiento.rnee_empresa_id='79292'";
$query .= " AND";
$query .= " rnee_sucursal_id>='0'";
$query .= " AND";
$query .= " rnee_condicion_actividad_movimiento.nenabled='1'";
$query .= " AND";
$query .= " rnee_condicion_actividad_movimiento.rnee_condicion_id <='2'";
$query .= " ORDER BY";
$query .= " rnee_sucursales.sdenominacion_comercial ASC";

?>
<style type="text/css">
    .loaders {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('../imagenes/cargando.gif') 50% 50% no-repeat rgb(255, 255, 255);
        opacity: 0.6;
        filter: alpha(opacity=60);
    }
</style>
<?php
$cedula_empresa = $_SESSION["id_usuario"];

$empr = "SELECT * FROM";
$empr .= " rnee.sesion";
$empr .= " WHERE";
$empr .= " id = '" . $cedula_empresa . "'";
$empr .= " AND";
$empr .= " nenabled='1'";

$row0 = pg_query($conex, $empr);
$ced_empre = pg_fetch_assoc($row0);

$id_empresa = $ced_empre["rnee_empresa_id"];
?>

<form name="frm_rnet_plantilla" id="frm_rnet_plantilla" method="post" action="/mpppst/rnet/mod_rnet/rnet_modificar_planilla.php">
    <input name="action" type="hidden" value="" />
    <script type="text/javascript" src="validar_rnet_solicitud_2.js"></script>
    <script type="text/javascript" src="funciones_rnet_solicitud_2.js"></script>
    <script type="text/javascript" src="funciones_identificacion_emp_rep.js"></script>

    <script>
        function send(saction) {
            if (validar_formulario() == true) {

                var form = document.frm_rnet_plantilla;
                form.action.value = saction;
                form.submit();
            }
        }

        //FUNCIONES PARA FORMATO DE NUMEROS 1000.00,00	
        $(function() {
            $('#txt_social').on('change', function() {
                console.log('Change event.');
                var val = $('#txt_social').val();
            });
            $('#txt_social').change(function() {
                console.log('Second change event...');
            });
            $('#txt_social').number(true, 2, ',', '.');
            $('#txt_pagado').on('change', function() {
                console.log('Change event.');
                var val = $('#txt_pagado').val();
            });
            $('#txt_pagado').change(function() {
                console.log('Second change event...');
            });
            $('#txt_pagado').number(true, 2, ',', '.');
            $('#txt_contable').on('change', function() {
                console.log('Change event.');
                var val = $('#txt_social').val();
            });
            $('#txt_contable').change(function() {
                console.log('Second change event...');
            });
            $('#txt_contable').number(true, 2, ',', '.');
        });
        // Agrega separador de mil y decimales a montos en bolivares
    </script>
    <script>
        //FUNCIONES PARA EL BUSCADOR EN COMBO
        //PRIMER COMBO
        (function($) {
            $.widget("custom.combobox", {
                _create: function() {
                    this.wrapper = $("<span>")
                        .addClass("custom-combobox")
                        .insertAfter(this.element);

                    this.element.hide();

                    this._createAutocomplete();
                    this._createShowAllButton();



                },
                _createAutocomplete: function() {



                    var selected = this.element.children(":selected"),
                        value = selected.val() ? selected.text() : "";


                    this.input = $("<input>")
                        .appendTo(this.wrapper)
                        .val(value)

                        //.attr( "title", "Indique su valor a Buscar" )
                        .addClass("custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left")
                        .autocomplete({

                            delay: 0,
                            minLength: 0,
                            source: $.proxy(this, "_source")
                        })
                        .tooltip({
                            tooltipClass: "ui-state-highlight"
                        });
                    this._on(this.input, {
                        autocompleteselect: function(event, ui) {
                            ui.item.option.selected = true;
                            this._trigger("select", event, {
                                item: ui.item.option
                            });


                            //EJECUTANDO UNA FUNCION		
                            setTimeout('recargar_cbo_economica5();', 200);
                            //FIN EJECUTANDO LA FUNCION

                        },
                        autocompletechange: "_removeIfInvalid"


                    });


                },
                _createShowAllButton: function() {
                    var input = this.input,
                        wasOpen = false;
                    $("<a>")
                        .attr("tabIndex", -1)
                        .attr("title", "Seleccionar todos")
                        .tooltip()
                        .appendTo(this.wrapper)
                        .button({
                            icons: {
                                primary: "ui-icon-triangle-1-s"
                            },
                            text: false
                        })
                        .removeClass("ui-corner-all")
                        .addClass("custom-combobox-toggle ui-corner-right")
                        .mousedown(function() {
                            wasOpen = input.autocomplete("widget").is(":visible");
                        })
                        .click(function() {
                            input.focus();

                            // Close if already visible
                            if (wasOpen) {
                                return;
                            }
                            // Pass empty string as value to search for, displaying all results
                            input.autocomplete("search", "");
                        });
                },
                _source: function(request, response) {
                    var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                    response(this.element.children("option").map(function() {

                        var text = $(this).text();
                        if (this.value && (!request.term || matcher.test(text)))
                            return {
                                label: text,
                                value: text,
                                option: this
                            };


                    }));

                },
                _removeIfInvalid: function(event, ui) {
                    // Selected an item, nothing to do
                    if (ui.item) {
                        return;
                    }
                    // Search for a match (case-insensitive)
                    var value = this.input.val(),
                        valueLowerCase = value.toLowerCase(),
                        valid = false;
                    this.element.children("option").each(function() {
                        if ($(this).text().toLowerCase() === valueLowerCase) {
                            this.selected = valid = true;
                            return false;
                        }

                    });
                    // Found a match, nothing to do
                    if (valid) {
                        return;
                    }
                    // Remove invalid value
                    this.input
                        .val("")
                        .attr("title", value + " no existe")
                        .tooltip("open");
                    this.element.val("");
                    this._delay(function() {
                        this.input.tooltip("close").attr("title", "");
                    }, 2500);
                    this.input.data("ui-autocomplete").term = "";
                },
                _destroy: function() {
                    this.wrapper.remove();
                    this.element.show();
                }
            });
        })(jQuery);

        //SEGUNDO COMBO
        (function($) {
            $.widget("custom.combobox2", {
                _create: function() {
                    this.wrapper = $("<span>")
                        .addClass("custom-combobox2")
                        .insertAfter(this.element);

                    this.element.hide();

                    this._createAutocomplete();
                    this._createShowAllButton();



                },
                _createAutocomplete: function() {



                    var selected = this.element.children(":selected"),
                        value = selected.val() ? selected.text() : "";


                    this.input = $("<input>")
                        .appendTo(this.wrapper)
                        .val(value)

                        //.attr( "title", "Indique su valor a Buscar" )
                        .addClass("custom-combobox2-input ui-widget ui-widget-content ui-state-default ui-corner-left")
                        .autocomplete({

                            delay: 0,
                            minLength: 0,
                            source: $.proxy(this, "_source")
                        })
                        .tooltip({
                            tooltipClass: "ui-state-highlight"
                        });
                    this._on(this.input, {
                        autocompleteselect: function(event, ui) {
                            ui.item.option.selected = true;
                            this._trigger("select", event, {
                                item: ui.item.option
                            });


                            //EJECUTANDO UNA FUNCION		
                            setTimeout('recargar_cbo_economica5_2();', 200);
                            //FIN EJECUTANDO LA FUNCION

                        },
                        autocompletechange: "_removeIfInvalid"


                    });


                },
                _createShowAllButton: function() {
                    var input = this.input,
                        wasOpen = false;
                    $("<a>")
                        .attr("tabIndex", -1)
                        .attr("title", "Seleccionar todos")
                        .tooltip()
                        .appendTo(this.wrapper)
                        .button({
                            icons: {
                                primary: "ui-icon-triangle-1-s"
                            },
                            text: false
                        })
                        .removeClass("ui-corner-all")
                        .addClass("custom-combobox2-toggle ui-corner-right")
                        .mousedown(function() {
                            wasOpen = input.autocomplete("widget").is(":visible");
                        })
                        .click(function() {
                            input.focus();

                            // Close if already visible
                            if (wasOpen) {
                                return;
                            }
                            // Pass empty string as value to search for, displaying all results
                            input.autocomplete("search", "");
                        });
                },
                _source: function(request, response) {
                    var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                    response(this.element.children("option").map(function() {

                        var text = $(this).text();
                        if (this.value && (!request.term || matcher.test(text)))
                            return {
                                label: text,
                                value: text,
                                option: this
                            };


                    }));

                },
                _removeIfInvalid: function(event, ui) {
                    // Selected an item, nothing to do
                    if (ui.item) {
                        return;
                    }
                    // Search for a match (case-insensitive)
                    var value = this.input.val(),
                        valueLowerCase = value.toLowerCase(),
                        valid = false;
                    this.element.children("option").each(function() {
                        if ($(this).text().toLowerCase() === valueLowerCase) {
                            this.selected = valid = true;
                            return false;
                        }

                    });
                    // Found a match, nothing to do
                    if (valid) {
                        return;
                    }
                    // Remove invalid value
                    this.input
                        .val("")
                        .attr("title", value + " no existe")
                        .tooltip("open");
                    this.element.val("");
                    this._delay(function() {
                        this.input.tooltip("close").attr("title", "");
                    }, 2500);
                    this.input.data("ui-autocomplete").term = "";
                },
                _destroy: function() {
                    this.wrapper.remove();
                    this.element.show();
                }
            });
        })(jQuery);

        //SEGUNDO COMBO
        $(function() {
            $("#cbo_economica5").combobox();
            $("#cbo_economica2_5").combobox2();
        });



        //IDENTIFICANDO VALOR PONIENDO SELECCIONE POR DEFECTO Y AL HACER CLICK BORRAR ESA Seleccione
        $(function() {
            //ES EN EL CASO DE QUE TENGA 2 COMBOS 
            //CUANDO HAGO EL FILTER CREO UNA MATRIZ DE ELEMNTOS
            if ($("#cbo_economica5").val() == "") {
                $('.custom-combobox-input').val('Seleccione');
                $('.custom-combobox-input').on("focus", function() {
                    if ($('.custom-combobox-input').val() == 'Seleccione') {
                        $('.custom-combobox-input').val('');
                    }
                });
            }

            if ($("#cbo_economica2_5").val() == "") {
                $('.custom-combobox2-input').val('Seleccione');
                $('.custom-combobox2-input').on("focus", function() {
                    if ($('.custom-combobox2-input').val() == 'Seleccione') {
                        $('.custom-combobox2-input').val('');
                    }
                });
            }
        });
    </script>

    <br>
    <div class="wrapper">
        <!-- Contenido Principal -->
        <div class="container-fluid">
            <!-- Oferta de Empleo -->
            <div class="card card-primary" style="border-radius: 30px">
                <div style="display: none;">
                    <input type="text" id="valor_id" value="0">
                </div>
                <div class="card-header" style="border-radius:30px 30px 0 0">
                    <h2 class="card-title" style="color: rgb(16, 96, 200); font-size: 32px"> Sintesis Curricular </h2>
                </div>
                <?
                $persona_id = $_SESSION['persona_id'];
                $query = ("SELECT * FROM snirlpcd.persona_foto_empresa WHERE persona_id = '" . $persona_id . "';");
                $row2 = pg_query($conex, $query);
                $persona2 = pg_fetch_assoc($row2);
                $simagen = $persona2["nombre_foto"];
                $consulta = ("SELECT * FROM snirlpcd.persona WHERE id = '" . $persona_id . "' and benabled='true';");
                $row = pg_query($conex, $consulta);
                $persona = pg_fetch_assoc($row);

                $ncertificado = $persona["ncertificado"];

                if ($ncertificado == "1") {
                    $certificado = "Si";
                    $cert = 1;
                } else {
                    $certificado = "No";
                    $cert = 2;
                }

                $sql2 = "SELECT
                    snirlpcd.persona_discapacidad.id,
                    snirlpcd.persona_discapacidad.tipo_discapacidad_id,
                    snirlpcd.persona_discapacidad.ngrado_discapacidad,
                    snirlpcd.persona_discapacidad.sdiscapacidad_especifica,
                    snirlpcd.persona_discapacidad.benabled,
                    snirlpcd.tipo_discapacidad.sdescripcion
                FROM
                    snirlpcd.persona_discapacidad
                INNER JOIN
                    snirlpcd.tipo_discapacidad
                ON
                    snirlpcd.persona_discapacidad.tipo_discapacidad_id = snirlpcd.tipo_discapacidad.id
                WHERE
                    snirlpcd.persona_discapacidad.persona_id = '" . $persona_id . "' and snirlpcd.tipo_discapacidad.benabled='true';";
                $row12 = pg_query($conex, $sql2);
                $persona4 = pg_fetch_assoc($row12);
                if ($persona4["ngrado_discapacidad"] == '1') {
                    $grado_discapacidad = " Leve";
                } else
                if ($persona4["ngrado_discapacidad"] == '2') {
                    $grado_discapacidad = " Moderado";
                } else
                if ($persona4["ngrado_discapacidad"] == '3') {
                    $grado_discapacidad = " Grave";
                } else
                if ($persona4["ngrado_discapacidad"] == '4') {
                    $grado_discapacidad = " Severo";
                } else
                if ($persona4["ngrado_discapacidad"] == '5') {
                    $grado_discapacidad = " Completo";
                }
                $sql = "SELECT";
                $sql .= " persona.snacionalidad as nacionalidad,";
                $sql .= " persona.ncedula as cedula,";
                $sql .= " persona.sprimer_apellido as apellido1,";
                $sql .= " persona.ssegundo_apellido as apellido2,";
                $sql .= " persona.sprimer_nombre as nombre1,";
                $sql .= " persona.ssegundo_nombre as nombre2,";
                $sql .= " persona.stelefono_personal,";
                $sql .= " persona.stelefono_habitacion,";
                $sql .= " persona.semail,";
                $sql .= " persona.ssexo,";
                $sql .= " public.estado_civil.sdescripcion,";
                $sql .= " public.entidad.scapital as ciudad_descripcion,";
                $sql .= " public.municipio.sdescripcion as municipio_descripcion,";
                $sql .= " public.parroquia.sdescripcion as parroquia_descripcion";
                $sql .= " FROM snirlpcd.persona";
                $sql .= " LEFT JOIN public.entidad ON entidad.nentidad=persona.nentidad_residencia_id";
                $sql .= " LEFT JOIN public.municipio ON municipio.nmunicipio=persona.nmunicipio_residencia_id";
                $sql .= " LEFT JOIN public.parroquia ON parroquia.nparroquia=persona.nparroquia_residencia_id";
                $sql .= " LEFT JOIN public.estado_civil ON estado_civil.id=persona.estado_civil_id";
                $sql .= " where persona.id =$persona_id";
                $row3 = pg_query($conex, $sql);
                $persona3 = pg_fetch_assoc($row3);
                $dfecha_nacimiento = $persona["dfecha_nacimiento"];
                $nacimiento = new DateTime($dfecha_nacimiento);
                $ahora = new DateTime(date("Y-m-d"));
                $year = $ahora->diff($nacimiento);
                $edad = $year->format("%y");
                $estado_civil_id = $persona["estado_civil_id"];
                $ssexo = $persona3["ssexo"];
                if ($ssexo == 1) {
                    $ssexo = "Femenino";
                    if ($estado_civil_id == -1) {
                        $estado_civil_id = "Indiferente";
                    } else
                        if ($estado_civil_id == 1) {
                        $estado_civil_id = "Casada";
                    } else
                        if ($estado_civil_id == 2) {
                        $estado_civil_id = "Divorciada";
                    } else
                        if ($estado_civil_id == 3) {
                        $estado_civil_id = "Soltera";
                    } else
                        if ($estado_civil_id == 4) {
                        $estado_civil_id = "Unión estable de hechos";
                    } else {
                        $estado_civil_id = "Viuda";
                    }
                } else {
                    $ssexo = "Masculino";
                    if ($estado_civil_id == -1) {
                        $estado_civil_id = "Indiferente";
                    } else
                        if ($estado_civil_id == 1) {
                        $estado_civil_id = "Casado";
                    } else
                        if ($estado_civil_id == 2) {
                        $estado_civil_id = "Divorciado";
                    } else
                        if ($estado_civil_id == 3) {
                        $estado_civil_id = "Soltero";
                    } else
                        if ($estado_civil_id == 4) {
                        $estado_civil_id = "Unión estable de hechos";
                    } else {
                        $estado_civil_id = "Viudo";
                    }
                }
                $edu = ("SELECT * FROM snirlpcd.persona_nivel_educativo WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
                $row97 = pg_query($conex, $edu);
                $persona97 = pg_fetch_assoc($row97);
                $id_eduacion = $persona97["id"];

                $PG = "SELECT";
                $PG .= " snirlpcd.persona_nivel_educativo.nivel_educativo_id,";
                $PG .= " snirlpcd.persona_nivel_educativo.stitulo_obtenido,";
                $PG .= " snirlpcd.persona_nivel_educativo.snombre_inst_educativa,";
                $PG .= " snirlpcd.persona_nivel_educativo.dfecha_graduacion";
                $PG .= " FROM";
                $PG .= " snirlpcd.persona";
                $PG .= " left JOIN";
                $PG .= " snirlpcd.persona_nivel_educativo";
                $PG .= " ON";
                $PG .= " persona_nivel_educativo.persona_id =persona.id";
                $PG .= " where";
                $PG .= " persona.id ='$persona_id'";
                $PG .= " and ";
                $PG .= " persona_nivel_educativo.benabled='t'";
                $PG .= " limit 4";
                $row5 = pg_query($conex, $PG);
                while ($row4 = pg_fetch_assoc($row5)) {
                    if ($row4["nivel_educativo_id"] == 1) {
                        $titulo .= '<p class="text-md-start"> Analfabeta </p>';
                        $instituto .= '<p class="text-md-start"> No posee </p>';
                        $graduacion .= '<p class="text-md-start"> No posee </p>';
                    } else
                    if ($row4["nivel_educativo_id"] == 2) {
                        $titulo .= '<p class="text-md-start"> Lee y Escribe </p>';
                        $instituto .= '<p class="text-md-start"> No posee </p>';
                        $graduacion .= '<p class="text-md-start"> No posee </p>';
                    } else {
                        if ($row4["stitulo_obtenido"] == '') {
                            $titulo .= '<p class="text-md-start"> En proceso de conseguirlo </p>';
                        } else {
                            $titulo .= '<p class="text-md-start">' . $row4["stitulo_obtenido"] . '</p>';
                        }
                        $instituto .= '<p class="text-md-start">' . $row4["snombre_inst_educativa"] . '</p>';
                        if ($row4["dfecha_graduacion"] == '') {
                            $graduacion .= '<p class="text-md-start"> Estudiando actualmente </p>';
                        } else {
                            $graduacion .= '<p class="text-md-start">' . $row4["dfecha_graduacion"] . '</p>';
                        }
                    }
                }
                $capa = ("SELECT * FROM snirlpcd.persona_capacitacion WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
                $row98 = pg_query($conex, $capa);
                $persona98 = pg_fetch_assoc($row98);
                $id_capacitacion = $persona98["id"];

                $PG2 = "SELECT";
                $PG2 .= " snirlpcd.persona_capacitacion.snombre_activ_capacitacion,";
                $PG2 .= " snirlpcd.persona_capacitacion.snombre_entidad_capacitadora,";
                $PG2 .= " snirlpcd.persona_capacitacion.sduracion_capacitacion";
                $PG2 .= " FROM";
                $PG2 .= " snirlpcd.persona";
                $PG2 .= " left JOIN";
                $PG2 .= " snirlpcd.persona_capacitacion";
                $PG2 .= " ON";
                $PG2 .= " snirlpcd.persona_capacitacion.persona_id =persona.id";
                $PG2 .= " where";
                $PG2 .= " persona.id ='$persona_id'";
                $PG2 .= " and ";
                $PG2 .= " persona_capacitacion.benabled='t'";
                $PG2 .= " limit 4";
                $row7 = pg_query($conex, $PG2);
                while ($row6 = pg_fetch_assoc($row7)) {
                    $actividad .= '<p class="text-md-start">' . $row6["snombre_activ_capacitacion"] . '</p>';
                    $institucion .= '<p class="text-md-start">' . $row6["snombre_entidad_capacitadora"] . '</p>';
                    $duracion .= '<p class="text-md-start">' . $row6["sduracion_capacitacion"] . ' Horas</p>';
                }

                $discp = ("SELECT * FROM snirlpcd.persona_exp_laboral WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
                $row99 = pg_query($conex, $discp);
                $persona99 = pg_fetch_assoc($row99);
                $id_experiencia = $persona99["id"];

                $PG3 = "SELECT";
                $PG3 .= " snirlpcd.persona_exp_laboral.snombre_entidad_trabajo,";
                $PG3 .= " snirlpcd.persona_exp_laboral.dfecha_ingreso,";
                $PG3 .= " snirlpcd.persona_exp_laboral.dfecha_egreso,";
                $PG3 .= " snirlpcd.persona_exp_laboral.scargo";
                $PG3 .= " FROM";
                $PG3 .= " snirlpcd.persona";
                $PG3 .= " left JOIN";
                $PG3 .= " snirlpcd.persona_exp_laboral";
                $PG3 .= " ON";
                $PG3 .= " snirlpcd.persona_exp_laboral.persona_id =persona.id";
                $PG3 .= " where";
                $PG3 .= " persona.id ='$persona_id'";
                $PG3 .= " and ";
                $PG3 .= " snirlpcd.persona_exp_laboral.benabled='t'";
                $PG3 .= " limit 4";
                $row9 = pg_query($conex, $PG3);
                while ($row8 = pg_fetch_assoc($row9)) {
                    $name_tra2 =  $row8['snombre_entidad_trabajo'];
                    $cargo2 = $row8['scargo'];
                    $fingreso = $row8['dfecha_ingreso'];
                    $fegreso = $row8['dfecha_egreso'];
                    $trabajo .= '<p class="text-md-start">' . $name_tra2 . '</p>';
                    $cargo .= '<p class="text-md-start">' . $cargo2 . '</p>';
                    $fecha .= '<p class="text-md-start"> Ingreso: ' . $fingreso;
                    if ($fegreso != '') {
                        $fecha .= ' / Egreso: ' . $fegreso . '</p>';
                    }
                }
                $hab = ("SELECT * FROM snirlpcd.persona_habilidad_destreza WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
                $row100 = pg_query($conex, $hab);
                $persona100 = pg_fetch_assoc($row100);
                $id_hab_des = $persona100["id"];

                $PG4 = "SELECT";
                $PG4 .= " snirlpcd.persona_habilidad_destreza.snombre_otros_conocimientos,";
                $PG4 .= " snirlpcd.persona_habilidad_destreza.sdominio_conocimiento";
                $PG4 .= " FROM";
                $PG4 .= " snirlpcd.persona";
                $PG4 .= " left JOIN";
                $PG4 .= " snirlpcd.persona_habilidad_destreza";
                $PG4 .= " ON";
                $PG4 .= " snirlpcd.persona_habilidad_destreza.persona_id =persona.id";
                $PG4 .= " where";
                $PG4 .= " persona.id ='$persona_id'";
                $PG4 .= " and ";
                $PG4 .= " snirlpcd.persona_habilidad_destreza.benabled='true'";
                $PG4 .= " limit 4";
                $row11 = pg_query($conex, $PG4);
                while ($row10 = pg_fetch_assoc($row11)) {
                    $conocimiento .= '<p class="text-md-start">' . $row10['snombre_otros_conocimientos'] . '</p>';
                    $nivel = $row10['sdominio_conocimiento'];
                    if ($nivel == 1) {
                        $nivel2 .= '<p class="text-md-start"> Bajo </p>';
                    } else
                        if ($nivel == 2) {
                        $nivel2 .= '<p class="text-md-start"> Medio </p>';
                    } else
                        if ($nivel == 3) {
                        $nivel2 .= '<p class="text-md-start"> Alto </p>';
                    } else {
                        $nivel2 .= '<p class="text-md-start"> No Especificado </p>';
                    }
                }
                ?>
                <form class="form-horizontal">
                    <div class="card-body">
                        <div class="form-group row" style="font-size: 14px;">
                            <div class="col-sm-3">
                                <img src="<? echo $simagen ?>" alt="">
                            </div>
                            <div class="col-sm-9 row align-items-center">
                                <div class="col-sm-12">
                                    <h1 class="h1" style="color: rgb(16, 96, 200)"><? echo strtoupper($persona["sprimer_nombre"]) . " " . strtoupper($persona["ssegundo_nombre"]) . " " . strtoupper($persona["sprimer_apellido"]) . " " . strtoupper($persona["ssegundo_apellido"]); ?></h1>
                                    <hr>
                                    <br>
                                </div>
                                <div class="col" style="max-width:280px;">
                                    <p class="text-md-start"><b style="color: rgb(16, 96, 200)">- Número de Cédula </b></p>
                                    <p class="text-md-start"><b style="color: rgb(16, 96, 200)">- Residencia </b></p>
                                    <p class="text-md-start"><b style="color: rgb(16, 96, 200)">- Teléfono de Contacto </b></p>
                                    <p class="text-md-start"><b style="color: rgb(16, 96, 200)">- Correo Electrónico </b></p>
                                    <p class="text-md-start"><b style="color: rgb(16, 96, 200)">- Edad </b></p>
                                    <p class="text-md-start"><b style="color: rgb(16, 96, 200)">- Sexo </b></p>
                                    <p class="text-md-start"><b style="color: rgb(16, 96, 200)">- Estado Civil </b></p>
                                    <?

                                    if ($cert == 1) {
                                    ?>
                                        <p class="text-md-start"><b style="color: rgb(16, 96, 200)">- Discapacidad </b></p>
                                        <p class="text-md-start"><b style="color: rgb(16, 96, 200)">- Discapacidad Específica </b></p>
                                        <p class="text-md-start"><b style="color: rgb(16, 96, 200)">- Grado </b></p>
                                    <?
                                    }

                                    ?>
                                    <p class="text-md-start"><b style="color: rgb(16, 96, 200)">- Certificado por CONAPDIS </b></p>
                                </div>
                                <div class="col">
                                    <p class="text-md-start"><? echo $persona["snacionalidad"] . "-" . $persona["ncedula"]; ?></p>
                                    <p class="text-md-start"><? echo $persona3["ciudad_descripcion"] . " - " . $persona3["municipio_descripcion"] . " - " . $persona3["parroquia_descripcion"]; ?></p>
                                    <p class="text-md-start"><? echo $persona3["stelefono_personal"] . " / " . $persona3["stelefono_habitacion"]; ?></p>
                                    <p class="text-md-start"><? echo $persona["semail"]; ?></p>
                                    <p class="text-md-start"><? echo $edad; ?></p>
                                    <p class="text-md-start"><? echo $ssexo; ?></p>
                                    <p class="text-md-start"><? echo $estado_civil_id; ?></p>
                                    <p class="text-md-start"><? echo $persona4['sdescripcion']; ?></p>
                                    <p class="text-md-start"><? echo $persona4['sdiscapacidad_especifica']; ?></p>
                                    <p class="text-md-start"><? echo $grado_discapacidad; ?></p>
                                    <p class="text-md-start"><? echo $certificado; ?></p>
                                </div>
                            </div>
                            <!-- ************************************************************* -->
                            <?
                            if ($id_eduacion != '') {
                            ?>
                                <div class="col-sm-12">
                                    <br>
                                    <h2 class="h2" style="color: rgb(16, 96, 200); font-size:32px">Nivel Educativo</h2>
                                    <hr>
                                </div>
                                <!-- ------------------------------------------------------------- -->
                                <div class="col-sm-4">
                                    <br>
                                    <h4 class="h4" style="color: rgb(16, 96, 200); font-size:23px">Título Obtenido</h4>
                                    <?
                                    echo $titulo;
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                    <br>
                                    <h4 class="h4" style="color: rgb(16, 96, 200); font-size:23px">Nombre de la Institución</h4>
                                    <?
                                    echo $instituto;
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                    <br>
                                    <h4 class="h4" style="color: rgb(16, 96, 200); font-size:23px">Año de Graduación</h4>
                                    <?
                                    echo $graduacion;
                                    ?>
                                </div>
                            <?
                            }
                            ?>
                            <!-- ************************************************************* -->
                            <?
                            if ($id_capacitacion != '') {
                            ?>
                                <div class="col-sm-12">
                                    <br>
                                    <h2 class="h2" style="color: rgb(16, 96, 200); font-size:32px">Actividades de Capacitación</h2>
                                    <hr>
                                </div>
                                <!-- ------------------------------------------------------------- -->
                                <div class="col-sm-4">
                                    <br>
                                    <h4 class="h4" style="color: rgb(16, 96, 200); font-size:23px">Nombre de la Actividad</h4>
                                    <? echo $actividad; ?>
                                </div>
                                <div class="col-sm-4">
                                    <br>
                                    <h4 class="h4" style="color: rgb(16, 96, 200); font-size:23px">Nombre de la Institución</h4>
                                    <? echo $institucion; ?>
                                </div>
                                <div class="col-sm-4">
                                    <br>
                                    <h4 class="h4" style="color: rgb(16, 96, 200); font-size:23px">Duración</h4>
                                    <? echo $duracion; ?>
                                </div>
                            <?
                            }
                            ?>
                            <!-- ************************************************************* -->
                            <?
                            if ($id_experiencia != '') {
                            ?>
                                <div class="col-sm-12">
                                    <br>
                                    <h2 class="h2" style="color: rgb(16, 96, 200); font-size:32px">Experiencia Laboral</h2>
                                    <hr>
                                </div>
                                <!-- ------------------------------------------------------------- -->
                                <div class="col-sm-4">
                                    <br>
                                    <h4 class="h4" style="color: rgb(16, 96, 200); font-size:23px">Nombre de la Empresa</h4>
                                    <? echo $trabajo; ?>
                                </div>
                                <div class="col-sm-4">
                                    <br>
                                    <h4 class="h4" style="color: rgb(16, 96, 200); font-size:23px">Cargo</h4>
                                    <? echo $cargo; ?>
                                </div>
                                <div class="col-sm-4">
                                    <br>
                                    <h4 class="h4" style="color: rgb(16, 96, 200); font-size:23px">Fecha</h4>
                                    <? echo $fecha; ?>
                                </div>
                            <?
                            }
                            ?>
                            <!-- ************************************************************* -->
                            <?
                            if ($id_hab_des != '') {
                            ?>
                                <div class="col-sm-12">
                                    <br>
                                    <h2 class="h2" style="color: rgb(16, 96, 200); font-size:32px">Habilidades y Destrezas</h2>
                                    <hr>
                                </div>
                                <!-- ------------------------------------------------------------- -->
                                <div class="col-sm-6">
                                    <br>
                                    <h4 class="h4" style="color: rgb(16, 96, 200); font-size:23px">Conocimiento</h4>
                                    <? echo $conocimiento; ?>
                                </div>
                                <div class="col-sm-6">
                                    <br>
                                    <h4 class="h4" style="color: rgb(16, 96, 200); font-size:23px">Nivel de Dominio</h4>
                                    <? echo $nivel2; ?>
                                </div>
                            <?
                            }
                            ?>
                        </div>
                        <br>
                    </div>
                </form>
            </div>
            <br>
            <!-- Horarios -->
            <div class="card card-primary" style="border-radius: 30px">
                <form class="form-horizontal" style="padding: 20px">
                    <!-- Formulario -->
                    <div class="form-group row">
                        <center>
                            <a href="ofertas_postulaciones.php">
                                <input class="btn btn-sm btn-secondary" readonly style="float: center; margin-top: 0; width: 15%; border-radius: 30px; font-size: 16px; font-family: Arial;" value="Regresar">
                            </a>
                            <input onclick="rechazar_postulacion()" class="btn btn-sm btn-danger" readonly style="float: center; margin-top: 0; width: 15%; border-radius: 30px; font-size: 16px; font-family: Arial;" data-bs-toggle="tooltip" value="Rechazar">
                            <input onclick="aceptar_postulacion()" class="btn btn-sm btn-primary" readonly style="float: center; margin-top: 0; width: 15%; border-radius: 30px; font-size: 16px; font-family: Arial;" data-bs-toggle="tooltip" value="Entrevistar">
                        </center>
                    </div>
                </form>
            </div>
            <br>
        </div>
    </div>
</form>

<?php
//CONDICION PARA ACTUALIZAR SIEMPRE LOS DATOS DE INTEROPERABILIDAD		

/* if ((isset($_SESSION['rif'])) and (isset($_SESSION['nusuario'])) and (isset($_SESSION['id_usuario'])) and (isset($_SESSION['empresa_id'])) and $_SESSION['estaus_empresa'] != 1 and $_SESSION['actualiza_entes'] != 1) { */

?>

<!-- <script>
    //BANAVIH
    /*
        $(document).ready(function () {
                        
                    $("#loader").show();
                    
                    $.ajax({
                    type: 'POST',
                    url: 'clientebanavih.php',
                    data: 'rif=<?php echo $_SESSION['rif']; ?>',
                    beforeSend: function() {
                // setting a timeout
                $("#loader").show();
                },
                    success: function(data) {
                        // 	$("#loader").hide();
                        }
                    });
                //FIN BANAVIH	

                    //INCES
                    $("#loader").show();
                    $.ajax({
                    type: 'POST',
                    url: 'clienteinces.php',
                    data: 'rif=<?php echo $_SESSION['rif']; ?>',
                    beforeSend: function() {
                // setting a timeout
                $("#loader").show();
                },
                    success: function(data) {
                        //$("#loader").hide();  	 
                        }
                    });		
                        //FIN INCES	
                        
                        
                    
                    
                    //IVSS
                    $("#loader").show();
                        $.ajax({
                        type: 'POST',
                        url: 'clienteivss.php',
                        data: 'rif=<?php echo $_SESSION['rif']; ?>',
                        beforeSend: function() {
                            // setting a timeout
                            $("#loader").show();
                        },
                        success: function(data) {
                        //	$("#loader").hide();  	 
                            }
                        });	
                    //FIN IVSS
                    
                    
            
                    //SENIAT
                    $("#loader").show();
                    $.ajax({
                    type: 'POST',
                    url: 'clienteseniat_local_actualizar_auto.php',
                    data: 'rif=<?php echo $_SESSION['rif']; ?>',
                    beforeSend: function() {
                // setting a timeout
            //   $("#loader").show();
                },
                    success: function(data) {
                        $("#loader").hide();  	 
                        }
                    });	
                    //FIN SENIAT
                
                    
        });
    */
</script> -->

<script src="../js/code.jquery.com_jquery-3.7.0.js"></script>
<script src="../js/cdn.tailwindcss.com_3.3.3"></script>
<script src="ofertas_empleo_discapacidad.js"></script>
<script src="../js/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
<script src="../js/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
<!-- <script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    });
</script> -->

<?php

/*    $_SESSION['actualiza_entes'] = 1;
} */
include('../footer.php');
?>