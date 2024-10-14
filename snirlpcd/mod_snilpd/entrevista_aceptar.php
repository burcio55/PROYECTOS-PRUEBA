<?
// DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

//OBTENER DATOS DE LA SESION Y HACER UNA CONSULTA DE LOS DATOS DEL REGUISTRO
//CONEXION CON SIRE

session_start();
include('../include/BD.php');
$conn2 = Conexion::ConexionBD();

//CONEXION CON SNIRLPCD

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$cedula = substr($_SESSION["cedula"], 1);

$consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "' and benabled='true';");
$row = pg_query($conn, $consulta);
$persona = pg_fetch_assoc($row);

$persona_id = $persona["id"];
$entrevista_id = $_REQUEST["entrevista_id"];
$postulacion_id = $_REQUEST["postuacion_id"];

$query = "SELECT * FROM";
$query .= " snirlpcd.entrevista";
$query .= " WHERE";
$query .= " benabled='TRUE'";
$query .= " AND";
$query .= " id = '$entrevista_id'";

$row = pg_query($conn, $query);

$entr = "SELECT * FROM";
$entr .= " snirlpcd.estatus_postulaciones";
$entr .= " WHERE";
$entr .= " benabled='TRUE'";
$entr .= " AND";
$entr .= " postulaciones_id = '$postulacion_id'";

if ($row0 = pg_query($conn, $entr)) {
    $status_postulaciones = pg_fetch_assoc($row0);

    $estatus_id = $status_postulaciones["estatus_id"];

    /* echo $entr . "<br>"; */

    $id_status = $status_postulaciones["id"];

    $SQL = "INSERT INTO";
    $SQL .= " snirlpcd.estatus_postulaciones";
    $SQL .= " (";
    $SQL .= " postulaciones_id,";
    $SQL .= " estatus_id";
    $SQL .= ")";
    $SQL .= " VALUES";
    $SQL .= " (";
    $SQL .= "'$postulacion_id',";
    $SQL .= " '7'";
    $SQL .= ");";

    /* echo $SQL . "<br>"; */

    $row2 = pg_query($conn, $SQL);

    $select = "SELECT * FROM";
    $select .= " snirlpcd.estatus_postulaciones";
    $select .= " WHERE";
    $select .= " benabled='TRUE'";
    $select .= " AND";
    $select .= " postulaciones_id = '$postulacion_id'";
    $select .= " AND";
    $select .= " estatus_id = '$estatus_id'";

    /* echo $select . "<br>"; */

    $row3 = pg_query($conn, $select);
    $status_postulaciones = pg_fetch_assoc($row2);

    $id_status_postulaciones = $status_postulaciones["id"];

    $update = "UPDATE";
    $update .= " snirlpcd.estatus_postulaciones";
    $update .= " SET";
    $update .= " benabled = 'false'";
    $update .= " WHERE";
    $update .= " id = '$id_status'";

    /* echo $update . "<br>"; */

    if ($row4 = pg_query($conn, $update)) {
        echo "Se aceptó con éxito la Entrevista";
    } else {
        echo "No se pudo aceptar la Entrevista";
    }
} else {
    echo "Ocurrió un error inesperado, por favor intentar más tarde";
}
