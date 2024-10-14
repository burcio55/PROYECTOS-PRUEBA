function accion_motor(motor)
{
    $.ajax
    ({
        url: 'accion_motor.php?motor='+motor,
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