<?php

    // DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS

    $host = "10.46.1.93";
    $dbname = "minpptrasse";
    $user = "postgres";
    $pass = "postgres";

    session_start();

    //CONEXION CON SNIRLPCD
 
    try {
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
    } catch (PDOException $error) {
        $conn = $error;
        echo ("Error al conectar en la Base de Datos " . $error);
    }

    $accion = $_REQUEST['accion'];

    if($accion == '1'){
        $pais = $_REQUEST['pais'];
        
        $PG2 = "SELECT";
        $PG2 .= " *";
        $PG2 .= " FROM";
        $PG2 .= " public.entidad";
        $PG2 .= " WHERE";
        $PG2 .= " nenabled =";
        $PG2 .= " '1'";
        $PG2 .= " ORDER BY";
        $PG2 .= " sdescripcion";
        $PG2 .= " ASC";
        $row2 = pg_query($conn, $PG2);
        echo ('<option value="-1">Seleccione</option>');

        while ($row = pg_fetch_assoc($row2)) {
            echo ('<option value="'.$row['nentidad'].'">'.$row['sdescripcion'].'</option>');
        }
    }
    if($accion == '2'){
        $estado = $_REQUEST['estado'];
        
        $PG2 = "SELECT";
        $PG2 .= " *";
        $PG2 .= " FROM";
        $PG2 .= " public.municipio";
        $PG2 .= " WHERE";
        $PG2 .= " nentidad = ";
        $PG2 .= " '$estado'";
        $PG2 .= " AND";
        $PG2 .= " nenabled =";
        $PG2 .= " '1'";
        $PG2 .= " ORDER BY";
        $PG2 .= " sdescripcion";
        $PG2 .= " ASC";
        $row2 = pg_query($conn, $PG2);
        $i = 0;
        echo ('<option value="-1">Seleccione</option>');

        while ($row = pg_fetch_assoc($row2)) {
            $i++;
            echo ('<option value="'.$row['nmunicipio'].'">'.$row['sdescripcion'].'</option>');
            $municipio = $row['nmunicipio'];
        }
        if($i == '1'){
            echo " / ";

            $PG = "SELECT";
            $PG .= " *";
            $PG .= " FROM";
            $PG .= " public.parroquia";
            $PG .= " WHERE";
            $PG .= " nmunicipio = ";
            $PG .= " '$municipio'";
            $PG .= " AND";
            $PG .= " nenabled =";
            $PG .= " '1'";
            $PG2 .= " ORDER BY";
            $PG2 .= " sdescripcion";
            $PG2 .= " ASC";
            $row = pg_query($conn, $PG);
            echo ('<option value="-1">Seleccione</option>');

            while ($row3 = pg_fetch_assoc($row)) {
                echo ('<option value="'.$row3['nparroquia'].'">'.$row3['sdescripcion'].'</option>');
            }
        }
    }
    if($accion == '3'){
        $municipio = $_REQUEST['municipio'];
        
        $PG2 = "SELECT";
        $PG2 .= " *";
        $PG2 .= " FROM";
        $PG2 .= " public.parroquia";
        $PG2 .= " WHERE";
        $PG2 .= " nmunicipio = ";
        $PG2 .= " '$municipio'";
        $PG2 .= " AND";
        $PG2 .= " nenabled =";
        $PG2 .= " '1'";
        $PG2 .= " ORDER BY";
        $PG2 .= " sdescripcion";
        $PG2 .= " ASC";
        $row2 = pg_query($conn, $PG2);
        echo ('<option value="-1">Seleccione</option>');

        while ($row = pg_fetch_assoc($row2)) {
            echo ('<option value="'.$row['nparroquia'].'">'.$row['sdescripcion'].'</option>');
        }
    }
?>