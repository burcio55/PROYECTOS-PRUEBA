function accion_guardar4(nombres2,apellidos2,telf2,Ambiente_Formacion2,Experiencia_Productiva2,Formacion_CPTT2,Insercion_Laboral2,srif)
{
    let valor = 0;

    if(document.getElementById("nombres2").value == ''){
        document.getElementById("nombres2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("nombres2").style.borderColor = '';
    }
    if(document.getElementById("apellidos2").value == ''){
        document.getElementById("apellidos2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("apellidos2").style.borderColor = '';
    }
    if(document.getElementById("telf2").value == ''){
        document.getElementById("telf2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("telf2").style.borderColor = '';
    }
    if(document.getElementById("Ambiente_Formacion2").value == '-1'){
        document.getElementById("Ambiente_Formacion2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("Ambiente_Formacion2").style.borderColor = '';
    }
    
    if(document.getElementById("Experiencia_Productiva2").value == '-1'){
        document.getElementById("Experiencia_Productiva2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("Experiencia_Productiva2").style.borderColor = '';
    }

    if(document.getElementById("Formacion_CPTT2").value == '-1'){
        document.getElementById("Formacion_CPTT2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("Formacion_CPTT2").style.borderColor = '';
    }

    if(document.getElementById("Insercion_Laboral2").value == '-1'){
        document.getElementById("Insercion_Laboral2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("Insercion_Laboral2").style.borderColor = '';
    }

    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        $.ajax
        ({
            url: 'accion_guardar4.php?',
            type: 'POST',
            data:{
                nombres2: nombres2,
                apellidos2: apellidos2,
                telf2: telf2,
                Ambiente_Formacion2: Ambiente_Formacion2,
                Experiencia_Productiva2: Experiencia_Productiva2,
                Formacion_CPTT2: Formacion_CPTT2,
                Insercion_Laboral2: Insercion_Laboral2,
                srif:srif
            },
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                if(v0 == 1){
                    alert(v1);
                    /* alert(srif); */
                    location.href = 'files2.php?srif=' + srif;
                    /* $(location).attr('href','accion_guardar2.php?nombres='+nombres+'&apellidos='+apellidos+'&telf='+telf+'&Ambiente_Formacion='+Ambiente_Formacion+'&ope0='+ope0+'&ope2='+ope2+'&ope3='+ope3+'&ope4='+ope4+'&ope5='+ope5+'&Experiencia_Productiva='+Experiencia_Productiva+'&Formacion_CPTT='+Formacion_CPTT+'&Insercion_Laboral='+Insercion_Laboral);  */
                }else{
                    alert(v1);
                }
            }
        });
    }
}