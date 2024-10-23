// JavaScript Document

$(document).ready(function() {

	$("#txt_cedula").blur(function() {//disparado cuando un elemento ha perdido su foco

		if ($("#txt_cedula").attr("value").match(/^[VEPGJ]{1}[0-9]{7,8}$/)) {
										
			$.ajax({
				type: 'POST',
				url: 'saime_buscar_cedula.php',
				data: 'txt_cedula='+$("#txt_cedula").val(),
				success: function(data) {
					var str=data;

					if(data==0){
						alert("ESTE REGISTRO NO EXISTE");

					}

					var resultado=str.split("|"); 
					
					if(resultado[0]!=""){	

					}else{
						
						//alert(resultado[7]);
						//$("#txt_cedula").val(resultado[1]);
						$("#txt_primer_nombre").val(resultado[3]);
						$("#txt_segundo_nombre").val(resultado[4]);
						$("#txt_primer_apellido").val(resultado[5]);
						$("#txt_segundo_apellido").val(resultado[6]);
						$("#cbo_sexo option[value="+resultado[7]+"]").attr("selected", true);
						$("#fecha_nacimiento").val(resultado[8]);
						
						$("#cbo_nacionalidad option[value="+resultado[9]+"]").attr("selected", true);
						$("#cbo_pais_origen option[value="+resultado[10]+"]").attr("selected", true);

					}
						
				}
			});	

		}else {

			alert("EL FORMATO DE CEDULA ES INCORECTO");
			$("#txt_cedula").val("");
		}
	});
});

$(document).ready(function () {
	$("#guardar").click(function(){
		
		
		valido=1;
		mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";

		if($("#txt_cedula").val()==''){
		 document.getElementById("txt_cedula").style.borderColor= 'Red';
		 valido=0;
		}
		if($("#txt_primer_nombre").val()==''){
		 document.getElementById("txt_primer_nombre").style.borderColor= 'Red';
		 valido=0;	
		}

		/*if($("#txt_segundo_nombre").val()==''){
		 document.getElementById("txt_segundo_nombre").style.borderColor= 'Red';
		 valido=0;	
		}*/
		if($("#txt_primer_apellido").val()==''){
		 document.getElementById("txt_primer_apellido").style.borderColor= 'Red';
		 valido=0;	
		}
		/*
		if($("#txt_segundo_apellido").val()==''){
		 document.getElementById("txt_segundo_apellido").style.borderColor= 'Red';
		 valido=0;	
		}*/
		if($("#cbo_sexo").val()==''){
		 document.getElementById("cbo_sexo").style.borderColor= 'Red';
		 valido=0;	
		}
		
		
		
		
		if($("#fecha_nacimiento").val()==''){
		 document.getElementById("fecha_nacimiento").style.borderColor= 'Red';
		 valido=0;	
		}
		if($("#cbo_nacionalidad").val()==''){
		 document.getElementById("cbo_nacionalidad").style.borderColor= 'Red';
		 valido=0;	
		}
		if($("#cbo_pais_origen").val()==''){
		 document.getElementById("cbo_pais_origen").style.borderColor= 'Red';
		 valido=0;	
		}

		



		if(valido==0){
			mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS (*). \n";
			alert(mensaje);	
		}else{
				$.ajax({
				type: 'POST',
				url: 'saime_guardar_db.php',
				data: 'txt_cedula='+$("#txt_cedula").val()+'&txt_primer_nombre='+$("#txt_primer_nombre").val()+'&txt_segundo_nombre='+$("#txt_segundo_nombre").val()+'&txt_primer_apellido='+$("#txt_primer_apellido").val()+'&txt_segundo_apellido='+$("#txt_segundo_apellido").val()+'&fecha_nacimiento='+$("#fecha_nacimiento").val()+'&cbo_nacionalidad='+$("#cbo_nacionalidad").val()+'&cbo_pais_origen='+$("#cbo_pais_origen").val()+'&cbo_sexo='+$("#cbo_sexo").val(),
				success: function(data) {
					//alert(data);
						if(data=='registrado'){
							alert('DATOS INGRESADOS EXITOSAMENTE');
							$("#txt_cedula").val('');
							$("#txt_primer_nombre").val('');
							$("#txt_segundo_nombre").val('');
							$("#txt_primer_apellido").val('');
							$("#txt_segundo_apellido").val('');
							$("#fecha_nacimiento").val('');
							$("#cbo_nacionalidad").val('');
							$("#cbo_pais_origen").val('');
							$("#cbo_sexo").val('');
							
							
						}else if(data=='existe'){
							
				$.ajax({
				type: 'POST',
				url: 'saime_modificar_db.php',
				data: 'txt_cedula='+$("#txt_cedula").val()+'&txt_primer_nombre='+$("#txt_primer_nombre").val()+'&txt_segundo_nombre='+$("#txt_segundo_nombre").val()+'&txt_primer_apellido='+$("#txt_primer_apellido").val()+'&txt_segundo_apellido='+$("#txt_segundo_apellido").val()+'&fecha_nacimiento='+$("#fecha_nacimiento").val()+'&cbo_nacionalidad='+$("#cbo_nacionalidad").val()+'&cbo_pais_origen='+$("#cbo_pais_origen").val()+'&cbo_sexo='+$("#cbo_sexo").val(),
				success: function(data) {
					//alert(data);
						if(data=='modificado'){
							alert('DATOS MODIFICADOS EXITOSAMENTE');
							$("#txt_cedula").val('');
							$("#txt_primer_nombre").val('');
							$("#txt_segundo_nombre").val('');
							$("#txt_primer_apellido").val('');
							$("#txt_segundo_apellido").val('');
							$("#fecha_nacimiento").val('');
							$("#cbo_nacionalidad").val('');
							$("#cbo_pais_origen").val('');
							$("#cbo_sexo").val('');
							

						}else{
							alert('ERROR AL MODIFICAR LOS DATOS');
							//document.getElementById("txt_clave1").style.borderColor= 'Red';
							//document.getElementById("txt_clave2").style.borderColor= 'Red';
						}
					}
				});	
			
		
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