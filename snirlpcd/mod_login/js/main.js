//Ejecutando funciones
/*btn_iniciar-sesion = id del boton   
iniciarSesion  Reliza un llamado a una funcion JavaScript que esta mas abajo
*/
document.getElementById("btn_iniciar-sesion").addEventListener("click", iniciarSesion);
//document.getElementById("btn_iniciar").addEventListener("click", iniciar);
document.getElementById("btn_registrarse").addEventListener("click", register);
document.getElementById("btn_olvido_clave").addEventListener("click", olvidocontrasena);//Llama a la funcion
//document.getElementById("btn_iniciar").addEventListener("click", iniciar);

//document.getElementById("btn_validacion").addEventListener("click", validacion);

window.addEventListener("resize", anchoPage);

//Declarando variables
var formulario_login = document.querySelector(".formulario_login");
var formulario_iniciar = document.querySelector(".formulario_iniciar");
var formulario_register = document.querySelector(".formulario_register");
var formulario_clave = document.querySelector(".formulario_clave");
var formulario_validacion = document.querySelector(".formulario_validacion");
var contenedor_login_register = document.querySelector(".contenedor_login-register");
var caja_trasera_register = document.querySelector(".caja_trasera-register");
var caja_trasera_login = document.querySelector(".caja_trasera-login");


    //FUNCIONES

function anchoPage(){
    formulario_register.style.display = "none";
    formulario_clave.style.display = "none";
    formulario_validacion.style.display = "none";
    if (window.innerWidth > 850){
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "block";
    }else{
        caja_trasera_register.style.display = "none";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "block";
        formulario_login.style.display = "none";
        formulario_clave.style.display = "none";
        //formulario_validacion.style.display = "none";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "block";   
    }
}

anchoPage();
    function iniciarSesion(){
        if (window.innerWidth > 850){
            //formulario_login = el nombre de la clase del formulario al que llama
            formulario_login.style.display = "block";//Mostrar
            formulario_clave.style.display = "none";//Ocultar
            formulario_validacion.style.display = "none";
            contenedor_login_register.style.left = "10px";
            formulario_register.style.display = "none";
            caja_trasera_register.style.opacity = "1";
            caja_trasera_login.style.opacity = "0";
        }else{
            formulario_login.style.display = "block";
            formulario_clave.style.display = "none";
            formulario_validacion.style.display = "none";
            contenedor_login_register.style.left = "0px";
            formulario_register.style.display = "none";
            caja_trasera_register.style.display = "block";
            caja_trasera_login.style.display = "none";
        }
    }
    function iniciar(){
        if (window.innerWidth > 850){
            formulario_login.style.display = "block";//Mostrar
            formulario_clave.style.display = "none";
            formulario_validacion.style.display = "none";
            contenedor_login_register.style.left = "10px";
            formulario_register.style.display = "none";
            caja_trasera_register.style.opacity = "1";
            caja_trasera_login.style.opacity = "0";
        }else{
            formulario_login.style.display = "block";
            formulario_clave.style.display = "none";
            formulario_validacion.style.display = "none";
            contenedor_login_register.style.left = "0px";
            formulario_register.style.display = "none";
            caja_trasera_register.style.display = "block";
            caja_trasera_login.style.display = "none";
        }
    }

    function olvidocontrasena(){ //Identifica el formulario a mostras en la misma pagina de login
        if (window.innerWidth > 850){
            formulario_register.style.display = "none";
            //formulario_validacion.style.display = "none";
            contenedor_login_register.style.left = "410px";
            contenedor_login_register.style.left = "410px";
            formulario_login.style.display = "none";
            formulario_clave.style.display = "block";
            caja_trasera_register.style.opacity = "0";
            caja_trasera_login.style.opacity = "1";
        }else{
            formulario_register.style.display = "none";
            //formulario_validacion.style.display = "none";
            contenedor_login_register.style.left = "0px";
            formulario_login.style.display = "none";
            formulario_clave.style.display = "block";
            caja_trasera_register.style.display = "none";
            caja_trasera_login.style.display = "block";
            caja_trasera_login.style.opacity = "1";
        }
    }
/* 
    function validacion(){
        //alert("CAMBIO DE FORMULARIO");
        if (window.innerWidth > 850){
            formulario_register.style.display = "none";
            
                formulario_validacion.style.display = "block";//Mostrar

            contenedor_login_register.style.left = "410px";
            contenedor_login_register.style.left = "410px";
            formulario_login.style.display = "none";
            formulario_clave.style.display = "none";
            caja_trasera_register.style.opacity = "0";
            caja_trasera_login.style.opacity = "1";
        }else{
            formulario_register.style.display = "none";
            formulario_validacion.style.display = "block";
            contenedor_login_register.style.left = "0px";
            formulario_login.style.display = "none";
            formulario_clave.style.display = "none";
            caja_trasera_register.style.display = "none";
            caja_trasera_login.style.display = "block";
            caja_trasera_login.style.opacity = "1";
        }
    } */

    function register(){
        if (window.innerWidth > 850){
            formulario_register.style.display = "block";
            //formulario_validacion.style.display = "none";
            contenedor_login_register.style.left = "410px";
            contenedor_login_register.style.left = "410px";
            formulario_login.style.display = "none";
            formulario_clave.style.display = "none";
            caja_trasera_register.style.opacity = "0";
            caja_trasera_login.style.opacity = "1";
        }else{
            formulario_register.style.display = "block";
            //formulario_validacion.style.display = "none";
            contenedor_login_register.style.left = "0px";
            formulario_login.style.display = "none";
            formulario_clave.style.display = "none";
            caja_trasera_register.style.display = "none";
            caja_trasera_login.style.display = "block";
            caja_trasera_login.style.opacity = "1";
        }
}