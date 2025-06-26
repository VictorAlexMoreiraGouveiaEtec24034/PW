<?php
// Configurações do banco de dados
require_once("./configuracoes.php");

// Opções de configuração do PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Ativa relatórios de erro
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Define o fetch mode padrão
    PDO::ATTR_EMULATE_PREPARES => false, // Desativa prepares emulados para segurança
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4' // Define charset
];

try {
    // Cria a conexão PDO
    $pdo = new PDO(
        "mysql:host=".HOST.";dbname=".BANCO.";charset=utf8mb4",
        USUARIO,
        SENHA,
        $options
    );
    
} catch (PDOException $e) {
    // Tratamento de erros
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}
?>