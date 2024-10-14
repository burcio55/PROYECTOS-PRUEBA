

function agg_origen(or2){
    let valor0=0;
    if(document.getElementById("or2").value==""){
        document.getElementById("or2").style.borderColor="red";
        valor0++;
    }else{
        document.getElementById("or2").style.borderColor="";
    }
    if(valor0>0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
    }else{
       /*  alert ('Todo mal'); */
        var fechaHora = new Date();
        console.log(fechaHora);
        $.ajax({
            url: 'proceso1.php?or2='+or2+'&fechaHora='+fechaHora+'&accion=1',
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                  
                    document.getElementById("texto").innerText = ("¡Se agrego con éxito!");
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";    
                    $('#fe').html(v2);
                
                    document.getElementById("or2").value = "";
                   

                }else{
                   document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                   
                    document.getElementById("observacion").style.display = "block";
                    
                   
                }
            }
        });
    }
}
function agg_bp(bp2){
    let valor0=0;
    if(document.getElementById("bp2").value==""){
        document.getElementById("bp2").style.borderColor="red";
        valor0++;
    }else{
        document.getElementById("bp2").style.borderColor="";
    }
    if(valor0>0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
    }else{
       /*  alert ('Todo mal'); */
        var fechaHora = new Date();
        console.log(fechaHora);
        $.ajax({
            url: 'proceso2.php?bp2='+bp2+'&fechaHora='+fechaHora+'&accion=1',
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                    
                    document.getElementById("texto").innerText = ("¡Se agrego con éxito!");
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";    
                    $('#fe').html(v2);

                    document.getElementById("bp2").value = "";
                   
                }else{
                  
                    //document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                   
                }
            }
        });
    }
}
function agg_marca(marc2){
    let valor0=0;
    if(document.getElementById("marc2").value==""){
        document.getElementById("marc2").style.borderColor="red";
        valor0++;
    }else{
        document.getElementById("marc2").style.borderColor="";
    }
    if(valor0>0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
       /*  alert ('Todo mal'); */
        var fechaHora = new Date();
        console.log(fechaHora);
        $.ajax({
            url: 'proceso3.php?marc2='+marc2+'&fechaHora='+fechaHora+'&accion=1',
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                    
                    document.getElementById("texto").innerText = ("¡Se agrego con éxito!");
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";    
                    $('#fe').html(v2);
                    document.getElementById("marc2").value = "";
                  
                }else{
                   
                    document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    
                }
            }
        });
    }
}
function agg_color(colr2){
    let valor0=0;
    if(document.getElementById("colr2").value==""){
        document.getElementById("colr2").style.borderColor="red";
        valor0++;
    }else{
        document.getElementById("colr2").style.borderColor="";
    }
    if(valor0>0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
       /*  alert ('Todo mal'); */
        var fechaHora = new Date();
        console.log(fechaHora);
        $.ajax({
            url: 'proceso4.php?colr2='+colr2+'&fechaHora='+fechaHora+'&accion=1',
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                
                    document.getElementById("texto").innerText = ("¡Se agrego con éxito!");
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";    
                    $('#fe').html(v2);
                    document.getElementById("colr2").value = "";
                    /* if (document.getElementById("observacion").style.display == "none" ) {
                        window.location.reload();
                    }else{
                        
                    } */
                    
                }else{
                  
                    document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    
                }
            }
        });
    }
}
function agg_estado(est2){
    let valor0=0;
    if(document.getElementById("est2").value==""){
        document.getElementById("est2").style.borderColor="red";
        valor0++;
    }else{
        document.getElementById("est2").style.borderColor="";
    }
    if(valor0>0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
       /*  alert ('Todo mal'); */
        var fechaHora = new Date();
        console.log(fechaHora);
        $.ajax({
            url: 'proceso5.php?est2='+est2+'&fechaHora='+fechaHora+'&accion=1',
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                   
                    document.getElementById("texto").innerText = ("¡Se agrego con éxito!");
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";    
                    $('#fe').html(v2);
                    document.getElementById("est2").value = "";
                   
                }else{
                
                    document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    
                }
            }
        });
    }
}
function agg_condicionf(cf2){
    let valor0=0;
    if(document.getElementById("cf2").value==""){
        document.getElementById("cf2").style.borderColor="red";
        valor0++;
    }else{
        document.getElementById("cf2").style.borderColor="";
    }
    if(valor0>0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
       /*  alert ('Todo mal'); */
        var fechaHora = new Date();
        console.log(fechaHora);
        $.ajax({
            url: 'proceso6.php?cf2='+cf2+'&fechaHora='+fechaHora+'&accion=1',
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                  
                    document.getElementById("texto").innerText = ("¡Se agrego con éxito!");
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";    
                    $('#fe').html(v2);

                    document.getElementById("cf2").value = "";
                   
                }else{
                    
                    document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                   
                }
            }
        });
    }
}
function agg_cuentaC(cc2){
    let valor0=0;
    if(document.getElementById("cc2").value==""){
        document.getElementById("cc2").style.borderColor="red";
        valor0++;
    }else{
        document.getElementById("cc2").style.borderColor="";
    }
    if(valor0>0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
    }else{
       /*  alert ('Todo mal'); */
        var fechaHora = new Date();
        console.log(fechaHora);
        $.ajax({
            url: 'proceso7.php?cc2='+cc2+'&fechaHora='+fechaHora+'&accion=1',
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                   
                    document.getElementById("texto").innerText = ("¡Se agrego con éxito!");
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";    
                    $('#fe').html(v2);
                    document.getElementById("cc2").value = "";
                  
                }else{
                 
                    document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                  
                }
            }
        });
    }
}
function accion_eliminar(id){
    document.getElementById("observacion3").style.display = "none";

    /*  alert (id); */
     $.ajax({
         url: '/minpptrassi/mod_bienes_publicos/proceso1.php',
         type: 'POST',
         data: {
             id: id,
             accion: 2
         },
         success: function(resp) {
             let v0 =  resp.split(" / ")[0];
             let v1 =  resp.split(" / ")[1];
             let v2 =  resp.split(" / ")[2];
             if (v0 == '0'){
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
             }else{
                document.getElementById("texto").innerText = ("¡Se elimino exitosamente!");
                document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";  
                 $('#fe').html(v2);
                 
             }
         }
     })
 }
 function accion_eliminar1(id){
    document.getElementById("observacion3").style.display = "none";
    /*  alert (id); */
     $.ajax({
         url: '/minpptrassi/mod_bienes_publicos/proceso2.php',
         type: 'POST',
         data: {
             id: id,
             accion: 2
         },
         success: function(resp) {
             let v0 =  resp.split(" / ")[0];
             let v1 =  resp.split(" / ")[1];
             let v2 =  resp.split(" / ")[2];
             if (v0 == '0'){
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
             }else{
                
                document.getElementById("texto").innerText = ("¡Se elimino exitosamente!");
                document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";    
                 $('#fe').html(v2);
                
             }
         }
     })
 }
 function accion_eliminar2(id){
    document.getElementById("observacion3").style.display = "none";

    /*  alert (id); */
     $.ajax({
         url: '/minpptrassi/mod_bienes_publicos/proceso3.php',
         type: 'POST',
         data: {
             id: id,
             accion: 2
         },
         success: function(resp) {
             let v0 =  resp.split(" / ")[0];
             let v1 =  resp.split(" / ")[1];
             let v2 =  resp.split(" / ")[2];
             if (v0 == '0'){
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
             }else{
                document.getElementById("texto").innerText = ("¡Se elimino exitosamente!");
                document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";   
                 $('#fe').html(v2);
                
             }
         }
     })
 }
 function accion_eliminar3(id){
    document.getElementById("observacion3").style.display = "none";

    /*  alert (id); */
     $.ajax({
         url: '/minpptrassi/mod_bienes_publicos/proceso4.php',
         type: 'POST',
         data: {
             id: id,
             accion: 2
         },
         success: function(resp) {
             let v0 =  resp.split(" / ")[0];
             let v1 =  resp.split(" / ")[1];
             let v2 =  resp.split(" / ")[2];
             if (v0 == '0'){
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
             }else{
                document.getElementById("texto").innerText = ("¡Se elimino exitosamente!");
                document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";  
                 $('#fe').html(v2);
                
             }
         }
     })
 }
 function accion_eliminar4(id){
    document.getElementById("observacion3").style.display = "none";

    /*  alert (id); */
     $.ajax({
         url: '/minpptrassi/mod_bienes_publicos/proceso5.php',
         type: 'POST',
         data: {
             id: id,
             accion: 2
         },
         success: function(resp) {
             let v0 =  resp.split(" / ")[0];
             let v1 =  resp.split(" / ")[1];
             let v2 =  resp.split(" / ")[2];
             if (v0 == '0'){
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
             }else{
                document.getElementById("texto").innerText = ("¡Se elimino exitosamente!");
                document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";  
                 $('#fe').html(v2);
                 
             }
         }
     })
 }
function accion_eliminar5(id){
    document.getElementById("observacion3").style.display = "none";

   /*  alert (id); */
    $.ajax({
        url: '/minpptrassi/mod_bienes_publicos/proceso6.php',
        type: 'POST',
        data: {
            id: id,
            accion: 2
        },
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if (v0 == '0'){
                document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
            }else{
                document.getElementById("texto").innerText = ("¡Se elimino exitosamente!");
                document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";  
                $('#fe').html(v2);
                
            }
        }
    })
}

 function accion_modificar(id_mantenimiento1, sdescripcion) {

    /* alert(id); */

    $("#id_mantenimiento1").val(id_mantenimiento1);
    $("#or2").val(sdescripcion);
    $('#bt1').css('display','none');
    $('#bt2').css('display','block');
    document.getElementById("or2").style.borderColor="blue";
    
}
function accion_modificar1(id_mantenimiento2, sdescripcion) {

    /* alert(id); */

    $("#id_mantenimiento2").val(id_mantenimiento2);
    $("#bp2").val(sdescripcion);
    $('#bt1').css('display','none');
    $('#bt2').css('display','block');
    document.getElementById("bp2").style.borderColor="blue";
    
}
function accion_modificar2(id_mantenimiento3, sdescripcion) {

    /* alert(id); */

    $("#id_mantenimiento3").val(id_mantenimiento3);
    $("#marc2").val(sdescripcion);
    $('#bt1').css('display','none');
    $('#bt2').css('display','block');
    document.getElementById("marc2").style.borderColor="blue";
    
}
function accion_modificar3(id_mantenimiento4, sdescripcion) {

    /* alert(sdescripcion); */

    $("#id_mantenimiento4").val(id_mantenimiento4);
    $("#colr2").val(sdescripcion);
    $('#bt1').css('display','none');
    $('#bt2').css('display','block');
    document.getElementById("corl2").style.borderColor="blue";
    
}
function accion_modificar4(id_mantenimiento5, sdescripcion) {

    /* alert(id); */

    $("#id_mantenimiento5").val(id_mantenimiento5);
    $("#est2").val(sdescripcion);
    $('#bt1').css('display','none');
    $('#bt2').css('display','block');
    document.getElementById("est2").style.borderColor="blue";
    
}
function accion_modificar5(id_mantenimiento6, sdescripcion) {

    /* alert(id_mantenimiento6,sdescripcion); */

    $("#id_mantenimiento6").val(id_mantenimiento6); 
    $("#cf2").val(sdescripcion);
    $('#bt1').css('display','none');
    $('#bt2').css('display','block');
    document.getElementById("cf2").style.borderColor="blue";
    
}
function accion_modificar6(id_mantenimiento7, sdescripcion) {

    /* alert(id); */
    $("#id_mantenimiento7").val(id_mantenimiento7);
    $("#cc2").val(sdescripcion);
    $('#bt1').css('display','none');
    $('#bt2').css('display','block');
    document.getElementById("cc2").style.borderColor="blue";
    
}
function accion_modificar_mod1(id_mantenimiento1,or2){

   /*  alert(id_mantenimiento1 + " " + or2) */
    let valor = 0;
 

    if(document.getElementById("or2").value == ""){
        document.getElementById("or2").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("or2").style.borderColor = "#999999";
    }

    if(valor > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
    }else{
      /*   alert('Todo Relax'); */
        $.ajax({
            url: '/minpptrassi/mod_bienes_publicos/proceso1.php',
            type: 'POST',
            data: {
                id_mantenimiento1: id_mantenimiento1,
                or2: or2,
                accion: 3
            },
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if (v0 == '0'){
                    document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
                }else{
                  /*   alert(id_mantenimiento1,or2) */
                  document.getElementById("texto").innerText = ("¡Se ha modificado exitosamente!");
                  document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                  document.getElementById("titulo").style.color = "white";
                  document.getElementById("observacion").style.display = "block";  

                    $('#bt1').css('display','block');
                    $('#bt2').css('display','none');
                    document.getElementById("or2").value = "";
                    $('#fe').html(v2);
                    
                }
            }
        })
    }
}
function accion_modificar_mod2(id_mantenimiento2,bp2){

        /* alert(id_mantenimiento2 + " " + bp2) */
        let valor = 0;
        if(document.getElementById("bp2").value == ""){
            document.getElementById("bp2").style.borderColor = "Red";
            valor++;
        }else{
            document.getElementById("bp2").style.borderColor = "#999999";
        }
    
        if(valor > 0){
            document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
        }else{
          /*   alert('Todo Relax'); */
          $.ajax({
            url: '/minpptrassi/mod_bienes_publicos/proceso2.php',
            type: 'POST',
            data: {
                id_mantenimiento2: id_mantenimiento2,
                bp2: bp2,
                accion: 3
            },
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if (v0 == '0'){
                    document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }else{
                  /*   alert(id_mantenimiento1,or2) */
                 
                  document.getElementById("texto").innerText = ("¡Se ha modificado exitosamente!");
                  document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                  document.getElementById("titulo").style.color = "white";
                  document.getElementById("observacion").style.display = "block";

                    $('#bt1').css('display','block');
                    $('#bt2').css('display','none');
                    document.getElementById("bp2").value = "";
                    $('#fe').html(v2);
                }
            }
        })
        }
    }
    function accion_modificar_mod3(id_mantenimiento3,marc2){

        /* alert(id_mantenimiento2 + " " + bp2) */
        let valor = 0;
    
        if(document.getElementById("marc2").value == ""){
            document.getElementById("marc2").style.borderColor = "Red";
            valor++;
        }else{
            document.getElementById("marc2").style.borderColor = "#999999";
        }
    
        if(valor > 0){
            document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
            document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
            document.getElementById("titulo").style.color = "white";
            document.getElementById("observacion").style.display = "block";
        }else{
          /*   alert('Todo Relax'); */
          $.ajax({
            url: '/minpptrassi/mod_bienes_publicos/proceso3.php',
            type: 'POST',
            data: {
                id_mantenimiento3: id_mantenimiento3,
                marc2: marc2,
                accion: 3
            },
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if (v0 == '0'){
                    document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }else{
                  /*   alert(id_mantenimiento1,or2) */
                  document.getElementById("texto").innerText = ("¡Se ha modificado exitosamente!");
                  document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                  document.getElementById("titulo").style.color = "white";
                  document.getElementById("observacion").style.display = "block";

                    $('#bt1').css('display','block');
                    $('#bt2').css('display','none');
                    document.getElementById("marc2").value = "";
                    $('#fe').html(v2);
                     
                }
            }
        })
        }
    }

    function accion_modificar_mod4(id_mantenimiento4,colr2){

        /* alert(id_mantenimiento2 + " " + bp2) */
        let valor = 0;
    
        if(document.getElementById("colr2").value == ""){
            document.getElementById("colr2").style.borderColor = "Red";
            valor++;
        }else{
            document.getElementById("colr2").style.borderColor = "#999999";
        }
    
        if(valor > 0){
            document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
            document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
            document.getElementById("titulo").style.color = "white";
            document.getElementById("observacion").style.display = "block";
        }else{
          /*   alert('Todo Relax'); */
          $.ajax({
            url: '/minpptrassi/mod_bienes_publicos/proceso4.php',
            type: 'POST',
            data: {
                id_mantenimiento4: id_mantenimiento4,
                colr2: colr2,
                accion: 3
            },
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if (v0 == '0'){
                    document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }else{
                  /*   alert(id_mantenimiento1,or2) */
                  document.getElementById("texto").innerText = ("¡Se ha modificado exitosamente!");
                  document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                  document.getElementById("titulo").style.color = "white";
                  document.getElementById("observacion").style.display = "block";


                    $('#bt1').css('display','block');
                    $('#bt2').css('display','none');
                    document.getElementById("colr2").value = "";
                    $('#fe').html(v2);
                    
                }
            }
        })
        }
    }
    function accion_modificar_mod5(id_mantenimiento5,est2){

       /*  alert(id_mantenimiento5 + " " + est2) */
        let valor = 0;
    
        if(document.getElementById("est2").value == ""){
            document.getElementById("est2").style.borderColor = "Red";
            valor++;
        }else{
            document.getElementById("est2").style.borderColor = "#999999";
        }
    
        if(valor > 0){
            document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
            document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
            document.getElementById("titulo").style.color = "white";
            document.getElementById("observacion").style.display = "block";
        }else{
          /*   alert('Todo Relax'); */
          $.ajax({
            url: '/minpptrassi/mod_bienes_publicos/proceso5.php',
            type: 'POST',
            data: {
                id_mantenimiento5: id_mantenimiento5,
                est2: est2,
                accion: 3
            },
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if (v0 == '0'){
                    document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
                }else{
                  /*   alert(id_mantenimiento1,or2) */
                  document.getElementById("texto").innerText = ("¡Se ha modificado exitosamente!");
                  document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                  document.getElementById("titulo").style.color = "white";
                  document.getElementById("observacion").style.display = "block";

                    $('#bt1').css('display','block');
                    $('#bt2').css('display','none');
                    document.getElementById("est2").value = "";
                    $('#fe').html(v2);
                   
                }
            }
        })
        }
    }
    function accion_modificar_mod6(id_mantenimiento6,cf2){

       /*   alert(id_mantenimiento6 + " " + cf2) */
         let valor = 0;
     
         if(document.getElementById("cf2").value == ""){
             document.getElementById("cf2").style.borderColor = "Red";
             valor++;
         }else{
             document.getElementById("cf2").style.borderColor = "#999999";
         }
     
         if(valor > 0){
            document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
         }else{
           /*   alert('Todo Relax'); */
           $.ajax({
             url: '/minpptrassi/mod_bienes_publicos/proceso6.php',
             type: 'POST',
             data: {
                 id_mantenimiento6: id_mantenimiento6,
                 cf2: cf2,
                 accion: 3
             },
             success: function(resp) {
                 let v0 =  resp.split(" / ")[0];
                 let v1 =  resp.split(" / ")[1];
                 let v2 =  resp.split(" / ")[2];
                 if (v0 == '0'){
                    document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                 }else{
                   /*   alert(id_mantenimiento1,or2) */
                   document.getElementById("texto").innerText = ("¡Se ha modificado exitosamente!");
                   document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                   document.getElementById("titulo").style.color = "white";
                   document.getElementById("observacion").style.display = "block";
 
                     $('#bt1').css('display','block');
                     $('#bt2').css('display','none');
                    
                     $('#fe').html(v2); 
                     document.getElementById("cf2").value = "";
                 
                 }
             }
         })
         }
     }
     function accion_modificar_mod7(id_mantenimiento7,cc2){

        /*   alert(id_mantenimiento6 + " " + cf2) */
          let valor = 0;
      
          if(document.getElementById("cc2").value == ""){
              document.getElementById("cc2").style.borderColor = "Red";
              valor++;
          }else{
              document.getElementById("cc2").style.borderColor = "#999999";
          }
      
          if(valor > 0){
            document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
            document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
            document.getElementById("titulo").style.color = "white";
            document.getElementById("observacion").style.display = "block";
          }else{
            /*   alert('Todo Relax'); */
            $.ajax({
              url: '/minpptrassi/mod_bienes_publicos/proceso7.php',
              type: 'POST',
              data: {
                id_mantenimiento7: id_mantenimiento7,
                cc2: cc2,
                  accion: 3
              },
              success: function(resp) {
                  let v0 =  resp.split(" / ")[0];
                  let v1 =  resp.split(" / ")[1];
                  let v2 =  resp.split(" / ")[2];
                  if (v0 == '0'){
                    document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                  }else{
                    /*   alert(id_mantenimiento1,or2) */
                    document.getElementById("texto").innerText = ("¡Se ha modificado exitosamente!");
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
  
                      $('#bt1').css('display','block');
                      $('#bt2').css('display','none');
                     
                      $('#fe').html(v2); document.getElementById("cc2").value = "";
                      
                  }
              }
          })
          }
      }
 function accion_eliminar6(id){
    cerrar_alert3();
    /*  alert (id); */
     $.ajax({
         url: '/minpptrassi/mod_bienes_publicos/proceso7.php',
         type: 'POST',
         data: {
             id: id,
             accion: 2
         },
         success: function(resp) {
             let v0 =  resp.split(" / ")[0];
             let v1 =  resp.split(" / ")[1];
             let v2 =  resp.split(" / ")[2];
             if (v0 == '0'){
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
             }else{
                document.getElementById("texto").innerText = ("¡Se ha modificado exitosamente!");
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                 $('#fe').html(v2);
             }
         }
     })
 }



function accion_motivo(cbp,dbp,or,marc,model,serl,colr,cf,est,vbp,oc,foc,cc,obs){
    let valor=0;
/*     alert(cbp,dbp,or,marc,model,serl,colr,cf,est,vbp,oc,foc,cc,obs)
 */    /* 1 */
    if(document.getElementById("cbp").value<=0){
        document.getElementById("cbp").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("cbp").style.borderColor="";
    }
    if(document.getElementById("dbp").value==-1){
        document.getElementById("dbp").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("dbp").style.borderColor="";
    }
    if(document.getElementById("or").value==-1){
        document.getElementById("or").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("or").style.borderColor="";
    }
    if(document.getElementById("marc").value==-1){
        document.getElementById("marc").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("marc").style.borderColor="";
    }
    if(document.getElementById("model").value==""){
        document.getElementById("model").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("model").style.borderColor="";
    }
    if(document.getElementById("serl").value==""){
        document.getElementById("serl").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("serl").style.borderColor="";
    }
    if(document.getElementById("colr").value==-1){
        document.getElementById("colr").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("colr").style.borderColor="";
    }
    if(document.getElementById("cf").value==-1){
        document.getElementById("cf").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("cf").style.borderColor="";
    }
    if(document.getElementById("est").value==-1){
        document.getElementById("est").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("est").style.borderColor="";
    }
    if(document.getElementById("vbp").value<=0){
        document.getElementById("vbp").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("vbp").style.borderColor="";
    }
    if(document.getElementById("oc").value<=0){
        document.getElementById("oc").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("oc").style.borderColor="";
    }
    if(document.getElementById("foc").value==""){
        document.getElementById("foc").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("foc").style.borderColor="";
    }
    if(document.getElementById("cc").value==-1){
        document.getElementById("cc").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("cc").style.borderColor="";
    }
    
    
   


    if(valor>0){
        document.getElementById("texto2").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo2").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo2").style.color = "white";
                    document.getElementById("observacion2").style.display = "block";
                   
    }else{
       
        var myDate = document.getElementById("foc");
// Obtiene la fecha actual
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();

        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;

        today = yyyy + '-' + mm + '-' + dd;

        // Establece la fecha máxima permitida
        myDate.setAttribute("max", today);
    

        var date = myDate.value;
    if (Date.parse(date)) {
        if (date > today) {
            document.getElementById("texto2").innerText = ("La fecha no puede ser mayor a la actual");
                    document.getElementById("titulo2").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo2").style.color = "white";
                    document.getElementById("observacion2").style.display = "block";
                   
            myDate.value = "";
        }
        else{
            $.ajax({
                url: '/minpptrassi/mod_bienes_publicos/regis.php',
                type: 'POST',
                data: {
                    cbp:cbp,
                    dbp:dbp,
                    or:or,
                    marc:marc,
                    model:model,
                    serl:serl,
                    colr:colr,
                    cf:cf,
                    est:est,
                    vbp:vbp,
                    oc:oc,
                    foc:foc,
                    cc:cc,
                    obs:obs,
                      accion: 1
                  },
                success: function(resp) {
                    /* alert(resp); */
                    let v0 =  resp.split(" / ")[0];
                    let v1 =  resp.split(" / ")[1];
                    let v2 =  resp.split(" / ")[2];
                    if(v0 == 0){
                      /*   alert(v0); */
                        document.getElementById("texto2").innerText = ("El número del Bien Público ya está registrado");
                        document.getElementById("titulo2").style.backgroundColor = "#DC3831"; //Rojo
                        document.getElementById("titulo2").style.color = "white";
                        document.getElementById("observacion2").style.display = "block";
                        
                    }else{
                      
                 
                        document.getElementById("texto").innerText = ("¡Se ha registrado el B.P exitosamente!");
                        document.getElementById("a").innerText = ("¿Desea realizar la asignacion?");
                        document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                        document.getElementById("titulo").style.color = "white";
                        document.getElementById("observacion").style.display = "block";   
                        document.getElementById("asig1").style.display = "";
                        $('#fe').html(v1);
                        document.getElementById("cbp").value="";
                        document.getElementById("dbp").value=-1;
                        document.getElementById("or").value=-1;
                        document.getElementById("marc").value=-1;
                        document.getElementById("model").value="";
                        document.getElementById("serl").value="";
                        document.getElementById("colr").value=-1;
                        document.getElementById("cf").value=-1;
                        document.getElementById("est").value=-1;
                        document.getElementById("vbp").value="";
                        document.getElementById("oc").value="";
                        document.getElementById("foc").value="";
                        document.getElementById("cc").value=-1;
                        document.getElementById("obs").value=="";
                      
                        
                    }
                }
            });
        }

        }
    } 
}

function accion_eliminar_regis(id){
    document.getElementById("observacion3").style.display = "none";
    /*  alert (id); */
     $.ajax({
         url: '/minpptrassi/mod_bienes_publicos/regis.php',
         type: 'POST',
         data: {
             id: id,
             accion: 2
         },
         success: function(resp) {
             let v0 =  resp.split(" / ")[0];
             let v1 =  resp.split(" / ")[1];
             let v2 =  resp.split(" / ")[2];
             if (v0 == '0'){
                
                document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
             }else{
                document.getElementById("texto").innerText = ("¡Se ha eliminado exitosamente!");
                document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";  
                 $('#fe').html(v2);
             }
         }
     })
 }
 function accion(id){
    alert(id);

 }

 function accion_modificarregis(id_regis,cbp,dbp,or,marc,model,serl,colr,cf,est,vbp,oc,foc,cc,obs) {

    /* alert(id); */
    $("#id_regis").val(id_regis);
    $("#cbp").val(cbp);
    $("#dbp").val(dbp);
    $("#or").val(or);
    $("#marc").val(marc);
    $("#model").val(model);
    $("#serl").val(serl);
    $("#colr").val(colr);
    $("#cf").val(cf);
    $("#est").val(est);
    $("#vbp").val(vbp);
    $("#oc").val(oc);
    $("#foc").val(foc);
    $("#cc").val(cc);
    $("#obs").val(obs);

    $('#motivo_agr').css('display','none');
    $('#motivo_agr2').css('display','block');
    $('#regre').css('display','block');
 /*    document.getElementById("cc2").style.borderColor="blue"; */

    /* $('#cbp').css('display','none');
    $('#id_regis').css('display','block'); */
    
}
function accion_modificar_regis(id_regis,cbp,dbp,or,marc,model,serl,colr,cf,est,vbp,oc,foc,cc,obs){

   /*  alert(id_mantenimiento1 + " " + or2) */
    let valor = 0;
 

    if(document.getElementById("cbp").value<=0){
        document.getElementById("cbp").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("cbp").style.borderColor="";
    }
    if(document.getElementById("dbp").value==-1){
        document.getElementById("dbp").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("dbp").style.borderColor="";
    }
    if(document.getElementById("or").value==-1){
        document.getElementById("or").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("or").style.borderColor="";
    }
    if(document.getElementById("marc").value==-1){
        document.getElementById("marc").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("marc").style.borderColor="";
    }
    if(document.getElementById("model").value==""){
        document.getElementById("model").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("model").style.borderColor="";
    }
    if(document.getElementById("serl").value==""){
        document.getElementById("serl").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("serl").style.borderColor="";
    }
    if(document.getElementById("colr").value==-1){
        document.getElementById("colr").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("colr").style.borderColor="";
    }
    if(document.getElementById("cf").value==-1){
        document.getElementById("cf").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("cf").style.borderColor="";
    }
    if(document.getElementById("est").value==-1){
        document.getElementById("est").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("est").style.borderColor="";
    }
    if(document.getElementById("vbp").value<=0){
        document.getElementById("vbp").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("vbp").style.borderColor="";
    }
    if(document.getElementById("oc").value<=0){
        document.getElementById("oc").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("oc").style.borderColor="";
    }
    if(document.getElementById("foc").value==""){
        document.getElementById("foc").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("foc").style.borderColor="";
    }
    if(document.getElementById("cc").value==-1){
        document.getElementById("cc").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("cc").style.borderColor="";
    }
   
 /*  alert(id_regis);
alert (cbp + ' ' + dbp+ ' ' + or + ' ' + marc+ ' ' + model+ ' ' + serl+ ' ' + colr+ ' ' + cf+ ' ' + est+ ' ' + vbp+ ' ' + oc+ ' ' + foc+ ' ' + cc+ ' ' + obs);
    */
    if(valor > 0){
        document.getElementById("texto2").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo2").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo2").style.color = "white";
                    document.getElementById("observacion2").style.display = "block";
                   
    }else{
      /*   alert('Todo Relax'); */

      var myDate = document.getElementById("foc");

        // Obtiene la fecha actual
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
            
        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;
            
        today = yyyy + '-' + mm + '-' + dd;
            
        // Establece la fecha máxima permitida
        myDate.setAttribute("max", today);

        var date = myDate.value;
    if (Date.parse(date)) {
        if (date > today) {
            document.getElementById("texto2").innerText = ("La fecha no puede ser mayor a la actual");
            document.getElementById("titulo2").style.backgroundColor = "#DC3831"; //Rojo
            document.getElementById("titulo2").style.color = "white";
            document.getElementById("observacion2").style.display = "block";
            myDate.value = "";
        }else{
            $.ajax({
                url: '/minpptrassi/mod_bienes_publicos/regis.php',
                type: 'POST',
                data: {
                    id_regis:id_regis,
                    cbp:cbp,
                    dbp:dbp,
                    or:or,
                    marc:marc,
                    model:model,
                    serl:serl,
                    colr:colr,
                    cf:cf,
                    est:est,
                    vbp:vbp,
                    oc:oc,
                    foc:foc,
                    cc:cc,
                    obs:obs,
                    
                    accion: 3
                },
                success: function(resp) {
                    let v0 =  resp.split(" / ")[0];
                    let v1 =  resp.split(" / ")[1];
                    let v2 =  resp.split(" / ")[2];
                    if (v0 == '0'){
                        document.getElementById("texto2").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                        document.getElementById("titulo2").style.backgroundColor = "#DC3831"; //Rojo
                        document.getElementById("titulo2").style.color = "white";
                        document.getElementById("observacion2").style.display = "block";
                    }else{
                      /*   alert(id_mantenimiento1,or2) */
                      document.getElementById("texto2").innerText = ("¡Se ha modificado el B.P exitosamente!");
                      document.getElementById("titulo2").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                      document.getElementById("titulo2").style.color = "white";
                      document.getElementById("observacion2").style.display = "block"; 
    
                        $('#motivo_agr').css('display','block');
                        $('#motivo_agr2').css('display','none');
                        document.getElementById("cbp").value = "";
                        document.getElementById("dbp").value = "";
                        document.getElementById("or").value = "";
                        document.getElementById("marc").value = "";
                        document.getElementById("model").value = "";
                        document.getElementById("serl").value = "";
                        document.getElementById("colr").value = "";
                        document.getElementById("cf").value = "";
                        document.getElementById("est").value = "";
                        document.getElementById("vbp").value = "";
                        document.getElementById("oc").value = "";
                        document.getElementById("foc").value = "";
                        document.getElementById("cc").value = "";
                        document.getElementById("obs").value = "";
                        $('#fe').html(v2);
                        // Recarga la página actual
                         
    
                    }
                }
            })
        }
        }
    }
        
}
function busq_cedula1(nacionalidad,ci1){

    let valor=0;

    if(document.getElementById("nacionalidad").value == -1){
        document.getElementById("nacionalidad").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("nacionalidad").style.borderColor = '';
    }
    if(document.getElementById("ci1").value == ''){
        document.getElementById("ci1").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("ci1").style.borderColor = '';
    }if(valor > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
    }else{
      
        $.ajax({
            url: '/minpptrassi/mod_bienes_publicos/buscador.php',
            type: 'POST',
            data: {
                nacionalidad: nacionalidad,
                ci1: ci1
            },
            success: function(resp) {
                /* var resultado = JSON.parse(resp); */
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                let v3 =  resp.split(" / ")[3];
                let v4 =  resp.split(" / ")[4];
                let v5 =  resp.split(" / ")[5];
                let v6 =  resp.split(" / ")[6];
                let v7 =  resp.split(" / ")[7];
                let v8 =  resp.split(" / ")[8];
              
                /* } */
                if (v0 == '0'){
                    document.getElementById("texto").innerText = ("Asegúrese de especificar la Nacionalidad y la Cédula de Identidad");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }else{
                    $( "#bci1" ).val(v1.toUpperCase());
                    $( "#bn1" ).val(v2.toUpperCase());
                    $("#ba1").val(v3.toUpperCase());
                    $("#bce1").val(v4.toUpperCase());
                    $("#buf1").val(v5.toUpperCase());
                    $("#bct1").val(v6.toUpperCase());
                    $("#bua1").val(v7.toUpperCase());
                    $("#id_c1").val(v8.toUpperCase());

                    /* ('#s_apellido').val(v4.toUpperCase()); */
                    
                  /*   document.getElementById("bci1").style.borderColor = '';
                    document.getElementById("bn1").style.borderColor = '';
                    document.getElementById("ba1").style.borderColor = '';
                    document.getElementById("s_apellido").style.borderColor = '';
                    document.getElementById("sexo").style.borderColor = '';
                    document.getElementById("todo").style.display='block';
                    document.getElementById("todo2").style.display='none';
                    document.getElementById("btn_regre").style.display='none';

                    document.querySelector("select[id='sexo']").value = v5; */
                    
               
                }
            }
        });
    }


}
function busq_cedula2(nacionalidad2,ci2){

    let valor=0;

    if(document.getElementById("nacionalidad2").value == -1){
        document.getElementById("nacionalidad2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("nacionalidad2").style.borderColor = '';
    }
    if(document.getElementById("ci2").value == ''){
        document.getElementById("ci2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("ci2").style.borderColor = '';
    }if(valor > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
    }else{
/*        alert(nacionalidad2+""+ci2); */
        $.ajax({
            url: '/minpptrassi/mod_bienes_publicos/buscador2.php',
            type: 'POST',
            data: {
                nacionalidad2: nacionalidad2,
                ci2: ci2
            },
            success: function(resp) {
                /* var resultado = JSON.parse(resp); */
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                let v3 =  resp.split(" / ")[3];
                let v4 =  resp.split(" / ")[4];
                let v5 =  resp.split(" / ")[5];
                let v6 =  resp.split(" / ")[6];
                let v7 =  resp.split(" / ")[7];
                let v8 =  resp.split(" / ")[8];
              
                /* } */
                if (v0 == '0'){
                    document.getElementById("texto").innerText = ("Asegúrese de especificar la Nacionalidad y la Cédula de Identidad");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }else{
                    $( "#bci2" ).val(v1.toUpperCase());
                    $( "#bn2" ).val(v2.toUpperCase());
                    $("#ba2 ").val(v3.toUpperCase());
                    $("#bce2").val(v4.toUpperCase());
                    $("#buf2").val(v5.toUpperCase());
                    $("#bct2").val(v6.toUpperCase());
                    $("#bua2").val(v7.toUpperCase());
                    $("#id_c2").val(v8.toUpperCase());
                   

                    /* ('#s_apellido').val(v4.toUpperCase()); */
                    
                   /*  document.getElementById("bci1").style.borderColor = '';
                    document.getElementById("bn1").style.borderColor = '';
                    document.getElementById("ba1").style.borderColor = '';
                    document.getElementById("s_apellido").style.borderColor = '';
                    document.getElementById("sexo").style.borderColor = '';
                    document.getElementById("todo").style.display='block';
                    document.getElementById("todo2").style.display='none';
                    document.getElementById("btn_regre").style.display='none';

                    document.querySelector("select[id='sexo']").value = v5; */
                    
               
                }
            }
        });
    }


}
function busq_cedula3(nacionalidad3,ci3){

    let valor=0;

    if(document.getElementById("nacionalidad3").value == -1){
        document.getElementById("nacionalidad3").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("nacionalidad3").style.borderColor = '';
    }
    if(document.getElementById("ci3").value == ''){
        document.getElementById("ci3").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("ci3").style.borderColor = '';
    }if(valor > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
    }else{
        
        $.ajax({
            url: '/minpptrassi/mod_bienes_publicos/buscador3.php',
            type: 'POST',
            data: {
                nacionalidad3: nacionalidad3,
                ci3: ci3
            },
            success: function(resp) {
                /* var resultado = JSON.parse(resp); */
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                let v3 =  resp.split(" / ")[3];
                let v4 =  resp.split(" / ")[4];
                let v5 =  resp.split(" / ")[5];
                let v6 =  resp.split(" / ")[6];
                let v7 =  resp.split(" / ")[7];
                let v8 =  resp.split(" / ")[8];

              
                /* } */
                if (v0 == '0'){
                    document.getElementById("texto").innerText = ("Asegurece de especificar la Nacionalidad y la Cédula de Identidad");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }else{
                    $( "#bci3" ).val(v1.toUpperCase());
                    $( "#bn3" ).val(v2.toUpperCase());
                    $("#ba3 ").val(v3.toUpperCase());
                    $("#bce3").val(v4.toUpperCase());
                    $("#buf3").val(v5.toUpperCase());
                    $("#bct3").val(v6.toUpperCase());
                    $("#bua3").val(v7.toUpperCase());
                   
                    $("#id_c3").val(v8.toUpperCase());

                }
            }
        });
    }


}
function accion_buscar_bp(cbp2){

    let valor=0;

    if(document.getElementById("cbp2").value == ''){
        document.getElementById("cbp2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("cbp2").style.borderColor = '';
    }if(valor > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
    }else{
       
        $.ajax({
            url: '/minpptrassi/mod_bienes_publicos/buscador4.php',
            type: 'POST',
            data: {
                cbp2: cbp2,
            },
            success: function(resp) {
                /* var resultado = JSON.parse(resp); */
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                let v3 =  resp.split(" / ")[3];
                let v4 =  resp.split(" / ")[4];
                let v5 =  resp.split(" / ")[5];
                let v6 =  resp.split(" / ")[6];
                let v7 =  resp.split(" / ")[7];
                let v8 =  resp.split(" / ")[8];
                let v9 =  resp.split(" / ")[9];
                let v10 =  resp.split(" / ")[10];
                let v11 =  resp.split(" / ")[11];
                let v12 =  resp.split(" / ")[12];
                let v13 =  resp.split(" / ")[13];
                let v14 =  resp.split(" / ")[14];
                let v15 =  resp.split(" / ")[15];
              
                /* } */
                if (v0 == '0'){
                    document.getElementById("texto").innerText = ("Hubo un error, verifique si el B.P que busca existe");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                   
                }else{
                    $( "#cbp2" ).val(v1.toUpperCase());
                    $( "#dbp2" ).val(v2.toUpperCase());
                    $("#or2 ").val(v3.toUpperCase());
                    $("#marc2").val(v4.toUpperCase());
                    $("#model2").val(v5.toUpperCase());
                    $("#serl2").val(v6.toUpperCase());
                    $("#colr2").val(v7.toUpperCase());
                    $("#cf2").val(v8.toUpperCase());
                    $("#est2").val(v9.toUpperCase());
                    $("#vbp2").val(v10.toUpperCase());
                    $("#oc2").val(v11.toUpperCase());
                    $("#foc2").val(v12.toUpperCase());
                    $("#cc2").val(v13.toUpperCase());
                    $("#obs2").val(v14.toUpperCase());
                    $("#id_cbp2").val(v15.toUpperCase());

                    /* ('#s_apellido').val(v4.toUpperCase()); */
                    
                   /*  document.getElementById("bci1").style.borderColor = '';
                    document.getElementById("bn1").style.borderColor = '';
                    document.getElementById("ba1").style.borderColor = '';
                    document.getElementById("s_apellido").style.borderColor = '';
                    document.getElementById("sexo").style.borderColor = '';
                    document.getElementById("todo").style.display='block';
                    document.getElementById("todo2").style.display='none';
                    document.getElementById("btn_regre").style.display='none';

                    document.querySelector("select[id='sexo']").value = v5; */
                    
               
                }
            }
        });
    }


}
function asignar_bp(id_c1,id_c2,id_c3,cbp2,id_cbp2,fa){
    let valor=0;
    /* alert(id_c1+"/"+id_c2+"/"+id_c3+"/"+id_cbp2); */
    if(document.getElementById("cbp2").value<=0){
        document.getElementById("cbp2").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("cbp2").style.borderColor="";
    }
    if(document.getElementById("fa").value==""){
        document.getElementById("fa").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("fa").style.borderColor="";
    }
    if(valor>0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
    }else{
       /*  let dbp2 = document.getElementById("dbp").value; */
       
   /*   alert(id_c1+" / "+id_c2+" / "+id_c3+" / "+cbp2+" / "+id_cbp2+" / "+fa) */

   var myDate = document.getElementById("fa");

   // Obtiene la fecha actual
   var today = new Date();
   var dd = today.getDate();
   var mm = today.getMonth() + 1;
   var yyyy = today.getFullYear();
       
   if (dd < 10) dd = '0' + dd;
   if (mm < 10) mm = '0' + mm;
       
   today = yyyy + '-' + mm + '-' + dd;
       
   // Establece la fecha máxima permitida
   myDate.setAttribute("max", today);

   var date = myDate.value;
if (Date.parse(date)) {
   if (date > today) {
    document.getElementById("texto").innerText = ("La fecha no puede ser mayor a la actual");
    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
    document.getElementById("titulo").style.color = "white";
    document.getElementById("observacion").style.display = "block";
       myDate.value = "";
   }else{

    $.ajax({
        url: '/minpptrassi/mod_bienes_publicos/asignar_bp2.php',
        type: 'POST',
        data: {
            id_c1:id_c1,
            id_c2:id_c2,
            id_c3:id_c3,
            cbp2:cbp2,
            id_cbp2:id_cbp2,
            fa:fa,
            accion: 1
            
              
          },
         
        success: function(resp) {
            /* alert(resp); */
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if(v0 == 0){
                document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo");
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
                
            }else{
               
                document.getElementById("texto").innerText = ("¡Se ha asignado exitosamente!");
                document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block"; 

                $('#fe').html(v2); 
                document.getElementById("fa").value="";
               /*  window.location.reload(); */
                
            }
        }
    });
}

   }
}
    
}
function accion_eliminar_asig(id,ci,ci3) {
    document.getElementById("observacion3").style.display = "none"; 

    /* alert(id+" "+ci3+" "+ci); */

    $.ajax({
        url: '/minpptrassi/mod_bienes_publicos/asignar_bp2.php',
        type: 'POST',
        data: {
            id: id,
            ci:ci,
            ci3:ci3,
            accion: 2
        },
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if (v0 == '0'){
                alert(v0);
                document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo");
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
                
            }else{
                document.getElementById("texto").innerText = ("¡Se ha eliminado exitosamente!");
                document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block"; 

                $('#fe').html(v2);
               

            }
        }
    })
    }

function cerrar_alert(){
    document.getElementById("observacion").style.display = "none";
    
    
}function cerrar_alert2(){
    document.getElementById("observacion2").style.display = "none";
    
    
}
function cerrar_alert3(){
    document.getElementById("observacion3").style.display = "none";
    
    
}
function busqueda_act(nacionalidad3, ci3) {
    let valor=0;
    /* alert(nacionalidad3+" "+ci3); */
    if(document.getElementById("nacionalidad3").value == -1){
        document.getElementById("nacionalidad3").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("nacionalidad3").style.borderColor = '';
    }
    if(document.getElementById("ci3").value == ''){
        document.getElementById("ci3").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("ci3").style.borderColor = '';
    }if(valor > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
    }else{
        
        $.ajax({
            url: '/minpptrassi/mod_bienes_publicos/busqueda_act.php',
            type: 'POST',
            data: {
                nacionalidad3: nacionalidad3,
                ci3: ci3
            },
            success: function(resp) {
                /* var resultado = JSON.parse(resp); */
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                let v3 =  resp.split(" / ")[3];
                let v4 =  resp.split(" / ")[4];
                let v5 =  resp.split(" / ")[5];
                let v6 =  resp.split(" / ")[6];
                let v7 =  resp.split(" / ")[7];
                let v8 =  resp.split(" / ")[8];
                let v9 =  resp.split(" / ")[9];
                if (v0 == '0'){
                    
                    document.getElementById("texto").innerText = resp;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }else{
                    
                    $("#bci3").val(v1.toUpperCase());
                    $("#bn3").val(v2.toUpperCase());
                    $("#ba3 ").val(v3.toUpperCase());
                    $("#bce3").val(v4.toUpperCase());
                    $("#buf3").val(v5.toUpperCase());
                    $("#bct3").val(v6.toUpperCase());
                    $("#bua3").val(v7.toUpperCase());
                    $("#id_c3").val(v8.toUpperCase());
                    $('#fe').html(v9);
                }
            }
        });
    }
}
function accion_eliminar_(id,ci,usu) {
    document.getElementById("observacion3").style.display = "none"; 

    /* alert(id+" "+ci3+" "+ci); */

    $.ajax({
        url: '/minpptrassi/mod_bienes_publicos/busqueda_act3.php',
        type: 'POST',
        data: {
            id: id,
            ci:ci,
            usu:usu,
            
        },
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if (v0 == '0'){
                
                document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo");
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
                
            }else{
                document.getElementById("texto").innerText = ("¡Se ha eliminado exitosamente!");
                document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block"; 

                $('#fe').html(v2);
               

            }
        }
    })
    }
function modificar_asig(id_cbp2,cbp,dbp,or,marc,model,serl,colr,cf,est,vbp,oc,foc,cc,obs ) {
   /*  alert("id_cbp2: "+id_cbp2+" cbp: "+cbp+" dbp: "+dbp+" or: "+or+" marc: "+marc+" model: "+model+" serl: "+serl+" colr: "+colr+" cf "+cf+" est "+est+" vbp "+vbp+" oc "+oc+" foc "+foc+" cc "+cc+" obs "+obs) */
    $("#id_cbp2").val(id_cbp2);
    $("#cbp2").val(cbp);
    $("#dbp2").val(dbp);
    $("#or2").val(or);
    $("#marc2").val(marc);
    $("#model2").val(model);
    $("#serl2").val(serl);
    $("#colr2").val(colr);
    $("#cf2").val(cf);
    $("#est2").val(est);
    $("#vbp2").val(vbp);
    $("#oc2").val(oc);
    $("#foc2").val(foc);
    $("#cc2").val(cc);
    $("#obs2").val(obs);
   
}

function actualiza_asig(id_c3,id_cbp2,cbp2,dbp2,or2,marc2,model2,serl2,colr2,cf2,est2,vbp2,oc2,foc2,cc2,obs2 ) {
   /*  alert("id_c3: "+id_c3+"id_cbp2: "+id_cbp2+" cbp: "+cbp+" dbp: "+dbp+" or: "+or+" marc: "+marc+" model: "+model+" serl: "+serl+" colr: "+colr+" cf "+cf+" est "+est+" vbp "+vbp+" oc "+oc+" foc "+foc+" cc "+cc+" obs "+obs)
 */   
    valor=0;

    if(document.getElementById("cbp2").value<=0){
        document.getElementById("cbp2").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("cbp2").style.borderColor="";
    }
    if(document.getElementById("dbp2").value==-1){
        document.getElementById("dbp2").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("dbp2").style.borderColor="";
    }
    if(document.getElementById("or2").value==-1){
        document.getElementById("or2").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("or2").style.borderColor="";
    }
    if(document.getElementById("marc2").value==-1){
        document.getElementById("marc2").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("marc2").style.borderColor="";
    }
    if(document.getElementById("model2").value==""){
        document.getElementById("model2").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("model2").style.borderColor="";
    }
    if(document.getElementById("serl2").value==""){
        document.getElementById("serl2").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("serl2").style.borderColor="";
    }
    if(document.getElementById("colr2").value==-1){
        document.getElementById("colr2").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("colr2").style.borderColor="";
    }
    if(document.getElementById("cf2").value==-1){
        document.getElementById("cf2").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("cf2").style.borderColor="";
    }
    if(document.getElementById("est2").value==-1){
        document.getElementById("est2").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("est2").style.borderColor="";
    }
    if(document.getElementById("vbp2").value<=0){
        document.getElementById("vbp2").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("vbp2").style.borderColor="";
    }
    if(document.getElementById("oc2").value<=0){
        document.getElementById("oc2").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("oc2").style.borderColor="";
    }
    if(document.getElementById("foc2").value==""){
        document.getElementById("foc2").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("foc2").style.borderColor="";
    }
    if(document.getElementById("cc2").value==-1){
        document.getElementById("cc2").style.borderColor="red";
        valor++;
    }else{
        document.getElementById("cc2").style.borderColor="";
    } 
    if(valor > 0){
      /*   alert("FALTA CAMPOS POR RELLENAR") */
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
    }else{
      /*   alert('Todo Relax'); */ 
        $.ajax({
            url: '/minpptrassi/mod_bienes_publicos/busqueda_act2.php',
            type: 'POST',
            data: {
                id_c3:id_c3,
                id_cbp2:id_cbp2,
                cbp2:cbp2,
                dbp2:dbp2,
                or2:or2,
                marc2:marc2,
                model2:model2,
                serl2:serl2,
                colr2:colr2,
                cf2:cf2,
                est2:est2,
                vbp2:vbp2,
                oc2:oc2,
                foc2:foc2,
                cc2:cc2,
                obs2:obs2
                
              
            },
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                
                let v1 =  resp.split(" / ")[1];
                if (v0 == '0'){
                   document.getElementById("texto").innerText = ("Hubo un error, Intente de nuevo, verifique si todo está correcto");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block"; 
                }else{
       
                   document.getElementById("texto").innerText = ("¡Se ha modificado exitosamente!");
                  document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                  document.getElementById("titulo").style.color = "white";
                  document.getElementById("observacion").style.display = "block";  

                    
                    document.getElementById("cbp2").value = "";
                    document.getElementById("dbp2").value = "";
                    document.getElementById("or2").value = "";
                    document.getElementById("marc2").value = "";
                    document.getElementById("model2").value = "";
                    document.getElementById("serl2").value = "";
                    document.getElementById("colr2").value = "";
                    document.getElementById("cf2").value = "";
                    document.getElementById("est2").value = "";
                    document.getElementById("vbp2").value = "";
                    document.getElementById("oc2").value = "";
                    document.getElementById("foc2").value = "";
                    document.getElementById("cc2").value = "";
                    document.getElementById("obs2").value = "";
                    $('#fe').html(v1);
                    // Recarga la página actual
                     

                }
            }
        })
    }
}
function consulta_1(nacionalidad3,ci3) {

    let valor=0;

   /*  alert(nacionalidad3+" "+ci3); */

    if(document.getElementById("nacionalidad3").value == -1){
        document.getElementById("nacionalidad3").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("nacionalidad3").style.borderColor = '';
    }
    if(document.getElementById("ci3").value == ''){
        document.getElementById("ci3").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("ci3").style.borderColor = '';
    }if(valor > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
    }else{
        
        $.ajax({
            url: '/minpptrassi/mod_bienes_publicos/consulta_1.php',
            type: 'POST',
            data: {
                nacionalidad3: nacionalidad3,
                ci3: ci3
            },
            success: function(resp) {
                /* var resultado = JSON.parse(resp); */
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                let v3 =  resp.split(" / ")[3];
                let v4 =  resp.split(" / ")[4];
                let v5 =  resp.split(" / ")[5];
                let v6 =  resp.split(" / ")[6];
                let v7 =  resp.split(" / ")[7];
                let v8 =  resp.split(" / ")[8];
                let v9 =  resp.split(" / ")[9];
                let v10 =  resp.split(" / ")[10];

              
                /* } */
                if (v0 == '0'){
                    document.getElementById("texto").innerText = ("Asegúrese de especificar la Nacionalidad y la Cédula de Identidad");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }else{
                    
                    $("#bci3").val(v1.toUpperCase());
                    $("#bn3").val(v2.toUpperCase());
                    $("#ba3 ").val(v3.toUpperCase());
                    $("#bce3").val(v4.toUpperCase());
                    $("#buf3").val(v5.toUpperCase());
                    $("#bct3").val(v6.toUpperCase());
                    $("#bua3").val(v7.toUpperCase());
                   
                    $("#id_c3").val(v8.toUpperCase());
                    
                   $('#fe').html(v9);
                  

                }
            }
        });
    
}
}
function asegurar(id) {



    document.getElementById("texto3").innerText = ("¿Seguro que deseas eliminar?");
    document.getElementById("titulo3").style.backgroundColor = "#DC3831"; //Rojo
    document.getElementById("titulo3").style.color = "white";
    document.getElementById("vv").innerText = ("Verifique que no este relacionado con algún B.P Registrado");

    document.getElementById("observacion3").style.display = "block";
    document.getElementById("eli").style.display = "";
    document.getElementById("pass").value=id;

}
function asegurar2(bienes_publicos_id,id_usuario,ci3) {



    document.getElementById("texto3").innerText = ("¿Seguro que deseas eliminar?");
    document.getElementById("titulo3").style.backgroundColor = "#DC3831"; //Rojo
    document.getElementById("titulo3").style.color = "white";
    document.getElementById("observacion3").style.display = "block";
    document.getElementById("eli").style.display = "";
    document.getElementById("bienes_publicos_id").value=bienes_publicos_id;
    document.getElementById("id_usuario").value=id_usuario;
    document.getElementById("ci5").value=ci3;

}
function imprimir(id_c3) {   
    window.location.replace('pdf/pdf1.php?id_c3='+id_c3);
}

function buscar(){
    let contador = 0;
    let nacionalidad = document.getElementById("nacionalidad");
    let cedula = document.getElementById("cedula");

    if(nacionalidad.value == "-1"){
        nacionalidad.style.border = "1px solid red";
        contador++;
    }else{
        nacionalidad.style.border = "";
    }

    if(cedula.value == ""){
        cedula.style.border = "1px solid red";
        contador++;
    } else {
        cedula.style.border = "";
    }

    if(contador > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        $.ajax({
            url: 'validar_usuario.php',
            type: 'GET',
            data: {
                accion: 1,
                cedula: cedula.value,
                nacionalidad: nacionalidad.value
            },
            success: function(resp){
                //alert(resp);
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                let v2 = resp.split(" / ")[2];
                if(v0 == '1')
                {
                    document.getElementById("nombres").value = v1;
                    document.getElementById("rol").value = v2;
                }else{
                    document.getElementById("texto").innerText = ("Usuario no registrado en SIGLA");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    document.getElementById("nombres").value = "";
                    document.getElementById("rol").value = "-1";
                    
                }
            }
        });
    } 
}

function asignar(){
    let contador = 0;
    let nacionalidad = document.getElementById("nacionalidad");
    let cedula = document.getElementById("cedula");
    let nombres = document.getElementById("nombres");
    let rol = document.getElementById("rol");

    if(nacionalidad.value == "-1"){
        nacionalidad.style.border = "1px solid red";
        contador++;
    }else{
        nacionalidad.style.border = "";
    }

    if(cedula.value == ""){
        cedula.style.border = "1px solid red";
        contador++;
    } else {
        cedula.style.border = "";
    }

    if(rol.value == "-1"){
        rol.style.border = "1px solid red";
        contador++;
    }else{
        rol.style.border = "";
    }

    if(nombres.value == ""){
        nombres.style.border = "1px solid red";
        contador++;
    } else {
        nombres.style.border = "";
    }

    if(contador > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        $.ajax({
            url: 'validar_usuario.php',
            type: 'GET',
            data: {
                accion: 2,
                cedula: cedula.value,
                rol: rol.value
            },
            success: function(resp){
                /* alert(resp); */
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                if(v0 == '1')
                {
                    document.getElementById("texto").innerText = ("¡Se asigno con éxito el rol al usuario!");
                  document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                  document.getElementById("titulo").style.color = "white";
                  document.getElementById("observacion").style.display = "block";  
                    nacionalidad.value = "-1";
                    cedula.value = "";
                    nombres.value = "";
                    rol.value = "-1";
                }else{
              /*       alert('mal') */
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }
            }
        });
    } 

}

function inhabilitar(){
    let contador = 0;
    let nacionalidad = document.getElementById("nacionalidad");
    let cedula = document.getElementById("cedula");
    let nombres = document.getElementById("nombres");
    let rol = document.getElementById("rol");

    if(nacionalidad.value == "-1"){
        nacionalidad.style.border = "1px solid red";
        contador++;
    }else{
        nacionalidad.style.border = "";
    }

    if(cedula.value == ""){
        cedula.style.border = "1px solid red";
        contador++;
    } else {
        cedula.style.border = "";
    }

    if(rol.value == "-1"){
        rol.style.border = "1px solid red";
        contador++;
    }else{
        rol.style.border = "";
    }

    if(nombres.value == ""){
        nombres.style.border = "1px solid red";
        contador++;
    } else {
        nombres.style.border = "";
    }

    if(contador > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        $.ajax({
            url: 'validar_usuario.php',
            type: 'GET',
            data: {
                accion: 3,
                cedula: cedula.value
            },
            success: function(resp){
                //alert(resp);
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                if(v0 == '1')
                {
                    document.getElementById("texto").innerText = ("¡Se inhabilito con éxito el rol al usuario!");
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block"; 
                    nacionalidad.value = "-1";
                    cedula.value = "";
                    nombres.value = "";
                    rol.value = "-1";
                }else{
                    document.getElementById("texto").innerText = (" No se pudo inhabilitar el rol al usuario favor intentar más tarde");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }
            }
        });
    } 

}
/* function barra_a(barra) {
    valor=0;
    
    if(document.getElementById("barra").value == ""){
        document.getElementById("barra").style.borderColor = 'Red';
        valor++;
   
    } else {
        document.getElementById("barra").style.borderColor = '';
      
    }

    if(valor > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        $.ajax({
            url: 'barra_busqueda.php',
            type: 'POST',
            data: {
              
                barra:barra
            },
            success: function(resp){
                //alert(resp);
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                if(v0 == '0')
                {
                    document.getElementById("texto").innerText = (" Lastimosamente no se puedo encontrar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }else{
                    
                    $('#fe').html(v1);
                }
            }
        });
    } 
    
} */
/* function barra_a(barra) {
    valor=0;
    
    if(document.getElementById("barra").value == ""){
        document.getElementById("barra").style.borderColor = 'Red';
        valor++;
   
    } else {
        document.getElementById("barra").style.borderColor = '';
      
    }

    if(valor > 0){
        document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        $.ajax({
            url: 'barra_busqueda.php',
            type: 'POST',
            data: {
              
                barra:barra
            },
            success: function(resp){
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                if(v0 == '0')
                {
                    document.getElementById("texto").innerText = (" Lastimosamente no se puedo encontrar");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }else{
                    
                    $('#fe').html(v1);
                }
            }
        });
    } 
    
} */
/* function barra_b(barra,id_c3) {
        valor=0;
        valor2=0;
        if(document.getElementById("ci3").value == ""){
            document.getElementById("ci3").style.borderColor = 'Red';
            valor2++;
       
        }else {
            document.getElementById("ci3").style.borderColor = '';
          
        }
        if (valor2
            >0) {
            document.getElementById("texto").innerText = ("Aun no puedes hacer la busqueda");
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
        } else {
            if(document.getElementById("barra").value == ""){
                document.getElementById("barra").style.borderColor = 'Red';
                valor++;
           
            } else {
                document.getElementById("barra").style.borderColor = '';
              
            }
        
            if(valor > 0){
                document.getElementById("texto").innerText = ("Debe llenar los Datos obligatorios (*) para continuar");
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("observacion").style.display = "block";
            }else{
                $.ajax({
                    url: 'barra_busquedab.php',
                    type: 'POST',
                    data: {
                        id_c3:id_c3,
                        barra:barra
                    },
                    success: function(resp){
                        let v0 = resp.split(" / ")[0];
                        let v1 = resp.split(" / ")[1];
                        if(v0 == '0')
                        {
                            document.getElementById("texto").innerText = (" Lastimosamente no se puedo encontrar");
                            document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                            document.getElementById("titulo").style.color = "white";
                            document.getElementById("observacion").style.display = "block";
                        }else{
                            
                            $('#fe').html(v1);
                        }
                    }
                });
            } 
        }
        
        
    } */
