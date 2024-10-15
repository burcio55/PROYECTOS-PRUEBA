//----------------------------------------- validar_frm_empresa redes----------------------------------------------------------------
function validar_frm_empresa_redes(){
	var valor=1 ; 

	if(document.getElementById("cbred_social").value=='-1'){
		valor=2;
	}else{
		document.getElementById("cbred_social").style.borderColor= '';

		if(document.getElementById("redes_sociales").value==''){
			valor=3;
		}else{
			document.getElementById("redes_sociales").style.borderColor= '';
		}

	}

	if(valor==2 || valor==3){
		if(valor==2){
			document.getElementById("cbred_social").style.borderColor= '#DF0101';
			alert("LA RED SOCIAL ES REQUERIDA");
		}

		if(valor==3){
			document.getElementById("redes_sociales").style.borderColor= '#DF0101';
			alert("LA DIRECCIÓN DE LA RED SOCIAL ES REQUERIDA");
		}
		return false;
	}else{
		return true;
	}
}
//----------------------------------------- validar_form_empresa----------------------------------------------------------------
function validar_frm_empresa(existe){
	var valor=1 ; 

	if(document.getElementById("cbEstado_empresa").value=='-1'){
		document.getElementById("cbEstado_empresa").style.borderColor= '#DF0101';
		valor=0;
	}else{
		document.getElementById("cbEstado_empresa").style.borderColor= '';
	}  

	if(document.getElementById("cbMunicipio_empresa").value=='-1'){
		document.getElementById("cbMunicipio_empresa").style.borderColor= '#DF0101';
		valor=0;
	}else{
		document.getElementById("cbMunicipio_empresa").style.borderColor= '';
	}

	if(document.getElementById("cbParroquia_empresa").value=='-1'){
		document.getElementById("cbParroquia_empresa").style.borderColor= '#DF0101';
		valor=0;
	}else{
		document.getElementById("cbParroquia_empresa").style.borderColor= '';
	}

	if(document.getElementById("sector_empresa").value==''){
		document.getElementById("sector_empresa").style.borderColor= '#DF0101';
		valor=0;
	}else{
		document.getElementById("sector_empresa").style.borderColor= '';
	}

	if(document.getElementById("direccion_empresa").value==''){
		document.getElementById("direccion_empresa").style.borderColor= '#DF0101';
		valor=0;
	}else{
		document.getElementById("direccion_empresa").style.borderColor= '';
	}

	if(document.getElementById("telefono_empresa").value==''){
		document.getElementById("telefono_empresa").style.borderColor= '#DF0101';
		valor=0;
	}else{
		document.getElementById("telefono_empresa").style.borderColor= '';
	}

	if(document.getElementById("email_empresa").value==''){
		document.getElementById("email_empresa").style.borderColor= '#DF0101';
		valor=0;
	}else{
		document.getElementById("email_empresa").style.borderColor= '';
	}

	if(document.getElementById("email_empresa_alternativo").value==''){
		document.getElementById("email_empresa_alternativo").style.borderColor= '#DF0101';
		valor=0;
	}else{
		document.getElementById("email_empresa_alternativo").style.borderColor= '';
	}

	if(document.getElementById("contacto_empresa").value==''){
		document.getElementById("contacto_empresa").style.borderColor= '#DF0101';
		valor=0;
	}else{
		document.getElementById("contacto_empresa").style.borderColor= '';
	}

	if(document.getElementById("cargo_contacto_empresa").value==''){
		document.getElementById("cargo_contacto_empresa").style.borderColor= '#DF0101';
		valor=0;
	}else{
		document.getElementById("cargo_contacto_empresa").style.borderColor= '';
	}

	if(document.getElementById("telefono_persona_contacto").value==''){
		document.getElementById("telefono_persona_contacto").style.borderColor= '#DF0101';
		valor=0;
	}else{
		document.getElementById("telefono_persona_contacto").style.borderColor= '';
	}

	if(document.getElementById("cbredes_sociales").value!='-1'){
		//verifica: si indica que posee redes sociales pero no las a agregado
		if(document.getElementById("cbredes_sociales").value=='1' && existe==2){
			document.getElementById("cbredes_sociales").style.borderColor= '#DF0101';
			valor=2;
		}else{
			//verifica: si indica que no posee redes sociales pero a agregado alguna
			if(document.getElementById("cbredes_sociales").value=='0' && existe==1){
				document.getElementById("cbredes_sociales").style.borderColor= '#DF0101';
				valor=3;
			}else{
				document.getElementById("cbredes_sociales").style.borderColor= '';
			}
		}	
	}


	if(valor==0 || valor==2 || valor==3){
		if(valor==0){
			alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
			return false;
		}
		if(valor==2){
			alert("USTED INDICO QUE POSEE REDE SOCIAL, DEBE AGREGARLA O INDICAR QUE NO POSEE");
			return false;
		}
		if(valor==3){
			alert("USTED INDICO QUE NO POSEE RED SOCIAL, DEBE ELIMINAR LA(S) AGREGADA(S) O INDICAR QUE SI POSEE");
			return false;
		}
	}else{
		return true;
	}	

}	