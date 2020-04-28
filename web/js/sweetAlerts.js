function confirmaBorrar(path,user) {
    swal({
        title: "Estás seguro?",
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