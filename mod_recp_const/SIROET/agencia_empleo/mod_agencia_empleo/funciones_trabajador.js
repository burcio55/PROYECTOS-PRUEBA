$(document).ready(function() {
//////////////////////////////////////////////////////DISCAPACIDAD///////////////////////////////////////////////////////////
if($("form").attr("name")=='frm_discapacidad'){

//----------------------------------------DISCAPACIDAD ADQUIRIDA----------------------------------------------

$("#div_adquirida").hide();

	if($("#cbDiscapacidad_origen").val()=="3"){
			$("#div_adquirida").show();
	}
	else{
			$("#div_adquirida").hide();
	}
	
	$("#cbDiscapacidad_origen").change(function(){
		
				if($("#cbDiscapacidad_origen").val()=='3'){	
					$("#div_adquirida").show();
				}
				else{
				$("#div_adquirida").hide();
				}
	 });

//----------------------------------------Nro. de certificado--------------------------------------------------
$("#td_certificado").hide();

	if($("#cbDiscapacidad_certificado").val()=="1"){
			$("#td_certificado").show();
	}
	else{
			$("#td_certificado").hide();
	}
	
	$("#cbDiscapacidad_certificado").change(function(){
		
				if($("#cbDiscapacidad_certificado").val()=='1'){	
					$("#td_certificado").show();
				}
				else{
				$("#td_certificado").hide();
				}
	 });

//------------------------------------------Tipo de ayuda técnica---------------------------------------------
$("#tr_Tipo_Ayuda_discapacidad").hide(); 
$("#tr_Nivel_autonomia").hide(); 

	if($("#cbDiscapacidad_ayuda").val()=="1"){
			$("#tr_Tipo_Ayuda_discapacidad").show();
			$("#tr_Nivel_autonomia").show(); 
	}
	else{
			$("#tr_Tipo_Ayuda_discapacidad").hide();
			$("#tr_Nivel_autonomia").hide(); 
	}
	
	$("#cbDiscapacidad_ayuda").change(function(){
		
				if($("#cbDiscapacidad_ayuda").val()=='1'){	
					$("#tr_Tipo_Ayuda_discapacidad").show();
					$("#tr_Nivel_autonomia").show(); 
				}
				else{
				$("#tr_Tipo_Ayuda_discapacidad").hide();
				$("#tr_Nivel_autonomia").hide(); 
				}
	 });

//------------------------------------------Si posee Discapacidad---------------------------------------------
/*$(document).ready(function() {	
if($("form").attr("name")=='frm_trabajador'){
/////////////////////////////////////////////////DATOS PERSONALES/////////////////////////////////////////////////////////
$("#tr_Tipo_discapacidad").hide(); 
$("#tr_Grado_discapacidad").hide(); 

	if($("#cbDiscapacidad_afiliado").val()=='1'){
						$("#tr_Tipo_discapacidad").show();
						$("#tr_Grado_discapacidad").show();
	}
	if($("#cbDiscapacidad_afiliado").val()=='0' || $("#cbDiscapacidad_afiliado").val()=='-1'){
						$("#tr_Tipo_discapacidad").hide();
						$("#tr_Grado_discapacidad").hide();
		}
	
	$("#cbDiscapacidad_afiliado").change(function(){
		
				if($("#cbDiscapacidad_afiliado").val()=='1'){	
						$("#tr_Tipo_discapacidad").show();
						$("#tr_Grado_discapacidad").show();
				}
				else{
						$("#tr_Tipo_discapacidad").hide();
						$("#tr_Grado_discapacidad").hide();
				}
	 });
  }
}*/
	
//------------------------------------------FRECUENCIA CON QUE ASISTE AL MEDICO--------------------------------
$("#tr_frecuencia").hide(); 

	if($("#cbControl_medico").val()=="1"){
			$("#tr_frecuencia").show();
	}
	else{
			$("#tr_frecuencia").hide();
	}
	
	$("#cbControl_medico").change(function(){
		
				if($("#cbControl_medico").val()=='1'){	
					$("#tr_frecuencia").show();
				}
				else{
				$("#tr_frecuencia").hide();
				}
	 });


//------------------------------------------MEDICADO MEDICAMENTO--------------------------------
$("#tr_medicamento").hide(); 

	if($("#cbMedicado").val()=="1"){
			$("#tr_medicamento").show();
	}
	else{
			$("#tr_medicamento").hide();
	}
	
	$("#cbMedicado").change(function(){
		
				if($("#cbMedicado").val()=='1'){	
					$("#tr_medicamento").show();
				}
				else{
				$("#tr_medicamento").hide();
				}
	 });
	
//------------------------------------------referido dps-------------------------------
/*$("#tr_referido_dps").hide(); 

	if($("#cbReferido_dps").val()=="1"){
			$("#tr_referido_dps").show();
	}
	else{
			$("#tr_referido_dps").hide();
	}
	
	$("#cbReferido_dps").change(function(){
		
				if($("#cbReferido_dps").val()=='1'){	
					$("#tr_referido_dps").show();
				}
				else{
				$("#tr_referido_dps").hide();
				}
	 });*/



  }
});

////////////////////////////////////////////////FIN DISCAPACIDAD///////////////////////////////////////////////////////////

/*
$(document).ready(function() {
//////////////////////////////////////////////////////PDPIE//////////////////////////////////////////////////////////
if($("form").attr("name")=='frm_ppie'){

//------------------------------------------referido orientacion---------------------------------------------
$("#tr_referido").hide(); 
$("#tr_motivo_referido").hide(); 

	if($("#cbOrientacion").val()=="1"){
			$("#tr_referido").show();
			$("#tr_motivo_referido").show(); 
	}
	else{
			$("#tr_referido").hide(); 
			$("#tr_motivo_referido").hide(); 
	}
	
	$("#cbOrientacion").change(function(){
		
				if($("#cbOrientacion").val()=='1'){	
					$("#tr_referido").show();
			$("#tr_motivo_referido").show(); 
				}
				else{
				$("#tr_referido").hide(); 
				$("#tr_motivo_referido").hide(); 
				}
	 });


//------------------------------------------referido dps--------------------------------

	if($("#cbReferido_dps").val()=="1"){
			$("#tr_referido_dps").show();
	}
	else{
			$("#tr_referido_dps").hide();
	}
	
	$("#cbReferido_dps").change(function(){
		
				if($("#cbReferido_dps").val()=='1'){	
					$("#tr_referido_dps").show();
				}
				else{
				$("#tr_referido_dps").hide();
				}
	 });

  }
});*/

////////////////////////////////////////////////FIN PDPIE///////////////////////////////////////////////////////////

$(document).ready(function() {
////////////////////////////////////////////////////EDUCACION///////////////////////////////////////////////////////////////
if($("form").attr("name")=='frm_educacion'){
	$("#tr_Carrera1").hide();
	$("#tr_Carrera2").hide();
	$("#tr_Carrera3").hide();
	$("#tr_Carrera4").hide();
  $("#tr_graduado").hide();
	$("#tr_titulo").hide();
	$("#tr_regimen").hide();
	$("#tr_periodo").hide();	
	$("#tr_anio").hide(); 
	$("#tr_instituto").hide(); 
	$("#tr_pasantias").hide();
	
//------------------------------------------nivel academico--------------------------------------------------
		$("#cbNivel_academico").change(function(){
		
				if($("#cbNivel_academico").val()==1 || $("#cbNivel_academico").val()==2){	
				  $("#tr_Carrera1").hide();
					$("#tr_Carrera2").hide();
					$("#tr_Carrera3").hide();
					$("#tr_Carrera4").hide();
					$("#tr_graduado").hide();
					$("#tr_titulo").hide();
					$("#tr_regimen").hide();
					$("#tr_periodo").hide();	
					$("#tr_anio").hide(); 
					$("#tr_instituto").hide();	
					$("#tr_pasantias").hide();	
				}
				
				if($("#cbNivel_academico").val()==3){	
				 	$("#tr_Carrera1").hide();
					$("#tr_Carrera2").hide();
					$("#tr_Carrera3").hide();
					$("#tr_Carrera4").hide();
					$("#tr_titulo").hide();
					$("#tr_graduado").show();					
					$("#tr_regimen").show();
					$("#tr_periodo").show();	
					$("#tr_anio").show(); 
					$("#tr_instituto").show();	
					$("#tr_pasantias").hide();									
				}
				
				if($("#cbNivel_academico").val()==4){	
				  $("#tr_Carrera1").show();
					$("#tr_Carrera2").show();
					$("#tr_Carrera3").hide();
					$("#tr_Carrera4").hide();
					$("#tr_graduado").show();
					$("#tr_titulo").show();
					$("#tr_regimen").show();
					$("#tr_periodo").show();	
					$("#tr_anio").show(); 
					$("#tr_instituto").show();
					$("#tr_pasantias").hide();			
				}
				
				if($("#cbNivel_academico").val()==5){	
				  $("#tr_Carrera1").show();
					$("#tr_Carrera2").show();
					$("#tr_Carrera3").hide();
					$("#tr_Carrera4").hide();
					$("#tr_graduado").show();
					$("#tr_titulo").show();
					$("#tr_regimen").show();
					$("#tr_periodo").show();	
					$("#tr_anio").show(); 
					$("#tr_instituto").show();
					$("#tr_pasantias").show();			
				}				
	
				if($("#cbNivel_academico").val()==6 || $("#cbNivel_academico").val()==7 || $("#cbNivel_academico").val()==8){	
				  $("#tr_Carrera1").show();
					$("#tr_Carrera2").show();
					$("#tr_Carrera3").show();
					$("#tr_Carrera4").show();	
					$("#tr_graduado").show();	
					$("#tr_titulo").show();
					$("#tr_regimen").show();
					$("#tr_periodo").show();	
					$("#tr_anio").show(); 
					$("#tr_instituto").show();	
					$("#tr_pasantias").show();	
								
				}
				
				if($("#cbNivel_academico").val()==9 || $("#cbNivel_academico").val()==10){	
				  $("#tr_Carrera1").hide();
					$("#tr_Carrera2").hide();
					$("#tr_Carrera3").hide();
					$("#tr_Carrera4").hide();	
					$("#tr_graduado").hide();	
					$("#tr_titulo").hide();
					$("#tr_regimen").hide();
					$("#tr_periodo").hide();	
					$("#tr_anio").hide(); 
					$("#tr_instituto").show();	
					$("#tr_pasantias").hide();
								
				}
	 });
//--------------------------------------------CUANDO RECARGA LA PAGINA EN EL EDITAR---------------------------------------------			

	$("#tr_Carrera1").hide();
	$("#tr_Carrera2").hide();
	$("#tr_Carrera3").hide();
	$("#tr_Carrera4").hide();
  $("#tr_graduado").hide();
	$("#tr_titulo").hide();
	$("#tr_regimen").hide();
	$("#tr_periodo").hide();	
	$("#tr_anio").hide(); 
	$("#tr_instituto").hide(); 
	$("#tr_pasantias").hide();
	
				if($("#cbNivel_academico").val()==1 || $("#cbNivel_academico").val()==2){	
				  $("#tr_Carrera1").hide();
					$("#tr_Carrera2").hide();
					$("#tr_Carrera3").hide();
					$("#tr_Carrera4").hide();
					$("#tr_graduado").hide();
					$("#tr_titulo").hide();
					$("#tr_regimen").hide();
					$("#tr_periodo").hide();	
					$("#tr_anio").hide(); 
					$("#tr_instituto").hide();	
					$("#tr_pasantias").hide();	
				}
				
				if($("#cbNivel_academico").val()==3){	
				 	$("#tr_Carrera1").hide();
					$("#tr_Carrera2").hide();
					$("#tr_Carrera3").hide();
					$("#tr_Carrera4").hide();
					$("#tr_titulo").hide();
					$("#tr_graduado").show();					
					$("#tr_regimen").show();
					$("#tr_periodo").show();	
					$("#tr_anio").show(); 
					$("#tr_instituto").show();	
					$("#tr_pasantias").hide();									
				}
				
				if($("#cbNivel_academico").val()==4){	
				  $("#tr_Carrera1").show();
					$("#tr_Carrera2").show();
					$("#tr_Carrera3").hide();
					$("#tr_Carrera4").hide();
					$("#tr_graduado").show();
					$("#tr_titulo").show();
					$("#tr_regimen").show();
					$("#tr_periodo").show();	
					$("#tr_anio").show(); 
					$("#tr_instituto").show();
					$("#tr_pasantias").hide();			
				}
				
				if($("#cbNivel_academico").val()==5){	
				  $("#tr_Carrera1").show();
					$("#tr_Carrera2").show();
					$("#tr_Carrera3").hide();
					$("#tr_Carrera4").hide();
					$("#tr_graduado").show();
					$("#tr_titulo").show();
					$("#tr_regimen").show();
					$("#tr_periodo").show();	
					$("#tr_anio").show(); 
					$("#tr_instituto").show();
					$("#tr_pasantias").show();			
				}				
	
				if($("#cbNivel_academico").val()==6 || $("#cbNivel_academico").val()==7 || $("#cbNivel_academico").val()==8){	
				  $("#tr_Carrera1").show();
					$("#tr_Carrera2").show();
					$("#tr_Carrera3").show();
					$("#tr_Carrera4").show();	
					$("#tr_graduado").show();	
					$("#tr_titulo").show();
					$("#tr_regimen").show();
					$("#tr_periodo").show();	
					$("#tr_anio").show(); 
					$("#tr_instituto").show();	
					$("#tr_pasantias").show();	
								
				}
				
				if($("#cbNivel_academico").val()==9 || $("#cbNivel_academico").val()==10){	
				  $("#tr_Carrera1").hide();
					$("#tr_Carrera2").hide();
					$("#tr_Carrera3").hide();
					$("#tr_Carrera4").hide();	
					$("#tr_graduado").hide();	
					$("#tr_titulo").hide();
					$("#tr_regimen").hide();
					$("#tr_periodo").hide();	
					$("#tr_anio").hide(); 
					$("#tr_instituto").show();	
					$("#tr_pasantias").hide();
								
				}
   } 
	  
});




$(document).ready(function() {
if($("form").attr("name")=='frm_capacitacion'){
/////////////////////////////////////////////////CAPACITACION/////////////////////////////////////////////////////////
	$("#tr_capacitacion").hide();
	$("#tr_capacitacion1").hide();
	$("#tr_capacitacion2").hide();
	$("#tr_capacitacion3").hide();
	$("#tr_capacitacion4").hide();
	$("#tr_capacitacion5").hide();
	$("#tr_capacitacion6").hide();
	$("#tr_capacitacion7").hide();
	$("#tr_capacitacion8").hide();
	$("#tr_capacitacion9").hide();
	$("#tr_capacitacion10").hide();
	$("#tr_capacitacion11").hide();
	$("#tr_capacitacion12").hide();
	$("#tr_capacitacion13").hide();

	if($("#cbCapacitacion").val()=='1'){
		$("#tr_capacitacion").show();
	  $("#tr_capacitacion1").show();
		$("#tr_capacitacion2").show();
		$("#tr_capacitacion3").show();
		$("#tr_capacitacion4").show();
		$("#tr_capacitacion5").show();
		$("#tr_capacitacion6").show();
		$("#tr_capacitacion7").show();
		$("#tr_capacitacion8").show();
		$("#tr_capacitacion9").show();
		$("#tr_capacitacion10").show();
		$("#tr_capacitacion11").show();
		$("#tr_capacitacion12").show();
		$("#tr_capacitacion13").show();
	}
	if($("#cbCapacitacion").val()=='0'){
		$("#tr_capacitacion").hide();
		$("#tr_capacitacion1").hide();
		$("#tr_capacitacion2").hide();
		$("#tr_capacitacion3").hide();
		$("#tr_capacitacion4").hide();
		$("#tr_capacitacion5").hide();
		$("#tr_capacitacion6").hide();
		$("#tr_capacitacion7").hide();
		$("#tr_capacitacion8").hide();
		$("#tr_capacitacion9").hide();
		$("#tr_capacitacion10").hide();
		$("#tr_capacitacion11").hide();
		$("#tr_capacitacion12").hide();
		$("#tr_capacitacion13").hide();
		}
	
	$("#cbCapacitacion").change(function(){
		
				if($("#cbCapacitacion").val()=='1'){
					$("#tr_capacitacion").show();	
					$("#tr_capacitacion1").show();
					$("#tr_capacitacion2").show();
					$("#tr_capacitacion3").show();
					$("#tr_capacitacion4").show();
					$("#tr_capacitacion5").show();
					$("#tr_capacitacion6").show();
					$("#tr_capacitacion7").show();
					$("#tr_capacitacion8").show();
					$("#tr_capacitacion9").show();
					$("#tr_capacitacion10").show();	
					$("#tr_capacitacion11").show();
					$("#tr_capacitacion12").show();	
					$("#tr_capacitacion13").show();	
				}
				else{
					$("#tr_capacitacion").hide();
					$("#tr_capacitacion1").hide();
					$("#tr_capacitacion2").hide();
					$("#tr_capacitacion3").hide();
					$("#tr_capacitacion4").hide();
					$("#tr_capacitacion5").hide();
					$("#tr_capacitacion6").hide();
					$("#tr_capacitacion7").hide();
					$("#tr_capacitacion8").hide();
					$("#tr_capacitacion9").hide();
					$("#tr_capacitacion10").hide();
					$("#tr_capacitacion11").hide();
					$("#tr_capacitacion12").hide();
					$("#tr_capacitacion13").hide();
				}
	 });
  }
});
/////////////////////////////////////////////FIN CAPACITACION/////////////////////////////////////////////////////////




$(document).ready(function() {
	
if($("form").attr("name")=='frm_conocimientos'){
/////////////////////////////////////////////////CONOCOMIENTOS/////////////////////////////////////////////////////////
$("#td_habla").hide();
$("#td_lee").hide();
$("#td_escribe").hide();
$("#td_habla1").hide();
$("#td_lee1").hide();
$("#td_escribe1").hide();
$("#td_habla_nivel").hide();
$("#td_lee_nivel").hide();
$("#td_escribe_nivel").hide();

	if($("#cbIdioma").val()!="-1"){
			$("#td_habla").show();
			$("#td_lee").show();
			$("#td_escribe").show();
			$("#td_habla1").show();
			$("#td_lee1").show();
			$("#td_escribe1").show();
	}
	else{
			$("#td_habla").hide();
			$("#td_lee").hide();
			$("#td_escribe").hide();
			$("#td_habla1").hide();
			$("#td_lee1").hide();
			$("#td_escribe1").hide();
		}
	
	
	$("#cbIdioma").change(function(){
		
				if($("#cbIdioma").val()!='-1'){	
					$("#td_habla").show();
					$("#td_lee").show();
					$("#td_escribe").show();
					$("#td_habla1").show();
					$("#td_lee1").show();
					$("#td_escribe1").show();
				}
				else{
				$("#td_habla").hide();
				$("#td_lee").hide();
				$("#td_escribe").hide();
				$("#td_habla1").hide();
				$("#td_lee1").hide();
				$("#td_escribe1").hide();
				}
	 });
//------------------------------------------------niveles habla---------------------	 
	 	if($("#cbHabla").val()==1){
			 $("#td_habla_nivel").show();
		}
		else{
			 $("#td_habla_nivel").hide();
		}
	
		$("#cbHabla").change(function(){
		
			if($("#cbHabla").val()==1){	
				$("#td_habla_nivel").show();
			}
			else{
			$("#td_habla_nivel").hide();
			}
	 });

//------------------------------------------------niveles lee---------------------	 
	 	if($("#cbLee").val()==1){
			 $("#td_lee_nivel").show();
		}
		else{
			 $("#td_lee_nivel").hide();
		}
	
		$("#cbLee").change(function(){
		
			if($("#cbLee").val()==1){	
				$("#td_lee_nivel").show();
			}
			else{
			$("#td_lee_nivel").hide();
			}
	 });

//------------------------------------------------niveles escribe---------------------	 
	 	if($("#cbEscribe").val()==1){
			 $("#td_escribe_nivel").show();
		}
		else{
			 $("#td_escribe_nivel").hide();
		}
	
		$("#cbEscribe").change(function(){
		
			if($("#cbEscribe").val()==1){	
				$("#td_escribe_nivel").show();
			}
			else{
			$("#td_escribe_nivel").hide();
			}
	 });
	 
}

});
/////////////////////////////////////////////FIN CONOCOMIENTOS/////////////////////////////////////////////////////////

$(document).ready(function() {	
if($("form").attr("name")=='frm_experiencia'){
/////////////////////////////////////////////////EXPERIENCIA LABORAL/////////////////////////////////////////////////////////
	
	$("#tr_experiencia").hide();
	$("#tr_experiencia0").hide();
	$("#tr_experiencia1").hide();
	
	$("#tr_experiencia3").hide();
	$("#tr_experiencia31").hide();
	$("#tr_experiencia4").hide();
	$("#tr_experiencia5").hide();
	$("#tr_experiencia6").hide();
	$("#tr_experiencia7").hide();
	$("#tr_experiencia8").hide();
	$("#tr_experiencia9").hide();
	
	$("#tr_experiencia10").hide();
	$("#tr_experiencia11").hide();
	$("#tr_experiencia12").hide();
	$("#tr_experiencia13").hide();
	
	$("#tr_experiencia18").hide();
	
	$("#tr_experiencia20").hide();
	$("#tr_experiencia21").hide();
	$("#tr_experiencia22").hide();
	$("#tr_experiencia23").hide();
	
	$("#tr_experiencia25").hide();

	if($("#cbExperiencia").val()=='1'){
	$("#tr_experiencia").show();
	$("#tr_experiencia0").show();
	$("#tr_experiencia1").show();

	$("#tr_experiencia3").show();
	$("#tr_experiencia31").show();
	$("#tr_experiencia4").show();
	$("#tr_experiencia5").show();
	$("#tr_experiencia6").show();
	$("#tr_experiencia7").show();
	$("#tr_experiencia8").show();
	$("#tr_experiencia9").show();
	
	$("#tr_experiencia10").show();
	$("#tr_experiencia11").show();
	$("#tr_experiencia12").show();
	$("#tr_experiencia13").show();

	$("#tr_experiencia18").show();
	//$("#tr_experiencia19").show();
	$("#tr_experiencia20").show();
	$("#tr_experiencia21").show();
	$("#tr_experiencia22").show();
	$("#tr_experiencia23").show();
	
	$("#tr_experiencia25").show();
	}
	if($("#cbExperiencia").val()=='0' || $("#cbExperiencia").val()=='-1'){
		$("#tr_experiencia").hide();
	  $("#tr_experiencia0").hide();
		$("#tr_experiencia1").hide();
		
		$("#tr_experiencia3").hide();
		$("#tr_experiencia31").hide();
		$("#tr_experiencia4").hide();
		$("#tr_experiencia5").hide();
		$("#tr_experiencia6").hide();
		$("#tr_experiencia7").hide();
		$("#tr_experiencia8").hide();
		$("#tr_experiencia9").hide();
		$("#tr_experiencia10").hide();
		$("#tr_experiencia11").hide();
		$("#tr_experiencia12").hide();
		$("#tr_experiencia13").hide();
	
		$("#tr_experiencia18").hide();
	
		$("#tr_experiencia20").hide();
		$("#tr_experiencia21").hide();
		$("#tr_experiencia22").hide();
		$("#tr_experiencia23").hide();
		
		$("#tr_experiencia25").hide();
		}
	
	$("#cbExperiencia").change(function(){
		
				if($("#cbExperiencia").val()=='1'){	
						$("#tr_experiencia").show();
						$("#tr_experiencia0").show();
						$("#tr_experiencia1").show();
						
						$("#tr_experiencia3").show();
						$("#tr_experiencia31").show();
						$("#tr_experiencia4").show();
						$("#tr_experiencia5").show();
						$("#tr_experiencia6").show();
						$("#tr_experiencia7").show();
						$("#tr_experiencia8").show();
						$("#tr_experiencia9").show();
						$("#tr_experiencia10").show();
						$("#tr_experiencia11").show();
						$("#tr_experiencia12").show();
						$("#tr_experiencia13").show();
					
						
						$("#tr_experiencia18").show();
					
						$("#tr_experiencia20").show();
						$("#tr_experiencia21").show();
						$("#tr_experiencia22").show();
						$("#tr_experiencia23").show();
					
						$("#tr_experiencia25").show();
				}
				else{
						$("#tr_experiencia").hide();
						$("#tr_experiencia0").hide();
						$("#tr_experiencia1").hide();
						
						$("#tr_experiencia3").hide();
						$("#tr_experiencia31").hide();
						$("#tr_experiencia4").hide();
						$("#tr_experiencia5").hide();
						$("#tr_experiencia6").hide();
						$("#tr_experiencia7").hide();
						$("#tr_experiencia8").hide();
						$("#tr_experiencia9").hide();
						$("#tr_experiencia10").hide();
						$("#tr_experiencia11").hide();
						$("#tr_experiencia12").hide();
						$("#tr_experiencia13").hide();
						
						$("#tr_experiencia18").hide();
						
						$("#tr_experiencia20").hide();
						$("#tr_experiencia21").hide();
						$("#tr_experiencia22").hide();
						$("#tr_experiencia23").hide();
						
						$("#tr_experiencia25").hide();
				}
	 });
	 
	 
	/*EXPERIENCIA LABORAL EN EL EXTRANJERO*/ 
	 
	$("#tr_experiencia00").hide();
	$("#tr_experiencia01").hide();
	$("#tr_experiencia02").hide();
	$("#tr_experiencia03").hide();
	$("#tr_experiencia04").hide();
	

	if($("#cbpais_ext").val()=='1'){
		$("#tr_experiencia00").show();
		$("#tr_experiencia01").show();
		$("#tr_experiencia02").show();
		$("#tr_experiencia03").show();
		$("#tr_experiencia04").show();
	
	}
	if($("#cbpais_ext").val()=='0' || $("#cbpais_ext").val()=='-1'){
		$("#tr_experiencia00").hide();
		$("#tr_experiencia01").hide();
		$("#tr_experiencia02").hide();
		$("#tr_experiencia03").hide();
		$("#tr_experiencia04").hide();
		}
	
	$("#cbpais_ext").change(function(){
		
				if($("#cbpais_ext").val()=='1'){	
								$("#tr_experiencia00").show();
								$("#tr_experiencia01").show();
								$("#tr_experiencia02").show();
								$("#tr_experiencia03").show();
								$("#tr_experiencia04").show();

				}
				else{
						$("#tr_experiencia00").hide();
						$("#tr_experiencia01").hide();
						$("#tr_experiencia02").hide();
						$("#tr_experiencia03").hide();
						$("#tr_experiencia04").hide();
				}
	 });
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
  }
});
/////////////////////////////////////////////EXPERIENCIA LABORAL/////////////////////////////////////////////////////////


$(document).ready(function() {	
if($("form").attr("name")=='frm_participacion'){
/////////////////////////////////////////////////PARTICIPACION OMUNITARIA///////////////////////////////////////////
						$("#tr_participacion1").hide();
						$("#tr_participacion2").hide();
						$("#tr_participacion3").hide();
						$("#tr_participacion4").hide();
						$("#tr_participacion5").hide();
						$("#tr_participacion6").hide();
						$("#tr_participacion7").hide();
						$("#tr_participacion8").hide();
						$("#tr_participacion9").hide();
						$("#tr_participacion10").hide();
						$("#tr_participacion11").hide();
						$("#tr_participacion12").hide();
						$("#tr_participacion13").hide();

	if($("#cbParticipacion").val()=='1'){
						$("#tr_participacion1").show();
						$("#tr_participacion2").show();
						$("#tr_participacion3").show();
						$("#tr_participacion4").show();
						$("#tr_participacion5").show();
						$("#tr_participacion6").show();
						$("#tr_participacion7").show();
						$("#tr_participacion8").show();
						$("#tr_participacion9").show();
						$("#tr_participacion10").show();
						$("#tr_participacion11").show();
						$("#tr_participacion12").show();
						$("#tr_participacion13").show();
	}
	if($("#cbParticipacion").val()=='0' || $("#cbParticipacion").val()=='-1'){
						$("#tr_participacion1").hide();
						$("#tr_participacion2").hide();
						$("#tr_participacion3").hide();
						$("#tr_participacion4").hide();
						$("#tr_participacion5").hide();
						$("#tr_participacion6").hide();
						$("#tr_participacion7").hide();
						$("#tr_participacion8").hide();
						$("#tr_participacion9").hide();
						$("#tr_participacion10").hide();
						$("#tr_participacion11").hide();
						$("#tr_participacion12").hide();
						$("#tr_participacion13").hide();
		}
	
	$("#cbParticipacion").change(function(){
		
				if($("#cbParticipacion").val()=='1'){	
						$("#tr_participacion1").show();
						$("#tr_participacion2").show();
						$("#tr_participacion3").show();
						$("#tr_participacion4").show();
						$("#tr_participacion5").show();
						$("#tr_participacion6").show();
						$("#tr_participacion7").show();
						$("#tr_participacion8").show();
						$("#tr_participacion9").show();
						$("#tr_participacion10").show();
						$("#tr_participacion11").show();
						$("#tr_participacion12").show();
						$("#tr_participacion13").show();
				}
				else{
						$("#tr_participacion1").hide();
						$("#tr_participacion2").hide();
						$("#tr_participacion3").hide();
						$("#tr_participacion4").hide();
						$("#tr_participacion5").hide();
						$("#tr_participacion6").hide();
						$("#tr_participacion7").hide();
						$("#tr_participacion8").hide();
						$("#tr_participacion9").hide();
						$("#tr_participacion10").hide();
						$("#tr_participacion11").hide();
						$("#tr_participacion12").hide();
						$("#tr_participacion13").hide();
				}
	 });
  }
});
///////////////////////////////////////FIN PARTICIPACION COMUNITARIA/////////////////////////////////////////////////

$(document).ready(function() {	
if($("form").attr("name")=='frm_trabajador'){
/////////////////////////////////////////////////DATOS PERSONALES/////////////////////////////////////////////////////////
						$("#cantidad_hijos").hide();
						$("#cantidad_hijos1").hide();

	if($("#cbHijos").val()=='1'){
						$("#cantidad_hijos").show();
						$("#cantidad_hijos1").show();
	}
	if($("#cbHijos").val()=='0' || $("#cbHijos").val()=='-1'){
						$("#cantidad_hijos").hide();
						$("#cantidad_hijos1").hide();
		}
	
	$("#cbHijos").change(function(){
		
				if($("#cbHijos").val()=='1'){	
						$("#cantidad_hijos").show();
						$("#cantidad_hijos1").show();
				}
				else{
						$("#cantidad_hijos").hide();
						$("#cantidad_hijos1").hide();
				}
	 });
	//::::::::::::::::::::::::::::::::::::::::si posee discapasidad :::::::::::::::::::::::::

	$("#tr_Tipo_discapacidad").hide(); 
	$("#tr_Grado_discapacidad").hide();

	if($("#cbDiscapacidad_afiliado").val()=='1'){
						$("#tr_Tipo_discapacidad").show();
						$("#tr_Grado_discapacidad").show();
	}
	if($("#cbDiscapacidad_afiliado").val()=='0' || $("#cbDiscapacidad_afiliado").val()=='-1'){
						$("#tr_Tipo_discapacidad").hide();
						$("#tr_Grado_discapacidad").hide();
		}
	
	$("#cbDiscapacidad_afiliado").change(function(){
		
				if($("#cbDiscapacidad_afiliado").val()=='1'){	
						$("#tr_Tipo_discapacidad").show();
						$("#tr_Grado_discapacidad").show();
				}
				else{
						$("#tr_Tipo_discapacidad").hide();
						$("#tr_Grado_discapacidad").hide();
				}
	 });
  }

	
	
	
	////////
/////////////////////////////////////////////////DATOS MISIONES/////////////////////////////////////////////////////////
	$("#tr_mision_edu").hide();
	if($("#cbmision_beneficio_educacion").val()=='1'){
		 $("#tr_mision_edu").show();
	}
	if($("#cbmision_beneficio_educacion").val()=='0' || $("#cbmision_beneficio_educacion").val()=='-1'){
		 $("#tr_mision_edu").hide();
		}
	
	$("#cbmision_beneficio_educacion").change(function(){
		
				if($("#cbmision_beneficio_educacion").val()=='1'){	
						$("#tr_mision_edu").show();
				}
				else{
						$("#tr_mision_edu").hide();
				}
	 }); 
	 

	$("#tr_mision_soc").hide();
	if($("#cbmision_beneficio_social").val()=='1'){
		 $("#tr_mision_soc").show();
	}
	if($("#cbmision_beneficio_social").val()=='0' || $("#cbmision_beneficio_social").val()=='-1'){
		 $("#tr_mision_soc").hide();
		}
	
	$("#cbmision_beneficio_social").change(function(){
		
				if($("#cbmision_beneficio_social").val()=='1'){	
						$("#tr_mision_soc").show();
				}
				else{
						$("#tr_mision_soc").hide();
				}
	 }); 
////////////////////////////////////////////////FIN MISIONES///////////////////////////////////////////////////////////////	


});
/////////////////////////////////////////FIN DATOS PERSONALES/////////////////////////////////////////////////////////


$(document).ready(function() {	
if($("form").attr("name")=='frm_ocupacion'){
/////////////////////////////////////////////SITUACION OCUPACIONAL//////////////////////////////////////////////////////
						$("#tr_cuenta_propia1").hide();
						$("#tr_cuenta_propia2").hide();

	if($("#cbTipo_situacion_afiliado").val()=='14'){
						$("#tr_cuenta_propia1").show();
						$("#tr_cuenta_propia2").show();
	}
	if($("#cbTipo_situacion_afiliado").val()!='14'){
						$("#tr_cuenta_propia1").hide();
						$("#tr_cuenta_propia2").hide();
		}
	
	$("#cbTipo_situacion_afiliado").change(function(){
		
				if($("#cbTipo_situacion_afiliado").val()=='14'){	
						$("#tr_cuenta_propia1").show();
						$("#tr_cuenta_propia2").show();
				}
				else{
						$("#tr_cuenta_propia1").hide();
						$("#tr_cuenta_propia2").hide();
				}
	 });
  }
});
//////////////////////////////////////////FIN SITUACION OCUPACIONAL/////////////////////////////////////////////////////////

$(document).ready(function() {
//////////////////////////////////////////////////////PREVISION//////////////////////////////////////////////////////////
if($("form").attr("name")=='frm_prevision'){

//------------------------------------------cotiza---------------------------------------------
$("#tr_si_cotiza").hide(); 

	if($("#cbCotiza").val()=="1"){
			$("#tr_si_cotiza").show(); 
	}
	else{
			$("#tr_si_cotiza").hide(); 
	}
	
	$("#cbCotiza").change(function(){
		
				if($("#cbCotiza").val()=='1'){	
					$("#tr_si_cotiza").show();
				}
				else{
				$("#tr_si_cotiza").hide();  
				}
	 });

//-----------------------------------------no cotiza---------------------------------------------
$("#tr_no_cotiza").hide(); 

	if($("#cbCotiza").val()=="2"){
			$("#tr_no_cotiza").show(); 
	}
	else{
			$("#tr_no_cotiza").hide(); 
	}
	
	$("#cbCotiza").change(function(){
		
				if($("#cbCotiza").val()=='2'){	
					$("#tr_no_cotiza").show();
				}
				else{
				$("#tr_no_cotiza").hide();  
				}
	 });

//-----------------------------------------no cotiza---------------------------------------------
$("#tr_no_cotiza_anterior").hide(); 

	if($("#cbCotiza_anterior").val()=="2"){
			$("#tr_no_cotiza_anterior").show(); 
	}
	else{
			$("#tr_no_cotiza_anterior").hide(); 
	}
	
	$("#cbCotiza_anterior").change(function(){
		
				if($("#cbCotiza_anterior").val()=='2'){	
					$("#tr_no_cotiza_anterior").show();
				}
				else{
				$("#tr_no_cotiza_anterior").hide();  
				}
	 });   
	 
//-----------------------------------------no cotiza---------------------------------------------
$("#tr_tipo_pension").hide(); 

	if($("#cbPensionado").val()=="1"){
			$("#tr_tipo_pension").show(); 
	}
	else{
			$("#tr_tipo_pension").hide(); 
	}
	
	$("#cbPensionado").change(function(){
		
				if($("#cbPensionado").val()=='1'){	
					$("#tr_tipo_pension").show();
				}
				else{
				$("#tr_tipo_pension").hide();  
				}
	 });

//-----------------------------------------no seguir cotizando---------------------------------------------
$("#tr_no_seguir_cotiza").hide(); 
	if($("#cbSeguir_cotizando").val()=="2"){
			$("#tr_no_seguir_cotiza").show(); 
	}
	else{
			$("#tr_no_seguir_cotiza").hide(); 
	}
	
	$("#cbSeguir_cotizando").change(function(){
		
				if($("#cbSeguir_cotizando").val()=='2'){	
					 $("#tr_no_seguir_cotiza").show();
				}
				else{
				$("#tr_no_seguir_cotiza").hide();  
				}
	 });

  }
});

////////////////////////////////////////////////FIN PREVISION//////////////////////////////////////////////////////////

//////oportunidades de empleo

//------------------------------------------sucursales---------------------------------------------
if($("#cbCapacitacion").val()=='1'){
		$("#tr_capacitacion").show();
	  $("#tr_capacitacion1").show();
		$("#tr_capacitacion2").show();
		$("#tr_capacitacion3").show();
		$("#tr_capacitacion4").show();
		$("#tr_capacitacion5").show();
		$("#tr_capacitacion6").show();
		$("#tr_capacitacion7").show();
		$("#tr_capacitacion8").show();
		$("#tr_capacitacion9").show();
		$("#tr_capacitacion10").show();
		$("#tr_capacitacion11").show();
		$("#tr_capacitacion12").show();
		$("#tr_capacitacion13").show();
	}
	if($("#cbCapacitacion").val()=='0'){
		$("#tr_capacitacion").hide();
		$("#tr_capacitacion1").hide();
		$("#tr_capacitacion2").hide();
		$("#tr_capacitacion3").hide();
		$("#tr_capacitacion4").hide();
		$("#tr_capacitacion5").hide();
		$("#tr_capacitacion6").hide();
		$("#tr_capacitacion7").hide();
		$("#tr_capacitacion8").hide();
		$("#tr_capacitacion9").hide();
		$("#tr_capacitacion10").hide();
		$("#tr_capacitacion11").hide();
		$("#tr_capacitacion12").hide();
		$("#tr_capacitacion13").hide();
		}
	
	$("#cbCapacitacion").change(function(){
		
				if($("#cbCapacitacion").val()=='1'){
					$("#tr_capacitacion").show();	
					$("#tr_capacitacion1").show();
					$("#tr_capacitacion2").show();
					$("#tr_capacitacion3").show();
					$("#tr_capacitacion4").show();
					$("#tr_capacitacion5").show();
					$("#tr_capacitacion6").show();
					$("#tr_capacitacion7").show();
					$("#tr_capacitacion8").show();
					$("#tr_capacitacion9").show();
					$("#tr_capacitacion10").show();	
					$("#tr_capacitacion11").show();
					$("#tr_capacitacion12").show();	
					$("#tr_capacitacion13").show();	
				}
				else{
					$("#tr_capacitacion").hide();
					$("#tr_capacitacion1").hide();
					$("#tr_capacitacion2").hide();
					$("#tr_capacitacion3").hide();
					$("#tr_capacitacion4").hide();
					$("#tr_capacitacion5").hide();
					$("#tr_capacitacion6").hide();
					$("#tr_capacitacion7").hide();
					$("#tr_capacitacion8").hide();
					$("#tr_capacitacion9").hide();
					$("#tr_capacitacion10").hide();
					$("#tr_capacitacion11").hide();
					$("#tr_capacitacion12").hide();
					$("#tr_capacitacion13").hide();
				}
	 });
 
;/*
$(document).ready(function() {
//if($("form").attr("name")=='form'){	


if($("#cbsucursales").val()=='1'){
		$("#tr_sucursales").show();
}
	else{
$("#tr_sucursales").hide(); 
	}

	
	$("#cbsucursales").change(function(){
		
				if($("#cbsucursales").val()=='1'){	
					$("#tr_sucursales").show();
				
				}
				else{
				$("#tr_sucursales").hide();
				
				}
	 });
//}//
});*/

//-
$(document).ready(function() {
if($("form").attr("name")=='frm_trabajador'){
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
				}
				else{
				$("#tr_redes_sociales").hide();
					$("#tr_redes_sociales1").hide();
					$("#tblDetalle").hide();
				}
	 });
		 
} 
});