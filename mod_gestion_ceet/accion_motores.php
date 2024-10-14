<?php
$host = "10.46.1.93";
$dbname = "minpptrassi";
$user = "postgres";
$pass = "postgres";

session_start();
include('include/BD.php');
$conn = Conexion::ConexionBD();

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$motor = $_REQUEST["motor"];
$accion = $_REQUEST["accion"];

if ($accion == 1) {

    $sqla = "SELECT * FROM reporte_ceet.motor WHERE sdescripcion='$motor' AND benabled = 'TRUE' ";
    $rs2 = pg_query($conn, $sqla);
    if (pg_num_rows($rs2) > 0) {
        echo "0 / Ya se encuentra registrado este elemento";
    } else {
        $SQL = "INSERT INTO";
        $SQL .= " reporte_ceet.motor";
        $SQL .= " (";
        $SQL .= " sdescripcion,";
        $SQL .= " nusuario_creacion";
        $SQL .= ")";
        $SQL .= " VALUES";
        $SQL .= " (";
        $SQL .= "'$motor',";
        $SQL .= " 13289657";
        $SQL .= ");";

        if ($resultado = pg_query($conn, $SQL)) {
            echo "1 / Se agregó correctamente el Motor";
        } else {
            echo "1 / Falló la inserción, razón: " . $SQL;
            die();
        }

        $PG9 = "SELECT * FROM reporte_ceet.motor WHERE benabled = 'TRUE' ORDER BY sdescripcion";

        $row2 = pg_query($conn, $PG9);

        $cosa = " / ";
        while ($persona2 = pg_fetch_assoc($row2)) {

            $valor = $persona2["id"];

            $sdescripcion = $persona2["sdescripcion"];
            $i++;
            $cosa .= "<tr>
                <td>" . $i . "</td>
                <td>" . $persona2['sdescripcion'] . "</td>
                <td id=\"botones\">
                    <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #e99002; border-radius: 30px;\" onclick=\"accion_motor_modificar('$valor','$sdescripcion')\">Modificar</button>
                    <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_motor_eliminar(" . $valor . ")\">Eliminar </button>
                </td>
            </tr>
        ";
        }
        if ($cosa == "") {
            $cosa = "No hay ningún dato en la tabla";
            echo $cosa;
            die();
        }
        echo $cosa;
    }
} else
if ($accion == 2) {
    $SQL = "UPDATE reporte_ceet.motor SET benabled = 'FALSE' WHERE id = '" . $motor . "'";
    if ($resultado = pg_query($conn, $SQL)) {
        echo "1 / Se eliminó el registro con éxito ";
    } else {
        echo "Falló la eliminación por: " . $SQL;
        die();
    }
    $PG9 = "SELECT * FROM reporte_ceet.motor WHERE benabled = 'TRUE' ORDER BY sdescripcion";

    $row2 = pg_query($conn, $PG9);

    $cosa = " / ";
    while ($persona2 = pg_fetch_assoc($row2)) {

        $valor = $persona2["id"];

        $sdescripcion = $persona2["sdescripcion"];
        $i++;
        $cosa .= "<tr>
                <td>" . $i . "</td>
                <td>" . $persona2['sdescripcion'] . "</td>
                <td id=\"botones\">
                    <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #e99002; border-radius: 30px;\" onclick=\"accion_motor_modificar('$valor','$sdescripcion')\">Modificar</button>
                    <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_motor_eliminar(" . $valor . ")\">Eliminar </button>
                </td>
            </tr>
        ";
    }
    if ($cosa == "") {
        $cosa = "No hay ningún dato en la tabla";
        echo $cosa;
        die();
    }
    echo $cosa;
} else
if ($accion == 3) {
    // Se actualiza
    $id_motor = $_REQUEST["id_motor"];
    $sdescripcion = $_REQUEST["motor"];

    $sqla = "SELECT * FROM reporte_ceet.motor WHERE sdescripcion='$sdescripcion' AND benabled = 'TRUE' ";
    $rs2 = pg_query($conn, $sqla);
    if (pg_num_rows($rs2) > 0) {
        echo "0 / Ya se encuentra registrado este elemento";
    } else {

        $SQL = "UPDATE reporte_ceet.motor SET sdescripcion = '" . $sdescripcion . "' WHERE id = '" . $id_motor . "'";
        if ($resultado = pg_query($conn, $SQL)) {
            echo "1 / Se Actualizó con éxito";
        } else {
            echo "1 / Falló la actualización: " . $SQL;
            die();
        }
        $PG9 = "SELECT * FROM reporte_ceet.motor WHERE benabled = 'TRUE' ORDER BY sdescripcion";

        $row2 = pg_query($conn, $PG9);

        $cosa = " / ";
        while ($persona2 = pg_fetch_assoc($row2)) {

            $valor = $persona2["id"];

            $sdescripcion = $persona2["sdescripcion"];
            $i++;
            $cosa .= "<tr>
                <td>" . $i . "</td>
                <td>" . $persona2['sdescripcion'] . "</td>
                <td id=\"botones\">
                    <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #e99002; border-radius: 30px;\" onclick=\"accion_motor_modificar('$valor','$sdescripcion')\">Modificar</button>
                    <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_motor_eliminar(" . $valor . ")\">Eliminar </button>
                </td>
            </tr>
        ";
        }
        if ($cosa == "") {
            $cosa = "No hay ningún dato en la tabla";
            echo $cosa;
            die();
        }
        echo $cosa;
    }
}
