<?php

$nacionalidad = $_POST["nacionalidad"];
$ced_afiliado = $_POST["ced_afiliado"];
$nombre_afiliado1 = $_POST["nombre_afiliado1"];
$nombre_afiliado2 = $_POST["nombre_afiliado2"];
$apellido_afiliado1 = $_POST["apellido_afiliado1"];
$apellido_afiliado2 = $_POST["apellido_afiliado2"];
$cbSexo_afiliado = $_POST["cbSexo_afiliado"];
$fnacimiento_afiliado = $_POST["fnacimiento_afiliado"];
$telefono_afiliado = $_POST["telefono_afiliado"];
$email_afiliado = $_POST["email_afiliado"];

$header = 'Form: ' . $email_afiliado . "\r\n";
$header .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$header .= "Mine-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";

$message = "Este mensaje fue enviado por el Sistema Web de SNIRLPD \r\n";
$message .= "La Nacionalidad registrada fue: " . $nacionalidad . "\r\n";
$message .= "La Cédula de Identidad registrada fue: " . $ced_afiliado . "\r\n";
$message .= "El Nombre registrado fue: " . $nombre_afiliado1 . " " . $nombre_afiliado2 . " " . $apellido_afiliado1 . " " . $apellido_afiliado2 . "\r\n";
$message .= "El Sexo registrado fue: " . $cbSexo_afiliado . "\r\n";
$message .= "La Fecha de Nacimiento registrada fue: " . $fnacimiento_afiliado . "\r\n";
$message .= "Su Número de Teléfono Personal es: " . $telefono_afiliado . "\r\n";
$message .= "El Correo Electrónico registrado es: " . $email_afiliado . "\r\n";

$para = $email_afiliado;
$asunto = 'Datos Registranos en el SNIRLPCD';

mail($para, $asunto, utf8_decode($message), $header);

header("Location:login.php");
