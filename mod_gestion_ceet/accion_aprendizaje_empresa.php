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

$aprendizaje2 = $_REQUEST["aprendizaje2"];
$srif = $_REQUEST["srif"];

/* echo "1 / " . $aprendizaje2 . " " . $srif;
die(); */
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



$sql = "SELECT * FROM";
$sql .= " reporte_ceet.abordaje_rnee_empresa";
$sql .= " WHERE";
$sql .= " rnee_empresa_id = '$empresa_id'";
$sql .= " AND";
$sql .= " benabled = 'TRUE'";
$row = pg_query($conn, $sql);
if ($persona = pg_fetch_assoc($row)) {
    $SQL = "INSERT INTO";
    $SQL .= " reporte_ceet.ambiente_aprendizaje_rnee_empresa";
    $SQL .= " (";
    $SQL .= " rnee_empresa_id,";
    $SQL .= " ambiente_aprendizaje_id,";
    $SQL .= " nusuario_creacion";
    $SQL .= ")";
    $SQL .= " VALUES";
    $SQL .= " (";
    $SQL .= "'$empresa_id',";
    $SQL .= "'$aprendizaje2',";
    $SQL .= " 13289657";
    $SQL .= ");";

    if ($resultado = pg_query($conn, $SQL)) {
        echo "1 / Se agregó el Ambiente de Aprendizaje con éxito";
    } else {
        echo "1 / Falló la inserción, razón: " . $SQL;
        die();
    }
    $PG9 = "SELECT ambiente_aprendizaje_rnee_empresa.rnee_empresa_id, ";
    $PG9 .= "ambiente_aprendizaje_rnee_empresa.ambiente_aprendizaje_id, ";
    $PG9 .= "reporte_ceet.ambiente_aprendizaje.sdescripcion, ";
    $PG9 .= "ambiente_aprendizaje_rnee_empresa.dfecha_ambiente_aprendizaje, ";
    $PG9 .= "ambiente_aprendizaje_rnee_empresa.benabled, ";
    $PG9 .= "ambiente_aprendizaje_rnee_empresa.nusuario_creacion, ";
    $PG9 .= "ambiente_aprendizaje_rnee_empresa.dfecha_creacion, ";
    $PG9 .= "ambiente_aprendizaje_rnee_empresa.nusuario_actualizacion, ";
    $PG9 .= "ambiente_aprendizaje_rnee_empresa.dfecha_actualizacion, ";
    $PG9 .= "ambiente_aprendizaje_rnee_empresa.id ";
    $PG9 .= "FROM reporte_ceet.ambiente_aprendizaje_rnee_empresa ";
    $PG9 .= "inner join reporte_ceet.ambiente_aprendizaje on reporte_ceet.ambiente_aprendizaje.id = ambiente_aprendizaje_rnee_empresa.ambiente_aprendizaje_id ";
    $PG9 .= "WHERE ";
    $PG9 .= "ambiente_aprendizaje_rnee_empresa.rnee_empresa_id = '" . $empresa_id   . "' ";
    $PG9 .= "AND ";
    $PG9 .= "ambiente_aprendizaje_rnee_empresa.benabled = 'TRUE'";
    $PG9 .= "OFFSET 0";

    $row2 = pg_query($conn, $PG9);

    $cosa = " / ";
    while ($persona2 = pg_fetch_assoc($row2)) {

        $valor = $persona2["id"];

        $i++;
        $cosa .= "<tr>
                <td>" . $i . "</td>
                <td>" . $persona2['sdescripcion'] . "</td>
                <td id=\"botones\">
                    <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_aprendizaje_empresa_del(" . $valor . "," . $empresa_id . ")\">Eliminar </button>
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
} else {
    echo "1 / " . $sql;
    die();
}
