//----------------------------------------- validar_frm_olvido_contrasena----------------------------------------------------------------

function validar_frm_olvido_contrasena(){
var valor=1 ;  

if(document.getElementById("cbCed_afiliado").value=='-1'){
document.getElementById("cbCed_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("cbCed_afiliado").style.borderColor= '';
}  

if(document.getElementById("ced_afiliado").value==''){
document.getElementById("ced_afiliado").style.borderColor= '#DF0101';
valor=0;
}else{
document.getElementById("ced_afiliado").style.borderColor= '';
}  

	if(valor==0){
		alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
		return false;
	}else{
		return true;
	}	
}

//----------------------------------------- validar_frm_trabajador----------------------------------------------------------------

function validar_frm_trabajador()
{
	var valor=1 ;
	var valorr=1 ;


/*
	alert($('#nombre_afiliado1').val());
	alert($('#nombre_afiliado2').val());

	alert($('#apellido_afiliado1').val());
	alert($('#apellido_afiliado2').val());

	alert($('#cbSexo_afiliado').val());
	alert($('#fnacimiento_afiliado').val());

	alert($('#telefono_afiliado').val());

	alert($('#email_afiliado1').val());
	alert($('#email_afiliado2').val());
*/

	if(document.getElementById("ced_afiliado").value=='')
	{
		//document.getElementById("ced_afiliado").style.borderColor= '#DF0101';
		alert("DEBE INTRODUCIR LA CEDULA");
	}
	else
	{
		if(document.getElementById("telefono_afiliado").value=='')
		{
			valor=0;
		}		
		if(document.getElementById("email_afiliado2").value=='')
		{
			valor=0;
		}
		var nombre_email1 =  document.getElementById("email_afiliado1").value;
	    var nombre_email2 =  document.getElementById("email_afiliado2").value;
		if(nombre_email1 != nombre_email2)		
		{
			valorr=0;
		}
		//VALIDAR CUANDO ESTE VACIO
		if(document.getElementById("nombre_afiliado1").value==''){
			valor=0;
		}
		if(document.getElementById("apellido_afiliado1").value==''){
			valor=0;
		}
		if(document.getElementById("fnacimiento_afiliado").value==''){
			valor=0;
		}
/* 		if(document.getElementById("cbSexo_afiliado").value==''){
			valor=0;
		}
 */
		if(valor==0)
		{
			alert("HAY CAMPOS REQUERIDOS");
			return false;
		}
		else
		{
			if(valorr==0)
			{
				alert("LOS CORREOS NO COINCIDEN");
				return false;
			}
			else
			{
				return true;
			}
		}
	}//cierre de si la cedula existe */
}	