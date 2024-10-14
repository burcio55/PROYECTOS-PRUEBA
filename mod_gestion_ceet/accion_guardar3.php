<?php


$srif = $_REQUEST["srif"];
$srazon_social = $_REQUEST["srazon_social"];
$sdenominacion_comercial = $_REQUEST["sdenominacion_comercial"];
$stipo_capital = $_REQUEST["stipo_capital"];

$entidad_nentidad2 = $_REQUEST["entidad_nentidad2"];
$parroquia_nparroquia2 = $_REQUEST["parroquia_nparroquia2"];
$municipio_nmunicipio2 = $_REQUEST["municipio_nmunicipio2"];

$snil = $_REQUEST["snil"];
$motor_id = $_REQUEST["motor_id"];
$actividad_economica2 = $_REQUEST["actividad_economica2"];
$sdireccion_fiscal = $_REQUEST["sdireccion_fiscal"];



/* echo " 1 / Esto por PHP: " . $srif . " " . $srazon_social . " " . $sdenominacion_comercial . " " . $stipo_capital . " " . $p_apellido . " " . $entidad_nentidad2 . " " . $parroquia_nparroquia2 . " " . $municipio_nmunicipio2 . " " . $snil . " " . $motor_id . " " . $actividad_economica2 . " " . $motor_id . " " . $sdireccion_fiscal;
die(); */

// Validaciones




if ($snil = ' ' or $snil = empty($snil)) {
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
    $nusuario_creacion = $_SESSION["id_usuario"];
    $s = "SELECT";
    $s .= " id,";
    $s .= " srif,";
    $s .= " snil";
    $s .= " FROM";
    $s .= " reporte_ceet.empresa";
    $s .= " WHERE";
    $s .= " srif = '$srif'";

    $rw = pg_query($conn, $s);


    if ($persona = pg_fetch_assoc($rw)) {

        $rnee_empresa_id = $persona["id"];

        $sql2 = "SELECT * FROM";
        $sql2 .= " reporte_ceet.abordaje_rnee_empresa";
        $sql2 .= " WHERE";
        $sql2 .= " rnee_empresa_id = '$rnee_empresa_id'";
        $sql2 .= " AND";
        $sql2 .= " benabled = 'TRUE'";
        $row2 = pg_query($conn, $sql2);
        if ($persona = pg_fetch_assoc($row2)) {
            echo "1 / Está empresa ya está registrada, no puede cambiar la información";
            die();
        } else {
            $SQL = "INSERT INTO";
            $SQL .= " reporte_ceet.abordaje_rnee_empresa";
            $SQL .= " (";
            $SQL .= " rnee_empresa_id,";
            $SQL .= " motor_id,";
            $SQL .= " nusuario_actualizacion";
            $SQL .= ")";
            $SQL .= " VALUES";
            $SQL .= " (";
            $SQL .= "'$rnee_empresa_id',";
            $SQL .= "'$motor_id',";
            $SQL .= " $nusuario_creacion";
            $SQL .= ");";
            if ($resultado = pg_query($conn, $SQL)) {
                echo "1 / Se agregó correctamente";
                die();
            } else {
                echo "1 / Ocurrió un error inesperado, razón: " . $SQL;
                die();
            }
        }
    } else {
        echo " 1 / No lo encontró en RNEE";
        die();
    }
} else {
    $host = "10.46.1.93";
    $dbname = "minpptrasse";
    $user = "postgres";
    $pass = "postgres";

    session_start();

    try {
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
    } catch (PDOException $error) {
        $conn = $error;
        echo ("Error al conectar en la Base de Datos " . $error);
    }
    $sql = "SELECT";
    $sql .= " id,";
    $sql .= " srif,";
    $sql .= " snil";
    $sql .= " FROM";
    $sql .= " rnee.rnee_empresa";
    $sql .= " WHERE";
    $sql .= " srif = '$srif'";
    $sql .= " AND";
    $sql .= " snil != ''";
    $row = pg_query($conn, $sql);
    if ($persona = pg_fetch_assoc($row)) {

        $rnee_empresa_id = $persona["id"];

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
        $nusuario_creacion = $_SESSION["CI"];
        $sql2 = "SELECT * FROM";
        $sql2 .= " reporte_ceet.abordaje_rnee_empresa";
        $sql2 .= " WHERE";
        $sql2 .= " rnee_empresa_id = '$rnee_empresa_id'";
        $sql2 .= " AND";
        $sql2 .= " benabled = 'TRUE'";
        $row2 = pg_query($conn, $sql2);
        if ($persona = pg_fetch_assoc($row2)) {
            echo "1 / Está empresa ya está registrada, no puede cambiar la información";
            die();
        } else {
            $SQL = "INSERT INTO";
            $SQL .= " reporte_ceet.abordaje_rnee_empresa";
            $SQL .= " (";
            $SQL .= " rnee_empresa_id,";
            $SQL .= " motor_id,";
            $SQL .= " nusuario_actualizacion";
            $SQL .= ")";
            $SQL .= " VALUES";
            $SQL .= " (";
            $SQL .= "'$rnee_empresa_id',";
            $SQL .= "'$motor_id',";
            $SQL .= " $nusuario_creacion";
            $SQL .= ");";
            if ($resultado = pg_query($conn, $SQL)) {
                echo "1 / Se agregó correctamente";
                die();
            } else {
                echo "1 / Ocurrió un error inesperado, razón: " . $SQL;
                die();
            }
        }
    } else {
        echo " 1 / No lo encontró en RNEE";
        die();
    }
}
