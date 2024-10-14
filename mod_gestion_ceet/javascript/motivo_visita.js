function accion_motivo(motivo)
{
    let valor = 0;
    if(document.getElementById("motivo").value == ''){
        document.getElementById("motivo").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("motivo").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        $.ajax
        ({
            url: 'accion_motivo_visita.php?motivo='+motivo+'&accion=1',
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                    alert(v1);
                    $('#fe').html(v2);
                    document.getElementById("motivo").value==" ";
                    location.reload();
                }else{
                    alert(v1);
                }
            }
        });
    }
}
function accion_motivo_eliminar(motivo)
{
    $.ajax
    ({
        url: 'accion_motivo_visita.php?motivo='+motivo+'&accion=2',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if(v0 == 1){
                alert(v1);
                $('#fe').html(v2);
            }else{
                alert(v1);
            }
        }
    });
}
function accion_motivo_modificar(id, sdescripcion) {

    /* alert(id); */

    $("#motivo_id").val(id);
    $("#motivo").val(sdescripcion);

    $('#motivo_agr').css('display','none');
    $('#motivo_act').css('display','block');
}
function accion_motivo_act(id_motivo, motivo){

    /* alert(id_motivo + ' ' + motivo); */

    $('#motivo_agr').css('display','block');
    $('#motivo_act').css('display','none');

    $.ajax
    ({
        url: 'accion_motivo_visita.php?id_motivo='+id_motivo+'&motivo='+motivo+'&accion=3',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if(v0 == 1){
                alert(v1);
                $('#fe').html(v2);
                document.getElementById("motivo").value==" ";
                location.reload();
            }else{
                alert(v1);
            }
        }
    });
}
