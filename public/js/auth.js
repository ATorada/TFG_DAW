// Este archivo obtiene los botones acceder y registrar y les añade un evento click
var url = window.location.href.split("/")[0] + "//" + window.location.href.split("/")[2];

window.onload = function () {
    var btnLogin = document.getElementById('acceder');
    var btnRegister = document.getElementById('registrar');
    if (btnLogin) {
        btnLogin.addEventListener('click', function (e) {
            e.preventDefault();
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var checkbox = document.getElementById('checkbox');

            //Hace una petición a api/login con los datos del formulario
                fetch(url + '/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password,
                        remember_me: checkbox.checked
                    })
                }).then(function (response) {
                    //Si la respuesta es correcta
                    if (response.status == 200) {
                        return response.json();
                    } else {
                        document.getElementById('email').classList.add('errorInput');
                        document.getElementById('password').classList.add('errorInput');
                        document.getElementsByClassName('error')[0].style.display = "block";
                    }
                }).then(function (data) {
                    //Obtiene el token y lo guarda en el localStorage
                    var token = data.token;
                    localStorage.setItem('token', token);
                    window.location.href = url + "/finances";
                }).catch(function (error) {
                });
        });
    }
    if (btnRegister) {
        btnRegister.addEventListener('click', function (e){
            e.preventDefault();
            var user = document.getElementById('user').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var password_confirmation = document.getElementById('password_confirmation').value;

            //Hace una petición a api/register con los datos del formulario
            fetch(url + '/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    user: user,
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation
                })
            }).then(function (response) {
                if (response.status == 201) {
                    window.location.href = url + "/finances";
                } else {
                    throw response.json();
                }
            }).then(function (data) {
            }).catch(function (error) {
                error.then(function (data) {
                    data = data.errors;
                    if (data.user) {
                        document.getElementById('user').classList.add('errorInput');
                    } else {
                        document.getElementById('user').classList.remove('errorInput');
                    }
                    if (data.email) {
                        document.getElementById('email').classList.add('errorInput');
                    } else {
                        document.getElementById('email').classList.remove('errorInput');
                    }
                    if (data.password) {
                        document.getElementById('password').classList.add('errorInput');
                        document.getElementById('password_confirmation').classList.add('errorInput');
                    } else {
                        document.getElementById('password').classList.remove('errorInput');
                        document.getElementById('password_confirmation').classList.remove('errorInput');
                    }
                });
            });
        });

    }
}
