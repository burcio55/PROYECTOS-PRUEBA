function accion_plan(plan)
{
    $.ajax
    ({
        url: 'accion_plan.php?plan='+plan,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            if(v0 == 1){
                alert(v1);
                window.location.reload();
                location.reload();
                window.location.reload();
                location.reload();
            }else{
                alert(v1);
                window.location.reload();
                location.reload();
                window.location.reload();
                location.reload();
            }
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