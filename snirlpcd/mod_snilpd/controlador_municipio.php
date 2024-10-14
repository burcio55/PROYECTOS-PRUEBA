<?php
    include("../include/BD.php");
	$conn = Conexion::ConexionBD();

    $id = $_POST['id'];
    $sql = "SELECT * FROM public.municipio where status = 'A' AND estado_id = '".$id."' ORDER BY nombre;";
    $row = pg_query($conn,$sql);
    $municipios = pg_fetch_all($row);
    $op = "<option value= -1>Seleccionar</option>";
    foreach($municipios as $municipio){
        $op .= "<option value=".$municipio['id'].">".$municipio['nombre']."</option>";
    }

    echo $op;
    /*$data = $_POST['id'];
    var_dump($data);die($data);
    echo $sql;*/
?> 