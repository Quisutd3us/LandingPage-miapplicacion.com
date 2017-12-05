
// Formulario de contacto

$('#formulario').submit(function (event) {
    event.preventDefault();
    enviar();
})

function enviar() {
    var datos = $('#formulario').serialize(); //Toma los datos name y los lleva a un arreglo
    $.ajax({
        type: "post",
        url: "php/formulario.php",
        data: datos,
        success: function (texto) {
            if (texto == 1) {
                bien();
            } else {
                mal(texto);
            }
        }
    })
}

function bien() {
    $('#msgExitoso').removeClass('d-none');
    $('#msgError').addClass('d-none');

}

function mal(texto) {
    $('#msgError').removeClass('d-none');
    $('#msgError').html(texto);

}