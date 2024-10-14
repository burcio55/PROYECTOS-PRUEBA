<?php

//VARIABLES PARA LA CONEXION CON SNIRLPCD

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

//OBTENER DATOS DE LA SESION Y HACER UNA CONSULTA DE LOS DATOS DEL REGUISTRO
//CONEXION CON SIRE

session_start();

//CONEXION CON SNIRLPCD

//$conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass"); 
try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("1 / Error al conectar en la Base de Datos " . $error);
}

if (isset($_SESSION['cedula'])) {

    $cedula = substr($_SESSION["cedula"], 1);

    $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
    $row = pg_query($conn, $consulta);
    $persona = pg_fetch_assoc($row);

    $id = $persona["id"];
    $fecha_nac = $persona["dfecha_nacimiento"];
}

//VARIABLES

$situacion_laboral = $_REQUEST['situacion_laboral'];
$fecha = $_REQUEST['fecha_sit_ocup'];
$ocupacion1 = $_REQUEST['ocupacion1'];
$experiencia1 = $_REQUEST['experiencia1'];
$ocupacion2 = $_REQUEST['ocupacion2'];
$experiencia2 = $_REQUEST['experiencia2'];

//VALIDACIONES

$fecha_actual = date('Y-m-d');
if ($situacion_laboral != '-1') {
    if ($fecha > 0) {
        if ($fecha > $fecha_actual) {
            echo '1 / La Fecha de su situación no puede ser superior a la Fecha Actual / #f_situacion';
            die();
        } else
        if ($fecha < $fecha_nac) {
            echo '1 / La Fecha de su situación no puede ser inferior a su año de Nacimiento / #f_situacion';
            die();
        }

        /* if ($situacion_laboral == '-1' || $ocupacion1 == '-1' || $experiencia1 == '-1') {
            echo "1 / Debe completar los campos obligatorios / #";
            die();
        } */
    }
}
/* if ($situacion_laboral == '-1') {
    echo "1 / Debe Especificar su Situación Ocupacional / #cbSituacion_afiliado";
    die();
}
if ($fecha == '') {
    echo "1 / Debe indicar ¿Desde cuando está en esa situación / #f_situacion";
    die();
}
if ($ocupacion1 == '') {
    echo "1 / Debe indicar al menos una Ocupación / #cbOcupacion5_interes_1";
    die();
}
if ($experiencia1 == '-1') {
    echo "1 / Debe responder a la pregunta: ¿Tiene Experiencia Laboral? / #cbExperiencia_1";
    die();
}*/
if ($ocupacion2 != '' && $experiencia2 == '') {
    echo "1 / Debe indicar si posee experiencia / #cbExperiencia_2";
    die();
} else
if ($ocupacion2 == '' && $experiencia2 != '') {
    echo "1 / Debe indicar su ocupación / #cbOcupacion5_interes2";
    die();
}

//VERIFICAR SI HAY DATOS DEL USUARIO EN LA TABLA

$PG2 = "SELECT";
$PG2 .= " *";
$PG2 .= " FROM";
$PG2 .= " snirlpcd.persona_sit_ocupacional";
$PG2 .= " WHERE";
$PG2 .= " persona_id = ";
$PG2 .= " '$id'";
$PG2 .= " AND";
$PG2 .= " benabled = ";
$PG2 .= " 'true' ";
$row2 = pg_query($conn, $PG2);
$valor = pg_fetch_assoc($row2);

if ($valor == '') {

    //INSERTAR DATOS EN LA TABLA

    $PG = "INSERT INTO snirlpcd.persona_sit_ocupacional ";
    $PG .= "(";
    $PG .= "persona_id";
    $PG .= ", situacion_laboral_id";
    $PG .= ", dfecha_sit_ocup";
    $PG .= ", sdescripcion_ocup_det1";
    $PG .= ", sexperiencia1";
    $PG .= ", sdescripcion_ocup_det2";
    $PG .= ", sexperiencia2";
    $PG .= ", nusuario_creacion";
    $PG .= ")";
    $PG .= " VALUES ";
    $PG .= "(";
    $PG .= "'$id'";
    $PG .= ", '$situacion_laboral'";
    $PG .= ", '$fecha'";
    $PG .= ", '$ocupacion1'";
    $PG .= ", '$experiencia1'";
    $PG .= ", '$ocupacion2'";
    $PG .= ", '$experiencia2'";
    $PG .= ", '$id'";
    $PG .= ")";

    if ($valor = pg_query($conn, $PG)) {
        echo "2 / Se actualizó sus datos exitosamente";
    } else {
        echo "1 / Se presentó un error, intente nuevamente";
    }
} else {

    //MODIFICAR DATOS DE LA TABLA

    $PG = "UPDATE";
    $PG .= " snirlpcd.persona_sit_ocupacional";
    $PG .= " SET";
    $PG .= " situacion_laboral_id ='$situacion_laboral'";
    $PG .= ", dfecha_sit_ocup='$fecha'";
    $PG .= ", sdescripcion_ocup_det1='$ocupacion1'";
    $PG .= ", sexperiencia1='$experiencia1'";
    $PG .= ", sdescripcion_ocup_det2='$ocupacion2'";
    $PG .= ", sexperiencia2='$experiencia2'";
    $PG .= ", nusuario_actualizacion='$id'";
    $PG .= " WHERE";
    $PG .= " persona_id='$id';";

    if ($valor = pg_query($conn, $PG)) {
        echo "2 / Se actualizó sus datos exitosamente";
    } else {
        echo "1 / Se presentó un error, intente nuevamente";
    }
}

    //echo $situacion_laboral ." / ". $fecha ." / ". $ocupacion1." / ". $experiencia1 ." / ". $ocupacion2 ." / ". $experiencia2;
