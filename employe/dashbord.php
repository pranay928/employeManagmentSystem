<?php
session_start();
if (!isset($_SESSION['employeEmail'])) {
    header("Location: login.php");
    exit();
}

date_default_timezone_set("Asia/Kolkata"); // Adjust timezone as needed
$currentDateTime = date("Y-m-d H:i:s");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard-container {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        h2 {
            color: #34495e;
            margin-bottom: 20px;
        }

        time {
            display: block;
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
            font-weight: bold;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Employee Dashboard</h1>
        <h2>Welcome, <?php echo $_SESSION['employeEmail']; ?>!</h2>

        <p>Current Date and Time:</p>
        <time datetime="<?php echo $currentDateTime; ?>">
            <?php echo date("l, d M Y - h:i:s A"); ?>
        </time>

        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
