// JavaScript Document


$(document).ready(function() {
$("#txt_rif").blur(function() {

	if ($("#txt_rif").attr("value").match(/^[VEPGJC]{1}[0-9]{9}$/)) {
									  



	}else {

		alert("EL FORMATO DEL RIF ES INCORECTO");
		$("#txt_rif").val("");
	}
});



$("#txt_email").blur(function() {

	if ($("#txt_email").attr("value").match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)) {
									  

	}else {

		alert("EL FORMATO DE EMAIL ES INCORECTO");
		$("#txt_email").val("");
	}
});



$("#txt_rif").blur(function() {

	if ($("#txt_rif").attr("value").match(/^[VEPGJ]{1}[0-9]{9}$/)) {
									  
			$.ajax({
				type: 'POST',
				url: 'seniat_buscar_rif.php',
				data: 'txt_rif='+$("#txt_rif").val(),
				success: function(data) {
				var str=data;

				if(data==0){
					alert("ESTE REGISTRO NO EXISTE");

				}

				var resultado=str.split("|"); 
				if(resultado[0]!=""){	

				}else{
						
							
							$("#txt_rif").val(resultado[1]);
							$("#txt_razon_social").val(resultado[2]);
							$("#txt_denominacion_comercial").val(resultado[3]);
							$("#txt_direccion_fiscal").val(resultado[4]);
							$("#txt_estado").val(resultado[5]);
							$("#txt_municipio").val(resultado[6]);
							$("#txt_parroquia").val(resultado[7]);
							$("#txt_email").val(resultado[8]);
							
				}

						
					}
				});	


	}else {

		alert("EL FORMATO DEL RIF ES INCORECTO");
		$("#txt_rif").val("");
	}
});
});

$(document).ready(function () {
	$("#guardar").click(function(){
		valido=1;
		mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";

		if($("#txt_rif").val()==''){
		 document.getElementById("txt_rif").style.borderColor= 'Red';
		 valido=0;
		}
		if($("#txt_razon_social").val()==''){
		 document.getElementById("txt_razon_social").style.borderColor= 'Red';
		 valido=0;	
		}

		if($("#txt_denominacion_comercial").val()==''){
		 document.getElementById("txt_denominacion_comercial").style.borderColor= 'Red';
		 valido=0;	
		}
		if($("#txt_direccion_fiscal").val()==''){
		 document.getElementById("txt_direccion_fiscal").style.borderColor= 'Red';
		 valido=0;	
		}
		if($("#txt_estado").val()==''){
		 document.getElementById("txt_estado").style.borderColor= 'Red';
		 valido=0;	
		}
		/*
		if($("#txt_municipio").val()==''){
		 document.getElementById("txt_municipio").style.borderColor= 'Red';
		 valido=0;	
		}
		if($("#txt_parroquia").val()==''){
		 document.getElementById("txt_parroquia").style.borderColor= 'Red';
		 valido=0;	
		}
		*/
		if($("#txt_email").val()==''){
		 document.getElementById("txt_email").style.borderColor= 'Red';
		 valido=0;	
		}



		if(valido==0){
			mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS (*). \n";
			alert(mensaje);	
		}else{
				$.ajax({
				type: 'POST',
				url: 'seniat_guardar_db.php',
				data: 'txt_rif='+$("#txt_rif").val()+'&txt_razon_social='+$("#txt_razon_social").val()+'&txt_denominacion_comercial='+$("#txt_denominacion_comercial").val()+'&txt_direccion_fiscal='+$("#txt_direccion_fiscal").val()+'&txt_estado='+$("#txt_estado").val()+'&txt_municipio='+$("#txt_municipio").val()+'&txt_parroquia='+$("#txt_parroquia").val()+'&txt_email='+$("#txt_email").val(),
				success: function(data) {
					//alert(data);
						if(data=='registrado'){
							alert('DATOS INGRESADOS EXITOSAMENTE');
							$("#txt_rif").val('');
							$("#txt_razon_social").val('');
							$("#txt_denominacion_comercial").val('');
							$("#txt_direccion_fiscal").val('');
							$("#txt_estado").val('');
							$("#txt_municipio").val('');
							$("#txt_parroquia").val('');
							$("#txt_email").val('');
							
						}else if(data=='existe'){
							alert('YA ESTA ENTIDAD SE ENCUENTRA REGISTRADA');
						}else{
							alert('ERROR AL INGRESAR LOS DATOS');
							//document.getElementById("txt_clave1").style.borderColor= 'Red';
							//document.getElementById("txt_clave2").style.borderColor= 'Red';
						}
					}
				});	
			
		}
	});
});


$(document).ready(function () {
	$("#modificar").click(function(){
		valido=1;
		mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";

		if($("#txt_rif").val()==''){
		 document.getElementById("txt_rif").style.borderColor= 'Red';
		 valido=0;
		}
		if($("#txt_razon_social").val()==''){
		 document.getElementById("txt_razon_social").style.borderColor= 'Red';
		 valido=0;	
		}

		if($("#txt_denominacion_comercial").val()==''){
		 document.getElementById("txt_denominacion_comercial").style.borderColor= 'Red';
		 valido=0;	
		}
		if($("#txt_direccion_fiscal").val()==''){
		 document.getElementById("txt_direccion_fiscal").style.borderColor= 'Red';
		 valido=0;	
		}
		if($("#txt_estado").val()==''){
		 document.getElementById("txt_estado").style.borderColor= 'Red';
		 valido=0;	
		}
		if($("#txt_municipio").val()==''){
		 document.getElementById("txt_municipio").style.borderColor= 'Red';
		 valido=0;	
		}
		if($("#txt_parroquia").val()==''){
		 document.getElementById("txt_parroquia").style.borderColor= 'Red';
		 valido=0;	
		}
		if($("#txt_email").val()==''){
		 document.getElementById("txt_email").style.borderColor= 'Red';
		 valido=0;	
		}



		if(valido==0){
			mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS (*). \n";
			alert(mensaje);	
		}else{
				$.ajax({
				type: 'POST',
				url: 'seniat_modificar_db.php',
				data: 'txt_rif='+$("#txt_rif").val()+'&txt_razon_social='+$("#txt_razon_social").val()+'&txt_denominacion_comercial='+$("#txt_denominacion_comercial").val()+'&txt_direccion_fiscal='+$("#txt_direccion_fiscal").val()+'&txt_estado='+$("#txt_estado").val()+'&txt_municipio='+$("#txt_municipio").val()+'&txt_parroquia='+$("#txt_parroquia").val()+'&txt_email='+$("#txt_email").val(),
				success: function(data) {
					alert(data);
						if(data=='modificado'){
							alert('DATOS MODIFICADOS EXITOSAMENTE');
							$("#txt_rif").val('');
							$("#txt_razon_social").val('');
							$("#txt_denominacion_comercial").val('');
							$("#txt_direccion_fiscal").val('');
							$("#txt_estado").val('');
							$("#txt_municipio").val('');
							$("#txt_parroquia").val('');
							$("#txt_email").val('');
							

						}else{
							alert('ERROR AL MODIFICAR LOS DATOS');
							//document.getElementById("txt_clave1").style.borderColor= 'Red';
							//document.getElementById("txt_clave2").style.borderColor= 'Red';
						}
					}
				});	
			
		}
	});
});