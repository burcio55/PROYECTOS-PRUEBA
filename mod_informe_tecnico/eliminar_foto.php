<?php
include('based.php');

    $variable = $_REQUEST['eliminar_id'];

 /* echo "1 / ".$variable; */

    $SQL2 = "UPDATE reporte_tecnico.adjuntos SET benabled ='FALSE' WHERE id = '" . $variable . "'";
       /*  echo "1 / ".$SQL2; */
        
    if ($resultado = pg_query($conn, $SQL2)){
            echo "1 / Se ha eliminado correctamente"; 
            die();       
    } else {
        echo "0 / Ha ocurrido un error."; 
        die();
    }
    
?>