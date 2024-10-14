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
    $id = $_SESSION['id_propuesta'];
    $oferta = "SELECT";
    $oferta .= " *";
    $oferta .= " FROM";
    $oferta .= " snirlpcd.oferta_empleo";
    $oferta .= " WHERE";
    $oferta .= " id = '$id'";
    $oferta .= " AND";
    $oferta .= " benabled = 'true'";
    $row0 = pg_query($conex, $oferta);
    $ofert = pg_fetch_assoc($row0);
    $nvacante = $ofert["nvacante"];
    ?>

    <div class="content-full" style="width: 95%; overflow: auto; height: 80vh; margin: auto">
        <br>
        <div class="jumbotron">
            <h2 class="font-weight-bold" style="color: rgb(16, 96, 200); font-size: 32px">Postulaciones</h2>
            <h2 class="text-secondary font-weight-bold" style="text-align: right; margin-top: -17.65px; font-size: 18px"><span style="color: rgb(16, 96, 200)">Número de Vacantes:</span> <? echo $nvacante; ?> </h2>
            <br>
        </div>
        <hr>
        <br>
        <?
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
        $row = pg_query($conex, $select);
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
                    $SQL .= " postulaciones_id = '" . $persona['id'] . "'";
                    $SQL .= " AND";
                    $SQL .= " benabled = 'true'";
                    $SQL .= " ORDER BY id DESC";
                    $SQL .= " Limit 1";
                    $row2 = pg_query($conex, $SQL);
                    $persona2 = pg_fetch_assoc($row2);
                    if ($persona2['estatus_id'] != '3' && $persona2['estatus_id'] != '8') {
                        $sql = ("SELECT estatus_postulaciones.estatus_id, estatus.sdescripcion FROM snirlpcd.estatus_postulaciones INNER JOIN snirlpcd.estatus ON estatus.id = estatus_postulaciones.estatus_id WHERE estatus_postulaciones.benabled = 'true' AND estatus_postulaciones.postulaciones_id = '" . $persona['id'] . "'");
                        $valor = pg_query($conex, $sql);
                        $persona3 = pg_fetch_assoc($valor);
                        $i++; ?>
                        <tr>
                            <? $nombre = $persona['sprimer_nombre'] . " " . $persona['ssegundo_nombre'];
                            $apellido = $persona['sprimer_apellido'] . " " . $persona['ssegundo_apellido']; ?>
                            <th scope="row" id="id"><? echo $i; ?></th>
                            <td id="cargo"><? echo $nombre ?></td>
                            <td id="horario"><? echo $apellido ?></td>
                            <td id="dias"><? echo $persona['dfecha_creacion']; ?></td>
                            <td id="dias"><? echo $persona3['sdescripcion']; ?></td>
                            <td id="botones">
                                <? if ($persona3['sdescripcion'] == 'Citado') { ?>
                                    <input class="btn btn-sm btn-danger" readonly style="float: center; margin-top: 0; width: 70%; border-radius: 30px; font-size: 16px; font-family: Arial;" onclick="rechazar_postulacion2(<? echo $persona['id']; ?>)" value="Rechazar">
                                <? } else if ($persona3['sdescripcion'] == 'Rechazó Entrevista') { ?>
                                    <input class="btn btn-sm btn-primary" readonly style="float: center; margin-top: 0; width: 70%; border-radius: 30px; font-size: 16px; font-family: Arial;" onclick="ver_motivo_rechazo(<? echo $persona['id']; ?>)" value="Ver Motivo">
                                <? } else if ($persona3['sdescripcion'] == 'Aceptó Entrevista') { ?>
                                    <input class="btn btn-sm btn-primary" readonly style="float: center; margin-top: 0; width: 50%; border-radius: 30px; font-size: 16px; font-family: Arial;" onclick="contratar(<? echo $persona['id']; ?>,<? echo $_SESSION['id_propuesta']; ?>)" value="Contratar">
                                    <input class="btn btn-sm btn-danger" readonly style="float: center; margin-top: 0; width: 50%; border-radius: 30px; font-size: 16px; font-family: Arial;" onclick="rechazar_postulacion2(<? echo $persona['id']; ?>)" value="Rechazar">
                                <? } else if ($persona3['sdescripcion'] == 'Contratado') { ?>
                                <? } else if ($persona3['sdescripcion'] == 'No Disponible') { ?>
                                    <input class="btn btn-sm btn-danger" readonly style="float: center; margin-top: 0; width: 70%; border-radius: 30px; font-size: 16px; font-family: Arial;" onclick="rechazar_postulacion2(<? echo $persona['id']; ?>)" value="Eliminar Postulación">
                                <? } else { ?>
                                    <input class="btn btn-sm btn-primary" readonly style="float: center; margin-top: 0; width: 70%; border-radius: 30px; font-size: 16px; font-family: Arial;" onclick="revisar(<? echo $persona['persona_id']; ?>,<? echo $persona['id']; ?>)" value="Ver Curriculum">
                                <? } ?>
                            </td>
                        </tr>
                <? }
                } ?>
            </tbody>
            </center>
        </table>
        <br>
        <center>
            <a href="ofertas_empleo.php">
                <input class="btn btn-sm btn-secondary" readonly style="float: center; margin-top: 0; width: 15%; border-radius: 30px; font-size: 16px; font-family: Arial;" data-bs-toggle="tooltip" value="Regresar">
            </a>
        </center>
        <br>
        <br>
    </div>
</form>

<?php
//CONDICION PARA ACTUALIZAR SIEMPRE LOS DATOS DE INTEROPERABILIDAD		

/* if ((isset($_SESSION['rif'])) and (isset($_SESSION['nusuario'])) and (isset($_SESSION['id_usuario'])) and (isset($_SESSION['empresa_id'])) and $_SESSION['estaus_empresa'] != 1 and $_SESSION['actualiza_entes'] != 1) { */

?>


<script src="../js/code.jquery.com_jquery-3.7.0.js"></script>
<script src="../js/cdn.tailwindcss.com_3.3.3"></script>
<script src="ofertas_empleo_discapacidad.js"></script>
<script src="../js/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
<script src="../js/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').dataTable({ //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
            "sPaginationType": "full_numbers" //DAMOS FORMATO A LA PAGINACION(NUMEROS)
        });
        $('#example').css('width', '100%');
    });
</script>

<?php

/*    $_SESSION['actualiza_entes'] = 1;
} */
include('../footer.php');
?>