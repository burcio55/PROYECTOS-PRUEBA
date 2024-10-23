<?
include('based.php');

$accion = $_REQUEST['accion'];

//Seleccionar elementos

if ($accion == '1') {
    $cedula = $_GET['cedula'];
    $nacionalidad = $_GET['nacionalidad'];

    
    $resy = " SELECT personales.cedula as cedula,
            personales.id as id,
            personales.nacionalidad as nacionalidad,
            personales.primer_apellido as apellido1,
            personales.segundo_apellido as apellido2,
            personales.primer_nombre as nombre1,
            personales.segundo_nombre as nombre2,
            personales.subicacion_fisica as ubicacion_fisica_actual,
            personales.scargo_actual_ejerce as cargo_actual_ejerce,
            public.cargos.sdescripcion as cargo,
            public.ubicacion_administrativa.sdescripcion as ubicacion_adm
            FROM public.personales
            LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula
            LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id
            LEFT JOIN public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo
            LEFT JOIN public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo
            where personales.cedula = '$cedula' and personales.nacionalidad = '$nacionalidad'
    ";

    /*
        '".$_SESSION['id_usuario']."' --and recibo_pago.nestatus='1' order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC LIMIT 1 "; 

        $result = "SELECT id, cedula, primer_apellido, primer_nombre, nacionalidad, subicacion_fisica, segundo_apellido, segundo_nombre, scargo_actual_ejerce  
        FROM public.personales Where cedula = $cedula";
    */

    $SQL = pg_query($conn, $resy);

    if ($row = pg_fetch_array($SQL, NULL, PGSQL_ASSOC)) {
        $cedula == $row['cedula'];
        $_SESSION["id_persona"] = $row['id'];
        $_SESSION["nusuario_creacion"] = $cedula;

        $star = $row['nombre1'];
        $echo = $row['nombre2'];
        $nombres = $row['nombre1'] . " " . $row['nombre2'];

        $apellido1 = $row['apellido1'];
        $apellido2 = $row['apellido2'];
        $apellidos = $row['apellido1'] . " " . $row['apellido2'];

        $ubicacion_adm = $row['ubicacion_adm'];

        $ubicacion_fisica_actual = $row['ubicacion_fisica_actual'];

        $cargo = $row['cargo'];

        $scargo_actual_ejerce = $row['cargo_actual_ejerce'];

        $todo = "1 / " . $nombres . " / " . $apellidos . " / " . $ubicacion_adm . " / " . $ubicacion_fisica_actual . " / " . $cargo . " / " . $scargo_actual_ejerce;
    }

    $personales = $_SESSION["id_persona"];

    $date = date('Ymd');

    $PG9 = "SELECT ";
    $PG9 .= " reporte_tecnico.reportes_fallas.id AS id_reporte,";
    $PG9 .= " personales_id,";
    $PG9 .= " dispositivos_id,";
    $PG9 .= " snombre_dispositivo,";
    $PG9 .= " sdisco_duro,";
    $PG9 .= " smemoria_ram,";
    $PG9 .= " dispositivos.sdescripcion AS tipo_disp,";
    $PG9 .= " nnumero_requer_glpi,";
    $PG9 .= " ubicacion_administrativa_scodigo,";
    $PG9 .= " marca_id,";
    $PG9 .= " marca.sdescripcion As marca,";
    $PG9 .= " smodelo,";
    $PG9 .= " nbien_publico,";
    $PG9 .= " reporte_tecnico.reportes_fallas.nusuario_creacion AS usuario,";
    $PG9 .= " sobservaciones_tecnico,";
    $PG9 .= " srecomendaciones_tecnico,";
    $PG9 .= " sserial,";
    $PG9 .= " estatus_id,";
    $PG9 .= " estatus.sdescripcion As estatus,";
    $PG9 .= " estatus_final,";
    $PG9 .= " reporte_tecnico.reportes_fallas.nusuario_creacion,";
    $PG9 .= " motivo_desincorporacion,";
    $PG9 .= " reporte_tecnico.reportes_fallas.snro_reporte,";
    $PG9 .= " reporte_tecnico.reportes_fallas.dfecha_creacion";
    $PG9 .= " snro_reporte";
    $PG9 .= " FROM reporte_tecnico.reportes_fallas";
    $PG9 .= " inner join reporte_tecnico.dispositivos on dispositivos.id = reportes_fallas.dispositivos_id";
    $PG9 .= " inner join reporte_tecnico.marca on marca.id = reportes_fallas.marca_id";
    $PG9 .= " inner join reporte_tecnico.estatus on estatus.id = reportes_fallas.estatus_id";
    $PG9 .= " where reportes_fallas.benabled='TRUE' AND estatus.benabled = 'TRUE' AND marca.benabled = 'TRUE' ";
    $PG9 .= " AND dispositivos.benabled = 'TRUE' AND reportes_fallas.snro_reporte is not null ";
    $PG9 .= " AND reportes_fallas.snro_reporte != 'No se ha generado un numero de reporte.' AND fecha_insercion = '$date'";
    $PG9 .= " AND cod_estatus = '0'";
    $PG9 .= " AND reportes_fallas.personales_id = '$personales' order by reporte_tecnico.reportes_fallas.snro_reporte desc ";

    /* echo "1 / " . $PG9;
    die(); */

    $row2 = pg_query($conn, $PG9);

    $element = "";
    $i = 0;

    while ($persona2 = pg_fetch_assoc($row2)) {
        $i++;

        $element .= "
                    <tr>
                        <td>" . $i . "</td>
                        <td>" . $persona2['tipo_disp'] . "</td>
                        <td>" . $persona2['marca'] . "</td>
                        <td>" . $persona2['smodelo'] . "</td>
                        <td>" . $persona2['nbien_publico'] . "</td> 
                        <td>" . $persona2['sserial'] . "</td>
                        <td>" . $persona2['estatus'] . "</td>
                    </tr>
        ";
    }

    if ($element == '') {
        $element = "
                    <tr>
                        <td colspan='7'> No hay ningún dato en la tabla </td>
                    </tr>
        ";
    }


    $_SESSION['snro_reporte'] = $persona2['snro_reporte'];

    $todo .= " / " . $element;

    echo $todo;
    die();
} else
if ($accion == '2') {

    $requirimiento = $_REQUEST['n_requerimiento'];
    $ubi_administrativa = $_REQUEST['ubicacion_administrativa']; // Éste
    $bien_public = $_REQUEST['bien_publico'];
    $nom_dispo = $_REQUEST['nombre_dispo'];
    $dispo = $_REQUEST['tipo_dispo'];
    $estatus = $_REQUEST['estatus'];
    $marca = $_REQUEST['marca'];
    $modelo = $_REQUEST['modelo'];
    $serial = $_REQUEST['serial'];
    $disco = $_REQUEST['disco_duro'];
    $ram = $_REQUEST['ram'];
    $persona_id = $_SESSION["id_persona"];
    $nusuario_creacion = $_SESSION["nusuario_creacion"];
    $date = date('Ymd');
    /* $num_repo = 0; */

    if ($requirimiento == "") {
        $requirimiento = "0";
    }

    if ($ubi_administrativa == "" || $ubi_administrativa == "0") {
        $ubi_administrativa = "1";
    }

    if ($bien_public == "") {
        $bien_public = "0";
    }

    $config = "SELECT * FROM
                reporte_tecnico.reportes_fallas
                WHERE
                fecha_insercion != '0'
                AND
                fecha_insercion = '$date'
                AND
                benabled = 'TRUE'
    ";

     /* echo "0 / " . $config;
    die();  */ 

    $rw = pg_query($conn, $config);
    $num_regis = pg_num_rows($rw);

    if($num_regis > 0 ){
        // Aquí entra sí ya existe un registro para la fecha actual

        $config2 = "SELECT * FROM
                reporte_tecnico.reportes_fallas
                WHERE
                fecha_insercion != '0'
                AND
                fecha_insercion = '$date'
                AND
                personales_id = '$persona_id'
                AND
                cod_estatus = '0'
                AND
                benabled = 'TRUE'
            ";

        $row = pg_query($conn, $config2);
        $num_regis2 = pg_num_rows($row);
        $pers = pg_fetch_assoc($row);

        $numero_reporte = $pers['snro_reporte'];

        if ($numero_reporte == ""){
            // Registro de Otro Usuario 

            $config3 = " SELECT DISTINCT personales_id, snro_reporte, COUNT(*) AS total_registros
                FROM reporte_tecnico.reportes_fallas
                WHERE benabled = 'TRUE' AND fecha_insercion = '$date'
                GROUP BY personales_id, snro_reporte
                    ";

                $grow = pg_query($conn, $config3);
                $persons = pg_num_rows($grow);

                $snro_reporte = $date . "-" . str_pad($persons + 1, 3, "0", STR_PAD_LEFT);
                $_SESSION["snro_reporte"] = $snro_reporte;

                /* echo "0 / $nro_reporte";
                die(); */

        } else{
            // Mismo usuario
            if($num_regis2 <= 5){
                //En caso de que que no haya exedido el límite 
                $snro_reporte = $numero_reporte;
                $_SESSION["snro_reporte"] = $snro_reporte;
            } else{
                // Superó el Límite
                //ERROR
                echo "0 / Excedió el límite de 5 dispositivos por registro para el informe por favor intente mas tarde";
                die();
            }
        }

        /* echo "0 / $numero_reporte";
        die(); */

    } else{
        // 1er Registro del día
        $snro_reporte = $date . "-001";

        $_SESSION['registro'] = $snro_reporte;
    }
      
    $personales = $_SESSION["id_persona"];

    $information0 = " SELECT";
    $information0 .= " reporte_tecnico.reportes_fallas.id AS id_reporte,";
    $information0 .= " personales_id,";
    $information0 .= " dispositivos_id,";
    $information0 .= " snombre_dispositivo,";
    $information0 .= " sdisco_duro,";
    $information0 .= " smemoria_ram,";
    $information0 .= " dispositivos.sdescripcion AS tipo_disp,";
    $information0 .= " nnumero_requer_glpi,";
    $information0 .= " ubicacion_administrativa_scodigo,";
    $information0 .= " marca_id,";
    $information0 .= " marca.sdescripcion As marca,";
    $information0 .= " smodelo,";
    $information0 .= " nbien_publico,";
    $information0 .= " reporte_tecnico.reportes_fallas.nusuario_creacion AS usuario,";
    $information0 .= " sobservaciones_tecnico,";
    $information0 .= " srecomendaciones_tecnico,";
    $information0 .= " sserial,";
    $information0 .= " estatus_id,";
    $information0 .= " estatus.sdescripcion As estatus,";
    $information0 .= " estatus_final,";
    $information0 .= " reporte_tecnico.reportes_fallas.nusuario_creacion,";
    $information0 .= " motivo_desincorporacion,";
    $information0 .= " reporte_tecnico.reportes_fallas.snro_reporte,";
    $information0 .= " reporte_tecnico.reportes_fallas.dfecha_creacion";
    $information0 .= " FROM";
    $information0 .= " reporte_tecnico.reportes_fallas";
    $information0 .= " inner join reporte_tecnico.dispositivos on dispositivos.id = reportes_fallas.dispositivos_id";
    $information0 .= " inner join reporte_tecnico.marca on marca.id = reportes_fallas.marca_id";
    $information0 .= " inner join reporte_tecnico.estatus on estatus.id = reportes_fallas.estatus_id";
    $information0 .= " where reportes_fallas.benabled='TRUE' AND estatus.benabled = 'TRUE' AND marca.benabled = 'TRUE' ";
    $information0 .= " AND";
    $information0 .= " dispositivos.benabled = 'TRUE'";
    $information0 .= " AND";
    $information0 .= " reportes_fallas.snro_reporte is not null";
    $information0 .= " AND";
    $information0 .= " reportes_fallas.snro_reporte != 'No se ha generado un numero de reporte.'";
    $information0 .= " AND";
    $information0 .= " fecha_insercion != '0'";
    $information0 .= " AND";
    $information0 .= " cod_estatus = '0'";
    $information0 .= " AND";
    $information0 .= " reportes_fallas.personales_id = '$personales'";
    $information0 .= " ORDER BY snro_reporte desc";

    /* echo "0 / " . $information0;
        die();  */

    $rw0 = pg_query($conn, $information0);
    if (pg_num_rows($rw0) > 4) {
        echo "0 / Excedió el límite de 5 dispositivos por registro";
        die();
    } else {
        $_SESSION["IMG"] = pg_num_rows($rw0);

        $query = "INSERT INTO";
        $query .= " reporte_tecnico.reportes_fallas";
        $query .= " (";
        $query .= " personales_id,";
        $query .= " nnumero_requer_glpi,";
        $query .= " ubicacion_administrativa_scodigo,";
        $query .= " nbien_publico,";
        $query .= " snombre_dispositivo,";
        $query .= " dispositivos_id,";
        $query .= " estatus_id,";
        $query .= " marca_id,";
        $query .= " smodelo,";
        $query .= " sserial,";
        $query .= " sdisco_duro,";
        $query .= " smemoria_ram,";
        $query .= " nusuario_creacion,";
        $query .= " snro_reporte,";
        $query .= " fecha_insercion";
        $query .= ")";
        $query .= " VALUES";
        $query .= " (";
        $query .= "'$persona_id',";
        $query .= "'$requirimiento',";
        $query .= "'$ubi_administrativa',";
        $query .= "'$bien_public',";
        $query .= "'$nom_dispo',";
        $query .= "'$dispo',";
        $query .= "'$estatus',";
        $query .= "'$marca',";
        $query .= "'$modelo',";
        $query .= " '$serial',";
        $query .= "'$disco',";
        $query .= "'$ram',";
        $query .= "'$nusuario_creacion',";
        $query .= " '$snro_reporte',";
        $query .= " '$date'";
        $query .= ")";

        /* echo "0 / " . $query;
        die(); */

        if ($resultado2 = pg_query($conn, $query)) {

            $i = 0;
            $date = date('Ymd');

            $information3 = " SELECT";
            $information3 .= " reporte_tecnico.reportes_fallas.id AS id_reporte,";
            $information3 .= " personales_id,";
            $information3 .= " dispositivos_id,";
            $information3 .= " snombre_dispositivo,";
            $information3 .= " sdisco_duro,";
            $information3 .= " smemoria_ram,";
            $information3 .= " dispositivos.sdescripcion AS tipo_disp,";
            $information3 .= " nnumero_requer_glpi,";
            $information3 .= " ubicacion_administrativa_scodigo,";
            $information3 .= " marca_id,";
            $information3 .= " marca.sdescripcion As marca,";
            $information3 .= " smodelo,";
            $information3 .= " nbien_publico,";
            $information3 .= " reporte_tecnico.reportes_fallas.nusuario_creacion AS usuario,";
            $information3 .= " sobservaciones_tecnico,";
            $information3 .= " srecomendaciones_tecnico,";
            $information3 .= " sserial,";
            $information3 .= " estatus_id,";
            $information3 .= " estatus.sdescripcion As estatus,";
            $information3 .= " estatus_final,";
            $information3 .= " reporte_tecnico.reportes_fallas.nusuario_creacion,";
            $information3 .= " motivo_desincorporacion,";
            $information3 .= " reporte_tecnico.reportes_fallas.snro_reporte,";
            $information3 .= " reporte_tecnico.reportes_fallas.dfecha_creacion";
            $information3 .= " FROM";
            $information3 .= " reporte_tecnico.reportes_fallas";
            $information3 .= " inner join reporte_tecnico.dispositivos on dispositivos.id = reportes_fallas.dispositivos_id";
            $information3 .= " inner join reporte_tecnico.marca on marca.id = reportes_fallas.marca_id";
            $information3 .= " inner join reporte_tecnico.estatus on estatus.id = reportes_fallas.estatus_id";
            $information3 .= " where reportes_fallas.benabled='TRUE' AND estatus.benabled = 'TRUE' AND marca.benabled = 'TRUE' ";
            $information3 .= " AND";
            $information3 .= " dispositivos.benabled = 'TRUE'";
            $information3 .= " AND";
            $information3 .= " reportes_fallas.snro_reporte is not null";
            $information3 .= " AND";
            $information3 .= " reportes_fallas.snro_reporte != 'No se ha generado un numero de reporte.'";
            $information3 .= " AND";
            $information3 .= " fecha_insercion = '$date'";
            $information3 .= " AND";
            $information3 .= " cod_estatus = '0'";
            $information3 .= " AND";
            $information3 .= " reportes_fallas.personales_id = '$personales'";
            $information3 .= " ORDER BY snro_reporte desc";

            /* echo "0 / " . $information3;
                die();  */
    
            $row3 = pg_query($conn, $information3);
            $info = pg_fetch_all($row3);

            $element2 = "";
            $i2 = "";

            while ($info =  pg_fetch_assoc($row3)) {
                $i2++;
                $element2 .= "
                    <tr>
                        <td>" . $i2 . "</td>
                        <td>" . $info['tipo_disp'] . "</td>
                        <td>" . $info['marca'] . "</td>
                        <td>" . $info['smodelo'] . "</td>
                        <td>" . $info['nbien_publico'] . "</td> 
                        <td>" . $info['sserial'] . "</td>
                        <td>" . $info['estatus'] . "</td>
                    </tr>
                ";
                $lost = $info['snro_reporte'];
                
                $_SESSION['snro_reporte'] = $lost;
            }

            $_SESSION['cnt_snro_reporte'] = $i;

            /* echo "0 / " . $info['snro_reporte'];
                die(); */

            echo "1 / Datos ingresados correctamente / " . $element2;
        } else {
            echo "0 / Error al insertar datos: " . $query;
            die();
        }
    }
} else  
if ($accion == 3) {


    $id_reporte = $_REQUEST["id_reporte"];

    $SQL2 = " UPDATE reporte_tecnico.reportes_fallas SET benabled = 'FALSE' WHERE id = '" . $id_reporte . "'";

    if ($resultado = pg_query($conn, $SQL2)) {
        $i4 = 0;
        $date = date('Ymd');

        $personales = $_SESSION['id_persona'];
        $snro_reporte = $_SESSION['snro_reporte'];

    $information2 = " SELECT";
    $information2 .= " reporte_tecnico.reportes_fallas.id AS id_reporte,";
    $information2 .= " personales_id,";
    $information2 .= " dispositivos_id,";
    $information2 .= " snombre_dispositivo,";
    $information2 .= " sdisco_duro,";
    $information2 .= " smemoria_ram,";
    $information2 .= " dispositivos.sdescripcion AS tipo_disp,";
    $information2 .= " nnumero_requer_glpi,";
    $information2 .= " ubicacion_administrativa_scodigo,";
    $information2 .= " marca_id,";
    $information2 .= " marca.sdescripcion As marca,";
    $information2 .= " smodelo,";
    $information2 .= " nbien_publico,";
    $information2 .= " reporte_tecnico.reportes_fallas.nusuario_creacion AS usuario,";
    $information2 .= " sobservaciones_tecnico,";
    $information2 .= " srecomendaciones_tecnico,";
    $information2 .= " sserial,";
    $information2 .= " estatus_id,";
    $information2 .= " estatus.sdescripcion As estatus,";
    $information2 .= " estatus_final,";
    $information2 .= " reporte_tecnico.reportes_fallas.nusuario_creacion,";
    $information2 .= " motivo_desincorporacion,";
    $information2 .= " reporte_tecnico.reportes_fallas.snro_reporte,";
    $information2 .= " reporte_tecnico.reportes_fallas.dfecha_creacion";
    $information2 .= " FROM";
    $information2 .= " reporte_tecnico.reportes_fallas";
    $information2 .= " inner join reporte_tecnico.dispositivos on dispositivos.id = reportes_fallas.dispositivos_id";
    $information2 .= " inner join reporte_tecnico.marca on marca.id = reportes_fallas.marca_id";
    $information2 .= " inner join reporte_tecnico.estatus on estatus.id = reportes_fallas.estatus_id";
    $information2 .= " where reportes_fallas.benabled='TRUE' AND estatus.benabled = 'TRUE' AND marca.benabled = 'TRUE' ";
    $information2 .= " AND";
    $information2 .= " dispositivos.benabled = 'TRUE'";
    $information2 .= " AND";
    $information2 .= " reportes_fallas.snro_reporte is not null";
    $information2 .= " AND";
    $information2 .= " reportes_fallas.snro_reporte != 'No se ha generado un numero de reporte.'";
    $information2 .= " AND";
    $information2 .= " cod_estatus = '1'";
    $information2 .= " AND";
    $information2 .= " reportes_fallas.benabled = 'TRUE'";
    $information2 .= " AND";
    $information2 .= " reportes_fallas.snro_reporte = '$snro_reporte'";
    $information2 .= " AND";
    $information2 .= " reportes_fallas.personales_id = '$personales'";
    $information2 .= " ORDER BY snro_reporte desc";

        $row4 = pg_query($conn, $information2);
        $info4 = pg_fetch_all($row4);

        $cosa2 = " / ";

        while ($info4 =  pg_fetch_assoc($row4)) {
            $i4++;
            $cosa2 .= "
                        <tr>
                            <td>" . $i4 . "</td>
                            <td>" . $info4['tipo_disp'] . "</td>
                            <td>" . $info4['marca'] . "</td>
                            <td>" . $info4['smodelo'] . "</td>
                            <td>" . $info4['nbien_publico'] . "</td> 
                            <td>" . $info4['sserial'] . "</td>
                            <td>" . $info4['estatus'] . "</td>
                            <td> <div class=\"button-grid\" style=\"display: flex; justify-content: center; gap: 10px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;\">
                            <button type=\"button\" style=\"text-align: center; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 20px; width: auto; max-width: 90px;\" onmouseout=\"'this.style.color='#fff'; this.style.backgroundColor='#46A2FD'; this.style.border='1px Solid #46A2FD''\" onmouseover=\"'this.style.color='#46A2FD'; this.style.backgroundColor='#fff'; data-bs-toggle='tooltip'\" onclick=\"accion_editar_registro('" . $info['snro_reporte'] . "','" . $info['id_reporte'] . "','" . $info['nnumero_requer_glpi'] . "','" . $info['ubicacion_administrativa_scodigo'] . "','" . $info['nbien_publico'] . "','" . $info['snombre_dispositivo'] . "','" . $info['dispositivos_id'] . "','" . $info['estatus_id'] . "','" . $info['marca_id'] . "','" . $info['smodelo'] . "','" . $info['sserial'] . "','" . $info['sdisco_duro'] . "','" . $info['smemoria_ram'] . "','" . $info['sobservaciones_tecnico'] . "','" . $info['srecomendaciones_tecnico'] . "','" . $info['estatus_final'] . "','" . $info['motivo_desincorporacion'] . "','" . $info['marca'] . "','" . $info['tipo_disp'] . "','" . $info['estatus'] . "','" . $info['usuario'] . "')\"><center>Modificar</center></button>
                            <button type=\"button\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 20px; width: auto; max-width: 90px;\" onmouseout=\"'this.style.color='#fff'; this.style.backgroundColor='#dc3545'; this.style.border='1px Solid #dc3545''\" onmouseover=\"'this.style.color='#dc3545'; this.style.backgroundColor='#fff'; data-bs-toggle='tooltip'\" onclick=\"accion_eliminar_registro('" . $info['id_reporte'] . "')\">Eliminar</button>
                            </div>
                        </td>
                        </tr>
            ";
        }
        $_SESSION["IMG"] = $i4 - 1;
        if ($cosa2 == " / ") {
            /* $cosa2 = " / " . $information2; */
            $cosa2 = " / Ningún dato en la tabla";
        }
        echo "1 / Se eliminó el registro correctamente. En unos instantes se actualizara la página" . $cosa2;
        die();
    } else {
        echo "0 / Falló la eliminación, Por favor volver a presionar el boton buscar ";
        die();
    }
} else
if ($accion == 4) {

    $id_reporte = $_REQUEST['reporte'];
    $requirimiento2 = $_REQUEST['requerimiento'];
    $ubi_administrativa2 = $_REQUEST['administracion'];
    $bien_public2 = $_REQUEST['bien_public'];
    $nom_dispo2 = $_REQUEST['dispositivo_nombre'];
    $dispo2 = $_REQUEST['id_dispositivo'];
    $estatus2 = $_REQUEST['id_estatus'];
    $marca2 = $_REQUEST['id_marca'];
    $modelo2 = $_REQUEST['modelo2'];
    $serial2 = $_REQUEST['serial2'];
    $disco2 = $_REQUEST['discoduro'];
    $ram2 = $_REQUEST['memoria_ram'];
    $observaciones2 = $_REQUEST['observaciones'];
    $recomendaciones2 = $_REQUEST['recomendaciones'];
    $final2 = $_REQUEST['final_estatus'];
    $desincorporacion2 = $_REQUEST['motivo_desincorporacion2'];

    if ($desincorporacion2 == "") {
        $desincorporacion2 = "No hay razones para desincorporar el equipo";
    }

    if ($recomendaciones2 == "") {
        $recomendaciones2 = "No hay razones para realizar recomendaciones al equipo";
    }

    if ($observaciones2 == "") {
        $observaciones2 = "No hay razones para realizar observaciones al equipo";
    }

    if ($final2 == "") {
        $final2 = "Su estatus no ha cambiado";
    }


    /* echo '4 /  '.$id_reporte.' -- '.$requirimiento2.' -- '.$ubi_administrativa2.' -- '.$bien_public2.' -- '.$nom_dispo2.' -- '.$dispo2.' -- '.$estatus2.' -- '.$marca2.' -- '.$modelo2.' -- '.$serial2.' -- '.$disco2.' -- '.$ram2.' -- '.$observaciones2.' -- '.$recomendaciones2.' -- '.$final2.' -- '.$desincorporacion2;  */

    $actualizar = " UPDATE reporte_tecnico.reportes_fallas SET id= '" . $id_reporte . "', 
                        dispositivos_id= '" . $dispo2 . "', 
                        marca_id= '" . $marca2 . "', 
                        estatus_id= '" . $final2 . "', 
                        nbien_publico= '" . $bien_public2 . "', 
                        snombre_dispositivo= '" . $nom_dispo2 . "', 
                        smodelo= '" . $modelo2 . "', 
                        sserial= '" . $serial2 . "', 
                        sdisco_duro= '" . $disco2 . "', 
                        smemoria_ram= '" . $ram2 . "', 
                        nnumero_requer_glpi= '" . $requirimiento2 . "', 
                        ubicacion_administrativa_scodigo= '" . $ubi_administrativa2 . "', 
                        sobservaciones_tecnico= '" . $observaciones2 . "', 
                        srecomendaciones_tecnico= '" . $recomendaciones2 . "', 
                        estatus_final= '" . $final2 . "', 
                        motivo_desincorporacion= '" . $desincorporacion2 . "'
                        WHERE id = '" . $id_reporte . "'
                        ";

    if ($resultado4 = pg_query($conn, $actualizar)) {
        $i4 = 0;
        $date = date('Ymd');

        $personales = $_SESSION["id_persona"];

        $snro_reporte = $_SESSION["snro_reporte"];

        $information = " SELECT";
        $information .= " reporte_tecnico.reportes_fallas.id AS id_reporte,";
        $information .= " personales_id,";
        $information .= " dispositivos_id,";
        $information .= " snombre_dispositivo,";
        $information .= " sdisco_duro,";
        $information .= " smemoria_ram,";
        $information .= " dispositivos.sdescripcion AS tipo_disp,";
        $information .= " nnumero_requer_glpi,";
        $information .= " ubicacion_administrativa_scodigo,";
        $information .= " marca_id,";
        $information .= " marca.sdescripcion As marca,";
        $information .= " smodelo,";
        $information .= " nbien_publico,";
        $information .= " reporte_tecnico.reportes_fallas.nusuario_creacion AS usuario,";
        $information .= " sobservaciones_tecnico,";
        $information .= " srecomendaciones_tecnico,";
        $information .= " sserial,";
        $information .= " estatus_id,";
        $information .= " estatus.sdescripcion As estatus,";
        $information .= " estatus_final,";
        $information .= " reporte_tecnico.reportes_fallas.nusuario_creacion,";
        $information .= " motivo_desincorporacion,";
        $information .= " reporte_tecnico.reportes_fallas.snro_reporte,";
        $information .= " reporte_tecnico.reportes_fallas.dfecha_creacion";
        $information .= " FROM";
        $information .= " reporte_tecnico.reportes_fallas";
        $information .= " inner join reporte_tecnico.dispositivos on dispositivos.id = reportes_fallas.dispositivos_id";
        $information .= " inner join reporte_tecnico.marca on marca.id = reportes_fallas.marca_id";
        $information .= " inner join reporte_tecnico.estatus on estatus.id = reportes_fallas.estatus_id";
        $information .= " where reportes_fallas.benabled='TRUE' AND estatus.benabled = 'TRUE' AND marca.benabled = 'TRUE' ";
        $information .= " AND";
        $information .= " dispositivos.benabled = 'TRUE'";
        $information .= " AND";
        $information .= " reportes_fallas.snro_reporte is not null";
        $information .= " AND";
        $information .= " reportes_fallas.snro_reporte != 'No se ha generado un numero de reporte.'";
        $information .= " AND";
        $information .= " cod_estatus = '1'";
        $information .= " AND";
        $information .= " reportes_fallas.benabled = 'TRUE'";
        $information .= " AND";
        $information .= " reportes_fallas.personales_id = '$personales'";
        $information .= " AND";
        $information .= " reportes_fallas.snro_reporte = '$snro_reporte'";
        $information .= " ORDER BY snro_reporte desc";

        $row3 = pg_query($conn, $information);
        $info3 = pg_fetch_all($row3);

        $cosa = " / ";

        while ($info3 =  pg_fetch_assoc($row3)) {
            $i3++;
            $cosa .= "
                        <tr>
                            <td>" . $i3 . "</td>
                            <td>" . $info3['tipo_disp'] . "</td>
                            <td>" . $info3['marca'] . "</td>
                            <td>" . $info3['smodelo'] . "</td>
                            <td>" . $info3['nbien_publico'] . "</td> 
                            <td>" . $info3['sserial'] . "</td>
                            <td>" . $info3['estatus'] . "</td>
                            <td> <div class=\"button-grid\" style=\"display: flex; justify-content: center; gap: 10px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;\">
                            <button type=\"button\" style=\"text-align: center; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 20px; width: auto; max-width: 90px;\" onmouseout=\"'this.style.color='#fff'; this.style.backgroundColor='#46A2FD'; this.style.border='1px Solid #46A2FD''\" onmouseover=\"'this.style.color='#46A2FD'; this.style.backgroundColor='#fff'; data-bs-toggle='tooltip'\" onclick=\"accion_editar_registro('" . $info['snro_reporte'] . "','" . $info['id_reporte'] . "','" . $info['nnumero_requer_glpi'] . "','" . $info['ubicacion_administrativa_scodigo'] . "','" . $info['nbien_publico'] . "','" . $info['snombre_dispositivo'] . "','" . $info['dispositivos_id'] . "','" . $info['estatus_id'] . "','" . $info['marca_id'] . "','" . $info['smodelo'] . "','" . $info['sserial'] . "','" . $info['sdisco_duro'] . "','" . $info['smemoria_ram'] . "','" . $info['sobservaciones_tecnico'] . "','" . $info['srecomendaciones_tecnico'] . "','" . $info['estatus_final'] . "','" . $info['motivo_desincorporacion'] . "','" . $info['marca'] . "','" . $info['tipo_disp'] . "','" . $info['estatus'] . "','" . $info['usuario'] . "')\"><center>Modificar</center></button>
                            <button type=\"button\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 20px; width: auto; max-width: 90px;\" onmouseout=\"'this.style.color='#fff'; this.style.backgroundColor='#dc3545'; this.style.border='1px Solid #dc3545''\" onmouseover=\"'this.style.color='#dc3545'; this.style.backgroundColor='#fff'; data-bs-toggle='tooltip'\" onclick=\"accion_eliminar_registro('" . $info['id_reporte'] . "')\">Eliminar</button>
                            </div>
                        </td>
                        </tr>
            ";
        }
        if ($cosa == " / ") {
            /* $cosa = " / " . $information; */
            $cosa = " / Ningún dato en la Tabla";
        }
        
        echo "1 / Se modificó el registro correctamente " . $cosa;

        die();
    } else {
        echo "0 / Falló la actualización: " . $actualizar;
        die();
    }

    //REGISTRAR IMAGEN
    echo $_POST['foto'];
    if (isset($_POST['Subir'])) {
        $nom_imagen = $_FILES['foto']['name'];
        echo $nom_imagen;

        if (isset($nom_imagen) && $nom_imagen != "") {
            $tipo_imagen = $_FILES['foto']['type'];
            $ruta_imagen = $_FILES['foto']['tmp_name'];

            /* echo $nom_imagen."--".$tipo_imagen."--".$ruta_imagen;  */

            $tiposValidos = array('image/jpeg', 'image/png');
            if (!in_array($tipo_imagen, $tiposValidos)) {
                echo "Solo se permiten imagenes de elementos JPEG o PNG ";
            } else {

                $creacion = "202120";
                /*  echo " Dato insertado: ".$creacion;  */

                $sql = "INSERT INTO reporte_tecnico.adjuntos(reportes_fallas_id,
                                    nombre_foto, archivo, nusuario_creacion)
                                VALUES ('$id_reporte', '$nom_imagen', '$tipo_imagen', '$creacion')";

                echo $sql;

                $imagen = pg_query($conn, $sql);
                if ($imagen) {
                    move_uploaded_file($ruta_imagen, 'imagenes/' . $nom_imagen);
                    echo "Datos insertados correctamente";
                } else {
                    echo "Error en la insercion de datos";
                }
            }
        } else {
            echo " No se ha ingresado una foto: Por favor intente otra vez";
        }
    }
} else
if ($accion == 5) {
    $snro_reporte = $_SESSION['snro_reporte'];

    if ($snro_reporte != '') {
        $SQL3 = "UPDATE reporte_tecnico.reportes_fallas SET cod_estatus = 1 WHERE snro_reporte = '$snro_reporte' AND benabled = 'TRUE'";

        if ($resultado3 = pg_query($conn, $SQL3)) {
            echo "1 / Su número de reporte es: " . $snro_reporte;
            die();
        } else {
            echo "1 / Falló la actualización por: " . $SQL3;
            die();
        }
    } else {
        echo "0 / No ha registrado ningún dispositivo aún";
        die();
    }
}