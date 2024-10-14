<!--1.1-->
<?php
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

<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

<script>
    $(document).ready(function() {
        elegido = "10000";
        combo = "Municipio";
        $.post("../combo_hijo.php", {
                elegido: elegido,
                combo: combo,
                seleccionado: "10100"
            },
            function(data) {
                $("#cbo_municipio").html(data);
            });

        elegido = "10100";
        combo = "Parroquia";
        $.post("../combo_hijo.php", {
                elegido: elegido,
                combo: combo,
                seleccionado: "10103"
            },
            function(data) {
                $("#cbo_parroquia").html(data);
            });
    });
</script>

<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script>
    $(document).ready(function() {
        tipo = "1";
        $("#cbo_entidad_mercantil option:selected").each(function() {
            elegido = "10000";
            combo = 'Mercantil';
            $.post("../combo_hijo.php", {
                elegido: elegido,
                combo: combo,
                tipo: tipo,
                seleccionado: "2"
            }, function(data) {
                //alert(data);
                $("#cbo_registromercatil2").html(data);
            });
        })
    });
</script>

<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script>
    $(document).ready(function() {
        elegido = "13910";
        combo = "Actividad";
        $.post("../combo_hijo.php", {
            elegido: elegido,
            combo: combo,
            seleccionado: "1391"
        }, function(data) {
            $("#cbo_economica4").html(data);
        });
    });
    $(document).ready(function() {
        elegido = "1391";
        combo = "Actividad";
        $.post("../combo_hijo.php", {
            elegido: elegido,
            combo: combo,
            seleccionado: "139"
        }, function(data) {
            $("#cbo_economica3").html(data);
        });
    });
    $(document).ready(function() {
        elegido = "139";
        combo = "Actividad";
        $.post("../combo_hijo.php", {
            elegido: elegido,
            combo: combo,
            seleccionado: "13"
        }, function(data) {
            $("#cbo_economica2").html(data);
        });
    });
    $(document).ready(function() {
        elegido = "13";
        combo = "Actividad";
        $.post("../combo_hijo.php", {
            elegido: elegido,
            combo: combo,
            seleccionado: "C"
        }, function(data) {
            $("#cbo_economica1").html(data);
        });
    });
</script>

<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script>
    $(document).ready(function() {
        elegido = "";
        combo = "Actividad";
        $.post("../combo_hijo.php", {
            elegido: elegido,
            combo: combo,
            seleccionado: ""
        }, function(data) {
            $("#cbo_economica2_4").html(data);
        });
    });
    $(document).ready(function() {
        elegido = "";
        combo = "Actividad";
        $.post("../combo_hijo.php", {
            elegido: elegido,
            combo: combo,
            seleccionado: ""
        }, function(data) {
            $("#cbo_economica2_3").html(data);
        });
    });
    $(document).ready(function() {
        elegido = "";
        combo = "Actividad";
        $.post("../combo_hijo.php", {
            elegido: elegido,
            combo: combo,
            seleccionado: ""
        }, function(data) {
            $("#cbo_economica2_2").html(data);
        });
    });
    $(document).ready(function() {
        elegido = "";
        combo = "Actividad";
        $.post("../combo_hijo.php", {
            elegido: elegido,
            combo: combo,
            seleccionado: ""
        }, function(data) {
            $("#cbo_economica2_1").html(data);
        });
    });
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Registro Nacional de Entidades de trabajo </title>
    <link href='../css/plantilla.css' type=text/css rel=stylesheet>
    <!-- <link href="../css/formularios.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="../css/cdn.datatables.net_1.13.6_css_jquery.dataTables.min.css" />
    <link rel="stylesheet" href="../css/bootstrap5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">



    <script type="text/javascript" src="../js/validacion_general.js"></script>


    <!--CALENDARIO-->
    <script src="../js/src/js/jscal2.js"></script>
    <script src="../js/src/js/lang/es.js"></script>
    <link rel="stylesheet" type="text/css" href="../js/src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../js/src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="../js/src/css/win2k/win2k.css" />
    <link type="text/css" rel="stylesheet" href="../js/src/css/reduce-spacing.css" />

    <!--FIN CALENDARIO-->



    <!--<script type="text/javascript" src="../js/jquery.js"></script>-->





    <!--LIBRERIA JQUERY Y UI JQUERY (BUSCADOR COMBO)-->
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery-ui.js"></script>
    <link href="../css/jquery-ui.css" rel="stylesheet" type="text/css" />

    <!--MENU-->
    <link rel="stylesheet" type="text/css" href="../css/ddsmoothmenu.css" />

    <!--
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery-ui.js"></script>
    -->
    <script type="text/javascript" src="../js/ddsmoothmenu.js"></script>

    <script type="text/javascript">
        ddsmoothmenu.init({
            mainmenuid: "smoothmenu1",
            orientation: 'h',
            classname: 'ddsmoothmenu',
            contentsource: "markup"
        })
    </script>
    <!--FIN MENU-->


    <!--LIBRERIA PARA FORMATO DE NUMEROS 100.00,00-->
    <script type="text/javascript" src="../js/jquery-number-master/jquery.number.js"></script>

    <!--LIBRERIA TOOLTIP-->
    <!--TOOL TIP-->
    <!--LIBRERIA TOOLTIP-->
    <script src="../js/jquery.tooltip.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            // modify global settings
            $.extend($.fn.Tooltip.defaults, {
                track: true,
                delay: 0,
                showURL: false,
                showBody: " - "
            });
            $('a, input, img , button,textarea,select').Tooltip();
        });
    </script>
    <!--FIN TOOL TIP-->
    <script src="../js/jquery.dataTables.js" type="text/javascript"></script>
    <link type="text/css" rel="stylesheet" href="../js/demo_table.css" />
</head>

<body>
    <div id="content">
        <div id="separador_superior"></div>
        <div id="cabecera_superior"></div>
        <div id="cabecera_inferior">
            <table width="100%" class="formulario" border="0" style="padding-top:0px;" align="right">
                <tr>
                    <td width="65%" align="left" style="font-weight:bold;">
                        <span style="color:#1060C8;">USUARIO ACTIVO:</span>&nbsp;Jose Fernandez
                    </td>

                    <td width="35%" align="right" style="font-weight:bold;">ESTATUS ACTUAL:&nbsp; <span style="color:#1060C8;">
                            Culminada </span>&nbsp;&nbsp;
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-weight:bold;">
                        <span style="font-weight:bold; color:#1060C8;">ENTIDAD DE TRABAJO:</span>&nbsp;J312045841 IMPORTADORA TEXTICENTRO, C.A.
                    </td>
                    <td width="35%" align="right" style="font-weight:bold;"><!--CONDICION ACTUAL:&nbsp;--><span style="color:#1060C8;">
                        </span>&nbsp;&nbsp;
                    </td>
                </tr>

                <tr>
                    <th align="center" style="font-weight:bold">
                        <br>
                        <span align="center" style="font-weight:bold; color:#1060C8;">REGISTRO NACIONAL DE ENTIDADES DE TRABAJO (RNET)</span>
                        <br>
                    </th>
                </tr>

            </table>

        </div>
        <div id="contenido_menu">
            <div id="smoothmenu1" class="ddsmoothmenu">
                <ul>
                    <li><a href="../mod_rnet/inicio.php"><span style="font-weight:bold; color:#fff;">INICIO</span></a></li>

                    <!--PARA LAS BLOQUEADAS-->
                    <!--FIN PARA LAS BLOQUEADAS-->
                    <!--PARA LAS BLOQUEADAS-->
                    <!--FIN PARA LAS BLOQUEADAS-->
                    <li><a href="#"><span style="font-weight:bold; color:#fff;"><span style="font-weight:bold; color:#fff;">REGISTRO</span></a>
                        <ul>
                            <li><a href="../mod_rnet/rnet_modificar_planilla.php"><span style="font-weight:bold; color:#fff;"><span style="font-weight:bold; color:#fffd;">Actualizar Registro Entidad de Trabajo</span></a></li>

                            <li><a href="../mod_rnet/rnet_solicitud_3.php"><span style="font-weight:bold; color:#fff;">Registro de Sucursales/Plantas o Dependencias</span></a></li>
                            <li><a href="../mod_rnet/planilla_empresa.php"><span style="font-weight:bold; color:#fff;">Ver planilla</span></a></li>
                            <li><a href="../mod_trimestral/nil.php"><span style="font-weight:bold; color:#fff;"><span style="font-weight:bold; color:#fff;">Ver NIL</span></a></li>
                        </ul>
                    </li>
                    <li><a href="#"><span style="font-weight:bold; color:#fff;"><span style="font-weight:bold; color:#fff;">DECLARACION</span></a>
                        <ul>
                            <li><a href="../mod_trimestral/trim_nueva.php"><span style="font-weight:bold; color:#fff;">Declaraciones</span></a></li>
                        </ul>
                    </li>
                    <li><a href="#"><span style="font-weight:bold; color:#fff;"><span style="font-weight:bold; color:#fff;">SOLVENCIA LABORAL</span></a>
                        <ul>
                            <li><a href="../mod_solvencia_laboral/datos_solicitud.php"><span style="font-weight:bold; color:#fff;">Verificar Solvencia</span></a></li>
                        </ul>
                    </li>
                    <li><a href="../mod_snilpd/ofertas_empleo.php"><span style="font-weight:bold; color:#fff;">OFERTA DE EMPLEO</span></a></li>
                    <li><a href="#"><span style="font-weight:bold; color:#fff;"><span style="font-weight:bold; color:#fff;">CONFIGURACION</span></a>
                        <ul>
                            <li><a href="../mod_login/cambiar_clave.php"><span style="font-weight:bold; color:#fff;">Cambiar Clave</span></a></li>
                        </ul>
                    </li>
                    <li><a href="../mod_login/cerrar_sesion.php"><span style="font-weight:bold; color:#fff;">CERRAR SESION</span></a></li>
                </ul>
                <br style="clear: left" />
            </div>
        </div>
        <div id="contenido">
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
                        <div class="card card-primary" style="border-radius: 30px" id="parte1">
                            <div style="display: none;">
                                <input type="text" id="valor_id" value="0">
                            </div>
                            <div class="card-header" style="border-radius:30px 30px 0 0">
                                <h2 class="card-title"> Oferta de Empleo </h2>
                            </div>
                            <div style="padding: 10px; text-align: right; margin-bottom: -25px">
                                <h4 style="color: #BF1F13; font-size: 15px;">Campos obligatorios (*)</h4>
                            </div>
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <label class="text-secondary">Origen</label><span style="color: red;"> *</span>
                                            <select name="" id="selector" style="border-radius: 30px; border: 1px solid #ccc; color: gray; width: 100%" onchange="javascript:set()" class=" form-control-sm select2">
                                                <option value="-1" selected="selected">Seleccione</option>
                                                <option value="1">Principal</option>
                                                <option value="2">Sucursal</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3"></div>
                                        <br><br><br>
                                        <!-- Proceso de Ejecución del Inner Join para las Sucursales -->
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6" id="sucursales" style="display: none">
                                            <label class="text-secondary">Sucursales</label><span style="color: red;"> *</span>
                                            <select name="" id="selector2" style="border-radius: 30px; border: 1px solid #ccc; color: gray; width: 100%" onchange="buscar(selector2.value)" class=" form-control-sm select2">
                                                <option value="-1" selected="selected">Seleccione</option>
                                                <?php
                                                $empresa = pg_query($conn, $query);
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
                                                
                                                    $result = pg_query($conn, $query);
                                                */
                                                while ($row = pg_fetch_assoc($empresa)) {
                                                    $id = $row["rnee_sucursal_id"];
                                                    $sdenominacion_comercial = $row["sdenominacion_comercial"];
                                                    echo '
                                                        <option value=' . $id . '>' . $id . " - " . $sdenominacion_comercial . '</option>";
                                                    ';
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
                                    <h2 class="card-title"> Datos de la Sucursal </h2>
                                </div>
                                <form class="form-horizontal">
                                    <div class="card-body">
                                        <!-- Dirección de la Entidad de Trabajo -->

                                        <p>
                                            ID de la Sucursal:
                                            <span id="idSucursal"></span>
                                        </p>
                                        <br>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="text-secondary">Nombre Comercial</label>
                                                <input type="text" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="nombre_comercial" size="50" maxlength="100" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="text-secondary">Estado</label>
                                                <input type="text" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="estado" size="50" maxlength="100" readonly>
                                            </div>
                                            <br><br><br>
                                            <div class="col-sm-6">
                                                <label class="text-secondary">Municipio</label>
                                                <input type="text" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="municipio" size="50" maxlength="100" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="text-secondary">Parroquia</label>
                                                <input type="text" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="parroquia" size="50" maxlength="100" readonly>
                                            </div>
                                            <br><br><br>
                                            <div class="col-sm-6">
                                                <label class="text-secondary">Dirección Fiscal</label>
                                                <input type="text" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="sdirecion" size="50" maxlength="100" readonly>
                                            </div>
                                            <!-- <div class="col-sm-6">
                                            <label class="text-secondary">Fecha de Publicación (Actual)</label>
                                            <p class="text-secondary">
                                                <?php
                                                echo $fecha = date("d-m-Y");
                                                ?>
                                            </p>
                                        </div> -->
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
                                <h2 class="card-title"> Datos Básicos de la Oferta de Empleo </h2>
                            </div>
                            <form class="form-horizontal" style="padding: 20px">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="text-secondary">Nombre del Cargo Vacante</label><span style="color: red;"> *</span>
                                        <input type="text" placeholder="Ej. Guardián de Seguridad" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="cargo" value="" size="50" maxlength="100">
                                    </div>
                                    <br><br><br>
                                    <div class="col-sm-6" style="width: 48.5%">
                                        <label class="text-secondary">Tipo de Contrato</label><span style="color: red;"> *</span>
                                        <select name="tipo_contrato" style="border-radius: 30px; width: 94%; border: 1px solid #ccc; color: gray" onchange="javascript:set()" class=" form-control-sm select2" id="tipo_contrato">
                                            <option value="-1" selected="selected">Seleccione</option>
                                            <?php
                                            $tipo_contrato = pg_query($conn, $PG);
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
                                        <label class="text-secondary">Frecuencia de Pago</label><span style="color: red;"> *</span>
                                        <select name="frecuencia_pago" style="border-radius: 30px; width: 94%; border: 1px solid #ccc; color: gray" onchange="javascript:set()" class=" form-control-sm select2" id="frecuencia_pago">
                                            <option value="-1" selected="selected">Seleccione</option>
                                            <?php
                                            $frecuencia_pago = pg_query($conn, $PG2);
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
                                <h2 class="card-title"> Horarios </h2>
                            </div>
                            <form class="form-horizontal" style="padding: 20px">
                                <!-- Formulario -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label class="text-secondary">Hora de entrada</label><span style="color: red;"> *</span>
                                        <input type="text" maxlength="5" placeholder="Ej. 8:30" class="form-control" style="border-radius: 30px 0 0 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="Hora_Entrada" value="" size="50" maxlength="100">
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="" style="border-radius: 0 30px 30px 0; width: 95%; border: 1px solid #ccc; color: gray; margin: 24px 0 0 -25px" onchange="javascript:set()" class=" form-control-sm select2" id="AmPm1">
                                            <option value="-1" selected="selected">am. / pm.</option>
                                            <option value="1">AM</option>
                                            <option value="2">PM</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="text-secondary">Hora de salida</label><span style="color: red;"> *</span>
                                        <input type="text" maxlength="5" placeholder="Ej. 8:30" class="form-control" style="border-radius: 30px 0 0 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="Hora_Salida" value="" size="50" maxlength="100">
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="" style="border-radius: 0 30px 30px 0; width: 95%; border: 1px solid #ccc; color: gray; margin: 24px 0 0 -25px" onchange="javascript:set()" class=" form-control-sm select2" id="AmPm2">
                                            <option value="-1" selected="selected">am. / pm.</option>
                                            <option value="1">AM</option>
                                            <option value="2">PM</option>
                                        </select>
                                    </div>
                                    <script>
                                        // Validamos que solo contenga números
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
                                        document.querySelector("#Hora_Salida").addEventListener("keypress", validateKey);
                                    </script>
                                    <br><br><br>
                                    <div class="col-sm-12">
                                        <label class="text-secondary">Días Laborales</label><span style="color: red;"> * </span>
                                        <input type="text" placeholder="Ej. Lunes, Martes, Miércoles, Jueves y Viernes" class="form-control" style="border-radius: 30px; width: 97%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="laborales" value="" size="50" maxlength="100">
                                    </div>

                                    <? if ($_SESSION['id_modificar'] == '-1') { ?>
                                        <center>
                                            <a href="ofertas_empleo.php">
                                                <input style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' value="Regresar">
                                            </a>
                                            <input onclick="agregar_oferta_empleo(selector.value,selector2.value,nombre_comercial.value,estado.value,municipio.value,parroquia.value,sdirecion.value,cargo.value,tipo_contrato.value,frecuencia_pago.value,Hora_Entrada.value,AmPm1.value,Hora_Salida.value,AmPm2.value,laborales.value)" style="background-color: #46A2FD; color: #fff; width: auto;border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; font-size:16px; margin: 30px 0 0 0;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="button" value="Guardar Registro">
                                        </center>
                                    <? } else { ?>
                                        <center>
                                            <a href="ofertas_empleo.php">
                                                <input style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' value="Regresar">
                                            </a>
                                            <input onclick="modificar_oferta(selector.value,selector2.value,nombre_comercial.value,estado.value,municipio.value,parroquia.value,sdirecion.value,cargo.value,tipo_contrato.value,frecuencia_pago.value,Hora_Entrada.value,AmPm1.value,Hora_Salida.value,AmPm2.value,laborales.value,valor_id.value)" style="background-color: #46A2FD; color: #fff; width: auto;border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; font-size:16px; margin: 30px 0 0 0;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="button" value="Actualizar Registro">
                                        </center>
                                    <? } ?>
                                </div>
                            </form>
                        </div>
                        <br>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
    <script src="../js/code.jquery.com_jquery-3.7.0.js"></script>
    <script src="../js/cdn.tailwindcss.com_3.3.3"></script>
    <script src="../js/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
    <script src="../js/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
</body>

</html>