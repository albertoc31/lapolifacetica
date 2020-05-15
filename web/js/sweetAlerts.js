function confirmaBorrar(path,user) {
    swal({
        title: "¿Estás seguro?",
        text: "Una vez borrado no vas a poder recuperar al usuario " + user,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("Hecho! El usuario ha sido borrado!", {
                    icon: "success",
                });
                window.location.replace(path);
            } else {
                swal("Dejamos a salvo este usuario!");
            }
        });
}

function confirmaCatAdd() {
    var cat = $('#nuevaCat').val();

    var api_key = $('#api_key').val();

    if (api_key != undefined && api_key != '') {
        if (cat != '') {
            swal({
                title: "¿Estás seguro?",
                text: "Esta acción va a crear la categoría " + cat + " definitivamente",
                icon: 'warning',
                buttons: true,
            })
                .then((createCat) => {
                    if (createCat) {
                        insertCat(cat);
                    } else {
                        swal("No se ha insertado ninguna categoría!");
                        return false;
                    }
                });
        }
    } else {
        // mostramos alerta
        NoApiKeyCatAdd();
    }
}

function failCatAdd(cat) {
    swal({
        title: "Error inesperado!",
        text: "Ha habido un fallo al crear la categoría " + cat + ". Vuelve a intentarlo!",
        icon: "error"
    })
}

function NoApiKeyCatAdd() {
    swal({
        title: "No tienes Api Key!",
        text: "Antes de poder crear una categoría necesitas tener una Api Key. Contacta con el webmaster.",
        icon: "error"
    })
}