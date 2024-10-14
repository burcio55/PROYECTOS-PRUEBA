function mensaje_usuario(mensaje,texto){
	
	$("#mensaje_usuario").removeClass();
	
	if(mensaje=='error'){
		$("#mensaje_usuario").addClass('mensaje_error');
	}
	if(mensaje=='exclamacion'){
		$("#mensaje_usuario").addClass('mensaje_exclamacion');
	}
	if(mensaje=='exito'){
		$("#mensaje_usuario").addClass('mensaje_exitoso');
	}
	if(mensaje=='informacion'){
		$("#mensaje_usuario").addClass('mensaje_informacion');
	}
	
	$("#mensaje_usuario").html(texto);	
	$("#mensaje_usuario").show();
	 
	setTimeout(function(){ 
		$("#mensaje_usuario").fadeOut(800);
	},5000);   
}

function validar_login(saction,valor){

	var nacionalidad=$('#nnacionalidad').attr('value');
	var usuario = $('#txt_usuario').attr('value');
	var clave = $('#txt_clave').attr('value');
	var captcha = $('#txt_captcha').attr('value');
	 
	nacionalidad=$.base64.encode(nacionalidad);
	usuario=$.base64.encode(usuario);
	clave=$.base64.encode(clave);
	captcha=$.base64.encode(captcha);
	
	var msg = '';
	
	if ($('#txt_usuario').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("nnacionalidad").style.border = "1px solid red";
		document.getElementById("txt_usuario").style.border = "1px solid red";
	}else{
		document.getElementById("nnacionalidad").style.border = "";
		document.getElementById("txt_usuario").style.border = "";
	}
	if ($('#txt_clave').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("txt_clave").style.border = "1px solid red";
	}else{
		document.getElementById("txt_clave").style.border = "";
	}
	if ($('#txt_captcha').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("txt_captcha").style.border = "1px solid red";
	}else{
		document.getElementById("txt_captcha").style.border = "";
	}
	
	if (msg != '') { 
		mensaje_usuario('error','DEBE SELECCIONAR LOS CAMPOR REQUERIDOS');
		return false;
	}else{
		
		$.ajax({
			url: "verificar_login.php",
			type: "POST",
			data: "&usuario="+usuario+"&clave="+clave+"&nacionalidad="+nacionalidad+"&captcha="+captcha,
			//data: "&usuario="+usuario+"&clave="+clave+"&nacionalidad="+nacionalidad,
			success: function(datos){
			datos=$.trim(datos);
			
				/*if(datos=='0'){ 
					mensaje_usuario('error','DATOS INCORRECTOS');	
					location.reload();
				}
				if(datos=='1'){ 
					mensaje_usuario('exito','DATOS CORRECTOS');
					$(location).attr('href','../mod_login/redirecciona.php');	
				}
				if(datos=='2'){ 
					mensaje_usuario('error','CAPTCHA INCORRECTOS');	
					location.reload();
				}*/
				if(datos=='0'){ 
					mensaje_usuario('error','DATOS INCORRECTOS');	
					location.reload();
				}
				if(datos=='1'){ 
					mensaje_usuario('exito','DATOS CORRECTOS');	
						var form = document.comprobacion;
						form.action.value=saction;
						form.submit();
						return true;	
				}
				if(datos=='2'){ 
					mensaje_usuario('error','CAPTCHA INCORRECTOS');
					location.reload();
				}
				
			}
		});
	}
}

function limpiar(){
	document.comprobacion.reset();
}