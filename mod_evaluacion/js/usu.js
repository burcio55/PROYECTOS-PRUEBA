function cerrar_alert() {
  document.getElementById("observacion").style.display = "none";
}
function buscar() {
  let contador = 0;
  let nacionalidad = document.getElementById("nacionalidad");
  let cedula = document.getElementById("cedula");

  if (nacionalidad.value == "-1") {
    nacionalidad.style.border = "1px solid red";
    contador++;
  } else {
    nacionalidad.style.border = "";
  }

  if (cedula.value == "") {
    cedula.style.border = "1px solid red";
    contador++;
  } else {
    cedula.style.border = "";
  }

  if (contador > 0) {
    document.getElementById("texto").innerText =
      "Debe llenar los Datos obligatorios (*) para continuar";
    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
    document.getElementById("titulo").style.color = "white";
    document.getElementById("observacion").style.display = "block";
  } else {
    $.ajax({
      url: "validar_usuario.php",
      type: "GET",
      data: {
        accion: 1,
        cedula: cedula.value,
        nacionalidad: nacionalidad.value,
      },
      success: function (resp) {
        //alert(resp);
        let v0 = resp.split(" / ")[0];
        let v1 = resp.split(" / ")[1];
        let v2 = resp.split(" / ")[2];
        if (v0 == "1") {
          document.getElementById("nombres").value = v1;
          document.getElementById("rol").value = v2;
        } else {
          document.getElementById("texto").innerText =
            "Usuario no registrado en SIGLA";
          document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
          document.getElementById("titulo").style.color = "white";
          document.getElementById("observacion").style.display = "block";
          document.getElementById("nombres").value = "";
          document.getElementById("rol").value = "-1";
        }
      },
    });
  }
}

function asignar() {
  let contador = 0;
  let nacionalidad = document.getElementById("nacionalidad");
  let cedula = document.getElementById("cedula");
  let nombres = document.getElementById("nombres");
  let rol = document.getElementById("rol");

  if (nacionalidad.value == "-1") {
    nacionalidad.style.border = "1px solid red";
    contador++;
  } else {
    nacionalidad.style.border = "";
  }

  if (cedula.value == "") {
    cedula.style.border = "1px solid red";
    contador++;
  } else {
    cedula.style.border = "";
  }

  if (rol.value == "-1") {
    rol.style.border = "1px solid red";
    contador++;
  } else {
    rol.style.border = "";
  }

  if (nombres.value == "") {
    nombres.style.border = "1px solid red";
    contador++;
  } else {
    nombres.style.border = "";
  }

  if (contador > 0) {
    document.getElementById("texto").innerText =
      "Debe llenar los Datos obligatorios (*) para continuar";
    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
    document.getElementById("titulo").style.color = "white";
    document.getElementById("observacion").style.display = "block";
  } else {
    $.ajax({
      url: "validar_usuario.php",
      type: "GET",
      data: {
        accion: 2,
        cedula: cedula.value,
        rol: rol.value,
      },
      success: function (resp) {
        /* alert(resp); */
        let v0 = resp.split(" / ")[0];
        let v1 = resp.split(" / ")[1];
        if (v0 == "1") {
          document.getElementById("texto").innerText =
            "¡Se asigno con éxito el rol al usuario!";
          document.getElementById("titulo").style.backgroundColor =
            "rgb(8, 150, 197)"; //Azul
          document.getElementById("titulo").style.color = "white";
          document.getElementById("observacion").style.display = "block";
          nacionalidad.value = "-1";
          cedula.value = "";
          nombres.value = "";
          rol.value = "-1";
        } else {
          /*       alert('mal') */
          document.getElementById("texto").innerText = v1;
          document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
          document.getElementById("titulo").style.color = "white";
          document.getElementById("observacion").style.display = "block";
        }
      },
    });
  }
}

function inhabilitar() {
  let contador = 0;
  let nacionalidad = document.getElementById("nacionalidad");
  let cedula = document.getElementById("cedula");
  let nombres = document.getElementById("nombres");
  let rol = document.getElementById("rol");

  if (nacionalidad.value == "-1") {
    nacionalidad.style.border = "1px solid red";
    contador++;
  } else {
    nacionalidad.style.border = "";
  }

  if (cedula.value == "") {
    cedula.style.border = "1px solid red";
    contador++;
  } else {
    cedula.style.border = "";
  }

  if (rol.value == "-1") {
    rol.style.border = "1px solid red";
    contador++;
  } else {
    rol.style.border = "";
  }

  if (nombres.value == "") {
    nombres.style.border = "1px solid red";
    contador++;
  } else {
    nombres.style.border = "";
  }

  if (contador > 0) {
    document.getElementById("texto").innerText =
      "Debe llenar los Datos obligatorios (*) para continuar";
    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
    document.getElementById("titulo").style.color = "white";
    document.getElementById("observacion").style.display = "block";
  } else {
    $.ajax({
      url: "validar_usuario.php",
      type: "GET",
      data: {
        accion: 3,
        cedula: cedula.value,
      },
      success: function (resp) {
        //alert(resp);
        let v0 = resp.split(" / ")[0];
        let v1 = resp.split(" / ")[1];
        if (v0 == "1") {
          document.getElementById("texto").innerText =
            "¡Se inhabilito con éxito el rol al usuario!";
          document.getElementById("titulo").style.backgroundColor =
            "rgb(8, 150, 197)"; //Azul
          document.getElementById("titulo").style.color = "white";
          document.getElementById("observacion").style.display = "block";
          nacionalidad.value = "-1";
          cedula.value = "";
          nombres.value = "";
          rol.value = "-1";
        } else {
          document.getElementById("texto").innerText =
            " No se pudo inhabilitar el rol al usuario favor intentar más tarde";
          document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
          document.getElementById("titulo").style.color = "white";
          document.getElementById("observacion").style.display = "block";
        }
      },
    });
  }
}
