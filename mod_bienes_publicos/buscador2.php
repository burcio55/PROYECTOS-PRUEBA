<?php

include "conexion.php";

$ci=$_REQUEST['ci2'];
$nc=$_REQUEST['nacionalidad2'];

$PG = "SELECT personales.cedula as cedula,
personales.id as id,
personales.nacionalidad as nacionalidad, 
personales.primer_apellido as apellido1, 
personales.segundo_apellido as apellido2, 
personales.primer_nombre as nombre1, 
personales.segundo_nombre as nombre2, 
personales.subicacion_fisica as ubicacion_fisica_actual,
personales.scargo_actual_ejerce as cargo_actual_ejerce,    
public.cargos.sdescripcion as cargo, 
public.ubicacion_administrativa.sdescripcion as ubicacion_adm                    
FROM public.personales
LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula
LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 

LEFT JOIN public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo 
LEFT JOIN public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo 
                    where personales.cedula ='$ci' AND personales.nacionalidad ='$nc' LIMIT 1";
$rs = pg_query($conn, $PG);
if (pg_num_rows($rs) == 0) {
    echo "0 / Asegurece de especificar la Nacionalidad y la Cédula de Identidad";
    die();
}

/* echo "0 / HOLA 1"; */
$personas = "1 / ";

$valores = pg_fetch_assoc($rs);
$cantidad = pg_num_rows($rs);
/* echo $valores['id'];
die(); */
for ($i=0; $i < $cantidad; $i++) { 
    $personas .= trim($_REQUEST['ci2']);
    $personas .= " / ";
    $personas .= $valores['nombre1'] . " " . $valores['nombre2'];
    $personas .= " / ";
    $personas .= trim($valores['apellido1']). " " .trim($valores['apellido2']);
    $personas .= " / ";
    $personas .= trim($valores['cargo_actual_ejerce']);
    $personas .= " / ";
    $personas .= trim($valores['ubicacion_fisica_actual']);
    $personas .= " / ";
    $personas .= trim($valores['cargo']);
    $personas .= " / ";
    $personas .= trim($valores['ubicacion_adm']);
    $personas .= " / ";
    $personas .= $valores['id'];
    $personas .= " / ";
}
echo $personas . " / ";
?>