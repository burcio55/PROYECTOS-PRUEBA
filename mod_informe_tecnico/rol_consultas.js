function cerrar(){
    document.getElementById("observacion").style.display = "none";  
}
function cerrar2(){
    document.getElementById("observacion2").style.display = "none";
}


document.getElementById('buscar').addEventListener('click', function() {
    var rol = document.getElementById('rol').value;

    if (rol == -1) {
      /*   alert("Por favor, seleccione un rol."); */
        document.getElementById("texto").innerText = "Por favor, seleccione un rol.";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
     
    }

    if (rol == 78) {
      /*   alert("Listado de Tecnicos."); */
        document.getElementById("texto2").innerText = "Cargando Listado de Técnicos.";
        document.getElementById("titulo2").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
        document.getElementById("titulo2").style.color = "white";
        document.getElementById("observacion2").style.display = "block";
     
    }

    if (rol == 79) {
/*         alert("Listado de Consultores."); */
        document.getElementById("texto2").innerText = "Cargando Listado de Consultores.";
        document.getElementById("titulo2").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
        document.getElementById("titulo2").style.color = "white";
        document.getElementById("observacion2").style.display = "block";
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'roles_consultar.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('mostrar_roles').innerHTML = xhr.responseText;
        }
    };
    xhr.send('rol=' + rol);
});


