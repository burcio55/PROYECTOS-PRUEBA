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
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SNIRLPCD </title>
    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet" href="../css/bootstrap5.1.3/css/bootstrap.min.css">-->
    <!--<link rel="stylesheet" href="../css/bootstrap.css">-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <!-- Link's CSS -->
    <!-- Indispensable Maquetado del Login y el efecto de transición-->
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/todo-login.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/font/fontello.css">
    <link rel="stylesheet" href="../css/fontelo.css">
    <link rel="stylesheet" href="fontello/css/fontello.css">
    <!--<link rel="stylesheet" href="../css/nuevo.css">-->
    <link rel="stylesheet" href="../css/font/fontello.css">
    <!-- //Libreria principal jquery-3.6.0-->
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<div id="alerta" class="fondo_alerta">
        <div class="alerta">
            <h4 id="titulo"></h4>
            <p id="texto"></p>
            <center><input type="button" id='btncerrar' name='btncerrar' style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: center; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onclick="cerrar_alert()" data-bs-toggle="tooltip" value="Cerrar"></center>
        </div>
    </div>
<body class="capa-fondo">
    <center>
        <div class="img-logo-content">
            <img alt="Gobierno bolivariano de Venezuela Ministerio del Poder Popular para el Proceso Social de Trabajo" src="../imagenes/cintillo_institucional.jpg" class="w-h-100">
        </div>
    </center>
    <div class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="nav navbar-nav mg-nav">
            <a tabindex="2" class="nav-link active li-1" href="index.php">Menú Principal</a>
            <div class="nav-item dropdown mg-opciones" id="tabla">
                <a tabindex="3" class="nav-link dropdown-toggle li-2" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="color: rgba(0, 0, 0, .9);">Persona</a>
                <div class="dropdown-menu submenu" id="submenu">
                    <a class="dropdown-item" href="datos_personales.php">Datos Personales</a>
                    <a class="dropdown-item" href="discapacidad.php">Discapacidad</a>
                    <a class="dropdown-item" href="educacion.php">Educación</a>
                    <a class="dropdown-item" href="capacitacion.php">Capacitación</a>
                    <a class="dropdown-item" href="situacion_ocupacional.php">Situación Ocupacional</a>
                    <a class="dropdown-item" href="experiencia_laboral.php">Experiencia Laboral</a>
                    <a class="dropdown-item" href="foto.php">Foto</a>
                    <a class="dropdown-item" href="formatos.php">Formatos</a>
                    <a class="dropdown-item" href="oportunidad.php">Oportunidad de Empleo</a>
                </div>
                <!-- Letras en Mayúsculas -->
                <script>
                    function mayus(e) {
                        e.value = e.value.toUpperCase();
                    }
                </script>
                <script>
                    let tabla = document.getElementById("tabla");
                    let recibir = document.getElementById("submenu");
                    let retrazo = "";
                    const width = window.innerWidth;

                    if (width <= 960) {
                        // Iterar sobre los elementos
                        recibir.forEach((recibir) => {
                            // Añadir un evento de clic al elemento
                            recibir.addEventListener('keypress', () => {
                                // Desplegar el submenú
                                recibir.children[1].style.display = 'block';
                            });
                        });
                    } else {
                        tabla.addEventListener("mouseover", (event) => {
                            recibir.style.display = "block";
                        });

                        tabla.addEventListener("mouseout", (event) => {
                            recibir.style.display = "none"
                        });
                    }
                </script>
            </div>
            <div class="nav-item dropdown" id="tabla2">
                <a tabindex="4" class="nav-link dropdown-toggle li-3" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="color: rgba(0, 0, 0, .9);">Configuración</a>
                <div class="dropdown-menu submenu" id="submenu2">
                    <a class="dropdown-item" href="../mod_login/olvido_contra.php">Cambiar Contraseña</a>
                </div>
                <script>
                    let tabla2 = document.getElementById("tabla2");
                    let recibir2 = document.getElementById("submenu2");
                    const width2 = window.innerWidth;

                    if (width <= 960) {
                        // Iterar sobre los elementos
                        recibir2.forEach((recibir) => {
                            // Añadir un evento de clic al elemento
                            recibir2.addEventListener('keypress', () => {
                                // Desplegar el submenú
                                recibir2.children[1].style.display = 'block';
                            });
                        });
                    } else {
                        tabla2.addEventListener("mouseover", (event) => {
                            recibir2.style.display = "block";
                        });

                        tabla2.addEventListener("mouseout", (event) => {
                            recibir2.style.display = "none"
                        });
                    }
                </script>
            </div>
            <a tabindex="5" class="nav-link active li-4" href="../Documentación/guia_usuario11102023.pdf" target="_blank">Guía de Usuario</a>
            <a tabindex="6" class="nav-link active li-5" href="../mod_login/cerrar_sesion.php">Cerrar Sesión</a>
        </div>
    </div>
    <br>
    <input type="text" id="link" value="" style="display: none;">
    <script>
        function cerrar_alert(){
            document.getElementById("alerta").style.display = "none";
            let link = document.getElementById("link").value;
            if(link != ""){
                document.getElementById("link").value = "";
                $(location).attr('href',link);
            }
        }
    </script>
    <div class="container">
        <div class="row">