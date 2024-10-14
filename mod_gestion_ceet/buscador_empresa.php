<?php
$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

try {
    $conn3 = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn3 = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

session_start();

/* echo "1 / Llegó al PHP";
die(); */

$PG0 = " SELECT rnee_empresa.id, ";
$PG0 .= " srif,";
$PG0 .= " srazon_social,";
$PG0 .= " sdenominacion_comercial,";
$PG0 .= " public.rnee_tipo_capital.id as capital,";
$PG0 .= " estado_id,";
$PG0 .= " municipio_id,";
$PG0 .= " parroquia_id,";
$PG0 .= " snil,";
$PG0 .= " public.actividad_eco.nombre,";
$PG0 .= " sdireccion_fiscal";
$PG0 .= " FROM";
$PG0 .= " rnee.rnee_empresa";
$PG0 .= " inner join public.rnee_tipo_capital on rnee_tipo_capital.id = rnee.rnee_empresa.rnee_tipo_capital_id";
$PG0 .= " inner join public.actividad_eco on actividad_eco.cod = rnee_empresa.act_economica4";
$PG0 .= " WHERE";
$PG0 .= " srif = '" . $_REQUEST['srif'] . "' AND snil != ''";
$row = pg_query($conn3, $PG0);
$persona = pg_fetch_assoc($row);

/* echo " 0 / " . $PG0;
die(); */

if (pg_num_rows($row) == 0) {

    $host = "10.46.1.93";
    $dbname = "minpptrassi";
    $user = "postgres";
    $pass = "postgres";

    try {
        $con = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
    } catch (PDOException $error) {
        $con = $error;
        echo ("Error al conectar en la Base de Datos " . $error);
    }

    session_start();

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
WHERE srif = '" . $_REQUEST['srif'] . "'";
    $rw = pg_query($con, $r);
    $persona = pg_fetch_assoc($rw);

    if (pg_num_rows($rw) == 0) {

        echo "0 / Esté RIF no se encuentra registrado en la Base de Datos";
        die();
    } else {

        $_SESSION["rnee_empresa_id"] = $persona["id"];
        $rnee_empresa_id = $_SESSION["rnee_empresa_id"];

        $_SESSION["srazon_social"] = $persona["srazon_social"];
        $_SESSION["sdenominacion_comercial"] = $persona["sdenominacion_comercial"];
        $_SESSION["sdescripcion"] = $persona["ca"];
        $_SESSION["estado_id"] = $persona["estado_id"];
        $_SESSION["municipio_id"] = $persona["municipio_id"];
        $_SESSION["parroquia_id"] = $persona["parroquia_id"];
        $_SESSION["snil"] = $persona["snil"];
        $_SESSION["nombre"] = $persona["nombre"];
        $_SESSION["sdireccion_fiscal"] = $persona["sdireccion_fiscal"];


        /* echo "0 / HOLA 1"; */
        $personas = "1 / ";

        $valores = pg_fetch_all($rw);
        foreach ($valores as $valor) {
            $personas .= trim($valor['srazon_social']);
            $personas .= " / ";
            $personas .= trim($valor['sdenominacion_comercial']);
            $personas .= " / ";
            $personas .= trim($valor['ca']);
            $personas .= " / ";
            $personas .= trim($valor['estado_id']);
            $personas .= " / ";
            $personas .= trim($valor['municipio_id']);
            $personas .= " / ";
            $personas .= trim($valor['parroquia_id']);
            $personas .= " / ";
            $personas .= trim($valor['snil']);


            $personas .= " / ";
            $personas .= trim($valor['nombre']);
            $personas .= " / ";
            $personas .= trim($valor['sdireccion_fiscal']);
        }

        echo $personas . " / ";
    }
} else {
    $_SESSION["rnee_empresa_id"] = $persona["id"];
    $rnee_empresa_id = $_SESSION["rnee_empresa_id"];

    $_SESSION["srazon_social"] = $persona["srazon_social"];
    $_SESSION["sdenominacion_comercial"] = $persona["sdenominacion_comercial"];
    $_SESSION["sdescripcion"] = $persona["capital"];
    $_SESSION["estado_id"] = $persona["estado_id"];
    $_SESSION["municipio_id"] = $persona["municipio_id"];
    $_SESSION["parroquia_id"] = $persona["parroquia_id"];
    $_SESSION["snil"] = $persona["snil"];

    $_SESSION["nombre"] = $persona["nombre"];
    $_SESSION["sdireccion_fiscal"] = $persona["sdireccion_fiscal"];

    /* echo "0 / HOLA 1"; */
    $personas = "1 / ";

    $valores = pg_fetch_all($row);
    foreach ($valores as $valor) {
        $personas .= trim($valor['srazon_social']);
        $personas .= " / ";
        $personas .= trim($valor['sdenominacion_comercial']);
        $personas .= " / ";
        $personas .= trim($valor['capital']);
        $personas .= " / ";
        $personas .= trim($valor['estado_id']);
        $personas .= " / ";
        $personas .= trim($valor['municipio_id']);
        $personas .= " / ";
        $personas .= trim($valor['parroquia_id']);
        $personas .= " / ";
        $personas .= trim($valor['snil']);
        $personas .= " / ";
        $personas .= trim($valor['nombre']);
        $personas .= " / ";
        $personas .= trim($valor['sdireccion_fiscal']);
    }

    echo $personas . " / ";
}


/* die(); */

$host = "10.46.1.93";
$dbname = "minpptrassi";
$user = "postgres";
$pass = "postgres";

try {
    $conn2 = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn2 = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
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
$PG9 .= "motivos_vis_rnee_empresa.rnee_empresa_id = '" . $rnee_empresa_id . "' ";
$PG9 .= "AND ";
$PG9 .= "motivos_vis_rnee_empresa.benabled = 'TRUE' ";
$PG9 .= "OFFSET 0";

$row2 = pg_query($conn2, $PG9);

$cosa = "";

while ($persona2 = pg_fetch_assoc($row2)) {

    if ($i != 1) {
        $valor = $persona2["id"];
    }
    $valor2 = current($persona2);

    $i++;
    $cosa .= "<tr>
            <td>" . $i . "</td>
            <td>" . $persona2['sdescripcion'] . "</td>
            <td id=\"botones\">
                <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar_empresa(" . $valor . ")\">Eliminar </button>
            </td>
        </tr>
    ";
}
// En caso de error
if ($cosa == "") {
    echo  "No hay ningún dato en la tabla";
}

echo $cosa . " / ";

$PG10 = "SELECT plan_formacion_rnee_empresa.rnee_empresa_id, ";
$PG10 .= "plan_formacion_rnee_empresa.plan_formacion_id, ";
$PG10 .= "reporte_ceet.plan_formacion.sdescripcion, ";
$PG10 .= "plan_formacion_rnee_empresa.dfecha_plan_formacion, ";
$PG10 .= "plan_formacion_rnee_empresa.benabled, ";
$PG10 .= "plan_formacion_rnee_empresa.nusuario_creacion, ";
$PG10 .= "plan_formacion_rnee_empresa.dfecha_creacion, ";
$PG10 .= "plan_formacion_rnee_empresa.nusuario_actualizacion, ";
$PG10 .= "plan_formacion_rnee_empresa.dfecha_actualizacion, ";
$PG10 .= "plan_formacion_rnee_empresa.id ";
$PG10 .= "FROM reporte_ceet.plan_formacion_rnee_empresa ";
$PG10 .= "inner join reporte_ceet.plan_formacion on reporte_ceet.plan_formacion.id = plan_formacion_rnee_empresa.plan_formacion_id ";
$PG10 .= "WHERE ";
$PG10 .= "plan_formacion_rnee_empresa.rnee_empresa_id = '$rnee_empresa_id' ";
$PG10 .= "AND  ";
$PG10 .= "plan_formacion_rnee_empresa.benabled = 'TRUE'  ";
$PG10 .= "OFFSET 0";

$row3 = pg_query($conn2, $PG10);

$cosa2 = "";

while ($persona3 = pg_fetch_assoc($row3)) {

    if ($i2 != 1) {
        $valor = $persona3["id"];
    }
    $valor2 = current($persona3);

    $i2++;
    $cosa2 .= "<tr>
            <td>" . $i2 . "</td>
            <td>" . $persona3['sdescripcion'] . "</td>
            <td id=\"botones\">
                <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_plan_empresa_del(" . $valor . ")\">Eliminar </button>
            </td>
        </tr>
    ";
}

// En caso de error
if ($cosa2 == "") {
    echo "No hay ningún dato en la tabla";
}

echo $cosa2 . " / ";

$PG11 = "SELECT novedades_rnee_empresa.rnee_empresa_id, ";
$PG11 .= "novedades_rnee_empresa.novedades_id, ";
$PG11 .= "reporte_ceet.novedades.sdescripcion,";
$PG11 .= "novedades_rnee_empresa.dfecha_visita, ";
$PG11 .= "novedades_rnee_empresa.benabled, ";
$PG11 .= "novedades_rnee_empresa.nusuario_creacion, ";
$PG11 .= "novedades_rnee_empresa.dfecha_creacion, ";
$PG11 .= "novedades_rnee_empresa.nusuario_actualizacion, ";
$PG11 .= "novedades_rnee_empresa.dfecha_actualizacion, ";
$PG11 .= "novedades_rnee_empresa.id ";
$PG11 .= "FROM reporte_ceet.novedades_rnee_empresa ";
$PG11 .= "inner join reporte_ceet.novedades on reporte_ceet.novedades.id = novedades_rnee_empresa.novedades_id ";
$PG11 .= "WHERE ";
$PG11 .= "novedades_rnee_empresa.rnee_empresa_id = '$rnee_empresa_id' ";
$PG11 .= "AND ";
$PG11 .= "novedades_rnee_empresa.benabled = 'TRUE' ";
$PG11 .= "OFFSET 0";

$row4 = pg_query($conn2, $PG11);

$cosa3 = "";

while ($persona4 = pg_fetch_assoc($row4)) {

    if ($i3 != 1) {
        $valor = $persona4["id"];
    }
    $valor2 = current($persona4);

    $i3++;
    $cosa3 .= "<tr>
            <td>" . $i3 . "</td>
            <td>" . $persona4['sdescripcion'] . "</td>
            <td id=\"botones\">
                <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_novedades_empresa_del(" . $valor . ")\">Eliminar </button>
            </td>
        </tr>
    ";
}
// En caso de error
if ($cosa3 == "") {
    echo "No hay ningún dato en la tabla";
}

echo $cosa3 . " / ";

$PG12 = "SELECT ambiente_aprendizaje_rnee_empresa.rnee_empresa_id, ";
$PG12 .= "ambiente_aprendizaje_rnee_empresa.ambiente_aprendizaje_id, ";
$PG12 .= "reporte_ceet.ambiente_aprendizaje.sdescripcion, ";
$PG12 .= "ambiente_aprendizaje_rnee_empresa.dfecha_ambiente_aprendizaje, ";
$PG12 .= "ambiente_aprendizaje_rnee_empresa.benabled, ";
$PG12 .= "ambiente_aprendizaje_rnee_empresa.nusuario_creacion, ";
$PG12 .= "ambiente_aprendizaje_rnee_empresa.dfecha_creacion, ";
$PG12 .= "ambiente_aprendizaje_rnee_empresa.nusuario_actualizacion, ";
$PG12 .= "ambiente_aprendizaje_rnee_empresa.dfecha_actualizacion, ";
$PG12 .= "ambiente_aprendizaje_rnee_empresa.id ";
$PG12 .= "FROM reporte_ceet.ambiente_aprendizaje_rnee_empresa ";
$PG12 .= "inner join reporte_ceet.ambiente_aprendizaje on reporte_ceet.ambiente_aprendizaje.id = ambiente_aprendizaje_rnee_empresa.ambiente_aprendizaje_id ";
$PG12 .= "WHERE ";
$PG12 .= "ambiente_aprendizaje_rnee_empresa.rnee_empresa_id = '" . $rnee_empresa_id  . "' ";
$PG12 .= "AND ";
$PG12 .= "ambiente_aprendizaje_rnee_empresa.benabled = 'TRUE'";
$PG12 .= "OFFSET 0";

$row5 = pg_query($conn2, $PG12);

$cosa4 = "";

while ($persona5 = pg_fetch_assoc($row5)) {

    $valor = $persona5["id"];

    $i4++;
    $cosa4 .= "<tr>
            <td>" . $i4 . "</td>
            <td>" . $persona5['sdescripcion'] . "</td>
            <td id=\"botones\">
                <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_aprendizaje_empresa_del(" . $valor . ")\">Eliminar </button>
            </td>
        </tr>
    ";
}
// En caso de error
if ($cosa4 == "") {
    echo "No hay ningún dato en la tabla";
}

echo $cosa4;

/* 


*/
