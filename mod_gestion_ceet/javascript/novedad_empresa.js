function accion_novedad_empresa(novedades2,srif)
{
  /*   alert(novedades2+" "+srif) */
    let valor = 0;
    if(document.getElementById("novedades2").value == -1){
        document.getElementById("novedades2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("novedades2").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        /* alert("Todo bien") */
        $.ajax
        ({
            url: 'accion_novedad_empresa.php?novedades2='+novedades2+'&srif='+srif,
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                    alert(v1);
                    $('#fe03').html(v2);
                }else{
                    alert(v1);
                }
            }
        });
    }
}
