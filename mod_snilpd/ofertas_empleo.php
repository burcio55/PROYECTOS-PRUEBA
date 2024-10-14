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

$sql1 = "SELECT * FROM rnee.rnee_empresa where srif='" . $_SESSION['rif'] . "'";
$aux1 = pg_query($conex, $sql1);
$dato1 = pg_fetch_assoc($aux1);

$sql2 = "SELECT * FROM rnee.rnee_condicion_actividad_movimiento where rnee_empresa_id='" . $dato1['id'] . "'";
$aux2 = pg_query($conex, $sql2);
$dato2 = pg_fetch_assoc($aux2);

$cedula_empresa = $dato1["id"];
$_SESSION['id_oferta_snirlpcd'] = $cedula_empresa;

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

    <div class="content-full" style="width: 95%; overflow: auto; height: 80vh; margin: auto">
        <br>
        <div class="jumbotron">
            <h2 class="font-weight-bold" style="color: rgb(16, 96, 200); font-size: 32px">Ofertas de Empleo Registradas </h2>
            <a href="oferta_empleo.php">
                <input readonly class="btn btn-sm btn-primary" onclick="agregar()" style="float: right; margin-top: -27px; width: 23%; border-radius: 30px; font-size: 16px; font-family: Arial;" value="Registrar Oferta de Empleo">
            </a>
            <br>
        </div>
        <hr>
        <br>
        <?
        $select2 = ("SELECT * FROM snirlpcd.oferta_empleo WHERE benabled = 'true'");
        $row2 = pg_query($conex, $select2);
        ?>

        <table id="example" class="table table-hover table-striped" style="width: 100%;">
            <thead>
                <center>
                    <tr>
                        <th scope="col" style="font-size: 14px; font-weight: normal; color: rgb(16, 96, 200)">#</th>
                        <th scope="col" style="font-size: 14px; font-weight: normal; color: rgb(16, 96, 200)">Cargo</th>
                        <th scope="col" style="font-size: 14px; font-weight: normal; color: rgb(16, 96, 200)">Nombre</th>
                        <th scope="col" style="font-size: 14px; font-weight: normal; color: rgb(16, 96, 200)">Entidad empleadora</th>
                        <th scope="col" style="font-size: 14px; font-weight: normal; width: 34%; color: rgb(16, 96, 200)">Acción</th>
                    </tr>
                </center>
            </thead>
            <tbody>
                <?
                /*
                    $sql = "SELECT 
                    rnee.rnee_empresa.srazon_social, 
                    rnee.rnee_condicion_actividad_movimiento.rnee_empresa_id as empresa,
                    rnee.rnee_condicion_actividad_movimiento.rnee_sucursal_id as sucursal,
                    rnee.rnee_sucursales.sdenominacion_comercial as nombre_sucursal,
                    rnee.rnee_sucursales.sdireccion as dir_sucursal
                    FROM rnee.rnee_condicion_actividad_movimiento
                    INNER JOIN snirlpcd.oferta_empleo on snirlpcd.oferta_empleo.rnee_condicion_actividad_movimiento_id = rnee.rnee_condicion_actividad_movimiento.id 
                    inner join rnee.rnee_empresa on rnee.rnee_empresa.id = rnee.rnee_condicion_actividad_movimiento.rnee_empresa_id
                    inner join rnee.rnee_sucursales on rnee.rnee_sucursales.id = rnee.rnee_condicion_actividad_movimiento.rnee_sucursal_id
                    inner join public.parroquia on public.parroquia.nparroquia = rnee.rnee_empresa.parroquia_id
                    inner join public.municipio on public.municipio.nmunicipio = parroquia.nmunicipio
                    inner join public.entidad on public.entidad.nentidad = parroquia.nentidad
                    where rnee.rnee_condicion_actividad_movimiento.rnee_empresa_id = '" . $dato1['id'] . "' 
                    and rnee.rnee_condicion_actividad_movimiento.nenabled='1'";
                */
                while ($persona7 = pg_fetch_assoc($row2)) {
                    $select3 = ("SELECT * FROM rnee.rnee_condicion_actividad_movimiento WHERE id = '" . $persona7['rnee_condicion_actividad_movimiento_id'] . "' AND rnee_empresa_id='" . $dato1["id"] . "' AND nenabled = '1'");
                    $row3 = pg_query($conex, $select3);
                    if ($valor3 = pg_fetch_assoc($row3)) {
                        if ($valor3['rnee_sucursal_id'] == '0') {
                            $select4 = ("SELECT * FROM rnee.rnee_empresa WHERE id = '" . $valor3['rnee_empresa_id'] . "'");
                            $row4 = pg_query($conex, $select4);
                            $valor4 = pg_fetch_assoc($row4);
                            $nombre = $valor4['srazon_social'];
                            $nombre2 = "Sede principal";
                        } else {
                            $select4 = ("SELECT * FROM rnee.rnee_sucursales WHERE id = '" . $valor3['rnee_sucursal_id'] . "'");
                            $row4 = pg_query($conex, $select4);
                            $valor4 = pg_fetch_assoc($row4);
                            $nombre = $valor4['sdenominacion_comercial'];
                            $nombre2 = "Sucursal";
                        }
                        $i++; ?>
                        <tr>
                            <th scope="row" id="id"><? echo $i; ?></th>
                            <td id="cargo"><? echo $persona7['snombre_cargo'] ?></td>
                            <td id="horario"><? echo $nombre ?></td>
                            <td id="dias"><? echo $nombre2 ?></td>
                            <td id="botones">
                                <input class="btn btn-sm btn-primary" readonly style="float: right; margin-top: 0; width: 40%; border-radius: 30px; font-size: 16px; font-family: Arial;" onclick="postulaciones(<? echo $persona7['id']; ?>)" value="Postulaciones">
                                <input class="btn btn-sm btn-warning" readonly style="float: right; margin-top: 0; width: 30%; border-radius: 30px; font-size: 16px; font-family: Arial;" onclick="modificar(<? echo $persona7['id']; ?>)" value="Modificar">
                                <input class="btn btn-sm btn-danger" readonly style="float: right; margin-top: 0; width: 30%; border-radius: 30px; font-size: 16px; font-family: Arial;" onclick="eliminarRegistro(<? echo $persona7['id']; ?>)"value="Eliminar">
                            </td>
                        </tr>
                <? }
                } ?>
            </tbody>
            </center>
        </table>
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
<script>
    /* $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    }); */
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