function accion_plan(plan_formacion,n_nacionalidad,personales_cedula)
{
    let valor = 0;
    if(document.getElementById("plan_formacion").value == -1){
        document.getElementById("plan_formacion").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("plan_formacion").style.borderColor = '';
    }
    if(document.getElementById("n_nacionalidad").value == -1){
        document.getElementById("n_nacionalidad").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("n_nacionalidad").style.borderColor = '';
    }
    if(document.getElementById("personales_cedula").value == ''){
        document.getElementById("personales_cedula").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("personales_cedula").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        /* alert (plan_formacion + " " + n_nacionalidad + " " + personales_cedula); */
        $.ajax
        ({
            url: 'accion_plan4.php?plan_formacion='+plan_formacion+'&n_nacionalidad='+n_nacionalidad+'&personales_cedula='+personales_cedula,
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                    alert(v1);
                    $('#fe2').html(v2);
                }else{
                    alert(v1);
                }
            }
        });
    }
}
