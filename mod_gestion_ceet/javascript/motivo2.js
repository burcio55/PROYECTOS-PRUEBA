
function accion_motivo_del(id_motivo)
{
    /* alert(id_motivo); */
    $.ajax
    ({
        url: 'accion_motivo2.php?id_motivo='+id_motivo,
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
    window.location.reload();
    location.reload();
    window.location.reload();
    location.reload();
}