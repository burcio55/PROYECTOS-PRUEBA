$(document).ready(function(){
						   
});
//--------------------------------------------------------------------------------------------------------------------------
function menu(saction,url){
	var form = document.form1;
	form.action.value=saction;
	document.form1.url.value=url;
	form.submit();
}
//-------------------------------------------------------------------------------------------------------------------------- 
function send(saction){  
	if(saction == 'guardar'){
		if(validar_formulario()==true){
			$("#loader").show();
			var form = document.olvido_contrasena;
			form.action.value=saction;
			form.submit();
			$("#loader").show();
		}
	}
	
	if(saction == 'regresar'){
		url="/sistema_cpt/mod_login/login.php";
    	$(location).attr('href',url);
		$("#loader").show();
	}
}
//--------------------------------------------------------------------------------------------------------------------------
function validarEmail() { 
	var correo = document.getElementById("txt_correoelectronico").value;
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!expr.test(correo)){
        alert("El correo electr\u00F3nico no es v\u00E1lido");
	}
}
//--------------------------------------------------------------------------------------------------------------------------
function validar_formulario(){

var valor=1 ;
var mensaje;
var mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";

if(document.getElementById("cbo_cedulatrabajador").value.length==0){
	document.getElementById("cbo_cedulatrabajador").style.borderColor= 'Red';
	valor=0;
}else{
	document.getElementById("cbo_cedulatrabajador").style.borderColor= '';
}

if(document.getElementById("txt_cedula").value.length==0){
	document.getElementById("txt_cedula").style.borderColor= 'Red';
	valor=0;
}else{
	if(document.getElementById("txt_cedula").value.length < 5 || document.getElementById("txt_cedula").value.length > 8){ 
		mensaje+=" - EL CAMPO CEDULA DEBE CONTENER DE 5 a 8 DIGITOS.\n"
		document.getElementById("txt_cedula").focus();
		document.getElementById("txt_cedula").style.borderColor= 'Red';
		valor=0;
	}else{
		document.getElementById("txt_cedula").style.borderColor= '';
	}
}

if(document.getElementById("txt_fecha_nac").value.length==0){
	document.getElementById("txt_fecha_nac").style.borderColor= 'Red';
	valor=0;
}else{
	document.getElementById("txt_fecha_nac").style.borderColor= '';
}



/*if(document.getElementById("txt_correoelectronico").value.length==0){
	document.getElementById("txt_correoelectronico").style.borderColor= 'Red';
	valor=0;
}else{
	document.getElementById("txt_correoelectronico").style.borderColor= '';
}*/

if(valor==0){
		mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS (*). \n";
		alert(mensaje);
		return false;
	}else{
		return true;
	}
	
}