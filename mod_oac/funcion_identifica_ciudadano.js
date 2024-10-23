function identificaciudadano() { //---Por Cedula--- 
	var cedula = document.getElementById("cedulaconsulta").value;
	var nacionalidad = document.getElementById("nacionalidad").value;
//	alert(cedula);
//		alert(nacionalidad);
	if(cedula != ''){
		
		
			$.ajax({ 
			data: {"cedula":+cedula,"nacionalidad":+nacionalidad},
			url: "identifica_ciudadano.php",
			type: "POST",
			dataType: 'json',
			cache: false,
			success: 
		
				function(data){
					if(data.response == 'success'){
						var descripcion = document.getElementById("apellidonombre").innerHTML = data.apellidonombre;
						
						 document.getElementById("apellidonombre").value = descripcion;
 alert(descripcion);
					}else{
							$.ajax({ 
							data: {"cedula":+cedula,"nacionalidad":+nacionalidad},
							url: "identifica_ciudadano_SAIME.php",
							type: "POST",
							dataType: 'json',
							cache: false,
							success: 
								function(data){
									if(data.response == 'success'){
										var descripcion = document.getElementById("apellidonombre").innerHTML = data.apellidonombre;
										document.getElementById("apellidonombre").value = descripcion;
				
									}else{
										document.getElementById("apellidonombre").innerHTML = "";
										alert(data.mensaje);
									}
								},
							error: 
								function(){
									var mjs="ERROR JSON";
									alert(mjs);
								}
							});
					}
				},
				
			error: 
				function(){
					var mjs="ERROR JSON";
                    alert(mjs);
				}
			});
	}else{
		alert("INTRODUZCA CEDULA");
		 return true;
	}
}
