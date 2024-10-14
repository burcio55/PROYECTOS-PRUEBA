<?php

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

if (isset($_SESSION['cedula'])) {

    $id = substr($_SESSION['cedula'], 1);

    $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $id . "' AND benabled = 'true';");
    $row = pg_query($conn, $consulta);
    $persona = pg_fetch_assoc($row);
    /*$persona = $conn->Execute($sentencia);*/

    $ncedula = $persona["ncedula"] . " ";
    $sprimer_nombre = $persona["sprimer_nombre"] . " ";
    $ssegundo_nombre = $persona["ssegundo_nombre"] . " ";
    $sprimer_apellido = $persona["sprimer_apellido"] . " ";
    $ssegundo_apellido = $persona["ssegundo_apellido"] . " ";
    /* $semail = $persona["correo"] . " "; */
}

$npais_nac_id = $_REQUEST['npais_nac_id'];
$entidad_nac_id = $_REQUEST['entidad_nac_id'];
$residencia_extranjera_id = $_REQUEST['residencia_extranjera_id'];
$estado_civil_id = $_REQUEST['estado_civil_id'];
$stelefono_personal = $_REQUEST['stelefono_personal'];
$stelefono_habitacion = $_REQUEST['stelefono_habitacion'];

$npais_residencia_id = $_REQUEST['npais_residencia_id'];
$nentidad_residencia_id = $_REQUEST['nentidad_residencia_id'];
$nmunicipio_residencia_id = $_REQUEST['nmunicipio_residencia_id'];
$nparroquia_residencia_id = $_REQUEST['nparroquia_residencia_id'];
$ssector_residencia = $_REQUEST['ssector_residencia'];
$sdireccion_residencia = $_REQUEST['sdireccion_residencia'];
$spunto_ref_residencia = $_REQUEST['spunto_ref_residencia'];

$bjefe_familia = $_REQUEST['bjefe_familia'];
$btiene_hijo = $_REQUEST['btiene_hijo'];
$nhijo_menores18 = $_REQUEST['nhijo_menores18'];
$nhijo_mayores18 = $_REQUEST['nhijo_mayores18'];

$vehiculo_id = $_REQUEST['vehiculo_id'];
$bcarnet_patria = $_REQUEST['bcarnet_patria'];
$scodigo_carnet_patria = $_REQUEST['scodigo_carnet_patria'];
$sserial_carnet_patria = $_REQUEST['sserial_carnet_patria'];
$sobservaciones = $_REQUEST['sobservaciones'];

//CONSULTA CON REDES SOCIALES

$PG = "SELECT";
$PG .= " *";
$PG .= " FROM";
$PG .= " snirlpcd.persona";
$PG .= " WHERE";
$PG .= " ncedula='$ncedula'";
$PG .= " AND";
$PG .= " benabled =";
$PG .= " 'true'";
$resultado = pg_query($conn, $PG);
$row = pg_fetch_assoc($resultado);
$id = $row['id'];

/* if ($npais_nac_id == 'null' || $npais_nac_id == '-1') {
    echo "1 / Debe indicar cuál es su País de Nacimiento / ";
    echo "#cbpais_nac_afiliado1";
    die();
}
if ($npais_nac_id == '245' && $entidad_nac_id == 'null' || $npais_nac_id == '245' && $entidad_nac_id == '-1') {
    echo "1 / Debe indicar cuál es su Estado de Nacimiento / ";
    echo "#cbEstado_nac_afiliado";
    die();
}
if ($stelefono_personal == '') {
    echo "1 / Debe indicar cuál es su número Personal / ";
    echo "#telefono_afiliado";
    die();
} else
if ($stelefono_personal < '1000000000' || $stelefono_personal > '9999999999') {
    echo "1 / El Teléfono Personal no tiene un formato válido / ";
    echo "#telefono_afiliado";
    die();
}
if ($stelefono_habitacion != '') {
    if ($stelefono_habitacion < '1000000000' || $stelefono_habitacion > '9999999999') {
        echo "1 / El Teléfono de Habitación no tiene un formato válido / ";
        echo "#otro_telefono_afiliado";
        die();
    }
}
if ($npais_residencia_id == '-1') {
    echo "1 / Debe indicar cuál es su País de Residencia / ";
    echo "#pais_residencia";
    die();
}
if ($nentidad_residencia_id == 'null') {
    echo "1 / Debe indicar cuál es su Estado de Residencia / ";
    echo "#estado_residencia";
    die();
}
if ($nmunicipio_residencia_id == 'null') {
    echo "1 / Debe indicar cuál es su Municipio de Residencia / ";
    echo "#municipio_residencia";
    die();
}
if ($nparroquia_residencia_id == 'null') {
    echo "1 / Debe indicar cuál es su Parroquia de Residencia / ";
    echo "#parroquia_residencia";
    die();
}
if ($bjefe_familia == '-1' || $bjefe_familia == 'null') {
    echo "1 / Debe responder a la pregunta: ¿Es Jefe o Jefa de Hogar? / ";
    echo "#cbJefe_familia";
    die();
}
if ($btiene_hijo == '-1' || $btiene_hijo == 'null') {
    echo "1 / Debe responder a la pregunta: ¿Tiene Hijos? / ";
    echo "#cbHijos";
    die();
} else if ($btiene_hijo == '1') {
    if ($nhijo_menores18 == '' || $nhijo_mayores18 == '') {
        if ($nhijo_menores18 == '') {
            echo "1 / Debe indicar la cantidad de hijos menores de edad / ";
            echo "#hijos_menores";
            die();
        } else if ($nhijo_mayores18 == '') {
            echo "1 / Debe indicar la cantidad de hijos mayores de edad / ";
            echo "#hijos_mayores";
            die();
        }
    }
    if ($nhijo_menores18 == '0' && $nhijo_mayores18 == '0') {
        if ($nhijo_menores18 == '0') {
            echo "1 / Error, la cantidad de hijos no puede ser 0 si ya indicó que posee hijos / ";
            echo "#hijos_menores";
            die();
        } else if ($nhijo_mayores18 == '') {
            echo "1 / Error, la cantidad de hijos no puede ser 0 si ya indicó que posee hijos / ";
            echo "#hijos_mayores";
            die();
        }
        echo "1 / Error, la cantidad de Hijos no puede ser 0 si ya indicó que posee Hijos";
        die();
    }
}
if ($bcarnet_patria == '-1' || $bcarnet_patria == 'null') {
    echo "1 / Debe responder a la pregunta: ¿Posee Carnet de la Patria? / ";
    echo "#carnet_patria";
    die();
} */
if ($bjefe_familia == '1') {
    $bjefe_familia = 'true';
} else {
    $bjefe_familia = 'false';
}
if ($nhijo_menores18 == '') {
    $nhijo_menores18 = "0";
}
if ($nhijo_mayores18 == '') {
    $nhijo_mayores18 = "0";
}
// Sintaxis del Update
$sql = "UPDATE";
$sql .= " snirlpcd.persona";
$sql .= " SET";
$sql .= " npais_nac_id='$npais_nac_id'";
$sql .= ", entidad_nac_id='$entidad_nac_id'";
$sql .= ", sestado_nacionalidad_ext='$residencia_extranjera_id'";
$sql .= ", estado_civil_id='$estado_civil_id'";
$sql .= ", stelefono_personal='$stelefono_personal'";
$sql .= ", stelefono_habitacion='$stelefono_habitacion'";

$sql .= ", npais_residencia_id='$npais_residencia_id'";
$sql .= ", nentidad_residencia_id='$nentidad_residencia_id'";
$sql .= ", nmunicipio_residencia_id='$nmunicipio_residencia_id'";
$sql .= ", nparroquia_residencia_id='$nparroquia_residencia_id'";
$sql .= ", ssector_residencia='$ssector_residencia'";
$sql .= ", sdireccion_residencia='$sdireccion_residencia'";
$sql .= ", spunto_ref_residencia='$spunto_ref_residencia'";

$sql .= ", bjefe_familia='$bjefe_familia'";
$sql .= ", btiene_hijo='$btiene_hijo'";
$sql .= ", nhijos_menores18='$nhijo_menores18'";
$sql .= ", nhijos_mayores18='$nhijo_mayores18'";

$sql .= ", vehiculo_id='$vehiculo_id'";
$sql .= ", bcarnet_patria='$bcarnet_patria'";
$sql .= ", scodigo_carnet_patria='$scodigo_carnet_patria'";
$sql .= ", sserial_carnet_patria='$sserial_carnet_patria'";
$sql .= ", sobservaciones='$sobservaciones'";
$sql .= " WHERE";
$sql .= " ncedula='$ncedula'";
$sql .= " AND";
$sql .= " benabled='true'";


if ($resultado = pg_query($conn, $sql)) {
    echo 'Se guardó con éxito la información';
} else {
    echo '1 / Se presentó un problema por favor intente más tarde'.$sql;
}