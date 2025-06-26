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
  <title>Cadastro de Noticias</title>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <h2 class="mb-4"><?= $tipoAcao ?></h2>
        <form id="formCadastro">
          <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
          <input type="hidden" name="id_noticia" id="id_notica" value="<?= $result['id'] ?? 0; ?>">
          <div class="mb-3">
            <label for="nomeCompleto" class="form-label">Nome Autor</label>
            <input type="text" class="form-control" id="nomeAutor" name="nomeAutor" value="<?= $result['autor_id'] ?? ''; ?>">
          </div>


          <div class="mb-3">
            <label for="titulo" class="form-label">Titulo</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $result['titulo'] ?? ''; ?>">
          </div>

        <div class="mb-3">
            <label for="resumo" class="form-label">Resumo</label>
            <input type="text" class="form-control" id="resumo" name="resumo" value="<?= $result['resumo'] ?? ''; ?>">
        </div>
        

        <div class="mb-3">
            <label for="noticia" class="form-label">Noticia</label>
            <input type="text" class="form-control" id="noticia" name="noticia" value="<?= $result['noticia'] ?? ''; ?>">
        </div>

        <div class="mb-3">
            <label for="data_cadastro" class="form-label">Data Cadastro</label>
            <input type="date" class="form-control" id="data_cadastro" name="data_cadastro" value="<?= $result['data_cadastro'] ?? ''; ?>">
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
        url: "/Aula_6_A/Funcoes/noticia",
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