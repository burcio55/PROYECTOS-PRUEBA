function accion_plan_empresa_del(plan_formacion2,empresa_id)
{
    /* alert(plan_formacion2) */
    /* alert("Todo bien") */
    $.ajax
    ({
        url: 'accion_plan_empresa2.php?plan_formacion2='+plan_formacion2+'&empresa_id='+empresa_id,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            $('#fe02').html(v0);
            /* alert(v1) */
        }
    });
}
