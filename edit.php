<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

include 'db.php';
$id = intval($_GET['id']);
$data = mysqli_query($conn, "SELECT * FROM expenses WHERE id=$id");
$row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<body>

<h2>Edit Expense</h2>

<form action="update.php" method="POST">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

Amount:
<input type="number" name="amount" value="<?php echo $row['amount']; ?>"><br><br>

Note:
<input type="text" name="note" value="<?php echo $row['note']; ?>"><br><br>

Date:
<input type="date" name="date" value="<?php echo $row['date']; ?>"><br><br>

<button type="submit">Update</button>
</form>

<br>
<a href="view.php">Back</a> |
<a href="logout.php">Logout</a>

</body>
</html>