<?php

declare(strict_types=1);
session_start();

require_once __DIR__ . '/db_connection.php';

$userId = !empty($_POST['user_id']) ? (int) $_POST['user_id'] : null;

if (!is_null($userId)) {
    // Check if email is exists
    $query = "SELECT * FROM `user` WHERE `id` = :id";
    $stmt = $database->prepare($query);
    $stmt->execute([
        'id' => $userId
    ]);
    $user = $stmt->fetch();
    if (empty($user)) {
        $_SESSION['errors']['delete_message'] = 'There is no user with Id = ' . $userId;
        header('Location: /lesson-2/index.php');
        exit();
    }


    $query = "DELETE FROM `user` WHERE `id` = :user_id";
    $stmt = $database->prepare($query);
    $stmt->execute([
        'user_id' => $userId
    ]);

    $_SESSION['success']['delete_message'] = "Congratulations! User has been deleted!";
} else {
    $_SESSION['errors']['delete_message'] = "User Id should be filled in!";
}

header('Location: /lesson-2/index.php');
exit();
