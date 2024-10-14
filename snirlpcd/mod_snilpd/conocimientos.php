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
$conocimientos = $_REQUEST['conocimientos'];
$dominio = $_REQUEST['dominio'];
$Observaciones = $_REQUEST['Observaciones'];
$valor = $_REQUEST['valor'];

if($valor == 1){
    $PG2 = "SELECT";
    $PG2 .= " brealizado_curso";
    $PG2 .= " FROM";
    $PG2 .= " snirlpcd.persona";
    $PG2 .= " WHERE";
    $PG2 .= " id =";
    $PG2 .= " '$id'";
    $PG2 .= " AND";
    $PG2 .= " benabled =";
    $PG2 .= " 'true'";
    $valor2 = pg_query($conn, $PG2);
    $row = pg_fetch_assoc($valor2);

    if($row['brealizado_curso'] == 'f'){
        echo "2 / datos llenado corectamente";
        die();
    }else{
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
        $vuelta = pg_fetch_assoc($valor3);

        if($vuelta == ''){
            echo "1 / Debe indicar si posee alguna Actividades de Capacitación";
            die();
        }
        echo "2 /";
        die();
    }
}

//VALIDACIONES
if ($Observaciones == '') {
    $Observaciones = 'ninguna';
}
if ($conocimientos != '') {
    if ($dominio == -1) {
        echo "1 / Debe completar el campo \"Dominio\" / #dominio";
        die();
    }
}
if ($dominio != -1) {
    if ($conocimientos == '') {
        echo "1 / Debe completar el campo \"Otros Conocimientos\" / #otros_conocimientos";
        die();
    }
}

if ($id_usuario != '0') {

    //MODIFICAR DATOS DE LA TABLA

    $PG = "UPDATE";
    $PG .= " snirlpcd.persona_habilidad_destreza";
    $PG .= " SET";
    $PG .= " snombre_otros_conocimientos ='$conocimientos'";
    $PG .= ", sdominio_conocimiento='$dominio'";
    $PG .= ", sobservaciones='$Observaciones'";
    $PG .= ", nusuario_actualizacion='$id'";
    $PG .= " WHERE";
    $PG .= " id='$id_usuario';";

    $valor2 = pg_query($conn, $PG);

    echo "2 / ";
} else {

    //INSERTAR DATOS EN LA TABLA

    $PG = "INSERT INTO snirlpcd.persona_habilidad_destreza ";
    $PG .= "(";
    $PG .= "persona_id";
    $PG .= ", snombre_otros_conocimientos";
    $PG .= ", sdominio_conocimiento";
    $PG .= ", sobservaciones";
    $PG .= ", nusuario_creacion";
    $PG .= ")";
    $PG .= " VALUES ";
    $PG .= "(";
    $PG .= "'$id'";
    $PG .= ", '$conocimientos'";
    $PG .= ", '$dominio'";
    $PG .= ", '$Observaciones'";
    $PG .= ", '$id'";
    $PG .= ")";

    $valor = pg_query($conn, $PG);
}

//SELECT PARA MOSTRAR LA TABLA

$PG2 = "SELECT";
$PG2 .= " *";
$PG2 .= " FROM";
$PG2 .= " snirlpcd.persona_habilidad_destreza";
$PG2 .= " WHERE";
$PG2 .= " persona_id =";
$PG2 .= " '$id'";
$PG2 .= " AND";
$PG2 .= " benabled =";
$PG2 .= " 'true'";

$valor2 = pg_query($conn, $PG2);
//$vuelta = pg_num_rows($valor2);
$i = 0;

$a = 20;
while ($row = pg_fetch_assoc($valor2)) {
    $i++;
    if ($row['sdominio_conocimiento'] == 1) {
        $row['sdominio_conocimiento'] = 'Bajo';
    } else if ($row['sdominio_conocimiento'] == 2) {
        $row['sdominio_conocimiento'] = 'Medio';
    } else if ($row['sdominio_conocimiento'] == 3) {
        $row['sdominio_conocimiento'] = 'Avanzado';
    }
    echo ('<tr><td tabindex="'.$a++.'">' . $i . '</td><td tabindex="'.$a++.'">' . $row['snombre_otros_conocimientos'] . '</td><td tabindex="'.$a++.'">' . $row['sdominio_conocimiento'] . '</td><td><input type="button" tabindex="'.$a++.'" class="btn btn-secondary" style="border-radius: 30px; display: inline-flex;" value="Editar" onclick="modificar_conocimientos(' . $row['id'] . ');"><input type="button" tabindex="'.$a++.'" class="btn btn-danger" style="border-radius: 30px;display: inline-flex;" value="Borrar" onclick="eliminar_conocimientos(' . $row['id'] . ');"></td></tr>');
}
