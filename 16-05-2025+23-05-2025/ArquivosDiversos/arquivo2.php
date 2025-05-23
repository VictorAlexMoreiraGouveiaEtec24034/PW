<?php
require_once("conn.php");

$id = 1;
$nome = "João da Silva";
$email = "teste@teste.com";
$senha = "mudar123";
$status = "A";

// Instrução SQL
$sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, 
status = :status WHERE id = :id";

// Preparando a instrução SQl
$stmt = $pdo->prepare($sql);

// Passando os parâmentros para o PDO
$stmt->bindValue(":nome", $nome);
$stmt->bindValue(":email", $email);
$stmt->bindValue(":senha", $senha);
$stmt->bindValue(":status", $status);
$stmt->bindValue(":id", $id);

 if ($stmt->execute()) {
    echo "Registro atualizado";
 } else {
    echo "Erro ao atualizar o registro";
 }


// Consultar os dados.
$stmt = $pdo->query("SELECT * FROM usuarios");

// Executando o select
$result = $stmt->fetchAll();

// exibindo
echo "<pre>";// Para formatar o Array ou Vetor
print_r($result);