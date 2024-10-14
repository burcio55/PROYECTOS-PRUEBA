<?php
include("../header.php");
include("../mod_hcm/general_LoadCombo.php");

include("BD.php");

$text = $_REQUEST["text"];
$evaluacion_id = $_SESSION["id_eva"];

$SQL = "UPDATE";
$SQL .= " evaluacion_desemp.evaluacion";
$SQL .= " SET";
$SQL .= " sdesacuerdo_evaluado = '$text'";
$SQL .= " WHERE";
$SQL .= " id = '$evaluacion_id'";

if ($resultado = pg_query($conn, $SQL)) {

    $mostrar = '
            <div style="width: 35%; height: auto; padding: 0; border-radius: 30px; position: fixed; margin-top: 30vh; margin-left: 30%; z-index: 50; background-color: white; border: solid 1px gray; display:none" id="alerta">
                <div class="presion" style="margin-top: -11px;">
                    <h4 id="titulo" style="padding: 7px 20px; border-radius: 30px 30px 0 0; background-color: #DC3831; color: white;">Atención</h4>
                    <p id="mensaje" style="text-align: justify; padding: 5px 20px; font-size: 20px; text-align: center;"></p>
                    <button type="button" style="margin-bottom: 20px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onclick="cerrar()">Cerrar</button>
                </div>
            </div>


            <div id="Contenido" align="center" style="overflow:auto">
                <br>
                <table class="tabla" width="95%" height="95%">
                    <tbody>
                        <tr valign="top">
                            <td>
                                <br />
                                <table width="95%" border="0" align="center" class="formulario">
                                    <div style="background-color: white; width: 40%; padding: 20px; border-radius: 30px; border: grey 1px solid; position:absolute; margin-left: 30%; display:none; margin-top: 10%" id="alerta">
                                        <p id="mensaje" style="text-align: justify;"></p>
                                        <button type="button" style="padding: 5px 10px; border-radius: 20px; border: 1px grey solid" onclick="cerrar()">Cerrar</button>
                                    </div>
                                    <script>
                                        document.getElementById("mensaje").style.textAlign = "center";
                                        document.getElementById("mensaje").textContent = "Se guardó Correctamente el Motivo";
                                        document.getElementById("alerta").style.display = "block";
                        
                                        function cerrar(){
                                            document.getElementById("alerta").style.display = "none";
                                            $(location).attr("href","vista.php");
                                        }
                                    </script>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    ';

    echo $mostrar;
}
