<?php

    include("BD.php");

    $accion = $_REQUEST["accion"];
    if($accion == 1){
        $cedula = $_REQUEST["cedula"];

        $SQL = "SELECT * FROM public.personales WHERE cedula = '$cedula' AND nenabled = '1'";
        if($row = pg_query($conn, $SQL)){
            $persona = pg_fetch_assoc($row);
            echo "1 / ". $persona['primer_apellido']. " ". $persona['segundo_apellido']." ". $persona['primer_nombre'] ." ". $persona['segundo_nombre'];
            die();
        }else{
            echo "0 / " . $SQL;
            die();
        }
    }else if($accion == 2){
        $cedula = $_REQUEST["cedula"];
        $rol = $_REQUEST["rol"];

        $SQL = "SELECT * FROM public.personales_rol WHERE personales_cedula = '$cedula' AND nenabled = '1' AND rol_id >= '84' AND rol_id <= '87'";
        $row = pg_query($conn, $SQL);
        $valor = pg_num_rows($row);
        echo "1 / ".$SQL;
        die();
        if($valor > 0){
            $persona = pg_fetch_assoc($row);
            $rol_original = $persona['rol_id'];
            $fecha = date("Y-m-d d:i:s");
            $usuario = $_SESSION["id_usuario"];
            $SQL2 = "UPDATE public.personales_rol SET rol_id='$rol', dfecha_actualizacion='$fecha', nusuario_actualizacion='$usuario' WHERE personales_cedula = '$cedula' AND rol_id >= '84' AND rol_id <= '87'";
            if($row = pg_query($conn, $SQL2)){
                echo "1 / Rol asignado Correctamente";
                die();
            }/* else{
                $SQL3 = "UPDATE public.personales_rol SET nenabled='1' WHERE personales_cedula = '$cedula' AND rol_id = '$rol'";
                if($row = pg_query($conn, $SQL3)){
                    $SQL4 = "UPDATE public.personales_rol SET nenabled='0' WHERE personales_cedula = '$cedula' AND rol_id = '$rol_original'";
                    $row = pg_query($conn, $SQL4);
                    echo "1 / Rol asignado Correctamente";
                    die();
                }else{
                    echo "0 / Se presentó un error, favor intentar más tarde / ".$SQL2;
                    die();
                }
            } */
        }else{
            $usuario = $_SESSION["id_usuario"];
            $SQL2 = "INSERT INTO public.personales_rol(personales_cedula, rol_id, nenabled, nusuario_creacion) VALUES ('$cedula', '$rol', '1', '$usuario')";
            if($row = pg_query($conn, $SQL2)){
                echo "1 / Rol asignado Correctamente";
                die();
            }else{
                echo "0 / Se presentó un error, favor intentar más tarde / ".$SQL;
                die();
            }
        }
    }else if($accion == 3){
        $id = $_REQUEST['id'];

        $SQL = "UPDATE evaluacion_desemp.evaluacion SET nestatus = '5' WHERE personales_id = '$id'";
        if($row = pg_query($conn, $SQL)){
            echo "1 / Se guardó con exito la información";
            die();
        }else{
            echo "0 / Se presentó un error, favor intentar más tarde / ".$SQL;
            die();
        }
    }else if($accion == 4){
        $id = $_REQUEST['id'];
        $oa = $_REQUEST['oa'];

        $SQL = "UPDATE evaluacion_desemp.evaluacion SET nestatus = '4', sobservacion_analista = '$oa' WHERE personales_id = '$id'";
        if($row = pg_query($conn, $SQL)){
            echo "1 / Se guardó con exito la información ";
            die();
        }else{
            echo "0 / Se presentó un error, favor intentar más tarde / ".$SQL;
            die();
        }
    }else if($accion == 5){
        $id = $_REQUEST['id'];

        $SQL = "UPDATE evaluacion_desemp.evaluacion SET nestatus = '3', sdesacuerdo_evaluado = 'SI' WHERE id = '$id'";
        if($row = pg_query($conn, $SQL)){
            echo "1 / Se guardó con exito la información";
            die();
        }else{
            echo "0 / Se presentó un error, favor intentar más tarde / ".$SQL;
            die();
        }
    }else if($accion == 6){
        $id = $_REQUEST['id'];
        $text = $_REQUEST['text'];

        $SQL = "UPDATE evaluacion_desemp.evaluacion SET nestatus = '4', sdesacuerdo_evaluado = 'NO', sobservaciones = '$text' WHERE id = '$id'";
        if($row = pg_query($conn, $SQL)){
            echo "1 / Se guardó con exito la información";
            die();
        }else{
            echo "0 / Se presentó un error, favor intentar más tarde / ".$SQL;
            die();
        }
    }
    
?>