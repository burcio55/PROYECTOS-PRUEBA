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
include('../include/BD.php');
$conex = Conexion::ConexionBD();

try {
    $conex = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conex = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$id_oferta = $_SESSION["id_oferta"];

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

<form name="frm_rnet_plantilla" id="frm_rnet_plantilla" method="post" action="/mpppst/rnet/mod_rnet/rnet_modificar_planilla.php">
    <input name="action" type="hidden" value="" />
    <script type="text/javascript" src="validar_rnet_solicitud_2.js"></script>
    <script type="text/javascript" src="funciones_rnet_solicitud_2.js"></script>
    <!--<script type="text/javascript" src="funciones_identificacion_emp_rep.js"></script>-->
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
            <div>
                <!-- Beneficios -->
                <?php

                $PG4 = "SELECT * FROM";
                $PG4 .= " public.tipo_beneficio";
                $PG4 .= " WHERE";
                $PG4 .= " benabled = 'true'";
                $PG4 .= " ORDER BY";
                $PG4 .= " id ASC ";

                ?>
                <div class="card card-primary" style="border-radius: 30px">
                    <div class="card-header" style="border-radius:30px 30px 0 0">
                        <h2 class="card-title" style="color: rgb(16, 96, 200); font-size: 32px"> Beneficios </h2>
                    </div>
                    <div style="padding: 10px; text-align: right; margin-bottom: -25px">
                        <h4 style="color: #BF1F13; font-size: 15px;">Campos obligatorios (*)</h4>
                    </div>
                    <form class="form-horizontal" style="padding: 20px">
                        <!-- Formulario -->
                        <div class="form-group row" style="padding: 15px;">
                            <div style="display: none;">
                                <input type="text" id="id_beneficio">
                            </div>
                            <div class="col-sm-6">
                                <label style="color: rgb(16, 96, 200)">Tipo de Beneficio</label><span style="color: red;"> * </span>
                                <select name="tipo_beneficio" style="border-radius: 30px; width: 94%; border: 1px solid #ccc; color: gray" onchange="javascript:set()" class=" form-control-sm select2" id="tipo_beneficio">
                                    <option value="-1" selected="selected">Seleccione</option>
                                    <?php
                                    $tipo_beneficio = pg_query($conex, $PG4);
                                    while ($row3 = pg_fetch_assoc($tipo_beneficio)) {
                                        $id = $row3["id"];
                                        $sdescripcion = $row3["sdescripcion"];
                                        echo '
                                                        <option value=' . $id . '>' . $id . " - " . $sdescripcion . '</option>";
                                                    ';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label style="color: rgb(16, 96, 200)">Descripción</label><span style="color: red;"> *</span>
                                <textarea class="form-control" name="beneficio_descrip" type="text" id="beneficio_descrip" value="<?= $aDefaultForm['beneficio_descrip'] ?>" size="50" style="border-radius: 30px; margin: 0 0 30px 0" onkeyup="mayus(this);"></textarea>
                            </div>
                            <div class="col-sm-12" id="btn">
                                <center>
                                    <input onclick="agregar_beneficios(tipo_beneficio.value,beneficio_descrip.value)" class="btn btn-sm btn-primary" readonly style="float: center; margin-top: 5px; width: 20%; border-radius: 30px; font-size: 16px; font-family: Arial;" value="Agregar">
                                </center>
                            </div>
                            <div class="col-sm-12" id="btn2" style="display: none;">
                                <center>
                                    <input onclick="modificar_beneficios(tipo_beneficio.value,beneficio_descrip.value,id_beneficio.value)" class="btn btn-sm btn-primary" readonly style="float: center; margin-top: 5px; width: 20%; border-radius: 30px; font-size: 16px; font-family: Arial;" value="Actualizar">
                                </center>
                            </div>
                            <!--
                                <div class="col-sm-12">
                                    <center>
                                        <input type="button" onclick="agregar_beneficios(tipo_beneficio.value,beneficio_descrip.value)" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' value="Agregar">
                                    </center>
                                </div>
                            -->
                            <table id="example" class="table table-secondary table-striped display" style="margin: 30px 0 0 0">
                                <thead>
                                    <tr class="text-secondary">
                                        <th class="text-center" style="font-size: 14px; font-weight: normal; color: rgb(16, 96, 200)">#</th>
                                        <th class="text-center" style="font-size: 14px; font-weight: normal; color: rgb(16, 96, 200)">Tipo de Beneficio</th>
                                        <th class="text-center" style="font-size: 14px; font-weight: normal; width: 55%; color: rgb(16, 96, 200)">Descripción</th>
                                        <th class="text-center" style="font-size: 14px; font-weight: normal; width: 200px; color: rgb(16, 96, 200)">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla">
                                </tbody>
                            </table>
                            <center>
                                <a href="oferta_empleo2.php">
                                    <input class="btn btn-sm btn-secondary" readonly style="float: center; margin-top: 5px; width: 20%; border-radius: 30px; font-size: 16px; font-family: Arial;" data-bs-toggle="tooltip" value="Regresar">
                                </a>
                                <input onclick="finalizar()" class="btn btn-sm btn-primary" readonly style="float: center; margin-top: 5px; width: 20%; border-radius: 30px; font-size: 16px; font-family: Arial;" data-bs-toggle="tooltip" value="Finalizar">
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
//CONDICION PARA ACTUALIZAR SIEMPRE LOS DATOS DE INTEROPERABILIDAD		

/* if ((isset($_SESSION['rif'])) and (isset($_SESSION['nusuario'])) and (isset($_SESSION['id_usuario'])) and (isset($_SESSION['empresa_id'])) and $_SESSION['estaus_empresa'] != 1 and $_SESSION['actualiza_entes'] != 1) { */

?>
<!-- Script Code -->
<!-- <script src="tabla_requerimientos.js"></script> -->
<script src="tabla_beneficios.js"></script>
<script>
    const selector = document.getElementById("selector");
    const cuadroInformacion = document.getElementById("sucursales");

    selector.addEventListener("change", function() {
        if (selector.value === "-1" || selector.value === "1") {
            cuadroInformacion.style.display = "none";
        } else {
            cuadroInformacion.style.display = "block";
        }
    });

    const selector2 = document.getElementById("selector2");
    const cuadroInformacion2 = document.getElementById("direccion");

    selector2.addEventListener("change", function() {
        if (selector2.value === "-1") {
            cuadroInformacion2.style.display = "none";
        } else {
            cuadroInformacion2.style.display = "block";
        }
    });
</script>
<script src="../js/code.jquery.com_jquery-3.7.0.js"></script>
<script src="../js/cdn.tailwindcss.com_3.3.3"></script>
<script src="../js/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
<script src="../js/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
<?
/* $_SESSION['actualiza_entes'] = 1;
} */
include('../footer.php');
?>