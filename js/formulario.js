
$('#formulario').submit(function (event) {
    event.preventDefault();
    enviar();
})

function enviar() {
    var datos = $('#formulario').serialize(); //Toma los datos name y los lleva a un arreglo
    $.ajax({
        type: "post",
        url: "formulario.php",
        data: datos,
        success: function (texto) {
            if (texto == 'exito') {
                correcto();
            } else {
                phperror(texto);
            }
        }
    })

    function correcto() {
        console.log('entro mtf');
        $('#mensajeExitoso').removeClass('d-none');
        $('#mensajeError').addClass('d-none');
    }

    function phperror(texto) {
        $('#mensajeError').removeClass('d-none');
        $('#mensajeError').html(texto);

    }
}