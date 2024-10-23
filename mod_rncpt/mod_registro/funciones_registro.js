/*--------------------------------*/
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}
function validar_campos(){
var validado=1;	
mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";
if($("#cbo_region").val()==""){
$("#cbo_region").css("border","solid 1px red");
validado=0;
}else{
$("#cbo_region").css("border","");
}
if($("#cbo_entidad").val()==""){
$("#cbo_entidad").css("border","solid 1px red");
validado=0;
}else{
$("#cbo_entidad").css("border","");
}
if($("#cbo_municipio").val()==""){
$("#cbo_municipio").css("border","solid 1px red");
validado=0;
}else{
$("#cbo_municipio").css("border","");
}

if($("#cbo_parroquia").val()==""){
$("#cbo_parroquia").css("border","solid 1px red");
validado=0;
}else{
$("#cbo_parroquia").css("border","");
}

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
if($("#txt_direccion").val()==""){
$("#txt_direccion").css("border","solid 1px red");
validado=0;
}else{
$("#txt_direccion").css("border","");
}



if($("#txt_sucursales").val()==""){
$("#txt_sucursales").css("border","solid 1px red");
validado=0;
}else{
$("#txt_sucursales").css("border","");
}



if($("#cbo_motor").val()==""){
$("#cbo_motor").css("border","solid 1px red");
validado=0;
}else{
$("#cbo_motor").css("border","");
}

var chk_opt_tipo=0;
var valor_opt_tipo;
for (var i=0;i<document.getElementsByName('opt_tiporeg').length;i++){
	if (document.getElementsByName('opt_tiporeg').item(i).checked){
		if(document.getElementsByName("opt_tiporeg").item(i).value==1){
			valor_opt_tipo=1;
		}
		if(document.getElementsByName("opt_tiporeg").item(i).value==2){
			valor_opt_tipo=2;
		}
		if(document.getElementsByName("opt_tiporeg").item(i).value==3){
			valor_opt_tipo=3;
		}
	
	}else{
		chk_opt_tipo=1;
	}
}	
if(chk_opt_tipo==1){
	document.getElementById("td_empresatipo5").style.border="1px solid";
	document.getElementById("td_empresatipo5").style.borderColor='Red';

}else{
	document.getElementById("td_empresatipo5").style.border="";
	document.getElementById("td_empresatipo5").style.borderColor='';

	validado=0;	
	
}

	if(validado==0){
		mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS (*). \n";
		alert(mensaje);
		return false;
	}else{
		return true;
	}
	
}




function consulta_empresa(){

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
			
									if(data==""){
										document.getElementById("cbo_rif1").value='';
										document.getElementById("txt_rif2").value='';
										document.getElementById("cbo_rif1").style.borderColor= 'Red';
										document.getElementById("txt_rif2").style.borderColor= 'Red';
										mensaje+= "- ESTIMADO USUARIO INGRESE UN RIF VALIDO. \n";
										alert(mensaje);
									}else{
										
										var str=data;
										str = str.replace(/[\/\\#,+()$~%.'":*?<>{}]/g, '');
										var n=str.split("|");

										$('#txt_razonsocial').val(n[0]);
										$('#txt_razonsocial_').val(n[0]);
										$('#txt_denominacion').val(n[1]);	
										$('#txt_denominacion_').val(n[1]);	
										//$('#txt_denominacion2').val(n[1]);	
										//$('#txt_denominacion2').val(n[1]);
										$('#txt_direccion').val(n[2]);
										$('#txt_direccion_').val(n[2]);
										//$('#txt_direccion').removeAttr("readonly");
									}
								},
							});

					
				
			
			
	}
}




function estado(){
           $("#cbo_region option:selected").each(function () {
            elegido=$(this).val();
            combo='Estado';
            $.post("/minpptrassi/mod_rncpt/combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
				$("#cbo_entidad").html(data);
			});            
        });
}

function estado_reporte(){
           $("#cbo_region2 option:selected").each(function () {
            elegido=$(this).val();
            combo='Estado';
            $.post("/minpptrassi/mod_rncpt/combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
								$("#cbo_entidad2").html(data);
						});            
        });
}

function municipio(){
           $("#cbo_entidad option:selected").each(function () {
            elegido=$(this).val();
            combo='Municipio';
            $.post("/minpptrassi/mod_rncpt/combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
								$("#cbo_municipio").html(data);
						});            
        });
}

function parroquia(){
           $("#cbo_municipio option:selected").each(function () {
            elegido=$(this).val();
            combo='Parroquia';
            $.post("/minpptrassi/mod_rncpt/combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
								$("#cbo_parroquia").html(data);
						});            
        });
}



function llamar_datatable(){
$('#tblDetalle').dataTable( { 
     "sPaginationType": "full_numbers" 
    } );
$('#tblDetalle').css('width','100%');
}	
function llamar_datatable_productos(){
$('#tblDetalle_prodcutos').dataTable( { 
     "sPaginationType": "full_numbers" 
    } );
$('#tblDetalle').css('width','100%');
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


function registros_empresa(){
	$.ajax({
	type: 'POST',
	url: 'consulta.php',
	data:'opcion='+2,
	success: function(data) {
			var str=data;
			var n=str.split("|");
			$('#empresa_tabla').html(n[0]); 
			if(n[1]==0){
				$('#cant_campos').val('0');	
			}else{
				$('#cant_campos').val(n[1]);	
			}
			llamar_datatable();
		}
		
	});
}

$(document).ready(function() {	
registros_empresa();
});


function ir(id){
  $.ajax({
	type: 'POST',
	url: 'consulta.php',
	data:'id='+id+'&opcion='+3,
	success: function(data) {
			if(data='ir'){
				url="registro_personal.php";
				$(location).attr('href',url);
			}else{
				mensaje= "- EMPRESA INACTIVA. \n";
				alert(mensaje);
			}
		
		}
  });
 }






