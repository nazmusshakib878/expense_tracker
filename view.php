<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

include 'db.php';

$filter_date = isset($_GET['date']) ? $_GET['date'] : '';
$filter_month = isset($_GET['month']) ? $_GET['month'] : '';

$sql = "SELECT * FROM expenses WHERE 1";
if($filter_date) $sql .= " AND date='$filter_date'";
if($filter_month) $sql .= " AND MONTH(date)='$filter_month'";
$result = mysqli_query($conn, $sql);

$total_sql = "SELECT SUM(amount) AS total FROM expenses WHERE 1";
if($filter_date) $total_sql .= " AND date='$filter_date'";
if($filter_month) $total_sql .= " AND MONTH(date)='$filter_month'";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);
$total_amount = $total_row['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Expense Dashboard</title>
<style>
body { font-family: Arial; background: linear-gradient(to right,#6a11cb,#2575fc); padding: 20px; color:#333;}
h2{text-align:center;color:white;margin-bottom:20px;}
.container{width:90%;margin:auto;}
.top-btn{display:block;width:150px;margin:15px auto;text-align:center;background:#333;color:white;text-decoration:none;padding:10px;border-radius:8px;}
.logout-btn{display:block;width:100px;margin:10px auto;text-align:center;background:red;color:white;text-decoration:none;padding:8px;border-radius:8px;}
.filter-form{text-align:center;margin-bottom:20px;}
.filter-form input,.filter-form select,.filter-form button{padding:8px 12px;margin:5px;border-radius:5px;border:none;}
.cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;}
.card{background:white;border-radius:12px;padding:20px;box-shadow:0 5px 15px rgba(0,0,0,0.2);transition:transform 0.2s;}
.card:hover{transform:scale(1.05);}
.card h3{margin:0 0 10px 0;color:#2575fc;}
.card p{margin:5px 0;font-size:14px;}
.card .buttons a{display:inline-block;margin:5px 5px 0 0;padding:6px 10px;border-radius:5px;color:white;text-decoration:none;font-size:13px;}
.edit{background:#28a745;}
.delete{background:#dc3545;}
.total{margin-top:20px;font-size:18px;font-weight:bold;text-align:right;color:white;}
@media(max-width:600px){.cards{grid-template-columns:1fr;}}
</style>
</head>
<body>

<h2>💰 Expense Dashboard</h2>

<div class="container">

<a class="top-btn" href="index.php">+ Add Expense</a>
<a class="logout-btn" href="logout.php">Logout</a>

<form class="filter-form" method="GET">
Filter by Date: <input type="date" name="date" value="<?php echo $filter_date; ?>">

Filter by Month: 
<select name="month">
<option value="">--Select Month--</option>
<?php 
for($m=1;$m<=12;$m++){ 
    $selected=($filter_month==$m)?"selected":""; 
    echo "<option value='$m' $selected>$m</option>"; 
} 
?>
</select>

<button type="submit">Filter</button>
<a href="view.php">Reset</a>
</form>

<div class="cards">
<?php
while($row = mysqli_fetch_assoc($result)){
    $id = intval($row['id']); // security fix
    echo "<div class='card'>
            <h3>{$row['amount']} TK</h3>
            <p><strong>Note:</strong> {$row['note']}</p>
            <p><strong>Date:</strong> {$row['date']}</p>
            <div class='buttons'>
                <a class='edit' href='edit.php?id=$id'>Edit</a>
                <a class='delete' href='delete.php?id=$id' onclick=\"return confirm('Are you sure?')\">Delete</a>
            </div>
          </div>";
}
?>
</div>

<div class="total">
Total Expense: <?php echo $total_amount;?> TK
</div>

</div>
</body>
</html>