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

if (!empty($_POST['birthday']) && DateTime::createFromFormat('Y-m-d', $_POST['birthday']) !== false) {
    $data['birthday'] = $_POST['birthday'];
} else {
    $data['birthday'] = null;
}

if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['errors']['insert_message'] = 'Email address is not valid!';
}

// Check if email is exists
$query = "SELECT * FROM `user` WHERE `email` = :email";
$stmt = $database->prepare($query);
$stmt->execute([
    'email' => $data['email']
]);
$user = $stmt->fetch();
if (!empty($user)) {
    $_SESSION['errors']['insert_message'] = 'This email already exists! Please, choose another one';
    header('Location: /lesson-2/index.php');
    exit();
}

if (isset($_SESSION['errors'])) {
    header('Location: /lesson-2/index.php');
    exit();
} else {

    try{
        // Begin transaction
        $database->beginTransaction();


        //Query 1: Attempt to insert the login and password to User table
        $query = "INSERT INTO `user` (`login`, `password`, `email`) VALUES (:login, :password, :email)";
        $stmt = $database->prepare($query);
        $stmt->execute([
            'login' => $data['login'],
            'password' => $data['password'],
            'email' => $data['email']
        ]);

        //Query 2: Attempt to insert the User's profile.
        $query = "INSERT INTO `user_profile` (`first_name`, `last_name`, `phone`, `birthday`) 
                    VALUES (:first_name, :last_name, :phone, :birthday)";
        $stmt = $database->prepare($query);
        $stmt->execute([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'birthday' => $data['birthday']
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
        $_SESSION['errors']['insert_message'] = 'Something gone wrong! Try again';
        header('Location: /lesson-2/index.php');
        exit();
    }

    if (!isset($_SESSION['errors'])) {
        $_SESSION['success']['insert_message'] = 'Congratulations! User is added to database!';
        header('Location: /lesson-2/index.php');
        exit();
    }
}