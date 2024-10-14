function accion_ambiente(ambiente)
{
    let valor = 0;
    if(document.getElementById("ambiente").value == ''){
        document.getElementById("ambiente").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("ambiente").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        $.ajax
        ({
            url: 'accion_ambiente_aprendizaje.php?ambiente='+ambiente+'&accion=1',
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                    alert(v1);
                    $('#fe5').html(v2);
                    document.getElementById("ambiente").value==" ";
                    location.reload();
                }else{
                    alert(v1);
                }
            }
        });
    }
}
function accion_ambiente_eliminar(ambiente)
{
    $.ajax
    ({
        url: 'accion_ambiente_aprendizaje.php?ambiente='+ambiente+'&accion=2',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if(v0 == 1){
                alert(v1);
                $('#fe5').html(v2);
            }else{
                alert(v1);
            }
        }
    });
}
function accion_ambiente_modificar(id, sdescripcion) {

    /* alert(id); */

    $("#ambiente_id").val(id);
    $("#ambiente").val(sdescripcion);

    $('#ambiente_agr').css('display','none');
    $('#ambiente_act').css('display','block');
}
function accion_ambiente_act(id_ambiente, ambiente){

    /* alert(id_ambiente + ' ' + ambiente); */

    $('#ambiente_agr').css('display','block');
    $('#ambiente_act').css('display','none');

    $.ajax
    ({
        url: 'accion_ambiente_aprendizaje.php?id_ambiente='+id_ambiente+'&ambiente='+ambiente+'&accion=3',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if(v0 == 1){
                alert(v1);
                $('#fe5').html(v2);
                document.getElementById("ambiente").value==" ";location.reload();
            }else{
                alert(v1);
            }
        }
    });
}
