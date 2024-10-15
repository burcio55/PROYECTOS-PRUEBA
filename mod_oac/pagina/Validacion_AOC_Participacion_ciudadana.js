function isNumberKey(evt){
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57) )
 return false;

 return true;
}

function validarEmail() {
	var correo = document.getElementById("email").value;
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    
	if(!correo){
		//alert("Debe escribir su correo.");
	}else{
	if (!expr.test(correo))
        alert("La direcci\u00f3n de correo es incorrecta.");
	}
}



//---------------------------------------------------------------------------------------------	
$(document).ready(function(){ 
	
	$("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
	
	var msg = '';
	
	$('#enviar').click(function() {
//---------------------------------------------------------------------------------------------			
		if(document.getElementById("cbo_entidad").value == ""){
		document.getElementById("cbo_entidad").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("cbo_entidad").style.border = "";
			}
		if(document.getElementById("cbo_municipio").value == ""){
		document.getElementById("cbo_municipio").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("cbo_municipio").style.border = "";
			}
		if(document.getElementById("cbo_parroquia").value == ""){
		document.getElementById("cbo_parroquia").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("cbo_parroquia").style.border = "";
			}
//---------------------------------------------------------------------------------------------	
		if(document.getElementById("cedulaconsulta").value == ""){
		document.getElementById("cedulaconsulta").style.border = "2px solid red";
		document.getElementById("nacionalidad").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("cedulaconsulta").style.border = "";
			document.getElementById("nacionalidad").style.border = "";
			}
//---------------------------------------------------------------------------------------------	
		if(document.getElementById("telefono").value == ""){
		document.getElementById("telefono").style.border = "2px solid red";
		document.getElementById("codigo").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("telefono").style.border = "";
			document.getElementById("codigo").style.border = "";
			}
//---------------------------------------------------------------------------------------------	
		if(document.getElementById("email").value == ""){
		document.getElementById("email").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("email").style.border = "";
			}
//---------------------------------------------------------------------------------------------	
		if(document.getElementById("motivo").value == ""){
		document.getElementById("motivo").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("motivo").style.border = "";
			}
//---------------------------------------------------------------------------------------------
		if(document.getElementById("comentario").value == ""){
		document.getElementById("comentario").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("comentario").style.border = "";
			}
//---------------------------------------------------------------------------------------------
		if (!$('input[name="entes"]').is(':checked')){
		//alert('Debe seleccionar Calidad del Trabajo');
		msg = msg+'-Bad';
		document.getElementById("entesmin").style.border = "2px double red";
		}else{
			document.getElementById("entesmin").style.border = "";
			}
			

			
		if (msg != '') { 
		alert ('Debe seleccionar los campos requeridos');
		msg = '';
		return false;
		}else{
			var form = document.formevaluacion;
			return true;
		}
		
	});
});