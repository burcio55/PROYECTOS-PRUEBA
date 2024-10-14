<?php
include("../header.php");
include("../mod_hcm/general_LoadCombo.php");

include("BD.php");

$periodo = $_SESSION["Periodo"];
$ayo = date('y');

if ($periodo == 1) {
    $desde = "01/01/" . $ayo;
    $hasta = "31/03/" . $ayo;
} else
if ($periodo == 2) {
    $desde = "01/04/" . $ayo;
    $hasta = "30/06/" . $ayo;
} else
if ($periodo == 3) {
    $desde = "01/7/" . $ayo;
    $hasta = "31/9/" . $ayo;
} else
if ($periodo == 4) {
    $desde = "01/10/" . $ayo;
    $hasta = "31/12/" . $ayo;
}

$_SESSION["Desde"] = $desde;
$_SESSION["Hasta"] = $hasta;

?>
<div style="background-color: white; width: 40%; padding: 20px; border-radius: 30px; border: grey 1px solid; position:absolute; margin-left: 30%; display:none; margin-top: 10%" id="alerta">
    <p id="mensaje" style="text-align: justify;"></p>
    <button type="button" style="padding: 5px 10px; border-radius: 20px; border: 1px grey solid" onclick="cerrar()">Cerrar</button>
</div>
<div style="background-color: white; width: 40%; padding: 20px; border-radius: 30px; border: grey 1px solid; position:absolute; margin-left: 30%; display:none; margin-top: 10%" id="alerta2">
    <p id="mensaje2" style="text-align: justify;"></p>
    <button type="button" style="padding: 5px 10px; border-radius: 20px; border: 1px grey solid" onclick="cerrar2()">Cerrar</button>
</div>
<form name="formulario" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" id="formulario">
    <div id="Contenido" align="center" style="overflow:auto">
        <br>
        <table class="tabla" width="95%" height="95%">
            <tbody>
                <tr valign="top">
                    <td>
                        <br />
                        <table width="95%" border="0" align="center" class="formulario">

                            <style>
                                .th,
                                .td {
                                    border: 1px solid #ddd;
                                    padding: 8px;
                                    text-align: left;
                                }

                                .center {
                                    text-align: center;
                                }

                                .th {
                                    background-color: #f0f0f0;
                                    text-align: center;
                                }

                                .title {
                                    text-align: left;
                                }
                            </style>
                            <tr>
                                <th colspan="4" class="sub_titulo">
                                    <div align="left">REPORTE --> Reporte ENTES </div>
                                </th>
                            <tr>
                                <td colspan="4" align="right"><span class="requerido">Campos Obligatorios (*)</span></td>
                            </tr>

                            <!-- ------------------------------ Periodo Evaluado --------------------------------------  -->

                            <tr class="identificacion_seccion">
                                <th colspan="4" class="sub_titulo_2" width="100%" align="center" style="background-color: #D0E0F4; padding: 5px; border-radius: 30px; color: #1060C8;">
                                    PERIODO EVALUADO
                                </th>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr style="margin-top: 30px;">
                                <th style="color: grey; text-align:right" width="23%">Desde : </th>
                                <td align="center" style="border-radius: 30px;">
                                    <font color="#666666">
                                        <input style="border-radius: 30px; border: solid 1px #999999; width:50%; float:left; text-align:center" name="desde" id="desde" type="text" value="<? echo $desde; ?>" readonly />
                                    </font>
                                </td>
                                <th style="color: grey; text-align:right" width="23%">Hasta : </th>
                                <td align="center" style="border-radius: 30px;">
                                    <font color="#666666">
                                        <input style="border-radius: 30px; border: solid 1px #999999; width:50%; float:left; text-align:center" name="hasta" id="hasta" type="text" value="<? echo $hasta; ?>" readonly />
                                    </font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Ente <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <select style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="nentes" id="nentes">
                                        <option selected value="-1"> Seleccione </option>
                                        <option value="1"> INPSASEL </option>
                                        <option value="2"> INCRET </option>
                                        <option value="3"> TSS </option>
                                    </select>
                                    <select style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align: center; display: none" name="nentes2" id="nentes2" disabled>
                                        <option value="1"> INPSASEL </option>
                                        <option value="2"> INCRET </option>
                                        <option value="3"> TSS </option>
                                    </select>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr class="identificacion_seccion">
                                <th colspan="4" width="100%" align="center" style="font-size: 15px" class="title">
                                    Alto Nivel <br>
                                    <hr>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Alto Nivel Evaluados <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Alto Nivel no Evaluado <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="alto_nivel" id="alto_nivel" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="alto_nivel_no" id="alto_nivel_no" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Alto Nivel con Excelente <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Alto Nivel con Muy Bueno <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="alto_nivel_exc" id="alto_nivel_exc" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="alto_nivel_m_bueno" id="alto_nivel_m_bueno" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Alto Nivel con Bueno <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Alto Nivel con Cumplimiento Ordinario <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="alto_nivel_bueno" id="alto_nivel_bueno" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="alto_nivel_ordinario" id="alto_nivel_ordinario" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Alto Nivel que No Cumplió <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="alto_nivel_no_cump" id="alto_nivel_no_cump" type="number" max="9999" />
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <label class="form-label"> Observaciones sobre los Alto Nivel </label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <textarea style="border-radius: 30px; border: solid 1px #999999; float:left; text-align:center; min-width: 98%; max-width: 98%; min-height: 70px" name="alto_nivel_sobservaciones" id="alto_nivel_sobservaciones" cols="0" rows="0" />
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr class="identificacion_seccion">
                                <th colspan="4" width="100%" align="center" style="font-size: 15px" class="title">
                                    Designados <br>
                                    <hr>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Designados Evaluados <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Designados de no Evaluados <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="designado" id="designado" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="designado_no" id="designado_no" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Designados con Excelente <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Designados con Muy Bueno <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="designado_exc" id="designado_exc" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="designado_m_bueno" id="designado_m_bueno" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Designados con Bueno <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Designados con Cumplimiento Ordinario <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="designado_bueno" id="designado_bueno" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="designado_ordinario" id="designado_ordinario" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Designados que No Cumplieron <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="designado_no_cump" id="designado_no_cump" type="number" max="9999" />
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <label class="form-label"> Observaciones sobre los Designados </label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <textarea style="border-radius: 30px; border: solid 1px #999999; float:left; text-align:center; min-width: 98%; max-width: 98%; min-height: 70px" name="designado_sobservaciones" id="designado_sobservaciones" cols="0" rows="0" />
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr class="identificacion_seccion">
                                <th colspan="4" width="100%" align="center" style="font-size: 15px" class="title">
                                    Empleados <br>
                                    <hr>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Empleados Evaluados <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Empleados de no Evaluados <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="empleado" id="empleado" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="empleado_no" id="empleado_no" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Empleados con Excelente <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Empleados con Muy Bueno <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="empleado_exc" id="empleado_exc" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="empleado_m_bueno" id="empleado_m_bueno" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Empleados con Bueno <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Empleados con Cumplimiento Ordinario <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="empleado_bueno" id="empleado_bueno" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="empleado_ordinario" id="empleado_ordinario" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Empleados que No Cumplieron <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="empleado_no_cump" id="empleado_no_cump" type="number" max="9999" />
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <label class="form-label"> Observaciones sobre los Empleados </label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <textarea style="border-radius: 30px; border: solid 1px #999999; float:left; text-align:center; min-width: 98%; max-width: 98%; min-height: 70px" name="empleado_sobservaciones" id="empleado_sobservaciones" cols="0" rows="0" />
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr class="identificacion_seccion">
                                <th colspan="4" width="100%" align="center" style="font-size: 15px" class="title">
                                    Obreros <br>
                                    <hr>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Obreros Evaluados <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Obreros de no Evaluados <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="obreros" id="obreros" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="obreros_no" id="obreros_no" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Obreros con Excelente <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Obreros con Muy Bueno <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="obreros_exc" id="obreros_exc" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="obreros_m_bueno" id="obreros_m_bueno" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Obreros con Bueno <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Obreros con Cumplimiento Ordinario <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="obreros_bueno" id="obreros_bueno" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="obreros_ordinario" id="obreros_ordinario" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Obreros que No Cumplieron <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="obreros_no_cump" id="obreros_no_cump" type="number" max="9999" />
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Observaciones sobre los Empleados </label>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <textarea style="border-radius: 30px; border: solid 1px #999999; float:left; text-align:center; min-width: 98%; max-width: 98%; min-height: 70px" name="obreros_sobservaciones" id="obreros_sobservaciones" cols="0" rows="0" />
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr class="identificacion_seccion">
                                <th colspan="4" width="100%" align="center" style="font-size: 15px" class="title">
                                    Comisión de Servicio <br>
                                    <hr>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Comisiones de Servicios Evaluados <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Comisiones de Servicios de no Evaluados <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="c_servicios" id="c_servicios" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="c_servicios_no" id="c_servicios_no" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Comisiones de Servicios con Excelente <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Comisiones de Servicios con Muy Bueno <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="c_servicios_exc" id="c_servicios_exc" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="c_servicios_m_bueno" id="c_servicios_m_bueno" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Comisiones de Servicios con Bueno <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Comisiones de Servicios con Cumplimiento Ordinario <span class="requid"> * </span></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="c_servicios_bueno" id="c_servicios_bueno" type="number" max="9999" />
                                </td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="c_servicios_ordinario" id="c_servicios_ordinario" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label"> Cantidad de Comisiones de Servicios que No Cumplieron <span class="requid"> * </span></label>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center" name="c_servicios_no_cump" id="c_servicios_no_cump" type="number" max="9999" />
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <label class="form-label"> Observaciones sobre las Comisiones de Servicios</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <textarea style="border-radius: 30px; border: solid 1px #999999; float:left; text-align:center; min-width: 98%; max-width: 98%; min-height: 70px" name="c_servicios_sobservaciones" id="c_servicios_sobservaciones" cols="0" rows="0" />
                                    </textarea>
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 98%; float:left; text-align:center; display: none" name="id_entes" id="id_entes" type="number" max="9999" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <center>
                                        <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: -8px; margin-left: 5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_agregar_entes(nentes.value,alto_nivel.value,alto_nivel_no.value,alto_nivel_exc.value,alto_nivel_m_bueno.value,alto_nivel_bueno.value,alto_nivel_ordinario.value,alto_nivel_no_cump.value,alto_nivel_sobservaciones.value,designado.value,designado_no.value,designado_exc.value,designado_m_bueno.value,designado_bueno.value,designado_ordinario.value,designado_no_cump.value,designado_sobservaciones.value,empleado.value,empleado_no.value,empleado_exc.value,empleado_m_bueno.value,empleado_bueno.value,empleado_ordinario.value,empleado_no_cump.value,empleado_sobservaciones.value,obreros.value,obreros_no.value,obreros_exc.value,obreros_m_bueno.value,obreros_bueno.value,obreros_ordinario.value,obreros_no_cump.value,obreros_sobservaciones.value,c_servicios.value,c_servicios_no.value,c_servicios_exc.value,c_servicios_m_bueno.value,c_servicios_bueno.value,c_servicios_ordinario.value,c_servicios_no_cump.value,c_servicios_sobservaciones.value)" id="guard">
                                            Agregar
                                        </button>
                                        <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: -8px; margin-left: 5px; display: none" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_entes_mod(id_entes.value,nentes2.value,alto_nivel.value,alto_nivel_no.value,alto_nivel_exc.value,alto_nivel_m_bueno.value,alto_nivel_bueno.value,alto_nivel_ordinario.value,alto_nivel_no_cump.value,alto_nivel_sobservaciones.value,designado.value,designado_no.value,designado_exc.value,designado_m_bueno.value,designado_bueno.value,designado_ordinario.value,designado_no_cump.value,designado_sobservaciones.value,empleado.value,empleado_no.value,empleado_exc.value,empleado_m_bueno.value,empleado_bueno.value,empleado_ordinario.value,empleado_no_cump.value,empleado_sobservaciones.value,obreros.value,obreros_no.value,obreros_exc.value,obreros_m_bueno.value,obreros_bueno.value,obreros_ordinario.value,obreros_no_cump.value,obreros_sobservaciones.value,c_servicios.value,c_servicios_no.value,c_servicios_exc.value,c_servicios_m_bueno.value,c_servicios_bueno.value,c_servicios_ordinario.value,c_servicios_no_cump.value,c_servicios_sobservaciones.value)" id="modi">
                                            Actualizar
                                        </button>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table style="width: 100%; border: 2px black solid; border-collapse: collapse; width: 100%; margin: 20px auto;">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="th" style="text-align: center"> Organismo </th>
                                                <th scope="col" class="th" style="text-align: center"> Tipo de Cargo </th>
                                                <th scope="col" class="th" style="text-align: center"> Total Evaluados </th>
                                                <th scope="col" class="th" style="text-align: center"> Total No Evaluados </th>
                                                <th scope="col" class="th" style="text-align: center"> Total Población </th>
                                                <th scope="col" class="th" style="text-align: center"> Excelente </th>
                                                <th scope="col" class="th" style="text-align: center"> Muy Bueno </th>
                                                <th scope="col" class="th" style="text-align: center"> Bueno </th>
                                                <th scope="col" class="th" style="text-align: center"> Cumplimiento Ordinario </th>
                                                <th scope="col" class="th" style="text-align: center"> No Cumplió </th>
                                                <th scope="col" class="th" style="text-align: center"> Observaciones </th>
                                            </tr>
                                        </thead>
                                        <tbody id="fe">
                                            <tr>
                                                <td class="td" rowspan="9"><b> INPSASEL </b></td>
                                            </tr>
                                            <?


                                            $sql1 = "SELECT * FROM evaluacion_desemp.evaluacion_entes WHERE nente = '1' AND periodo_eval_id = '$periodo' AND nanno_evalu = '$ayo' AND benabled = 'TRUE'";
                                            $rs1 = pg_query($conn, $sql1);
                                            if (pg_num_rows($rs1) == 0) {
                                                $num_registro1 = 0;
                                            } else {
                                                $num_registro1 = pg_num_rows($rs1);
                                            }

                                            if ($num_registro1 == 0) {
                                            ?>
                                                <tr>
                                                    <td class="td"><b> ALTO NIVEL </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="td"><b> DESIGNADOS (GRADO 99) </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="td"><b> EMPLEADOS </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="td"><b> OBREROS </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="td"><b> COMISIÓN DE SERVICIOS </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <th class="th"><b> TOTAL </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th"><b> </b></th>
                                                </tr>
                                                <tr>
                                                    <th class="th" colspan="2"><b> TOTAL POBLACIÓN = PERSONAL <br> EVALUADO + NO EVALUADO </b></th>
                                                    <th class="th center" colspan="2"><b> 0 </b></th>
                                                    <th class="th" colspan="6"><b> </b></th>
                                                </tr>
                                                <tr>
                                                    <th class="th" colspan="4"><b> TOTAL PERSONAL EVALUADO POR RANGO DE ACTUACIÓN </b></th>
                                                    <th class="th" colspan="6"><b> 0 </b></th>
                                                </tr>
                                            <?
                                            } else {
                                                $SQL1 = "SELECT * FROM evaluacion_desemp.evaluacion_entes WHERE nente = '1' AND periodo_eval_id = '$periodo' AND nanno_evalu = '$ayo' AND benabled = 'TRUE'";
                                                $row1 = pg_query($conn, $SQL1);
                                                $persona = pg_fetch_assoc($row1);

                                                $id = $persona["id"];

                                                $nalto_nivel_evalu = $persona['nalto_nivel_evalu'];
                                                $nalto_nivel_no_evalu = $persona['nalto_nivel_no_evalu'];
                                                $total_alto_nivel = $nalto_nivel_evalu + $nalto_nivel_no_evalu;
                                                $nalto_nivel_exc = $persona['nalto_nivel_exc'];
                                                $nalto_nivel_muy_bueno = $persona['nalto_nivel_muy_bueno'];
                                                $nalto_nivel_bueno = $persona['nalto_nivel_bueno'];
                                                $nalto_nivel_cump_ord = $persona['nalto_nivel_cump_ord'];
                                                $nalto_nivel_no_cump = $persona['nalto_nivel_no_cump'];
                                                $salto_nivel_observaciones = $persona['salto_nivel_observaciones'];

                                                $ndesignado_evalu = $persona['ndesignado_evalu'];
                                                $ndesignado_no_evalu = $persona['ndesignado_no_evalu'];
                                                $total_designado = $ndesignado_evalu + $ndesignado_no_evalu;
                                                $ndesignado_excelente = $persona['ndesignado_excelente'];
                                                $ndesignado_muy_bueno = $persona['ndesignado_muy_bueno'];
                                                $ndesignado_bueno = $persona['ndesignado_bueno'];
                                                $ndesignado_cump_ord = $persona['ndesignado_cump_ord'];
                                                $ndesignado_no_cump = $persona['ndesignado_no_cump'];
                                                $ndesignado_observaciones = $persona['ndesignado_observaciones'];

                                                $nempleado_evalu = $persona['nempleado_evalu'];
                                                $nempleado_no_evalu = $persona['nempleado_no_evalu'];
                                                $total_empleado = $nempleado_evalu + $nempleado_no_evalu;
                                                $nempleado_excelente = $persona['nempleado_excelente'];
                                                $nempleado_muy_bueno = $persona['nempleado_muy_bueno'];
                                                $nempleado_bueno = $persona['nempleado_bueno'];
                                                $nempleado_cump_ord = $persona['nempleado_cump_ord'];
                                                $nempleado_no_cump = $persona['nempleado_no_cump'];
                                                $nempleado_observaciones = $persona['nempleado_observaciones'];

                                                $nobrero_evalu = $persona['nobrero_evalu'];
                                                $nobrero_no_evalu = $persona['nobrero_no_evalu'];
                                                $total_obrero = $nobrero_evalu + $nobrero_no_evalu;
                                                $nobrero_excelente = $persona['nobrero_excelente'];
                                                $nobrero_muy_bueno = $persona['nobrero_muy_bueno'];
                                                $nobrero_bueno = $persona['nobrero_bueno'];
                                                $nobrero_cump_ord = $persona['nobrero_cump_ord'];
                                                $nobrero_no_cump = $persona['nobrero_no_cump'];
                                                $nobrero_observaciones = $persona['nobrero_observaciones'];

                                                $ncom_servicio_evalu = $persona['ncom_servicio_evalu'];
                                                $ncom_servicio_no_evalu = $persona['ncom_servicio_no_evalu'];
                                                $total_com_servicio = $ncom_servicio_evalu + $ncom_servicio_no_evalu;
                                                $ncom_servicio_excelente = $persona['ncom_servicio_excelente'];
                                                $ncom_servicio_muy_bueno = $persona['ncom_servicio_muy_bueno'];
                                                $ncom_servicio_bueno = $persona['ncom_servicio_bueno'];
                                                $ncom_servicio_cump_ord = $persona['ncom_servicio_cump_ord'];
                                                $ncom_servicio_no_cump = $persona['ncom_servicio_no_cump'];
                                                $ncom_servicio_observaciones = $persona['ncom_servicio_observaciones'];

                                                $total_f1 = $nalto_nivel_evalu + $ndesignado_evalu + $nempleado_evalu + $nobrero_evalu + $ncom_servicio_evalu;
                                                $total_f2 = $nalto_nivel_no_evalu + $ndesignado_no_evalu + $nempleado_no_evalu + $nobrero_no_evalu + $ncom_servicio_no_evalu;
                                                $total_f3 = $total_alto_nivel + $total_designado + $total_empleado + $total_obrero + $total_com_servicio;
                                                $total_f4 = $nalto_nivel_exc + $ndesignado_excelente + $nempleado_excelente + $nobrero_excelente + $ncom_servicio_excelente;
                                                $total_f5 = $nalto_nivel_muy_bueno + $ndesignado_muy_bueno + $nempleado_muy_bueno + $nobrero_muy_bueno + $ncom_servicio_muy_bueno;
                                                $total_f6 = $nalto_nivel_bueno + $ndesignado_bueno + $nempleado_bueno + $nobrero_bueno + $ncom_servicio_bueno;
                                                $total_f7 = $nalto_nivel_cump_ord + $ndesignado_cump_ord + $nempleado_cump_ord + $nobrero_cump_ord + $ncom_servicio_cump_ord;
                                                $total_f8 = $nalto_nivel_no_cump + $ndesignado_no_cump + $nempleado_no_cump + $nobrero_no_cump + $ncom_servicio_no_cump;
                                                $cosa .= "
                                                    
                                                <tr>
                                                    <td class=\"td\"><b> ALTO NIVEL </b></td>
                                                    <td class=\"td center\"> $nalto_nivel_evalu </td>
                                                    <td class=\"td center\"> $nalto_nivel_no_evalu </td>
                                                    <td class=\"td center\"> $total_alto_nivel </td>
                                                    <td class=\"td center\"> $nalto_nivel_exc </td>
                                                    <td class=\"td center\"> $nalto_nivel_muy_bueno </td>
                                                    <td class=\"td center\"> $nalto_nivel_bueno </td>
                                                    <td class=\"td center\"> $nalto_nivel_cump_ord </td>
                                                    <td class=\"td center\"> $nalto_nivel_no_cump </td>
                                                    <td class=\"td\"> $salto_nivel_observaciones </td>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> DESIGNADOS (GRADO 99) </b></td>
                                                    <td class=\"td center\"> $ndesignado_evalu </td>
                                                    <td class=\"td center\"> $ndesignado_no_evalu </td>
                                                    <td class=\"td center\"> $total_designado </td>
                                                    <td class=\"td center\"> $ndesignado_excelente </td>
                                                    <td class=\"td center\"> $ndesignado_muy_bueno </td>
                                                    <td class=\"td center\"> $ndesignado_bueno </td>
                                                    <td class=\"td center\"> $ndesignado_cump_ord </td>
                                                    <td class=\"td center\"> $ndesignado_no_cump </td>
                                                    <td class=\"td\"> $ndesignado_observaciones </td>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> EMPLEADOS </b></td>
                                                    <td class=\"td center\"> $nempleado_evalu </td>
                                                    <td class=\"td center\"> $nempleado_no_evalu </td>
                                                    <td class=\"td center\"> $total_empleado </td>
                                                    <td class=\"td center\"> $nempleado_excelente </td>
                                                    <td class=\"td center\"> $nempleado_muy_bueno </td>
                                                    <td class=\"td center\"> $nempleado_bueno </td>
                                                    <td class=\"td center\"> $nempleado_cump_ord </td>
                                                    <td class=\"td center\"> $nempleado_no_cump </td>
                                                    <td class=\"td\"> $nempleado_observaciones </td>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> OBREROS </b></td>
                                                    <td class=\"td center\"> $nobrero_evalu </td>
                                                    <td class=\"td center\"> $nobrero_no_evalu </td>
                                                    <td class=\"td center\"> $total_obrero </td>
                                                    <td class=\"td center\"> $nobrero_excelente </td>
                                                    <td class=\"td center\"> $nobrero_muy_bueno </td>
                                                    <td class=\"td center\"> $nobrero_bueno </td>
                                                    <td class=\"td center\"> $nobrero_cump_ord </td>
                                                    <td class=\"td center\"> $nobrero_no_cump </td>
                                                    <td class=\"td\"> $nobrero_observaciones </td>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> COMISIÓN DE SERVICIOS </b></td>
                                                    <td class=\"td center\"> $ncom_servicio_evalu </td>
                                                    <td class=\"td center\"> $ncom_servicio_no_evalu </td>
                                                    <td class=\"td center\"> $total_com_servicio </td>
                                                    <td class=\"td center\"> $ncom_servicio_excelente </td>
                                                    <td class=\"td center\"> $ncom_servicio_muy_bueno </td>
                                                    <td class=\"td center\"> $ncom_servicio_bueno </td>
                                                    <td class=\"td center\"> $ncom_servicio_cump_ord </td>
                                                    <td class=\"td center\"> $ncom_servicio_no_cump </td>
                                                    <td class=\"td\"> $ncom_servicio_observaciones </td>
                                                </tr>
                                                <tr>
                                                    <th class=\"th\"><b> TOTAL </b></th>
                                                    <th class=\"th center\"><b> $total_f1 </b></th>
                                                    <th class=\"th center\"><b> $total_f2 </b></th>
                                                    <th class=\"th center\"><b> $total_f3 </b></th>
                                                    <th class=\"th center\"><b> $total_f4 </b></th>
                                                    <th class=\"th center\"><b> $total_f5 </b></th>
                                                    <th class=\"th center\"><b> $total_f6 </b></th>
                                                    <th class=\"th center\"><b> $total_f7 </b></th>
                                                    <th class=\"th center\"><b> $total_f8 </b></th>
                                                    <th class=\"th\"><b> </b></th>
                                                </tr>
                                                <tr>
                                                    <th class=\"th\" colspan=\"2\"><b> TOTAL POBLACIÓN = PERSONAL <br> EVALUADO + NO EVALUADO </b></th>
                                                    <th class=\"th center\" colspan=\"2\"><b> $total_f3 </b></th>
                                                    <th class=\"th\" colspan=\"6\"><b> </b></th>
                                                </tr>
                                                <tr>
                                                    <th class=\"th\" colspan=\"4\"><b> TOTAL PERSONAL EVALUADO POR RANGO DE ACTUACIÓN </b></th>
                                                    <th class=\"th\" colspan=\"6\"><b> $total_f3 </b></th>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> Acciones </b></td>
                                                    <td class=\"td center\" colspan=\"10\">
                                                        <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #e99002; border-radius: 30px;\" onclick=\"accion_modificar_entes($id, $nalto_nivel_evalu, $nalto_nivel_no_evalu, $nalto_nivel_exc, $nalto_nivel_muy_bueno, $nalto_nivel_bueno, $nalto_nivel_cump_ord, $nalto_nivel_no_cump, '$salto_nivel_observaciones', $ndesignado_evalu, $ndesignado_no_evalu, $ndesignado_excelente, $ndesignado_muy_bueno, $ndesignado_bueno, $ndesignado_cump_ord, $ndesignado_no_cump, '$ndesignado_observaciones', $nempleado_evalu, $nempleado_no_evalu, $nempleado_excelente, $nempleado_muy_bueno, $nempleado_bueno, $nempleado_cump_ord, $nempleado_no_cump, '$nempleado_observaciones', $nobrero_evalu, $nobrero_no_evalu, $nobrero_excelente, $nobrero_muy_bueno, $nobrero_bueno, $nobrero_cump_ord, $nobrero_no_cump, '$nobrero_observaciones', $ncom_servicio_evalu, $ncom_servicio_no_evalu, $ncom_servicio_excelente, $ncom_servicio_muy_bueno, $ncom_servicio_bueno, $ncom_servicio_cump_ord, $ncom_servicio_no_cump, '$ncom_servicio_observaciones', 1)\">Modificar</button>
                                                        <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar_entes($id, 1)\">Eliminar </button>
                                                    </td>
                                                </tr>
                                                ";
                                                echo $cosa;
                                            }
                                            ?>
                                        </tbody>
                                        <tbody id="fe2">
                                            <tr>
                                                <td class="td" rowspan="9"><b> INCRET </b></td>
                                            </tr>
                                            <?
                                            $sql2 = "SELECT * FROM evaluacion_desemp.evaluacion_entes WHERE nente = '2' AND periodo_eval_id = '$periodo' AND nanno_evalu = '$ayo' AND benabled = 'TRUE'";
                                            $rs2 = pg_query($conn, $sql2);
                                            if (pg_num_rows($rs2) == 0) {
                                                $num_registro2 = 0;
                                            } else {
                                                $num_registro2 = pg_num_rows($rs2);
                                            }

                                            if ($num_registro2 == 0) {
                                            ?>
                                                <tr>
                                                    <td class="td"><b> ALTO NIVEL </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="td"><b> DESIGNADOS (GRADO 99) </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="td"><b> EMPLEADOS </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="td"><b> OBREROS </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="td"><b> COMISIÓN DE SERVICIOS </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <th class="th"><b> TOTAL </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th"><b> </b></th>
                                                </tr>
                                                <tr>
                                                    <th class="th" colspan="2"><b> TOTAL POBLACIÓN = PERSONAL <br> EVALUADO + NO EVALUADO </b></th>
                                                    <th class="th center" colspan="2"><b> 0 </b></th>
                                                    <th class="th" colspan="6"><b> </b></th>
                                                </tr>
                                                <tr>
                                                    <th class="th" colspan="4"><b> TOTAL PERSONAL EVALUADO POR RANGO DE ACTUACIÓN </b></th>
                                                    <th class="th" colspan="6"><b> 0 </b></th>
                                                </tr>
                                            <?
                                            } else {
                                                $SQL2 = "SELECT * FROM evaluacion_desemp.evaluacion_entes WHERE nente = '2' AND periodo_eval_id = '$periodo' AND nanno_evalu = '$ayo' AND benabled = 'TRUE'";
                                                $row2 = pg_query($conn, $SQL2);
                                                $persona2 = pg_fetch_assoc($row2);

                                                $id2 = $persona2["id"];

                                                $nalto_nivel_evalu2 = $persona2['nalto_nivel_evalu'];
                                                $nalto_nivel_no_evalu2 = $persona2['nalto_nivel_no_evalu'];
                                                $total_alto_nivel2 = $nalto_nivel_evalu2 + $nalto_nivel_no_evalu2;
                                                $nalto_nivel_exc2 = $persona2['nalto_nivel_exc'];
                                                $nalto_nivel_muy_bueno2 = $persona2['nalto_nivel_muy_bueno'];
                                                $nalto_nivel_bueno2 = $persona2['nalto_nivel_bueno'];
                                                $nalto_nivel_cump_ord2 = $persona2['nalto_nivel_cump_ord'];
                                                $nalto_nivel_no_cump2 = $persona2['nalto_nivel_no_cump'];
                                                $salto_nivel_observaciones2 = $persona2['salto_nivel_observaciones'];

                                                $ndesignado_evalu2 = $persona2['ndesignado_evalu'];
                                                $ndesignado_no_evalu2 = $persona2['ndesignado_no_evalu'];
                                                $total_designado2 = $ndesignado_evalu2 + $ndesignado_no_evalu2;
                                                $ndesignado_excelente2 = $persona2['ndesignado_excelente'];
                                                $ndesignado_muy_bueno2 = $persona2['ndesignado_muy_bueno'];
                                                $ndesignado_bueno2 = $persona2['ndesignado_bueno'];
                                                $ndesignado_cump_ord2 = $persona2['ndesignado_cump_ord'];
                                                $ndesignado_no_cump2 = $persona2['ndesignado_no_cump'];
                                                $ndesignado_observaciones2 = $persona2['ndesignado_observaciones'];

                                                $nempleado_evalu2 = $persona2['nempleado_evalu'];
                                                $nempleado_no_evalu2 = $persona2['nempleado_no_evalu'];
                                                $total_empleado2 = $nempleado_evalu2 + $nempleado_no_evalu2;
                                                $nempleado_excelente2 = $persona2['nempleado_excelente'];
                                                $nempleado_muy_bueno2 = $persona2['nempleado_muy_bueno'];
                                                $nempleado_bueno2 = $persona2['nempleado_bueno'];
                                                $nempleado_cump_ord2 = $persona2['nempleado_cump_ord'];
                                                $nempleado_no_cump2 = $persona2['nempleado_no_cump'];
                                                $nempleado_observaciones2 = $persona2['nempleado_observaciones'];

                                                $nobrero_evalu2 = $persona2['nobrero_evalu'];
                                                $nobrero_no_evalu2 = $persona2['nobrero_no_evalu'];
                                                $total_obrero2 = $nobrero_evalu2 + $nobrero_no_evalu2;
                                                $nobrero_excelente2 = $persona2['nobrero_excelente'];
                                                $nobrero_muy_bueno2 = $persona2['nobrero_muy_bueno'];
                                                $nobrero_bueno2 = $persona2['nobrero_bueno'];
                                                $nobrero_cump_ord2 = $persona2['nobrero_cump_ord'];
                                                $nobrero_no_cump2 = $persona2['nobrero_no_cump'];
                                                $nobrero_observaciones2 = $persona2['nobrero_observaciones'];

                                                $ncom_servicio_evalu2 = $persona2['ncom_servicio_evalu'];
                                                $ncom_servicio_no_evalu2 = $persona2['ncom_servicio_no_evalu'];
                                                $total_com_servicio2 = $ncom_servicio_evalu2 + $ncom_servicio_no_evalu2;
                                                $ncom_servicio_excelente2 = $persona2['ncom_servicio_excelente'];
                                                $ncom_servicio_muy_bueno2 = $persona2['ncom_servicio_muy_bueno'];
                                                $ncom_servicio_bueno2 = $persona2['ncom_servicio_bueno'];
                                                $ncom_servicio_cump_ord2 = $persona2['ncom_servicio_cump_ord'];
                                                $ncom_servicio_no_cump2 = $persona2['ncom_servicio_no_cump'];
                                                $ncom_servicio_observaciones2 = $persona2['ncom_servicio_observaciones'];

                                                $total_f1_2 = $nalto_nivel_evalu2 + $ndesignado_evalu2 + $nempleado_evalu2 + $nobrero_evalu2 + $ncom_servicio_evalu2;
                                                $total_f2_2 = $nalto_nivel_no_evalu2 + $ndesignado_no_evalu2 + $nempleado_no_evalu2 + $nobrero_no_evalu2 + $ncom_servicio_no_evalu2;
                                                $total_f3_2 = $total_alto_nivel2 + $total_designado2 + $total_empleado2 + $total_obrero2 + $total_com_servicio2;
                                                $total_f4_2 = $nalto_nivel_exc2 + $ndesignado_excelente2 + $nempleado_excelente2 + $nobrero_excelente2 + $ncom_servicio_excelente2;
                                                $total_f5_2 = $nalto_nivel_muy_bueno2 + $ndesignado_muy_bueno2 + $nempleado_muy_bueno2 + $nobrero_muy_bueno2 + $ncom_servicio_muy_bueno2;
                                                $total_f6_2 = $nalto_nivel_bueno2 + $ndesignado_bueno2 + $nempleado_bueno2 + $nobrero_bueno2 + $ncom_servicio_bueno2;
                                                $total_f7_2 = $nalto_nivel_cump_ord2 + $ndesignado_cump_ord2 + $nempleado_cump_ord2 + $nobrero_cump_ord2 + $ncom_servicio_cump_ord2;
                                                $total_f8_2 = $nalto_nivel_no_cump2 + $ndesignado_no_cump2 + $nempleado_no_cump2 + $nobrero_no_cump2 + $ncom_servicio_no_cump2;

                                                $cosa2 .= "
                                                <tr>
                                                    <td class=\"td\"><b> ALTO NIVEL </b></td>
                                                    <td class=\"td center\"> $nalto_nivel_evalu2 </td>
                                                    <td class=\"td center\"> $nalto_nivel_no_evalu2 </td>
                                                    <td class=\"td center\"> $total_alto_nivel2 </td>
                                                    <td class=\"td center\"> $nalto_nivel_exc2 </td>
                                                    <td class=\"td center\"> $nalto_nivel_muy_bueno2 </td>
                                                    <td class=\"td center\"> $nalto_nivel_bueno2 </td>
                                                    <td class=\"td center\"> $nalto_nivel_cump_ord2 </td>
                                                    <td class=\"td center\"> $nalto_nivel_no_cump2 </td>
                                                    <td class=\"td\"> $salto_nivel_observaciones2 </td>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> DESIGNADOS (GRADO 99) </b></td>
                                                    <td class=\"td center\"> $ndesignado_evalu2 </td>
                                                    <td class=\"td center\"> $ndesignado_no_evalu2 </td>
                                                    <td class=\"td center\"> $total_designado2 </td>
                                                    <td class=\"td center\"> $ndesignado_excelente2 </td>
                                                    <td class=\"td center\"> $ndesignado_muy_bueno2 </td>
                                                    <td class=\"td center\"> $ndesignado_bueno2 </td>
                                                    <td class=\"td center\"> $ndesignado_cump_ord2 </td>
                                                    <td class=\"td center\"> $ndesignado_no_cump2 </td>
                                                    <td class=\"td\"> $ndesignado_observaciones2 </td>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> EMPLEADOS </b></td>
                                                    <td class=\"td center\"> $nempleado_evalu2 </td>
                                                    <td class=\"td center\"> $nempleado_no_evalu2 </td>
                                                    <td class=\"td center\"> $total_empleado2 </td>
                                                    <td class=\"td center\"> $nempleado_excelente2 </td>
                                                    <td class=\"td center\"> $nempleado_muy_bueno2 </td>
                                                    <td class=\"td center\"> $nempleado_bueno2 </td>
                                                    <td class=\"td center\"> $nempleado_cump_ord2 </td>
                                                    <td class=\"td center\"> $nempleado_no_cump2 </td>
                                                    <td class=\"td\"> $nempleado_observaciones2 </td>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> OBREROS </b></td>
                                                    <td class=\"td center\"> $nobrero_evalu2 </td>
                                                    <td class=\"td center\"> $nobrero_no_evalu2 </td>
                                                    <td class=\"td center\"> $total_obrero2 </td>
                                                    <td class=\"td center\"> $nobrero_excelente2 </td>
                                                    <td class=\"td center\"> $nobrero_muy_bueno2 </td>
                                                    <td class=\"td center\"> $nobrero_bueno2 </td>
                                                    <td class=\"td center\"> $nobrero_cump_ord2 </td>
                                                    <td class=\"td center\"> $nobrero_no_cump2 </td>
                                                    <td class=\"td\"> $nobrero_observaciones2 </td>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> COMISIÓN DE SERVICIOS </b></td>
                                                    <td class=\"td center\"> $ncom_servicio_evalu2 </td>
                                                    <td class=\"td center\"> $ncom_servicio_no_evalu2 </td>
                                                    <td class=\"td center\"> $total_com_servicio2 </td>
                                                    <td class=\"td center\"> $ncom_servicio_excelente2 </td>
                                                    <td class=\"td center\"> $ncom_servicio_muy_bueno2 </td>
                                                    <td class=\"td center\"> $ncom_servicio_bueno2 </td>
                                                    <td class=\"td center\"> $ncom_servicio_cump_ord2 </td>
                                                    <td class=\"td center\"> $ncom_servicio_no_cump2 </td>
                                                    <td class=\"td\"> $ncom_servicio_observaciones2 </td>
                                                </tr>
                                                <tr>
                                                    <th class=\"th\"><b> TOTAL </b></th>
                                                    <th class=\"th center\"><b> $total_f1_2 </b></th>
                                                    <th class=\"th center\"><b> $total_f2_2 </b></th>
                                                    <th class=\"th center\"><b> $total_f3_2 </b></th>
                                                    <th class=\"th center\"><b> $total_f4_2 </b></th>
                                                    <th class=\"th center\"><b> $total_f5_2 </b></th>
                                                    <th class=\"th center\"><b> $total_f6_2 </b></th>
                                                    <th class=\"th center\"><b> $total_f7_2 </b></th>
                                                    <th class=\"th center\"><b> $total_f8_2 </b></th>
                                                    <th class=\"th\"><b> </b></th>
                                                </tr>
                                                <tr>
                                                    <th class=\"th\" colspan=\"2\"><b> TOTAL POBLACIÓN = PERSONAL <br> EVALUADO + NO EVALUADO </b></th>
                                                    <th class=\"th center\" colspan=\"2\"><b> $total_f3_2 </b></th>
                                                    <th class=\"th\" colspan=\"6\"><b> </b></th>
                                                </tr>
                                                <tr>
                                                    <th class=\"th\" colspan=\"4\"><b> TOTAL PERSONAL EVALUADO POR RANGO DE ACTUACIÓN </b></th>
                                                    <th class=\"th\" colspan=\"6\"><b> $total_f3_2 </b></th>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> Acciones </b></td>
                                                    <td class=\"td center\" colspan=\"10\">
                                                        <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #e99002; border-radius: 30px;\" onclick=\"accion_modificar_entes( $id2, $nalto_nivel_evalu2, $nalto_nivel_no_evalu2, $nalto_nivel_exc2, $nalto_nivel_muy_bueno2, $nalto_nivel_bueno2, $nalto_nivel_cump_ord2, $nalto_nivel_no_cump2, '$salto_nivel_observaciones2', $ndesignado_evalu2, $ndesignado_no_evalu2, $ndesignado_excelente2, $ndesignado_muy_bueno2, $ndesignado_bueno2, $ndesignado_cump_ord2, $ndesignado_no_cump2, '$ndesignado_observaciones2', $nempleado_evalu2, $nempleado_no_evalu2, $nempleado_excelente2, $nempleado_muy_bueno2, $nempleado_bueno2, $nempleado_cump_ord2, $nempleado_no_cump2, '$nempleado_observaciones2', $nobrero_evalu2, $nobrero_no_evalu2, $nobrero_excelente2, $nobrero_muy_bueno2, $nobrero_bueno2, $nobrero_cump_ord2, $nobrero_no_cump2, '$nobrero_observaciones2', $ncom_servicio_evalu2, $ncom_servicio_no_evalu2, $ncom_servicio_excelente2, $ncom_servicio_muy_bueno2, $ncom_servicio_bueno2, $ncom_servicio_cump_ord2, $ncom_servicio_no_cump2, '$ncom_servicio_observaciones2', 2)\">Modificar</button>
                                                        <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar_entes($id2, 2)\">Eliminar </button>
                                                    </td>
                                                </tr>
                                                ";
                                                echo $cosa2;
                                            }
                                            ?>
                                        </tbody>
                                        <tbody id="fe3">
                                            <tr>
                                                <td class="td" rowspan="9"><b> TSS </b></td>
                                            </tr>
                                            <?


                                            $sql2 = "SELECT * FROM evaluacion_desemp.evaluacion_entes WHERE nente = '3' AND periodo_eval_id = '$periodo' AND nanno_evalu = '$ayo' AND benabled = 'TRUE'";
                                            $rs2 = pg_query($conn, $sql2);
                                            if (pg_num_rows($rs2) == 0) {
                                                $num_registro2 = 0;
                                            } else {
                                                $num_registro2 = pg_num_rows($rs2);
                                            }

                                            if ($num_registro2 == 0) {
                                            ?>
                                                <tr>
                                                    <td class="td"><b> ALTO NIVEL </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="td"><b> DESIGNADOS (GRADO 99) </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="td"><b> EMPLEADOS </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="td"><b> OBREROS </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="td"><b> COMISIÓN DE SERVICIOS </b></td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td center"> 0 </td>
                                                    <td class="td"> </td>
                                                </tr>
                                                <tr>
                                                    <th class="th"><b> TOTAL </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th center"><b> 0 </b></th>
                                                    <th class="th"><b> </b></th>
                                                </tr>
                                                <tr>
                                                    <th class="th" colspan="2"><b> TOTAL POBLACIÓN = PERSONAL <br> EVALUADO + NO EVALUADO </b></th>
                                                    <th class="th center" colspan="2"><b> 0 </b></th>
                                                    <th class="th" colspan="6"><b> </b></th>
                                                </tr>
                                                <tr>
                                                    <th class="th" colspan="4"><b> TOTAL PERSONAL EVALUADO POR RANGO DE ACTUACIÓN </b></th>
                                                    <th class="th" colspan="6"><b> 0 </b></th>
                                                </tr>
                                            <?
                                            } else {
                                                $SQL3 = "SELECT * FROM evaluacion_desemp.evaluacion_entes WHERE nente = '3' AND periodo_eval_id = '$periodo' AND nanno_evalu = '$ayo' AND benabled = 'TRUE'";
                                                $row3 = pg_query($conn, $SQL3);
                                                $persona3 = pg_fetch_assoc($row3);

                                                $id3 = $persona3["id"];

                                                $nalto_nivel_evalu3 = $persona3['nalto_nivel_evalu'];
                                                $nalto_nivel_no_evalu3 = $persona3['nalto_nivel_no_evalu'];
                                                $total_alto_nivel3 = $nalto_nivel_evalu3 + $nalto_nivel_no_evalu3;
                                                $nalto_nivel_exc3 = $persona3['nalto_nivel_exc'];
                                                $nalto_nivel_muy_bueno3 = $persona3['nalto_nivel_muy_bueno'];
                                                $nalto_nivel_bueno3 = $persona3['nalto_nivel_bueno'];
                                                $nalto_nivel_cump_ord3 = $persona3['nalto_nivel_cump_ord'];
                                                $nalto_nivel_no_cump3 = $persona3['nalto_nivel_no_cump'];
                                                $salto_nivel_observaciones3 = $persona3['salto_nivel_observaciones'];

                                                $ndesignado_evalu3 = $persona3['ndesignado_evalu'];
                                                $ndesignado_no_evalu3 = $persona3['ndesignado_no_evalu'];
                                                $total_designado3 = $ndesignado_evalu3 + $ndesignado_no_evalu3;
                                                $ndesignado_excelente3 = $persona3['ndesignado_excelente'];
                                                $ndesignado_muy_bueno3 = $persona3['ndesignado_muy_bueno'];
                                                $ndesignado_bueno3 = $persona3['ndesignado_bueno'];
                                                $ndesignado_cump_ord3 = $persona3['ndesignado_cump_ord'];
                                                $ndesignado_no_cump3 = $persona3['ndesignado_no_cump'];
                                                $ndesignado_observaciones3 = $persona3['ndesignado_observaciones'];

                                                $nempleado_evalu3 = $persona3['nempleado_evalu'];
                                                $nempleado_no_evalu3 = $persona3['nempleado_no_evalu'];
                                                $total_empleado3 = $nempleado_evalu3 + $nempleado_no_evalu3;
                                                $nempleado_excelente3 = $persona3['nempleado_excelente'];
                                                $nempleado_muy_bueno3 = $persona3['nempleado_muy_bueno'];
                                                $nempleado_bueno3 = $persona3['nempleado_bueno'];
                                                $nempleado_cump_ord3 = $persona3['nempleado_cump_ord'];
                                                $nempleado_no_cump3 = $persona3['nempleado_no_cump'];
                                                $nempleado_observaciones3 = $persona3['nempleado_observaciones'];

                                                $nobrero_evalu3 = $persona3['nobrero_evalu'];
                                                $nobrero_no_evalu3 = $persona3['nobrero_no_evalu'];
                                                $total_obrero3 = $nobrero_evalu3 + $nobrero_no_evalu3;
                                                $nobrero_excelente3 = $persona3['nobrero_excelente'];
                                                $nobrero_muy_bueno3 = $persona3['nobrero_muy_bueno'];
                                                $nobrero_bueno3 = $persona3['nobrero_bueno'];
                                                $nobrero_cump_ord3 = $persona3['nobrero_cump_ord'];
                                                $nobrero_no_cump3 = $persona3['nobrero_no_cump'];
                                                $nobrero_observaciones3 = $persona3['nobrero_observaciones'];

                                                $ncom_servicio_evalu3 = $persona3['ncom_servicio_evalu'];
                                                $ncom_servicio_no_evalu3 = $persona3['ncom_servicio_no_evalu'];
                                                $total_com_servicio3 = $ncom_servicio_evalu3 + $ncom_servicio_no_evalu3;
                                                $ncom_servicio_excelente3 = $persona3['ncom_servicio_excelente'];
                                                $ncom_servicio_muy_bueno3 = $persona3['ncom_servicio_muy_bueno'];
                                                $ncom_servicio_bueno3 = $persona3['ncom_servicio_bueno'];
                                                $ncom_servicio_cump_ord3 = $persona3['ncom_servicio_cump_ord'];
                                                $ncom_servicio_no_cump3 = $persona3['ncom_servicio_no_cump'];
                                                $ncom_servicio_observaciones3 = $persona3['ncom_servicio_observaciones'];

                                                $total_f1_3 = $nalto_nivel_evalu3 + $ndesignado_evalu3 + $nempleado_evalu3 + $nobrero_evalu3 + $ncom_servicio_evalu3;
                                                $total_f2_3 = $nalto_nivel_no_evalu3 + $ndesignado_no_evalu3 + $nempleado_no_evalu3 + $nobrero_no_evalu3 + $ncom_servicio_no_evalu3;
                                                $total_f3_3 = $total_alto_nivel3 + $total_designado3 + $total_empleado3 + $total_obrero3 + $total_com_servicio3;
                                                $total_f4_3 = $nalto_nivel_exc3 + $ndesignado_excelente3 + $nempleado_excelente3 + $nobrero_excelente3 + $ncom_servicio_excelente3;
                                                $total_f5_3 = $nalto_nivel_muy_bueno3 + $ndesignado_muy_bueno3 + $nempleado_muy_bueno3 + $nobrero_muy_bueno3 + $ncom_servicio_muy_bueno3;
                                                $total_f6_3 = $nalto_nivel_bueno3 + $ndesignado_bueno3 + $nempleado_bueno3 + $nobrero_bueno3 + $ncom_servicio_bueno3;
                                                $total_f7_3 = $nalto_nivel_cump_ord3 + $ndesignado_cump_ord3 + $nempleado_cump_ord3 + $nobrero_cump_ord3 + $ncom_servicio_cump_ord3;
                                                $total_f8_3 = $nalto_nivel_no_cump3 + $ndesignado_no_cump3 + $nempleado_no_cump3 + $nobrero_no_cump3 + $ncom_servicio_no_cump3;
                                                $cosa3 .= "
                                                    
                                                <tr>
                                                    <td class=\"td\"><b> ALTO NIVEL </b></td>
                                                    <td class=\"td center\"> $nalto_nivel_evalu3 </td>
                                                    <td class=\"td center\"> $nalto_nivel_no_evalu3 </td>
                                                    <td class=\"td center\"> $total_alto_nivel3 </td>
                                                    <td class=\"td center\"> $nalto_nivel_exc3 </td>
                                                    <td class=\"td center\"> $nalto_nivel_muy_bueno3 </td>
                                                    <td class=\"td center\"> $nalto_nivel_bueno3 </td>
                                                    <td class=\"td center\"> $nalto_nivel_cump_ord3 </td>
                                                    <td class=\"td center\"> $nalto_nivel_no_cump3 </td>
                                                    <td class=\"td\"> $salto_nivel_observaciones3 </td>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> DESIGNADOS (GRADO 99) </b></td>
                                                    <td class=\"td center\"> $ndesignado_evalu3 </td>
                                                    <td class=\"td center\"> $ndesignado_no_evalu3 </td>
                                                    <td class=\"td center\"> $total_designado3 </td>
                                                    <td class=\"td center\"> $ndesignado_excelente3 </td>
                                                    <td class=\"td center\"> $ndesignado_muy_bueno3 </td>
                                                    <td class=\"td center\"> $ndesignado_bueno3 </td>
                                                    <td class=\"td center\"> $ndesignado_cump_ord3 </td>
                                                    <td class=\"td center\"> $ndesignado_no_cump3 </td>
                                                    <td class=\"td\"> $ndesignado_observaciones3 </td>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> EMPLEADOS </b></td>
                                                    <td class=\"td center\"> $nempleado_evalu3 </td>
                                                    <td class=\"td center\"> $nempleado_no_evalu3 </td>
                                                    <td class=\"td center\"> $total_empleado3 </td>
                                                    <td class=\"td center\"> $nempleado_excelente3 </td>
                                                    <td class=\"td center\"> $nempleado_muy_bueno3 </td>
                                                    <td class=\"td center\"> $nempleado_bueno3 </td>
                                                    <td class=\"td center\"> $nempleado_cump_ord3 </td>
                                                    <td class=\"td center\"> $nempleado_no_cump3 </td>
                                                    <td class=\"td\"> $nempleado_observaciones3 </td>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> OBREROS </b></td>
                                                    <td class=\"td center\"> $nobrero_evalu3 </td>
                                                    <td class=\"td center\"> $nobrero_no_evalu3 </td>
                                                    <td class=\"td center\"> $total_obrero3 </td>
                                                    <td class=\"td center\"> $nobrero_excelente3 </td>
                                                    <td class=\"td center\"> $nobrero_muy_bueno3 </td>
                                                    <td class=\"td center\"> $nobrero_bueno3 </td>
                                                    <td class=\"td center\"> $nobrero_cump_ord3 </td>
                                                    <td class=\"td center\"> $nobrero_no_cump3 </td>
                                                    <td class=\"td\"> $nobrero_observaciones3 </td>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> COMISIÓN DE SERVICIOS </b></td>
                                                    <td class=\"td center\"> $ncom_servicio_evalu3 </td>
                                                    <td class=\"td center\"> $ncom_servicio_no_evalu3 </td>
                                                    <td class=\"td center\"> $total_com_servicio3 </td>
                                                    <td class=\"td center\"> $ncom_servicio_excelente3 </td>
                                                    <td class=\"td center\"> $ncom_servicio_muy_bueno3 </td>
                                                    <td class=\"td center\"> $ncom_servicio_bueno3 </td>
                                                    <td class=\"td center\"> $ncom_servicio_cump_ord3 </td>
                                                    <td class=\"td center\"> $ncom_servicio_no_cump3 </td>
                                                    <td class=\"td\"> $ncom_servicio_observaciones3 </td>
                                                </tr>
                                                <tr>
                                                    <th class=\"th\"><b> TOTAL </b></th>
                                                    <th class=\"th center\"><b> $total_f1_3 </b></th>
                                                    <th class=\"th center\"><b> $total_f2_3 </b></th>
                                                    <th class=\"th center\"><b> $total_f3_3 </b></th>
                                                    <th class=\"th center\"><b> $total_f4_3 </b></th>
                                                    <th class=\"th center\"><b> $total_f5_3 </b></th>
                                                    <th class=\"th center\"><b> $total_f6_3 </b></th>
                                                    <th class=\"th center\"><b> $total_f7_3 </b></th>
                                                    <th class=\"th center\"><b> $total_f8_3 </b></th>
                                                    <th class=\"th\"><b> </b></th>
                                                </tr>
                                                <tr>
                                                    <th class=\"th\" colspan=\"2\"><b> TOTAL POBLACIÓN = PERSONAL <br> EVALUADO + NO EVALUADO </b></th>
                                                    <th class=\"th center\" colspan=\"2\"><b> $total_f3_3 </b></th>
                                                    <th class=\"th\" colspan=\"6\"><b> </b></th>
                                                </tr>
                                                <tr>
                                                    <th class=\"th\" colspan=\"4\"><b> TOTAL PERSONAL EVALUADO POR RANGO DE ACTUACIÓN </b></th>
                                                    <th class=\"th\" colspan=\"6\"><b> $total_f3_3 </b></th>
                                                </tr>
                                                <tr>
                                                    <td class=\"td\"><b> Acciones </b></td>
                                                    <td class=\"td center\" colspan=\"10\">
                                                        <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #e99002; border-radius: 30px;\" onclick=\"accion_modificar_entes($id3, $nalto_nivel_evalu3, $nalto_nivel_no_evalu3, $nalto_nivel_exc3, $nalto_nivel_muy_bueno3, $nalto_nivel_bueno3, $nalto_nivel_cump_ord3, $nalto_nivel_no_cump3, '$salto_nivel_observaciones3', $ndesignado_evalu3, $ndesignado_no_evalu3, $ndesignado_excelente3, $ndesignado_muy_bueno3, $ndesignado_bueno3, $ndesignado_cump_ord3, $ndesignado_no_cump3, '$ndesignado_observaciones3', $nempleado_evalu3, $nempleado_no_evalu3, $nempleado_excelente3, $nempleado_muy_bueno3, $nempleado_bueno3, $nempleado_cump_ord3, $nempleado_no_cump3, '$nempleado_observaciones3', $nobrero_evalu3, $nobrero_no_evalu3, $nobrero_excelente3, $nobrero_muy_bueno3, $nobrero_bueno3, $nobrero_cump_ord3, $nobrero_no_cump3, '$nobrero_observaciones3', $ncom_servicio_evalu3, $ncom_servicio_no_evalu3, $ncom_servicio_excelente3, $ncom_servicio_muy_bueno3, $ncom_servicio_bueno3, $ncom_servicio_cump_ord3, $ncom_servicio_no_cump3, '$ncom_servicio_observaciones3', 3)\">Modificar</button>
                                                        <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar_entes($id3, 3)\">Eliminar </button>
                                                    </td>
                                                </tr>
                                                ";
                                                echo $cosa3;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr width="100%">
                                <td colspan="4">
                                    <center>
                                        <a href="imprimir2.php" target="_blank">
                                            <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: -8px; margin-left: 5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";'>Imprimir</button>
                                        </a>
                                    </center>
                                </td>
                            </tr>
                        </table>
                </tr>
        </table>
        </td>
        </tr>
        </tbody>
        </table>

        <!-- script -->

        <script src="entes.js"></script>
        <?php include("../footer.php"); ?>