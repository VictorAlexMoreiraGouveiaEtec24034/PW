<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>
<body>
    <?php
        $msg =  $_POST['entrada'];
        data_default_imezone_set("America/Sao_Paulo");
        echo "$msg ".date("s:i:h");
        var_dump($_POST);
    ?>
</body>
</html>