<?php 
include '../admin/connection.php';
session_start();
$email = $_SESSION['employeEmail'];


$sqlon="UPDATE employe SET status ='0' WHERE employeEmail = '$email'";
$resulton = mysqli_query($conn, $sqlon);
$sql= "SELECT * FROM employe WHERE employeEmail = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$dateToday = date('Y-m-d');
$timeNow = date('Y-m-d H:i:s');
$emoloyeid = $row['employeId'];

        $update = "UPDATE employeloginnew SET last_logout = '$timeNow' WHERE employeid = '$emoloyeid' AND logindate = '$dateToday'";
        mysqli_query($conn, $update);

        $sqllogin ="INSERT INTO employelogout (employeid) VALUES ('$emoloyeid')";
        $sqlloginresult = mysqli_query($conn, $sqllogin);
        if ($sqlloginresult) {
            echo "Logout successfully";
        } else {
            echo "Error: " . mysqli_error($conn);
        } 
session_destroy();
header('Location: login.php');
exit();

?>
