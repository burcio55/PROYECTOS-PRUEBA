function soloNumeros(e) {
  // Permitir solo teclas numéricas, retroceso y tabulación
  const permitidos = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 8, 9, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
  if (!permitidos.includes(e.keyCode)) {
    e.preventDefault();
  }
}

document.getElementById("personales_cedula").addEventListener("keydown", soloNumeros);
document.getElementById("stelefono_personal").addEventListener("keydown", soloNumeros);
document.getElementById("telf").addEventListener("keydown", soloNumeros);
document.getElementById("telf2").addEventListener("keydown", soloNumeros);

/* function convertirAMayusculas() {

  var actividad_economica = document.getElementById("actividad_economica").value;
  document.getElementById("actividad_economica").value = actividad_economica.toUpperCase();

  var nombres = document.getElementById("nombres").value;
  document.getElementById("nombres").value = nombres.toUpperCase();

  var apellidos = document.getElementById("apellidos").value;
  document.getElementById("apellidos").value = apellidos.toUpperCase();
} */

function convertirAMayusculas() {
  var actividad_economica = document.getElementById("actividad_economica").value;
  actividad_economica = actividad_economica.toUpperCase();
  actividad_economica = actividad_economica.replace(/[0-9]/g, "");
  document.getElementById("actividad_economica").value = actividad_economica;
  
  var nombres = document.getElementById("nombres").value;
  nombres = nombres.toUpperCase();
  nombres = nombres.replace(/[0-9]/g, "");
  document.getElementById("nombres").value = nombres;

  var nombres2 = document.getElementById("nombres2").value;
  nombres2 = nombres2.toUpperCase();
  nombres2 = nombres2.replace(/[0-9]/g, "");
  document.getElementById("nombres2").value = nombres2;
  
  var apellidos = document.getElementById("apellidos").value;
  apellidos = apellidos.toUpperCase();
  apellidos = apellidos.replace(/[0-9]/g, "");
  document.getElementById("apellidos").value = apellidos; 
  
  var apellidos2 = document.getElementById("apellidos2").value;
  apellidos2 = apellidos2.toUpperCase();
  apellidos2 = apellidos2.replace(/[0-9]/g, "");
  document.getElementById("apellidos2").value = apellidos2; 
}