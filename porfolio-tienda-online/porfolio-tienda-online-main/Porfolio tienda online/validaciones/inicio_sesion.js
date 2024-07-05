
let form = document.getElementById('form');

document.addEventListener("DOMContentLoaded", function (){
    form.addEventListener('submit', corregirValores);
});

function corregirValores(evento){

evento.preventDefault();

let nombre = document.getElementById('nombre');
let contrasena = document.getElementById('contrasena');

let corregirNombre = document.getElementById('corregirNombre');
let corregirContrasena = document.getElementById('corregirContrasena');

let validar = true

if(nombre.value.trim() === "" || !/^[a-zA-Z\s]{1,25}$/.test(nombre.value)){
    nombre = document.getElementById('nombre').style.border = "1px red solid";
    corregirNombre.style.color = 'red';
    corregirNombre.innerHTML = "El nombre tiene que tener entre 1 y 25 caracteres, sin caracteres especiales ni numeros";
    validar = false;
}
else{
    nombre = document.getElementById('nombre').style.border = "1px green solid";
    corregirNombre.innerHTML = "";
    validar = true;
}

if(contrasena.value.trim() === "" || !/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,}$/.test(contrasena.value)){
    contrasena = document.getElementById('contrasena').style.border = "1px red solid";
    corregirContrasena.style.color = 'red';
    corregirContrasena.innerHTML = "La contraseña tiene que tener 4 caracteres, una mayuscula, minuscula, numero y caracter especial";
    validar = false;
}
else{
    contrasena = document.getElementById('contrasena').style.border = "1px green solid";
    corregirContrasena.innerHTML = "";    
    validar = true;
}

if(validar === true){
form.submit();
}


}