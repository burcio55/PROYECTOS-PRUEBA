function accion_eliminar2(id_plan)
{
    /* alert(id_plan); */
    $.ajax
    ({
        url: 'accion_plan5.php?id_plan='+id_plan,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            $('#fe2').html(v0);
        }
    });
}