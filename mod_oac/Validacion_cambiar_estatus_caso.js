function isNumberKey(evt){
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57) )
 return false;

 return true;
}

function validarEmail() {
	var correo1 = document.getElementById("email_contacto1").value;
	var correo2 = document.getElementById("email_contacto2").value;
	var correo= correo1+"@"+correo2;
	//alert(correo);
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
		
//			}
//-----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------			
		if(document.getElementById("persona_remite_caso").value == ""){
		document.getElementById("persona_remite_caso").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("persona_remite_caso").style.border = "";
			}
//-----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------			
	if(document.getElementById("cbo_organismo").value == ""){
		document.getElementById("cbo_organismo").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("cbo_organismo").style.border = "";
			}
//-----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------			
		if(document.getElementById("f_remision").value == ""){
		document.getElementById("f_remision").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("f_remision").style.border = "";
			}
//-----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------			
		if(document.getElementById("numero_memo").value == ""){
		document.getElementById("numero_memo").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("numero_memo").style.border = "";
			}
//-----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------			
			if(document.getElementById("cbo_resultado").value == ""){
		document.getElementById("cbo_resultado").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("cbo_resultado").style.border = "";
			}
//-----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------			
			/*if(document.getElementById("observaciones").value == ""){
		document.getElementById("observaciones").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("observaciones").style.border = "";
			}*/
//-----------------------------------------------------------------------------------------------

		if (msg != '') { 
		alert ('Debe seleccionar los campos requeridos');
		msg = '';
		return false;
		}else{
			var form = document.form;
	
			return true;
		}
		
	});
});

