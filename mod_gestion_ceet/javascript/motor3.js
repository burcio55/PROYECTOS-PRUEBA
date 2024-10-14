
function accion_motor_mod(id, sdescripcion) {

    /* alert(id); */

    $("#motor_id").val(id);
    $("#motor").val(sdescripcion);

    $('#motor_agr').css('display','none');
    $('#motor_act').css('display','block');
}
function accion_motor_act(id_motor, motor){

    /* alert(id_motor + ' ' + motor); */

    $('#motor_agr').css('display','block');
    $('#motor_act').css('display','none');

    $.ajax
    ({
        url: 'accion_motor3.php?id_motor='+id_motor+'&motor='+motor,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            if(v0 == 1){
                alert(v1);
            }else{
                alert(v1);
            }
        }
    });
    window.location.reload();
    location.reload();
}