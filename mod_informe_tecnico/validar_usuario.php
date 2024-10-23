<?
    include('based.php'); 

    $accion = $_REQUEST['accion'];
    if($accion == 1){
        $cedula = $_REQUEST['cedula'];
        //echo $cedula;

        $SQL = "SELECT cedula, primer_apellido, segundo_apellido, primer_nombre, segundo_nombre FROM public.personales WHERE nenabled = '1' AND cedula = '".$cedula."'";
        $row = pg_query($conn, $SQL);
        $cont = pg_num_rows($row);
        if($cont > 0){
            $valor = pg_fetch_assoc($row);
            $nombre = $valor['primer_nombre']." ".$valor['segundo_nombre'].", ".$valor['primer_apellido']." ".$valor['segundo_apellido'];
            echo "1 / ".$nombre;
            $SQL2 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '".$cedula."' AND rol_id >= '77' AND rol_id <= '79' AND nenabled = '1'";
            $row2 = pg_query($conn, $SQL2);
            $cont2 = pg_num_rows($row2);
            if($cont2 > 0){
                $valor2 = pg_fetch_assoc($row2);
                echo " / ".$valor2['rol_id'];
            }else{
                echo " / -1";
            }
        }else{
            echo "0 / Usuario no registrado en SIGLA";
        }
    }else
    if($accion == 2){
        $cedula = $_REQUEST['cedula'];
        $rol = $_REQUEST['rol'];
    
        $SQL2 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '".$cedula."' AND rol_id >= '77' AND rol_id <= '79' AND nenabled = '1'";
        $row2 = pg_query($conn, $SQL2);
        $cont2 = pg_num_rows($row2);
        if ($accion == 2) {
            $cedula = $_REQUEST['cedula'];
            $rol = $_REQUEST['rol'];
        
            $SQL2 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $cedula . "' AND rol_id >= '77' AND rol_id <= '79' AND nenabled = '1'";
            $row2 = pg_query($conn, $SQL2);
            $cont2 = pg_num_rows($row2);
            if ($accion == 2) {
                $cedula = $_REQUEST['cedula'];
                $rol = $_REQUEST['rol'];
            
                $SQL2 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $cedula . "' AND rol_id >= '77' AND rol_id <= '79' AND nenabled = '1'";
                $row2 = pg_query($conn, $SQL2);
                $cont2 = pg_num_rows($row2);

                if ($accion == 2) {
                    $cedula = $_REQUEST['cedula'];
                    $rol = $_REQUEST['rol'];
                
                    // Inhabilitar todos los roles actuales del usuario
                    $SQL1 = "UPDATE public.personales_rol SET nenabled='0' WHERE personales_cedula='" . $cedula . "'  AND nenabled='1' AND rol_id >= '77' AND rol_id <= '79'" ;
                    if (pg_query($conn, $SQL1)) {
                
                        // Asignar el nuevo rol
                        $SQL2 = "UPDATE public.personales_rol SET rol_id='" . $rol . "', nenabled='1' WHERE personales_cedula='" . $cedula . "' AND rol_id='" . $rol . "'";
                        if (pg_affected_rows(pg_query($conn, $SQL2)) == 0) {
                            // Si no se actualizó ninguna fila, insertar el nuevo rol
                            $SQL3 = "INSERT INTO public.personales_rol(personales_cedula, rol_id, dfecha_caducidad, nenabled) VALUES ('" . $cedula . "', '" . $rol . "', '2021-12-31', '1')";
                            if (pg_query($conn, $SQL3)) {
                                echo "1 / Se asignó con éxito el rol al usuario";
                            } else {
                                echo "0 / No se pudo asignar el rol al usuario, favor intentar más tarde. Error: " /* . pg_last_error($conn) */;
                            }
                        } else {
                            echo "1 / Se asignó con éxito el rol al usuario";
                        }
                    } else {
                        echo "0 / No se pudo inhabilitar los roles anteriores, favor intentar más tarde. Error: " /* . pg_last_error($conn) */;
                    }
                }
            }
        }
    }else
     if($accion == 3){
      $cedula = $_REQUEST['cedula'];
    
        $SQL2 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '".$cedula."' AND rol_id >= '77' AND rol_id <= '79' AND nenabled = '1'";
        $row2 = pg_query($conn, $SQL2);
        $cont2 = pg_num_rows($row2);

        if($cont2 > 0){
            $valor2 = pg_fetch_assoc($row2);
            $id = $valor2['id'];
            $date = date('Y-m-d H:i:s'); 
            $sesion = $_SESSION['id_usuario'];

            $SQL3 = "UPDATE public.personales_rol SET nenabled='0', dfecha_actualizacion='".$date."', nusuario_actualizacion='".$sesion."' WHERE id='".$id."' AND rol_id >= '77' AND rol_id <= '79'";
            if($row3 = pg_query($conn, $SQL3)){
                echo "1 / Se inhabilito con éxito el rol al usuario ";
            }else{
                echo "0 / No se pudo inhabilitar el rol al usuario favor intentar más tarde ";
            }
        }else{
            
            $SQL3 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '".$cedula."' AND rol_id >= '77' AND rol_id <= '79'";
            $row3 = pg_query($conn, $SQL3);
            $cont3 = pg_num_rows($row3);
            if($cont3 > 0){
                echo "0 / Rol de usuario inhabilitado, favor asignar primero un nuevo rol";
            }else{
                echo "0 / Usuario no registrado en SIGLA";
            }
        }
    } 
?>