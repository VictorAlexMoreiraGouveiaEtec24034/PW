function ViewAnimation() {
    setTimeout(function () {
        $("#load").show();
        }, 200)
}

function NullAnimation() {
    setTimeout(function () {
        $("#load").hide();
        }, 100)
}

/* Attach a submit handler to the form */
$("#form_1").submit(function(event) {
    var ajaxRequest;

    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear result div*/
    $("#response").html('');

    setTimeout(function() {
        $("#load").show();
    }, 200)

    /* Get from elements values */
    var values = $(this).serialize();

       ajaxRequest= $.ajax({
            url: "arquivo.php",
            type: "post",
            data: values,
            beforeSend: function(){
                mostraAnimacao()
           }
        });

   ajaxRequest.done(function (response, textStatus, jqXHR){
             ocultaAnimacao();
             $("#response").html(response);            
    });

    ajaxRequest.fail(function (){ 
        ocultaAnimacao();       
        $("#response").html('Erro ao enviar os dados.');
    });
});