$(document).ready(function() {

if($("form").attr("name")=='form_empresa'){
	if($("#cbredes_sociales").val()=='1'){
			$("#tr_redes_sociales").show();
			$("#tr_redes_sociales1").show();
			$("#tblDetalle").show();
	}else{
		$("#tr_redes_sociales").hide(); 
		$("#tr_redes_sociales1").hide(); 
		$("#tblDetalle").hide();
	}


	$("#cbredes_sociales").change(function(){
	
		if($("#cbredes_sociales").val()=='1'){	
			$("#tr_redes_sociales").show();
			$("#tr_redes_sociales1").show();
			$("#tblDetalle").show();		
		}else{
			$("#tr_redes_sociales").hide();
			$("#tr_redes_sociales1").hide();
			$("#tblDetalle").hide();
		}
 	}); 
}

if($("form").attr("name")=='form_otros_datos'){
	if($("#cbsucursales").val()=='1'){
			$("#tr_sucursales").show();
			$("#tr_sucursales1").show();
			$("#tr_sucursales2").show();
	}else{
		$("#tr_sucursales").hide(); 
		$("#tr_sucursales1").hide(); 
		$("#tr_sucursales2").hide()
		
	}

	$("#cbsucursales").change(function(){
	
		if($("#cbsucursales").val()=='1'){	
			$("#tr_sucursales").show();
			$("#tr_sucursales1").show();
			$("#tr_sucursales2").show();
				
		}else{
			$("#tr_sucursales").hide();
			$("#tr_sucursales1").hide();
			$("#tr_sucursales2").hide()
		}
 	}); 
}
 

});
$(document).ready(function() {

if($("form").attr("name")=='form_otros_datos'){
	if($("#cbsucursales").val()=='1'){
			$("#tr_sucursales").show();
			$("#tr_sucursales1").show();
			;
	}else{
		$("#tr_sucursales").hide(); 
		$("#tr_sucursales1").hide(); 
	
		
	}

	$("#cbsucursales").change(function(){
	
		if($("#cbsucursales").val()=='1'){	
			$("#tr_sucursales").show();
			$("#tr_sucursales1").show();
			
				
		}else{
			$("#tr_sucursales").hide();
			$("#tr_sucursales1").hide();
			
		}
 	}); 
}
 

});
