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

    //VARIABLES

    $id = $_REQUEST['id'];

    //CONSULTA LOS DATOS PARA LLENAR LOS CAMPOS

    $PG2 = "SELECT";
    $PG2 .= " *";
    $PG2 .= " FROM";
    $PG2 .= " snirlpcd.persona_exp_laboral";
    $PG2 .= " WHERE";
    $PG2 .= " id =";
    $PG2 .= " '$id'";
    $row2 = pg_query($conn, $PG2);
    $valor = pg_fetch_assoc($row2);

    echo $valor['id'] . " / " . $valor['srif'] . " / " . $valor['snombre_entidad_trabajo']. " / " . $valor['sector_empleo_id']. " / " . $valor['actividad_eco_cod']. " / " . $valor['stelefono_contacto']. " / " . $valor['scargo']. " / " . $valor['dfecha_ingreso']. " / " . $valor['stipo_relacion']. " / " . $valor['dfecha_egreso']. " / " . $valor['sotra_habilidades'];
