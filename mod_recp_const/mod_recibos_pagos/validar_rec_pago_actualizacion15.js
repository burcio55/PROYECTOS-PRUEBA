function menu(saction,url){
	$("#loader").show();
		var form = document.frm_rec_pago_actualizacion;
		form.action.value=saction;
		document.frm_rec_pago_actualizacion.url.value=url;
	form.submit();
}

function send(saction){
		if(saction=='guardar'){
			if(validar_formulario()==true){
				$("#loader").show();
				var form = document.frm_rec_pago_actualizacion;
				form.action.value=saction;
				form.submit();
			}
		}
		
}

function validar_formulario(){
	
//VALIDAR CORREO
var chk_direccion1=0;
var valor_direccion1;
var chk_direccion2=0;
var valor_direccion2;
//var chk_direccion3=0;
//var valor_direccion3;
var chk_direccion4=0;
var valor_direccion4; 
var valor=1 ;
var mensaje;
var mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";
var filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;	



		if (!filtro.test(document.getElementById("txt_correoelectronico").value)) {
			document.getElementById("txt_correoelectronico").value="";
		}
		
		if(document.getElementById("cbo_lateralidad").value.length==0){
			document.getElementById("cbo_lateralidad").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("cbo_lateralidad").style.borderColor= '';
		}
		
		if(document.getElementById("cbo_discapacidad").value.length==0){
			document.getElementById("cbo_discapacidad").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("cbo_discapacidad").style.borderColor= '';
		}
		
		if(document.getElementById("cbo_inscripcion_militar").value.length==0){
			document.getElementById("cbo_inscripcion_militar").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("cbo_inscripcion_militar").style.borderColor= '';
		}
		
		if(document.getElementById("txt_telefono_personal").value.length==0){
			document.getElementById("txt_telefono_personal").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("txt_telefono_personal").style.borderColor= '';
		}
		
		if(document.getElementById("txt_telefono_hab").value.length==0){
			document.getElementById("txt_telefono_hab").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("txt_telefono_hab").style.borderColor= '';
		}
		
		if(document.getElementById("txt_telefono_ext").value.length==0){
			document.getElementById("txt_telefono_ext").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("txt_telefono_ext").style.borderColor= '';
		}
		
		if(document.getElementById("txt_correoelectronico").value.length==0){
			document.getElementById("txt_correoelectronico").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("txt_correoelectronico").style.borderColor= '';
		}
		
		if(document.getElementById("txt_direccion1_2").value.length==0){
			document.getElementById("txt_direccion1_2").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("txt_direccion1_2").style.borderColor= '';
		}
		
		if(document.getElementById("txt_direccion2_2").value.length==0){
			document.getElementById("txt_direccion2_2").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("txt_direccion2_2").style.borderColor= '';
		}
		
/*		if(document.getElementById("txt_direccion3_2").value.length==0){
			document.getElementById("txt_direccion3_2").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("txt_direccion3_2").style.borderColor= '';
		}*/
		
		if(document.getElementById("txt_direccion4_2").value.length==0){
			document.getElementById("txt_direccion4_2").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("txt_direccion4_2").style.borderColor= '';
		}
		
		if(document.getElementById("cbo_entidad").value.length==0){
			document.getElementById("cbo_entidad").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("cbo_entidad").style.borderColor= '';
		}
		
		if(document.getElementById("cbo_municipio").value.length==0){
			document.getElementById("cbo_municipio").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("cbo_municipio").style.borderColor= '';
		}
		
		if(document.getElementById("cbo_parroquia").value.length==0){
			document.getElementById("cbo_parroquia").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("cbo_parroquia").style.borderColor= '';
		}
		
		if(document.getElementById("cbo_ciudad").value.length==0){
			document.getElementById("cbo_ciudad").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("cbo_ciudad").style.borderColor= '';
		}
		
		if(document.getElementById("txt_punto_referencia").value.length==0){
			document.getElementById("txt_punto_referencia").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("txt_punto_referencia").style.borderColor= '';
		}
		
		if(document.getElementById("txt_direccion1_2").value.length==0){
			document.getElementById("txt_direccion1_2").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("txt_direccion1_2").style.borderColor= '';
		}
		
		if(document.getElementById("txt_direccion2_2").value.length==0){
			document.getElementById("txt_direccion2_2").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("txt_direccion2_2").style.borderColor= '';
		}
		
/*		if(document.getElementById("txt_direccion3_2").value.length==0){
			document.getElementById("txt_direccion3_2").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("txt_direccion3_2").style.borderColor= '';
		}*/
		
		if(document.getElementById("txt_direccion4_2").value.length==0){
			document.getElementById("txt_direccion4_2").style.borderColor= 'Red';
			valor=0;
		}else{
			document.getElementById("txt_direccion4_2").style.borderColor= '';
		}
		
		
///hasta aqui van todos los inputs del formulario que estoy validando.
	if(valor==0){
		mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS (*). \n";
		alert(mensaje);
		return false;
	}else{
		return true;
	}
	
}






