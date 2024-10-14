(function (){

    var actualizarhora = function(){
        var fecha = new Date(),
            horas = fecha.getHours(),
            ap,
            minutos = fecha.getMinutes(),
            segundos = fecha.getSeconds(),
            dia = fecha.getDate(),
            mes = fecha.getMonth(),
            year = fecha.getFullYear();

        var phoras = document.getElementById('horas'),
            pap = document.getElementById('ap'),
            pminutos = document.getElementById('minutos'),
            psegundos = document.getElementById('segundos'),
            pdia = document.getElementById('dia'),
            pmes = document.getElementById('mes'),
            pyear = document.getElementById('year');

        pdia.textContent = dia;

        mes = mes + 1;
        if (mes < 10) {
            mes = "0" + mes;
        }
        pmes.textContent = mes;
        pyear.textContent = year;

        if(horas >= 12 ){
            horas = horas - 12;
            ap = 'PM';
        }else
            ap = 'AM';

        if(horas == 0)
            horas = 12;

        if(horas < 10){
            horas = "0" + horas;
        }

        phoras.textContent = horas;
        pap.textContent = ap;

        if (minutos < 10) {
            minutos = "0" + minutos;
        }

        pminutos.textContent = minutos;

        if (segundos < 10) {
            segundos = "0" + segundos;
        }

        psegundos.textContent = segundos;
    };

    actualizarhora();

    var interval = setInterval(actualizarhora, 1000);

}())