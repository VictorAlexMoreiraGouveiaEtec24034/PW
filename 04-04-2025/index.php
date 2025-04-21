<!-- login.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Adicione o link para o CSS do Bootstrap -->
    <link href="Css/bootstrap.min.css" rel="stylesheet">

    <!-- Adicionando Bibliotecas Java Script -->
    <script src="Js/bootstrap.min.js"></script>
    <script src="Js/popper.min.js"></script>
    <script src="Js/jquery-3.7.1.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Login</h2>
                    </div>
                    <div class="card-body">
                        <form id="form_1">
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuário:</label>
                                <input type="text" id="username" name="username" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha:</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Animação para o usuário ver que algo está acontecendo -->
                <div id="load" style="display:none; margin-top:10px">
                    Por favor aguarde...
                    <img src="loaders.svg?fill=maroon&ic=tail-spin"
                        style="width:24px">
                </div>
                <!-- Apresentação do  restorno -->
                <div id="response"></div>
            </div>
        </div>
    </div>

    <script>
        $("#form_1").submit(function(event) {
            var ajaxRequest;

            // Para a ação do form
            event.preventDefault();

            // Limpa a div response
            $("response").html('');

            // Pegando as variáveis do form
            var values = $(this).serialize();

            ajaxRequest = $.ajax({
                url: "process_login.php",
                type: "post",
                data: values,
                beforeSend: function() {
                    mostraAnimacao();
                }
            });

            // Tratamento para acertos
            ajaxRequest.done(function(response, textStatus, jqXHR) {
                ocultaAnimacao();
                // Imprime o retorno da requisição
                //$("#response").html(response);

                // Parseia a resposta JSON
                var jsonResponse = JSON.parse(response); // Parseia a resposta JSON

                if ('redirect' in jsonResponse) {
                    // Redireciona para a URL fornecida
                    window.location.href = jsonResponse.redirect;
                } else {
                    // Verifica o status e exibe a mensagem
                    if (jsonResponse.status === "success") {
                        $("#response").html(jsonResponse.message);
                    } else {
                        $("#response").html(jsonResponse.message);
                    }
                }

            });

            // Tratamento para erros
            ajaxRequest.fail(function() {
                ocultaAnimacao();
                // Imprime o retorno da requisição
                $("#response").html("Erro na requisição");
            });

        });



        function mostraAnimacao() {
            setTimeout(function() {
                $("#load").show();
            }, 200)
        }

        function ocultaAnimacao() {
            setTimeout(function() {
                $("#load").hide();
            }, 10)
        }
    </script>


</body>

</html>