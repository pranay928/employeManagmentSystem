<?php
session_start();
include('connection.php');
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql="SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $_SESSION['email'] = $email;
        header("Location: dashboard.php");
    } else {
        echo "Invalid email or password";
    }
}?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6f8;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    form {
        background-color: #fff;
        padding: 40px 30px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #2c3e50;
    }

    label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        color: #333;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        width: 100%;
        background-color: #3498db;
        color: white;
        padding: 12px;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #2980b9;
    }

    .error {
        text-align: center;
        color: red;
        font-weight: bold;
        margin-top: 10px;
    }
</style>

</head>
<body>
  
  <form action="" method="post">
    <label for="email">Email:</label><br>
    <input type="email" name="email" id="email" required><br><br>
    <label for="password">Password:</label><br>
    <input type="password" name="password" id="password" required><br><br>

    <input type="submit" value="Login" name="login">
  </form>
    
</body>
</html>