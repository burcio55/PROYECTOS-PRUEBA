<?php
session_start(); //- Iniciar una nueva sesión o reanudar la existente
//var_dump($_SESSION);
//var_dump($_SESSION["condition_question_2"][1]);
include_once('modal.php');

// Validación del reCAPTCHA

if (isset($_POST['submit'])) {

    $ip = $_SERVER['REMOTE_ADDR'];

    $captcha = $_POST['g-recaptcha-response'];
    $secretkey = "6LdCiuMmAAAAAGYqnMY4fn3ohOE1KKEbusZqk7lH";

    $resp_captcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");

    $atributos = json_decode($resp_captcha, TRUE);

    if (!$atributos['success']) {
?>
        <script>
            alert("Verificar captcha");
        </script>
<?php
    }
}

?>

<!doctype html>
<html lang="Es-es">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SNIRLPCD</title>
    <!-- Bootstrap CSS  v5.1 CDN    -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->

    <!-- Bootstrap CSS  v5.1.3
        Maquetado de Header y el Menu con las opciones
        LIBRERIA COMPLETA Y LOS JS-->
    <link rel="stylesheet" href="../css/bootstrap5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font/fontello.css">
    <link rel="stylesheet" href="fontello/css/fontello.css">
    <link rel="stylesheet" href="../css/fontelo.css">
    <!-- Bootstrap CSS  v5.1.3
        Maquetado de Header y el Menu con las opciones
        https://getbootstrap.com/docs/5.1/getting-started/introduction/
    -->
    <!--<link rel="stylesheet" href="../css/bootstrap.css">-->
    <!-- Indispensable Maquetado del Login y el efecto de transición-->
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/todo-login2.css">
    <!-- trabaja con main.js CSS -->

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">




    <!--<link rel="stylesheet" href="../css/estilos.css">-->

    <!--<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
    <link href="../css/login.css" rel="stylesheet" type="text/css" />
    <link href="../css/font/fontello.css" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/validacion_general.js"></script>	
    <script type="text/javascript" src="validar_login.js"></script>	
    <script type="text/javascript" src="funciones.js"></script>	
    <script type="text/javascript" src="base64.js"></script>-->
</head>
<div id="alerta" class="fondo_alerta">
        <div class="alerta">
            <h4 id="titulo"></h4>
            <p id="texto"></p>
            <center><input type="button" id='btncerrar' name='btncerrar' style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: center; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onclick="cerrar_alert()" data-bs-toggle="tooltip" value="Cerrar"></center>
        </div>
    </div>
<body>

    <!--  Header -->
    <header>
        <center>
            <div class="logo mg-l-3">
                <img tabindex="1" alt="Gobierno bolivariano de Venezuela" class="w-h-100" src="../imagenes/cintillo_institucional.jpg">
            </div>
        </center>
        <nav class="navbar navbar-expand-lg navbar-dark bg-color-white">
            <div class="container-fluid ">
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
                <div class="mg-opciones mg-nav" id="navbarColor02">
                    <div>
                        <ul class="navbar-nav me-auto navbar-pequenio">
                            <li class="nav-item mglr-20 mg-r-20 li-1" style="font-size: 16px; margin-right: 30px">
                                <a tabindex="2" class="nav-link active text-black" href="../index.php">Inicio</a>
                            </li>
                            <li class="nav-item mg-r-20 li-2" style="font-size: 16px; margin-right: 30px">
                                <a tabindex="3" class="nav-link text-black" href="../nosotros.php">Nosotros</a>
                            </li>
                            <li class="nav-item mg-r-20 li-2" style="font-size: 16px; margin-right: 30px">
                                <a tabindex="4" class="nav-link text-black" href="login3.php">Registrarse</a>
                            </li>
                            <li class="nav-item li-3" style="font-size: 16px; margin-right: 30px">
                                <a tabindex="5" class="nav-link text-black" href="login2.php">Iniciar Sesión</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
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
    <main>
        <div class="content-video3 video">
            <video src="../videos/video_iniciar_sesion.mp4" class="video" controls>
                <!-- <source src="videos/video_prueba.mp4" type="video/mp4"> -->
            </video>
        </div>
        <div class="contenedor_todo">
            <div class="caja_trasera">
                <div class="caja_trasera-login">
                    <h3 tabindex="24">¿Ya tienes una cuenta?</h3>
                    <p tabindex="25">Inicia Sesión para Entrar en el Sistema</p>
                    <a href="login2.php">
                        <button tabindex="26" aria-label="Inicia Sesión" id="btn_iniciar-sesion" style="font-size: 16px; background-color: #fff; color: #46A2FD; font-weight: bold;" onmouseover='this.style.color="#fff"; this.style.backgroundColor="#46A2FD";' onmouseout='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";'>Iniciar Sesión</button>
                    </a>
                </div>
            </div>
            <!--Formulario de Login y registro  row g-3 was-validated  needs-validation" novalidate -->
            <div class="contenedor_login-register">

                <!--olvidó Contreaseña-->
                <form id="frm_olvido" name="frm_olvido" action="login4.php" method="POST" class="formulario_clave needs-validation novalidate">
                    <center>
                        <img tabindex="6" alt="logo del Ministerio del Poder Popular para el Proceso Social de Trabajo" style="width: 30%; margin: -10px 0 10px 0" src="../imagenes/logo.png">
                    </center>
                    <h2 tabindex="8">¿Olvidó Contraseña?</h2>
                    <center><label style="color: #BF1F13; font-size: 15px"> Datos Obligatorios (*) </label><br></center>

                    <div class="input-group">
                        <select tabindex="9" alt="es obligatorio llenar su nacionalidad" style="width: 20%;" name="nacionalidad" id="nacionalidad" data-bs-toggle="tooltip" data-bs-placement="left" title="Nacionalidad">
                            <option value="">***</option>
                            <option value="V">V</option>
                            <option value="E">E</option>
                        </select>
                        <span><i class="" style="padding:5px; color: gray"></i></span>
                        <input tabindex="10" alt="es obligatorio indicar su cédula de identidad" type="text" style="width: 45%;" class="form-control" placeholder="Cédula de Identidad" name="ced_afiliado" id="ced_afiliado" maxlength="11" pattern="[0-9]{7,11}" data-bs-toggle="tooltip" data-bs-placement="right" title="Cédula">
                        <!--<button type="button" class="btn btn_consultar_saime2 btn-secondary float-right" data-bs-toggle="tooltip" data-bs-placement="right" title="Buscar">B</button-->
                    </div>
                    <!--input type="text" class="form-control" name="nombre" id="nombre" style="width:100%" placeholder="Nombre" disabled>
                    <input type="text" class="form-control" name="apellido" id="apellido" style="width:100%" placeholder="Apellido" disabled  id="btn_validacion"-->
                    <input tabindex="11" type="button" onclick="olvido(nacionalidad.value,ced_afiliado.value)" class="btn_siguiente1" style="width: 100%; font-size: 16px; background-color: #46A2FD; border: 1px Solid #46A2FD; color: #fff; font-weight: bold;" onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' value="Validar" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Validar Cuenta" class="btn-outline-p">
                    <br><br><br>
                    <p style="margin-top: -20px; color: #BF1F13;" tabindex="7">Se recomienda usar el navegador Google Chrome</p>
                    <center><span><img src="../imagenes/cromo.png" alt="" style="width: 25px"></span></center>
                </form>

                <!-- ************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************* -->

                <form id="frm_olvido2" name="frm_olvido2" action="" method="POST" class="formulario_validacion needs-validation" style="display: none;">
                    <center>
                        <img tabindex="12" alt="logo del Ministerio del Poder Popular para el Proceso Social de Trabajo" style="width: 30%; margin: -10px 0 10px 0" src="../imagenes/logo.png">
                    </center>
                    <h2>¿Olvidó Contraseña?</h2><br>
                    <h6 id="nombress" style="color: grey;"><!-- Nombre(s): --></h6>
                    <h6 id="apellidoss" style="color: grey;"><!-- Apellido(s): --></h6>
                    <h6 tabindex="14" style="color: grey; text-align: justify">Para continuar con el proceso de "Olvidó Contraseña", por favor responda las siguientes preguntas:</h6>
                    <h6 tabindex="15" id="Pregunta1" style="color: grey; margin-top: 25px"></h6>
                    <div class="form-check">
                        <input tabindex="16" alt="En caso de que la respuesta sea Si" class="form-check-input" type="radio" style="width: 20px; border: 1px solid black" name="flexRadioDefault1" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            SI
                        </label>
                    </div>
                    <div class="form-check">
                        <input tabindex="19" alt="En caso de que la respuesta sea No" class="form-check-input" type="radio" style="width: 20px; border: 1px solid black" name="flexRadioDefault1" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            NO
                        </label>
                    </div>
                    <h6 tabindex="20" id="Pregunta2" style="color: grey; margin-top: 25px"></h6>
                    <div class="form-check2">
                        <input tabindex="21" alt="En caso de que la respuesta sea Si" class="form-check-input" type="radio" style="width: 20px; border: 1px solid black" name="flexRadioDefault2" id="flexRadioDefault3">
                        <label class="form-check-label" for="flexRadioDefault1">
                            SI
                        </label>
                    </div>
                    <div class="form-check2">
                        <input tabindex="22" alt="En caso de que la respuesta sea No" class="form-check-input" type="radio" style="width: 20px; border: 1px solid black" name="flexRadioDefault2" id="flexRadioDefault4">
                        <label class="form-check-label" for="flexRadioDefault2">
                            NO
                        </label>
                    </div>

                    <!--<br><h6 style="color: grey;">INDIQUE SU FECHA DE NACIMIENTO:</h6>
                    <div style="width: 50%;margin: 0 80px">
                        <input type="radio" id="radioPrimary13" style="width: 10%;" onclick="javascript:seleccion()" name="r7">
                        <span class="text-secondary">SI</span>
                    </div>
                    <div style="width: 50%;margin: -33px 0px 0 190px; position:relative;">
                        <input type="radio" id="radioPrimary14" style="width: 10%;" onclick="javascript:deselecion()" name="r7">
                        <span class="text-secondary">NO</span>
                    </div-->

                    <? //echo $array1[0]."<br>"; 
                    ?>
                    <? //echo $array1[1]."<br>"; 
                    ?>
                    <input tabindex="23" type="button" style="width: 100%; font-size: 16px; background-color: #46A2FD; border: 1px Solid #46A2FD; color: #fff; font-weight: bold;" onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onclick="validar()" id="btn_iniciar" value="Siguiente">
                    <!--btn_iniciar = valor de un atributo que es usado en js/main el cual alista un evento y llama a la funcion iniciar
                        para mostrar y ocultar formularios-->
                    <!--button id="btn_iniciar-sesion">Siguiente</button-->
                    <br><br><br>
                    <p style="margin-top: -20px; color: #BF1F13;" tabindex="13">Se recomienda usar el navegador Google Chrome</p>
                    <center><span><img src="../imagenes/cromo.png" alt="" style="width: 25px"></span></center>
                </form>
            </div>
        </div>
    </main>
    <br><br><br>
    <footer>
        <br>
        <div style="margin: -98px auto 0 auto">
            <center>
                <div class="cent"><br><br><br>
                    <h5 tabindex="27" style="color: white; font-size: 15px">
                        Centro Simón Bolívar. Torre Sur. Caracas, Distrito Capital. Ministerio del Poder Popular para el Proceso Social de Trabajo. RIF G-20000012-0 <br>
                        Oficina de Tecnología de la Información y la Comunicación (OTIC) - División de Análisis y Desarrollo de Sistemas.<br>
                        © 2023 Todos los Derechos Reservados.
                    </h5>
                </div>
            </center>
        </div>
    </footer>
    <!-- Script's -->
    <!-- CDN -->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->

    <script type="text/javascript" src="../css/bootstrap5.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../css/bootstrap5.1.3/js/popper.min.js"></script>
    <!-- popper es indispensable para el manejo de los Tooltips Editados con bootstrap.bundle -->

    <!--<script type="text/javascript" src="../css/bootstrap5.1.3/js/bootstrap.js"></script> -->


    <!-- //Libreria principal jquery-3.6.0-->
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <!--<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>-->

    <script type="text/javascript" src="js/login.js"></script>
    <script type="text/javascript" src="js/bloq.js"></script>
    <script type="text/javascript" src="js/numbers.js"></script>
    <script type="text/javascript" src="js/olvido_pass.js"></script>
    <script type="text/javascript" src="js/pass-eje.js"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- <script src="js/main.js"></script> -->
    <!--<script src="js/pass-eje.js"></script>-->
</body>

</html>