<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expense_tracker";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];

    // ตรวจสอบว่ามีชื่อหมวดหมู่หรือไม่
    if (!empty($category_name)) {
        // เพิ่มหมวดหมู่ใหม่
        $sql = "INSERT INTO category (category_name) VALUES ('$category_name')";
        
        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success d-flex align-items-center" role="alert">';
            echo '<i class="bi bi-check-circle me-2" style="font-size: 24px;"></i>'; 
            echo 'เพิ่มหมวดหมู่สำเร็จ';
            echo '</div>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
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
        <a href="delete_category.php">กลับไปยังหน้าหลัก</a>
    </div>
    </body>
</html>
