<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
body {
    font-family: Arial;
    background: linear-gradient(to right, #667eea, #764ba2);
}
.login-box {
    width: 300px;
    margin: 100px auto;
    background: white;
    padding: 25px;
    border-radius: 10px;
    text-align: center;
}
input, button {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
}
button {
    background: #667eea;
    color: white;
    border: none;
}
</style>
</head>
<body>

<div class="login-box">
<h2>Login</h2>

<form action="login_process.php" method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Login</button>
</form>

</div>

</body>
</html>