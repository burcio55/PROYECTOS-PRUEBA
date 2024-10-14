<?php
//----------------------------------------
ini_set("display_errors", 1);
ini_set('max_execution_time', 300);
error_reporting(E_ALL | E_STRICT);

$host = "10.46.1.93";
$dbname = "minpptrassi";
$user = "postgres";
$pass = "postgres";

session_start();

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$fecha = date("d-m-Y");

$trab = $_SESSION["trab"];

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment; filename=REPORTE_DIARIO_TRABAJADOR_INDEPENDIENTE_$fecha.xls");
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <caption>
                <b>
                    REPORTE DIARIO DE TRABAJADORES INDEPENDIENTES - FECHA: <? echo $fecha; ?>
                </b>
            </caption>
        </tr>
        <tr>
            <th style='text-align: center' colspan="10"> DATOS DEL TRABAJADOR INDEPENDIENTE </th>
            <th style='text-align: center' colspan="3"> DATOS DEL RESPONSABLE </th>
        </tr>
        <tr>
            <?
            /* $titulos = "";
            foreach($columnas AS $campo => $valor) {
                $titulos .= "<th style='text-align: justify'>$campo</th>"; 
            }
            echo $titulos; */
            ?>
            <th style='text-align: center'> # </th>
            <th style='text-align: center'>CÉDULA DE IDENTIDAD</th>
            <th style='text-align: center'>NOMBRE COMPLETO DEL TRABAJADOR</th>
            <th style='text-align: center'>SEXO</th>
            <th style='text-align: center'>TELEFONO PERSONAL</th>
            <th style='text-align: center'>ENTIDAD</th>
            <th style='text-align: center'>MUNICIPIO</th>
            <th style='text-align: center'>PARROQUIA</th>
            <th style='text-align: center'>MOTOR</th>
            <th style='text-align: center'>ACTIVIDAD ECONÓMICA QUE DESEMPEÑA</th>
            <th style='text-align: center'>NOMBRE COMPLETO DEL RESPONSABLE</th>
            <th style='text-align: center'>TELÉFONO PERSONAL</th>
            <th style='text-align: center'>INSERCIÓN LABORAL</th>
            <!--
                <th style='text-align: justify'>MOTIVO(S) DE VISITA</th>
                <th style='text-align: justify'>NOMBRE COMPLETO DEL RESPONSABLE</th>
                <th style='text-align: justify'>TELÉFONO DEL RESPONSABLE</th>
                <th style='text-align: justify'>AMBIENTE(S) DE FORMACIÓN</th>
                <th style='text-align: justify'>PLAN(ES) DE FORMACIÓN</th>
                <th style='text-align: justify'>EXPERIENCIA PRODUCTIVA</th>
                <th style='text-align: justify'>NOVEDADES</th>
                <th style='text-align: justify'>INSERSIÓN LABORAL</th>
                <th style='text-align: justify'>PLANILLA DE FORMACIÓN</th>
                <th style='text-align: justify'>PLANILLA DEL CPTT</th>
                <th style='text-align: justify'>LISTA DEL PERSONAL CEET</th>
                <th style='text-align: justify'>MINUTA DE LOS ABORDAJES</th>
            -->
        </tr>
        <?

        $sql2 = "SELECT trabajador_indep.benabled, 
	trabajador_indep.id, 
	trabajador_indep.ncedula, 
	trabajador_indep.sprimer_nombre, 
	trabajador_indep.ssegundo_nombre, 
	trabajador_indep.sprimer_apellido, 
	trabajador_indep.ssegundo_apellido, 
	trabajador_indep.ssexo, 
	trabajador_indep.stelefono_personal, 
	entidad.sdescripcion as entidad_nentidad, 
	municipio.sdescripcion as municipio_nmunicipio,
	parroquia.sdescripcion as parroquia_nparroquia, 
	motor.sdescripcion as motor_id,
	trabajador_indep.actividad_economica
FROM reporte_ceet.trabajador_indep 
INNER JOIN public.entidad ON trabajador_indep.entidad_nentidad = entidad.nentidad
INNER JOIN public.municipio ON trabajador_indep.municipio_nmunicipio = municipio.nmunicipio
INNER JOIN public.parroquia ON trabajador_indep.parroquia_nparroquia = parroquia.nparroquia
INNER JOIN reporte_ceet.motor ON trabajador_indep.motor_id = motor.id
 WHERE trabajador_indep.benabled = 'TRUE' AND trabajador_indep.id = '$trab'";
        $rs2 = pg_query($conn, $sql2);
        $persona2 = pg_fetch_assoc($rs2);
        $nombre = $persona2['sprimer_nombre'];
        $apellido = $persona2['sprimer_apellido'];
        //echo $sql2;

        if (pg_num_rows($rs2) == 0) {
            $num_registro2 = 0;
        } else {
            $num_registro2 = pg_num_rows($rs2);
        }

        $trabajador_indep_id = $persona2["id"];

        // Se debe repetir todo pero ahora con el siguiente usuario
        $sql1 = "SELECT * FROM reporte_ceet.abordaje_trabaj_indep WHERE benabled = 'TRUE' AND trabajador_indep_id = '$trabajador_indep_id' AND snombres_resp_form LIKE '$nombre%' AND sapellidos_resp_form LIKE '$apellido%'";
        $rs1 = pg_query($conn, $sql1);
        $persona1 = pg_fetch_all($rs1);
        //echo  $sql1;

        $i = 0;

        while ($persona1 = pg_fetch_assoc($rs1)) {
            $i++;
            $ci = $persona2["ncedula"];
            $name = $persona2['sprimer_nombre'] . " " . $persona2['ssegundo_nombre'] . " " . $persona2['sprimer_apellido'] . " " . $persona2['ssegundo_apellido'];
        ?>
            <tr>
                <td colspan='10'>
                    <table>
                        <tr>
                            <th style='text-align: center'><? echo $i; ?></th>
                            <th style='text-align: center'><? echo $ci; ?></th>
                            <th style='text-align: center'><? echo $name; ?></th>
                            <th style='text-align: center'><? echo $persona2['ssexo']; ?></th>
                            <th style='text-align: center'><? echo $persona2['stelefono_personal']; ?></th>
                            <th style='text-align: center'><? echo $persona2['entidad_nentidad']; ?></th>
                            <th style='text-align: center'><? echo $persona2['municipio_nmunicipio']; ?></th>
                            <th style='text-align: center'><? echo $persona2['parroquia_nparroquia']; ?></th>
                            <th style='text-align: center'><? echo $persona2['motor_id']; ?></th>
                            <th style='text-align: center'><? echo $persona2['actividad_economica']; ?></th>
                        </tr>
                    </table>
                </td>
                <td colspan='3'>
                    <table>
                        <tr>
                            <td style='text-align: center'><? echo $persona1['snombres_resp_form'] . " " . $persona1['sapellidos_resp_form']; ?></td>
                            <td style='text-align: center'><? echo $persona1['stelefono_personal_resp_form']; ?></td>
                            <td style='text-align: center'><? echo $persona1['sinsercion_laboral']; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        <?
        }
        ?>
    </thead>
</table>