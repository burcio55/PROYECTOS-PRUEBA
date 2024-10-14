<?php
include "conexion.php";

$accion = $_REQUEST["accion"];

if ($accion == 1) {
    $id_usuario = $_SESSION["id_usuario"];
    $marca = $_REQUEST["marc2"];
    $fecha = $_REQUEST["fechaHora"];

    if ($marca == "") {
        echo " 0 / todo mal";
    } else {
        $sql2 = "SELECT * FROM bienes_publicos.marca WHERE sdescripcion='$marca'  AND benabled = 'TRUE'";
        $rs2 = pg_query($conn, $sql2);
        if (pg_num_rows($rs2) > 0) {
            echo "0 / Esta marca ya está registrada";
        } else {

            $sql = "INSERT INTO bienes_publicos.marca(sdescripcion,  nusuario_creacion) VALUES ('" . $marca . "', '" . $id_usuario . "')";
            if ($row = pg_query($conn, $sql)) {

                $i = 0;
                $sql2 = "SELECT id, sdescripcion FROM bienes_publicos.marca WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                $row2 = pg_query($conn, $sql2);
                $or = pg_fetch_all($row2);
                while ($or = pg_fetch_assoc($row2)) {

                    $i++;
                    $cosa .= "<tr>
                            <td class=\"td center\">" . $i . "</td>
                            <td class=\"td center\" style=\"width: 68%;\">" . $or['sdescripcion'] . "</td>
                            <td class=\"td center\" id=\"botones\">
                                <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                   \"onclick=\"accion_modificar2('" . $or['id'] . "','" . $or['sdescripcion'] . "')\">Modificar</button>";
                    if ($_SESSION['bienes_publicos_rol'] == 80) {
                        $cosa .= "<button type=\"button\" class=\"btn btn-danger\"  style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px;border-radius: 30px; width: auto;\" onclick=\"asegurar(" . $or['id'] . ")\">Eliminar </button>";
                    }
                    $cosa .= "</td>
                        </tr>
                    ";
                }
                echo "1 / Nuevo registro creado exitosamente / " . $cosa;
            } else {
                echo "0 / Error: " . $sql;
            }
        }
    }
} else
if ($accion == 2) {
    $id = $_REQUEST["id"];
    /* echo "1 / ". $id; */

    $a = "SELECT * FROM bienes_publicos.bienes_publicos WHERE benabled = 'TRUE' AND marca_id='" . $id . "'";

    $res = pg_query($conn, $a);

    if (pg_num_rows($res) > 0) {
        echo "0 / Este \"registro\" está relacionado con un B.P ";
    } else {


        $i = 0;
        $SQL2 = "UPDATE bienes_publicos.marca SET benabled = 'FALSE' WHERE id = '" . $id . "'";
        if ($resultado2 = pg_query($conn, $SQL2)) {
            $i2 = 0;
            $sql2 = "SELECT * FROM bienes_publicos.marca WHERE benabled = 'TRUE' Order By sdescripcion";
            $row2 = pg_query($conn, $sql2);
            $persona2 = pg_fetch_all($row2);

            while ($or2 = pg_fetch_assoc($row2)) {
                $i2++;
                $cosa2 .= "<tr>
                    <td class=\"td center\">" . $i2 . "</td>
                    <td class=\"td center\" style=\"width: 68%;\">" . $or2['sdescripcion'] . "</td>
                    <td class=\"td center\" id=\"botones\">
                    <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"accion_modificar2('" . $or2['id'] . "','" . $or2['sdescripcion'] . "')\">Modificar</button>";
                if ($_SESSION['bienes_publicos_rol'] == 80) {
                    $cosa2 .= "<button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px;border-radius: 30px; width: auto;\" onclick=\"asegurar(" . $or2['id'] . ")\">Eliminar </button>";
                }
                $cosa2 .= "</td>
                </tr>
            ";
            }
            echo "1 / Se eliminó Correctamente el Registro / " . $cosa2;
        } else {
            echo "0 / Error: " . $SQL2;
        }
    }
} else 
if ($accion == 3) {
    $id3 = $_REQUEST["id_mantenimiento3"];
    $marca = $_REQUEST["marc2"];
    $id_usuario3 = $_SESSION["id_usuario"];
    /*  echo "1 / ".$id3." ".$origen3." ".$id_usuario3; */
    $SQL3 = "UPDATE bienes_publicos.marca SET sdescripcion='" . $marca . "', nusuario_actualizacion='" . $id_usuario3 . "' WHERE id ='" . $id3 . "'";
    if ($resultado3 = pg_query($conn, $SQL3)) {
        $i3 = 0;
        $sql3 = "SELECT * FROM bienes_publicos.marca WHERE benabled = 'TRUE' Order By sdescripcion";
        $row3 = pg_query($conn, $sql3);
        $or3 = pg_fetch_all($row3);

        while ($or3 = pg_fetch_assoc($row3)) {

            $i3++;
            $cosa3 .=  "<tr>
            <td class=\"td center\">" . $i3 . "</td>
            <td class=\"td center\" style=\"width: 68%;\">" . $or3['sdescripcion'] . "</td>
            <td class=\"td center\" id=\"botones\">
            <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;\" onclick=\"accion_modificar2('" . $or3['id'] . "','" . $or3['sdescripcion'] . "')\">Modificar</button>";
            if ($_SESSION['bienes_publicos_rol'] == 80) {
                $cosa3 .= "<button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px;border-radius: 30px; width: auto;\" onclick=\"asegurar(" . $or3['id'] . ")\">Eliminar </button>";
            }
            $cosa3 .= "</td>
        </tr>
    ";
        }
        echo "1 / Se modificó correctamente" . " / " . $cosa3;
    } else {
        echo "0 / Falló la actualización: " . $SQL3;
    }
}
