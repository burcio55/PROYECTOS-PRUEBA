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
 

});