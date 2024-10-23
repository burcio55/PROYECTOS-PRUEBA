		
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
		$("#mensaje_usuario").fadeOut(800);},5000);   
}

function send(action){
	switch(action){
	case 1:
	 	if(validar_login()==true){
			verificar_login();
		}
	break;
	case 2:
		limpiar();
	break;
	default:
	
	}
}

function limpiar(){
$('#nnacionalidad').val('');
$('#txt_usuario').val('');
$('#txt_clave').val('');
$('#txt_captcha').val('');
}
function verificar_login(){
var nacionalidad=$('#nnacionalidad').attr('value');
var usuario = $('#txt_usuario').attr('value');
var clave = $('#txt_clave').attr('value');
var captcha = $('#txt_captcha').attr('value');
 

nacionalidad=$.base64.encode(nacionalidad);
usuario=$.base64.encode(usuario);
clave=$.base64.encode(clave);
captcha=$.base64.encode(captcha);


$.ajax({
			url: 'verificar_login.php',
			type: "POST",
			data: "&usuario="+usuario+"&clave="+clave+"&nacionalidad="+nacionalidad+"&captcha="+captcha,
			success: function(datos){
			datos=$.trim(datos);
				
				if(datos=='0'){ 
					mensaje_usuario('error','DATOS INCORRECTOS');	
					location.reload();
				}
				if(datos=='2'){ 
					mensaje_usuario('error','DATOS INCORRECTOS');	
					location.reload();
				}
				if(datos=='1'){ 
					mensaje_usuario('exito','DATOS CORRECTOS');	
					$(location).attr('href','../mod_login/redirecciona.php');
				}
			}
		});
		return false;			

}