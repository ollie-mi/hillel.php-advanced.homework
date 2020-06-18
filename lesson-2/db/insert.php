<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/db_connection.php';

$requiredFields = [
    'login',
    'password',
    'email',
    'phone',
    'first_name',
    'last_name',
];

$rawData = [];

// Check that fields are not empty (except Birthday)
foreach ($requiredFields as $field) {
    if (isset($_POST[$field]) && strlen($_POST[$field])) {
        $rawData[$field] = trim($_POST[$field]);
    } else {
        $fieldName = ucfirst(str_replace('_', ' ', $field));
        $_SESSION['errors']['message'] = "The field $fieldName must be filled in!";
        header('Location: /lesson-2/index.php');
        exit();
    }
}

// Validation
$data = [
    'login' => htmlspecialchars($rawData['login']),
    'password' => password_hash($rawData['password'], PASSWORD_DEFAULT),
    'email' => htmlspecialchars($rawData['email']),
    'phone' => (int)$rawData['phone'],
    'first_name' => htmlspecialchars($rawData['first_name']),
    'last_name' => htmlspecialchars($rawData['last_name']),
];

if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['errors']['message'] = 'Email address is not valid!';
}

if (isset($_SESSION['errors'])) {
    header('Location: /lesson-2/index.php');
    exit();
} else {

    try{
        // Begin transaction
        $database->beginTransaction();


        //Query 1: Attempt to insert the login and password to User table
        $query = "INSERT INTO `user` (`login`, `password`) VALUES (:login, :password)";
        $stmt = $database->prepare($query);
        $stmt->execute([
            'login' => $data['login'],
            'password' => $data['password']
        ]);

        //Query 2: Attempt to insert the User's profile.
        $query = "INSERT INTO `user_profile` (`first_name`, `last_name`, `email`, `phone`) 
                    VALUES (:first_name, :last_name, :email, :phone)";
        $stmt = $database->prepare($query);
        $stmt->execute([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);

        // Commit the changes
        $database->commit();

    } catch(Exception $e){
        $dir = __DIR__ . '/../logs';
        if (!mkdir($dir, 0777, true) && !is_dir($dir)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
        }
        file_put_contents($dir . '/db_logs.log', $e->getMessage() . PHP_EOL);
        // Rollback the transaction
        $database->rollBack();
        $_SESSION['errors']['message'] = 'Something gone wrong! Try again';
        header('Location: /lesson-2/index.php');
        exit();
    }

    if (!isset($_SESSION['errors'])) {
        $_SESSION['success']['message'] = 'Congratulations! User is added to database!';
        header('Location: /lesson-2/index.php');
        exit();
    }
}