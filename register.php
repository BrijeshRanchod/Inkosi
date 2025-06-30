<!-- register.php -->
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="style.css">
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
        <label>First Name:</label><br>
        <input type="text" name="firstname" placeholder="Enter your first name" required><br>

        <label>Surname:</label><br>
        <input type="text" name="surname" placeholder="Enter your surname" required><br>

        <label>Username:</label><br>
        <input type="text" name="username" placeholder="Enter your username" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" placeholder="Enter your email" required><br>

        <label>Cell:</label><br>
        <input type="text" name="cell" placeholder="Enter your cell number"><br>

        <label>Address:</label><br>
        <input type="text" name="address" placeholder="Enter your address" required><br>

        <label>Password:</label><br>
        <input type="password" name="password" placeholder="Enter your password" required><br><br>

        <input type="submit" value="Register">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 1. DB connection
        $host = '127.0.0.1';
        $db   = 'mysql';
        $user = 'root';
        $pass = '';
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

        try {
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 2. Sanitize + hash password
            $firstname = $_POST['firstname'];
            $surname = $_POST['surname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $cell = $_POST['cell'];
            $address = $_POST['address'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // 3. Insert into DB
            $stmt = $pdo->prepare("INSERT INTO users (firstname, surname, username, email, cell, address, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$firstname, $surname, $username, $email, $cell, $address, $password]);

            echo "<p style='color:green;'>User registered successfully!</p>";

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<p style='color:red;'>Username or email already exists.</p>";
            } else {
                echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
            }
        }
    }
    ?>
</body>
</html>
