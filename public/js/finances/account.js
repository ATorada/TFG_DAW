window.addEventListener('load', function () {
    /* //Al editar el p de usuario/email y darle a enter, se hace un fetch para editar el usuario
        const email = document.getElementById('email');
        const usuario = document.getElementById('usuario');

        //Si se le da al boton de id editar, se hace un fetch para editar el usuario
        const editarUsuario = document.getElementById('editarUsuario');
        if (editarUsuario) {
            editarUsuario.addEventListener('click', function (e) {
                e.preventDefault();
                fetchFinance('email=' + email.textContent + '&name=' + usuario.textContent, 'PUT', '/api/users').then(function (data) {
                    console.log(data);
                });
            });
        } */

    //El boton editarModal abre el modal para editar el usuario
    const editarModal = document.getElementById('editarModal');
    if (editarModal) {
        editarModal.addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('modal').style.display = 'block';
            span = document.getElementsByClassName('close')[0];
            span.addEventListener('click', function (e) {
                e.preventDefault();
                document.getElementById('modal').style.display = 'none';
            } );
        });
    }

    //Cuando se le de al boton de editar se envia un fetch para editar el usuario
    const editarUsuario = document.getElementById('editar');

    if (editarUsuario) {
        editarUsuario.addEventListener('click', function (e) {
            e.preventDefault();
            //Se pasa el formdata
            var form = document.getElementsByTagName('form')[0];
            var formData = new FormData(form);
            var data = new URLSearchParams(formData);
            //Si el valor del form está vacio se elimina de data
            for (var i = 0; i < form.length; i++) {
                if (form[i].type != 'submit' && form[i].type != 'file') {
                    if (!form[i].value) {
                        data.delete(form[i].name);
                    }
                }
            }
/*             if (!form.image.value) {
                data.delete('image');
            } else {
                data.set('image', form.image.files[0]);
            } */
            fetch('/api/user', {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                body: data
            }).then(function (response) {
                if (response.status == 200) {
                    document.getElementById('modal').style.display = 'none';
                    response.json().then(function (result) {
                        console.log(result.email);
                        document.getElementById('correo').textContent = result.email;
                        document.getElementById('usuario').textContent = result.user;
                        //Si se ha cambiado la imagen, se cambia el src de id=imagen por el nuevo src
/*                         if (formData.get('imagen')) {
                            img.src = 'http://81.203.93.98/storage/users/' + result.id;
                        } */
                        form.reset();
                        //Oculta todos los p de errores
                        var errores = document.getElementsByClassName('error');
                        for (var i = 0; i < errores.length; i++) {
                            errores[i].style.display = 'none';
                        }
                        //Elimina la clase errorInput de todos los inputs
                        var inputs = document.getElementsByTagName('input');
                        for (var i = 0; i < inputs.length; i++) {
                            inputs[i].classList.remove('errorInput');
                        }
                    });
                } else {
                    throw response.json();
                }
            }).catch(function (error) {
                error.then(function (data) {
                    if(!data.errors){
                        //Le añade errors con {'user':'', 'email':'', 'password':''};
                        data.errors = {};
                        data.errors.user = 'nodata'
                        data.errors.email = 'nodata';
                        data.errors.password = 'nodata';
                        throwErrorsUI(data);
                    } else {
                        throwErrorsUI(data);
                    }
                });
            });
        });
    }
});
