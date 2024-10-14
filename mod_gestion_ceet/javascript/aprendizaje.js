function accion_aprendizaje(aprendizaje)
{
    $.ajax
    ({
        url: 'accion_aprendizaje.php?aprendizaje='+aprendizaje,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            if(v0 == 1){
                alert(v1);
                window.location.reload();
                location.reload();
            }else{
                alert(v1);
                window.location.reload();
                location.reload();
            }
            window.location.reload();
            location.reload();
        }
    });
    window.location.reload();
    location.reload();
}