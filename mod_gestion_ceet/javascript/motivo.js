function accion_motivo(motivo)
{
    $.ajax
    ({
        url: 'accion_motivo.php?motivo='+motivo,
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
    window.location.reload();
    location.reload();
    window.location.reload();
    location.reload();
    window.location.reload();
    location.reload();
    window.location.reload();
    location.reload();
}

/* function accion_motivo(motivo)
{
  $.ajax
  ({
    url: 'accion_motivo.php?motivo='+motivo,
    type: 'GET',
    success: function(resp) {
      let v0 = resp.split(" / ")[0];
      let v1 = resp.split(" / ")[1];
      if(v0 == 1){
        alert(v1);
      }else{
        alert(v1);
        $(document).on("ajaxComplete", function() {
          window.location.reload();
        });
      }
    }
  });
} */