<?php
// Kết nối cơ sở dữ liệu và khởi tạo session
session_start();
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "ql_webbanhang";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET['add_to_cart'])) {
    $idsp = $_GET['add_to_cart'];

    // Nếu giỏ hàng chưa tồn tại thì tạo giỏ hàng
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Nếu sản phẩm đã có trong giỏ thì tăng số lượng, ngược lại thiết lập số lượng ban đầu là 1
    if (isset($_SESSION['cart'][$idsp])) {
        $_SESSION['cart'][$idsp]++;
    } else {
        $_SESSION['cart'][$idsp] = 1;
    }

    // Chuyển hướng để tránh thêm lại sản phẩm khi tải lại trang
    header("Location: home.php");
    exit();
}

// Kiểm tra xem có tham số category trên URL không
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Xây dựng truy vấn SQL dựa trên danh mục
if ($category) {
    $sql = "SELECT idsp, hinhanh, tensp, giasp FROM sanpham WHERE danhmuc = '$category'";
} else {
    $sql = "SELECT idsp, hinhanh, tensp, giasp FROM sanpham"; // Hiển thị tất cả sản phẩm
}

$result = $conn->query($sql);
?>
<!-- home.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website bán hàng gia dụng</title>
    <style>
        body {
            background-color: #FBEEC1;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }     
    </style>
</head>
<body>

<?php include 'header2.php'; ?>
<?php include 'banner.php'; ?>  
<?php include 'menuSale.php'; ?> 
<?php include 'back.php'; ?> 
<?php include 'footer.php'; ?>

</body>
</html>
