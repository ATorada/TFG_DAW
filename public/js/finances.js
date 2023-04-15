var url = window.location.href.split("/")[0] + "//" + window.location.href.split("/")[2];
//Crea una función  que le añade al id modal un formulario para agregar un nuevo ingreso
var modal = document.getElementsByClassName('modal')[0];

var span = document.getElementsByClassName("close")[0];

var btnAdd = document.getElementsByClassName('añadir')[1];
var enviar = document.getElementsByClassName('añadir')[0];


window.onload = function () {
    btnAdd.addEventListener('click', function (e) {
        e.preventDefault();
        modal.style.display = "block";
    });
    enviar.addEventListener('click', function (e) {
        e.preventDefault();
        var form = document.getElementsByTagName('form')[0];
        const data = new URLSearchParams(new FormData(form));
        console.log(data);
        fetch(url + '/api/finances', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            //Se le pasa todo el FormData pero como no
            body: data,
        }).then(function (response) {
            console.log(response);
        }).then(function (data) {
            console.log(data);
        }
        ).catch(function (error) {
            console.log(error);
        } );
    } );
}

span.onclick = function () {
    modal.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
