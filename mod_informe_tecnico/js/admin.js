function op1(){
    document.getElementById("op").style.display = "none";
    document.getElementById("op1").style.display = "";
    document.getElementById("op2").style.display = "none";
    document.getElementById("op3").style.display = "none";
    document.getElementById("op4").style.display = "none";
    document.getElementById("op5").style.display = "none";
    document.getElementById("op6").style.display = "none";
}

function op2(){
    document.getElementById("op").style.display = "none";
    document.getElementById("op1").style.display = "none";
    document.getElementById("op2").style.display = "";
    document.getElementById("op3").style.display = "none";
    document.getElementById("op4").style.display = "none";
    document.getElementById("op5").style.display = "none";
    document.getElementById("op6").style.display = "none";
}

function op3(){
    document.getElementById("op").style.display = "none";
    document.getElementById("op1").style.display = "none";
    document.getElementById("op2").style.display = "none";
    document.getElementById("op3").style.display = "";
    document.getElementById("op4").style.display = "none";
    document.getElementById("op5").style.display = "none";
    document.getElementById("op6").style.display = "none";
}

function op4(){
    document.getElementById("op").style.display = "none";
    document.getElementById("op1").style.display = "none";
    document.getElementById("op2").style.display = "none";
    document.getElementById("op3").style.display = "none";
    document.getElementById("op4").style.display = "";
    document.getElementById("op5").style.display = "none";
    document.getElementById("op6").style.display = "none";
}

function op5(){
    document.getElementById("op").style.display = "none";
    document.getElementById("op1").style.display = "none";
    document.getElementById("op2").style.display = "none";
    document.getElementById("op3").style.display = "none";
    document.getElementById("op4").style.display = "none";
    document.getElementById("op5").style.display = "";
    document.getElementById("op6").style.display = "none";
}

function op6(){
    document.getElementById("op").style.display = "none";
    document.getElementById("op1").style.display = "none";
    document.getElementById("op2").style.display = "none";
    document.getElementById("op3").style.display = "none";
    document.getElementById("op4").style.display = "none";
    document.getElementById("op5").style.display = "none";
    document.getElementById("op6").style.display = "";
}

function boton1(){
    document.getElementById("bt1").style.display = "";
    document.getElementById("bt2").style.display = "none";
    document.getElementById("bt3").style.display = "none";
    document.getElementById("bt4").style.display = "none";
}

function boton2(){
    document.getElementById("bt1").style.display = "none";
    document.getElementById("bt2").style.display = "";
    document.getElementById("bt3").style.display = "none";
    document.getElementById("bt4").style.display = "none";
}

function boton3(){
    document.getElementById("bt1").style.display = "none";
    document.getElementById("bt2").style.display = "none";
    document.getElementById("bt3").style.display = "";
    document.getElementById("bt4").style.display = "none";
}

function boton4(){
    document.getElementById("bt1").style.display = "none";
    document.getElementById("bt2").style.display = "none";
    document.getElementById("bt3").style.display = "none";
    document.getElementById("bt4").style.display = "";
}

function finalizar(){
    document.getElementById("observacion").style.display = "none";
}

function buscar(){
    let valor = 0;
    if(document.getElementById("cedula").value == ""){
        document.getElementById("cedula").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("cedula").style.borderColor = "";
    }
    if(valor > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        let nacionalidad = document.getElementById("nacionalidad").value;
        let cedula = document.getElementById("cedula").value;
        $.ajax
        ({
            url: 'validar_admin.php?accion=1&cedula='+cedula,
            type: 'GET',
            success: function(resp) {
                /* alert(resp); */
                let v0 = resp.split(" / ")[0]; //condición
                let v1 = resp.split(" / ")[1]; //nombres
                let v2 = resp.split(" / ")[2]; //apellidos
                let v3 = resp.split(" / ")[3]; //sexo
                let v4 = resp.split(" / ")[4]; //fecha de nacimineto
                let v5 = resp.split(" / ")[5]; //estado
                let v6 = resp.split(" / ")[6]; //municipio
                let v7 = resp.split(" / ")[7]; //parroquia
                let v8 = resp.split(" / ")[8]; //centro de Votación
                let v9 = resp.split(" / ")[9]; //nacionalidad
                if(v0 == 1){
                    document.getElementById("nombres2").value = v1;
                    document.getElementById("apellidos2").value = v2;
                    document.getElementById("nombre_completo").innerText = (v1+" "+v2);
                    document.getElementById("sexo2").value = v3;
                    document.getElementById("fecha_nac2").value = v4;
                    document.getElementById("Estado2").value = v5;
                    document.getElementById("Municipio2").value = v6;
                    document.getElementById("Parroquia2").value = v7;
                    document.getElementById("centro_votacion2").value = v8;
                    document.getElementById("nacionalidad").value = v9;
                }else{
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }             
            }
        });
    }
}

function buscar2(){
    let valor = 0;
    if(document.getElementById("nacionalidad2").value == -1){
        document.getElementById("nacionalidad2").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("nacionalidad2").style.borderColor = "";
    }
    if(document.getElementById("cedula2").value == ""){
        document.getElementById("cedula2").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("cedula2").style.borderColor = "";
    }
    if(valor > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        document.getElementById("texto").innerText = ("Realizar busqueda");
        document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }
}

function buscar3(){
    let valor = 0;
    if(document.getElementById("cedula3").value == ""){
        document.getElementById("cedula3").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("cedula3").style.borderColor = "";
    }
    if(valor > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        let cedula = document.getElementById("cedula3").value;
        $.ajax
        ({
            url: 'validar_admin.php?accion=3&cedula='+cedula,
            type: 'GET',
            success: function(resp) {
                /* alert(resp); */
                let v0 = resp.split(" / ")[0]; //condición
                let v1 = resp.split(" / ")[1]; //nombres
                let v2 = resp.split(" / ")[2]; //apellidos
                let v3 = resp.split(" / ")[3]; //sexo
                let v4 = resp.split(" / ")[4]; //fecha de nacimineto
                let v5 = resp.split(" / ")[5]; //estado
                let v6 = resp.split(" / ")[6]; //municipio
                let v7 = resp.split(" / ")[7]; //parroquia
                let v8 = resp.split(" / ")[8]; //centro de Votación
                let v9 = resp.split(" / ")[9]; //nacionalidad
                if(v0 == 1){
                    document.getElementById("nombres3").value = v1;
                    document.getElementById("apellidos3").value = v2;
                    document.getElementById("sexo3").value = v3;
                    document.getElementById("fecha_nac3").value = v4;
                    document.getElementById("estado3").value = v5;
                    document.getElementById("municipio3").value = v6;
                    document.getElementById("parroquia3").value = v7;
                    document.getElementById("centro_votacion3").value = v8;
                    document.getElementById("nacionalidad3").value = v9;
                }else{
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }             
            }
        });
    }
}

/* function pdf1(){
    location("pdf/pdf1.php");
} */

function agregar(){
    let valor = 0;
    if(document.getElementById("nacionalidad2").value == -1){
        document.getElementById("nacionalidad2").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("nacionalidad2").style.borderColor = "";
    }
    if(document.getElementById("cedula2").value == ""){
        document.getElementById("cedula2").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("cedula2").style.borderColor = "";
    }
    if(document.getElementById("nombres").value == ""){
        document.getElementById("nombres").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("nombres").style.borderColor = "";
    }
    if(document.getElementById("apellidos").value == ""){
        document.getElementById("apellidos").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("apellidos").style.borderColor = "";
    }
    if(document.getElementById("sexo").value == -1){
        document.getElementById("sexo").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("sexo").style.borderColor = "";
    }
    if(document.getElementById("fecha_nac").value == ""){
        document.getElementById("fecha_nac").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("fecha_nac").style.borderColor = "";
    }
    if(document.getElementById("Estado").value == -1){
        document.getElementById("Estado").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("Estado").style.borderColor = "";
    }
    if(document.getElementById("Municipio").value == -1){
        document.getElementById("Municipio").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("Municipio").style.borderColor = "";
    }
    if(document.getElementById("Parroquia").value == -1){
        document.getElementById("Parroquia").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("Parroquia").style.borderColor = "";
    }
    if(document.getElementById("centro_votacion").value == ""){
        document.getElementById("centro_votacion").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("centro_votacion").style.borderColor = "";
    }
    if(valor > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        document.getElementById("texto").innerText = ("Agregar Datos");
        document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }
}