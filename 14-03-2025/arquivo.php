<?php
    // Inclui i arquivo de conexao com banco de dados
    require_once("./conn.php");
    
    // Testando banco de dados
    $smt = $pdo -> query("select * from user;");

    // Executa o select e traz todos os dados
    $result = $smt->fetchAll();

    echo '<pre>';
    // Imprimeo array resultante
    print_r($result);

    die();

    print_r($_POST);

    // Filtrar e validar variaveis globais $POST
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    $senha = strip_tags($senha);

    if ($email && $senha) {
        // Osd dados foram filtrados e validados com sucesso
        // Faça o que for necessário com os dados filtrados
    } else {
        // Dados inválidos, trate de acordo (ex: exiba uma mensagem de erro)
    }

    // Filtrar e validar variaveis globais $_GET
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id !== null){
        // O ID foi filtrado e validado com sucesso
        // Faça o que for necessário com o ID filtrado
    } else {
        // ID Inválido, trate de acordo (ex: exiba uma mensagem de erro)
    }
?>