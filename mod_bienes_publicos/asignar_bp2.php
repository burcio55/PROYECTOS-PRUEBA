<?php
include "conexion.php";

$accion=$_REQUEST["accion"];

$cbp=$_REQUEST["cbp2"];
$id_c=$_REQUEST["id_cbp2"];
$fa=$_REQUEST["fa"];
$id_usuario = $_SESSION["id_usuario"];

         /* $c="SELECT * FROM public.personales_rol WHERE personales_cedula = '".$id_usuario."' AND rol_id >= '80' AND rol_id <= '81' AND nenabled = '1'";
            $sw=pg_query($conn,$c);
            $cont2=pg_num_rows($sw); */
/* echo"0 / ".$ci1." / ".$ci2." / ".$ci3." / ".$cbp." / ".$id_c." / ".$fa." / ".$id_usuario; */

if ($accion==1) {
  $ci1=$_REQUEST["id_c1"];
$ci2=$_REQUEST["id_c2"];
$ci3=$_REQUEST["id_c3"];
  $sql="INSERT INTO bienes_publicos.bienes_publicos_personas(bienes_publicos_id, personales_id,dfecha_asignacion, resp_patrimonial_id, resp_dependencia_id, nusuario_creacion) VALUES ( '".$id_c."', '".$ci3."','".$fa."', '".$ci1."', '".$ci2."', '".$id_usuario."')";
  if ($row = pg_query($conn, $sql)) {
    $i=0; 
    $sql2="SELECT id, bienes_publicos_id, personales_id, dfecha_asignacion, resp_patrimonial_id, resp_dependencia_id
    FROM bienes_publicos.bienes_publicos_personas WHERE personales_id='".$ci3."' AND benabled='TRUE'";
  
     $row2 = pg_query($conn, $sql2);
     $or1 = pg_fetch_all($row2);
      while ($or1 = pg_fetch_assoc($row2)) { 
       $resultado = $or1['bienes_publicos_id'];
      
       
       $SQL="SELECT bienes_publicos.bienes_publicos. id , nnro_bien_publico,
       productos.sdescripcion as producto,
       origen.sdescripcion as origen, 
       marca.sdescripcion as marca,smodelo,sserial,
       color.sdescripcion as color,
       condicion_fisica.sdescripcion as condicion_fisica,
       estado.sdescripcion as estado,nvalor,nnro_valor_compra,dfecha_orden_compra,
       cuenta_contable.sdescripcion as cuenta_contable,sobservaciones
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
         $cosa2 .= "    <tr>
         
         <td class=\"td center\">" . $or['nnro_bien_publico'] . "</td>
         <td class=\"td center\">" . $or['producto'] . "</td>
         <td class=\"td center\">" . $or['marca'] . "</td>
         <td class=\"td center\">" . $or['smodelo'] . "</td>
         <td class=\"td center\">" . $or['sserial'] . "</td>
         <td class=\"td center\">" . $or['color'] . "</td>
         <td class=\"td center\">" . $or['estado'] . "</td>
         <td class=\"td center\" id=\"botones\">
  
             <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px;border-radius: 30px; width: auto;\" onclick=\"asegurar2(" . $or1['bienes_publicos_id'] . ",".$id_usuario.",".$ci3.")\">Eliminar </button>
         </td>
         </tr>
         ";
        }else if($_SESSION['bienes_publicos_rol']==81){
          $cosa2 .= "    <tr>
         
          <td class=\"td center\">" . $or['nnro_bien_publico'] . "</td>
          <td class=\"td center\">" . $or['producto'] . "</td>
          <td class=\"td center\">" . $or['marca'] . "</td>
          <td class=\"td center\">" . $or['smodelo'] . "</td>
          <td class=\"td center\">" . $or['sserial'] . "</td>
          <td class=\"td center\">" . $or['color'] . "</td>
          <td class=\"td center\">" . $or['estado'] . "</td>
          <td class=\"td center\" id=\"botones\">
   
              
          </td>
          </tr>
          ";
        }
       }
    }   
  
    echo "1 / Nuevo registro creado exitosamente / ".$cosa2;
  } else {
   echo "0 / Error: " . $sql;
  } 
  
}else if ($accion==2) {
  $id=$_REQUEST["id"];

  $ci=$_REQUEST["ci3"];

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
     origen.sdescripcion as origen, 
     marca.sdescripcion as marca,smodelo,sserial,
     color.sdescripcion as color,
     condicion_fisica.sdescripcion as condicion_fisica,
     estado.sdescripcion as estado,nvalor,nnro_valor_compra,dfecha_orden_compra,
     cuenta_contable.sdescripcion as cuenta_contable,sobservaciones
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

       </td>
       </tr>
       ";
      }

     }
  }   

  echo "1 / Se ha eliminado con exito / ".$cosa;
} else {
 echo "0 / Error: " . $sql;
} 
  
}


?>