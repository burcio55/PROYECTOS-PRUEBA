function buscar(e) {
    let valor = 0;
    if (e == 1) {
        let input2 = document.getElementById("cedula2");
        if (input2.value == "") {
            input2.style.borderColor = "Red";
            valor++;
        } else {
            input2.style.borderColor = "#999999";
      }
    }
    if (valor > 0) {
        document.getElementById("mensaje").style.textAlign = "center";
        document.getElementById("mensaje").textContent ='Debe ingresar la "Cédula de Identidad" para continuar';
        document.getElementById("alerta").style.display = "block";
    } else {
        if (e == 1) {
            let input2 = document.getElementById("cedula2").value;
            $.ajax({
                url: "funcion.php",
                type: "GET",
                data: {
                    cedula: input2,
                    accion: e
                },
                success: function (resp) {
                    let v0 = resp.split(" / ")[0];
                    let v1 = resp.split(" / ")[1];
                    if (v0 == "0") {
                        document.getElementById("mensaje").style.textAlign = "center";
                        document.getElementById("mensaje").textContent = "Está Cédula de Identidad no se encuentra en el Sistema";
                        document.getElementById("alerta").style.display = "block";
                        /* Está Cédula de Identidad no se encuentra en el Sistema */
                    } else {
                        document.getElementById("nombre_apellido2").value = v1;
                        //$("#nombre_apellido2").val(v1.toUpperCase());
                    }
                },
            });
        }
    }
}
function asignar(){
    let valor = 0;
    if (document.getElementById("cedula2").value == "") {
        document.getElementById("cedula2").style.borderColor = "Red";
        valor++;
    } else {
        document.getElementById("cedula2").style.borderColor = "#999999";
    }
    if (document.getElementById("nombre_apellido2").value == "") {
        document.getElementById("nombre_apellido2").style.borderColor = "Red";
        valor++;
    } else {
        document.getElementById("nombre_apellido2").style.borderColor = "#999999";
    }
    if (document.getElementById("rol").value == "") {
        document.getElementById("rol").style.borderColor = "Red";
        valor++;
    } else {
        document.getElementById("rol").style.borderColor = "#999999";
    }
    if (valor > 0) {
        document.getElementById("mensaje").style.textAlign = "center";
        document.getElementById("mensaje").textContent ='Debe ingresar la "Cédula de Identidad" para continuar';
        document.getElementById("alerta").style.display = "block";
    } else {
        let cedula = document.getElementById("cedula2").value;
        let rol = document.getElementById("rol").value;
        $.ajax({
            url: "funcion.php",
            type: "GET",
            data: {
                cedula: cedula,
                rol: rol,
                accion: 2
            },
            success: function (resp) {
                let v0 = resp.split(" / ")[0];
                document.getElementById("mensaje").style.textAlign = "center";
                document.getElementById("mensaje").textContent = v0;
                document.getElementById("alerta").style.display = "block";
            },
        });
    }
}
function cerrar() {
    document.getElementById("alerta").style.display = "none";
  }