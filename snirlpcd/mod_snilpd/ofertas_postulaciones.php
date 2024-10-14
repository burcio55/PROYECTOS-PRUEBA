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

    $_SESSION['id_modificar'] = '-1';
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

                <div class="content-full">
                    <br>
                    <div class="jumbotron">
                        <h2 class="text-secondary font-weight-bold">Postulaciones</h2>
                        <br>
                    </div>
                    <hr>
                    <br>
                    <!-- <table id="example" class="table table-secondary table-striped display">
                        <thead>
                            <tr>
                                <th scope="col"> # </th>
                                <th scope="col"> Sucursal </th>
                                <th scope="col"> Cargo </th>
                                <th scope="col"> Tipo de Contrato </th>
                                <th scope="col"> Días Laborales </th>
                                <th scope="col"> Horario de Trabajo </th>
                                <th scope="col"> Frecuencia de Pago </th>
                                <th scope="col"> Acciones </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row"> 1 </td>
                                <td> Equiofica Sabana Grande </td>
                                <td> Contador </td>
                                <td> Indeterminado </td>
                                <td> Lunes a Viernes </td>
                                <td> 8:00 AM - 4:30 PM </td>
                                <td> Semanal </td>
                                <td>
                                    <button type="button" class="btn btn-primary" style="background-color: #008cba">Postulaciones</button>
                                    <button type="button" class="btn btn-warning" style="background-color: #e99002">Modificar</button>
                                    <button type="button" class="btn btn-danger" onclick="eliminarRegistro()" style="background-color: #f04124">Eliminar</button>
                                </td>
                            </tr>
                            <tr>
                                <td scope="row"> 2 </td>
                                <td> Bulevar </td>
                                <td> Programador </td>
                                <td> Contrato Fijo </td>
                                <td> lunes a Lunes </td>
                                <td> 7:00 AM - 4:30 PM </td>
                                <td> Mensual </td>
                                <td>
                                    <button type="button" class="btn btn-primary" style="background-color: #008cba">Postulaciones</button>
                                    <button type="button" class="btn btn-warning" style="background-color: #e99002">Modificar</button>
                                    <button type="button" class="btn btn-danger" onclick="eliminarRegistro()" style="background-color: #f04124">Eliminar</button>
                                </td>
                            </tr>
                            <tr>
                                <td scope="row"> 3 </td>
                                <td> Movistar Centro Capital </td>
                                <td> Procrastinador Profesional </td>
                                <td> Indeterminado </td>
                                <td> Marte, Miércoles y Viernes</td>
                                <td> 9:00 AM - 6:00 PM </td>
                                <td> Quincenal </td>
                                <td>
                                    <button type="button" class="btn btn-primary" style="background-color: #008cba">Postulaciones</button>
                                    <button type="button" class="btn btn-warning" style="background-color: #e99002">Modificar</button>
                                    <button type="button" class="btn btn-danger" onclick="eliminarRegistro()" style="background-color: #f04124">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table> -->
                    <? 
                        $id = $_SESSION['id_propuesta'];
                        $select = "SELECT ";
                        $select .= " snirlpcd.postulaciones.oferta_empleo_id,";
                        $select .= " snirlpcd.postulaciones.persona_id,";
                        $select .= " snirlpcd.postulaciones.id,";
                        $select .= " snirlpcd.postulaciones.dfecha_creacion,";
                        $select .= " snirlpcd.persona.sprimer_nombre,";
                        $select .= " snirlpcd.persona.ssegundo_nombre,";
                        $select .= " snirlpcd.persona.sprimer_apellido,";
                        $select .= " snirlpcd.persona.ssegundo_apellido";
                        $select .= " FROM snirlpcd.postulaciones";
                        $select .= " inner join snirlpcd.persona on snirlpcd.persona.id = snirlpcd.postulaciones.persona_id";
                        $select .= " where snirlpcd.postulaciones.benabled='TRUE'";
                        $select .= " AND snirlpcd.persona.benabled='TRUE'";
                        $select .= " AND oferta_empleo_id='$id'";
                        $row = pg_query($conn, $select);
                    ?>
                    <table id="example" class="table table-secondary table-striped display">
                        <thead>
                            <center>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">Fecha de Postulación</th>
                                    <th scope="col">Estatus</th>
                                    <th scope="col">Acción</th>
                                </tr>
                        </thead>
                        <tbody>
                            <? while ($persona = pg_fetch_assoc($row)) { 
                                $SQL = "SELECT";
                                $SQL .= " *";
                                $SQL .= " FROM";
                                $SQL .= " snirlpcd.estatus_postulaciones";
                                $SQL .= " WHERE";
                                $SQL .= " postulaciones_id = '".$persona['id']."'";
                                $SQL .= " AND";
                                $SQL .= " benabled = 'true'";
                                $SQL .= " ORDER BY id DESC";
                                $SQL .= " Limit 1";
                                $row2 = pg_query($conn, $SQL);
                                $persona2 = pg_fetch_assoc($row2);
                                if($persona2['estatus_id'] != 4 && $persona2['estatus_id'] != 7){
                                    $sql = ("SELECT estatus_postulaciones.estatus_id, estatus.sdescripcion FROM snirlpcd.estatus_postulaciones INNER JOIN snirlpcd.estatus ON estatus.id = estatus_postulaciones.estatus_id WHERE estatus_postulaciones.benabled = 'true' AND estatus_postulaciones.postulaciones_id = '".$persona['id']."'");
                                    $valor = pg_query($conn, $sql);
                                    $persona3 = pg_fetch_assoc($valor);
                                    $i++;?>
                                    <tr>
                                        <? $nombre = $persona['sprimer_nombre']." ".$persona['ssegundo_nombre'];
                                        $apellido = $persona['sprimer_apellido']." ".$persona['ssegundo_apellido']; ?>
                                        <th scope="row" id="id"><? echo $i; ?></th>
                                        <td id="cargo"><? echo $nombre?></td>
                                        <td id="horario"><? echo $apellido?></td>
                                        <td id="dias"><? echo $persona['dfecha_creacion']; ?></td>
                                        <td id="dias"><? echo $persona3['sdescripcion']; ?></td>
                                        <td id="botones">
                                            <?if($persona3['sdescripcion'] == 'Citado'){ ?>
                                                <button type="button" class="btn btn-danger" style="background-color: #f04124; border-radius: 30px;" onclick="rechazar_postulacion2(<? echo $persona['id'];?>)">Rechazar</button>
                                            <?}else{?>
                                                <button type="button" class="btn btn-primary" style="background-color: #008cba; border-radius: 30px;" onclick="revisar(<? echo $persona['persona_id'];?>,<? echo $persona['id'];?>)">Ver Curriculum</button>
                                            <?}?>
                                        </td>
                                    </tr>
                                <?}
                            }?>
                        </tbody>
                        </center>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <script src="../js/code.jquery.com_jquery-3.7.0.js"></script>
    <script src="../js/cdn.tailwindcss.com_3.3.3"></script>
    <script src="ofertas_empleo_discapacidad.js"></script>
    <script src="../js/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
    <script src="../js/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });
    </script>
</body>

</html>