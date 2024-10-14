function consultar_saime(cedula){
if(cedula=="" || cedula=="V|" || cedula=="E|")
{
				$("input[name='ced_afiliado']").val('');
				$("input[name='nombre_afiliado1']").val('');
				$("input[name='nombre_afiliado2']").val('');
				$("input[name='apellido_afiliado1']").val('');
				$("input[name='apellido_afiliado2']").val('');
				$("input[name='fnacimiento_afiliado']").val('');
				$("input[name='cbSexo_afiliado']").val('');
				document.getElementById("cbSexo_afiliado").value='-1';
				$("input[name='ced_afiliad']").val('');
				$("input[name='nacionalidad_afiliado']").val('');
				$("input[name='telefono1']").val('');
				$("input[name='email_afiliado1']").val('');
				$("input[name='email_afiliado2']").val('');
				$("input[name='ced_afiliado2']").val('');
				$("input[name='codigo1']").val('');
				$("input[name='codigo2']").val('');
				$("input[name='telefono2']").val('');
				$("input[name='email_afiliado']").val('');
				$("input[name='email_afiliado21']").val('');


				alert("DEBE INGRESAR LA CEDULA DE IDENTIDAD");	
}
else
{
$.ajax({
	type: 'POST',
	url: '../mod_registro/consulta_saime.php',
	data: 'cedula='+cedula,
	success: function(data) {
		var str=data;
		var usuario=str.split("|"); 
		//PARA SABER SI EL REGISTRO TRAE ALGO
		//alert(data);
		//alert(usuario[0]);
		
		if(usuario[0]!="")
		{	
				if(usuario[0]==-2)
				{
					//AQUI ES QUE NO EXISTE
					$("input[name='ced_afiliado']").val('');
					$("input[name='nombre_afiliado1']").val('');
					$("input[name='nombre_afiliado2']").val('');
					$("input[name='apellido_afiliado1']").val('');
					$("input[name='apellido_afiliado2']").val('');
					$("input[name='fnacimiento_afiliado']").val('');
					$("input[name='cbSexo_afiliado']").val('');
					document.getElementById("cbSexo_afiliado").value='-1';
					$("input[name='ced_afiliad']").val('');
					$("input[name='nacionalidad_afiliado']").val('');
					$("input[name='telefono1']").val('');
					$("input[name='email_afiliado1']").val('');
					$("input[name='email_afiliado2']").val('');
					$("input[name='ced_afiliado2']").val('');
					$("input[name='codigo1']").val('');
					$("input[name='codigo2']").val('');
					$("input[name='telefono2']").val('');
					$("input[name='email_afiliado']").val('');
					$("input[name='email_afiliado21']").val('');
					alert("EL NUMERO DE CEDULA NO ESTA REGISTRADO EN EL SAIME POR FAVOR INGRESE UNA CEDULA VALIDA. PARA MAYOR INFORMACION COMUNIQUESE AL 0800TRABAJO (872-22-56).");
				}
				else if(usuario[0]==-1){
					//AQUI ES QUE ESTA CAIDO EL WEBSERVICE
					$("input[name='ced_afiliado']").val('');
					$("input[name='nombre_afiliado1']").val('');
					$("input[name='nombre_afiliado2']").val('');
					$("input[name='apellido_afiliado1']").val('');
					$("input[name='apellido_afiliado2']").val('');
					$("input[name='fnacimiento_afiliado']").val('');
					$("input[name='cbSexo_afiliado']").val('');
					document.getElementById("cbSexo_afiliado").value='-1';
					$("input[name='ced_afiliad']").val('');
					$("input[name='nacionalidad_afiliado']").val('');
					$("input[name='telefono1']").val('');
					$("input[name='email_afiliado1']").val('');
					$("input[name='email_afiliado2']").val('');
					$("input[name='ced_afiliado2']").val('');
					$("input[name='codigo1']").val('');
					$("input[name='codigo2']").val('');
					$("input[name='telefono2']").val('');
					$("input[name='email_afiliado']").val('');
					$("input[name='email_afiliado21']").val('');
					alert("EN ESTOS MOMENTOS NO ES POSIBLE ESTABLECER CONEXION PARA LA VALIDACION DE LOS DATOS CON SAIME, POR FAVOR INTENTE LUEGO.");
				}
				else
				{
					//AQUI TRAE LOS DATOS

					if(usuario[0]=="EL NUMERO DE CEDULA NO ESTA REGISTRADO EN EL SAIME POR FAVOR INGRESE UNA CEDULA VALIDA. ")
					{	
						//limpia campos
						$("input[name='ced_afiliado']").val('');
						$("input[name='nombre_afiliado1']").val('');
						$("input[name='nombre_afiliado2']").val('');
						$("input[name='apellido_afiliado1']").val('');
						$("input[name='apellido_afiliado2']").val('');
						$("input[name='fnacimiento_afiliado']").val('');
						$("input[name='cbSexo_afiliado']").val('');
						document.getElementById("cbSexo_afiliado").value='-1';
						$("input[name='ced_afiliad']").val('');
						$("input[name='nacionalidad_afiliado']").val('');
						$("input[name='telefono1']").val('');
						$("input[name='email_afiliado1']").val('');
						$("input[name='email_afiliado2']").val('');
						$("input[name='ced_afiliado2']").val('');
						$("input[name='codigo1']").val('');
						$("input[name='codigo2']").val('');
						$("input[name='telefono2']").val('');
						$("input[name='email_afiliado']").val('');
						$("input[name='email_afiliado21']").val('');

						//emite mensaje
						alert(usuario[0]+' '+usuario[1]);

					}
					else
					{
						$("input[name='ced_afiliado']").val(usuario[0]);

/* 						if(usuario[1]=='V')
						{
							if(usuario[7]=='F'){
								usuario[1]="VENEZOLANA";
						    }else{
						    	usuario[1]="VENEZOLANO";
						    }
						}
						if(usuario[1]=='E')
						{
							if(usuario[7]=='F'){
								usuario[1]="EXTRANJERA";
							}else{
								usuario[1]="VENEZOLANO";
							}	
						}
						$("input[name='nacionalidad_afiliado']").val(usuario[1]);
 */						$("input[name='nombre_afiliado1']").val(usuario[2]);
						$("input[name='nombre_afiliado2']").val(usuario[3]);
						$("input[name='apellido_afiliado1']").val(usuario[4]);
						$("input[name='apellido_afiliado2']").val(usuario[5]);
						$("input[name='fnacimiento_afiliado']").val(usuario[6]);				
						
						if(usuario[7]=='F'){
							usuario[7]=1;
						}
						if(usuario[7]=='M'){
							usuario[7]=2;	
						}
 						$("#cbSexo_afiliado").val(usuario[7]);
						$("input[name='cbSexo_afiliado']").val(usuario[7]);
				}
				
			}

				$("input[name='ced_afiliado2']").val(usuario[0]);

				
		}
		else
		{
			alert("EL NUMERO DE CEDULA NO ESTA REGISTRADO EN EL SAIME POR FAVOR INGRESE UNA CEDULA VALIDA. PARA MAYOR INFORMACION COMUNIQUESE AL 0800TRABAJO (872-22-56).");
					$("input[name='ced_afiliado']").val('');
						$("input[name='nombre_afiliado1']").val('');
						$("input[name='nombre_afiliado2']").val('');
						$("input[name='apellido_afiliado1']").val('');
						$("input[name='apellido_afiliado2']").val('');
						$("input[name='fnacimiento_afiliado']").val('');
						$("input[name='cbSexo_afiliado']").val('');
						document.getElementById("cbSexo_afiliado").value='-1';
						$("input[name='ced_afiliad']").val('');
						$("input[name='nacionalidad_afiliado']").val('');
						$("input[name='telefono1']").val('');
						$("input[name='email_afiliado1']").val('');
						$("input[name='email_afiliado2']").val('');
						$("input[name='ced_afiliado2']").val('');
						$("input[name='codigo1']").val('');
						$("input[name='codigo2']").val('');
						$("input[name='telefono2']").val('');
						$("input[name='email_afiliado']").val('');
						$("input[name='email_afiliado21']").val('');
		}
	}
	});
   }
}
