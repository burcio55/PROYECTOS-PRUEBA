<?php
include "conexion.php";
$id_usuario = $_SESSION["id_usuario"];
$id_usuario = $_SESSION["id_usuario"];
         /* $c="SELECT * FROM public.personales_rol WHERE personales_cedula = '".$id_usuario."' AND rol_id >= '80' AND rol_id <= '81' AND nenabled = '1'";
            $sw=pg_query($conn,$c);
            $cont2=pg_num_rows($sw);
            $valor2 = pg_fetch_assoc($sw); */
$id=$_REQUEST["id"];

  $ci=$_REQUEST["usu"];

  $SQL2="UPDATE bienes_publicos.bienes_publicos_personas
	SET benabled='FALSE',nusuario_actualizacion='$id_usuario'
	WHERE bienes_publicos_id = '" . $id . "'";

if ($row2 = pg_query($conn, $SQL2)) {
  $i=0;
  $sql3="SELECT id, bienes_publicos_id, personales_id, dfecha_asignacion, resp_patrimonial_id, resp_dependencia_id
  FROM bienes_publicos.bienes_publicos_personas WHERE personales_id='".$ci."' AND benabled='TRUE'";

   $row3 = pg_query($conn, $sql3);
   $or3 = pg_fetch_all($row3);
    while ($or3 = pg_fetch_assoc($row3)) { 
     $resultado2 = $or3['bienes_publicos_id'];
    
     
     $SQL3="SELECT bienes_publicos.bienes_publicos. id , nnro_bien_publico,
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
      where bienes_publicos.benabled='TRUE' AND bienes_publicos.bienes_publicos. id='".$resultado2."' LIMIT 1"; 
   
     $row4=pg_query($conn,$SQL3);
     $or4=pg_fetch_all($row4);
     while($or4=pg_fetch_assoc($row4)){     
      if ($_SESSION['bienes_publicos_rol']==80) {

     $i++;
       $cosa .= "    <tr>
       
       <td class=\"td center\">" . $or4['nnro_bien_publico'] . "</td>
       <td class=\"td center\">" . $or4['producto'] . "</td>
       <td class=\"td center\">" . $or4['marca'] . "</td>
       <td class=\"td center\">" . $or4['smodelo'] . "</td>
       <td class=\"td center\">" . $or4['sserial'] . "</td>
       <td class=\"td center\">" . $or4['color'] . "</td>
       <td class=\"td center\">" . $or4['estado'] . "</td>
       <td class=\"td center\" id=\"botones\">
       <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"modificar_asig('" . $or4['id'] . "','" . $or4['nnro_bien_publico'] . "','" . $or4['producto_id'] . "','" . $or4['origen_id'] . "','" . $or4['marca_id'] . "','" . $or4['smodelo'] . "','" . $or4['sserial'] . "','" . $or4['color_id'] . "','" . $or4['condicion_fisica_id'] . "','" . $or4['estado_id'] . "','" . $or4['nvalor'] . "','" . $or4['nnro_valor_compra'] . "','" . $or4['dfecha_orden_compra'] . "','" . $or4['cuenta_contable_id'] . "','" . $or4['sobservaciones'] . "')\">Modificar</button>
           <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px;border-radius: 30px; width: auto;\" onclick=\"asegurar2(" . $or3['bienes_publicos_id'] . ",".$id_usuario.",".$ci.")\">Eliminar </button>
       </td>
       </tr>
       ";
      }else if($_SESSION['bienes_publicos_rol']==81){
        $cosa .= "    <tr>
       
       <td class=\"td center\">" . $or4['nnro_bien_publico'] . "</td>
       <td class=\"td center\">" . $or4['producto'] . "</td>
       <td class=\"td center\">" . $or4['marca'] . "</td>
       <td class=\"td center\">" . $or4['smodelo'] . "</td>
       <td class=\"td center\">" . $or4['sserial'] . "</td>
       <td class=\"td center\">" . $or4['color'] . "</td>
       <td class=\"td center\">" . $or4['estado'] . "</td>
       <td class=\"td center\" id=\"botones\">
       <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"modificar_asig('" . $or4['id'] . "','" . $or4['nnro_bien_publico'] . "','" . $or4['producto_id'] . "','" . $or4['origen_id'] . "','" . $or4['marca_id'] . "','" . $or4['smodelo'] . "','" . $or4['sserial'] . "','" . $or4['color_id'] . "','" . $or4['condicion_fisica_id'] . "','" . $or4['estado_id'] . "','" . $or4['nvalor'] . "','" . $or4['nnro_valor_compra'] . "','" . $or4['dfecha_orden_compra'] . "','" . $or4['cuenta_contable_id'] . "','" . $or4['sobservaciones'] . "')\">Modificar</button>
       </td>
       </tr>
       ";
      }
     }
  }   

  echo "1 / Se ha eliminado con éxito / ".$cosa;
} else {
 echo "0 / Error: " . $sql;
} 
  
  

?>