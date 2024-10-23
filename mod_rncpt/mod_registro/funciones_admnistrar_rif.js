/*--------------------------------*/

function validar_campos(){
var validado=1;	
mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";

if($("#cbo_rif1").val()==""){
$("#cbo_rif1").css("border","solid 1px red");
validado=0;
}else{
$("#cbo_rif1").css("border","");
}
if($("#cbo_rif1").val()==""){
$("#cbo_rif1").css("border","solid 1px red");
validado=0;
}else{
$("#cbo_rif1").css("border","");
}
if($("#txt_rif2").val()==""){
$("#txt_rif2").css("border","solid 1px red");
validado=0;
}else{
$("#txt_rif2").css("border","");
}
if($("#txt_razonsocial").val()==""){
$("#txt_razonsocial").css("border","solid 1px red");
validado=0;
}else{
$("#txt_razonsocial").css("border","");
}
if($("#txt_denominacion").val()==""){
$("#txt_denominacion").css("border","solid 1px red");
validado=0;
}else{
$("#txt_denominacion").css("border","");
}

if(validado==0){
		mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS (*). \n";
		alert(mensaje);
		return false;
	}else{
		return true;
	}
	
}




function consulta_rif(){

var validado=1 ;
var rif_empresa;

var mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";

if(document.getElementById("cbo_rif1").value.length==0){
document.getElementById("cbo_rif1").style.borderColor= 'Red';
validado=0;
}else{
	document.getElementById("cbo_rif1").style.borderColor= '';
}
if(document.getElementById("txt_rif2").value.length==0){
document.getElementById("txt_rif2").style.borderColor= 'Red';
validado=0;
}else{
	document.getElementById("txt_rif2").style.borderColor= '';
}

	if(validado==0){
			mensaje+= "- DEBE LLENAR EL CAMPO REQUERIDO (*). \n";
			alert(mensaje);
			return false;
		}else{
			rif_empresa=$("#cbo_rif1").val()+$("#txt_rif2").val();
			$.ajax({
			type: 'POST',
			url: 'consulta.php',
			data: 'opcion='+1+'&rif='+rif_empresa,
			success: function(data) {
					data=data.trim();
					if(data=="seniat"){
							$.ajax({
							type: 'POST',
							url: 'cliente_seniat_local_actualizar.php',
							data: 'rif='+rif_empresa,
							async: false, 
							success: function(data) {
									data=data.trim();
									if(data!="seniat"){
											var str=data;
											var n=str.split("|"); 
											$('#txt_razonsocial').val(n[0]);
											$('#txt_denominacion').val(n[1]);	
									}else{
										var str=data;
										var n=str.split("|");
										$('#txt_razonsocial').val(n[0]);
										$('#txt_denominacion').val(n[1]);	
									}
								},
							});
					}else{
							var str=data;
							var n=str.split("|"); 
							$('#txt_razonsocial').val(n[0]);
							$('#txt_denominacion').val(n[1]);	
					}
				},
			});
			
	}
}

