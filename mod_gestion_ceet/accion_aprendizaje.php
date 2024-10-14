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

$aprendizaje = $_REQUEST["aprendizaje"];

// Validaciones

if ($aprendizaje == '') {
    echo "1 / Es Obligatorio indicar cuál es el Ambiente de Aprendizaje a Agregar";
    die();
} else {
    $SQL = "INSERT INTO";
    $SQL .= " reporte_ceet.ambiente_aprendizaje";
    $SQL .= " (";
    $SQL .= " sdescripcion,";
    $SQL .= " nusuario_creacion";
    $SQL .= ")";
    $SQL .= " VALUES";
    $SQL .= " (";
    $SQL .= "'$aprendizaje',";
    $SQL .= " 13289657";
    $SQL .= ");";

    if ($resultado = pg_query($conn, $SQL)) {
        echo "1 / Se agregó correctamente el \"Ambiente de Aprendizaje\"";
        die();
    } else {
        echo "1 / Falló la inserción, razón: " . $SQL;
        die();
    }
}
