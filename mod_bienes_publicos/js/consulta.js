

function cerrar(){
    document.getElementById("observacion").style.display = "none";  
}
function cerrar2(){
    document.getElementById("observacion2").style.display = "none";
}

function consulta_rol(rol) {
    
    let valor=0;

    

    if (rol == -1) {
      /*   alert("Por favor, seleccione un rol."); */
      document.getElementById("rol").style.borderColor = 'Red';

      valor=1;
     
    }else{
        document.getElementById("rol").style.borderColor = '';  
    }

    if (rol == 80) {
      /*   alert("Listado de Tecnicos."); */
        document.getElementById("texto").innerText = "Cargando Listado de Administrador.";
        document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
     
    }

    if (rol == 81) {
/*         alert("Listado de Consultores."); */
        document.getElementById("texto").innerText = "Cargando Listado de Registradores.";
        document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }

    if(valor > 0){
        document.getElementById("texto").innerText = "Por favor, seleccione un rol.";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        $.ajax({
            url: '/minpptrassi/mod_bienes_publicos/roles_consultar.php',
            type: 'POST',
            data: {
                rol: rol
            },
            success: function(resp) {
                /* var resultado = JSON.parse(resp); */
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];

                if (v0 == '0'){
                    document.getElementById("texto").innerText = ("error");
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                }else{
                    
                
                   $('#fe').html(v1);
                  

                }
            }
        });
   
}}