<?php
include 'db.php';
$id = $_POST['id'];
$amount = $_POST['amount'];
$note = $_POST['note'];
$date = $_POST['date'];

$sql="UPDATE expenses SET amount='$amount', note='$note', date='$date' WHERE id=$id";
if(mysqli_query($conn,$sql)){
    header("Location:view.php");
}else{ echo "Error!"; }
?>