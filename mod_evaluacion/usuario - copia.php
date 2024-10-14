<?php
include("../header.php");
include("../mod_hcm/general_LoadCombo.php");

include("BD.php");

?>
<div style="background-color: white; width: 40%; padding: 20px; border-radius: 30px; border: grey 1px solid; position:absolute; margin-left: 30%; display:none; margin-top: 10%" id="alerta">
    <p id="mensaje" style="text-align: justify;"></p>
    <button type="button" style="padding: 5px 10px; border-radius: 20px; border: 1px grey solid" onclick="cerrar()">Cerrar</button>
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
                            <tr>
                                <th colspan="4" class="sub_titulo">
                                    <div align="left">MANTENIMIENTO --> Usuarios </div>
                                </th>
                            <tr>
                                <td colspan="4" align="right"><span class="requerido">Campos Obligatorios (*)</span></td>
                            </tr>
                            <tr class="identificacion_seccion">
                                <th colspan="4" class="sub_titulo_2" width="100%" align="center" style="background-color: #D0E0F4; padding: 5px; border-radius: 30px; color: #1060C8;">
                                    DATOS B&Aacute;SICOS</th>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr style="margin-top: 30px;">
                                <th style="color: grey;" width="23%">Cédula de Identidad</th>
                                <td style="border-radius: 30px;">
                                    <font color="#666666">
                                        <input style="border-radius: 30px; border-color: #999999; width: 50%; float: left;" maxlength="8" name="cedula2" id="cedula2" type="text" value="" placeholder="" />
                                        <span class="requerido" style="float: left"> * </span>
                                    </font>
                                </td>
                                <td>
                                    <center>
                                        <button type="button" style="padding: 5px 10px; border-radius: 20px; border: 1px grey solid;" onclick="buscar(1)">BUSCAR</button>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <th style="color: grey" width="23%">Apellido(s) y Nombre(s)</th>
                                <td align="center" style="border-radius: 30px;" colspan="3">
                                    <font color="#666666">
                                        <input style="border-radius: 30px; border-color: #999999; width: 93%; float: left;" name="nombre_apellido2" id="nombre_apellido2" type="text" value="" placeholder="" readonly />
                                    </font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <th style="color: grey;" width="23%">Rol Asignado</th>
                                <td align="center" style="border-radius: 30px;">
                                    <font color="#666666">
                                        <select style="border-radius: 30px; border-color: #999999; width: 50%; float: left" id="rol" name="rol">
                                            <option value="-1">Seleccione </option>
                                            <option value="84">Administrador </option>
                                            <option value="85">Analista </option>
                                            <option value="86">Evaluador </option>
                                            <option value="87">Evaluado </option>
                                        </select>
                                        <span class="requerido" style="float: left"> * </span>
                                    </font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <center>
                                        <button type="button" style="padding: 5px 10px; border-radius: 20px; border: 1px grey solid;" onclick="asignar()">GUARDAR</button>
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

        <script src="funcion_rol.js"></script>
        <?php include("../footer.php"); ?>