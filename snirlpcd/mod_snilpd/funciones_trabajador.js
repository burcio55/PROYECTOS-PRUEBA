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

//------------------------------------------Tipo de ayuda t�cnica---------------------------------------------
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
	$("#tr_experiencia2").hide();
	$("#tr_experiencia3").hide();
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
	$("#tr_experiencia14").hide();
	$("#tr_experiencia15").hide();
	$("#tr_experiencia16").hide();
	$("#tr_experiencia17").hide();
	$("#tr_experiencia18").hide();
	$("#tr_experiencia19").hide();
	$("#tr_experiencia20").hide();
	$("#tr_experiencia21").hide();
	$("#tr_experiencia22").hide();
	$("#tr_experiencia23").hide();
	$("#tr_experiencia24").hide();
	$("#tr_experiencia25").hide();

	if($("#cbExperiencia").val()=='1'){
	$("#tr_experiencia").show();
	$("#tr_experiencia0").show();
	$("#tr_experiencia1").show();
	$("#tr_experiencia2").show();
	$("#tr_experiencia3").show();
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
	$("#tr_experiencia14").show();
	$("#tr_experiencia15").show();
	$("#tr_experiencia16").show();
	$("#tr_experiencia17").show();
	$("#tr_experiencia18").show();
	$("#tr_experiencia19").show();
	$("#tr_experiencia20").show();
	$("#tr_experiencia21").show();
	$("#tr_experiencia22").show();
	$("#tr_experiencia23").show();
	$("#tr_experiencia24").show();
	$("#tr_experiencia25").show();
	}
	if($("#cbExperiencia").val()=='0' || $("#cbExperiencia").val()=='-1'){
		$("#tr_experiencia").hide();
	  $("#tr_experiencia0").hide();
		$("#tr_experiencia1").hide();
		$("#tr_experiencia2").hide();
		$("#tr_experiencia3").hide();
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
		$("#tr_experiencia14").hide();
		$("#tr_experiencia15").hide();
		$("#tr_experiencia16").hide();
		$("#tr_experiencia17").hide();
		$("#tr_experiencia18").hide();
		$("#tr_experiencia19").hide();
		$("#tr_experiencia20").hide();
		$("#tr_experiencia21").hide();
		$("#tr_experiencia22").hide();
		$("#tr_experiencia23").hide();
		$("#tr_experiencia24").hide();
		$("#tr_experiencia25").hide();
		}
	
	$("#cbExperiencia").change(function(){
		
				if($("#cbExperiencia").val()=='1'){	
						$("#tr_experiencia").show();
						$("#tr_experiencia0").show();
						$("#tr_experiencia1").show();
						$("#tr_experiencia2").show();
						$("#tr_experiencia3").show();
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
						$("#tr_experiencia14").show();
						$("#tr_experiencia15").show();
						$("#tr_experiencia16").show();
						$("#tr_experiencia17").show();
						$("#tr_experiencia18").show();
						$("#tr_experiencia19").show();
						$("#tr_experiencia20").show();
						$("#tr_experiencia21").show();
						$("#tr_experiencia22").show();
						$("#tr_experiencia23").show();
						$("#tr_experiencia24").show();
						$("#tr_experiencia25").show();
				}
				else{
						$("#tr_experiencia").hide();
						$("#tr_experiencia0").hide();
						$("#tr_experiencia1").hide();
						$("#tr_experiencia2").hide();
						$("#tr_experiencia3").hide();
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
						$("#tr_experiencia14").hide();
						$("#tr_experiencia15").hide();
						$("#tr_experiencia16").hide();
						$("#tr_experiencia17").hide();
						$("#tr_experiencia18").hide();
						$("#tr_experiencia19").hide();
						$("#tr_experiencia20").hide();
						$("#tr_experiencia21").hide();
						$("#tr_experiencia22").hide();
						$("#tr_experiencia23").hide();
						$("#tr_experiencia24").hide();
						$("#tr_experiencia25").hide();
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
    document.getElementById('cbEstado_nac_afiliado').disabled = true;
	if($("#cbPais_nac_afiliado").val()=='239'){
		   document.getElementById('cbEstado_nac_afiliado').disabled = false;
	}
	$("#cbPais_nac_afiliado").change(function(){
	
		if($("#cbPais_nac_afiliado").val()=='239'){	
		document.getElementById('cbEstado_nac_afiliado').disabled = false;
	
		}
		else{
			document.getElementById('cbEstado_nac_afiliado').disabled = true;
				
		}
	});

        document.getElementById('hijos_menores').disabled = true;
		document.getElementById('hijos_mayores').disabled = true;
/*
						$("#cantidad_hijos1").hide();
						$("#cantidad_hijos11").hide();
						$("#cantidad_hijos12").hide();*/
						

	if($("#cbHijos").val()=='1'){
		document.getElementById('hijos_menores').disabled = false;
		document.getElementById('hijos_mayores').disabled = false;
		
				/*		$("#cantidad_hijos").show();
						$("#cantidad_hijos1").show();
						$("#cantidad_hijos11").show();
						$("#cantidad_hijos12").show();*/
	}
	if($("#cbHijos").val()=='0' || $("#cbHijos").val()=='-1'){
		document.getElementById('hijos_menores').disabled = true;
		document.getElementById('hijos_mayores').disabled = true;
						/*$("#cantidad_hijos").hide();
						$("#cantidad_hijos1").hide();
						$("#cantidad_hijos11").hide();
						$("#cantidad_hijos12").hide();*/
						
		}
	
	$("#cbHijos").change(function(){
		
				if($("#cbHijos").val()=='1'){	
				document.getElementById('hijos_menores').disabled = false;
		document.getElementById('hijos_mayores').disabled = false;
						
						/*$("#cantidad_hijos").show();
						$("#cantidad_hijos1").show();
						$("#cantidad_hijos11").show();
						$("#cantidad_hijos12").show();*/
				}
				else{
					document.getElementById('hijos_menores').disabled = true;
						document.getElementById('hijos_mayores').disabled = true;
						/*$("#cantidad_hijos").hide();
						$("#cantidad_hijos1").hide();
						$("#cantidad_hijos11").hide();
						$("#cantidad_hijos12").hide();*/
				}
	 });
	   document.getElementById('cbTipo_discapacidad').disabled = true;
		

						

	if($("#cbDiscapacidad_afiliado").val()=='1'){
		document.getElementById('cbTipo_discapacidad').disabled = false;	
	}
	
	
	$("#cbDiscapacidad_afiliado").change(function(){
		
				if($("#cbDiscapacidad_afiliado").val()=='1'){	
				document.getElementById('cbTipo_discapacidad').disabled = false;
		
				}
				else{
					document.getElementById('cbTipo_discapacidad').disabled = true;
			
				}
	 });
	////////PAIS DE RESIDENCIA/////////////////// 
	// $("#direccion_habitacion").hide();
	 $("#direccion_habitacion1").hide();
	 $("#direccion_habitacion2").hide();
	 $("#direccion_habitacion3").hide();
	 $("#direccion_habitacion4").hide();
	 $("#direccion_habitacion5").hide();
	 $("#direccion_habitacion6").hide();
	 $("#direccion_habitacion7").hide();
	 $("#direccion_habitacion8").hide();
	 $("#direccion_habitacion9").hide();
	 $("#direccion_habitacion10").hide();
	// $("#direccion_habitacion11").hide();

	if($("#cbPais_afiliado").val()=='239'){
		//$("#direccion_habitacion").show();
		$("#direccion_habitacion1").show();
		 $("#direccion_habitacion2").show();
		 $("#direccion_habitacion3").show();
		 $("#direccion_habitacion4").show();
		 $("#direccion_habitacion5").show();
		 $("#direccion_habitacion6").show();
		 $("#direccion_habitacion7").show();
		 $("#direccion_habitacion8").show();
		 $("#direccion_habitacion9").show();
		 $("#direccion_habitacion10").show();
		// $("#direccion_habitacion11").show();
	}else{
		//$("#direccion_habitacion").hide();
		$("#direccion_habitacion1").hide();
		 $("#direccion_habitacion2").hide();
		 $("#direccion_habitacion3").hide();
		 $("#direccion_habitacion4").hide();
		 $("#direccion_habitacion5").hide();
		 $("#direccion_habitacion6").hide();
		 $("#direccion_habitacion7").hide();
		 $("#direccion_habitacion8").hide();
		 $("#direccion_habitacion9").hide();
		 $("#direccion_habitacion10").hide();
	//	 $("#direccion_habitacion11").hide();
	}
	 	$("#cbPais_afiliado").change(function(){
		
				if($("#cbPais_afiliado").val()=='239'){	
					//$("#direccion_habitacion").show();
					$("#direccion_habitacion1").show();
					$("#direccion_habitacion2").show();
					$("#direccion_habitacion3").show();
					$("#direccion_habitacion4").show();
					$("#direccion_habitacion5").show();
					$("#direccion_habitacion6").show();
					$("#direccion_habitacion7").show();
					$("#direccion_habitacion8").show();
					$("#direccion_habitacion9").show();
					$("#direccion_habitacion10").show();
		//			$("#direccion_habitacion11").show();
						
				}
				else{
					//$("#direccion_habitacion").hide();
					$("#direccion_habitacion1").hide();
					 $("#direccion_habitacion2").hide();
					 $("#direccion_habitacion3").hide();
					 $("#direccion_habitacion4").hide();
					 $("#direccion_habitacion5").hide();
					 $("#direccion_habitacion6").hide();
					 $("#direccion_habitacion7").hide();
					 $("#direccion_habitacion8").hide();
					 $("#direccion_habitacion9").hide();
					 $("#direccion_habitacion10").hide();
		//			 $("#direccion_habitacion11").hide();
						
				}
	 });
  }
////////FIN PAIS DE RESIDENCIA/////////////////// 	
	
/////////////////////////////////////////////////DATOS MISIONES/////////////////////////////////////////////////////////
	$("#tr_mision_edu").hide();
	if($("#cbmision_beneficio_educacion").val()=='1'){
		 $("#tr_mision_edu").show();
		  $("#tr_mision_edu1").show();
		 
	}
	if($("#cbmision_beneficio_educacion").val()=='0' || $("#cbmision_beneficio_educacion").val()=='-1'){
		 $("#tr_mision_edu").hide();
		  $("#tr_mision_edu1").hide();
		}
	
	$("#cbmision_beneficio_educacion").change(function(){
		
				if($("#cbmision_beneficio_educacion").val()=='1'){	
						$("#tr_mision_edu").show();
						 $("#tr_mision_edu1").show();
				}
				else{
						$("#tr_mision_edu").hide();
						  $("#tr_mision_edu1").hide();
				}
	 }); 
	 

	$("#tr_mision_soc").hide();
	$("#tr_mision_soc1").hide();
	if($("#cbmision_beneficio_social").val()=='1'){
		 $("#tr_mision_soc").show();
		 $("#tr_mision_soc1").show();
	}
	if($("#cbmision_beneficio_social").val()=='0' || $("#cbmision_beneficio_social").val()=='-1'){
		 $("#tr_mision_soc").hide();
		  $("#tr_mision_soc1").hide();
		}
	
	$("#cbmision_beneficio_social").change(function(){
		
				if($("#cbmision_beneficio_social").val()=='1'){	
						$("#tr_mision_soc").show();
						$("#tr_mision_soc1").show();
				}
				else{
						$("#tr_mision_soc").hide();
						$("#tr_mision_soc1").hide();
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