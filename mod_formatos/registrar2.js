function cerrar(){
    document.getElementById("observacion").style.display = "none";  
    
} 
document.addEventListener('DOMContentLoaded', function() {
    nombre_apellido = document.getElementById("nombre_apellido");
    cedula = document.getElementById("cedula");
    cargo_titular = document.getElementById("cargo_titular");
    codigo_nomina = document.getElementById("codigo_nomina");
    gmail = document.getElementById("gmail");
    ubicacion_adcripcion = document.getElementById("ubicacion_adcripcion");
    ingreso_ministerio = document.getElementById("ingreso_ministerio");
    antiguedad = document.getElementById("antiguedad");
    servicio_APN = document.getElementById("antiguedad_apn");
    total_servicio_APN = document.getElementById("antiguedad_apn_final");
    lapso_vacacional = document.getElementById("lapso_vacacional");
    fecha_deseada = document.getElementById("fecha_deseada");
    $.ajax({
        url: 'interaccion2.php?nombre_apellido='+nombre_apellido.value+'&cedula='+cedula.value+'&cargo_titular='+cargo_titular.value+
        '&codigo_nomina='+codigo_nomina.value+'&gmail='+gmail.value+'&ubicacion_adcripcion='+ubicacion_adcripcion.value+
        '&ingreso_ministerio='+ingreso_ministerio.value+'&antiguedad='+antiguedad.value+'&servicio_APN='+servicio_APN.value+'&total_servicio_APN='+total_servicio_APN.value+'&lapso_vacacional='+lapso_vacacional.value+
        '&fecha_deseada='+fecha_deseada.value,
        type: 'GET',
        success: function(resp){
            /* alert(resp);  */
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            let v2 = resp.split(" / ")[2];
            let v3 = resp.split(" / ")[3];
            let v4 = resp.split(" / ")[4];
            let v5 = resp.split(" / ")[5];
            let v6 = resp.split(" / ")[6];
            let v7 = resp.split(" / ")[7];
            let v8 = resp.split(" / ")[8];
            let v9 = resp.split(" / ")[9];
            let v10 = resp.split(" / ")[10];
            let v11 = resp.split(" / ")[11];
            let v12 = resp.split(" / ")[12];
            let v13 = resp.split(" / ")[13];
            if(v0 == '1')
                {
                    document.getElementById("nombre_apellido").value = v1; 
                    document.getElementById("cedula").value = v2; 
                    document.getElementById("codigo_nomina").value=v3;
                    document.getElementById("gmail").value=v4;
                    document.getElementById("cargo_titular").value=v5;
                    document.getElementById("ubicacion_adcripcion").value=v6;

                    document.getElementById("ingreso_ministerio").value=v7;

                    document.getElementById("antiguedad").value=v8;
                    
                    document.getElementById("antiguedad_apn").value=v9;
                    document.getElementById("antiguedad_apn_final").value=v10;
                    document.getElementById("lapso_vacacional").value=v11;
                    document.getElementById("fecha_deseada").value=v12;
                    $('#funcionario2').html(v13);

                    /* document.getElementById("texto").innerText = "Se extrajeron correctamente los datos";
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block"; */

                    /* window.location.href = "index.php?nombre="+v1+"&apellido="+v2+"&ubicacion_adm="+v3+"&ubicacion_fisica_actual="+v4+"&cargo="+v5+"&scargo_actual_ejerce="+v6+"&cedula="+v7+"&nacionalidad="+nacionalidad.value+"&id="+cedula.value; */
                }else{
                    document.getElementById("texto").innerText = "Usuario no encontrada, por favor intente otra vez";
                    /*  document.getElementById("texto").innerText = resp; */
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }
        }
    })
});

function imprimir2() {
    let contador = 0;

    let fechaDeseada = document.getElementById("fecha_deseada").value;
    let ingreso_ministerio = document.getElementById("ingreso_ministerio").value;
    fechaDeseada = new Date(fechaDeseada);
    ingreso_ministerio = new Date(ingreso_ministerio);

    // Validar si la fecha deseada es mayor que la fecha a comparar
    if (fechaDeseada > ingreso_ministerio) {
        document.getElementById("fecha_deseada").style.border = "";
    } else {
        document.getElementById("texto").innerText = "La fecha deseada no es válida.";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; // Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
        contador++;
        document.getElementById("fecha_deseada").style.border = "2px solid red";
    }

    var emailField = document.getElementById("gmail");
var email = emailField.value;
var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

const invalidEmailMessage = "Por favor, introduce una dirección de correo válida.";
const errorBorderColor = "2px solid red";
const validBorderColor = "";

if (email === "") {
    contador++;
    emailField.style.border = errorBorderColor;
    document.getElementById("texto").innerText = invalidEmailMessage;
    document.getElementById("titulo").style.backgroundColor = "#DC3831"; // Rojo
    document.getElementById("titulo").style.color = "white";
    document.getElementById("observacion").style.display = "block";
} else if (!emailRegex.test(email)) {
    contador++;
    emailField.style.border = errorBorderColor;
    document.getElementById("texto").innerText = invalidEmailMessage;
    document.getElementById("titulo").style.backgroundColor = "#DC3831"; // Rojo
    document.getElementById("titulo").style.color = "white";
    document.getElementById("observacion").style.display = "block";
} else {
    emailField.style.border = validBorderColor;
    document.getElementById("texto").innerText = "";
    document.getElementById("titulo").style.backgroundColor = "";
    document.getElementById("titulo").style.color = "";
    document.getElementById("observacion").style.display = "none";
}
    if (document.getElementById("cargo_titular").value == "") {
        contador++;
        document.getElementById("cargo_titular").style.border = "2px solid red";
    } else {
        document.getElementById("cargo_titular").style.border = "";
    }

    if (document.getElementById("antiguedad_apn").value == "") {
        contador++;
        document.getElementById("antiguedad_apn").style.border = "2px solid red";
    } else {
        document.getElementById("antiguedad_apn").style.border = "";
    }

    if (document.getElementById("lapso_vacacional").value == "") {
        contador++;
        document.getElementById("lapso_vacacional").style.border = "2px solid red";
    } else {
        document.getElementById("lapso_vacacional").style.border = "";
    }

    if (document.getElementById("fecha_deseada").value == "") {
        contador++;
        document.getElementById("fecha_deseada").style.border = "2px solid red";
    } else {
        document.getElementById("fecha_deseada").style.border = "";
    }

    if (document.getElementById("jefe_inmediato").value == "") {
        contador++;
        document.getElementById("jefe_inmediato").style.border = "2px solid red";
    } else {
        document.getElementById("jefe_inmediato").style.border = "";
    }

    if (document.getElementById("director").value == "") {
        contador++;
        document.getElementById("director").style.border = "2px solid red";
    } else {
        document.getElementById("director").style.border = "";
    }

    if (contador > 0) {
        document.getElementById("texto").innerText = "Debe llenar los Campos Obligatorios (*).";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; // Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
        return false;
    } else {
        window.open("imprimir2.php?cargo_titular=" + document.getElementById("cargo_titular").value + "&gmail=" + email + '&antiguedad_apn=' + document.getElementById("antiguedad_apn").value + '&antiguedad_apn_final=' + document.getElementById("antiguedad_apn_final").value +
        '&lapso_vacacional=' + document.getElementById("lapso_vacacional").value + '&fecha_deseada=' + document.getElementById("fecha_deseada").value + '&jefe_inmediato=' + document.getElementById("jefe_inmediato").value + '&director=' + document.getElementById("director").value);
    }

    window.onpopstate = function() {
        window.location.href = "vacaciones.php";
    };
}

history.pushState({ page: 'vacaciones' }, 'Vacaciones', 'vacaciones.php');
window.onpopstate = function() {
    if (history.state && history.state.page === 'vacaciones') {
        window.location.href = "vacaciones.php";
    }
};
