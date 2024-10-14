<?php

    // DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS

     $host = "10.46.1.93";
     $dbname = "minpptrasse";
     $user = "postgres";
     $pass = "postgres";

    //CONEXION CON SNIRLPCD

    try {
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
    }
    catch(PDOException $error){
        $conn = $error;
        echo ("Error al conectar en la Base de Datos ".$error);
    } 

    // VARIABLES

    $id = $_REQUEST['id'];

    //SELEC PARA MOSTRAR SUS DATOS A LA PERSONA Y PUEDA MODIFICARLO

    $PG2 = "SELECT";
    $PG2 .= " *";
    $PG2 .= " FROM";
    $PG2 .= " snirlpcd.persona_habilidad_destreza";
    $PG2 .= " WHERE";
    $PG2 .= " id =";
    $PG2 .= " '$id'";
    $valor2 = pg_query($conn, $PG2);
    $valor = pg_fetch_assoc($valor2);

    echo $valor['id'] . " / " . $valor['snombre_otros_conocimientos'] . " / " . $valor['sdominio_conocimiento']. " / " . $valor['sobservaciones'];
?>