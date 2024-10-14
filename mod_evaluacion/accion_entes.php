<?php
include("BD.php");

$accion = $_REQUEST["accion"];
$id_persona = $_SESSION["id_usuario"];
$periodo = $_SESSION["Periodo"];
$ayo = date('y');

/* echo " 1 / " . $incidencia . " " . $periodo . " " . $id_personas;
die(); */

if ($accion == 1) {

    $nentes = $_REQUEST["nentes"];

    $sql1 = "SELECT * FROM evaluacion_desemp.evaluacion_entes WHERE nente = '$nentes' AND periodo_eval_id = '$periodo' AND nanno_evalu = '$ayo' AND benabled = 'TRUE'";

    /* echo " 0 / " . $sql1;
    die(); */

    $rs1 = pg_query($conn, $sql1);
    if (pg_num_rows($rs1) == 0) {
        $num_registro1 = 0;
    } else {
        $num_registro1 = pg_num_rows($rs1);
    }

    /* echo " 0 / " . $num_registro1;
    die(); */

    if ($num_registro1 > 0) {
        echo " 0 / Ya ingresó esté registro para el campo \"Ente\" para éste Trimestre del año actual";
        die();
    } else {
        $alto_nivel = $_REQUEST["alto_nivel"];
        $alto_nivel_no = $_REQUEST["alto_nivel_no"];
        $alto_nivel_exc = $_REQUEST["alto_nivel_exc"];
        $alto_nivel_m_bueno = $_REQUEST["alto_nivel_m_bueno"];
        $alto_nivel_bueno = $_REQUEST["alto_nivel_bueno"];
        $alto_nivel_ordinario = $_REQUEST["alto_nivel_ordinario"];
        $alto_nivel_no_cump = $_REQUEST["alto_nivel_no_cump"];
        $alto_nivel_sobservaciones = $_REQUEST["alto_nivel_sobservaciones"];
        $designado = $_REQUEST["designado"];
        $designado_no = $_REQUEST["designado_no"];
        $designado_exc = $_REQUEST["designado_exc"];
        $designado_m_bueno = $_REQUEST["designado_m_bueno"];
        $designado_bueno = $_REQUEST["designado_bueno"];
        $designado_ordinario = $_REQUEST["designado_ordinario"];
        $designado_no_cump = $_REQUEST["designado_no_cump"];
        $designado_sobservaciones = $_REQUEST["designado_sobservaciones"];
        $empleado = $_REQUEST["empleado"];
        $empleado_no = $_REQUEST["empleado_no"];
        $empleado_exc = $_REQUEST["empleado_exc"];
        $empleado_m_bueno = $_REQUEST["empleado_m_bueno"];
        $empleado_bueno = $_REQUEST["empleado_bueno"];
        $empleado_ordinario = $_REQUEST["empleado_ordinario"];
        $empleado_no_cump = $_REQUEST["empleado_no_cump"];
        $empleado_sobservaciones = $_REQUEST["empleado_sobservaciones"];
        $obreros = $_REQUEST["obreros"];
        $obreros_no = $_REQUEST["obreros_no"];
        $obreros_exc = $_REQUEST["obreros_exc"];
        $obreros_m_bueno = $_REQUEST["obreros_m_bueno"];
        $obreros_bueno = $_REQUEST["obreros_bueno"];
        $obreros_ordinario = $_REQUEST["obreros_ordinario"];
        $obreros_no_cump = $_REQUEST["obreros_no_cump"];
        $obreros_sobservaciones = $_REQUEST["obreros_sobservaciones"];
        $c_servicios = $_REQUEST["c_servicios"];
        $c_servicios_no = $_REQUEST["c_servicios_no"];
        $c_servicios_exc = $_REQUEST["c_servicios_exc"];
        $c_servicios_m_bueno = $_REQUEST["c_servicios_m_bueno"];
        $c_servicios_bueno = $_REQUEST["c_servicios_bueno"];
        $c_servicios_ordinario = $_REQUEST["c_servicios_ordinario"];
        $c_servicios_no_cump = $_REQUEST["c_servicios_no_cump"];
        $c_servicios_sobservaciones = $_REQUEST["c_servicios_sobservaciones"];

        $SQL = "INSERT INTO";
        $SQL .= " evaluacion_desemp.evaluacion_entes";
        $SQL .= " (";
        $SQL .= " nente,";
        $SQL .= " periodo_eval_id,";
        $SQL .= " nanno_evalu,";
        $SQL .= " nalto_nivel_evalu,";
        $SQL .= " nalto_nivel_no_evalu,";
        $SQL .= " nalto_nivel_exc,";
        $SQL .= " nalto_nivel_muy_bueno,";
        $SQL .= " nalto_nivel_bueno,";
        $SQL .= " nalto_nivel_cump_ord,";
        $SQL .= " nalto_nivel_no_cump,";
        $SQL .= " salto_nivel_observaciones,";
        $SQL .= " ndesignado_evalu,";
        $SQL .= " ndesignado_no_evalu,";
        $SQL .= " ndesignado_excelente,";
        $SQL .= " ndesignado_muy_bueno,";
        $SQL .= " ndesignado_bueno,";
        $SQL .= " ndesignado_cump_ord,";
        $SQL .= " ndesignado_no_cump,";
        $SQL .= " ndesignado_observaciones,";
        $SQL .= " nempleado_evalu,";
        $SQL .= " nempleado_no_evalu,";
        $SQL .= " nempleado_excelente,";
        $SQL .= " nempleado_muy_bueno,";
        $SQL .= " nempleado_bueno,";
        $SQL .= " nempleado_cump_ord,";
        $SQL .= " nempleado_no_cump,";
        $SQL .= " nempleado_observaciones,";
        $SQL .= " nobrero_evalu,";
        $SQL .= " nobrero_no_evalu,";
        $SQL .= " nobrero_excelente,";
        $SQL .= " nobrero_muy_bueno,";
        $SQL .= " nobrero_bueno,";
        $SQL .= " nobrero_cump_ord,";
        $SQL .= " nobrero_no_cump,";
        $SQL .= " nobrero_observaciones,";
        $SQL .= " ncom_servicio_evalu,";
        $SQL .= " ncom_servicio_no_evalu,";
        $SQL .= " ncom_servicio_excelente,";
        $SQL .= " ncom_servicio_muy_bueno,";
        $SQL .= " ncom_servicio_bueno,";
        $SQL .= " ncom_servicio_cump_ord,";
        $SQL .= " ncom_servicio_no_cump,";
        $SQL .= " ncom_servicio_observaciones,";
        $SQL .= " nusuario_creacion";
        $SQL .= ")";
        $SQL .= " VALUES";
        $SQL .= " (";
        $SQL .= "'$nentes',";
        $SQL .= "'$periodo',";
        $SQL .= "'$ayo',";
        $SQL .= "'$alto_nivel',";
        $SQL .= "'$alto_nivel_no',";
        $SQL .= "'$alto_nivel_exc',";
        $SQL .= "'$alto_nivel_m_bueno',";
        $SQL .= "'$alto_nivel_bueno',";
        $SQL .= "'$alto_nivel_ordinario',";
        $SQL .= "'$alto_nivel_no_cump',";
        $SQL .= "'$alto_nivel_sobservaciones',";
        $SQL .= "'$designado',";
        $SQL .= "'$designado_no',";
        $SQL .= "'$designado_exc',";
        $SQL .= "'$designado_m_bueno',";
        $SQL .= "'$designado_bueno',";
        $SQL .= "'$designado_ordinario',";
        $SQL .= "'$designado_no_cump',";
        $SQL .= "'$designado_sobservaciones',";
        $SQL .= "'$empleado',";
        $SQL .= "'$empleado_no',";
        $SQL .= "'$empleado_exc',";
        $SQL .= "'$empleado_m_bueno',";
        $SQL .= "'$empleado_bueno',";
        $SQL .= "'$empleado_ordinario',";
        $SQL .= "'$empleado_no_cump',";
        $SQL .= "'$empleado_sobservaciones',";
        $SQL .= "'$obreros',";
        $SQL .= "'$obreros_no',";
        $SQL .= "'$obreros_exc',";
        $SQL .= "'$obreros_m_bueno',";
        $SQL .= "'$obreros_bueno',";
        $SQL .= "'$obreros_ordinario',";
        $SQL .= "'$obreros_no_cump',";
        $SQL .= "'$obreros_sobservaciones',";
        $SQL .= "'$c_servicios',";
        $SQL .= "'$c_servicios_no',";
        $SQL .= "'$c_servicios_exc',";
        $SQL .= "'$c_servicios_m_bueno',";
        $SQL .= "'$c_servicios_bueno',";
        $SQL .= "'$c_servicios_ordinario',";
        $SQL .= "'$c_servicios_no_cump',";
        $SQL .= "'$c_servicios_sobservaciones',";
        $SQL .= "'$id_persona'";
        $SQL .= ");";

        if ($resultado = pg_query($conn, $SQL)) {
            if ($nentes == 1) {
                $cosa = "
                    <tr>
                        <td class=\"td\" rowspan=\"9\"><b> INPSASEL </b></td>
                    </tr>
                ";

                $SQL1 = "SELECT * FROM evaluacion_desemp.evaluacion_entes WHERE nente = '$nentes' AND periodo_eval_id = '$periodo' AND nanno_evalu = '$ayo' AND benabled = 'TRUE'";
                $row1 = pg_query($conn, $SQL1);
                $persona = pg_fetch_assoc($row1);

                $id = $persona["id"];

                $nalto_nivel_evalu = $persona['nalto_nivel_evalu'];
                $nalto_nivel_no_evalu = $persona['nalto_nivel_no_evalu'];
                $total_alto_nivel = $nalto_nivel_evalu + $nalto_nivel_evalu;
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
                $total_obrero = $nempleado_evalu + $nempleado_no_evalu;
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
                                <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #e99002; border-radius: 30px;\" onclick=\"accion_modificar_entes()\">Modificar</button>
                                <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar_entes($id,1)\">Eliminar </button>
                            </td>
                        </tr>
                ";

                echo "1 / Se agregó correctamente" . " / " . $cosa;
                die();
            } else
            if ($nentes == 2) {
                $cosa = "
                    <tr>
                        <td class=\"td\" rowspan=\"9\"><b> INCRET </b></td>
                    </tr>
                ";

                $SQL2 = "SELECT * FROM evaluacion_desemp.evaluacion_entes WHERE nente = '$nentes' AND periodo_eval_id = '$periodo' AND nanno_evalu = '$ayo' AND benabled = 'TRUE'";
                $row2 = pg_query($conn, $SQL2);
                $persona2 = pg_fetch_assoc($row2);

                $id2 = $persona2["id"];

                $nalto_nivel_evalu2 = $persona2['nalto_nivel_evalu'];
                $nalto_nivel_no_evalu2 = $persona2['nalto_nivel_no_evalu'];
                $total_alto_nivel2 = $nalto_nivel_evalu2 + $nalto_nivel_evalu2;
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
                $total_obrero2 = $nempleado_evalu2 + $nempleado_no_evalu2;
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
                                <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #e99002; border-radius: 30px;\" onclick=\"accion_modificar_entes()\">Modificar</button>
                                <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar_entes($id2,2)\">Eliminar </button>
                            </td>
                        </tr>
                ";

                echo "1 / Se agregó correctamente" . " / " . $cosa2;
                die();
            } else
            if ($nentes == 3) {
                $cosa = "
                    <tr>
                        <td class=\"td\" rowspan=\"9\"><b> TSS </b></td>
                    </tr>
                ";

                $SQL3 = "SELECT * FROM evaluacion_desemp.evaluacion_entes WHERE nente = '$nentes' AND periodo_eval_id = '$periodo' AND nanno_evalu = '$ayo' AND benabled = 'TRUE'";
                $row3 = pg_query($conn, $SQL3);
                $persona3 = pg_fetch_assoc($row3);

                $id3 = $persona3["id"];

                $nalto_nivel_evalu3 = $persona3['nalto_nivel_evalu'];
                $nalto_nivel_no_evalu3 = $persona3['nalto_nivel_no_evalu'];
                $total_alto_nivel3 = $nalto_nivel_evalu3 + $nalto_nivel_evalu3;
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
                $total_obrero3 = $nempleado_evalu3 + $nempleado_no_evalu3;
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
                                <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #e99002; border-radius: 30px;\" onclick=\"accion_modificar_entes()\">Modificar</button>
                                <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar_entes($id3,3)\">Eliminar </button>
                            </td>
                        </tr>
                ";

                echo "1 / Se agregó correctamente" . " / " . $cosa3;
                die();
            }
        } else {
            echo "0 / Falló la inserción, razón: " . $SQL;
            die();
        }
    }
} else
if ($accion == 2) {
    $id_eva = $_REQUEST["id"];

    $SQL2 = "UPDATE evaluacion_desemp.evaluacion_entes SET benabled = 'FALSE' WHERE id = '" . $id_eva . "'";

    if ($resultado2 = pg_query($conn, $SQL2)) {
        if ($nentes == 1) {
            $cosa4 = "
                <tr>
                    <td class=\"td\" rowspan=\"9\"><b> INPSASEL </b></td>
                </tr>
            ";

            $cosa4 .= "   
                    <tr>
                        <td class=\"td\"><b> ALTO NIVEL </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <td class=\"td\"><b> DESIGNADOS (GRADO 99) </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <td class=\"td\"><b> EMPLEADOS </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <td class=\"td\"><b> OBREROS </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <td class=\"td\"><b> COMISIÓN DE SERVICIOS </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <th class=\"th\"><b> TOTAL </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th\"><b> </b></th>
                    </tr>
                    <tr>
                        <th class=\"th\" colspan=\"2\"><b> TOTAL POBLACIÓN = PERSONAL <br> EVALUADO + NO EVALUADO </b></th>
                        <th class=\"th center\" colspan=\"2\"><b> 0 </b></th>
                        <th class=\"th\" colspan=\"6\"><b> </b></th>
                    </tr>
                    <tr>
                        <th class=\"th\" colspan=\"4\"><b> TOTAL PERSONAL EVALUADO POR RANGO DE ACTUACIÓN </b></th>
                        <th class=\"th\" colspan=\"6\"><b> 0 </b></th>
                    </tr>
            ";

            echo "1 / Se eliminó correctamente" . " / " . $cosa4;
            die();
        } else
        if ($nentes == 2) {
            $cosa5 = "
                <tr>
                    <td class=\"td\" rowspan=\"9\"><b> INCRET </b></td>
                </tr>
            ";

            $cosa5 .= "
                    <tr>
                        <td class=\"td\"><b> ALTO NIVEL </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <td class=\"td\"><b> DESIGNADOS (GRADO 99) </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <td class=\"td\"><b> EMPLEADOS </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <td class=\"td\"><b> OBREROS </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <td class=\"td\"><b> COMISIÓN DE SERVICIOS </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <th class=\"th\"><b> TOTAL </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th\"><b> </b></th>
                    </tr>
                    <tr>
                        <th class=\"th\" colspan=\"2\"><b> TOTAL POBLACIÓN = PERSONAL <br> EVALUADO + NO EVALUADO </b></th>
                        <th class=\"th center\" colspan=\"2\"><b> 0 </b></th>
                        <th class=\"th\" colspan=\"6\"><b> </b></th>
                    </tr>
                    <tr>
                        <th class=\"th\" colspan=\"4\"><b> TOTAL PERSONAL EVALUADO POR RANGO DE ACTUACIÓN </b></th>
                        <th class=\"th\" colspan=\"6\"><b> 0 </b></th>
                    </tr>
            ";

            echo "1 / Se eliminó correctamente" . " / " . $cosa5;
            die();
        } else
        if ($nentes == 3) {
            $cosa6 = "
                <tr>
                    <td class=\"td\" rowspan=\"9\"><b> TSS </b></td>
                </tr>
            ";

            $cosa6 .= "
                    <tr>
                        <td class=\"td\"><b> ALTO NIVEL </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <td class=\"td\"><b> DESIGNADOS (GRADO 99) </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <td class=\"td\"><b> EMPLEADOS </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <td class=\"td\"><b> OBREROS </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <td class=\"td\"><b> COMISIÓN DE SERVICIOS </b></td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td center\"> 0 </td>
                        <td class=\"td\">  </td>
                    </tr>
                    <tr>
                        <th class=\"th\"><b> TOTAL </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th center\"><b> 0 </b></th>
                        <th class=\"th\"><b> </b></th>
                    </tr>
                    <tr>
                        <th class=\"th\" colspan=\"2\"><b> TOTAL POBLACIÓN = PERSONAL <br> EVALUADO + NO EVALUADO </b></th>
                        <th class=\"th center\" colspan=\"2\"><b> 0 </b></th>
                        <th class=\"th\" colspan=\"6\"><b> </b></th>
                    </tr>
                    <tr>
                        <th class=\"th\" colspan=\"4\"><b> TOTAL PERSONAL EVALUADO POR RANGO DE ACTUACIÓN </b></th>
                        <th class=\"th\" colspan=\"6\"><b> 0 </b></th>
                    </tr>
            ";

            echo "1 / Se eliminó correctamente" . " / " . $cosa6;
            die();
        }
    } else {
        echo "0 / Falló la eliminación, razón: " . $SQL2;
        die();
    }
} else
if ($accion == 3) {

    $id_usuario = $_SESSION["id_usuario"];

    $id_nentes = $_REQUEST["id_nentes"];
    $nentes = $_REQUEST["nentes"];

    $alto_nivel = $_REQUEST["alto_nivel"];
    $alto_nivel_no = $_REQUEST["alto_nivel_no"];
    $alto_nivel_exc = $_REQUEST["alto_nivel_exc"];
    $alto_nivel_m_bueno = $_REQUEST["alto_nivel_m_bueno"];
    $alto_nivel_bueno = $_REQUEST["alto_nivel_bueno"];
    $alto_nivel_ordinario = $_REQUEST["alto_nivel_ordinario"];
    $alto_nivel_no_cump = $_REQUEST["alto_nivel_no_cump"];
    $alto_nivel_sobservaciones = $_REQUEST["alto_nivel_sobservaciones"];

    $designado = $_REQUEST["designado"];
    $designado_no = $_REQUEST["designado_no"];
    $designado_exc = $_REQUEST["designado_exc"];
    $designado_m_bueno = $_REQUEST["designado_m_bueno"];
    $designado_bueno = $_REQUEST["designado_bueno"];
    $designado_ordinario = $_REQUEST["designado_ordinario"];
    $designado_no_cump = $_REQUEST["designado_no_cump"];
    $designado_sobservaciones = $_REQUEST["designado_sobservaciones"];

    $empleado = $_REQUEST["empleado"];
    $empleado_no = $_REQUEST["empleado_no"];
    $empleado_exc = $_REQUEST["empleado_exc"];
    $empleado_m_bueno = $_REQUEST["empleado_m_bueno"];
    $empleado_bueno = $_REQUEST["empleado_bueno"];
    $empleado_ordinario = $_REQUEST["empleado_ordinario"];
    $empleado_no_cump = $_REQUEST["empleado_no_cump"];
    $empleado_sobservaciones = $_REQUEST["empleado_sobservaciones"];

    $obreros = $_REQUEST["obreros"];
    $obreros_no = $_REQUEST["obreros_no"];
    $obreros_exc = $_REQUEST["obreros_exc"];
    $obreros_m_bueno = $_REQUEST["obreros_m_bueno"];
    $obreros_bueno = $_REQUEST["obreros_bueno"];
    $obreros_ordinario = $_REQUEST["obreros_ordinario"];
    $obreros_no_cump = $_REQUEST["obreros_no_cump"];
    $obreros_sobservaciones = $_REQUEST["obreros_sobservaciones"];

    $c_servicios = $_REQUEST["c_servicios"];
    $c_servicios_no = $_REQUEST["c_servicios_no"];
    $c_servicios_exc = $_REQUEST["c_servicios_exc"];
    $c_servicios_m_bueno = $_REQUEST["c_servicios_m_bueno"];
    $c_servicios_bueno = $_REQUEST["c_servicios_bueno"];
    $c_servicios_ordinario = $_REQUEST["c_servicios_ordinario"];
    $c_servicios_no_cump = $_REQUEST["c_servicios_no_cump"];
    $c_servicios_sobservaciones = $_REQUEST["c_servicios_sobservaciones"];

    /* echo " 1 / " . $id_nentes . " " . $alto_nivel . " " . $alto_nivel_no . " " . $alto_nivel_exc . " " . $alto_nivel_m_bueno . " " . $alto_nivel_bueno . " " . $alto_nivel_ordinario . " " . $alto_nivel_no_cump . " " . $alto_nivel_sobservaciones . " " . $designado . " " . $designado_no . " " . $designado_exc . " " . $designado_m_bueno . " " . $designado_bueno . " " . $designado_ordinario . " " . $designado_no_cump . " " . $designado_sobservaciones . " " . $empleado . " " . $empleado_no . " " . $empleado_exc . " " . $empleado_m_bueno . " " . $empleado_bueno . " " . $empleado_ordinario . " " . $empleado_no_cump . " " . $empleado_sobservaciones . " " . $obreros . " " . $obreros_no . " " . $obreros_exc . " " . $obreros_m_bueno . " " . $obreros_bueno . " " . $obreros_ordinario . " " . $obreros_no_cump . " " . $obreros_sobservaciones . " " . $c_servicios . " " . $c_servicios_no . " " . $c_servicios_exc . " " . $c_servicios_m_bueno . " " . $c_servicios_bueno . " " . $c_servicios_ordinario . " " . $c_servicios_no_cump . " " . $c_servicios_sobservaciones;
    die(); */

    $SQL3 = "UPDATE";
    $SQL3 .= " evaluacion_desemp.evaluacion_entes";
    $SQL3 .= " SET";
    $SQL3 .= " nente = '" . $nentes . "',";
    $SQL3 .= " nalto_nivel_evalu = '" . $alto_nivel . "',";
    $SQL3 .= " nalto_nivel_no_evalu = '" . $alto_nivel_no . "',";
    $SQL3 .= " nalto_nivel_exc = '" . $alto_nivel_exc . "',";
    $SQL3 .= " nalto_nivel_muy_bueno = '" . $alto_nivel_m_bueno . "',";
    $SQL3 .= " nalto_nivel_bueno = '" . $alto_nivel_bueno . "',";
    $SQL3 .= " nalto_nivel_cump_ord = '" . $alto_nivel_ordinario . "',";
    $SQL3 .= " nalto_nivel_no_cump = '" . $alto_nivel_no_cump . "',";
    $SQL3 .= " salto_nivel_observaciones = '" . $alto_nivel_sobservaciones . "',";
    $SQL3 .= " ndesignado_evalu = '" . $designado . "',";
    $SQL3 .= " ndesignado_no_evalu = '" . $designado_no . "',";
    $SQL3 .= " ndesignado_excelente = '" . $designado_exc . "',";
    $SQL3 .= " ndesignado_muy_bueno = '" . $designado_m_bueno . "',";
    $SQL3 .= " ndesignado_bueno = '" . $designado_bueno . "',";
    $SQL3 .= " ndesignado_cump_ord = '" . $designado_ordinario . "',";
    $SQL3 .= " ndesignado_no_cump = '" . $designado_no_cump . "',";
    $SQL3 .= " ndesignado_observaciones = '" . $designado_sobservaciones . "',";
    $SQL3 .= " nempleado_evalu = '" . $empleado . "',";
    $SQL3 .= " nempleado_no_evalu = '" . $empleado_no . "',";
    $SQL3 .= " nempleado_excelente = '" . $empleado_exc . "',";
    $SQL3 .= " nempleado_muy_bueno = '" . $empleado_m_bueno . "',";
    $SQL3 .= " nempleado_bueno = '" . $empleado_bueno . "',";
    $SQL3 .= " nempleado_cump_ord = '" . $empleado_ordinario . "',";
    $SQL3 .= " nempleado_no_cump = '" . $empleado_no_cump . "',";
    $SQL3 .= " nempleado_observaciones = '" . $empleado_sobservaciones . "',";
    $SQL3 .= " nobrero_evalu = '" . $obreros . "',";
    $SQL3 .= " nobrero_no_evalu = '" . $obreros_no . "',";
    $SQL3 .= " nobrero_excelente = '" . $obreros_exc . "',";
    $SQL3 .= " nobrero_muy_bueno = '" . $obreros_m_bueno . "',";
    $SQL3 .= " nobrero_bueno = '" . $obreros_bueno . "',";
    $SQL3 .= " nobrero_cump_ord = '" . $obreros_ordinario . "',";
    $SQL3 .= " nobrero_no_cump = '" . $obreros_no_cump . "',";
    $SQL3 .= " nobrero_observaciones = '" . $obreros_sobservaciones . "',";
    $SQL3 .= " ncom_servicio_evalu = '" . $c_servicios . "',";
    $SQL3 .= " ncom_servicio_no_evalu = '" . $c_servicios_no . "',";
    $SQL3 .= " ncom_servicio_excelente = '" . $c_servicios_exc . "',";
    $SQL3 .= " ncom_servicio_muy_bueno = '" . $c_servicios_m_bueno . "',";
    $SQL3 .= " ncom_servicio_bueno = '" . $c_servicios_bueno . "',";
    $SQL3 .= " ncom_servicio_cump_ord = '" . $c_servicios_ordinario . "',";
    $SQL3 .= " ncom_servicio_no_cump = '" . $c_servicios_no_cump . "',";
    $SQL3 .= " ncom_servicio_observaciones = '" . $c_servicios_sobservaciones . "',";
    $SQL3 .= " nusuario_actualizacion = '" . $id_usuario . "'";
    $SQL3 .= " WHERE";
    $SQL3 .= " id = '" . $id_nentes . "'";

    /* echo " 1 / " . $SQL3;
    die(); */

    if ($resultado3 = pg_query($conn, $SQL3)) {
        echo " 1 / Se realizó correctamente la actualización";
        die();
    } else {
        echo " 0 / Falló la actualización por: " . $SQL3;
        die();
    }
}
