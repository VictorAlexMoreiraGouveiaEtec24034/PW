<?php

sleep(1);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);


echo $email . " - " . $senha;
if (empty($email) || empty($senha)){
    echo json_encode("Email ou senha em branco!");
    return;
}

if (($senha != "master123") && ($email != 'Root@gmail.com')){
    echo json_encode("Emial ou senha inválidos");
    return;
}
?>