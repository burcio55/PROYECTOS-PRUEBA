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

function llamar_datatable_miembros(){
$('#tblDetalle_miembros').dataTable( { 
     "sPaginationType": "full_numbers" 
    } );
$('#tblDetalle_miembros').css('width','100%');
}	

function llamar_datatable_nacional(){
$('#tblDetalle_nacional').dataTable( { 
     "sPaginationType": "full_numbers" 
    } );
$('#tblDetalle_nacional').css('width','100%');
}	

function llamar_datatable_es_re(){
$('#tblDetalle_es_re').dataTable( { 
     "sPaginationType": "full_numbers" 
    } );
$('#tblDetalle_es_re').css('width','100%');
}	

function llamar_datatable_reporte(){
$('#tblDetalle_reporte').dataTable( { 
     "sPaginationType": "full_numbers" 
    } );
$('#tblDetalle_reporte').css('width','100%');
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
		
if($("#valor").val()=='2'){ reporte_empresa_estado();}
if($("#valor").val()=='1'){ reporte_empresa_es_re();}
if($("#valor").val()=='1'){ reporte_empresa_nacional();}
if($("#valor").val()=='3'){ reporte_miembros();}
});

function reporte_empresa_estado(){
	$.ajax({
	type: 'POST',
	url: 'consulta_reporte.php',
	data:'opcion='+1+'&estado='+$("#cbo_estado_reporte").val(),
	beforesend: function(){
			$("#loader").show();
	},
	
	success: function(data) {
			var str=data;
			var n=str.split("|");
			$('#empresa_estado_tabla').html(n[0]); 
			$('#empresa_origen').html(n[1]); 
			if(n[1]==0){
				$('#cant_campos').val('0');	
			}else{
				$('#cant_campos').val(n[2]);	
			}
			llamar_datatable();
		},
		complete: function(){
		$("#loader").hide();
	}
		
	});
}

function reporte_empresa_nacional(){
	$.ajax({
	type: 'POST',
	url: 'consulta_reporte.php',
	data:'opcion='+3,
	success: function(data) {
			var str=data;
			var n=str.split("|");
			$('#nacional_tabla').html(n[0]); 
			if(n[1]==0){
				$('#cant_campos').val('0');	
			}else{
				$('#cant_campos').val(n[1]);	
			}
			llamar_datatable_nacional();
		}
		
	});
}

function reporte_empresa_es_re(){
	$.ajax({
	type: 'POST',
	url: 'consulta_reporte.php',
	data:'opcion='+4+'&region='+$("#cbo_region2").val()+'&estado='+$("#cbo_entidad2").val(),
	success: function(data) {
			var str=data;
			var n=str.split("|");
			$('#region_estado_tabla').html(n[0]); 
			if(n[1]==0){
				$('#cant_campos').val('0');	
			}else{
				$('#cant_campos').val(n[1]);	
			}
			llamar_datatable_es_re();
		}
		
	});
}


function reporte_miembros(){
	$.ajax({
	type: 'POST',
	url: 'consulta_reporte.php',
	data:'opcion='+2+'&estado='+$("#cbo_estado_reporte").val(),
	success: function(data) {
			var str=data;
			var n=str.split("|");
			$('#empresa_miembros').html(n[0]); 
			if(n[1]==0){
				$('#cant_campos').val('0');	
			}else{
				$('#cant_campos').val(n[1]);	
			}
			llamar_datatable_reporte();
		}
		
	});
}
