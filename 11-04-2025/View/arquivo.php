<?php
// Incluir o arquivo de conexão com o banco dados
require_once("conn.php");

$nome = "José da Silva";
$email = "teste@teste.com";
$senha = "senha1234";
$status = "A";

// Criando a string de inserção no banco de dados
$sql = "INSERT INTO usuarios (nome, email, senha, status) 
       VALUES (:nome, :email, :senha, :status)";

 // Preparando a execução
$stmt = $pdo->prepare($sql);

// Passando os dados e executando
$stmt->execute(
    [
        ":nome" => $nome,
        ":email" => $email,
        ":senha" => $senha,
        ":status" => $status,
    ]
);

 // Validando se deu certo a execução do insert
 if ($stmt->rowCount() > 0) {
    echo json_encode(["status" => "success", 
                      "message" =>  "Dados inseridos com sucesso!"]);
 } else {
    echo json_encode(["status" => "error", 
    "message" =>"Erro ao inserir os dados!"]);
 }

return;

//["status" => "error", "message" => "invalid_credentials"]);
// sleep(500);
echo '<pre>';
// die();
//print_r($_GET);
print_r($_POST);

die();
// Filtrar e validar variáveis globais $_POST
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING); // Depreciado.
$senha = strip_tags($senha);
if ($email && $senha) {
    // Os dados foram filtrados e validados com sucesso
    // Faça o que for necessário com os dados filtrados
} else {
    // Dados inválidos, trate de acordo (ex: exiba uma mensagem de erro)
}

// Filtrar e validar variáveis globais $_GET
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id !== null) {
    // O ID foi filtrado e validado com sucesso
    // Faça o que for necessário com o ID filtrado
} else {
    // ID inválido, trate de acordo (ex: exiba uma mensagem de erro)
}
