/**
 * Función que calcula el ahorro en función del valor del slider
 * @returns {Number} ahorro
 */
function calcularAhorro() {
    var ahorro = document.getElementById('ahorroSlider').value * (parseFloat(dineroTotal.textContent) / 100);
    ahorro = ahorro.toFixed(2);
    return ahorro;
}

/**
 * Función que activa el formulario de añadir ahorro
 * @returns {void}
 */
function activateCreateAhorro() {
    ahorroActual.innerHTML = 0;
    dineroDisponible.innerHTML = dineroTotal.textContent;
    añadirAhorro.style.display = "block";
    editarAhorro.style.display = "none";
    borrarAhorro.classList.add('disabled');
    borrarAhorro.disabled = true;
    ahorroSlider.value = 0;
    ahorroSlider.nextElementSibling.value = 0 + '%';
}

/**
 * Función que activa el formulario de editar ahorro
 * @param {Object} data
 * @returns {void}
 */
function activateEditAhorro(data) {
    añadirAhorro.style.display = "none";
    editarAhorro.style.display = "block";
    borrarAhorro.style.display = "block";
    borrarAhorro.classList.remove('disabled');
    borrarAhorro.disabled = false;
    ahorroActual.innerHTML = ahorro;
    dineroDisponible.innerHTML = (parseFloat(dineroTotal.textContent) - ahorro).toFixed(2);
    ahorroSlider.setAttribute('data-id', data.id);
    ahorroSlider.value = 0;
    ahorroSlider.nextElementSibling.value = 0 + '%';
}


window.addEventListener('load', function () {

    const añadirAhorro = document.getElementById('añadirAhorro');
    const editarAhorro = document.getElementById('editarAhorro');
    const dineroTotal = document.getElementById('dineroTotal');
    const dineroDisponible = document.getElementById('dineroDisponible');
    const ahorroActual = document.getElementById('ahorroActual');
    const borrarAhorro = document.getElementById('borrarAhorro');
    const ahorroSlider = document.getElementById('ahorroSlider');

    if (dineroTotal.textContent < 0) {
        ahorroSlider.disabled = true;
        añadirAhorro.disabled = true;
        editarAhorro.disabled = true;
        borrarAhorro.disabled = true;
        //A los botones les pone un cursor no permitido, un tooltip y un color de fondo gris
        añadirAhorro.classList.add('disabled');
        editarAhorro.classList.add('disabled');
        borrarAhorro.classList.add('disabled');
    }

    //Si no hay ahorro se desabilita el boton de borrar
    if (ahorroActual.textContent == 0) {
        borrarAhorro.disabled = true;
        borrarAhorro.classList.add('disabled');
    }

    //Al cambiar el valor del slider, se calcula el ahorro y se muestra dinero disponible
    if (ahorroSlider) {
        ahorroSlider.addEventListener('input', function (e) {
            this.nextElementSibling.value = this.value + '%';
            ahorro = calcularAhorro();
            dineroDisponible.innerHTML = (parseFloat(dineroTotal.textContent) - ahorro).toFixed(2);
        });
    }

    //Al hacer click en añadir ahorro, se crea el ahorro
    if (añadirAhorro) {
        añadirAhorro.addEventListener('click', function (e) {
            e.preventDefault();
            var ahorro = calcularAhorro();
            if (ahorro > 0) {
                fetchFinance('name=ahorro&category=ahorro&is_income=0&amount=' + ahorro, 'POST', '/api/finances').then(function (data) {
                    activateEditAhorro(data);
                });
            }
        });
    }

    //Al hacer click en editar ahorro, se edita el ahorro
    if (editarAhorro) {
        editarAhorro.addEventListener('click', function (e) {
            e.preventDefault();
            var id = document.getElementById('ahorroSlider').getAttribute('data-id');
            var ahorro = calcularAhorro();
            if (ahorro > 0) {
                fetchFinance('name=ahorro&category=ahorro&is_income=0&amount=' + ahorro, 'PUT', '/api/finances/' + id).then(function (data) {
                    ahorroActual.innerHTML = ahorro;
                    dineroDisponible.innerHTML = (parseFloat(dineroTotal.textContent) - ahorro).toFixed(2);
                });
            } else {
                fetchFinance('name=ahorro&category=ahorro&is_income=0&amount=' + ahorro, 'DELETE', '/api/finances/' + id).then(function (data) {
                    activateCreateAhorro();
                });
            }
        });
    }

    //Al hacer click en borrar ahorro, se borra el ahorro
    if (borrarAhorro) {
        borrarAhorro.addEventListener('click', function (e) {
            e.preventDefault();
            var id = document.getElementById('ahorroSlider').getAttribute('data-id');
            fetchFinance('name=ahorro&category=ahorro&is_income=0&amount=' + ahorro, 'DELETE', '/api/finances/' + id).then(function (data) {
                activateCreateAhorro();
            });
        });
    }

});
