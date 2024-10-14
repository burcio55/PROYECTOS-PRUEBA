<?php
$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

session_start();
/* include('../include/BD.php');
$conn = Conexion::ConexionBD(); */

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("1 / Error al conectar en la Base de Datos " . $error);
}

$accion = $_REQUEST["accion"];

if ($accion == 1) {

    $selector = $_REQUEST["selector"];
    $selector2 = $_REQUEST["selector2"];
    $sql1 = "SELECT * FROM rnee.rnee_empresa where srif='" . $_SESSION['rif'] . "'";
    $aux1 = pg_query($conn, $sql1);
    $dato1 = pg_fetch_assoc($aux1);

    $id = $dato1["id"];

    if ($selector2 == '-1') {
        $selector2 = '0';
    }

    $sql2 = "SELECT * FROM rnee.rnee_condicion_actividad_movimiento where rnee_empresa_id='" . $id . "' AND rnee_sucursal_id = '" . $selector2 . "' AND nenabled = '1'";
    $aux2 = pg_query($conn, $sql2);
    $dato2 = pg_fetch_assoc($aux2);

    if ($dato2 == '') {
        echo "1 / Esta opción está inhabilitada" . $sql2;
        die();
    }

    $selector2 = $dato2['id'];
    /* $selector2 = $_SESSION['id_oferta_snirlpcd']." - ".$_REQUEST["selector2"]; */

    $nombre_comercial = $_REQUEST["nombre_comercial"];
    $estado = $_REQUEST["estado"];
    $municipio = $_REQUEST["municipio"];
    $parroquia = $_REQUEST["parroquia"];
    $sdirecion = $_REQUEST["sdirecion"];

    $cargo = mb_strtoupper($_REQUEST["cargo"], "UTF-8");
    $vacantes = $_REQUEST["vacantes"];
    $tipo_contrato = $_REQUEST["tipo_contrato"];
    $frecuencia_pago = $_REQUEST["frecuencia_pago"];

    $Hora_Entrada = $_REQUEST["Hora_Entrada"];
    $Hora_Entrada2 = $_REQUEST["Hora_Entrada2"];
    $AmPm1 = $_REQUEST["AmPm1"];
    $Hora_Salida = $_REQUEST["Hora_Salida"];
    $Hora_Salida2 = $_REQUEST["Hora_Salida2"];
    $AmPm2 =  $_REQUEST["AmPm2"];

    if ($Hora_Entrada != '-1' && $Hora_Entrada2 != '-1' && $AmPm1 != '-1') {
        if ($AmPm1 == 1) {
            $entrada = $Hora_Entrada . ":" . $Hora_Entrada2 . " - AM";
        } else {
            $entrada = $Hora_Entrada . ":" . $Hora_Entrada2 . " - PM";
        }
    } else {
        echo "1 / Error, el formato de la \"Hora de Entrada\" no es el correcto";
        die();
    }


    if ($Hora_Salida != '-1' && $Hora_Salida2 != '-1' && $AmPm2 != '-1') {
        if ($AmPm2 == 1) {
            $salida = $Hora_Salida2 . ":" . $Hora_Salida . " - AM";
        } else {
            $salida = $Hora_Salida2 . ":" . $Hora_Salida . " - PM";
        }
    } else {
        echo "1 / Error, el formato de la \"Hora de Salida\" no es el correcto";
        die();
    }

    /* $horario = $entrada;
    $horario .= " - ";
    $horario .= $salida; */

    $laborales = mb_strtoupper($_REQUEST["laborales"], "UTF-8");

    if ($laborales == '') {
        echo "1 / Error, el campo \"Días Laborales\" no puede estar vacio";
        die();
    }

    /* echo $selector . " " . $selector2 . " " . $nombre_comercial . " " . $estado . " " . $municipio . " " . $parroquia . " " . $sdirecion . " " . $cargo . " " . $tipo_contrato . " " . $frecuencia_pago . " " . $entrada . " " . $salida . " " . $laborales;
    die(); */

    if ($AmPm1 == 1) {
        $Am_Pm1 = "AM";
    } else {
        $Am_Pm1 = "PM";
    }
    if ($AmPm2 == 1) {
        $Am_Pm2 = "AM";
    } else {
        $Am_Pm2 = "PM";
    }

    $SQL = "INSERT INTO";
    $SQL .= " snirlpcd.oferta_empleo";
    $SQL .= " (";
    $SQL .= " rnee_condicion_actividad_movimiento_id,";
    $SQL .= " snombre_cargo,";
    $SQL .= " tipo_contrato_lab_id,";
    $SQL .= " frecuencia_pago_id,";
    /* $SQL .= " shorario_trabajo,"; */
    $SQL .= " nhora_entrada,";
    $SQL .= " nminutos_entrada,";
    $SQL .= " nhora_salida,";
    $SQL .= " nminutos_salida,";
    $SQL .= " shorario_entrada,";
    $SQL .= " shorario_salida,";
    $SQL .= " sdias_laborales,";
    $SQL .= " nvacante";
    $SQL .= ")";
    $SQL .= " VALUES";
    $SQL .= " (";
    $SQL .= "'$selector2',";
    $SQL .= " '$cargo',";
    $SQL .= " '$tipo_contrato',";
    $SQL .= " '$frecuencia_pago',";
    /* $SQL .= " '$horario',"; */
    $SQL .= " '$Hora_Entrada',";
    $SQL .= " '$Hora_Entrada2',";
    $SQL .= " '$Hora_Salida2',";
    $SQL .= " '$Hora_Salida',";
    $SQL .= " '$Am_Pm1',";
    $SQL .= " '$Am_Pm2',";
    $SQL .= " '$laborales',";
    $SQL .= " '$vacantes'";
    $SQL .= ");";

    /* echo "1 / " . $SQL;
    die(); */

    if ($row = pg_query($conn, $SQL)) {
        $query = "SELECT * FROM";
        $query .= " snirlpcd.oferta_empleo";
        $query .= " WHERE";
        $query .= " rnee_condicion_actividad_movimiento_id='$selector2'";
        $query .= " AND";
        $query .= " snombre_cargo='$cargo'";
        $query .= " AND";
        $query .= " tipo_contrato_lab_id='$tipo_contrato'";
        $query .= " AND";
        $query .= " frecuencia_pago_id='$frecuencia_pago'";
        $query .= " AND";
        $query .= " sdias_laborales='$laborales'";
        $query .= " AND";
        $query .= " benabled='true'";
        $query .= " ORDER BY id DESC";
        $query .= " limit 1";

        $row2 = pg_query($conn, $query);
        $oferta = pg_fetch_assoc($row2);
        $_SESSION["id_oferta"] = $oferta["id"];

        echo "2 / Datos guardados exitosamente";
    } else {
        echo "1 / Se ha presentado un problema por favor intente de nuevo más tarde";
    }
} else 
if ($accion == 2) {
    $id = $_SESSION['snirlpcd3'];

    if ($id == '') {
        die();
    }

    $query = "SELECT * FROM";
    $query .= " snirlpcd.oferta_empleo";
    $query .= " WHERE";
    $query .= " id='" . $id . "'";

    $row = pg_query($conn, $query);
    $datos = pg_fetch_assoc($row);

    echo ($datos['id'] . " / " . $datos['rnee_condicion_actividad_movimiento_id'] . " / " . $datos['snombre_cargo'] . " / " . $datos['tipo_contrato_lab_id'] . " / " . $datos['frecuencia_pago_id'] . " / " . $datos['sdias_laborales'] . " / " . $datos['nhora_entrada'] . " / " . $datos['nminutos_entrada'] . " / " . $datos['shorario_entrada'] . " / " . $datos['nhora_salida'] . " / " . $datos['nminutos_salida'] . " / " . $datos['shorario_salida'] . " / " . $datos['nvacante']);
} else
if ($accion == 3) {
    $valor = $_REQUEST['value'];

    $sql1 = "SELECT * FROM rnee.rnee_empresa where srif='" . $_SESSION['rif'] . "'";
    $aux1 = pg_query($conex, $sql1);
    $dato1 = pg_fetch_assoc($aux1);

    $SQL = "SELECT";
    $SQL .= " rnee_sucursales.id,";
    $SQL .= " rnee_sucursales.sdenominacion_comercial,";
    $SQL .= " rnee_sucursales.sdireccion,";
    $SQL .= " entidad.sdescripcion AS estado,";
    $SQL .= " municipio.sdescripcion AS municipio,";
    $SQL .= " parroquia.sdescripcion AS parroquia,";
    $SQL .= " rnee_condicion_actividad_movimiento.rnee_sucursal_id";
    $SQL .= " FROM rnee.rnee_sucursales";
    $SQL .= " INNER JOIN rnee.rnee_condicion_actividad_movimiento ON";
    $SQL .= " rnee_condicion_actividad_movimiento.rnee_sucursal_id = rnee_sucursales.id";
    $SQL .= " INNER JOIN parroquia ON";
    $SQL .= " parroquia.nparroquia = rnee_sucursales.parroquia_id";
    $SQL .= " INNER JOIN municipio ON";
    $SQL .= " municipio.nmunicipio = parroquia.nmunicipio";
    $SQL .= " INNER JOIN entidad ON";
    $SQL .= " entidad.nentidad = parroquia.nentidad";
    $SQL .= " WHERE";
    /* $SQL .= " rnee_condicion_actividad_movimiento.rnee_empresa_id='".$dato1['id']."'";
    $SQL .= " AND"; */
    $SQL .= " rnee_sucursal_id = '$valor'";
    $SQL .= " ORDER BY";
    $SQL .= " rnee_sucursales.sdenominacion_comercial ASC";
    $row2 = pg_query($conn, $SQL);
    $sucursal = pg_fetch_assoc($row2);

    /* $id = $sucursal["id"]; */
    echo $sucursal["sdenominacion_comercial"] . " / " . $sucursal["sdireccion"] . " / " . $sucursal["estado"] . " / " . $sucursal["municipio"] . " / " . $sucursal["parroquia"];
} else
if ($accion == 4) {

    $id = $_REQUEST['valor_id'];
    $selector = $_REQUEST["selector"];
    $selector2 = $_REQUEST["selector2"];
    $vacantes = $_REQUEST["vacantes"];

    if ($selector == '-1') {
        echo "1 / Error, el campo \"Origen\" no puede estar vacio";
        die();
    } else {
        if ($selector == '1') {
            $selector2 = 0;
        }
        if ($selector2 == '-1') {
            echo "1 / Error, el campo \"Sucursales\" no puede estar vacio";
            die();
        }
    }

    $sql1 = "SELECT * FROM rnee.rnee_empresa where srif='" . $_SESSION['rif'] . "'";
    $aux1 = pg_query($conex, $sql1);
    $dato1 = pg_fetch_assoc($aux1);

    $sql2 = "SELECT * FROM rnee.rnee_condicion_actividad_movimiento where rnee_empresa_id='" . $dato1['id'] . "' AND rnee_sucursal_id = '" . $selector2 . "'";
    $aux2 = pg_query($conex, $sql2);
    $dato2 = pg_fetch_assoc($aux2);

    $selector2 = $dato2['id'];

    /* $selector2 = $_SESSION['id_oferta_snirlpcd']." - ".$_REQUEST["selector2"]; */

    $nombre_comercial = $_REQUEST["nombre_comercial"];
    $estado = $_REQUEST["estado"];
    $municipio = $_REQUEST["municipio"];
    $parroquia = $_REQUEST["parroquia"];
    $sdirecion = $_REQUEST["sdirecion"];

    $cargo = mb_strtoupper($_REQUEST["cargo"], "UTF-8");
    $tipo_contrato = $_REQUEST["tipo_contrato"];
    $frecuencia_pago = $_REQUEST["frecuencia_pago"];

    if ($cargo == '') {
        echo "1 / Error, el campo \"Nombre del Cargo Vacante\" no puede estar vacio";
        die();
    }
    if ($tipo_contrato == '-1') {
        echo "1 / Error, el campo \"Tipo de Contrato\" no puede estar vacio";
        die();
    }
    if ($frecuencia_pago == '-1') {
        echo "1 / Error, el campo \"Frecuencia de Pago\" no puede estar vacio";
        die();
    }


    $Hora_Entrada = $_REQUEST["Hora_Entrada"];
    $Hora_Entrada2 = $_REQUEST["Hora_Entrada2"];
    $AmPm1 = $_REQUEST["AmPm1"];
    $Hora_Salida = $_REQUEST["Hora_Salida"];
    $Hora_Salida2 = $_REQUEST["Hora_Salida2"];
    $AmPm2 =  $_REQUEST["AmPm2"];

    if ($Hora_Entrada != '-1' && $Hora_Entrada2 != '-1' && $AmPm1 != '-1') {
        if ($AmPm1 == 1) {
            $entrada = $Hora_Entrada . ":" . $Hora_Entrada2 . " - AM";
        } else {
            $entrada = $Hora_Entrada . ":" . $Hora_Entrada2 . " - PM";
        }
    } else {
        echo "1 / Error, el formato de la \"Hora de Entrada\" no es el correcto";
        die();
    }


    if ($Hora_Salida != '-1' && $Hora_Salida2 != '-1' && $AmPm2 != '-1') {
        if ($AmPm2 == 1) {
            $salida = $Hora_Salida2 . ":" . $Hora_Salida . " - AM";
        } else {
            $salida = $Hora_Salida2 . ":" . $Hora_Salida . " - PM";
        }
    } else {
        echo "1 / Error, el formato de la \"Hora de Salida\" no es el correcto";
        die();
    }

    /* $horario = $entrada;
    $horario .= " - ";
    $horario .= $salida; */

    $laborales = mb_strtoupper($_REQUEST["laborales"], "UTF-8");

    if ($laborales == '') {
        echo "1 / Error, el campo \"Días Laborales\" no puede estar vacio";
        die();
    }

    /* echo $selector . " " . $selector2 . " " . $nombre_comercial . " " . $estado . " " . $municipio . " " . $parroquia . " " . $sdirecion . " " . $cargo . " " . $tipo_contrato . " " . $frecuencia_pago . " " . $entrada . " " . $salida . " " . $laborales;
    die(); */

    if ($AmPm1 == 1) {
        $Am_Pm1 = "AM";
    } else {
        $Am_Pm1 = "PM";
    }
    if ($AmPm2 == 1) {
        $Am_Pm2 = "AM";
    } else {
        $Am_Pm2 = "PM";
    }

    $laborales = $_REQUEST["laborales"];

    if ($laborales == '') {
        echo "1 / Error, el campo \"Días Laborales\" no puede estar vacio";
        die();
    }

    /* echo $selector . " " . $selector2 . " " . $nombre_comercial . " " . $estado . " " . $municipio . " " . $parroquia . " " . $sdirecion . " " . $cargo . " " . $tipo_contrato . " " . $frecuencia_pago . " " . $entrada . " " . $salida . " " . $laborales;
    die(); */

    $SQL = "UPDATE";
    $SQL .= " snirlpcd.oferta_empleo";
    $SQL .= " SET";
    $SQL .= " snombre_cargo = '$cargo',";
    $SQL .= " tipo_contrato_lab_id = '$tipo_contrato',";
    $SQL .= " frecuencia_pago_id = '$frecuencia_pago',";
    $SQL .= " sdias_laborales = '$laborales',";
    $SQL .= " nhora_entrada = '$Hora_Entrada',";
    $SQL .= " nminutos_entrada = '$Hora_Entrada2',";
    $SQL .= " shorario_entrada = '$Am_Pm1',";
    $SQL .= " nhora_salida = '$Hora_Salida2',";
    $SQL .= " nminutos_salida = '$Hora_Salida',";
    $SQL .= " shorario_salida = '$Am_Pm2',";
    $SQL .= " nvacante = '$vacantes'";
    $SQL .= " WHERE";
    $SQL .= " id = '$id'";

    if ($row = pg_query($conn, $SQL)) {
        echo "2 / Datos guardados exitosamente";
        $_SESSION['snirlpcd3'] = '';
        $_SESSION['id_oferta'] = $id;
    } else {
        echo "1 / Error, por favor intentar más tarde  $SQL";
    }
} else {
    echo "Ocurrió un error inesperado, intente más tarde";
}
