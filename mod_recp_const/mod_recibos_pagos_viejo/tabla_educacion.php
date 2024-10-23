<?php
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

    //$conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass"); 
    try {
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
    }
    catch(PDOException $error){
        $conn = $error;
        echo ("Error al conectar en la Base de Datos ".$error);
    } 

    if (isset($_SESSION['cedula'])) {

        $cedula = substr($_SESSION["cedula"], 1);

        $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
        $row = pg_query($conn, $consulta);
        $persona = pg_fetch_assoc($row);

        $id = $persona["id"] . " ";
    }

    $PG2 = "SELECT";
    $PG2 .= " public.nivel_educativo.sdescripcion,";
    $PG2 .= " persona_nivel_educativo.snombre_inst_educativa";
    $PG2 .= " FROM";
    $PG2 .= " snirlpcd.persona_nivel_educativo";
    $PG2 .= " INNER JOIN";
    $PG2 .= " nivel_educativo";
    $PG2 .= " ON nivel_educativo.ID =";
    $PG2 .= " persona_nivel_educativo.nivel_educativo_id";
    $PG2 .= " WHERE";
    $PG2 .= " persona_nivel_educativo.persona_id =";
    $PG2 .= " '$id'";
    $PG2 .= " AND";
    $PG2 .= " persona_nivel_educativo.benabled =";
    $PG2 .= " 'true'";
    $row2 = pg_query($conn, $PG2);
    $vuelta = pg_num_rows($row);

    //echo $PG2;

     while ($row = pg_fetch_assoc($row2)) {
        echo ('<tr><td>'.$row['sdescripcion'].'</td><td>'.$row['snombre_inst_educativa'].'</td><td></td></tr>');
    }
?>