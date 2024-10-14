$(document).ready(function(){
    //alert('Hola Mundo');
    let tab = $('#btn').tabindex;
    $.ajax({
        url: 'mostrar_conocimientos.php?tab='+tab,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            $('#conocimientos').html(v0);
            $('#continuar').prop("tabindex",v1+2);
            $('#regresar').prop("tabindex",v1+1);
        }
    });
})

function agregar_conocimientos(otros_conocimientos, dominio, Observaciones_conocimientos, id){
    /* alert(otros_conocimientos);
    alert(dominio);
    alert(Observaciones_conocimientos); */
    let valor = 0;
    if(otros_conocimientos == ""){
        document.getElementById("otros_conocimientos").style.border = "red solid 1px";
        valor++;
    }else{
        document.getElementById("otros_conocimientos").style.border = "";
    }
    if(dominio == "-1"){
        document.getElementById("dominio").style.border = "red solid 1px";
        valor++;
    }else{
        document.getElementById("dominio").style.border = "";
    }
    if(valor > 0){
        document.getElementById("texto").innerText = ("Debe conpletar los campos obligatorios (*)");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("titulo").innerText = ("Atención");
        document.getElementById("alerta").style.display = "Block";
    }else{
        $.ajax({
            url: 'conocimientos.php?conocimientos='+otros_conocimientos+'&dominio='+dominio+'&Observaciones='+Observaciones_conocimientos+'&id_usuario='+id,
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 = resp.split(" / ")[2];
                if(v0 == 1){
                    $(v2).focus(); // Para quitar focus = .blur()
                    $(v2).css({'border':'2px solid #F50101dd'});
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                }else if(v0 == 2){
                    $('#conocimientos').html(resp);
                    $("#otros_conocimientos").val('');
                    $("#dominio").val('-1');
                    $("#Observaciones_conocimientos").val('');
                    $("#id_conocimiento").val('0');
                    $('#btn2').css({'display':'none'});
                    $('#btn').css({'display':''});
                }else{
                    $('#conocimientos').html(resp);
                    $("#otros_conocimientos").val('');
                    $("#dominio").val('-1');
                    $("#Observaciones_conocimientos").val('');
                    $("#id_conocimiento").val('0');
                    $('#btn2').css({'display':'none'});
                    $('#btn').css({'display':''});
                }
            }
        });
    }
}

function modificar_conocimientos(id){
    $.ajax({
        url: 'modificar_conocimientos.php?id='+id,
        type: 'GET',
        success: function(resp) {
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            let v2 = resp.split(" / ")[2];
            let v3 = resp.split(" / ")[3];
            let valor = document.getElementById("habilidades_destrezas").tabIndex;
            let valor1 = valor + 1;
            let valor2 = valor + 2;
            let valor3 = valor + 3;
            let valor4 = valor + 4;
            document.getElementById("id_conocimiento").value = v0;
            document.getElementById("otros_conocimientos").value = v1;
            document.getElementById("otros_conocimientos").tabIndex = valor1;
            document.getElementById("otro_co").tabIndex = valor1;
            document.getElementById("otro_co").focus();
            document.getElementById("dominio").value = v2;
            document.getElementById("dominio").tabIndex = valor2;
            document.getElementById("Observaciones_conocimientos").value = v3;
            document.getElementById("obg2").tabIndex = valor3;
            document.getElementById("Observaciones_conocimientos").tabIndex = valor3;
            document.getElementById("btn2").style.display = 'block';
            document.getElementById("btn2").tabIndex = valor4;
            document.getElementById("btn").style.display = 'none';
            document.getElementById("texto").innerText = ('Se extrajo sus datos con exito');
            document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
            document.getElementById("titulo").style.color = "white";
            document.getElementById("titulo").innerText = ("Atención");
            document.getElementById("alerta").style.display = "Block";
        }
    });
}

function eliminar_conocimientos(id){
    $.ajax({
        url: 'eliminar_conocimientos.php?id='+id,
        type: 'GET',
        success: function(resp) {
            //alert(resp);
            $('#conocimientos').html(resp);
        }
    });
}
function continuar(){
    $.ajax({
        url: 'conocimientos.php?valor=1',
        type: 'GET',
        success: function(resp) {
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            if(v0 == '1'){
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("titulo").innerText = ("Atención");
                document.getElementById("alerta").style.display = "Block";
            }else{
                $(location).attr('href','situacion_ocupacional.php'); 
            }
        }
    });
}