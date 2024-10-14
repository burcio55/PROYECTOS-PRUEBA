
function accion_aprendizaje_mod(id, sdescripcion) {

    /* alert(id); */

    $("#aprendizaje_id").val(id);
    $("#aprendizaje").val(sdescripcion);

    $('#aprendizaje_agr').css('display','none');
    $('#aprendizaje_act').css('display','block');
}
function accion_aprendizaje_act(id_aprendizaje, aprendizaje){

    /* alert(id_aprendizaje + ' ' + aprendizaje); */

    $('#aprendizaje_agr').css('display','block');
    $('#aprendizaje_act').css('display','none');

    $.ajax
    ({
        url: 'accion_aprendizaje3.php?id_aprendizaje='+id_aprendizaje+'&aprendizaje='+aprendizaje,
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
}