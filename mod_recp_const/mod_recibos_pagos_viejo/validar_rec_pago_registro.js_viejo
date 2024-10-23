$(document).ready(function () {//la primera carta
			$("#editar").hide(); //oculto
			$("#guardar").show(); //mostrar	
											
});	

function validar_recibo_pago_ano_actual(){
var valor=1 ;
var mensaje;
var mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";


if(document.getElementById("mes").value.length==0){
	document.getElementById("mes").style.borderColor= 'Red';
	valor=0;
}else{
	document.getElementById("mes").style.borderColor= '';
}

if(document.getElementById("txt_codigo_tipos_trabajadores").value!='05'){
if(document.getElementById("quincena").value.length==0){
	document.getElementById("quincena").style.borderColor= 'Red';
	valor=0;
}else{
	document.getElementById("quincena").style.borderColor= '';
}
}
else{
	if(document.getElementById("semana").value.length==0){
	document.getElementById("semana").style.borderColor= 'Red';
	valor=0;
}else{
	document.getElementById("semana").style.borderColor= '';
}
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

function validar_recibo_pago_ano_anteriores(){
var valor=1 ;
var mensaje;
var mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";

if(document.getElementById("anio").value.length==0){
	document.getElementById("anio").style.borderColor= 'Red';
	valor=0;
}else{
	document.getElementById("anio").style.borderColor= '';
}

if(document.getElementById("mes").value.length==0){
	document.getElementById("mes").style.borderColor= 'Red';
	valor=0;
}else{
	document.getElementById("mes").style.borderColor= '';
}

if(document.getElementById("txt_codigo_tipos_trabajadores").value!='05'){
if(document.getElementById("quincena").value.length==0){
	document.getElementById("quincena").style.borderColor= 'Red';
	valor=0;
}else{
	document.getElementById("quincena").style.borderColor= '';
}
}
else{
	if(document.getElementById("semana").value.length==0){
	document.getElementById("semana").style.borderColor= 'Red';
	valor=0;
}else{
	document.getElementById("semana").style.borderColor= '';
}
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

function validar_tbtickets_alimentacion(){
var valor=1 ;
var mensaje;
var mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";

if(document.getElementById("mes_vigencia").value.length==0){
	document.getElementById("mes_vigencia").style.borderColor= 'Red';
	valor=0;
}else{
	document.getElementById("mes_vigencia").style.borderColor= '';
}

if(document.getElementById("txt_monto_unidad").value.length==0){
document.getElementById("txt_monto_unidad").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("txt_monto_unidad").style.borderColor= '';
}

if(document.getElementById("txt_porcentaje").value.length==0){
document.getElementById("txt_porcentaje").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("txt_porcentaje").style.borderColor= '';
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

function validar_tbcargos(){
var valor=1 ;
var mensaje;
var mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";


if(document.getElementById("txt_codigo").value.length==0){
document.getElementById("txt_codigo").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("txt_codigo").style.borderColor= '';
}

if(document.getElementById("txt_nombre_cargo").value.length==0){
	document.getElementById("txt_nombre_cargo").style.borderColor= 'Red';
	valor=0;
}else{
	document.getElementById("txt_nombre_cargo").style.borderColor= '';
}

if(document.getElementById("txt_grado").value.length==0){
document.getElementById("txt_grado").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("txt_grado").style.borderColor= '';
}

if(document.getElementById("txt_tipo_cargo").value.length==0){
document.getElementById("txt_tipo_cargo").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("txt_tipo_cargo").style.borderColor= '';
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
									
function inhabilitar_editar(opcion,valor){
	$("#guardar").hide();
	$("#editar").hide();
	
$.ajax({
	type: 'POST',
	url: 'funciones.php',
	data: 'codigo='+valor+'&opcion='+opcion,
	success: function(data){
		if(data=='actualizado'){
			
		  location.reload();
			}else{
						var str=data;
						var n=str.split("|");
						if(n!=''){ 
									document.getElementById("txt_nombre_cargo").value=n[0];
									document.getElementById("txt_codigo").value=n[1];
									document.getElementById("txt_grado").value=n[2];
									document.getElementById("txt_tipo_cargo").value=n[3];
									$("#guardar").hide();
									$("#editar").show();
						}
					
									
						}
	}
	
	});		
}

function inhabilitar_editar_tick(opcion,valor,nulo){
	$("#guardar").hide();
	$("#editar").hide();
	
$.ajax({
	type: 'POST',
	url: 'funciones_tick.php',
	data: 'codigo='+valor+'&opcion='+opcion,
	success: function(data){
if(data=='actualizado'){
location.reload();
}else if(data=='error_guarda'){
if(opcion==1){valor = 'INHABILITAR'} 
if(opcion==3){valor = 'HABILITAR'} 
var mensaje="ESTIMADO USUARIO NO SE HA PODIDO  "+valor+"  EL REGISTRO";
alert(mensaje);
}
else {
if (nulo==1){
var str=data;
var n=str.split("|");  
if(n!=''){ 
alert(n[4]);
document.getElementById("txt_monto_unidad").value=n[0];
document.getElementById("mes_vigencia").value=n[3];
document.getElementById("txt_monto_cancelar").value=n[1];
document.getElementById("txt_porcentaje").value=n[2];
document.getElementById("txt_codigo").value=n[4];
$("#guardar").hide();
$("#editar").show();
}

}else {
var mensaje="EL REGISTRO SE ENCUENTA INHABILITADO POR LO QUE NO SE PUEDE EDITAR";
alert(mensaje);
}

}
	}
});		
}

function validar_tbconceptos(){
var valor=1 ;
var mensaje;
var mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";

if(document.getElementById("txt_nombre_concepto").value.length==0){
	document.getElementById("txt_nombre_concepto").style.borderColor= 'Red';
	valor=0;
}else{
	document.getElementById("txt_nombre_concepto").style.borderColor= '';
}

if(document.getElementById("cbo_tipo").value.length==0){
document.getElementById("cbo_tipo").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("cbo_tipo").style.borderColor= '';
}

if(document.getElementById("cbo_categoria").value.length==0){
document.getElementById("cbo_categoria").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("cbo_categoria").style.borderColor= '';
}

if(document.getElementById("cbo_condicion").value.length==0){
document.getElementById("cbo_condicion").style.borderColor= 'Red';
valor=0;
}else{
document.getElementById("cbo_condicion").style.borderColor= '';
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
