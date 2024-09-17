<?php
session_start();
require_once '../config/config.php';
require_once '../src/User.php';
require_once '../src/Expense.php';

$db = getDB();
$user = new User($db);
$expense = new Expense($db);

if (!$user->isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $expense->addExpense($userId, $amount, $description);
}

$expenses = $expense->getExpenses($userId);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <img src="assets/images/logo.png" alt="Logo">
    </header>
    <h1>Welcome to Your Dashboard</h1>
    <form method="post" action="">
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required>
        <br>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>
        <br>
        <input type="submit" value="Add Expense">
    </form>

    <h2>Expenses</h2>
    <ul>
        <?php foreach ($expenses as $exp): ?>
            <li><?php echo htmlspecialchars($exp['amount']); ?> - <?php echo htmlspecialchars($exp['description']); ?></li>
        <?php endforeach; ?>
    </ul>
    <footer>
        <p>Footer content here</p>
    </footer>
</body>
</html>
