function accion_plan_del(id_plan)
{
    $.ajax
    ({
        url: 'accion_plan2.php?id_plan='+id_plan,
        type: 'GET',
        success: function(resp) {
            alert(resp);
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
            window.location.reload();
            location.reload();
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
}