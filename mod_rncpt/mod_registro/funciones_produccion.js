$(document).ready(function() {
llamar_datatable();
});

function llamar_datatable(){
$('#tblDetalle').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
        "sPaginationType": "full_numbers" //DAMOS FORMATO A LA PAGINACION(NUMEROS)
    } );
$('#tblDetalle').css('width','100%');
}	


$(document).ready(function(){

if(document.getElementById("valor").value=="1"){
	$("#medida2").hide();
	$("#producto2").hide();
}else{
 $('#medida1').show();
 $('#medida2').hide();
 
 $('#producto1').show();
 $('#producto2').hide();
}


});

function valores_anuales(){//concatena capacidad unidad y producto
if(document.getElementById("produccion_anual").text !=''){
var producto = document.getElementById("cbo_producto");
var producto_seleccionado = producto.options[producto.selectedIndex].text;
//alert(producto_seleccionado);

var medida = document.getElementById("cbo_medida");
var medida_seleccionado = medida.options[medida.selectedIndex].text;
//alert(medida_seleccionado);

var cantidad=document.getElementById("capacidad_produccion_anual").value;

document.getElementById("anual").value= cantidad+" "+medida_seleccionado+" de "+producto_seleccionado ;  
}


}
function valores_mensuales(){//concatena capacidad unidad y producto
if(document.getElementById("produccion_mensual").text !=''){
var producto = document.getElementById("cbo_producto");
var producto_seleccionado = producto.options[producto.selectedIndex].text;
//alert(producto_seleccionado);

var medida = document.getElementById("cbo_medida");
var medida_seleccionado = medida.options[medida.selectedIndex].text;
//alert(medida_seleccionado);

var cantidad=document.getElementById("produccion_mensual").value;

document.getElementById("mensual").value= cantidad+" "+medida_seleccionado+" de "+producto_seleccionado ;
}



}
					

					
function agregar_medida(){
$('#medida1').hide();
$('#medida2').show();
document.getElementById("cbo_medida").value="";
document.getElementById("valorunidadmedida").value="1";
}

function limpiar(){
$('#medida1').show();
$('#medida2').hide();
document.getElementById("nueva_medida").value="";
document.getElementById("valor").value="";

}

function agregar_producto(){
$('#producto1').hide();
$('#producto2').show();
document.getElementById("cbo_producto").value="";
document.getElementById("valorproducto").value="1";

//$('#cbo_producto').focus().val('');
//$('#cbo_producto').autocomplete('close');

//$('.custom-combobox-input').val('');
//$("#cbo_producto").children().remove();
}



function limpiar_producto(){
$('#producto1').show();
$('#producto2').hide();

document.getElementById("nuevo_producto").value="";
document.getElementById("valorproducto").value="";

}




function limpiar_unidad_medida(){
$('#medida1').show();
$('#medida2').hide();
document.getElementById("valorunidadmedida").value="";
document.getElementById("valor").value="";

}


function sector(){
           $("#cbo_motor option:selected").each(function () {
            elegido=$(this).val();
            combo='Sector';
            $.post("../combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
								$("#cbo_sector").html(data);
								
								if(data=='CONSULTAR'){		
									alert('Debe Comunicarse con el Administrador del Sistema');	
									//$("cbo_producto").html(data).load(function(e) {
                                        
                                  //  });;
								}	
						});            
        });
}

function sector_validar(){
if($("#cbo_sector option:selected").text()=='CONSULTAR'){
	document.getElementById("cbo_producto").disabled=true;
	document.getElementById("Continuar").disabled=true
	alert('Debe Comunicarse con el Administrador del Sistema');		
						
}
				
}

function guardar_producto_produccion(){
//ESTE ES EL TEXTO PREVIO
//valorproducto

		
var validado=1 ;

var mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";

if(document.getElementById("valorproducto").value==1){
	if(document.getElementById("nuevo_producto").value.length==0){
	document.getElementById("nuevo_producto").style.borderColor= 'Red';
	validado=0;
	}else{
		document.getElementById("nuevo_producto").style.borderColor= '';
	}
}

	if(validado==0){
			mensaje+= "- DEBE LLENAR EL CAMPO REQUERIDO (*). \n";
			alert(mensaje);
			return false;
		}else{
			$.ajax({
				type: 'POST',
				url: 'guardar_producto_produccion.php',
				data:'nuevo_producto='+document.getElementById("nuevo_producto").value,
				success: function(data) {
					if(data=='existe'){		
						alert('El Producto se encuentra Registrado');			
					}					
					if(data=='guardar'){		
						alert('REGISTRADO EXITOSAMENTE');	
						location.reload();	
						
						
					}
					if(data=='error_guardar'){					
						alert('ERROR AL REALIZAR LA OPERACION');
					}
				//registros_productividad();
				limpiar_producto();	
				}
			});
	}
}




function guardar_unidad_medida_produccion(){
//ESTE ES EL TEXTO PREVIO
//valorproducto

		
var validado=1 ;

var mensaje="ESTIMADO USUARIO DEBE VERIFICAR LAS SIGUIENTES CONDICIONES: \n\n";

if(document.getElementById("valorunidadmedida").value==1){
	if(document.getElementById("nueva_medida").value.length==0){
	document.getElementById("nueva_medida").style.borderColor= 'Red';
	validado=0;
	}else{
		document.getElementById("nueva_medida").style.borderColor= '';
	}
}

	if(validado==0){
			mensaje+= "- DEBE LLENAR EL CAMPO REQUERIDO (*). \n";
			alert(mensaje);
			return false;
		}else{
			$.ajax({
				type: 'POST',
				url: 'guardar_unidad_medida_produccion.php',
				data:'nueva_medida='+document.getElementById("nueva_medida").value,
				success: function(data) {
					if(data=='existe'){		
						alert('El Producto se encuentra Registrado');			
					}					
					if(data=='guardar'){		
						alert('REGISTRADO EXITOSAMENTE');	
						location.reload();		
					}
					if(data=='error_guardar'){					
						alert('ERROR AL REALIZAR LA OPERACION');
					}
				//registros_productividad();
				limpiar_unidad_medida();	
				}
			});
	}
}








/*

	
//-------------------------------------------ACTIVIDAD ECONOMICA PRINCIPAL----------------------------------------//
function recargar_cbo_economica5(){
           $("#cbo_economica5 option:selected").each(function () {
            elegido=$(this).val();
            combo='Actividad';
            $.post("../combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
						data=$.trim(data);
							if(data!="<option value=''>Seleccione</option>"){
								$("#cbo_economica4").html(data);
								//PARA QUE APAREZCA LA PRIMERA OPCION DESPUES DE SELECCIONAR SELECCIONADA 
								$("#cbo_economica4").val($("#cbo_economica4 option:eq(1)").val());	
								//LLAMO A LA OTRA FUNCION PARA RECARGAR AL COMBO DE ABAJO
								recargar_cbo_economica4();		
							}else{
								$("#cbo_economica4").html(data);
								$("#cbo_economica3").html(data);
								$("#cbo_economica2").html(data);
								$("#cbo_economica1").html(data);
							}
            });            
        });}

function recargar_cbo_economica4(){
           $("#cbo_economica4 option:selected").each(function () {
            elegido=$(this).val();
            combo='Actividad';
            $.post("../combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
            //alert(data);
							if(data!="<option value=''>Seleccione</option>"){
								$("#cbo_economica3").html(data);
								$("#cbo_economica3").val($("#cbo_economica3 option:eq(1)").val());	
								recargar_cbo_economica3();					

							}else{
								$("#cbo_economica3").html(data);
								$("#cbo_economica2").html(data);
								$("#cbo_economica1").html(data);
							}
            });            
        });
}

function recargar_cbo_economica3(){
           $("#cbo_economica3 option:selected").each(function () {
            elegido=$(this).val();
            combo='Actividad';
            $.post("../combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
							if(data!="<option value=''>Seleccione</option>"){
								$("#cbo_economica2").html(data);
								$("#cbo_economica2").val($("#cbo_economica2 option:eq(1)").val());	
								recargar_cbo_economica2();
							}else{
								$("#cbo_economica2").html(data);
								$("#cbo_economica1").html(data);
							}
            });            
        });
	
}

function recargar_cbo_economica2(){
           $("#cbo_economica2 option:selected").each(function () {
            elegido=$(this).val();
            combo='Actividad';
            $.post("../combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
							if(data!="<option value=''>Seleccione</option>"){
								$("#cbo_economica1").html(data);
								$("#cbo_economica1").val($("#cbo_economica1 option:eq(1)").val());	
							}else{
								$("#cbo_economica1").html(data);
							}
            });            
        });
}


$(document).ready(function(){
   $("#cbo_economica5").change(function () {
           $("#cbo_economica5 option:selected").each(function () {
            elegido=$(this).val();
            combo='Actividad';
            $.post("../combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
						data=$.trim(data);
							if(data!="<option value=''>Seleccione</option>"){
								$("#cbo_economica4").html(data);
							}else{
								$("#cbo_economica4").html(data);
								$("#cbo_economica3").html(data);
								$("#cbo_economica2").html(data);
								$("#cbo_economica1").html(data);
							}
            });            
        });
   })
});
$(document).ready(function(){
   $("#cbo_economica4").change(function () {
           $("#cbo_economica4 option:selected").each(function () {
            elegido=$(this).val();
            combo='Actividad';
            $.post("../combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
            //alert(data);
							if(data!="<option value=''>Seleccione</option>"){
								$("#cbo_economica3").html(data);
							}else{
								$("#cbo_economica3").html(data);
								$("#cbo_economica2").html(data);
								$("#cbo_economica1").html(data);
							}
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbo_economica3").change(function () {
           $("#cbo_economica3 option:selected").each(function () {
            elegido=$(this).val();
            combo='Actividad';
            $.post("../combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
							if(data!="<option value=''>Seleccione</option>"){
								$("#cbo_economica2").html(data);
							}else{
								$("#cbo_economica2").html(data);
								$("#cbo_economica1").html(data);
							}
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbo_economica2").change(function () {
           $("#cbo_economica2 option:selected").each(function () {
            elegido=$(this).val();
            combo='Actividad';
            $.post("../combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
							if(data!="<option value=''>Seleccione</option>"){
								$("#cbo_economica1").html(data);
							}else{
								$("#cbo_economica1").html(data);
							}
            });            
        });
   })
});*/
//-----------------------------------------------------------------------------------------------------------------------------------------------//
