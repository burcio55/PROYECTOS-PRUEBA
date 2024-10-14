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

    //ACTUALIZAR DATOS EN LA TABLA PERSONA

    $PG = "UPDATE";
    $PG .= " snirlpcd.persona_exp_laboral";
    $PG .= " SET";
    $PG .= " benabled = 'false'";
    $PG .= " WHERE";
    $PG .= " id='$id';";

    $valor2 = pg_query($conn,$PG);

    //ACTUALIZAR LOS DATOS DE LA TABLA

    $PG2 = "SELECT";
    $PG2 .= " *";
    $PG2 .= " FROM";
    $PG2 .= " snirlpcd.persona_exp_laboral";
    $PG2 .= " WHERE";
    $PG2 .= " persona_id =";
    $PG2 .= " '$persona_id'";
    $PG2 .= " AND";
    $PG2 .= " benabled =";
    $PG2 .= " 'true'";
    $row2 = pg_query($conn, $PG2);
    $vuelta = pg_num_rows($row);

    while ($row = pg_fetch_assoc($row2)) {
        echo ('<tr><td>'.$row['scargo'].'</td><td>'.$row['snombre_entidad_trabajo'].'</td><td>'.$row['srif'].'</td><td>'.$row['dfecha_ingreso'].'</td><td><input type="button" class="btn btn-secondary" style="border-radius: 30px; display: inline-flex;" value="Editar" onclick="editar_experiencia('.$row['id'].');"><input type="button" class="btn btn-danger" style="border-radius: 30px;display: inline-flex;" value="Borrar" onclick="eliminar_experiencia('.$row['id'].');"></td></tr>');
    }
?>