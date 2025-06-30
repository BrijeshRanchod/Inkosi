<?php
session_start();

// Database connection
$host = '127.0.0.1';
$db   = 'mysql';
$user = 'root';
$pass = '';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch user details
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $error = "Connection error: " . $e->getMessage();
}
?>