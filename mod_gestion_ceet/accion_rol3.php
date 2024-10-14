<?php
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
$SQL2 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $cedula . "' AND rol_id >= '82' AND rol_id <= '83' AND nenabled = '1'";
$row2 = pg_query($conn, $SQL2);
$cont2 = pg_num_rows($row2);
if ($cont2 > 0) {
    $valor2 = pg_fetch_assoc($row2);
    $id = $valor2['rol_id'];
    $SQL3 = "UPDATE public.personales_rol SET nenabled='0' WHERE personales_cedula='" . $cedula . "' AND rol_id='" . $id . "'";
    if ($row3 = pg_query($conn, $SQL3)) {
        echo "1 / Se inhabilito con éxito el rol al usuario";
    } else {
        echo "0 / No se pudo inhabilitar el rol al usuario favor intentar más tarde";
    }
} else {
    $SQL3 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $cedula . "' AND rol_id >= '82' AND rol_id <= '83'";
    $row3 = pg_query($conn, $SQL3);
    $cont3 = pg_num_rows($row3);
    if ($cont3 > 0) {
        echo "0 / Rol de usuario inhabilitado, favor asignar primero un nuevo rol";
    } else {
        echo "0 / Usuario no registrado en SIGLA";
    }
}
