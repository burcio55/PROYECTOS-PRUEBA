<?php

include("BD.php");

$input2 = $_REQUEST["input2"];

$SQL = "SELECT
    personales.id as id,
    personales.cedula as cedula,
    periodo_eval_id as evaluacion,
    personales.nacionalidad as nacionalidad,
    personales.primer_apellido as apellido1,
    personales.segundo_apellido as apellido2,
    personales.primer_nombre as nombre1,
    personales.segundo_nombre as nombre2,
    recibo_pago.ncodigo_nomina as codigo_nom,
    personales.subicacion_fisica as ubicacion_fisica_actual,
    personales.scargo_actual_ejerce as cargo_actual_ejerce,
    public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
    public.cargos.sdescripcion as cargo,
    public.cargos.id as cargo_id,
    public.tipo_trabajador.ncodigo as codigo_tipos_trabajadores,
    public.ubicacion_administrativa.sdescripcion as ubicacion_adm,
    public.ubicacion_administrativa.scodigo as ubicacion_scodigo,
    COALESCE(evaluacion_desemp.personas_incidencias.nusuario_creacion, 0) as incidencia_cedula,
    COALESCE(evaluacion_desemp.personas_incidencias.dfecha_fin_incid, '1970-01-01') as fecha,
    COALESCE(evaluacion_desemp.personas_incidencias.sobservaciones, '') as observaciones
    FROM public.personales
    LEFT JOIN recibos_pagos_constancias.recibo_pago ON recibo_pago.personales_cedula = personales.cedula
    LEFT JOIN public.cargos ON recibo_pago.cargos_id = cargos.id
    LEFT JOIN public.tipo_trabajador ON recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo
    LEFT JOIN evaluacion_desemp.personas_incidencias ON evaluacion_desemp.personas_incidencias.nusuario_creacion = personales.cedula AND evaluacion_desemp.personas_incidencias.benabled = 'TRUE'
    LEFT JOIN public.ubicacion_administrativa ON recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo
    LEFT JOIN public.ubicacion_fisica ON recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo
    WHERE personales.cedula = '$input2' AND recibo_pago.nestatus = '1'
    ORDER BY recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC
    LIMIT 1";

$row = pg_query($conn, $SQL);
$persona = pg_fetch_assoc($row);


if ($persona == 0) {
    // Mostrar mensaje de no encontrado
    echo "0 / " . $SQL;
    die();
}

$_SESSION["Persona_id2"] = $persona["id"];
$ayo = date('y');
$personas = "1 / ";

$error = "Error que no debe salir";

$valores = pg_fetch_all($row);
foreach ($valores as $valor) {
    $nombres = trim($valor['apellido1']) . " " . trim($valor['apellido2']) . " " . trim($valor['nombre1']) . " " . trim($valor['nombre2']);
    $personas .= $nombres . " / " . trim($valor['codigo_nom']) . " / " . trim($valor['cargo']) . " / " . trim($valor['ubicacion_adm']) . " / " . trim($valor['ubicacion_fisica_actual']) . " / " . trim($valor['cargo_actual_ejerce']) . " / " . trim($valor['id']);

    $_SESSION["persona_incidencia_id"] = $valor['id'];

    $personas .= " / " . trim($valor['cargo_id']) . " / " . $_SESSION["Periodo"] . " / " . $ayo . " / " . trim($valor['codigo_tipos_trabajadores']) . " / " . trim($valor['ubicacion_scodigo']) . " / " . trim($valor['codigo_tipos_trabajadores']) . " / " . trim($valor['tipo_trabajador']) . " / ";

    // Verificar si la fecha de fin de incidencia ha pasado
    $fecha_fin = strtotime($valor['fecha']);
    $fecha_actual = strtotime(date('Y-m-d'));

    if ($fecha_fin <= $fecha_actual) {
        // Actualizar la base de datos para inhabilitar la incidencia
        $updateSQL = "UPDATE evaluacion_desemp.personas_incidencias
                      SET benabled = 'FALSE'
                      WHERE nusuario_creacion = '$input2'
                      AND dfecha_fin_incid <= '" . date('Y-m-d', $fecha_actual) . "'";
        pg_query($conn, $updateSQL);
    
        // Recargar los datos actualizados
        $row = pg_query($conn, $SQL);
        $persona = pg_fetch_assoc($row);
        $valores = pg_fetch_all($row);
    
        $personas .= " ";
    } else {
        // Imprimir mensaje de error y cerrar el proceso
        $personas .= trim($valor['incidencia_cedula']);
        echo "ERROR: No se puede evaluar a este funcionario porque tiene una incidencia registrada que aún no ha terminado.";
        die(); // O puedes usar die() en su lugar
    }

    $personas .= " / ";
    $personas .= trim($valor['fecha']);
    $personas .= " / ";
    $personas .= trim($valor['observaciones']);
}

// Confirmar la transacción
pg_query($conn, "COMMIT");

echo htmlspecialchars($personas) . " / " . "<script>alert(" . json_encode($error) . ");</script>";
 
/* echo "0 / HOLA 1"; */
/* $personas = "1 / ";

$valores = pg_fetch_all($rs);
foreach ($valores as $valor) {
    $personas .= trim($valor['primer_nombre']);
    $personas .= " / ";
    $personas .= trim($valor['segundo_nombre']);
    $personas .= " / ";
    $personas .= trim($valor['primer_apellido']);
    $personas .= " / ";
    $personas .= trim($valor['segundo_apellido']);
    $personas .= " / ";
    $personas .= trim($valor['sexo']);
}

echo $personas . " / ";

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

$PG9 = "SELECT motivos_vis_trabajador_indep.trabajador_indep_id, ";
$PG9 .= "motivos_vis_trabajador_indep.motivo_visita_id, ";
$PG9 .= "reporte_ceet.motivo_visita.sdescripcion,";
$PG9 .= "motivos_vis_trabajador_indep.dfecha_visita, ";
$PG9 .= "motivos_vis_trabajador_indep.benabled, ";
$PG9 .= "motivos_vis_trabajador_indep.nusuario_creacion, ";
$PG9 .= "motivos_vis_trabajador_indep.dfecha_creacion, ";
$PG9 .= "motivos_vis_trabajador_indep.nusuario_actualizacion, ";
$PG9 .= "motivos_vis_trabajador_indep.dfecha_actualizacion, ";
$PG9 .= "motivos_vis_trabajador_indep.id ";
$PG9 .= "FROM reporte_ceet.motivos_vis_trabajador_indep ";
$PG9 .= "inner join reporte_ceet.motivo_visita on reporte_ceet.motivo_visita.id = motivos_vis_trabajador_indep.motivo_visita_id ";
$PG9 .= "WHERE ";
$PG9 .= "motivos_vis_trabajador_indep.trabajador_indep_id = '" . $_SESSION["trabajador_indep_id"]  . "' ";
$PG9 .= "AND ";
$PG9 .= "motivos_vis_trabajador_indep.benabled = 'TRUE' ";
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
                <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar(" . $valor . ")\">Eliminar </button>
            </td>
        </tr>
    ";
}
// En caso de error
if ($cosa == "") {
    echo "No hay ningún dato en la tabla";
}

echo $cosa . " / ";

$PG10 = "SELECT plan_formacion_trabajador_indep.trabajador_indep_id, ";
$PG10 .= "plan_formacion_trabajador_indep.plan_formacion_id, ";
$PG10 .= "reporte_ceet.plan_formacion.sdescripcion, ";
$PG10 .= "plan_formacion_trabajador_indep.dfecha_plan_formacion, ";
$PG10 .= "plan_formacion_trabajador_indep.benabled, ";
$PG10 .= "plan_formacion_trabajador_indep.nusuario_creacion, ";
$PG10 .= "plan_formacion_trabajador_indep.dfecha_creacion, ";
$PG10 .= "plan_formacion_trabajador_indep.nusuario_actualizacion, ";
$PG10 .= "plan_formacion_trabajador_indep.dfecha_actualizacion, ";
$PG10 .= "plan_formacion_trabajador_indep.id ";
$PG10 .= "FROM reporte_ceet.plan_formacion_trabajador_indep ";
$PG10 .= "inner join reporte_ceet.plan_formacion on reporte_ceet.plan_formacion.id = plan_formacion_trabajador_indep.plan_formacion_id ";
$PG10 .= "WHERE ";
$PG10 .= "plan_formacion_trabajador_indep.trabajador_indep_id = '" . $_SESSION["trabajador_indep_id"]  . "' ";
$PG10 .= "AND  ";
$PG10 .= "plan_formacion_trabajador_indep.benabled = 'TRUE'  ";
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
                <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar2(" . $valor . ")\">Eliminar </button>
            </td>
        </tr>
    ";
}
// En caso de error
if ($cosa2 == "") {
    echo "No hay ningún dato en la tabla";
}

echo $cosa2 . " / ";

$PG11 = "SELECT novedades_trabajador_indep.trabajador_indep_id, ";
$PG11 .= "novedades_trabajador_indep.novedades_id, ";
$PG11 .= "reporte_ceet.novedades.sdescripcion,";
$PG11 .= "novedades_trabajador_indep.dfecha_visita, ";
$PG11 .= "novedades_trabajador_indep.benabled, ";
$PG11 .= "novedades_trabajador_indep.nusuario_creacion, ";
$PG11 .= "novedades_trabajador_indep.dfecha_creacion, ";
$PG11 .= "novedades_trabajador_indep.nusuario_actualizacion, ";
$PG11 .= "novedades_trabajador_indep.dfecha_actualizacion, ";
$PG11 .= "novedades_trabajador_indep.id ";
$PG11 .= "FROM reporte_ceet.novedades_trabajador_indep ";
$PG11 .= "inner join reporte_ceet.novedades on reporte_ceet.novedades.id = novedades_trabajador_indep.novedades_id ";
$PG11 .= "WHERE ";
$PG11 .= "novedades_trabajador_indep.trabajador_indep_id = '" . $_SESSION["trabajador_indep_id"]  . "' ";
$PG11 .= "AND ";
$PG11 .= "novedades_trabajador_indep.benabled = 'TRUE' ";
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
                <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar3(" . $valor . ")\">Eliminar </button>
            </td>
        </tr>
    ";
}
// En caso de error
if ($cosa3 == "") {
    echo "No hay ningún dato en la tabla";
}

echo $cosa3 . " / ";

$PG12 = "SELECT ambiente_aprendizaje_trabajador_indep.trabajador_indep_id, ";
$PG12 .= "ambiente_aprendizaje_trabajador_indep.ambiente_aprendizaje_id, ";
$PG12 .= "reporte_ceet.ambiente_aprendizaje.sdescripcion, ";
$PG12 .= "ambiente_aprendizaje_trabajador_indep.dfecha_ambiente_aprendizaje, ";
$PG12 .= "ambiente_aprendizaje_trabajador_indep.benabled, ";
$PG12 .= "ambiente_aprendizaje_trabajador_indep.nusuario_creacion, ";
$PG12 .= "ambiente_aprendizaje_trabajador_indep.dfecha_creacion, ";
$PG12 .= "ambiente_aprendizaje_trabajador_indep.nusuario_actualizacion, ";
$PG12 .= "ambiente_aprendizaje_trabajador_indep.dfecha_actualizacion, ";
$PG12 .= "ambiente_aprendizaje_trabajador_indep.id ";
$PG12 .= "FROM reporte_ceet.ambiente_aprendizaje_trabajador_indep ";
$PG12 .= "inner join reporte_ceet.ambiente_aprendizaje on reporte_ceet.ambiente_aprendizaje.id = ambiente_aprendizaje_trabajador_indep.ambiente_aprendizaje_id ";
$PG12 .= "WHERE ";
$PG12 .= "ambiente_aprendizaje_trabajador_indep.trabajador_indep_id = '" . $_SESSION["trabajador_indep_id"]  . "' ";
$PG12 .= "AND ";
$PG12 .= "ambiente_aprendizaje_trabajador_indep.benabled = 'TRUE'";
$PG12 .= "OFFSET 0";

$row5 = pg_query($conn2, $PG12);

$cosa4 = "";

while ($persona5 = pg_fetch_assoc($row5)) {

    if ($i4 != 1) {
        $valor = $persona5["id"];
    }
    $valor2 = current($persona5);

    $i4++;
    $cosa4 .= "<tr>
            <td>" . $i4 . "</td>
            <td>" . $persona5['sdescripcion'] . "</td>
            <td id=\"botones\">
                <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #f04124; border-radius: 30px;\" onclick=\"accion_eliminar4(" . $valor . ")\">Eliminar </button>
            </td>
        </tr>
    ";
}
// En caso de error
if ($cosa4 == "") {
    echo "No hay ningún dato en la tabla";
}

echo $cosa4; */
