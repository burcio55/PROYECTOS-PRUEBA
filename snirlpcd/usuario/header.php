<?php
    /*session_start();

    if(!isset($_SESSION['usuario'])){
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
    <title>AGENCIA DE EMPLEO </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link's CSS -->
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nuevo.css">
    <link rel="stylesheet" href="../css/font/fontello.css">
    <link href='../css/p.css' rel=stylesheet>
    <link href=":./css/f.css" rel="stylesheet">
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
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" onclick="emerjer()" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">SNILPD</a>
                <div class="dropdown-menu" id="submenu" style="display: none;">
                    <a class="dropdown-item" href="1_1agen_trab_datos.php">Datos Personales</a>
                    <a class="dropdown-item" href="discapacidad.php">Discapacidad</a>
                    <a class="dropdown-item" href="1_5agen_trab_educacion.php">Educación</a>
                    <a class="dropdown-item" href="1_6agen_trab_capacitacion.php">Capacitación</a>
                    <a class="dropdown-item" href="1_4agen_trab_ocupacion.php">Situación Ocupacional</a>
                    <a class="dropdown-item" href="1_8agen_trab_experiencia.php">Experiencia Laboral</a>
                    <a class="dropdown-item" href="1_12agen_trab_foto.php">Foto</a>
                    <a class="dropdown-item" href="1_14agen_trab_formatos.php">Formato</a>
                    <a class="dropdown-item" href="#">Oportunidad de Trabajo</a>
                    <!--a class="dropdown-item" href="#"></a>
                    <a class="dropdown-item" href="#"></a>
                    <a class="dropdown-item" href="#"></a>
                    <a class="dropdown-item" href="#"></a-->
                </div>
                <script>
                    function emerjer(){
                        if (document.getElementById("submenu").style.display == "none") {
                            document.getElementById("submenu").style.display = "block";
                            }
                            else {
                                document.getElementById("submenu").style.display = "none";
                        }
                    }
                </script>
            </div>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" onclick="abrir2()" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Configuración</a>
                <div class="dropdown-menu" id="submenu2" style="display: none;">
                    <a class="dropdown-item" href="1_1agen_trab_datos.php">Cambiar Clave</a>
                </div>
                <script>
                    function abrir2(){
                        if (document.getElementById("submenu2").style.display == "none") {
                            document.getElementById("submenu2").style.display = "block";
                            }
                            else {
                                document.getElementById("submenu2").style.display = "none";
                        }
                    }
                </script>
            </div>
            <a class="nav-link active" href="#">Ayuda</a>
            <a class="nav-link active" href="../mod_login/cerrar_sesion.php">Cerrar Sesión</a>
        </div>
    </nav>
    <br>
    <div class="container">
        <div class="row">