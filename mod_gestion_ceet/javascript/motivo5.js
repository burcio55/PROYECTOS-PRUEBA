function accion_eliminar(id_motivo)
{
    /* alert(id_motivo); */
    $.ajax
    ({
        url: 'accion_motivo5.php?id_motivo='+id_motivo,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            $('#fe').html(v0);
        }
    });
}