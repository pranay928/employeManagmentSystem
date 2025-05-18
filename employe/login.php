<?php
session_start();
include '../admin/connection.php';
?>
<?php
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];  
    $sql = "SELECT * FROM employe WHERE employeEmail = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['employeEmail'] = $email;
        $_SESSION['employeId'] = $row['employeId'];
        $sqlon="UPDATE employe SET status ='1' WHERE employeEmail = '$email'";
        $resulton = mysqli_query($conn, $sqlon);

        $emoloyeid = $row['employeId'];
        
$dateToday = date('Y-m-d');
$timeNow = date('H:i:s');

// Check if entry exists for today
$check = "SELECT * FROM employeloginnew WHERE employeid = '$emoloyeid' AND logindate = '$dateToday'";
$checkResult = mysqli_query($conn, $check);

if (mysqli_num_rows($checkResult) == 0) {
    // First login of the day
    $insert = "INSERT INTO employeloginnew (employeid, logindate, first_login) VALUES ('$emoloyeid', '$dateToday', '$timeNow')";
    mysqli_query($conn, $insert);
}



        header("Location: dashbord.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Login</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input[type="submit"] {
            width: 100%;
            background: #3498db;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background: #2980b9;
        }
        .error {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<form method="post" action="">
    <h1>Employee Login</h1>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <input type="submit" name="login" value="Login">
    <a href="signup.php">Register</a>

    
</form>

</body>
</html>

