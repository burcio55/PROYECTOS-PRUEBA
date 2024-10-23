<?
include("bd.php");

    $resy = " SELECT personal.id_personal,
                                personal.primer_apellido as apellido1,
                                personal.segundo_apellido as apellido2,
                                personal.primer_nombre as nombre1,
                                personal.segundo_nombre as nombre2, 
                                personal.nacionalidad,
                                personal.sexo,
                                personal.cedula as cedula, 
                                trabajador.fecha_ingreso,
                                trabajador.codigo_nomina as cod_nom,
                                cargo.descripcion_cargo,
                                dependencia.nombre as nombre_dep
                                FROM trabajador
                                INNER JOIN personal on personal.id_personal = trabajador.id_personal
                                inner join cargo on trabajador.id_cargo = cargo.id_cargo
                                inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia 
                                WHERE personal.cedula='".$_SESSION['id_usuario']."' and estatus='A' 
                    ";

    $SQL = pg_query($conn, $resy);

    if ($row = pg_fetch_array($SQL, NULL, PGSQL_ASSOC)) {
       
        $star = $row['nombre1'];
        $echeco = $row['nombre2'];
        $nombres = $row['apellido1'] . " " . $row['apellido2'] . " " . $row['nombre1']. " " . $row['nombre2'];

        $identificacion = $row['cedula'];

        $ubicacion_adm = $row['nombre_dep'];

        $ubicacion_fisica_actual = $row['ubicacion_fisica_actual'];

        $cargo = $row['descripcion_cargo'];

        $nomina = $row['cod_nom'];
        
        $fecha = $row['fecha_ingreso'];

        $fechaActual = date('Y');

        $fecha2 = str_split($fecha, 4);
        $fecha3 = $fecha2[0];

        $diferencia =  $fechaActual - $fecha3;
        

        /* // Convertir las fechas a objetos DateTime
        $fechaIngreso = DateTime::createFromFormat('d/m/Y', $fecha);
        $fechaActualDate = DateTime::createFromFormat('d/m/Y', $fechaActual);

        // Calcular la diferencia
        $diferencia = $fechaActualDate->diff($fechaIngreso);
        $años = $diferencia->y; */


        $todo = "1 / " . $nombres . " / " . $identificacion . " / " . $nomina . " / " . $nada . " / " . $cargo . " / " . $ubicacion_adm . " / " . $fecha . " / " . $diferencia . " / " . $nada . " / " . $nada .  " / " . $nada .  " / " . $nada .  " / " . $nada;
        
        echo $todo;
        die();

    }


?>