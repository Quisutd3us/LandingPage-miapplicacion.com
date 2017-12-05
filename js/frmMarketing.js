// Formulario Marketing

$('#frmMarketing').submit(function(event){
    event.preventDefault();
    enviarMkt();
});

function enviarMkt(){
    var datosMkt= $('#frmMarketing').serialize();
    $.ajax({
        type:"post",
        url:"php/formularioMkt.php",
        data: datosMkt,
        success: function(textomkt){
            console.log(textomkt);
            if(textomkt==1){
                bienMkt();
            }else{
                malMkt(textomkt);
            }
        }
    });
}

function bienMkt() {
    $('#msgMktExitoso').removeClass('d-none');
    $('#msgMktError').addClass('d-none');

}

function malMkt(textomkt) {
    $('#msgMktError').removeClass('d-none');
    $('#msgMktError').html(textomkt);

}