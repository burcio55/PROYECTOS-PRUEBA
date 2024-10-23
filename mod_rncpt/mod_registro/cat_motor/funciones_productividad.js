function mostrar_formulario(){
	$.ajax({
	type: 'POST',
	url: 'formulario_productividad.php',
	success: function(data) {
		$('#formulario_productividad').html(data);
		$('#btnAgregar').show();
		$('#btnModificar').hide();
	 }
  });	
} 


$(document).ready(function() {	
mostrar_formulario();
registro_tabla();

});


function registro_tabla(){

		if($("#id").val()==''){
			$('#btnAgregar').show();
			$('#btnModificar').show();
		}else{
			$('#btnAgregar').hide();
			$('#btnModificar').show();
		}
		
	$.ajax({
	type: 'POST',
	url: '../tablas.php',
	data:'opcion='+1,
	success: function(data) {
			var str=data;
			var n=str.split("|");
			$('#tabla_productividad').html(n[0]); 
			if(n[1]==0){
				$('#cant_campos').val('0');	
			}else{
				$('#cant_campos').val(n[1]);	
			}
		}
	});
}


function validar_campos(){
var validado=1;	
mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";

if($("#txt_descripcion").val()==""){
$("#txt_descripcion").css("border","solid 1px red");
validado=0;
}else{
$("#txt_descripcion").css("border","");
}

	if(validado==0){
		mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS (*). \n";
		alert(mensaje);
		return false;
	}else{
		return true;
	}
	
}


function limpiar(){
$("#id").val('');
mostrar_formulario();
}


function agregar(){	

	if(validar_campos()==true){
		$.ajax({
			type: 'POST',
			url: '../case_sentencias.php',
	  	    data:'txt_descripcion='+document.getElementById("txt_descripcion").value+'&opcion='+1,
			success: function(data) {
				if(data=='guardado'){		
					alert('REGISTRADO EXITOSAMENTE');			
					$("#cant_campos").val('1');
				}
				if(data=='error_guardar'){					
					alert('ERROR AL REALIZAR LA OPERACION');
				}
				if(data=='existe'){	
					alert('ESTE REGISTRO YA EXISTE');
				}
				if(data=='data_inconsistente'){	
					alert('NO SE PUEDE REALIZAR LA OPERACION,DEBE LLENAR LOS DATOS CORRECTAMENTE');
				}
				limpiar();
				registro_tabla();	
			}
		});
	}else{
		return false;
	}
}



function editar(id){
$('#formulario_productividad').show();

	$.ajax({
	type: 'POST',
	url: 'formulario_productividad.php',
	data: 'id='+id,
	success: function(data){
  registro_tabla();
	$('#formulario_productividad').html(data); 
	$('#btnAgregar').hide();
	$('#btnModificar').show();
	}
	});		
}


function modificar(){
		if(validar_campos()==true){
		$.ajax({
			type: 'POST',
			url: '../case_sentencias.php',
	  	    data:'txt_descripcion='+document.getElementById("txt_descripcion").value+
			'&opcion='+2+'&productividad_id='+document.getElementById("id").value,
			success: function(data) {
					//alert(data);
					if(data=='modificado'){		
						alert('REGISTRO MODIFICADO EXITOSAMENTE');			
						$("#cant_campos").val('1');
					}
					if(data=='error_guardar'){					
						alert('ERROR AL REALIZAR LA OPERACION');
					}
					if(data=='existe'){	
						alert('ESTE REGISTRO YA EXISTE');
					}
				limpiar();
				registro_tabla();	
				}
			});
	}else{
		return false;
	}
}


function activar(id,tipo,tabla){

	$.ajax({
	type: 'POST',
	url: '../case_sentencias.php',
	data: 'id='+id+'&tipo='+tipo+'&opcion='+5+'&tabla='+tabla,
	success: function(data){
		if(data=='1'){	
				alert('REGISTRO FUE HABILITADO EXITOSAMENTE');	
		}else if(data=='0'){	
				alert('REGISTRO FUE INHABILITADO EXITOSAMENTE');	
		}
  	registro_tabla();
	mostrar_formulario();
		}
	});		
}
