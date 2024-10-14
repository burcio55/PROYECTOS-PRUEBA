function accion_eliminar_empresa(id_motivo,empresa_id)
{
    alert(id_motivo+" "+empresa_id);
    $.ajax
    ({
        url: 'accion_motivo_empresa2.php?id_motivo='+id_motivo+'&empresa_id='+empresa_id,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            $('#fe01').html(v0);
            /* alert(v0) */
        }
    });
}