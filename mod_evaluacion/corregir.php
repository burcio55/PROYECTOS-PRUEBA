<?php

include("BD.php");

$accion = $_REQUEST["accion"];

if($accion == 1){
    $id = $_REQUEST["id"];

    $SQL = "SELECT
            personales.id as id,
            personales.cedula as cedula,
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
            public.ubicacion_administrativa.scodigo as ubicacion_scodigo
            FROM
            public.personales LEFT JOIN
            recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula LEFT JOIN
            public.cargos on recibo_pago.cargos_id = cargos.id LEFT JOIN
            public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo LEFT JOIN
            public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo LEFT JOIN
            public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo
            WHERE
            personales.id ='".$id."'
            AND
            recibo_pago.nestatus='1'
            order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC
            LIMIT 1
    ";
    $row = pg_query($conn, $SQL);
    $valor = pg_fetch_assoc($row);

    /* if ($persona == 0) {
        // Mostrar mensaje de no encontrado
        echo "0 / " . $SQL;
        die();
    } */

    $_SESSION["Persona_id2"] = $persona["id"];

    $ayo = date('y');

    $personas = "1 / ";
    $nombres = trim($valor['apellido1']) . " " . trim($valor['apellido2']) . " " . trim($valor['nombre1']) . " " . trim($valor['nombre2']);
    $personas .= $nombres;
    $personas .= " / ";
    $personas .= trim($valor['codigo_nom']);
    $personas .= " / ";
    $personas .= trim($valor['cargo']);
    $personas .= " / ";
    $personas .= trim($valor['ubicacion_adm']);
    $personas .= " / ";
    $personas .= trim($valor['ubicacion_fisica_actual']);
    $personas .= " / ";
    $personas .= trim($valor['cargo_actual_ejerce']);
    $personas .= " / ";
    $personas .= trim($valor['id']);

    $_SESSION["persona_incidencia_id"] = $valor['id'];

    $personas .= " / ";
    $personas .= trim($valor['cargo_id']);
    $personas .= " / ";
    $personas .= $_SESSION["Periodo"];
    $personas .= " / ";
    $personas .= $ayo;
    $personas .= " / ";
    $personas .= trim($valor['codigo_tipos_trabajadores']);
    $personas .= " / ";
    $personas .= trim($valor['ubicacion_scodigo']);
    $personas .= " / ";
    $personas .= trim($valor['codigo_tipos_trabajadores']);
    $personas .= " / ";
    $personas .= trim($valor['tipo_trabajador']);
    $personas .= " / ";
    $personas .= trim($valor['cedula']);

    echo $personas . " / ";

    $mes = date('m');

    if($mes == '01' || $mes == '02' || $mes == '03'){
        $periodo = 1;
    }
    if($mes == '04' || $mes == '05' || $mes == '06'){
        $periodo = 2;
    }
    if($mes == '07' || $mes == '08' || $mes == '09'){
        $periodo = 3;
    }
    if($mes == '10' || $mes == '11' || $mes == '12'){
        $periodo = 4;
    }

    $SQL2 = "SELECT * FROM evaluacion_desemp.evaluacion WHERE personales_id = '$id' AND periodo_eval_id = '$periodo' AND nestatus = '4' AND benabled = 'TRUE' LIMIT 1";
    /* echo $SQL2;
    die(); */

    $row2 = pg_query($conn, $SQL2);
    $persona2 = pg_fetch_assoc($row2);

    $nodi1_rango = $persona2["nodi1_rango"];
    $nodi2_rango = $persona2["nodi2_rango"];
    $nodi3_rango = $persona2["nodi3_rango"];
    $sodi4 = $persona2["sodi4"];
    $nodi4_peso = $persona2["nodi4_peso"];
    $nodi4_rango = $persona2["nodi4_rango"];
    $sodi5 = $persona2["sodi5"];
    $nodi5_peso = $persona2["nodi5_peso"];
    $nodi5_rango = $persona2["nodi5_rango"];
    $sodi6 = $persona2["sodi6"];
    $nodi6_peso = $persona2["nodi6_peso"];
    $nodi6_rango = $persona2["nodi6_rango"];
    $sodi7 = $persona2["sodi7"];
    $nodi7_peso = $persona2["nodi7_peso"];
    $nodi7_rango = $persona2["nodi7_rango"];
    $sodi8 = $persona2["sodi8"];
    $nodi8_peso = $persona2["nodi8_peso"];
    $nodi8_rango = $persona2["nodi8_rango"];

    $personas .= " / ";
    $personas .= $nodi1_rango;
    $personas .= " / ";
    $personas .= $nodi2_rango;
    $personas .= " / ";
    $personas .= $nodi3_rango;
    $personas .= " / ";
    $personas .= $sodi4;
    $personas .= " / ";
    $personas .= $nodi4_peso;
    $personas .= " / ";
    $personas .= $nodi4_rango;
    $personas .= " / ";
    $personas .= $sodi5;
    $personas .= " / ";
    $personas .= $nodi5_peso;
    $personas .= " / ";
    $personas .= $nodi5_rango;
    $personas .= " / ";
    $personas .= $sodi6;
    $personas .= " / ";
    $personas .= $nodi6_peso;
    $personas .= " / ";
    $personas .= $nodi6_rango;
    $personas .= " / ";
    $personas .= $sodi7;
    $personas .= " / ";
    $personas .= $nodi7_peso;
    $personas .= " / ";
    $personas .= $nodi7_rango;
    $personas .= " / ";
    $personas .= $sodi8;
    $personas .= " / ";
    $personas .= $nodi8_peso;
    $personas .= " / ";
    $personas .= $nodi8_rango;
    echo $personas . " / ";
}else
if($accion == 2){

    $id = $_REQUEST["id"];

    $mes = date('m');

    if($mes == '01' || $mes == '02' || $mes == '03'){
        $periodo = 1;
    }
    if($mes == '04' || $mes == '05' || $mes == '06'){
        $periodo = 2;
    }
    if($mes == '07' || $mes == '08' || $mes == '09'){
        $periodo = 3;
    }
    if($mes == '10' || $mes == '11' || $mes == '12'){
        $periodo = 4;
    }

    $sodi1 = "Asistencia y Puntualidad al Trabajo";
    $nodi1_peso = $_REQUEST["peso1"];
    $nodi1_rango = $_REQUEST["rango1"];

    $sodi2 = "Asistencia y Puntualidad a las Reuniones de Trabajo";
    $nodi2_peso = $_REQUEST["peso2"];
    $nodi2_rango = $_REQUEST["rango2"];

    $sodi3 = "Asistencia y Puntualidad a los Despliegues de Campo";
    $nodi3_peso = $_REQUEST["peso3"];
    $nodi3_rango = $_REQUEST["rango3"];

    $sodi4 = $_REQUEST["descripcion1"];
    $nodi4_peso = $_REQUEST["peso4"];
    $nodi4_rango = $_REQUEST["rango4"];

    $sodi5 = $_REQUEST["descripcion2"];
    $nodi5_peso = $_REQUEST["peso5"];
    $nodi5_rango = $_REQUEST["rango5"];

    $sodi6 = $_REQUEST["descripcion3"];
    $nodi6_peso = $_REQUEST["peso6"];
    $nodi6_rango = $_REQUEST["rango6"];

    $sodi7 = $_REQUEST["descripcion4"];
    $nodi7_peso = $_REQUEST["peso7"];
    $nodi7_rango = $_REQUEST["rango7"];

    $sodi8 = $_REQUEST["descripcion5"];
    $nodi8_peso = $_REQUEST["peso8"];
    $nodi8_rango = $_REQUEST["rango8"];

    $peso_rango_total_m1 = $_REQUEST["peso_rango_total_m1"];

    $_SESSION["peso_total1"] = $peso_rango_total_m1;

    $persona_id = $_SESSION["Persona_id2"];
    $cedula = $_SESSION["Cedula"];

    $SQL = "UPDATE evaluacion_desemp.evaluacion";
    $SQL .= " SET nodi1_rango='$nodi1_rango',";
    $SQL .= " nodi2_rango='$nodi2_rango',";
    $SQL .= " nodi3_rango='$nodi3_rango',";
    $SQL .= " sodi4='$sodi4',";
    $SQL .= " nodi4_peso='$nodi4_peso',";
    $SQL .= " nodi4_rango='$nodi4_rango',";
    $SQL .= " sodi5='$sodi5',";
    $SQL .= " nodi5_peso='$nodi5_peso',";
    $SQL .= " nodi5_rango='$nodi5_rango',";
    $SQL .= " sodi6='$sodi6',";
    $SQL .= " nodi6_peso='$nodi6_peso',";
    $SQL .= " nodi6_rango='$nodi6_rango',";
    $SQL .= " sodi7='$sodi7',";
    $SQL .= " nodi7_peso='$nodi7_peso',";
    $SQL .= " nodi7_rango='$nodi7_rango',";
    $SQL .= " sodi8='$sodi8',";
    $SQL .= " nodi8_peso='$nodi8_peso',";
    $SQL .= " nodi8_rango='$nodi8_rango'";
    $SQL .= " WHERE ";
    $SQL .= " personales_id='$id'";
    $SQL .= " AND periodo_eval_id='$periodo'";
    $SQL .= " AND nestatus='4'";
    $SQL .= " AND benabled='TRUE'";

    if ($resultado = pg_query($conn, $SQL)) {

        $SQL2 = "SELECT * FROM evaluacion_desemp.evaluacion WHERE personales_id = '$id' AND nestatus = '4' AND periodo_eval_id = '$periodo' AND benabled = 'TRUE'";
        $row = pg_query($conn, $SQL2);
        $valor = pg_fetch_assoc($row);
        $evaluacion_id = $valor['id'];

        $comp = "SELECT * FROM evaluacion_desemp.evaluacion_comp WHERE evaluacion_id = '$evaluacion_id'";
        $rs = pg_query($conn, $comp);
        $respuesta = "";

        while($eva = pg_fetch_assoc($rs)){
            $respuesta .= $eva['npeso'];
            $respuesta .= " / ";
            $respuesta .= $eva['nrango'];
            $respuesta .= " / ";
        }
        
        echo "1 / ".$respuesta;
    } else {
        echo "0 / Falló la inserción, razón: " . $SQL;
        die();
    }
}else
if($accion == 3){
    $id = $_REQUEST["id"];

    $mes = date('m');

    if($mes == '01' || $mes == '02' || $mes == '03'){
        $periodo = 1;
    }
    if($mes == '04' || $mes == '05' || $mes == '06'){
        $periodo = 2;
    }
    if($mes == '07' || $mes == '08' || $mes == '09'){
        $periodo = 3;
    }
    if($mes == '10' || $mes == '11' || $mes == '12'){
        $periodo = 4;
    }

    $SQL2 = "SELECT * FROM evaluacion_desemp.evaluacion WHERE personales_id = '$id' AND nestatus = '4' AND periodo_eval_id = '$periodo' AND benabled = 'TRUE'";
    $row = pg_query($conn, $SQL2);
    $valor = pg_fetch_assoc($row);
    $evaluacion_id = $valor['id'];

    $npeso9 = $_REQUEST["peso9"];
    $nrango9 = $_REQUEST["rango9"];

    $npeso10 = $_REQUEST["peso10"];
    $nrango10 = $_REQUEST["rango10"];

    $npeso11 = $_REQUEST["peso11"];
    $nrango11 = $_REQUEST["rango11"];

    $npeso12 = $_REQUEST["peso12"];
    $nrango12 = $_REQUEST["rango12"];

    $npeso13 = $_REQUEST["peso13"];
    $nrango13 = $_REQUEST["rango13"];

    $npeso14 = $_REQUEST["peso14"];
    $nrango14 = $_REQUEST["rango14"];

    $npeso15 = $_REQUEST["peso15"];
    $nrango15 = $_REQUEST["rango15"];

    $npeso16 = $_REQUEST["peso16"];
    $nrango16 = $_REQUEST["rango16"];

    $npeso17 = $_REQUEST["peso17"];
    $nrango17 = $_REQUEST["rango17"];

    $npeso18 = $_REQUEST["peso18"];
    $nrango18 = $_REQUEST["rango18"];

    $npeso19 = $_REQUEST["peso19"];
    $nrango19 = $_REQUEST["rango19"];

    $peso_total1 = $_REQUEST["peso_rango_total_m1"];
    $peso_total2 = $_REQUEST["peso_rango_total_m2"];

    $peso_total = $peso_total1 + $peso_total2;

    $id_ususario = $_SESSION["id_usuario"];

    for ($i = 0; $i < 11; $i++) {
        $SQL = "UPDATE";
        $SQL .= " evaluacion_desemp.evaluacion_comp";
        $SQL .= " SET";
        if ($i == 0) {
            $SQL .= " npeso = '$npeso9',";
            $SQL .= " nrango = '$nrango9',";
            $SQL .= " nusuario_actualizacion = '$id_ususario'";
            $SQL .= " WHERE";
            $SQL .= " competencias_id = '4'";
        } else
        if ($i == 1) { 
            $SQL .= " npeso = '$npeso10',";
            $SQL .= " nrango = '$nrango10',";
            $SQL .= " nusuario_actualizacion = '$id_ususario'";
            $SQL .= " WHERE";
            $SQL .= " competencias_id = '5'";
        } else
        if ($i == 2) {
            $SQL .= " npeso = '$npeso11',";
            $SQL .= " nrango = '$nrango11',";
            $SQL .= " nusuario_actualizacion = '$id_ususario'";
            $SQL .= " WHERE";
            $SQL .= " competencias_id = '8'";
        } else
        if ($i == 3) {
            $SQL .= " npeso = '$npeso12',";
            $SQL .= " nrango = '$nrango12',";
            $SQL .= " nusuario_actualizacion = '$id_ususario'";
            $SQL .= " WHERE";
            $SQL .= " competencias_id = '9'";
        } else
        if ($i == 4) {
            $SQL .= " npeso = '$npeso13',";
            $SQL .= " nrango = '$nrango13',";
            $SQL .= " nusuario_actualizacion = '$id_ususario'";
            $SQL .= " WHERE";
            $SQL .= " competencias_id = '10'";
        } else
        if ($i == 5) { 
            $SQL .= " npeso = '$npeso14',";
            $SQL .= " nrango = '$nrango14',";
            $SQL .= " nusuario_actualizacion = '$id_ususario'";
            $SQL .= " WHERE";
            $SQL .= " competencias_id = '11'";
        } else
        if ($i == 6) { 
            $SQL .= " npeso = '$npeso15',";
            $SQL .= " nrango = '$nrango15',";
            $SQL .= " nusuario_actualizacion = '$id_ususario'";
            $SQL .= " WHERE";
            $SQL .= " competencias_id = '12'";
        } else
        if ($i == 7) {
            $SQL .= " npeso = '$npeso16',";
            $SQL .= " nrango = '$nrango16',";
            $SQL .= " nusuario_actualizacion = '$id_ususario'";
            $SQL .= " WHERE";
            $SQL .= " competencias_id = '13'";
        } else
        if ($i == 8) {
            $SQL .= " npeso = '$npeso17',";
            $SQL .= " nrango = '$nrango17',";
            $SQL .= " nusuario_actualizacion = '$id_ususario'";
            $SQL .= " WHERE";
            $SQL .= " competencias_id = '14'";
        } else
        if ($i == 9) {
            $SQL .= " npeso = '$npeso18',";
            $SQL .= " nrango = '$nrango18',";
            $SQL .= " nusuario_actualizacion = '$id_ususario'";
            $SQL .= " WHERE";
            $SQL .= " competencias_id = '15'";
        } else
        if ($i == 10) {
            $SQL .= " npeso = '$npeso19',";
            $SQL .= " nrango = '$nrango19',";
            $SQL .= " nusuario_actualizacion = '$id_ususario'";
            $SQL .= " WHERE";
            $SQL .= " competencias_id = '16'";
        }
        $SQL .= " AND evaluacion_id = '$id'";

        $resultado = pg_query($conn, $SQL);
        if($resultado = pg_query($conn, $SQL)){
        }else{
            echo $SQL;
            die();
        }
    }

    if ($peso_total >= '100 ' && $peso_total <= '124') {
        $total = "No cumplió";
    } else
    if ($peso_total >= '125' && $peso_total <= '249') {
        $total = "Cumplimiento Ordinario";
    } else
    if ($peso_total >= '250 ' && $peso_total <= '374') {
        $total = "Bueno - Cumplimiento de Proceso de Mejora";
    } else
    if ($peso_total >= '375' && $peso_total <= '499') {
        $total = "Muy Bueno - Cumplimiento Destacable";
    } else
    if ($peso_total == '500') {
        $total = "Excelente - Cumplimiento Emulable";
    }
    
    $_SESSION["Total"] = $peso_total;
    
    $_SESSION["peso_total1"] = $peso_total1;
    $_SESSION["peso_total2"] = $peso_total2;

    $scontrol_actualizaciones = $valor['scontrol_actualizaciones'];
    
    if ($scontrol_actualizaciones < 3) {
        // Ejecutar la consulta de actualización
        $SQL2 = "UPDATE evaluacion_desemp.evaluacion 
                 SET srango_actuacion = '$total', 
                     nrango_actuacion = '$peso_total', 
                     nestatus = '2', 
                     scontrol_actualizaciones = scontrol_actualizaciones + 1 
                 WHERE personales_id='$id' 
                   AND benabled = 'TRUE' 
                   AND scontrol_actualizaciones < 3";
        echo "Ejecutando consulta en if: $SQL2";
    } else {
        // Ejecutar la consulta alternativa
        $SQL2 = "UPDATE evaluacion_desemp.evaluacion 
                 SET srango_actuacion = '$total', 
                     nrango_actuacion = '$peso_total', 
                     nestatus = '3',
                     sdesacuerdo_evaluado = 'SI' 
                    /*  scontrol_actualizaciones = scontrol_actualizaciones + 1  */
                 WHERE personales_id='$id' 
                   AND benabled = 'TRUE'";
        echo "Ejecutando consulta en else: $SQL2";
    }
    
    $resultado2 = pg_query($conn, $SQL2);

    $_SESSION['id_evaluacion']=$id;
}