<?php
    include("../include/BD.php");
	$conn = Conexion::ConexionBD();

    $id = $_POST['id'];
    $sql = "SELECT * FROM public.parroquia where status = 'A' AND municipio_id = '".$id."' ORDER BY nombre;";
    $row = pg_query($conn,$sql);
    $parroquias = pg_fetch_all($row);
    $op = "<option value= -1>Seleccionar</option>";
    foreach($parroquias as $parroquia){
        $op .= "<option value=".$parroquia['id'].">".$parroquia['nombre']."</option>";
    }

    echo $op;
    /*$data = $_POST['id'];
    var_dump($data);die($data);*/
?> 