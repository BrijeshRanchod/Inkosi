<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = '127.0.0.1';
    $db   = 'mysql';
    $user = 'root';
    $pass = '';
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: landing.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }

    } catch (PDOException $e) {
        $error = "Connection error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<link rel="stylesheet" href="style.css">

<body>
    <h2>Client Login</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post" action="login.php">
        <label>Username:</label><br>
        <input type="text" name="username" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login"><br>
        
    </form>
    <a href="./register.php"><button class="register-button">Not a client? Register here</button></a>
</body>
</html>
