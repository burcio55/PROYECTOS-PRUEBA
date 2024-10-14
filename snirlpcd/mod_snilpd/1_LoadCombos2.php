<?

session_start();
include('../include/BD.php');
$conn2 = Conexion::ConexionBD();

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

if (isset($_SESSION['cedula'])) {

    $id = substr($_SESSION['cedula'], 1);

    $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $id . "' AND benabled = 'true';");
    $row = pg_query($conn, $consulta);
    $persona = pg_fetch_assoc($row);
    /*$persona = $conn->Execute($sentencia);*/

    $id = $persona["id"];
    /* $semail = $persona["correo"] . " "; */
}

$sSQL = "
    SELECT *
    FROM snirlpcd.persona
    where id='$id' AND benabled = 'true'
";
$row2 = pg_query($conn, $sSQL);
//$vuelta = pg_num_rows($row2);

$vuelta = pg_fetch_assoc($row2);

echo ($vuelta['npais_nac_id'] . " / " . $vuelta['entidad_nac_id'] . " / " . $vuelta['estado_civil_id'] . " / " . $vuelta['stelefono_personal'] . " / " . $vuelta['stelefono_habitacion'] . " / " . $vuelta['npais_residencia_id'] . " / " . $vuelta['nentidad_residencia_id'] . " / " . $vuelta['nmunicipio_residencia_id'] . " / " . $vuelta['nparroquia_residencia_id'] . " / " . $vuelta['ssector_residencia'] . " / " . $vuelta['sdireccion_residencia'] . " / " . $vuelta['spunto_ref_residencia'] . " / " . $vuelta['bjefe_familia'] . " / " . $vuelta['btiene_hijo'] . " / " . $vuelta['nhijos_menores18'] . " / " . $vuelta['nhijos_mayores18'] . " / " . $vuelta['vehiculo_id'] . " / " . $vuelta['bcarnet_patria'] . " / " . $vuelta['scodigo_carnet_patria'] . " / " . $vuelta['sserial_carnet_patria'] . " / " . $vuelta['sobservaciones']);

/* while ($row = pg_fetch_assoc($row2)) {
    echo ('<tr><td>' . $row['sdescripcion'] . '</td><td>' . $row['snombre_inst_educativa'] . '</td><td></td></tr>');
} */
