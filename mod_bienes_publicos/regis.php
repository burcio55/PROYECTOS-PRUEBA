<?php


include "conexion.php";

$accion=$_REQUEST["accion"];

 $id_usuario = $_SESSION["id_usuario"];
         
              //$valor2['rol_id']=98;

     if($accion==1){
        

         /* echo "1 / ". $id_usuario; */
        $nro_bp=$_REQUEST["cbp"];
        $estado=$_REQUEST["est"];
        $descripción=$_REQUEST["dbp"];
        $origen=$_REQUEST["or"];
        $marca=$_REQUEST["marc"];
        $modelo=$_REQUEST["model"];
        $serial=$_REQUEST["serl"];
        $color=$_REQUEST["colr"];
        $condicion_fisica=$_REQUEST["cf"];
        $as=$_REQUEST["vbp"];
        $Valor = str_replace(".", "", $as);
        $nro_oc=$_REQUEST["oc"];
        $fecha_oc=$_REQUEST["foc"];
        $cuenta_contable=$_REQUEST["cc"];
        $observacion = $_REQUEST["obs"];
       

       /*  echo "1 / ".$nro_bp." ".$estado." ".$descripción." ".$origen." ".$marca." ".$modelo." ".$serial." ".$color." ".$condicion_fisica." ".$Valor." ".$nro_oc." ".$fecha_oc." ".$cuenta_contable." ".$observacion; */
            

       $sq = "SELECT * FROM bienes_publicos.bienes_publicos WHERE nnro_bien_publico='$nro_bp'  AND benabled = 'TRUE'";
         
          $rs2 = pg_query($conn, $sq);
       if (pg_num_rows($rs2) > 0) {
        echo " 0 / ";
      
        } else {
         
           $sql="INSERT INTO bienes_publicos.bienes_publicos( productos_id, estado_id, nnro_bien_publico, origen_id, marca_id, smodelo, sserial, color_id, condicion_fisica_id, nvalor, nnro_valor_compra, dfecha_orden_compra, cuenta_contable_id, sobservaciones, nusuario_creacion)VALUES ('".$descripción."','".$estado."','".$nro_bp."','".$origen."','".$marca."','".$modelo."','".$serial."','".$color."','".$condicion_fisica."','".$Valor."','".$nro_oc."','".$fecha_oc."','".$cuenta_contable."','".$observacion."','".$id_usuario."');";
           /*  echo " 1 / ".$sql;
            die(); */
           if ($row = pg_query($conn, $sql)) {
              $SQL="SELECT bienes_publicos.bienes_publicos. id,
              nnro_bien_publico,
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
              FROM
              bienes_publicos.bienes_publicos inner join bienes_publicos.color on
              color.id = bienes_publicos.color_id
              inner join bienes_publicos.marca on
              marca.id = bienes_publicos.marca_id
              inner join bienes_publicos.origen on
              origen.id = bienes_publicos.origen_id
              inner join bienes_publicos.estado on
              estado.id = bienes_publicos.estado_id
              inner join bienes_publicos.productos on
              productos.id = bienes_publicos.productos_id
              inner join bienes_publicos.condicion_fisica on
              condicion_fisica.id = bienes_publicos.condicion_fisica_id
              inner join bienes_publicos.cuenta_contable on
              cuenta_contable.id = bienes_publicos.cuenta_contable_id
              where bienes_publicos.benabled='TRUE' ORDER BY nnro_bien_publico ASC"; 
              $row2=pg_query($conn,$SQL);
              $or=pg_fetch_all($row2);

              $c="SELECT * FROM public.personales_rol WHERE personales_cedula = '".$id_usuario."' AND rol_id >= '80' AND rol_id <= '81' AND nenabled = '1'";
                 $sw=pg_query($conn,$c);
                 $cont2=pg_num_rows($sw);
                 $valor2 = pg_fetch_assoc($sw);

              while($or=pg_fetch_assoc($row2)){
                
                if ($valor2['rol_id']==80) {
                  $cosa .= "  <tr>
                  <td class=\"td center\">" . $or['nnro_bien_publico'] . "</td>
                  <td class=\"td center\">" . $or['producto'] . "</td>
                  <td class=\"td center\">" . $or['marca'] . "</td>
                  <td class=\"td center\">" . $or['smodelo'] . "</td>
                  <td class=\"td center\">" . $or['sserial'] . "</td>
                  <td class=\"td center\">" . $or['color'] . "</td>
                  <td class=\"td center\">" . $or['estado'] . "</td>
                  <td class=\"td center\" id=\"botones\">
                      <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"accion_modificarregis('" . $or['id'] . "','" . $or['nnro_bien_publico'] . "','" . $or['producto_id'] . "','" . $or['origen_id'] . "','" . $or['marca_id'] . "','" . $or['smodelo'] . "','" . $or['sserial'] . "','" . $or['color_id'] . "','" . $or['condicion_fisica_id'] . "','" . $or['estado_id'] . "','" . $or['nvalor'] . "','" . $or['nnro_valor_compra'] . "','" . $or['dfecha_orden_compra'] . "','" . $or['cuenta_contable_id'] . "','" . $or['sobservaciones'] . "')\">Modificar</button>
                      <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px;border-radius: 30px; width: auto;\" onclick=\"asegurar(" . $or['id'] . ")\">Eliminar </button>
                  </td>
                  </tr>
                          ";
                        }
                        else if($valor2['rol_id']==81){
                            $cosa .= "<tr>
                            <td class=\"td center\">" . $or['nnro_bien_publico'] . "</td>
                            <td class=\"td center\">" . $or['producto'] . "</td>
                            <td class=\"td center\">" . $or['marca'] . "</td>
                            <td class=\"td center\">" . $or['smodelo'] . "</td>
                            <td class=\"td center\">" . $or['sserial'] . "</td>
                            <td class=\"td center\">" . $or['color'] . "</td>
                            <td class=\"td center\">" . $or['estado'] . "</td>
                            <td class=\"td center\" id=\"botones\">
                                <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"accion_modificarregis('" . $or['id'] . "','" . $or['nnro_bien_publico'] . "','" . $or['producto_id'] . "','" . $or['origen_id'] . "','" . $or['marca_id'] . "','" . $or['smodelo'] . "','" . $or['sserial'] . "','" . $or['color_id'] . "','" . $or['condicion_fisica_id'] . "','" . $or['estado_id'] . "','" . $or['nvalor'] . "','" . $or['nnro_valor_compra'] . "','" . $or['dfecha_orden_compra'] . "','" . $or['cuenta_contable_id'] . "','" . $or['sobservaciones'] . "')\">Modificar</button>
                             </td>
                            </tr>
                                    ";

                        }           
            
              }
              echo "1 / ".$cosa;
          } else{
              echo "0 / Error: " . $sql;
          }
    }
}else if($accion==2){
    $id=$_REQUEST["id"];
  /*    echo "0 / ". $id;  */
    $i = 0;
    $SQL2 = "UPDATE bienes_publicos.bienes_publicos SET benabled = 'FALSE' WHERE id = '" . $id . "'";
    if ($resultado2 = pg_query($conn, $SQL2)) {
        $i2 = 0;
        $sql2 = "SELECT bienes_publicos.bienes_publicos. id,
        nnro_bien_publico,
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
        FROM
        bienes_publicos.bienes_publicos inner join bienes_publicos.color on
        color.id = bienes_publicos.color_id
        inner join bienes_publicos.marca on
        marca.id = bienes_publicos.marca_id
        inner join bienes_publicos.origen on
        origen.id = bienes_publicos.origen_id
        inner join bienes_publicos.estado on
        estado.id = bienes_publicos.estado_id
        inner join bienes_publicos.productos on
        productos.id = bienes_publicos.productos_id
        inner join bienes_publicos.condicion_fisica on
        condicion_fisica.id = bienes_publicos.condicion_fisica_id
        inner join bienes_publicos.cuenta_contable on
        cuenta_contable.id = bienes_publicos.cuenta_contable_id
        where bienes_publicos.benabled='TRUE' ORDER BY nnro_bien_publico ASC";
        $row2 = pg_query($conn, $sql2);
        $or2 = pg_fetch_all($row2);

        while ($or2 = pg_fetch_assoc($row2)) {
            $i2++;
            $cosa2 .= "<tr>
            <td class=\"td center\">" . $or2['nnro_bien_publico'] . "</td>
            <td class=\"td center\">" . $or2['producto'] . "</td>
            <td class=\"td center\">" . $or2['marca'] . "</td>
            <td class=\"td center\">" . $or2['smodelo'] . "</td>
            <td class=\"td center\">" . $or2['sserial'] . "</td>
            <td class=\"td center\">" . $or2['color'] . "</td>
            <td class=\"td center\">" . $or2['estado'] . "</td>
            <td class=\"td center\" id=\"botones\">
            <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"accion_modificarregis('" . $or2['id'] . "')\">Modificar</button>
            <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px;border-radius: 30px; width: auto;\" onclick=\"asegurar(" . $or2['id'] . ")\">Eliminar </button>
        </td>
            </tr>
            ";
        }
        echo "1 / Se eliminó Correctamente el Registro / ".$cosa2;
    } else {
        echo "0 / Error: " . $SQL2;
    }

}else if($accion==3){

    $id3=$_REQUEST["id_regis"];
    $id_usuario = $_SESSION["id_usuario"];
         /*  echo "0 / ". $id_usuario;  */
        $nro_bp=$_REQUEST["cbp"];
        $estado=$_REQUEST["est"];
        $descripción=$_REQUEST["dbp"];
        $origen=$_REQUEST["or"];
        $marca=$_REQUEST["marc"];
        $modelo=$_REQUEST["model"];
        $serial=$_REQUEST["serl"];
        $color=$_REQUEST["colr"];
        $condicion_fisica=$_REQUEST["cf"];
        $Valor=$_REQUEST["vbp"];
        $nro_oc=$_REQUEST["oc"];
        $fecha_oc=$_REQUEST["foc"];
        $cuenta_contable=$_REQUEST["cc"];
        $observacion = $_REQUEST["obs"];
    
        $SQL3="UPDATE bienes_publicos.bienes_publicos SET productos_id='".$descripción."', estado_id='".$estado."', nnro_bien_publico='".$nro_bp."', origen_id='".$origen."', marca_id='".$marca."', smodelo='".$modelo."', sserial='".$serial."', color_id='".$color."', condicion_fisica_id='".$condicion_fisica."', nvalor='".$Valor."', nnro_valor_compra='".$nro_oc."', dfecha_orden_compra='".$fecha_oc."', cuenta_contable_id='".$cuenta_contable."', sobservaciones='".$observacion."', nusuario_actualizacion='".$id_usuario."' WHERE id ='" . $id3 . "';";
        if ($resultado3 = pg_query($conn, $SQL3)) {
            $i3 = 0;
            $sql3 = "SELECT bienes_publicos.bienes_publicos. id,
            nnro_bien_publico,
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
            FROM
            bienes_publicos.bienes_publicos inner join bienes_publicos.color on
            color.id = bienes_publicos.color_id
            inner join bienes_publicos.marca on
            marca.id = bienes_publicos.marca_id
            inner join bienes_publicos.origen on
            origen.id = bienes_publicos.origen_id
            inner join bienes_publicos.estado on
            estado.id = bienes_publicos.estado_id
            inner join bienes_publicos.productos on
            productos.id = bienes_publicos.productos_id
            inner join bienes_publicos.condicion_fisica on
            condicion_fisica.id = bienes_publicos.condicion_fisica_id
            inner join bienes_publicos.cuenta_contable on
            cuenta_contable.id = bienes_publicos.cuenta_contable_id
            where bienes_publicos.benabled='TRUE' ORDER BY nnro_bien_publico ASC";
            $row3 = pg_query($conn, $sql3);
            $or3 = pg_fetch_all($row3);
            $c="SELECT * FROM public.personales_rol WHERE personales_cedula = '".$id_usuario."' AND rol_id >= '80' AND rol_id <= '81' AND nenabled = '1'";
            $sw=pg_query($conn,$c);
            $cont2=pg_num_rows($sw);
            $valor2 = pg_fetch_assoc($sw);
            while ($or3 = pg_fetch_assoc($row3)) {
                if ($valor2['rol_id']==80) {
                $i3++;
                $cosa3 .= "<tr>
                <td class=\"td center\">" . $or3['nnro_bien_publico'] . "</td>
                <td class=\"td center\">" . $or3['producto'] . "</td>
                <td class=\"td center\">" . $or3['marca'] . "</td>
                <td class=\"td center\">" . $or3['smodelo'] . "</td>
                <td class=\"td center\">" . $or3['sserial'] . "</td>
                <td class=\"td center\">" . $or3['color'] . "</td>
                <td class=\"td center\">" . $or3['estado'] . "</td>
                        <td class=\"td center\" id=\"botones\">
                        <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"accion_modificarregis('" . $or3['id'] . "','" . $or3['nnro_bien_publico'] . "','" . $or3['producto_id'] . "','" . $or3['origen_id'] . "','" . $or3['marca_id'] . "','" . $or3['smodelo'] . "','" . $or3['sserial'] . "','" . $or3['color_id'] . "','" . $or3['condicion_fisica_id'] . "','" . $or3['estado_id'] . "','" . $or3['nvalor'] . "','" . $or3['nnro_valor_compra'] . "','" . $or3['dfecha_orden_compra'] . "','" . $or3['cuenta_contable_id'] . "','" . $or['sobservaciones'] . "')\">Modificar</button>
                        <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px;border-radius: 30px; width: auto;\" onclick=\"asegurar(" . $or3['id'] . ")\">Eliminar </button>
                    </td>
                    </tr>
                ";
            }else if($valor2['rol_id']==81){
                $i3++;
                $cosa3 .= "<tr>
                <td class=\"td center\">" . $or3['nnro_bien_publico'] . "</td>
                <td class=\"td center\">" . $or3['producto'] . "</td>
                <td class=\"td center\">" . $or3['marca'] . "</td>
                <td class=\"td center\">" . $or3['smodelo'] . "</td>
                <td class=\"td center\">" . $or3['sserial'] . "</td>
                <td class=\"td center\">" . $or3['color'] . "</td>
                <td class=\"td center\">" . $or3['estado'] . "</td>
                        <td class=\"td center\" id=\"botones\">
                        <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"accion_modificarregis('" . $or3['id'] . "','" . $or3['nnro_bien_publico'] . "','" . $or3['producto_id'] . "','" . $or3['origen_id'] . "','" . $or3['marca_id'] . "','" . $or3['smodelo'] . "','" . $or3['sserial'] . "','" . $or3['color_id'] . "','" . $or3['condicion_fisica_id'] . "','" . $or3['estado_id'] . "','" . $or3['nvalor'] . "','" . $or3['nnro_valor_compra'] . "','" . $or3['dfecha_orden_compra'] . "','" . $or3['cuenta_contable_id'] . "','" . $or['sobservaciones'] . "')\">Modificar</button>
                     </td>
                    </tr>
                ";
            }
            }
            echo "1 / Se Modifico Correctamente el Registro / ".$cosa3;
        } else {
            echo "0 / Error: " . $SQL3;
        }
}
?>