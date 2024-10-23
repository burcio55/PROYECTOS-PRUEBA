function buscar() {
    let contador = 0;
    let nacionalidad = document.getElementById("nacionalidad");
    let cedula = document.getElementById("cedula");

    if (nacionalidad.value == "-1") {
        nacionalidad.style.border = "1px solid red";
        contador++;
    } else {
        nacionalidad.style.border = "";
    }

    if (cedula.value == "") {
        cedula.style.border = "1px solid red";
        contador++;
    } else {
        cedula.style.border = "";
    }

    if (contador > 0) {
        document.getElementById("texto").innerText = "Debe llenar los Datos obligatorios (*) para continuar";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; // Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
        document.getElementById("validador").value = "";
    } else {
        $.ajax({
            url: 'validar_usuario.php',
            type: 'GET',
            data: {
                accion: 1,
                cedula: cedula.value
            },
            success: function(resp) {
                let responseParts = resp.split(" / ");
                let v0 = responseParts[0];
                let v1 = responseParts[1];
                let v2 = responseParts[2];

                if (v0 == '1') {
                    document.getElementById("nombres").value = v1;
                    document.getElementById("rol").value = v2;
                } else {
                    document.getElementById("nombres").value = "";
                    document.getElementById("rol").value = "-1";
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; // Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    document.getElementById("validador").value = "";
                }
            },
            error: function() {
                document.getElementById("texto").innerText = "Error en la solicitud. Por favor, intente nuevamente.";
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; // Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
                document.getElementById("validador").value = "";
            }
        });
    }
}

function asignar(){
    let contador = 0;
    let nacionalidad = document.getElementById("nacionalidad");
    let cedula = document.getElementById("cedula");
    let nombres = document.getElementById("nombres");
    let rol = document.getElementById("rol");

    if(nacionalidad.value == "-1"){
        nacionalidad.style.border = "1px solid red";
        contador++;
    }else{
        nacionalidad.style.border = "";
    }

    if(cedula.value == ""){
        cedula.style.border = "1px solid red";
        contador++;
    } else {
        cedula.style.border = "";
    }

    if(rol.value == "-1"){
        rol.style.border = "1px solid red";
        contador++;
    }else{
        rol.style.border = "";
    }

    if(nombres.value == ""){
        nombres.style.border = "1px solid red";
        contador++;
    } else {
        nombres.style.border = "";
    }

    if(contador > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        $.ajax({
            url: 'validar_usuario.php',
            type: 'GET',
            data: {
                accion: 2,
                cedula: cedula.value,
                rol: rol.value
            },
            success: function(resp){
                /* alert(resp); */
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                if(v0 == '1')
                {
                document.getElementById("texto").innerText = ("¡Se asigno con éxito el rol al usuario!");
                  document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                  document.getElementById("titulo").style.color = "white";
                  document.getElementById("observacion").style.display = "block";  

                    nacionalidad.value = "-1";
                    cedula.value = "";
                    nombres.value = "";
                    rol.value = "-1"; 
                }else{
              /*       alert('mal') */
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }
            }
        });
    } 

}

function inhabilitar() {
    let contador = 0;
    let nacionalidad = document.getElementById("nacionalidad");
    let cedula = document.getElementById("cedula");
    let nombres = document.getElementById("nombres");
    let rol = document.getElementById("rol");

    if (nacionalidad.value == "-1") {
        nacionalidad.style.border = "1px solid red";
        contador++;
    } else {
        nacionalidad.style.border = "";
    }

    if (cedula.value == "") {
        cedula.style.border = "1px solid red";
        contador++;
    } else {
        cedula.style.border = "";
    }

    if (rol.value == "-1") {
        rol.style.border = "1px solid red";
        contador++;
    } else {
        rol.style.border = "";
    }

    if (nombres.value == "") {
        nombres.style.border = "1px solid red";
        contador++;
    } else {
        nombres.style.border = "";
    }

    if (contador > 0) {
        document.getElementById("texto").innerText = "Debe llenar los Datos obligatorios (*) para continuar";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; // Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
        document.getElementById("validador").value = "";
    } else {
        $.ajax({
            url: 'validar_usuario.php',
            type: 'GET',
            data: {
                accion: 3,
                cedula: cedula.value || '' // Asegurarse de que cedula siempre tenga un valor
            },
            success: function(resp) {
                let [v0, v1] = resp.split(" / ");
                if (v0 == '1') {
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; // Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    document.getElementById("validador").value = "";
                    nacionalidad.value = "-1";
                    cedula.value = "";
                    nombres.value = "";
                    rol.value = "-1";
                } else {
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; // Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    document.getElementById("validador").value = "";
                }
            },
            error: function() {
                document.getElementById("texto").innerText = "Error en la solicitud. Intente nuevamente.";
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; // Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
            }
        });
    }
}

function finalizar(){
    let validador = document.getElementById("validador");
    if(validador.value == "1"){
        location.reload();
    }else{
        document.getElementById("observacion").style.display = "none";
    }
}