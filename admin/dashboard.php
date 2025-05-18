<?php
session_start(); 
include 'connection.php';
if(!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f5f7fa;
        color: #333;
    }

    h1, h2 {
        text-align: center;
        color: #2c3e50;
    }

    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        background-color: #fff;
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

    hr {
        border: 0;
        height: 1px;
        background: #ccc;
        margin: 40px auto;
        width: 80%;
    }

    button {
        padding: 6px 12px;
        background-color: #2ecc71;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #27ae60;
    }

    a {
        text-decoration: none;
    }
</style>

 
    <title>dashboard</title>
</head>
<body>
    <h1>dashboard</h1>
    <h2>Welcome to the Admin Dashboard</h2>

    <hr><hr>
    <h2>Employe List</h2>
    <table>
        <tr>
            <th>Employe ID</th>
            <th>Employe Name</th>
            <th>Position</th>
            <th>Salary</th>
            <th>date of joining</th>
        </tr>
        <?php 
        $sql ="SELECT * FROM employe";
        $result = mysqli_query($conn, $sql);
        
        while($row = mysqli_fetch_assoc($result)) {
            ?>
           
            <tr>
                <td><?php echo $row['employeId']; ?></td>
                <td><?php echo $row['employeName']; ?></td>
                <td><?php echo $row['profession']; ?></td>
                <td><?php echo $row['salary']; ?></td>
                <td><?php echo $row['date']; ?></td>
            </tr>

            
            <?php
        }
        ?>
    </table>
  <div>
    <hr><hr>
    <h2>Employe present</h2>
    <?php 
    $dateTodaypr= date("y-m-d");    
    $sqlpr="SELECT * FROM employeloginnew WHERE logindate= '$dateTodaypr'";
    $resultpr = mysqli_query($conn, $sqlpr);
    $rowpr= mysqli_fetch_assoc($resultpr);
    $employeidpr = $rowpr['employeid'];
    $sqlemp ="SELECT * FROM employe WHERE employeid ='$employeidpr'";
    $resultemp = mysqli_query($conn, $sqlemp);
    ?>
    <table>
       <tr>
        <th>Name</th>
        <th>email</th>
        <th>role</th>
        <th>active(0)| inactive (1)</th>
        </tr>
        <?php 
        while($rowemp = mysqli_fetch_assoc($resultemp)) {
            ?>
            <tr>
                <td><?php echo $rowemp['employeName']; ?></td>
                <td><?php echo $rowemp['employeEmail']; ?></td>
                <td><?php echo $rowemp['profession']; ?></td>                
                <td><?php echo $rowemp['status']; ?></td>                
            </tr>
            <?php
        }
        ?>
        </table>

    

    
    
    
    
  

    <h2>Employe Active</h2>
    <?php
    $sqlactive ="SELECT * FROM employe WHERE status = '1'";
    $resultactive = mysqli_query($conn, $sqlactive);
    ?>
    <table>
        <tr>
            <th>Employe ID</th>
            <th>Employe Name</th>
            <th>Position</th>            
            <th>date of joining</th>
            <th>logIn details </th>
        </tr>
        <?php 
        while($rowactive = mysqli_fetch_assoc($resultactive)) {
            ?>
            <tr>
                <td><?php echo $rowactive['employeId']; ?></td>
                <td><?php echo $rowactive['employeName']; ?></td>
                <td><?php echo $rowactive['profession']; ?></td>                
                <td><?php echo $rowactive['date']; ?></td>
                <td><a href="logindetails.php?employeid=<?php echo $rowactive['employeId']; ?>"><button type="button">details</button></a> </td>
            </tr>
            <?php
        }
        ?>
       </table>
</div>
        <hr><hr>
    <h2>Employe Non-active</h2>
    <?php
    $sqlinactive ="SELECT * FROM employe WHERE status = '0'";
    $resultinactive = mysqli_query($conn, $sqlinactive);
    ?>
    <table>
        <tr>
            <th>Employe ID</th>
            <th>Employe Name</th>
            <th>Position</th>            
            <th>date of joining</th>
        </tr>
        <?php 
        while($rowinactive = mysqli_fetch_assoc($resultinactive)) {
            ?>
            <tr>
                <td><?php echo $rowinactive['employeId']; ?></td>
                <td><?php echo $rowinactive['employeName']; ?></td>
                <td><?php echo $rowinactive['profession']; ?></td>               
                <td><?php echo $rowinactive['date']; ?></td>
            </tr>
            <?php
        }
        ?>
       </table> 

    <hr><hr>
    <h2>Employe salary </h2>
    <?php
    $sqlsalary ="SELECT * FROM employe";
    $resultsalary = mysqli_query($conn, $sqlsalary);
    ?>
    <table>
        <tr>
            <th>Employe ID</th>
            <th>Employe Name</th>
            <th>Position</th>
            <th>date of joining</th>
            <th>see salary report</th>            
        </tr>
        <?php 
        while($rowsalary = mysqli_fetch_assoc($resultsalary)) {  
            ?>
            <tr>
                <td><?php echo $rowsalary['employeId']; ?></td>
                <td><?php echo $rowsalary['employeName']; ?></td>
                <td><?php echo $rowsalary['profession']; ?></td>                
                <td><?php echo $rowsalary['date']; ?></td>
                <td><a href="salaryreport.php?employeid=<?php echo $rowsalary['employeId']; ?>"><button type="button">Report</button></a> </td>
           
            <?php
        }
        ?>
    
</body>
</html>