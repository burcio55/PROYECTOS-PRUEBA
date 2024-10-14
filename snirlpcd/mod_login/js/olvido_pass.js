function validar_olvido(){
    $.ajax({
        url: '/snirlpcd/mod_login/login_Controlador2.php?&accion=5',
        type: 'GET',
        success: function(resp) {
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            let v2 = resp.split(" / ")[2];
            let v3 = resp.split(" / ")[3];
            $('#Pregunta1').html(v0);
            $('#Pregunta2').html(v1);
            $('#flexRadioDefault1').val(v2);
            $('#flexRadioDefault2').val(v2);
            $('#flexRadioDefault3').val(v3);
            $('#flexRadioDefault4').val(v3);
        }
    });
}
function olvido(nacionalidad,cedula){
    if(nacionalidad == ''){
        alert('Debe completar los campos obligatorios');
    }else if(cedula == ''){
        alert('Debe completar los campos obligatorios');
    }else{
        $.ajax({
            url: '/snirlpcd/mod_login/login_Controlador2.php?nacionalidad='+nacionalidad+'&cedula='+cedula+'&accion=4',
            type: 'GET',
            success: function(resp) {
                let condicional = resp.split(" / ")[0];
                //let mensaje = resp.split(" / ")[1];
                if(condicional == '1'){
                    let mensaje = resp.split(" / ")[1];
                    document.getElementById("texto").innerText = mensaje;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                }else if(condicional == '2'){
                    var formulario_login = document.getElementById("frm_olvido");
                    var formulario_login2 = document.getElementById("frm_olvido2");

                    formulario_login2.style.display = "block";
                    formulario_login.style.display = "none";
                    validar_olvido();
                }
            }
        });
    }
}
function validar(){
    let telefono = document.querySelector('input[id="flexRadioDefault1"]:checked');
    let nacimiento = document.querySelector('input[id="flexRadioDefault3"]:checked');
    let validar1 = 0;
    let validar2 = 0;
    if(telefono) {
        validar1=1;
    } else {
        validar1=2;
    }
    if(nacimiento) {
        validar2=1;
    } else {
        validar2=2;
    }
    telefono = document.getElementById("flexRadioDefault2").value;
    nacimiento = document.getElementById("flexRadioDefault4").value;
    $.ajax({
        url: '/snirlpcd/mod_login/login_Controlador2.php?telefono='+telefono+'&nacimiento='+nacimiento+'&validar1='+validar1+'&validar2='+validar2+'&accion=6',
        type: 'GET',
        success: function(resp) {
            let condicional = resp.split(" / ")[0];
            let mensaje = resp.split(" / ")[1];
            if(condicional == 1){
                document.getElementById("texto").innerText = mensaje;
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("titulo").innerText = ("Atención");
                document.getElementById("alerta").style.display = "Block";
                document.getElementById("link").value = "/snirlpcd/mod_login/login2.php";
            }else{
                document.getElementById("texto").innerText = mensaje;
                document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("titulo").innerText = ("Atención");
                document.getElementById("alerta").style.display = "Block";
            }
        }
    });
}