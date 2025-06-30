<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: callout.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Call Out</title>
</head>
    <link rel="stylesheet" href="style.css">
<body>
    <h2>Your callout has been logged and a unit is to meet you are your designated address</h2>
        <p>Address: <?php 
                echo isset($_SESSION['address']) 
                    ? htmlspecialchars($_SESSION['address']) 
                    : 'No address provided.';
            ?>
        </p>
</body>
</html>
