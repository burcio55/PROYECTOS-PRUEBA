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

$ced = $_REQUEST["ced"];
$rol_id = $_REQUEST["rol_id"];

if ($ced == '') {
    echo "1 / Debe seleccionar indicar una Cédula para continuar";
    die();
}

$select = "SELECT * FROM public.personales_rol WHERE nenabled = 1 AND personales_cedula = $ced AND rol_id = 82";
$row = pg_query($conn, $select);
$persona = pg_fetch_assoc($row);

$select2 = "SELECT * FROM public.personales_rol WHERE nenabled = 1 AND personales_cedula = $ced AND rol_id = 83";
$row2 = pg_query($conn, $select2);
$persona2 = pg_fetch_assoc($row2);

/* echo "1 / " . $persona . " - " . $select; */

if (empty($persona)) {
    /* echo "1 / No es Administrador";
    die(); */
    if (empty($persona2)) {
        /* echo "1 / No es Registrador";
        die(); */
        $SQL = "INSERT INTO";
        $SQL .= " public.personales_rol";
        $SQL .= " (";
        $SQL .= " personales_cedula,";
        $SQL .= " rol_id,";
        $SQL .= " nenabled";
        $SQL .= ")";
        $SQL .= " VALUES";
        $SQL .= " (";
        $SQL .= "'$ced',";
        $SQL .= " '$rol_id',";
        $SQL .= " '1'";
        $SQL .= ");";

        /* echo "1 / " . $SQL;
        die(); */

        if ($resultado = pg_query($conn, $SQL)) {
            echo "1 / Rol asignado exitosamente";
            die();
        } else {
            echo "1 / No puede repetir el rol de Administrador por: " . $SQL;
            die();
        }
    } else {
        /* echo "1 / No se puede cambiar el rol del Administrador";
        die(); */
        $id_persona = $persona2["id"];
        /* echo "1 / " . $id_persona;
        die(); */
        $delete = "DELETE FROM public.personales_rol WHERE id = $id_persona";
        if ($resultado2 = pg_query($conn, $delete)) {
            $SQL2 = "INSERT INTO";
            $SQL2 .= " public.personales_rol";
            $SQL2 .= " (";
            $SQL2 .= " personales_cedula,";
            $SQL2 .= " rol_id,";
            $SQL2 .= " nenabled";
            $SQL2 .= ")";
            $SQL2 .= " VALUES";
            $SQL2 .= " (";
            $SQL2 .= "'$ced',";
            $SQL2 .= " '$rol_id',";
            $SQL2 .= " '1'";
            $SQL2 .= ");";

            if ($resultado = pg_query($conn, $SQL2)) {
                echo "1 / Rol modificado exitosamente";
                die();
            } else {
                echo "1 / No puede repetir el rol de Administrador por: " . $SQL;
                die();
            }
        } else {
            echo "1 / Falló la inhabilitación del rol anterior por: " . $delete;
            die();
        }
    }
} else {
    // En caso de necesitar eliminar 
    echo "1 / No se puede cambiar el rol del Administrador";
    die();
}
