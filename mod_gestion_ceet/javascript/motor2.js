function accion_motor_del(id_motor)
{
    $.ajax
    ({
        url: 'accion_motor2.php?id_motor='+id_motor,
        type: 'GET',
        success: function(resp) {
            alert(resp);
            $(location).attr('href','registro_admin_ceet.php');
            window.location.reload();
            location.reload();
        }
    });
}