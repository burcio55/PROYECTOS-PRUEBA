<?php
include "conexion.php";
$id_usuario = $_SESSION["id_usuario"];

$id_usuario = $_SESSION["id_usuario"];
         /* $c="SELECT * FROM public.personales_rol WHERE personales_cedula = '".$id_usuario."' AND rol_id >= '80' AND rol_id <= '81' AND nenabled = '1'";
            $sw=pg_query($conn,$c);
            $cont2=pg_num_rows($sw);
            $valor2 = pg_fetch_assoc($sw); */

$ci=$_REQUEST['ci3'];
$nc=$_REQUEST['nacionalidad3'];


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
/* $personas = "1 / "; */



$valores = pg_fetch_all($rs); 

/* echo $valores['id'];
die(); */

foreach ($valores as $valores1){ 
    $personas .= " / ";
    $personas .= trim($valores1['cedula']);
    $personas .= " / ";
    $personas .= $valores1['nombre1'] . " " . $valores1['nombre2'];
    $personas .= " / ";
    $personas .= trim($valores1['apellido1']). " " .trim($valores1['apellido2']);
    $personas .= " / ";
    $personas .= trim($valores1['cargo_actual_ejerce']);
    $personas .= " / ";
    $personas .= trim($valores1['ubicacion_fisica_actual']);
    $personas .= " / ";
    $personas .= trim($valores1['cargo']);
    $personas .= " / ";
    $personas .= trim($valores1['ubicacion_adm']);
    $personas .= " / ";
    $personas .= $valores1['id'];
    $personas .= " / ";
    $id_usu=$valores1['id'];
}  /* echo "1 / ".$id_usu;
die(); */


$sql2="SELECT id, bienes_publicos_id, personales_id, dfecha_asignacion, resp_patrimonial_id, resp_dependencia_id
        FROM bienes_publicos.bienes_publicos_personas WHERE personales_id='".$id_usu."' AND benabled='TRUE'";
      
         $row2 = pg_query($conn, $sql2);
         $or1 = pg_fetch_all($row2);
          while ($or1 = pg_fetch_assoc($row2)) { 
           $resultado = $or1['bienes_publicos_id'];
          
          
           
             $SQL="SELECT bienes_publicos.bienes_publicos. id , nnro_bien_publico,
             productos.sdescripcion as producto,
             productos.id as producto_id,
             origen.sdescripcion as origen, 
             origen.id as origen_id, 
             marca.sdescripcion as marca,
             marca.id as marca_id,
             smodelo,sserial,
             color.sdescripcion as color,
             color.id as color_id,
             condicion_fisica.sdescripcion as condicion_fisica,
             condicion_fisica.id as condicion_fisica_id,
             estado.sdescripcion as estado,
             estado.id as estado_id,
             nvalor,nnro_valor_compra,dfecha_orden_compra,
             cuenta_contable.sdescripcion as cuenta_contable,
             cuenta_contable.id as cuenta_contable_id,
             sobservaciones
           
            FROM bienes_publicos.bienes_publicos 
            inner join bienes_publicos.color on color.id = bienes_publicos.color_id 
            inner join bienes_publicos.marca on marca.id = bienes_publicos.marca_id 
            inner join bienes_publicos.origen on origen.id = bienes_publicos.origen_id 
            inner join bienes_publicos.estado on estado.id = bienes_publicos.estado_id 
            inner join bienes_publicos.productos on productos.id = bienes_publicos.productos_id 
            inner join bienes_publicos.condicion_fisica on condicion_fisica.id = bienes_publicos.condicion_fisica_id 
            inner join bienes_publicos.cuenta_contable on cuenta_contable.id = bienes_publicos.cuenta_contable_id 
            where bienes_publicos.benabled='TRUE' AND bienes_publicos.bienes_publicos. id='".$resultado."' LIMIT 1"; 
         
           $row=pg_query($conn,$SQL);
           $or=pg_fetch_all($row);
           while($or=pg_fetch_assoc($row)){   
            if ($_SESSION['bienes_publicos_rol']==80) {
           $i++;
             $cosa .= " 
             <tr>
             
             <td class=\"td center\">" . $or['nnro_bien_publico'] . "</td>
             <td class=\"td center\">" . $or['producto'] . "</td>
             <td class=\"td center\">" . $or['marca'] . "</td>
             <td class=\"td center\">" . $or['smodelo'] . "</td>
             <td class=\"td center\">" . $or['sserial'] . "</td>
             <td class=\"td center\">" . $or['color'] . "</td>
             <td class=\"td center\">" . $or['estado'] . "</td>
             <td class=\"td center\" id=\"botones\">
             <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"modificar_asig('" . $or['id'] . "','" . $or['nnro_bien_publico'] . "','" . $or['producto_id'] . "','" . $or['origen_id'] . "','" . $or['marca_id'] . "','" . $or['smodelo'] . "','" . $or['sserial'] . "','" . $or['color_id'] . "','" . $or['condicion_fisica_id'] . "','" . $or['estado_id'] . "','" . $or['nvalor'] . "','" . $or['nnro_valor_compra'] . "','" . $or['dfecha_orden_compra'] . "','" . $or['cuenta_contable_id'] . "','" . $or['sobservaciones'] . "')\">Modificar</button>
                 <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px;border-radius: 30px; width: auto;\" onclick=\"asegurar2(" . $or1['bienes_publicos_id'] . ",".$id_usuario.",".$id_usu.")\">Eliminar </button>
             </td>
             </tr>
          
             ";
            }else if($_SESSION['bienes_publicos_rol']==81){
                $cosa .= " 
                <tr>
                
                <td class=\"td center\">" . $or['nnro_bien_publico'] . "</td>
                <td class=\"td center\">" . $or['producto'] . "</td>
                <td class=\"td center\">" . $or['marca'] . "</td>
                <td class=\"td center\">" . $or['smodelo'] . "</td>
                <td class=\"td center\">" . $or['sserial'] . "</td>
                <td class=\"td center\">" . $or['color'] . "</td>
                <td class=\"td center\">" . $or['estado'] . "</td>
                <td class=\"td center\" id=\"botones\">
                <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"modificar_asig('" . $or['id'] . "','" . $or['nnro_bien_publico'] . "','" . $or['producto_id'] . "','" . $or['origen_id'] . "','" . $or['marca_id'] . "','" . $or['smodelo'] . "','" . $or['sserial'] . "','" . $or['color_id'] . "','" . $or['condicion_fisica_id'] . "','" . $or['estado_id'] . "','" . $or['nvalor'] . "','" . $or['nnro_valor_compra'] . "','" . $or['dfecha_orden_compra'] . "','" . $or['cuenta_contable_id'] . "','" . $or['sobservaciones'] . "')\">Modificar</button>
                </td>
                </tr>
             
                ";
            }
           }
        }
    
    echo $personas; 
   
    echo $cosa ;
  



?>