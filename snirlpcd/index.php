<!DOCTYPE html>
<html lang="Es-es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> SNIRLPCD </title>
	<!-- link CSS's -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- link CSS's -->
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="css/todo.css">
</head>
<div id="alerta" class="fondo_alerta">
	<div class="alerta">
		<h4 id="titulo">Recomendación</h4>
		<p id="texto">Sugerimos utilizar el navegador Google Chrome <span><img src="imagenes/cromo.png" alt="" style="width: 30px"></span></p>
		<center><input type="button" id='btncerrar' name='btncerrar' style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: center; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onclick="cerrar_alert()" data-bs-toggle="tooltip" value="Cerrar"></center>
	</div>
</div>
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

<body>
	<!-- Video -->
	<div class="content-video content-video">
		<video src="videos/video_portada.mp4" class="video" controls>
			<!-- <source src="videos/video_prueba.mp4" type="video/mp4"> -->
		</video>
	</div>

	<!--  Header -->
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark">
			<div class="container-fluid ">
				<div class="logo mg-l-3">
					<img tabindex="1" alt="Gobierno bolivariano de Venezuela" class="w-h-100" src="imagenes/cintillo_institucional.jpg">
				</div>
				<!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button> -->
				<div class="mg-l-30" id="navbarColor02">
					<div>
						<ul class="navbar-nav me-auto navbar-pequenio">
							<li class="nav-item mglr-20 mg-r-20 li-1">
								<a tabindex="2" class="nav-link active text-black" href="index.php">Inicio</a>
							</li>
							<li class="nav-item mg-r-20 li-2">
								<a tabindex="3" class="nav-link text-black" href="nosotros.php">Nosotros</a>
							</li>
							<li class="nav-item mg-r-20 li-2">
								<a tabindex="4" class="nav-link text-black" href="mod_login/login3.php">Registrarse</a>
							</li>
							<li class="nav-item li-3">
								<a tabindex="5" class="nav-link text-black" href="mod_login/login2.php">Iniciar Sesión</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<!-- Main -->
	<main>

		<div tabindex="6" aria-label="Una imagen que muestra al presidente Chavez saludando a personas con discapacidad" class="content-portada"> <!-- Imagen -->
			<div class="capa-gradient"></div> <!-- Oscurece la Imagen -->
			<div class="content-details"> <!-- Sombra del Texto -->
				<div class="sep1"></div>
				<div class="details w-58"> <!-- Tamaño de la Letra -->
					<h1 class="text-44"> ¡Bienvenidos! <br> Sistema Nacional para la Inserción y Reinserción Laboral de Personas Con Discapacidad </h1> <!-- Título -->
					<div class="sep2"></div>
					<!-- Texto -->
					<p class="text-20">
						<i>Las personas con discapacidad son las estrellas y luceros de la patria.<br> No debe quedar una sola persona que tenga algún <br> tipo de discapacidad que no sea atendida<br> <b>Hugo Rafael Chávez Frías</b></i>.
					</p>
					<img aria-label="Firma de Chavez" style="width: 130px; margin:-200px -560px 0 0;" src="imagenes/firma_chavez.png" alt="">
				</div>
			</div>
		</div>
	</main>

	<!-- Footer -->
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
		<!-- <br>
		<div class="pub-2">
			<center>
				<div class="circle">
					<span class="icon-user"></span>
				</div>
				<div class="cent">
					<h3>
						Despacho del Viceministro o Viceministra de Previsión Social.<br>
					</h3>
				</div>
			</center>
		</div> -->
		<div class="mg-pub2">
			<center>
				<div class="cent"><br><br><br>
					<h3 tabindex="8" class="text-footer">
						Centro Simón Bolívar. Torre Sur. Caracas, Distrito Capital. Ministerio del Poder Popular para el Proceso Social de Trabajo. RIF G-20000012-0 <br>
						Oficina de Tecnología de la Información y la Comunicación (OTIC) - División de Análisis y Desarrollo de Sistemas.<br>
						© 2023 Todos los Derechos Reservados.
					</h3>
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
	<script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
</body>

</html>
</body>

</html>