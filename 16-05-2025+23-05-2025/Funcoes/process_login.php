<?php
require_once("../Core/conn.php");

// Inicia a sessão
session_start();

// Verifica se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Simula autenticação - aqui você deve fazer a verificação do usuário 
    // no banco de dados
    $username = filter_input(INPUT_POST, 'username', FILTER_VALIDATE_EMAIL);
    $password = strip_tags($_POST["password"]);
    
    $sql = "SELECT email, senha FROM usuarios WHERE email = :email AND  
    senha = :senha";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":email", $username);
    $stmt->bindValue(":senha", $password);
    $stmt->execute();
    $result =  $stmt->fetch();

    // Verifica se o usuário e a senha são válidos (simulação)
    if ($result) {
        // Define uma variável de sessão para indicar que o usuário está logado
        $_SESSION["logged_in"] = true;
        // Define outras informações do usuário na sessão, se necessário
        $_SESSION["username"] = $username;

        // Redireciona o usuário para a página de perfil
        echo json_encode(["status" => "success", "redirect" => "View/dashboard.php"]);
        exit();
    } else {
        // Se as credenciais estiverem incorretas, redireciona de volta 
        // para a página de login com uma mensagem de erro
        echo json_encode(["status" => "error", "message" => "invalid_credentials"]);
        exit();
    }





} else {
    // Se o formulário não foi enviado, redireciona de volta para a página de login
    // echo json_encode("Erro no tipo de requisição");
    echo json_encode(["status" => "error", "message" => "Erro no tipo de requisição"]);
    exit();
}
