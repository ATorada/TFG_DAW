window.addEventListener('load', function() {
    //Obtiene el primer boton con la clase añadir y hace una peticion para crear un household
    var integrantes = document.getElementById('integrantes');
    integrantes.style.height = "auto";
    var btnAdd = document.getElementById('crear');
    btnAdd.onclick = function (e) {
        e.preventDefault();
        fetchFinance(null, 'POST', '/api/households').then(function (data) {
            //Muestra unidad y oculta no-unidad
            document.getElementById('unidad').style.display = "block";
            document.getElementById('no-unidad').style.display = "none";

            document.getElementById('uuid').innerHTML = data.uuid;
            //Obtiene los integrantes del household /api/households/members
            fetchFinance(null, 'GET', '/api/households/members').then(function (data) {
                var members = data;

                integrantes.innerHTML = "";
                integrantes.style.height = "auto";
/*                 for (var i = 0; i < members.length; i++) {
                    var span = document.createElement('span');
                    var img = document.createElement('img');
                    img.src = "../img/account_placeholder.png";
                    img.alt = "";
                    span.appendChild(img);
                    integrantes.appendChild(span);
                } */
                //Pone sus nombres en vez de su foto
                for (var i = 0; i < members.length; i++) {
                    var span = document.createElement('span');
                    span.innerHTML = members[i];
                    integrantes.appendChild(span);
                }
            });

            //Obtiene el balance /api/households/balance en income modifica un texto de id income y un texto de id expenses
            fetchFinance(null, 'GET', '/api/households/balance').then(function (data) {
                document.getElementById('income').innerHTML = data.income;
                document.getElementById('expenses').innerHTML = data.expenses;
            }
            );
        });
    }

    //AL boton de clase borrar le añade un evento para /api/user/leavehousehold
    var btnBorrar = document.getElementsByClassName('borrar')[0];
    btnBorrar.onclick = function (e) {
        e.preventDefault();
        fetchFinance(null, 'DELETE', '/api/user/leavehousehold').then(function (data) {
            //Muestra no-unidad y oculta unidad
            document.getElementById('unidad').style.display = "none";
            document.getElementById('no-unidad').style.display = "block";
        } );
    }

    //Al boton de unirseModal le añade para abrir el modal
    var btnUnirseModal = document.getElementById('unirseModal');
    btnUnirseModal.onclick = function (e) {
        e.preventDefault();
        document.getElementById('modal').style.display = "block";
        span = document.getElementsByClassName("close")[0];
        span.onclick = function () {
            modal.style.display = "none";
        }

    }

    //Al boton de id unirse le añade un evento para /api/households/join/uuid
    var btnUnirse = document.getElementById('unirse');
    btnUnirse.removeEventListener('click', btnUnirse.onclick);
    btnUnirse.onclick = function (e) {
        e.preventDefault();
        //Obtiene el uuid del formulario
        var form = document.getElementsByTagName('form')[0];
        var uuid = form.elements[0].value;

        fetchFinance(null, 'POST', '/api/households/join/' + uuid).then(function (data) {
            //Limia el form y oculta el modal
            form.reset();
            document.getElementById('modal').style.display = "none";
            //Muestra unidad y oculta no-unidad
            document.getElementById('unidad').style.display = "block";
            document.getElementById('no-unidad').style.display = "none";

            document.getElementById('uuid').innerHTML = uuid;

            //Obtiene los integrantes del household /api/households/members
            fetchFinance(null, 'GET', '/api/households/members').then(function (data) {
                var members = data;

                integrantes.innerHTML = "";
                integrantes.style.height = "auto";
/*                 for (var i = 0; i < members.length; i++) {
                    var span = document.createElement('span');
                    var img = document.createElement('img');
                    img.src = "../img/account_placeholder.png";
                    img.alt = "";
                    span.appendChild(img);
                    integrantes.appendChild(span);
                } */
                //Pone sus nombres en vez de su foto
                for (var i = 0; i < members.length; i++) {
                    var span = document.createElement('span');
                    span.innerHTML = members[i];
                    integrantes.appendChild(span);
                }
            });

            //Obtiene el balance /api/households/balance en income modifica un texto de id income y un texto de id expenses
            fetchFinance(null, 'GET', '/api/households/balance').then(function (data) {
                document.getElementById('income').innerHTML = data.income;
                document.getElementById('expenses').innerHTML = data.expenses;
            });

            //Oculta el mensaje de error
            var error = document.getElementsByClassName('error')[0];
            error.style.display = "none";
            form.elements[0].classList.remove('errorInput');

        }).catch(function (err) {
            //Si el uuid no es valido muestra un mensaje de error
            var error = document.getElementsByClassName('error')[0];
            error.style.display = "block";
            //Pinta el input de rojo
            form.elements[0].classList.add('errorInput');
        });
    }

});
