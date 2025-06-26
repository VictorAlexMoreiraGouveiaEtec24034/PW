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

    $nomeAutor = strip_tags($_POST["nomeAutor"]);
    $titulo = strip_tags($_POST["titulo"]);
    $resumo = strip_tags($_POST["resumo"]);
    $noticia = strip_tags($_POST["noticia"]);
    $dataCadastro = strip_tags($_POST["data_cadastro"]);
    $idNoticia = filter_input(INPUT_POST, 'id_noticia', FILTER_VALIDATE_INT);

    $tipoUsuario = filter_input(INPUT_POST, 'tipoUsuario', FILTER_VALIDATE_INT);
    $idUsuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);

    $sql = "";

    if ($idNoticia > 0) {

        // Instrução SQL
        $sql = "UPDATE noticias SET nomeAutor = :nomeAutor, titulo = :titulo, resumo = :resumo, 
        noticia = :noticia, dataCadastro = :dataCadastro WHERE id = :id";

        // Preparando a instrução SQl
        $stmt = $pdo->prepare($sql);

        // Passando os parâmentros para o PDO
        $stmt->bindValue(":nomeAutor", $nomeAutor);
        $stmt->bindValue(":titulo", $titulo);
        $stmt->bindValue(":resumo", $resumo);
        $stmt->bindValue(":noticia", $noticia);
        $stmt->bindValue(":dataCadastro", $dataCadastro);
        $stmt->bindValue(":id", $idNoticia);
        if ($stmt->execute()) {
            echo "Registro atualizado";
        } else {
            echo "Erro ao atualizar o registro";
        }
    } else {
        $sql = "INSERT INTO noticias (nomeAutor, titulo, resumo, noticia, dataCadastro) 
        VALUES (:nomeAutor, :titulo, :resumo, :noticia, :dataCadastro)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(
            [
                ":nomeAutor" => $nomeAutor,
                ":titulo" => $titulo,
                ":resumo" => $resumo,
                ":noticia" => $noticia,
                ":dataCadastro" => $dataCadastro
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
        $stmt = $pdo->query("select * from noticias where id = {$id};");
        $result = $stmt->fetch();
        if ($result) {
            $smtp = $pdo->prepare("UPDATE noticias SET status = 'I' WHERE id = :id");
            $smtp->bindValue(":id", $id);
            if ($smtp->execute()) {
                echo "Registro excluido";
            } else {
                echo "Erro ao excluir o registro";
            }
        } else {
            echo "noticia não localizada!";
        }
    }
}
return;
