<?php
//Agregamos la libreria para genera códigos QR
require "phpqrcode/qrlib.php";

//Declaramos una carpeta temporal para guardar la imagenes generadas
$dir = 'temp/';

//Si no existe la carpeta la creamos
if (!file_exists($dir))
    mkdir($dir);

//Declaramos la ruta y nombre del archivo a generar
$filename = $dir . 'test.png';

//Parametros de Condiguración

$tamaño = 6; //Tamaño de Pixel
$level = 'H'; //Precisión Máxima
$framSize = 3; //Tamaño en blanco
$contenido = "http://172.17.1.3/snirlpcd/pdf/registro3.php"; //Texto

//Enviamos los parametros a la Función para generar código QR 
QRcode::png($contenido, $filename, $level, $tamaño, $framSize);

//Mostramos la imagen generada
echo '<img src="' . $dir . basename($filename) . '" /><hr/>';
