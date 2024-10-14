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

    $PG = "SELECT";
    $PG .= " *";
    $PG .= " FROM";
    $PG .= " snirlpcd.persona_capacitacion";
    $PG .= " WHERE";
    $PG .= " id =";
    $PG .= " '$id'";
    $row = pg_query($conn, $PG);
    $valor = pg_fetch_assoc($row);

    if($valor['snombre_activ_capacitacion'] == 'ninguna'){
        $aux = 2;
    }else {
        $aux = 1;
    }
    if($valor['sobservaciones'] == 'ninguna'){
        $valor['sobservaciones'] = "";
    }

    echo $valor['id'] . " / " . $aux. " / " . $valor['categoria_curso_id'] . " / " . $valor['snombre_activ_capacitacion']. " / " . $valor['snombre_entidad_capacitadora']. " / " . $valor['sduracion_capacitacion']. " / " . $valor['sobservaciones'];
?>