
let form = document.getElementById('form');

document.addEventListener("DOMContentLoaded", function (){
    form.addEventListener('submit', corregirValores);
});

function corregirValores(evento){

evento.preventDefault();

let nombre = document.getElementById('nombre');
let descripcion = document.getElementById('descripcion');
let categoria = document.getElementById('categoria');
let precio = document.getElementById('precio');

let corregirNombre = document.getElementById('corregirNombre');
let corregirDescripcion = document.getElementById('corregirDescripcion');
let corregirCategoria = document.getElementById('corregirCategoria');
let corregirPrecio = document.getElementById('corregirPrecio');

let validar = true;
// nombre
if(nombre.value.trim() === "" || !/^[a-zA-Z0-9]{1,50}$/.test(nombre.value)){
    nombre = document.getElementById('nombre').style.border = "1px red solid";
    corregirNombre.style.color = 'red';
    corregirNombre.innerHTML = "El nombre tiene que tener como maximo 50 caracteres";
    validar = false;
}
else{
    nombre = document.getElementById('nombre').style.border = "1px green solid";
    corregirNombre.innerHTML = "";
    validar = true;
}
// descripción
if(descripcion.value.trim() === "" || !/^[a-zA-Z0-9 ]{1,100}$/.test(descripcion.value)){
    descripcion = document.getElementById('descripcion').style.border = "1px red solid";
    corregirDescripcion.style.color = 'red';
    corregirDescripcion.innerHTML = "La descripción tiene que tener como mucho 100 caracteres sin caracteres especiales";
    validar = false;
}
else{
    descripcion = document.getElementById('descripcion').style.border = "1px green solid";
    corregirDescripcion.innerHTML = "";    
    validar = true;
}
// categoria
if(categoria.value.trim() === ""){
    categoria = document.getElementById('categoria').style.border = "1px red solid";
    corregirCategoria.style.color = 'red';
    corregirCategoria.innerHTML = "Elige una categoria";
    validar = false;
}
else{
    categoria = document.getElementById('categoria').style.border = "1px green solid";
    corregirCategoria.innerHTML = "";    
    validar = true;
}

if(precio.value.trim() === "" || !/^[0-9]+(\.[0-9]{3})*\.[0-9]{2}$/.test(precio.value)){
    precio = document.getElementById('precio').style.border = "1px red solid";
    corregirPrecio.style.color = 'red';
    corregirPrecio.innerHTML = "El precio tiene que tener este formato: 1025.59";
    validar = false;
}
else{
    precio = document.getElementById('precio').style.border = "1px green solid";
    corregirPrecio.innerHTML = "";    
    validar = true;
}

if(validar === true){
form.submit();
}


}