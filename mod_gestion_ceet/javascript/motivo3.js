
function accion_motivo_mod(id, sdescripcion) {

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
        url: 'accion_motivo3.php?id_motivo='+id_motivo+'&motivo='+motivo,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            if(v0 == 1){
                alert(v1);
                window.location.reload();
                location.reload();
                window.location.reload();
                location.reload();
            }else{
                alert(v1);
                window.location.reload();
                location.reload();
                window.location.reload();
                location.reload();
            }
        }
    });
    window.location.reload();
    location.reload();
    window.location.reload();
    location.reload();
}