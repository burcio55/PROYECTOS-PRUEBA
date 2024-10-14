+<?php
    $host = "10.46.1.93";
    $dbname = "minpptrassi";
    $user = "postgres";
    $pass = "postgres";

    session_start();
    include('include/BD.php');
    $conn = Conexion::ConexionBD();

    try {
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
    } catch (PDOException $error) {
        $conn = $error;
        echo ("Error al conectar en la Base de Datos " . $error);
    }

    $cedula = $_REQUEST["ced"];
    $entidad_id = $_REQUEST["entidad_id"];
    $rol = $_REQUEST["rol_id"];





    /* echo "1 / " . $SQL2;
        die(); */

    $SQL2 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $cedula . "' AND rol_id >= '82' AND rol_id <= '83' AND nenabled = '1'";
    $row2 = pg_query($conn, $SQL2);
    $cont2 = pg_num_rows($row2);
    if ($cont2 > 0) {
        $valor2 = pg_fetch_assoc($row2);
        $id = $valor2['rol_id'];

        $aql = "UPDATE public.personales_rol SET nenabled='0' WHERE personales_cedula='" . $cedula . "' AND  rol_id='" . $id . "'";
        if ($rs = pg_query($conn, $aql)) {

            $SQL3 = "UPDATE public.personales_rol SET nenabled='1' WHERE personales_cedula='" . $cedula . "' AND  rol_id='" . $rol . "'";
            if ($row3 = pg_query($conn, $SQL3)) {
                echo "1 / Se asignó con éxito el rol al usuario";
                die();
            } else {
                echo "0 / No se pudo asignar el rol al usuario favor intentar más tarde ";
                die();
            }
        } else {
            echo " 0 / Hubo un error " . $aql;
        }
    } else {
        $SQL3 = "INSERT INTO public.personales_rol(personales_cedula, rol_id, dfecha_caducidad, nenabled) VALUES ('" . $cedula . "', '" . $rol . "', '2021-12-31', '1')";
        if ($row3 = pg_query($conn, $SQL3)) {
            echo "1 / Se asignó con éxito el rol al usuario";
            die();
        } else {
            $SQL4 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $cedula . "' AND rol_id = '" . $rol . "'";
            $row4 = pg_query($conn, $SQL4);
            $cont4 = pg_num_rows($row4);
            if ($cont4 > 0) {
                $valor4 = pg_fetch_assoc($row4);
                $SQL5 = "UPDATE public.personales_rol SET nenabled='1' WHERE personales_cedula='" . $cedula . "' AND rol_id='" . $rol . "'";
                if ($row5 = pg_query($conn, $SQL5)) {
                    echo "1 / Se asignó con éxito el rol al usuario";
                    die();
                } else {
                    echo "0 / No se pudo asignar el rol al usuario favor intentar más tarde ";
                    die();
                }
            }
        }
    }









    /* echo "1 / " . $ced . "-" . $entidad_id . "-" . $rol_id;
die(); */

    /* echo "1 / " . $ced . " " . $modulos . " " . $entidad_id . " " . $rol_id; */

    /* $SQL = "UPDATE reporte_ceet.motivo_visita SET sdescripcion = '" . $sdescripcion . "' WHERE id = '" . $id_motivo . "'";
if ($resultado = pg_query($conn, $SQL)) {
    echo "1 / Se Actualizó con éxito";
    die();
} else {
    echo "1 / Falló la actualización: " . $SQL;
    die();
} */

    /* echo " 1 / " . $ced . "  " . $rol_id; */

/* 
    $select = "SELECT * FROM public.personales_rol WHERE nenabled = 1 AND personales_cedula = $ced AND rol_id = 82";
    $row = pg_query($conn, $select);
    $persona = pg_fetch_assoc($row);

    $select2 = "SELECT * FROM public.personales_rol WHERE nenabled = 1 AND personales_cedula = $ced AND rol_id = 83";
    $row2 = pg_query($conn, $select2);
    $persona2 = pg_fetch_assoc($row2);


    if (empty($persona)) {
        if (empty($persona2)) {
            $SQL = "INSERT INTO";
            $SQL .= " public.personales_rol";
            $SQL .= " (";
            $SQL .= " personales_cedula,";
            $SQL .= " rol_id,";
            $SQL .= " entidad_id,";
            $SQL .= " nenabled";
            $SQL .= ")";
            $SQL .= " VALUES";
            $SQL .= " (";
            $SQL .= "'$ced',";
            $SQL .= " '$rol_id',";
            $SQL .= " '$entidad_id',";
            $SQL .= " '1'";
            $SQL .= ");";

            if ($resultado = pg_query($conn, $SQL)) {
                echo "1 / Rol asignado exitosamente";
                die();
            } else {
                echo "1 / No puede repetir el rol de Registrador por: " . $SQL;
                die();
            }
        } else {
            echo "1 / No se puede cambiar el rol del Administrador";
            die();
        }
    } else {
        $id_persona = $persona["id"];

        $update = "UPDATE public.personales_rol SET entidad_id = '$estado' WHERE id = $id_persona";
        if ($resultado2 = pg_query($conn, $update)) {
            echo "1 / Estado actualizado exitosamente";
            die();
        } else {
            echo "1 / Falló la actuaclización del Estado por: " . $update;
            die();
        }
    }
 */