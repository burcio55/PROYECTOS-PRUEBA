//-------------------------------------------------------SISTEMAS-ROLES
$(document).ready(function(){
	$('#agregar').show();//-----MUESTRO-----
	$('#editar').hide();//-----OCULTO-----
	load()
});

function load(){
	var cbo_sistema= $("#cbo_sistema").val();
	var cbo_roles= $("#cbo_roles").val();	
	$.ajax({
		url:'ajax_admin_modulos.php?cbo_sistema='+cbo_sistema+'&cbo_roles='+cbo_roles+'&proceso=1',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');			
		}
	})
}

function limpiar(){
	$('#agregar').show();//-----MUESTRO-----
	$('#editar').hide();//-----OCULTO-----
	document.getElementById("modulos").reset();	
	document.getElementById("logo1_muestra").src = '/minpptrassi/logos/imagen1.jpg';
	document.getElementById("logo2_muestra").src = '/minpptrassi/logos/imagen2.jpg';
}

$(function(){	
	$("input[name='logo1']").on("change", function(){
		var formData = new FormData($("#modulos")[0]);
		var ruta = "ajax_subirimagen.php?opcion=1";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType: 'json',
			contentType: false,
			processData: false,
			success: function(datos){
				if(datos.response == 'success'){
					document.getElementById("logo1_muestra").src = '/minpptrassi/logos/'+datos.nombreimagen1;
					document.getElementById("imagen1").value = datos.nombreimagen1;	
				}else{
					var mensaje = datos.mensaje;
					alert(mensaje);
					document.getElementById("logo1").value = '';  
				}
			}
		});
	});
			
	$("input[name='logo2']").on("change", function(){
		var formData = new FormData($("#modulos")[0]);
		var ruta = "ajax_subirimagen.php?opcion=2";
		$.ajax({
			url: ruta,
			type: "POST",
			dataType: 'json',
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos){
				if(datos.response == 'success'){
					document.getElementById("logo2_muestra").src = '/minpptrassi/logos/'+datos.nombreimagen2;
					document.getElementById("imagen2").value = datos.nombreimagen2;
				}else{
					var mensaje = datos.mensaje;
					alert(mensaje);
					document.getElementById("logo2").value = ''; 
				}
			}
		});
	});	
});

function editar(modulo, opciones){
	$('#agregar').hide();//-----OCULTO-----
	$('#editar').show();//-----MUESTRO-----
	document.getElementById("modulos").reset();	
	$.ajax({
		url:'ajax_admin_modulos.php?modulo='+modulo+'&opciones='+opciones+'&proceso=2',
		dataType: 'json',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			if(data.response == 'success'){
			document.getElementById("modulo").value = data.descripcion;  
			document.getElementById("url_modulo").value = data.direccionurl;
			document.getElementById("logo1_muestra").src = '/minpptrassi/logos/'+data.logo1;
			document.getElementById("logo2_muestra").src = '/minpptrassi/logos/'+data.logo2;
			document.getElementById("imagen1").value = data.logo1;
			document.getElementById("imagen2").value = data.logo2;
			document.getElementById("modulo_id").value = data.modulo_id;
			document.getElementById("opcion_id").value = data.opcion_id;
			}
		}
	})
}

function procesaroption(modulo, opciones){
	var marcado = $('#mod'+modulo+':checked').val()?true:false;
		if (!marcado) { //alert('No checked');
			$.ajax({
				url:'ajax_admin_modulos.php?modulo='+modulo+'&opciones='+opciones+'&proceso=3',
				 beforeSend: function(objeto){
			  },
				success:function(data){
					//load();
				}
			})
        }else{ //alert('Si checked');
			$.ajax({
				url:'ajax_admin_modulos.php?modulo='+modulo+'&opciones='+opciones+'&proceso=4',
				 beforeSend: function(objeto){
			  },
				success:function(data){
					//load();
				}
			})
		}	
}

function actualizar(){
	
	var msg = '';
	
	if ($('#modulo').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("modulo").style.border = "1px solid red";
	}else{
		document.getElementById("modulo").style.border = "";
	}
	if ($('#url_modulo').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("url_modulo").style.border = "1px solid red";
	}else{
		document.getElementById("url_modulo").style.border = "";
	}
	if ($('#imagen1').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("logo1").style.border = "1px solid red";
	}else{
		document.getElementById("logo1").style.border = "";
	}
	if ($('#imagen2').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("logo2").style.border = "1px solid red";
	}else{
		document.getElementById("logo2").style.border = "";
	}
	
	
	if (msg != '') { 
		alert ('DEBE SELECCIONAR LOS CAMPOS REQUERIDOS');
		msg = '';
		return false;
	}else{ 	
		var modulo= $("#modulo_id").val();
		var opciones= $("#opcion_id").val();
		var descripcion= $("#modulo").val();
		var url= $("#url_modulo").val();
		var imagen1= $("#imagen1").val();
		var imagen2= $("#imagen2").val();	
		$.ajax({
			url:'ajax_admin_modulos.php?modulo='+modulo+'&opciones='+opciones+'&descripcion='+descripcion+'&url='+url+'&imagen1='+imagen1+'&imagen2='+imagen2+'&proceso=5',
			 beforeSend: function(objeto){
		  },
			success:function(data){
				$('#agregar').show();//-----MUESTRO-----
				$('#editar').hide();//-----OCULTO-----
				document.getElementById("modulos").reset();	
				document.getElementById("logo1_muestra").src = '/minpptrassi/logos/imagen1.jpg';
				document.getElementById("logo2_muestra").src = '/minpptrassi/logos/imagen2.jpg';
				load();
			}
		})
	}
}

function roles(modulo, opciones){
	location.href ='admin_roles.php?M='+modulo+'&O='+opciones;
}

function opciones(modulo, opciones){
	location.href ='admin_opciones.php?M='+modulo+'&O='+opciones;
}

function agregar(){
	
	var msg = '';
	
	if ($('#modulo').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("modulo").style.border = "1px solid red";
	}else{
		document.getElementById("modulo").style.border = "";
	}
	if ($('#url_modulo').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("url_modulo").style.border = "1px solid red";
	}else{
		document.getElementById("url_modulo").style.border = "";
	}
	if ($('#imagen1').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("logo1").style.border = "1px solid red";
	}else{
		document.getElementById("logo1").style.border = "";
	}
	if ($('#imagen2').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("logo2").style.border = "1px solid red";
	}else{
		document.getElementById("logo2").style.border = "";
	}
	
	
	if (msg != '') { 
		alert ('DEBE SELECCIONAR LOS CAMPOS REQUERIDOS');
		msg = '';
		return false;
	}else{ 	
		var descripcion= $("#modulo").val();
		var url= $("#url_modulo").val();
		var imagen1= $("#imagen1").val();
		var imagen2= $("#imagen2").val();
		
		$.ajax({
			url:'ajax_admin_modulos.php?descripcion='+descripcion+'&url='+url+'&imagen1='+imagen1+'&imagen2='+imagen2+'&proceso=6',
			dataType: 'json',
			 beforeSend: function(objeto){
		  },
			success:function(data){
				if(data.response == 'success'){
					$('#agregar').show();//-----MUESTRO-----
					$('#editar').hide();//-----OCULTO-----
					load();	
				}else{
					alert(data.mensaje);
				}
			}
		})
	}
}

function eliminar(opcion){

	$.ajax({
		url:'ajax_admin_modulos.php?opcion='+opcion+'&proceso=7',
		dataType: 'json',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			if(data.response == 'success'){
				$('#agregar').show();//-----MUESTRO-----
				$('#editar').hide();//-----OCULTO-----
				document.getElementById("modulos").reset();	
				document.getElementById("logo1_muestra").src = '/minpptrassi/logos/imagen1.jpg';
				document.getElementById("logo2_muestra").src = '/minpptrassi/logos/imagen2.jpg';
				load();			
			}else{
				alert(data.mensaje);
			}

		}
	})
}