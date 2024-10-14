
function buscar(e) {
    let valor = 0;
    let incidenciaElement = document.getElementById("incidencia");
    const incidencia = incidenciaElement.value.trim();
    let input2 = document.getElementById("cedula2");
    if (e == 2) {
        if (input2.value === "") {
          input2.style.borderColor = "Red";
          valor++;
          console.log("input2 está vacío, valor incrementado:", valor);
        } else {
          input2.style.borderColor = "#999999";
          console.log("input2 tiene valor, borde restablecido");
        }
    }
    if (valor > 0) {
        document.getElementById("mensaje").style.textAlign = "center";
        document.getElementById("mensaje").textContent = 'Debe ingresar la "Cédula de Identidad" para continuar';
        document.getElementById("alerta").style.display = "block";
        document.getElementById("titulo").style.backgroundColor = "#DC3831";
    } else {
        if (e == 2) {
                let input2 = document.getElementById("cedula2").value;
                $.ajax({
                url: "/minpptrassi/mod_evaluacion/buscar2.php",
                type: "POST",
                data: {
                    input2: input2,
                },
                success: function (resp) {
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
                let v14 = resp.split(" / ")[14];
                let v15 = resp.split(" / ")[15];
                let v16 = resp.split(" / ")[16];
                let v17 = resp.split(" / ")[17];
                if (resp.startsWith("ERROR:")) {
                    // Mostrar el mensaje de error con estilos
                    document.getElementById("mensaje").style.textAlign = "center";
                    document.getElementById("mensaje").textContent = resp.substring(6); // Remover "ERROR: "
                    document.getElementById("titulo").style.backgroundColor = "#DC3831";
                    document.getElementById("alerta").style.display = "block";
                }
                if (v0 == "0") {
                    document.getElementById("mensaje").style.textAlign = "center";
                    document.getElementById("mensaje").textContent = "Está Cédula de Identidad no se encuentra en el Sistema";
                    document.getElementById("alerta").style.display = "block";
                    document.getElementById("titulo").style.backgroundColor = "#DC3831";
                    /* Está Cédula de Identidad no se encuentra en el Sistema */
                    } else {
                        $("#nombre_apellido2").val(v1.toUpperCase());
                        $("#codigo2").val(v2.toUpperCase());
                        $("#cargo2").val(v3.toUpperCase());
                        $("#ubicacion_adm2").val(v4.toUpperCase());
                        $("#ubicacion_act2").val(v5.toUpperCase());
                        $("#cargo_ejerce2").val(v6.toUpperCase());
            
                        $("#persona_id2").val(v7.toUpperCase());
                        $("#rol_evaluacion2").val(v8.toUpperCase());
                        $("#periodo_evaluacion2").val(v9.toUpperCase());
                        $("#nanno_evalu2").val(v10.toUpperCase());
                        $("#cargo_id2").val(v11.toUpperCase());
                        $("#ubicacion_scodigo2").val(v12.toUpperCase());
                        $("#codigo_tipos_trabajadores2").val(v13.toUpperCase());
                        $("#tipo_trabajador2").val(v14.toUpperCase());
                        $("#incidencia").val(values[15].toUpperCase());
                        $("#incidencia_fecha").val(values[16].toUpperCase());
                        $("#incidencia_observacion").val(values[17].toUpperCase());
            
                        document.getElementById("nombre_apellido2").style.borderColor = "";
                        document.getElementById("cargo2").style.borderColor = "";
                        document.getElementById("ubicacion_adm2").style.borderColor = "";
                        document.getElementById("ubicacion_act2").style.borderColor = "";
                        document.getElementById("cargo_ejerce2").style.borderColor = "";
                        document.getElementById("codigo2").style.borderColor = "";
                        document.getElementById("tipo_trabajador2").style.borderColor = "";

                        document.getElementById("razon").value = "-1";
                        document.getElementById("persona_id2").value = "";
                        document.getElementById("desde2").value = "";
                        document.getElementById("hasta2").value = "";
                        document.getElementById("obs").value = "";
                    }
                },
            });
        }
    }

    
}

function permiso(){
    let valor = 0;
    let mensaje_p = "";
    let mensaje_m = "";
    let mensaje1 = "";
    let mensaje2 = "";

    let cedula2 = document.getElementById("cedula2").value;
    let razon = document.getElementById("razon").value;
    let persona_id2 = document.getElementById("persona_id2").value;
    let desde2 = document.getElementById("desde2").value;
    let hasta2 = document.getElementById("hasta2").value;
    let obs = document.getElementById("obs").value;

    if(document.getElementById("cedula2").value == ""){
        document.getElementById("cedula2").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("cedula2").style.borderColor = "#999999";
    }
    if(document.getElementById("nombre_apellido2").value == ""){
        document.getElementById("nombre_apellido2").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("nombre_apellido2").style.borderColor = "#999999";
    }
    if(document.getElementById("razon").value == "-1"){
        document.getElementById("razon").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("razon").style.borderColor = "#999999";
    }
    if(document.getElementById("desde2").value == ""){
        document.getElementById("desde2").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("desde2").style.borderColor = "#999999";
    }
    if(document.getElementById("hasta2").value == ""){
        document.getElementById("hasta2").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("hasta2").style.borderColor = "#999999";
    }

    if(valor > 0){
        mensaje_m = "Debe llenar los Campos Obligatorios (*)";
    }
    if(mensaje_p != "" && mensaje_m != ""){
        mensaje1 = mensaje_m+" y "+mensaje_p;
    }else
    if(mensaje_p != "" || mensaje_m != ""){
        mensaje1 = mensaje_m+" "+mensaje_p;
        /* document.getElementById("mensaje").textContent = mensaje_m+mensaje_p; */
        /* document.getElementById("alerta").style.display = "block"; */
    }
    if(mensaje1 != "" || mensaje2 != ""){
        document.getElementById("mensaje").textContent = mensaje1+" "+mensaje2;
        document.getElementById("alerta").style.display = "block";
        document.getElementById("mensaje").style.textAlign = "center";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"
    }else{
        $.ajax({
            url: '/minpptrassi/mod_evaluacion/accion_incidencias.php',
            type: 'POST',
            data: {
                cedula2: cedula2,
                razon: razon,
                desde2: desde2,
                hasta2: hasta2,
                persona_id2: persona_id2,
                obs: obs,
                accion: 4
            },
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                if (v0 == '0'){
                    document.getElementById("mensaje").style.textAlign = "center";
                    document.getElementById("mensaje").textContent = v1;
                    document.getElementById("alerta").style.display = "block";
                }else{
                    document.getElementById("mensaje").style.textAlign = "center";
                    document.getElementById("mensaje").textContent = v1;
                    document.getElementById("alerta").style.display = "block";
                    
                    document.getElementById("cedula2").value = "";
                    document.getElementById("nombre_apellido2").value = "";
                    document.getElementById("razon").value = "-1";
                    document.getElementById("desde2").value = "";
                    document.getElementById("hasta2").value = "";
                    document.getElementById("obs").value = "";
                }
            }
        })
    }
}

/* cerrar alert */

function cerrar(){
    document.getElementById("alerta").style.display = "none";
}

function accion_agregar_incidencia(){
    let valor = 0;
    let mensaje_p = "";
    let mensaje_m = "";
    let mensaje1 = "";
    let mensaje2 = "";

    let incidencia = document.getElementById("incidencia").value;

    if(document.getElementById("incidencia").value == ""){
        document.getElementById("incidencia").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("incidencia").style.borderColor = "#999999";
    }

    if(valor > 0){
        mensaje_m = "Debe llenar los Campos Obligatorios (*)";
    }
    if(mensaje_p != "" && mensaje_m != ""){
        mensaje1 = mensaje_m+" y "+mensaje_p;
    }else
    if(mensaje_p != "" || mensaje_m != ""){
        mensaje1 = mensaje_m+" "+mensaje_p;
        /* document.getElementById("mensaje").textContent = mensaje_m+mensaje_p; */
        /* document.getElementById("alerta").style.display = "block"; */
    }
    if(mensaje1 != "" || mensaje2 != ""){
        document.getElementById("mensaje").textContent = mensaje1+" "+mensaje2;
        document.getElementById("alerta").style.display = "block";
        document.getElementById("mensaje").style.textAlign = "center";
    }else{
        $.ajax({
            url: '/minpptrassi/mod_evaluacion/accion_incidencias.php',
            type: 'POST',
            data: {
                incidencia: incidencia,
                accion: 1
            },
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if (v0 == '0'){
                    document.getElementById("mensaje").style.textAlign = "center";
                    document.getElementById("mensaje").textContent = "Falló el Sistema";
                    document.getElementById("alerta").style.display = "block";
                }else{
                    document.getElementById("mensaje").style.textAlign = "center";
                    document.getElementById("mensaje").textContent = v1;
                    document.getElementById("alerta").style.display = "block";
                    $('#fe').html(v2);
                }
            }
        })
    }
}

function accion_eliminar_incidencia(id_incidencia){
    /* alert (id_incidencia); */
    $.ajax({
        url: '/minpptrassi/mod_evaluacion/accion_incidencias.php',
        type: 'POST',
        data: {
            id_incidencia: id_incidencia,
            accion: 2
        },
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if (v0 == '0'){
                document.getElementById("mensaje").style.textAlign = "center";
                document.getElementById("mensaje").textContent = "Falló el Sistema";
                document.getElementById("alerta").style.display = "block";
            }else{
                document.getElementById("mensaje").style.textAlign = "center";
                document.getElementById("mensaje").textContent = v1;
                document.getElementById("alerta").style.display = "block";
                $('#fe').html(v2);
            }
        }
    })
}

function accion_modificar_incidencia(id, sdescripcion) {

    /* alert(id); */

    $("#id_incidencia").val(id);
    $("#incidencia").val(sdescripcion);

    $('#guardar').css('display','none');
    $('#mod').css('display','block');
}

function accion_incidencia_mod(id_incidencia,incidencia){

    let valor = 0;
    let mensaje_p = "";
    let mensaje_m = "";
    let mensaje1 = "";
    let mensaje2 = "";

    if(document.getElementById("incidencia").value == ""){
        document.getElementById("incidencia").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("incidencia").style.borderColor = "#999999";
    }

    if(valor > 0){
        mensaje_m = "Debe llenar los Campos Obligatorios (*)";
    }
    if(mensaje_p != "" && mensaje_m != ""){
        mensaje1 = mensaje_m+" y "+mensaje_p;
    }else
    if(mensaje_p != "" || mensaje_m != ""){
        mensaje1 = mensaje_m+" "+mensaje_p;
        /* document.getElementById("mensaje").textContent = mensaje_m+mensaje_p; */
        /* document.getElementById("alerta").style.display = "block"; */
    }
    if(mensaje1 != "" || mensaje2 != ""){
        document.getElementById("mensaje").textContent = mensaje1+" "+mensaje2;
        document.getElementById("alerta").style.display = "block";
        document.getElementById("mensaje").style.textAlign = "center";
    }else{
        $.ajax({
            url: '/minpptrassi/mod_evaluacion/accion_incidencias.php',
            type: 'POST',
            data: {
                id_incidencia: id_incidencia,
                incidencia: incidencia,
                accion: 3
            },
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if (v0 == '0'){
                    document.getElementById("mensaje").style.textAlign = "center";
                    document.getElementById("mensaje").textContent = "Falló el Sistema";
                    document.getElementById("alerta").style.display = "block";
                }else{
                    document.getElementById("mensaje").style.textAlign = "center";
                    document.getElementById("mensaje").textContent = v1;
                    document.getElementById("alerta").style.display = "block";

                    $('#guardar').css('display','block');
                    $('#mod').css('display','none');
                    $('#fe').html(v2);
                }
            }
        })
    }
}

/* cerrar alert */

function cerrar(){
    document.getElementById("alerta").style.display = "none";
}