<?php
/** Verificar se existe uma sessão criada */
if (session_status() == PHP_SESSION_NONE) {
    /** se não existir, é iniciada a sessão */
    session_start();
}

function check_login()
{   /** Verifica se o usuário está logado no sistema */
    if (empty($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
        /** Se não estiver logado expulsa o usuário do blog */
        header("Location: /index");
        exit();
    }
}
