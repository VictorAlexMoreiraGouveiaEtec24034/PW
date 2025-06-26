<?php

require_once("conn.php");

$stmt = $pdo->query("select * from usuarios where status = 'A';");

$result = $stmt->fetchAll();

echo "<pre>";

print_r($result);

exit;