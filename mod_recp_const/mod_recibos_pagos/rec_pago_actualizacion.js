function mayusculas(e) {
    e.value = e.value.toUpperCase();
}
function minusculas(e) {
    e.value = e.value.toLowerCase();
}
/*VALIDAR FECHA*/


$(document).ready(function(){
if(document.getElementById('cbo_discapacidad').value!='1')
{
     $("#cbo_tipo_discapacidad").attr('disabled','disabled')
     $("#cbo_grado_discapacidad").attr('disabled','disabled')
}
else
{
     $("#cbo_tipo_discapacidad").removeAttr('disabled')
     $("#cbo_grado_discapacidad").removeAttr('disabled')
}
$("#txt_conapdis").attr('disabled','disabled')

	function validarFormatoFecha(campo) {
	      //var RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
	      var RegExPattern = /^\d{1,2}\-\d{1,2}\-\d{2,4}$/;
	      if ((campo.match(RegExPattern)) && (campo!='')) {
	            return true;
	      } else {
	            return false;
	      }
	}

	$("#fechana").blur(function(){	
		var fecha = $(this).val();
		if(validarFormatoFecha(fecha)){
		      if(existeFecha(fecha)){
		            //alert("La fecha introducida es correcta.");
		      }else{
		            alert("La fecha introducida no existe.");
		      }
		}else{
		      alert("El formato de la fecha es incorrecto, el formato correcto es 00-00-0000.");
		}

	}); 


	function existeFecha(fecha){
	      var fechaf = fecha.split("/");
	      var day = fechaf[0];
	      var month = fechaf[1];
	      var year = fechaf[2];
	      var date = new Date(year,month,'0');
	      if((day-0)>(date.getDate()-0)){
	            return false;
	      }
	      return true;
	}
	
	$("#buscar").hide();
	//$('#Boton_editar').hide();

}); 

function buscar_exis(){
$("#buscar").show();
	//alert(id); 
	
	//$('#Boton_agregar').hide();//-----OCULTO-----
	//$('#Boton_editar').show();//-----MUESTRO-----
	//document.getElementById("certificado_nac").reset();	
	$.ajax({
		url:'ajax_registro.php?certificado_nac='+$('#certificado_nac').val()+'&accion='+6,
		dataType: 'json',
		success:function(data){
			if(data.response == '1'){

			//document.getElementById("certificado_nac").value = data.certificado_nac;  
			 alert("El Beneficiario/Asegurado ya se encuentra registrado.");
			
			}else{
			
			document.getElementById("cedulaconsulta").value = "";
			document.getElementById('primer_apellido').value = "";
			document.getElementById('segundo_apellido').value = "";
			document.getElementById('primer_nombre').value = "";
			document.getElementById('segundo_nombre').value = "";
			document.getElementById('sexo2').value = "";
			document.getElementById('fechanac').value = "";	
			document.getElementById('cbo_parentesco').value = "";
			document.getElementById('cbo_lateralidad').value = "";
			
			document.getElementById('cbo_discapacitado').value = "";
			document.getElementById('txt_conapdis').value = "";
			document.getElementById('cbo_discapacidad').value = "";
			document.getElementById('cbo_grado_discapacidad').value = "";	
			document.getElementById("cbo_adopcion").value ="";
			document.getElementById("txt_registro_tribunal").value ="";
			document.getElementById("cbo_alergias").value ="";


			document.getElementById('codigo1').value = "";
			document.getElementById('codigo2').value = "";
			document.getElementById('telefono1').value = "";
			document.getElementById('telefono2').value = "";
			document.getElementById("txt_correoelectronico1").value ="";
			document.getElementById("txt_correoelectronico2").value ="";
			
			document.getElementById('primer_apellido').disabled = false;
			document.getElementById('segundo_apellido').disabled = false;
			document.getElementById('primer_nombre').disabled = false;
			document.getElementById('segundo_nombre').disabled = false;
			document.getElementById('sexo2').disabled = false;
			document.getElementById('fechanac').disabled = false;
			document.getElementById('estado_civil').disabled = false;
			}
			quitar_bordes_rojos();
		}
	})
}


function buscar_existe_institucion(){
	var cedula = document.getElementById("cedulaconsulta").value;
	var nacionalidad = document.getElementById("nacionalidad").value;

	$.ajax({
		url:'ajax_registro.php?cedula='+ cedula  + '&nacionalidad='+ nacionalidad +'&accion=7',
		dataType: 'json',
		success:function(data){
			if(data.response == '1'){

			//document.getElementById("certificado_nac").value = data.certificado_nac;  
			 alert("El Beneficiario/Asegurado trabaja en la institucion.");						
					$('#Boton_agregar').hide();			
			}
		}
	})
}





$(document).ready(function(){
	document.getElementById('primer_apellido').disabled = true;
	document.getElementById('segundo_apellido').disabled = true;
	document.getElementById('primer_nombre').disabled = true;
	document.getElementById('segundo_nombre').disabled = true;
	document.getElementById('sexo2').disabled = true;
	document.getElementById('fechanac').disabled = true;
	document.getElementById('txt_conapdis').disabled = true;
	document.getElementById('cbo_discapacidad').disabled = true;
	document.getElementById('cbo_grado_discapacidad').disabled = true;		
	$('#concedula').hide();//-----OCULTO-----
	$('#sincedula').hide();//-----OCULTO-----
	$('#sexoletra').show();//-----MUESTRO-----
	$('#sexocombo').hide();//-----OCULTO-----
	$('#etiqueta_adopcion').hide();//-----OCULTO-----
	$('#combo_adopcion').hide();//-----OCULTO-----combo_adopcion
	
	load();
});

function load(){
	$.ajax({
		url:'ajax_registro.php?accion=1',
		 beforeSend: function(objeto){
	  },
		success:function(datatable){
			$(".outer_div").html(datatable).fadeIn('slow');			
		}
	})
}

function tienecedula(){


	var condicion = document.getElementById("condicion").value;
	var cedulasession = document.getElementById("cedulasession").value;
	
		if(condicion == ""){
			
			document.getElementById('primer_apellido').value = "";
			document.getElementById('segundo_apellido').value = "";
			document.getElementById('primer_nombre').value = "";
			document.getElementById('segundo_nombre').value = "";
			document.getElementById('sexo2').value = "";
			document.getElementById('fechanac').value = "";
			
			document.getElementById("certificado_nac").value = "";

			/*document.getElementById('nacionalidad').disabled = false;*/
			document.getElementById('primer_apellido').disabled = true;
			document.getElementById('segundo_apellido').disabled = true;
			document.getElementById('primer_nombre').disabled = true;
			document.getElementById('segundo_nombre').disabled = true;
			document.getElementById('sexo2').disabled = true;
			document.getElementById('fechanac').disabled = true;
			$('#concedula').hide();//-----OCULTO-----
			$('#sincedula').hide();//-----OCULTO-----
			$('#sexoletra').show();//-----MUESTRO-----
			$('#sexocombo').hide();//-----OCULTO-----
			$("#etiqueta_adopcion").hide();//-----OCULTO-----
			$("#combo_adopcion").hide();//-----OCULTO-----
			$("#buscar").hide();//-----OCULTO-----
		}
		if(condicion == 1){ // tien cedula
			document.getElementById("certificado_nac").value = "";
			/*document.getElementById('nacionalidad').disabled = false;*/

			document.getElementById('primer_apellido').disabled = true;
			document.getElementById('segundo_apellido').disabled = true;
			document.getElementById('primer_nombre').disabled = true;
			document.getElementById('segundo_nombre').disabled = true;
			document.getElementById('sexo2').disabled = true;
			document.getElementById('fechanac').disabled = true;
			document.getElementById('estado_civil').disabled = false;
			
			document.getElementById('cbo_parentesco').value = "";
			document.getElementById('cbo_lateralidad').value = "";
			document.getElementById('cbo_discapacitado').value = "";
			document.getElementById('txt_conapdis').value = "";
			document.getElementById('cbo_discapacidad').value = "";
			document.getElementById('cbo_grado_discapacidad').value = "";			
		
			
			document.getElementById('txt_observacion').value = "";
			document.getElementById('codigo1').value = "";
			document.getElementById('codigo2').value = "";
			document.getElementById('telefono1').value = "";
			document.getElementById('telefono2').value = "";
			document.getElementById('txt_correoelectronico1').value = "";
			document.getElementById('txt_correoelectronico2').value = "";
			
			$('#concedula').show();//-----MUESTRO-----
			$('#sincedula').hide();//-----OCULTO-----
			$('#sexoletra').show();//-----MUESTRO-----
			$('#sexocombo').hide();//-----OCULTO-----
			$("#etiqueta_adopcion").hide();//-----OCULTO-----
			$("#combo_adopcion").hide();//-----OCULTO-----
			$("#buscar").show();//-----OCULTO-----
		}
		if(condicion == 2){//no tiebe cedula
			document.getElementById("cedulaconsulta").value = "";
			
			document.getElementById('primer_apellido').value = "";
			document.getElementById('segundo_apellido').value = "";
			document.getElementById('primer_nombre').value = "";
			document.getElementById('segundo_nombre').value = "";
			document.getElementById('sexo2').value = "";
			document.getElementById('fechanac').value = "";	
			document.getElementById('cbo_discapacitado').value = "";
			document.getElementById('txt_conapdis').value = "";
			document.getElementById('cbo_discapacidad').value = "";
			document.getElementById('cbo_grado_discapacidad').value = "";	
			document.getElementById('cbo_adopcion').value = "";
			document.getElementById('txt_registro_tribunal').value = "";		
			
			document.getElementById('primer_apellido').disabled = false;
			document.getElementById('segundo_apellido').disabled = false;
			document.getElementById('primer_nombre').disabled = false;
			document.getElementById('segundo_nombre').disabled = false;
			document.getElementById('sexo2').disabled = false;
			document.getElementById('fechanac').disabled = false;
			document.getElementById('estado_civil').disabled = false;

			$('#sincedula').show();//-----MUESTRO-----
			$('#concedula').hide();//-----OCULTO-----
			$('#sexoletra').hide();//-----OCULTO-----
			$('#sexocombo').show();//-----MUESTRO-----
			$("#etiqueta_adopcion").show();//-----MUESTRO-----
			$("#combo_adopcion").show();//-----MUESTRO-----
			$("#buscar").show();//-----MUESTRO-----

		}


}
function tienediscapacidad()
{
	let cbo_discapacidad = document.getElementById("cbo_discapacidad").value;
     //alert($('#cbo_discapacidad').val());
     //alert(typeof(document.getElementById('cbo_tipo_discapacidad').value))
	
		if(cbo_discapacidad===''){
			
			document.getElementById('txt_conapdis').value = "";
			document.getElementById('cbo_tipo_discapacidad').value = "";
			document.getElementById('cbo_grado_discapacidad').value = "";
						
			document.getElementById('txt_conapdis').disabled = true;
			document.getElementById('cbo_tipo_discapacidad').disabled = true;
			document.getElementById('cbo_grado_discapacidad').disabled = true;	
			
		}
		//if(document.getElementById('cbo_discapacidad').value==='1'){
		if(cbo_discapacidad==='1'){
			
			document.getElementById('txt_conapdis').value = "";
			document.getElementById('cbo_tipo_discapacidad').value = "";
			document.getElementById('cbo_grado_discapacidad').value = "";
			
			document.getElementById('txt_conapdis').disabled = false;
			//////$("#cbo_tipo_discapacidad").removeAttr('disabled')
			//////$("#cbo_grado_discapacidad").removeAttr('disabled')
			document.getElementById('cbo_tipo_discapacidad').disabled = false;
			document.getElementById('cbo_grado_discapacidad').disabled = false;	
			/*
			$("#cbo_tipo_discapacidad").removeAttr('disabled')
            $("#cbo_grado_discapacidad").attr('disabled')
            $("#txt_conapdis").attr('disabled')
			*/
		
		}
		if(cbo_discapacidad==='2'){
			document.getElementById('txt_conapdis').value = "";
			document.getElementById('cbo_tipo_discapacidad').value = "";
			document.getElementById('cbo_grado_discapacidad').value = "";
			
			document.getElementById('txt_conapdis').disabled = true;
			document.getElementById('cbo_tipo_discapacidad').disabled = true;
			document.getElementById('cbo_grado_discapacidad').disabled = true;					
			
		}


}
function tieneadopcion(){


	var cbo_adopcion = document.getElementById("cbo_adopcion").value;
//alert(cbo_adopcion);
	
		if(cbo_adopcion == ""){			
			document.getElementById('txt_registro_tribunal').value = "";
			document.getElementById('txt_registro_tribunal').disabled = true;	
			
		}
		if(cbo_adopcion == "1"){			
			document.getElementById('txt_registro_tribunal').value = "";			
			document.getElementById('txt_registro_tribunal').disabled = false;	
		
		}
		if(cbo_adopcion == "2"){
			document.getElementById('txt_registro_tribunal').value = "";			
			document.getElementById('txt_registro_tribunal').disabled = true;	
		}


}
function identificaciudadano() { //---Por Cedula--- 
$("#buscar").show();
$("#Boton_agregar").show();
$("#Boton_editar").hide();
	var cedula = document.getElementById("cedulaconsulta").value;
	var nacionalidad = document.getElementById("nacionalidad").value;
	if(cedula != ''){
		//MENSAJE QUE INDQUE ESPERA MIENTRAS BUSCA
			$.ajax({ 
			data: {"cedula":+cedula,"nacionalidad":+nacionalidad},
			url: "/minpptrassi/web_server/identifica_ciudadano.php",
			type: "POST",
			dataType: 'json',
			cache: false,
			success: 
				function(data){
					if(data.response == 'success'){
						//var apellidonombre = document.getElementById("apellidonombre").innerHTML = data.apellidonombre;
						//document.getElementById("apellidonombre").value = apellidonombre;
										
						var cedulaidentida = document.getElementById("cedulaidentida").innerHTML = data.cedulaidentida;
						document.getElementById("cedulaidentida").value = cedulaidentida;
										
						var primer_nombre = document.getElementById("primer_nombre").innerHTML = data.primer_nombre;
						document.getElementById("primer_nombre").value = primer_nombre;
							
						var segundo_nombre = document.getElementById("segundo_nombre").innerHTML = data.segundo_nombre;
						document.getElementById("segundo_nombre").value = segundo_nombre;
							
						var primer_apellido = document.getElementById("primer_apellido").innerHTML = data.primer_apellido;
						document.getElementById("primer_apellido").value = primer_apellido;
							
						var segundo_apellido = document.getElementById("segundo_apellido").innerHTML = data.segundo_apellido;
						document.getElementById("segundo_apellido").value = segundo_apellido;
						
						var sexo = document.getElementById("sexo").innerHTML = data.sexo;
						document.getElementById("sexo").value = sexo;
						
						var fechanac = document.getElementById("fechanac").innerHTML = data.fechanac;
						document.getElementById("fechanac").value = fechanac;

						
						if (data.sexo == 1){
							var sexo2 = 'MASCULINO';
							}
						if (data.sexo == 2){
							var sexo2 = 'FEMENINO';
							}
						document.getElementById("sexo2").value = sexo2;						
						quitar_bordes_rojos();
					}else{//	//no SUCCESS
						alert(data.mensaje);
						
						document.getElementById('primer_apellido').value = "";
						document.getElementById('segundo_apellido').value = "";
						document.getElementById('primer_nombre').value = "";
						document.getElementById('segundo_nombre').value = "";
						
						document.getElementById('sexo2').value = "";
						document.getElementById('fechanac').value = "";	
						document.getElementById('certificado_nac').value ="";
						document.getElementById('primer_apellido').value ="";
						document.getElementById('segundo_apellido').value ="";
						document.getElementById('primer_nombre').value ="";
						document.getElementById('segundo_nombre').value ="";
						
						document.getElementById('fechanac').value ="";
						document.getElementById("estado_civil").value ="";
						document.getElementById("cbo_parentesco").value ="";
						
						document.getElementById("codigo1").value ="";
						document.getElementById("telefono1").value ="";
						document.getElementById("codigo2").value ="";
						document.getElementById("telefono2").value ="";
						document.getElementById("txt_correoelectronico").value ="";
						document.getElementById("cbo_lateralidad").value ="";
						document.getElementById("cbo_discapacitado").value ="";
						document.getElementById('txt_conapdis').value ="";
						document.getElementById('cbo_discapacidad').value ="";
						document.getElementById('cbo_grado_discapacidad').value ="";
						document.getElementById("txt_observacion").value ="";
						
						document.getElementById("cbo_adopcion").value ="";
						document.getElementById("txt_registro_tribunal").value ="";
						document.getElementById("cbo_alergias").value ="";
						document.getElementById("txt_tipo_alergias").value ="";
						document.getElementById('codigo1').value = "";
						document.getElementById('codigo2').value = "";
						document.getElementById('telefono1').value = "";
						document.getElementById('telefono2').value = "";
						document.getElementById("txt_correoelectronico1").value ="";
						document.getElementById("txt_correoelectronico2").value ="";
						
						document.getElementById('primer_apellido').disabled = false;
						document.getElementById('segundo_apellido').disabled = false;
						document.getElementById('primer_nombre').disabled = false;
						document.getElementById('segundo_nombre').disabled = false;
						$("#sexocombo").show();
						$("#sexoletra").hide();
						
						document.getElementById('fechanac').disabled = false;
						document.getElementById('estado_civil').disabled = false;
//						$.ajax({
//				type: 'POST',
//				url: '..mod_entes/saime_guardar_db.php',
//				data: 'txt_cedula='+$("#cedulaidentida").val()+'&txt_primer_nombre='+$("#primer_nombre").val()+'&txt_segundo_nombre='+$("#segundo_nombre").val()+'&txt_primer_apellido='+$("#primer_apellido").val()+'&txt_segundo_apellido='+$("#segundo_apellido").val()+'&fecha_nacimiento='+$("#fechanac").val()+'&cbo_nacionalidad='+$("#cbo_nacionalidad").val()+'&cbo_pais_origen='+$("#cbo_pais_origen").val()+'&cbo_sexo='+$("#cbo_sexo").val(),
//				success: function(data) {
//					//alert(data);
//						if(data=='registrado'){
//							alert('DATOS INGRESADOS EXITOSAMENTE');
//							$("#txt_cedula").val('');
//							$("#txt_primer_nombre").val('');
//							$("#txt_segundo_nombre").val('');
//							$("#txt_primer_apellido").val('');
//							$("#txt_segundo_apellido").val('');
//							$("#fecha_nacimiento").val('');
//							$("#cbo_nacionalidad").val('');
//							$("#cbo_pais_origen").val('');
//							$("#cbo_sexo").val('');
//							
//							
//						}
//				}
//				});	
					}
				},
				
			error: 
				function(){
					var mjs="ERROR JSON";
                    alert(mjs);
				}
			});
	}else{
		document.getElementById("cedulaconsulta").style.border = "1px solid red";
		alert("Introduzca la Cédula de Identidad");
		
		 return true;
	}
}


function tienealergias(){


	var cbo_alergias = document.getElementById("cbo_alergias").value;
//alert(cbo_discapacitado);
	
		if(cbo_alergias == ""){
			
			document.getElementById('txt_tipo_alergias').value = "";

						
			document.getElementById('txt_tipo_alergias').disabled = true;

			
		}
		if(cbo_alergias == "1"){
			
			document.getElementById('txt_tipo_alergias').value = "";

			
			document.getElementById('txt_tipo_alergias').disabled = false;


			
		}
		if(cbo_alergias == "2"){
			document.getElementById('txt_tipo_alergias').value = "";

			
			document.getElementById('txt_tipo_alergias').disabled = true;
	
			
			
		}


}

function tienealergias_titular(){


	var cbo_alergias = document.getElementById("cbo_alergias_titular").value;
//alert(cbo_discapacitado);
	
		if(cbo_alergias == ""){
			
			document.getElementById('txt_tipo_alergias_titular').value = "";

						
			document.getElementById('txt_tipo_alergias_titular').disabled = true;

			
		}
		if(cbo_alergias == "1"){
			
			document.getElementById('txt_tipo_alergias_titular').value = "";

			
			document.getElementById('txt_tipo_alergias_titular').disabled = false;


			
		}
		if(cbo_alergias == "2"){
			document.getElementById('txt_tipo_alergias_titular').value = "";

			
			document.getElementById('txt_tipo_alergias_titular').disabled = true;
	
			
			
		}


}


function quitar_bordes_rojos(){
document.getElementById("condicion").style.border = "";
document.getElementById("cedulaconsulta").style.border = "";
document.getElementById("certificado_nac").style.border = "";
document.getElementById("cbo_sexo").style.border = "";
document.getElementById("estado_civil").style.border = "";
document.getElementById("cbo_sexo").style.border = "";
document.getElementById("fechanac").style.border = "";
document.getElementById("estado_civil").style.border = "";
document.getElementById("primer_apellido").style.border = "";
document.getElementById("primer_nombre").style.border = "";
document.getElementById("cbo_parentesco").style.border = "";
document.getElementById("codigo1").style.border = "";
document.getElementById("codigo2").style.border = "";
document.getElementById("telefono1").style.border = "";
document.getElementById("telefono2").style.border = "";
//document.getElementById("txt_correoelectronico").style.border = "";
document.getElementById("txt_correoelectronico1").style.border = "";
document.getElementById("txt_correoelectronico2").style.border = "";
document.getElementById("cbo_lateralidad").style.border = "";
document.getElementById("cbo_discapacitado").style.border = "";
document.getElementById('txt_conapdis').style.border = "";
document.getElementById('cbo_discapacidad').style.border = "";
document.getElementById('cbo_grado_discapacidad').style.border = "";
document.getElementById('cbo_adopcion').style.border = "";
document.getElementById('txt_registro_tribunal').style.border = "";
document.getElementById('cbo_alergias').style.border = "";
document.getElementById('txt_tipo_alergias').style.border = "";
}


function validar_campos(){
	quitar_bordes_rojos();

	var msg = '';

	if ($('#condicion').val().trim() == ''){
		msg=msg+"- Indique si el Beneficiario/asegurado tiene cédula de identidad o no. \n";
		document.getElementById("condicion").style.border = "1px solid red";
	}else{
		document.getElementById("condicion").style.border = "";

			if ($('#cedulaconsulta').val().trim() == '' && $('#condicion').val().trim() == 1 ){
				//msg=msg+'-Bad';
				document.getElementById("cedulaconsulta").style.border = "1px solid red";
				msg=msg+"- La cédula de identidad es requerida. \n";
			}else{
				document.getElementById("cedulaconsulta").style.border = "";
			}	

			if(document.getElementById("condicion").value!=2){		
				if ($('#estado_civil').val().trim() == ''){
					//msg=msg+'-Bad';
					document.getElementById("estado_civil").style.border = "1px solid red";
					
					msg=msg+"- El Estado Civil es requerida.. \n";
				}else{
					document.getElementById("estado_civil").style.border = "";
				}
			}

			if(document.getElementById("condicion").value==2){
				if ($('#certificado_nac').val().trim() == ''){
					msg=msg+"- El Número de Certificado de Nacimiento es requerido. \n";
					document.getElementById("certificado_nac").style.border = "1px solid red";
				}else{
					document.getElementById("certificado_nac").style.border = "";
				}

				if ($('#primer_apellido').val().trim() == ''){
					//msg=msg+'-Bad';
					document.getElementById("primer_apellido").style.border = "1px solid red";
					msg=msg+"- El Primer Apellido es requerido. \n";
				}else{
					document.getElementById("primer_apellido").style.border = "";
				}

				if ($('#primer_nombre').val().trim() == ''){
					//msg=msg+'-Bad';
					document.getElementById("primer_nombre").style.border = "1px solid red";
					msg=msg+"- El Primer Nombre es requerido. \n";
				}else{
					document.getElementById("primer_nombre").style.border = "";
				}
				//alert (+document.getElementById("fechanac").value);
			}
			if ($('#fechanac').val().trim() == '' && $('#condicion').val().trim() == 2 ){
					//msg=msg+'-Bad';
				document.getElementById("fechanac").style.border = "1px solid red";
				msg=msg+"- La Fecha de Nacimiento es requerida.. \n";
				}else{
					document.getElementById("fechanac").style.border = "";
				}
			if ($('#cbo_sexo').val().trim() == ''  && $('#condicion').val().trim() == 2){
				//msg=msg+'-Bad';
				document.getElementById("cbo_sexo").style.border = "1px solid red";
				msg=msg+"- El Sexo es requerido. \n";
			}else{
				document.getElementById("cbo_sexo").style.border = "";
			}

			if ($('#cbo_parentesco').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("cbo_parentesco").style.border = "1px solid red";
				msg=msg+"- El Parentezco es requerido. \n";
			}else{
				document.getElementById("cbo_parentesco").style.border = "";
			}
			if ($('#cbo_lateralidad').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("cbo_lateralidad").style.border = "1px solid red";
				msg=msg+"- La Lateralidad es requerido. \n";
			}else{
				document.getElementById("cbo_lateralidad").style.border = "";
			}
			

			
			if ($('#cbo_lateralidad').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("cbo_lateralidad").style.border = "1px solid red";
			}else{
				document.getElementById("cbo_lateralidad").style.border = "";
			}

			if ($('#cbo_discapacitado').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("cbo_discapacitado").style.border = "1px solid red";
				msg=msg+"- Posee alguna Discapacidad? es requerido. \n";
			}else{
				document.getElementById("cbo_discapacitado").style.border = "";
			}	
			
				if ($('#cbo_discapacidad').val().trim() == '' && $('#cbo_discapacitado').val()==1 ){
					//msg=msg+'-Bad';
				document.getElementById("cbo_discapacidad").style.border = "1px solid red";
				msg=msg+"- La Discapacidad es requerida. \n";
				}else{
					document.getElementById("cbo_discapacidad").style.border = "";
				}
				
				if ($('#txt_conapdis').val().trim() == ''  && $('#cbo_discapacitado').val()==1){
					//msg=msg+'-Bad';
				document.getElementById("txt_conapdis").style.border = "1px solid red";
				msg=msg+"- El Código CONAPDIS es requerido. \n";
				}else{
					document.getElementById("txt_conapdis").style.border = "";
				}	
		
				if ($('#cbo_grado_discapacidad').val().trim() == ''  && $('#cbo_discapacitado').val()==1){
					//msg=msg+'-Bad';
				document.getElementById("cbo_grado_discapacidad").style.border = "1px solid red";
				msg=msg+"- El grado de la Discapacidad es requerido. \n";
				}else{
					document.getElementById("cbo_grado_discapacidad").style.border = "";
				}		
				
				if($('#condicion').val()==2){
					if ($('#cbo_adopcion').val().trim() == '' ){
						//msg=msg+'-Bad';
					document.getElementById("cbo_adopcion").style.border = "1px solid red";
					msg=msg+"- Posee parentezco por Adopción o Colocación Familiar? es requerido. \n";
					}else{
						document.getElementById("cbo_adopcion").style.border = "";
					}
					
					if ($('#txt_registro_tribunal').val().trim() == ''  && $('#cbo_adopcion').val()==1){
						//msg=msg+'-Bad';
					document.getElementById("txt_registro_tribunal").style.border = "1px solid red";
					msg=msg+"- El N° Registro Tribunal es requerido. \n";
					}else{
						document.getElementById("txt_registro_tribunal").style.border = "";
					}	
				}
		
			if ($('#cbo_alergias').val().trim() == '' ){
					//msg=msg+'-Bad';
				document.getElementById("cbo_alergias").style.border = "1px solid red";
				msg=msg+"- Si tiene o no Alergias es requerido. \n";
				}else{
					document.getElementById("cbo_alergias").style.border = "";
				}
		
			if ($('#cbo_alergias').val().trim() == 1 ){
					if ($('#txt_tipo_alergias').val().trim() == ''){
						//msg=msg+'-Bad';
						document.getElementById("txt_tipo_alergias").style.border = "1px solid red";
						msg=msg+"- El Tipo de Alergias es requerido. \n";
					}else{
						document.getElementById("txt_tipo_alergias").style.border = "";
					}
			}
			if ($('#codigo1').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("codigo1").style.border = "1px solid red";
			}else{
				document.getElementById("codigo1").style.border = "";
			}

			if ($('#telefono1').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("telefono1").style.border = "1px solid red";
				msg=msg+"- El N° Telefono Personal es requerido. \n";
			}else{
				document.getElementById("telefono1").style.border = "";
			}

			if ($('#codigo2').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("codigo2").style.border = "1px solid red";
				msg=msg+"- El N° Telefono Habitación es requerido. \n";
			}else{
				document.getElementById("codigo2").style.border = "";
			}

			if ($('#telefono2').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("telefono2").style.border = "1px solid red";
			}else{
				document.getElementById("telefono2").style.border = "";
			}

			if ($('#txt_correoelectronico1').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("txt_correoelectronico1").style.border = "1px solid red";
				msg=msg+"- El Nombre del Correo Electrónico Personal es requerido. \n";
			}else{
				document.getElementById("txt_correoelectronico1").style.border = "";
			}
			if ($('#txt_correoelectronico2').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("txt_correoelectronico2").style.border = "1px solid red";
				msg=msg+"- El Dominio del Correo Electrónico Personal es requerido. \n";
			}else{
				document.getElementById("txt_correoelectronico2").style.border = "";
			}
		
			//si el hijo no es discapacitado y tiene mayor a 25 años años	

			if($('#fechanac').val() && ($('#cbo_parentesco').val()==3 || $('#cbo_parentesco').val()==4) && $('#cbo_discapacitado').val()==2){
				fechanac=$('#fechanac').val();
				var fechanac_arr = fechanac.split("-");
				var fechanac_date = new Date(fechanac_arr[2], fechanac_arr[1] - 1, fechanac_arr[0]);
				var ageDifMs = Date.now() - fechanac_date.getTime();
				var ageDate = new Date(ageDifMs);
				edad =Math.abs(ageDate.getUTCFullYear() - 1970);

				if(edad >= 25  ){
					msg=msg+"- El Beneficiario/Asegurado hijo o hija es mayor a 25 años. \n";
				}

			}
			//si conyugue trabaja en la institucion
			if($('#cbo_conyuge_titular').val()==1 && ($('#cbo_parentesco').val()==1 || $('#cbo_parentesco').val()==2) ){
							
			msg=msg+"- El Beneficiario/Asegurado no puede registrarse \n ya que usted indicó que su conyugue trabaja en la institución. \n";			

			}


	}

	if (msg != '') { 
		alert ('Debe verificar las siguientes condiciones del Beneficiario/Asegurado:\n' + msg);
		msg = '';
		return false;
	}else{
		return true;	
	}


}

function agregar(){
	//alert ("agrego");
	if(validar_campos()==true){
		$.ajax({
			type: 'POST',
			url: 'ajax_registro.php',
	  	data:'&cedulaconsulta='+document.getElementById("cedulaconsulta").value+
			'&certificado_nac='+document.getElementById("certificado_nac").value+
			'&primer_apellido='+document.getElementById("primer_apellido").value+
			'&segundo_apellido='+document.getElementById("segundo_apellido").value+
			'&primer_nombre='+document.getElementById("primer_nombre").value+
			'&segundo_nombre='+document.getElementById("segundo_nombre").value+
			'&sexo='+document.getElementById("sexo").value+
			'&cbo_sexo='+document.getElementById("cbo_sexo").value+
			'&fechanac='+document.getElementById("fechanac").value+
			'&estado_civil='+document.getElementById("estado_civil").value+
			'&cbo_parentesco='+document.getElementById("cbo_parentesco").value+
			'&nacionalidad='+document.getElementById("nacionalidad").value+
			'&codigo1='+document.getElementById("codigo1").value+
			'&telefono1='+document.getElementById("telefono1").value+
			'&codigo2='+document.getElementById("codigo2").value+
			'&telefono2='+document.getElementById("telefono2").value+
			'&txt_correoelectronico='+document.getElementById("txt_correoelectronico").value+
			'&txt_correoelectronico1='+document.getElementById("txt_correoelectronico1").value+
			'&txt_correoelectronico2='+document.getElementById("txt_correoelectronico2").value+
			'&cbo_lateralidad='+document.getElementById("cbo_lateralidad").value+
			'&cbo_discapacitado='+document.getElementById("cbo_discapacitado").value+
			'&txt_conapdis='+document.getElementById("txt_conapdis").value+
			'&cbo_discapacidad='+document.getElementById("cbo_discapacidad").value+
			'&cbo_grado_discapacidad='+document.getElementById("cbo_grado_discapacidad").value+
			'&txt_observacion='+document.getElementById("txt_observacion").value+
			'&condicion='+document.getElementById("condicion").value+
			'&cbo_adopcion='+document.getElementById("cbo_adopcion").value+
			'&txt_registro_tribunal='+document.getElementById("txt_registro_tribunal").value+
			'&cbo_alergias='+document.getElementById("cbo_alergias").value+
			'&txt_tipo_alergias='+document.getElementById("txt_tipo_alergias").value+
			'&accion='+2,
			success: function(data) {
				if(data=='fallo'){		
					alert('Problemas al registrar el Beneficiario/Asegurado');			
				}else{
					if(data=='duplicado'){		
						alert('El Beneficiario/Asegurado Ya se encuentra Registrado');
						document.getElementById("registrohcm").reset();
						document.getElementById('primer_apellido').disabled = true;
						document.getElementById('segundo_apellido').disabled = true;
						document.getElementById('primer_nombre').disabled = true;
						document.getElementById('segundo_nombre').disabled = true;
						document.getElementById('sexo2').disabled = true;
						document.getElementById('fechanac').disabled = true;
						$('#concedula').hide();//-----OCULTO-----
						$('#sincedula').hide();//-----OCULTO-----
					}else{
						if(data=='agregado'){		
							alert('El Beneficiario/Asegurado fue Registrado Exitosamente');
							document.getElementById("registrohcm").reset();
							document.getElementById('primer_apellido').disabled = true;
							document.getElementById('segundo_apellido').disabled = true;
							document.getElementById('primer_nombre').disabled = true;
							document.getElementById('segundo_nombre').disabled = true;
							document.getElementById('sexo2').disabled = true;
							document.getElementById('fechanac').disabled = true;
							$('#concedula').hide();//-----OCULTO-----
							$('#sincedula').hide();//-----OCULTO-----
							load();
						}else{
							mensajes = JSON.parse(data);
							var text = "";
							for (var campo in mensajes){
								if(campo == 'condicion'){
									document.getElementById("condicion").style.border = "1px solid red";
								}else{
									if(campo == 'cedulaconsulta'){
										document.getElementById("cedulaconsulta").style.border = "1px solid red";
									}else{
										if(campo == 'cbo_sexo'){
											document.getElementById("cbo_sexo").style.border = "1px solid red";
										}

									if(document.getElementById("condicion").value!=2){	
										if(campo == 'estado_civil'){
											document.getElementById("estado_civil").style.border = "1px solid red";
										}
									}

									if(document.getElementById("condicion").value!=2){		
										if ($('#estado_civil').val().trim() == ''){
											//msg=msg+'-Bad';
											document.getElementById("estado_civil").style.border = "1px solid red";
										}else{
											document.getElementById("estado_civil").style.border = "";
										}
									}
			

										if(campo == 'certificado_nac'){
											document.getElementById("certificado_nac").style.border = "1px solid red";
										}
										if(campo == 'cbo_parentesco'){
											document.getElementById("cbo_parentesco").style.border = "1px solid red";
										}
										if(campo == 'codigo1'){
											document.getElementById("codigo1").style.border = "1px solid red";
										}
										if(campo == 'telefono1'){
											document.getElementById("telefono1").style.border = "1px solid red";
										}
										if(campo == 'codigo2'){
											document.getElementById("codigo2").style.border = "1px solid red";
										}
										if(campo == 'telefono2'){
											document.getElementById("telefono2").style.border = "1px solid red";
										}
										if(campo == 'txt_correoelectronico1'){
											document.getElementById("txt_correoelectronico1").style.border = "1px solid red";
										}
										if(campo == 'txt_correoelectronico2'){
											document.getElementById("txt_correoelectronico2").style.border = "1px solid red";
										}
										if(campo == 'cbo_lateralidad'){
											document.getElementById("cbo_lateralidad").style.border = "1px solid red";
										}										
										
										if(document.getElementById("cbo_discapacitado").value==1){	
										
										
											if ($('#txt_conapdis').val().trim() == ''){
												//msg=msg+'-Bad';
												document.getElementById("txt_conapdis").style.border = "1px solid red";
											}else{
												document.getElementById("txt_conapdis").style.border = "";
											}
											if ($('#cbo_discapacidad').val().trim() == ''){
												//msg=msg+'-Bad';
												document.getElementById("cbo_discapacidad").style.border = "1px solid red";
											}else{
												document.getElementById("cbo_discapacidad").style.border = "";
											}
											if ($('#cbo_grado_discapacidad').val().trim() == ''){
												//msg=msg+'-Bad';
												document.getElementById("cbo_grado_discapacidad").style.border = "1px solid red";
											}else{
												document.getElementById("cbo_grado_discapacidad").style.border = "";
											}
										}
										
									/*	
										if(document.getElementById("cbo_adopcion").val().trim() == ''){	
												//msg=msg+'-Bad';
												document.getElementById("cbo_adopcion").style.border = "1px solid red";
											}else{
												document.getElementById("cbo_adopcion").style.border = "";
										}
											
										
										
										

																	
										
										if(document.getElementById("cbo_adopcion").value!=1 && document.getElementById("condicion").value!=2){		
											
											if ($('#txt_registro_tribunal').val().trim() == ''){
												//msg=msg+'-Bad';
												document.getElementById("txt_registro_tribunal").style.border = "1px solid red";
											}else{
												document.getElementById("txt_registro_tribunal").style.border = "";
											}
										}
										*/
										
										if(document.getElementById("cbo_alergias").val().trim() == ''){	
												//msg=msg+'-Bad';
												document.getElementById("cbo_alergias").style.border = "1px solid red";
											}else{
												document.getElementById("cbo_alergias").style.border = "";
										}
										
										if(document.getElementById("cbo_alergias").val().trim() == 1){	
											if ($('#txt_tipo_alergias').val().trim() == ''){
												//msg=msg+'-Bad';
												document.getElementById("txt_tipo_alergias").style.border = "1px solid red";
											}else{
												document.getElementById("txt_tipo_alergias").style.border = "";
											}
										}
										
										
										
									}
								}						
								text += mensajes[campo] + "\n";
							}
							alert(text);
						}					
					}				
				}
				//load();
			alert(data);				
			}
	});
		
	}else{
		return true;
	}
	
}
function limpiar(){
	quitar_bordes_rojos();

	$('#Boton_agregar').show();//-----MUESTRO-----
	$('#Boton_editar').hide();//-----OCULTO-----
	$("#buscar").hide();
	document.getElementById("registrohcm").reset();
	document.getElementById('certificado_nac').text ="";
	document.getElementById('primer_apellido').text ="";
	document.getElementById('segundo_apellido').text ="";
	document.getElementById('primer_nombre').text ="";
	document.getElementById('segundo_nombre').text ="";
	document.getElementById('sexo2').disabled.text ="";
	document.getElementById('fechanac').text ="";
	document.getElementById("estado_civil").text ="";
	document.getElementById("cbo_parentesco").text ="";
	document.getElementById("nacionalidad").text ="";
	document.getElementById("codigo1").text ="";
	document.getElementById("telefono1").text ="";
	document.getElementById("codigo2").text ="";
	document.getElementById("telefono2").text ="";
	document.getElementById("txt_correoelectronico").text ="";
	document.getElementById("cbo_lateralidad").text ="";
	document.getElementById("cbo_discapacitado").text ="";
	document.getElementById('txt_conapdis').text ="";
	document.getElementById('cbo_discapacidad').text ="";
	document.getElementById('cbo_grado_discapacidad').text ="";
	document.getElementById("txt_observacion").text ="";
	document.getElementById("condicion").text ="";
	document.getElementById("cbo_adopcion").text ="";
	document.getElementById("txt_registro_tribunal").text ="";
	document.getElementById("cbo_alergias").text ="";
	document.getElementById("txt_tipo_alergias").text ="";
	
	$('#concedula').hide();//-----OCULTO-----
	$('#sincedula').hide();//-----OCULTO-----
}

function editar(id){
	//alert(id); 
	$("#buscar").show();
	$('#Boton_agregar').hide();//-----OCULTO-----
	$('#Boton_agregar').hide();//-----OCULTO-----
	$('#Boton_agregar').hide();//-----OCULTO-----
	$('#cbo_sexo').hide();//-----MUESTRO-----
	document.getElementById("registrohcm").reset();	
	$.ajax({
		url:'ajax_registro.php?id_asegurado='+id+'&accion='+3,
		dataType: 'json',
		 beforeSend: function(objeto){


		 	setTimeout(function(){
				 	if($('#cbo_parentesco').val()==3 || $('#cbo_parentesco').val()==4){
							$("#primer_apellido").prop('disabled', '');
							$("#primer_nombre").prop('disabled', '');
							$("#estado_civil").prop('disabled', 'disabled');
							$("#cbo_parentesco").prop('disabled', '');
							$("#cbo_lateralidad").prop('disabled', '');
							$("#cbo_alergias").prop('disabled', '');
							
						}else{
							$("#estado_civil").prop('disabled', '');
							$("#primer_apellido").prop('disabled', 'disabled');
							$("#primer_nombre").prop('disabled', 'disabled');

						}
			}, 1000);

	  },
		success:function(data){
			if(data.response == 'success'){
				

				
				
				if(data.certificado_nac==0){
					data.certificado_nac=null;
				}
				//alert("CEDULA=" + data.cedulasegurado);
				//alert("CERTIFICADO=" + data.certificado_nac);
				
				if(data.certificado_nac!=null){
				//	alert("SI");
					$("#sincedula").show();
					$("#concedula").hide();
					$("#condicion").val(2);
				}else{
				//	alert("NO");
					$("#sincedula").hide();
					$("#concedula").show();
					$("#condicion").val(1);
				}

			document.getElementById("cedulaconsulta").value=data.cedulasegurado;
			document.getElementById("certificado_nac").value = data.certificado_nac;  
			document.getElementById("primer_apellido").value = data.primer_apellido;  
			document.getElementById("segundo_apellido").value = data.segundo_apellido;
			document.getElementById("primer_nombre").value=data.primer_nombre;
			document.getElementById("segundo_nombre").value=data.segundo_nombre;
			document.getElementById("sexo2").value = data.sexo2;
			document.getElementById("fechanac").value = data.fechanac;
			document.getElementById("estado_civil").value = data.estado_civil;
			document.getElementById("cbo_parentesco").value = data.cbo_parentesco;
			document.getElementById("nacionalidad").value = data.nacionalidadasegurado;
			/*document.getElementById("nacionalidad").disabled = true;*/
			document.getElementById("codigo1").value = data.codigo1;
			document.getElementById("telefono1").value = data.telefono1;
			document.getElementById("codigo2").value = data.codigo2;
			document.getElementById("telefono2").value = data.telefono2;
			document.getElementById("txt_correoelectronico").value = data.txt_correoelectronico;
			document.getElementById("txt_correoelectronico1").value = data.txt_correoelectronico1;
			document.getElementById("txt_correoelectronico2").value = data.txt_correoelectronico2;
			document.getElementById("cbo_discapacitado").value = data.cbo_discapacitado;
			
			if( data.cbo_discapacitado==1){
				$("#cbo_discapacidad").prop('disabled', '');
				$("#txt_conapdis").prop('disabled', '');
				$("#cbo_grado_discapacidad").prop('disabled', '');
			}else{
				$("#cbo_discapacidad").prop('disabled', 'disabled');
				$("#txt_conapdis").prop('disabled', 'disabled');
				$("#cbo_grado_discapacidad").prop('disabled', 'disabled');
			}
				
				
			if(data.cbo_alergias==0){
				data.cbo_alergias="";
			}	
				
			if( data.cbo_alergias==1){
				$("#txt_tipo_alergias").prop('disabled', '');
			}else{
				$("#txt_tipo_alergias").prop('disabled', 'disabled');
			}
				
			if( data.adopcion==1){
				$("#txt_registro_tribunal").prop('disabled', '');
			}else{
				$("#txt_registro_tribunal").prop('disabled', 'disabled');
			}
				
				
				
			//	alert(data.certificado_nac);
			if(data.certificado_nac!="" && data.certificado_nac!=null){	
			//	alert("LLENO");
				$("#etiqueta_adopcion").show();
				$("#combo_adopcion").show();
			}else{
			//	alert("VACIO");
				$("#etiqueta_adopcion").hide();
				$("#combo_adopcion").hide();
			}
			
			document.getElementById("cbo_discapacidad").value = data.cbo_discapacidad;
			document.getElementById("txt_conapdis").value = data.txt_conapdis;
			document.getElementById("cbo_grado_discapacidad").value = data.cbo_grado_discapacidad;
			
			document.getElementById("cbo_lateralidad").value = data.cbo_lateralidad;
			document.getElementById("cbo_alergias").value =data.cbo_alergias;	
			document.getElementById("txt_observacion").value = data.txt_observacion;
			
			//document.getElementById("condicion").value = data.condicion;
			document.getElementById("id_asegurado").value= data.asegurados_id;

			/** RAFA GÓMEZ 26/01/23 */
			document.dispatchEvent(new CustomEvent("alCambiarAsegurado",{detail: {id_asegurado: data.asegurados_id}}))
			/** */
			
			document.getElementById("cbo_lateralidad").value = data.cbo_lateralidad;
			document.getElementById("cbo_alergias").value =data.cbo_alergias;	
			document.getElementById("txt_observacion").value = data.txt_observacion;
				
			//alert( data.adopcion);
			//alert( data.txt_registro_tribunal);
			if(data.adopcion==0){
				data.adopcion="";
			}	
			if(data.txt_registro_tribunal==0){
				data.txt_registro_tribunal="";
			}	
			//alert( data.adopcion);
			//alert( data.txt_registro_tribunal);	
				
			document.getElementById("cbo_adopcion").value =data.adopcion;
			document.getElementById("txt_registro_tribunal").value =data.txt_registro_tribunal;			
			
			document.getElementById("txt_tipo_alergias").value =data.txt_tipo_alergias;		
			//alert(data.telefono2);
			
			
			}
		}
	})
	
function guardar(id){// guarda en base de datos
 	$('#Boton_agregar').hide();//-----OCULTO-----
	$('#guardar').show();//-----MUESTRO-----
	document.getElementById("registrohcm").reset();	
	$.ajax({
		url:'ajax_registro.php?id_asegurado='+id+'&accion='+4,
		dataType: 'json',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			if(data.response == 'success'){
			document.getElementById("certificado_nac").value = data.certificado_nac; 
			document.getElementById("primer_apellido").value = data.primer_apellido;  
			document.getElementById("segundo_apellido").value = data.segundo_apellido;
			document.getElementById("primer_nombre").value=data.primer_nombre;
			document.getElementById("segundo_nombre").value=data.segundo_nombre;
			document.getElementById("sexo2").value = data.sexo2;
			document.getElementById("fechana").value = data.fechana;
			document.getElementById("estado_civil").value = data.estado_civil;
			document.getElementById("cbo_parentesco").value = data.cbo_parentesco;
			document.getElementById("nacionalidad").value = data.nacionalidad;
			document.getElementById("codigo1").value = data.codigo1;
			document.getElementById("telefono1").value = data.telefono1;
			document.getElementById("codigo2").value = data.codigo2;
			document.getElementById("telefono2").value = data.telefono2;
			document.getElementById("txt_correoelectronico").value = data.txt_correoelectronico;
			document.getElementById("txt_correoelectronico1").value = data.txt_correoelectronico1;
			document.getElementById("txt_correoelectronico2").value = data.txt_correoelectronico2;
			document.getElementById("cbo_discapacitado").value = data.cbo_discapacitado;
			document.getElementById("cbo_discapacidad").value = data.cbo_discapacidad;
			document.getElementById("txt_conapdis").value = data.txt_conapdis;
			document.getElementById("cbo_grado_discapacidad").value = data.cbo_grado_discapacidad;
			document.getElementById("cbo_lateralidad").value = data.cbo_lateralidad;
			document.getElementById("txt_observacion").value = data.txt_observacion;
			document.getElementById("condicion").value = data.condicion;
				
		
				
			document.getElementById("cbo_adopcion").value = data.adopcion;
			document.getElementById("txt_registro_tribunal").value = data.txt_registro_tribunal;
				
			
			document.getElementById("cbo_alergias").value = data.cbo_alergias;
			document.getElementById("txt_tipo_alergias").value = data.txt_tipo_alergias;
			

			$("#cbo_discapacitado").prop('disabled', 'disabled');
			$("#txt_conapdis").prop('disabled', 'disabled');
			$("#cbo_discapacidad").prop('disabled', 'disabled');
			$("#cbo_grado_discapacidad").prop('disabled', 'disabled');
			/*$("#cbo_adopcion").prop('disabled', 'disabled');
			$("#txt_registro_tribunal").prop('disabled', 'disabled');*/
			$("#estado_civil").prop('disabled', 'disabled');

			}
		}
	})	
}
}

function actualizar(){
	
	//alert($("#id_asegurado").val());
	
	var msg = '';
	
	
			if ($('#cbo_parentesco').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("cbo_parentesco").style.border = "1px solid red";
				msg=msg+"- El Parentezco es requerido. \n";
			}else{
				document.getElementById("cbo_parentesco").style.border = "";
			}
			
			if ($('#cbo_lateralidad').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("cbo_lateralidad").style.border = "1px solid red";
			}else{
				document.getElementById("cbo_lateralidad").style.border = "";
			}

			if ($('#cbo_discapacitado').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("cbo_discapacitado").style.border = "1px solid red";
				msg=msg+"- Posee alguna Discapacidad? es requerido. \n";
			}else{
				document.getElementById("cbo_discapacitado").style.border = "";
			}	
			
				if ($('#cbo_discapacidad').val().trim() == '' && $('#cbo_discapacitado').val()==1 ){
					//msg=msg+'-Bad';
				document.getElementById("cbo_discapacidad").style.border = "1px solid red";
				msg=msg+"- La Discapacidad es requerida. \n";
				}else{
					document.getElementById("cbo_discapacidad").style.border = "";
				}
				
				if ($('#txt_conapdis').val().trim() == ''  && $('#cbo_discapacitado').val()==1){
					//msg=msg+'-Bad';
				document.getElementById("txt_conapdis").style.border = "1px solid red";
				msg=msg+"- El Código CONAPDIS es requerido. \n";
				}else{
					document.getElementById("txt_conapdis").style.border = "";
				}	
				
				
		
				if ($('#cbo_adopcion').val().trim() == '' && $('#cbo_adopcion').val()==1 ){
					//msg=msg+'-Bad';
				document.getElementById("cbo_adopcion").style.border = "1px solid red";
				msg=msg+"- Posee parentezco por Adopción o Colocación Familiar? es requerido. \n";
				}else{
					document.getElementById("cbo_adopcion").style.border = "";
				}
				
				if ($('#txt_registro_tribunal').val().trim() == ''  && $('#cbo_adopcion').val()==1){
					//msg=msg+'-Bad';
				document.getElementById("txt_registro_tribunal").style.border = "1px solid red";
				msg=msg+"- El N° Registro Tribunal es requerido. \n";
				}else{
					document.getElementById("txt_registro_tribunal").style.border = "";
				}	
		
		
			if ($('#cbo_alergias').val().trim() == '' ){
					//msg=msg+'-Bad';
				document.getElementById("cbo_alergias").style.border = "1px solid red";
				msg=msg+"- Si tiene o no Alergias es requerido. \n";
				}else{
					document.getElementById("cbo_alergias").style.border = "";
				}
		
			if ($('#cbo_alergias').val().trim() == 1 ){
					if ($('#txt_tipo_alergias').val().trim() == ''){
						//msg=msg+'-Bad';
						document.getElementById("txt_tipo_alergias").style.border = "1px solid red";
						msg=msg+"- El Tipo de Alergias es requerido. \n";
					}else{
						document.getElementById("txt_tipo_alergias").style.border = "";
					}
			}
			if ($('#codigo1').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("codigo1").style.border = "1px solid red";
			}else{
				document.getElementById("codigo1").style.border = "";
			}

			if ($('#telefono1').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("telefono1").style.border = "1px solid red";
				msg=msg+"- El N° Telefono Personal es requerido. \n";
			}else{
				document.getElementById("telefono1").style.border = "";
			}

			if ($('#codigo2').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("codigo2").style.border = "1px solid red";
				msg=msg+"- El N° Telefono Habitación es requerido. \n";
			}else{
				document.getElementById("codigo2").style.border = "";
			}

			if ($('#telefono2').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("telefono2").style.border = "1px solid red";
			}else{
				document.getElementById("telefono2").style.border = "";
			}

			if ($('#txt_correoelectronico1').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("txt_correoelectronico1").style.border = "1px solid red";
				msg=msg+"- El Nombre del Correo Electrónico Personal es requerido. \n";
			}else{
				document.getElementById("txt_correoelectronico1").style.border = "";
			}
			if ($('#txt_correoelectronico2').val().trim() == ''){
				//msg=msg+'-Bad';
				document.getElementById("txt_correoelectronico2").style.border = "1px solid red";
				msg=msg+"- El Dominio del Correo Electrónico Personal es requerido. \n";
			}else{
				document.getElementById("txt_correoelectronico2").style.border = "";
			}
	
//si el hijo no es discapacitado y tiene mayor a 25 años años	
	
	if($('#fechanac').val() && ($('#cbo_parentesco').val()==3 || $('#cbo_parentesco').val()==4) && $('#cbo_discapacitado').val()==2){
				fechanac=$('#fechanac').val();
				var fechanac_arr = fechanac.split("-");
				var fechanac_date = new Date(fechanac_arr[2], fechanac_arr[1] - 1, fechanac_arr[0]);
				var ageDifMs = Date.now() - fechanac_date.getTime();
				var ageDate = new Date(ageDifMs);
				edad =Math.abs(ageDate.getUTCFullYear() - 1970);

				if(edad >= 25  ){
					msg=msg+"- El Beneficiario/Asegurado hijo o hija es mayor a 25 años. \n";
				}

			}


	
	
	
	if (msg != '') { 
			alert ('Debe verificar las siguientes condiciones del Beneficiario/Asegurado:\n' + msg);
		msg = '';
		return false;
	}else{ 		

		var id_asegurado= $("#id_asegurado").val(); 
		var cbo_parentesco= $("#cbo_parentesco").val();
		var cbo_lateralidad= $("#cbo_lateralidad").val();
		var txt_observacion= $("#txt_observacion").val();
		var codigo1= $("#codigo1").val();
		var telefono1= $("#telefono1").val();
		var codigo2= $("#codigo2").val();
		var telefono2= $("#telefono2").val();
		var txt_correoelectronico= $("#txt_correoelectronico").val();	
		var txt_correoelectronico1= $("#txt_correoelectronico1").val();	
		var txt_correoelectronico2= $("#txt_correoelectronico2").val();	
		var cbo_discapacitado= $("#cbo_discapacitado").val();	
		var cbo_discapacidad= $("#cbo_discapacidad").val();	
		var txt_conapdis= $("#txt_conapdis").val();
		var cbo_grado_discapacidad= $("#cbo_grado_discapacidad").val();
		var cbo_adopcion= $("#cbo_adopcion").val();
		var txt_registro_tribunal= $("#txt_registro_tribunal").val();
		var cbo_alergias= $("#cbo_alergias").val();
		var txt_tipo_alergias= $("#txt_tipo_alergias").val();
		
		var nacionalidad= $("#nacionalidad").val();
		var cedulaconsulta= $("#cedulaconsulta").val();
		var certificado_nac= $("#certificado_nac").val();
		var primer_nombre	=$("#primer_nombre").val();
		var segundo_nombre	=$("#segundo_nombre").val();
		var primer_apellido	=$("#primer_apellido").val();
		var segundo_apellido	=$("#segundo_apellido").val();
		//alert ('FUNCION ACTUALIZAR');////////////////////////////////////////////////////////////
		$.ajax({
			url:'ajax_registro.php?cbo_parentesco='+cbo_parentesco+'&cbo_lateralidad='+cbo_lateralidad+'&txt_observacion='+txt_observacion+'&codigo1='+codigo1+'&telefono1='+telefono1+'&codigo2='+codigo2+'&telefono2='+telefono2+'&txt_correoelectronico='+txt_correoelectronico+'&txt_correoelectronico1='+txt_correoelectronico1+'&txt_correoelectronico2='+txt_correoelectronico2+'&cbo_parentesco='+cbo_parentesco+'&accion='+4+'&id_asegurado='+id_asegurado+'&cbo_discapacitado='+cbo_discapacitado+ '&cbo_discapacidad='+cbo_discapacidad+'&txt_conapdis='+txt_conapdis+'&cbo_grado_discapacidad='+cbo_grado_discapacidad+'&cbo_adopcion='+cbo_adopcion+'&txt_registro_tribunal='+txt_registro_tribunal+'&cbo_alergias='+cbo_alergias+'&txt_tipo_alergias='+txt_tipo_alergias+'&nacionalidad='+nacionalidad+'&cedulaconsulta='+cedulaconsulta+'&certificado_nac='+certificado_nac+'&primer_apellido='+primer_apellido+'&segundo_apellido='+segundo_apellido+'&primer_nombre='+primer_nombre+'&segundo_nombre='+segundo_nombre,			
			dataType: 'json',
			 beforeSend: function(objeto){

			 	alert('Se ha modificado corectamente el Beneficiario/Asegurado ');
				//limpiar();	


		  },
			success:function(data){


				$('#Boton_agregar').show();//-----MUESTRO-----
				$('#Boton_editar').hide();//-----OCULTO-----
				document.getElementById("registrohcm").reset();	
				//document.getElementById("logo1_muestra").src = '/minpptrassi/logos/imagen1.jpg';
				//document.getElementById("logo2_muestra").src = '/minpptrassi/logos/imagen2.jpg';
				load();

			}
		})
	}
}
function eliminar(opcion){
	$.ajax({
		url:'ajax_registro.php?opcion='+opcion+'&accion='+5,
		dataType: 'json',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			if(data.response == 'success'){
					alert(data.mensaje);
				$('#Boton_agregar').show();//-----MUESTRO-----
				$('#Boton_editar').hide();//-----OCULTO-----
				//document.getElementById("modulos").reset();	
				//document.getElementById("logo1_muestra").src = '/minpptrassi/logos/imagen1.jpg';
				//document.getElementById("logo2_muestra").src = '/minpptrassi/logos/imagen2.jpg';
				load();	
				//window.location.reload();
				
			}else{
				alert(data.mensaje);
				return true;
			}

		}
	})
}


function actualizar_titular(){
	var msg = '';
	
	
	if ($('#cbo_hijos_titular').val().trim() == ''){
		msg=msg+"- Tiene o no hijos? es requerido. \n";
		
		document.getElementById("cbo_hijos_titular").style.border = "1px solid red";
	}else{
		document.getElementById("cbo_hijos_titular").style.border = "";
	}
	
	if ($('#cbo_conyuge_titular').val().trim() == ''){
		//msg=msg+'-Bad';
		msg=msg+"- Su conyugue trabaja en la Institución? es requerido. \n";
		document.getElementById("cbo_conyuge_titular").style.border = "1px solid red";
	}else{
		document.getElementById("cbo_conyuge_titular").style.border = "";
	}
	
if ($('#cbo_alergias_titular').val().trim() == ''){
		//msg=msg+'-Bad';
		msg=msg+"- Tiene o no alergias? es requerido. \n";
		document.getElementById("cbo_alergias_titular").style.border = "1px solid red";
	}else{
		document.getElementById("cbo_alergias_titular").style.border = "";
}

if ($('#cbo_alergias_titular').val().trim() == 1){
	if ($('#txt_tipo_alergias_titular').val().trim() == ''){
		//msg=msg+'-Bad';
		msg=msg+"- El tipo de Alergias es requerido. \n";
		document.getElementById("txt_tipo_alergias_titular").style.border = "1px solid red";
	}else{
		document.getElementById("txt_tipo_alergias_titular").style.border = "";
	}
}
	

	
	if (msg != '') { 
		//alert ('DEBE SELECCIONAR LOS CAMPOS REQUERIDOS');
		msg= alert ('Debe verificar las siguientes condiciones del Titular:\n' + msg);
		return false;
	}else{ 		

		var cbo_hijos_titular= $("#cbo_hijos_titular").val();
		var cbo_conyuge_titular= $("#cbo_conyuge_titular").val();
		var cbo_alergias_titular= $("#cbo_alergias_titular").val();
		var txt_tipo_alergias_titular= $("#txt_tipo_alergias_titular").val();
		

			 
		//alert ('FUNCION ACTUALIZAR');////////////////////////////////////////////////////////////
		$.ajax({
			url:'ajax_registro.php?cbo_hijos_titular='+cbo_hijos_titular+'&cbo_conyuge_titular='+cbo_conyuge_titular+'&cbo_alergias_titular='+cbo_alergias_titular+'&txt_tipo_alergias_titular='+txt_tipo_alergias_titular+'&accion=8',				
			 dataType: 'json',
			 beforeSend: function(objeto){

			 	alert('Los datos del Titular han sido actualizados exitosamente.');
				//limpiar();	


		  },
			success:function(data){

				window.location.reload();

			}
		})
	}
}
