function isNumberKey(evt){
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57) )
 return false;

 return true;
}

function validarEmail() {
	var correo1 = document.getElementById("email1").value;
	var correo2 = document.getElementById("email2").value;
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
		if(document.getElementById("telefono2").value == ""){
		document.getElementById("telefono1").style.border = "2px solid red";
		document.getElementById("telefono2").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("telefono1").style.border = "";
			document.getElementById("telefono2").style.border = "";
			}
//---------------------------------------------------------------------------------------------	
		/*if(document.getElementById("email").value == ""){
		document.getElementById("email").style.border = "2px solid red";
		msg = msg+'-Bad';
		}else{
			document.getElementById("email").style.border = "";
			}*/
//---------------------------------------------------------------------------------------------	
	
//-----------------------------------------------------------------------------------------------			
		if (msg != '') { 
//			alert ('LOS CAMPOS NO PUEDEN QUEDAR VACIOS');
//document.getElementById("mensaje").value="LOS CAMPOS NO PUEDEN QUEDAR VACIOS";
//document.getElementById("mensaje").value="LOS CAMPOS NO PUEDEN QUEDAR VACIOS";
//document.getElementById("mensaje").style.b="2px solid red";
//
//mensaje_usuario('error','LOS CAMPOS NO PUEDEN QUEDAR VACIOS');
msg = '';
		return false;
		}else{
			var form = document.form;
			return true;
		}
		
	});
	
});