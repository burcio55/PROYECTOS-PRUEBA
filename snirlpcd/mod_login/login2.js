function buscar(nacionalidad, cedula){
    $.ajax({
		url: '/snirlpcd/mod_login/login_Controlador2.php?nacionalidad='+nacionalidad+'&cedula='+cedula+'&accion=1',
		type: 'GET',
		success: function(resp) {
            //alert(resp);
            let condicional = resp.split(" / ")[0];
            if(condicional == '1'){
                let mensaje = resp.split(" / ")[1];
                alert(mensaje);
            }else if(condicional == '2'){
                let variable1 = resp.split(" / ")[1];
                let variable2 = resp.split(" / ")[2];
                let variable3 = resp.split(" / ")[3];
                let variable4 = resp.split(" / ")[4];
                let variable5 = resp.split(" / ")[5];
                $("#nombre_afiliado1").val(variable1);
                $("#nombre_afiliado2").val(variable2);
                $("#apellido_afiliado1").val(variable3);
                $("#apellido_afiliado2").val(variable4);
                $("#cbSexo_afiliado").val(variable5);
            }else if(condicional == '3'){
                let mensaje = resp.split(" / ")[1];
                alert(mensaje);
                location.reload();
            }
        }
    });
}
function registrar(nacionalidad,cedula,nombre1,nombre2,apellido1,apellido2,sexo,fnacimiento,telefono,telefono2,email,email2){;
    $.ajax({
		url: '/snirlpcd/mod_login/login_Controlador2.php?nacionalidad='+nacionalidad+'&cedula='+cedula+'&nombre1='+nombre1+'&nombre2='+nombre2+'&apellido1='+apellido1+'&apellido2='+apellido2+'&sexo='+sexo+'&fnacimiento='+fnacimiento+'&telefono='+telefono+'&telefono2='+telefono2+'&email='+email+'&email2='+email2+'&accion=2',
		type: 'GET',
		success: function(resp) {
            //alert(resp);
            let condicional = resp.split(" / ")[0];
            if(condicional == '1'){
                let mensaje = resp.split(" / ")[1];
                alert(mensaje);
            }else if(condicional == '2'){
                let mensaje = resp.split(" / ")[1];
                alert(mensaje);
                location.reload();
            }
        }
    });
}