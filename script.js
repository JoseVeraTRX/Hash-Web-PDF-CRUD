//De arranque
document.getElementById("btn_Register").addEventListener("click",register);
document.getElementById("btn_Login").addEventListener("click",login);
window.addEventListener("resize", anchPage);

//Declaracion de variables
var form_login = document.querySelector(".form_Login"); //Variable login
var form_register = document.querySelector(".form_Register"); //Variable register
var container_loginandregister = document.querySelector(".container__LoginAndRegister"); //Variable contenedor

//Cajas traseras
var back_boxlogin = document.querySelector(".back__boxLogin");
var back_boxregister = document.querySelector(".back__boxRegister");

function anchPage(){

    if(window.innerWidth>850){
        back_boxlogin.style.display = "block";
        back_boxregister.style.display = "block";   
    }else{
        back_boxregister.style.display = "block";
        back_boxregister.style.opacity = "1";
        back_boxlogin.style.display = "none";
        form_login.style.display = "block";
        form_register.style.display = "none";
        container_loginandregister.style.left = "0px";
    }
}


anchPage();

//Funcion para mover back box register
function register(){
    if(window.innerWidth>850){
        form_register.style.display = "block";
        container_loginandregister.style.left = "410px";
        form_login.style.display = "none";
        back_boxregister.style.opacity = "0";
        back_boxlogin.style.opacity = "1";
    }else{
        form_register.style.display = "block";
        container_loginandregister.style.left = "0px";
        form_login.style.display = "none";
        back_boxregister.style.display = "none";
        back_boxlogin.style.display = "block";
        back_boxlogin.style.opacity= "1";
    }
    
}
//Funcion para mover back box login
function login(){
    if(window.innerWidth>850){

        form_register.style.display = "none";
        container_loginandregister.style.left = "10px";
        form_login.style.display = "block";
        back_boxregister.style.opacity = "1";
        back_boxlogin.style.opacity = "0";
    }else{
        form_register.style.display = "none";
        container_loginandregister.style.left = "0px";
        form_login.style.display = "block";
        back_boxregister.style.display = "block";
        back_boxlogin.style.display = "none";
    }
    
}

