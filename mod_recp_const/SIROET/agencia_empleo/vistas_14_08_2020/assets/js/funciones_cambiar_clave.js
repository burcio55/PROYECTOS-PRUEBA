// JavaScript Document
$(document).ready(function () {
	$("#guardar").click(function(){
		valido=1;
		if($("#txt_clave1").val()==''){
		 document.getElementById("txt_clave1").style.borderColor= 'Red';
		 valido=0;
		}
		if($("#txt_clave2").val()==''){
		 document.getElementById("txt_clave2").style.borderColor= 'Red';
		 valido=0;	
		}
		if(valido==0){
			alert("DEBE LLENAR LOS CAMPOS EN ROJO");	
		}else{
			if($("#txt_clave2").val()!=$("#txt_clave1").val()){
				alert("LAS CLAVES NO COINCIDEN");
			}else{
				$.ajax({
				type: 'POST',
				url: 'cambiar_clave_db.php',
				data: 'passwd='+$("#txt_clave1").val(),
				success: function(data) {
						if(data=='actualizada'){
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