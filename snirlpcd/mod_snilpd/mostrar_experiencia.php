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

    //CONSULTA LOS DATOS PARA QUE TE APARESCA EN LA TABLA

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
    $vuelta = pg_num_rows($row2);

    /* if($vuelta == ''){
        echo "1 / ";
    }else{
        echo "2 / ";
    } */

    $PG = "SELECT";
    $PG .= " *";
    $PG .= " FROM";
    $PG .= " snirlpcd.persona";
    $PG .= " WHERE";
    $PG .= " id =";
    $PG .= " '$persona_id'";
    $PG .= " AND";
    $PG .= " benabled =";
    $PG .= " 'true'";
    $aux = pg_query($conn, $PG);
    $valor = pg_fetch_assoc($aux);

    $tab = 22;

    echo "2 / ";

    while ($row = pg_fetch_assoc($row2)) {
        $i++;
        $tab1 = ($tab*$i)+1;
        $tab2 = ($tab*$i)+2;
        $tab3 = ($tab*$i)+3;
        $tab4 = ($tab*$i)+4;
        $tab5 = ($tab*$i)+5;
        $tab6 = ($tab*$i)+6;
        echo ('<tr><td tabindex="'.$tab1.'" aria-label="'.$row['scargo'].'">'.$row['scargo'].'</td><td tabindex="'.$tab2.'" aria-label="'.$row['snombre_entidad_trabajo'].'">'.$row['snombre_entidad_trabajo'].'</td><td tabindex="'.$tab3.'" aria-label="'.$row['srif'].'">'.$row['srif'].'</td><td tabindex="'.$tab4.'" aria-label="'.$row['dfecha_ingreso'].'">'.$row['dfecha_ingreso'].'</td><td><input type="button" class="btn btn-secondary" tabindex="'.$tab5.'" aria-label="Editar los Datos" style="border-radius: 30px; display: inline-flex;" value="Editar" onclick="editar_experiencia('.$row['id'].');"><input type="button" class="btn btn-danger" tabindex="'.$tab6.'" aria-label="Eliminar los Datos" style="border-radius: 30px;display: inline-flex;" value="Borrar" onclick="eliminar_experiencia('.$row['id'].');"></td></tr>');
    }

    echo " / ".$valor['nexperiencia_laboral']." / $tab6 / $tab6+1";