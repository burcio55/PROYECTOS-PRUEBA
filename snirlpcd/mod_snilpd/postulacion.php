<?
// DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS
include("header.php");
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
$id_oferta = $_REQUEST["id"];

$query = "SELECT * FROM";
$query .= " snirlpcd.postulaciones";
$query .= " WHERE";
$query .= " benabled='TRUE'";
$query .= " AND";
$query .= " oferta_empleo_id = '$id_oferta'";
$query .= " AND";
$query .= " persona_id = '$persona_id'";

/* echo $query;
die(); */

$row = pg_query($conn, $query);
$postulacion = pg_fetch_assoc($row);
/* echo $postulacion["oferta_empleo_id"] . " = " . $id_oferta . "<br>" . $postulacion["persona_id"] . " = " . $persona_id;
die(); */

if ($postulacion["oferta_empleo_id"] == $id_oferta || $postulacion["persona_id"] == $persona_id) {
    echo "
        <script>
            document.getElementById(\"texto\").innerText = ('No puede postularse dos veces para la misma oferta');
            document.getElementById(\"titulo\").style.backgroundColor = \"#DC3831\"; //Rojo
            document.getElementById(\"titulo\").style.color = \"white\";
            document.getElementById(\"titulo\").innerText = (\"Atención\");
            document.getElementById(\"alerta\").style.display = \"Block\";
            document.getElementById(\"link\").value = \"oportunidad_trabajo.php\";
        </script>
    ";
    die();
}

$SQL = "INSERT INTO";
$SQL .= " snirlpcd.postulaciones";
$SQL .= " (";
$SQL .= " oferta_empleo_id,";
$SQL .= " persona_id,";
$SQL .= " nusuario_creacion";
$SQL .= ")";
$SQL .= " VALUES";
$SQL .= " (";
$SQL .= "'$id_oferta',";
$SQL .= " '$persona_id',";
$SQL .= " '$cedula'";
$SQL .= ");";

if ($row2 = pg_query($conn, $SQL)) {
    $select = "SELECT * FROM";
    $select .= " snirlpcd.postulaciones";
    $select .= " WHERE";
    $select .= " benabled='TRUE'";
    $select .= " AND";
    $select .= " oferta_empleo_id = '$id_oferta'";
    $select .= " AND";
    $select .= " persona_id = '$persona_id'";
    $row3 = pg_query($conn, $select);
    $postulacion2 = pg_fetch_assoc($row3);

    $_SESSION["id_postulacion"] = $postulacion2["id"];
    $postulacion_id = $_SESSION["id_postulacion"];

    $PG = "INSERT INTO";
    $PG .= " snirlpcd.estatus_postulaciones";
    $PG .= " (";
    $PG .= " postulaciones_id,";
    $PG .= " estatus_id";
    $PG .= " )";
    $PG .= " VALUES";
    $PG .= " (";
    $PG .= " '$postulacion_id',";
    $PG .= " '1'";
    $PG .= " )";

    $row4 = pg_query($conn, $PG);
    $postulacion3 = pg_fetch_assoc($row4);

    echo "
        <script>
            document.getElementById(\"texto\").innerText = ('Se ha enviado su currículum vitae con éxito');
            document.getElementById(\"titulo\").style.backgroundColor = \"#46A2FD\"; //Azul
            document.getElementById(\"titulo\").style.color = \"white\";
            document.getElementById(\"titulo\").innerText = (\"Atención\");
            document.getElementById(\"alerta\").style.display = \"Block\";
            document.getElementById(\"link\").value = \"oportunidad_trabajo.php\";
        </script>
    ";
    die();
} else {
    echo "
        <script>
            document.getElementById(\"texto\").innerText = ('Ocurrió un error inesperado, por favor intentar más tarde');
            document.getElementById(\"titulo\").style.backgroundColor = \"#DC3831\"; //Rojo
            document.getElementById(\"titulo\").style.color = \"white\";
            document.getElementById(\"titulo\").innerText = (\"Atención\");
            document.getElementById(\"alerta\").style.display = \"Block\";
            document.getElementById(\"link\").value = \"Detalles_oferta.php?id=" . $id_oferta . "\";
        </script>
    ";
    die();
}
include("footer.php"); ?>