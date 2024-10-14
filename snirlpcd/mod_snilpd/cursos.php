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

//OBTENER DATOS DE LA PERSONA Y VALIDANDO CON LA TABLA PERSONA EN EL ESQUEMA SNIRLPCD UBICADO EN LA BASE DE DATOS 
//MINPPTRASSE   

if (isset($_SESSION['cedula'])) {

    $cedula = substr($_SESSION["cedula"], 1);

    $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
    $row = pg_query($conn, $consulta);
    $persona = pg_fetch_assoc($row);

    $id = $persona["id"] . " ";
}

// VARIABLES

$id_usuario = $_REQUEST['id_usuario'];
$cbCapacitacion = $_REQUEST['cbCapacitacion'];
$cbCurso_categoria = $_REQUEST['cbCurso_categoria'];
$nombre_actividad = $_REQUEST['nombre_actividad'];
$nombre_entidad = $_REQUEST['nombre_entidad'];
$Duracion_curso = $_REQUEST['Duracion_curso'];
$Observaciones_curso = $_REQUEST['Observaciones_curso'];

//VALIDACIONES

if ($id == '') {
    echo "1 / Debe llenar sus datos personales para continuar";
    die();
}
if ($cbCapacitacion == -1) {
    echo "1 / Debe completar los campos obligatorios / #cbCapacitacion";
    die();
} else if ($cbCapacitacion == 1) {
    $cbCapacitacion = 'true';
} else {
    $cbCapacitacion = 'false';
}

if($cbCapacitacion == 'false'){

    $pg = "UPDATE snirlpcd.persona";
    $pg .= " SET";
    $pg .= " brealizado_curso = $cbCapacitacion";
    $pg .= " WHERE";
    $pg .= " id = '$id'";

    $valor = pg_query($conn, $pg);
    echo "1 / Dato actualizado correctamente";
    die();
}else{
    if ($cbCurso_categoria == 0) {
        /* $nombre_actividad = 'ninguna';
        $nombre_entidad = 'ninguna';
        $Duracion_curso = '0';
        $cbCurso_categoria = -1; */
        echo "1 / Debe seleccionar la Categoría de la Actividad / #cbCurso_categoria";
        die();
    }
    if ($nombre_actividad == '') {
        echo "1 / Debe indicar el Nombre de la Actividad Capacitadora / #nombre_actividad";
        die();
    }
    if ($nombre_entidad == '') {
        echo "1 / Debe indicar el Nombre de la Entidad Capacitadora / #nombre_entidad";
        die();
    }
    if ($Duracion_curso == '') {
        echo "1 / Debe indicar la Duración en Horas de la Actividad Capacitadora / #Duracion_curso";
        die();
    }

    if ($Observaciones_curso == '') {
        $Observaciones_curso = 'ninguna';
    }


    if ($id_usuario != '0') {

        //MODIFICAR DATOS DE LA TABLA

        $PG = "UPDATE";
        $PG .= " snirlpcd.persona_capacitacion";
        $PG .= " SET";
        $PG .= " categoria_curso_id ='$cbCurso_categoria'";
        $PG .= ", snombre_activ_capacitacion='$nombre_actividad'";
        $PG .= ", snombre_entidad_capacitadora='$nombre_entidad'";
        $PG .= ", sduracion_capacitacion='$Duracion_curso'";
        $PG .= ", sobservaciones='$Observaciones_curso'";
        $PG .= ", nusuario_actualizacion='$id'";
        $PG .= " WHERE";
        $PG .= " id='$id_usuario';";

        $valor2 = pg_query($conn, $PG);
    } else {

        //MODIFICAR SI LA PERSONA REALIZO UNA ACTIVIDAD DE CAPACITACIÓN

        $pg = "UPDATE snirlpcd.persona";
        $pg .= " SET";
        $pg .= " brealizado_curso = $cbCapacitacion";
        $pg .= " WHERE";
        $pg .= " id = '$id'";

        $valor = pg_query($conn, $pg);

        //INSERTAR DATOS EN LA TABLA

        $PG = "INSERT INTO snirlpcd.persona_capacitacion ";
        $PG .= "(";
        $PG .= "persona_id";
        $PG .= ", categoria_curso_id";
        $PG .= ", snombre_activ_capacitacion";
        $PG .= ", snombre_entidad_capacitadora";
        $PG .= ", sduracion_capacitacion";
        $PG .= ", sobservaciones";
        $PG .= ", nusuario_creacion";
        $PG .= ")";
        $PG .= " VALUES ";
        $PG .= "(";
        $PG .= "'$id'";
        $PG .= ", '$cbCurso_categoria'";
        $PG .= ", '$nombre_actividad'";
        $PG .= ", '$nombre_entidad'";
        $PG .= ", '$Duracion_curso'";
        $PG .= ", '$Observaciones_curso'";
        $PG .= ", '$id'";
        $PG .= ")";

        $valor2 = pg_query($conn, $PG);
    }

    //SELECT PARA LLENAR LA TABLA

    $PG2 = "SELECT";
    $PG2 .= " *";
    $PG2 .= " FROM";
    $PG2 .= " snirlpcd.persona_capacitacion";
    $PG2 .= " WHERE";
    $PG2 .= " persona_id =";
    $PG2 .= " '$id'";
    $PG2 .= " AND";
    $PG2 .= " benabled =";
    $PG2 .= " 'true'";

    $valor3 = pg_query($conn, $PG2);
    $vuelta = pg_num_rows($valor3);
    $i = 0;


    while ($row = pg_fetch_assoc($valor3)) {
        $i++;
        echo ('<tr><td>' . $i . '</td><td>' . $row['snombre_activ_capacitacion'] . '</td><td>' . $row['snombre_entidad_capacitadora'] . '</td><td>' . $row['sduracion_capacitacion'] . '</td><td><input type="button" class="btn btn-secondary" style="border-radius: 30px; display: inline-flex;" value="Editar" onclick="modificar_curso(' . $row['id'] . ');"><input type="button" class="btn btn-danger" style="border-radius: 30px;display: inline-flex;" value="Borrar" onclick="eliminar_curso(' . $row['id'] . ');"></td></tr>');
    }
}
