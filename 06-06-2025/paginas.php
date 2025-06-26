<?php
require_once("Core/conn.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado (exemplo simples, ajuste conforme seu sistema)
if (!isset($_SESSION['logged_in'])) {
    header('Location: index');
    exit;
}

// Define a página padrão
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Lista de páginas permitidas para evitar inclusão de arquivos 
// não autorizados
$paginas_permitidas = [
    'dashboard' => 'View/dashboard_partial.php',
    'usuario/listarUsuarios' => 'View/usuario/listarUsuarios_partial.php',
    'usuario/Usuario' => 'View/usuario/usuario.php',
    // Adicione outras páginas permitidas aqui
];

// Verifica se a página solicitada está na lista permitida
if (!array_key_exists($page, $paginas_permitidas)) {
    $page = 'dashboard'; // fallback para dashboard
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Página Única - Aula 6 A</title>
    <link rel="stylesheet" href="Css/bootstrap.min.css">
    <link rel="stylesheet" href="Css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="Css/listarUsuarios.css">

    <script src="Js/jquery-3.7.1.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="paginas.php">Painel Administrativo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'dashboard' ? 'active' : '' ?>" href="paginas.php?page=dashboard">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'usuario/listarUsuarios' ? 'active' : '' ?>" href="paginas?page=usuario/listarUsuarios">Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="View/logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Área de inclusão de conteúdo-->
    <div class="container mt-4">
        <?php include $paginas_permitidas[$page]; ?>
    </div>


    <script src="Js/popper.min.js"></script>
    <script src="Js/bootstrap.min.js"></script>
    <script src="Js/jquery.dataTables.min.js"></script>
    <script src="Js/sweetalert2@11.js"></script>
</body>

</html>