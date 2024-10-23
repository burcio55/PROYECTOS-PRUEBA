function cerrar(){
    document.getElementById("observacion").style.display = "none";  
}
function cerrar2(){
    document.getElementById("observacion2").style.display = "none";
   /*  $(location).attr("href","actualizar.php"); */
}

function buscar() {
    var nacionalidad = document.getElementById('nacionalidad').value;
    var cedula = document.getElementById('cedula').value;

    // Validar que ambos campos no estén vacíos
    if (nacionalidad.trim() === "" || cedula.trim() === "") {
       /*  document.getElementById('mostrar').innerHTML = "<tr><td colspan='4'>Por favor, ingrese tanto la nacionalidad como la cédula.</td></tr>"; */
        document.getElementById("texto").innerText = 'Por favor, ingrese tanto la nacionalidad como la cédula';
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
        
        return; // No continuar si los campos están vacíos
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'registros_tecnicos.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('mostrar').innerHTML = xhr.responseText;
        }
    };
    xhr.send('nacionalidad=' + encodeURIComponent(nacionalidad) + '&cedula=' + encodeURIComponent(cedula));
}
