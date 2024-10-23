function identificaciudadano() {
    //---Por Cedula---
    var cedula = document.getElementById("cedulaconsulta").value;
    var nacionalidad = document.getElementById("nacionalidad").value;

    if (cedula != '') {
        $.ajax({
            data: {"cedula": +cedula, "nacionalidad": +nacionalidad},
            url: "identifica_ciudadano.php",
            type: "POST",
            dataType: 'json',
            cache: false,
            success: function(data) {
                console.log(data);
                if (data.response == 'success') {
                    document.getElementById("fechanac").value = data.fechanac;
                    document.getElementById("fecha_nacimiento").value = data.fechanac;
                    document.getElementById("edad").value = data.edad;
                    document.getElementById("primer_nombre").value = data.primer_nombre;
                    document.getElementById("segundo_nombre").value = data.segundo_nombre;
                    document.getElementById("primer_apellido").value = data.primer_apellido;
                    document.getElementById("segundo_apellido").value = data.segundo_apellido;
					 document.getElementById("cbo_sexo").value = data.sexo;

					/* var sexo = document.getElementById("sexo").innerHTML = data.sexo;
					
					  if (data.sexo == 'M'){
						 var sexo2 = 'MASCULINO'; 
						} 
						if (data.sexo == 'F'){ 
							var sexo2 = 'FEMENINO'; 

					} 
					document.getElementById("sexo2").value = sexo2;  */

                    // Here's the important part for "apellidonombre"
                    if (data.apellidonombre) {
                        document.getElementById("apellidonombre").value = data.apellidonombre;
                    } else {
                        console.error("apellidonombre not found in response");
                    }

                    document.getElementById("cedulaidentida").value = data.cedulaidentida;
                } else {
                    alert("Cédula de Identidad no encontrada.");
                }
            },
            error: function() {
                alert("Problemas al Intentar la búsqueda.");
            }
        });
    } else {
        alert("INTRODUZCA CEDULA");
        return true;
	}
}


