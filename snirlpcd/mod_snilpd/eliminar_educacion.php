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
    }
    catch(PDOException $error){
        $conn = $error;
        echo ("Error al conectar en la Base de Datos ".$error);
    } 

    //OBTENER DATOS DE LA PERSONA Y VALIDANDO CON LA TABLA PERSONA EN EL ESQUEMA SNIRLPCD UBICADO EN LA BASE DE DATOS 
    //MINPPTRASSE   

    if (isset($_SESSION['cedula'])) {

        $cedula = substr($_SESSION["cedula"], 1);

        $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
        $row = pg_query($conn, $consulta);
        $persona = pg_fetch_assoc($row);

        $id_usuario = $persona["id"] . " ";
    }

    // VARIABLES

    $id = $_REQUEST['id'];

    //SELEC PARA MOSTRAR SUS DATOS A LA PERSONA Y PUEDA MODIFICARLO

    $PG = "UPDATE";
    $PG .= " snirlpcd.persona_nivel_educativo";
    $PG .= " SET";
    $PG .= " benabled ='False'";
    $PG .= " WHERE";
    $PG .= " id='$id';";

    $valor2 = pg_query($conn,$PG);

    //SELECT PARA ACTUALIZAR LA TABLA

    $PG2 = "SELECT";
    $PG2 .= " public.nivel_educativo.sdescripcion,";
    $PG2 .= " persona_nivel_educativo.snombre_inst_educativa,";
    $PG2 .= " persona_nivel_educativo.id";
    $PG2 .= " FROM";
    $PG2 .= " snirlpcd.persona_nivel_educativo";
    $PG2 .= " INNER JOIN";
    $PG2 .= " nivel_educativo";
    $PG2 .= " ON nivel_educativo.ID =";
    $PG2 .= " persona_nivel_educativo.nivel_educativo_id";
    $PG2 .= " WHERE";
    $PG2 .= " persona_nivel_educativo.persona_id =";
    $PG2 .= " '$id_usuario'";
    $PG2 .= " AND";
    $PG2 .= " persona_nivel_educativo.benabled =";
    $PG2 .= " 'true'";
    $row2 = pg_query($conn, $PG2);
    $vuelta = pg_num_rows($row);

    //echo $PG2;

    while ($row = pg_fetch_assoc($row2)) {
        echo ('<tr><td>'.$row['sdescripcion'].'</td><td>'.$row['snombre_inst_educativa'].'</td><td><input type="button" class="btn btn-secondary" style="border-radius: 30px; display: inline-flex;" value="Editar" onclick="modificar_educacion('.$row['id'].');"><input type="button" class="btn btn-danger" style="border-radius: 30px;display: inline-flex;" value="Borrar" onclick="eliminar_educacion('.$row['id'].');"></td></tr>');
    }
?>