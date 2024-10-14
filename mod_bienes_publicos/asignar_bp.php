<?php
include "conexion.php";

$ci1=$_REQUEST["id_c1"];
$ci2=$_REQUEST["id_c2"];
$ci3=$_REQUEST["id_c3"];
$cbp=$_REQUEST["cbp2"];
$id_c=$_REQUEST["id_cbp2"];
$fa=$_REQUEST["fa"];
$id_usuario = $_SESSION["id_usuario"];

echo"0 / ".$ci1." / ".$ci2." / ".$ci3." / ".$cbp." / ".$id_c." / ".$fa." / ".$id_usuario;

/* $sql2 = "SELECT * FROM bienes_publicos.bienes_publicos_personas WHERE bienes_publicos_id='$id_c'  AND benabled = 'TRUE'";
        $rs2 = pg_query($conn, $sql2);
        if (pg_num_rows($rs2) > 0) {
       echo "0 / ";
         } else {} */

           /*  $sql="INSERT INTO bienes_publicos.bienes_publicos_personas(bienes_publicos_id, personales_id,dfecha_asignacion, resp_patrimonial_id, resp_dependencia_id, nusuario_creacion) VALUES ( '$id_c', '$id_c3','$fa', '$ci1', '$ci2', '$id_usuario')";
                if ($row = pg_query($conn, $sql)) { */
 /*
                    $i = 0;
                    $sql2="SELECT id, sdescripcion FROM bienes_publicos.origen WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                    $row2 = pg_query($conn, $sql2);
                    $or = pg_fetch_all($row2);
                    while ($or = pg_fetch_assoc($row2)) {
        
                        $i++;
                        $cosa .= "<tr>
                                <td class=\"td center\">" . $i . "</td>
                                <td class=\"td center\" style=\"width: 68%;\">" . $or['sdescripcion'] . "</td>
                                <td class=\"td center\" id=\"botones\">
                                    <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                   \"onclick=\"accion_modificar('" . $or['id'] . "','" . $or['sdescripcion'] . "')\">Modificar</button>
                                    <button type=\"button\" class=\"btn btn-danger\"  style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px;border-radius: 30px; width: auto;\" onclick=\"accion_eliminar(" . $or['id'] . ")\">Eliminar </button>
                                </td>
                            </tr>
                        ";
                    } */
                   /*  echo "1 / Nuevo registro creado exitosamente / ".$cosa;
                } else {
                    echo "0 / Error: " . $sql;
                } */
            
?>