//version 1.0
// JavaScript Document
//PERMITE SOLO NUMEROS
/*
function isNumberKey(evt){
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57) )
 return false;

 return true;
}	
*/	

function validar_produccion(){
var valor=1 ;

var chk_opt_tipo_sector=0;
var valor_opt_tipo_sector;
for (var i=0;i<document.getElementsByName("opt_tiporeg").length;i++){
	//alert(document.getElementsByName("opt_tiporeg").item(i).value);
	if (document.getElementsByName('opt_tiporeg').item(i).checked){
		chk_opt_tipo_sector=1;
	}else{
		//chk_opt_tipo_sector=0;
	}
}	
//alert(chk_opt_tipo_sector);
if(chk_opt_tipo_sector==1){
	document.getElementById("td_empresatipo5").style.border="";
	document.getElementById("td_empresatipo5").style.borderColor='';

}else{
	document.getElementById("td_empresatipo5").style.border="1px solid";
	document.getElementById("td_empresatipo5").style.borderColor='Red';
	valor=0;	
	
	}

if(document.getElementById("cbo_motor").value.length==0){
document.getElementById("cbo_motor").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("cbo_motor").style.borderColor= '';
}

if(document.getElementById("cbo_sector").value.length==0){
document.getElementById("cbo_sector").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("cbo_sector").style.borderColor= '';
}

//----------------------------------------------------------------------

//if(document.getElementById("cbo_producto").value.length==0){
//document.getElementById("cbo_producto").style.borderColor= 'Red';
//
//$('.custom-combobox-input').css("border","solid 1px red");  
//$('.ui-button').filter(function(index) {
// return index == 0;
//}).css("border","solid 1px red"); 
//
//valor=0;
//}else{
//document.getElementById("cbo_producto").style.borderColor= '';
//$('.custom-combobox-input').css("border","");  
//$('.ui-button').css("border","");
//}

//-----------------------------------------------------------------
if(document.getElementById("valorproducto").value.length==0){
	if(document.getElementById("cbo_producto").value.length==0){
	document.getElementById("cbo_producto").style.borderColor= 'Red';
	
	$('.custom-combobox-input').css("border","solid 1px red");  
	$('.ui-button').filter(function(index) {
	 return index == 0;
	}).css("border","solid 1px red"); 
	
	valor1=0;
	}else{
	document.getElementById("cbo_producto").style.borderColor= '';
	}
}else{
	
	document.getElementById("cbo_producto").style.borderColor= '';
	$('.custom-combobox-input').css("border","");  
	$('.ui-button').css("border","");
	
	if(document.getElementById("nuevo_producto").value.length==0){
	document.getElementById("nuevo_producto").style.borderColor= 'Red';
	valor1=0;
	}else{
	document.getElementById("nuevo_producto").style.borderColor= '';
	}
}

//----------------------------------------------------------------------

if(document.getElementById("valor").value.length==0){
	if(document.getElementById("cbo_medida").value.length==0){
	document.getElementById("cbo_medida").style.borderColor= 'Red';
	valor2=0;
	}else{
	document.getElementById("cbo_medida").style.borderColor= '';
	}
}else{
	
	document.getElementById("cbo_medida").style.borderColor= '';
	
	if(document.getElementById("nueva_medida").value.length==0){
	document.getElementById("nueva_medida").style.borderColor= 'Red';
	valor2=0;
	}else{
	document.getElementById("nueva_medida").style.borderColor= '';
	}
}


if(document.getElementById("produccion_anual").value.length==0){
document.getElementById("produccion_anual").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("produccion_anual").style.borderColor= '';
}

if(document.getElementById("produccion_mensual").value.length==0){
document.getElementById("produccion_mensual").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("produccion_mensual").style.borderColor= '';
}



if(document.getElementById("capacidad_produccion_anual").value.length==0){
document.getElementById("capacidad_produccion_anual").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("capacidad_produccion_anual").style.borderColor= '';
}

if(document.getElementById("cbo_actividadEco").value.length==0){
document.getElementById("cbo_actividadEco").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("cbo_actividadEco").style.borderColor= '';
}




//if(document.getElementById("fecha_production").value.length==0){
//document.getElementById("fecha_production").style.borderColor= 'Red';
//valor=0;
//}else{
//document.getElementById("fecha_production").style.borderColor= '';
//}




if(valor==0){
		alert("DEBE LLENAR LOS CAMPOS REQUERIDOS (*)");
	return false;
}else if(valor==1){
	return true;
}else{
	return false;	
}
}