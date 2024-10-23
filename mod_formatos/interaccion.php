<?
 include("bd.php");

    $query = " SELECT personal.id_personal,
                personal.primer_apellido as apellido1,
                personal.segundo_apellido as apellido2,
                personal.primer_nombre as nombre1,
                personal.segundo_nombre as nombre2, 
                personal.nacionalidad,
                personal.cedula as cedula, 
                trabajador.codigo_nomina as cod_nom,
                cargo.descripcion_cargo,
                dependencia.nombre as nombre_dep
                FROM trabajador
                INNER JOIN personal on personal.id_personal = trabajador.id_personal
                inner join cargo on trabajador.id_cargo = cargo.id_cargo
                inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia 
                WHERE personal.cedula='".$_SESSION['id_usuario']."' and estatus='A'
            ";
            /* echo $query;
            die(); */

            $SQL = pg_query($conn, $query);

            if ($row = pg_fetch_array($SQL, NULL, PGSQL_ASSOC)) {
                /* $_SESSION["id_persona"] = $row['id']; 
                $_SESSION["nusuario_creacion"] = $cedula; */
        
                $star = $row['nombre1'];
                $echeco = $row['nombre2'];
                $nombres = $row['nombre1'] . " " . $row['nombre2'] . " " . $row['apellido1']. " " . $row['apellido2'];
        
                $identificacion = $row['cedula'];

                $ubicacion_adm = $row['nombre_dep'];
        
                $ubicacion_fisica_actual = $row['ubicacion_fisica_actual'];
        
                $cargo = $row['descripcion_cargo'];

                $nomina = $row['cod_nom'];
        
                $scargo_actual_ejerce = $row['cargo_actual_ejerce'];

                $todo = "1 / " . $nombres . " / " . $identificacion . " / " . $cargo . " / " . $nomina . " / " . $ubicacion_adm . " / " . $nada;
                echo $todo;
                die();
        
            }

?>