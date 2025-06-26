<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("Funcoes/auth_helper.php");
require_once("COre/Configuracoes.php");

check_login();

$stmt = $pdo->query("SELECT * FROM autores ORDER BY nome ASC;");
$result = $stmt->fetchAll();
?>
<h1>Listar usuários</h1>

<div style="margin: 20px">
    <a href="paginas?page=usuario/Usuario" class="btn btn-add" target="_blank"> + Adicionar Novo Autor</a>
</div>

<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result) {
            foreach ($result as $linha) {
        ?>
                <tr>
                    <td><a href="paginas?page=usuario/Usuario&id=<?= htmlspecialchars($linha['id'], ENT_QUOTES, 'UTF-8') ?>" target="_blank"><?= htmlspecialchars($linha['nome'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                    <td><?= htmlspecialchars($linha['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($linha['telefone'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($linha['status'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a href="#" class="btn btn-del" onclick="confirmarExclusao(<?= $linha['id']; ?>)">Excluir</a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            language: {
                url: "<?= DOMINIO ?>Js/pt-BR.json"
            },
            paging: true,
            searching: true,
            ordering: true
        });
    });

    function confirmarExclusao(id) {
        Swal.fire({
            title: 'Tem certeza da exclusão?',
            text: 'Você não poderá reverter a exclusão!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/Aula_6_A/Funcoes/usuario.php?id=" + id;
            }
        });
    }
</script>

<style>
    .btn-del {
        color: white !important;
        text-decoration: none;
    }

    .btn-del:hover {
        color: white !important;
        text-decoration: none;
    }
</style>