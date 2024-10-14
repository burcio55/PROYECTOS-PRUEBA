// JavaScript Document
$(document).ready(function () {
	$("#guardar").click(function(){
		valido=1;
		mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";

		if($("#txt_clave1").val()==''){
		 document.getElementById("txt_clave1").style.borderColor= 'Red';
		 valido=0;
		}
		if($("#txt_clave2").val()==''){
		 document.getElementById("txt_clave2").style.borderColor= 'Red';
		 valido=0;	
		}
		if(valido==0){
			mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS (*). \n";
			alert(mensaje);	
		}else{
			if($("#txt_clave2").val()!=$("#txt_clave1").val()){
				alert("LAS CLAVES NO COINCIDEN");
				$("#txt_clave1").val('');
				$("#txt_clave2").val('');
			}else{
				$.ajax({
				type: 'POST',
				url: 'cambiar_clave_db.php',
				data: 'passwd='+$("#txt_clave1").val(),
				success: function(data) {
						if(data == 'actualizada'){
							alert('CLAVE ACTUALIZADA EXITOSAMENTE');
							$("#txt_clave1").val('');
							$("#txt_clave2").val('');
						}else{
							alert('ERROR AL CAMBIAR LA CLAVE');
							document.getElementById("txt_clave1").style.borderColor= 'Red';
							document.getElementById("txt_clave2").style.borderColor= 'Red';
						}
					}
				});	
			}
		}
	});
});