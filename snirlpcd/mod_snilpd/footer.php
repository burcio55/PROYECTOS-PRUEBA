		</div>
		</div>
		<!-- Footer -->
		<footer style="width: 100vw">
			<!--div class="pub-1">
			<center>
				<h3><b>Logo empleado</b></h3>
				<img src="favicon/favicon.png"><br>
				<a href="https://www.freepik.es/vectores/logo">Vector de Logo creado por freepik - www.freepik.es</a>
			</center>
		</div>
		<div class="line"></div-->
			<br>
			<center>
				<h3 style="font-size: 15px; color: white; margin: 0">
					Ministerio del Poder Popular para el Proceso Social de Trabajo.<br>
					Oficina de Tecnología de la Información y la Comunicación (OTIC) - División de Análisis y Desarrollo de Sistemas. <br>
					© 2023 Todos los Derechos Reservados.
				</h3>
			</center>
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
		<!-- JavaScipt Code -->
		<!-- Code JS - Animado 1 (Movimiento Hacia Arriba) -->
		<script>
			let animado = document.querySelectorAll(".animado");

			function mostrarScroll() {
				let scrollTop = document.documentElement.scrollTop;
				for (var i = 0; i < animado.length; i++) {
					let alturaAnimado = animado[i].offsetTop;
					if (alturaAnimado - 555 < scrollTop) {
						animado[i].style.opacity = 1;
						animado[i].classList.add("arriba");
					}
				}
			}
			window.addEventListener('scroll', mostrarScroll);
		</script>
		<!-- Code JS - Animado 2 (Movimiento Hacia Abajo) -->
		<script>
			let animado2 = document.querySelectorAll(".animado2");

			function mostrarScroll() {
				let scrollTop = document.documentElement.scrollTop;
				for (var i = 0; i < animado2.length; i++) {
					let alturaAnimado2 = animado2[i].offsetTop;
					if (alturaAnimado2 - 555 < scrollTop) {
						animado2[i].style.opacity = 1;
						animado2[i].classList.add("abajo");
					}
				}
			}
			window.addEventListener('scroll', mostrarScroll);
		</script>
		<!-- Code JS - Animado 3 (Movimiento Hacia La Derecha) -->
		<script>
			let animado3 = document.querySelectorAll(".animado3");

			function mostrarScroll() {
				let scrollTop = document.documentElement.scrollTop;
				for (var i = 0; i < animado3.length; i++) {
					let alturaAnimado3 = animado3[i].offsetTop;
					if (alturaAnimado3 - 555 < scrollTop) {
						animado3[i].style.opacity = 1;
						animado3[i].classList.add("derecha");
					}
				}
			}
			window.addEventListener('scroll', mostrarScroll);
		</script>
		<!-- Code JS - Animado 4 (Movimiento Hacia La Izquierda) -->
		<script>
			let animado4 = document.querySelectorAll(".animado4");

			function mostrarScroll() {
				let scrollTop = document.documentElement.scrollTop;
				for (var i = 0; i < animado4.length; i++) {
					let alturaAnimado4 = animado4[i].offsetTop;
					if (alturaAnimado4 - 555 < scrollTop) {
						animado4[i].style.opacity = 1;
						animado4[i].classList.add("izquierda");
					}
				}
			}
			window.addEventListener('scroll', mostrarScroll);
		</script>
		<!-- Code JS - Animado 5 (Achicar) -->
		<script>
			let animado5 = document.querySelectorAll(".animado5");

			function mostrarScroll() {
				let scrollTop = document.documentElement.scrollTop;
				for (var i = 0; i < animado5.length; i++) {
					let alturaAnimado5 = animado5[i].offsetTop;
					if (alturaAnimado5 - 555 < scrollTop) {
						animado5[i].style.opacity = 1;
						animado5[i].classList.add("pequenio");
					}
				}
			}
			window.addEventListener('scroll', mostrarScroll);
		</script>
		<!-- Code JS - Animado 6 (Agrandar) -->
		<script>
			let animado6 = document.querySelectorAll(".animado6");

			function mostrarScroll() {
				let scrollTop = document.documentElement.scrollTop;
				for (var i = 0; i < animado6.length; i++) {
					let alturaAnimado6 = animado5[i].offsetTop;
					if (alturaAnimado6 - 555 < scrollTop) {
						animado6[i].style.opacity = 1;
						animado6[i].classList.add("grande");
					}
				}
			}
			window.addEventListener('scroll', mostrarScroll);
		</script>
		<!-- Code JS - Menú Desplegable -->
		<script>
			$(".submenu").click(function() {
				$(this).children("ul").slideToggle();
			})
			$("ul").click(function(p) {
				p.stopPropagation();
			})
		</script>
		</body>

		</html>