<meta charset="UTF-8">
<?php
$sql = "SELECT * FROM moneyrecord";

$filter = isset($_GET['filter_tb']) ? $_GET['filter_tb'] : '';

$conn = mysqli_connect("localhost", "root", "", "expense_tracker");
mysqli_query($conn, "SET NAMES UTF8");
$result = mysqli_query($conn, $sql);
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
            margin: 50px;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2.5rem;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            font-size: 1.2rem;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .input-group {
            width: 50%;
            margin: 0 auto 30px auto;
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

        .btn-danger, .btn-warning {
            width: 100%;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        td, th {
            text-align: center;
            vertical-align: middle;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>บันทึกรายรับรายจ่าย</h1>
        <div class="d-flex justify-content-between mb-4">
            <a href="input_income.php" class="btn btn-success"><i class="bi bi-plus-circle"></i> กรอกข้อมูลเพิ่ม</a>  
            <a href="summary.php" class="btn btn-success"><i class="bi bi-file-earmark-bar-graph"></i> สรุปรายรับ-รายจ่าย</a>
            <form action="filter_category.php" method="GET" class="d-flex">
                <input type="text" name="filter_tb" value="<?= htmlspecialchars($filter) ?>" class="form-control" placeholder="กรอกหมวดหมู่ที่ต้องการกรอง">
                <button class="btn btn-primary ms-2" type="submit">ค้นหา</button>
            </form>
        </div>

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
                        <td><?=$row['amount']?></td>
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
