<?php

// DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

//OBTENER DATOS DE LA SESION Y HACER UNA CONSULTA DE LOS DATOS DEL REGUISTRO
//CONEXION CON SIRE

session_start();

//CONEXION CON SNIRLPCD

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

if (isset($_SESSION['cedula'])) {

    $cedula = substr($_SESSION["cedula"], 1);

    $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
    $row = pg_query($conn, $consulta);
    $persona = pg_fetch_assoc($row);

    $persona_id = $persona["id"];
}

//VARIABLES
$experiencia = $_REQUEST['experiencia'];

/* echo "2 / $valor";
die();
 */

if ($experiencia == '1') {
    $PG2 = "UPDATE";
    $PG2 .= " snirlpcd.persona";
    $PG2 .= " SET";
    $PG2 .= " nexperiencia_laboral = '$experiencia'";
    $PG2 .= " WHERE";
    $PG2 .= " id='$persona_id';";

    $valor3 = pg_query($conn, $PG2);

    $PG = "SELECT";
    $PG .= " *";
    $PG .= " FROM";
    $PG .= " snirlpcd.persona_exp_laboral";
    $PG .= " WHERE";
    $PG .= " persona_id =";
    $PG .= " '$persona_id'";
    $PG .= " AND";
    $PG .= " benabled =";
    $PG .= " 'true'";
    $row2 = pg_query($conn, $PG);
    $valor = pg_fetch_assoc($row2);

    if($valor == ''){
        echo "1 / Debe llenar la tabla con al menos un dato";
    }else{
        echo "3 / Se ha guardado sus datos exitosamente";
    }

    

}else 
if ($experiencia == '2'){
    $PG = "UPDATE";
    $PG .= " snirlpcd.persona";
    $PG .= " SET";
    $PG .= " bexperiencia_laboral = '$experiencia'";
    $PG .= " WHERE";
    $PG .= " id='$persona_id';";

    $valor2 = pg_query($conn, $PG);

    echo "3 / Se ha guardado sus datos exitosamente";
}