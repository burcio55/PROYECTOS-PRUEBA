<?php
if (isset($_FILES["logo1"]) && $_GET['opcion'] == 1){
    $file = $_FILES["logo1"];
    $nombreimagen = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "../logos/";
	$ruta = "/minpptrassi/logos/";

    if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif')
    {
	  $datos = array("response"=>"nosuccess", "mensaje"=>"Error, el archivo no es una imagen");
	  echo json_encode($datos);
    }
    else if ($size > 1024*1024)
    {
	  $datos = array("response"=>"nosuccess", "mensaje"=>"Error, el tamaño máximo permitido es un 1MB");
	  echo json_encode($datos);	  
    }
    else if ($width > 211 || $height > 76)
    {
	  $datos = array("response"=>"nosuccess", "mensaje"=>"Error la anchura y la altura maxima permitida es 211px x 76px");
	  echo json_encode($datos);
    }
    else if($width < 211 || $height < 76)
    {
	  $datos = array("response"=>"nosuccess", "mensaje"=>"Error la anchura y la altura mínima permitida es 211px x 76px");
	  echo json_encode($datos);
    }
    else
    {
        $src = $carpeta.$nombreimagen;
        move_uploaded_file($ruta_provisional, $src);
		$src2 = $ruta.$nombreimagen;
		$datos = array("response"=>"success", "nombreimagen1"=>$nombreimagen);  
		echo json_encode($datos);
    }
}

if (isset($_FILES["logo2"]) && $_GET['opcion'] == 2){
    $file = $_FILES["logo2"];
    $nombreimagen = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "../logos/";
	$ruta = "/minpptrassi/logos/";

    if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif')
    {
	  $datos = array("response"=>"nosuccess", "mensaje"=>"Error, el archivo no es una imagen");
	  echo json_encode($datos);
    }
    else if ($size > 1024*1024)
    {
	  $datos = array("response"=>"nosuccess", "mensaje"=>"Error, el tamaño máximo permitido es un 1MB");
	  echo json_encode($datos);	  
    }
    else if ($width > 211 || $height > 76)
    {
	  $datos = array("response"=>"nosuccess", "mensaje"=>"Error la anchura y la altura maxima permitida es 211px x 76px");
	  echo json_encode($datos);
    }
    else if($width < 211 || $height < 76)
    {
	  $datos = array("response"=>"nosuccess", "mensaje"=>"Error la anchura y la altura mínima permitida es 211px x 76px");
	  echo json_encode($datos);
    }
    else
    {
        $src = $carpeta.$nombreimagen;
        move_uploaded_file($ruta_provisional, $src);
		$src2 = $ruta.$nombreimagen;
		$datos = array("response"=>"success", "nombreimagen2"=>$nombreimagen);  
		echo json_encode($datos);
    }
}
?>