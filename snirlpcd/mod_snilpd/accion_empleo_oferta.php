<?php
$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

session_start();
include('../include/BD.php');
$conn = Conexion::ConexionBD();

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("0 / Error al conectar en la Base de Datos " . $error);
}



$accion = $_REQUEST["accion"];

if ($accion == 1) {

    $selector = $_REQUEST["selector"];
    $selector2 = $_REQUEST["selector2"];

    /* echo "0 / " . $selector2;
    die(); */

    if ($selector == '-1') {
        echo "0 / Error, el campo \"Origen\" no puede estar vacio";
        die();
    } else {
        if ($selector == '1') {
            $selector2 = 0;
        }
        if ($selector2 == '-1') {
            echo "0 / Error, el campo \"Sucursales\" no puede estar vacio";
            die();
        }
    }

    $nombre_comercial = $_REQUEST["nombre_comercial"];
    $estado = $_REQUEST["estado"];
    $municipio = $_REQUEST["municipio"];
    $parroquia = $_REQUEST["parroquia"];
    $sdirecion = $_REQUEST["sdirecion"];

    $cargo = $_REQUEST["cargo"];
    $tipo_contrato = $_REQUEST["tipo_contrato"];
    $frecuencia_pago = $_REQUEST["frecuencia_pago"];

    if ($cargo == '') {
        echo "0 / Error, el campo \"Nombre del Cargo Vacante\" no puede estar vacio";
        die();
    }
    if ($tipo_contrato == '-1') {
        echo "0 / Error, el campo \"Tipo de Contrato\" no puede estar vacio";
        die();
    }
    if ($frecuencia_pago == '-1') {
        echo "0 / Error, el campo \"Frecuencia de Pago\" no puede estar vacio";
        die();
    }

    $Hora_Entrada = $_REQUEST["Hora_Entrada"];
    $AmPm1 = $_REQUEST["AmPm1"];
    $Hora_Salida = $_REQUEST["Hora_Salida"];
    $AmPm2 =  $_REQUEST["AmPm2"];
    /*  echo " 0 / " . $Hora_Entrada . " " . $AmPm1 . " " . $Hora_Salida . " " . $AmPm2;
    die(); */

    if ($Hora_Entrada != '' && $AmPm1 != '-1') {
        if (!ereg("^[0-9]{2}[:][0-9]{2}$", $Hora_Entrada)) {
            echo "0 / La Hora de entrada no posse un formato válido ejemplo: 05:30";
            die();
        }
        $am = "AM";
        $pm = "PM";
        if ($AmPm1 == 1) {
            $entrada = $Hora_Entrada . " " . $am;
        } else {
            $entrada = $Hora_Entrada . " " . $pm;
        }
        /* echo " 0 / " . $entrada;
        die(); */
    } else {
        echo "0 / Error, el formato de la \"Hora de Entrada\" no es el correcto";
        die();
    }

    if ($Hora_Salida != '' && $AmPm2 != '-1') {
        if (!ereg("^[0-9]{2}[:][0-9]{2}$", $Hora_Salida)) {
            echo "0 / La Hora de salida no posse un formato válido ejemplo: 05:30";
            die();
        }
        $am = "AM";
        $pm = "PM";
        if ($AmPm2 == 1) {
            $salida = $Hora_Salida . " " . $am;
        } else {
            $salida = $Hora_Salida . " " . $pm;
        }
        /*  echo " 0 / " . $salida;
        die(); */
    } else {
        echo "0 / Error, el formato de la \"Hora de Salida\" no es el correcto";
        die();
    }

    $horario = $entrada . " - " . $salida;
    /*  echo " 0 / " . $horario;
    die(); */

    $laborales = $_REQUEST["laborales"];
    /* echo " 0 / " . $laborales;
    die(); */

    if ($laborales == '') {
        echo "0 / Error, el campo \"Días Laborales\" no puede estar vacio";
        die();
    }

    /*  echo " 0 / selector:" . $selector . " selector2:" . $selector2 /* . "nombre_comercial " . $nombre_comercial . "estado " . $estado . "municipio " . $municipio . "parroquia " . $parroquia . "sdirecion " . $sdirecion . "cargo " . $cargo   . "tipo_contrato " . $tipo_contrato . "frecuencia_pago " . $frecuencia_pago . "entrada " . $entrada . "salida " . $salida . "laborales " . $laborales;
    die(); */

    $SQL = "INSERT INTO snirlpcd.oferta_empleo(rnee_condicion_actividad_movimiento_id,snombre_cargo,tipo_contrato_lab_id,frecuencia_pago_id,shorario_trabajo,shora_entrada_trab,shora_salida_trab,sdias_laborales) VALUES ('47016','$cargo','$tipo_contrato','$frecuencia_pago', '$horario','$entrada', '$salida','$laborales')";


    if ($row = pg_query($conn, $SQL)) {
        $query = "SELECT * FROM";
        $query .= " snirlpcd.oferta_empleo";
        $query .= " WHERE";
        $query .= " rnee_condicion_actividad_movimiento_id='47016'";
        $query .= " AND";
        $query .= " snombre_cargo='$cargo'";
        $query .= " AND";
        $query .= " tipo_contrato_lab_id='$tipo_contrato'";
        $query .= " AND";
        $query .= " frecuencia_pago_id='$frecuencia_pago'";
        $query .= " AND";
        $query .= " shorario_trabajo='$horario'";
        $query .= " AND";
        $query .= " sdias_laborales='$laborales'";
        $query .= " AND";
        $query .= " benabled='true'";
        $query .= " ORDER BY id DESC";
        $query .= " limit 1";

        $row2 = pg_query($conn, $query);
        $oferta = pg_fetch_assoc($row2);
        $_SESSION["id_oferta"] = $oferta["id"];

        echo "1 / Datos guardados exitosamente";
    } else {
        echo "0 / Ocurrió un error inesperado, por favor intentar más tarde";
    }
} else 
if ($accion == 2) {
    $id = $_SESSION['id_modificar'];

    if ($id == -1) {
        echo $id;
        die();
    }

    $query = "SELECT * FROM";
    $query .= " snirlpcd.oferta_empleo";
    $query .= " WHERE";
    $query .= " id='$id'";

    $row = pg_query($conn, $query);
    $datos = pg_fetch_assoc($row);

    echo ($datos['id'] . " / " . $datos['rnee_condicion_actividad_movimiento_id'] . " / " . $datos['snombre_cargo'] . " / " . $datos['tipo_contrato_lab_id'] . " / " . $datos['frecuencia_pago_id'] . " / " . $datos['sdias_laborales'] . " / " . $datos['shora_entrada_trab'] . " / " . $datos['shora_salida_trab']);
} else
if ($accion == 3) {
    $valor = $_REQUEST['value'];

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
    $SQL .= " rnee_condicion_actividad_movimiento.rnee_empresa_id='79292'";
    $SQL .= " AND";
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


    if ($selector == '-1') {
        echo "0 / Error, el campo \"Origen\" no puede estar vacio";
        die();
    } else {
        if ($selector == '1') {
            $selector2 = 0;
        }
        if ($selector2 == '-1') {
            echo "0 / Error, el campo \"Sucursales\" no puede estar vacio";
            die();
        }
    }

    $nombre_comercial = $_REQUEST["nombre_comercial"];
    $estado = $_REQUEST["estado"];
    $municipio = $_REQUEST["municipio"];
    $parroquia = $_REQUEST["parroquia"];
    $sdirecion = $_REQUEST["sdirecion"];

    $cargo = $_REQUEST["cargo"];
    $tipo_contrato = $_REQUEST["tipo_contrato"];
    $frecuencia_pago = $_REQUEST["frecuencia_pago"];

    if ($cargo == '') {
        echo "0 / Error, el campo \"Nombre del Cargo Vacante\" no puede estar vacio";
        die();
    }
    if ($tipo_contrato == '-1') {
        echo "0 / Error, el campo \"Tipo de Contrato\" no puede estar vacio";
        die();
    }
    if ($frecuencia_pago == '-1') {
        echo "0 / Error, el campo \"Frecuencia de Pago\" no puede estar vacio";
        die();
    }

    $Hora_Entrada = $_REQUEST["Hora_Entrada"];
    $AmPm1 = $_REQUEST["AmPm1"];
    $Hora_Salida = $_REQUEST["Hora_Salida"];
    $AmPm2 =  $_REQUEST["AmPm2"];

    if ($Hora_Entrada != '' && $AmPm1 != '-1') {
        if ($AmPm1 == 1) {
            $entrada = $Hora_Entrada . " / AM";
        } else {
            $entrada = $Hora_Entrada . " / PM";
        }
    } else {
        echo "0 / Error, el formato de la \"Hora de Entrada\" no es el correcto";
        die();
    }

    if ($Hora_Salida != '' && $AmPm2 != '-1') {
        if ($AmPm2 == 1) {
            $salida = $Hora_Salida . " / AM";
        } else {
            $salida = $Hora_Salida . " / PM";
        }
    } else {
        echo "0 / Error, el formato de la \"Hora de Salida\" no es el correcto";
        die();
    }

    $horario = $entrada . " - " . $salida;

    $laborales = $_REQUEST["laborales"];

    if ($laborales == '') {
        echo "0 / Error, el campo \"Días Laborales\" no puede estar vacio";
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
    $SQL .= " shora_entrada_trab = '$entrada',";
    $SQL .= " shora_salida_trab = '$salida',";
    $SQL .= " shorario_trabajo = '$horario'";
    $SQL .= " WHERE";
    $SQL .= " id = '$id'";

    if ($row = pg_query($conn, $SQL)) {
        echo "1 / Datos guardados exitosamente";
        $_SESSION['id_oferta'] = $id;
    } else {
        echo "0 / Error, por favor intentar más tarde";
    }
} else {
    echo "Ocurrió un error inesperado, intente más tarde";
}
