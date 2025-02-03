<?php
include 'db.php';     // การเชื่อมต่อฐานข้อมูล

$period = $_POST['period'];    //รับข้อมูลจากฟอร์ม

// กำหนดช่วงเวลาและแยกประเภทระหว่างรายรับและรายจ่าย
switch ($period) {
    case 'daily':
        $sql = "SELECT DATE(date_time) AS date, 
                       SUM(CASE WHEN type_use = 'รายรับ' THEN amount ELSE 0 END) AS income, 
                       SUM(CASE WHEN type_use = 'รายจ่าย' THEN amount ELSE 0 END) AS expense 
                FROM moneyrecord 
                GROUP BY DATE(date_time)";
        break;
    case 'weekly':
        $sql = "SELECT YEAR(date_time) AS year, WEEK(date_time) AS week, 
                       SUM(CASE WHEN type_use = 'รายรับ' THEN amount ELSE 0 END) AS income, 
                       SUM(CASE WHEN type_use = 'รายจ่าย' THEN amount ELSE 0 END) AS expense 
                FROM moneyrecord 
                GROUP BY YEAR(date_time), WEEK(date_time)";
        break;
    case 'monthly':
        $sql = "SELECT YEAR(date_time) AS year, MONTH(date_time) AS month, 
                       SUM(CASE WHEN type_use = 'รายรับ' THEN amount ELSE 0 END) AS income, 
                       SUM(CASE WHEN type_use = 'รายจ่าย' THEN amount ELSE 0 END) AS expense 
                FROM moneyrecord 
                GROUP BY YEAR(date_time), MONTH(date_time)";
        break;
    case 'yearly':
        $sql = "SELECT YEAR(date_time) AS year, 
                       SUM(CASE WHEN type_use = 'รายรับ' THEN amount ELSE 0 END) AS income, 
                       SUM(CASE WHEN type_use = 'รายจ่าย' THEN amount ELSE 0 END) AS expense 
                FROM moneyrecord 
                GROUP BY YEAR(date_time)";
        break;
    default:
        $sql = "";
        break;
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สรุปรายรับ-รายจ่าย</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
            display: inline-block;
            margin: 20px auto;
            text-align: center;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>สรุปรายรับ-รายจ่ายประจำวัน สัปดาห์ เดือน ปี</h1>

    <table>
        <tr>
            <?php
            if ($period == 'daily') {
                echo "<th>วันที่</th><th>รายรับ</th><th>รายจ่าย</th>";
            } elseif ($period == 'weekly') {
                echo "<th>ปี</th><th>สัปดาห์</th><th>รายรับ</th><th>รายจ่าย</th>";
            } elseif ($period == 'monthly') {
                echo "<th>ปี</th><th>เดือน</th><th>รายรับ</th><th>รายจ่าย</th>";
            } elseif ($period == 'yearly') {
                echo "<th>ปี</th><th>รายรับ</th><th>รายจ่าย</th>";
            }
            ?>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            if ($period == 'daily') {
                echo "<td>" . $row['date'] . "</td><td>" . $row['income'] . "</td><td>" . $row['expense'] . "</td>";
            } elseif ($period == 'weekly') {
                echo "<td>" . $row['year'] . "</td><td>" . $row['week'] . "</td><td>" . $row['income'] . "</td><td>" . $row['expense'] . "</td>";
            } elseif ($period == 'monthly') {
                echo "<td>" . $row['year'] . "</td><td>" . $row['month'] . "</td><td>" . $row['income'] . "</td><td>" . $row['expense'] . "</td>";
            } elseif ($period == 'yearly') {
                echo "<td>" . $row['year'] . "</td><td>" . $row['income'] . "</td><td>" . $row['expense'] . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <a href="show_income.php">กลับไปยังหน้าหลัก</a>
</body>
</html>

<?php
$conn->close();   //ปิดการเชื่อมต่อฐานข้อมูล
?>
