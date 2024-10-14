$(document).ready(function() {
    let id = document.getElementById("usuario2").value;

    $.ajax({
        url: "/minpptrassi/mod_evaluacion/corregir.php",
        type: "POST",
        data: {
            id: id,
            accion: 1
        },
        success: function (resp) {
            /* datos del segundo usuario */
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            let v2 = resp.split(" / ")[2];
            let v3 = resp.split(" / ")[3];
            let v4 = resp.split(" / ")[4];
            let v5 = resp.split(" / ")[5];
            let v6 = resp.split(" / ")[6];
            let v7 = resp.split(" / ")[7];
            let v8 = resp.split(" / ")[8];
            let v9 = resp.split(" / ")[9];
            let v10 = resp.split(" / ")[10];
            let v11 = resp.split(" / ")[11];
            let v12 = resp.split(" / ")[12];
            let v13 = resp.split(" / ")[13];
            let v14 = resp.split(" / ")[14];
            let v15 = resp.split(" / ")[15];
            /* modulo I */
            let v32 = resp.split(" / ")[32];
            let v33 = resp.split(" / ")[33];
            let v34 = resp.split(" / ")[34];
            let v35 = resp.split(" / ")[35];
            let v36 = resp.split(" / ")[36];
            let v37 = resp.split(" / ")[37];
            let v38 = resp.split(" / ")[38];
            let v39 = resp.split(" / ")[39];
            let v40 = resp.split(" / ")[40];
            let v41 = resp.split(" / ")[41];
            let v42 = resp.split(" / ")[42];
            let v43 = resp.split(" / ")[43];
            let v44 = resp.split(" / ")[44];
            let v45 = resp.split(" / ")[45];
            let v46 = resp.split(" / ")[46];
            let v47 = resp.split(" / ")[47];
            let v48 = resp.split(" / ")[48];
            let v49 = resp.split(" / ")[49];
            if (v0 == "0") {
                /* document.getElementById("mensaje").style.textAlign = "center";
                document.getElementById("mensaje").textContent =
                "Está Cédula de Identidad no se encuentra en el Sistema";
                document.getElementById("alerta").style.display = "block"; */

                /* Está Cédula de Identidad no se encuentra en el Sistema */
            } else {
                $("#nombre_apellido2").val(v1.toUpperCase());
                $("#codigo2").val(v2.toUpperCase());
                $("#cargo2").val(v3.toUpperCase());
                $("#ubicacion_adm2").val(v4.toUpperCase());
                $("#ubicacion_act2").val(v5.toUpperCase());
                $("#cargo_ejerce2").val(v6.toUpperCase());

                $("#persona_id2").val(v7.toUpperCase());
                $("#rol_evaluacion2").val(v8.toUpperCase());
                $("#periodo_evaluacion2").val(v9.toUpperCase());
                $("#nanno_evalu2").val(v10.toUpperCase());
                $("#cargo_id2").val(v11.toUpperCase());
                $("#ubicacion_scodigo2").val(v12.toUpperCase());
                $("#codigo_tipos_trabajadores2").val(v13.toUpperCase());
                $("#tipo_trabajador2").val(v14.toUpperCase());
                $("#cedula2").val(v15.toUpperCase());

                document.getElementById("nombre_apellido2").style.borderColor = "";
                document.getElementById("cargo2").style.borderColor = "";
                document.getElementById("ubicacion_adm2").style.borderColor = "";
                document.getElementById("ubicacion_act2").style.borderColor = "";
                document.getElementById("cargo_ejerce2").style.borderColor = "";
                document.getElementById("codigo2").style.borderColor = "";
                document.getElementById("tipo_trabajador2").style.borderColor = "";

                $("#rango1").val(v32);
                $("#rango2").val(v33);
                $("#rango3").val(v34);
                $("#descripcion1").val(v35.toUpperCase());
                $("#peso4").val(v36);
                $("#rango4").val(v37);
                $("#descripcion2").val(v38.toUpperCase());
                $("#peso5").val(v39);
                $("#rango5").val(v40);
                $("#descripcion3").val(v41.toUpperCase());
                $("#peso6").val(v42);
                $("#rango6").val(v43);
                $("#descripcion4").val(v44.toUpperCase());
                $("#peso7").val(v45);
                $("#rango7").val(v46);
                $("#descripcion5").val(v47.toUpperCase());
                $("#peso8").val(v48);
                $("#rango8").val(v49);

                multiplicar(1);
                multiplicar(2);
                multiplicar(3);
                multiplicar(4);
                multiplicar(5);
                multiplicar(6);
                multiplicar(7);
                multiplicar(8);
                suma_modulo1();
            }
        },
    });
});

/* mostrar alert con mensaje */

function descripcion(e) {
    if (e == 1) {
        mensaje =
            "1.- Mide  la  motivación  del servidor público para el mejoramiento continuo a través de estudios, cursos, lectura y cualquier otra actividad individual u organizacional que asegure su evolución personal y profesional además de cumplir con la aprobación en el trimestre de dos (2) cursos avalado por el Ministerio con competencias en planificación.";
    } else if (e == 2) {
        mensaje =
            "2.- Mide el grado en que los procesos de trabajo y las relaciones con el colectivo del servidor público  reflejan el interés por satisfacer los requerimientos de los usuarios externos e internos ofreciéndoles un servicio eficiente.";
    } else if (e == 3) {
        mensaje =
            "3.- Es la capacidad para ofrecer creatividad y originalidad. Un estilo innovador permite pensar de qué manera se puede mejorar en el futuro.";
    } else if (e == 4) {
        mensaje =
            "4.- Mide la habilidad del  servidor público  para interactuar en forma cordial, amable y proactiva, tanto individual como colectivamente.";
    } else if (e == 5) {
        mensaje =
            "5.- Identificación con las políticas, reglamentos y códigos de conducta que regulan todos los aspectos de las responsabilidades   inherente al desempeño del cargo y conducta apropiada en la organización.";
    } else if (e == 6) {
        mensaje =
            "6.- Habilidad del servidor público de infundir al colectivo organizacional la aplicación de acciones acertadas en situaciones determinadas.";
    } else if (e == 7) {
        mensaje =
            "7.- Cumplimiento de las normas y procedimientos establecidos por la organización para proteger la integridad física y mental del servidor público.";
    } else if (e == 8) {
        mensaje =
            "8.- Mide el grado de responsabilidad del servidor publico por la conservación, uso y mantenimiento de los bienes materiales, herramientas y equipos asignados a su área y en otras de la organización, con la finalidad de optimizar su utilidad y beneficio tanto individualmente como colectivamente.";
    } else if (e == 9) {
        mensaje =
            "9.- Mide el grado de  capacidad del servidor público por gestionar en forma consistente, rápida y directa  los requerimientos individuales y colectivos de los usuarios internos y externos.";
    } else if (e == 10) {
        mensaje =
            "10.- Mide la habilidad del servidor público  para recibir, comprender y transmitir en forma oral y escrita ideas e información de manera que facilite la rápida comprensión, logrando una actitud positiva en cualquier situación de trabajo.";
    } else if (e == 11) {
        mensaje =
            "11.- Capacidad  del servidor público para  cooperar  y prestar ayuda o asistencia para el logro de los fines organizacionales.";
    }
    document.getElementById("mensaje").textContent = mensaje;
    document.getElementById("alerta").style.display = "block";
}

function cerrar() {
    document.getElementById("alerta").style.display = "none";
}
function cerrar2() {
    document.getElementById("alerta").style.display = "none";
    $(location).attr("href", "files.php");
}

function peso_rango1(e) {
    let pr1 = document.getElementById("peso_rango1").value;
    let pr2 = document.getElementById("peso_rango2").value;
    let pr3 = document.getElementById("peso_rango3").value;
    let pr4 = document.getElementById("peso_rango4").value;
    let pr5 = document.getElementById("peso_rango5").value;
    let pr6 = document.getElementById("peso_rango6").value;
    let pr7 = document.getElementById("peso_rango7").value;
    let pr8 = document.getElementById("peso_rango8").value;
    let modulo =
      Number(pr1) +
      Number(pr2) +
      Number(pr3) +
      Number(pr4) +
      Number(pr5) +
      Number(pr6) +
      Number(pr7) +
      Number(pr8);
    document.getElementById("peso_rango_total_m1").value = modulo;
    document.getElementById("total_modulo1").value = modulo;
  }

function peso_rango2(e) {
    let pr9 = document.getElementById("peso_rango9").value;
    let pr10 = document.getElementById("peso_rango10").value;
    let pr11 = document.getElementById("peso_rango11").value;
    let pr12 = document.getElementById("peso_rango12").value;
    let pr13 = document.getElementById("peso_rango13").value;
    let pr14 = document.getElementById("peso_rango14").value;
    let pr15 = document.getElementById("peso_rango15").value;
    let pr16 = document.getElementById("peso_rango16").value;
    let pr17 = document.getElementById("peso_rango17").value;
    let pr18 = document.getElementById("peso_rango18").value;
    let pr19 = document.getElementById("peso_rango19").value;
    let modulo =
      Number(pr9) +
      Number(pr10) +
      Number(pr11) +
      Number(pr12) +
      Number(pr13) +
      Number(pr14) +
      Number(pr15) +
      Number(pr16) +
      Number(pr17) +
      Number(pr18) +
      Number(pr19);
    document.getElementById("peso_rango_total_m2").value = modulo;
    document.getElementById("total_modulo2").value = modulo;
  }

/* multiplicar peso x rango */

function multiplicar(e) {
    if (e == 1) {
        let peso = document.getElementById("peso1");
        let rango = document.getElementById("rango1");
        if (peso.value == "" || peso.value != 5) {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango1").value = peso_rango;
            peso_rango1();
            }
        }
    } else if (e == 2) {
        let peso = document.getElementById("peso2");
        let rango = document.getElementById("rango2");
        if (peso.value == "" || peso.value != 5) {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango2").value = peso_rango;
            peso_rango1();
            }
        }
    } else if (e == 3) {
        let peso = document.getElementById("peso3");
        let rango = document.getElementById("rango3");
        if (peso.value == "" || peso.value != 6) {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango3").value = peso_rango;
            peso_rango1();
            }
        }
    } else if (e == 4) {
        let peso = document.getElementById("peso4");
        let rango = document.getElementById("rango4");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango4").value = peso_rango;
            peso_rango1();
            }
        }
    } else if (e == 5) {
        let peso = document.getElementById("peso5");
        let rango = document.getElementById("rango5");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango5").value = peso_rango;
            peso_rango1();
            }
        }
    } else if (e == 6) {
        let peso = document.getElementById("peso6");
        let rango = document.getElementById("rango6");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango6").value = peso_rango;
            peso_rango1();
            }
        }
    } else if (e == 7) {
        let peso = document.getElementById("peso7");
        let rango = document.getElementById("rango7");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango7").value = peso_rango;
            peso_rango1();
            }
        }
    } else if (e == 8) {
        let peso = document.getElementById("peso8");
        let rango = document.getElementById("rango8");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango8").value = peso_rango;
            peso_rango1();
            }
        }
    } else if (e == 9) {
        let peso = document.getElementById("peso9");
        let rango = document.getElementById("rango9");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango9").value = peso_rango;
            peso_rango2();
            }
        }
    } else if (e == 10) {
        let peso = document.getElementById("peso10");
        let rango = document.getElementById("rango10");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango10").value = peso_rango;
            peso_rango2();
            }
        }
    } else if (e == 11) {
        let peso = document.getElementById("peso11");
        let rango = document.getElementById("rango11");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango11").value = peso_rango;
            peso_rango2();
            }
        }
    } else if (e == 12) {
        let peso = document.getElementById("peso12");
        let rango = document.getElementById("rango12");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango12").value = peso_rango;
            peso_rango2();
            }
        }
    } else if (e == 13) {
        let peso = document.getElementById("peso13");
        let rango = document.getElementById("rango13");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango13").value = peso_rango;
            peso_rango2();
            }
        }
    } else if (e == 14) {
        let peso = document.getElementById("peso14");
        let rango = document.getElementById("rango14");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango14").value = peso_rango;
            peso_rango2();
            }
        }
    } else if (e == 15) {
        let peso = document.getElementById("peso15");
        let rango = document.getElementById("rango15");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango15").value = peso_rango;
            peso_rango2();
            }
        }
    } else if (e == 16) {
        let peso = document.getElementById("peso16");
        let rango = document.getElementById("rango16");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango16").value = peso_rango;
            peso_rango2();
            }
        }
    } else if (e == 17) {
        let peso = document.getElementById("peso17");
        let rango = document.getElementById("rango17");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango17").value = peso_rango;
            peso_rango2();
            }
        }
    } else if (e == 18) {
        let peso = document.getElementById("peso18");
        let rango = document.getElementById("rango18");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango18").value = peso_rango;
            peso_rango2();
            }
        }
    } else if (e == 19) {
        let peso = document.getElementById("peso19");
        let rango = document.getElementById("rango19");
        if (peso.value == "") {
            peso.style.borderColor = "Red";
        } else {
            peso.style.borderColor = "#999999";
            if (rango.value == "") {
            rango.style.borderColor = "Red";
            } else {
            rango.style.borderColor = "#999999";
            let peso_rango = peso.value * rango.value;
            document.getElementById("peso_rango19").value = peso_rango;
            peso_rango2(1);
            }
        }
    }
}
function suma_modulo1(e) {
    if (e == 4) {
        multiplicar(4);
    } else if (e == 5) {
        multiplicar(5);
    } else if (e == 6) {
        multiplicar(6);
    } else if (e == 7) {
        multiplicar(7);
    } else if (e == 8) {
        multiplicar(8);
    }
    let contador = 0;
    let p1 = document.getElementById("peso1").value;
    let p2 = document.getElementById("peso2").value;
    let p3 = document.getElementById("peso3").value;
    let p4 = document.getElementById("peso4").value;
    let p5 = document.getElementById("peso5").value;
    let p6 = document.getElementById("peso6").value;
    let p7 = document.getElementById("peso7").value;
    let p8 = document.getElementById("peso8").value;
    contador =
        Number(p1) +
        Number(p2) +
        Number(p3) +
        Number(p4) +
        Number(p5) +
        Number(p6) +
        Number(p7) +
        Number(p8);
    document.getElementById("peso_total_m1").value = contador;
    if (contador > 50) {
        mensaje_p =
            'La suma de todos los "PESOS" del "Módulo I" deben ser iguales a 50, siendo su valor: ' +
            contador;
        document.getElementById("mensaje").textContent = mensaje_p;
        document.getElementById("alerta").style.display = "block";
        document.getElementById("peso_total_m1").style.borderColor = "Red";
    } else {
        document.getElementById("peso_total_m1").style.borderColor = "#999999";
    }
}

function suma_modulo2(e) {
    if (e == 9) {
        multiplicar(9);
    } else if (e == 10) {
        multiplicar(10);
    } else if (e == 11) {
        multiplicar(11);
    } else if (e == 12) {
        multiplicar(12);
    } else if (e == 13) {
        multiplicar(13);
    } else if (e == 14) {
        multiplicar(14);
    }
    if (e == 15) {
        multiplicar(15);
    } else if (e == 16) {
        multiplicar(16);
    } else if (e == 17) {
        multiplicar(17);
    } else if (e == 18) {
        multiplicar(18);
    } else if (e == 19) {
        multiplicar(19);
    }
    let contador = 0;
    let p9 = document.getElementById("peso9").value;
    let p10 = document.getElementById("peso10").value;
    let p11 = document.getElementById("peso11").value;
    let p12 = document.getElementById("peso12").value;
    let p13 = document.getElementById("peso13").value;
    let p14 = document.getElementById("peso14").value;
    let p15 = document.getElementById("peso15").value;
    let p16 = document.getElementById("peso16").value;
    let p17 = document.getElementById("peso17").value;
    let p18 = document.getElementById("peso18").value;
    let p19 = document.getElementById("peso19").value;
    contador =
        Number(p9) +
        Number(p10) +
        Number(p11) +
        Number(p12) +
        Number(p13) +
        Number(p14) +
        Number(p15) +
        Number(p16) +
        Number(p17) +
        Number(p18) +
        Number(p19);
    document.getElementById("peso_total_m2").value = contador;
    if (contador > 50) {
        mensaje_p =
            'La suma de todos los "PESOS" del "Módulo I" deben ser iguales a 50, siendo su valor: ' +
            contador;
        document.getElementById("mensaje").textContent = mensaje_p;
        document.getElementById("alerta").style.display = "block";
        document.getElementById("peso_total_m2").style.borderColor = "Red";
    } else {
        document.getElementById("peso_total_m2").style.borderColor = "#999999";
    }
}

function validar_peso_rango() {
    if (document.getElementById("peso_rango_total_m1").value == "") {
        document.getElementById("peso_rango_total_m1").style.borderColor = "Red";
        document.getElementById("total_modulo1").style.borderColor = "Red";
    
        document.getElementById("mensaje").textContent =
            "Para continuar debe completar el Módulo I";
        document.getElementById("alerta").style.display = "block";
    } else {
        document.getElementById("peso_rango_total_m1").style.borderColor =
            "#999999";
    
        if (document.getElementById("peso_rango_total_m2").value == "") {
            document.getElementById("peso_rango_total_m2").style.borderColor = "Red";
            document.getElementById("total_modulo2").style.borderColor = "Red";
    
            document.getElementById("mensaje").textContent =
            "Para continuar debe completar el Módulo II";
            document.getElementById("alerta").style.display = "block";
        } else {
            document.getElementById("peso_rango_total_m2").style.borderColor =
            "#999999";
    
            let pr1 = document.getElementById("peso_rango_total_m1").value;
            let pr2 = document.getElementById("peso_rango_total_m2").value;
            let total = Number(pr1) + Number(pr2);
    
            document.getElementById("total_modulo3").value = total;
    
            if (total >= 100 && total <= 124) {
            document.getElementById("rango_accion1").textContent = "No Cumplió";
            document.getElementById("rango_accion").style.textAlign = "center";
            document.getElementById("op3").style.display = "none";
            document.getElementById("op4").style.display = "none";
            } else if (total >= 125 && total <= 249) {
            document.getElementById("rango_accion1").textContent =
                "Cumplimiento Ordinario";
            document.getElementById("rango_accion").style.textAlign = "center";
            document.getElementById("op3").style.display = "none";
            document.getElementById("op4").style.display = "none";
            } else if (total >= 250 && total <= 374) {
            document.getElementById("rango_accion1").textContent = "Bueno";
            document.getElementById("rango_accion2").textContent =
                " - Cumplimiento de Proceso de Mejora";
            document.getElementById("rango_accion").style.textAlign = "center";
            document.getElementById("op3").style.display = "block";
            document.getElementById("op4").style.display = "block";
            } else if (total >= 375 && total <= 499) {
            document.getElementById("rango_accion1").textContent = "Muy Bueno";
            document.getElementById("rango_accion2").textContent =
                " - Cumplimiento Destacable";
            document.getElementById("rango_accion").style.textAlign = "center";
            document.getElementById("op3").style.display = "block";
            document.getElementById("op4").style.display = "block";
            } else if (total == 500) {
            document.getElementById("rango_accion1").textContent = "Excelente";
            document.getElementById("rango_accion2").textContent =
                " - Cumplimiento Emulable";
            document.getElementById("rango_accion").style.textAlign = "center";
            document.getElementById("op3").style.display = "block";
            document.getElementById("op4").style.display = "block";
            } else if (total > 500) {
            document.getElementById("mensaje").textContent =
                'El total del "Módulo I" + "Modulo II" no debe ser mayor a 500';
            document.getElementById("alerta").style.display = "block";
            }
        }
    }
}

function modulo1() {
    let valor = 0;
    let valor2 = 0;
    let descripcion = 0;
    let mensaje_p = "";
    let mensaje_m = "";
    let mensaje1 = "";
    let mensaje2 = "";
    let pr1 = document.getElementById("peso_rango1").value;
    let pr2 = document.getElementById("peso_rango2").value;
    let pr3 = document.getElementById("peso_rango3").value;
    let pr4 = document.getElementById("peso_rango4").value;
    let pr5 = document.getElementById("peso_rango5").value;
    let pr6 = document.getElementById("peso_rango6").value;
    let pr7 = document.getElementById("peso_rango7").value;
    let pr8 = document.getElementById("peso_rango8").value;
  
    let modulo =
        Number(pr1) +
        Number(pr2) +
        Number(pr3) +
        Number(pr4) +
        Number(pr5) +
        Number(pr6) +
        Number(pr7) +
        Number(pr8);
  
    contador = document.getElementById("peso_total_m1").value;
  
    if (document.getElementById("peso_rango1").value == "") {
        document.getElementById("peso_rango1").style.borderColor = "Red";
        valor++;
    } else {
        document.getElementById("peso_rango1").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango2").value == "") {
        document.getElementById("peso_rango2").style.borderColor = "Red";
        valor++;
    } else {
        document.getElementById("peso_rango2").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango3").value == "") {
        document.getElementById("peso_rango3").style.borderColor = "Red";
        valor++;
    } else {
        document.getElementById("peso_rango3").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango4").value == "") {
        document.getElementById("peso_rango4").style.borderColor = "Red";
        valor++;
    } else {
        document.getElementById("peso_rango4").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango5").value == "") {
        document.getElementById("peso_rango5").style.borderColor = "Red";
        valor++;
    } else {
        document.getElementById("peso_rango5").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango6").value == "") {
        document.getElementById("peso_rango6").style.borderColor = "Red";
        valor++;
    } else {
        document.getElementById("peso_rango6").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango7").value == "") {
        document.getElementById("peso_rango7").style.borderColor = "Red";
        valor++;
    } else {
        document.getElementById("peso_rango7").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango8").value == "") {
        document.getElementById("peso_rango8").style.borderColor = "Red";
        valor++;
    } else {
        document.getElementById("peso_rango8").style.borderColor = "#999999";
    }
    if (document.getElementById("cedula2").value == "") {
        document.getElementById("cedula2").style.borderColor = "Red";
        valor2++;
    } else {
        document.getElementById("cedula2").style.borderColor = "#999999";
    }
    if (document.getElementById("persona_id2").value == "") {
        valor2++;
    }
    if (document.getElementById("peso_total_m1").value != 50) {
        mensaje_p =
            'La suma de todos los "PESOS" del "Módulo I" deben ser iguales a 50, siendo su valor: ' +
            contador;
    }
    if (valor > 0) {
        mensaje_m = "Falta completar " + valor + ' campo(s) en el "Módulo I"';
    }
    if (valor2 > 0) {
        mensaje_m = "Faltó buscar al evaluado para seguir con el proceso";
    }
    if (mensaje_p != "" && mensaje_m != "") {
        mensaje1 = mensaje_m + " y " + mensaje_p;
    } else if (mensaje_p != "" || mensaje_m != "") {
        mensaje1 = mensaje_m + " " + mensaje_p;
        /* document.getElementById("mensaje").textContent = mensaje_m+mensaje_p; */
        /* document.getElementById("alerta").style.display = "block"; */
    }
    if (document.getElementById("descripcion1").value == "") {
        document.getElementById("descripcion1").style.borderColor = "Red";
        descripcion++;
    } else {
        document.getElementById("descripcion1").style.borderColor = "#999999";
    }
    if (document.getElementById("descripcion2").value == "") {
        document.getElementById("descripcion2").style.borderColor = "Red";
        descripcion++;
    } else {
        document.getElementById("descripcion2").style.borderColor = "#999999";
    }
    if (document.getElementById("descripcion3").value == "") {
        document.getElementById("descripcion3").style.borderColor = "Red";
        descripcion++;
    } else {
        document.getElementById("descripcion3").style.borderColor = "#999999";
    }
    if (document.getElementById("descripcion4").value == "") {
        document.getElementById("descripcion4").style.borderColor = "Red";
        descripcion++;
    } else {
        document.getElementById("descripcion4").style.borderColor = "#999999";
    }
    if (document.getElementById("descripcion5").value == "") {
        document.getElementById("descripcion5").style.borderColor = "Red";
        descripcion++;
    } else {
        document.getElementById("descripcion5").style.borderColor = "#999999";
    }
    if (descripcion > 0) {
        mensaje2 = 'Debe indicar todos los "Objetivos del Desempeño Individual"';
    }
    if (mensaje1 != "" && mensaje2 != "") {
        document.getElementById("mensaje").textContent =
            mensaje1 + " y " + mensaje2;
        document.getElementById("alerta").style.display = "block";
    } else if (mensaje1 != "" || mensaje2 != "") {
        document.getElementById("mensaje").textContent = mensaje1 + " " + mensaje2;
        document.getElementById("alerta").style.display = "block";
        document.getElementById("mensaje").style.textAlign = "center";
    } else {
        document.getElementById("peso_rango_total_m1").value = modulo;
        document.getElementById("total_modulo1").value = modulo;
        document.getElementById("modulo2").style.display = "block";
    
        /* document.getElementById("mensaje").textContent = "Todo Correcto"; */
        document.getElementById("alerta").style.display = "block";
        document.getElementById("mensaje").style.textAlign = "center";
    
        let cedula2 = document.getElementById("cedula2").value;
        let nombre_apellido2 = document.getElementById("nombre_apellido2").value;
        let codigo2 = document.getElementById("codigo2").value;
        let cargo2 = document.getElementById("cargo2").value;
        let cargo_id2 = document.getElementById("cargo_id2").value;
        let ubicacion_adm2 = document.getElementById("ubicacion_adm2").value;
        let ubicacion_act2 = document.getElementById("ubicacion_act2").value;
        let cargo_ejerce2 = document.getElementById("cargo_ejerce2").value;
        let persona_id2 = document.getElementById("persona_id2").value;
        let rol_evaluacion2 = document.getElementById("rol_evaluacion2").value;
        let periodo_evaluacion2 = document.getElementById(
            "periodo_evaluacion2"
        ).value;
        let nanno_evalu2 = document.getElementById("nanno_evalu2").value;
        let ubicacion_scodigo2 =
            document.getElementById("ubicacion_scodigo2").value;
        let codigo_tipos_trabajadores2 = document.getElementById(
            "codigo_tipos_trabajadores2"
        ).value;
    
        let peso1 = document.getElementById("peso1").value;
        let rango1 = document.getElementById("rango1").value;
    
        let peso2 = document.getElementById("peso2").value;
        let rango2 = document.getElementById("rango2").value;
    
        let peso3 = document.getElementById("peso3").value;
        let rango3 = document.getElementById("rango3").value;
    
        let descripcion1 = document.getElementById("descripcion1").value;
        let peso4 = document.getElementById("peso4").value;
        let rango4 = document.getElementById("rango4").value;
    
        let descripcion2 = document.getElementById("descripcion2").value;
        let peso5 = document.getElementById("peso5").value;
        let rango5 = document.getElementById("rango5").value;
    
        let descripcion3 = document.getElementById("descripcion3").value;
        let peso6 = document.getElementById("peso6").value;
        let rango6 = document.getElementById("rango6").value;
    
        let descripcion4 = document.getElementById("descripcion4").value;
        let peso7 = document.getElementById("peso7").value;
        let rango7 = document.getElementById("rango7").value;
    
        let descripcion5 = document.getElementById("descripcion5").value;
        let peso8 = document.getElementById("peso8").value;
        let rango8 = document.getElementById("rango8").value;
    
        let peso_rango_total_m1 = document.getElementById(
            "peso_rango_total_m1"
        ).value;
        let id = document.getElementById("usuario2").value;
    
        $.ajax({
            url: "/minpptrassi/mod_evaluacion/corregir.php",
            type: "POST",
            data: {
            peso1: peso1,
            rango1: rango1,
            peso2: peso2,
            rango2: rango2,
            peso3: peso3,
            rango3: rango3,
            descripcion1: descripcion1,
            peso4: peso4,
            rango4: rango4,
            descripcion2: descripcion2,
            peso5: peso5,
            rango5: rango5,
            descripcion3: descripcion3,
            peso6: peso6,
            rango6: rango6,
            descripcion4: descripcion4,
            peso7: peso7,
            rango7: rango7,
            descripcion5: descripcion5,
            peso8: peso8,
            rango8: rango8,
            id: id,
            peso_rango_total_m1: peso_rango_total_m1,
            accion: 2
            },
            success: function (resp) {
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                let v2 = resp.split(" / ")[2];
                let v3 = resp.split(" / ")[3];
                let v4 = resp.split(" / ")[4];
                let v5 = resp.split(" / ")[5];
                let v6 = resp.split(" / ")[6];
                let v7 = resp.split(" / ")[7];
                let v8 = resp.split(" / ")[8];
                let v9 = resp.split(" / ")[9];
                let v10 = resp.split(" / ")[10];
                let v11 = resp.split(" / ")[11];
                let v12 = resp.split(" / ")[12];
                let v13 = resp.split(" / ")[13];
                let v14 = resp.split(" / ")[14];
                let v15 = resp.split(" / ")[15];
                let v16 = resp.split(" / ")[16];
                let v17 = resp.split(" / ")[17];
                let v18 = resp.split(" / ")[18];
                let v19 = resp.split(" / ")[19];
                let v20 = resp.split(" / ")[20];
                let v21 = resp.split(" / ")[21];
                let v22 = resp.split(" / ")[22];
                if (v0 == "0") {
                    document.getElementById("mensaje").style.textAlign = "center";
                    document.getElementById("mensaje").textContent = "Falló el Sistema ";
                    document.getElementById("alerta").style.display = "block";
        
                    /* Está Cédula de Identidad no se encuentra en el Sistema */
                } else {
                    /* $( "#nombre_apellido2" ).val(v1.toUpperCase());
                            $( "#codigo2" ).val(v2.toUpperCase());
                            $( "#cargo2" ).val(v3.toUpperCase());
                            $( "#ubicacion_adm2" ).val(v4.toUpperCase());
                            $( "#ubicacion_act2" ).val(v5.toUpperCase());
                            $( "#cargo_ejerce2" ).val(v6.toUpperCase());
                            
                            document.getElementById("nombre_apellido2").style.borderColor = '';
                            document.getElementById("cargo2").style.borderColor = '';
                            document.getElementById("ubicacion_adm2").style.borderColor = '';
                            document.getElementById("ubicacion_act2").style.borderColor = '';
                            document.getElementById("cargo_ejerce2").style.borderColor = '';
                            document.getElementById("codigo2").style.borderColor = ''; */
        
                    /* alert (v1); */
                    document.getElementById("mensaje").style.textAlign = "center";
                    document.getElementById("mensaje").textContent = "Se guardó Correctamente el Primer Módulo I ";
                    document.getElementById("alerta").style.display = "block";
                    $("#peso9").val(v1);
                    $("#rango9").val(v2);
                    $("#peso10").val(v3);
                    $("#rango10").val(v4);
                    $("#peso11").val(v5);
                    $("#rango11").val(v6);
                    $("#peso12").val(v7);
                    $("#rango12").val(v8);
                    $("#peso13").val(v9);
                    $("#rango13").val(v10);
                    $("#peso14").val(v11);
                    $("#rango14").val(v12);
                    $("#peso15").val(v13);
                    $("#rango15").val(v14);
                    $("#peso16").val(v15);
                    $("#rango16").val(v16);
                    $("#peso17").val(v17);
                    $("#rango17").val(v18);
                    $("#peso18").val(v19);
                    $("#rango18").val(v20);
                    $("#peso19").val(v21);
                    $("#rango19").val(v22);
                    multiplicar(9);
                    multiplicar(10);
                    multiplicar(11);
                    multiplicar(12);
                    multiplicar(13);
                    multiplicar(14);
                    multiplicar(15);
                    multiplicar(16);
                    multiplicar(17);
                    multiplicar(18);
                    multiplicar(19);
                    suma_modulo2();
                }
            },
        });
    }
}
function modulo2() {
    let valor2 = 0;
    let contador = 0;
    let mensaje_p = "";
    let mensaje_m = "";
    let pr9 = document.getElementById("peso_rango9").value;
    let pr10 = document.getElementById("peso_rango10").value;
    let pr11 = document.getElementById("peso_rango11").value;
    let pr12 = document.getElementById("peso_rango12").value;
    let pr13 = document.getElementById("peso_rango13").value;
    let pr14 = document.getElementById("peso_rango14").value;
    let pr15 = document.getElementById("peso_rango15").value;
    let pr16 = document.getElementById("peso_rango16").value;
    let pr17 = document.getElementById("peso_rango17").value;
    let pr18 = document.getElementById("peso_rango18").value;
    let pr19 = document.getElementById("peso_rango19").value;
  
    let modulo =
        Number(pr9) +
        Number(pr10) +
        Number(pr11) +
        Number(pr12) +
        Number(pr13) +
        Number(pr14) +
        Number(pr15) +
        Number(pr16) +
        Number(pr17) +
        Number(pr18) +
        Number(pr19);
  
    contador = document.getElementById("peso_total_m2").value;
  
    if (document.getElementById("peso_rango9").value == "") {
        document.getElementById("peso_rango9").style.borderColor = "Red";
        valor2++;
    } else {
        document.getElementById("peso_rango9").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango10").value == "") {
        document.getElementById("peso_rango10").style.borderColor = "Red";
        valor2++;
    } else {
        document.getElementById("peso_rango10").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango11").value == "") {
        document.getElementById("peso_rango11").style.borderColor = "Red";
        valor2++;
    } else {
        document.getElementById("peso_rango11").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango12").value == "") {
        document.getElementById("peso_rango12").style.borderColor = "Red";
        valor2++;
    } else {
        document.getElementById("peso_rango12").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango13").value == "") {
        document.getElementById("peso_rango13").style.borderColor = "Red";
        valor2++;
    } else {
        document.getElementById("peso_rango13").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango14").value == "") {
        document.getElementById("peso_rango14").style.borderColor = "Red";
        valor2++;
    } else {
        document.getElementById("peso_rango14").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango15").value == "") {
        document.getElementById("peso_rango15").style.borderColor = "Red";
        valor2++;
    } else {
        document.getElementById("peso_rango15").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango16").value == "") {
        document.getElementById("peso_rango16").style.borderColor = "Red";
        valor2++;
    } else {
        document.getElementById("peso_rango16").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango17").value == "") {
        document.getElementById("peso_rango17").style.borderColor = "Red";
        valor2++;
    } else {
        document.getElementById("peso_rango17").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango18").value == "") {
        document.getElementById("peso_rango18").style.borderColor = "Red";
        valor2++;
    } else {
        document.getElementById("peso_rango18").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango19").value == "") {
        document.getElementById("peso_rango19").style.borderColor = "Red";
        valor2++;
    } else {
        document.getElementById("peso_rango19").style.borderColor = "#999999";
    }
    if (document.getElementById("peso_rango_total_m1").value == "") {
        document.getElementById("peso_rango_total_m1").style.borderColor = "Red";
        valor2++;
    } else {
        document.getElementById("peso_rango_total_m1").style.borderColor =
            "#999999";
    }
    if (document.getElementById("peso_rango_total_m2").value == "") {
        document.getElementById("peso_rango_total_m2").style.borderColor = "Red";
        valor2++;
    } else {
        document.getElementById("peso_rango_total_m2").style.borderColor =
            "#999999";
    }
    if (contador != 50) {
        mensaje_p =
            'La suma de todos los "PESOS" del "Módulo II" deben ser iguales a 50, siendo su valor: ' +
            contador;
    }
    if (valor2 > 0) {
        mensaje_m = "Falta completar " + valor2 + ' campo(s) en el "Módulo II"';
    }
    if (mensaje_p != "" && mensaje_m != "") {
        document.getElementById("mensaje").textContent =
            mensaje_m + " y " + mensaje_p;
        document.getElementById("alerta").style.display = "block";
    } else if (mensaje_p != "" || mensaje_m != "") {
        document.getElementById("mensaje").textContent =
            mensaje_m + " " + mensaje_p;
        document.getElementById("alerta").style.display = "block";
    } else {
        document.getElementById("peso_rango_total_m2").value = modulo;
        document.getElementById("total_modulo2").value = modulo;
        /* document.getElementById("modulo3").style.display = "";
            document.getElementById("modulo4").style.display = ""; */
    
        /* document.getElementById("mensaje").textContent = "Todo Bien"; */
        /* document.getElementById("alerta").style.display = "block"; */
    
        let peso9 = document.getElementById("peso9").value;
        let rango9 = document.getElementById("rango9").value;
    
        let peso10 = document.getElementById("peso10").value;
        let rango10 = document.getElementById("rango10").value;
    
        let peso11 = document.getElementById("peso11").value;
        let rango11 = document.getElementById("rango11").value;
    
        let peso12 = document.getElementById("peso12").value;
        let rango12 = document.getElementById("rango12").value;
    
        let peso13 = document.getElementById("peso13").value;
        let rango13 = document.getElementById("rango13").value;
    
        let peso14 = document.getElementById("peso14").value;
        let rango14 = document.getElementById("rango14").value;
    
        let peso15 = document.getElementById("peso15").value;
        let rango15 = document.getElementById("rango15").value;
    
        let peso16 = document.getElementById("peso16").value;
        let rango16 = document.getElementById("rango16").value;
    
        let peso17 = document.getElementById("peso17").value;
        let rango17 = document.getElementById("rango17").value;
    
        let peso18 = document.getElementById("peso18").value;
        let rango18 = document.getElementById("rango18").value;
    
        let peso19 = document.getElementById("peso19").value;
        let rango19 = document.getElementById("rango19").value;
    
        let peso_rango_total_m1 = document.getElementById(
            "peso_rango_total_m1"
        ).value;
        let peso_rango_total_m2 = document.getElementById(
            "peso_rango_total_m2"
        ).value;
        let id = document.getElementById("usuario2").value;
    
        $.ajax({
            url: "/minpptrassi/mod_evaluacion/corregir.php",
            type: "POST",
            data: {
            peso9: peso9,
            rango9: rango9,
            peso10: peso10,
            rango10: rango10,
            peso11: peso11,
            rango11: rango11,
            peso12: peso12,
            rango12: rango12,
            peso13: peso13,
            rango13: rango13,
            peso14: peso14,
            rango14: rango14,
            peso15: peso15,
            rango15: rango15,
            peso16: peso16,
            rango16: rango16,
            peso17: peso17,
            rango17: rango17,
            peso18: peso18,
            rango18: rango18,
            peso19: peso19,
            rango19: rango19,
            peso_rango_total_m1: peso_rango_total_m1,
            peso_rango_total_m2: peso_rango_total_m2,
            id: id,
            accion: 3
            },
            success: function (resp) {
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            if (v0 == "0") {
                document.getElementById("mensaje").style.textAlign = "center";
                document.getElementById("mensaje").textContent = "Falló el Sistema";
                document.getElementById("alerta").style.display = "block";
            } else {
                document.getElementById("mensaje").style.textAlign = "center";
                document.getElementById("mensaje").textContent =
                "Se guardó Correctamente el Módulo II";
                document.getElementById("alerta").style.display = "block";
                document.getElementById("cerrar1").style.display = "none";
                document.getElementById("cerrar2").style.display = "block";
                /* $(location).attr('href','files.php'); */
            }
            },
        });
    }
    validar_peso_rango();
}
function validar_peso_rango() {
    if (document.getElementById("peso_rango_total_m1").value == "") {
        document.getElementById("peso_rango_total_m1").style.borderColor = "Red";
        document.getElementById("total_modulo1").style.borderColor = "Red";
    
        document.getElementById("mensaje").textContent =
            "Para continuar debe completar el Módulo I";
        document.getElementById("alerta").style.display = "block";
    } else {
        document.getElementById("peso_rango_total_m1").style.borderColor =
            "#999999";
    
        if (document.getElementById("peso_rango_total_m2").value == "") {
            document.getElementById("peso_rango_total_m2").style.borderColor = "Red";
            document.getElementById("total_modulo2").style.borderColor = "Red";
    
            document.getElementById("mensaje").textContent =
            "Para continuar debe completar el Módulo II";
            document.getElementById("alerta").style.display = "block";
        } else {
            document.getElementById("peso_rango_total_m2").style.borderColor =
            "#999999";
  
            let pr1 = document.getElementById("peso_rango_total_m1").value;
            let pr2 = document.getElementById("peso_rango_total_m2").value;
            let total = Number(pr1) + Number(pr2);
    
            document.getElementById("total_modulo3").value = total;
    
            if (total >= 100 && total <= 124) {
                document.getElementById("rango_accion1").textContent = "No Cumplió";
                document.getElementById("rango_accion").style.textAlign = "center";
                document.getElementById("op3").style.display = "none";
                document.getElementById("op4").style.display = "none";
            } else if (total >= 125 && total <= 249) {
                document.getElementById("rango_accion1").textContent =
                    "Cumplimiento Ordinario";
                document.getElementById("rango_accion").style.textAlign = "center";
                document.getElementById("op3").style.display = "none";
                document.getElementById("op4").style.display = "none";
            } else if (total >= 250 && total <= 374) {
                document.getElementById("rango_accion1").textContent = "Bueno";
                document.getElementById("rango_accion2").textContent =
                    " - Cumplimiento de Proceso de Mejora";
                document.getElementById("rango_accion").style.textAlign = "center";
                document.getElementById("op3").style.display = "block";
                document.getElementById("op4").style.display = "block";
            } else if (total >= 375 && total <= 499) {
                document.getElementById("rango_accion1").textContent = "Muy Bueno";
                document.getElementById("rango_accion2").textContent =
                    " - Cumplimiento Destacable";
                document.getElementById("rango_accion").style.textAlign = "center";
                document.getElementById("op3").style.display = "block";
                document.getElementById("op4").style.display = "block";
            } else if (total == 500) {
                document.getElementById("rango_accion1").textContent = "Excelente";
                document.getElementById("rango_accion2").textContent =
                    " - Cumplimiento Emulable";
                document.getElementById("rango_accion").style.textAlign = "center";
                document.getElementById("op3").style.display = "block";
                document.getElementById("op4").style.display = "block";
            } else if (total > 500) {
                document.getElementById("mensaje").textContent =
                    'El total del "Módulo I" + "Modulo II" no debe ser mayor a 500';
                document.getElementById("alerta").style.display = "block";
            }
        }
    }
}