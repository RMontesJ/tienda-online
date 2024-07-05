
let form = document.getElementById('form');

document.addEventListener("DOMContentLoaded", function (){
    form.addEventListener('submit', corregirValores);
});

function corregirValores(evento){

evento.preventDefault();

let nombreNuevo = document.getElementById('nombreNuevo');
let correccionNombre = document.getElementById('correccionNombre');

let validar = true;

if(nombreNuevo.value.trim() === "" || !/^[a-zA-Z0-9\s@$!%*?&]{1,25}$/.test(nombreNuevo.value)){
    nombreNuevo = document.getElementById('nombreNuevo').style.border = "1px red solid";
    correccionNombre.style.color = 'red';
    correccionNombre.innerHTML = "El nombre debe tener entre 1 y 25 caracteres y solo contener letras, números y caracteres especiales @$!%*?&";
    validar = false;
} else {
    nombreNuevo = document.getElementById('nombreNuevo').style.border = "1px green solid";
    correccionNombre.innerHTML = "";
    validar = true;
}

if(validar === true){
    form.submit();
}


}