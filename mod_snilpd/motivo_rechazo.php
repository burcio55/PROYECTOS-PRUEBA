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
    <?
    $id = $_SESSION['snirlpcd4'];
    $select = "SELECT ";
    $select .= " *";
    $select .= " FROM snirlpcd.entrevista";
    $select .= " WHERE benabled='TRUE'";
    $select .= " AND postulaciones_id='$id'";
    $row = pg_query($conex, $select);
    $valor = pg_fetch_assoc($row);
    ?>
    <div class="content-full">
        <br>
        <div class="jumbotron">
            <div class="col-sm-12">
                <h2 class="font-weight-bold" style="color: rgb(16, 96, 200)">Motivo del rechazo</h2>
                <hr>
                <p><? echo $valor['smotivo_rechazo']; ?></p>
            </div>
        </div>
        <center>
            <a href="ofertas_postulaciones.php">
                <input class="btn btn-secondary" style="border-radius: 30px; background-color: darkgray; color: #fff;" data-bs-toggle="tooltip" type="button" value="Regresar">
            </a>
            <button type="button" class="btn btn-primary" style="background-color: #008cba; border-radius: 30px;" onclick="aceptar_postulacion()">Modificar entrevista</button>
            <button type="button" class="btn btn-danger" style="background-color: #f04124; border-radius: 30px;" onclick="rechazar_postulacion3(<? echo $id; ?>)">Eliminar Propuesta</button>
        </center>
    </div>
</form>
<script src="ofertas_empleo_discapacidad.js"></script>
<?php

/*    $_SESSION['actualiza_entes'] = 1;
} */
include('../footer.php');
?>