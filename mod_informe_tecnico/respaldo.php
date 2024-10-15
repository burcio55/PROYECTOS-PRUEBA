<?
/* if ($num_regis > 0) {
        $config2 = "SELECT * FROM
                    reporte_tecnico.reportes_fallas
                    WHERE
                    fecha_insercion != '0'
                    AND
                    personales_id = '$persona_id'
                    AND
                    fecha_insercion = '$date'
                    AND
                    benabled = 'TRUE'
                    LIMIT 1
        ";
        $rw2 = pg_query($conn, $config2);
        $pers = pg_fetch_assoc($rw2);
    
        $num_regis2 = $pers["snro_reporte"];
    
        $snro_reporte = $num_regis2;

        echo "0 / Config2" . $config2;
        die();

    } else {
         Obtener el total de registros para la fecha actual y cédula
        $config3 = "SELECT COUNT(*) AS total_registros
                    FROM reporte_tecnico.reportes_fallas
                    WHERE personales_id = '$persona_id'
                    AND fecha_insercion = '$date'
                    AND benabled = 'TRUE'";
        $rw3 = pg_query($conn, $config3);
        $pers2 = pg_fetch_assoc($rw3);
    
        $total_registros = $pers2["total_registros"];

        echo "0 / Configtotal: " . $total_registros;
        die();

    
         Mantener el mismo número de reporte hasta un máximo de 5 registros
        if ($total_registros < 5) {
            $snro_reporte = $date . "-" . str_pad($total_registros + 1, 3, "0", STR_PAD_LEFT);
        } else {
            Comenzar un nuevo número de reporte
            $snro_reporte = $date . "-001";
        }

         echo "0 / Config3" . $config3;
        die(); 
    }
     */

phpinfo();

?>