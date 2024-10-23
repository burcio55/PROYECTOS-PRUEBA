// JavaScript Document
$(document).ready(function () {
	$("#buscar_entidad_por_estado").click(function(){
		valido=1;
		if($("#cbEstado_empresa").val()=='-1'){
		 document.getElementById("cbEstado_empresa").style.borderColor= '#DF0101';
		 valido=0;
		}else{
		document.getElementById("cbEstado_empresa").style.borderColor= '';
		}
		
		if(valido==0){
			alert("DEBE SELECCIONAR EL ESTADO");	
		}else{	
				$.ajax({
				type: 'POST',
				url: 'mod_agencia_empleo/buscar_entidad_estado.php',
				data: 'estado='+$("#cbEstado_empresa").val(),
				success: function(data) {

						if(data=='no_encontrado'){
							alert('ESTE ESTADO NO TIENE ENTIDAD DE TRABAJO');
							$("#cbEstado_empresa").val('-1');
							$("#reporte_por_estado").html(data).fadeOut(1);
						}else{
							if(data!='no_encontrado'){
								$("#reporte_por_estado").html(data).fadeIn('slow');
							}
						}
					}
				});	
			
		}
	});
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::
$("#buscar_entidad_por_municipio").click(function(){
	valido=1;

		if($("#cbEstado_afiliado").val()==''){
			document.getElementById("cbEstado_afiliado").style.borderColor= '#DF0101';
		 	valido=2;
		}else{

			document.getElementById("cbEstado_afiliado").style.borderColor= '';

			if($("#cbMunicipio_afiliado").val()==''){
			 document.getElementById("cbMunicipio_afiliado").style.borderColor= '#DF0101';
			 valido=3;
			}else{
			document.getElementById("cbMunicipio_afiliado").style.borderColor= '';
			}
		}
		
		if(valido==2){
			alert("DEBE SELECCIONAR EL ESTADO");	
		}
		if(valido==3){
			alert("DEBE SELECCIONAR EL MUNICIPIO");
		}

		if(valido!=2 && valido!=3){	
				$.ajax({
				type: 'POST',
				url: 'mod_agencia_empleo/buscar_entidad_municipio.php',
				data: '&estado='+$("#cbEstado_afiliado").val()+'&municipio='+$("#cbMunicipio_afiliado").val(),
				success: function(data){
		
						if(data=='no_encontrado'){
							alert('ESTE MUNICIPIO NO TIENE ENTIDAD DE TRABAJO');
							$("#reporte_por_municipio").html(data).fadeOut(1);
						}else{
							if(data!='no_encontrado'){
								$("#reporte_por_municipio").html(data).fadeIn('slow');
							}
						}
					}
				});	
			
		}
});
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::
$("#buscar_entidad_por_parroquia").click(function(){
	valido=1;

		if($("#cbEstado_afiliado").val()==''){
			document.getElementById("cbEstado_afiliado").style.borderColor= '#DF0101';
		 	valido=2;
		}else{
			document.getElementById("cbEstado_afiliado").style.borderColor= '';

			if($("#cbMunicipio_afiliado").val()==''){
			 	document.getElementById("cbMunicipio_afiliado").style.borderColor= '#DF0101';
			 	valido=3;
			}else{
				document.getElementById("cbMunicipio_afiliado").style.borderColor= '';

					if($("#cbParroquia_afiliado").val()==''){
				 		document.getElementById("cbParroquia_afiliado").style.borderColor= '#DF0101';
				 		valido=4;
					}else{
						document.getElementById("cbParroquia_afiliado").style.borderColor= '';
					}
			}
		}
		
		if(valido==2){
			alert("DEBE SELECCIONAR EL ESTADO");	
		}
		if(valido==3){
			alert("DEBE SELECCIONAR EL MUNICIPIO");
		}
		if(valido==4){
			alert("DEBE SELECCIONAR LA PARROQUIA");
		}

		if(valido!=2 && valido!=3 && valido!=4){	
				$.ajax({
				type: 'POST',
				url: 'mod_agencia_empleo/buscar_entidad_parroquia.php',
				data: '&estado='+$("#cbEstado_afiliado").val()+'&municipio='+$("#cbMunicipio_afiliado").val()+'&parroquia='+$("#cbParroquia_afiliado").val(),
				success: function(data){
		
						if(data=='no_encontrado'){
							alert('ESTA PARROQUIA NO TIENE ENTIDAD DE TRABAJO');
							$("#reporte_por_parroquia").html(data).fadeOut(1);
						}else{
							if(data!='no_encontrado'){
								$("#reporte_por_parroquia").html(data).fadeIn('slow');
							}
						}
					}
				});	
			
		}
});
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::
$("#buscar_trabajador_por_estado").click(function(){
	valido=1;
	if($("#cbEstado_empresa").val()=='-1'){
	 document.getElementById("cbEstado_empresa").style.borderColor= '#DF0101';
	 valido=0;
	}else{
	 document.getElementById("cbEstado_empresa").style.borderColor= '';
	}
	
	if(valido==0){
		alert("DEBE SELECCIONAR EL ESTADO");	
	}else{	
			$.ajax({
			type: 'POST',
			url: 'mod_agencia_empleo/buscar_trabajador_estado.php',
			data: 'estado='+$("#cbEstado_empresa").val(),
			success: function(data) {

					if(data=='no_encontrado'){
						alert('ESTE ESTADO NO TIENE TRABAJADOR REGISTRADO');
						$("#cbEstado_empresa").val('');
						$("#reporte_por_estado").html(data).fadeOut(1);
					}else{
						if(data!='no_encontrado'){
							$("#reporte_por_estado").html(data).fadeIn('slow');
						}
					}
				}
			});	
		
	}
});
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::
$("#buscar_trabajador_por_municipio").click(function(){
	valido=1;

		if($("#cbEstado_afiliado").val()==''){
			document.getElementById("cbEstado_afiliado").style.borderColor= '#DF0101';
		 	valido=2;
		}else{
			document.getElementById("cbEstado_afiliado").style.borderColor= '';

			if($("#cbMunicipio_afiliado").val()==''){
			 document.getElementById("cbMunicipio_afiliado").style.borderColor= '#DF0101';
			 valido=3;
			}else{
			 document.getElementById("cbMunicipio_afiliado").style.borderColor= '';
			}
		}
		
		if(valido==2){
			alert("DEBE SELECCIONAR EL ESTADO");	
		}
		if(valido==3){
			alert("DEBE SELECCIONAR EL MUNICIPIO");
		}

		if(valido!=2 && valido!=3){	
				$.ajax({
				type: 'POST',
				url: 'mod_agencia_empleo/buscar_trabajador_municipio.php',
				data: '&estado='+$("#cbEstado_afiliado").val()+'&municipio='+$("#cbMunicipio_afiliado").val(),
				success: function(data){
						
						//alert(data);
						if(data=='no_encontrado'){
							alert('ESTE MUNICIPIO NO TIENE TRABAJADOR');
							$("#reporte_por_municipio").html(data).fadeOut(1);
						}else{
							if(data!='no_encontrado'){
								$("#reporte_por_municipio").html(data).fadeIn('slow');
							}
						}
					}
				});	
			
		}
});
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::
$("#buscar_trabajador_por_parroquia").click(function(){
	valido=1;

		if($("#cbEstado_afiliado").val()==''){
			document.getElementById("cbEstado_afiliado").style.borderColor= '#DF0101';
		 	valido=2;
		}else{
			document.getElementById("cbEstado_afiliado").style.borderColor= '';

			if($("#cbMunicipio_afiliado").val()==''){
			 	document.getElementById("cbMunicipio_afiliado").style.borderColor= '#DF0101';
			 	valido=3;
			}else{
				document.getElementById("cbMunicipio_afiliado").style.borderColor= '';
				
					if($("#cbParroquia_afiliado").val()==''){
				 		document.getElementById("cbParroquia_afiliado").style.borderColor= '#DF0101';
				 		valido=4;
					}else{
					 document.getElementById("cbParroquia_afiliado").style.borderColor= '';
					}
			}
		}
		
		if(valido==2){
			alert("DEBE SELECCIONAR EL ESTADO");	
		}
		if(valido==3){
			alert("DEBE SELECCIONAR EL MUNICIPIO");
		}
		if(valido==4){
			alert("DEBE SELECCIONAR LA PARROQUIA");
		}

		if(valido!=2 && valido!=3 && valido!=4){	
				$.ajax({
				type: 'POST',
				url: 'mod_agencia_empleo/buscar_trabajador_parroquia.php',
				data: '&estado='+$("#cbEstado_afiliado").val()+'&municipio='+$("#cbMunicipio_afiliado").val()+'&parroquia='+$("#cbParroquia_afiliado").val(),
				success: function(data){
		
						if(data=='no_encontrado'){
							alert('ESTA PARROQUIA NO TIENE TRABAJADOR');
							$("#reporte_por_parroquia").html(data).fadeOut(1);
						}else{
							if(data!='no_encontrado'){
								$("#reporte_por_parroquia").html(data).fadeIn('slow');
							}
						}
					}
				});	
			
		}
});
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::
});