<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ql_webbanhang";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
if (!empty($cart_items)) {
    $ids = implode(',', array_keys($cart_items));
    $sql = "SELECT idsp, tensp, giasp FROM sanpham WHERE idsp IN ($ids)";
    $result = $conn->query($sql);
} else {
    $result = null;
}

$totalAmount = 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn Thanh Toán</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: auto;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .total {
            text-align: right;
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
        }

        .print-btn {
            margin-top: 20px;
            display: block;
            text-align: center;
        }

        .print-btn button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .print-btn button:hover {
            background-color: #218838;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="invoice-container">
    <h1>Hóa Đơn Thanh Toán</h1>
    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Tổng cộng</th>
            </tr>
            <?php
            $grandTotal = 0;
            foreach ($cart_items as $id => $quantity):
                $result->data_seek(0);
                while ($row = $result->fetch_assoc()):
                    if ($row['idsp'] == $id) {
                        $itemTotal = $row['giasp'] * $quantity;
                        $grandTotal += $itemTotal;
                        ?>
                        <tr>
                            <td><?php echo $row['tensp']; ?></td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo number_format($row['giasp'], 0, ',', '.'); ?> VND</td>
                            <td><?php echo number_format($itemTotal, 0, ',', '.'); ?> VND</td>
                        </tr>
                    <?php }
                endwhile;
            endforeach; ?>
        </table>
        <p class="total">Tổng tiền: <?php echo number_format($grandTotal, 0, ',', '.'); ?> VND</p>
        <div class="print-btn">
            <button onclick="window.print()">In Hóa Đơn</button>
        </div>
    <?php else: ?>
        <p>Giỏ hàng của bạn đang trống.</p>
    <?php endif; ?>
</div>
</body>
</html>

<?php 
$conn->close(); 
?>
