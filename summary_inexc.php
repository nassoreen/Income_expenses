<meta charset="UTF-8">
<?php
$conn = mysqli_connect("localhost", "root", "", "expense_tracker");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "
    SELECT 
        category,
        SUM(CASE WHEN type_use = 'รายรับ' THEN amount ELSE 0 END) AS total_income,
        SUM(CASE WHEN type_use = 'รายจ่าย' THEN amount ELSE 0 END) AS total_expense
    FROM 
        moneyrecord
    GROUP BY 
        category
";

$result = $conn->query($sql);
?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }

        .summary-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 1000px; /* ปรับขนาดตารางให้ใหญ่ขึ้น */
            margin: 0 auto;
        }

        .summary-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px; /* เพิ่มขนาดหัวข้อ */
            color: #333;
        }

        table {
            width: 100%; /* ขยายตารางให้กว้างเต็มที่ */
            border-collapse: collapse;
        }

        th, td {
            padding: 20px; /* เพิ่ม padding ให้ใหญ่ขึ้น */
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 18px; /* เพิ่มขนาดตัวอักษร */
        }

        th {
            background-color: #2E8B57;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
        }

        .total {
            font-weight: bold;
            background-color: #e2e2e2;
        }

        tr:hover td {
            background-color: #f1f1f1;
        }

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
    </style>
</head>
<body>
    <div class="summary-container">
        <h2>สรุปรายรับ-รายจ่ายตามหมวดหมู่</h2>
        <table>
            <tr>
                <th>หมวดหมู่</th>
                <th>รายรับ</th>
                <th>รายจ่าย</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['category']; ?></td>
                <td><?= number_format($row['total_income']); ?></td>
                <td><?= number_format($row['total_expense']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <a href="show_income.php">กลับไปยังหน้าหลัก</a>
</body>
</html>
