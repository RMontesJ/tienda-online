let form = document.getElementById('form');

document.addEventListener("DOMContentLoaded", function () {
    form.addEventListener('submit', corregirValores);
});

function corregirValores(evento) {
    evento.preventDefault();

    let titulo = document.getElementById('titulo');
    let descripcion = document.getElementById('descripcion');

    let corregirTitulo = document.getElementById('corregirTitulo');
    let corregirDescripcion = document.getElementById('corregirDescripcion');

    let validar = true;

    // Validación del título
    if (titulo.value.trim() === "" || !/^[A-Za-z0-9\s]{3,50}$/.test(titulo.value)) {
        titulo.style.border = "1px red solid";
        corregirTitulo.style.color = 'red';
        corregirTitulo.innerHTML = "El título debe tener entre 3 y 50 caracteres alfanuméricos.";
        validar = false;
    } else {
        titulo.style.border = "1px green solid";
        corregirTitulo.innerHTML = "";
    }

    // Validación de la descripción
    if (descripcion.value.trim() === "" || !/^[A-Za-z0-9\s]{10,200}$/.test(descripcion.value)) {
        descripcion.style.border = "1px red solid";
        corregirDescripcion.style.color = 'red';
        corregirDescripcion.innerHTML = "La descripción debe tener entre 10 y 200 caracteres alfanuméricos.";
        validar = false;
    } else {
        descripcion.style.border = "1px green solid";
        corregirDescripcion.innerHTML = "";
    }

    // Si todo es válido, se envía el formulario
    if (validar === true) {
        form.submit();
    }
}