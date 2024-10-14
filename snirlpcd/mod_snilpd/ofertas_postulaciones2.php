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
                        <div class="card card-primary" style="border-radius: 30px">
                            <div style="display: none;">
                                <input type="text" id="valor_id" value="0">
                            </div>
                            <div class="card-header" style="border-radius:30px 30px 0 0">
                                <h2 class="card-title"> Sintesis Curricular </h2>
                            </div>
                            <?
                                $persona_id = $_SESSION['persona_id'];

                                $query = ("SELECT * FROM snirlpcd.persona_fotos WHERE persona_id = '" . $persona_id . "';");
                                $row2 = pg_query($conn, $query);
                                $persona2 = pg_fetch_assoc($row2);
                                $simagen = $persona2["nombre_foto"];

                                $consulta = ("SELECT * FROM snirlpcd.persona WHERE id = '" . $persona_id . "' and benabled='true';");
                                $row = pg_query($conn, $consulta);
                                $persona = pg_fetch_assoc($row);

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
                                $row3 = pg_query($conn, $sql);
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

                                $PG = "SELECT";
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
                                $row5 = pg_query($conn, $PG);
                                while ($row4 = pg_fetch_assoc($row5)){
                                    if($row4["stitulo_obtenido"] == ''){
                                        $titulo .= '<p class="text-md-start"> En proceso de conseguirlo </p>';
                                    }else{
                                        $titulo .= '<p class="text-md-start">'.$row4["stitulo_obtenido"].'</p>';
                                    }
                                    $instituto .= '<p class="text-md-start">'.$row4["snombre_inst_educativa"].'</p>';
                                    if($row4["dfecha_graduacion"] == ''){
                                        $graduacion .= '<p class="text-md-start"> Estudiando actualmente </p>';
                                    }else{
                                        $graduacion .= '<p class="text-md-start">'.$row4["dfecha_graduacion"].'</p>';
                                    }
                                }

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
                                $row7 = pg_query($conn, $PG2);
                                while ($row6 = pg_fetch_assoc($row7)){
                                    $actividad .= '<p class="text-md-start">'.$row6["snombre_activ_capacitacion"].'</p>';
                                    $institucion .= '<p class="text-md-start">'.$row6["snombre_entidad_capacitadora"].'</p>';
                                    $duracion .= '<p class="text-md-start">'.$row6["sduracion_capacitacion"].' Horas</p>';
                                }

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
                                $row9 = pg_query($conn, $PG3);
                                while ($row8 = pg_fetch_assoc($row9)){
                                    $name_tra2 =  $row8['snombre_entidad_trabajo'];
                                    $cargo2 = $row8['scargo'];
                                    $fingreso = $row8['dfecha_ingreso'];
                                    $fegreso = $row8['dfecha_egreso'];
                                    if ($fegreso == '') {
                                        $fegreso = "Sigo actualmente";
                                    }
                                    $trabajo .= '<p class="text-md-start">'.$name_tra2.'</p>';
                                    $cargo .= '<p class="text-md-start">'.$cargo2.'</p>';
                                    $fecha .= '<p class="text-md-start"> Ingreso: '.$fingreso.' <br> Egreso: '.$fegreso.'</p>';
                                }

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
                                $row11 = pg_query($conn, $PG4);
                                while ($row10 = pg_fetch_assoc($row11)){
                                    $conocimiento .= '<p class="text-md-start">'.$row10['snombre_otros_conocimientos'].'</p>';
                                    $nivel = $row10['sdominio_conocimiento'];
                                    if($nivel == 1){
                                        $nivel2 .= '<p class="text-md-start"> Bajo </p>';
                                    }else
                                    if($nivel == 2){
                                        $nivel2 .= '<p class="text-md-start"> Medio </p>';
                                    }else
                                    if($nivel == 3){
                                        $nivel2 .= '<p class="text-md-start"> Alto </p>';
                                    }else{
                                        $nivel2 .= '<p class="text-md-start"> No Especificado </p>';
                                    }
                                }
                            ?>
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <img src="<?echo $simagen?>" alt="">
                                        </div>
                                        <div class="col-sm-9 row align-items-center">
                                            <div class="col-sm-12">
                                                <h1 class="h1"><? echo strtoupper($persona["sprimer_nombre"])." ".strtoupper($persona["ssegundo_nombre"])." ".strtoupper($persona["sprimer_apellido"])." ".strtoupper($persona["ssegundo_apellido"]); ?></h1>
                                                <hr>
                                                <br>
                                            </div>
                                            <div class="col">
                                                <p class="text-md-start"><b>- Número de Cédula: </b></p>
                                                <p class="text-md-start"><b>- Residencia: </b></p>
                                                <p class="text-md-start"><b>- Teléfono de contacto: </b></p>
                                                <p class="text-md-start"><b>- Correo Electrónico: </b></p>
                                                <p class="text-md-start"><b>- Edad: </b></p>
                                                <p class="text-md-start"><b>- Sexo: </b></p>
                                                <p class="text-md-start"><b>- Estado Civil: </b></p>
                                            </div>
                                            <div class="col">
                                                <p class="text-md-start"><? echo $persona["snacionalidad"]."-".$persona["ncedula"]; ?></p>
                                                <p class="text-md-start"><? echo $persona3["ciudad_descripcion"]." - ".$persona3["municipio_descripcion"]." - ".$persona3["parroquia_descripcion"]; ?></p>
                                                <p class="text-md-start"><? echo $persona3["stelefono_personal"]." / ".$persona3["stelefono_habitacion"]; ?></p>
                                                <p class="text-md-start"><? echo $persona["semail"]; ?></p>
                                                <p class="text-md-start"><? echo $edad; ?></p>
                                                <p class="text-md-start"><? echo $ssexo; ?></p>
                                                <p class="text-md-start"><? echo $estado_civil_id; ?></p>
                                            </div>
                                        </div>
                                        <!-- ************************************************************* -->
                                        <div class="col-sm-12">
                                            <br>
                                            <h2 class="h2">Nivel Educativo</h2>
                                            <hr>
                                        </div>
                                        <!-- ------------------------------------------------------------- -->
                                        <div class="col-sm-4">
                                            <br>
                                            <h4 class="h4">Título Obtenido</h4>
                                            <? echo $titulo; ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <br>    
                                            <h4 class="h4">Nombre de la Intitución</h4>
                                            <? echo $instituto; ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <br>
                                            <h4 class="h4">Año de Graduación</h4>
                                            <? echo $graduacion; ?>
                                        </div>
                                        <!-- ************************************************************* -->
                                        <div class="col-sm-12">
                                            <br>
                                            <h2 class="h2">Actividades de Capacitación</h2>
                                            <hr>
                                        </div>
                                        <!-- ------------------------------------------------------------- -->
                                        <div class="col-sm-4">
                                            <br>
                                            <h4 class="h4">Nombre de la Actividad</h4>
                                            <? echo $actividad; ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <br>    
                                            <h4 class="h4">Nombre de la Intitución</h4>
                                            <? echo $institucion; ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <br>
                                            <h4 class="h4">Duración</h4>
                                            <? echo $duracion; ?>
                                        </div>
                                        <!-- ************************************************************* -->
                                        <div class="col-sm-12">
                                            <br>
                                            <h2 class="h2">Experiencia Laboral</h2>
                                            <hr>
                                        </div>
                                        <!-- ------------------------------------------------------------- -->
                                        <div class="col-sm-4">
                                            <br>
                                            <h4 class="h4">Nombre de la Empresa</h4>
                                            <? echo $trabajo; ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <br>    
                                            <h4 class="h4">Cargo</h4>
                                            <? echo $cargo; ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <br>    
                                            <h4 class="h4">Fecha</h4>
                                            <? echo $fecha; ?>
                                        </div>
                                        <!-- ************************************************************* -->
                                        <div class="col-sm-12">
                                            <br>
                                            <h2 class="h2">Habilidades y Destrezas</h2>
                                            <hr>
                                        </div>
                                        <!-- ------------------------------------------------------------- -->
                                        <div class="col-sm-6">
                                            <br>
                                            <h4 class="h4">Conocimiento</h4>
                                            <? echo $conocimiento; ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <br>    
                                            <h4 class="h4">Nivel de Dominio</h4>
                                            <? echo $nivel2; ?>
                                        </div>
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
                                            <input type="button" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' value="Regresar">
                                        </a>
                                        <input onclick="rechazar_postulacion()" style="background-color: #46A2FD; color: #fff; width: auto;border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; font-size:16px; margin: 30px 0 0 0;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="button" value="Rechazar">
                                        <input onclick="aceptar_postulacion()" style="background-color: #46A2FD; color: #fff; width: auto;border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; font-size:16px; margin: 30px 0 0 0;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="button" value="Entrevistar">
                                    </center>
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
    <script src="ofertas_empleo_discapacidad.js"></script>
    <script src="../js/code.jquery.com_jquery-3.7.0.js"></script>
    <script src="../js/cdn.tailwindcss.com_3.3.3"></script>
    <script src="../js/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
    <script src="../js/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
</body>

</html>