<?php
    include "conexion.php";
    $busq=$_REQUEST['barra'];
    $id=$_REQUEST['id_c3'];







   $sql2="SELECT id, bienes_publicos_id, personales_id, dfecha_asignacion, resp_patrimonial_id, resp_dependencia_id
        FROM bienes_publicos.bienes_publicos_personas WHERE personales_id='".$id."' AND benabled='TRUE'";
      
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
            where bienes_publicos.benabled='TRUE' AND bienes_publicos.bienes_publicos. nnro_bien_publico='".$busq."' LIMIT 1"; 
         
           if($row=pg_query($conn,$SQL)){
           $or=pg_fetch_all($row);
           while($or=pg_fetch_assoc($row)){   
           
           $i++;
             $cosa .= "    <tr>
             
             <td class=\"td center\">" . $or['nnro_bien_publico'] . "</td>
             <td class=\"td center\">" . $or['producto'] . "</td>
             <td class=\"td center\">" . $or['marca'] . "</td>
             <td class=\"td center\">" . $or['smodelo'] . "</td>
             <td class=\"td center\">" . $or['sserial'] . "</td>
             <td class=\"td center\">" . $or['color'] . "</td>
             <td class=\"td center\">" . $or['estado'] . "</td>
             <td class=\"td center\" id=\"botones\">
             <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"modificar_asig('" . $or['id'] . "','" . $or['nnro_bien_publico'] . "','" . $or['producto_id'] . "','" . $or['origen_id'] . "','" . $or['marca_id'] . "','" . $or['smodelo'] . "','" . $or['sserial'] . "','" . $or['color_id'] . "','" . $or['condicion_fisica_id'] . "','" . $or['estado_id'] . "','" . $or['nvalor'] . "','" . $or['nnro_valor_compra'] . "','" . $or['dfecha_orden_compra'] . "','" . $or['cuenta_contable_id'] . "','" . $or['sobservaciones'] . "')\">Modificar</button>
                 <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px;border-radius: 30px; width: auto;\" onclick=\"accion_eliminar_(" . $or1['bienes_publicos_id'] . ",".$id_usuario.",".$id_usu.")\">Eliminar </button>
             </td>
             </tr>
             ";
           }
         echo " 1 / ".$cosa ;
        }else
        echo" 0 / ";
    
    
   
   }
?> 