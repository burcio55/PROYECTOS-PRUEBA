function accion_aprendizaje_del(id_aprendizaje)
{
    /* alert(id_aprendizaje); */
    $.ajax
    ({
        url: 'accion_aprendizaje2.php?id_aprendizaje='+id_aprendizaje,
        type: 'GET',
        success: function(resp) {
            alert(resp);
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
}