window.addEventListener('load', function () {
    //Obtiene el input de id buscar y le añade un evento keyup en el que filtra la tabla para mostrar solo las compras que coincidan
    var inputBuscar = document.getElementById('buscar');
    inputBuscar.addEventListener('keyup', function (e) {
        var filter = inputBuscar.value.toUpperCase();
        var table = document.getElementsByTagName('table')[0];
        var tr = table.getElementsByTagName('tr');
        for (var i = 0; i < tr.length; i++) {
            var td = tr[i].getElementsByTagName('td');
            for (var j = 0; j < td.length; j++) {
                var cell = td[j];
                if (cell) {
                    if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }
    );
});
