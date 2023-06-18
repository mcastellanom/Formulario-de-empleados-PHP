function validarLongitud(campo, min, max) {
    return campo.length >= min && campo.length <= max;
}

function validarEmail(email) {
    const re = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    return re.test(email);

}
function validarFormulario() {
    const nombre = document.querySelector('input[name="nombre"]').value.trim();
    const apellido = document.querySelector('input[name="apellido"]').value.trim();
    const email = document.querySelector('input[name="email"]').value.trim();

    if (!validarLongitud(nombre, 1, 20)) {
        alert('Este campo debe contener un máximo de 20 caracteres.');
        return false;
    }

    if (!validarLongitud(apellido, 1, 20)) {
        alert('Este campo debe contener un máximo de 20 caracteres.');
        return false;
    }

    if (!validarEmail(email)) {
        alert('Debe ingresar una dirección de correo electrónico válida.');
        return false;
    }

    alert('Sus datos han sido completados correctamente.');
    return true;
}
