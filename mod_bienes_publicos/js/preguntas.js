$(document).ready(function(){
    $.ajax
    ({
        url: 'validar_preguntas.php?accion=1',
        type: 'GET',
        success: function(resp) {
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            let v2 = resp.split(" / ")[2];
            let v3 = resp.split(" / ")[3];
            let v4 = resp.split(" / ")[4];
            let v5 = resp.split(" / ")[5];
            document.getElementById("pregunta1").innerText = v0;
            document.getElementById("pregunta2").innerText = v1;
            document.getElementById("pregunta3").innerText = v2;
            document.getElementById("p1").value = v3;
            document.getElementById("p2").value = v4;
            document.getElementById("p3").value = v5;
        }
    });
});

function cerrar_alert(){
    if(document.getElementById("link").value == ""){
        document.getElementById("observacion").style.display = "none";
    }else{
        let link = document.getElementById("link").value;
        location.href = link;
    }
}
function Radio1(){
    document.getElementById("Radio1").checked = "true";
    document.getElementById("Radio2").checked = ""; 
}
function Radio2(){
    document.getElementById("Radio1").checked = "";
    document.getElementById("Radio2").checked = "true"; 
}
function Radio3(){
    document.getElementById("Radio3").checked = "true";
    document.getElementById("Radio4").checked = ""; 
}
function Radio4(){
    document.getElementById("Radio3").checked = "";
    document.getElementById("Radio4").checked = "true"; 
}
function Radio5(){
    document.getElementById("Radio5").checked = "true";
    document.getElementById("Radio6").checked = ""; 
}
function Radio6(){
    document.getElementById("Radio5").checked = "";
    document.getElementById("Radio6").checked = "true"; 
}
function confirmar(){
    let valor = 0;
    if(document.getElementById("Radio1").checked == false && document.getElementById("Radio2").checked == false){
        document.getElementById("Radio1").style.borderColor = "red";
        document.getElementById("Radio2").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("Radio1").style.borderColor = "";
        document.getElementById("Radio2").style.borderColor = "";
    }
    if(document.getElementById("Radio3").checked == false && document.getElementById("Radio4").checked == false){
        document.getElementById("Radio3").style.borderColor = "red";
        document.getElementById("Radio4").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("Radio3").style.borderColor = "";
        document.getElementById("Radio4").style.borderColor = "";
    }
    if(document.getElementById("Radio5").checked == false && document.getElementById("Radio6").checked == false){
        document.getElementById("Radio5").style.borderColor = "red";
        document.getElementById("Radio6").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("Radio5").style.borderColor = "";
        document.getElementById("Radio6").style.borderColor = "";
    }
    if(valor > 0){
        document.getElementById("texto").innerText = ("Debe indicar \"Sí\" o \"No\" para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        let op1 = "";
        let op2 = "";
        let op3 = "";
        if(document.getElementById("Radio1").checked == true){
            op1 = "Si";
        }
        if(document.getElementById("Radio2").checked == true){
            op1 = "No";
        }
        if(document.getElementById("Radio3").checked == true){
            op2 = "Si";
        }
        if(document.getElementById("Radio4").checked == true){
            op2 = "No";
        }
        if(document.getElementById("Radio5").checked == true){
            op3 = "Si";
        }
        if(document.getElementById("Radio6").checked == true){
            op3 = "No";
        }
        let op4 = document.getElementById("p1").value;
        let op5 = document.getElementById("p2").value;
        let op6 = document.getElementById("p3").value;
        $.ajax
        ({
            url: 'validar_preguntas.php?accion=2&op1='+op1+'&op2='+op2+'&op3='+op3+'&p1='+op4+'&p2='+op5+'&p3='+op6,
            type: 'GET',
            success: function(resp) {
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                if(v0 == '1'){
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    document.getElementById("link").value = "usuario.php";
                }else{
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    document.getElementById("link").value = "preguntas.php";
                }
            }
        });
    }
}