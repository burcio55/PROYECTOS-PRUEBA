$(document).ready(function() {

	$.fn.eventos();
	
});

/****** EVENTOS *******/

$.fn.eventos = function(){

	
	$('.btn_baporte').unbind();
	$('.btn_baporte').click(function(){
		//alert("checked");
			var valor = $(this).val();
			if(valor == '1'){
				$("#td_baporte").show();
			}
			if(valor == '2'){
				$("#td_baporte").hide();
				//$("#td_binventiva").hide();
			}
    });
	$('.btn_binventiva').unbind();
	$('.btn_binventiva').click(function(){
		//alert("checked");
			var valor = $(this).val();
			if(valor == '1'){
				$("#td_binventiva").show(); 
				$("#txt_req_inventiva_value").show();
				$("#td_req_binventiva").show();
			}
			if(valor == '2'){
				$("#td_binventiva").hide();
				$("#txt_req_inventiva_value").hide();
				$("#td_req_binventiva").hide();
			}
    });

		
}


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
if($("#txt_raas").val()==""){
$("#txt_raas").css("border","solid 1px red");
validado=0;
}else{
$("#txt_raas").css("border","");
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
if($("#txt_direccion2").val()==""){
$("#txt_direccion2").css("border","solid 1px red");
validado=0;
}else{
$("#txt_direccion2").css("border","");
}
if($("#txt_trabajadores").val()==""){
$("#txt_trabajadores").css("border","solid 1px red");
validado=0;
}else{
$("#txt_trabajadores").css("border","");
}

if($("#txt_nro1").val()==""){
$("#txt_nro1").css("border","solid 1px red");
validado=0;
}else{
$("#txt_nro1").css("border","");
}

if($("#txt_nro2").val()==""){
$("#txt_nro2").css("border","solid 1px red");
validado=0;
}else{
$("#txt_nro2").css("border","");
}

if($("#txt_nro3").val()==""){
$("#txt_nro3").css("border","solid 1px red");
validado=0;
}else{
$("#txt_nro3").css("border","");
}

/*if($("#txt_nro_boleta").val()==""){
$("#txt_nro_boleta").css("border","solid 1px red");
validado=0;
}else{
$("#txt_nro_boleta").css("border","");
}*/


/*if($("#txt_sucursales").val()==""){
$("#txt_sucursales").css("border","solid 1px red");
validado=0;
}else{
$("#txt_sucursales").css("border","");
}*/



	var chk_opt_junta=0;
	var valor_opt_junta;
	for (var i=0;i<document.getElementsByName('opt_empresatipo').length;i++){
		if (document.getElementsByName('opt_empresatipo').item(i).checked){
			if(document.getElementsByName("opt_empresatipo").item(i).value==1){
				valor_opt_junta=1;
			}else{
				valor_opt_junta=2;
			}
		chk_opt_junta=1;
		}else{
		}
	}	
	if(chk_opt_junta==1){
		document.getElementById("td_empresatipo").style.border="";
		document.getElementById("td_empresatipo").style.borderColor='';

	}else{
		document.getElementById("td_empresatipo").style.border="1px solid";
		document.getElementById("td_empresatipo").style.borderColor='Red';
		validado=0;	
		
	}
	//<<<<<<<<<<<<Aportes
	var chk_opt_aporte=0;
	var valor_opt_aporte;
	for (var i=0;i<document.getElementsByName('opt_baporte').length;i++){
		if (document.getElementsByName('opt_baporte').item(i).checked){
			if(document.getElementsByName("opt_baporte").item(i).value==1){
				valor_opt_aporte=1;

				if($("#txt_aporte").val()==""){

					$("#txt_aporte").css("border","solid 1px red");
					validado=0;
		
				}else{
		
					$("#txt_aporte").css("border","");
					
				}
			}else{
				valor_opt_aporte=2;
			}
			chk_opt_aporte=1;
		}else{
		}
	}	
	if(chk_opt_aporte==1){
		document.getElementById("td_baporte_value").style.border="";
		document.getElementById("td_baporte_value").style.borderColor='';

		$("#td_baporte").show();

		
	}else{
		document.getElementById("td_baporte_value").style.border="1px solid";
		document.getElementById("td_baporte_value").style.borderColor='Red';
		validado=0;	
		$("#td_baporte").hide();
		$("#txt_aporte").css("border","");
		
	}
	

	//<<<<<<<<<<<<Inventiva
	var chk_opt_binventiva=0;
	var valor_opt_binventiva;
	for (var i=0;i<document.getElementsByName('opt_binventiva').length;i++){
		if (document.getElementsByName('opt_binventiva').item(i).checked){
			if(document.getElementsByName("opt_binventiva").item(i).value==1){
				
				valor_opt_binventiva=1;

				if($("#txt_binventiva").val()==""){

					$("#txt_binventiva").css("border","solid 1px red");
					validado=0;
		
				}else{
		
					$("#txt_binventiva").css("border","");
		
				}
				
				if($("#txt_req_inventiva").val()==""){
		
					$("#txt_req_inventiva").css("border","solid 1px red");
					validado=0;
		
				}else{
		
					$("#txt_req_inventiva").css("border","");
		
				}
			}else{
				valor_opt_binventiva=2;
			}
			chk_opt_binventiva=1;
		}else{
		}
	}	
	if(chk_opt_binventiva==1){
		document.getElementById("td_binventiva_value").style.border="";
		document.getElementById("td_binventiva_value").style.borderColor='';

		$("#td_binventiva").show();

		

	}else{
		document.getElementById("td_binventiva_value").style.border="1px solid";
		document.getElementById("td_binventiva_value").style.borderColor='Red';
		validado=0;	
		$("#td_binventiva").hide();
		
	}



	if(validado==0){
		mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS (*). \n";
		alert(mensaje);
		return false;
	}else{
		return true;
	}
	
}

function validar_campos_buscar(){
var validado=1;	
mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";


if($("#txt_nro11").val()==""){
$("#txt_nro11").css("border","solid 1px red");
validado=0;
}else{
$("#txt_nro11").css("border","");
}

if($("#txt_nro22").val()==""){
$("#txt_nro22").css("border","solid 1px red");
validado=0;
}else{
$("#txt_nro22").css("border","");
}

if($("#txt_nro33").val()==""){
$("#txt_nro33").css("border","solid 1px red");
validado=0;
}else{
$("#txt_nro33").css("border","");
}
if(validado==0){
		mensaje+= "- DEBE LLENAR LOS CAMPOS REQUERIDOS (*). \n";
		alert(mensaje);
		return false;
	}else{
		return true;
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
function eliminar(id){

	$.ajax({
	type: 'POST',
	url: 'eliminar_cpt.php',
	data: 'id='+id,
	success: function(data){
		alert(data);
		if(data=='1'){	
				alert('El REGISTRO CPT FUE ELIMINADO EXITOSAMENTE');	
		}
	}
		
	});		
}



/*

//$("#td_baporte").hide();
	//$("#td_binventiva").hide();
	//$("#txt_req_inventiva_value").hide();
	//$("#td_req_binventiva").hide();
	*/



