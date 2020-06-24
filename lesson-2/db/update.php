<?php

declare(strict_types=1);
session_start();

require_once __DIR__ . '/db_connection.php';

$userId = !empty($_POST['user_id']) ? (int) $_POST['user_id'] : null;
$newName = !empty($_POST['new_name']) ? htmlspecialchars(trim($_POST['new_name'])) : null;

if (!is_null($userId) && !is_null($newName)) {
    // Check if email is exists
    $query = "SELECT * FROM `user_profile` WHERE `user_id` = :id";
    $stmt = $database->prepare($query);
    $stmt->execute([
        'id' => $userId
    ]);
    $user = $stmt->fetch();
    if (empty($user)) {
        $_SESSION['errors']['update_message'] = 'There is no user with Id = ' . $userId;
        header('Location: /lesson-2/index.php');
        exit();
    }


    $query = "UPDATE `user_profile` SET `first_name` = :new_name WHERE `user_id` = :user_id";
    $stmt = $database->prepare($query);
    $stmt->execute([
        'user_id' => $userId,
        'new_name' => $newName
    ]);

    $_SESSION['success']['update_message'] = "Congratulations! User's name has been updated!";
} else {
    $_SESSION['errors']['update_message'] = "All fields should be filled in!";
}

header('Location: /lesson-2/index.php');
exit();
