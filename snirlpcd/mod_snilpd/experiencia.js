$(document).ready(function(){
    //alert('Hola Mundo');
    $.ajax({
        url: 'mostrar_experiencia.php',
        type: 'GET',
        success: function(resp) {
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            let v2 = resp.split(" / ")[2];
            let v3 = resp.split(" / ")[3];
            let v4 = resp.split(" / ")[4];
            if(v0 == 2){
                $('#experiencia').html(v1);
                $('#cbExperiencia').val(v2);
                if(v2 == 1){
                    document.getElementById("b1").style.display = 'none';
                    document.getElementById("op1").style.display = 'block';
                    document.getElementById("tr_experiencia2").style.display = 'block';
                    $("#btn").prop("tabindex",v4);
                    $("#regresar").prop("tabindex",v3);
                }
            }else{
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("titulo").innerText = ("Atención");
                document.getElementById("alerta").style.display = "Block";
            }
        }
    });
})   

function agregar(cbExperiencia,rif,patrono,cbSector_empleo,cbAct_economica4,Telf_patrono,ocupacion,f_ingreso,cbRelacion_trabajo,f_egreso,Otra_habilidad,id){
    /* alert(id); */
    $.ajax({
        url: 'agregar_experiencia.php?experiencia='+cbExperiencia+'&rif='+rif+'&patrono='+patrono+'&sector='+cbSector_empleo+'&economia='+cbAct_economica4+'&telefono='+Telf_patrono+'&ocupacion='+ocupacion+'&ingreso='+f_ingreso+'&relacion='+cbRelacion_trabajo+'&egreso='+f_egreso+'&otro='+Otra_habilidad+'&valor='+id,
        type: 'GET',
        success: function(resp) {
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            let v2 = resp.split(" / ")[2];
            if(v0 == 1){
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("titulo").innerText = ("Atención");
                document.getElementById("alerta").style.display = "Block";
                $(v2).focus(); // Para quitar focus = .blur()
                $(v2).css({'border':'2px solid #F50101dd'});
                if(v2 == '#patrono'){
                    $('#rif').css({'border':'1px solid #312E33'});
                }else
                if(v2 == '#ocupacion'){
                    $('#rif').css({'border':'1px solid #312E33'});
                    $('#patrono').css({'border':'1px solid #312E33'});
                }else
                if(v2 == '#cbRelacion_trabajo'){
                    $('#rif').css({'border':'1px solid #312E33'});
                    $('#patrono').css({'border':'1px solid #312E33'});
                    $('#ocupacion').css({'border':'1px solid #312E33'});
                }else
                if(v2 == '#f_ingreso'){
                    $('#rif').css({'border':'1px solid #312E33'});
                    $('#patrono').css({'border':'1px solid #312E33'});
                    $('#ocupacion').css({'border':'1px solid #312E33'});
                    $('#cbRelacion_trabajo').css({'border':'1px solid #312E33'});
                }else
                if(v2 == '#f_egreso'){
                    $('#rif').css({'border':'1px solid #312E33'});
                    $('#patrono').css({'border':'1px solid #312E33'});
                    $('#ocupacion').css({'border':'1px solid #312E33'});
                    $('#cbRelacion_trabajo').css({'border':'1px solid #312E33'});
                    $('#f_ingreso').css({'border':'1px solid #312E33'});
                }
            }else if(v0 == 2){
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("titulo").innerText = ("Atención");
                document.getElementById("alerta").style.display = "Block";
                document.getElementById("link").value = "experiencia_laboral.php";
            }else if(v0 == 3){
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("titulo").innerText = ("Atención");
                document.getElementById("alerta").style.display = "Block";
                document.getElementById("link").value = "foto.php";
                //window.location('foto.php');
                $(location).attr('href','foto.php'); 
            }else{
                $('#experiencia').html(v0);
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
function agregar2(cbExperiencia){
    let valor = 0;
    if(cbExperiencia == '-1'){
        valor++;
        document.getElementById("cbExperiencia").style.border = "1px solid #F50101dd";
    }else{
        document.getElementById("cbExperiencia").style.border = "";
    }
    if(valor > 0){
        document.getElementById("texto").innerText = ("Debe completar los \"Campos Obligatorios (*)\"");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("titulo").innerText = ("Atención");
        document.getElementById("alerta").style.display = "Block";
    }else{
        $.ajax({
            url: 'agregar_experiencia2.php?experiencia='+cbExperiencia,
            type: 'GET',
            success: function(resp) {
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
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
                    document.getElementById("link").value = "foto.php";
                }
            }
        });
    }
}

function editar_experiencia(id){
    $.ajax({
        url: 'editar_experiencia.php?id='+id,
        type: 'GET',
        success: function(resp) {
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            let f1 = v1.split("V")[1];
            let v2 = resp.split(" / ")[2];
            let v3 = resp.split(" / ")[3];
            let v4 = resp.split(" / ")[4];
            let v5 = resp.split(" / ")[5];
            let v6 = resp.split(" / ")[6];
            let v7 = resp.split(" / ")[7];
            let v8 = resp.split(" / ")[8];
            let v9 = resp.split(" / ")[9];
            let v10 = resp.split(" / ")[10];
            $("#id_esperiencia").val(v0);
            $("#rif").val(f1);
            $("#cont_rif").focus();
            $("#patrono").val(v2);
            $("#cbSector_empleo").val(v3);
            $("#cbAct_economica4").val(v4);
            $("#Telf_patrono").val(v5);
            $("#ocupacion").val(v6);
            $("#f_ingreso").val(v7);
            $("#cbRelacion_trabajo").val(v8);
            $("#f_egreso").val(v9);
            $("#Otra_habilidad").val(v10);
            document.getElementById("actualizar").style.display = 'block';
            document.getElementById("agregar").style.display = 'none';
            document.getElementById("texto").innerText = ('Se extrajo sus datos con exito');
            document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
            document.getElementById("titulo").style.color = "white";
            document.getElementById("titulo").innerText = ("Atención");
            document.getElementById("alerta").style.display = "Block";
        }
    });
}

function eliminar_experiencia(id){
    $.ajax({
        url: 'eliminar_experiencia.php?id='+id,
        type: 'GET',
        success: function(resp) {
            //alert(resp);
            $('#experiencia').html(resp);
        }
    });
}