<?

include('based.php');

$num_informe = $_REQUEST['num_informe'];
$num_bpublico = $_REQUEST['num_bpublico'];
$num_tecnico = $_REQUEST['num_tecnico'];


if ($num_bpublico == '') {
    $num_bpublico2 = 0;
} else {
    $num_bpublico2 = $num_bpublico;
}

if ($num_informe == '') {
    $num_informe2 = 0;
} else {
    $num_informe2 = $num_informe;
}

if ($num_tecnico == '') {
    $num_tecnico2 = 0;
} else {
    $num_tecnico2 = $num_tecnico;
}

/* echo " 1 / " . $num_informe . " " . $num_bpublico;
die(); */

$resalt = " SELECT personales.cedula as cedula,";
$resalt .= " personales.id as id,";
$resalt .= " personales.primer_apellido as apellido1,";
$resalt .= " personales.segundo_apellido as apellido2,";
$resalt .= " personales.primer_nombre as nombre1,";
$resalt .= " personales.segundo_nombre as nombre2,";
$resalt .= " personales.subicacion_fisica as ubicacion_fisica_actual,";
$resalt .= " personales.scargo_actual_ejerce as cargo_actual_ejerce,";
$resalt .= " public.cargos.sdescripcion as cargo,";
$resalt .= " reportes_fallas.snro_reporte  as reporte,";
$resalt .= " reportes_fallas.nbien_publico,";
$resalt .= " reportes_fallas.sserial,";
$resalt .= " reportes_fallas.dispositivos_id as dispositivo,";
$resalt .= " public.ubicacion_administrativa.sdescripcion as ubicacion_adm";
$resalt .= " FROM public.personales";
$resalt .= " LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula";
$resalt .= " LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id";
$resalt .= " LEFT JOIN public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo";
$resalt .= " LEFT JOIN public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo";
$resalt .= " LEFT JOIN reporte_tecnico.reportes_fallas ON reportes_fallas.personales_id = personales.id";
$resalt .= "  WHERE (reportes_fallas.sserial = '$num_informe' 
                    OR reportes_fallas.snro_reporte = '$num_tecnico2' 
                    OR reportes_fallas.nbien_publico = '$num_bpublico2')
                AND benabled='TRUE' 
                ";

/* echo "0 / " . $resalt;
die(); */

$SQL = pg_query($conn, $resalt);

if ($row = pg_fetch_array($SQL, NULL, PGSQL_ASSOC)) {
    /* echo "1 / SIUUUU";
    die(); */

    $_SESSION['id_usuario'];


    $_SESSION["id_imp"] = $row['reporte'];

    $_SESSION["serial"] = $row['sserial'];
    $_SESSION["bien_publico"] = $row['nbien_publico'];

    $cedula = $row['cedula'];

    $nombres = $row['nombre1'] . " " . $row['nombre2'];

    $apellidos = $row['apellido1'] . " " . $row['apellido2'];

    $reporte = $row['reporte'];

    $ubicacion_adm = $row['ubicacion_adm'];

    echo "1 / " . $cedula . " / " . $nombres . " / " . $apellidos . " / " . $reporte . " / " . $ubicacion_adm;
} else {
    echo "0 / No se encontró el informe";
    die();
}
