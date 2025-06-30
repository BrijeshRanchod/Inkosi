<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
    <link rel="stylesheet" href="style.css">
<body>
    <h2>Welcome to Inkosi Security, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Your security is our priority.</p>
    <p>To make a Call Out please tap the button below</p>
    <a href="callout.php"><button class="call-out-button">Log Call Out</button></a><br>
    <a href="logout.php"><button class="logout-button">Logout</button></a>
</body>
</html>
