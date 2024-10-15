//----------------------------------------- validar_frm_trabajador----------------------------------------------------------------

function validar_frm_trabajador(){
var valor=1 ;  

if(document.getElementById("cbCed_afiliado").value=='-1'){
document.getElementById("cbCed_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbCed_afiliado").style.borderColor= '';
}  

if(document.getElementById("ced_afiliado").value==''){
document.getElementById("ced_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("ced_afiliado").style.borderColor= '';
}  


//VALIDAR CUANDO ESTE VACIO
if(document.getElementById("nombre_afiliado").value==''){
document.getElementById("nombre_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("nombre_afiliado").style.borderColor= '';
}

if(document.getElementById("apellido_afiliado").value==''){
document.getElementById("apellido_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("apellido_afiliado").style.borderColor= '';
}

if(document.getElementById("cbSexo_afiliado").value=='-1'){
document.getElementById("cbSexo_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbSexo_afiliado").style.borderColor= '';
}


if(document.getElementById("fnacimiento_afiliado").value==''){
document.getElementById("fnacimiento_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("fnacimiento_afiliado").style.borderColor= '';
}

if(document.getElementById("telefono_afiliado").value==''){
document.getElementById("telefono_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("telefono_afiliado").style.borderColor= '';
}

if(document.getElementById("email_afiliado").value==''){
document.getElementById("email_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("email_afiliado").style.borderColor= '';
}

if(document.getElementById("email_afiliado2").value==''){
document.getElementById("email_afiliado2").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("email_afiliado2").style.borderColor= '';
}



	if(valor==0){
		alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
		return false;
	}else{
		return true;
	}	
}

//----------------------------------------- validar_frm_migracion----------------------------------------------------------------

function validar_frm_migracion(){
var valor=1 ;  

//VALIDAR CUANDO ESTE VACIO

if(document.getElementById("cbPais_migrante").value=='-1' || document.getElementById("cbPais_migrante").value==''){
document.getElementById("cbPais_migrante").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbPais_migrante").style.borderColor= '';
}
 
if(document.getElementById("cbPais_migrante").value=='239'){
if(document.getElementById("cbEstado_migrante").value=='-1' || document.getElementById("cbEstado_migrante").value==''){
document.getElementById("cbEstado_migrante").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbEstado_migrante").style.borderColor= '';
}
}
else{
document.getElementById("cbEstado_migrante").style.borderColor= '';
}

if(document.getElementById("cbTipo_migrante").value=='-1' || document.getElementById("cbTipo_migrante").value==''){
document.getElementById("cbTipo_migrante").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbTipo_migrante").style.borderColor= '';
}

if(document.getElementById("cbCausa_migrante").value=='-1' || document.getElementById("cbCausa_migrante").value==''){
document.getElementById("cbCausa_migrante").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbCausa_migrante").style.borderColor= '';
}

if(document.getElementById("cbCausa_migrante1").value=='-1' || document.getElementById("cbCausa_migrante1").value==''){
document.getElementById("cbCausa_migrante1").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbCausa_migrante1").style.borderColor= '';
}  

if(document.getElementById("fmigrante").value==''){
document.getElementById("fmigrante").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("fmigrante").style.borderColor= '';
}


	if(valor==0){
		alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
		return false;
	}else{
		return true;
	}	
}

//----------------------------------------- validar_frm_discapacidad----------------------------------------------------------------

function validar_frm_discapacidad(){
var valor=1 ;  

//VALIDAR CUANDO ESTE VACIO

if(document.getElementById("cbTipo_discapacidad").value=='-1' || document.getElementById("cbTipo_discapacidad").value==''){
document.getElementById("cbTipo_discapacidad").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbTipo_discapacidad").style.borderColor= '';
}
 
if(document.getElementById("cbDiscapacidad_nivel").value=='-1' || document.getElementById("cbDiscapacidad_nivel").value==''){
document.getElementById("cbDiscapacidad_nivel").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbDiscapacidad_nivel").style.borderColor= '';
}

if(document.getElementById("cbDiscapacidad_origen").value=='-1' || document.getElementById("cbDiscapacidad_origen").value==''){
document.getElementById("cbDiscapacidad_origen").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbDiscapacidad_origen").style.borderColor= '';
} 

if(document.getElementById("chk_Discapacidad_ayuda").checked){
if(document.getElementById("cbTipo_Ayuda_discapacidad").value=='-1' || document.getElementById("cbTipo_Ayuda_discapacidad").value==''){
document.getElementById("cbTipo_Ayuda_discapacidad").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbTipo_Ayuda_discapacidad").style.borderColor= '';
}
}
else{
document.getElementById("cbTipo_Ayuda_discapacidad").style.borderColor= '';
}
  
if(document.getElementById("cbDiscapacidad_nivel_depen").value=='-1' || document.getElementById("cbDiscapacidad_nivel_depen").value==''){
document.getElementById("cbDiscapacidad_nivel_depen").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbDiscapacidad_nivel_depen").style.borderColor= '';
}

	
if($("#chk_Discapacidad_calificacion").is(':checked')){
		if( document.getElementById("Nro_historia_calificacion").value==''){
				document.getElementById("Nro_historia_calificacion").style.borderColor= 'Red'; 
				valor=0;
				}
			else{
				document.getElementById("Nro_historia_calificacion").style.borderColor= '';
			}
}
else{
	    document.getElementById("Nro_historia_calificacion").style.borderColor= '';	
	}
	
if($("#chk_Discapacidad_certificado").is(':checked')){
		if( document.getElementById("Nro_historia_certificado").value==''){
				document.getElementById("Nro_historia_certificado").style.borderColor= 'Red'; 
				valor=0;
				}
			else{
				document.getElementById("Nro_historia_certificado").style.borderColor= '';
			}
}
else{
	    document.getElementById("Nro_historia_certificado").style.borderColor= '';	
	}
	
if($("#chk_Discapacidad_ayuda").is(':checked')){
		if( document.getElementById("cbDiscapacidad_nivel_depen").value=='-1'){
				document.getElementById("cbDiscapacidad_nivel_depen").style.borderColor= 'Red'; 
				valor=0;
				}
			else{
				document.getElementById("cbDiscapacidad_nivel_depen").style.borderColor= '';
			}
}
else{
	    document.getElementById("cbDiscapacidad_nivel_depen").style.borderColor= '';	
	}

if(document.getElementById("cbTipo_Ayuda_discapacidad").value=='8'){
		if( document.getElementById("detalle_ayuda").value==''){
			
			   
				document.getElementById("detalle_ayuda").style.borderColor= 'Red'; 
				valor=0;
				}
			else{
				document.getElementById("detalle_ayuda").style.borderColor= '';
			}
}
else{
	    document.getElementById("detalle_ayuda").style.borderColor= '';	
	}
//----------------------------------------------------------------------
	if(valor==0){
		alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
		return false;
	}else{
		return true;
	}	
}

//----------------------------------------- validar_frm_ocupacion----------------------------------------------------------------

function validar_frm_ocupacion(){
var valor=1 ;  

//VALIDAR CUANDO ESTE VACIO
if(document.getElementById("cbSituacion_afiliado").value=='-1'){
document.getElementById("cbSituacion_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbSituacion_afiliado").style.borderColor= '';
}

if(document.getElementById("cbTipo_situacion_afiliado").value=='-1' || document.getElementById("cbTipo_situacion_afiliado").value==''){
document.getElementById("cbTipo_situacion_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbTipo_situacion_afiliado").style.borderColor= '';
}

if(document.getElementById("cbSituacion_afiliado").value=='1'){
if(document.getElementById("f_situacion").value==''){
document.getElementById("f_situacion").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("f_situacion").style.borderColor= '';
}
}
else{
document.getElementById("f_situacion").style.borderColor= '';
}

if(document.getElementById("cbOcupacion5_interes_1").value=='-1'){
document.getElementById("cbOcupacion5_interes_1").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbOcupacion5_interes_1").style.borderColor= '';
}

if(document.getElementById("cbOcupacion4_interes_1").value=='-1' || document.getElementById("cbOcupacion4_interes_1").value==''){
document.getElementById("cbOcupacion4_interes_1").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbOcupacion4_interes_1").style.borderColor= '';
}

if(document.getElementById("cbOcupacion3_interes_1").value=='-1' || document.getElementById("cbOcupacion3_interes_1").value==''){
document.getElementById("cbOcupacion3_interes_1").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbOcupacion3_interes_1").style.borderColor= '';
}

if(document.getElementById("cbOcupacionE_interes_1").value=='-1' || document.getElementById("cbOcupacionE_interes_1").value==''){
document.getElementById("cbOcupacionE_interes_1").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbOcupacionE_interes_1").style.borderColor= '';
}

if(document.getElementById("cbOcupacionG_interes_1").value=='-1' || document.getElementById("cbOcupacionG_interes_1").value==''){
document.getElementById("cbOcupacionG_interes_1").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbOcupacionG_interes_1").style.borderColor= '';
}

if(document.getElementById("cbExperiencia_1").value=='-1'){
document.getElementById("cbExperiencia_1").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbExperiencia_1").style.borderColor= '';
}

if(document.getElementById("cbOcupacion5_interes2").value=='-1'){
document.getElementById("cbOcupacion5_interes2").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbOcupacion5_interes2").style.borderColor= '';
}

if(document.getElementById("cbOcupacion4_interes2").value=='-1' || document.getElementById("cbOcupacion4_interes2").value==''){
document.getElementById("cbOcupacion4_interes2").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbOcupacion4_interes2").style.borderColor= '';
}

if(document.getElementById("cbOcupacion3_interes2").value=='-1' || document.getElementById("cbOcupacion3_interes2").value==''){
document.getElementById("cbOcupacion3_interes2").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbOcupacion3_interes2").style.borderColor= '';
}

if(document.getElementById("cbOcupacionE_interes2").value=='-1' || document.getElementById("cbOcupacionE_interes2").value==''){
document.getElementById("cbOcupacionE_interes2").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbOcupacionE_interes2").style.borderColor= '';
}

if(document.getElementById("cbOcupacionG_interes2").value=='-1' || document.getElementById("cbOcupacionG_interes2").value==''){
document.getElementById("cbOcupacionG_interes2").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbOcupacionG_interes2").style.borderColor= '';
}

if(document.getElementById("cbExperiencia_2").value=='-1'){
document.getElementById("cbExperiencia_2").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbExperiencia_2").style.borderColor= '';
}

if(document.getElementById("cbJornada_interes").value=='-1'){
document.getElementById("cbJornada_interes").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbJornada_interes").style.borderColor= '';
}

if(document.getElementById("cbTrabajar_fuera").value=='-1'){
document.getElementById("cbTrabajar_fuera").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbTrabajar_fuera").style.borderColor= '';
}

if(document.getElementById("salario_interes").value==''){
document.getElementById("salario_interes").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("salario_interes").style.borderColor= '';
}
	if(valor==0){
		alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
		return false;
	}else{
		return true;
	}	
}
//----------------------------------------- validar_frm_educacion----------------------------------------------------------------

function validar_frm_educacion(){
var valor=1 ;  

//VALIDAR CUANDO ESTE VACIO

if(document.getElementById("cbNivel_academico").value=='-1' || document.getElementById("cbNivel_academico").value==''){
document.getElementById("cbNivel_academico").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbNivel_academico").style.borderColor= '';
}
//-----------------------------------------valida educacion primaria, secundaria y secundaria tecnica------------------------------
if(document.getElementById("cbNivel_academico").value=='3' || document.getElementById("cbNivel_academico").value=='4' || document.getElementById("cbNivel_academico").value=='5'){
	
	if(document.getElementById("cbCarrera").value=='-1' || document.getElementById("cbCarrera").value==''){
	document.getElementById("cbCarrera").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbCarrera").style.borderColor= '';
	}
	if(document.getElementById("cbCarrera1").value=='-1' || document.getElementById("cbCarrera1").value==''){
	document.getElementById("cbCarrera1").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbCarrera1").style.borderColor= '';
	}
	
	if(document.getElementById("cbGraduado").value=='-1' || document.getElementById("cbGraduado").value==''){
	document.getElementById("cbGraduado").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbGraduado").style.borderColor= '';
	}	
	    if(document.getElementById("cbGraduado").value=='1'){
		if(document.getElementById("f_finalizacion").value==''){
		document.getElementById("f_finalizacion").style.borderColor= '#DF0101';
		valor=0;
		}else{
		document.getElementById("f_finalizacion").style.borderColor= '';
		}
			    if(document.getElementById("cbNivel_academico").value=='4' || document.getElementById("cbNivel_academico").value=='5'){
				if(document.getElementById("titulo").value==''){
				document.getElementById("titulo").style.borderColor= '#DF0101';
				valor=0;
				}else{
				document.getElementById("titulo").style.borderColor= '';
				}
				}		
	    }
}
//-----------------------------------------valida educacion superior tsu, universitaria y postgrado---------------------------

if(document.getElementById("cbNivel_academico").value=='6' || document.getElementById("cbNivel_academico").value=='7' || document.getElementById("cbNivel_academico").value=='8'){
	
	if(document.getElementById("cbCarrera").value=='-1' || document.getElementById("cbCarrera").value==''){
	document.getElementById("cbCarrera").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbCarrera").style.borderColor= '';
	}
	if(document.getElementById("cbCarrera1").value=='-1' || document.getElementById("cbCarrera1").value==''){
	document.getElementById("cbCarrera1").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbCarrera1").style.borderColor= '';
	}
	if(document.getElementById("cbCarrera2").value=='-1' || document.getElementById("cbCarrera2").value==''){
	document.getElementById("cbCarrera2").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbCarrera2").style.borderColor= '';
	}
	if(document.getElementById("cbCarrera3").value=='-1' || document.getElementById("cbCarrera3").value==''){
	document.getElementById("cbCarrera3").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbCarrera3").style.borderColor= '';
	}
	
	if(document.getElementById("cbGraduado").value=='-1' || document.getElementById("cbGraduado").value==''){
	document.getElementById("cbGraduado").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbGraduado").style.borderColor= '';
	}	
	    if(document.getElementById("cbGraduado").value=='1'){
			if(document.getElementById("f_finalizacion").value==''){
			document.getElementById("f_finalizacion").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("f_finalizacion").style.borderColor= '';
			}			   
			if(document.getElementById("titulo").value==''){
			document.getElementById("titulo").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("titulo").style.borderColor= '';
			}						
	    }
}
//------------------------------------------valida educacion en general------------------------------------------------------------	

if(document.getElementById("cbNivel_academico").value=='3' || document.getElementById("cbNivel_academico").value=='4' || document.getElementById("cbNivel_academico").value=='5' || document.getElementById("cbNivel_academico").value=='6' || document.getElementById("cbNivel_academico").value=='7' || document.getElementById("cbNivel_academico").value=='8'){
	var ultimo='';
	var total='';
	
	if(document.getElementById("cbRegimen").value=='-1' || document.getElementById("cbRegimen").value==''){
	document.getElementById("cbRegimen").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbRegimen").style.borderColor= '';
	}
	
	if(document.getElementById("cbUltimo_aprobado").value==0 || document.getElementById("cbUltimo_aprobado").value==''){
	document.getElementById("cbUltimo_aprobado").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbUltimo_aprobado").style.borderColor= '';
	}
	
	if(document.getElementById("cbTotal").value==0 || document.getElementById("cbTotal").value==''){
	document.getElementById("cbTotal").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbTotal").style.borderColor= '';
	}
	
	
	if(parseInt(document.getElementById("cbUltimo_aprobado").value)!=0 && parseInt(document.getElementById("cbTotal").value)!=0){
		if(parseInt(document.getElementById("cbUltimo_aprobado").value) > parseInt(document.getElementById("cbTotal").value)){
			document.getElementById("cbUltimo_aprobado").style.borderColor= '#DF0101';
			valor=0;
		}else{
			document.getElementById("cbUltimo_aprobado").style.borderColor= '';

	}
}
	
	
	
	
	if(document.getElementById("instituto").value==''){
	document.getElementById("instituto").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("instituto").style.borderColor= '';
	}
}

	if(valor==0){
		alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
		return false;
	}else{
		return true;
	}	
}

//----------------------------------------- validar_frm_capacitacion----------------------------------------------------------------

function validar_frm_capacitacion(){
var valor=1 ;  

//VALIDAR CUANDO ESTE VACIO

if(document.getElementById("cbCapacitacion").value=='-1' || document.getElementById("cbCapacitacion").value==''){
document.getElementById("cbCapacitacion").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbCapacitacion").style.borderColor= '';
}


if(document.getElementById("cbCapacitacion").value=='1'){

if(document.getElementById("cbCurso_categoria").value=='-1' || document.getElementById("cbCurso_categoria").value==''){
document.getElementById("cbCurso_categoria").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbCurso_categoria").style.borderColor= '';
}

if(document.getElementById("cbCurso").value=='-1' || document.getElementById("cbCurso").value==''){
document.getElementById("cbCurso").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbCurso").style.borderColor= '';
} 
  
if(document.getElementById("Instituto_curso").value==''){
document.getElementById("Instituto_curso").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("Instituto_curso").style.borderColor= '';
} 

if(document.getElementById("Duracion_curso").value==''){
document.getElementById("Duracion_curso").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("Duracion_curso").style.borderColor= '';
}

if(document.getElementById("cbRelacion_curso").value=='-1' || document.getElementById("cbRelacion_curso").value==''){
document.getElementById("cbRelacion_curso").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbRelacion_curso").style.borderColor= '';
}

if(document.getElementById("cbPrograma_curso").value=='-1' || document.getElementById("cbPrograma_curso").value==''){
document.getElementById("cbPrograma_curso").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbPrograma_curso").style.borderColor= '';
}

if(document.getElementById("cbPrograma_curso").value=='1'){
if(document.getElementById("Nombre_programa").value==''){
document.getElementById("Nombre_programa").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("Nombre_programa").style.borderColor= '';
}
}

if(document.getElementById("cbCentro_capacitacion").value=='-1' || document.getElementById("cbCentro_capacitacion").value==''){
document.getElementById("cbCentro_capacitacion").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbCentro_capacitacion").style.borderColor= '';
}

}

	if(valor==0){
		alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
		return false;
	}else{
		return true;
	}	
}

//----------------------------------------- validar_frm_conocimientos----------------------------------------------------------------

function validar_frm_conocimientos(boton){
var valor=1 ; 
//alert(boton);

//VALIDAR CUANDO ESTE VACIO
 if(boton=='Agrega_compu'){
			if(document.getElementById("cbComputacion").value=='-1' || document.getElementById("cbComputacion").value==''){
			document.getElementById("cbComputacion").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbComputacion").style.borderColor= '';
			}
			if(document.getElementById("cbComputacion").value!='1'){
			if(document.getElementById("cbNivel_compu").value=='-1' || document.getElementById("cbNivel_compu").value==''){
			document.getElementById("cbNivel_compu").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbNivel_compu").style.borderColor= '';
			}
			}
				if(valor==0){
					alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
					return false;
				}else{
					return true;
				}	
 }
 
else{
			document.getElementById("cbComputacion").style.borderColor= '';
			document.getElementById("cbNivel_compu").style.borderColor= '';
			
			if(document.getElementById("cbIdioma").value=='-1'){
				document.getElementById("cbIdioma").style.borderColor= '#DF0101';
				valor=0;
			}else{
					document.getElementById("cbIdioma").style.borderColor= '';
				
					if(document.getElementById("cbIdioma").value=='-1'){
					document.getElementById("cbIdioma").style.borderColor= '#DF0101';
					valor=0;
					}else{
						document.getElementById("cbIdioma").style.borderColor= '';
							if(document.getElementById("cbHabla").value=='-1'){
							document.getElementById("cbHabla").style.borderColor= '#DF0101';
							valor=0;
							}else{
							document.getElementById("cbHabla").style.borderColor= '';
									if(document.getElementById("cbHabla").value=='1' && document.getElementById("cbNivel_Habla").value=='-1'){
									document.getElementById("cbNivel_Habla").style.borderColor= '#DF0101';
									valor=0;
									}else{
									document.getElementById("cbNivel_Habla").style.borderColor= '';
									}	
							}
							if(document.getElementById("cbLee").value=='-1'){
							document.getElementById("cbLee").style.borderColor= '#DF0101';
							valor=0;
							}else{
							document.getElementById("cbLee").style.borderColor= '';
									if(document.getElementById("cbLee").value=='1' && document.getElementById("cbNivel_Lee").value=='-1'){
									document.getElementById("cbNivel_Lee").style.borderColor= '#DF0101';
									valor=0;
									}else{
									document.getElementById("cbNivel_Lee").style.borderColor= '';
									}	
							}
							if(document.getElementById("cbEscribe").value=='-1'){
							document.getElementById("cbEscribe").style.borderColor= '#DF0101';
							valor=0;
							}else{
							document.getElementById("cbEscribe").style.borderColor= '';
									if(document.getElementById("cbEscribe").value=='1' && document.getElementById("cbNivel_Escribe").value=='-1'){
									document.getElementById("cbNivel_Escribe").style.borderColor= '#DF0101';
									valor=0;
									}else{
									document.getElementById("cbNivel_Escribe").style.borderColor= '';
									}
							}
					}
			}
			

				if(valor==0){
					alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
					return false;
				}else{
					return true;
				}	
	
	}
}

//validar_frm_experiencia----------------------------------------------------------------

function validar_frm_experiencia(boton){
var valor=1 ; 
//alert(boton);

//VALIDAR CUANDO ESTE VACIO
 if(boton=='Agrega_compu'){
			if(document.getElementById("cbComputacion").value=='-1' || document.getElementById("cbComputacion").value==''){
			document.getElementById("cbComputacion").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbComputacion").style.borderColor= '';
			}
			if(document.getElementById("cbComputacion").value!='1'){
			if(document.getElementById("cbNivel_compu").value=='-1' || document.getElementById("cbNivel_compu").value==''){
			document.getElementById("cbNivel_compu").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbNivel_compu").style.borderColor= '';
			}
			}
				if(valor==0){
					alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
					return false;
				}else{
					return true;
				}	
 }
 
else{
			document.getElementById("cbComputacion").style.borderColor= '';
			document.getElementById("cbNivel_compu").style.borderColor= '';
			
			if(document.getElementById("cbIdioma").value=='-1'){
				document.getElementById("cbIdioma").style.borderColor= '#DF0101';
				valor=0;
			}else{
					document.getElementById("cbIdioma").style.borderColor= '';
				
					if(document.getElementById("cbIdioma").value=='-1'){
					document.getElementById("cbIdioma").style.borderColor= '#DF0101';
					valor=0;
					}else{
						document.getElementById("cbIdioma").style.borderColor= '';
							if(document.getElementById("cbHabla").value=='-1'){
							document.getElementById("cbHabla").style.borderColor= '#DF0101';
							valor=0;
							}else{
							document.getElementById("cbHabla").style.borderColor= '';
									if(document.getElementById("cbHabla").value=='1' && document.getElementById("cbNivel_Habla").value=='-1'){
									document.getElementById("cbNivel_Habla").style.borderColor= '#DF0101';
									valor=0;
									}else{
									document.getElementById("cbNivel_Habla").style.borderColor= '';
									}	
							}
							if(document.getElementById("cbLee").value=='-1'){
							document.getElementById("cbLee").style.borderColor= '#DF0101';
							valor=0;
							}else{
							document.getElementById("cbLee").style.borderColor= '';
									if(document.getElementById("cbLee").value=='1' && document.getElementById("cbNivel_Lee").value=='-1'){
									document.getElementById("cbNivel_Lee").style.borderColor= '#DF0101';
									valor=0;
									}else{
									document.getElementById("cbNivel_Lee").style.borderColor= '';
									}	
							}
							if(document.getElementById("cbEscribe").value=='-1'){
							document.getElementById("cbEscribe").style.borderColor= '#DF0101';
							valor=0;
							}else{
							document.getElementById("cbEscribe").style.borderColor= '';
									if(document.getElementById("cbEscribe").value=='1' && document.getElementById("cbNivel_Escribe").value=='-1'){
									document.getElementById("cbNivel_Escribe").style.borderColor= '#DF0101';
									valor=0;
									}else{
									document.getElementById("cbNivel_Escribe").style.borderColor= '';
									}
							}
					}
			}
			

				if(valor==0){
					alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
					return false;
				}else{
					return true;
				}	
	
	}
}