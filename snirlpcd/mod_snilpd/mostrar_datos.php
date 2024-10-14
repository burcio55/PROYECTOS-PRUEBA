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

    //CONSULTA LOS DATOS EN PUBLIC.PAIS

    $PG2 = "SELECT";
    $PG2 .= " *";
    $PG2 .= " FROM";
    $PG2 .= " public.pais";
    $PG2 .= " WHERE";
    $PG2 .= " benabled =";
    $PG2 .= " 'true'";
    $PG2 .= " ORDER BY";
    $PG2 .= " sdescripcion";
    $PG2 .= " ASC";
    $row2 = pg_query($conn, $PG2);
    echo ('<option value="-1">Seleccione</option>');

    while ($row = pg_fetch_assoc($row2)) {
        echo ('<option value="'.$row['id'].'">'.$row['sdescripcion'].'</option>');
    }

    echo " / ";

    //CONSULTA LOS DATOS EN PUBLIC.ENTIDAD

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

    echo " / ";

    //CONSULTA LOS DATOS EN PUBLIC.MUNICIPIO

    $PG2 = "SELECT";
    $PG2 .= " *";
    $PG2 .= " FROM";
    $PG2 .= " public.municipio";
    $PG2 .= " WHERE";
    $PG2 .= " nenabled =";
    $PG2 .= " '1'";
    $PG2 .= " ORDER BY";
    $PG2 .= " sdescripcion";
    $PG2 .= " ASC";
    $row2 = pg_query($conn, $PG2);
    echo ('<option value="-1">Seleccione</option>');

    while ($row = pg_fetch_assoc($row2)) {
        echo ('<option value="'.$row['nmunicipio'].'">'.$row['sdescripcion'].'</option>');
    }

    echo " / ";

    //CONSULTA LOS DATOS EN PUBLIC.PARROQUIA

    $PG2 = "SELECT";
    $PG2 .= " *";
    $PG2 .= " FROM";
    $PG2 .= " public.parroquia";
    $PG2 .= " WHERE";
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

    echo " / ";

    //CONSULTA LOS DATOS EN snirlpcd.persona

    $cedula = $_SESSION['ncedula'];

    $PG2 = "SELECT";
    $PG2 .= " *";
    $PG2 .= " FROM";
    $PG2 .= " snirlpcd.persona";
    $PG2 .= " WHERE";
    $PG2 .= " ncedula = ";
    $PG2 .= " '$cedula'";
    $PG2 .= " AND";
    $PG2 .= " benabled =";
    $PG2 .= " 'true'";
    $row2 = pg_query($conn, $PG2);
    $valor = pg_fetch_assoc($row2);

    $dfecha_nacimiento = $valor["dfecha_nacimiento"]; // Aquí recibes la Fecha de Nacimiento del usuario

    $nacimiento = new DateTime($dfecha_nacimiento); // Paja
    $ahora = new DateTime(date("Y-m-d")); // Paja X2
    $year = $ahora->diff($nacimiento); // Paja X3
    $edad = $year->y; // Resultado :D

    if($valor['snacionalidad'] == 'V'){
        $valor['snacionalidad'] = 'Venezolano';
    }else{
        $valor['snacionalidad'] = 'Extranjero';
    }

    echo $valor['snacionalidad']." / ".$valor['ssexo']." / ".$valor['dfecha_nacimiento']." / ".$valor['npais_nac_id']." / ".$valor['entidad_nac_id']." / ".$valor['estado_civil_id']." / ".$valor['stelefono_personal']." / ".$valor['stelefono_habitacion']." / ".$valor['npais_residencia_id']." / ".$valor['nentidad_residencia_id']." / ".$valor['nmunicipio_residencia_id']." / ".$valor['nparroquia_residencia_id']." / ".$valor['ssector_residencia']." / ".$valor['sdireccion_residencia']." / ".$valor['spunto_ref_residencia']." / ".$valor['bjefe_familia']." / ".$valor['btiene_hijo']." / ".$valor['nhijos_menores18']." / ".$valor['nhijos_mayores18']." / ".$valor['vehiculo_id']." / ".$valor['bcarnet_patria']." / ".$valor['scodigo_carnet_patria']." / ".$valor['sserial_carnet_patria']." / ".$valor['sobservaciones']." / ".$edad." / ".$valor['semail']." / ";

    // CONSULTA PARA LLENAR EL CAMPO, "POSEE VEHIVULOS"

    $PG2 = "SELECT";
    $PG2 .= " *";
    $PG2 .= " FROM";
    $PG2 .= " public.vehiculo";
    $PG2 .= " WHERE";
    $PG2 .= " benabled =";
    $PG2 .= " 'true'";
    $PG2 .= " ORDER BY";
    $PG2 .= " sdescripcion";
    $PG2 .= " ASC";
    $row2 = pg_query($conn, $PG2);
    echo ('<option value="-1">Seleccione</option>');

    while ($row = pg_fetch_assoc($row2)) {
        echo ('<option value="'.$row['id'].'">'.$row['sdescripcion'].'</option>');
    }

    echo" / ";

    // CONSULTA PARA LLENAR EL CAMPO, "ESTADO CIVIL"

    $PG2 = "SELECT";
    $PG2 .= " *";
    $PG2 .= " FROM";
    $PG2 .= " public.estado_civil";
    $PG2 .= " WHERE";
    $PG2 .= " benabled =";
    $PG2 .= " 'true'";
    $PG2 .= " ORDER BY";
    $PG2 .= " sdescripcion";
    $PG2 .= " ASC";
    $row2 = pg_query($conn, $PG2);
    echo ('<option value="-1">Seleccione</option>');

    while ($row = pg_fetch_assoc($row2)) {
        echo ('<option value="'.$row['id'].'">'.$row['sdescripcion'].'</option>');
    }

    echo" / ";

    // CONSULTA PARA LLENAR EL CAMPO, "REDES SOCIALES"

    $PG2 = "SELECT";
    $PG2 .= " *";
    $PG2 .= " FROM";
    $PG2 .= " public.redes_sociales";
    $PG2 .= " WHERE";
    $PG2 .= " benabled =";
    $PG2 .= " 'true'";
    $PG2 .= " ORDER BY";
    $PG2 .= " sdescripcion";
    $PG2 .= " ASC";
    $row2 = pg_query($conn, $PG2);
    echo ('<option value="-1">Seleccione</option>');

    while ($row = pg_fetch_assoc($row2)) {
        echo ('<option value="'.$row['id'].'">'.$row['sdescripcion'].'</option>');
    }

    echo " / ".$valor['sestado_nacionalidad_ext'];
?>