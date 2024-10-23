$(document).ready(function() 
{
     let hoy=new Date();
     hoy    =hoy.toISOString().slice(0,10).replace(/-/g,"-");
     $("#guardar").show();
     $("#editar").hide();
     //if(document.getElementById("vocero_estatus3").checked==true)
     //{
     //Deshabilito el Botón de Impresión de Boleta desde que se carga la Página(verificar esto con Francys)
/*      $('#cmd_guardar').attr('disabled','disabled');
 */     //}
     $("#f_btn2").hide();
     document.getElementById("hoy").value=hoy;
});

function mayusculas(e) {
    e.value = e.value.toUpperCase();
}


function eliminarT(saction,id){
	if (confirm("\u00BFDESEA ELIMINAR AL VOCERO?") == true) {
		$("#loader").show();
		var form = document.formularioCPT;
		form.action.value=saction;
		form.id_miembro_empresa.value=id;
		form.submit()
	}	
}
function editarT(saction,id,id_miembro_empresa){
	var fechaDelDia=new Date();

	//if (confirm("\u00BFDESEA MODIFICAR LOS DATOS DEL VOCERO?") == true) {
		//$("#loader").show();	
		$("#guardar").hide();
		$("#editar").show();		
	        //$('#fechaconst').attr('disabled','disabled');
		//$("#f_btn1").hide();
		$("#f_btn2").show();
		$.ajax({
		url:'consulta_miembros.php?id='+id+'&accion='+1,
		dataType: 'json',
		  success:function(data){
			//alert('eje='+data.nestatus_cptt);
			console.log(data);

			if(data.response == 'success'){
				fechaDelDia       =fechaDelDia.toISOString().split('T')[0];
				fechaDeVencimiento=data.fechavencimiento;
			if(data.nestatus_cptt!=4)// originalmente la condición era la siguiente: data.nestatus_cptt!=3
			{
				if(fechaDeVencimiento>fechaDelDia)
				{
					document.getElementById("vocero_estatus1").checked=true;
					$('#cmd_guardar').removeAttr('disabled');
				}
				else if(fechaDeVencimiento<fechaDelDia)
				{
					document.getElementById("vocero_estatus2").checked=true;
					$('#cmd_guardar').removeAttr('disabled');
					////$('#cmd_guardar').attr('disabled','disabled');
				}
			}
			/* else if(data.nestatus_cptt==3)
			{
				document.getElementById("vocero_estatus3").checked=true;
				$('#cmd_guardar').attr('disabled','disabled');
			} */

			document.getElementById("id").value=data.id;		
			document.getElementById("id_miembro_empresa").value=data.id_miembro_empresa;	
			document.getElementById("cedulaconsulta").value=data.cedulaconsulta;
			document.getElementById("apellidonombre").value = data.apellidonombre;  
			document.getElementById("fechanac").value = data.fechanac; 
			document.getElementById("fecha_nacimiento").value = data.fechanac;  
			document.getElementById("edad").value = data.edad;
			document.getElementById("cbo_sexo").value = data.sexo2;
			
/* 			$("#cbo_sexo option[value="+data.sexo2+"]").attr("selected", true);
 */
			document.getElementById("email").value=data.email;

			document.getElementById("codigo1").value=data.codigo1;
			document.getElementById("telefono1").value = data.telefono1;
			document.getElementById("codigo2").value=data.codigo2;
			document.getElementById("telefono2").value = data.telefono2;
			document.getElementById("txt_direccion_hab").value = data.sdireccion_habitacion;
			document.getElementById("condicion").value = data.condicion;
			document.getElementById("condicion_laboral").value = data.condicion_laboral;
			document.getElementById("cbo_cargos").value = data.cbo_cargos;
			
			
			document.getElementById("total_trabajadores").value = data.total_trabajadores;
			document.getElementById("nro_votos").value = data.nro_votos;
			document.getElementById("voto_p").value = data.nro_votos;

			//if(data.fechanueva_eleccion==NULL)data.fechanueva_eleccion='';
			document.getElementById("fechanueva_eleccion").value = data.fechanueva_eleccion;
			document.getElementById("fechaconst").value = data.fechaconst;
			document.getElementById("fechavencimiento").value = data.fechavencimiento;
			document.getElementById("fechavencimiento_").value = data.fechavencimiento;
			document.getElementById("txt_comentarios").value = data.txt_comentarios;
		
			

			}else{
				if(data.response == 'nosuccess'){
						alert ('Error al cargar los datos del Vocero');
					}
				}
			
		}
	})
	
	
	
		/*var form = document.formularioCPT;
		form.action.value=saction;
		form.id.value=id;
		$("#guardar").hide();
		$("#editar").show();
		form.submit();
		*/
	//}	
}
function modificarT(saction){
	/* OJO: Esta validación es para Alertar si al colocar el estatus inactivo, 
	 * la fecha de Vencimiento es menor a la fecha del día
	 */
	var fechaDelDia=new Date();

	/*
	fechaDelDia       =fechaDelDia.toISOString().split('T')[0];
	fechaDeVencimiento=$('#fechavencimiento').val()
	if((document.getElementById("vocero_estatus2").checked==true) and (fechaDeVencimiento>fechaDelDia))
	{
		alert('La fecha de vencimiento es mayor a la fecha del día');
	}
	*/
	$("#guardar").hide();
	$("#editar").show();
	var msg = '';
		
	if ($('#fechaconst').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("fechaconst").style.border = "1px solid red";
	}else{
		document.getElementById("fechaconst").style.border = "";
	}

	/*if ($('#fechanueva_eleccion').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("fechanueva_eleccion").style.border = "1px solid red";
	}else{
		document.getElementById("fechanueva_eleccion").style.border = "";
	}*/
	
	if ($('#fechavencimiento').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("fechavencimiento").style.border = "1px solid red";
	}else{
		document.getElementById("fechavencimiento").style.border = "";
	}
	if ($('#total_trabajadores').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("total_trabajadores").style.border = "1px solid red";
	}else{
		document.getElementById("total_trabajadores").style.border = "";
	}
	if ($('#nro_votos').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("nro_votos").style.border = "1px solid red";
	}else{
		document.getElementById("nro_votos").style.border = "";
	}
	
	if ($('#cedulaconsulta').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("cedulaconsulta").style.border = "1px solid red";
	}else{
		document.getElementById("cedulaconsulta").style.border = "";
	}
	
	if ($('#email').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("email").style.border = "1px solid red";
	}else{
		document.getElementById("email").style.border = "";
	}	

	
	if ($('#cbo_cargos').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("cbo_cargos").style.border = "1px solid red";
	}else{
		document.getElementById("cbo_cargos").style.border = "";
	}
	if ($('#cbo_sexo').val().trim() == ''){
		msg=msg+'-Bad';
			document.getElementById("cbo_sexo").style.border = "1px solid red";
		}else{
			document.getElementById("cbo_sexo").style.border = "";
		}
	
	if ($('#condicion').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("condicion").style.border = "1px solid red";
	}else{
		document.getElementById("condicion").style.border = "";
	}
if ($('#condicion_laboral').val().trim() == ''){
	msg=msg+'-Bad';
		document.getElementById("condicion_laboral").style.border = "1px solid red";
	}else{
		document.getElementById("condicion_laboral").style.border = "";
	}

	//**./FIN VALIDACIONES */
	if (msg != '') { 
		alert ('Debe seleccionar los campos requeridos');
		msg = '';
		return false;
	}else{
	
		var votos=$('#nm_voto').val().trim();
		var votos2=$('#nro_votos').val().trim();
		var votop=$('#voto_p').val().trim();

		var total=$('#nm_total').val().trim();
		var total2=$('#total_trabajadores').val().trim();


		tl2=total2-votos2;

		vt=votos-votop;
		tl=total2-vt;


		if(tl2 < vt){

		   alert("El número de votantes a llegado al límite de votos, Deben de haber más trabajadores");
		   
		   document.getElementById("total_trabajadores").style.border = "1px solid red";

	   }else{
		   document.getElementById("total_trabajadores").style.border = " ";

	
		if (confirm("\u00BFDESEA MODIFICAR LOS DATOS DEL VOCERO?") == true) {
			////$("#loader").show();		
			var form = document.formularioCPT;
			form.action.value=saction;
			//form.id.value=id;
			//$("#guardar").show();
			//$("#editar").hide();
			//$("#loader").hide();	
			//form.submit()
			if(document.getElementById("vocero_estatus3").checked==true)
			{
				if(document.getElementById("txt_comentarios").value=='')
				{
					document.getElementById("txt_comentarios").focus();
					alert('Debe Colocar Una Observación');
				}
				else
				{
					//Inhabilitar el botón para la impresión de la Boleta:
/* 					$('#cmd_guardar').attr('disabled','disabled');
 */
					//Habilitar el botón Editar si el vocero está Inoperativo
					$('#editar').removeAttr('disabled');

					$("#guardar").show();
					$("#editar").hide();
					$("#loader").hide();	
					form.submit()
				}
			}
			else
			{
				$("#guardar").show();
				$("#editar").hide();
				$("#loader").hide();	
				form.submit()
			}
			/*
			var form = document.formularioCPT;
			form.action.value=saction;
			//form.id.value=id;
			$("#guardar").show();
			$("#editar").hide();
			$("#loader").hide();	
			form.submit()
			*/
		}	
	}
	}
}
function guardarT(saction,cedulaconsulta)
{
     $("#guardar").show();
     $("#editar").hide();
     var msg = '';
	
     if ($('#fechaconst').val().trim() == '')
     {
	  msg=msg+'-Bad';
	  document.getElementById("fechaconst").style.border = "1px solid red";
     }
     else
     {
	  document.getElementById("fechaconst").style.border = "";
     }

     if ($('#fechavencimiento').val().trim() == '')
     {
	  msg=msg+'-Bad';
	  document.getElementById("fechavencimiento").style.border = "1px solid red";
     }
     else
     {
	  document.getElementById("fechavencimiento").style.border = "";
     }
     if ($('#total_trabajadores').val().trim() == '')
     {
	  msg=msg+'-Bad';
	  document.getElementById("total_trabajadores").style.border = "1px solid red";
     }
     else
     {
	  document.getElementById("total_trabajadores").style.border = "";
     }
     if ($('#nro_votos').val().trim() == '')
     {
	  msg=msg+'-Bad';
	  document.getElementById("nro_votos").style.border = "1px solid red";
     }
     else
     {
	  document.getElementById("nro_votos").style.border = "";
     }
	
     if ($('#cedulaconsulta').val().trim() == '')
     {
	  msg=msg+'-Bad';
	  document.getElementById("cedulaconsulta").style.border = "1px solid red";
     }
     else
     {
	  document.getElementById("cedulaconsulta").style.border = "";
     }
	
     if ($('#email').val().trim() == '')
     {
	  msg=msg+'-Bad';
	  document.getElementById("email").style.border = "1px solid red";
     }
     else
     {
	  document.getElementById("email").style.border = "";
     }	
	
     if ($('#cbo_cargos').val().trim() == '')
     {
	  msg=msg+'-Bad';
	  document.getElementById("cbo_cargos").style.border = "1px solid red";
     }
     else
     {
	  document.getElementById("cbo_cargos").style.border = "";
     }
	
     if ($('#condicion').val().trim() == '')
     {
	  msg=msg+'-Bad';
	  document.getElementById("condicion").style.border = "1px solid red";
     }
     else
     {
	  document.getElementById("condicion").style.border = "";
     }

     if ($('#condicion_laboral').val().trim() == '')
     {
	  msg=msg+'-Bad';
	  document.getElementById("condicion_laboral").style.border = "1px solid red";
     }
     else
     {
	  document.getElementById("condicion_laboral").style.border = "";
     }
	
     if (msg != '')
     { 
	  alert ('Debe seleccionar los campos requeridos');
	  msg = '';
	  return false;
     }
     else
     {
		 var votos=$('#nm_voto').val().trim();
		 var votos2=$('#nro_votos').val().trim();
		 var total=$('#nm_total').val().trim();
		 var total2=$('#total_trabajadores').val().trim();

		 tl=total-votos;
		 tl2=total2-votos2;


		 if(tl2<votos){

			alert("El número de votantes a llegado al límite de votos, Deben de haber más trabajadores");
			
			document.getElementById("total_trabajadores").style.border = "1px solid red";

		}else{
			document.getElementById("total_trabajadores").style.border = " ";

	  if (confirm("\u00BFDESEA CONTINUAR?") == true) 
	  {
	       ////$("#loader").show();
	       var form = document.formularioCPT;
	       //alert(saction);
	       form.action.value=saction;
	       form.submit();
	  }
     }
	
	}

}

function isNumberKey(evt){
	
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode > 31 && (charCode < 48 || charCode > 57) )
	 return false;
	
	 return true;
}

function validarEmail() {
	var correo = document.getElementById("email").value;
    expr = /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}([.][a-zA-Z]{2,4})+$/;
    
	if(!correo){
		//alert("Debe escribir su correo.");
	}else{
	if (!expr.test(correo))
        alert("La direcci\u00f3n de correo es incorrecta.");
	}
}
						
function vecimiento(){	
//FORMULARIO3
var fechaDelDia=new Date();

var inicio=document.getElementById("fechaconst").value;
//Igualo la Fecha de la nueva Elección a la fecha de inicio
//inicio=document.getElementById("fechanueva_eleccion").value=inicio;
document.getElementById("fechanueva_eleccion").value=inicio;
//var fin=document.getElementById("datepicker2").value;
     
var start=new Date(inicio);

start.setFullYear(start.getFullYear()+2);
var startf = start.toISOString().slice(0,10).replace(/-/g,"-");
document.getElementById("fechavencimiento_").value= startf;
document.getElementById("fechavencimiento").value= startf;

var fechaVencimiento=document.getElementById("fechavencimiento").value;
fechaVencimiento    =new Date(fechaVencimiento);

if(fechaVencimiento<fechaDelDia)
{
     document.getElementById("vocero_estatus2").checked=true;
}
else if(fechaVencimiento>fechaDelDia)
{
     document.getElementById("vocero_estatus1").checked=true;
}
else
{
     document.getElementById("vocero_estatus1").checked=true;
}
//Esto ya estaba:
/*		
var inicio=document.getElementById("fechaconst").value;					
var fecha = new Date(inicio);
fecha.setYear(fecha.getYear()+2);

document.getElementById("fechavencimiento").value=	fecha;*/
}

function vencimientoPorFechaNuevaEleccion()
{
     var inicio=document.getElementById("fechanueva_eleccion").value;

     var start=new Date(inicio);
     var hoy  =new Date();
     start.setFullYear(start.getFullYear()+2);
     var startf = start.toISOString().slice(0,10).replace(/-/g,"-");
     hoy        = hoy.toISOString().slice(0,10).replace(/-/g,"-");
     document.getElementById("fechavencimiento_").value= startf;
     document.getElementById("fechavencimiento").value= startf;

     //document.getElementById("hoy").value=hoy;

     if(document.getElementById("vocero_estatus3").checked!==true)
     {
	  if(startf<hoy)
	  {
	       //alert('fecha fin es menor')
	       document.getElementById("vocero_estatus2").checked=true
	  }
	  else
	  {
	       //alert('fecha fin es mayor')
	       document.getElementById("vocero_estatus1").checked=true
	  }
     }
}
