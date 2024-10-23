function buscar(){
    let contador = 0;
    let nacionalidad = document.getElementById("nacionalidad");
    let cedula = document.getElementById("cedula");

    if(nacionalidad.value == ""){
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

    if(contador > 0){
        document.getElementById("texto").innerText = "Debe llenar los datos obligatorios";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        $.ajax({
            url: 'interaccion.php?nacionalidad='+nacionalidad.value+'&cedula='+cedula.value+'&accion=1',
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
                if(v0 == '1')
                {
                    document.getElementById("nombre").value = v1; 
                    document.getElementById("apellido").value = v2; 
                    document.getElementById("ubicacion_adm").value = v3;
                    document.getElementById("ubicacion_fisica_actual").value = v4;
                    document.getElementById("cargo").value = v5; 
                    document.getElementById("scargo_actual_ejerce").value = v6;
                    $('#loco').html(v7);

                    document.getElementById("texto").innerText = "Se extrajeron correctamente los datos";
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";

                    /* window.location.href = "index.php?nombre="+v1+"&apellido="+v2+"&ubicacion_adm="+v3+"&ubicacion_fisica_actual="+v4+"&cargo="+v5+"&scargo_actual_ejerce="+v6+"&cedula="+v7+"&nacionalidad="+nacionalidad.value+"&id="+cedula.value; */
                }else{
                    document.getElementById("texto").innerText = "Cédula no encontrada, por favor intente otra vez";
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }
            }
        });
    } 
}

/* let reports = [];

function addReport() {
    
    let n_requerimiento = document.getElementById("nnumero_requer_glpi").value;
    let ubicacion_administrativa = document.getElementById("ubicacion_administrativa_scodigo").value;
    let bien_publico = document.getElementById("nbien_publico").value;
    let nombre_dispo = document.getElementById("snombre_dispositivo").value;
    let tipo_dispo = document.getElementById("dispositivos_id").value;
    let estatus = document.getElementById("estatus_id").value;
    let marca = document.getElementById("marca_id").value;
    let modelo = document.getElementById("smodelo").value;
    let serial = document.getElementById("sserial").value;
    let disco_duro = document.getElementById("sdisco_duro").value;
    let ram = document.getElementById("smemoria_ram").value;

  
    // Add data to the reports array
    reports.push({
      n_requerimiento: n_requerimiento,
      ubicacion_administrativa: ubicacion_administrativa,
      bien_publico: bien_publico,
      nombre_dispo: nombre_dispo,
      tipo_dispo: tipo_dispo,
      estatus: estatus,
      marca: marca,
      modelo: modelo,
      serial: serial,
      disco_duro: disco_duro,
      ram: ram
    
    });
    
}
  
function submitReports() {
    // Check if there are reports to submit
    if (reports.length === 0) {
      alert("No hay reportes para enviar");
      return;
    }
  
    // Send reports to PHP (modified logic)
    $.ajax({
      url: 'interaccion.php?accion=2', // Modify URL to handle multiple reports
      type: 'POST', // Use POST method for sending data as an array
      data: { reports: JSON.stringify(reports) }, // Send reports as JSON string
      success: function(resp) {
        // Handle response from PHP
        // ...
      }
    });
}
 */
function insertar(){
    let numero = 0; 
    let num = 0;
    let n_requerimiento = document.getElementById("nnumero_requer_glpi");
    let ubicacion_administrativa = document.getElementById("ubicacion_administrativa_scodigo");
    let bien_publico = document.getElementById("nbien_publico");
    let nombre_dispo = document.getElementById("snombre_dispositivo");
    let tipo_dispo = document.getElementById("dispositivos_id");
    let estatus = document.getElementById("estatus_id");
    let marca = document.getElementById("marca_id");
    let modelo = document.getElementById("smodelo");
    let serial = document.getElementById("sserial");
    let disco_duro = document.getElementById("sdisco_duro");
    let ram = document.getElementById("smemoria_ram");

    if(ubicacion_administrativa.value == ""){
        ubicacion_administrativa.style.border = "1px solid red";
        numero++;
    }else{
        ubicacion_administrativa.style.border = "";
    }

    if(nombre_dispo.value == ""){
        nombre_dispo.style.border = "1px solid red";
        numero++;
    }else{
        nombre_dispo.style.border = "";
    }

    if(ubicacion_administrativa_scodigo.value == "0"){
        ubicacion_administrativa_scodigo.style.border = "1px solid red";
        numero++;
    }else{
        ubicacion_administrativa_scodigo.style.border = "";
    }

    if(tipo_dispo.value == "" || tipo_dispo.value == 0){
        tipo_dispo.style.border = "1px solid red";
         numero++;
    } else {
         tipo_dispo.style.border = "";
    }

    if(estatus.value == "" || estatus.value == 0){
        estatus.style.border = "1px solid red";
        numero++;
    } else {
        estatus.style.border = "";
    }

    if(marca.value == "" || marca.value == 0){
        marca.style.border = "1px solid red";

        numero++;
    } else {
        marca.style.border = "";
    }

    if(modelo.value == ""){
       modelo.style.border = "1px solid red";

        numero++;
    } else {
        modelo.style.border = "";
    }

    if(serial.value == ""){
        serial.style.border = "1px solid red";

         numero++;
    } else {
        serial.style.border = "";
    }

    if(disco_duro.value == ""){
        disco_duro.style.border = "1px solid red";
        numero++;
    } else {
        disco_duro.style.border = "";
    }

    if(ram.value == ""){
        ram.style.border = "1px solid red";
        numero++;
    } else {
         ram.style.border = "";
    }

    if(numero > 0 || num > 0){
        document.getElementById("texto").innerText = "Debe llenar los datos obligatorios";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    } else{
        $.ajax({
            url: 'interaccion.php?n_requerimiento='+n_requerimiento.value+'&ubicacion_administrativa='+ubicacion_administrativa.value+'&bien_publico='+bien_publico.value+
            '&nombre_dispo='+nombre_dispo.value+'&tipo_dispo='+tipo_dispo.value+'&estatus='+estatus.value+'&marca='+marca.value+'&modelo='+modelo.value+'&serial='+serial.value+
            '&disco_duro='+disco_duro.value+'&ram='+ram.value+'&accion=2',
            type: 'GET',
            success: function(resp){
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                let v2 = resp.split(" / ")[2];
                if(v0 == '1'){

                    $('#loco').html(v2);
                    /* window.location.href = "index.php="+ubicacion_administrativa.value;
                    document.getElementById("ubicacion_administrativa_scodigo").value = ubicacion_administrativa.value; */

                    
                    document.getElementById("nbien_publico").value = '';
                    document.getElementById("snombre_dispositivo").value = '';
                    document.getElementById("dispositivos_id").value = '0';
                    document.getElementById("estatus_id").value = '0';
                    document.getElementById("marca_id").value = '0';
                    document.getElementById("smodelo").value = '';
                    document.getElementById("sserial").value = '';
                    document.getElementById("sdisco_duro").value = '';
                    document.getElementById("smemoria_ram").value = '';

                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }else{
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }
            }
        });
    }

};

function showAlert(){
    $.ajax({
        url: 'interaccion.php',
        data: {
            accion: 5
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

function modificar_recomendaciones(final_id)
{
    
    const element = document.getElementById("motivo_desincorporacion2")
    let colum2 =  document.getElementById("final_id").value;
    if (colum2 !== "113"){
        $('#motivo_desincorporacion2').css('display','none');
    } else {
        $('#motivo_desincorporacion2').css('display','block');
    }
}

function cerrar(){
    document.getElementById("observacion").style.display = "none";  
}
function cerrar2(){
    document.getElementById("observacion2").style.display = "none";
     $(location).attr("href","actualizar.php"); 
}