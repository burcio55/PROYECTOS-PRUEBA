function accion_novedad_del(id_novedad)
{
    $.ajax
    ({
        url: 'accion_novedad2.php?id_novedad='+id_novedad,
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
}