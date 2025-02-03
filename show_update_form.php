<?php
    $id_money = $_REQUEST["id_money"];   
    $sel_sql = "SELECT * FROM moneyrecord WHERE id_money='" . $id_money . "'";

    $conn = mysqli_connect("localhost", "root", "", "expense_tracker");
    $rs = mysqli_query($conn, $sel_sql);

    $row = mysqli_fetch_assoc($rs);

    $sql = "SELECT * FROM category";
    $result = $conn->query($sql);
?>



<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    <!--ใช้ Bootstrap -->

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
        .form-container input[type="date"],
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
    </style>
</head>
</head>
<body>
    <div class="form-container">
        <h2>แก้ไขรายการ</h2>
        <form action="do_update.php" method="post">
        <input type="hidden" name="id_money" value="<?=$id_money; ?>">
            <table>
                <tr>
                    <td>วัน/เดือน/ปี:</td>
                    <td><input type="datetime-local" name="date_time" value="<?=$row["date_time"]; ?>"></td>
                </tr>
                <tr>
                    <td>รายการ:</td>
                    <td><input type="text" name="description_money" value="<?=$row["description_money"]; ?>"></td>
                </tr>
                <tr>
                    <td>ประเภท:</td>
                    <td>
                        <select class="form-select" aria-label="Default select example" name="type_use">
                          <option value="รายรับ" <?=($row["type_use"] == "รายรับ") ? "selected" : ""; ?>>รายรับ</option>
                          <option value="รายจ่าย" <?=($row["type_use"] == "รายจ่าย") ? "selected" : ""; ?>>รายจ่าย</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>จำนวน:</td>
                    <td><input type="text" name="amount" value="<?=$row["amount"]; ?>"></td>
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
                    <td  colspan="2" align="right">
                        <input class="btn btn-success" type="submit" value="บันทึก">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
