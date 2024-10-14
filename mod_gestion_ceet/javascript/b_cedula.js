function consulta(cedula) { 
    /* alert(cedula); */
    let valor = 0;
    if(document.getElementById("ced").value == ''){
        document.getElementById("ced").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("ced").style.borderColor = '';
        document.getElementById("nombre").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        $.ajax({
            url: 'b_cedula.php?accion=1&numcedula='+cedula,
            type: 'GET',
            success: function(data) {
                //alert(data);
                let v0 = data.split(" / ")[0]; //Validaciones
                let v1 = data.split(" / ")[1]; //mensaje o datos
                let v2 = data.split(" / ")[2]; //datos
                let v3 = data.split(" / ")[3];
                if(v0 == 1){
                    alert(v1);
                    location.reload();
                }else{
                    $('#nombre').val(v1);
                    $('#entidad_id').val(v2);
                     $('#rol_id').val(v3);
                }
            }
        });
    }   
}
/* function accion_rol(cedula,estado,rol)
{
    alert(cedula + ' ' + estado + ' ' + rol)
    $.ajax
    ({
        url: 'accion_rol.php?cedula='+cedula+'estado='+estado+'rol='+rol,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            if(v0 == 1){
                alert(v1);
            }else{
                alert(v1);
            }
        }
    });
} */