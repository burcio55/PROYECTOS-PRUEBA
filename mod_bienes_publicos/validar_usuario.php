<?
include('conexion.php');

$accion = $_REQUEST['accion'];
if ($accion == 1) {
    $cedula = $_REQUEST['cedula'];
    $nacionalidad = $_REQUEST['nacionalidad'];
    //echo $cedula;

    $SQL = "SELECT cedula, primer_apellido, segundo_apellido, primer_nombre, segundo_nombre 
        FROM public.personales WHERE nenabled = '1' AND cedula = '" . $cedula . "' AND personales.nacionalidad ='" . $nacionalidad . "'";
    $row = pg_query($conn, $SQL);
    $cont = pg_num_rows($row);
    if ($cont > 0) {
        $valor = pg_fetch_assoc($row);
        $nombre = $valor['primer_nombre'] . " " . $valor['segundo_nombre'] . ", " . $valor['primer_apellido'] . " " . $valor['segundo_apellido'];
        echo "1 / " . $nombre;
        $SQL2 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $cedula . "' AND rol_id >= '80' AND rol_id <= '81' AND nenabled = '1'";
        $row2 = pg_query($conn, $SQL2);
        $cont2 = pg_num_rows($row2);
        if ($cont2 > 0) {
            $valor2 = pg_fetch_assoc($row2);
            echo " / " . $valor2['rol_id'];
        } else {
            echo " / 0 / -1";
        }
    } else {
        echo " / 0 / Usuario no registrado en SIGLA";
    }
} else
    if ($accion == 2) {
    $cedula = $_REQUEST['cedula'];
    $rol = $_REQUEST['rol'];

    $SQL2 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $cedula . "' AND rol_id >= '80' AND rol_id <= '81' AND nenabled = '1'";
    $row2 = pg_query($conn, $SQL2);
    $cont2 = pg_num_rows($row2);
    if ($cont2 > 0) {
        $valor2 = pg_fetch_assoc($row2);
        $id = $valor2['rol_id'];

        $aql = "UPDATE public.personales_rol SET nenabled='0' WHERE personales_cedula='" . $cedula . "' AND  rol_id='" . $id . "'";
        if ($rs = pg_query($conn, $aql)) {

            $SQL3 = "UPDATE public.personales_rol SET nenabled='1' WHERE personales_cedula='" . $cedula . "' AND  rol_id='" . $rol . "'";
            if ($row3 = pg_query($conn, $SQL3)) {
                echo "1 / Se asigno con éxito el rol al usuario";
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
            echo "1 / Se asigno con éxito el rol al usuario";
            die();
        } else {
            $SQL4 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $cedula . "' AND rol_id = '" . $rol . "'";
            $row4 = pg_query($conn, $SQL4);
            $cont4 = pg_num_rows($row4);
            if ($cont4 > 0) {
                $valor4 = pg_fetch_assoc($row4);
                $SQL5 = "UPDATE public.personales_rol SET nenabled='1' WHERE personales_cedula='" . $cedula . "' AND rol_id='" . $rol . "'";
                if ($row5 = pg_query($conn, $SQL5)) {
                    echo "1 / Se asigno con éxito el rol al usuario";
                    die();
                } else {
                    echo "0 / No se pudo asignar el rol al usuario favor intentar más tarde ";
                    die();
                }
            }
        }
    }
} else
    if ($accion == 3) {
    $cedula = $_REQUEST['cedula'];

    $SQL2 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $cedula . "' AND rol_id >= '80' AND rol_id <= '81' AND nenabled = '1'";
    $row2 = pg_query($conn, $SQL2);
    $cont2 = pg_num_rows($row2);
    if ($cont2 > 0) {
        $valor2 = pg_fetch_assoc($row2);
        $id = $valor2['id'];
        $SQL3 = "UPDATE public.personales_rol SET nenabled='2' WHERE id='" . $id . "'";
        if ($row3 = pg_query($conn, $SQL3)) {
            echo "1 / Se inhabilito con éxito el rol al usuario";
        } else {
            echo "0 / No se pudo inhabilitar el rol al usuario favor intentar más tarde";
        }
    } else {
        $SQL3 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $cedula . "' AND rol_id >= '80' AND rol_id <= '81'";
        $row3 = pg_query($conn, $SQL3);
        $cont3 = pg_num_rows($row3);
        if ($cont3 > 0) {
            echo "0 / Rol de usuario inhabilitado, favor asignar primero un nuevo rol";
        } else {
            echo "0 / Usuario no registrado en SIGLA";
        }
    }
}
