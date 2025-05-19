<?php
session_start();
if(!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Monthly Salary Report</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f4f6f8;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
  }

  .salary-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 25px rgba(0,0,0,0.1);
    max-width: 400px;
    width: 100%;
    padding: 30px 40px;
    text-align: center;
  }

  h1 {
    color: #2c3e50;
    margin-bottom: 25px;
  }

  .info {
    font-size: 18px;
    margin: 15px 0;
    color: #34495e;
  }

  .value {
    font-weight: 700;
    color: #2980b9;
  }

  .error {
    color: #e74c3c;
    font-weight: 700;
    margin-top: 20px;
  }

  a.logout-btn {
    display: inline-block;
    margin-top: 30px;
    text-decoration: none;
    background-color: #3498db;
    color: white;
    padding: 12px 25px;
    border-radius: 6px;
    font-weight: 600;
    transition: background-color 0.3s ease;
  }

  a.logout-btn:hover {
    background-color: #2980b9;
  }
</style>
</head>
<body>

<div class="salary-card">
    <h1>Monthly Salary Report</h1>

<?php
if(isset($_GET['employeid'])) {
    $employeid = $_GET['employeid'];

    // Get employee info
    $sql = "SELECT * FROM employe WHERE employeId = '$employeid'";
    $result = mysqli_query($conn, $sql);

    if (!$result || mysqli_num_rows($result) === 0) {
        echo "<p class='error'>Employee not found or query failed: " . mysqli_error($conn) . "</p>";
    } else {
        $row = mysqli_fetch_assoc($result);
        $dailyRate = $row['salary'] / 26;
        $hourlyRate = $dailyRate / 8;

        echo "<p class='info'>Hourly Rate: <span class='value'>₹" . number_format($hourlyRate, 2) . "</span></p>";

        $month = date('m');
        $year = date('Y');

        $sql_login = "SELECT * FROM emoplyelogin WHERE employeid='$employeid' AND MONTH(date)='$month' AND YEAR(date)='$year'";
        $sql_logout = "SELECT * FROM employelogout WHERE employeid='$employeid' AND MONTH(date)='$month' AND YEAR(date)='$year'";

        $result_login = mysqli_query($conn, $sql_login);
        $result_logout = mysqli_query($conn, $sql_logout);

        if (!$result_login || !$result_logout) {
            echo "<p class='error'>Login or Logout query failed: " . mysqli_error($conn) . "</p>";
        } else {
            $totalMinutes = 0;

            while (($row_login = mysqli_fetch_assoc($result_login)) && ($row_logout = mysqli_fetch_assoc($result_logout))) {
                $login = DateTime::createFromFormat('H:i:s', $row_login['logintime']);
                $logout = DateTime::createFromFormat('H:i:s', $row_logout['logouttime']);

                if ($login && $logout) {
                    $interval = $login->diff($logout);
                    $minutes = ($interval->h * 60) + $interval->i + round($interval->s / 60);
                    $totalMinutes += $minutes;
                }
            }

            $totalHours = $totalMinutes / 60;
            $monthlySalary = $totalHours * $hourlyRate;

            echo "<p class='info'>Total Hours Worked: <span class='value'>" . round($totalHours, 2) . " hrs</span></p>";
            echo "<p class='info'>Monthly Salary : <span class='value'>₹" . number_format($monthlySalary, 2) . "</span></p>";
        }
    }
}
?>   
    <a href="dashboard.php" class="logout-btn">Back to Dashboard</a>
</div>

</body>
</html>
