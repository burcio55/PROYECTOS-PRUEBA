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
    }
    catch(PDOException $error){
        $conn = $error;
        echo ("Error al conectar en la Base de Datos ".$error);
    } 

    if (isset($_SESSION['cedula'])) {

        $cedula = substr($_SESSION["cedula"], 1);

        $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
        $row = pg_query($conn, $consulta);
        $persona = pg_fetch_assoc($row);

        $id = $persona["id"] . " ";
    }

    // VARIABLES

    $nacademico = $_REQUEST['nacademico'];
    $graduado = $_REQUEST['graduado'];
    $titulo = $_REQUEST['titulo'];
    $anio_graduacion = $_REQUEST['anio_graduacion'];
    $instituto = $_REQUEST['instituto'];
    $estatus = $_REQUEST['estatus'];
    $ultimo_anio = $_REQUEST['ultimo_anio'];
    $observaciones = $_REQUEST['observaciones'];


    // VALIDAR QUE CAMPOS NO ESTEN VACIOS
    if($observaciones == ""){
        $observaciones = 'ninguna';
    }
    if($nacademico == -1 ){
        echo "Debe completar los campos obligatorios";
        die();
    }else if($nacademico > 2 ){
        if($graduado == -1){
            echo "Debe completar los campos obligatorios2";
            die();
        }
    }
    if($graduado == 1){
        $graduado = 'true';
    }else{
        $graduado = 'false';
    }
    if($ultimo_anio == ''){
        $ultimo_anio = 0;
    }

    $sesion = $id;

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

    $valor = pg_query($conn,$PG); 

    //echo $PG;  */

    //CONSULTA LOS DATOS PARA QUE TE APARESCA EN LA TABLA

    $PG2 = "SELECT";
    $PG2 .= " public.nivel_educativo.sdescripcion,";
    $PG2 .= " persona_nivel_educativo.snombre_inst_educativa";
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
        echo ('<tr><td>'.$row['sdescripcion'].'</td><td>'.$row['snombre_inst_educativa'].'</td><td></td></tr>');
    }

?>