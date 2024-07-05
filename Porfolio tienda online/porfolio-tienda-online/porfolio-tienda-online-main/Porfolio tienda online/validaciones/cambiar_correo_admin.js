
let form = document.getElementById('form');

document.addEventListener("DOMContentLoaded", function (){
    form.addEventListener('submit', corregirValores);
});

function corregirValores(evento){

evento.preventDefault();

let correoNuevo = document.getElementById('correoNuevo');
let correccionCorreo = document.getElementById('correccionCorreo');

let validar = true;

if(correoNuevo.value.trim() === "" || !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(correoNuevo.value) || !correoNuevo.value.includes("@admin.com")){
    correoNuevo = document.getElementById('correoNuevo').style.border = "1px red solid";
    correccionCorreo.style.color = 'red';
    correccionCorreo.innerHTML = "Al ser administrador, debes poner un correo que contenga @admin.com";
    validar = false;
}
else{
    correoNuevo = document.getElementById('correoNuevo').style.border = "1px green solid";
    correccionCorreo.innerHTML = "";
    validar = true;
}

if(validar === true){
form.submit();
}


}