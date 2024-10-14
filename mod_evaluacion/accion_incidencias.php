<?php
include("BD.php");

$accion = $_REQUEST["accion"];
$id_persona = $_SESSION["id_usuario"];

/* echo " 1 / " . $incidencia . " " . $periodo . " " . $id_personas;
die(); */

if ($accion == 1) {
    $incidencia = $_REQUEST["incidencia"];

    $SQL = "INSERT INTO";
    $SQL .= " evaluacion_desemp.incidencias";
    $SQL .= " (";
    $SQL .= " sdescripcion,";
    $SQL .= " nusuario_creacion";
    $SQL .= ")";
    $SQL .= " VALUES";
    $SQL .= " (";
    $SQL .= "'$incidencia',";
    $SQL .= "'$id_persona'";
    $SQL .= ");";

    /* echo " 1 / " . $SQL;
    die(); */
    if ($resultado = pg_query($conn, $SQL)) {

        $i = 0;
        $sql = "SELECT * FROM evaluacion_desemp.incidencias WHERE benabled = 'TRUE' Order By sdescripcion";
        $row = pg_query($conn, $sql);
        $persona = pg_fetch_all($row);

        while ($persona = pg_fetch_assoc($row)) {

            $i++;
            $cosa .= "<tr>
                    <td class=\"td center\">" . $i . "</td>
                    <td class=\"td center\" style=\"width: 70%;\">" . $persona['sdescripcion'] . "</td>
                    <td class=\"td center\" id=\"botones\">
                        <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #e99002; border-radius: 30px;\" onclick=\"accion_modificar_incidencia('" . $persona['id'] . "','" . $persona['sdescripcion'] . "')\">Modificar</button>
                        <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar_incidencia(" . $persona['id'] . ")\">Eliminar </button>
                    </td>
                </tr>
            ";
        }
        echo "1 / Se agregó correctamente" . " / " . $cosa;
    } else {
        echo "1 / Falló la inserción, razón: " . $SQL;
        die();
    }
} else
if ($accion == 2) {
    $id_incidencia = $_REQUEST["id_incidencia"];
    $SQL2 = "UPDATE evaluacion_desemp.incidencias SET benabled = 'FALSE' WHERE id = '" . $id_incidencia . "'";
    if ($resultado2 = pg_query($conn, $SQL2)) {

        $i2 = 0;
        $sql2 = "SELECT * FROM evaluacion_desemp.incidencias WHERE benabled = 'TRUE' Order By sdescripcion";
        $row2 = pg_query($conn, $sql2);
        $persona2 = pg_fetch_all($row2);

        while ($persona2 = pg_fetch_assoc($row2)) {

            $i2++;
            $cosa2 .= "<tr>
                    <td class=\"td center\">" . $i2 . "</td>
                    <td class=\"td center\" style=\"width: 70%;\">" . $persona2['sdescripcion'] . "</td>
                    <td class=\"td center\" id=\"botones\">
                        <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #e99002; border-radius: 30px;\" onclick=\"accion_modificar_incidencia('" . $persona2['id'] . "','" . $persona2['sdescripcion'] . "')\">Modificar</button>
                        <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar_incidencia(" . $persona2['id'] . ")\">Eliminar </button>
                    </td>
                </tr>
            ";
        }
        echo "1 / Se eliminó correctamente" . " / " . $cosa2;
        die();
    } else {
        echo "1 / Falló la inserción, razón: " . $SQL2;
        die();
    }
} else
if ($accion == 3) {
    $id_incidencia = $_REQUEST["id_incidencia"];
    $incidencia = $_REQUEST["incidencia"];

    $SQL3 = "UPDATE evaluacion_desemp.incidencias SET sdescripcion = '" . $incidencia . "' WHERE id = '" . $id_incidencia . "'";
    if ($resultado3 = pg_query($conn, $SQL3)) {

        $i3 = 0;
        $sql3 = "SELECT * FROM evaluacion_desemp.incidencias WHERE benabled = 'TRUE' Order By sdescripcion";
        $row3 = pg_query($conn, $sql3);
        $persona3 = pg_fetch_all($row3);

        while ($persona3 = pg_fetch_assoc($row3)) {

            $i3++;
            $cosa3 .= "<tr>
                    <td class=\"td center\">" . $i3 . "</td>
                    <td class=\"td center\" style=\"width: 70%;\">" . $persona3['sdescripcion'] . "</td>
                    <td class=\"td center\" id=\"botones\">
                        <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #e99002; border-radius: 30px;\" onclick=\"accion_modificar_incidencia('" . $persona3['id'] . "','" . $persona3['sdescripcion'] . "')\">Modificar</button>
                        <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar_incidencia(" . $persona3['id'] . ")\">Eliminar </button>
                    </td>
                </tr>
            ";
        }
        echo "1 / Se modificó correctamente" . " / " . $cosa3;
        die();
    } else {
        echo "1 / Falló la actualización: " . $SQL3;
        die();
    }
} else
if ($accion == 4) {

    $cedula2 = $_REQUEST["cedula2"];
    $razon = $_REQUEST["razon"];
    $desde2 = $_REQUEST["desde2"];
    $hasta2 = $_REQUEST["hasta2"];
    $persona_id2 = $_SESSION["persona_incidencia_id"];
    $obs = $_REQUEST["obs"];

    if ($desde2 > $hasta2) {
        echo "0 / La fecha de inicio no puede ser menor a la del final";
        die();
    } else
    if ($desde2 == $hasta2) {
        echo "0 / Las fechas no pueden ser iguales";
        die();
    }

    $periodo = $_SESSION["Periodo"];

    $SQL = "INSERT INTO";
    $SQL .= " evaluacion_desemp.personas_incidencias";
    $SQL .= " (";
    $SQL .= " personales_id,";
    $SQL .= " incidencias_id,";
    $SQL .= " periodo_eval_id,";
    $SQL .= " dfecha_inicio_incid,";
    $SQL .= " dfecha_fin_incid,";
    $SQL .= " sobservaciones,";
    $SQL .= " nusuario_creacion";
    $SQL .= ")";
    $SQL .= " VALUES";
    $SQL .= " (";
    $SQL .= "'$persona_id2',";
    $SQL .= "'$razon',";
    $SQL .= "'$periodo',";
    $SQL .= "'$desde2',";
    $SQL .= "'$hasta2',";
    $SQL .= "'$obs',";
    $SQL .= "'$cedula2'";
    $SQL .= ");";

    /* echo " 1 / " . $SQL;
    die(); */
    if ($resultado = pg_query($conn, $SQL)) {
        echo "1 / Se agregó correctamente";
        die();
    } else {
        echo "1 / " . $SQL;
        die();
    }
}
