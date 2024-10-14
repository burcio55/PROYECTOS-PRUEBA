<?php

include("BD.php");

$año_actual = 2019;
$mes_actual = 10;

// Tabla 1 Select 1

$SQL1 = "SELECT DISTINCT 
        recibos_pagos_constancias.recibo_pago.personales_cedula,
        public.tipo_trabajador.ncodigo as id_tipo_trabajador,
        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
        public.cargos.sdescripcion as cargo,
        public.cargos.id as cargo_id,
        recibos_pagos_constancias.recibo_pago.nanio,
        recibos_pagos_constancias.recibo_pago.nmes,
        recibos_pagos_constancias.recibo_pago.nestatus
        FROM public.personales 
        LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula 
        LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
        LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
        WHERE
        public.tipo_trabajador.ncodigo = '2'
        AND
        recibos_pagos_constancias.recibo_pago.nanio = '$año_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nmes = '$mes_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nestatus = '1'
";

$rs1 = pg_query($conn, $SQL1);
if (pg_num_rows($rs1) == 0) {
    $num_registro1 = 0;
} else {
    $num_registro1 = pg_num_rows($rs1);
}

// Tabla 1 Select 2

$SQL2 = "SELECT DISTINCT 
        recibos_pagos_constancias.recibo_pago.personales_cedula,
        public.tipo_trabajador.ncodigo as id_tipo_trabajador,
        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
        public.cargos.sdescripcion as cargo,
        public.cargos.id as cargo_id,
        recibos_pagos_constancias.recibo_pago.nanio,
        recibos_pagos_constancias.recibo_pago.nmes,
        recibos_pagos_constancias.recibo_pago.nestatus
        FROM public.personales 
        LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula 
        LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
        LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
        WHERE
        public.tipo_trabajador.ncodigo = '3'
        AND
        recibos_pagos_constancias.recibo_pago.nanio = '$año_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nmes = '$mes_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nestatus = '1'
";

$rs2 = pg_query($conn, $SQL2);
if (pg_num_rows($rs2) == 0) {
    $num_registro2 = 0;
} else {
    $num_registro2 = pg_num_rows($rs2);
}

// Tabla 1 Select 3

$SQL3 = "SELECT DISTINCT 
        recibos_pagos_constancias.recibo_pago.personales_cedula,
        public.tipo_trabajador.ncodigo as id_tipo_trabajador,
        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
        public.cargos.sdescripcion as cargo,
        public.cargos.id as cargo_id,
        recibos_pagos_constancias.recibo_pago.nanio,
        recibos_pagos_constancias.recibo_pago.nmes,
        recibos_pagos_constancias.recibo_pago.nestatus
        FROM public.personales 
        LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula 
        LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
        LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
        WHERE
        public.tipo_trabajador.ncodigo = '1'
        AND
        recibos_pagos_constancias.recibo_pago.nanio = '$año_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nmes = '$mes_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nestatus = '1'
";

$rs3 = pg_query($conn, $SQL3);
if (pg_num_rows($rs3) == 0) {
    $num_registro3 = 0;
} else {
    $num_registro3 = pg_num_rows($rs3);
}

// Tabla 1 Select 4

$SQL4 = "SELECT DISTINCT 
        recibos_pagos_constancias.recibo_pago.personales_cedula,
        public.tipo_trabajador.ncodigo as id_tipo_trabajador,
        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
        public.cargos.sdescripcion as cargo,
        public.cargos.id as cargo_id,
        recibos_pagos_constancias.recibo_pago.nanio,
        recibos_pagos_constancias.recibo_pago.nmes,
        recibos_pagos_constancias.recibo_pago.nestatus
        FROM public.personales 
        LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula 
        LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
        LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
        WHERE
        public.tipo_trabajador.ncodigo = '6'
        AND
        recibos_pagos_constancias.recibo_pago.nanio = '$año_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nmes = '$mes_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nestatus = '1'
";

$rs4 = pg_query($conn, $SQL4);
if (pg_num_rows($rs4) == 0) {
    $num_registro4 = 0;
} else {
    $num_registro4 = pg_num_rows($rs4);
}

// Tabla 1 Select 5

$SQL5 = "SELECT DISTINCT 
        recibos_pagos_constancias.recibo_pago.personales_cedula,
        public.tipo_trabajador.ncodigo as id_tipo_trabajador,
        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
        public.cargos.sdescripcion as cargo,
        public.cargos.id as cargo_id,
        recibos_pagos_constancias.recibo_pago.nanio,
        recibos_pagos_constancias.recibo_pago.nmes,
        recibos_pagos_constancias.recibo_pago.nestatus
        FROM public.personales 
        LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula 
        LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
        LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
        WHERE
        public.tipo_trabajador.ncodigo = '5'
        AND
        recibos_pagos_constancias.recibo_pago.nanio = '$año_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nmes = '$mes_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nestatus = '1'
";

$rs5 = pg_query($conn, $SQL5);
if (pg_num_rows($rs5) == 0) {
    $num_registro5 = 0;
} else {
    $num_registro5 = pg_num_rows($rs5);
}

// Tabla 1 Select 6

$SQL6 = "SELECT DISTINCT 
        recibos_pagos_constancias.recibo_pago.personales_cedula,
        public.tipo_trabajador.ncodigo as id_tipo_trabajador,
        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
        public.cargos.sdescripcion as cargo,
        public.cargos.id as cargo_id,
        recibos_pagos_constancias.recibo_pago.nanio,
        recibos_pagos_constancias.recibo_pago.nmes,
        recibos_pagos_constancias.recibo_pago.nestatus
        FROM public.personales 
        LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula 
        LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
        LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
        WHERE
        public.tipo_trabajador.ncodigo = '15'
        AND
        recibos_pagos_constancias.recibo_pago.nanio = '$año_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nmes = '$mes_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nestatus = '1'
";

$rs6 = pg_query($conn, $SQL6);
if (pg_num_rows($rs6) == 0) {
    $num_registro6 = 0;
} else {
    $num_registro6 = pg_num_rows($rs6);
}

// Tabla 1 Select 7

$SQL7 = "SELECT DISTINCT 
        recibos_pagos_constancias.recibo_pago.personales_cedula,
        public.tipo_trabajador.ncodigo as id_tipo_trabajador,
        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
        public.cargos.sdescripcion as cargo,
        public.cargos.id as cargo_id,
        recibos_pagos_constancias.recibo_pago.nanio,
        recibos_pagos_constancias.recibo_pago.nmes,
        recibos_pagos_constancias.recibo_pago.nestatus
        FROM public.personales 
        LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula 
        LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
        LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
        WHERE
        public.tipo_trabajador.ncodigo = '4'
        AND
        recibos_pagos_constancias.recibo_pago.nanio = '$año_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nmes = '$mes_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nestatus = '1'
";

$rs7 = pg_query($conn, $SQL7);
if (pg_num_rows($rs7) == 0) {
    $num_registro7 = 0;
} else {
    $num_registro7 = pg_num_rows($rs7);
}

$total1 = $num_registro1 + $num_registro2 + $num_registro3 + $num_registro4 + $num_registro5 + $num_registro6 + $num_registro7;

// Tabla 2 Select 1

$SQL8 = "SELECT personales_id, rol_evaluacion_id, count(personales_id) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        rol_evaluacion_id = 2
        AND
        benabled = 'TRUE'
        group by personales_id, rol_evaluacion_id order by personales_id
";

$rs8 = pg_query($conn, $SQL8);
$persona8 = pg_fetch_assoc($rs8);

if ($persona8["count"] == '') {
    $num_registro8 = 0;
} else {
    $num_registro8 = pg_num_rows($rs8);
}

// Tabla 2 Select 2

$SQL9 = "SELECT personales_id, rol_evaluacion_id, count(personales_id) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        rol_evaluacion_id = 3
        AND
        benabled = 'TRUE'
        group by personales_id, rol_evaluacion_id order by personales_id
";

$rs9 = pg_query($conn, $SQL9);
$persona9 = pg_fetch_assoc($rs9);

if ($persona9["count"] == '') {
    $num_registro9 = 0;
} else {
    $num_registro9 = pg_num_rows($rs9);
}

// Tabla 2 Select 3

$SQL10 = "SELECT personales_id, rol_evaluacion_id, count(personales_id) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        rol_evaluacion_id = 1
        AND
        benabled = 'TRUE'
        group by personales_id, rol_evaluacion_id order by personales_id
";

$rs10 = pg_query($conn, $SQL10);
$persona10 = pg_fetch_assoc($rs10);

if ($persona10["count"] == '') {
    $num_registro10 = 0;
} else {
    $num_registro10 = pg_num_rows($rs10);
}

// Tabla 2 Select 4

$SQL11 = "SELECT personales_id, rol_evaluacion_id, count(personales_id) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        rol_evaluacion_id = 6
        AND
        benabled = 'TRUE'
        group by personales_id, rol_evaluacion_id order by personales_id
";

$rs11 = pg_query($conn, $SQL11);
$persona11 = pg_fetch_assoc($rs11);

if ($persona11["count"] == '') {
    $num_registro11 = 0;
} else {
    $num_registro11 = pg_num_rows($rs11);
}

// Tabla 2 Select 5

$SQL12 = "SELECT personales_id, rol_evaluacion_id, count(personales_id) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        rol_evaluacion_id = 5
        AND
        benabled = 'TRUE'
        group by personales_id, rol_evaluacion_id order by personales_id
";

$rs12 = pg_query($conn, $SQL12);
$persona12 = pg_fetch_assoc($rs12);

if ($persona12["count"] == '') {
    $num_registro12 = 0;
} else {
    $num_registro12 = pg_num_rows($rs12);
}

// Tabla 2 Select 6

$SQL13 = "SELECT personales_id, rol_evaluacion_id, count(personales_id) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        rol_evaluacion_id = 15
        AND
        benabled = 'TRUE'
        group by personales_id, rol_evaluacion_id order by personales_id
";

$rs13 = pg_query($conn, $SQL13);
$persona13 = pg_fetch_assoc($rs13);

if ($persona13["count"] == '') {
    $num_registro13 = 0;
} else {
    $num_registro13 = pg_num_rows($rs13);
}

// Tabla 2 Select 7

$SQL14 = "SELECT personales_id, rol_evaluacion_id, count(personales_id) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        rol_evaluacion_id = 4
        AND
        benabled = 'TRUE'
        group by personales_id, rol_evaluacion_id order by personales_id
";

$rs14 = pg_query($conn, $SQL14);
$persona14 = pg_fetch_assoc($rs14);

if ($persona14["count"] == '') {
    $num_registro14 = 0;
} else {
    $num_registro14 = pg_num_rows($rs14);
}

$total2 = $num_registro8 + $num_registro9 + $num_registro10 + $num_registro11 + $num_registro12 + $num_registro13 + $num_registro14;

// Tabla 3 Select 1

$SQL15 = "SELECT DISTINCT 
        recibos_pagos_constancias.recibo_pago.personales_cedula,
        public.tipo_trabajador.ncodigo as id_tipo_trabajador,
        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
        public.cargos.sdescripcion as cargo,
        public.cargos.id as cargo_id,
        recibos_pagos_constancias.recibo_pago.nanio,
        recibos_pagos_constancias.recibo_pago.nmes,
        recibos_pagos_constancias.recibo_pago.nestatus
        FROM public.personales 
        LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula 
        LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
        LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
        WHERE
        public.tipo_trabajador.ncodigo = '2'
        AND
        recibos_pagos_constancias.recibo_pago.nanio = '$año_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nmes = '$mes_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nestatus = '1'
";

$rs15 = pg_query($conn, $SQL15);
if (pg_num_rows($rs15) == 0) {
    $num_registro15 = 0;
} else {
    $num_registro15 = pg_num_rows($rs15) - $num_registro8;
}

// Tabla 3 Select 2

$SQL16 = "SELECT DISTINCT 
        recibos_pagos_constancias.recibo_pago.personales_cedula,
        public.tipo_trabajador.ncodigo as id_tipo_trabajador,
        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
        public.cargos.sdescripcion as cargo,
        public.cargos.id as cargo_id,
        recibos_pagos_constancias.recibo_pago.nanio,
        recibos_pagos_constancias.recibo_pago.nmes,
        recibos_pagos_constancias.recibo_pago.nestatus
        FROM public.personales 
        LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula 
        LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
        LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
        WHERE
        public.tipo_trabajador.ncodigo = '3'
        AND
        recibos_pagos_constancias.recibo_pago.nanio = '$año_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nmes = '$mes_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nestatus = '1'
";

$rs16 = pg_query($conn, $SQL16);
if (pg_num_rows($rs16) == 0) {
    $num_registro16 = 0;
} else {
    $num_registro16 = pg_num_rows($rs16) - $num_registro9;
}

// Tabla 3 Select 3

$SQL17 = "SELECT DISTINCT 
        recibos_pagos_constancias.recibo_pago.personales_cedula,
        public.tipo_trabajador.ncodigo as id_tipo_trabajador,
        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
        public.cargos.sdescripcion as cargo,
        public.cargos.id as cargo_id,
        recibos_pagos_constancias.recibo_pago.nanio,
        recibos_pagos_constancias.recibo_pago.nmes,
        recibos_pagos_constancias.recibo_pago.nestatus
        FROM public.personales 
        LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula 
        LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
        LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
        WHERE
        public.tipo_trabajador.ncodigo = '1'
        AND
        recibos_pagos_constancias.recibo_pago.nanio = '$año_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nmes = '$mes_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nestatus = '1'
";

$rs17 = pg_query($conn, $SQL17);
if (pg_num_rows($rs17) == 0) {
    $num_registro17 = 0;
} else {
    $num_registro17 = pg_num_rows($rs17) - $num_registro10;
}

// Tabla 3 Select 4

$SQL18 = "SELECT DISTINCT 
        recibos_pagos_constancias.recibo_pago.personales_cedula,
        public.tipo_trabajador.ncodigo as id_tipo_trabajador,
        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
        public.cargos.sdescripcion as cargo,
        public.cargos.id as cargo_id,
        recibos_pagos_constancias.recibo_pago.nanio,
        recibos_pagos_constancias.recibo_pago.nmes,
        recibos_pagos_constancias.recibo_pago.nestatus
        FROM public.personales 
        LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula 
        LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
        LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
        WHERE
        public.tipo_trabajador.ncodigo = '6'
        AND
        recibos_pagos_constancias.recibo_pago.nanio = '$año_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nmes = '$mes_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nestatus = '1'
";

$rs18 = pg_query($conn, $SQL18);
if (pg_num_rows($rs18) == 0) {
    $num_registro18 = 0;
} else {
    $num_registro18 = pg_num_rows($rs18) - $num_registro11;
}

// Tabla 3 Select 5

$SQL19 = "SELECT DISTINCT 
        recibos_pagos_constancias.recibo_pago.personales_cedula,
        public.tipo_trabajador.ncodigo as id_tipo_trabajador,
        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
        public.cargos.sdescripcion as cargo,
        public.cargos.id as cargo_id,
        recibos_pagos_constancias.recibo_pago.nanio,
        recibos_pagos_constancias.recibo_pago.nmes,
        recibos_pagos_constancias.recibo_pago.nestatus
        FROM public.personales 
        LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula 
        LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
        LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
        WHERE
        public.tipo_trabajador.ncodigo = '5'
        AND
        recibos_pagos_constancias.recibo_pago.nanio = '$año_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nmes = '$mes_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nestatus = '1'
";

$rs19 = pg_query($conn, $SQL19);
if (pg_num_rows($rs19) == 0) {
    $num_registro19 = 0;
} else {
    $num_registro19 = pg_num_rows($rs19) - $num_registro12;
}

// Tabla 3 Select 6

$SQL20 = "SELECT DISTINCT 
        recibos_pagos_constancias.recibo_pago.personales_cedula,
        public.tipo_trabajador.ncodigo as id_tipo_trabajador,
        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
        public.cargos.sdescripcion as cargo,
        public.cargos.id as cargo_id,
        recibos_pagos_constancias.recibo_pago.nanio,
        recibos_pagos_constancias.recibo_pago.nmes,
        recibos_pagos_constancias.recibo_pago.nestatus
        FROM public.personales 
        LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula 
        LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
        LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
        WHERE
        public.tipo_trabajador.ncodigo = '15'
        AND
        recibos_pagos_constancias.recibo_pago.nanio = '$año_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nmes = '$mes_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nestatus = '1'
";

$rs20 = pg_query($conn, $SQL20);
if (pg_num_rows($rs20) == 0) {
    $num_registro20 = 0;
} else {
    $num_registro20 = pg_num_rows($rs20) - $num_registro13;
}

// Tabla 3 Select 7

$SQL21 = "SELECT DISTINCT 
        recibos_pagos_constancias.recibo_pago.personales_cedula,
        public.tipo_trabajador.ncodigo as id_tipo_trabajador,
        public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador,
        public.cargos.sdescripcion as cargo,
        public.cargos.id as cargo_id,
        recibos_pagos_constancias.recibo_pago.nanio,
        recibos_pagos_constancias.recibo_pago.nmes,
        recibos_pagos_constancias.recibo_pago.nestatus
        FROM public.personales 
        LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula 
        LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
        LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
        WHERE
        public.tipo_trabajador.ncodigo = '4'
        AND
        recibos_pagos_constancias.recibo_pago.nanio = '$año_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nmes = '$mes_actual'
        AND
        recibos_pagos_constancias.recibo_pago.nestatus = '1'
";

$rs21 = pg_query($conn, $SQL21);
if (pg_num_rows($rs21) == 0) {
    $num_registro21 = 0;
} else {
    $num_registro21 = pg_num_rows($rs21) - $num_registro14;
}

$total3 = $num_registro15 + $num_registro16 + $num_registro17 + $num_registro18 + $num_registro19 + $num_registro20 + $num_registro21;

// Tabla 4 Select 1

$SQL22 = "SELECT srango_actuacion, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        srango_actuacion = 'Excelente - Cumplimiento Emulable'
        AND
        benabled = 'TRUE'
        group by srango_actuacion order by srango_actuacion
";

$rs22 = pg_query($conn, $SQL22);
$persona22 = pg_fetch_assoc($rs22);

if ($persona22["count"] == '') {
    $num_registro22 = 0;
} else {
    $num_registro22 = pg_num_rows($rs22);
}

// Tabla 4 Select 2

$SQL23 = "SELECT srango_actuacion, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        srango_actuacion = 'Muy Bueno - Cumplimiento Destacable'
        AND
        benabled = 'TRUE'
        group by srango_actuacion order by srango_actuacion
";

$rs23 = pg_query($conn, $SQL23);
$persona23 = pg_fetch_assoc($rs23);

if ($persona23["count"] == '') {
    $num_registro23 = 0;
} else {
    $num_registro23 = $persona23["count"];
}

// Tabla 4 Select 3

$SQL24 = "SELECT srango_actuacion, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        srango_actuacion = 'Bueno - Cumplimiento de Proceso de Mejora'
        AND
        benabled = 'TRUE'
        group by srango_actuacion order by srango_actuacion
";

$rs24 = pg_query($conn, $SQL24);
$persona24 = pg_fetch_assoc($rs24);

if ($persona24["count"] == '') {
    $num_registro24 = 0;
} else {
    $num_registro24 = $persona24["count"];
}

// Tabla 4 Select 4

$SQL25 = "SELECT srango_actuacion, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        srango_actuacion = 'Cumplimiento Ordinario'
        AND
        benabled = 'TRUE'
        group by srango_actuacion order by srango_actuacion
";

$rs25 = pg_query($conn, $SQL25);
$persona25 = pg_fetch_assoc($rs25);

if ($persona25["count"] == '') {
    $num_registro25 = 0;
} else {
    $num_registro25 = $persona25["count"];
}

// Tabla 4 Select 5

$SQL26 = "SELECT srango_actuacion, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        srango_actuacion = 'No cumplió'
        AND
        benabled = 'TRUE'
        group by srango_actuacion order by srango_actuacion
";

$rs26 = pg_query($conn, $SQL26);
$persona26 = pg_fetch_assoc($rs26);

if ($persona26["count"] == '') {
    $num_registro26 = 0;
} else {
    $num_registro26 = $persona26["count"];
}

$total4 = $num_registro22 + $num_registro23 + $num_registro24 + $num_registro25 + $num_registro26;

$porcentaje1 = ($num_registro22 / $total4) * 100;
$porcentaje2 = ($num_registro23 / $total4) * 100;
$porcentaje3 = ($num_registro24 / $total4) * 100;
$porcentaje4 = ($num_registro25 / $total4) * 100;
$porcentaje5 = ($num_registro26 / $total4) * 100;

$total_porcentajes = $porcentaje1 + $porcentaje2 + $porcentaje3 + $porcentaje4 + $porcentaje5;

// Tabla 5 Select 1

/* $SQL27 = "SELECT srango_actuacion, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        srango_actuacion = 'No cumplió'
        AND
        benabled = 'TRUE'
        group by srango_actuacion order by srango_actuacion
";

$rs27 = pg_query($conn, $SQL27);
$persona27 = pg_fetch_assoc($rs27);

if ($persona27["count"] == '') {
    $num_registro27 = 0;
} else {
    $num_registro27 = $persona27["count"];
} */

// Tabla 5 Select 2

/* $SQL28 = "SELECT srango_actuacion, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        srango_actuacion = 'No cumplió'
        AND
        benabled = 'TRUE'
        group by srango_actuacion order by srango_actuacion
";

$rs28 = pg_query($conn, $SQL28);
$persona28 = pg_fetch_assoc($rs28);

if ($persona28["count"] == '') {
    $num_registro28 = 0;
} else {
    $num_registro28 = $persona28["count"];
} */

// Tabla 5 Select 3

/* $SQL29 = "SELECT srango_actuacion, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        srango_actuacion = 'No cumplió'
        AND
        benabled = 'TRUE'
        group by srango_actuacion order by srango_actuacion
";

$rs29 = pg_query($conn, $SQL29);
$persona29 = pg_fetch_assoc($rs29);

if ($persona29["count"] == '') {
    $num_registro29 = 0;
} else {
    $num_registro29 = $persona29["count"];
} */

// Tabla 5 Select 4

/* $SQL30 = "SELECT srango_actuacion, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        srango_actuacion = 'No cumplió'
        AND
        benabled = 'TRUE'
        group by srango_actuacion order by srango_actuacion
";

$rs30 = pg_query($conn, $SQL30);
$persona30 = pg_fetch_assoc($rs30);

if ($persona30["count"] == '') {
    $num_registro30 = 0;
} else {
    $num_registro30 = $persona30["count"];
} */

// Tabla 5 Select 5

/* $SQL31 = "SELECT srango_actuacion, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        srango_actuacion = 'No cumplió'
        AND
        benabled = 'TRUE'
        group by srango_actuacion order by srango_actuacion
";

$rs31 = pg_query($conn, $SQL31);
$persona31 = pg_fetch_assoc($rs31);

if ($persona31["count"] == '') {
    $num_registro31 = 0;
} else {
    $num_registro31 = $persona31["count"];
} */

// Tabla 5 Select 6

/* $SQL32 = "SELECT srango_actuacion, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        srango_actuacion = 'No cumplió'
        AND
        benabled = 'TRUE'
        group by srango_actuacion order by srango_actuacion
";

$rs32 = pg_query($conn, $SQL32);
$persona32 = pg_fetch_assoc($rs32);

if ($persona32["count"] == '') {
    $num_registro32 = 0;
} else {
    $num_registro32 = $persona32["count"];
} */

// Tabla 5 Select 7

/* $SQL33 = "SELECT srango_actuacion, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        srango_actuacion = 'No cumplió'
        AND
        benabled = 'TRUE'
        group by srango_actuacion order by srango_actuacion
";

$rs33 = pg_query($conn, $SQL33);
$persona33 = pg_fetch_assoc($rs33);

if ($persona33["count"] == '') {
    $num_registro33 = 0;
} else {
    $num_registro33 = $persona33["count"];
} */

// Tabla 5 Select 8

/* $SQL34 = "SELECT srango_actuacion, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        srango_actuacion = 'No cumplió'
        AND
        benabled = 'TRUE'
        group by srango_actuacion order by srango_actuacion
";

$rs34 = pg_query($conn, $SQL34);
$persona34 = pg_fetch_assoc($rs34);

if ($persona34["count"] == '') {
    $num_registro34 = 0;
} else {
    $num_registro34 = $persona34["count"];
} */

/*
    $total5 = $num_registro27 + $num_registro28 + $num_registro29 + $num_registro30 + $num_registro31 + $num_registro32 + $num_registro33 + $num_registro34;
*/


// Tabla 6 Select 1

$SQL35 = "SELECT DISTINCT
        personales_id, rol_evaluacion_id,
        count(rol_evaluacion_id)
        FROM evaluacion_desemp.evaluacion
        WHERE
        rol_evaluacion_id = 2
        AND
        benabled = 'TRUE'
        group by personales_id, rol_evaluacion_id order by personales_id
";

$rs35 = pg_query($conn, $SQL35);
$persona35 = pg_fetch_assoc($rs35);

if ($persona35["count"] == '') {
    $num_registro35 = 0;
    $num_registro35_1 = 0;
    $num_registro35_2 = 0;
    $num_registro35_3 = 0;
    $num_registro35_4 = 0;
    $num_registro35_5 = 0;
} else {
    $num_registro35 = pg_num_rows($rs35);

    // Select de Excelente

    $SQL35_1 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 2
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Excelente - Cumplimiento Emulable'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs35_1 = pg_query($conn, $SQL35_1);
    $persona35_1 = pg_fetch_assoc($rs35_1);

    if ($persona35_1["count1"] == '') {
        $num_registro35_1 = 0;
    } else {
        $num_registro35_1 = pg_num_rows($rs35_1);
    }

    // Select de Muy Bueno

    $SQL35_2 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 2
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Muy Bueno - Cumplimiento Destacable'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs35_2 = pg_query($conn, $SQL35_2);
    $persona35_2 = pg_fetch_assoc($rs35_2);

    if ($persona35_2["count1"] == '') {
        $num_registro35_2 = 0;
    } else {
        $num_registro35_2 = pg_num_rows($rs35_2);
    }

    // Select de Bueno

    $SQL35_3 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 2
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Bueno - Cumplimiento de Proceso de Mejora'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs35_3 = pg_query($conn, $SQL35_3);
    $persona35_3 = pg_fetch_assoc($rs35_3);

    if ($persona35_3["count1"] == '') {
        $num_registro35_3 = 0;
    } else {
        $num_registro35_3 = pg_num_rows($rs35_3);
    }

    // Select de Cumplimiento Ordinario

    $SQL35_4 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 2
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Cumplimiento Ordinario'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs35_4 = pg_query($conn, $SQL35_4);
    $persona35_4 = pg_fetch_assoc($rs35_4);

    if ($persona35_4["count1"] == '') {
        $num_registro35_4 = 0;
    } else {
        $num_registro35_4 = pg_num_rows($rs35_4);
    }

    // Select de No cumplió

    $SQL35_5 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 2
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'No cumplió'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs35_5 = pg_query($conn, $SQL35_5);
    $persona35_5 = pg_fetch_assoc($rs35_5);

    if ($persona35_5["count1"] == '') {
        $num_registro35_5 = 0;
    } else {
        $num_registro35_5 = pg_num_rows($rs35_5);
    }
}

// Tabla 6 Select 2

$SQL36 = "SELECT DISTINCT
        personales_id, rol_evaluacion_id,
        count(rol_evaluacion_id)
        FROM evaluacion_desemp.evaluacion
        WHERE
        rol_evaluacion_id = 3
        AND
        benabled = 'TRUE'
        group by personales_id, rol_evaluacion_id order by personales_id
";

$rs36 = pg_query($conn, $SQL36);
$persona36 = pg_fetch_assoc($rs36);

if ($persona36["count"] == '') {
    $num_registro36 = 0;
    $num_registro36_1 = 0;
    $num_registro36_2 = 0;
    $num_registro36_3 = 0;
    $num_registro36_4 = 0;
    $num_registro36_5 = 0;
} else {
    $num_registro36 = pg_num_rows($rs36);

    // Select de Excelente

    $SQL36_1 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 3
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Excelente - Cumplimiento Emulable'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs36_1 = pg_query($conn, $SQL65_1);
    $persona36_1 = pg_fetch_assoc($rs36_1);

    if ($persona36_1["count1"] == '') {
        $num_registro36_1 = 0;
    } else {
        $num_registro36_1 = pg_num_rows($rs36_1);
    }

    // Select de Muy Bueno

    $SQL36_2 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 3
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Muy Bueno - Cumplimiento Destacable'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs36_2 = pg_query($conn, $SQL36_2);
    $persona36_2 = pg_fetch_assoc($rs36_2);

    if ($persona36_2["count1"] == '') {
        $num_registro36_2 = 0;
    } else {
        $num_registro36_2 = pg_num_rows($rs36_2);
    }

    // Select de Bueno

    $SQL36_3 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 3
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Bueno - Cumplimiento de Proceso de Mejora'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs36_3 = pg_query($conn, $SQL36_3);
    $persona36_3 = pg_fetch_assoc($rs36_3);

    if ($persona36_3["count1"] == '') {
        $num_registro36_3 = 0;
    } else {
        $num_registro36_3 = pg_num_rows($rs36_3);
    }

    // Select de Cumplimiento Ordinario

    $SQL36_4 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 3
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Cumplimiento Ordinario'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs36_4 = pg_query($conn, $SQL36_4);
    $persona36_4 = pg_fetch_assoc($rs36_4);

    if ($persona36_4["count1"] == '') {
        $num_registro36_4 = 0;
    } else {
        $num_registro36_4 = pg_num_rows($rs36_4);
    }

    // Select de No cumplió

    $SQL36_5 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 3
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'No cumplió'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs36_5 = pg_query($conn, $SQL36_5);
    $persona36_5 = pg_fetch_assoc($rs36_5);

    if ($persona36_5["count1"] == '') {
        $num_registro36_5 = 0;
    } else {
        $num_registro36_5 = pg_num_rows($rs36_5);
    }
}

// Tabla 6 Select 3

$SQL37 = "SELECT DISTINCT
        personales_id, rol_evaluacion_id,
        count(rol_evaluacion_id)
        FROM evaluacion_desemp.evaluacion
        WHERE
        rol_evaluacion_id = 1
        AND
        benabled = 'TRUE'
        group by personales_id, rol_evaluacion_id order by personales_id
";

$rs37 = pg_query($conn, $SQL37);
$persona37 = pg_fetch_assoc($rs37);

if ($persona37["count"] == '') {
    $num_registro37 = 0;
    $num_registro37_1 = 0;
    $num_registro37_2 = 0;
    $num_registro37_3 = 0;
    $num_registro37_4 = 0;
    $num_registro37_5 = 0;
} else {
    $num_registro37 = pg_num_rows($rs37);

    // Select de Excelente

    $SQL37_1 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 1
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Excelente - Cumplimiento Emulable'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs37_1 = pg_query($conn, $SQL37_1);
    $persona37_1 = pg_fetch_assoc($rs37_1);

    if ($persona37_1["count1"] == '') {
        $num_registro37_1 = 0;
    } else {
        $num_registro37_1 = pg_num_rows($rs37_1);
    }

    // Select de Muy Bueno

    $SQL37_2 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 1
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Muy Bueno - Cumplimiento Destacable'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs37_2 = pg_query($conn, $SQL37_2);
    $persona37_2 = pg_fetch_assoc($rs37_2);

    if ($persona37_2["count1"] == '') {
        $num_registro37_2 = 0;
    } else {
        $num_registro37_2 = pg_num_rows($rs37_2);
    }

    // Select de Bueno

    $SQL37_3 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 1
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Bueno - Cumplimiento de Proceso de Mejora'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs37_3 = pg_query($conn, $SQL37_3);
    $persona37_3 = pg_fetch_assoc($rs37_3);

    if ($persona37_3["count1"] == '') {
        $num_registro37_3 = 0;
    } else {
        $num_registro37_3 = pg_num_rows($rs37_3);
    }

    // Select de Cumplimiento Ordinario

    $SQL37_4 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 1
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Cumplimiento Ordinario'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs37_4 = pg_query($conn, $SQL37_4);
    $persona37_4 = pg_fetch_assoc($rs37_4);

    if ($persona37_4["count1"] == '') {
        $num_registro37_4 = 0;
    } else {
        $num_registro37_4 = pg_num_rows($rs37_4);
    }

    // Select de No cumplió

    $SQL37_5 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 1
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'No cumplió'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs37_5 = pg_query($conn, $SQL37_5);
    $persona37_5 = pg_fetch_assoc($rs37_5);

    if ($persona37_5["count1"] == '') {
        $num_registro37_5 = 0;
    } else {
        $num_registro37_5 = pg_num_rows($rs37_5);
    }
}

// Tabla 6 Select 4

$SQL38 = "SELECT DISTINCT
        personales_id, rol_evaluacion_id,
        count(rol_evaluacion_id)
        FROM evaluacion_desemp.evaluacion
        WHERE
        rol_evaluacion_id = 6
        AND
        benabled = 'TRUE'
        group by personales_id, rol_evaluacion_id order by personales_id
";

$rs38 = pg_query($conn, $SQL38);
$persona38 = pg_fetch_assoc($rs38);

if ($persona38["count"] == '') {
    $num_registro38 = 0;
    $num_registro38_1 = 0;
    $num_registro38_2 = 0;
    $num_registro38_3 = 0;
    $num_registro38_4 = 0;
    $num_registro38_5 = 0;
} else {
    $num_registro38 = pg_num_rows($rs38);

    // Select de Excelente

    $SQL38_1 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 6
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Excelente - Cumplimiento Emulable'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs38_1 = pg_query($conn, $SQL38_1);
    $persona38_1 = pg_fetch_assoc($rs38_1);

    if ($persona38_1["count1"] == '') {
        $num_registro38_1 = 0;
    } else {
        $num_registro38_1 = pg_num_rows($rs38_1);
    }

    // Select de Muy Bueno

    $SQL38_2 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 6
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Muy Bueno - Cumplimiento Destacable'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs38_2 = pg_query($conn, $SQL38_2);
    $persona38_2 = pg_fetch_assoc($rs38_2);

    if ($persona38_2["count1"] == '') {
        $num_registro38_2 = 0;
    } else {
        $num_registro38_2 = pg_num_rows($rs38_2);
    }

    // Select de Bueno

    $SQL38_3 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 6
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Bueno - Cumplimiento de Proceso de Mejora'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs38_3 = pg_query($conn, $SQL38_3);
    $persona38_3 = pg_fetch_assoc($rs38_3);

    if ($persona38_3["count1"] == '') {
        $num_registro38_3 = 0;
    } else {
        $num_registro38_3 = pg_num_rows($rs38_3);
    }

    // Select de Cumplimiento Ordinario

    $SQL38_4 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 6
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Cumplimiento Ordinario'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs38_4 = pg_query($conn, $SQL38_4);
    $persona38_4 = pg_fetch_assoc($rs38_4);

    if ($persona38_4["count1"] == '') {
        $num_registro38_4 = 0;
    } else {
        $num_registro38_4 = pg_num_rows($rs38_4);
    }

    // Select de No cumplió

    $SQL38_5 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 6
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'No cumplió'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs38_5 = pg_query($conn, $SQL38_5);
    $persona38_5 = pg_fetch_assoc($rs38_5);

    if ($persona38_5["count1"] == '') {
        $num_registro38_5 = 0;
    } else {
        $num_registro38_5 = pg_num_rows($rs38_5);
    }
}

// Tabla 6 Select 5

$SQL39 = "SELECT DISTINCT
        personales_id, rol_evaluacion_id,
        count(rol_evaluacion_id)
        FROM evaluacion_desemp.evaluacion
        WHERE
        rol_evaluacion_id = 5
        AND
        benabled = 'TRUE'
        group by personales_id, rol_evaluacion_id order by personales_id
";

$rs39 = pg_query($conn, $SQL39);
$persona39 = pg_fetch_assoc($rs39);

if ($persona39["count"] == '') {
    $num_registro39 = 0;
    $num_registro39_1 = 0;
    $num_registro39_2 = 0;
    $num_registro39_3 = 0;
    $num_registro39_4 = 0;
    $num_registro39_5 = 0;
} else {
    $num_registro39 = pg_num_rows($rs39);

    // Select de Excelente

    $SQL39_1 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 5
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Excelente - Cumplimiento Emulable'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs39_1 = pg_query($conn, $SQL39_1);
    $persona39_1 = pg_fetch_assoc($rs39_1);

    if ($persona39_1["count1"] == '') {
        $num_registro39_1 = 0;
    } else {
        $num_registro39_1 = pg_num_rows($rs39_1);
    }

    // Select de Muy Bueno

    $SQL39_2 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 5
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Muy Bueno - Cumplimiento Destacable'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs39_2 = pg_query($conn, $SQL39_2);
    $persona39_2 = pg_fetch_assoc($rs39_2);

    if ($persona39_2["count1"] == '') {
        $num_registro39_2 = 0;
    } else {
        $num_registro39_2 = pg_num_rows($rs39_2);
    }

    // Select de Bueno

    $SQL39_3 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 5
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Bueno - Cumplimiento de Proceso de Mejora'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs39_3 = pg_query($conn, $SQL39_3);
    $persona39_3 = pg_fetch_assoc($rs39_3);

    if ($persona39_3["count1"] == '') {
        $num_registro39_3 = 0;
    } else {
        $num_registro39_3 = pg_num_rows($rs39_3);
    }

    // Select de Cumplimiento Ordinario

    $SQL39_4 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 5
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Cumplimiento Ordinario'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs39_4 = pg_query($conn, $SQL39_4);
    $persona39_4 = pg_fetch_assoc($rs39_4);

    if ($persona39_4["count1"] == '') {
        $num_registro39_4 = 0;
    } else {
        $num_registro39_4 = pg_num_rows($rs39_4);
    }

    // Select de No cumplió

    $SQL39_5 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 5
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'No cumplió'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs39_5 = pg_query($conn, $SQL39_5);
    $persona39_5 = pg_fetch_assoc($rs39_5);

    if ($persona39_5["count1"] == '') {
        $num_registro39_5 = 0;
    } else {
        $num_registro39_5 = pg_num_rows($rs39_5);
    }
}

// Tabla 6 Select 6

$SQL40 = "SELECT DISTINCT
        personales_id, rol_evaluacion_id,
        count(rol_evaluacion_id)
        FROM evaluacion_desemp.evaluacion
        WHERE
        rol_evaluacion_id = 15
        AND
        benabled = 'TRUE'
        group by personales_id, rol_evaluacion_id order by personales_id
";

$rs40 = pg_query($conn, $SQL40);
$persona40 = pg_fetch_assoc($rs40);

if ($persona40["count"] == '') {
    $num_registro40 = 0;
    $num_registro40_1 = 0;
    $num_registro40_2 = 0;
    $num_registro40_3 = 0;
    $num_registro40_4 = 0;
    $num_registro40_5 = 0;
} else {
    $num_registro40 = pg_num_rows($rs40);

    // Select de Excelente

    $SQL40_1 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 15
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Excelente - Cumplimiento Emulable'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs40_1 = pg_query($conn, $SQL40_1);
    $persona40_1 = pg_fetch_assoc($rs40_1);

    if ($persona40_1["count1"] == '') {
        $num_registro40_1 = 0;
    } else {
        $num_registro40_1 = pg_num_rows($rs40_1);
    }

    // Select de Muy Bueno

    $SQL40_2 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 15
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Muy Bueno - Cumplimiento Destacable'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs40_2 = pg_query($conn, $SQL40_2);
    $persona40_2 = pg_fetch_assoc($rs40_2);

    if ($persona40_2["count1"] == '') {
        $num_registro40_2 = 0;
    } else {
        $num_registro40_2 = pg_num_rows($rs40_2);
    }

    // Select de Bueno

    $SQL40_3 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 15
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Bueno - Cumplimiento de Proceso de Mejora'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs40_3 = pg_query($conn, $SQL40_3);
    $persona40_3 = pg_fetch_assoc($rs40_3);

    if ($persona40_3["count1"] == '') {
        $num_registro40_3 = 0;
    } else {
        $num_registro40_3 = pg_num_rows($rs40_3);
    }

    // Select de Cumplimiento Ordinario

    $SQL40_4 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 15
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Cumplimiento Ordinario'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs40_4 = pg_query($conn, $SQL40_4);
    $persona40_4 = pg_fetch_assoc($rs40_4);

    if ($persona40_4["count1"] == '') {
        $num_registro40_4 = 0;
    } else {
        $num_registro40_4 = pg_num_rows($rs40_4);
    }

    // Select de No cumplió

    $SQL40_5 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 15
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'No cumplió'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs40_5 = pg_query($conn, $SQL40_5);
    $persona40_5 = pg_fetch_assoc($rs40_5);

    if ($persona40_5["count1"] == '') {
        $num_registro40_5 = 0;
    } else {
        $num_registro40_5 = pg_num_rows($rs40_5);
    }
}

// Tabla 6 Select 7

$SQL41 = "SELECT DISTINCT
        personales_id, rol_evaluacion_id,
        count(rol_evaluacion_id)
        FROM evaluacion_desemp.evaluacion
        WHERE
        rol_evaluacion_id = 4
        AND
        benabled = 'TRUE'
        group by personales_id, rol_evaluacion_id order by personales_id
";

$rs41 = pg_query($conn, $SQL41);
$persona41 = pg_fetch_assoc($rs41);

if ($persona41["count"] == '') {
    $num_registro41 = 0;
    $num_registro41_1 = 0;
    $num_registro41_2 = 0;
    $num_registro41_3 = 0;
    $num_registro41_4 = 0;
    $num_registro41_5 = 0;
} else {
    $num_registro41 = pg_num_rows($rs41);

    // Select de Excelente

    $SQL41_1 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 4
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Excelente - Cumplimiento Emulable'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs41_1 = pg_query($conn, $SQL41_1);
    $persona41_1 = pg_fetch_assoc($rs41_1);

    if ($persona41_1["count1"] == '') {
        $num_registro41_1 = 0;
    } else {
        $num_registro41_1 = pg_num_rows($rs41_1);
    }

    // Select de Muy Bueno

    $SQL41_2 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 4
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Muy Bueno - Cumplimiento Destacable'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs41_2 = pg_query($conn, $SQL41_2);
    $persona41_2 = pg_fetch_assoc($rs41_2);

    if ($persona41_2["count1"] == '') {
        $num_registro41_2 = 0;
    } else {
        $num_registro41_2 = pg_num_rows($rs41_2);
    }

    // Select de Bueno

    $SQL41_3 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 4
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Bueno - Cumplimiento de Proceso de Mejora'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs41_3 = pg_query($conn, $SQL41_3);
    $persona41_3 = pg_fetch_assoc($rs41_3);

    if ($persona41_3["count1"] == '') {
        $num_registro41_3 = 0;
    } else {
        $num_registro41_3 = pg_num_rows($rs41_3);
    }

    // Select de Cumplimiento Ordinario

    $SQL41_4 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 4
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'Cumplimiento Ordinario'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs41_4 = pg_query($conn, $SQL41_4);
    $persona41_4 = pg_fetch_assoc($rs41_4);

    if ($persona41_4["count1"] == '') {
        $num_registro41_4 = 0;
    } else {
        $num_registro41_4 = pg_num_rows($rs41_4);
    }

    // Select de No cumplió

    $SQL41_5 = "SELECT DISTINCT
                personales_id, rol_evaluacion_id, srango_actuacion,
                count(personales_id) AS count1, count(srango_actuacion) AS count2
                FROM evaluacion_desemp.evaluacion
                WHERE
                rol_evaluacion_id = 4
                AND
                benabled = 'TRUE'
                AND
                srango_actuacion = 'No cumplió'
                group by personales_id, rol_evaluacion_id, srango_actuacion order by personales_id
    ";

    $rs41_5 = pg_query($conn, $SQL41_5);
    $persona41_5 = pg_fetch_assoc($rs41_5);

    if ($persona41_5["count1"] == '') {
        $num_registro41_5 = 0;
    } else {
        $num_registro41_5 = pg_num_rows($rs41_5);
    }
}

$total6 = $num_registro35 + $num_registro36 + $num_registro37 + $num_registro38 + $num_registro39 + $num_registro40 + $num_registro41;

$total6_1 = $num_registro35_1 + $num_registro36_1 + $num_registro37_1 + $num_registro38_1 + $num_registro39_1 + $num_registro40_1 + $num_registro41_1;
$total6_2 = $num_registro35_2 + $num_registro36_2 + $num_registro37_2 + $num_registro38_2 + $num_registro39_2 + $num_registro40_2 + $num_registro41_2;
$total6_3 = $num_registro35_3 + $num_registro36_3 + $num_registro37_3 + $num_registro38_3 + $num_registro39_3 + $num_registro40_3 + $num_registro41_3;
$total6_4 = $num_registro35_4 + $num_registro36_4 + $num_registro37_4 + $num_registro38_4 + $num_registro39_4 + $num_registro40_4 + $num_registro41_4;
$total6_5 = $num_registro35_5 + $num_registro36_5 + $num_registro37_5 + $num_registro38_5 + $num_registro39_5 + $num_registro40_5 + $num_registro41_5;

/* Para la Tabla 9 */

$total_6_2 = $num_registro35 + $num_registro36 + $num_registro37 + $num_registro38 + $num_registro39 + $num_registro41;

$total6_1_2 = $num_registro35_1 + $num_registro36_1 + $num_registro37_1 + $num_registro38_1 + $num_registro39_1 + $num_registro41_1;
$total6_2_2 = $num_registro35_2 + $num_registro36_2 + $num_registro37_2 + $num_registro38_2 + $num_registro39_2 + $num_registro41_2;
$total6_3_2 = $num_registro35_3 + $num_registro36_3 + $num_registro37_3 + $num_registro38_3 + $num_registro39_3 + $num_registro41_3;
$total6_4_2 = $num_registro35_4 + $num_registro36_4 + $num_registro37_4 + $num_registro38_4 + $num_registro39_4 + $num_registro41_4;
$total6_5_2 = $num_registro35_5 + $num_registro36_5 + $num_registro37_5 + $num_registro38_5 + $num_registro39_5 + $num_registro41_5;

// Tabla 7

$año_periodo = 2024;
$periodo = 2;

// Tabla 7 Select 1

$SQL42 = "SELECT DISTINCT srango_actuacion, periodo_eval_id, anio_periodo, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        anio_periodo = '$año_periodo'
        AND
        periodo_eval_id = '$periodo'
        AND
        srango_actuacion = 'Excelente - Cumplimiento Emulable'
        AND
        benabled = 'TRUE'
        group by srango_actuacion, periodo_eval_id, anio_periodo order by srango_actuacion
";

$rs42 = pg_query($conn, $SQL42);
$persona42 = pg_fetch_assoc($rs42);

if ($persona42["count"] == '') {
    $num_registro42 = 0;
} else {
    $num_registro42 = $persona42["count"];
}

// Tabla 7 Select 2

$SQL43 = "SELECT DISTINCT srango_actuacion, periodo_eval_id, anio_periodo, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        anio_periodo = '$año_periodo'
        AND
        periodo_eval_id = '$periodo'
        AND
        srango_actuacion = 'Muy Bueno - Cumplimiento Destacable'
        AND
        benabled = 'TRUE'
        group by srango_actuacion, periodo_eval_id, anio_periodo order by srango_actuacion
";

$rs43 = pg_query($conn, $SQL43);
$persona43 = pg_fetch_assoc($rs43);

if ($persona43["count"] == '') {
    $num_registro43 = 0;
} else {
    $num_registro43 = $persona43["count"];
}

// Tabla 7 Select 3

$SQL44 = "SELECT DISTINCT srango_actuacion, periodo_eval_id, anio_periodo, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        anio_periodo = '$año_periodo'
        AND
        periodo_eval_id = '$periodo'
        AND
        srango_actuacion = 'Bueno - Cumplimiento de Proceso de Mejora'
        AND
        benabled = 'TRUE'
        group by srango_actuacion, periodo_eval_id, anio_periodo order by srango_actuacion
";

$rs44 = pg_query($conn, $SQL44);
$persona44 = pg_fetch_assoc($rs44);

if ($persona44["count"] == '') {
    $num_registro44 = 0;
} else {
    $num_registro44 = $persona44["count"];
}

// Tabla 7 Select 4

$SQL45 = "SELECT DISTINCT srango_actuacion, periodo_eval_id, anio_periodo, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        anio_periodo = '$año_periodo'
        AND
        periodo_eval_id = '$periodo'
        AND
        srango_actuacion = 'Cumplimiento Ordinario'
        AND
        benabled = 'TRUE'
        group by srango_actuacion, periodo_eval_id, anio_periodo order by srango_actuacion
";

$rs45 = pg_query($conn, $SQL45);
$persona45 = pg_fetch_assoc($rs45);

if ($persona45["count"] == '') {
    $num_registro45 = 0;
} else {
    $num_registro45 = $persona45["count"];
}

// Tabla 7 Select 5

$SQL46 = "SELECT DISTINCT srango_actuacion, periodo_eval_id, anio_periodo, count(srango_actuacion) 
        FROM evaluacion_desemp.evaluacion
        WHERE
        anio_periodo = '$año_periodo'
        AND
        periodo_eval_id = '$periodo'
        AND
        srango_actuacion = 'No cumplió'
        AND
        benabled = 'TRUE'
        group by srango_actuacion, periodo_eval_id, anio_periodo order by srango_actuacion
";

$rs46 = pg_query($conn, $SQL46);
$persona46 = pg_fetch_assoc($rs46);

if ($persona46["count"] == '') {
    $num_registro46 = 0;
} else {
    $num_registro46 = $persona46["count"];
}

$total7 = $num_registro42 + $num_registro43 + $num_registro44 + $num_registro45 + $num_registro46;

$total2_3 = $total2 + $total3;

/* $periodo = $_SESSION["Periodo"]; */
$ayo = date('y');

if ($periodo == 1) {
    $desde = "01/01/" . $ayo;
    $hasta = "31/03/" . $ayo;
    $num_periodo = "1ER TRIMESTRE 20" . $ayo;
    $num_periodo2 = "1er Trimestre 20" . $ayo;
} else
if ($periodo == 2) {
    $desde = "01/04/" . $ayo;
    $hasta = "30/06/" . $ayo;
    $num_periodo = "2DO TRIMESTRE 20" . $ayo;
    $num_periodo2 = "2do Trimestre 20" . $ayo;
} else
if ($periodo == 3) {
    $desde = "01/7/" . $ayo;
    $hasta = "31/9/" . $ayo;
    $num_periodo = "3ER TRIMESTRE 20" . $ayo;
    $num_periodo2 = "3er Trimestre 20" . $ayo;
} else
if ($periodo == 4) {
    $desde = "01/10/" . $ayo;
    $hasta = "31/12/" . $ayo;
    $num_periodo = "4TO TRIMESTRE 20" . $ayo;
    $num_periodo2 = "4to Trimestre 20" . $ayo;
}


$_SESSION["Desde"] = $desde;
$_SESSION["Hasta"] = $hasta;

?>
<table class="tabla" width="95%" height="95%">
    <tbody>
        <tr valign="top">
            <td>
                <br />
                <table width="95%" border="0" align="center" class="formulario">

                    <!-- ------------------------------ Periodo Evaluado --------------------------------------  -->

                    <tr>
                        <th colspan="2" class="sub_titulo">
                            <div align="center">
                                <img src="../imagenes/cabecera_superior.png">
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="4"> </td>
                    </tr>
                    <tr>
                        <td colspan="4"> </td>
                    </tr>

                    <!-- ------------------------------ 1.- Total de la Población Laboral del Organismo --------------------------------------  -->

                    <style>
                        .th,
                        .td {
                            border: 1px solid #ddd;
                            padding: 8px;
                            text-align: left;
                        }

                        .center {
                            text-align: center;
                        }

                        .th {
                            background-color: #f0f0f0;
                            color: #1060C8;
                            text-align: center;
                        }

                        .identificacion_seccion>th {
                            color: #1060C8;
                        }
                    </style>

                    <tr class="identificacion_seccion">
                        <th colspan="2" width="100%" align="center" style="font-size: 15px">
                            1.- Total de la Población Laboral del Organismo
                        </th>
                    </tr>
                    <tr>
                        <td colspan="4"> </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table style="width: 100%; border: 2px black solid; border-collapse: collapse; width: 100%; margin: 20px auto;">
                                <thead>
                                    <tr>
                                        <th class="th"> TIPO DE PERSONAL </th>
                                        <th class="th"> N° </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="td"> Alto Nivel </td>
                                        <td class="td center"> <? echo $num_registro1; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Designados </td>
                                        <td class="td center"> <? echo $num_registro2; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Empleados Fijos </td>
                                        <td class="td center"> <? echo $num_registro3; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Empleados Contratados </td>
                                        <td class="td center"> <? echo $num_registro4; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Obreros Fijos </td>
                                        <td class="td center"> <? echo $num_registro5; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Obreros Contratados </td>
                                        <td class="td center"> <? echo $num_registro6; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Camisión de Servicio </td>
                                        <td class="td center"> <? echo $num_registro7; ?> </td>
                                    </tr>
                                    <tr>
                                        <th class="th"><b> TOTAL </b></th>
                                        <th class="th center"><b> <? echo $total1; ?> </b></th>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td colspan="2">
                        </td>
                    </tr>

                    <!-- ------------------------------ 2.- Total de la Población Laboral del Organismo Evaluado --------------------------------------  -->

                    <tr class="identificacion_seccion">
                        <th colspan="2" width="100%" align="center" style="font-size: 15px">
                            2.- Total de la Población Laboral del Organismo Evaluado
                        </th>
                    </tr>
                    <tr>
                        <td colspan="4"> </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table style="width: 100%; border: 2px black solid; border-collapse: collapse; width: 100%; margin: 20px auto;">
                                <thead>
                                    <tr>
                                        <th class="th"> TIPO DE PERSONAL </th>
                                        <th class="th"> N° </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="td"> Alto Nivel </td>
                                        <td class="td center"> <? echo $num_registro8; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Designados </td>
                                        <td class="td center"> <? echo $num_registro9; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Empleados Fijos </td>
                                        <td class="td center"> <? echo $num_registro10; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Empleados Contratados </td>
                                        <td class="td center"> <? echo $num_registro11; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Obreros Fijos </td>
                                        <td class="td center"> <? echo $num_registro12; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Obreros Contratados </td>
                                        <td class="td center"> <? echo $num_registro13; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Camisión de Servicio </td>
                                        <td class="td center"> <? echo $num_registro14; ?> </td>
                                    </tr>
                                    <tr>
                                        <th class="th"><b> TOTAL </b></th>
                                        <th class="th"><b> <? echo $total2; ?> </b></th>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td colspan="2">
                        </td>
                    </tr>

                    <!-- ------------------------------ 3.- Total de la Población Laboral del Organismo no Evaluado --------------------------------------  -->

                    <tr class="identificacion_seccion">
                        <th colspan="2" width="100%" align="center" style="font-size: 15px">
                            3.- Total de la Población Laboral del Organismo no Evaluado
                        </th>
                    </tr>
                    <tr>
                        <td colspan="4"> </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table style="width: 100%; border: 2px black solid; border-collapse: collapse; width: 100%; margin: 20px auto;">
                                <thead>
                                    <tr>
                                        <th class="th"> TIPO DE PERSONAL </th>
                                        <th class="th"> N° </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="td"> Alto Nivel </td>
                                        <td class="td center"> <? echo $num_registro15; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Designados </td>
                                        <td class="td center"> <? echo $num_registro16; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Empleados Fijos </td>
                                        <td class="td center"> <? echo $num_registro17; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Empleados Contratados </td>
                                        <td class="td center"> <? echo $num_registro18; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Obreros Fijos </td>
                                        <td class="td center"> <? echo $num_registro19; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Obreros Contratados </td>
                                        <td class="td center"> <? echo $num_registro20; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Camisión de Servicio </td>
                                        <td class="td center"> <? echo $num_registro21; ?> </td>
                                    </tr>
                                    <tr>
                                        <th class="th"><b> TOTAL </b></th>
                                        <th class="th"><b> <? echo $total3; ?> </b></th>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <!-- ------------------------------ 4.- Distribución del Personal Evaluado en los Rangos de Actuación --------------------------------------  -->

                    <tr class="identificacion_seccion">
                        <th colspan="2" width="100%" align="center" style="font-size: 15px">
                            4.- Distribución del Personal Evaluado en los Rangos de Actuación
                        </th>
                    </tr>
                    <tr>
                        <td colspan="4"> </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table style="width: 100%; border: 2px black solid; border-collapse: collapse; width: 100%; margin: 20px auto;">
                                <thead>
                                    <tr>
                                        <th class="th"> RANGO DE ACTUACIÓN </th>
                                        <th class="th"> 1ER TRIMESTRE 2023 </th>
                                        <th class="th"> PORCENTAJE </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="td"> Excelente </td>
                                        <td class="td center"> <? echo $num_registro22; ?> </td>
                                        <td class="td center"> <? echo number_format($porcentaje1, 2); ?>% </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Muy Bueno </td>
                                        <td class="td center"> <? echo $num_registro23; ?> </td>
                                        <td class="td center"> <? echo number_format($porcentaje2, 2); ?>% </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Bueno </td>
                                        <td class="td center"> <? echo $num_registro24; ?> </td>
                                        <td class="td center"> <? echo number_format($porcentaje3, 2); ?>% </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Cumplimiento Ordinario </td>
                                        <td class="td center"> <? echo $num_registro25; ?> </td>
                                        <td class="td center"> <? echo number_format($porcentaje4, 2); ?>% </td>
                                    </tr>
                                    <tr>
                                        <td class="td">No Cumplió </td>
                                        <td class="td center"> <? echo $num_registro26; ?> </td>
                                        <td class="td center"> <? echo number_format($porcentaje5, 2); ?>% </td>
                                    </tr>
                                    <tr>
                                        <th class="th"> TOTAL </th>
                                        <th class="th"> <? echo $total4; ?> </th>
                                        <th class="th"> <? echo $total_porcentajes; ?>% </th>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td colspan="2">
                        </td>
                    </tr>

                    <!-- ------------------------------ 5.- Razones y Circunstancias por las cuales la población OBJETO <br>de Evaluación quedó excluida del Proceso de Evaluación --------------------------------------  -->

                    <tr class="identificacion_seccion">
                        <th colspan="4" width="100%" align="center" style="font-size: 15px" class="title">
                            5.- Razones y Circunstancias por las cuales la población OBJETO <br>de Evaluación quedó excluida del Proceso de Evaluación
                        </th>
                    </tr>
                    <tr>
                        <td colspan="4"> </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table style="width: 100%; border: 2px black solid; border-collapse: collapse; width: 100%; margin: 20px auto;">
                                <thead>
                                    <tr>
                                        <th class="th" colspan="2"> RAZONES Y CIRCUNSTANCIAS </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?
                                    $i = 0;
                                    $sql = "SELECT
                                            incidencias.sdescripcion, count (personas_incidencias.personales_id)    
                                            FROM
                                            evaluacion_desemp.personas_incidencias
                                            LEFT JOIN evaluacion_desemp.incidencias ON evaluacion_desemp.incidencias.id = personas_incidencias.incidencias_id
                                            WHERE personas_incidencias.benabled='TRUE' AND personas_incidencias.periodo_eval_id = $periodo
                                            GROUP BY incidencias.sdescripcion ORDER BY sdescripcion
                                    ";
                                    $row = pg_query($conn, $sql);
                                    $persona = pg_fetch_all($row);

                                    while ($persona = pg_fetch_assoc($row)) {

                                        $i++;
                                        $cosa .= "
                                                <tr>
                                                    <td class=\"td center\" style=\"width: 70%;\">" . $persona['sdescripcion'] . "</td>
                                                    <td class=\"td center\" style=\"width: 70%;\">" . $persona['count'] . "</td>
                                                </tr>
                                        ";
                                        $total5 += $persona['count'];
                                    }
                                    $sql0 = "SELECT
                                            incidencias.sdescripcion,
                                            0 AS count
                                            FROM
                                            evaluacion_desemp.incidencias
                                            WHERE
                                            NOT EXISTS (
                                                SELECT 1
                                                FROM evaluacion_desemp.personas_incidencias
                                                WHERE
                                                evaluacion_desemp.personas_incidencias.incidencias_id = evaluacion_desemp.incidencias.id
                                            )
                                            AND benabled = 'TRUE'
                                    ";
                                    $row0 = pg_query($conn, $sql0);
                                    $persona0 = pg_fetch_all($row0);

                                    while ($persona0 = pg_fetch_assoc($row0)) {

                                        $i++;
                                        $cosa .= "
                                                <tr>
                                                    <td class=\"td center\" style=\"width: 70%;\">" . $persona0['sdescripcion'] . "</td>
                                                    <td class=\"td center\" style=\"width: 70%;\">" . $persona0['count'] . "</td>
                                                </tr>
                                        ";
                                        $total5 += $persona40_3['count'];
                                    }
                                    echo $cosa;
                                    ?>
                                    <tr>
                                        <th class="th"><b> TOTAL </b></th>
                                        <th class="th center"><b> <? echo $total5; ?> </b></th>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td colspan="2">
                        </td>
                    </tr>

                    <!-- ------------------------------ 6.- Ministerio del Poder Popular para el Proceso Social de TRABAJO CMPPPST --------------------------------------  -->

                    <tr class="identificacion_seccion">
                        <th colspan="4" width="100%" align="center" style="font-size: 15px">
                            6.- Ministerio del Poder Popular para el Proceso Social de TRABAJO CMPPPST
                        </th>
                    </tr>
                    <tr>
                        <td colspan="4"> </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table style="width: 100%; border: 2px black solid; border-collapse: collapse; width: 100%; margin: 20px auto;">
                                <thead>
                                    <tr>
                                        <th class="th"> TIPO PERSONAL </th>
                                        <th class="th"> N° </th>
                                        <th class="th"> EXCELENTE </th>
                                        <th class="th"> MUY BUENO </th>
                                        <th class="th"> BUENO </th>
                                        <th class="th"> CUMPLIMIENTO ORDINARIO </th>
                                        <th class="th"> NO CUMPLIÓ </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="td"> Alto Nivel </td>
                                        <td class="td center"> <? echo $num_registro35 ?> </td>
                                        <td class="td center"> <? echo $num_registro35_1 ?> </td>
                                        <td class="td center"> <? echo $num_registro35_2 ?> </td>
                                        <td class="td center"> <? echo $num_registro35_3 ?> </td>
                                        <td class="td center"> <? echo $num_registro35_4 ?> </td>
                                        <td class="td center"> <? echo $num_registro35_5 ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Designados </td>
                                        <td class="td center"> <? echo $num_registro36 ?> </td>
                                        <td class="td center"> <? echo $num_registro36_1 ?> </td>
                                        <td class="td center"> <? echo $num_registro36_2 ?> </td>
                                        <td class="td center"> <? echo $num_registro36_3 ?> </td>
                                        <td class="td center"> <? echo $num_registro36_4 ?> </td>
                                        <td class="td center"> <? echo $num_registro36_5 ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Empleados Fijos </td>
                                        <td class="td center"> <? echo $num_registro37 ?> </td>
                                        <td class="td center"> <? echo $num_registro37_1 ?> </td>
                                        <td class="td center"> <? echo $num_registro37_2 ?> </td>
                                        <td class="td center"> <? echo $num_registro37_3 ?> </td>
                                        <td class="td center"> <? echo $num_registro37_4 ?> </td>
                                        <td class="td center"> <? echo $num_registro37_5 ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Empleados Contratados </td>
                                        <td class="td center"> <? echo $num_registro38 ?> </td>
                                        <td class="td center"> <? echo $num_registro38_1 ?> </td>
                                        <td class="td center"> <? echo $num_registro38_2 ?> </td>
                                        <td class="td center"> <? echo $num_registro38_3 ?> </td>
                                        <td class="td center"> <? echo $num_registro38_4 ?> </td>
                                        <td class="td center"> <? echo $num_registro38_5 ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Obreros Fijos </td>
                                        <td class="td center"> <? echo $num_registro39 ?> </td>
                                        <td class="td center"> <? echo $num_registro39_1 ?> </td>
                                        <td class="td center"> <? echo $num_registro39_2 ?> </td>
                                        <td class="td center"> <? echo $num_registro39_3 ?> </td>
                                        <td class="td center"> <? echo $num_registro39_4 ?> </td>
                                        <td class="td center"> <? echo $num_registro39_5 ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Obreros Contratados </td>
                                        <td class="td center"> <? echo $num_registro40 ?> </td>
                                        <td class="td center"> <? echo $num_registro40_1 ?> </td>
                                        <td class="td center"> <? echo $num_registro40_2 ?> </td>
                                        <td class="td center"> <? echo $num_registro40_3 ?> </td>
                                        <td class="td center"> <? echo $num_registro40_4 ?> </td>
                                        <td class="td center"> <? echo $num_registro40_5 ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Comisión de Servicio </td>
                                        <td class="td center"> <? echo $num_registro41 ?> </td>
                                        <td class="td center"> <? echo $num_registro41_1 ?> </td>
                                        <td class="td center"> <? echo $num_registro41_2 ?> </td>
                                        <td class="td center"> <? echo $num_registro41_3 ?> </td>
                                        <td class="td center"> <? echo $num_registro41_4 ?> </td>
                                        <td class="td center"> <? echo $num_registro41_5 ?> </td>
                                    </tr>
                                    <tr>
                                        <th class="th"><b> TOTAL </b></th>
                                        <th class="th center"><b> <? echo $total6 ?> </b></th>
                                        <th class="th center"><b> <? echo $total6_1 ?> </b></th>
                                        <th class="th center"><b> <? echo $total6_2 ?> </b></th>
                                        <th class="th center"><b> <? echo $total6_3 ?> </b></th>
                                        <th class="th center"><b> <? echo $total6_4 ?> </b></th>
                                        <th class="th center"><b> <? echo $total6_5 ?> </b></th>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td colspan="2">
                        </td>
                    </tr>

                    <!-- ------------------------------ 7.- Evaluaciones de Desempeño 1er Trimestre 2023 Ministerio del Poder Popular para el Proceso Social de Trabajo --------------------------------------  -->

                    <tr class="identificacion_seccion">
                        <th colspan="4" width="100%" align="center" style="font-size: 15px">
                            7.- Evaluaciones de Desempeño <? echo $num_periodo2; ?> <br> Ministerio del Poder Popular para el Proceso Social de Trabajo
                        </th>
                    </tr>
                    <tr>
                        <td colspan="4"> </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table style="width: 100%; border: 2px black solid; border-collapse: collapse; width: 100%; margin: 20px auto;">
                                <thead>
                                    <tr>
                                        <th class="th"> RANGO DE ACTUACIÓN </th>
                                        <th class="th"> TOTAL DE EVALUADOS </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="td"> Excelente </td>
                                        <td class="td center"> <? echo $num_registro42; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Muy Bueno </td>
                                        <td class="td center"> <? echo $num_registro43; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Bueno </td>
                                        <td class="td center"> <? echo $num_registro44; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"> Cumplimiento Ordinario </td>
                                        <td class="td center"> <? echo $num_registro45; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="td">No Cumplió </td>
                                        <td class="td center"> <? echo $num_registro46; ?> </td>
                                    </tr>
                                    <tr>
                                        <th class="th"><b> TOTAL </b></th>
                                        <th class="th center"><b> <? echo $total7; ?> </b></th>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td colspan="2">
                        </td>
                    </tr>

                    <!-- ------------------------------ 8.- Evaluación de Desempeño del MPPPST --------------------------------------  -->

                    <tr class="identificacion_seccion">
                        <th colspan="4" width="100%" align="center" style="font-size: 15px">
                            8.- Evaluación de Desempeño del MPPPST <br> <? echo $num_periodo2; ?>
                        </th>
                    </tr>
                    <?

                    ?>
                    <input type="text" style="display: none;" value="<? echo $num_registro22; ?>" id="excelente_8" readonly>
                    <input type="text" style="display: none;" value="<? echo $num_registro23; ?>" id="muy_bueno_8" readonly>
                    <input type="text" style="display: none;" value="<? echo $num_registro24; ?>" id="bueno_8" readonly>
                    <input type="text" style="display: none;" value="<? echo $num_registro25; ?>" id="cumplimiento_ordinario_8" readonly>
                    <input type="text" style="display: none;" value="<? echo $num_registro26; ?>" id="no_cumplio_8" readonly>
                    <tr>
                        <td colspan="4"> </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </td>
                    </tr>

                    <!-- ------------------------------ 9.- Diseño Horizontal --------------------------------------  -->

                    <tr class="identificacion_seccion">
                        <th colspan="4" width="100%" align="center" style="font-size: 15px">
                            9.- Diseño Horizontal
                        </th>
                    </tr>
                    <tr>
                        <td colspan="4"> </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table style="border: 2px black solid; border-collapse: collapse; width: 70%; margin: 20px auto; float: left; font-size: 13px">
                                <thead>
                                    <tr>
                                        <th class="th" style="width: 9.09%;"> ORGANISMO </th>
                                        <th class="th" style="width: 9.09%;"> TIPO DE CARGO </th>
                                        <th class="th" style="width: 4%;"> TOTAL EVALUADOS </th>
                                        <th class="th" style="width: 4%;"> TOTAL NO EVALUADOS </th>
                                        <th class="th" style="width: 4%;"> TOTAL POBLACIÓN </th>
                                        <th class="th" style="width: 4%;"> EXCELENTE </th>
                                        <th class="th" style="width: 4%;"> MUY BUENO </th>
                                        <th class="th" style="width: 4%;"> BUENO </th>
                                        <th class="th" style="width: 4%;"> CUMPLIMIENTO ORDINARIO </th>
                                        <th class="th" style="width: 4%;"> NO CUMPLIÓ </th>
                                        <th class="th" style="width: 4%;"> OBSERVACIONES </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="td" rowspan="10"><b> Ministerio del Poder Popular para el Proceso Social de Trabajo (MPPPST) </b></td>
                                    </tr>
                                    <tr>
                                        <td class="td"><b> ALTO NIVEL </b></td>
                                        <td class="td center"> <? echo $num_registro8; ?> </td>
                                        <td class="td center"> <? echo $num_registro15; ?> </td>
                                        <td class="td center"> <? echo $num_registro1; ?> </td>
                                        <td class="td center"> <? echo $num_registro35_1; ?> </td>
                                        <td class="td center"> <? echo $num_registro35_2; ?> </td>
                                        <td class="td center"> <? echo $num_registro35_3; ?> </td>
                                        <td class="td center"> <? echo $num_registro35_4; ?> </td>
                                        <td class="td center"> <? echo $num_registro35_5; ?> </td>
                                        <td class="td"> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"><b> DESIGNADO (GRADO 99) </b></td>
                                        <td class="td center"> <? echo $num_registro9; ?> </td>
                                        <td class="td center"> <? echo $num_registro16; ?> </td>
                                        <td class="td center"> <? echo $num_registro2; ?> </td>
                                        <td class="td center"> <? echo $num_registro36_1; ?> </td>
                                        <td class="td center"> <? echo $num_registro36_2; ?> </td>
                                        <td class="td center"> <? echo $num_registro36_3; ?> </td>
                                        <td class="td center"> <? echo $num_registro36_4; ?> </td>
                                        <td class="td center"> <? echo $num_registro36_5; ?> </td>
                                        <td class="td"> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"><b> EMPLEADO </b></td>
                                        <td class="td center"> <? echo $num_registro10; ?> </td>
                                        <td class="td center"> <? echo $num_registro17; ?> </td>
                                        <td class="td center"> <? echo $num_registro3; ?> </td>
                                        <td class="td center"> <? echo $num_registro37_1; ?> </td>
                                        <td class="td center"> <? echo $num_registro37_2; ?> </td>
                                        <td class="td center"> <? echo $num_registro37_3; ?> </td>
                                        <td class="td center"> <? echo $num_registro37_4; ?> </td>
                                        <td class="td center"> <? echo $num_registro37_5; ?> </td>
                                        <td class="td"> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"><b> CONTRATADO </b></td>
                                        <td class="td center"> <? echo $num_registro11; ?> </td>
                                        <td class="td center"> <? echo $num_registro18; ?> </td>
                                        <td class="td center"> <? echo $num_registro4; ?> </td>
                                        <td class="td center"> <? echo $num_registro38_1; ?> </td>
                                        <td class="td center"> <? echo $num_registro38_2; ?> </td>
                                        <td class="td center"> <? echo $num_registro38_3; ?> </td>
                                        <td class="td center"> <? echo $num_registro38_4; ?> </td>
                                        <td class="td center"> <? echo $num_registro38_5; ?> </td>
                                        <td class="td"> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"><b> OBRERO </b></td>
                                        <td class="td center"> <? echo $num_registro12; ?> </td>
                                        <td class="td center"> <? echo $num_registro18; ?> </td>
                                        <td class="td center"> <? echo $num_registro5; ?> </td>
                                        <td class="td center"> <? echo $num_registro39_1; ?> </td>
                                        <td class="td center"> <? echo $num_registro39_2; ?> </td>
                                        <td class="td center"> <? echo $num_registro39_3; ?> </td>
                                        <td class="td center"> <? echo $num_registro39_4; ?> </td>
                                        <td class="td center"> <? echo $num_registro39_5; ?> </td>
                                        <td class="td"> </td>
                                    </tr>
                                    <tr>
                                        <td class="td"><b> COMISIÓN DE SERVICIO </b></td>
                                        <td class="td center"> <? echo $num_registro14; ?> </td>
                                        <td class="td center"> <? echo $num_registro20; ?> </td>
                                        <td class="td center"> <? echo $num_registro7; ?> </td>
                                        <td class="td center"> <? echo $num_registro41_1; ?> </td>
                                        <td class="td center"> <? echo $num_registro41_2; ?> </td>
                                        <td class="td center"> <? echo $num_registro41_3; ?> </td>
                                        <td class="td center"> <? echo $num_registro41_4; ?> </td>
                                        <td class="td center"> <? echo $num_registro41_5; ?> </td>
                                        <td class="td"> </td>
                                    </tr>
                                    <tr>
                                        <th class="th"><b> TOTAL </b></th>
                                        <th class="th center"><b> <? echo $total2; ?> </b></th>
                                        <th class="th center"><b> <? echo $total3; ?> </b></th>
                                        <th class="th center"><b> <? echo $total1; ?> </b></th>
                                        <th class="th center"><b> <? echo $total6_1_2; ?> </b></th>
                                        <th class="th center"><b> <? echo $total6_2_2; ?> </b></th>
                                        <th class="th center"><b> <? echo $total6_3_2; ?> </b></th>
                                        <th class="th center"><b> <? echo $total6_4_2; ?> </b></th>
                                        <th class="th center"><b> <? echo $total6_5_2; ?> </b></th>
                                        <th class="th"><b> </b></th>
                                    </tr>
                                    <tr>
                                        <th class="th" colspan="2"><b> TOTAL POBLACIÓN = PERSONAL <br> EVALUADO + NO EVALUADO </b></th>
                                        <th class="th center" colspan="2"><b> <? echo $total2_3; ?> </b></th>
                                        <th class="th" colspan="6"><b> </b></th>
                                    </tr>
                                    <tr>
                                        <th class="th" colspan="4"><b> TOTAL PERSONAL EVALUADO POR RANGO DE ACTUACIÓN </b></th>
                                        <th class="th center" colspan="6"><b> <? echo $total1; ?> </b></th>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>

                <!-- script -->

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script src="funciones.js"></script>

                <script>
                    const ctx = document.getElementById('myChart');

                    let excelente_8 = document.getElementById('excelente_8').value;
                    let muy_bueno_8 = document.getElementById('muy_bueno_8').value;
                    let bueno_8 = document.getElementById('bueno_8').value;
                    let cumplimiento_ordinario_8 = document.getElementById('cumplimiento_ordinario_8').value;
                    let no_cumplio_8 = document.getElementById('no_cumplio_8').value;

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            datasets: [{
                                label: 'Desempeño del MPPPST',
                                data: {
                                    Excelente: excelente_8,
                                    Muy_Bueno: muy_bueno_8,
                                    Bueno: bueno_8,
                                    Cumplimiento_Ordinario: cumplimiento_ordinario_8,
                                    No_Cumplió: no_cumplio_8
                                }
                            }]
                        }
                    });

                    window.addEventListener("DOMContentLoaded", function() {
                        setTimeout(imprimir, 1000);
                    });

                    function imprimir() {
                        window.print();
                    }
                </script>