function consultar_saime(cedula){
if(cedula==""){
				$("input[name='ced_afiliado']").val('');
				$("input[name='nombre_afiliado']").val('');
				$("input[name='apellido_afiliado']").val('');
				$("input[name='cbSexo_afiliado']").val('');
				$("input[name='fnacimiento_afiliado']").val('');
				$("input[name='telefono_afiliado']").val('');
				$("input[name='email_afiliado']").val('');
				$("input[name='email_afiliado2']").val('');
				$("input[name='ced_afiliado2']").val('');
}else{
$.ajax({
	type: 'POST',
	url: 'consulta_saime.php',
	data: 'cedula='+cedula,
	success: function(data) {
		var str=data;
		var usuario=str.split("|"); 
		//PARA SABER SI EL REGISTRO TRAE ALGO
		//alert(data);
		
		if(usuario[0]!=""){	
				if(usuario[0]==-2){
					//AQUI ES QUE NO EXISTE
					$("input[name='ced_afiliado']").val('');
					$("input[name='nombre_afiliado']").val('');
					$("input[name='apellido_afiliado']").val('');
					$("input[name='cbSexo_afiliado']").val('');
					$("input[name='fnacimiento_afiliado']").val('');
					$("input[name='telefono_afiliado']").val('');
					$("input[name='email_afiliado']").val('');
					$("input[name='email_afiliado2']").val('');
					$("input[name='ced_afiliado2']").val('');
					alert("EL NUMERO DE CEDULA NO ESTA REGISTRADO EN EL SAIME POR FAVOR INGRESE UNA CEDULA VALIDA. PARA MAYOR INFORMACION COMUNIQUESE AL 0800TRABAJO (872-22-56).");
				}else if(usuario[0]==-1){
					//AQUI ES QUE ESTA CAIDO EL WEBSERVICE
					$("input[name='ced_afiliado']").val('');
					$("input[name='nombre_afiliado']").val('');
					$("input[name='apellido_afiliado']").val('');
					$("input[name='cbSexo_afiliado']").val('');
					$("input[name='fnacimiento_afiliado']").val('');
					$("input[name='telefono_afiliado']").val('');
					$("input[name='email_afiliado']").val('');
					$("input[name='email_afiliado2']").val('');
					$("input[name='ced_afiliado2']").val('');
					alert("EN ESTOS MOMENTOS NO ES POSIBLE ESTABLECER CONEXION PARA LA VALIDACION DE LOS DATOS CON SAIME, POR FAVOR INTENTE LUEGO.");
				}else{
					//AQUI TRAE LOS DATOS
					$("input[name='nombre_afiliado']").val(usuario[0]);
					$("input[name='apellido_afiliado']").val(usuario[1]);
					$("input[name='fnacimiento_afiliado']").val(usuario[2]);
					
					
					
			if(usuario[3]=='F'){
						usuario[3]=1;
					}else{
						usuario[3]=2;	
					}
					$("#cbSexo_afiliado").val(usuario[3]);
					$("input[name='cbSexo_afiliado']").val(usuario[3]);
				}
				
				$("input[name='ced_afiliado2']").val(usuario[4]);
				
		}else{
			alert("EL NUMERO DE CEDULA NO ESTA REGISTRADO EN EL SAIME POR FAVOR INGRESE UNA CEDULA VALIDA. PARA MAYOR INFORMACION COMUNIQUESE AL 0800TRABAJO (872-22-56).");
					$("input[name='ced_afiliado']").val('');
					$("input[name='nombre_afiliado']").val('');
					$("input[name='apellido_afiliado']").val('');
					$("input[name='cbSexo_afiliado']").val('');
					$("input[name='fnacimiento_afiliado']").val('');
					$("input[name='telefono_afiliado']").val('');
					$("input[name='email_afiliado']").val('');
					$("input[name='email_afiliado2']").val('');
					$("input[name='ced_afiliado2']").val('');
		}
	}
	});	
}
}
