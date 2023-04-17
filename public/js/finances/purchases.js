window.addEventListener('load', function() {
//Obtiene todos los botones con la clase borrar y les añade un evento click en el que hacen un fetch a la ruta api/delete
    var btnsBorrar = document.getElementsByClassName('borrar');
    for (var i = 0; i < btnsBorrar.length; i++) {
        btnsBorrar[i].addEventListener('click', function (e) {
            e.preventDefault();
            //Obtiene el padre de su padre
            var id = this.parentNode.parentNode.id;

            fetchFinance(null, 'DELETE', '/api/purchases/' + id).then(function (data) {
                if (data.status == 204) {
                    document.getElementById(id).remove();
                }
            });
        });
    }
    //Obtiene todos los botones con la clase editar y les añade un evento click en el que hacen un fetch a la ruta api/edit
    var btnsEditar = document.getElementsByClassName('modificar');
    for (var i = 0; i < btnsEditar.length; i++) {
        btnsEditar[i].addEventListener('click', function (e) {
            e.preventDefault();
            var id = this.getAttribute('data-id');
            fetchFinance('id=' + id, 'GET', '/api/finances').then(function (data) {
                if (data.status == 200) {
                    var finance = data.finance;
                    document.getElementById('id').value = finance.id;
                    document.getElementById('concept').value = finance.concept;
                    document.getElementById('amount').value = finance.amount;
                    document.getElementById('date').value = finance.date;
                    document.getElementById('type').value = finance.type;
                }
            });
        });
    }
}
);

