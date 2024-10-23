 function cerrar(){
    document.getElementById("observacion").style.display = "none";  
    
} 

document.addEventListener('DOMContentLoaded', function() {
    nombre_apellido = document.getElementById("nombre_apellido");
    cedula = document.getElementById("cedula");
    cargo_titular = document.getElementById("cargo_titular");
    codigo_nomina = document.getElementById("codigo_nomina");
    ubicacion_adcripcion = document.getElementById("ubicacion_adcripcion");
    subicacion_fisica = document.getElementById("adscrito");
    $.ajax({
        url: 'interaccion.php?nombre_apellido='+nombre_apellido.value+'&cedula='+cedula.value+'&cargo_titular='+cargo_titular.value+
        '&codigo_nomina='+codigo_nomina.value+'&ubicacion_adcripcion='+ubicacion_adcripcion.value+'&adscrito='+adscrito.value,
        type: 'GET',
        success: function(resp){
          /*   alert(resp); */
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            let v2 = resp.split(" / ")[2];
            let v3 = resp.split(" / ")[3];
            let v4 = resp.split(" / ")[4];
            let v5 = resp.split(" / ")[5];
            let v6 = resp.split(" / ")[6];
            let v7 = resp.split(" / ")[7];
            if(v0 == '1')
                {
                    document.getElementById("nombre_apellido").value = v1; 
                    document.getElementById("cedula").value = v2; 
                    document.getElementById("cargo_titular").value = v3;
                    document.getElementById("codigo_nomina").value = v4;
                    document.getElementById("ubicacion_adcripcion").value = v5; 
                    document.getElementById("adscrito").value = v6;
                    $('#funcionario').html(v7);

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

function imprimir() {
    let contador = 0;
    const campos = ["cargo_titular", "adscrito", "motivo", "soporte_legal", "fecha_inicio", "fecha_final", "duracion", "jefe_inmediato", "director"];

    campos.forEach(campo => {
        const elemento = document.getElementById(campo);
        if (elemento.value == "") {
            contador++;
            elemento.style.border = "2px solid red";
        } else {
            elemento.style.border = "";
        }
    });

    // Validar fechas específicas
    const fechaInicio = document.getElementById("fecha_inicio").value;
    const fechaFinal = document.getElementById("fecha_final").value;

    if (fechaInicio === "" || fechaFinal === "") {
        contador++;
        document.getElementById("texto").innerText = "Debe ingresar tanto la fecha de inicio como la fecha final.";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; // Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
        //alert("Debe ingresar tanto la fecha de inicio como la fecha final.");
        document.getElementById("duracion").value = " ";
    }

    if (contador > 0) {
        document.getElementById("texto").innerText = "Debe llenar los Campos Obligatorios (*).";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; // Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    } else {
        // Guardar la página actual en el historial
        history.pushState(null, null, location.href);
        
        // Construir la URL con los parámetros
        var url = "imprimir.php?cargo_titular=" + document.getElementById("cargo_titular").value + 
                  "&adscrito=" + document.getElementById("adscrito").value + 
                  "&motivo=" + document.getElementById("motivo").value + 
                  "&soporte_legal=" + document.getElementById("soporte_legal").value + 
                  "&fecha_inicio=" + document.getElementById("fecha_inicio").value + 
                  "&fecha_final=" + document.getElementById("fecha_final").value + 
                  "&duracion=" + document.getElementById("duracion").value + 
                  "&jefe_inmediato=" + document.getElementById("jefe_inmediato").value + 
                  "&director=" + document.getElementById("director").value;

        // Abrir la URL en una nueva pestaña
        window.open(url, '_blank');
    }

    // Interceptar el evento de retroceso
    window.onpopstate = function() {
        window.location.href = "index.php";
    };
}

const fechaInicio = document.getElementById('fecha_inicio');
const fechaFinal = document.getElementById('fecha_final');
const duracion = document.getElementById('duracion');

fechaFinal.addEventListener('change', function() {
    const inicio = new Date(fechaInicio.value);
    const fin = new Date(fechaFinal.value);

    // Validar si ambas fechas están ingresadas y son válidas
   /*  if (isNaN(inicio.getTime())) {
        alert("La fecha de inicio no es válida.");
        return;
    }
    if (isNaN(fin.getTime())) {
        alert("La fecha final no es válida.");
        return;
    } */
    /* const hoy = new Date();
    if (fin < hoy) {
        alert("Las fechas no pueden ser anteriores a hoy.");
        return;
    } */
    calcularDuracion();
});

function calcularDuracion() {
    const inicio = new Date(fechaInicio.value);
    const fin = new Date(fechaFinal.value);

    // Calcular la diferencia en milisegundos y convertir a días
    const diferenciaMilisegundos = fin.getTime() - inicio.getTime();
    const diferenciaDias = Math.round(diferenciaMilisegundos / (1000 * 60 * 60 * 24));

    // Mostrar resultado
    if (diferenciaDias > 0) {
        duracion.value = diferenciaDias + (diferenciaDias === 1 ? " día" : " días");
        duracion.disabled = true;
    } else if (diferenciaDias === 0) {
        duracion.value = " ";
        duracion.disabled = false;
       /*  alert("Puedes ahora escribir en la Duración") */
    } else {
        /* alert("La fecha final debe ser igual o mayor que fecha inicial."); */
        duracion.value = "";
        fechaFinal.value = "";
        duracion.disabled = true;
    }
}

// Agregar eventos para calcular la duración automáticamente cuando se cambian las fechas
fechaInicio.addEventListener('change', calcularDuracion);
fechaFinal.addEventListener('change', calcularDuracion);


function imprimir2() {
    let contador = 0;
    const campos = ["cargo_titular", "adscrito", "motivo", "soporte_legal", "fecha_inicio", "fecha_final", "duracion", "jefe_inmediato", "director"];

    campos.forEach(campo => {
        const elemento = document.getElementById(campo);
        if (elemento.value == "") {
            contador++;
            elemento.style.border = "2px solid red";
        } else {
            elemento.style.border = "";
        }
    });

    const fechaInicio = document.getElementById("fecha_inicio").value;
    const fechaFinal = document.getElementById("fecha_final").value;

    if (fechaInicio === "" || fechaFinal === "") {
        contador++;
        
        document.getElementById("texto").innerText = "Debe ingresar tanto la fecha de inicio como la fecha final.";
        document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
     /*    alert("Debe ingresar tanto la fecha de inicio como la fecha final."); */
        document.getElementById("duracion").value = " ";
    }

    if (contador > 0) {
        document.getElementById("texto").innerText = "Debe llenar los Campos Obligatorios (*).";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; // Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    } else {
        // Guardar la página actual en el historial
        history.pushState(null, null, location.href);
        var url = "imprimir3.php?cargo_titular=" + document.getElementById("cargo_titular").value + 
                  "&adscrito=" + document.getElementById("adscrito").value + 
                  "&motivo=" + document.getElementById("motivo").value + 
                  "&soporte_legal=" + document.getElementById("soporte_legal").value + 
                  "&fecha_inicio=" + document.getElementById("fecha_inicio").value + 
                  "&fecha_final=" + document.getElementById("fecha_final").value + 
                  "&duracion=" + document.getElementById("duracion").value + 
                  "&jefe_inmediato=" + document.getElementById("jefe_inmediato").value + 
                  "&director=" + document.getElementById("director").value;

            // Reemplazar la URL actual con la nueva URL
            window.open(url, '_blank');
    }

    // Interceptar el evento de retroceso
    window.onpopstate = function() {
        window.location.href = "permiso.php";
    };
}

