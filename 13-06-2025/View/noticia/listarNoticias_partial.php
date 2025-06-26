<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("Funcoes/auth_helper.php");
require_once("COre/Configuracoes.php");

check_login();

$stmt = $pdo->query("SELECT * FROM noticias ORDER BY autor_id ASC;");
$result = $stmt->fetchAll();
?>
<h1>Listar noticias</h1>

<div style="margin: 20px">
    <a href="paginas?page=noticia/Noticia" class="btn btn-add" target="_blank"> + Adicionar Nova noticia</a>
</div>

<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>id</th>
            <th>autor_id</th>
            <th>titulo</th>
            <th>resumo</th>
            <th>noticia</th>
            <th>data_cadastro</th>
            <th>status</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result) {
            foreach ($result as $linha) {
        ?>
                <tr>
                    <td><a href="paginas?page=noticia/Noticia&id=<?= htmlspecialchars($linha['id'], ENT_QUOTES, 'UTF-8') ?>" target="_blank"><?= htmlspecialchars($linha['autor_id'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                    <td><?= htmlspecialchars($linha['titulo'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($linha['resumo'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($linha['noticia'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($linha['data_cadastro'], ENT_QUOTES, 'UTF-8'); ?></td>
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