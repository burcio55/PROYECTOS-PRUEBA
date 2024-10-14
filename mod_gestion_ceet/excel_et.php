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

$ente = $_SESSION["ente"];

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment; filename=REPORTE_DIARIO_ENTIDAD_TRABAJO_$fecha.xls");
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <caption>
                <b>
                    REPORTE DIARIO DE LAS ENTIDADES DE TRABAJO - FECHA: <? echo $fecha . " " . $ente; ?>
                </b>
            </caption>
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
            <th style='text-align: center'> EMPRESA RNEE </th>
            <th style='text-align: center'> NOMBRE COMPLETO DEL RESPONSABLE </th>
            <th style='text-align: center'> TELEFONO PERSONAL </th>
            <th style='text-align: center'> MOTOR </th>
            <th style='text-align: center'> INSERCIÓN LABORAL </th>
        </tr>
        <?

        $sql1 = "SELECT abordaje_rnee_empresa.benabled,
	abordaje_rnee_empresa.rnee_empresa_id,
	abordaje_rnee_empresa.fecha,
	abordaje_rnee_empresa.rnee_empresa_id,
	abordaje_rnee_empresa.snombres_resp_form,
	abordaje_rnee_empresa.sapellidos_resp_form,
	abordaje_rnee_empresa.stelefono_personal_resp_form,
	motor.sdescripcion as motor_id,
	abordaje_rnee_empresa.sinsercion_laboral
FROM reporte_ceet.abordaje_rnee_empresa 
INNER JOIN reporte_ceet.motor ON abordaje_rnee_empresa.motor_id = motor.id
 WHERE abordaje_rnee_empresa.benabled = 'TRUE'
  AND abordaje_rnee_empresa.rnee_empresa_id = '$ente' 
  ";
        $rs1 = pg_query($conn, $sql1);
        //$persona1 = pg_fetch_all($rs1);
        //secho $sql1;

        $i = 0;

        while ($persona1 = pg_fetch_assoc($rs1)) {
            $i++;
        ?>

            <tr>
                <td style='text-align: center'><? echo $i; ?></td>
                <td style='text-align: center'><? echo $persona1['rnee_empresa_id']; ?></td>
                <td style='text-align: center'><? echo $persona1['snombres_resp_form'] . " " . $persona1['sapellidos_resp_form']; ?></td>
                <td style='text-align: center'><? echo $persona1['stelefono_personal_resp_form']; ?></td>
                <td style='text-align: center'><? echo $persona1['motor_id']; ?></td>
                <td style='text-align: center'><? echo $persona1['sinsercion_laboral']; ?></td>
            </tr>
        <?
        }
        ?>
    </thead>
</table>