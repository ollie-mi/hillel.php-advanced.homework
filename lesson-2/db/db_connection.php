<?php

// DB credentials
const DATABASE_CONFIG = [
    'host' => '127.0.0.1',
    'user' => 'root',
    'password' => '',
    'database' => 'hillel_shop',
    'charset' => 'utf8mb4'
];

$dns = vsprintf(
    'mysql:host=%s;dbname=%s;charset=%s', [
        DATABASE_CONFIG['host'],
        DATABASE_CONFIG['database'],
        DATABASE_CONFIG['charset']
    ]
);

const PDO_OPTIONS = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

// DB connection
try {
    $database = new PDO(
        $dns, DATABASE_CONFIG['user'], DATABASE_CONFIG['password'], PDO_OPTIONS
    );
} catch (PDOException $e) {
    $dir = __DIR__ . '/../logs';

    if (!mkdir($dir, 0777, true) && !is_dir($dir)) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
    }
    file_put_contents($dir . '/db_logs.log', $e->getMessage() . PHP_EOL);
    $_SESSION['errors']['message'] = 'Database connection error!';
    header('Location: /lesson-2/index.php');
    exit();
}
