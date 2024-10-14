<?php

    //VARIABLES PARA LA CONEXION CON LA BASE DE DATOS

    $host = "10.46.1.93";
    $dbname = "minpptrasse";
    $user = "postgres";
    $pass = "postgres";

    $host2 = "10.46.1.93";
    $dbname2 = "entes";
    $user2 = "postgres";
    $pass2 = "postgres";

    //CONEXION CON MINPPTRASSE

    try {
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
    } catch (PDOException $error) {
        $conn = $error;
        echo ("Error al conectar en la Base de Datos " . $error);
    }

    //CONEXION CON ENTES

    try {
        $conn2 = pg_connect("host=$host2 port=5432 dbname=$dbname2 user=$user2 password=$pass2");
    } catch (PDOException $error) {
        $conn2 = $error;
        echo ("Error al conectar en la Base de Datos " . $error);
    }

    //RECIBIR VARIABLES

    $nacionalidad = $_REQUEST['nacionalidad'];
    $cedula = $_REQUEST['cedula'];

    echo $nacionalidad.$cedula;

?>