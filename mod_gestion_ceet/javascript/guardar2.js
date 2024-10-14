function accion_guardar2(nombres,apellidos,telf,Ambiente_Formacion,Experiencia_Productiva,Formacion_CPTT,Insercion_Laboral)
{
    let valor = 0;
    let ope0 = "TRUE";
    let ope2 = "TRUE";
    let ope3 = "TRUE";
    let ope4 = "TRUE";
    let ope5 = "TRUE";

    if(document.getElementById("nombres").value == ''){
        document.getElementById("nombres").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("nombres").style.borderColor = '';
    }
    if(document.getElementById("apellidos").value == ''){
        document.getElementById("apellidos").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("apellidos").style.borderColor = '';
    }
    if(document.getElementById("telf").value == ''){
        document.getElementById("telf").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("telf").style.borderColor = '';
    }
    if(document.getElementById("Ambiente_Formacion").value == '-1'){
        document.getElementById("Ambiente_Formacion").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("Ambiente_Formacion").style.borderColor = '';
    }
    if(document.getElementById("Experiencia_Productiva").value == '-1'){
        document.getElementById("Experiencia_Productiva").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("Experiencia_Productiva").style.borderColor = '';
    }
    if(document.getElementById("Formacion_CPTT").value == '-1'){
        document.getElementById("Formacion_CPTT").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("Formacion_CPTT").style.borderColor = '';
    }
    if(document.getElementById("Insercion_Laboral").value == '-1'){
        document.getElementById("Insercion_Laboral").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("Insercion_Laboral").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        $.ajax
        ({
            url: 'accion_guardar2.php?',
            type: 'POST',
            data:{
                nombres: nombres,
                apellidos: apellidos,
                telf: telf,
                Ambiente_Formacion: Ambiente_Formacion,
                ope0: ope0,
                ope2: ope2,
                ope3: ope3,
                ope4: ope4,
                ope5: ope5,
                Experiencia_Productiva: Experiencia_Productiva,
                Formacion_CPTT: Formacion_CPTT,
                Insercion_Laboral: Insercion_Laboral
            },
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                if(v0 == 1){
                    alert(v1);
                    $(location).attr('href','files.php');
                    /* $(location).attr('href','accion_guardar2.php?nombres='+nombres+'&apellidos='+apellidos+'&telf='+telf+'&Ambiente_Formacion='+Ambiente_Formacion+'&ope0='+ope0+'&ope2='+ope2+'&ope3='+ope3+'&ope4='+ope4+'&ope5='+ope5+'&Experiencia_Productiva='+Experiencia_Productiva+'&Formacion_CPTT='+Formacion_CPTT+'&Insercion_Laboral='+Insercion_Laboral);  */
                }else{
                    alert(v1);
                }
            }
        });
    }
}