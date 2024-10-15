function agregar_dispositivo(){
    let counter = 0;//0
    let marc2= document.getElementById('marc2').value;

    if (marc2==""){
        document.getElementById('marc2').style.border="solid 1px red";
        counter=counter+1;//1
    }else{
        document.getElementById('marc2').style.border="";//0
    }
    if (counter> "0"){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        //document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
        document.getElementById("validador").value = "";
    }else{
        $.ajax({
            url: 'subir3.php?accion=1&marca='+marc2,
            type: 'GET',
            success: function(resp){
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                if(v0 == '2'){
                    document.getElementById("texto").innerText = (v1);
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    //document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    document.getElementById("validador").value = "1";
                }else{
                    document.getElementById("texto").innerText = (v1);
                    //document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    document.getElementById("validador").value = "1";
                }
                
            }
        });
    }
     
}

function borrar_dispo(id){
    /* id = document.getElementById("id").value; */

    // Ocultar el elemento con el ID "borrar_registro"
    document.getElementById("borrar_dispo").style.display = "none";

    // Configurar el texto de la alerta
    document.getElementById("texto3").innerText = "¿Seguro que deseas eliminar este registro?";
    document.getElementById("titulo3").style.backgroundColor = "#DC3831"; // Rojo
    document.getElementById("titulo3").style.color = "white"; // Color de la letra

    // Mostrar la alerta
    document.getElementById("borrar_dispo").style.display = "block";
    //CANCELAR
    document.querySelector("#borrar_dispo button[data-bs-toggle='tooltip']").addEventListener("click", function() {
        document.getElementById("borrar_dispo").style.display = "none";
    });

    // Agregar evento al botón "Continuar" (o cualquier otro botón)
    document.querySelector("#borrar_dispo button[data-bs-toggle='tooltip2']").addEventListener("click", function() {
        document.getElementById("borrar_dispo").style.display = "none";
        eliminar_dispositivo(id)
    });

}

function eliminar_dispositivo(id) {
    $.ajax({
        type: "DELETE",
        url: 'subir3.php?accion=2&id='+id,
        success: function(resp){
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            if(v0 == '2'){
                document.getElementById("texto").innerText = (v1);
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                //document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
                document.getElementById("validador").value = "1";
            }else{
                document.getElementById("texto").innerText = (v1);
                //document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
                document.getElementById("validador").value = "1";
            }
        }
    });
}
function editar_dispositivo2(id_proceso, sdescripcion){   
    $.ajax({
        url: 'subir3.php?accion=3&id_proceso='+id_proceso+'&sdescripcion='+sdescripcion,
        method: 'GET',
        success: function(resp){
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            if(v0 == '2'){
                document.getElementById("texto").innerText = (v1);
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                //document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
                document.getElementById("validador").value = "1";
            }else{
                document.getElementById("texto").innerText = (v1);
                //document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
                document.getElementById("validador").value = "1";
            }
        }
    });
}
function editar_dispositivo(id, sdescripcion){
    document.getElementById("id_proceso").value = id;
    document.getElementById("marc2").value = sdescripcion;
}


/* esto es para ocultar y mostrar botones */

function editar_dispositivo(id_proceso, sdescripcion) {

    /* alert(id_mantenimiento6,sdescripcion); */

    $("#id_proceso").val(id_proceso); 
    $("#marc2").val(sdescripcion);
    $('#bt1').css('display','none');
    $('#bt2').css('display','block');
    $('#bt4').css('display','');
    document.getElementById("marc2").style.borderColor="blue";
    
}

function finalizar(){
    let validador = document.getElementById("validador");
    if(validador.value == "1"){
        location.reload();
    }else{
        document.getElementById("observacion").style.display = "none";
    }
}

function mayusculas(e) {
    let aux = e.value = e.value.toUpperCase();
    aux.preventDefault();
}