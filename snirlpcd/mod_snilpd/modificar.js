
function agregar_estudios(nacademico,graduado,titulo,anio_graduacion,instituto,estatus,ultimo_anio,observaciones,usuario){
    let valor = 0;
    if(nacademico == '-1' || nacademico == null){
        document.getElementById('cbNivel_academico').style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById('cbNivel_academico').style.border = "";
        if(nacademico > '2'){
            if(graduado == '-1' || graduado == null){
                document.getElementById('cbGraduado').style.border = "1px solid red";
                valor++;
            }else{
                document.getElementById('cbGraduado').style.border = "";
                if(graduado == true){
                    if(titulo == ''){
                        document.getElementById('titulo').style.border = "1px solid red";
                        valor++;
                    }else{
                        document.getElementById('titulo').style.border = "";
                    }
                    if(anio_graduacion == ''){
                        document.getElementById('anio_graduacion').style.border = "1px solid red";
                        valor++;
                    }else{
                        document.getElementById('anio_graduacion').style.border = "";
                    }
                    if(instituto == ''){
                        document.getElementById('instituto').style.border = "1px solid red";
                        valor++;
                    }else{
                        document.getElementById('instituto').style.border = "";
                    }
                }else{
                    if(instituto == ''){
                        document.getElementById('instituto').style.border = "1px solid red";
                        valor++;
                    }else{
                        document.getElementById('instituto').style.border = "";
                    }
                    if(estatus == '-1' || estatus == null){
                        document.getElementById('Estatus_academico').style.border = "1px solid red";
                        valor++;
                    }else{
                        document.getElementById('Estatus_academico').style.border = "";
                    }
                    if(ultimo_anio == ''){
                        document.getElementById('ultimo_anio').style.border = "1px solid red";
                        valor++;
                    }else{
                        document.getElementById('ultimo_anio').style.border = "";
                    }
                }
            }
        }
    }
    if(valor > 0){
        document.getElementById("texto").innerText = ("Debe completar los \"Campos Obligatorios (*)\"");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("titulo").innerText = ("Atención");
        document.getElementById("alerta").style.display = "Block";
    }else{
        $.ajax({
            url: 'v_educacion.php?nacademico='+nacademico+'&graduado='+graduado+'&titulo='+titulo+'&anio_graduacion='+anio_graduacion+'&instituto='+instituto+'&estatus='+estatus+'&ultimo_anio='+ultimo_anio+'&observaciones='+observaciones+'&usuario='+usuario,
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
                    if(v2 == '#cbGraduado'){
                        $('#cbNivel_academico').css({'border':'1px solid #312E33'});
                    }else
                    if(nacademico > 2){
                        if(graduado == 1){
                            if(v2 == '#titulo'){
                                $('#cbNivel_academico').css({'border':'1px solid #312E33'});
                                $('#cbGraduado').css({'border':'1px solid #312E33'});
                            }else
                            if(v2 == '#anio_graduacion'){
                                $('#cbNivel_academico').css({'border':'1px solid #312E33'});
                                $('#cbGraduado').css({'border':'1px solid #312E33'});
                                $('#titulo').css({'border':'1px solid #312E33'});
                            }else
                            if(v2 == '#instituto'){
                                $('#cbNivel_academico').css({'border':'1px solid #312E33'});
                                $('#cbGraduado').css({'border':'1px solid #312E33'});
                                $('#titulo').css({'border':'1px solid #312E33'});
                                $('#anio_graduacion').css({'border':'1px solid #312E33'});
                            }
                        }else{
                            if(v2 == '#instituto'){
                                $('#cbNivel_academico').css({'border':'1px solid #312E33'});
                                $('#cbGraduado').css({'border':'1px solid #312E33'});
                            }else
                            if(v2 == '#Estatus_academico'){
                                $('#cbNivel_academico').css({'border':'1px solid #312E33'});
                                $('#cbGraduado').css({'border':'1px solid #312E33'});
                                $('#instituto').css({'border':'1px solid #312E33'});
                            }else
                            if(v2 == '#ultimo_anio'){
                                $('#cbNivel_academico').css({'border':'1px solid #312E33'});
                                $('#cbGraduado').css({'border':'1px solid #312E33'});
                                $('#instituto').css({'border':'1px solid #312E33'});
                                $('#Estatus_academico').css({'border':'1px solid #312E33'});
                            }
                        }
                    }
                }else{
                    $('#estudios').html(resp);
                    location.reload();
                }            
            }
        });
    }
}

function continuar(){
    $.ajax({
        url: 'v_educacion.php?verificar=1',
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
                $(location).attr('href','capacitacion.php'); 
            }
        }
    });
}
