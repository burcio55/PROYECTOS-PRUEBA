const fechaNacimiento = document.getElementById("fecha_nac");
const edad = document.getElementById("edad");

const CalcularEdad = (fechaNacimiento) =>{
    const fechaActual = new Date();
    const anoActual = parseInt(fechaActual.getFullYear());
    const mesActual = parseInt(mesActual.getMonth())+1;
    const diaActual = parseInt(diaActual.getDate());

    const anoNacimiento = parseInt(String(fechaNacimiento).substring(0,4));
    const mesNacimiento = parseInt(String(fechaNacimiento).substring(5,7));
    const diaNacimiento = parseInt(String(fechaNacimiento).substring(8,10));

    let edad = anoActual-anoNacimiento;
    if(mesActual < mesNacimiento){
        edad--;
    } else if(mesActual == mesNacimiento){
        if(diaActual < diaNacimiento){
            edad--;
        }
    }
    return edad;
};

window.addEventListener('load', function(){
    fechaNacimiento.addEventListener('change', function(){
        if(this.value){
            edad.innerText = `Tiene: ${CalcularEdad(this.value)} años`;
        }
    });
});