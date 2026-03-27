<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Expense</title>
    <style>
        body { font-family: Arial; background: linear-gradient(to right, #4facfe, #00f2fe); padding: 50px; }
        .form-container { background: white; padding: 30px; border-radius: 12px; width: 400px; margin: auto; }
        input, button { padding: 10px; margin: 10px 0; width: 100%; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add Expense</h2>
    <form action="insert.php" method="POST">
        <input type="number" name="amount" placeholder="Amount" required>
        <input type="text" name="note" placeholder="Note">
        <input type="date" name="date" required>
        <button type="submit">Save</button>
    </form>

    <a href="view.php">View Expenses</a><br><br>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>