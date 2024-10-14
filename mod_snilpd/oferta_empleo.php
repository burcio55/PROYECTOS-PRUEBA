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

$sql1 = "SELECT * FROM rnee.rnee_empresa where srif='" . $_SESSION['rif'] . "'";
$aux1 = pg_query($conex, $sql1);
$dato1 = pg_fetch_assoc($aux1);

$query = "SELECT";
$query .= " *";
$query .= " FROM rnee.rnee_condicion_actividad_movimiento";
$query .= " WHERE";
$query .= " rnee_empresa_id ='" . $dato1['id'] . "'";
$query .= " AND";
$query .= " nenabled ='1'";
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
    <!-- <script type="text/javascript" src="validar_rnet_solicitud_2.js"></script>
    <script type="text/javascript" src="funciones_rnet_solicitud_2.js"></script> -->
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
            <div class="card card-primary" style="border-radius: 30px" id="parte1">
                <div style="display: none;">
                    <input type="text" id="valor_id" value="<? echo $_SESSION['snirlpcd3']; ?>">
                </div>
                <div class="card-header" style="border-radius:30px 30px 0 0">
                    <h2 class="card-title" style="color: rgb(16, 96, 200); font-size: 32px;"> Oferta de Empleo </h2>
                </div>
                <div style="padding: 10px; text-align: right; margin-bottom: -25px">
                    <h4 style="color: #BF1F13; font-size: 15px;">Campos obligatorios (*)</h4>
                </div>
                <form class="form-horizontal">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <label style="color: rgb(16, 96, 200); font-size: 14px;">Origen</label><span style="color: red;"> *</span>
                                <select name="" id="selector" style="border-radius: 30px; border: 1px solid #ccc; color: gray; width: 100%" onchange="javascript:set()" class=" form-control-sm select2">
                                    <option value="-1" selected>Seleccione</option>
                                    <option value="1">Principal</option>
                                    <option value="2">Sucursal</option>
                                </select>
                            </div>
                            <div class="col-sm-3"></div>
                            <br><br><br>
                            <!-- Proceso de Ejecución del Inner Join para las Sucursales -->
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6" id="sucursales" style="display: none">
                                <label style="color: rgb(16, 96, 200); font-size: 14px;">Sucursales</label><span style="color: red;"> *</span>
                                <select name="" id="selector2" style="border-radius: 30px; border: 1px solid #ccc; color: gray; width: 100%" onchange="buscar(selector2.value)" class=" form-control-sm select2">
                                    <option value="-1" selected="selected">Seleccione</option>
                                    <?php
                                    $empresa = pg_query($conex, $query);
                                    /*
                                    $empresa = pg_fetch_assoc($row);
                                
                                    echo $id = $empresa["id"] . " ";
                                    echo $sdenominacion_comercial = $empresa["sdenominacion_comercial"] . " ";
                                    echo $sdireccion = $empresa["sdireccion"] . " ";
                                    echo $estado = $empresa["estado"] . " ";
                                    echo $municipio = $empresa["municipio"] . " ";
                                    echo $parroquia = $empresa["parroquia"] . " ";
                                    echo $rnee_sucursal_id = $empresa["rnee_sucursal_id"] . " ";
                                
                                    die();
                                
                                    $result = pg_query($conex, $query);
                                */
                                    while ($row = pg_fetch_assoc($empresa)) {
                                        $sucursal = $row["rnee_sucursal_id"];
                                        $query2 = " SELECT * FROM";
                                        $query2 .= " rnee.rnee_sucursales";
                                        $query2 .= " WHERE";
                                        $query2 .= " id ='" . $sucursal . "'";
                                        $query2 .= " AND";
                                        $query2 .= " nenabled ='1'";
                                        $sucursal2 = pg_query($conex, $query2);
                                        $row2 = pg_fetch_assoc($sucursal2);
                                        if ($row2 != '') {
                                            $id = $row2["id"];
                                            $sdenominacion_comercial = $row2["sdenominacion_comercial"];
                                            echo '
                                                <option value=' . $id . '>' . $sdenominacion_comercial . '</option>";
                                            ';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <br>
                    </div>
                </form>
            </div>
            <div id="direccion" style="display: none;">
                <br>
                <!-- Dirección -->
                <div class="card card-primary" style="border-radius: 30px;">
                    <div class="card-header" style="border-radius:30px 30px 0 0">
                        <h2 class="card-title" style="color: rgb(16, 96, 200); font-size: 32px;"> Datos de la Sucursal </h2>
                    </div>
                    <form class="form-horizontal">
                        <div class="card-body">
                            <div style="display: none;">
                                <input type="text" id="idSucursal">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label style="color: rgb(16, 96, 200)"><b>Nombre Comercial: </b></label>
                                    <p id="nombre_comercial"></p>
                                </div>
                                <div class="col-sm-6">
                                    <label style="color: rgb(16, 96, 200)"><b>Estado: </b></label>
                                    <p id="estado"></p>
                                </div>
                                <br><br><br>
                                <div class="col-sm-6">
                                    <label style="color: rgb(16, 96, 200)"><b>Municipio: </b></label>
                                    <p id="municipio"></p>
                                </div>
                                <div class="col-sm-6">
                                    <label style="color: rgb(16, 96, 200)"><b>Parroquia: </b></label>
                                    <p id="parroquia"></p>
                                </div>
                                <br><br><br>
                                <div class="col-sm-12">
                                    <label style="color: rgb(16, 96, 200)"><b>Dirección Fiscal: </b></label>
                                    <p id="sdirecion"></p>
                                </div>
                                <!--
                                    <div class="col-sm-6">
                                        <label class="text-secondary">Fecha de Publicación (Actual)</label>
                                        <p class="text-secondary">
                                            <?php
                                            /* echo $fecha = date("d-m-Y"); */
                                            ?>
                                        </p>
                                    </div>
                                -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <?php
            $PG = "SELECT * FROM";
            $PG .= " public.tipo_contrato_lab";
            $PG .= " WHERE";
            $PG .= " benabled = 'true'";
            $PG .= " ORDER BY";
            $PG .= " id ASC ";
            ?>
            <!-- Opciones Básicas -->
            <div class="card card-primary" style="border-radius: 30px">
                <div class="card-header" style="border-radius:30px 30px 0 0">
                    <h2 class="card-title" style="color: rgb(16, 96, 200); font-size: 32px"> Datos Básicos de la Oferta de Empleo </h2>
                </div>
                <form class="form-horizontal" style="padding: 20px">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label style="color: rgb(16, 96, 200)">Nombre del Cargo Vacante</label><span style="color: red;"> *</span>
                            <input type="text" placeholder="Ej. Guardián de Seguridad" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray; font-size: 14px; text-transform:uppercase;" class=" form-control form-control-sm" id="cargo" value="" maxlength="100">
                        </div>
                        <div class="col-sm-6">
                            <label style="color: rgb(16, 96, 200)">Cantidad de Vacantes</label><span style="color: red;"> *</span>
                            <input type="text" placeholder="Ej. 2" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray; font-size: 14px" class=" form-control form-control-sm" id="vacantes" value="" size="50" maxlength="100">
                        </div>
                        <br><br><br>
                        <div class="col-sm-6" style="width: 48.5%">
                            <label style="color: rgb(16, 96, 200)">Tipo de Contrato</label><span style="color: red;"> *</span>
                            <select name="tipo_contrato" style="border-radius: 30px; width: 94%; border: 1px solid #ccc; color: gray" onchange="javascript:set()" class=" form-control-sm select2" id="tipo_contrato">
                                <option value="-1" selected="selected">Seleccione</option>
                                <?php
                                $tipo_contrato = pg_query($conex, $PG);
                                while ($row = pg_fetch_assoc($tipo_contrato)) {
                                    $id = $row["id"];
                                    $sdescripcion = $row["sdescripcion"];
                                    echo '
                                                        <option value=' . $id . '>' . $id . " - " . $sdescripcion . '</option>";
                                                    ';
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                        $PG2 = "SELECT * FROM";
                        $PG2 .= " public.frecuencia_pago";
                        $PG2 .= " WHERE";
                        $PG2 .= " benabled = 'true'";
                        $PG2 .= " ORDER BY";
                        $PG2 .= " id ASC ";
                        ?>
                        <div class="col-sm-6" style="width: 48.5%">
                            <label style="color: rgb(16, 96, 200)">Frecuencia de Pago</label><span style="color: red;"> *</span>
                            <select name="frecuencia_pago" style="border-radius: 30px; width: 94%; border: 1px solid #ccc; color: gray" onchange="javascript:set()" class=" form-control-sm select2" id="frecuencia_pago">
                                <option value="-1" selected="selected">Seleccione</option>
                                <?php
                                $frecuencia_pago = pg_query($conex, $PG2);
                                while ($row = pg_fetch_assoc($frecuencia_pago)) {
                                    $id = $row["id"];
                                    $sdescripcion = $row["sdescripcion"];
                                    echo '
                                                        <option value=' . $id . '>' . $id . " - " . $sdescripcion . '</option>";
                                                    ';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <br>
            <!-- Horarios -->
            <div class="card card-primary" style="border-radius: 30px">
                <div class="card-header" style="border-radius:30px 30px 0 0">
                    <h2 class="card-title" style="color: rgb(16, 96, 200); font-size: 32px"> Horarios </h2>
                </div>
                <form class="form-horizontal" style="padding: 20px">
                    <!-- Formulario -->
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label style="color: rgb(16, 96, 200)">Hora de entrada</label><span style="color: red;"> *</span>
                            <select name="" style="width: 100%; height: 31px; border: 1px solid #ccc; color: gray; font-size: 14px; border-radius: 30px 0 0 30px" class=" form-control-sm select2" id="Hora_Entrada">
                                <option value="-1" selected="selected">Seleccione...</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                                <option value="4">04</option>
                                <option value="5">05</option>
                                <option value="6">06</option>
                                <option value="7">07</option>
                                <option value="8">08</option>
                                <option value="9">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select name="" style="width: 100%; height: 31px; border: 1px solid #ccc; color: gray; font-size: 14px; margin: 24px 0 0 -12.5px" class=" form-control-sm select2" id="Hora_Entrada2">
                                <option value="-1" selected="selected">Seleccione...</option>
                                <option value="0">00</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select name="" style="border-radius: 0 30px 30px 0; width: 95%; border: 1px solid #ccc; color: gray; margin: 24px 0 0 -25px" onchange="javascript:set()" class=" form-control-sm select2" id="AmPm1">
                                <option value="-1" selected="selected">Seleccione...</option>
                                <option value="1">AM</option>
                                <option value="2">PM</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label style="color: rgb(16, 96, 200)">Hora de salida</label><span style="color: red;"> *</span>
                            <select name="" style="width: 100%; height: 31px; border: 1px solid #ccc; color: gray; font-size: 14px; border-radius: 30px 0 0 30px" class=" form-control-sm select2" id="Hora_Salida">
                                <option value="-1" selected="selected">Seleccione...</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                                <option value="4">04</option>
                                <option value="5">05</option>
                                <option value="6">06</option>
                                <option value="7">07</option>
                                <option value="8">08</option>
                                <option value="9">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select name="" style="width: 100%; height: 31px; border: 1px solid #ccc; color: gray; font-size: 14px; margin: 24px 0 0 -12.5px" class=" form-control-sm select2" id="Hora_Salida2">
                                <option value="-1" selected="selected">Seleccione...</option>
                                <option value="0">00</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select name="" style="border-radius: 0 30px 30px 0; width: 95%; border: 1px solid #ccc; color: gray; margin: 24px 0 0 -25px" onchange="javascript:set()" class=" form-control-sm select2" id="AmPm2">
                                <option value="-1" selected="selected">Seleccione...</option>
                                <option value="1">AM</option>
                                <option value="2">PM</option>
                            </select>
                        </div>
                        <script>
                            /* // Validamos que solo contenga números
                            function validateKey(event) {
                                // Obtenemos el valor actual del campo
                                var value = event.target.value;

                                // Validamos que solo contenga números
                                var keyCode = event.keyCode;
                                if (keyCode < 48 || keyCode > 58) {
                                    event.preventDefault();
                                }
                            }

                            // Vinculamos la función de validación al evento onkeypress
                            document.querySelector("#Hora_Entrada").addEventListener("keypress", validateKey);
                            document.querySelector("#Hora_Salida").addEventListener("keypress", validateKey); */
                        </script>
                        <br><br><br>
                        <div class="col-sm-12">
                            <label style="color: rgb(16, 96, 200)">Días Laborales</label><span style="color: red;"> * </span>
                            <input type="text" placeholder="Ej. Lunes, Martes, Miércoles, Jueves y Viernes" class="form-control" style="border-radius: 30px; width: 97%; height: 31px; border: 1px solid #ccc; color: gray; font-size: 14px; text-transform:uppercase;" id="laborales" value="" size="50" maxlength="100">
                        </div>
                        <? if ($_SESSION['snirlpcd3'] == '') { ?>
                            <center>
                                <a href="ofertas_empleo.php">
                                    <input class="btn btn-sm btn-secondary" readonly style="float: center; margin-top: 5px; width: 20%; border-radius: 30px; font-size: 16px; font-family: Arial;" value="Regresar">
                                </a>
                                <input onclick="agregar_oferta_empleo(selector.value,selector2.value,nombre_comercial.value,estado.value,municipio.value,parroquia.value,sdirecion.value,cargo.value,vacantes.value,tipo_contrato.value,frecuencia_pago.value,Hora_Entrada.value,Hora_Entrada2.value,AmPm1.value,Hora_Salida2.value,Hora_Salida.value,AmPm2.value,laborales.value)" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" readonly style="float: center; margin-top: 5px; width: 20%; border-radius: 30px; font-size: 16px; font-family: Arial;" value="Guardar Registro">
                            </center>
                        <? } else { ?>
                            <center>
                                <a href="ofertas_empleo.php">
                                    <input class="btn btn-sm btn-secondary" readonly style="float: center; margin-top: 5px; width: 20%; border-radius: 30px; font-size: 16px; font-family: Arial;" value="Regresar">
                                </a>
                                <input onclick="modificar_oferta(selector.value,selector2.value,nombre_comercial.value,estado.value,municipio.value,parroquia.value,sdirecion.value,cargo.value,vacantes.value,tipo_contrato.value,frecuencia_pago.value,Hora_Entrada.value,Hora_Entrada2.value,AmPm1.value,Hora_Salida.value,Hora_Salida2.value,AmPm2.value,valor_id.value,laborales.value)" class="btn btn-sm btn-primary" readonly style="float: center; margin-top: 5px; width: 20%; border-radius: 30px; font-size: 16px; font-family: Arial;" data-bs-toggle="tooltip" value="Actualizar Registro">
                            </center>
                        <? } ?>
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

<!-- Script Code -->
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
<script>
    $('#vacantes').on('keydown keypress', function(e) {
        if (e.key.length === 1) { // Evaluar si es un solo caracter
            if ($(this).val().length < 12 && !isNaN(parseFloat(e.key))) {
                /* Comprobar que
                 * son menos de 12
                 * catacteres y que
                 * es un número */
                $(this).val($(this).val() + e.key); // Muestra el valor en el input
                /*
                 * Aquí haces lo que quieras.
                 */
            }
            return false;
        }
    });
</script>
<!-- DataTable -->
<script>
    new DataTable("#example");
    /* $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    }); */
    /* var table = $("#example").DataTable({
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es-ES.json",
        },
    }); */
</script>
<script src="mostrar_select_opor_empl.js"></script>
<script src="ofertas_empleo_discapacidad.js"></script>
<script src="../js/code.jquery.com_jquery-3.7.0.js"></script>
<script src="../js/cdn.tailwindcss.com_3.3.3"></script>
<script src="../js/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
<script src="../js/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>

<?php

/*    $_SESSION['actualiza_entes'] = 1;
} */
include('../footer.php');
?>