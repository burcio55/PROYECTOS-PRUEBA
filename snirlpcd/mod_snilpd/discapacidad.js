function accion_discapacidad_actualizar(discapacidad,numero_certificado,f_emision,f_vencimiento,discapacidad_general,sdiscapacidad_especifica,discapacidad_grado,mision_jose)
{
    let contador = 0;
    if(discapacidad=='-1'){
        contador++;
        document.getElementById('discapacidad').style.border = "1px solid red";
    }else{
        document.getElementById('discapacidad').style.border = "";
        if(discapacidad=='1'){
            if(numero_certificado==''){
                contador++;
                document.getElementById('numero_certificado').style.border = "1px solid red";
            }else{
                document.getElementById('numero_certificado').style.border = "";
            }
            if(f_emision==''){
                contador++;
                document.getElementById('f_emision').style.border = "1px solid red";
            }else{
                document.getElementById('f_emision').style.border = "";
            }
            if(f_vencimiento==''){
                contador++;
                document.getElementById('f_vencimiento').style.border = "1px solid red";
            }else{
                document.getElementById('f_vencimiento').style.border = "";
            }
            if(discapacidad_general=='-1'){
                contador++;
                document.getElementById('discapacidad_general').style.border = "1px solid red";
            }else{
                document.getElementById('discapacidad_general').style.border = "";
            }
            if(sdiscapacidad_especifica==''){
                contador++;
                document.getElementById('sdiscapacidad_especifica').style.border = "1px solid red";
            }else{
                document.getElementById('sdiscapacidad_especifica').style.border = "";
            }
            if(discapacidad_grado=='-1'){
                contador++;
                document.getElementById('discapacidad_grado').style.border = "1px solid red";
            }else{
                document.getElementById('discapacidad_grado').style.border = "";
            }
        }
    }
    if(mision_jose=='-1'){
        contador++;
        document.getElementById('mision_jose').style.border = "1px solid red";
    }else{
        document.getElementById('mision_jose').style.border = "";
    }
    if (contador == 0){
        $.ajax
        ({
            url: 'accion_discapacidad.php?discapacidad='+discapacidad+'&numero_certificado='+numero_certificado+'&f_emision='+f_emision+'&f_vencimiento='+f_vencimiento+'&discapacidad_general='+discapacidad_general+'&sdiscapacidad_especifica='+sdiscapacidad_especifica+'&discapacidad_grado='+discapacidad_grado+'&mision_jose='+mision_jose,
            type: 'GET',
            success: function(resp) {
                /* $(location).attr('href','educacion.php');  */
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                if(v0 == 1){
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                }else{
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                    document.getElementById("link").value = "educacion.php";
                }
            }
        });
    }else{
        document.getElementById("texto").innerText = ("Debe completar los \"Campos Obligatorios (*)\"");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("titulo").innerText = ("Atención");
        document.getElementById("alerta").style.display = "Block";
    }
}
function accion_discapacidad(discapacidad,numero_certificado,f_emision,f_vencimiento,discapacidad_general,sdiscapacidad_especifica,discapacidad_grado,mision_jose) 
{
    let contador = 0;
    if(discapacidad=='-1'){
        contador++;
        document.getElementById('discapacidad').style.border = "1px solid red";
    }else{
        document.getElementById('discapacidad').style.border = "";
        if(discapacidad=='1'){
            if(numero_certificado==''){
                contador++;
                document.getElementById('numero_certificado').style.border = "1px solid red";
            }else{
                document.getElementById('numero_certificado').style.border = "";
            }
            if(f_emision==''){
                contador++;
                document.getElementById('f_emision').style.border = "1px solid red";
            }else{
                document.getElementById('f_emision').style.border = "";
            }
            if(f_vencimiento==''){
                contador++;
                document.getElementById('f_vencimiento').style.border = "1px solid red";
            }else{
                document.getElementById('f_vencimiento').style.border = "";
            }
            if(discapacidad_general=='-1'){
                contador++;
                document.getElementById('discapacidad_general').style.border = "1px solid red";
            }else{
                document.getElementById('discapacidad_general').style.border = "";
            }
            if(sdiscapacidad_especifica==''){
                contador++;
                document.getElementById('sdiscapacidad_especifica').style.border = "1px solid red";
            }else{
                document.getElementById('sdiscapacidad_especifica').style.border = "";
            }
            if(discapacidad_grado=='-1'){
                contador++;
                document.getElementById('discapacidad_grado').style.border = "1px solid red";
            }else{
                document.getElementById('discapacidad_grado').style.border = "";
            }
        }
    }
    if(mision_jose=='-1'){
        contador++;
        document.getElementById('mision_jose').style.border = "1px solid red";
    }else{
        document.getElementById('mision_jose').style.border = "";
    }
    if (contador == 0){
        $.ajax
        ({
            url: 'accion_discapacidad2.php?discapacidad='+discapacidad+'&numero_certificado='+numero_certificado+'&f_emision='+f_emision+'&f_vencimiento='+f_vencimiento+'&discapacidad_general='+discapacidad_general+'&sdiscapacidad_especifica='+sdiscapacidad_especifica+'&discapacidad_grado='+discapacidad_grado+'&mision_jose='+mision_jose,
            type: 'GET',
            success: function(resp) {
                /* $(location).attr('href','educacion.php');  */
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                if(v0 == 1){
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                }else{
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("btncerrar").value = "Continuar";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                    document.getElementById("link").value = "educacion.php";
                }
            }
        });
    }else{
        document.getElementById("texto").innerText = ("Debe completar los \"Campos Obligatorios (*)\"");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("titulo").innerText = ("Atención");
        document.getElementById("alerta").style.display = "Block";
    }
}