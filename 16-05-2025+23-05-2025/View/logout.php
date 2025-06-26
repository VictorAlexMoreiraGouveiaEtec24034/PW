<?php
// Verifica se a sessão existe, se não existir inicia.
if (!isset($_SESSION)) {
    session_start();
}

// Passo 1 : Remver todas as variáveis de sessão!
$_SESSION = array();
// OU
// $_SESSION = [];

// Passo 2 : Destroi a sessão no servidor
session_destroy();

// Passo 3 : Redireciona para a página de login
header("Location: index.php");
exit();
?>