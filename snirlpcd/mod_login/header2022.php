<?php
session_start();//- Iniciar una nueva sesión o reanudar la existente
//var_dump($_SESSION);
include_once('modal.php');

if(!isset($_SESSION['sUsuario']) ){
    header("location:login.php");
    /*if($_SESSION["status"] == 'A'){
        header("location:../mod_snilpd/index.php");
    }else{
        header("location:olvido_contra.php");
    }*/

    //session_destroy();
    //
    //die();
}
//else{
    //header("location:login.php");
//}


?>
<!doctype html>
<html lang="Es-es">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SNILPD</title>
        <!-- Bootstrap CSS  v5.1 CDN    -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->

    <!-- Bootstrap CSS  v5.1.3
        Maquetado de Header y el Menu con las opciones
        LIBRERIA COMPLETA Y LOS JS-->
    <link rel="stylesheet" href="../css/bootstrap5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font/fontello.css">
    <link rel="stylesheet" href="../css/fontelo.css">
    <!-- Bootstrap CSS  v5.1.3
        Maquetado de Header y el Menu con las opciones
        https://getbootstrap.com/docs/5.1/getting-started/introduction/
    -->
    <!--<link rel="stylesheet" href="../css/bootstrap.css">-->
    <!-- Indispensable Maquetado del Login y el efecto de transición-->
    <link rel="stylesheet" href="../css/inicio.css">
    <!-- trabaja con main.js CSS -->

    <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

</head>
<body class="capa-fondo">
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div style="width: 600px; height: 50px; position: absolute; margin: -10px 0 -25px 0sd;">
            <img src="../imagenes/cintillo_institucional.jpg" style="width: 100%; height: 100%;">
        </div>
        <div class="nav navbar-nav" style="margin-left:57%; font-size: 14px">
            <a class="nav-link active" href="index.php">Menú Principal</a>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" onclick="emerjer()" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">SNILPD</a>
                <div class="dropdown-menu" id="submenu" style="display: none;">
                    <a class="dropdown-item" href="../mod_snilpd/datos_personales.php">Datos Personales</a>
                    <a class="dropdown-item" href="discapacidad.php">Discapacidad</a>
                    <a class="dropdown-item" href="educacion.php">Educación</a>
                    <a class="dropdown-item" href="capacitacion.php">Capacitación</a>
                    <a class="dropdown-item" href="situacion_ocupacional.php">Situación Ocupacional</a>
                    <a class="dropdown-item" href="experiencia_laboral.php">Experiencia Laboral</a>
                    <a class="dropdown-item" href="foto.php">Foto</a>
                    <a class="dropdown-item" href="formatos.php">Formato</a>
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
                    <a class="dropdown-item" href="../mod_login/olvido_contra.php">Cambiar Clave</a>
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
                </header>
    <br>
    <div class="container">
        <div class="row">