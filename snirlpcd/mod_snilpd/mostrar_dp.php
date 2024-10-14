<?php

    session_start();

    // DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS

    $host = "10.46.1.93";
    $dbname = "minpptrasse";
    $user = "postgres";
    $pass = "postgres";

    //CONEXION CON SNIRLPCD

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
    
        $id = $persona["id"];
    }

?>