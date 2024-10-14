<?php

include "conexion.php";

$ci=$_REQUEST['cbp2'];


$PG = "SELECT 
bienes_publicos.bienes_publicos. id, nnro_bien_publico,

productos.id as producto_id,
origen.id as origen_id, 
marca.id as marca_id,smodelo,sserial,
color.id as color_id,
condicion_fisica.id as condicion_fisica_id,
estado.id as estado_id,nvalor,nnro_valor_compra,dfecha_orden_compra,
cuenta_contable.id as cuenta_contable_id,sobservaciones 
FROM bienes_publicos.bienes_publicos 
inner join bienes_publicos.color on color.id = bienes_publicos.color_id 
inner join bienes_publicos.marca on marca.id = bienes_publicos.marca_id 
inner join bienes_publicos.origen on origen.id = bienes_publicos.origen_id 
inner join bienes_publicos.estado on estado.id = bienes_publicos.estado_id 
inner join bienes_publicos.productos on productos.id = bienes_publicos.productos_id 
inner join bienes_publicos.condicion_fisica on condicion_fisica.id = bienes_publicos.condicion_fisica_id 
inner join bienes_publicos.cuenta_contable on cuenta_contable.id = bienes_publicos.cuenta_contable_id 
where bienes_publicos.nnro_bien_publico='$ci' AND bienes_publicos.benabled='TRUE'  ";
$rs = pg_query($conn, $PG);
if (pg_num_rows($rs) == 0) {
    echo "0 / Asegúrese de especificar la Nacionalidad y la Cédula de Identidad";
    die();
}


/* echo "0 / HOLA 1"; */
$personas = "1 / ";

$valores = pg_fetch_all($rs);
foreach ($valores as $valor) {
    $personas .= trim($_REQUEST['cbp2']);
    $personas .= " / ";
    $personas .= trim($valor['producto_id']);
    $personas .= " / ";
    $personas .= trim($valor['origen_id']);
    $personas .= " / ";
    $personas .= trim($valor['marca_id']);
    $personas .= " / ";
    $personas .= trim($valor['smodelo']);
    $personas .= " / ";
    $personas .= trim($valor['sserial']);
    $personas .= " / ";
    $personas .= trim($valor['color_id']);
    $personas .= " / ";
    $personas .= trim($valor['condicion_fisica_id']);
    $personas .= " / ";
    $personas .= trim($valor['estado_id']);
    $personas .= " / ";
    $personas .= trim($valor['nvalor']);
    $personas .= " / ";
    $personas .= trim($valor['nnro_valor_compra']);
    $personas .= " / ";
    $personas .= trim($valor['dfecha_orden_compra']);
    $personas .= " / ";
    $personas .= trim($valor['cuenta_contable_id']);
    $personas .= " / ";
    $personas .= trim($valor['sobservaciones']);
    $personas .= " / ";
    $personas .= trim($valor['id']);
}

echo $personas . " / ";
?>