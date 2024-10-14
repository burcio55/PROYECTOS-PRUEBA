/* $('#btn_actualizar_clave').on('click', function()
{
    olvido_contra();
}); */
/* function olvido_contra(){
	alert('hola');
	let clave1 = $('#pswd').val();
    let clave2 = $('#pswd2').val();
	if(clave1 == ''){
		document.getElementById("texto").innerText = ('Debe llenar todos los campos obligatorios');
		document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
		document.getElementById("titulo").style.color = "white";
		document.getElementById("titulo").innerText = ("Atención");
		document.getElementById("alerta").style.display = "Block";
	}else
	if(clave2 == ''){
		document.getElementById("texto").innerText = ('Debe llenar todos los campos obligatorios');
		document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
		document.getElementById("titulo").style.color = "white";
		document.getElementById("titulo").innerText = ("Atención");
		document.getElementById("alerta").style.display = "Block";
	}else
	if(clave1 != clave2){
		document.getElementById("texto").innerText = ('Las contraseñas deben ser iguales');
		document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
		document.getElementById("titulo").style.color = "white";
		document.getElementById("titulo").innerText = ("Atención");
		document.getElementById("alerta").style.display = "Block";
	}else{
		$.ajax
		({
			url: '/snirlpcd/mod_login/olvido_contra_controlador.php?clave='+clave2,
			type: 'GET',
			success: function(resp) {;
				let condicional = resp.split(" / ")[0];
				let mensaje = resp.split(" / ")[1];
				if(condicional == '1'){
					document.getElementById("texto").innerText = mensaje;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
				}else
				if(condicional == '2'){
					document.getElementById("texto").innerText = mensaje;
                    document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
					document.getElementById("link").value = "/snirlpcd/mod_snilpd/index.php";
				}else{
					document.getElementById("texto").innerText = mensaje;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
				}
			}
		});
	}
	
} */
function olvido_contra2(){
	//alert('hola');
	let valor = 0;
	let clave1 = $('#pswd').val();
    let clave2 = $('#pswd2').val();
	if(clave1 == ""){
		document.getElementById("pswd").style.border = "1px solid red";
		valor++;
	}else{
		document.getElementById("pswd").style.border = "";
	}
	if(clave2 == ""){
		document.getElementById("pswd2").style.border = "1px solid red";
		valor++;
	}else{
		document.getElementById("pswd2").style.border = "";
	}
	if(valor == 0){
		if(clave1 != clave2){
			document.getElementById("texto").innerText = ('Las contraseñas deben ser iguales');
			document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
			document.getElementById("titulo").style.color = "white";
			document.getElementById("titulo").innerText = ("Atención");
			document.getElementById("alerta").style.display = "";
		}else{
			$.ajax
			({
				url: '/snirlpcd/mod_login/olvido_contra_controlador.php?clave='+clave2,
				type: 'GET',
				success: function(resp) {
					let condicional = resp.split(" / ")[0];
					let mensaje = resp.split(" / ")[1];
					if(condicional == '1'){
						document.getElementById("texto").innerText = (mensaje);
						document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
						document.getElementById("titulo").style.color = "white";
						document.getElementById("titulo").innerText = ("Atención");
						document.getElementById("alerta").style.display = "block";
					}else{
						document.getElementById("texto").innerText = (mensaje);
						document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
						document.getElementById("titulo").style.color = "white";
						document.getElementById("titulo").innerText = ("Atención");
						document.getElementById("alerta").style.display = "block";
						document.getElementById("link").value = "/snirlpcd/mod_snilpd/index.php";
					}
				}
			});
		}
	}else{
		document.getElementById("texto").innerText = ('Debe llenar todos los campos obligatorios');
		document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
		document.getElementById("titulo").style.color = "white";
		document.getElementById("titulo").innerText = ("Atención");
		document.getElementById("alerta").style.display = "block";
	}
}
function validar1(){
    let input1 = $("#pswd").val();
	let mayusculas ='ABCDEFGHIJKLMNÑOPQRSTUWVXYZ';
	let minusculas ='abcdefghijklmnñopqrstuvwxyz';
	let numeros ='1234567890';
	for (let i = 0; i < input1.length; i++) {
		if (mayusculas.indexOf(input1[i]) >= 0) {
			$("#t2").removeClass("text-danger").addClass("text-success");
		}
		if (minusculas.indexOf(input1[i]) >= 0) {
			$("#t1").removeClass("text-danger").addClass("text-success");
		}
		if (numeros.indexOf(input1[i]) >= 0) {
			$("#t3").removeClass("text-danger").addClass("text-success");
		}
	}
	if(input1.length >= 10){
		$("#t4").removeClass("text-danger").addClass("text-success");
	}else{
		$("#t4").removeClass("text-success").addClass("text-danger");
	}
}
function validar2(){
    let input1 = $("#pswd").val();
	let input2 = $("#pswd2").val();
	if(input1 == input2){
		$("#t5").removeClass("text-danger").addClass("text-success");
	}else{
		$("#t5").removeClass("text-success").addClass("text-danger");
	}
}