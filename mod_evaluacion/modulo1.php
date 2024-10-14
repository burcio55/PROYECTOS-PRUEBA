<?php

include("BD.php");

$mes = date('m');
$anio = date('Y');

$persona_id2 = $_REQUEST["persona_id2"];
$rol_evaluacion2 = $_REQUEST["rol_evaluacion2"];
$periodo_evaluacion2 = $_REQUEST["periodo_evaluacion2"];
$nanno_evalu2 = $_REQUEST["nanno_evalu2"];
$cargo2 = $_REQUEST["cargo2"];
$cargo_id2 = $_REQUEST["cargo_id2"];
$ubicacion_adm2 = $_REQUEST["ubicacion_adm2"];
$ubicacion_scodigo2 = $_REQUEST["ubicacion_scodigo2"];
$ubicacion_act2 = $_REQUEST["ubicacion_act2"];
$cargo_ejerce2 = $_REQUEST["cargo_ejerce2"];
$codigo_tipos_trabajadores2 = $_REQUEST["codigo_tipos_trabajadores2"];

if ($periodo_evaluacion2 == "") {
    if ($mes >= 1 && $mes <= 3) {
        $periodo = 1;
    } else
    if ($mes >= 4 && $mes <= 6) {
        $periodo = 2;
    } else
    if ($mes >= 7 && $mes <= 9) {
        $periodo = 3;
    } else
    if ($mes >= 10 && $mes <= 12) {
        $periodo = 4;
    }
    $periodo_evaluacion2 = $periodo;
}

$cedula2 = $_REQUEST["cedula2"];
$nombre_apellido2 = $_REQUEST["nombre_apellido2"];
$codigo2 = $_REQUEST["codigo2"];

$sodi1 = "Asistencia y Puntualidad al Trabajo";
$nodi1_peso = $_REQUEST["peso1"];
$nodi1_rango = $_REQUEST["rango1"];

$sodi2 = "Asistencia y Puntualidad a las Reuniones de Trabajo";
$nodi2_peso = $_REQUEST["peso2"];
$nodi2_rango = $_REQUEST["rango2"];

$sodi3 = "Asistencia y Puntualidad a los Despliegues de Campo";
$nodi3_peso = $_REQUEST["peso3"];
$nodi3_rango = $_REQUEST["rango3"];

$sodi4 = $_REQUEST["descripcion1"];
$nodi4_peso = $_REQUEST["peso4"];
$nodi4_rango = $_REQUEST["rango4"];

$sodi5 = $_REQUEST["descripcion2"];
$nodi5_peso = $_REQUEST["peso5"];
$nodi5_rango = $_REQUEST["rango5"];

$sodi6 = $_REQUEST["descripcion3"];
$nodi6_peso = $_REQUEST["peso6"];
$nodi6_rango = $_REQUEST["rango6"];

$sodi7 = $_REQUEST["descripcion4"];
$nodi7_peso = $_REQUEST["peso7"];
$nodi7_rango = $_REQUEST["rango7"];

$sodi8 = $_REQUEST["descripcion5"];
$nodi8_peso = $_REQUEST["peso8"];
$nodi8_rango = $_REQUEST["rango8"];

$peso_rango_total_m1 = $_REQUEST["peso_rango_total_m1"];

$_SESSION["peso_total1"] = $peso_rango_total_m1;

$desde = $_SESSION["Desde"];
$hasta = $_SESSION["Hasta"];

/* $v1 = $codigo_tipos_trabajadores2;

echo " 1 / " . $v1;
die(); */

$persona_id = $_SESSION["Persona_id2"];
$cedula = $_SESSION["Cedula"];

$SQL = "INSERT INTO";
$SQL .= " evaluacion_desemp.evaluacion";
$SQL .= " (";
$SQL .= " personales_id,";
$SQL .= " rol_evaluacion_id,";
$SQL .= " periodo_eval_id,";
$SQL .= " nanno_evalu,";
$SQL .= " cargos_id,";
$SQL .= " ubicacion_administrativa_scodigo,";
$SQL .= " subicacion_fisica,";
$SQL .= " scargo_ejerce,";
$SQL .= " nusuario_creacion,";
$SQL .= " sodi1,";
$SQL .= " nodi1_peso,";
$SQL .= " nodi1_rango,";
$SQL .= " sodi2,";
$SQL .= " nodi2_peso,";
$SQL .= " nodi2_rango,";
$SQL .= " sodi3,";
$SQL .= " nodi3_peso,";
$SQL .= " nodi3_rango,";
$SQL .= " sodi4,";
$SQL .= " nodi4_peso,";
$SQL .= " nodi4_rango,";
$SQL .= " sodi5,";
$SQL .= " nodi5_peso,";
$SQL .= " nodi5_rango,";
$SQL .= " sodi6,";
$SQL .= " nodi6_peso,";
$SQL .= " nodi6_rango,";
$SQL .= " sodi7,";
$SQL .= " nodi7_peso,";
$SQL .= " nodi7_rango,";
$SQL .= " sodi8,";
$SQL .= " nodi8_peso,";
$SQL .= " nodi8_rango,";
$SQL .= " anio_periodo";
$SQL .= ")";
$SQL .= " VALUES";
$SQL .= " (";
$SQL .= "'$persona_id',";
$SQL .= "'1',";
$SQL .= "'$periodo_evaluacion2',";
$SQL .= "'$nanno_evalu2',";
$SQL .= "'$cargo_id2',";
$SQL .= "'$ubicacion_scodigo2',";
$SQL .= "'$ubicacion_act2',";
$SQL .= "'$cargo_ejerce2',";
$SQL .= "'$cedula',";
$SQL .= "'$sodi1',";
$SQL .= "'$nodi1_peso',";
$SQL .= "'$nodi1_rango',";
$SQL .= "'$sodi2',";
$SQL .= "'$nodi2_peso',";
$SQL .= "'$nodi2_rango',";
$SQL .= "'$sodi3',";
$SQL .= "'$nodi3_peso',";
$SQL .= "'$nodi3_rango',";
$SQL .= "'$sodi4',";
$SQL .= "'$nodi4_peso',";
$SQL .= "'$nodi4_rango',";
$SQL .= "'$sodi5',";
$SQL .= "'$nodi5_peso',";
$SQL .= "'$nodi5_rango',";
$SQL .= "'$sodi6',";
$SQL .= "'$nodi6_peso',";
$SQL .= "'$nodi6_rango',";
$SQL .= "'$sodi7',";
$SQL .= "'$nodi7_peso',";
$SQL .= "'$nodi7_rango',";
$SQL .= "'$sodi8',";
$SQL .= "'$nodi8_peso',";
$SQL .= "'$nodi8_rango',";
$SQL .= "'$anio'";
$SQL .= ");";

/* echo " 1 / " . $SQL;
die(); */

if ($resultado = pg_query($conn, $SQL)) {
    $SQL2 = "SELECT * FROM
            evaluacion_desemp.evaluacion
            WHERE
            personales_id = '$persona_id'
            AND
            rol_evaluacion_id = '1'
            AND
            periodo_eval_id = '$periodo_evaluacion2'
            AND
            nanno_evalu = '$nanno_evalu2'
            AND
            cargos_id = '$cargo_id2'
            AND
            ubicacion_administrativa_scodigo = '$ubicacion_scodigo2'
            AND
            subicacion_fisica = '$ubicacion_act2'
            AND
            scargo_ejerce = '$cargo_ejerce2'
            AND
            nusuario_creacion = '$cedula'
            AND
            sodi1 = '$sodi1'
            AND
            nodi1_peso = '$nodi1_peso'
            AND
            nodi1_rango = '$nodi1_rango'
            AND
            sodi2 = '$sodi2'
            AND
            nodi2_peso = '$nodi2_peso'
            AND
            nodi2_rango = '$nodi2_rango'
            AND
            sodi3 = '$sodi3'
            AND
            nodi3_peso = '$nodi3_peso'
            AND
            nodi3_rango = '$nodi3_rango'
            AND
            sodi4 = '$sodi4'
            AND
            nodi4_peso = '$nodi4_peso'
            AND
            nodi4_rango = '$nodi4_rango'
            AND
            sodi5 = '$sodi5'
            AND
            nodi5_peso = '$nodi5_peso'
            AND
            nodi5_rango = '$nodi5_rango'
            AND
            sodi6 = '$sodi6'
            AND
            nodi6_peso = '$nodi6_peso'
            AND
            nodi6_rango = '$nodi6_rango'
            AND
            sodi7 = '$sodi7'
            AND
            nodi7_peso = '$nodi7_peso'
            AND
            nodi7_rango = '$nodi7_rango'
            AND
            sodi8 = '$sodi8'
            AND
            nodi8_peso = '$nodi8_peso'
            AND
            nodi8_rango = '$nodi8_rango'
            AND
            benabled = 'TRUE'
    ";
    /* echo " 1 / " . $SQL2;
    die(); */
    $row = pg_query($conn, $SQL2);
    if (pg_num_rows($row) > 0) {
        $persona = pg_fetch_assoc($row);
        $evaluacion_id = $persona["id"];
        $_SESSION["evaluacion_id"] = $evaluacion_id;
        echo " 1 / " . $evaluacion_id;
    } else {
        echo "0 / Falló la inserción, razón: " . $SQL2;
        die();
    }
} else {
    echo "0 / Falló la inserción, razón: " . $SQL;
    die();
}
