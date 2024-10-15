function cerrar(){
    document.getElementById("observacion").style.display = "none";  
}



function buscar(){
    let contador = 0;

    if(document.getElementById("num_informe").value == ""){
        contador++;
    }else{
        document.getElementById("num_informe").style.border = "";
    }

    if(document.getElementById("num_bpublico").value == ""){
        contador++;
    }else{
        document.getElementById("num_bpublico").style.border = "";
    }

    if(contador > 1){
        document.getElementById("num_informe").style.border = "1px solid red";
        document.getElementById("num_bpublico").style.border = "1px solid red";

        document.getElementById("cedula").value = '';
        document.getElementById("nombres").value = '';
        document.getElementById("apellidos").value = '';
        document.getElementById("reporte").value = '';
        document.getElementById("ubicacion_adm").value = '';

        document.getElementById("texto").innerText = "Debe llenar los datos obligatorios";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        /* alert ("Todo bien"); */
        document.getElementById("num_bpublico").style.border = "";
        document.getElementById("num_informe").style.border = "";

        let num_informe = document.getElementById("num_informe").value;
        let num_bpublico = document.getElementById("num_bpublico").value;

        $.ajax({
            url: '/minpptrassi/mod_informe_tecnico/accion_buscar.php',
            type: 'GET',
            data: {
                num_informe: num_informe,
                num_bpublico: num_bpublico,
            },
            success:function(resp){
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                let v2 = resp.split(" / ")[2];
                let v3 = resp.split(" / ")[3];
                let v4 = resp.split(" / ")[4];
                let v5 = resp.split(" / ")[5];
                let v6 = resp.split(" / ")[6];
                /* let v7 = resp.split(" / ")[7]; */
                if(v0 == '0'){
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    
                    document.getElementById("cedula").value = '';
                    document.getElementById("nombres").value = '';
                    document.getElementById("apellidos").value = '';
                    document.getElementById("reporte").value = '';
                    document.getElementById("ubicacion_adm").value = '';
                }else{
                    document.getElementById("texto").innerText = "Se extrajeron correctamente los datos";
                    document.getElementById("titulo").style.backgroundColor = "rgb(8, 150, 197)"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("observacion").style.display = "block";
                    
                    document.getElementById("cedula").value = v1;
                    document.getElementById("nombres").value = v2;
                    document.getElementById("apellidos").value = v3 ;
                    document.getElementById("reporte").value = v4;
                    document.getElementById("ubicacion_adm").value = v5;
                   /*  document.getElementById("dispositivos_id").value = v6; */
                }

            },
            error: function(jqXHR, textStatus, errorThrawn){
                console.error("Error: ", textStatus, errorThrawn)
            }
        })
    }
}

function imprimir(){
    let contador = 0;

    if(document.getElementById("cedula").value == ""){
        contador++;
    }else{
        document.getElementById("cedula").style.border = "";
    }
    if(document.getElementById("nombres").value == ""){
        contador++;
    }else{
        document.getElementById("nombres").style.border = "";
    }
    if(document.getElementById("apellidos").value == ""){
        contador++;
    }else{
        document.getElementById("apellidos").style.border = "";
    }

    if(contador > 0){
        document.getElementById("texto").innerText = "Para imprimir un dispositivo primero deberá buscar el informe asociado";
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("observacion").style.display = "block";
    }else{
        window.open("imprimir_consulta.php", "_blank");
    }
}

function soloNumeros(e) {
    const permitidos = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 8, 9, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
    if (!permitidos.includes(e.keyCode)) {
    e.preventDefault();
    }
}
document.getElementById("num_bpublico").addEventListener("keydown", soloNumeros);
const input = document.getElementById('num_bpublico');
const maxLength = 8; 
input.addEventListener('input', function() {
    const currentValue = input.value;
    input.value = currentValue.slice(0, maxLength);
});