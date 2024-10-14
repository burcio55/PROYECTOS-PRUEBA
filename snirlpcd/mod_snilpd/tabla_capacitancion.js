$(document).ready(function(){
    //alert('Hola Mundo');
    $.ajax({
        url: 'tabla_cursos.php',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            $('#cursos').html(v0);
            let t1 = v1+1;
            let t2 = v1+2;
            let t3 = v1+3;
            let t4 = v1+4;
            let t5 = v1+5;
            $('#habilidades_destrezas').prop("tabindex",t1);
            $('#otro_co').prop("tabindex",t2);
            $('#otros_conocimientos').prop("tabindex",t2);
            $('#dominio').prop("tabindex",t3);
            $('#obg2').prop("tabindex",t4);
            $('#Observaciones_conocimientos').prop("tabindex",t4);
            $('#btn2').prop("tabindex",t5);
            $('#btn').prop("tabindex",t5);
            conocimientos();
        }
    });
})  

function conocimientos(){
    //alert('Hola Mundo');
    let tab = $('#btn2').prop("tabindex");
    $.ajax({
        url: 'mostrar_conocimientos.php?tab='+tab,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let t1 = v1+1;
            let t2 = v1+2;
            $('#conocimientos').html(v0);
            $('#continuar').prop("tabindex",t2);
            $('#regresar').prop("tabindex",t1);
        }
    });
}

function agregar_curso(cbCapacitacion, cbCurso_categoria, nombre_actividad, nombre_entidad, Duracion_curso, Observaciones_curso, id_usuario){
    let valor = 0;
    if(cbCapacitacion == "-1"){
        document.getElementById("cbCapacitacion").style.border = "red solid 1px";
        valor++;
    }else{
        document.getElementById("cbCapacitacion").style.border = "";
        if(cbCapacitacion == "1"){
            if(cbCurso_categoria == "-1"){
                document.getElementById("cbCurso_categoria").style.border = "red solid 1px";
                valor++;
            }else{
                document.getElementById("cbCurso_categoria").style.border = "";
            }
            if(nombre_actividad == ""){
                document.getElementById("nombre_actividad").style.border = "red solid 1px";
                valor++;
            }else{
                document.getElementById("nombre_actividad").style.border = "";
            }
            if(nombre_entidad == ""){
                document.getElementById("nombre_entidad").style.border = "red solid 1px";
                valor++;
            }else{
                document.getElementById("nombre_entidad").style.border = "";
            }
            if(Duracion_curso == ""){
                document.getElementById("Duracion_curso").style.border = "red solid 1px";
                valor++;
            }else{
                document.getElementById("Duracion_curso").style.border = "";
            }
        }
    }
    if(valor > 0){
        document.getElementById("texto").innerText = ("Debe completar los campos obligatorios (*)");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("titulo").innerText = ("Atención");
        document.getElementById("alerta").style.display = "Block";
    }else{
        $.ajax({
            url: 'cursos.php?cbCapacitacion='+cbCapacitacion+'&cbCurso_categoria='+cbCurso_categoria+'&nombre_actividad='+nombre_actividad+'&nombre_entidad='+nombre_entidad+'&Duracion_curso='+Duracion_curso+'&Observaciones_curso='+Observaciones_curso+'&id_usuario='+id_usuario,
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 = resp.split(" / ")[2];
                if(v0 == 1){
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                    $(v2).focus(); // Para quitar focus = .blur()
                    $(v2).css({'border':'2px solid #F50101dd'});
                    if(v2 == '#cbCurso_categoria'){
                        $('#cbCapacitacion').css({'border':'1px solid #312E33'});
                    }else
                    if(v2 == '#nombre_actividad'){
                        $('#cbCurso_categoria').css({'border':'1px solid #312E33'});
                        $('#cbCapacitacion').css({'border':'1px solid #312E33'});
                    }else
                    if(v2 == '#nombre_entidad'){
                        $('#cbCurso_categoria').css({'border':'1px solid #312E33'});
                        $('#cbCapacitacion').css({'border':'1px solid #312E33'});
                        $('#nombre_actividad').css({'border':'1px solid #312E33'});
                    }else
                    if(v2 == '#Duracion_curso'){
                        $('#cbCurso_categoria').css({'border':'1px solid #312E33'});
                        $('#cbCapacitacion').css({'border':'1px solid #312E33'});
                        $('#nombre_actividad').css({'border':'1px solid #312E33'});
                        $('#nombre_entidad').css({'border':'1px solid #312E33'});
                    }
                }else{
                    $('#cursos').html(resp);
                    $("#cbCapacitacion").val('-1');
                    $("#cbCurso_categoria").val('-1');
                    $("#nombre_actividad").val('');
                    $("#nombre_entidad").val('');
                    $("#Duracion_curso").val('');
                    $("#Observaciones_curso").val('');
                    $("#id_usuario").val('0');
                    selecc();
                    $('#actualizar').css({'display':'none'});
                    $('#agregar').css({'display':''});
                }
            }
        });
    }
}

function modificar_curso(id){
    //alert(id);
    $.ajax({
        url: 'modificar_curso.php?id='+id,
        type: 'GET',
        success: function(resp) {
            //alert (resp);
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            let v3 =  resp.split(" / ")[3];
            let v4 =  resp.split(" / ")[4];
            let v5 =  resp.split(" / ")[5];
            let v6 =  resp.split(" / ")[6];
            let valor = document.getElementById("cbCapacitacion").tabIndex;
            let valor1 = valor + 1;
            let valor2 = valor + 2;
            let valor3 = valor + 3;
            let valor4 = valor + 4;
            let valor5 = valor + 5;
            let valor6 = valor + 6;
            document.getElementById("texto").innerText = ('Se extrajo sus datos con exito');
            document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
            document.getElementById("titulo").style.color = "white";
            document.getElementById("titulo").innerText = ("Atención");
            document.getElementById("alerta").style.display = "Block";
            if(v1 == 1){
                document.getElementById("id_usuario").value = v0;
                document.getElementById("cbCapacitacion").value = v1;
                document.getElementById("cbCapacitacion").focus();
                document.getElementById("op1").style.display = 'block';
                document.getElementById("cbCurso_categoria").tabIndex = valor1;
                document.getElementById("op2").style.display = 'block';
                document.getElementById("op2").tabIndex = valor2;
                document.getElementById("nombre_actividad").tabIndex = valor2;
                document.getElementById("op3").style.display = 'block';
                document.getElementById("op3").tabIndex = valor3;
                document.getElementById("nombre_entidad").tabIndex = valor3;
                document.getElementById("op4").style.display = 'block';
                document.getElementById("op4").tabIndex = valor4;
                document.getElementById("Duracion_curso").tabIndex = valor4;
                document.getElementById("actualizar").style.display = 'block';
                document.getElementById("actualizar").tabIndex = valor6;
                document.getElementById("agregar").style.display = 'none';
                document.getElementById("cbCurso_categoria").value = v2;
                document.getElementById("nombre_actividad").value = v3;
                document.getElementById("nombre_entidad").value = v4;
                document.getElementById("Duracion_curso").value = v5;
                document.getElementById("Observaciones_curso").value = v6;
                document.getElementById("Observaciones_curso").tabIndex = valor5;
                document.getElementById("obg").tabIndex = valor5;
            }else{
                document.getElementById("id_usuario").value = v0;
                document.getElementById("cbCapacitacion").value = v1;
                document.getElementById("cbCapacitacion").focus();
                document.getElementById("op1").style.display = 'none';
                document.getElementById("op2").style.display = 'none';
                document.getElementById("op3").style.display = 'none';
                document.getElementById("op4").style.display = 'none';
                document.getElementById("actualizar").style.display = 'block';
                document.getElementById("agregar").style.display = 'none';  
                document.getElementById("cbCurso_categoria").value = -1;
                document.getElementById("nombre_actividad").value = "";
                document.getElementById("nombre_entidad").value = "";
                document.getElementById("Duracion_curso").value = "";
                document.getElementById("Observaciones_curso").value = v6;
                document.getElementById("cbCurso_categoria").tabIndex = valor1;
                document.getElementById("op2").tabIndex = valor2;
                document.getElementById("nombre_actividad").tabIndex = valor2;
                document.getElementById("op3").tabIndex = valor3;
                document.getElementById("nombre_entidad").tabIndex = valor3;
                document.getElementById("op4").tabIndex = valor4;
                document.getElementById("Duracion_curso").tabIndex = valor4;
                document.getElementById("Observaciones_curso").tabIndex = valor5;
                document.getElementById("obg").tabIndex = valor5;
                document.getElementById("actualizar").tabIndex = valor6;
            }
            //$('#cursos').html(resp);
        }
    });
}

function eliminar_curso(id){
    $.ajax({
        url: 'eliminar_curso.php?id='+id,
        type: 'GET',
        success: function(resp) {
            //alert(resp);
            $('#cursos').html(resp);
        }
    });
}