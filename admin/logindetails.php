
<?php 
session_start();
if(!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

include 'connection.php';
if(isset($_GET['employeid'])) {
    $employeid = $_GET['employeid'];
    $sql ="SELECT * FROM employeloginnew WHERE employeid = '$employeid' ";       
    $result = mysqli_query($conn, $sql);   
    
?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        margin: 40px;
        color: #333;
    }

    h1 {
        text-align: center;
        color: #2c3e50;
    }

    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 5px;
        overflow: hidden;
    }

    th {
        background-color: #34495e;
        color: white;
        padding: 12px;
        text-align: center;
    }

    td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    a {
        display: block;
        width: fit-content;
        margin: 30px auto;
        text-align: center;
        padding: 10px 20px;
        background-color: #2ecc71;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        background-color: #27ae60;
    }

    hr {
        border: none;
        height: 1px;
        background-color: #ccc;
        margin: 40px 0;
    }
</style>

        <title>Employe Login Details</title>
    </head>
    <body>

   <table>
    <tr> 
        <th>Employe id</th> 
        <th>Login time </th>
        <th>Logout time</th> 
        <th> Date</th>
        
    </tr>
    <?php 
     while($row1 = mysqli_fetch_assoc($result) ) {

       
        
        ?>
        <tr>
            <td><?php echo $row1['employeid']; ?></td>
            <td><?php echo $row1['first_login']; ?></td>
            <td><?php echo $row1['last_logout']; ?></td>
            <td><?php echo $row1['logindate']; ?></td>
           
        </tr>
        <?php
     }
     ?>
     </table>
     <a href="dashboard.php">Back to Dashboard</a>
     <hr><hr>
    </body>
     <?php  
      
    }

   


?>

    

    
    

