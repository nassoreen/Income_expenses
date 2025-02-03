<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px; /* เพิ่มช่องว่างระหว่างปุ่ม */
        }

        .btn-custom {
            width: 300px; /* กำหนดความกว้างให้เท่ากัน */
            padding: 15px; /* เพิ่มขนาดของปุ่ม */
            font-size: 18px; /* เพิ่มขนาดฟอนต์ */
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px; /* เพิ่มช่องว่างระหว่างไอคอนและข้อความ */
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .btn-summary-date {
            background-color: #4CAF50; /* สีเขียวอ่อน */
        }

        .btn-summary-date:hover {
            background-color: #45a049; /* สีเขียวเข้มเมื่อ hover */
        }

        .btn-summary-category {
            background-color: #2E8B57; /* สีเขียวเข้ม */
        }

        .btn-summary-category:hover {
            background-color: #267347; /* สีเขียวที่เข้มขึ้นเมื่อ hover */
        }

        .btn-custom i {
            font-size: 24px; /* ขนาดของไอคอน */
        }

    </style>
</head>
<body>
    <div class="button-container">
        <!-- ปุ่มสรุปรายรับ-รายจ่ายประจำวัน สัปดาห์ เดือน ปี -->
        <a href="choice_summary_date.php" class="btn btn-custom btn-summary-date">
            <i class="bi bi-calendar3"></i> สรุปรายรับ-รายจ่ายประจำวัน สัปดาห์ เดือน ปี
        </a>

        <!-- ปุ่มสรุปรายรับ-รายจ่ายตามหมวดหมู่ -->
        <a href="summary_inexc.php" class="btn btn-custom btn-summary-category">
            <i class="bi bi-bar-chart-line"></i> สรุปรายรับ-รายจ่ายตามหมวดหมู่
        </a>
    </div>

    <!-- Bootstrap icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
</body>
</html>
