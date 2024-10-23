/*--------------------------------*/
$(document).ready(function() {	
registros_empresa();
});

function registros_empresa(){
	$.ajax({
	type: 'POST',
	url: 'consulta.php',
	data:'opcion='+2,
	success: function(data) {
		//alert (data);
			var str=data;
			var n=str.split("|");
			$('#empresa_tabla').html(n[0]); 
			if(n[1]==0){
				$('#cant_campos').val('0');	
			}else{
				$('#cant_campos').val(n[1]);	
			}
			llamar_datatable();
		}
		
	});
}


function llamar_datatable(){
$('#tblDetalle').dataTable( { 
     "sPaginationType": "full_numbers" 
    } );
$('#tblDetalle').css('width','100%');
}	

function mayusculas(e) {
    e.value = e.value.toUpperCase();
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


function ir(id){
  $.ajax({
	type: 'POST',
	
	success: function(data) {
			if(data='ir'){
				url="registro_empresa.php";
				$(location).attr('href',url);			
			}
		
		}
  });
 }

function ir_vocero(id,entidad){
  $.ajax({
	type: 'POST',	
	success: function(data) {
		//alert(data);
			if(data='ir'){					
				url="registro_personal.php?id="+id+"&entidad="+entidad;
				$(location).attr('href',url);			
			}		
		}
  });
 }







