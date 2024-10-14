
function si(){
    let valor = 0;
    if(document.getElementById("asd").value == ""){
        valor++;
    }
    if(valor == 0){
        let asd = document.getElementById("asd").value;
        $.ajax({
            url: "/minpptrassi/mod_evaluacion/funcion.php",
            type: "GET",
            data: {
                id: asd,
                accion: 5
            },
            success: function (resp){
                //alert(resp);
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                let v2 = resp.split(" / ")[2];
                document.getElementById("mensaje").style.textAlign = "center";
                document.getElementById("mensaje").textContent = v1;
                document.getElementById("alerta").style.display = "block";
                if(v0 == 1){
                    document.getElementById("com").value = "vista.php";
                }
            }
        });
    }else{
        document.getElementById("mensaje").style.textAlign = "center";
        document.getElementById("mensaje").textContent = "Este usuario no presenta una evaluación este trimestre";
        document.getElementById("alerta").style.display = "block";
    }
}

function no(){
    document.getElementById("mensaje2").style.textAlign = "center";
    document.getElementById("mensaje2").textContent = "Debe indicar por qué no está de acuerdo";
    document.getElementById("alerta2").style.display = "block";
    document.getElementById("text").style.display = "block";
}
function cerrar(){
    document.getElementById("alerta").style.display = "none";
    if(document.getElementById("com").value != ""){
        let com = document.getElementById("com").value;
        $(location).attr("href",com);
    }
    //$(location).attr("href","vista.php");
}
function cerrar2(){
    let valor = 0;
    document.getElementById("alerta2").style.display = "none";

    if(document.getElementById("text").value == ""){
        document.getElementById("text").style.borderColor = "Red";
        valor++;
        document.getElementById("mensaje").style.textAlign = "center";
        document.getElementById("mensaje").textContent = "Debe indicar el porque de su respuesta";
        document.getElementById("alerta").style.display = "block";
    }else{
        document.getElementById("text").style.borderColor = "#999999";
        if(document.getElementById("asd").value == ""){
            ocument.getElementById("mensaje").style.textAlign = "center";
            document.getElementById("mensaje").textContent = "Este ususario no presenta una evaluación este trimestre";
            document.getElementById("alerta").style.display = "block";
        }else{
            let asd = document.getElementById("asd").value;
            let text = document.getElementById("text").value;
/*             alert(asd+ "" + text);
 */            $.ajax({
                url: "/minpptrassi/mod_evaluacion/funcion.php",
                type: "GET",
                data: {
                    id: asd,
                    text: text,
                    accion: 6
                },
                success: function (resp){
                    //alert(resp);
                    let v0 = resp.split(" / ")[0];
                    let v1 = resp.split(" / ")[1];
                    let v2 = resp.split(" / ")[2];
                    document.getElementById("mensaje").style.textAlign = "center";
                    document.getElementById("mensaje").textContent = v1;
                    document.getElementById("alerta").style.display = "block";
                    if(v0 == 1){
/*                         alert(v1);
 */                        document.getElementById("com").value = "vista.php";
                    
                    }
                }
            });
        }
    }
}
function guardar(id){
    let valor = 0;
    if(document.getElementById("observacion_analista").value != ""){
        valor++;
    }
    if(valor == 0){
        $.ajax({
            url: "/minpptrassi/mod_evaluacion/funcion.php",
            type: "GET",
            data: {
                id: id,
                accion: 3
            },
            success: function (resp){
                //alert(resp);
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                let v2 = resp.split(" / ")[2];
                document.getElementById("mensaje").style.textAlign = "center";
                document.getElementById("mensaje").textContent = v1;
                document.getElementById("alerta").style.display = "block";
                if(v0 == 1){
                    document.getElementById("com").value = "vista.php";
                }
            }
        });
    }else{
        let oa = document.getElementById("observacion_analista").value;
        $.ajax({
            url: "/minpptrassi/mod_evaluacion/funcion.php",
            type: "GET",
            data: {
                id: id,
                oa: oa,
                accion: 4
            },
            success: function (resp){
                //alert(resp);
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                let v2 = resp.split(" / ")[2];
                document.getElementById("mensaje").style.textAlign = "center";
                document.getElementById("mensaje").textContent = v1;
                document.getElementById("alerta").style.display = "block";
                if(v0 == 1){
                    document.getElementById("com").value = "vista.php";
                }
            }
        });
    }

}