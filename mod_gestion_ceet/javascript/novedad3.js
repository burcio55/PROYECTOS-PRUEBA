
function accion_novedad_mod(id, sdescripcion) {

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
        url: 'accion_novedad3.php?id_novedad='+id_novedad+'&novedad='+novedad,
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
    window.location.reload();
    location.reload();
    window.location.reload();
    location.reload();
    window.location.reload();
    location.reload();
}