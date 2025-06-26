<?php
  require_once("../../Core/conn.php");
  $id = $_GET['id'] ?? ""; // IF ternário
  // $id = (!empty($_GET['id'])) ? 0 : intVal($_GET['id']);

  if (!empty($id)){
    // Recuperando o usuário para edição
    $sql= "SELECT * FROM usuarios WHERE id = {$id}";
    $smtp = $pdo->query($sql);
    $result = $smtp->fetch();

    if ($result){
      echo "Editando o usuário {$result['nome']}";

    } else {
      echo "usuário não localizado!";
    }

  } else {
    echo "Inserindo um novo usuário";
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Usuários</title>
  <link href="../../Css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <h2 class="mb-4">Cadastro de Usuários</h2>
        <form id="formCadastro">
          <div class="mb-3">
            <label for="nomeCompleto" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
          <div class="mb-3">
            <label for="tipoUsuario" class="form-label">Tipo de Usuário</label>
            <select class="form-select" id="tipoUsuario" name="tipoUsuario">
              <option value="0">Selecione</option>
              <option value="1">Usuário Comum</option>
              <option value="2">Administrador</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha">
          </div>
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


  <script>;
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
