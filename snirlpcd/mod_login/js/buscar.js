function consultar(nacionalidad, ced_afiliado){
    alert('consulta');
    $.ajax({
        type: 'GET',
        url: '/snirlpcd/mod_login/registrarse.php?nacionalidad='+nacionalidad+'&cedula='+ced_afiliado,
        success: function(resp) {
            alert(resp);
        }
    });
}