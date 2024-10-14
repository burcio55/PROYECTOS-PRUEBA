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

    $tab = $_REQUEST['tab'];

    //CONSULTA LOS VALORES DE LA TABLA

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
    $vuelta = pg_num_rows($valor2);
    $i = 0;


    while ($row = pg_fetch_assoc($valor2)) {
        $i++;
        $tab1 = ($tab+$i)+1;
        $tab2 = ($tab+$i)+2;
        $tab3 = ($tab+$i)+3;
        $tab4 = ($tab+$i)+4;
        if($row['sdominio_conocimiento'] == 1){
            $row['sdominio_conocimiento'] = 'Bajo';
        }else if($row['sdominio_conocimiento'] == 2){
            $row['sdominio_conocimiento'] = 'Medio';
        }else if($row['sdominio_conocimiento'] == 3){
            $row['sdominio_conocimiento'] = 'Avanzado';
        }
        echo ('<tr><td>'.$i.'</td><td tabindex="'.$tab1.'" aria-label="'.$row['snombre_otros_conocimientos'].'">'.$row['snombre_otros_conocimientos'].'</td><td tabindex="'.$tab2.'" aria-label="'.$row['sdominio_conocimiento'].'">'.$row['sdominio_conocimiento'].'</td><td><input tabindex="'.$tab3.'" aria-label="Editar los datos" type="button" class="btn btn-secondary" style="border-radius: 30px; display: inline-flex;" value="Editar" onclick="modificar_conocimientos('.$row['id'].');"><input type="button" class="btn btn-danger" tabindex="'.$tab4.'" aria-label="Eliminar los datos" style="border-radius: 30px;display: inline-flex;" value="Borrar" onclick="eliminar_conocimientos('.$row['id'].');"></td></tr>');
    }

    echo " / $tab4";

?>