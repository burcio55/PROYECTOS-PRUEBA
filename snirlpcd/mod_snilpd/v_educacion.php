<?

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

//$conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass"); 
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

    $id = $persona["id"] . " ";
    $fecha_nacimiento = $persona["dfecha_nacimiento"];
    $ano_nac = substr($fecha_nacimiento, 0, 4);
}

// VARIABLES

$usuario = $_REQUEST['usuario'];
$nacademico = $_REQUEST['nacademico'];
$graduado = $_REQUEST['graduado'];
$titulo = $_REQUEST['titulo'];
$anio_graduacion = $_REQUEST['anio_graduacion'];
$instituto = $_REQUEST['instituto'];
$estatus = $_REQUEST['estatus'];
$ultimo_anio = $_REQUEST['ultimo_anio'];
$observaciones = $_REQUEST['observaciones'];

$verificar = $_REQUEST['verificar'];

if($verificar == 1){
    //CONSULTA LOS DATOS PARA QUE TE APAREZCA EN LA TABLA

    $PG2 = "SELECT";
    $PG2 .= " *";
    $PG2 .= " FROM";
    $PG2 .= " snirlpcd.persona_nivel_educativo";
    $PG2 .= " WHERE";
    $PG2 .= " persona_id =";
    $PG2 .= " '$id'";
    $PG2 .= " AND";
    $PG2 .= " benabled =";
    $PG2 .= " 'true'";
    $row = pg_query($conn, $PG2);

    if($row == ''){
        echo "1 / Debe llenar los campos para poder avanzar";
        die();
    }else{
        echo "2";
        die();
    }
}


// VALIDAR QUE CAMPOS NO ESTEN VACIOS
if ($observaciones == "") {
    $observaciones = 'ninguna';
}
/* if ($nacademico == -1) {
    echo '1 / Debe indicar cuál es su Nivel Educativo / #cbNivel_academico';
    die();
} else
if ($nacademico > 2) {
    if ($graduado == -1) {
        echo '1 / Debe responder a la pregunta: ¿Está Graduado? / #cbGraduado';
        die();
    }
}
if ($graduado == 1) {
    $graduado = 'true';
} else {
    $graduado = 'false';
}
if ($ultimo_anio == '') {
    $ultimo_anio = 0;
} */

// Validad el año de graduación

if ($graduado == 1) {
    $graduado = 'true';
} else {
    $graduado = 'false';
}
if ($ultimo_anio == '') {
    $ultimo_anio = 0;
}
if ($nacademico > 2) {
    if($graduado == 'true'){
        if ($titulo == '') {
            echo "1 / Debe indicar el Título Obtenido / #titulo";
            die();
        }
        if ($anio_graduacion == '') {
            echo '1 / Es obligatorio llenar el campo "Año de Graduación" / #anio_graduacion';
            die();
        }
        $anio_actual = date('Y');
        if ($anio_graduacion == '') {
            echo '1 / Es obligatorio llenar el campo "Año de Graduación" / #anio_graduacion';
            die();
        }
        if ($anio_graduacion > $anio_actual) {
            echo '1 / El Año de Graduación no puede ser superior al Año Actual / #anio_graduacion';
            die();
        } else
        if ($anio_graduacion < 1920) {
            echo '1 / El Año de Graduación no puede ser inferior al Año 1920 / #anio_graduacion';
            die();
        }else
        if ($anio_graduacion <= $ano_nac) {
            echo '1 / El Año de Graduación no puede ser inferior a tu Fecha de Nacimiento / #anio_graduacion';
            die();
        }
        if ($instituto == '') {
            echo '1 / Debe indicar el Nombre de la Institución Educativa / #instituto';
            die();
        }
    }else{
        if ($instituto == '') {
            echo '1 / Debe indicar el Nombre de la Institución Educativa / #instituto';
            die();
        }
        if($estatus == '-1'){
            echo '1 / Debe indicar el Estatus Académico Actual / #Estatus_academico';
            die();
        }
        if($ultimo_anio == ''){
            echo '1 / Debe indicar el Último año Cursado / #ultimo_anio';
            die();
        }else
        $anio_actual = date('Y');
        if ($ultimo_anio > $anio_actual) {
            echo '1 / El Último año Cursado no puede ser superior al Año Actual / #ultimo_anio';
            die();
        }else
        if ($ultimo_anio < 1920) {
            echo '1 / El Último año Cursado no puede ser inferior al Año 1920 / #ultimo_anio';
            die();
        }else
        if ($ultimo_anio <= $ano_nac) {
            echo '1 / El Último año Cursado no puede ser inferior a tu Fecha de Nacimiento / #ultimo_anio';
            die();
        }
    } 
}

$sesion = $id;

if ($usuario == '') {

    // INSERTAR DATOS

    $PG = "INSERT INTO snirlpcd.persona_nivel_educativo ";
    $PG .= "(";
    $PG .= "persona_id";
    $PG .= ", nivel_educativo_id";
    $PG .= ", bgraduado";
    $PG .= ", stitulo_obtenido";
    $PG .= ", dfecha_graduacion";
    $PG .= ", snombre_inst_educativa";
    $PG .= ", sestatus_academico";
    $PG .= ", nultimo_anno_cursado";
    $PG .= ", sobservaciones";
    $PG .= ", nusuario_creacion";
    $PG .= ")";
    $PG .= " VALUES ";
    $PG .= "(";
    $PG .= "'$id'";
    $PG .= ", '$nacademico'";
    $PG .= ", '$graduado'";
    $PG .= ", '$titulo'";
    $PG .= ", '$anio_graduacion'";
    $PG .= ", '$instituto'";
    $PG .= ", '$estatus'";
    $PG .= ", '$ultimo_anio'";
    $PG .= ", '$observaciones'";
    $PG .= ", '$sesion'";
    $PG .= ")";

    $valor = pg_query($conn, $PG);
} else {

    //MODIFICAR DATOS DE LA TABLA

    $PG = "UPDATE";
    $PG .= " snirlpcd.persona_nivel_educativo";
    $PG .= " SET";
    $PG .= " nivel_educativo_id ='$nacademico'";
    $PG .= ", bgraduado='$graduado'";
    $PG .= ", stitulo_obtenido='$titulo'";
    $PG .= ", dfecha_graduacion='$anio_graduacion'";
    $PG .= ", snombre_inst_educativa='$instituto'";
    $PG .= ", sestatus_academico='$estatus'";
    $PG .= ", nultimo_anno_cursado='$ultimo_anio'";
    $PG .= ", sobservaciones='$observaciones'";
    $PG .= ", nusuario_actualizacion='$sesion'";
    $PG .= " WHERE";
    $PG .= " id='$usuario';";

    $valor2 = pg_query($conn, $PG);
}

//CONSULTA LOS DATOS PARA QUE TE APAREZCA EN LA TABLA

$PG2 = "SELECT";
$PG2 .= " public.nivel_educativo.sdescripcion,";
$PG2 .= " persona_nivel_educativo.snombre_inst_educativa";
$PG2 .= " persona_nivel_educativo.id";
$PG2 .= " FROM";
$PG2 .= " snirlpcd.persona_nivel_educativo";
$PG2 .= " INNER JOIN";
$PG2 .= " nivel_educativo";
$PG2 .= " ON nivel_educativo.ID =";
$PG2 .= " persona_nivel_educativo.nivel_educativo_id";
$PG2 .= " WHERE";
$PG2 .= " persona_id =";
$PG2 .= " '$id'";
$PG2 .= " AND";
$PG2 .= " benabled =";
$PG2 .= " 'true'";
$row2 = pg_query($conn, $PG2);
$vuelta = pg_num_rows($row);

while ($row = pg_fetch_assoc($row2)) {
    echo ('<tr><td>' . $row['sdescripcion'] . '</td><td>' . $row['snombre_inst_educativa'] . '</td><td><input type="button" class="btn btn-secondary" style="border-radius: 30px; display: inline-flex;" value="Editar" onclick="modificar_conocimientos(' . $row['id'] . ');"><input type="button" class="btn btn-danger" style="border-radius: 30px;display: inline-flex;" value="Borrar" onclick="eliminar_conocimientos(' . $row['id'] . ');"></td></tr>');
}
