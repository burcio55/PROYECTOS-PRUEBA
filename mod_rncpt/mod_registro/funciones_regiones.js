
function estado(){
           $("#cbo_region option:selected").each(function () {
            elegido=$(this).val();
            combo='Estado';
            $.post("../combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
								$("#cbo_entidad").html(data);
						});            
        });
}

function estado_reporte(){
           $("#cbo_region2 option:selected").each(function () {
            elegido=$(this).val();
            combo='Estado';
            $.post("../combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
								$("#cbo_entidad2").html(data);
						});            
        });
}

function llamar_datatable(){
$('#tblDetalle').dataTable( { 
     "sPaginationType": "full_numbers" 
    } );
$('#tblDetalle').css('width','100%');
}	

function llamar_datatable_productos(){
$('#tblDetalle_prodcutos').dataTable( { 
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

if($("#valor").val()=='2'){buscar_estado();}else{

	if($("#valor").val()=='1'){
	buscar_region();
	}else{
	buscar_global();
	}
}

if($("#id").val()!="undefined"){
	miembros();
	productos();
	}
});

function buscar_region(){
	$.ajax({
	type: 'POST',
	url: 'consulta.php',
	data:'opcion='+4+'&cbo_estado_consulta='+$("#cbo_estado_consulta").val()+'&valor='+$("#valor").val(),
	success: function(data) {
			var str=data;
			var n=str.split("|");
			$('#region_tabla').html(n[0]); 
			if(n[1]==0){
				$('#cant_campos').val('0');	
			}else{
				$('#cant_campos').val(n[1]);	
			}
			llamar_datatable();
		}
		
	});
}

function buscar_global(){
	$.ajax({
	type: 'POST',
	url: 'consulta.php',
	data:'opcion='+4+'&cbo_region2='+$("#cbo_region2").val()+'&cbo_entidad2='+$("#cbo_entidad2").val(),
	success: function(data) {
			var str=data;
			var n=str.split("|");
			$('#region_tabla').html(n[0]); 
			if(n[1]==0){
				$('#cant_campos').val('0');	
			}else{
				$('#cant_campos').val(n[1]);	
			}
			llamar_datatable();
		}
		
	});
}
//__________________________________________________________
function buscar_estado(){
	
	$.ajax({
	type: 'POST',
	url: 'consulta.php',
	data:'opcion='+11+'&cbo_estado_consulta2='+$("#cbo_estado_consulta2").val(),
	success: function(data) {
			var str=data;
			var n=str.split("|");
			$('#estado_tabla').html(n[0]); 
			if(n[1]==0){
				$('#cant_campos').val('0');	
			}else{
				$('#cant_campos').val(n[1]);	
			}
			llamar_datatable();
		}
		
	});
}
//_____________________________________________________________

function ver_formulario(id){
	url='registro_region.php?id='+id;
	$(location).attr('href',url);
} 


function miembros(){
	$.ajax({
	type: 'POST',
	url: 'consulta.php',
	data:'opcion='+5+'&id='+$("#id").val(),
	success: function(data) {
			var str=data;
			var n=str.split("|");
			$('#miembros_tabla').html(n[0]); 
			if(n[1]==0){
				$('#cant_campos').val('0');	
			}else{
				$('#cant_campos').val(n[1]);	
			}
			llamar_datatable();
		}
		
	});
}

function productos(){
	$.ajax({
	type: 'POST',
	url: 'consulta.php',
	data:'opcion='+6+'&id='+$("#id").val(),
	success: function(data) {
			var str=data;
			var n=str.split("|");
			$('#productos_tabla').html(n[0]); 
			if(n[1]==0){
				$('#cant_campos').val('0');	
			}else{
				$('#cant_campos').val(n[1]);	
			}
			llamar_datatable_productos();
		}
		
	});
}


function editar(id,valor){
	url='registro_empresa.php?id='+id+'&valor='+valor;
	$(location).attr('href',url);
} 


function inactivo(id){
	if (confirm("- Desea Inhabilitar este Registro?")){
			$.ajax({
				type: 'POST',
				url: 'consulta.php',
				data:'opcion='+9+'&id='+id,
				success: function(data){
					data=data.trim();
				if(data=='activo'){	
					mensaje= "- REGISTRO NO PUEDE SER INHABILITADO LA EMPRESA TIENE TRABAJADORES REGISTRADOS. \n";
					alert(mensaje);
				}else if(data=='exito'){	
					alert('REGISTRO INHABILITADO EXITOSAMENTE');
					buscar();
					}else{
					alert('ERROR VERIFCAR POR SISTEMA');
					}
				}
			});
		}
}	

