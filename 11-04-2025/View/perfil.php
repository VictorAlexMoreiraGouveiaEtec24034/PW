<?php
// perfil.php

// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: index.php");
    exit();
}

// Exibe as informações do usuário
echo "<h2>Bem-vindo, " . $_SESSION["username"] . "!</h2>";
echo "<p>Esta é sua página de perfil.</p>";
echo "<p><a href='logout.php'>Sair</a></p>";
