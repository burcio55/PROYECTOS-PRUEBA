<?php
include("header.php"); 

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

session_start();
include('../include/BD.php');
$conn = Conexion::ConexionBD();

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$id_postulacion = $_REQUEST["id"];

$update = "UPDATE";
$update .= " snirlpcd.estatus_postulaciones";
$update .= " SET";
$update .= " estatus_id='10'";
$update .= " WHERE";
$update .= " postulaciones_id='$id_postulacion'";

if ($row = pg_query($conn, $update)) {
    echo '
        <script>
            document.getElementById("texto").innerText = ("Se Eliminó con éxito la Postulación");
            document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
            document.getElementById("titulo").style.color = "white";
            document.getElementById("titulo").innerText = ("Atención");
            document.getElementById("alerta").style.display = "Block";
            document.getElementById("link").value = "postulaciones.php";
        </script>
    ';
    die();
} else {
    echo '
        <script>
            document.getElementById("texto").innerText = ("Ocurrió un error inesperado, por favor intentar más tarde");
            document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
            document.getElementById("titulo").style.color = "white";
            document.getElementById("titulo").innerText = ("Atención");
            document.getElementById("alerta").style.display = "Block";
            document.getElementById("link").value = "postulaciones.php";
        </script>
    ';
    die();
}
