<?php
require_once("../../Core/conn.php");
$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY nome ASC;");
$result = $stmt->fetchAll();
// echo "<pre>";
// print_r($result);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar usuários</title>
    <link rel="stylesheet" href="../../Css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Css/jquery.dataTables.min.css">
</head>
<body>
    <h1>Listar usuários</h1>

    <div style="margin: 20px">
        <a href="#" class="btn btn-add" target="_blank"> + Adicionar Novo Usuário</a>
    </div>

    <table id="example" class="display" style="width:100">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- validando se existe usuário em meu banco de dados -->
            <?php if ($result) { 
            //    perrcorendo a tabela usuário em meu banco de dados
               foreach ($result as $linha) {    
            ?>
            <tr>
                <td><a href="usuario.php?id=<?= $linha['id']?>" target="_blank"><?= $linha['nome']; ?></a></td>
                <td><?= $linha['email']; ?></td>
                <td><?= $linha['status']; ?></td>
                <td>                    
                    <a href="#" class="btn btn-danger" 
                        onclick="confirmarExclusao(<?= $linha['id']; ?>)">Excluir</a>
                </td>
            </tr>
            <?php } 
               }
            ?>
        </tbody>
    </table>
    <script src="../../Js/jquery-3.7.1.js"></script>
    <script src="../../Js/bootstrap.min.js"></script>
    <script src="../../Js/jquery.dataTables.min.js"></script>
    <script src="../../Js/popper.min.js"></script>
    <script src="../../Js/sweetalert2@11"></script>
    <script src="../../Js/sweetalert2@11.js"></script>
<script>

$(document).ready(function() {
    $('#example').DataTable({
        language:{
            url: 'http://localhost/16-05-2025/Js/pt-BR.json',
        },
        pagin: true,
        searching: true,
        ordering: true

    });
});

  function confirmarExclusao(id){
      Swal.fire({
        title:'Tem certeza da exclusão?',
        text: 'Você não poderá reverter a exclusão!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
          if (result.isConfirmed) {
             window.location.href="/Aula_6_A/Funcoes/usuario.php?id=" + id;
          }
       
      });
    }
</script>
<style>
    /* Estilo do botão ADD */
    .btn-add {
        padding: 10px 15px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 4px;
    }

    .btn-add:hover {
        background-color: #218838;
    }

    /* Links da tabela */
    #example a {
        color: #007b77;
        text-decoration: none;
    }

    #example a:hover{
        text-decoration: underline;
    }
</style>
</body>
</html>