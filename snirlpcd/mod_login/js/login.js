function buscar(nacionalidad, cedula){
    let valor = 0;
    if(isNaN(cedula)){
        document.getElementById("texto").innerText = "Debe ingresar únicamente número no letras";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("titulo").innerText = ("Atención");
        document.getElementById("alerta").style.display = "Block";
        return false;
    }
    if(nacionalidad == ""){
        document.getElementById("nacionalidad").style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById("nacionalidad").style.border = "";
    }
    if(cedula == ""){
        document.getElementById("ced_afiliado").style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById("ced_afiliado").style.border = "";
    }
    if(valor == 0){
        $.ajax({
            url: '/snirlpcd/mod_login/login_Controlador2.php?nacionalidad='+nacionalidad+'&cedula='+cedula+'&accion=1',
            type: 'GET',
            success: function(resp) {
                //alert(resp);
                let condicional = resp.split(" / ")[0];
                if(condicional == '1'){
                    let mensaje = resp.split(" / ")[1];
                    let v2 = resp.split(" / ")[2];
                    document.getElementById("texto").innerText = mensaje;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                    $(v2).focus();
                    $(v2).css({'border':'2px solid #F50101dd'});
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
                    if(variable5 == "2"){
                        variable5 = "Masculino";
                    }else{
                        variable5 = "Femenino";
                    }
                    $("#cbSexo_afiliado").val(variable5);
                    let mensaje = ("Se ha encontrado su registro, estos son sus datos: "+variable1+" "+variable2+" "+variable3+" "+variable4);
                    document.getElementById("texto").innerText = mensaje;
                    document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                    document.getElementById("link").value = "";
                    document.getElementById("grup2").style.display = 'Block';
                }else if(condicional == '3'){
                    let mensaje = resp.split(" / ")[1];
                    document.getElementById("texto").innerText = mensaje;
                    document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                    document.getElementById("link").value = "/snirlpcd/mod_login/login2.php";
                }
            }
        });
    }else{
        document.getElementById("texto").innerText = "Debe Completar los Datos Obligatorios";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("titulo").innerText = ("Atención");
        document.getElementById("alerta").style.display = "Block";
    }
}
function registrar(nacionalidad,cedula,nombre1,nombre2,apellido1,apellido2,sexo,fnacimiento,telefono,telefono2,email,email2){
    let validador = 1;
    let valor = 0;
    if(email2.indexOf('@', 0) == -1 || email2.indexOf('.', 0) == -1) {
        validador++;
    }else{
        if(email2.indexOf('gmail', 0) != -1){
            validador = 1;
        }else
        if(email2.indexOf('outlook', 0) != -1){
            validador = 1;
        }else
        if(email2.indexOf('yahoo', 0) != -1){
            validador = 1;
        }else
        if(email2.indexOf('hotmail', 0) != -1){
            validador = 1;
        }else{
            validador++;
        }
    }
    if(nombre1 == ""){
        document.getElementById("nombre_afiliado1").style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById("nombre_afiliado1").style.border = "";
    }
    if(apellido1 == ""){
        document.getElementById("apellido_afiliado1").style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById("apellido_afiliado1").style.border = "";
    }
    if(sexo == ""){
        document.getElementById("cbSexo_afiliado").style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById("cbSexo_afiliado").style.border = "";
    }
    if(fnacimiento == ""){
        document.getElementById("fnacimiento_afiliado").style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById("fnacimiento_afiliado").style.border = "";
    }
    if(telefono == ""){
        document.getElementById("telefono_afiliado").style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById("telefono_afiliado").style.border = "";
    }
    if(email == ""){
        document.getElementById("email_afiliado").style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById("email_afiliado").style.border = "";
    }
    if(email2 == ""){
        document.getElementById("email_afiliado_V").style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById("email_afiliado_V").style.border = "";
    }
    if(valor == 0){
        if(validador == 1){
            $.ajax({
                url: '/snirlpcd/mod_login/login_Controlador2.php?nacionalidad='+nacionalidad+'&cedula='+cedula+'&nombre1='+nombre1+'&nombre2='+nombre2+'&apellido1='+apellido1+'&apellido2='+apellido2+'&sexo='+sexo+'&fnacimiento='+fnacimiento+'&telefono='+telefono+'&telefono2='+telefono2+'&email='+email+'&email2='+email2+'&accion=2',
                type: 'GET',
                success: function(resp) {
                    //alert(resp);
                    let condicional = resp.split(" / ")[0];
                    if(condicional == '1'){
                        let mensaje = resp.split(" / ")[1];
                        let v2 = resp.split(" / ")[2];
                        document.getElementById("texto").innerText = mensaje;
                        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                        document.getElementById("titulo").style.color = "white";
                        document.getElementById("titulo").innerText = ("Atención");
                        document.getElementById("alerta").style.display = "Block";
                        $(v2).focus();
                        $(v2).css({'border':'2px solid #F50101dd'});
                        if(v2 == '#ced_afiliado'){
                            $('#nacionalidad').css({'border':'1px solid #312E33'});
                        }else
                        if(v2 == '#fnacimiento_afiliado'){
                            $('#nacionalidad').css({'border':'1px solid #312E33'});
                            $('#ced_afiliado').css({'border':'1px solid #312E33'});
                        }else
                        if(v2 == '#telefono_afiliado'){
                            $('#nacionalidad').css({'border':'1px solid #312E33'});
                            $('#ced_afiliado').css({'border':'1px solid #312E33'});
                            $('#fnacimiento_afiliado').css({'border':'1px solid #312E33'});
                        }else
                        if(v2 == '#email_afiliado'){
                            $('#nacionalidad').css({'border':'1px solid #312E33'});
                            $('#ced_afiliado').css({'border':'1px solid #312E33'});
                            $('#fnacimiento_afiliado').css({'border':'1px solid #312E33'});
                            $('#telefono_afiliado').css({'border':'1px solid #312E33'});
                        }else
                        if(v2 == '#email_afiliado_V'){
                            $('#nacionalidad').css({'border':'1px solid #312E33'});
                            $('#ced_afiliado').css({'border':'1px solid #312E33'});
                            $('#fnacimiento_afiliado').css({'border':'1px solid #312E33'});
                            $('#telefono_afiliado').css({'border':'1px solid #312E33'});
                            $('#email_afiliado').css({'border':'1px solid #312E33'});
                        }
                    }else if(condicional == '2'){
                        /* let mensaje = resp.split(" / ")[1]; */
                        let mensaje = "Usuario creado exitosamente";
                        document.getElementById("texto").innerText = mensaje;
                        document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
                        document.getElementById("titulo").style.color = "white";
                        document.getElementById("titulo").innerText = ("Atención");
                        document.getElementById("alerta").style.display = "Block";
                        document.getElementById("link").value = "/snirlpcd/mod_login/olvido_contra.php";
                        $(location).attr('href','/snirlpcd/mod_login/olvido_contra.php');
                    }
                }
            });
        }else{
            document.getElementById("texto").innerText = ('El Correo Electrónico no posee un formato correcto');
            document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
            document.getElementById("titulo").style.color = "white";
            document.getElementById("titulo").innerText = ("Atención");
            document.getElementById("alerta").style.display = "Block";
        }
    }else{
        document.getElementById("texto").innerText = "Debe Completar los Datos Obligatorios";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("titulo").innerText = ("Atención");
        document.getElementById("alerta").style.display = "Block";
    }
}
function ingresar(nacionalidad,cedula,clave,codigo1,codigo2){
    let valor = 0;
    if(nacionalidad == ""){
        document.getElementById("cbCed_afiliado").style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById("cbCed_afiliado").style.border = "";
    }
    if(cedula == ""){
        document.getElementById("txt_usuario").style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById("txt_usuario").style.border = "";
    }
    if(clave == ""){
        document.getElementById("txt_clave").style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById("txt_clave").style.border = "";
    }
    if(codigo2 == ""){
        document.getElementById("txt_codigo2").style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById("txt_codigo2").style.border = "";
    }
    if(valor == 0){
        $.ajax({
            url: '/snirlpcd/mod_login/login_Controlador2.php?nacionalidad='+nacionalidad+'&cedula='+cedula+'&clave='+clave+'&codigo1='+codigo1+'&codigo2='+codigo2+'&accion=3',
            type: 'GET',
            success: function(resp) {
                let condicional = resp.split(" / ")[0];
                if(condicional == '1'){
                    let mensaje = resp.split(" / ")[1];
                    let v2 = resp.split(" / ")[2];
                    document.getElementById("texto").innerText = mensaje;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                    $(v2).focus();
                    $(v2).css({'border':'2px solid #F50101dd'});
                }else if(condicional == '2'){
                    $(location).attr('href','../mod_snilpd/index.php');
                }else if(condicional == '3'){
                    $(location).attr('href','/snirlpcd/mod_login/olvido_contra.php');
                }
            }
        });
    }else{
        document.getElementById("texto").innerText = "Debe Completar los Datos Obligatorios";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("titulo").innerText = ("Atención");
        document.getElementById("alerta").style.display = "Block";
    }
}