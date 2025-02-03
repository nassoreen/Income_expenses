<meta charset="UTF-8">
<?php
$sql = "SELECT * FROM moneyrecord";
$filter = isset($_GET['filter_tb']) ? $_GET['filter_tb'] : ''; // ใช้สำหรับกรองข้อมูลของ category
if ($filter) {
    $sql .= " WHERE category = '$filter'"; // ใช้ค่าที่ได้จากฟอร์มเพื่อกรองข้อมูล
}

$conn = mysqli_connect("localhost", "root", "", "expense_tracker");
mysqli_query($conn, "SET NAMES UTF8");
$result = mysqli_query($conn, $sql);

// รีเซ็ต pointer อีกครั้งเพื่อแสดงผลตาราง
mysqli_data_seek($result, 0);
?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 20px;
        }
        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table thead th {
            background-color: #343a40;
            color: white;
            font-weight: bold;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        td, th {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>

    <!-- ตารางแสดงข้อมูลที่กรองมา -->
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>วัน/เดือน/ปี</th>
                    <th>รายการ</th>
                    <th>ประเภท</th>
                    <th>จำนวน</th>
                    <th>หมวดหมู่</th>
                    <th>ลบ</th>
                    <th>แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?=$row['id_money']?></td>
                        <td><?=$row['date_time']?></td>
                        <td><?=$row['description_money']?></td>
                        <td><?=$row['type_use']?></td>
                        <td><?=number_format($row['amount'], 2)?></td>
                        <td><?=$row['category']?></td>
                        <td><a href="delete.php?id_money=<?=$row['id_money']?>"><button class="btn btn-danger"><i class="bi bi-trash"></i> Delete</button></a></td>
                        <td><a href="show_update_form.php?id_money=<?=$row['id_money']?>"><button class="btn btn-warning"><i class="bi bi-pencil-square"></i> Edit</button></a></td>
                    </tr> 
                <?php
                }
                ?>
            </tbody>
        </table>
        

    </div>
</body>
</html>
