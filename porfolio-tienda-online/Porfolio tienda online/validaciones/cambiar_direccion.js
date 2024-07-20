
let form = document.getElementById('form');

document.addEventListener("DOMContentLoaded", function (){
    form.addEventListener('submit', corregirValores);
});

function corregirValores(evento){

evento.preventDefault();

let direccionNueva = document.getElementById('direccionNueva');
let correccionDireccion = document.getElementById('correccionDireccion');

let validar = true;

if(direccionNueva.value.trim() === "" || !/^[a-zA-Z0-9\s.,-]+$/.test(direccionNueva.value)){
    direccionNueva = document.getElementById('direccionNueva').style.border = "1px red solid";
    correccionDireccion.style.color = 'red';
    correccionDireccion.innerHTML = "La dirección debe tener minusculas, mayusculas, un numero, puntos, comas y guiones";
    validar = false;
}
else{
    direccionNueva = document.getElementById('direccionNueva').style.border = "1px green solid";
    correccionDireccion.innerHTML = "";
    validar = true;
}

if(validar === true){
form.submit();
}


}