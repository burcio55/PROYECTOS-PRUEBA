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

    //CONSULTA LOS VALORES DE LA TABLA

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

    $tab = 16;

    while ($row = pg_fetch_assoc($valor3)) {
        $i++;
        $tab1 = $tab*$i;
        $tab2 = ($tab*$i)+1;
        $tab3 = ($tab*$i)+2;
        $tab4 = ($tab*$i)+3;
        $tab5 = ($tab*$i)+4;
        echo ('<tr><td>'.$i.'</td><td tabindex="'.$tab1.'" aria-label="'.$row['snombre_activ_capacitacion'].'">'.$row['snombre_activ_capacitacion'].'</td><td tabindex="'.$tab2.'" aria-label="'.$row['snombre_entidad_capacitadora'].'">'.$row['snombre_entidad_capacitadora'].'</td><td tabindex="'.$tab3.'" aria-label="'.$row['sduracion_capacitacion'].'">'.$row['sduracion_capacitacion'].'</td><td><input type="button" tabindex="'.$tab4.'" aria-label="Editar los datos" class="btn btn-secondary" style="border-radius: 30px; display: inline-flex;" value="Editar" onclick="modificar_curso('.$row['id'].');"><input type="button" class="btn btn-danger" style="border-radius: 30px;display: inline-flex;" tabindex="'.$tab5.'" aria-label="Eliminar los datos" value="Borrar" onclick="eliminar_curso('.$row['id'].');"></td></tr>');
    }

    if($tab5 < $tab){
        echo " / $tab";
        die();
    }
    echo " / $tab5";
?>