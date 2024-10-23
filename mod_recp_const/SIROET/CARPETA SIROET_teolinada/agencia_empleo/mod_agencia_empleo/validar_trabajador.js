//----------------------------------------- validar_frm_trabajador----------------------------------------------------------------
		
		
function validar_frm_trabajador(){
var valor=1 ;  

//VALIDAR CUANDO ESTE VACIO
/*if(document.getElementById("nombre_afiliado").value==''){
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

if(document.getElementById("cbNacionalidad_afiliado").value=='-1'){
document.getElementById("cbNacionalidad_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbNacionalidad_afiliado").style.borderColor= '';
}  
*/
if(document.getElementById("cbEstado_Civil_afiliado").value=='-1'){
document.getElementById("cbEstado_Civil_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbEstado_Civil_afiliado").style.borderColor= '';
} 


if(document.getElementById("cbPais_nac_afiliado").value=='-1'){
document.getElementById("cbPais_nac_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbPais_nac_afiliado").style.borderColor= '';
} 

if(document.getElementById("cbPais_nac_afiliado").value=='239'){
if(document.getElementById("cbEstado_nac_afiliado").value=='-1' || document.getElementById("cbEstado_nac_afiliado").value==''){
document.getElementById("cbEstado_nac_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbEstado_nac_afiliado").style.borderColor= '';
}
}
else{
document.getElementById("cbEstado_nac_afiliado").style.borderColor= '';
}

if(document.getElementById("tipo_persona").value!='P'){
if(document.getElementById("cbPais_afiliado").value=='-1' || document.getElementById("cbPais_afiliado").value==''){
document.getElementById("cbPais_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbPais_afiliado").style.borderColor= '';
}
}
else{
document.getElementById("cbPais_afiliado").style.borderColor= '';
}

if(document.getElementById("cbEstado_afiliado").value=='-1'){
document.getElementById("cbEstado_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbEstado_afiliado").style.borderColor= '';
}

if(document.getElementById("cbMunicipio_afiliado").value=='-1' || document.getElementById("cbMunicipio_afiliado").value==''){
document.getElementById("cbMunicipio_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbMunicipio_afiliado").style.borderColor= '';
}

if(document.getElementById("cbParroquia_afiliado").value=='-1' || document.getElementById("cbParroquia_afiliado").value==''){
document.getElementById("cbParroquia_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbParroquia_afiliado").style.borderColor= '';
}

if(document.getElementById("sector_afiliado").value==''){
document.getElementById("sector_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("sector_afiliado").style.borderColor= '';
}

if(document.getElementById("direccion_afiliado").value==''){
document.getElementById("direccion_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("direccion_afiliado").style.borderColor= '';
}

if(document.getElementById("telefono_afiliado").value==''){
document.getElementById("telefono_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("telefono_afiliado").style.borderColor= '';
}

if(document.getElementById("cbDiscapacidad_afiliado").value=='-1'){
document.getElementById("cbDiscapacidad_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbDiscapacidad_afiliado").style.borderColor= '';
}

if(document.getElementById("cbJefe_familia").value=='-1'){
document.getElementById("cbJefe_familia").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbJefe_familia").style.borderColor= '';
} 
if(document.getElementById("cbHijos").value=='-1'){
document.getElementById("cbHijos").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbHijos").style.borderColor= '';
} 
if(document.getElementById("cbHijos").value=='1'){
	if(document.getElementById("hijos_mayores").value=='' && document.getElementById("hijos_menores").value==''){
	document.getElementById("hijos_mayores").style.borderColor= '#DF0101';
	document.getElementById("hijos_menores").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("hijos_mayores").style.borderColor= '';
	document.getElementById("hijos_menores").style.borderColor= '';
	}
}   

if(document.getElementById("ingreso_familiar").value==''){
document.getElementById("ingreso_familiar").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("ingreso_familiar").style.borderColor= '';
}

if(document.getElementById("cbVehiculo_afiliado").value=='-1'){
document.getElementById("cbVehiculo_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbVehiculo_afiliado").style.borderColor= '';
}


if(document.getElementById("cbmision_beneficio_educacion").value=='-1' || document.getElementById("cbmision_beneficio_educacion").value==''){
document.getElementById("cbmision_beneficio_educacion").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbmision_beneficio_educacion").style.borderColor= '';
}

if(document.getElementById("cbmision_beneficio_educacion").value=='1'){
	if(document.getElementById("cbMisiones_Educacion").value=='-1' || document.getElementById("cbMisiones_Educacion").value==''){
	document.getElementById("cbMisiones_Educacion").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbMisiones_Educacion").style.borderColor= '';
	}
}

if(document.getElementById("cbmision_beneficio_social").value=='-1' || document.getElementById("cbmision_beneficio_social").value==''){
document.getElementById("cbmision_beneficio_social").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbmision_beneficio_social").style.borderColor= '';
}

if(document.getElementById("cbmision_beneficio_social").value=='1'){
	if(document.getElementById("cbMisiones_social").value=='-1' || document.getElementById("cbMisiones_social").value==''){
	document.getElementById("cbMisiones_social").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbMisiones_social").style.borderColor= '';
	}
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


if(document.getElementById("cbvia_ingreso").value=='-1' || document.getElementById("cbvia_ingreso").value==''){
document.getElementById("cbvia_ingreso").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbvia_ingreso").style.borderColor= '';
}

if(document.getElementById("cbstatus_migratorio").value=='-1' || document.getElementById("cbstatus_migratorio").value==''){
document.getElementById("cbstatus_migratorio").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbstatus_migratorio").style.borderColor= '';
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


if(document.getElementById("cbDiscapacidad_origen").value=='3'){
	if(document.getElementById("cbAdquirida").value=='-1' || document.getElementById("cbAdquirida").value==''){
	document.getElementById("cbAdquirida").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbAdquirida").style.borderColor= '';
	} 
}else{
document.getElementById("cbAdquirida").style.borderColor= '';
} 


if(document.getElementById("cbDiscapacidad_calificacion").value=='-1' || document.getElementById("cbDiscapacidad_calificacion").value==''){
document.getElementById("cbDiscapacidad_calificacion").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbDiscapacidad_calificacion").style.borderColor= '';
}  

if(document.getElementById("cbDiscapacidad_certificado").value=='-1' || document.getElementById("cbDiscapacidad_certificado").value==''){
document.getElementById("cbDiscapacidad_certificado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbDiscapacidad_certificado").style.borderColor= '';
}

if(document.getElementById("cbDiscapacidad_certificado").value=='1'){
	if(document.getElementById("cbCertificado").value=='-1' || document.getElementById("cbCertificado").value==''){
	document.getElementById("cbCertificado").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbCertificado").style.borderColor= '';
	} 
}else{
document.getElementById("cbCertificado").style.borderColor= '';
} 


if(document.getElementById("cbDiscapacidad_ayuda").value=='-1' || document.getElementById("cbDiscapacidad_ayuda").value==''){
document.getElementById("cbDiscapacidad_ayuda").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbDiscapacidad_ayuda").style.borderColor= '';
} 


if(document.getElementById("cbDiscapacidad_ayuda").value=='1'){
	if(document.getElementById("cbTipo_Ayuda_discapacidad").value=='-1' || document.getElementById("cbTipo_Ayuda_discapacidad").value==''){
	document.getElementById("cbTipo_Ayuda_discapacidad").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbTipo_Ayuda_discapacidad").style.borderColor= '';
	} 
}else{
document.getElementById("cbTipo_Ayuda_discapacidad").style.borderColor= '';
}   

if(document.getElementById("cbDiscapacidad_ayuda").value=='1'){
	if(document.getElementById("cbDiscapacidad_nivel_depen").value=='-1' || document.getElementById("cbDiscapacidad_nivel_depen").value==''){
	document.getElementById("cbDiscapacidad_nivel_depen").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbDiscapacidad_nivel_depen").style.borderColor= '';
	} 
}else{
document.getElementById("cbDiscapacidad_nivel_depen").style.borderColor= '';
} 


if(document.getElementById("cbControl_medico").value=='-1' || document.getElementById("cbControl_medico").value==''){
document.getElementById("cbControl_medico").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbControl_medico").style.borderColor= '';
}


if(document.getElementById("cbControl_medico").value=='1'){
	if(document.getElementById("cbFrecuencia").value=='-1' || document.getElementById("cbFrecuencia").value==''){
	document.getElementById("cbFrecuencia").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbFrecuencia").style.borderColor= '';
	} 
}else{
document.getElementById("cbFrecuencia").style.borderColor= '';
}   


if(document.getElementById("cbMedicado").value=='-1' || document.getElementById("cbMedicado").value==''){
document.getElementById("cbMedicado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbMedicado").style.borderColor= '';
}


if(document.getElementById("cbMedicado").value=='1'){
		if(document.getElementById("medicamento").value==''){
		document.getElementById("medicamento").style.borderColor= '#DF0101';
		valor=0;
		}else{
		document.getElementById("medicamento").style.borderColor= '';
		}
}else{
document.getElementById("medicamento").style.borderColor= '';
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

if(document.getElementById("cbTeletrabajo").value==''){
document.getElementById("cbTeletrabajo").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbTeletrabajo").style.borderColor= '';
}

			if(document.getElementById("cbTipo_situacion_afiliado").value=='14'){
					if(document.getElementById("cbLugar_trabajo").value=='' || document.getElementById("cbLugar_trabajo").value=='0'){
					document.getElementById("cbLugar_trabajo").style.borderColor= '#DF0101';
					valor=0;
					}else{
					document.getElementById("cbLugar_trabajo").style.borderColor= '';
					}
					if(document.getElementById("cbFrecuencia_actividad").value=='' || document.getElementById("cbFrecuencia_actividad").value=='0'){
					document.getElementById("cbFrecuencia_actividad").style.borderColor= '#DF0101';
					valor=0;
					}else{
					document.getElementById("cbFrecuencia_actividad").style.borderColor= '';
					}
									
					}
			else{
			document.getElementById("cbTipo_situacion_afiliado").style.borderColor= '';
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
var cbultimo=0;
var cbtotal=0;
  
if(document.getElementById("cbNivel_academico").value=='-1' || document.getElementById("cbNivel_academico").value==''){
	document.getElementById("cbNivel_academico").style.borderColor= '#DF0101';
	valor=0;
}
else{
		document.getElementById("cbNivel_academico").style.borderColor= '';
		
//----------------------------------------------valida educacion especial e inicial------------------------------------
		if(document.getElementById("cbNivel_academico").value=='9' || document.getElementById("cbNivel_academico").value=='10'){
				if(document.getElementById("instituto").value==''){
					document.getElementById("instituto").style.borderColor= '#DF0101';
					valor=0;
					}else{
					document.getElementById("instituto").style.borderColor= '';
					}
		}
//----------------------------------------------valida educacion primaria------------------------------------
		if(document.getElementById("cbNivel_academico").value=='3'){
				if(document.getElementById("instituto").value==''){
					document.getElementById("instituto").style.borderColor= '#DF0101';
					valor=0;
					}else{
					document.getElementById("instituto").style.borderColor= '';
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
					}
					else{
							document.getElementById("f_finalizacion").style.borderColor= '';
							document.getElementById("titulo").style.borderColor= '';
						}
						
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
					cbultimo=1;	
					document.getElementById("cbUltimo_aprobado").style.borderColor= '';
					}
					
					if(document.getElementById("cbTotal").value==0 || document.getElementById("cbTotal").value==''){
					document.getElementById("cbTotal").style.borderColor= '#DF0101';
					valor=0;
					}else{
					cbtotal=1;	
					document.getElementById("cbTotal").style.borderColor= '';
					}
					
					if(cbultimo==1 && cbtotal==1){
							if(document.getElementById("cbUltimo_aprobado").value > document.getElementById("cbTotal").value){
							document.getElementById("cbUltimo_aprobado").style.borderColor= '#DF0101';
							document.getElementById("cbTotal").style.borderColor= '#DF0101';
							valor=0;
							}else{
							document.getElementById("cbUltimo_aprobado").style.borderColor= '';
							document.getElementById("cbTotal").style.borderColor= '';
							} 
					}
					 
					if(document.getElementById("instituto").value==''){
					document.getElementById("instituto").style.borderColor= '#DF0101';
					valor=0;
					}else{
					document.getElementById("instituto").style.borderColor= '';
					}
		}		
		
//----------------valida educacion secundaria - secundaria tecnica tsu universitaria postgrado---------------------------
		
		if(document.getElementById("cbNivel_academico").value=='4' || document.getElementById("cbNivel_academico").value=='5'||document.getElementById("cbNivel_academico").value=='6' || document.getElementById("cbNivel_academico").value=='7' || document.getElementById("cbNivel_academico").value=='8'){
				
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
				
				if(document.getElementById("instituto").value==''){
					document.getElementById("instituto").style.borderColor= '#DF0101';
					valor=0;
					}else{
					document.getElementById("instituto").style.borderColor= '';
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
					else{
							document.getElementById("f_finalizacion").style.borderColor= '';
							document.getElementById("titulo").style.borderColor= '';
						}
						
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
					cbultimo=1;	
					document.getElementById("cbUltimo_aprobado").style.borderColor= '';
					}
					
					if(document.getElementById("cbTotal").value==0 || document.getElementById("cbTotal").value==''){
					document.getElementById("cbTotal").style.borderColor= '#DF0101';
					valor=0;
					}else{
					cbtotal=1;	
					document.getElementById("cbTotal").style.borderColor= '';
					}
					
					if(cbultimo==1 && cbtotal==1){
							if(document.getElementById("cbUltimo_aprobado").value > document.getElementById("cbTotal").value){
							document.getElementById("cbUltimo_aprobado").style.borderColor= '#DF0101';
							document.getElementById("cbTotal").style.borderColor= '#DF0101';
							valor=0;
							}else{
							document.getElementById("cbUltimo_aprobado").style.borderColor= '';
							document.getElementById("cbTotal").style.borderColor= '';
							} 
					}
					
					if(document.getElementById("instituto").value==''){
					document.getElementById("instituto").style.borderColor= '#DF0101';
					valor=0;
					}else{
					document.getElementById("instituto").style.borderColor= '';
					}
					
					if(document.getElementById("cbNivel_academico").value=='6' || document.getElementById("cbNivel_academico").value=='7'){
	
							if(document.getElementById("cbPasantias").value=='-1' || document.getElementById("cbPasantias").value==''){
							document.getElementById("cbPasantias").style.borderColor= '#DF0101';
							valor=0;
							}else{
							document.getElementById("cbPasantias").style.borderColor= '';
							}
					}else{
					 document.getElementById("cbPasantias").style.borderColor= '';
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



//-----------------------------validar_frm_capacitacion----------------------------------------------------------------

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

function validar_frm_experiencia(){
var valor=1 ;  

if(document.getElementById("cbExperiencia").value=='-1' || document.getElementById("cbExperiencia").value==''){
			document.getElementById("cbExperiencia").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbExperiencia").style.borderColor= '';
			}

			if(document.getElementById("patrono").value==''){
			document.getElementById("patrono").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("patrono").style.borderColor= '';
			}
			
			if(document.getElementById("cbSector_empleo").value=='-1'){
			document.getElementById("cbSector_empleo").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbSector_empleo").style.borderColor= '';
			}
			
			if(document.getElementById("cbAct_economica4").value=='-1' || document.getElementById("cbAct_economica4").value==''){
			document.getElementById("cbAct_economica4").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbAct_economica4").style.borderColor= '';
			} 
			
			if(document.getElementById("cbAct_economica3").value=='-1' || document.getElementById("cbAct_economica3").value==''){
			document.getElementById("cbAct_economica3").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbAct_economica3").style.borderColor= '';
			} 
			
			if(document.getElementById("cbAct_economica2").value=='-1' || document.getElementById("cbAct_economica2").value==''){
			document.getElementById("cbAct_economica2").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbAct_economica2").style.borderColor= '';
			} 
			
			if(document.getElementById("cbAct_economica1").value=='-1' || document.getElementById("cbAct_economica1").value==''){
			document.getElementById("cbAct_economica1").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbAct_economica1").style.borderColor= '';
			} 
			
			if(document.getElementById("cbOcupacion5_experiencia").value=='-1' || document.getElementById("cbOcupacion5_experiencia").value==''){
			document.getElementById("cbOcupacion5_experiencia").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbOcupacion5_experiencia").style.borderColor= '';
			} 
			
			if(document.getElementById("cbOcupacion4_experiencia").value=='-1' || document.getElementById("cbOcupacion4_experiencia").value==''){
			document.getElementById("cbOcupacion4_experiencia").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbOcupacion4_experiencia").style.borderColor= '';
			} 
			
			if(document.getElementById("cbOcupacion3_experiencia").value=='-1' || document.getElementById("cbOcupacion3_experiencia").value==''){
			document.getElementById("cbOcupacion3_experiencia").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbOcupacion3_experiencia").style.borderColor= '';
			} 
			
			if(document.getElementById("cbOcupacionE_experiencia").value=='-1' || document.getElementById("cbOcupacionE_experiencia").value==''){
			document.getElementById("cbOcupacionE_experiencia").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbOcupacionE_experiencia").style.borderColor= '';
			} 
			
			if(document.getElementById("cbOcupacionG_experiencia").value=='-1' || document.getElementById("cbOcupacionG_experiencia").value==''){
			document.getElementById("cbOcupacionG_experiencia").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbOcupacionG_experiencia").style.borderColor= '';
			}
			
			if(document.getElementById("cbRelacion_trabajo").value=='-1' || document.getElementById("cbRelacion_trabajo").value==''){
			document.getElementById("cbRelacion_trabajo").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbRelacion_trabajo").style.borderColor= '';
			}
			
			if(document.getElementById("sueldo").value==''){
			document.getElementById("sueldo").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("sueldo").style.borderColor= '';
			}
			
			if(document.getElementById("f_ingreso").value==''){
			document.getElementById("f_ingreso").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("f_ingreso").style.borderColor= '';
			}
			
			if(document.getElementById("cbPersonal_supervisado").value=='-1' || document.getElementById("cbPersonal_supervisado").value==''){
			document.getElementById("cbPersonal_supervisado").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbPersonal_supervisado").style.borderColor= '';
			}

	if(valor==0){
		alert("LOS CAMPOS EN ROJO SON REQUERIDO");
		return false;
	}else{
		return true;
	}	
}

//validar_frm_participacion----------------------------------------------------------------

function validar_frm_participacion(){
var valor=1 ;  

			if(document.getElementById("nombre_org").value==''){
			document.getElementById("nombre_org").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("nombre_org").style.borderColor= '';
			}
			
			if(document.getElementById("cbObjeto_org").value=='-1' || document.getElementById("cbObjeto_org").value==''){
			document.getElementById("cbObjeto_org").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbObjeto_org").style.borderColor= '';
			} 
						
			if(document.getElementById("cbEstado_org").value=='-1' || document.getElementById("cbEstado_org").value==''){
			document.getElementById("cbEstado_org").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbEstado_org").style.borderColor= '';
			} 
			
			if(document.getElementById("cbMunicipio_org").value=='-1' || document.getElementById("cbMunicipio_org").value==''){
			document.getElementById("cbMunicipio_org").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbMunicipio_org").style.borderColor= '';
			} 
			
			if(document.getElementById("cbParroquia_org").value=='-1' || document.getElementById("cbParroquia_org").value==''){
			document.getElementById("cbParroquia_org").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbParroquia_org").style.borderColor= '';
			} 
			
			if(document.getElementById("sector_org").value==''){
			document.getElementById("sector_org").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("sector_org").style.borderColor= '';
			}
			
			if(document.getElementById("direccion_org").value==''){
			document.getElementById("direccion_org").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("direccion_org").style.borderColor= '';
			}	

	if(valor==0){
		alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
		return false;
	}else{
		return true;
	}	
}

//validar_frm_PPIE----------------------------------------------------------------

function validar_frm_ppie(){
var valor=1 ;  

			if(document.getElementById("rif_pdpie").value==''){
			document.getElementById("rif_pdpie").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("rif_pdpie").style.borderColor= '';
			} 
			
			if(document.getElementById("empresa_pdpie").value==''){
			document.getElementById("empresa_pdpie").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("empresa_pdpie").style.borderColor= '';
			} 
			 
			if(document.getElementById("cbSector_empleo").value=='-1' || document.getElementById("cbSector_empleo").value==''){
			document.getElementById("cbSector_empleo").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbSector_empleo").style.borderColor= '';
			} 
			
			if(document.getElementById("ivss_pdpie").value==''){
			document.getElementById("ivss_pdpie").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("ivss_pdpie").style.borderColor= '';
			} 
			
			if(document.getElementById("cbMotivo_retiro_pdpie").value=='-1' || document.getElementById("cbMotivo_retiro_pdpie").value==''){
			document.getElementById("cbMotivo_retiro_pdpie").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cbMotivo_retiro_pdpie").style.borderColor= '';
			} 
			
			if(document.getElementById("f_culminacion_pdpie").value==''){
			document.getElementById("f_culminacion_pdpie").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("f_culminacion_pdpie").style.borderColor= '';
			} 
			
			if(document.getElementById("f_solicitud_pdpie").value==''){
			document.getElementById("f_solicitud_pdpie").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("f_solicitud_pdpie").style.borderColor= '';
			} 
			
			if(document.getElementById("cargo_pdpie").value==''){
			document.getElementById("cargo_pdpie").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("cargo_pdpie").style.borderColor= '';
			}
			
			if(document.getElementById("salario_pdpie").value==''){
			document.getElementById("salario_pdpie").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("salario_pdpie").style.borderColor= '';
			}

			
	/*			if(document.getElementById("cbReferido").value=='-1' || document.getElementById("cbReferido").value==''){
				document.getElementById("cbReferido").style.borderColor= '#DF0101';
				valor=0;
				}else{
				document.getElementById("cbReferido").style.borderColor= '';
				}  
				if(document.getElementById("cbMotivo_referido").value=='-1' || document.getElementById("cbMotivo_referido").value==''){
				document.getElementById("cbMotivo_referido").style.borderColor= '#DF0101';
				valor=0;
				}else{
				document.getElementById("cbMotivo_referido").style.borderColor= '';
				}  */

	if(valor==0){
		alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
		return false;
	}else{
		return true;
	}	
}

//validar_frm_consulta_trabajador----------------------------------------------------------------

function validar_frm_consulta_trabajador(){
var valor=1 ;  

			if(document.getElementById("Ced_afiliado").value==''){
			document.getElementById("Ced_afiliado").style.borderColor= '#DF0101';
			valor=0;
			}else{
			document.getElementById("Ced_afiliado").style.borderColor= '';
			}
			
	if(valor==0){
		alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
		return false;
	}else{
		return true;
	}	
}

//----------------------------------------- validar_frm_prevision----------------------------------------------------------------

function validar_frm_prevision(){
var valor=1 ;  

//VALIDAR CUANDO ESTE VACIO

if(document.getElementById("cbCotiza").value=='-1' || document.getElementById("cbCotiza").value==''){
document.getElementById("cbCotiza").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbCotiza").style.borderColor= '';
}
 

/*if(document.getElementById("cbCotiza").value=='1'){
	if(document.getElementById("Numero_cotizaciones").value==''){
	document.getElementById("Numero_cotizaciones").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("Numero_cotizaciones").style.borderColor= '';
	} 
}else{
document.getElementById("Numero_cotizaciones").style.borderColor= '';
}*/ 

if(document.getElementById("cbCotiza").value=='2'){
	if(document.getElementById("cbNo_cotiza").value=='-1' || document.getElementById("cbNo_cotiza").value==''){
	document.getElementById("cbNo_cotiza").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbNo_cotiza").style.borderColor= '';
	} 
}else{
document.getElementById("cbNo_cotiza").style.borderColor= '';
} 

if(document.getElementById("cbCotiza_anterior").value=='-1' || document.getElementById("cbCotiza_anterior").value==''){
document.getElementById("cbCotiza_anterior").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbCotiza_anterior").style.borderColor= '';
} 

if(document.getElementById("cbCotiza_anterior").value=='2'){
	if(document.getElementById("cbNo_cotiza_anterior").value=='-1' || document.getElementById("cbNo_cotiza_anterior").value==''){
	document.getElementById("cbNo_cotiza_anterior").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbNo_cotiza_anterior").style.borderColor= '';
	} 
}else{
document.getElementById("cbNo_cotiza_anterior").style.borderColor= '';
}  

if(document.getElementById("cbPensionado").value=='-1' || document.getElementById("cbPensionado").value==''){
document.getElementById("cbPensionado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbPensionado").style.borderColor= '';
}

if(document.getElementById("cbPensionado").value=='1'){
	if(document.getElementById("cbTipo_pension").value=='-1' || document.getElementById("cbTipo_pension").value==''){
	document.getElementById("cbTipo_pension").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbTipo_pension").style.borderColor= '';
	} 
}else{
document.getElementById("cbTipo_pension").style.borderColor= '';
} 

if(document.getElementById("cbSeguir_cotizando").value=='-1' || document.getElementById("cbSeguir_cotizando").value==''){
document.getElementById("cbSeguir_cotizando").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbSeguir_cotizando").style.borderColor= '';
} 

if(document.getElementById("cbSeguir_cotizando").value=='2'){
	if(document.getElementById("cbNo_seguir_cotiza").value=='-1' || document.getElementById("cbNo_seguir_cotiza").value==''){
	document.getElementById("cbNo_seguir_cotiza").style.borderColor= '#DF0101';
	valor=0;
	}else{
	document.getElementById("cbNo_seguir_cotiza").style.borderColor= '';
	} 
}else{
document.getElementById("cbNo_seguir_cotiza").style.borderColor= '';
}  

//----------------------------------------------------------------------
	if(valor==0){
		alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
		return false;
	}else{
		return true;
	}	
}