
function cerrar(){
    document.getElementById("observacion").style.display = "none";
      
}

function cerrar3(){
    document.getElementById("observacion_especial").style.display = "none";
      
}

function cerrar2(){
    document.getElementById("observacion2").style.display = "none";
    $(location).attr("href","adjuntar.php");
}

function borrar(id_reporte){
    id_reporte = document.getElementById("id_reporte").value;

    // Ocultar el elemento con el ID "borrar_registro"
    document.getElementById("borrar_registro").style.display = "none";

    // Configurar el texto de la alerta
    document.getElementById("texto3").innerText = "¿Usted está seguro de eliminar este registro?";
    document.getElementById("titulo3").style.backgroundColor = "#DC3831"; // Rojo
    document.getElementById("titulo3").style.color = "white"; // Color de la letra

    // Mostrar la alerta
    document.getElementById("borrar_registro").style.display = "block";
    //CANCELAR
    document.querySelector("#borrar_registro button[data-bs-toggle='tooltip']").addEventListener("click", function() {
        document.getElementById("borrar_registro").style.display = "none";
    });

    // Agregar evento al botón "Continuar" (o cualquier otro botón)
    document.querySelector("#borrar_registro button[data-bs-toggle='tooltip2']").addEventListener("click", function() {
        document.getElementById("borrar_registro").style.display = "none";
    });


}
    
function busqueda3(){
    let contador = 0;
    let num_informe = document.getElementById("num_informe").value;

    if(document.getElementById("num_informe").value == ""){
        document.getElementById("num_informe").style.border = "1px solid red";
        contador++;
    }else{
        document.getElementById("num_informe").style.border = "";
    }

    if(contador > 0){
        document.getElementById("texto").innerText = "Debe llenar los datos obligatorios";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";//color de la letra
        document.getElementById("observacion").style.display = "block";
    }else{
        $.ajax({
            url: 'interaccion2.php',
            data: {
                num_informe: num_informe,
                accion: 1
            },
            type: 'GET',
            success: function(resp){
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
                if(v0 == '1'){
                    document.getElementById("cedula").value = v1; 
                    document.getElementById("name").value = v2; 
                    document.getElementById("last_name").value = v3; 
                    document.getElementById("ubicacion_adcripcion").value = v4;
                    document.getElementById("subicacion_fisica").value = v5;
                    document.getElementById("cargo_titular").value = v6; 
                    document.getElementById("scargo_actual_ejerce").value = v7;
                    document.getElementById("id_reporte").value = v8;
                    document.getElementById("snro_reporte").value = v9;
                    document.getElementById("nnumero_requer_glpi").value = v10;
                    document.getElementById("ubicacion_administrativa_scodigo").value = v11;
                    $('#loco1').html(v12);

                    document.getElementById("imagis").style.display = "block";

                    document.getElementById("texto").innerText = "Se extrajeron correctamente los datos";
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }else{
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    
                    document.getElementById("imagis").style.display = "none";
                }
            }
        });
    }
}

function busqueda(){
    let contador = 0;
    let num_informe = document.getElementById("num_informe").value;

    if(document.getElementById("num_informe").value == ""){
        document.getElementById("num_informe").style.border = "1px solid red";
        contador++;
    }else{
        document.getElementById("num_informe").style.border = "";
    }

    if(contador > 0){
        document.getElementById("texto").innerText = "Debe llenar los datos obligatorios";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";//color de la letra
        document.getElementById("observacion").style.display = "block";
    }else{
        $.ajax({
            url: 'interaccion2.php',
            data: {
                num_informe: num_informe,
                accion: 1
            },
            type: 'GET',
            success: function(resp){
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
                if(v0 == '1'){
                    document.getElementById("cedula").value = v1; 
                    document.getElementById("name").value = v2; 
                    document.getElementById("last_name").value = v3; 
                    document.getElementById("ubicacion_adcripcion").value = v4;
                    document.getElementById("subicacion_fisica").value = v5;
                    document.getElementById("cargo_titular").value = v6; 
                    document.getElementById("scargo_actual_ejerce").value = v7;
                    document.getElementById("id_reporte").value = v8;
                    document.getElementById("snro_reporte").value = v9;
                    document.getElementById("nnumero_requer_glpi").value = v10;
                    document.getElementById("ubicacion_administrativa_scodigo").value = v11;
                    $('#loco1').html(v12);

                    document.getElementById("imagis").style.display = "block";

/*                  document.getElementById("texto").innerText = "Se actualizó correctamente su registro.";
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block"; */
                }else{
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    
                    document.getElementById("imagis").style.display = "none";
                }
            }
        });
    }
}


function busqueda2(){
    let contador = 0;
    let num_informe = document.getElementById("num_informe").value;

    if(document.getElementById("num_informe").value == ""){
        document.getElementById("num_informe").style.border = "1px solid red";
        contador++;
    }else{
        document.getElementById("num_informe").style.border = "";
    }

    if(contador > 0){
        document.getElementById("texto4").innerText = "Debe llenar los datos obligatorios";
        document.getElementById("titulo4").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo4").style.color = "white";//color de la letra
        document.getElementById("observacion_especial").style.display = "block";
    }else{
        $.ajax({
            url: 'interaccion2.php',
            data: {
                num_informe: num_informe,
                accion: 1
            },
            type: 'GET',
            success: function(resp){
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
                if(v0 == '1'){
                    document.getElementById("cedula").value = v1; 
                    document.getElementById("name").value = v2; 
                    document.getElementById("last_name").value = v3; 
                    document.getElementById("ubicacion_adcripcion").value = v4;
                    document.getElementById("subicacion_fisica").value = v5;
                    document.getElementById("cargo_titular").value = v6; 
                    document.getElementById("scargo_actual_ejerce").value = v7;
                    document.getElementById("id_reporte").value = v8;
                    document.getElementById("snro_reporte").value = v9;
                    document.getElementById("nnumero_requer_glpi").value = v10;
                    document.getElementById("ubicacion_administrativa_scodigo").value = v11;
                    $('#loco1').html(v12);

                    document.getElementById("imagis").style.display = "block";

                    document.getElementById("texto4").innerText = "Datos actualizados";
                    document.getElementById("titulo4").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo4").style.color = "white";
                    document.getElementById("observacion_especial").style.display = "block";
                }else{
                    document.getElementById("texto4").innerText = v1;
                    document.getElementById("titulo4").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo4").style.color = "white";
                    document.getElementById("observacion_especial").style.display = "block";
                    
                    document.getElementById("imagis").style.display = "none";
                }
            }
        });
    }
}



function accion_eliminar_registro(id_reporte){
   /* alert (id_reporte) */
    $.ajax({
        url: 'interaccion.php',
        type: 'POST',
        data: {
            id_reporte: id_reporte,
            accion: 3
        },
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if (v0 == '0'){
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
            }else{
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
                /* $('#loco1').html(v2);  */
                setTimeout(busqueda2, 4000);
            } 
            /* alert('Funciono parcialmente');  */
        },
        error: function(jqXHR, textStatus, errorThrawn){
            console.error("Error: ", textStatus, errorThrawn)
        }
    })
}

function accion_editar_registro(snro_reporte, id_reporte, nnumero_requer_glpi, ubicacion_administrativa_scodigo, nbien_publico, snombre_dispositivo, dispositivos_id, 
    estatus_id, marca_id, smodelo, sserial, sdisco_duro, smemoria_ram, sobservaciones_tecnico, srecomendaciones_tecnico, estatus_final, motivo_desincorporacion){
   
    
    $('#snro_reporte').val(snro_reporte);

    $('#id_reporte').val(id_reporte);

    $('#nnumero_requer_glpi').val(nnumero_requer_glpi);

    $('#ubicacion_administrativa_scodigo').val(ubicacion_administrativa_scodigo);

    $('#nbien_publico').val(nbien_publico);
    $('#snombre_dispositivo').val(snombre_dispositivo);
    $('#dispositivos_id').val(dispositivos_id);
    $('#estatus_id').val(estatus_id);
    $('#marca_id').val(marca_id);
    $('#smodelo').val(smodelo);

    $('#sserial').val(sserial);

    $('#sdisco_duro').val(sdisco_duro);
    $('#smemoria_ram').val(smemoria_ram);

    $('#sobservaciones_tecnico').val(sobservaciones_tecnico);
    $('#srecomendaciones_tecnico').val(srecomendaciones_tecnico);
    $('#final_id').val(estatus_final);
    $('#motivo_desincorporacion').val(motivo_desincorporacion);

    $('#agregar').css('display','none');
    $('#actualizar').css('display','block');
    
    
    document.getElementById("texto").innerText = "Se extrajeron correctamente los datos";
    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
    document.getElementById("titulo").style.color = "white";
    document.getElementById("observacion").style.display = "block";
    
}

function accion_reporte_modificar(id_reporte){
    let contador2 = 0;

    let reporte = document.getElementById("id_reporte").value;
    let requerimiento = document.getElementById("nnumero_requer_glpi").value;
    let administracion = document.getElementById("ubicacion_administrativa_scodigo").value;
    let bien_public = document.getElementById("nbien_publico").value;
    let dispositivo_nombre = document.getElementById("snombre_dispositivo").value;
    let id_dispositivo = document.getElementById("dispositivos_id").value;
    let id_estatus = document.getElementById("estatus_id").value;
    let id_marca = document.getElementById("marca_id").value;
    let modelo2 = document.getElementById("smodelo").value;
    let serial2 = document.getElementById("sserial").value;
    let discoduro = document.getElementById("sdisco_duro").value; 
    let memoria_ram = document.getElementById("smemoria_ram").value;
    let observaciones = document.getElementById("sobservaciones_tecnico").value;
    let recomendaciones = document.getElementById("srecomendaciones_tecnico").value;
    let final_estatus = document.getElementById("final_id").value; 
    let motivo_desincorporacion2 = document.getElementById("motivo_desincorporacion").value; 

    if(document.getElementById("id_reporte").value == ""){
        document.getElementById("id_reporte").style.borderColor = "Red";
        contador2++;
    }else{
        document.getElementById("id_reporte").style.borderColor = "#999999";
    }

    if(document.getElementById("ubicacion_administrativa_scodigo").value == ""){
        document.getElementById("ubicacion_administrativa_scodigo").style.borderColor = "Red";
        contador2++;
    }else{
        document.getElementById("ubicacion_administrativa_scodigo").style.borderColor = "#999999";
    }

    if(document.getElementById("nbien_publico").value == ""){
        document.getElementById("nbien_publico").style.borderColor = "Red";
        contador2++;
    }else{
        document.getElementById("nbien_publico").style.borderColor = "#999999";
    }

    if(document.getElementById("snombre_dispositivo").value == ""){
        document.getElementById("snombre_dispositivo").style.borderColor = "Red";
        contador2++;
    }else{
        document.getElementById("snombre_dispositivo").style.borderColor = "#999999";
    }

    if(document.getElementById("dispositivos_id").value == ""){
        document.getElementById("dispositivos_id").style.borderColor = "Red";
        contador2++;
    }else{
        document.getElementById("dispositivos_id").style.borderColor = "#999999";
    }

    if(document.getElementById("estatus_id").value == ""){
        document.getElementById("estatus_id").style.borderColor = "Red";
        contador2++;
    }else{
        document.getElementById("estatus_id").style.borderColor = "#999999";
    }

    if(document.getElementById("marca_id").value == ""){
        document.getElementById("marca_id").style.borderColor = "Red";
        contador2++;
    }else{
        document.getElementById("marca_id").style.borderColor = "#999999";
    }

    if(document.getElementById("smodelo").value == ""){
        document.getElementById("smodelo").style.borderColor = "Red";
        contador2++;
    }else{
        document.getElementById("smodelo").style.borderColor = "#999999";
    }

    if(document.getElementById("sserial").value == ""){
        document.getElementById("sserial").style.borderColor = "Red";
        contador2++;
    }else{
        document.getElementById("sserial").style.borderColor = "#999999";
    }

    if(document.getElementById("sdisco_duro").value == ""){
        document.getElementById("sdisco_duro").style.borderColor = "Red";
        contador2++;
    }else{
        document.getElementById("sdisco_duro").style.borderColor = "#999999";
    }

    if(document.getElementById("smemoria_ram").value == ""){
        document.getElementById("smemoria_ram").style.borderColor = "Red";
        contador2++;
    }else{
        document.getElementById("smemoria_ram").style.borderColor = "#999999";
    }

    if(document.getElementById("sobservaciones_tecnico").value == ""){
        document.getElementById("sobservaciones_tecnico").style.borderColor = "Red";
        contador2++;
    }else{
        document.getElementById("sobservaciones_tecnico").style.borderColor = "#999999";
    }

    if(document.getElementById("srecomendaciones_tecnico").value == ""){
        document.getElementById("srecomendaciones_tecnico").style.borderColor = "Red";
        contador2++;
    }else{
        document.getElementById("srecomendaciones_tecnico").style.borderColor = "#999999";
    }

    if(document.getElementById("final_id").value == ""){
        document.getElementById("final_id").style.borderColor = "Red";
        contador2++;
    }else{
        document.getElementById("final_id").style.borderColor = "#999999";
    }

    if(contador2 > 0){
        document.getElementById("texto").innerText = "Debe llenar los datos obligatorios";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion_especial").style.display = "block";
    }else{
         /* alert(reporte+"---"+requerimiento+ "---"+administracion+ "---"+bien_public+"---"+dispositivo_nombre+" "+id_dispositivo+
            "---"+id_estatus+"---"+id_marca+"---"+modelo2+"---"+serial2+"---"+discoduro+"---"+memoria_ram+"---"+observaciones+"---"+recomendaciones+" "+
            final_estatus+" "+motivo_desincorporacion2);  */
        
        $.ajax({
            url: '/minpptrassi/mod_informe_tecnico/interaccion.php',
            type: 'POST',
            data: {
                reporte: reporte,
                requerimiento: requerimiento,
                administracion: administracion,
                bien_public: bien_public,
                dispositivo_nombre: dispositivo_nombre,
                id_dispositivo: id_dispositivo,
                id_estatus: id_estatus,
                id_marca: id_marca,
                modelo2: modelo2, 
                serial2: serial2,
                discoduro: discoduro,
                memoria_ram: memoria_ram,
                observaciones: observaciones,
                recomendaciones: recomendaciones,
                final_estatus: final_estatus,
                motivo_desincorporacion2: motivo_desincorporacion2,
                accion: 4
            },
            success: function(resp){
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                let v2 = resp.split(" / ")[2];
                if (v0 == '0'){
                    document.getElementById("texto4").innerText = v1;
                    document.getElementById("titulo4").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo4").style.color = "white";
                    document.getElementById("observacion_especial").style.display = "block";
                }else{
                    document.getElementById("sserial").value = '';
                    document.getElementById("nbien_publico").value = '';
                    document.getElementById("snombre_dispositivo").value = '';
                    document.getElementById("dispositivos_id").value = '0';
                    document.getElementById("estatus_id").value = '0';
                    document.getElementById("marca_id").value = '0';
                    document.getElementById("smodelo").value = '';
                    document.getElementById("sdisco_duro").value = '';
                    document.getElementById("smemoria_ram").value = '';
                    document.getElementById("sobservaciones_tecnico").value = '';
                    document.getElementById("srecomendaciones_tecnico").value = '';
                    document.getElementById("final_id").value = '0';


                    document.getElementById("texto4").innerText = v1;
                    document.getElementById("titulo4").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo4").style.color = "white";
                    document.getElementById("observacion_especial").style.display = "block";
                    busqueda(); 
                    /* document.getElementById('#loco1').innerHTML(v2); */
                }
            },
            error: function(jqXHR, textStatus, errorThrawn){
                console.error("Error: ", textStatus, errorThrawn)    
            }
        })
        
    }
}

function eliminar_imagen(eliminar_id){
   /* alert (eliminar_id);  */  
    $.ajax({
        url: 'eliminar_foto.php',
        type: 'POST',
        data: {
            eliminar_id: eliminar_id ,
        },
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            if (v0 == '0'){
                alert(v0);
            }else{
                alert(v1);
            } 
            /* alert('Funciono parcialmente');  */
        },
        error: function(jqXHR, textStatus, errorThrawn){
            console.error("Error: ", textStatus, errorThrawn)
        }
    })
}

function accion_guardar(){
    $.ajax({
        url: 'interaccion2.php',
        data: {
            accion: 2
        },
        type: 'GET',
        success: function(resp){
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            if(v0 == '1'){
                document.getElementById("texto2").innerText = v1;
                document.getElementById("titulo2").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo2").style.color = "white";
                document.getElementById("observacion2").style.display = "block";
            }else{
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
            }
        }
    });
}
    



