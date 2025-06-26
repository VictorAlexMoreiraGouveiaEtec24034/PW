<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

require_once("Funcoes/csrf_helper.php");
require_once("Funcoes/auth_helper.php");

check_login();

// Verificando se a variável id existe na url.
$id = $_GET['id'] ?? ''; // Realizando um if ternário

$result = [];

$tipoAcao = "";

if (!empty($id)) {
  $tipoAcao =  "Editando o usuário: {$id}";

  $stmt = $pdo->query("select * from usuarios where id = {$id};");

  $result = $stmt->fetch();

  if (!$result) {
    $tipoAcao =  "Usuário não localizado!!!";
  }
} else {
  $tipoAcao =  "Inserindo um novo usuário";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Usuários</title>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <h2 class="mb-4"><?= $tipoAcao ?></h2>
        <form id="formCadastro">
          <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
          <input type="hidden" name="id_usuario" id="id_usuario" value="<?= $result['id'] ?? 0; ?>">
          <div class="mb-3">
            <label for="nomeCompleto" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" value="<?= $result['nome'] ?? ''; ?>">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $result['email'] ?? ''; ?>">
          </div>
          <div class="mb-3">
            <label for="tipoUsuario" class="form-label">Tipo de Usuário</label>
            <select class="form-select" id="tipoUsuario" name="tipoUsuario">
              <option value="">Selecione</option>
              <option value="0" <?= (!empty($result['tipoUsuario']) && $result['tipoUsuario'] == "0") ? "selected" : ""; ?>>Usuário Comum</option>
              <option value="1" <?= (!empty($result['tipoUsuario']) && $result['tipoUsuario'] == "1") ? "selected" : ""; ?>>Administrador</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha">
          </div>
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
              <option value="">Selecione</option>
              <option value="A" <?= (!empty($result['status']) && $result['status'] == "A") ? "selected" : ""; ?>>Ativo</option>
              <option value="I" <?= (!empty($result['status']) && $result['status'] == "I") ? "selected" : ""; ?>>Inativo</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary"> <?= (!empty($id))  ? "Editar" : "Cadastrar"; ?> </button>
        </form>
      </div>
    </div>
    <div id="response"></div>
  </div>

  <script>
    $("#formCadastro").submit(function(event) {
      var ajaxRequest;
      event.preventDefault();
      $("#response").html('');
      var values = $(this).serialize();
      ajaxRequest = $.ajax({
        url: "/Aula_6_A/Funcoes/usuario",
        type: "post",
        data: values,
        beforeSend: function() {
          mostraAnimacao();
        }
      });
      ajaxRequest.done(function(response, textStatus, jqXHR) {
        ocultaAnimacao();
        var jsonResponse = JSON.parse(response); // Parseia a resposta JSON
        if ('redirect' in jsonResponse) {
          window.location.href = jsonResponse.redirect;
        } else {
          if (jsonResponse.status === "success") {
            $("#response").html(jsonResponse.message);
            $("#formCadastro").trigger("reset");
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