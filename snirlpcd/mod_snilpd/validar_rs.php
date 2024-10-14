<?php

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";
// $id = CI En teoría
//$respuesta = $_POST['nacionalidad'] . ' y ' . $_POST['sexo'] . ' y ' . $_POST['fecha_nacimiento'];
//echo $respuesta;

/* $hostname = "10.46.1.74";
    $username = "produccion";
    $password = "produccionpasswd"; */

session_start();
include('../include/BD.php');
$conn = Conexion::ConexionBD();

if (isset($_SESSION['cedula'])) {

    $id = substr($persona["cedula"], 1);

    $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $id . "';");

    echo $consulta;
    die();
    
    $row = pg_query($conn, $consulta);
    $persona = pg_fetch_assoc($row);
    /*$persona = $conn->Execute($sentencia);*/

    $id = $persona['id'];
}

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

/*
$ssexo = $_POST['sexo'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$npais_nac_id = $_POST['npais_nac_id'];
$entidad_nac_id = $_POST['entidad_nac_id'];
$estado_civil_id = $_POST['estado_civil_id'];
$stelefono_personal = $_POST['stelefono_personal'];
$stelefono_habitacion = $_POST['stelefono_habitacion'];

$npais_residencia_id = $_POST['npais_residencia_id'];
$nentidad_residencia_id = $_POST['nentidad_residencia_id'];
$nmunicipio_residencia_id = $_POST['nmunicipio_residencia_id'];
$nparroquia_residencia_id = $_POST['nparroquia_residencia_id'];
$ssector_residencia = $_POST['ssector_residencia'];
$sdireccion_residencia = $_POST['sdireccion_residencia'];
$spunto_ref_residencia = $_POST['spunto_ref_residencia'];

$bjefe_familia = $_POST['bjefe_familia'] . " ";
$btiene_hijo = $_POST['btiene_hijo'] . " ";
$nhijo_menores18 = $_POST['nhijo_menores18'] . " ";
$nhijo_mayores18 = $_POST['nhijo_mayores18'] . " ";

$vehiculo_id = $_POST['vehiculo_id'] . " ";
$bcarnet_patria = $_POST['bcarnet_patria'] . " ";
$scodigo_carnet_patria = $_POST['scodigo_carnet_patria'] . " ";
$sserial_carnet_patria = $_POST['sserial_carnet_patria'] . " ";
$sobservaciones = $_POST['sobservaciones'] . " ";

$siguiente = 'discapacidad.php'; // Redireccionamiento a la sigueiente página

// Validación de sí Insert o Update
if ($ncedula == "") {
    $sql = "INSERT INTO snirlpcd.copia ";
    $sql .= "(";
    $sql .= "snacionalidad";
    $sql .= ", ncedula";
    $sql .= ", sprimer_nombre";
    $sql .= ", ssegundo_nombre";
    $sql .= ", sprimer_apellido";
    $sql .= ", ssegundo_apellido";
    $sql .= ", ssexo";
    $sql .= ", semail";
    $sql .= ", dfecha_nacimiento";
    $sql .= ", npais_nac_id";
    $sql .= ", entidad_nac_id";
    $sql .= ", estado_civil_id";
    $sql .= ", stelefono_personal";
    $sql .= ", stelefono_habitacion";
    $sql .= ", npais_residencia_id";
    $sql .= ", nentidad_residencia_id";
    $sql .= ", nmunicipio_residencia_id";
    $sql .= ", nparroquia_residencia_id";
    $sql .= ", ssector_residencia";
    $sql .= ", sdireccion_residencia";
    $sql .= ", spunto_ref_residencia";
    $sql .= ", bjefe_familia";
    $sql .= ", btiene_hijo";
    $sql .= ", nhijos_menores18";
    $sql .= ", nhijos_mayores18";
    $sql .= ", vehiculo_id";
    $sql .= ", bcarnet_patria";
    $sql .= ", scodigo_carnet_patria";
    $sql .= ", sserial_carnet_patria";
    $sql .= ", sobservaciones";
    $sql .= ". nusuario_creacion"; 
    $sql .= ")";
    $sql .= " VALUES ";
    $sql .= "(";
    $sql .= "'$snacionalidad'";
    $sql .= ", '$ncedula'";
    $sql .= ", '$sprimer_nombre'";
    $sql .= ", '$ssegundo_nombre'";
    $sql .= ", '$sprimer_apellido'";
    $sql .= ", '$ssegundo_apellido'";
    $sql .= ", '$ssexo'";
    $sql .= ", '$semail'"; 
    $sql .= ", '$fecha_nacimiento'";
    $sql .= ", '$npais_nac_id'";
    $sql .= ", '$entidad_nac_id'";
    $sql .= ", '$estado_civil_id'";
    $sql .= ", '$stelefono_personal'";
    $sql .= ", '$stelefono_habitacion'";
    $sql .= ", '$npais_residencia_id'";
    $sql .= ", '$nentidad_residencia_id'";
    $sql .= ", '$nmunicipio_residencia_id'";
    $sql .= ", '$nparroquia_residencia_id'";
    $sql .= ", '$ssector_residencia'";
    $sql .= ", '$sdireccion_residencia'";
    $sql .= ", '$spunto_ref_residencia'";
    $sql .= ", '$bjefe_familia'";
    $sql .= ", '$btiene_hijo'";
    $sql .= ", '$nhijo_menores18'";
    $sql .= ", '$nhijo_mayores18'";
    $sql .= ", '$vehiculo_id'";
    $sql .= ", '$bcarnet_patria'";
    $sql .= ", '$scodigo_carnet_patria'";
    $sql .= ", '$sserial_carnet_patria'";
    $sql .= ", '$sobservaciones'";
    $sql .= ")";

    if ($resultado = pg_query($conn, $sql)) {
        echo 'Registro exitoso';
    } else {
        echo 'Registro no exitoso';
    }
} else {
    // Sintaxis del Update
    $sql = "UPDATE";
    $sql .= " snirlpcd.persona";
    $sql .= " SET";
    $sql .= " estado_civil_id='$estado_civil_id'";
    $sql .= ", stelefono_personal='$stelefono_personal'";
    $sql .= ", stelefono_habitacion='$stelefono_habitacion'";
    /* $sql .= ", nentidad_residencia_id='$nentidad_residencia_id'";
    $sql .= ", nmunicipio_residencia_id='$nmunicipio_residencia_id'"; 
    $sql .= ", nparroquia_residencia_id='$nparroquia_residencia_id'";*/
    $sql .= ", ssector_residencia='$ssector_residencia'";
    $sql .= ", sdireccion_residencia='$sdireccion_residencia'";
    $sql .= ", spunto_ref_residencia='$spunto_ref_residencia'";
    $sql .= ", bjefe_familia='$bjefe_familia'";
    $sql .= ", btiene_hijo='$btiene_hijo'";
    /*  $sql .= ", nhijos_menores18=$nhijos_menores18";
    $sql .= ", nhijos_mayores18=$nhijos_mayores18"; */
    $sql .= ", vehiculo_id='$vehiculo_id'";
    $sql .= ", bcarnet_patria='$bcarnet_patria'";
    $sql .= ", scodigo_carnet_patria='$scodigo_carnet_patria'";
    $sql .= ", sserial_carnet_patria='$sserial_carnet_patria'";
    $sql .= ", sobservaciones='$sobservaciones'";
    $sql .= " WHERE";
    $sql .= " ncedula='$ncedula';";

    /* echo $sql;
    die(); */

    if ($resultado = pg_query($conn, $sql)) {
        echo 'Actualización de datos exitosa';
    } else {
        echo 'No se pudo Actualizar la Información';
    }
} */