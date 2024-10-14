<?php
include_once('header.php');
?>

<!--<body>
    <header-->
<!--<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid ">
            <div class="logo">
                <img src="../imagenes/cintillo_institucional.jpg">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor02"> 
                <div>
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item mglr-20">
                            <a class="nav-link active" href="../index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a href="../nosotros.php">Nosotros</a>
                        </li-->
<!--<li class="nav-item">
                            <a href="login.php">
                                <button type="button" class="btn btn-outline-primary">Iniciar Sesión</button>
                            </a>-->
<!--</li>
                    </ul>
                </div>
            </div>
        </div>
    </nav-->
<!--</header-->
<main class="mg-l-20">
    <div class="content-video3 video">
        <video src="../videos/video_olvido_contrasena.mp4" class="video" controls>
            <!-- <source src="videos/video_prueba.mp4" type="video/mp4"> -->
        </video>
    </div>
    <div class="contenedor_todo">
        <div class="caja_trasera">
            <div class="caja_trasera-login">
                <!-- <h3>¿Ya tienes una cuenta?</h3>
                <p>Inicia sesión para entrar en la página</p>
                <button id="btn_iniciar-sesion">Iniciar Sesión</button> -->
            </div>
            <div class="caja_trasera-register mg-55-100">
                <center>
                    <h4 class="text-d">Defina una contraseña que cumpla las siguientes caracteristicas</h4>
                </center>
                <br>
                <div class="validaciones caja_trasera-register validaciones-mg">
                    <div class="ul-seguridad validaciones caja_trasera-register validaciones-mg">
                        <ul>
                            <li id="t1" class="text-danger">Al Menos <strong>Una Letra Min&uacute;scula</strong></li>
                            <li id="t2" class="text-danger">Al Menos <strong>Una Letra May&uacute;scula</strong></li>
                            <li id="t3" class="text-danger">Al Menos <strong>Un N&uacute;mero</strong></li>
                            <li id="t4" class="text-danger">Debe Contener mas de <strong>10 Caracteres</strong></li>
                            <li id="t5" class="text-danger">La Contrase&ntilde;a <strong>debe Coincidir</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--Formulario de Login y registro  row g-3 was-validated  needs-validation" novalidate -->
        <div class="contenedor_login-register mg-10-0-10-0">
            <!--Validación Contraseña-->
            <form id="olvido_contra" name="olvido_contra" action="../mod_snilpd/index.php" method="POST" class="formulario_validacion">
                <center>
                    <img class="img-login" src="../imagenes/logo.png">
                </center>
                <h2>Establezca una Nueva Contraseña</h2><br>
                <h6 class="fgray">Por motivos de seguridad debe tener una contraseña personalizada:</h6>
                <h6 class="fgray">Nueva Contraseña:</h6>
                <input class="form-control eye" onkeyup="validar1()" type="password" placeholder="Contraseña *" id="pswd" name="pswd" value="" nkeyup="muestra_seguridad_clave(this.value, this.form)" maxlength="" required pattern="(?=.*[0-9])(?=.*[@#%&])(?=.*[A-Z]).[0-9 a-z A-Z.@#%&áéíóú]{10,}">
                <i class="bx icon-eye-2 icon-eye" id="ojo2" onclick="javascript: icon2();"></i>
                <h6 class="fgray">Confirmar Nueva Contraseña:</h6>
                <input class="form-control eye" type="password" onkeyup="validar2()" placeholder="Repite Contraseña *" id="pswd2" name="pswd2" value="" nkeyup="muestra_seguridad_clave(this.value, this.form)" maxlength="" required pattern="(?=.*[0-9])(?=.*[@#%&])(?=.*[A-Z]).[0-9 a-z A-Z.@#%&áéíóú]{10,}">
                <i class="bx icon-eye-2 icon-eye" id="ojo3" onclick="javascript: icon3();"></i>
                <input type="button" class="button" style="width: 100%; font-size: 16px; background-color: #fff; border: 1px Solid #46A2FD; color: #46A2FD; margin-top: 0px; font-weight: bold" onmouseover='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseout='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onclick="olvido_contra2()" value="Siguiente"/>
                <!--button id="btn_iniciar-sesion">Siguiente</button-->
            </form>

        </div>
    </div>
</main>
<br><br><br><br><br>
<!-- Footer 
<br><br><br><br>
<footer>
    <div class="pub-1">
			<center>
				<h3><b>Logo empleado</b></h3>
				<img src="favicon/favicon.png"><br>
				<a href="https://www.freepik.es/vectores/logo">Vector de Logo creado por freepik - www.freepik.es</a>
			</center>
		</div>
		<div class="line"></div>
    <br><br><br><br>
    <div>
        <center>
            <div class="circle">
					<span class="icon-user"></span>
				</div>
            <div class="cent">
                <h3>
                    Ministerio del Poder Popular para el Proceso Social del Trabajo <br> Sistema Nacional para la Inserción y Reinserción Laboral para Personas con Discapacidad<br><br><br>
                </h3>
            </div>
        </center>
    </div>
    <div class="line"></div>
    <div class="pub-2">
        <center>
            <div class="circle">
                <span class="icon-user"></span>
            </div>
            <div class="cent"><br><br><br>
                <h3>Oficina de Tecnología de la Información y la Comunicación (OTIC). <br> Análisis y Desarrollo de Sistemas. <br> © 2023 Todos los Derechos Reservados.</h3>
            </div>
        </center>
    </div>
    div class="sepa"></div>
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
		</div
</footer> -->
<!-- Script's -->
<!-- CDN -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->

<script type="text/javascript" src="../css/bootstrap5.1.3/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../css/bootstrap5.1.3/js/popper.min.js"></script>
<!-- popper es indispensable para el manejo de los Tooltips Editados con bootstrap.bundle -->

<!--<script type="text/javascript" src="../css/bootstrap5.1.3/js/bootstrap.js"></script> -->


<!-- //Libreria principal jquery-3.6.0-->
<script src="../js/jquery-3.6.0.min.js"></script>
<!--<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>-->

<!--<script type="text/javascript" src="js/login.js"></script-->
<script src="js/olvido_contra.js"></script>
<script src="js/pass-eje.js"></script>

<!--<script src="js/main.js"></script-->
</body>

</html>