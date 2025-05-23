<?php 
    require_once("../../Core/conn.php");

    $smlp = $pdo->query("SELECT id, nome, email, status, tipoUsuario FROM usuarios;");
    $result = $smlp->fetchAll();
    // echo "<pre>";
    // print_r($result);
    // die();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Css/dataTables.dataTables.css">
    <link rel="stylesheet" href="../../Css/rowGroup.dataTables.css">
    <title>Listar Usuários</title>
</head>
<body>
    <table class="display" id="MyTable">
        <thead>
            <tr>
                <th>Nome </th>
                <th>E-mail</th>
                <th>Status</th>
                <th>Tipo Usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result){
                    foreach ($result as $linha) {
                ?>
                <tr>
                    <td><a href="./usuario.php?id=<?= $linha['id']?>"><?= $linha['nome']; ?></a></td>
                    <td><a href="./usuario.php?id=<?= $linha['email']?>"><?= $linha['email']; ?></a></td>
                    <td><a href="./usuario.php?id=<?= $linha['status']?>"><?= $linha['status']; ?></a></td>
                    <td><a href="./usuario.php?id=<?= $linha['tipoUsuario']?>"><?= $linha['tipoUsuario']; ?></a></td>
                </tr>
                <?php }
            }
                ?>
        </tbody>
    </table>
    <script src="../../Js/jquery-3.7.1.js"></script>
    <script src="../../Js/dataTables.js"></script>
    <script src="../../Js/dataTables.rowGroup.js"></script>
    <script src="../../Js/rowGroup.dataTables.js"></script>
    <script>
        new DataTable('#MyTable', {
            order: [[2, 'asc']]
        })
    </script>
</body>
</html>