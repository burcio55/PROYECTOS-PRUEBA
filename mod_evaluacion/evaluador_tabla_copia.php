<?php
include("../header.php");
include("../mod_hcm/general_LoadCombo.php");

include("BD.php");

?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.css" />
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
                                    <div align="left">ODI --> Evaluaciones por Revisar</div>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="4"><br><br><br> </td>
                            </tr>
                            <table style="margin: auto;">
                                <thead>
                                    <tr>
                                        <th style="border: solid 1px gray; padding: 5px 15px; text-align: center">#</th>
                                        <th style="border: solid 1px gray; padding: 5px 15px; text-align: center">Cédula de Identidad del Evaluado</th>
                                        <th style="border: solid 1px gray; padding: 5px 15px; text-align: center">Observación</th>
                                        <th style="border: solid 1px gray; padding: 5px 15px; text-align: center">Estatus</th>
                                        <th style="border: solid 1px gray; padding: 5px 15px; text-align: center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                <?php
                                $usuario = $_SESSION["id_usuario"];
                                $SQL = "SELECT *
                                        FROM evaluacion_desemp.evaluacion 
                                        WHERE nestatus = '4'
                                        --AND nusuario_creacion = '$usuario'
                                        AND benabled = 'TRUE'";
                                $row = pg_query($conn, $SQL);
                                $i = 0;

                                        if (pg_num_rows($row) > 0) {
                                            while ($valor = pg_fetch_assoc($row)) {
                                                $i++;
                                                $id = $valor['personales_id'];
                                                $SQL2 = "SELECT
                                                            personales.id as id,
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
                                                        FROM
                                                            public.personales 
                                                        LEFT JOIN
                                                            recibos_pagos_constancias.recibo_pago ON recibo_pago.personales_cedula = personales.cedula 
                                                        LEFT JOIN
                                                            public.cargos ON recibo_pago.cargos_id = cargos.id 
                                                        LEFT JOIN
                                                            public.tipo_trabajador ON recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
                                                        LEFT JOIN
                                                            public.ubicacion_administrativa ON recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo 
                                                        LEFT JOIN
                                                            public.ubicacion_fisica ON recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo
                                                        WHERE
                                                            personales.id = '$id'
                                                        AND
                                                            recibo_pago.nestatus = '1'
                                                        ORDER BY
                                                            recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC
                                                        LIMIT 1";
                                                $row2 = pg_query($conn, $SQL2);
                                                $valor2 = pg_fetch_assoc($row2);
                                                $observacion = $valor['sobservacion_analista'] ?: $valor['sobservaciones'];

                                                echo "<tr> 
                                                        <center>
                                                            <td style=\"border: solid 1px gray; padding: 5px 15px;\">".$i."</td>
                                                            <td style=\"border: solid 1px gray; padding: 5px 15px;\">".$valor2['cedula']."</td>
                                                            <td style=\"border: solid 1px gray; padding: 5px 15px;\">".$observacion."</td>
                                                            <td style=\"border: solid 1px gray; padding: 5px 15px;\">POR REVISIÓN</td>
                                                            <td style=\"border: solid 1px gray; padding: 5px 15px;\"><a href=\"corregir_evaluacion.php?id=".$id."\"><input type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;\" onclick=\"\" value=\"Ver\"></a></td>
                                                        </center>
                                                    </tr>";
                                            }
                                        } else {
                                            echo "<tr>
                                                    <td colspan='5' style='border: solid 1px gray; padding: 5px 15px; text-align: center;'>No hay evaluaciones por Revisar Actualmente.</td>
                                                </tr>";
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
<script src="js/code.jquery.com_jquery-3.7.0.js"></script>
<script>
    var DataTable = require( 'datatables.net' );
    require( 'datatables.net-responsive' );
    
    let table = new DataTable('#myTable', {
        responsive: true
    });
</script>
<?php include("../footer.php"); ?>
--AND nusuario_creacion = '$usuario'