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
                    <h3 tabindex="22">¿Ya tienes una cuenta?</h3>
                    <a href="login2.php">
                        <button tabindex="24" aria-label="Iniciar Sesión" id="btn_iniciar-sesion" style="font-size: 16px; background-color: #fff; color: #46A2FD; font-weight: bold;" onmouseover='this.style.color="#fff"; this.style.backgroundColor="#46A2FD";' onmouseout='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";'>Iniciar Sesión</button>
                    </a>
                </div>
            </div>
            <!--Formulario de Login y registro  row g-3 was-validated  needs-validation" novalidate -->
            <div class="contenedor_login-register">

                <!--Register-->
                <!-- El Archivo "Enviar.php" se encarga de enviar los datos al correo del usuario -->
                <form id="frmRegistro" name="frmRegistro" action="enviar.php" method="POST" class="formulario_register needs-validation">
                    <center>
                        <img tabindex="5" alt="logo del Ministerio del Poder Popular para el Proceso Social de Trabajo" style="width: 30%; margin: -10px 0 10px 0" src="../imagenes/logo.png">
                    </center>
                    <h2 tabindex="7">Registrarse</h2>
                    <center>
                        <label style="color: #BF1F13; font-size: 15px"> Datos Obligatorios (*) </label><br>
                        <div class="input-group">
                            <select tabindex="8" aria-label="Es obligatorio indicar su nacionalidad" style="width: 100%" name="nacionalidad" id="nacionalidad" data-bs-toggle="tooltip" data-bs-placement="left" title="Nacionalidad" required>
                                <option value="">Nacionalidad *</option>
                                <option value="V">Venezolano</option>
                                <option value="E">Extranjero</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <input tabindex="9" aria-label="Es obligatorio indicar su Cédula de Identidad" type="text" style="width: 80%; max-width: 210px" class="form-control" placeholder="Cédula de Identidad *" name="ced_afiliado" id="ced_afiliado" maxlength="11" onkeypress="return numbers(event);" required pattern="[0-9]{6,11}">
                            <span style="width: 10px; background-color: #fff"></span>
                            <button tabindex="10" type="button" class="btn btn-secondary float-right btn-outline-p" data-bs-toggle="tooltip" data-bs-placement="right" onclick="buscar(nacionalidad.value,ced_afiliado.value);" title="Buscar" style="font-size: 16px; background-color: #46A2FD; border: 1px Solid #46A2FD; color: #fff" onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"'>Buscar</button>
                        </div>
                    </center>
                    <div id="grup2" style="display: none;">
                        <center>
                            <div class="input-group" style="margin-top: -10px">
                                <input tabindex="11" style="width:40%;margin-bottom:-10px;" type="text" class="form-control" placeholder="Primer Nombre *" name="nombre_afiliado1" id="nombre_afiliado1" maxlength="15" required pattern="[A-Za-zÑ-ñÁ-Éó-úÍ ]{3,15}">
                                <span><i class="" style="padding:5px; color: gray"></i></span>
                                <input tabindex="12" style="width:40%;margin-bottom:-10px;" type="text" class="form-control" placeholder="Segundo Nombre" name="nombre_afiliado2" id="nombre_afiliado2" maxlength="15" pattern="[A-Za-zÑ-ñÁ-Éó-úÍ ]{3,15}">
                            </div>
                            <!--
                                <select style="width: 20%;" name="cbCed_afiliado">
                                    <option value="">*</option>
                                    <option value="V">V-.</option>
                                    <option value="E">E.-</option>
                                </select>
                                <span><i class="icon-cedula" style="padding:5px; color: gray"></i></span><input type="number" style="width: 70%;" placeholder="Cédula de Identidad*" name="ced_afiliado" min="3000000" max="50000000">
                                <span><i class="icon-at" style="padding:5px; color: gray"></i></span><input style="width:40%;margin-bottom:-10px;" type="text" placeholder="Primer Nombre*" name="name">
                                <span><i class="icon-at" style="padding:5px; color: gray"></i></span><input style="width:42.5%;margin-bottom:-10px;" type="text" placeholder="Segundo Nombre" name="name2">-->



                            <!--<span><i class="icon-at" style="padding:5px; color: gray"></i></span><input style="width:40%;margin-bottom:-10px;" type="text" placeholder="Primer Apellido*" name="name3">
                            <span><i class="icon-at" style="padding:5px; color: gray"></i></span><input style="width:42.5%;margin-bottom:-10px;" type="text" placeholder="Segundo Apellido" name="name4"-->
                            <div class="input-group">
                                <input tabindex="13" style="width:40%;margin-bottom:-10px;" class="form-control" type="text" placeholder="Primer Apellido *" name="apellido_afiliado1" id="apellido_afiliado1" maxlength="15" required pattern="[A-Za-zÑ-ñÁ-Éó-úÍ ]{3,15}">
                                <span><i class="" style="padding:5px; color: gray"></i></span>
                                <input tabindex="14" style="width:40%;margin-bottom:-10px;" class="form-control" type="text" placeholder="Segundo Apellido" name="apellido_afiliado2" id="apellido_afiliado2" maxlength="15" pattern="[A-Za-zÑ-ñÁ-Éó-úÍ ]{3,15}">
                            </div>
                        </center>
                        <!--<label>Sexo *:</label-->
                        <!-- <select tabindex="15" name="cbSexo_afiliado" id="cbSexo_afiliado" style="width: 48.75%; height: 45px; display: inline; border-top-right-radius: 0; border-bottom-right-radius: 0; margin-right: 4px" required disabled>
                                <option value="0" selected="selected">Sexo *</option>
                                <option value="1">Femenino</option>
                                <option value="2">Masculino</option>
                            </select> -->
                        <input tabindex="15" style="width: 48.75%; height: 45px; display: inline; border-top-right-radius: 0; border-bottom-right-radius: 0; margin-right: 4px; color:black" type="text" placeholder="Sexo" name="cbSexo_afiliado" id="cbSexo_afiliado" required disabled>
                        <!--<label> Fecha de Nacimiento *: </label><br-->
                        <input tabindex="16" alt="Es obligatorio indicar su fecha de nacimineto" type="DATE" style="text-align: center; color: rgb(104, 103, 103); width: 48.75%; height: 45px; display: inline; border-top-left-radius: 0; border-bottom-left-radius: 0" class="form-control" data-bs-toggle="tooltip" data-bs-placement="left" title="Fecha de Nacimiento" name="fnacimiento_afiliado" id="fnacimiento_afiliado" required>
                        <!--<input type="DATE" style="color: gray;">
                            <label style="color: grey;"> Fecha de Nacimiento: </label><br>
                            <input style="text-align: center; color: rgb(104, 103, 103); width: 90%" type="date" name="fnacimiento_afiliado" min="1" max="31"><span><i class="icon-calendario" style="padding:5px; color: gray"></i></span-->
                        <input tabindex="17" alt="Es obligatorio indicar su número telefónico" type="text" class="form-control" name="telefono_afiliado" id="telefono_afiliado" data-bs-toggle="tooltip" data-bs-placement="left" title="Teléfono Personal" placeholder="Teléfono Personal *" maxlength="11" style="margin: 5px 0; width: 48.75%; height: 45px; display: inline; border-top-right-radius: 0; border-bottom-right-radius: 0; margin-right: 4px" onkeypress="return numbers(event);" required pattern="[0-9]{11,11}" />
                        <input tabindex="18" alt="Es opcional indicar un número telefónico secundario" type="text" class="form-control" name="telefono_afiliado2" id="telefono_afiliado2" data-bs-toggle="tooltip" data-bs-placement="left" title="Teléfono de Habitación" placeholder="Teléfono de Habitación" maxlength="11" style="margin: 5px 0; color: rgb(104, 103, 103); width: 48.75%; height: 45px; display: inline; border-top-left-radius: 0; border-bottom-left-radius: 0" onkeypress="return numbers(event);" pattern="[0-9]{11,11}" />
                        <input tabindex="19" alt="Es obligatorio indicar correo electrónico" type="email" class="form-control" data-bs-toggle="tooltip" data-bs-placement="left" title="Correo Electrónico" placeholder="Ingrese su Correo Electrónico *" name="email_afiliado" id="email_afiliado" style="margin: 0 0 5px 0" required>
                        <input tabindex="20" alt="debe repetir el correo electrónico" type="email" class="form-control" data-bs-toggle="tooltip" data-bs-placement="left" title="Confirmar Correo Electrónico" placeholder="Verificar su Correo Electrónico *" name="email_afiliado_V" id="email_afiliado_V" style="margin: 5px 0" required>
                        <input tabindex="21" type="button" value="Registrarse" class="btn btn-outline-primary btn_registrar" style="width: 100%; font-size: 16px; background-color: #46A2FD; border: 1px Solid #46A2FD; color: #fff; font-weight: bold;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onclick="registrar(nacionalidad.value,ced_afiliado.value,nombre_afiliado1.value,nombre_afiliado2.value,apellido_afiliado1.value,apellido_afiliado2.value,cbSexo_afiliado.value,fnacimiento_afiliado.value,telefono_afiliado.value,telefono_afiliado2.value,email_afiliado.value,email_afiliado_V.value)" data-bs-toggle="tooltip" data-bs-placement="right" title="Registrar Usuario">
                        <!-- <button type='button' class="btn btn-outline-primary btn_registrar" style="width: 100%; font-size: 16px; background-color: #46A2FD; border: 1px Solid #46A2FD; color: #fff; font-weight: bold;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onclick="registrar(nacionalidad.value,ced_afiliado.value,nombre_afiliado1.value,nombre_afiliado2.value,apellido_afiliado1.value,apellido_afiliado2.value,cbSexo_afiliado.value,fnacimiento_afiliado.value,telefono_afiliado.value,email_afiliado.value,email_afiliado2.value)" data-bs-toggle="tooltip" data-bs-placement="right" title="Registrar Usuario" class="btn-outline-p">Registrarse</button> -->
                    </div>
                    <br>
                    <p style="color: #BF1F13;" tabindex="6">Se recomienda usar el navegador Google Chrome</p>
                    <center><span><img src="../imagenes/cromo.png" alt="" style="width: 25px"></span></center>
                    <!--<a href="../usuario/index.php"><button type='button' class='btn_registrar' title="Guardar Registro -  Haga Click para Guardar la Informaci&oacute;n">Registrarse</button></a-->
                </form>
            </div>
        </div>
    </main>
    <br><br><br><br><br><br><br>
    <footer>
        <!--div class="pub-1">
			<center>
				<h3><b>Logo empleado</b></h3>
				<img src="favicon/favicon.png"><br>
				<a href="https://www.freepik.es/vectores/logo">Vector de Logo creado por freepik - www.freepik.es</a>
			</center>
		</div>
		<div class="line"></div-->
        <br>
        <!-- <div class="pub-2" style="float: left; margin: -15px 0 0 0">
            <center>
                <div class="circle">
					<span class="icon-user"></span>
				</div>
                <div class="cent">
                    <h3 style="font-size: 20px; color: white; margin: 15px 0 0 0">
                        Despacho del Viceministro o Viceministra de Previsión Social.<br>
                    </h3>
                </div>
            </center>
        </div> -->
        <div style="margin: -70px auto 0 auto">
            <center>
                <div class="cent"><br><br><br>
                    <h5 tabindex="45" style="color: white; font-size: 15px">
                        Centro Simón Bolívar. Torre Sur. Caracas, Distrito Capital. Ministerio del Poder Popular para el Proceso Social de Trabajo. RIF G-20000012-0 <br>
                        Oficina de Tecnología de la Información y la Comunicación (OTIC) - División de Análisis y Desarrollo de Sistemas.<br>
                        © 2023 Todos los Derechos Reservados.
                    </h5>
                </div>
            </center>
        </div>
        <!--div class="sepa"></div>
		<div class="pub-3">
			<center>
				<div class="circle">
					<span class="icon-user"></span>
				</div>
				<h3><b>Carlos Aguiar</b></h3>
				<div class="cent">
					<a href="https://www.facebook.com"> Facebook </a><br>
					<a href="https://www.gmail.com"> Gmail </a><br>
					<a href="https://www.instagram.com"> Instagram </a><br>
					<a href="https://www.twitter.com"> Twttier </a>
				</div>
			</center>
		</div>
		<div class="sepa"></div>
		<div class="pub-4">
			<center>
				<div class="circle">
					<span class="icon-user"></span>
				</div>
				<h3><b>Roberto Contreras</b></h3>
				<div class="cent">
					<a href="https://www.facebook.com"> Facebook </a><br>
					<a href="https://www.gmail.com"> Gmail </a><br>
					<a href="https://www.instagram.com"> Instagram </a><br>
					<a href="https://www.twitter.com"> Twttier </a>
				</div>
			</center>
		</div-->
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