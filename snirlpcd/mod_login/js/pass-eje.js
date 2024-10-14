let pass = document.getElementById("txt_clave");
let eye = document.getElementById("ojo");

function icon(){
    if (pass.type === "password"){
        pass.type = "text";
        eye.classList.remove('icon-eye-2');
        eye.classList.add('icon-eye-off');
    }else{
        pass.type = "password";
        eye.classList.remove('icon-eye-off');
        eye.classList.add('icon-eye-2');
    }
}

let pswd = document.getElementById("pswd");
let eye2 = document.getElementById("ojo2");

function icon2(){
    if (pswd.type === "password"){
        pswd.type = "text";
        eye2.classList.remove('icon-eye-2');
        eye2.classList.add('icon-eye-off');
    }else{
        pswd.type = "password";
        eye2.classList.remove('icon-eye-off');
        eye2.classList.add('icon-eye-2');
    }
}

let pswd2 = document.getElementById("pswd2");
let eye3 = document.getElementById("ojo3");

function icon3(){
    if (pswd2.type === "password"){
        pswd2.type = "text";
        eye3.classList.remove('icon-eye-2');
        eye3.classList.add('icon-eye-off');
    }else{
        pswd2.type = "password";
        eye3.classList.remove('icon-eye-off');
        eye3.classList.add('icon-eye-2');
    }
}

/*
    Código que no funcionó

    icon.addEventListenner("click", e => {
        if (pass.type === "password"){
            pass.type = "text";
        }else{
            pass.type = "password";
        }
    })

*/