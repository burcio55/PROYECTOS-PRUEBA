<?php
session_start();

/*if(!isset($_SESSION['usuario'])){
        echo '
            <script>
                alert("Por favor debes iniciar sesión");
                window.location = "index.php";
            </script>
        ';
        session_destroy();
        die();
    }*/
?>
<!doctype html>
<html lang="Es-es">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SNIRLPD </title>
    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet" href="../css/bootstrap5.1.3/css/bootstrap.min.css">-->
    <!--<link rel="stylesheet" href="../css/bootstrap.css">-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <!-- Link's CSS -->
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/fondo.css">
    <link rel="stylesheet" href="../css/style.css">
    <!--<link rel="stylesheet" href="../css/nuevo.css">-->
    <link rel="stylesheet" href="../css/font/fontello.css">
    <link href='../css/p.css' rel=stylesheet>
    <link href=":./css/f.css" rel="stylesheet">
    <!-- //Libreria principal jquery-3.6.0-->
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
</head>

<body class="capa-fondo">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div style="width: 600px; height: 50px; position: absolute; margin: -10px 0 -25px 0sd;">
            <img src="../imagenes/cintillo_institucional.jpg" style="width: 100%; height: 100%;">
        </div>
        <div class="nav navbar-nav" style="margin-left:57%; font-size: 14px">
            <a class="nav-link active" href="index.php">Menú Principal</a>
            <div class="nav-item dropdown" id="tabla">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">SNIRLPD</a>
                <div class="dropdown-menu" id="submenu" style="display: none; margin-top: -5px">
                    <a class="dropdown-item" href="datos_personales.php">Datos Personales</a>
                    <a class="dropdown-item" href="discapacidad.php">Discapacidad</a>
                    <a class="dropdown-item" href="educacion.php">Educación</a>
                    <a class="dropdown-item" href="capacitacion.php">Capacitación</a>
                    <a class="dropdown-item" href="situacion_ocupacional.php">Situación Ocupacional</a>
                    <a class="dropdown-item" href="experiencia_laboral.php">Experiencia Laboral</a>
                    <a class="dropdown-item" href="foto.php">Foto</a>
                    <a class="dropdown-item" href="formatos.php">Formatp</a>
                    <a class="dropdown-item" href="oportunidad_trabajo.php">Oportunidad de Trabajo</a>
                    <!--a class="dropdown-item" href="#"></a>
                    <a class="dropdown-item" href="#"></a>
                    <a class="dropdown-item" href="#"></a>
                    <a class="dropdown-item" href="#"></a-->
                </div>
                <script>
                    let tabla = document.getElementById("tabla");
                    let recibir = document.getElementById("submenu");
                    let retrazo = "";

                    tabla.addEventListener("mouseover", (event) => {
                        recibir.style.display = "block";
                    });

                    tabla.addEventListener("mouseout", (event) => {
                        recibir.style.display = "none"
                    });
                </script>
            </div>
            <div class="nav-item dropdown" id="tabla2">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Configuración</a>
                <div class="dropdown-menu" id="submenu2" style="display: none; margin-top: -5px">
                    <a class="dropdown-item" href="../mod_login/olvido_contra.php">CAMBIAR CLAVE</a>
                </div>
                <script>
                    let tabla2 = document.getElementById("tabla2");
                    let recibir2 = document.getElementById("submenu2");

                    tabla2.addEventListener("mouseover", (event) => {
                        recibir2.style.display = "block";
                    });

                    tabla2.addEventListener("mouseout", (event) => {
                        recibir2.style.display = "none";
                    });
                </script>
            </div>
            <a class="nav-link active" href="#">Ayuda</a>
            <a class="nav-link active" href="../mod_login/cerrar_sesion.php">Cerrar Sesión</a>
        </div>
    </nav>
    <br>
    <div class="container">
        <div class="row">