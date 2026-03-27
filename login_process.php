<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_assoc($result);

    // simple password check
    if($password == $row['password']){
        $_SESSION['user'] = $username;
        header("Location: view.php");
        exit();
    } else {
        echo "Wrong password!";
    }

} else {
    echo "User not found!";
}
?>