function cerrar() {
    document.getElementById("alerta2").style.display = "none";
};

function cerrar2() {
    document.getElementById("alerta").style.display = "none";
};

document.getElementById('miFormulario').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe y la página se recargue

    // Obtener los valores de los campos
    var sacotacionSupervisor = document.getElementById('sacotacion_supervisor').value;
    var sprimerCursoNombre = document.getElementById('sprimer_curso_nombre').value;
    var sprimerCursoFecha = document.getElementById('sprimer_curso_fecha').value;
    var sprimerCursoArchivo = document.getElementById('sprimer_curso').files[0];
    var ssegundoCursoNombre = document.getElementById('ssegundo_curso_nombre').value;
    var ssegundoCursoFecha = document.getElementById('ssegundo_curso_fecha').value;
    var ssegundoCursoArchivo = document.getElementById('ssegundo_curso').files[0];

    // Obtener la fecha actual
    var fechaActual = new Date().toISOString().split('T')[0];

    // Resetear estilos de borde
    document.getElementById('sacotacion_supervisor').style.border = '';
    document.getElementById('sprimer_curso_nombre').style.border = '';
    document.getElementById('sprimer_curso_fecha').style.border = '';
    document.getElementById('sprimer_curso').style.border = '';
    document.getElementById('ssegundo_curso_nombre').style.border = '';
    document.getElementById('ssegundo_curso_fecha').style.border = '';
    document.getElementById('ssegundo_curso').style.border = '';

    // Validar los campos
    var errores = [];

    if (!sacotacionSupervisor) {
        errores.push('La observación del supervisor es requerida.');
        document.getElementById('sacotacion_supervisor').style.border = '1px solid red';
    }

    if (!sprimerCursoNombre) {
        errores.push('El nombre del primer curso es requerido.');
        document.getElementById('sprimer_curso_nombre').style.border = '1px solid red';
    }

    if (!sprimerCursoFecha) {
        errores.push('La fecha de realización del primer curso es requerida.');
        document.getElementById('sprimer_curso_fecha').style.border = '1px solid red';
    } else if (sprimerCursoFecha > fechaActual) {
        errores.push('La fecha de realización del primer curso no puede ser mayor que la fecha actual.');
        document.getElementById('sprimer_curso_fecha').style.border = '1px solid red';
    }

    if (!sprimerCursoArchivo) {
        errores.push('El certificado del primer curso es requerido.');
        document.getElementById('sprimer_curso').style.border = '1px solid red';
    } else if (sprimerCursoArchivo.type !== 'application/pdf') {
        errores.push('El certificado del primer curso debe estar en formato PDF.');
        document.getElementById('sprimer_curso').style.border = '1px solid red';
    }

    if (!ssegundoCursoNombre) {
        errores.push('El nombre del segundo curso es requerido.');
        document.getElementById('ssegundo_curso_nombre').style.border = '1px solid red';
    }

    if (!ssegundoCursoFecha) {
        errores.push('La fecha de realización del segundo curso es requerida.');
        document.getElementById('ssegundo_curso_fecha').style.border = '1px solid red';
    } else if (ssegundoCursoFecha > fechaActual) {
        errores.push('La fecha de realización del segundo curso no puede ser mayor que la fecha actual.');
        document.getElementById('ssegundo_curso_fecha').style.border = '1px solid red';
    }

    if (!ssegundoCursoArchivo) {
        errores.push('El certificado del segundo curso es requerido.');
        document.getElementById('ssegundo_curso').style.border = '1px solid red';
    } else if (ssegundoCursoArchivo.type !== 'application/pdf') {
        errores.push('El certificado del segundo curso debe estar en formato PDF.');
        document.getElementById('ssegundo_curso').style.border = '1px solid red';
    }

    // Mostrar errores o enviar el formulario
    if (errores.length > 0) {
        alert(errores.join('\n')); // Muestra los errores en una alerta
    } else {
        this.submit(); // Envía el formulario si no hay errores
    }
});