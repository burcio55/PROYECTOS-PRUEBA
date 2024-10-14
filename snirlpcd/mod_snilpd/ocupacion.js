$(document).ready(function(){
    //alert('Hola Mundo');
    $.ajax({
        url: 'mostrar_ocupacion.php',
        type: 'GET',
        success: function(resp) {
            //alert(resp);
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            let v2 = resp.split(" / ")[2];
            let v3 = resp.split(" / ")[3];
            let v4 = resp.split(" / ")[4];
            let v5 = resp.split(" / ")[5];
            let v6 = resp.split(" / ")[6];
            if(v0 == '1'){
            }else{
                $("#cbSituacion_afiliado").val(v1);
                $("#f_situacion").val(v2);
                $("#cbOcupacion5_interes_1").val(v3);
                $("#cbExperiencia_1").val(v4);
                $("#cbOcupacion5_interes2").val(v5);
                $("#cbExperiencia_2").val(v6);
            }
        }
    });
}) 

function agregar_ocupacion(cbSituacion_afiliado,f_situacion,cbOcupacion5_interes_1,cbExperiencia_1,cbOcupacion5_interes2,cbExperiencia_2){
    /* alert(cbSituacion_afiliado);
    alert(f_situacion);
    alert(cbOcupacion5_interes_1);
    alert(cbExperiencia_1);
    alert(cbOcupacion5_interes2);
    alert(cbExperiencia_2); */
    let valor = 0;
    if(cbSituacion_afiliado == '-1' || cbSituacion_afiliado == null){
        document.getElementById('cbSituacion_afiliado').style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById('cbSituacion_afiliado').style.border = "";
    }
    if(f_situacion == '' ){
        document.getElementById('f_situacion').style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById('f_situacion').style.border = "";
    }
    if(cbOcupacion5_interes_1 == ''){
        document.getElementById('cbOcupacion5_interes_1').style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById('cbOcupacion5_interes_1').style.border = "";
    }
    if(cbExperiencia_1 == ''){
        document.getElementById('cbExperiencia_1').style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById('cbExperiencia_1').style.border = "";
    }
    if(valor > 0 ){
        document.getElementById("texto").innerText = ("Debe completar los \"Campos Obligatorios (*)\"");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("titulo").innerText = ("Atención");
        document.getElementById("alerta").style.display = "Block";
    }else{
        $.ajax({
            url: 'agregar_ocupacion.php?situacion_laboral='+cbSituacion_afiliado+'&fecha_sit_ocup='+f_situacion+'&ocupacion1='+cbOcupacion5_interes_1+'&experiencia1='+cbExperiencia_1+'&ocupacion2='+cbOcupacion5_interes2+'&experiencia2='+cbExperiencia_2,
            type: 'GET',
            success: function(resp) {
                //alert(resp); 
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                let v2 = resp.split(" / ")[2];
                if(v0 == '1'){
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                    $(v2).focus(); // Para quitar focus = .blur()
                    $(v2).css({'border':'2px solid #F50101dd'});
                    if(v2 == '#f_situacion'){
                        $('#cbSituacion_afiliado').css({'border':'1px solid #312E33'});
                    }else
                    if(v2 == '#cbOcupacion5_interes_1'){
                        $('#cbSituacion_afiliado').css({'border':'1px solid #312E33'});
                        $('#f_situacion').css({'border':'1px solid #312E33'});
                    }else
                    if(v2 == '#cbExperiencia_1'){
                        $('#cbSituacion_afiliado').css({'border':'1px solid #312E33'});
                        $('#f_situacion').css({'border':'1px solid #312E33'});
                        $('#cbOcupacion5_interes_1').css({'border':'1px solid #312E33'});
                    }else
                    if(v2 == '#cbOcupacion5_interes2'){
                        $('#cbSituacion_afiliado').css({'border':'1px solid #312E33'});
                        $('#f_situacion').css({'border':'1px solid #312E33'});
                        $('#cbOcupacion5_interes_1').css({'border':'1px solid #312E33'});
                        $('#cbExperiencia_1').css({'border':'1px solid #312E33'});
                    }else
                    if(v2 == '#cbExperiencia_2'){
                        $('#cbSituacion_afiliado').css({'border':'1px solid #312E33'});
                        $('#f_situacion').css({'border':'1px solid #312E33'});
                        $('#cbOcupacion5_interes_1').css({'border':'1px solid #312E33'});
                        $('#cbExperiencia_1').css({'border':'1px solid #312E33'});
                        $('#cbOcupacion5_interes2').css({'border':'1px solid #312E33'});
                    }
                }else
                if(v0 == 2){
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                    document.getElementById("link").value = "experiencia_laboral.php";
                }            
            }
        });
    }
}