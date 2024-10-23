<?php
    include('bd.php');
 
    $accion = $_REQUEST['accion'];

    if($accion == "1"){

        $marca = $_REQUEST['marca'];

        $insertar = ("INSERT INTO reporte_tecnico.dispositivos (sdescripcion) VALUES ('".$marca."');");
        if($row = pg_query($conn, $insertar)){
            /*$i = 0;
            $consulta = "SELECT *  FROM reporte_tecnico.estatus WHERE benabled = 'true'";
            $row = pg_query($conn, $consulta);
            //$valor = pg_fetch_assoc($row);
            echo"1 /";

            while ($valor = pg_fetch_assoc($row)) {
                $i++;
                echo ('<tr><td>'.$i.'</td><td style="text-align: left;">'.$valor['sdescripcion'].'</td><td style="width: 34%;"> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout=\'this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"\' onmouseover=\'this.style.color="#46A2FD"; this.style.backgroundColor="#fff";\' data-bs-toggle="tooltip">Editar</button><button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout=\'this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"\' onmouseover=\'this.style.color="#dc3545"; this.style.backgroundColor="#fff";\' data-bs-toggle="tooltip" onclick="eliminar_estatus('.$valor['id'].')">Eliminar</button></td></tr>');
            }*/
            echo"1 / Se ha insertado un nuevo dispositivo";
        }else{
            echo"2 / Se produjo un error.";
        }
            
    }else
    if ($accion == 2){
        $id = $_REQUEST['id'];
        /* echo "1 / ". $id; */
      
        $insertar2 = "UPDATE reporte_tecnico.dispositivos SET benabled = 'FALSE' WHERE id = '" . $id . "'";
        if ($resultado2 = pg_query($conn, $insertar2)) {
            /*$i2 = 0;
            $consulta2 = "SELECT * FROM reporte_tecnico.dispositivos WHERE benabled = 'TRUE' Order By sdescripcion";
            $row2 = pg_query($conn, $consulta2);
    
            while ($valor2 = pg_fetch_assoc($row2)) {
                $i2++;
                echo ('<tr><td>'.$i.'</td><td style="text-align: left;">'.$valor2['sdescripcion'].'</td><td style="width: 34%;"> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout=\'this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"\' onmouseover=\'this.style.color="#46A2FD"; this.style.backgroundColor="#fff";\' data-bs-toggle="tooltip">Editar</button><button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout=\'this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"\' onmouseover=\'this.style.color="#dc3545"; this.style.backgroundColor="#fff";\' data-bs-toggle="tooltip" onclick="eliminar_estatus('.$valor2['id'].')">Eliminar</button></td></tr>');
            }*/
            echo "1 / Sus datos se han eliminado correctamente.";
        } else {
            echo "2 / Error: " . $consulta2;
        }
    }else 
    if ($accion == 3){
        $id3 = $_REQUEST['id_proceso'];
        $prueba=$_REQUEST["sdescripcion"];
        $id_usuario = $_SESSION["id_usuario"];

        $insertar3 = "UPDATE reporte_tecnico.dispositivos SET sdescripcion ='" . $prueba . "' , nusuario_actualizacion='" . $id_usuario . "' WHERE id ='" . $id3 . "'";
        if ($resultado3 = pg_query($conn, $insertar3)) {
            $i3 = 0;
            $consulta3 = "SELECT * FROM reporte_tecnico.dispositivos WHERE benabled = 'TRUE' Order By sdescripcion";
            $row3 = pg_query($conn, $consulta3);
            $valor3 = pg_fetch_all($row3);

            while ($valor3 = pg_fetch_assoc($row3)) {
                $i3++;
                echo ('<tr><td>'.$i3.'</td><td style="text-align: left;">'.$valor3['sdescripcion'].'</td><td style="width: 34%;"> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout=\'this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"\' onmouseover=\'this.style.color="#46A2FD"; this.style.backgroundColor="#fff";\' data-bs-toggle="tooltip">Editar</button><button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout=\'this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"\' onmouseover=\'this.style.color="#dc3545"; this.style.backgroundColor="#fff";\' data-bs-toggle="tooltip" onclick="eliminar_estatus('.$valor3['id'].')">Eliminar</button></td></tr>');
            }
            echo "1 / Sus datos se han editado correctamente.";
        } else {
            echo "2 / Error: " . $insertar3;
        }
    }
   
?>