
let form = document.getElementById('form');

document.addEventListener("DOMContentLoaded", function (){
    form.addEventListener('submit', corregirValores);
});

function corregirValores(evento){

evento.preventDefault();

let contrasenaNueva = document.getElementById('contrasenaNueva');
let correccionContrasena = document.getElementById('correccionContrasena');

let validar = true;

if(contrasenaNueva.value.trim() === "" || !/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,}$/.test(contrasenaNueva.value)){
    contrasenaNueva = document.getElementById('contrasenaNueva').style.border = "1px red solid";
    correccionContrasena.style.color = 'red';
    correccionContrasena.innerHTML = "La contraseña debe tener minusculas, mayusculas, un numero y un caracter especial";
    validar = false;
}
else{
    contrasenaNueva = document.getElementById('contrasenaNueva').style.border = "1px green solid";
    correccionContrasena.innerHTML = "";
    validar = true;
}

if(validar === true){
form.submit();
}


}