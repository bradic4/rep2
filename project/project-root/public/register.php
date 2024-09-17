<?php
session_start();
require_once '../config/config.php';
require_once '../src/User.php';

$db = getDB();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user->register($username, $password)) {
        header('Location: login.php');
    } else {
        echo "Registration failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <img src="assets/images/logo.png" alt="Logo">
    </header>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Register">
    </form>
    <footer>
        <p>Footer content here</p>
    </footer>
</body>
</html>
