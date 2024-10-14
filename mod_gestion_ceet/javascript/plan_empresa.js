function accion_plan_empresa(plan_formacion2,srif)
{
    /* alert(plan_formacion2) */
    let valor = 0;
    if(document.getElementById("plan_formacion2").value == -1){
        document.getElementById("plan_formacion2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("plan_formacion2").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        /* alert("Todo bien") */
        $.ajax
        ({
            url: 'accion_plan_empresa.php?plan_formacion2='+plan_formacion2+'&srif='+srif,
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                    alert(v1);
                    $('#fe02').html(v2);
                }else{
                    alert(v1);
                }
            }
        });
    }
}
