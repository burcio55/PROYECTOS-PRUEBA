function mayusculas(e) {
    e.value = e.value.toUpperCase();
}


function eliminarT(saction,id){
	if (confirm("\u00BFDESEA ELIMINAR AL VOCERO?") == true) {
		$("#loader").show();
		var form = document.formularioCPT;
		form.action.value=saction;
		form.id.value=id;
		form.submit()
	}	
}
function editarT(saction,id){
	if (confirm("\u00BFDESEA MODIFICAR LOS DATOS DEL VOCERO?") == true) {
		$("#loader").show();
		var form = document.formularioCPT;
		form.action.value=saction;
		form.id.value=id;
		form.submit()
	}	
}
function guardarT(saction,cedulaconsulta){
var msg = '';
	
	if ($('#fechaconst').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("fechaconst").style.border = "1px solid red";
	}else{
		document.getElementById("fechaconst").style.border = "";
	}
	//if ($('#fechaconst').val().trim() > hoy ){
//	msg=msg+'-Bad';
//		document.getElementById("fechaconst").style.border = "1px solid red";
//			alert ('La Fecha de Constitución del CPTT es mayor a la fecha actual');
//		}else{
//		document.getElementById("fechaconst").style.border = "";
//	}
	if ($('#fechavencimiento').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("fechavencimiento").style.border = "1px solid red";
	}else{
		document.getElementById("fechavencimiento").style.border = "";
	}
	if ($('#total_trabajadores').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("total_trabajadores").style.border = "1px solid red";
	}else{
		document.getElementById("total_trabajadores").style.border = "";
	}
	if ($('#nro_votos').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("nro_votos").style.border = "1px solid red";
	}else{
		document.getElementById("nro_votos").style.border = "";
	}
	
	if ($('#cedulaconsulta').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("cedulaconsulta").style.border = "1px solid red";
	}else{
		document.getElementById("cedulaconsulta").style.border = "";
	}
	
	if ($('#email').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("email").style.border = "1px solid red";
	}else{
		document.getElementById("email").style.border = "";
	}	

	
	if ($('#cbo_cargos').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("cbo_cargos").style.border = "1px solid red";
	}else{
		document.getElementById("cbo_cargos").style.border = "";
	}
	
	if ($('#condicion').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("condicion").style.border = "1px solid red";
	}else{
		document.getElementById("condicion").style.border = "";
	}

	
		if (msg != '') { 
		alert ('Debe seleccionar los campos requeridos');
		msg = '';
		return false;
		}else{
			//if (confirm("\u00BFDESEA CONTINUAR?") == true) {
				$("#loader").show();
				var form = document.formularioCPT;
				form.action.value=saction;
				form.submit();
			//}
		}
}

function isNumberKey(evt){
	
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode > 31 && (charCode < 48 || charCode > 57) )
	 return false;
	
	 return true;
}

function validarEmail() {
	var correo = document.getElementById("email").value;
    expr = /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}([.][a-zA-Z]{2,4})+$/;
    
	if(!correo){
		//alert("Debe escribir su correo.");
	}else{
	if (!expr.test(correo))
        alert("La direcci\u00f3n de correo es incorrecta.");
	}
}
						
function vecimiento(){	


//FORMULARIO3

var inicio=document.getElementById("fechaconst").value;
//var fin=document.getElementById("datepicker2").value;

var start=new Date(inicio);
start.setFullYear(start.getFullYear()+2);
var startf = start.toISOString().slice(0,10).replace(/-/g,"-");
document.getElementById("fechavencimiento_").value= startf;
document.getElementById("fechavencimiento").value= startf;
/*		
var inicio=document.getElementById("fechaconst").value;					
var fecha = new Date(inicio);
fecha.setYear(fecha.getYear()+2);

document.getElementById("fechavencimiento").value=	fecha;*/
}