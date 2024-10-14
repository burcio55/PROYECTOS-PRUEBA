function accion_novedad(novedad)
{
    let valor = 0;
    if(document.getElementById("novedad").value == ''){
        document.getElementById("novedad").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("novedad").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        $.ajax
        ({
            url: 'accion_novedades.php?novedad='+novedad+'&accion=1',
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                    alert(v1);
                    $('#fe3').html(v2);
                    document.getElementById("novedad").value==" ";
                    location.reload();
                }else{
                    alert(v1);
                }
            }
        });
    }
}
function accion_novedad_eliminar(novedad)
{
    $.ajax
    ({
        url: 'accion_novedades.php?novedad='+novedad+'&accion=2',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if(v0 == 1){
                alert(v1);
                $('#fe3').html(v2);
            }else{
                alert(v1);
            }
        }
    });
}
function accion_novedad_modificar(id, sdescripcion) {

    /* alert(id); */

    $("#novedad_id").val(id);
    $("#novedad").val(sdescripcion);

    $('#novedad_agr').css('display','none');
    $('#novedad_act').css('display','block');
}
function accion_novedad_act(id_novedad, novedad){

    /* alert(id_novedad + ' ' + novedad); */

    $('#novedad_agr').css('display','block');
    $('#novedad_act').css('display','none');

    $.ajax
    ({
        url: 'accion_novedades.php?id_novedad='+id_novedad+'&novedad='+novedad+'&accion=3',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if(v0 == 1){
                alert(v1);
                $('#fe3').html(v2);
                document.getElementById("novedad").value==" ";
                location.reload();
            }else{
                alert(v1);
            }
        }
    });
}
