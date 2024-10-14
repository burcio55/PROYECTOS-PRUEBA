function accion_motivo_empresa(motivo2,srif)
{
    let valor = 0;
    if(document.getElementById("motivo2").value == -1){
        document.getElementById("motivo2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("motivo2").style.borderColor = '';
    }
    if(document.getElementById("srif").value == ''){
        document.getElementById("srif").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("srif").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
/* 
        document.getElementById("asa").style.display='block'; */

        /* alert(motivo2 + " " + srif); */
        $.ajax
        ({
            url: 'accion_motivo_empresa.php?motivo2='+motivo2+'&srif='+srif,
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                    alert(v1);
                    $('#fe01').html(v2);
                }else{
                    alert(v1);
                }
            }
        });
    }
}
