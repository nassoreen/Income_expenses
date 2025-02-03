<?php

$id_money = $_REQUEST["id_money"];    
$date_time = $_REQUEST["date_time"];    
$description_money = $_REQUEST["description_money"];
$type_use = $_REQUEST["type_use"];
$amount = $_REQUEST["amount"];
$category = $_REQUEST["category"];

$sql = "INSERT INTO moneyrecord(id_money, date_time, description_money, type_use, amount, category)" . 
    " VALUES('$id_money', '$date_time', '$description_money', '$type_use', $amount, '$category')";

//connect database server
$conn = mysqli_connect("localhost", "root", "", "expense_tracker");

//execute sql command
mysqli_query($conn, "SET NAMES UTF8");
$result = mysqli_query($conn, $sql);

if ($result)
   echo '<div class="alert alert-success d-flex align-items-center" role="alert">';
   echo '<i class="bi bi-check-circle me-2" style="font-size: 24px;"></i>'; 
   echo 'เพิ่มข้อมูลสำเร็จ';
   echo '</div>';
mysqli_close($conn);
?>
<html>
    <head>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
        a {
            display: inline-block;
            margin: 20px auto;
            text-align: center;
            padding: 10px 20px;
            background-color: #2E8B57;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .link-container {
            text-align: left; 
            margin-left: 50px;
            margin-top: 30px; 
        }
        </style>
    </head>
    <body>
    <div class="link-container">
        <a href="show_income.php">กลับไปยังหน้าหลัก</a>
    </div>
    </body>
</html>
