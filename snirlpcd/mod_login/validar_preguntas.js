//version 1.0
function validar_formulario(){
var validado=1 ;
var mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";




///respuesta1
var chk_respuesta1=0;
var valor_respuesta1;
for (var i=0;i<document.getElementsByName('respuesta1').length;i++){
	if (document.getElementsByName('respuesta1').item(i).checked){
		if(document.getElementsByName("respuesta1").item(i).value==1){
			valor_respuesta1=1;
		}else{
			valor_respuesta1=2;
		}
	chk_respuesta1=1;
	}else{
	}
}	
if(chk_respuesta1==1){
	document.getElementById("td_respuesta1").style.border="";
	document.getElementById("td_respuesta1").style.borderColor='';
	
}else{
	document.getElementById("td_respuesta1").style.border="1px solid";
	document.getElementById("td_respuesta1").style.borderColor='Red';
	
	validado=0;		
}

//respuesta2

var chk_respuesta2=0;
var valor_respuesta2;
for (var i=0;i<document.getElementsByName('respuesta2').length;i++){
	if (document.getElementsByName('respuesta2').item(i).checked){
		if(document.getElementsByName("respuesta2").item(i).value==1){
			valor_respuesta2=1;
		}else{
			valor_respuesta2=2;
		}
	chk_respuesta2=1;
	}else{
	}
}	
if(chk_respuesta2==1){
	document.getElementById("td_respuesta2").style.border="";
	document.getElementById("td_respuesta2").style.borderColor='';
	
}else{
	document.getElementById("td_respuesta2").style.border="1px solid";
	document.getElementById("td_respuesta2").style.borderColor='Red';
	
	validado=0;		
}
/*//////respuesta3
var chk_respuesta3=0;
var valor_respuesta3;
for (var i=0;i<document.getElementsByName('respuesta3').length;i++){
	if (document.getElementsByName('respuesta3').item(i).checked){
		if(document.getElementsByName("respuesta3").item(i).value==1){
			valor_respuesta3=1;
		}else{
			valor_respuesta3=2;
		}
	chk_respuesta3=1;
	}else{
	}
}	
if(chk_respuesta3==1){
	document.getElementById("td_respuesta3").style.border="";
	document.getElementById("td_respuesta3").style.borderColor='';
	
}else{
	document.getElementById("td_respuesta3").style.border="1px solid";
	document.getElementById("td_respuesta3").style.borderColor='Red';
	
	validado=0;		
}*/


	if(validado==0){
		mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS (*). \n";
		alert(mensaje);
		return false;
	}else{
		return true;
	}
	
}
