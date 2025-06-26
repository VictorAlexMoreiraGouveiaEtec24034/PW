<?php
function generate_csrf_token()
{
     /** Se não existir a variável csrf_token */
    if (empty($_SESSION['csrf_token'])) {
        /** Será criada */
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    /** retorna o tokem criado */
    return $_SESSION['csrf_token'];
}

function validate_csrf_token($token)
{   /** Retorna true se for verdadeiro e false, caso contrário */
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], 
    $token);
}
