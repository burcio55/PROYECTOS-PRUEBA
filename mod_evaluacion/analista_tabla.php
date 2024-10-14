<?php
include("header.php");
include("BD.php");
?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.css" />

<main>
    <div class="content-3d">

        <div class="container">
            <?
            include('menu2.php');
            ?>

            <div class="content-login">
                <div class="row">
                    <div class="col-sm-8">
                        <h1 style="font-size:32px; font-weight: normal;">MANTENIMIENTO - Evaluaciones por Analizar</h1>
                    </div>
                    <div class="col-sm-4"></div>


                    <div class="sep"></div>

                    <hr>
                    <div class="sep"></div>

                    <form name="formulario" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" id="formulario">
                        <div id="Contenido" align="center" style="overflow:auto">

                            <table class="tabla" width="95%" height="95%">
                                <tbody>
                                    <tr valign="top">
                                        <td>

                                            <table width="95%" border="0" align="center" class="formulario">


                                                <table style="margin: auto;">
                                                    <thead>
                                                        <tr>
                                                            <th style="border: solid 1px gray; padding: 5px 15px; text-align: center">#</th>
                                                            <th style="border: solid 1px gray; padding: 5px 15px; text-align: center">Cédula de Identidad del Evaluado</th>
                                                            <th style="border: solid 1px gray; padding: 5px 15px; text-align: center">Ubicación Administrativa</th>
                                                            <th style="border: solid 1px gray; padding: 5px 15px; text-align: center">Estatus</th>
                                                            <th style="border: solid 1px gray; padding: 5px 15px; text-align: center">Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="text-align: center;">
                                                        <?php
                                                        $SQL = "SELECT id, personales_id, rol_evaluacion_id, periodo_eval_id, nanno_evalu, 
                                            cargos_id, ubicacion_administrativa_scodigo, subicacion_fisica, 
                                            scargo_ejerce, sobservaciones, benabled, nusuario_creacion, dfecha_creacion, 
                                            nusuario_actualizacion, dfecha_actualizacion, sodi1, nodi1_peso, 
                                            nodi1_rango, sodi2, nodi2_peso, nodi2_rango, sodi3, nodi3_peso, 
                                            nodi3_rango, sodi4, nodi4_peso, nodi4_rango, sodi5, nodi5_peso, 
                                            nodi5_rango, sodi6, nodi6_peso, nodi6_rango, sodi7, nodi7_peso, 
                                            nodi7_rango, sodi8, nodi8_peso, nodi8_rango, srango_actuacion, 
                                            sacotacion_supervisor, sprimer_curso, ssegundo_curso, nrango_actuacion, 
                                            anio_periodo, sdesacuerdo_evaluado, sprimer_curso_nombre, sprimer_curso_fecha, 
                                            ssegundo_curso_nombre, ssegundo_curso_fecha, nestatus
                                            FROM evaluacion_desemp.evaluacion 
                                            WHERE nestatus = '3' AND benabled = 'TRUE'";

                                                        $row = pg_query($conn, $SQL);
                                                        $i = 0;

                                                        while ($valor = pg_fetch_assoc($row)) {
                                                            $i++;
                                                            $id = $valor['personales_id'];
                                                            $SQL2 = "SELECT personales.id as id,
                                                        personales.cedula as cedula,
                                                        personales.nacionalidad as nacionalidad,
                                                        personales.primer_apellido as apellido1,
                                                        personales.segundo_apellido as apellido2,
                                                        personales.primer_nombre as nombre1,
                                                        personales.segundo_nombre as nombre2,
                                                        recibo_pago.ncodigo_nomina as codigo_nom,
                                                        personales.subicacion_fisica as ubicacion_fisica_actual,
                                                        personales.scargo_actual_ejerce as cargo_actual_ejerce,
                                                        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
                                                        public.cargos.sdescripcion as cargo,
                                                        public.cargos.id as cargo_id,
                                                        public.tipo_trabajador.ncodigo as codigo_tipos_trabajadores,
                                                        public.ubicacion_administrativa.sdescripcion as ubicacion_adm,
                                                        public.ubicacion_administrativa.scodigo as ubicacion_scodigo
                                                FROM public.personales 
                                                LEFT JOIN recibos_pagos_constancias.recibo_pago 
                                                ON recibo_pago.personales_cedula = personales.cedula 
                                                LEFT JOIN public.cargos 
                                                ON recibo_pago.cargos_id = cargos.id 
                                                LEFT JOIN public.tipo_trabajador 
                                                ON recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
                                                LEFT JOIN public.ubicacion_administrativa 
                                                ON recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo 
                                                LEFT JOIN public.ubicacion_fisica 
                                                ON recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo
                                                WHERE personales.id = '$id'
                                                AND recibo_pago.nestatus = '1'
                                                ORDER BY recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC
                                                LIMIT 1";

                                                            $row2 = pg_query($conn, $SQL2);
                                                            $valor2 = pg_fetch_assoc($row2);
                                                            if ($valor2) {
                                                                echo "<tr> 
                                                    <center>
                                                        <td style=\"border: solid 1px gray; padding: 5px 15px;\">" . $i . "</td>
                                                        <td style=\"border: solid 1px gray; padding: 5px 15px;\">" . $valor2['cedula'] . "</td>
                                                        <td style=\"border: solid 1px gray; padding: 5px 15px;\">" . $valor2['ubicacion_adm'] . "</td>
                                                        <td style=\"border: solid 1px gray; padding: 5px 15px;\">POR EVALUAR</td>
                                                        <td style=\"border: solid 1px gray; padding: 5px 15px;\"><a href=\"analista.php?id=" . $id . "\"><input type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;\" onclick=\"\" value=\"Ver\"></a></td>
                                                    </center>
                                                </tr>";
                                                            } else {
                                                                echo "<tr> 
                                                    <center>
                                                        <td style=\"border: solid 1px gray; padding: 5px 15px;\">No se encuentran elementos para evaluar.</td>
                                                    </center>
                                                </tr>";
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
</main>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
<script src="js/code.jquery.com_jquery-3.7.0.js"></script>
<script>
    var DataTable = require('datatables.net');
    require('datatables.net-responsive');

    let table = new DataTable('#myTable', {
        responsive: true
    });
</script>
<div class="sep"></div>
<div class="sep"></div>
<div class="sep"></div>
<div class="sep"></div>
<div class="sep"></div>
<div class="sep"></div>
<div class="sep"></div>

<?php include("footer.php"); ?>