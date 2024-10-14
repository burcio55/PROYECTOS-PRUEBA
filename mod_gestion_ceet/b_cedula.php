<?
$accion = $_REQUEST["accion"];

if ($accion == 1) {

    // Verificar que el ususario no está registrado
    $host = "10.46.1.93";
    $dbname = "minpptrassi";
    $user = "postgres";
    $pass = "postgres";

    session_start();

    try {
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
    } catch (PDOException $error) {
        $conn = $error;
        echo ("Error al conectar en la Base de Datos " . $error);
    }

    $numcedula = $_REQUEST["numcedula"];
    /* echo " 1 / " . $numcedula; */

    $SQL = "SELECT cedula, primer_apellido, segundo_apellido, primer_nombre, segundo_nombre,nentidad_entidad 
        FROM public.personales WHERE nenabled = '1' AND cedula = '" . $numcedula . "' ";
    /*  echo " 1 / " . $SQL; */

    $row = pg_query($conn, $SQL);
    $cont = pg_num_rows($row);
    if ($cont > 0) {
        $valor = pg_fetch_assoc($row);
        $nombre = $valor['primer_nombre'] . " " . $valor['segundo_nombre'] . ", " . $valor['primer_apellido'] . " " . $valor['segundo_apellido'];
        echo "0 / " . $nombre;
        echo " / " . $valor['nentidad_entidad'];

        $SQL2 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $numcedula . "' AND rol_id >= '82' AND rol_id <= '83' AND nenabled = '1'";
        $row2 = pg_query($conn, $SQL2);
        $cont2 = pg_num_rows($row2);
        if ($cont2 > 0) {
            $valor2 = pg_fetch_assoc($row2);
            echo " / " . $valor2['rol_id'];
        } else {
            echo " / 1 / -1";
        }
    } else {
        echo " / 1 / Usuario no registrado en SIGLA";
    }
}/*  else
if ($accion == 2) {
    $host = "10.46.1.93";
    $dbname = "minpptrassi";
    $user = "postgres";
    $pass = "postgres";

    session_start();

    try {
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
    } catch (PDOException $error) {
        $conn = $error;
        echo ("Error al conectar en la Base de Datos " . $error);
    }

    // Inserción
    $nusuario_creacion = $_SESSION['elecciones']->ncedula;
    $numcedula = $_REQUEST["numcedula"];
    $nombre = $_REQUEST["snombre_apellidos"];
    $ntelefono_movil = strtoupper($_REQUEST["ntelefono_movil"]);
    $sestado = strtoupper($_REQUEST["sestado"]);
    $smunicipio = strtoupper($_REQUEST["smunicipio"]);
    $sparroquia = strtoupper($_REQUEST["sparroquia"]);
    $scentro_votacion = strtoupper($_REQUEST["scentro_votacion"]);
    $sgenero = strtoupper($_REQUEST["sgenero"]);
    $dependencia = strtoupper($_REQUEST["dependencia"]);

    if ($sgenero == 'Femenino') {
        $sexo = 'F';
    } else {
        $sexo = 'M';
    }

    // Validar que no esté registrado en Base de Datos

    $SQL = "SELECT * FROM ";
    $SQL .= "elecciones_2021.trabajadores ";
    $SQL .= "where ncedula = '$numcedula';";

    $row = pg_query($conn, $SQL);
    $consulta = pg_fetch_assoc($row);

    if ($consulta == '') {

        $SQL2 = "INSERT INTO";
        $SQL2 .= " elecciones_2021.trabajadores";
        $SQL2 .= " (";
        $SQL2 .= " ncedula,";
        $SQL2 .= " snombres_apellidos,";
        $SQL2 .= " ntelefono_movil,";
        $SQL2 .= " sestado,";
        $SQL2 .= " smunicipio,";
        $SQL2 .= " sparroquia,";
        $SQL2 .= " scentro_votacion,";
        $SQL2 .= " nusuario_creacion,";
        $SQL2 .= " sgenero,";
        $SQL2 .= " sdependencia,";
        $SQL2 .= " estatus_electoral_id";
        $SQL2 .= ")";
        $SQL2 .= " VALUES";
        $SQL2 .= " (";
        $SQL2 .= " '$numcedula',";
        $SQL2 .= " '$nombre',";
        $SQL2 .= " '$ntelefono_movil',";
        $SQL2 .= " '$sestado',";
        $SQL2 .= " '$smunicipio',";
        $SQL2 .= " '$sparroquia',";
        $SQL2 .= " '$scentro_votacion',";
        $SQL2 .= " '$nusuario_creacion',";
        $SQL2 .= " '$sexo',";
        $SQL2 .= " '$dependencia',";
        $SQL2 .= " '1'";
        $SQL2 .= ");";

        if ($resultado = pg_query($conn, $SQL2)) {
            echo "9 / Se agregó correctamente el Trabajador";
            die();
        } else {
            echo "1 / Falló la inserción, razón: " . $SQL2;
            die();
        }
    } else {
        echo "1 / Ususario ya está registrado ";
    }
} */
