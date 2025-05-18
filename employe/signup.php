<?php 
include '../admin/connection.php';

if(isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $post = $_POST['post'];
    $password = $_POST['password']; 
    $salary = $_POST['salary'];

    // Insert into database (Note: Use prepared statements in production)
    $sql = "INSERT INTO employe (employeName, employeEmail, employeDob, profession, salary, password) 
            VALUES ('$name', '$email', '$dob', '$post', '$salary', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo "<div class='success'>Registration successful</div>";
    } else {
        echo "<div class='error'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Register</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .radio-group {
            margin-bottom: 20px;
        }

        .radio-group input {
            margin-right: 10px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #3498db;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        .error {
            color: red;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .success {
            color: green;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<form action="" method="post">
    <h1>Employee Registration</h1>

    <label for="name">Full Name</label>
    <input type="text" name="name" id="name" required>

    <label for="dob">Date of Birth</label>
    <input type="date" name="dob" id="dob" required>

    <label>Profession</label>
    <div class="radio-group">
        <label><input type="radio" name="post" value="Developer" required> Developer</label>
        <label><input type="radio" name="post" value="Designer" required> Designer</label>
        <label><input type="radio" name="post" value="Marketer" required> Marketer</label>
        <label><input type="radio" name="post" value="Manager" required> Manager</label>
    </div>

    <label for="salary">Salary</label>
    <input type="number" name="salary" id="salary" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>

    <input type="submit" value="Register" name="register">
</form>

</body>
</html>
