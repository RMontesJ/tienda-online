
let form = document.getElementById('form');

document.addEventListener("DOMContentLoaded", function (){
    form.addEventListener('submit', corregirValores);
});

function corregirValores(evento){

evento.preventDefault();

let nombre = document.getElementById('nombre');
let contrasena = document.getElementById('contrasena');
let correo = document.getElementById('correo');
let direccion = document.getElementById('direccion');


let corregirNombre = document.getElementById('corregirNombre');
let corregirContrasena = document.getElementById('corregirContrasena');
let corregirCorreo = document.getElementById('corregirCorreo');
let corregirDireccion = document.getElementById('corregirDireccion');

let validar = true

if(nombre.value.trim() === "" || !/^[a-zA-Z\s]{1,25}$/.test(nombre.value)){
    nombre = document.getElementById('nombre').style.border = "1px red solid";
    corregirNombre.style.color = 'red';
    corregirNombre.innerHTML = "El nombre tiene que tener entre 1 y 25 caracteres, sin caracteres especiales";
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
    corregirContrasena.innerHTML = "La contraseña tiene que tener 5 caracteres, una mayuscula, minuscula, numero y caracter especial";
    validar = false;
}
else{
    contrasena = document.getElementById('contrasena').style.border = "1px green solid";
    corregirContrasena.innerHTML = "";    
    validar = true;
}

if(correo.value.trim() === "" || !/^(?=.*[a-zA-Z])[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(correo.value) || correo.value.includes("@admin.com")){
    correo = document.getElementById('correo').style.border = "1px red solid";
   corregirCorreo.style.color = 'red';
   corregirCorreo.innerHTML = "El correo tiene que tener una @";
   validar = false;
}
else{
    correo = document.getElementById('correo').style.border = "1px green solid";
    corregirCorreo.innerHTML = "";
    validar = true;
}

if(direccion.value.trim() === "" || !/^[a-zA-Z0-9 ]+$/.test(direccion.value)){
    direccion = document.getElementById('direccion').style.border = "1px red solid";
    corregirDireccion.style.color = 'red';
   corregirDireccion.innerHTML = "La direccion solo debe tener letras y numeros";
   validar = false;
}
else{
    direccion = document.getElementById('direccion').style.border = "1px green solid";
    corregirDireccion.innerHTML = "";
    validar = true;
}

if(validar === true){
form.submit();
}


}