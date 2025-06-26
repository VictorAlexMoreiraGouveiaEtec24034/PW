<?php
require_once("../Core/conn.php");
session_start();
require_once("csrf_helper.php");
require_once("auth_helper.php");
check_login();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação CSRF
    if (empty($_POST['csrf_token']) || !validate_csrf_token($_POST['csrf_token'])) {
        echo json_encode(["status" => "error", "message" => "Token CSRF inválido ou ausente."]);
        exit();
    }

    $nome = strip_tags($_POST["nomeCompleto"]);
    $email = strip_tags($_POST["email"]);
    $senha = strip_tags($_POST["senha"]);
    $status = strip_tags($_POST["status"]);
    $tipoUsuario = filter_input(INPUT_POST, 'tipoUsuario', FILTER_VALIDATE_INT);
    $idUsuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);

    $sql = "";

    if ($idUsuario > 0) {

        // Instrução SQL
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, 
        status = :status, tipoUsuario = :tipoUsuario WHERE id = :id";

        // Preparando a instrução SQl
        $stmt = $pdo->prepare($sql);

        // Passando os parâmentros para o PDO
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $senha);
        $stmt->bindValue(":status", $status);
        $stmt->bindValue(":tipoUsuario", $tipoUsuario);
        $stmt->bindValue(":id", $idUsuario);
        if ($stmt->execute()) {
            echo "Registro atualizado";
        } else {
            echo "Erro ao atualizar o registro";
        }
    } else {
        $sql = "INSERT INTO usuarios (nome, email, senha, status, tipoUsuario) 
        VALUES (:nome, :email, :senha, :status, :tipoUsuario)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(
            [
                ":nome" => $nome,
                ":email" => $email,
                ":senha" => $senha,
                ":status" => $status,
                ":tipoUsuario" => $tipoUsuario
            ]
        );
    }



    if ($stmt->rowCount() > 0) {
        echo json_encode([
            "status" => "success",
            "message" =>  "Dados inseridos com sucesso!"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Erro ao inserir os dados!"
        ]);
    }
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'] ?? 0;
    if (intval($id) > 0) {
        $stmt = $pdo->query("select * from usuarios where id = {$id};");
        $result = $stmt->fetch();
        if ($result) {
            $smtp = $pdo->prepare("UPDATE usuarios SET status = 'I' WHERE id = :id");
            $smtp->bindValue(":id", $id);
            if ($smtp->execute()) {
                echo "Registro excluido";
            } else {
                echo "Erro ao excluir o registro";
            }
        } else {
            echo "usuario não localizado!";
        }
    }
}
return;
