<?php

include("BD.php");

/* $sql = "SELECT * FROM evaluacion_desemp.competencias ORDER BY id ASC";
$row = pg_query($conn, $sql);
if ($persona = pg_fetch_assoc($row)) {
    // Contar el número de filas
    $filas = pg_num_rows($row);
    for ($i = 0; $i < $filas; $i++) {
        $sql = "SELECT * FROM evaluacion_desemp.competencias ORDER BY id ASC";
    }
} */

$npeso9 = $_REQUEST["peso9"];
$nrango9 = $_REQUEST["rango9"];

$npeso10 = $_REQUEST["peso10"];
$nrango10 = $_REQUEST["rango10"];

$npeso11 = $_REQUEST["peso11"];
$nrango11 = $_REQUEST["rango11"];

$npeso12 = $_REQUEST["peso12"];
$nrango12 = $_REQUEST["rango12"];

$npeso13 = $_REQUEST["peso13"];
$nrango13 = $_REQUEST["rango13"];

$npeso14 = $_REQUEST["peso14"];
$nrango14 = $_REQUEST["rango14"];

$npeso15 = $_REQUEST["peso15"];
$nrango15 = $_REQUEST["rango15"];

$npeso16 = $_REQUEST["peso16"];
$nrango16 = $_REQUEST["rango16"];

$npeso17 = $_REQUEST["peso17"];
$nrango17 = $_REQUEST["rango17"];

$npeso18 = $_REQUEST["peso18"];
$nrango18 = $_REQUEST["rango18"];

$npeso19 = $_REQUEST["peso19"];
$nrango19 = $_REQUEST["rango19"];

$peso_total1 = $_REQUEST["peso_rango_total_m1"];
$peso_total2 = $_REQUEST["peso_rango_total_m2"];

$peso_total = $peso_total1 + $peso_total2;

$evaluacion_id = $_SESSION["evaluacion_id"];
$cedula = $_SESSION["Cedula"];

for ($i = 0; $i < 11; $i++) {
    $SQL = "INSERT INTO";
    $SQL .= " evaluacion_desemp.evaluacion_comp";
    $SQL .= " (";
    $SQL .= " evaluacion_id,";
    $SQL .= " competencias_id,";
    $SQL .= " nrango,";
    $SQL .= " npeso,";
    $SQL .= " nusuario_creacion";
    $SQL .= ")";
    $SQL .= " VALUES";
    $SQL .= " (";
    $SQL .= "'$evaluacion_id',";
    if ($i == 0) { // FALLÓ
        $SQL .= "'4',";
        $SQL .= "'$nrango9',";
        $SQL .= "'$npeso9',";
    } else
    if ($i == 1) { // FALLÓ
        $SQL .= "'5',";
        $SQL .= "'$nrango10',";
        $SQL .= "'$npeso10',";
    } else
    if ($i == 2) { // FALLÓ
        $SQL .= "'8',";
        $SQL .= "'$nrango11',";
        $SQL .= "'$npeso11',";
    } else
    if ($i == 3) {
        $SQL .= "'9',";
        $SQL .= "'$nrango12',";
        $SQL .= "'$npeso12',";
    } else
    if ($i == 4) {
        $SQL .= "'10',";
        $SQL .= "'$nrango13',";
        $SQL .= "'$npeso13',";
    } else
    if ($i == 5) { // FALLÓ
        $SQL .= "'11',";
        $SQL .= "'$nrango14',";
        $SQL .= "'$npeso14',";
    } else
    if ($i == 6) { // FALLÓ
        $SQL .= "'12',";
        $SQL .= "'$nrango15',";
        $SQL .= "'$npeso15',";
    } else
    if ($i == 7) {
        $SQL .= "'13',";
        $SQL .= "'$nrango16',";
        $SQL .= "'$npeso16',";
    } else
    if ($i == 8) {
        $SQL .= "'14',";
        $SQL .= "'$nrango17',";
        $SQL .= "'$npeso17',";
    } else
    if ($i == 9) {
        $SQL .= "'15',";
        $SQL .= "'$nrango18',";
        $SQL .= "'$npeso18',";
    } else
    if ($i == 10) {
        $SQL .= "'16',";
        $SQL .= "'$nrango19',";
        $SQL .= "'$npeso19',";
    }
    $SQL .= "'$cedula'";
    $SQL .= ");";

    //echo "0 / ".$SQL;

    $resultado = pg_query($conn, $SQL);

    /* if ($resultado = pg_query($conn, $SQL)) {
        $bien++;
    } else {
        echo " 1 / " . $SQL;
        die();
    } */
}

if ($peso_total >= '100 ' && $peso_total <= '124') {
    $total = "No cumplió";
} else
if ($peso_total >= '125' && $peso_total <= '249') {
    $total = "Cumplimiento Ordinario";
} else
if ($peso_total >= '250 ' && $peso_total <= '374') {
    $total = "Bueno - Cumplimiento de Proceso de Mejora";
} else
if ($peso_total >= '375' && $peso_total <= '499') {
    $total = "Muy Bueno - Cumplimiento Destacable";
} else
if ($peso_total == '500') {
    $total = "Excelente - Cumplimiento Emulable";
}

$_SESSION["Total"] = $peso_total;

$_SESSION["peso_total1"] = $peso_total1;
$_SESSION["peso_total2"] = $peso_total2;

$SQL2 = "UPDATE evaluacion_desemp.evaluacion SET srango_actuacion = '$total', nrango_actuacion = '$peso_total', nestatus = '2' WHERE id='$evaluacion_id'";
$resultado2 = pg_query($conn, $SQL2);
