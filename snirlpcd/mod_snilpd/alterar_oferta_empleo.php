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
    echo ("Error al conectar en la Base de Datos " . $error);
}

$accion = $_REQUEST['accion'];
if ($accion == 1) {
    $_SESSION['snirlpcd3'] = $_REQUEST['id'];
} else
    if ($accion == 2) {
    $id = $_REQUEST['id'];

    $sql2 = "SELECT";
    $sql2 .= " *";
    $sql2 .= " FROM";
    $sql2 .= " snirlpcd.postulaciones";
    $sql2 .= " WHERE";
    $sql2 .= " oferta_empleo_id = '$id'";
    $sql2 .= " AND";
    $sql2 .= " benabled = 'true'";
    $row2 = pg_query($conn, $sql2);
    while ($persona = pg_fetch_assoc($row2)) {
        $sql3 = "UPDATE";
        $sql3 .= " snirlpcd.estatus_postulaciones";
        $sql3 .= " SET";
        $sql3 .= " benabled = 'False'";
        $sql3 .= " WHERE";
        $sql3 .= " postulaciones_id = '".$persona['id']."'";
        $row3 = pg_query($conn, $sql3);
    }

    $sql4 = "UPDATE";
    $sql4 .= " snirlpcd.postulaciones";
    $sql4 .= " SET";
    $sql4 .= " benabled = 'False'";
    $sql4 .= " WHERE";
    $sql4 .= " oferta_empleo_id = '".$id."'";
    $row4 = pg_query($conn, $sql4);

    $sql = "UPDATE";
    $sql .= " snirlpcd.oferta_empleo";
    $sql .= " SET";
    $sql .= " benabled = 'False'";
    $sql .= " WHERE";
    $sql .= " id = '$id'";

    if ($row = pg_query($conn, $sql)) {
        echo "La oferta se eliminó correctamente";
    } else {
        echo "Error, por favor intentar más tarde";
    }
} else
    if ($accion == 3) {
    $_SESSION['id_propuesta'] = $_REQUEST['id'];
} else
    if ($accion == 4) {
    $persona_id = $_REQUEST['id_persona'];
    $postulacion_id = $_REQUEST['id_postulacion'];
    $_SESSION['persona_id'] = $persona_id;
    $_SESSION['postulacion_discapacidad'] = $postulacion_id;

    $SQL = "SELECT";
    $SQL .= " *";
    $SQL .= " FROM";
    $SQL .= " snirlpcd.estatus_postulaciones";
    $SQL .= " WHERE";
    $SQL .= " postulaciones_id = '$postulacion_id'";
    $SQL .= " AND";
    $SQL .= " benabled = 'true'";
    $row = pg_query($conn, $SQL);
    $persona = pg_fetch_assoc($row);

    if ($persona['estatus_id'] == 1) {
        $query = "INSERT INTO";
        $query .= " snirlpcd.estatus_postulaciones";
        $query .= " (";
        $query .= " postulaciones_id,";
        $query .= " estatus_id";
        $query .= " )";
        $query .= " VALUES";
        $query .= " (";
        $query .= " '$postulacion_id',";
        $query .= " '2'";
        $query .= " )";

        $row2 = pg_query($conn, $query);

        $query2 = "UPDATE";
        $query2 .= " snirlpcd.estatus_postulaciones";
        $query2 .= " SET";
        $query2 .= " benabled = 'False'";
        $query2 .= " WHERE";
        $query2 .= " postulaciones_id = '$postulacion_id'";
        $query2 .= " AND";
        $query2 .= " estatus_id = '1'";

        $row3 = pg_query($conn, $query2);
    }
} else
    if ($accion == 5) {
    $postulacion_id = $_SESSION['postulacion_discapacidad'];

    /* $SQL = "SELECT";
    $SQL .= " *";
    $SQL .= " FROM";
    $SQL .= " snirlpcd.estatus_postulaciones";
    $SQL .= " WHERE";
    $SQL .= " postulaciones_id = '$postulacion_id'";
    $SQL .= " AND";
    $SQL .= " benabled = 'true'";
    $row = pg_query($conn, $SQL);
    $persona = pg_fetch_assoc($row);

    if ($persona['estatus_id'] == 2) { */
        $query = "INSERT INTO";
        $query .= " snirlpcd.estatus_postulaciones";
        $query .= " (";
        $query .= " postulaciones_id,";
        $query .= " estatus_id";
        $query .= " )";
        $query .= " VALUES";
        $query .= " (";
        $query .= " '$postulacion_id',";
        $query .= " '4'";
        $query .= " )";

        if ($row2 = pg_query($conn, $query)) {
            $query2 = "UPDATE";
            $query2 .= " snirlpcd.estatus_postulaciones";
            $query2 .= " SET";
            $query2 .= " benabled = 'False'";
            $query2 .= " WHERE";
            $query2 .= " postulaciones_id = '$postulacion_id'";
            $query2 .= " AND";
            $query2 .= " estatus_id = '2'";

            $row3 = pg_query($conn, $query2);
        } else {
            echo "Error, intente nuevamente";
        }
    /* } else {
        echo "Error, intente nuevamente";
    } */
} else
    if ($accion == 6) {
    $postulacion_id = $_SESSION['postulacion_discapacidad'];

    $SQL = "SELECT";
    $SQL .= " *";
    $SQL .= " FROM";
    $SQL .= " snirlpcd.estatus_postulaciones";
    $SQL .= " WHERE";
    $SQL .= " postulaciones_id = '$postulacion_id'";
    $SQL .= " AND";
    $SQL .= " benabled = 'true'";
    $row = pg_query($conn, $SQL);
    $persona = pg_fetch_assoc($row);

    if ($persona['estatus_id'] == 2) {
        $query = "INSERT INTO";
        $query .= " snirlpcd.estatus_postulaciones";
        $query .= " (";
        $query .= " postulaciones_id,";
        $query .= " estatus_id";
        $query .= " )";
        $query .= " VALUES";
        $query .= " (";
        $query .= " '$postulacion_id',";
        $query .= " '6'";
        $query .= " )";

        if ($row2 = pg_query($conn, $query)) {
            echo "2 / Se ha guardado el cambio exitosamente";

            $query2 = "UPDATE";
            $query2 .= " snirlpcd.estatus_postulaciones";
            $query2 .= " SET";
            $query2 .= " benabled = 'False'";
            $query2 .= " WHERE";
            $query2 .= " postulaciones_id = '$postulacion_id'";
            $query2 .= " AND";
            $query2 .= " estatus_id = '2'";

            $row3 = pg_query($conn, $query2);
        } else {
            echo "1 / Error, intente nuevamente";
        }
    } else
        if ($persona['estatus_id'] == 6) {
        echo "3 / Este Usuario ya tiene una cita programada";
    } else {
        echo "1 / Error, intente nuevamente";
    }
} else
    if ($accion == 7) {
    $postulacion_id = $_SESSION['postulacion_discapacidad'];
    $fecha = $_REQUEST['fecha'];
    if ($fecha == '') {
        echo "1 / Debe llenar el campo de Fecha";
        die();
    }
    $valor = date('Y-m-d');
    if ($fecha <= $valor) {
        echo "1 / La fecha no puede ser menor o igual a la actual";
        die();
    }
    $hora = $_REQUEST['hora'];
    if ($hora == '') {
        echo "1 / Debe llenar el campo de la hora";
        die();
    } else {
        if (!ereg("^[0-9]{2}[:][0-9]{2}$", $hora)) {
            echo "1 / La Hora no posse un formato válido ejemplo: 05:30";
            die();
        }
    }
    $ampm = $_REQUEST['ampm'];
    if ($ampm == -1) {
        echo "1 / Debe llenar el campo de la hora";
        die();
    } else
        if ($ampm == 1) {
        $horas = $hora . "/AM";
    } else {
        $horas = $hora . "/PM";
    }
    $SQL = "SELECT";
    $SQL .= " *";
    $SQL .= " FROM";
    $SQL .= " snirlpcd.estatus_postulaciones";
    $SQL .= " WHERE";
    $SQL .= " postulaciones_id = '$postulacion_id'";
    $SQL .= " AND";
    $SQL .= " benabled = 'true'";
    $row = pg_query($conn, $SQL);
    $persona = pg_fetch_assoc($row);

    if ($persona['estatus_id'] == 6) {
        $sql = "INSERT INTO";
        $sql .= " snirlpcd.entrevista";
        $sql .= " (";
        $sql .= " postulaciones_id,";
        $sql .= " dfecha_entrevista,";
        $sql .= " shora_entrevista";
        $sql .= " )";
        $sql .= " VALUES";
        $sql .= " (";
        $sql .= " '$postulacion_id',";
        $sql .= " '$fecha',";
        $sql .= " '$horas'";
        $sql .= " )";
        $valor = pg_query($conn, $sql);

        $query = "INSERT INTO";
        $query .= " snirlpcd.estatus_postulaciones";
        $query .= " (";
        $query .= " postulaciones_id,";
        $query .= " estatus_id";
        $query .= " )";
        $query .= " VALUES";
        $query .= " (";
        $query .= " '$postulacion_id',";
        $query .= " '5'";
        $query .= " )";

        if ($row2 = pg_query($conn, $query)) {
            echo "2 / Se ha guardado el cambio exitosamente";

            $query2 = "UPDATE";
            $query2 .= " snirlpcd.estatus_postulaciones";
            $query2 .= " SET";
            $query2 .= " benabled = 'False'";
            $query2 .= " WHERE";
            $query2 .= " postulaciones_id = '$postulacion_id'";
            $query2 .= " AND";
            $query2 .= " estatus_id = '6'";

            $row3 = pg_query($conn, $query2);
        } else {
            echo "1 / Error, intente nuevamente1";
        }
    } else
        if ($persona['estatus_id'] == 5) {
        echo "1 / Este Usuario ya tiene una cita programada";
    } else {
        echo "1 / Error, intente nuevamente2";
    }
} else
    if ($accion == 8) {
    $postulacion_id = $_REQUEST['id'];

    $SQL = "SELECT";
    $SQL .= " *";
    $SQL .= " FROM";
    $SQL .= " snirlpcd.estatus_postulaciones";
    $SQL .= " WHERE";
    $SQL .= " postulaciones_id = '$postulacion_id'";
    $SQL .= " AND";
    $SQL .= " benabled = 'true'";
    $row = pg_query($conn, $SQL);
    $persona = pg_fetch_assoc($row);

    if ($persona['estatus_id'] == 5) {
        $query = "INSERT INTO";
        $query .= " snirlpcd.estatus_postulaciones";
        $query .= " (";
        $query .= " postulaciones_id,";
        $query .= " estatus_id";
        $query .= " )";
        $query .= " VALUES";
        $query .= " (";
        $query .= " '$postulacion_id',";
        $query .= " '4'";
        $query .= " )";

        $row2 = pg_query($conn, $query);

        $query2 = "UPDATE";
        $query2 .= " snirlpcd.estatus_postulaciones";
        $query2 .= " SET";
        $query2 .= " benabled = 'False'";
        $query2 .= " WHERE";
        $query2 .= " postulaciones_id = '$postulacion_id'";
        $query2 .= " AND";
        $query2 .= " estatus_id = '5'";

        $row3 = pg_query($conn, $query2);

        $query3 = "UPDATE";
        $query3 .= " snirlpcd.entrevista";
        $query3 .= " SET";
        $query3 .= " benabled = 'False'";
        $query3 .= " WHERE";
        $query3 .= " postulaciones_id = '$postulacion_id'";

        $row4 = pg_query($conn, $query3);
    }
}else
if ($accion == 9) {
    $_SESSION['snirlpcd3'] = '';
}
