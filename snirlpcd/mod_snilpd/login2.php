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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
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
                            <li class="nav-item mglr-20 mg-r-20 li-1">
                                <a tabindex="2" class="nav-link active text-black" href="../index.php">Inicio</a>
                            </li>
                            <li class="nav-item mg-r-20 li-2">
                                <a tabindex="3" class="nav-link text-black" href="../nosotros.php">Nosotros</a>
                            </li>
                            <li class="nav-item li-3">
                                <a href="login2.php">
                                    <button tabindex="4" type="button" class="btn btn-outline-primary" style="border-radius: 30px">Iniciar Sesión</button>
                                </a>
                                <a href="login3.php">
                                    <button tabindex="4" type="button" class="btn btn-outline-primary" style="border-radius: 30px">Registrarse</button>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="contenedor_todo">
            <div class="caja_trasera">
                <div class="caja_trasera-register">
                    <h3 tabindex="16">¿Aún no Tienes una Cuenta?</h3>
                    <p tabindex="17">Regístrate para que Puedas Iniciar Sesión</p>
                    <a href="login3.php">
                        <button tabindex="18" id="btn_registrarse" style="font-size: 16px; background-color: #fff; color: #46A2FD; font-weight: bold;" onmouseover='this.style.color="#fff"; this.style.backgroundColor="rgba(0, 128, 255, 0.5)";' onmouseout='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";'>Registrarse</button>
                    </a>
                </div>
            </div>
            <!--Formulario de Login y registro  row g-3 was-validated  needs-validation" novalidate -->
            <div class="contenedor_login-register">

                <!--Login-->
                <form id="frm" name="frm" action="login4.php" method="POST" class="formulario_login needs-validation">
                    <center>
                        <img tabindex="5" alt="logo del Ministerio del Poder Popular para el Proceso Social de Trabajo" style="width: 30%; margin: -10px 0 10px 0" src="../imagenes/logo.png">
                    </center>
                    <h2 tabindex="7">Iniciar Sesión</h2>
                    <center><label style="color: #BF1F13; font-size: 15px"> Datos Obligatorios (*) </label><br></center>
                    <div class="input-group" style="margin-bottom: 30px">
                        <select tabindex="8" aria-label="Es obligatorio indicar su nacionalidad" style="width: 15%" data-bs-toggle="tooltip" data-bs-placement="left" title="Nacionalidad" id="cbCed_afiliado" name="cbCed_afiliado">
                            <option value="">***</option>
                            <option value="V">V </option>
                            <option value="E">E </option>
                        </select>
                        <!-- 
                                Intento de Añadir ↓ en el Select

                                <span class="dir-domm">
                                    <img src="../imagenes/Flecha Abajo 1.png" alt="">
                                </span>
                            -->
                        <span><i class="" style="padding:5px; color: gray"></i></span>
                        <input tabindex="9" aria-label="Es obligatorio indicar su cédula de Indentidad" class="form-control" type="text" style="width: 75%;" placeholder="Cédula de Identidad *" onkeypress="return numbers(event);" id="txt_usuario" name="txt_usuario" value="">
                    </div>


                    <!--<span><i class="icon-cedula" style="padding:5px; color: gray"></i></span><input type="number" style="width: 71.5%;" id="txt_usuario" name="txt_usuario" placeholder="Cédula de Identidad *" maxlength="10"-->
                    <!--<input type="password" placeholder="Contraseña *" name="txt_clave">-->
                    <!--<div class="input-group">
                        <samp style="font-size: 15px;" class="icon-cerradura"></samp>
                        <input class="form-control" type="password" placeholder="Contraseña *" id="txt_clave" name="txt_clave" value="">
                    </div>-->
                    <div style="margin-top: 20px;">
                        <input tabindex="10" aria-label="Es obligatorio indicar su contraseña en caso de que se halla registrado" class="form-control" type="password" style="width: 90%; margin: -10px 0 0 0; position:relative;" placeholder="Contraseña *" id="txt_clave" name="txt_clave" value="">
                        <i tabindex="11" aria-label="boton para ocultar y mostrar contraseña" class="bx icon-eye-2" id="ojo" onclick="javascript: icon();" style="font-size: 30px; cursor: pointer; margin-top: -38px; margin-bottom: 12px; margin-left: 90%; display: flex; position: relative;"></i>
                    </div>
                    <!-- reCAPTCHA 
                    <center>
                        <div class="mb-3">
                            <div class="g-recaptcha" data-sitekey="6LdCiuMmAAAAAB4yYqFXUzrsbKDs6x-EyYHMi7Az" style="margin-top: 30px; margin-bottom: -10px" name="captcha"></div>
                        </div>
                    </center>-->
                    <?php

                    $permitididos = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $codigo = substr(str_shuffle($permitididos), 0, 6);

                    ?>
                    <div class="input-group" style="margin-top: 10px;">
                        <div class="col-sm-6">
                            <input tabindex="12" aria-label=" El recapcha es el siguiente <?php echo $codigo; ?>" class="form-control cod-1" type="text" style="width: 90%; height: 45px; border-radius: 30px 0 0 30px" id="txt_codigo" name="txt_codigo" value="<?php echo $codigo; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <input tabindex="13" aria-label="Es obligario copiar el recapcha tal cual lo escucho" class="form-control cod-2" type="text" style="width: 90%; height: 45px; border-radius: 0 30px 30px 0" placeholder="Introducir Código" id="txt_codigo2" name="txt_codigo2" value="" maxlength="6" onkeypress="mayus(this);">
                        </div>
                    </div>
                    <!--<a href="../usuario/index.php"><button type='button' class='btn_Entrar'>Entrar</button></a>-->
                    <div class="input-group">
                        <button tabindex="14" type='button' style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD" onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onclick="ingresar(cbCed_afiliado.value,txt_usuario.value,txt_clave.value,txt_codigo.value,txt_codigo2.value)">Entrar</button>
                        <span><i class="icon-cedula" style="padding:5px; color: gray"></i></span>
                        <input tabindex="15" aria-label="olvidó contraseña" type="submit" style="width: 63%; font-size: 16px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; font-weight: bold;" onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' id="btn_olvido_clave" value="¿Olvidó Contraseña?">
                    </div>
                    <br>
                    <p style="color: #BF1F13;" tabindex="6">Se recomienda usar el navegador Google Chrome</p>
                </form>
            </div>
        </div>
    </main>
    <br><br><br><br><br>
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
        <div style="margin: -98px auto 0 auto">
            <center>
                <div class="cent"><br><br><br>
                    <h5 tabindex="19" style="color: white; font-size: 15px"> Ministerio del Poder Popular para el Proceso Social del Trabajo Oficina de Tecnología de la Información y la Comunicación (OTIC). Análisis y Desarrollo de Sistemas. © 2023 Todos los Derechos Reservados. <br> Rif (G-20000012-0) Centro Simón Bolívar. Torre Sur. Caracas, Distrito Capital.</h5>
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

    <!--  <script src="js/main.js"></script> -->
    <!--<script src="js/pass-eje.js"></script>-->
</body>

</html>