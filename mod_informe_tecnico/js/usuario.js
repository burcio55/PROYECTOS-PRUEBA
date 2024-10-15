function finalizar(){
    location.href = "admin.php";
}
function soloNumeros(e) {
    // Permitir solo teclas numéricas, retroceso y tabulación
    const permitidos = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 8, 9, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
    if (!permitidos.includes(e.keyCode)) {
    e.preventDefault();
    }
}
document.getElementById("cedula").addEventListener("keydown", soloNumeros);
function mayusculas(e) {
    let aux = e.value = e.value.toUpperCase();
    aux.preventDefault();
}
function observacion(){
    document.getElementById("observacion").style.display = "";
}