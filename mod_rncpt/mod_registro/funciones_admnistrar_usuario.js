/*--------------------------------*/

function validar_campos(){
var validado=1;	
mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";

if($("#nacionalidad").val()==""){
$("#nacionalidad").css("border","solid 1px red");
validado=0;
}else{
$("#nacionalidad").css("border","");
}
if($("#cedulaconsulta").val()==""){
$("#cedulaconsulta").css("border","solid 1px red");
validado=0;
}else{
$("#cedulaconsulta").css("border","");
}
if($("#primer_apellido").val()==""){
$("#primer_apellido").css("border","solid 1px red");
validado=0;
}else{
$("#primer_apellido").css("border","");
}
/*if($("#segundo_apellido").val()==""){
$("#segundo_apellido").css("border","solid 1px red");
validado=0;
}else{
$("#segundo_apellido").css("border","");
}*/
if($("#txt_denominacion").val()==""){
$("#txt_denominacion").css("border","solid 1px red");
validado=0;
}else{
$("#txt_denominacion").css("border","");
}
if($("#primer_nombre").val()==""){
$("#primer_nombre").css("border","solid 1px red");
validado=0;
}else{
$("#primer_nombre").css("border","");
}
/*
if($("#segundo_nombre").val()==""){
$("#segundo_nombre").css("border","solid 1px red");
validado=0;
}else{
$("#segundo_nombre").css("border","");
}*/

if($("#cbo_usuario").val()==""){
$("#cbo_usuario").css("border","solid 1px red");
validado=0;
}else{
$("#cbo_usuario").css("border","");
}
if($("#cbo_region").val()==""){
$("#cbo_region").css("border","solid 1px red");
validado=0;
}else{
$("#cbo_region").css("border","");
}
if($("#cbo_entidad").val()==""){
$("#cbo_entidad").css("border","solid 1px red");
validado=0;
}else{
$("#cbo_entidad").css("border","");
}


if(validado==0){
		mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS (*). \n";
		alert(mensaje);
		return false;
	}else{
		return true;
	}
	
}

function estado(){
		 $("#cbo_region option:selected").each(function () {
			elegido=$(this).val();
			combo='Estado';
			$.post("../combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
					$("#cbo_entidad").html(data);
			});            
	});
}

function llamar_datatable(){
$('#tblDetalle').dataTable( { 
     "sPaginationType": "full_numbers" 
    } );
$('#tblDetalle').css('width','100%');
}	


function llamar_tooltip(){
	// modify global settings
	$.extend($.fn.Tooltip.defaults, {
		track: true,
		delay: 0,
		showURL: false,
		showBody: " - "
	});
	$('a, input, img , button,textarea,select').Tooltip();
	
}


$(document).ready(function() {	
mostrar_formulario();
setTimeout('usuario_registro()',500);	

});


function usuario_registro(){
	
		if($("#registrador").val()==''){
			$('#btnAgregar').show();
			$('#btnModificar').hide();
		}else{
			$('#btnAgregar').hide();
			$('#btnModificar').show();
		}

	$.ajax({
	type: 'POST',
	url: 'consulta_administrar_usuario.php',
	data:'opcion='+1,
	success: function(data) {
			var str=data;
			var n=str.split("|");
			$('#tabla_usuario').html(n[0]); 
			if(n[1]==0){
				$('#cant_campos').val('0');	
			}else{
				$('#cant_campos').val(n[1]);	
			}
			llamar_datatable();
		}
		
	});
}



function mostrar_formulario(){
	$.ajax({
	type: 'POST',
	url: 'formulario_usuario.php',
	success: function(data) {
	$('#formulario_usuario').html(data);
		$('#btnAgregar').show();
		$('#btnModificar').hide();
	 }
  });	
}

function editar(id){
	$.ajax({
		type: 'POST',
		url: 'formulario_usuario.php',
		data: 'id='+id,
		success: function(data){
		usuario_registro();
		$('#formulario_usuario').html(data); 
		$('#btnAgregar').hide();
		$('#btnModificar').show();
		}
	});		
}


function estatus(id,estatus){
	
	var nombre;
	
	if(estatus==1){ nombre='Inhabilitar'; valor='0'; nombre2='INHABILITADO'; }
	if(estatus==0){ nombre='Habilitar'; valor='1'; nombre2='HABILITADO';}
	
		if (confirm("- Desea "+ nombre +" este Registro?")){
				$.ajax({
					type: 'POST',
					url: 'consulta_administrar_usuario.php',
					data:'opcion='+2+'&id='+id+'&estatus='+valor,
					success: function(data){
						data=data.trim();
						if(data=='exito'){			
						alert('REGISTRO '+ nombre2 +' EXITOSAMENTE');
						usuario_registro();
						}
					}
				});
		}
}	

function limpiar_formulario(){
$("#sesion_id").val('');
$("#registrador").val('');
mostrar_formulario();
setTimeout('usuario_registro()',500);	

}

function modificar(){
		
	if(validar_campos()==true){
			$.ajax({
				type: 'POST',
				url: 'consulta_administrar_usuario.php',
				data:'sesion_id='+document.getElementById("sesion_id").value+
				'&registrador='+document.getElementById("registrador").value+
				'&nacionalidad='+document.getElementById("nacionalidad").value+
				'&cedula='+document.getElementById("cedulaconsulta").value+
				'&apellido1='+document.getElementById("primer_apellido").value+
				'&apellido2='+document.getElementById("segundo_apellido").value+
				'&nombre1='+document.getElementById("primer_nombre").value+
				'&nombre2='+document.getElementById("segundo_nombre").value+
				'&cbo_usuario='+document.getElementById("cbo_usuario").value+
				'&cbo_region='+document.getElementById("cbo_region").value+
				'&cbo_entidad='+document.getElementById("cbo_entidad").value+
				'&fechanac='+document.getElementById("fechanac").value+
				'&opcion='+3,
				success: function(data) {
					data=data.trim();
					if(data=='modificado'){		
						alert('REGISTRO MODIFICADO EXITOSAMENTE');			
					}
					if(data=='error_guardar'){					
						alert('ERROR AL REALIZAR LA OPERACION');
					}
				limpiar_formulario();
				}
			});
	}else{
		return false;
	}
}

function guardar(){
		
	if(validar_campos()==true){
			$.ajax({
				type: 'POST',
				url: 'consulta_administrar_usuario.php',
				data:'&nacionalidad='+document.getElementById("nacionalidad").value+
				'&cedula='+document.getElementById("cedulaconsulta").value+
				'&apellido1='+document.getElementById("primer_apellido").value+
				'&apellido2='+document.getElementById("segundo_apellido").value+
				'&nombre1='+document.getElementById("primer_nombre").value+
				'&nombre2='+document.getElementById("segundo_nombre").value+
				'&cbo_usuario='+document.getElementById("cbo_usuario").value+
				'&cbo_region='+document.getElementById("cbo_region").value+
				'&cbo_entidad='+document.getElementById("cbo_entidad").value+
				'&fechanac='+document.getElementById("fechanac").value+
				'&opcion='+4,
				success: function(data) {
					data=data.trim();
					if(data=='existe'){		
						alert('EL USUARIO YA SE ENCUENTRA HABILITADO');	
					}
					if(data=='gurdado'){		
						alert('REGISTRO MODIFICADO EXITOSAMENTE');			
					}
					if(data=='error_guardar'){					
						alert('ERROR AL REALIZAR LA OPERACION');
					}
				usuario_registro();
				}
			});
	}else{
		return false;
	}
}




function clave(id){
	
		if (confirm("- Desea Restaurar la Clave del Usuario?")){
				$.ajax({
					type: 'POST',
					url: 'consulta_administrar_usuario.php',
					data:'opcion='+5+'&id='+id,
					success: function(data){
						data=data.trim();
						if(data=='clave'){			
						alert('RESTAURACION DE CLAVE EXITOSAMENTE');
						usuario_registro();
						}
						if(data=='error_guardar'){					
							alert('ERROR AL REALIZAR LA OPERACION');
						}
					}
				});
		}
}	