function validar_login(){

var valor=1 ;
if(document.getElementById("nnacionalidad").value.length==0){
document.getElementById("nnacionalidad").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("nnacionalidad").style.borderColor= '';	
}
if(document.getElementById("txt_usuario").value.length==0){
document.getElementById("txt_usuario").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("txt_usuario").style.borderColor= '';	
}

if(document.getElementById("txt_clave").value.length==0){
document.getElementById("txt_clave").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("txt_clave").style.borderColor= '';	
}
if(document.getElementById("txt_captcha").value.length==0){
document.getElementById("txt_captcha").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("txt_captcha").style.borderColor= '';	
}
	if(valor==0){
		mensaje_usuario('error','LOS CAMPOS NO PUEDEN QUEDAR VACIOS');
		return false;
	}else{
		return true;
	}
	
}	
