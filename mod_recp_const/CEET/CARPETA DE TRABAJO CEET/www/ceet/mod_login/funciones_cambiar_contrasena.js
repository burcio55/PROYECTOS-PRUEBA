$(document).ready(function() {

$('input[id=pswd]').keyup(function() {
	// set password variable
	var pswd = $(this).val();
	//validate the length
		if ( pswd.length < 8 ) {
			$('#length').removeClass('valid').addClass('invalid');
		} else {
			$('#length').removeClass('invalid').addClass('valid');
		}
		//validate letter
		if ( pswd.match(/[a-z]/) ) {
			$('#letter').removeClass('invalid').addClass('valid');
		} else {
			$('#letter').removeClass('valid').addClass('invalid');
		}
		
		//validate capital letter
		if ( pswd.match(/[A-Z]/) ) {
			$('#capital').removeClass('invalid').addClass('valid');
		} else {
			$('#capital').removeClass('valid').addClass('invalid');
		}
		
		//validate number
		if ( pswd.match(/\d/) ) {
			$('#number').removeClass('invalid').addClass('valid');
		} else {
			$('#number').removeClass('valid').addClass('invalid');
		}
		
		//validate character
		if ( pswd.match(/(?=[@#%&]|-|_)/) ) {
			$('#character').removeClass('invalid').addClass('valid');
		} else {
			$('#character').removeClass('valid').addClass('invalid');
		}
		
		//}).focus(function() {
		//	$('#pswd_info').show();
		//}).blur(function() {
		//	$('#pswd_info').hide();
});


$('input[id=pswd2]').keyup(function() {
	// set password variable
	var campo1 = document.getElementById("pswd").value;
	var campo2 = document.getElementById("pswd2").value;
	//validate the length
		if ( campo1 == campo2 ) {
			$('#letter2').removeClass('invalid').addClass('valid');
		} else {
			$('#letter2').removeClass('valid').addClass('invalid');
		}

		//}).focus(function() {
		//	$('#pswd_info2').show();
		//}).blur(function() {
		//	$('#pswd_info2').hide();
});

});

//--------------------------------------------------------------------------------------------------

//-Tiene letras y números: +30% 
//-Tiene mayúsculas y minúsculas: +30% 
//-Tiene entre 4 y 5 caracteres: +10% 
//-Tiene entre 6 y 8 caracteres: +30% 
//-Tiene más de 8 caracteres: +40%

function seguridad_clave(pswd){
   var seguridad = 0;
   if (pswd.length!=0){
      if (tiene_numeros(pswd) && tiene_letras(pswd)){
         seguridad += 20;
      }
      if (tiene_minusculas(pswd) && tiene_mayusculas(pswd)){
         seguridad += 20;
      }
	  if (tiene_caracterespeciales(pswd)){
         seguridad += 20;
      }
      if (pswd.length >= 4 && pswd.length <= 5){
         seguridad += 10;
      }else{
         if (pswd.length >= 6 && pswd.length <= 8){
            seguridad += 30;
         }else{
            if (pswd.length > 8){
               seguridad += 40;
            }
         }
      }
   }
   return seguridad            
} 

function muestra_seguridad_clave(pswd,formulario){
   seguridad=seguridad_clave(pswd);
   document.getElementById("seguridad").innerHTML="Nivel de Seguridad: " + seguridad + "%";
}

var numeros="0123456789";

function tiene_numeros(texto){
   for(i=0; i<texto.length; i++){
      if (numeros.indexOf(texto.charAt(i),0)!=-1){
         return 1;
      }
   }
   return 0;
}

var letras="abcdefghyjklmnñopqrstuvwxyz";

function tiene_letras(texto){
   texto = texto.toLowerCase();
   for(i=0; i<texto.length; i++){
      if (letras.indexOf(texto.charAt(i),0)!=-1){
         return 1;
      }
   }
   return 0;
}

var letras="abcdefghyjklmnñopqrstuvwxyz";

function tiene_minusculas(texto){
   for(i=0; i<texto.length; i++){
      if (letras.indexOf(texto.charAt(i),0)!=-1){
         return 1;
      }
   }
   return 0;
}

var letras_mayusculas="ABCDEFGHYJKLMNÑOPQRSTUVWXYZ";

function tiene_mayusculas(texto){
   for(i=0; i<texto.length; i++){
      if (letras_mayusculas.indexOf(texto.charAt(i),0)!=-1){
         return 1;
      }
   }
   return 0;
}

var caracterespeciales="@#%&";

function tiene_caracterespeciales(texto){
   for(i=0; i<texto.length; i++){
      if (caracterespeciales.indexOf(texto.charAt(i),0)!=-1){
         return 1;
      }
   }
   return 0;
}

//--------------------------------------------------------------------------------------------------

function aceptar(saction){
	valido=1;
	condicion=1;
	var pswd = $("#pswd").val();
	
	mensaje="ESTIMADO USUARIO SE DEBE CUMPLIR CON TODAS LAS CONDICIONES \n\n";

	if($("#pswd").val()==''){
	 document.getElementById("pswd").style.borderColor= 'Red';
	 mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS. \n";
	 valido=0;
	 condicion=0;
	}else{
		document.getElementById("pswd").style.borderColor= '';
	
		if ( pswd.length < 8 ) { 
			condicion=0;
		}
		//validate letter
		if ( pswd.match(/[a-z]/) ) {
		}else{
			condicion=0;
		}
		//validate capital letter
		if ( pswd.match(/[A-Z]/) ) {
		}else{
			condicion=0;
		}
		//validate number
		if ( pswd.match(/\d/) ) {
		}else{
			condicion=0;
		}
		//validate character
		if ( pswd.match(/(?=[@#%&]|-|_)/) ) {
		}else{
			condicion=0;
		}
	}
	
	if(condicion==0){
		alert(mensaje);
	}

	if($("#pswd2").val()=='' && condicion==1){
	 document.getElementById("pswd2").style.borderColor= 'Red';
	 alert('DEBE LLENAR LOS CAMPOS REQUERIDOS');
	 valido=0;		
	}
	
	if(valido==1 && condicion==1){
		if($("#pswd2").val()!=$("#pswd").val()){
			alert("LAS CONTRASE\u00D1AS NO COINCIDEN");
			//$("#pswd").val('');
			$("#pswd2").val('');
			//$('#length').removeClass('valid').addClass('invalid');
			//$('#letter').removeClass('valid').addClass('invalid');
			//$('#capital').removeClass('valid').addClass('invalid');
			//$('#number').removeClass('valid').addClass('invalid');
			//$('#character').removeClass('valid').addClass('invalid');
		}else{
			var form = document.form;
			form.action.value=saction;
			form.submit();
			$("#loader").show();
		}
	}
}

function regresar(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
	$("#loader").show();
}

function limpiar(){
			$("#pswd").val('');
			$("#pswd2").val('');
			$('#length').removeClass('valid').addClass('invalid');
			$('#letter').removeClass('valid').addClass('invalid');
			$('#capital').removeClass('valid').addClass('invalid');
			$('#number').removeClass('valid').addClass('invalid');
			$('#character').removeClass('valid').addClass('invalid');
			$('#letter2').removeClass('valid').addClass('invalid');
}
