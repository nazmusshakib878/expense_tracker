<?php
include 'db.php';

$amount = $_POST['amount'];
$note = $_POST['note'];
$date = $_POST['date'];

$sql = "INSERT INTO expenses (amount, note, date) VALUES ('$amount','$note','$date')";

if (mysqli_query($conn, $sql)) {
    header("Location: view.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>