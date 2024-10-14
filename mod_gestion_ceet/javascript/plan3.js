
function accion_plan_mod(id, sdescripcion) {

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
        url: 'accion_plan3.php?id_plan='+id_plan+'&plan='+plan,
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
    window.location.reload();
    location.reload();
    window.location.reload();
    location.reload();
}