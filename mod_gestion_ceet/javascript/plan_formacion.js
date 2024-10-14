function accion_plan(plan)
{
    let valor = 0;
    if(document.getElementById("plan").value == ''){
        document.getElementById("plan").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("plan").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        $.ajax
        ({
            url: 'accion_plan_formacion.php?plan='+plan+'&accion=1',
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                    alert(v1);
                    $('#fe2').html(v2);
                    document.getElementById("plan").value==" ";
                    location.reload();
                }else{
                    alert(v1);
                }
            }
        });
    }
}
function accion_plan_eliminar(plan)
{
    $.ajax
    ({
        url: 'accion_plan_formacion.php?plan='+plan+'&accion=2',
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
function accion_plan_modificar(id, sdescripcion) {

    /* alert(id); */

    $("#plan_id").val(id);
    $("#plan").val(sdescripcion);

    $('#plan_agr').css('display','none');
    $('#plan_act').css('display','block');
}
function accion_plan_act(id_plan, plan){

    /* alert(id_plan + ' ' + plan); */

    $('#plan_agr').css('display','block');
    $('#plan_act').css('display','none');

    $.ajax
    ({
        url: 'accion_plan_formacion.php?id_plan='+id_plan+'&plan='+plan+'&accion=3',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if(v0 == 1){
                alert(v1);
                $('#fe2').html(v2);
                document.getElementById("plan").value==" ";
                location.reload();
            }else{
                alert(v1);
            }
        }
    });
}
