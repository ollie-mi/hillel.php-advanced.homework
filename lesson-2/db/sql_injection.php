<?php

declare(strict_types=1);

require_once __DIR__ . '/db_connection.php';

// ?email=test@test.com&id=1%27%20OR%20%271
$id = $_GET['id'] ?? null;
$email = $_GET['email'] ?? null;

if (!is_null($id) && ! is_null($email)) {

    $sql = "UPDATE `user` SET `email` = '$email' WHERE id = '$id'";
    $database->exec($sql);
}
