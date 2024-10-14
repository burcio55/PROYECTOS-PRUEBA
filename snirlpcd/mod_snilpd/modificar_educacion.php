<?php

    //VARIABLES PARA LA CONEXION CON SNIRLPCD

    $host = "10.46.1.93";
    $dbname = "minpptrasse";
    $user = "postgres";
    $pass = "postgres";

    //OBTENER DATOS DE LA SESION Y HACER UNA CONSULTA DE LOS DATOS DEL REGUISTRO
    //CONEXION CON SIRE

    /* session_start();
    include('../include/BD.php');
    $conn2 = Conexion::ConexionBD(); */

    //CONEXION CON SNIRLPCD

    //$conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass"); 
    try {
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
    }
    catch(PDOException $error){
        $conn = $error;
        echo ("Error al conectar en la Base de Datos ".$error);
    } 

    /* if (isset($_SESSION['cedula'])) {

        $cedula = substr($_SESSION["cedula"], 1);

        $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
        $row = pg_query($conn, $consulta);
        $persona = pg_fetch_assoc($row);

        $id = $persona["id"] . " ";
    } */

    //VARIABLES

    $id = $_REQUEST['id'];

    //CONSULTA LOS DATOS PARA QUE EL USUSARIO PUED MODIFICAR SUS DATOS

    $PG2 = "SELECT";
    $PG2 .= " *";
    $PG2 .= " FROM";
    $PG2 .= " snirlpcd.persona_nivel_educativo";
    $PG2 .= " WHERE";
    $PG2 .= " id = ";
    $PG2 .= " '$id'";
    $row2 = pg_query($conn, $PG2);
    $valor = pg_fetch_assoc($row2);
 
    echo $valor['id'] . " / " . $valor['nivel_educativo_id'] . " / " . $valor['bgraduado']. " / " . $valor['stitulo_obtenido']. " / " . $valor['dfecha_graduacion']. " / " . $valor['snombre_inst_educativa']. " / " . $valor['sestatus_academico']. " / " . $valor['nultimo_anno_cursado']. " / " . $valor['sobservaciones'];

?>