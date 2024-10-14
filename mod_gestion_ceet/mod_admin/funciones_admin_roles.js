//-------------------------------------------------------SISTEMAS-ROLES
$(document).ready(function(){
	$('#agregar').show();//-----MUESTRO-----
	$('#editar').hide();//-----OCULTO-----
	load()
});

function load(){
	var modulo= $("#modulo").val();	
	$.ajax({
		url:'ajax_admin_roles.php?modulo='+modulo+'&proceso=1',
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
	document.getElementById("rol").value = ''; 
	document.getElementById("rol_id").value = '';
	document.getElementById("cbo_administrador").value = '';
}

function regresar(){
	location.href ='admin_modulos.php';
}

function editar(rol){
	$('#agregar').hide();//-----OCULTO-----
	$('#editar').show();//-----MUESTRO-----
	$.ajax({
		url:'ajax_admin_roles.php?rol='+rol+'&proceso=2',
		dataType: 'json',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			if(data.response == 'success'){
			document.getElementById("rol").value = data.descripcion;  
			document.getElementById("rol_id").value = data.rol_id;
			document.getElementById("cbo_administrador").value = data.nadministrador;
			}
		}
	})
}

function procesaroption(rol){
	var marcado = $('#rol'+rol+':checked').val()?true:false;
		if (!marcado) { //alert('No checked');
			$.ajax({
				url:'ajax_admin_roles.php?rol='+rol+'&proceso=3',
				 beforeSend: function(objeto){
			  },
				success:function(data){
					//load();
				}
			})
        }else{ //alert('Si checked');
			$.ajax({
				url:'ajax_admin_roles.php?rol='+rol+'&proceso=4',
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
	
	if ($('#rol').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("rol").style.border = "1px solid red";
	}else{
		document.getElementById("rol").style.border = "";
	}
	if ($('#cbo_administrador').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("cbo_administrador").style.border = "1px solid red";
	}else{
		document.getElementById("cbo_administrador").style.border = "";
	}
	
	
	if (msg != '') { 
		alert ('DEBE SELECCIONAR LOS CAMPOS REQUERIDOS');
		msg = '';
		return false;
	}else{ 	
		var rol_id= $("#rol_id").val();
		var descripcionrol= $("#rol").val();
		var cbo_administrador= $("#cbo_administrador").val();
		$.ajax({
			url:'ajax_admin_roles.php?rol_id='+rol_id+'&descripcionrol='+descripcionrol+'&cbo_administrador='+cbo_administrador+'&proceso=5',
			 beforeSend: function(objeto){
		  },
			success:function(data){
				$('#agregar').show();//-----MUESTRO-----
				$('#editar').hide();//-----OCULTO-----
				document.getElementById("rol").value = ''; 
				document.getElementById("rol_id").value = '';
				document.getElementById("cbo_administrador").value = '';
				load();
			}
		})
	}
}

function agregar(){
	
	var msg = '';
	
	if ($('#rol').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("rol").style.border = "1px solid red";
	}else{
		document.getElementById("rol").style.border = "";
	}
	if ($('#cbo_administrador').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("cbo_administrador").style.border = "1px solid red";
	}else{
		document.getElementById("cbo_administrador").style.border = "";
	}
	
	if (msg != '') { 
		alert ('DEBE SELECCIONAR LOS CAMPOS REQUERIDOS');
		msg = '';
		return false;
	}else{ 		
		var descripcionrol= $("#rol").val();
		var modulo= $("#modulo").val();
		var opcion_id= $("#opcion").val();
		var cbo_administrador= $("#cbo_administrador").val();
		$.ajax({
			url:'ajax_admin_roles.php?descripcionrol='+descripcionrol+'&modulo='+modulo+'&opcion_id='+opcion_id+'&cbo_administrador='+cbo_administrador+'&proceso=6',
			 beforeSend: function(objeto){
		  },
			success:function(data){
				$('#agregar').show();//-----MUESTRO-----
				$('#editar').hide();//-----OCULTO-----
				document.getElementById("rol").value = '';
				load();			
			}
		})
	}
}

function eliminar(rol){

	$.ajax({
		url:'ajax_admin_roles.php?rol='+rol+'&proceso=7',
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