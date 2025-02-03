<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expense_tracker";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM category WHERE id=$id";
    $conn->query($sql);
}

// ดึงหมวดหมู่ทั้งหมด
$sql = "SELECT * FROM category";
$result = $conn->query($sql);
?>

<html>
<head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>จัดการหมวดหมู่</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #dddddd;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            color: #0056b3;
        }
        .delete-btn {
            color: red;
            cursor: pointer;
        }
        .delete-btn:hover {
            color: darkred;
        }

        .back {
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
    <h2 style="text-align: center;">หมวดหมู่ทั้งหมด</h2>
    <br>
    <a href="add_category.php" class="btn btn-success"><i class="bi bi-plus-circle"></i> เพิ่มหมวดหมู่</a>
    <table>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อหมวดหมู่</th>
            <th>การกระทำ</th>
        </tr>
        <?php 
        $i = 1;
        while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['category_name']; ?></td>
                <td>
                    <a href="delete_category.php?delete=<?php echo $row['id']; ?>" class="delete-btn">ลบ</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <div class="link-container">
        <a class="back" href="show_income.php">กลับไปยังหน้าหลัก</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
