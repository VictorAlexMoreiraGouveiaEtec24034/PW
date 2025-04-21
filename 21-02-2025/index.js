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

    ViewAnimation();

    /* Get from elements values */
    var values = $(this).serialize();

       ajaxRequest= $.ajax({
            url: "./arquivo.php",
            type: "get",
            data: values,
            beforeSend: function(){
                ViewAnimation()
           }
        });

   ajaxRequest.done(function (response, textStatus, jqXHR){
        NullAnimation();
             $("#response").html(response);            
    });

    ajaxRequest.fail(function (){ 
        NullAnimation();
        $("#response").html('Erro ao enviar os dados.');
    });
});