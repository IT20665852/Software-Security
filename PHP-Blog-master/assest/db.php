<?php
// Database configuration for XAMPP (default settings)
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'phpblog'); // Change this to match your actual DB name

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Enable exceptions for error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Make connection globally available if needed
    $GLOBALS['conn'] = $pdo;

} catch (PDOException $e) {
    // Store error and display message
    $GLOBALS['e'] = $e;
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>
