<?php

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

    if (isset($_SESSION['cedula'])) {

        $cedula = substr($_SESSION["cedula"], 1);

        $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
        $row = pg_query($conn, $consulta);
        $persona = pg_fetch_assoc($row);

        $persona_id = $persona["id"];
    }

    //CONSULTA LOS DATOS PARA QUE TE APARESCA EN LA TABLA

    $PG2 = "SELECT";
    $PG2 .= " *";
    $PG2 .= " FROM";
    $PG2 .= " snirlpcd.persona_sit_ocupacional";
    $PG2 .= " WHERE";
    $PG2 .= " persona_id =";
    $PG2 .= " '$persona_id'";
    $PG2 .= " AND";
    $PG2 .= " benabled =";
    $PG2 .= " 'true'";
    $row2 = pg_query($conn, $PG2);
    $valor = pg_fetch_assoc($row2);

    if($valor == ''){
        echo "1 / ";
    }else{
        echo "2 / ";
        echo $valor['situacion_laboral_id'] . " / " . $valor['dfecha_sit_ocup'] . " / " . $valor['sdescripcion_ocup_det1']. " / " . $valor['sexperiencia1']. " / " . $valor['sdescripcion_ocup_det2']. " / " . $valor['sexperiencia2'];
    }

?>