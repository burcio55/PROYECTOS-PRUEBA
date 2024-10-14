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
                            </style>
                            <tr>
                                <th colspan="4" class="sub_titulo">
                                    <div align="left">INCIDENCIAS --> Incidencias </div>
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
                                        <input style="border-radius: 30px; border: solid 1px #999999; width:75%; float:left; text-align:center" name="desde" id="desde" type="text" value="<? echo $desde; ?>" placeholder="" readonly />
                                    </font>
                                </td>
                                <th style="color: grey; text-align:right" width="23%">Hasta : </th>
                                <td align="center" style="border-radius: 30px;">
                                    <font color="#666666">
                                        <input style="border-radius: 30px; border: solid 1px #999999; width:50%; float:left; text-align:center" name="hasta" id="hasta" type="text" value="<? echo $hasta; ?>" placeholder="" readonly />
                                    </font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr>

                                <td></td>
                                <td colspan="2">
                                    <label class="form-label"> Incidencias <span class="requid"> * </span></label>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2">
                                    <input style="border-radius: 30px; border: solid 1px #999999; width: 75%; float:left; text-align:center" name="incidencia" id="incidencia" type="text" placeholder="Ej. Reposo Médico" />

                                    <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: -8px; margin-left: 5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_agregar_incidencia(incidencia.value)" id="guardar">
                                        Agregar
                                    </button>
                                    <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: -8px; margin-left: 5px; display: none" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_incidencia_mod(id_incidencia.value,incidencia.value)" id="mod">
                                        Actualizar
                                    </button>
                                    <input type="button" type="text" class="form-control" aria-describedby="basic-addon1" id="id_incidencia" style="display: none">
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table style="width: 100%; border: 2px black solid; border-collapse: collapse; width: 100%; margin: 20px auto;">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="th" style="text-align: center">#</th>
                                                <th scope="col" class="th" style="text-align: center">Incidencias</th>
                                                <th scope="col" class="th" style="text-align: center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="fe">
                                            <?
                                            $i = 0;
                                            $sql = "SELECT * FROM evaluacion_desemp.incidencias WHERE benabled = 'TRUE' Order By sdescripcion";
                                            $row = pg_query($conn, $sql);
                                            $persona = pg_fetch_all($row);

                                            while ($persona = pg_fetch_assoc($row)) {

                                                $i++;
                                                $cosa .= "<tr>
                                                        <td class=\"td center\">" . $i . "</td>
                                                        <td class=\"td center\" style=\"width: 70%;\">" . $persona['sdescripcion'] . "</td>
                                                        <td class=\"td center\" id=\"botones\">
                                                            <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #e99002; border-radius: 30px;\" onclick=\"accion_modificar_incidencia('" . $persona['id'] . "','" . $persona['sdescripcion'] . "')\">Modificar</button>
                                                            <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar_incidencia(" . $persona['id'] . ")\">Eliminar </button>
                                                        </td>
                                                    </tr>
                                                ";
                                            }
                                            echo $cosa;
                                            ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                        </table>
                </tr>
        </table>
        </td>
        </tr>
        </tbody>
        </table>

        <!-- script -->

        <script src="permiso.js"></script>
        <?php include("../footer.php"); ?>