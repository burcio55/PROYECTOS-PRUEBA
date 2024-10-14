<?php

$host = "10.46.1.93";
$dbname = "minpptrassi";
$user = "postgres";
$pass = "postgres";

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}
$accion = $_REQUEST["accion"];
if ($accion == 1) {
    $entidad_nentidad = $_REQUEST["entidad_nentidad"];
    $sql = "SELECT * FROM public.municipio WHERE nenabled = 1 AND nentidad = " . $entidad_nentidad . " ORDER BY sdescripcion ASC";
    $row = pg_query($conn, $sql);
    $municipio = pg_fetch_all($row);
    $op = "<option value= -1>Seleccionar</option>";
    foreach ($municipio as $u) {
        $op .= "<option value='" . $u['nmunicipio'] . "'>" . $u['sdescripcion'] . "</option>";
    }

    echo $op;
} else
if ($accion == 2) {
    $municipio_nmunicipio = $_REQUEST["municipio_nmunicipio"];
    $sql2 = "SELECT * FROM public.parroquia WHERE nenabled = 1 AND nmunicipio = " . $municipio_nmunicipio . " ORDER BY sdescripcion ASC";
    $row2 = pg_query($conn, $sql2);
    $parroquia = pg_fetch_all($row2);
    $op2 = "<option value= -1>Seleccionar</option>";
    foreach ($parroquia as $u) {
        $op2 .= "<option value='" . $u['nparroquia'] . "'>" . $u['sdescripcion'] . "</option>";
    }

    echo $op2;
} else
if ($accion == 3) {
    $entidad_nentidad2 = $_REQUEST["entidad_nentidad2"];
    $sql3 = "SELECT * FROM public.municipio WHERE nenabled = 1 AND nentidad = " . $entidad_nentidad2 . " ORDER BY sdescripcion ASC";
    $row3 = pg_query($conn, $sql3);
    $municipio2 = pg_fetch_all($row3);
    $op3 = "<option value= -1>Seleccionar</option>";
    foreach ($municipio2 as $u) {
        $op3 .= "<option value='" . $u['nmunicipio'] . "'>" . $u['sdescripcion'] . "</option>";
    }

    echo $op3;
} else
if ($accion == 4) {
    $municipio_nmunicipio2 = $_REQUEST["municipio_nmunicipio2"];
    $sql4 = "SELECT * FROM public.parroquia WHERE nenabled = 1 AND nmunicipio = " . $municipio_nmunicipio2 . " ORDER BY sdescripcion ASC";
    $row4 = pg_query($conn, $sql4);
    $parroquia2 = pg_fetch_all($row4);
    $op4 = "<option value= -1>Seleccionar</option>";
    foreach ($parroquia2 as $u) {
        $op4 .= "<option value='" . $u['nparroquia'] . "'>" . $u['sdescripcion'] . "</option>";
    }

    echo $op4;
} else {
    echo "¿Cómo chuta llegaste aquí?";
    die();
}
