<?php
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

$motivo2 = $_REQUEST["motivo2"];
$srif = $_REQUEST["srif"];



$r = "SELECT empresa.id, srif,srazon_social,sdenominacion_comercial,tipo_capital_id as ca,
tipo_capital.sdescripcion as capital,estado_id,municipio_id,parroquia_id,
entidad.sdescripcion as estado,
municipio.sdescripcion as minicipio,
parroquia.sdescripcion as parroquia,
act_economica4 as nombre,sdireccion_fiscal 
FROM reporte_ceet.empresa
inner join reporte_ceet.tipo_capital on tipo_capital.id = reporte_ceet.empresa.tipo_capital_id 

LEFT JOIN public.entidad ON entidad.nentidad=empresa.estado_id 
LEFT JOIN public.municipio ON municipio.nmunicipio=empresa.municipio_id 
LEFT JOIN public.parroquia ON parroquia.nparroquia=empresa.parroquia_id 
WHERE srif = '" . $srif . "'  LIMIT 1";
$ra = pg_query($conn, $r);
$persona = pg_fetch_assoc($ra);

/* echo " 1 / " . $r; */

$empresa_id = $persona["id"];
/* $_SESSION["id_a"] = $empresa_id; */
/* echo "1 / " . $motivo2 . " " . $srif . " " . $empresa_id;
die(); */

$sql = "SELECT * FROM";
$sql .= " reporte_ceet.abordaje_rnee_empresa";
$sql .= " WHERE";
$sql .= " rnee_empresa_id = '$empresa_id'";
$sql .= " AND";
$sql .= " benabled = 'TRUE'";
$row = pg_query($conn, $sql);

if ($persona = pg_fetch_assoc($row)) {
    $SQL = "INSERT INTO";
    $SQL .= " reporte_ceet.motivos_vis_rnee_empresa";
    $SQL .= " (";
    $SQL .= " rnee_empresa_id,";
    $SQL .= " motivo_visita_id,";
    $SQL .= " nusuario_creacion";
    $SQL .= ")";
    $SQL .= " VALUES";
    $SQL .= " (";
    $SQL .= "'$empresa_id',";
    $SQL .= "'$motivo2',";
    $SQL .= " 13289657";
    $SQL .= ");";

    if ($resultado = pg_query($conn, $SQL)) {
        $bien = 1;
    } else {
        echo "1 / Falló la inserción, razón: " . $SQL;
        die();
    }
    $PG9 = "SELECT motivos_vis_rnee_empresa.rnee_empresa_id, ";
    $PG9 .= "motivos_vis_rnee_empresa.motivo_visita_id, ";
    $PG9 .= "reporte_ceet.motivo_visita.sdescripcion,";
    $PG9 .= "motivos_vis_rnee_empresa.dfecha_visita, ";
    $PG9 .= "motivos_vis_rnee_empresa.benabled, ";
    $PG9 .= "motivos_vis_rnee_empresa.nusuario_creacion, ";
    $PG9 .= "motivos_vis_rnee_empresa.dfecha_creacion, ";
    $PG9 .= "motivos_vis_rnee_empresa.nusuario_actualizacion, ";
    $PG9 .= "motivos_vis_rnee_empresa.dfecha_actualizacion, ";
    $PG9 .= "motivos_vis_rnee_empresa.id ";
    $PG9 .= "FROM reporte_ceet.motivos_vis_rnee_empresa ";
    $PG9 .= "inner join reporte_ceet.motivo_visita on reporte_ceet.motivo_visita.id = motivos_vis_rnee_empresa.motivo_visita_id ";
    $PG9 .= "WHERE ";
    $PG9 .= "motivos_vis_rnee_empresa.rnee_empresa_id = '" . $empresa_id  . "' ";
    $PG9 .= "AND ";
    $PG9 .= "motivos_vis_rnee_empresa.benabled = 'TRUE' ";
    $PG9 .= "OFFSET 0";
    /*     echo " 1 / " . $PG9; */

    $row2 = pg_query($conn, $PG9);

    $cosa = " / ";
    while ($persona2 = pg_fetch_assoc($row2)) {

        $valor = $persona2["id"];

        $i++;
        $cosa .= "<tr>
                <td>" . $i . "</td>
                <td>" . $persona2['sdescripcion'] . "</td>
                <td id=\"botones\">
                    <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar_empresa(" . $valor . "," . $empresa_id . ")\">Eliminar </button>
                </td>
            </tr>
        ";
    }
    if ($bien == 1) {
        echo "1 / Se agregó correctamente";

        if ($cosa == "") {
            $cosa = "No hay ningún dato en la tabla";
            echo $cosa;
            die();
        }
        echo $cosa;
    }
} else {
    echo "1 / No se encontró a la Empresa";
    die();
}
