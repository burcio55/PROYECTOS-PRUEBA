$(document).ready(function () {//la primera carta
			//$("#editar").hide(); //oculto
			//$("#guardar").show(); //mostrar	
											
});

function send(saction){
	if(saction=='cargar'){
		if(validar_carga_nomina_db_obrero() == true){
			$("#loader").show();
			var form = document.form;
			form.action.value=saction;
			form.submit();
		}
	}
		
}	

function validar_carga_nomina_db_obrero(){
	var valor=1 ;
	var mensaje;
	var mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";


	if(document.getElementById("anio").value.length==0){
		document.getElementById("anio").style.borderColor= 'Red';
		valor=0;
	}else{
		document.getElementById("anio").style.borderColor= '';
	}
	
	if(document.getElementById("mes").value.length==0){
		document.getElementById("mes").style.borderColor= 'Red';
		valor=0;
	}else{
		document.getElementById("mes").style.borderColor= '';
	}
	if(document.getElementById("semana").value.length==0){
		alert('2');
		document.getElementById("semana").style.borderColor= 'Red';
		valor=0;
	}else{
		document.getElementById("semana").style.borderColor= '';
	}
	if(document.getElementById("ticket").value.length==0){
		document.getElementById("ticket").style.borderColor= 'Red';
		valor=0;
	}else{
		document.getElementById("ticket").style.borderColor= '';
	}
	
	if(valor==0){
		mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS (*). \n";
		alert(mensaje);
		return false;
	}else{
		return true;
	}
	
}