<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expense_tracker";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM category";
$result = $conn->query($sql);
?>
<meta charset="UTF-8">
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-container table {
            width: 100%;
        }

        .form-container td {
            padding: 10px 0;
        }

        .form-container input[type="text"],
        .form-container input[type="datetime-local"],
        .form-container select {
            width: calc(100% - 20px);
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-left: 10px;
        }

        .form-container td:first-child {
            text-align: right;
            padding-right: 10px;
            color: #555;
        }

        .manage-category {
            text-align: right;
            color: #007bff;
            font-weight: bold;
        }

        .manage-category a {
            color: #007bff;
            text-decoration: none;
        }

        .manage-category a:hover {
            text-decoration: underline;
        }

    </style>

</head>
<body>
    <div class="form-container">
        <h2>เพิ่มรายการ</h2>
        <form action="input.php" method="post">
            <input type="hidden" name="id_money" value="">
            <table>
                <tr>
                    <td>วัน/เดือน/ปี:</td>
                    <td><input type="datetime-local" name="date_time"></td>
                </tr>
                <tr>
                    <td>รายการ:</td>
                    <td><input type="text" name="description_money"></td>
                </tr>
                <tr>
                    <td>ประเภท:</td>
                    <td>
                        <select class="form-select" aria-label="Default select example" name="type_use">
                            <option value="รายรับ">รายรับ</option>
                            <option value="รายจ่าย">รายจ่าย</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>จำนวน:</td>
                    <td><input type="text" name="amount"></td>
                </tr>
                <tr>
                    <td>หมวดหมู่:</td>
                    <td>
                        <select class="form-select" name="category">
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <option value="<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="manage-category">
                        <a href="delete_category.php">จัดการหมวดหมู่</a>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" align="right">
                        <input class="btn btn-success" type="submit" value="บันทึก">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
<?php
$conn->close();
?>
