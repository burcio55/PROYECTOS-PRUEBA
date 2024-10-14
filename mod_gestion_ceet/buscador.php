<?php
$host = "10.46.1.93";
$dbname = "minpptrassi";
$user = "postgres";
$pass = "postgres";

try {
    $conn3 = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn3 = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

session_start();

$PG0 = " SELECT * FROM reporte_ceet.trabajador_indep WHERE snacionalidad = '" . $_REQUEST['n_nacionalidad'] . "' AND ncedula='" . $_REQUEST['personales_cedula'] . "' AND benabled = 'TRUE'";
$row = pg_query($conn3, $PG0);
$persona = pg_fetch_assoc($row);

$_SESSION["trabajador_indep_id"] = $persona["id"];


$host = "10.46.1.93";
$dbname = "entes";
$user = "postgres";
$pass = "postgres";

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$PG = "SELECT";
$PG .= " primer_nombre,";
$PG .= " segundo_nombre,";
$PG .= " primer_apellido,";
$PG .= " segundo_apellido,";
$PG .= " sexo";
$PG .= " FROM";
$PG .= " public.saime";
$PG .= " WHERE";
$PG .= " numcedula='" . $_REQUEST['personales_cedula'];
$PG .= "' AND";
$PG .= " letra='" . $_REQUEST['n_nacionalidad'] . "'";
$rs = pg_query($conn, $PG);
if (pg_num_rows($rs) == 0) {
    echo "0 / Asegurece de especificar la Nacionalidad y la Cédula de Identidad";
    die();
}

/* echo "0 / HOLA 1"; */
$personas = "1 / ";

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

echo $cosa4;
