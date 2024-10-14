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

    //VARIABLE

    $id = $_REQUEST['id'];

    //MODIFICAR DATOS PARA ELIMINACIÓN VISAUL DE DATOS

    $PG = "UPDATE";
    $PG .= " snirlpcd.persona_redes_sociales";
    $PG .= " SET";
    $PG .= " benabled='false'";
    $PG .= " WHERE";
    $PG .= " id='$id';";

    $valor2 = pg_query($conn, $PG); 

    //SELECT PARA LLENAR LA TABLA

    $PG2 = "SELECT";
    $PG2 .= " public.redes_sociales.sdescripcion,";
    $PG2 .= " snirlpcd.persona_redes_sociales.snombre,";
    $PG2 .= " snirlpcd.persona_redes_sociales.id";
    $PG2 .= " FROM";
    $PG2 .= " snirlpcd.persona_redes_sociales";
    $PG2 .= " INNER JOIN";
    $PG2 .= " redes_sociales";
    $PG2 .= " ON redes_sociales.id =";
    $PG2 .= " persona_redes_sociales.redes_sociales_id";
    $PG2 .= " WHERE";
    $PG2 .= " persona_redes_sociales.persona_id =";
    $PG2 .= " '$persona_id'";
    $PG2 .= " AND";
    $PG2 .= " persona_redes_sociales.benabled =";
    $PG2 .= " 'true'";

    $valor3 = pg_query($conn, $PG2);
    //$vuelta = pg_num_rows($valor3);
    $i = 0;

    while ($row = pg_fetch_assoc($valor3)) {
        $i++;
        echo ('<tr><td>' . $i . '</td><td>' . $row['sdescripcion'] . '</td><td>' . $row['snombre'] . '</td><td><input type="button" class="btn btn-secondary" style="border-radius: 30px; display: inline-flex;" value="Editar" onclick="editar_red_social(' . $row['id'] . ')"><input type="button" class="btn btn-danger" style="border-radius: 30px;display: inline-flex;" value="Borrar" onclick="eliminar_red_social(' . $row['id'] . ')"></td></tr>');
    }
?>