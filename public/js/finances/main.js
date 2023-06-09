//Variables globales
var url = window.location.href.split("/")[0] + "//" + window.location.href.split("/")[2];
let modal = null;
let table = null;
let form = null;
var elementoSeleccionado = null;
let json = null;

/**
 * Función que crea un elemento checkbox
 * @param {string} id
 * @param {boolean} checked
 * @returns {Element}
 */
function createCheckbox(id, checked) {
    var input = document.createElement('input');
    input.type = 'checkbox';
    input.name = id;
    input.id = id;
    input.checked = checked ? 1 : 0;
    input.classList.add('checkbox');
    input.addEventListener('click', function (e) {
        try {
            editElement(this, this.name, this.checked ? 1 : 0);
        } catch (error) { }
    });
    return input;
}

/**
 * Función que edita un elemento
 * @param {Element} element
 * @param {string} name
 * @param {string} value
 * @returns {void}
 * @throws {Error}
 */
function editElement(element, name, value) {
    var id = element.parentNode.parentNode.getElementsByTagName('td')[0].innerHTML;
    fetchFinance(name + '=' + value, 'PUT', '/api/finances/' + id).then(function (data) {
        //Muestra un mensaje de éxito
        var row = element.parentNode.parentNode;
        row.classList.add('nuevo');
        setTimeout(function () {
            row.classList.remove('nuevo');
        }, 1000);
    }).catch(function (error) {
        //Muestra un mensaje de error
        var row = element.parentNode.parentNode;
        row.classList.add('fallo');
        setTimeout(function () {
            row.classList.remove('fallo');
        }, 1000);
        try {
            error.then(function (data) {
                console.log(data);
            });
        } catch (e) {
            console.log(error);
        }
    });
}

/**
 * Función que crea eventos a los elementos
 * @param {string} elementType
 * @param {string} eventName
 * @param {function} callback
 * @returns {void}
 * @throws {Error}
 */
function addEventToElements(elementType, eventName, callback) {
    try {
        var elements = document.getElementsByTagName(elementType);
        for (var i = 0; i < elements.length; i++) {
            if (elementType == 'input' && elements[i].type != 'checkbox') continue;
            elements[i].addEventListener(eventName, callback);
        }
    } catch (error) {
        console.log(error);
    }
}

/**
 * Función que crea un elemento input
 * @param {string} id
 * @param {string} value
 * @returns {Element}
 * @throws {Error}
 */
async function fetchFinance(data, method, route) {
    return fetch(url + route, {
        method: method,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'authorization': 'Bearer ' + localStorage.getItem('token')
        },
        body: data,
    }).then(function (response) {
        if (response.status == 201 || response.status == 200) {
            return response.json();
        }
        else if (response.status == 204) {
            return response;
        }
        throw response.json();
    })
}

/**
 * Función que añade una fila a la tabla
 * @param {Object} data
 * @returns {void}
 * @throws {Error}
 * @todo Eliminar el try catch
 */
function addRowToTable(data) {
    try {
        //Obtiene el tr del tbody, si tiene un atributo colspan es que no hay datos entonces lo elimina
        if (table.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('td')[0].getAttribute('colspan') != null) {
            table.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].remove();
        }
    } catch (error) { }

    //Elimina los campos que no se van a mostrar
    var row = table.getElementsByTagName('tbody')[0].insertRow(-1);
    delete data.is_income;
    delete data.period;
    delete data.id_user
    delete data.created_at;
    delete data.updated_at;
    if (data.category == null) {
        delete data.category;
    }

    let id = data.id;
    delete data.id;

    //Dependiendo de si es un gasto o un ingreso se hace de una manera u otra
    var keys = ['name', 'amount', 'category', 'constant', 'compute_household'];
    if (data['category'] == null) {
        keys = ['name', 'amount', 'constant', 'compute_household'];
    }
    for (var i = 0; i < keys.length; i++) {
        if (keys[i] == 'category') {
            //Crea un select con las categorias
            var select = document.createElement('select');
            select.name = keys[i];
            select.id = keys[i];
            select.classList.add('select');
            select.addEventListener('change', function (e) {
                try {
                    editElement(this, this.name, this.value);
                } catch (error) { }
            });

            var options = ['alimentacion', 'vivienda', 'transporte', 'ocio', 'comunicaciones', 'salud', 'educacion', 'otros'];
            if (json.Idioma == 'es') {
                var optionsNames = ['Alimentación', 'Vivienda', 'Transporte', 'Ocio', 'Comunicaciones', 'Salud', 'Educación', 'Otros'];
            } else if (json.Idioma == 'en') {
                var optionsNames = ['Food', 'Housing', 'Transport', 'Leisure', 'Communications', 'Health', 'Education', 'Others'];
            } else if (json.Idioma == 'de') {
                var optionsNames = ['Lebensmittel', 'Wohnung', 'Transport', 'Freizeit', 'Kommunikation', 'Gesundheit', 'Bildung', 'Andere'];
            }
            for (var j = 0; j < options.length; j++) {
                var option = document.createElement('option');
                option.value = options[j];
                option.innerHTML = optionsNames[j];
                if (options[j] == data[keys[i]]) {
                    option.selected = true;
                }
                select.appendChild(option);
            }

            var cell = row.insertCell(i);
            cell.appendChild(select);
            continue;
        }
        var cell = row.insertCell(i);
        if (keys[i] == 'amount') {
            data[keys[i]] = parseFloat(data[keys[i]]).toFixed(2);
        }
        if (keys[i] == 'constant' || keys[i] == 'compute_household') {
            cell.appendChild(createCheckbox(keys[i], data[keys[i]]));
        } else {
            cell.innerHTML = data[keys[i]];
        }
        createEventListeners();
    }

    var cell = row.insertCell(0);
    cell.id = id;
    cell.hidden = true;
    cell.innerHTML = id;

    row.classList.add('nuevo');

    setTimeout(function () {
        row.classList.remove('nuevo');
    }, 5000);

}

/**
 * Función que atualiza la interfaz
 * @returns {void}
 * @throws {Error}
 */
function updateUI() {

    form.reset();
    modal.style.display = "none";
    let toast = document.getElementsByClassName('toast')[0];
    toast.classList.add('show');

    setTimeout(function () {
        toast.classList.remove('show');
    }, 3000);

    var table = document.getElementsByTagName('table')[0];
    var lastRow = table.rows.length - 1;
    var lastCell = table.rows[lastRow].cells.length - 1;
    table.rows[lastRow].cells[lastCell].scrollIntoView();

    for (var i = 0; i < form.length; i++) {
        if (form[i].type != 'submit') {
            form[i].classList.remove('errorInput');
            try {
                hideError(form[i].name);
            } catch (error) { }
        }
    }

    //Si la tabla es id tabla-gastos, se actualiza el dinero total
    if (table.id == 'tabla-gastos') {
        let total = document.getElementById('dineroTotal');
        //Obtiene la cantidad de la ultima celda de la ultima fila
        let amount = table.rows[table.rows.length - 1].cells[table.rows[table.rows.length - 1].cells.length - 2].innerHTML;
        total.innerHTML = parseFloat(total.innerHTML) - parseFloat(amount);
    }

}

/**
 * Función que muestra un error en un campo
 * @param {String} name
 * @param {Boolean} checked
 * @returns {Element}
 * @throws {Error}
 */
function showError(name) {
    document.querySelector('[data-name=' + name + ']').style.display = "block";
}

/**
 * Función que oculta un error en un campo
 * @param {String} name
 * @returns {Element}
 * @throws {Error}
 * @returns {void}
 */
function hideError(name) {
    document.querySelector('[data-name=' + name + ']').style.display = "none";
}

/**
 * Función que lanza los errores de la API
 * @param {Object} data
 * @returns {void}
 * @throws {Error}
 * @returns {void}
 */
function throwErrorsUI(data) {
    if (data.errors) {
        for (var i = 0; i < form.length; i++) {
            if (form[i].type != 'submit') {
                if (data.errors[form[i].name]) {
                    form[i].classList.add('errorInput');
                    try {
                        showError(form[i].name);
                    } catch (error) { }
                } else {
                    form[i].classList.remove('errorInput');
                    try {
                        hideError(form[i].name);
                    } catch (error) { }
                }
            }
        }
    } else {
        form.name.classList.add('errorInput');
        showError('name');
        for (var i = 1; i < form.length; i++) {
            if (form[i].type != 'submit') {
                form[i].classList.remove('errorInput');
                try {
                    hideError(form[i].name);
                } catch (error) { }
            }
        }
        if (data.error.includes('(5)')) {
            document.querySelector('#limite').style.display = "block";
            hideError('name');
            form.name.classList.remove('errorInput');
        }
    }
}

/**
 * Función que crea los event listeners para borrar
 * @returns {void}
 * @throws {Error}
 */
function createEventListeners() {
    document.querySelectorAll('tbody tr').forEach(function (tr) {
        //Si el tr tiene un colspan de 5 o 6 no se le añade el evento
        try {
            if (tr.cells[0].colSpan == 5 || tr.cells[0].colSpan == 6) {
                return;
            }
        } catch (error) { }

        if (!tr.onclick) {
            tr.addEventListener('click', function (e) {
                if (e.target.nodeName == 'INPUT' || e.target.nodeName == 'TD' && e.target.colSpan == 5 || e.target.nodeName == 'TD' && e.target.colSpan == 6) {
                    return;
                }
                if (elementoSeleccionado) {
                    elementoSeleccionado.classList.remove('table-selected');
                }
                elementoSeleccionado = this;
                this.classList.add('table-selected');
                //Activa el boton de borrar
                document.querySelector('#borrar').disabled = false;
                document.querySelector('#borrar').classList.remove('disabled');
            });
        }
    });
}

//Añade un key listener, si se presiona escape se deselecciona el elemento seleccionado
document.addEventListener('keydown', function (e) {
    if (e.key == 'Escape') {
        if (elementoSeleccionado) {
            elementoSeleccionado.classList.remove('table-selected');
            elementoSeleccionado = null;
            document.querySelector('#borrar').disabled = true;
            document.querySelector('#borrar').classList.add('disabled');
        }
    }
});


window.addEventListener('load', function () {
    //Obtiene los elementos del DOM
    table = document.getElementsByTagName('table')[0];
    form = document.getElementsByTagName('form')[0];
    modal = document.getElementsByClassName('modal')[0];
    const span = document.getElementsByClassName("close")[0];
    const modalOpenBtn = document.getElementById('añadir');
    const enviar = document.getElementsByClassName('añadir')[0];

    let titulo = document.getElementById('titulo').getElementsByTagName('h1')[0].innerHTML;
    if (titulo == "Ingresos" || titulo == "Gastos" || titulo == "Compras Grandes") {
        json = {
            "Idioma": "es",
            "Total": "Total: ",
            "DineroMes": "€/mes",
            "Ingresos": "No hay ingresos",
            "Gastos": "No hay gastos",
            "Borrar": "Borrar",
        };
    } else if (titulo == "Income" || titulo == "Expenses" || titulo == "Purchases") {
        json = {
            "Idioma": "en",
            "Total": "Total:",
            "DineroMes": "€/month",
            "Ingresos": "No income",
            "Gastos": "No expenses",
            "Borrar": "Delete",
        };
    } else if (titulo == "Einkommen" || titulo == "Ausgaben" || titulo == "Großeinkäufe") {
        json = {
            "Idioma": "de",
            "Total": "Gesamt:",
            "DineroMes": "€/Monat",
            "Ingresos": "Kein Einkommen",
            "Gastos": "Keine Ausgaben",
            "Borrar": "Löschen",
        };
    }
    // Añadir evento a los inputs
    addEventToElements('input', 'click', function (e) {
        try {
            editElement(this, this.name, this.checked ? 1 : 0);
        } catch (error) { }
    });

    // Añadir evento a los selects
    addEventToElements('select', 'change', function (e) {
        try {
            editElement(this, this.name, this.value);
        } catch (error) { }
    });

    // Se encarga de añadir el cerrar y el abrir del modal
    if (modalOpenBtn) {
        modalOpenBtn.addEventListener('click', function (e) {
            e.preventDefault();
            modal.style.display = "block";
        });
        span.onclick = function () {
            modal.style.display = "none";
        }
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Se encarga de obtener los datos del formulario y enviarlos
    try {
        if (enviar && enviar.textContent == 'Añadir' || enviar.textContent == 'Add' || enviar.textContent == 'Hinzufügen') {
            enviar.addEventListener('click', async function (e) {
                e.preventDefault();
                const data = new URLSearchParams(new FormData(form));
                if (!form.image) {
                    data.delete('image');
                } else {
                    data.set('image', form.image.files[0]);
                }

                //Si data tiene period, es una compra grande
                if (!data.has('period')) {
                    await fetchFinance(data, 'POST', '/api/finances')
                        .then(function (data) {
                            addRowToTable(data);
                            updateUI();
                        })
                        .catch(function (error) {
                            console.log(error);
                            error.then(function (data) {
                                throwErrorsUI(data);
                            });
                        });
                } else {
                    const data = new FormData(form);
                    fetch('/api/purchases', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        },
                        body: data
                    })
                        .then(function (data) {
                            if (data.ok) {
                                data.json().then(function (data) {
                                    const div = document.createElement('div');
                                    div.classList.add('compra-grande');

                                    const img = document.createElement('img');
                                    //Si el form tenía una imagen, la añade, sino, pone una por defecto

                                    if (!form.image.value) {
                                        img.src = '../img/comprasgrandes/compragrande_placeholder.png';
                                        img.alt = '';
                                    } else {
                                        img.src = 'http://81.203.93.98/storage/purchases/purchase_' + data.id + '.png';
                                    }

                                    const p1 = document.createElement('p');
                                    const span1 = document.createElement('span');
                                    span1.classList.add('titulo');
                                    let period = new Date(data.period);
                                    const today = new Date();
                                    span1.innerHTML = today.getFullYear() + "-" + (today.getMonth() + 1) + " - " + period.getFullYear() + '-' + (period.getMonth() + 1)
                                    p1.appendChild(span1);

                                    const p2 = document.createElement('p');
                                    const span2 = document.createElement('span');
                                    span2.classList.add('titulo');
                                    span2.innerHTML = data.name;
                                    span2.style.textDecoration = 'underline';
                                    p2.appendChild(span2);

                                    const br = document.createElement('br');

                                    const p3 = document.createElement('p');
                                    const span3 = document.createElement('span');
                                    span3.classList.add('titulo');
                                    span3.innerHTML = json.Total + ' ';
                                    const span4 = document.createElement('span');
                                    //Data amount pero en formato decimal 2
                                    let amount = Math.round(parseFloat(data.amount) * 100) / 100;
                                    span4.innerHTML = `0.00 / ${amount.toFixed(2)}€`;
                                    const span5 = document.createElement('span');
                                    span5.classList.add('titulo');
                                    span5.innerHTML = '<br>' + json.DineroMes + ': ';
                                    const span6 = document.createElement('span');
                                    //Obtiene la diferencia de mes entre la fecha de hoy a dia 1 y la fecha de la compra
                                    const date = new Date();
                                    const date2 = new Date(data.period);
                                    const diff = date2.getMonth() - date.getMonth();
                                    span6.innerHTML = `${(amount / diff).toFixed(2)}€`;
                                    p3.append(span3, span4, span5, span6);

                                    const div2 = document.createElement('div');
                                    div2.classList.add('botones');

                                    const button1 = document.createElement('button');
                                    button1.classList.add('borrar');
                                    button1.innerHTML = json.Borrar;
                                    button1.addEventListener('click', function (e) {
                                        e.preventDefault();
                                        div.remove();
                                        fetchFinance(null, 'DELETE', '/api/purchases/' + data.id);
                                    });

                                    div2.append(button1);
                                    div.append(img, p1, p2, br, p3, div2);
                                    document.querySelector('.main-content').appendChild(div);

                                    form.reset();
                                    modal.style.display = "none";
                                    document.querySelector('#limite').style.display = "none";
                                });
                            } else {
                                throw data.json();
                            }
                        })
                        .catch(function (error) {
                            error.then(function (data) {
                                throwErrorsUI(data);
                            });
                        });
                }
            });
        }
    }
    catch (error) {}

    // Se encarga de ponerle al boton de salir que borre el token del localStorage y las cookies
    document.querySelector('.salir a').addEventListener('click', function (e) {
        localStorage.removeItem('token');
        //Hace una peticion a la api de logout para que borre la cookie
        fetch('/api/logout', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })

    });

    //Si se hace click en el boton de borrado, borra el elemento seleccionado
    if (document.querySelector('#borrar')) {
        createEventListeners();
        document.querySelector('#borrar').addEventListener('click', function (e) {
            e.preventDefault();
            var id = elementoSeleccionado.firstElementChild.innerHTML;
            fetchFinance(null, 'DELETE', '/api/finances/' + id).then(function (data) {
                elementoSeleccionado.remove();
                elementoSeleccionado = null;
                document.querySelector('#borrar').disabled = true;
                document.querySelector('#borrar').classList.add('disabled');
                //Si era la ultima fila añade una fila vacia con "No hay ingresos/gastos" dependiendo de si tiene 5 o 6 columnas
                if (document.querySelector('#tabla-ingresos')) {
                    if (document.querySelectorAll('#tabla-ingresos tbody tr').length == 0) {
                        var tr = document.createElement('tr');
                        var td = document.createElement('td');
                        td.innerHTML = json.Ingresos;
                        td.style.fontWeight = 'bold';
                        td.colSpan = '5';
                        tr.appendChild(td);
                        document.querySelector('#tabla-ingresos tbody').appendChild(tr);
                    }
                }
                else {
                    if (document.querySelectorAll('#tabla-gastos tbody tr').length == 0) {
                        var tr = document.createElement('tr');
                        var td = document.createElement('td');
                        td.innerHTML = json.Gastos;
                        td.style.fontWeight = 'bold';
                        td.colSpan = '6';
                        tr.appendChild(td);
                        document.querySelector('#tabla-gastos tbody').appendChild(tr);
                    }
                }
            });
        });
    }
});



