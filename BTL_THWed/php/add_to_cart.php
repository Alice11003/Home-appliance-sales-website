<?php
session_start();

// Lấy ID sản phẩm từ yêu cầu
$id = isset($_POST['id']) ? $_POST['id'] : 0;

// Kiểm tra nếu sản phẩm đã có trong giỏ hàng
if (isset($_SESSION['cart'][$id])) {
    // Tăng số lượng lên 1 nếu sản phẩm đã có trong giỏ hàng
    $_SESSION['cart'][$id]++;
} else {
    // Thêm sản phẩm với số lượng mặc định là 1
    $_SESSION['cart'][$id] = 1;
}

// Quay lại trang giỏ hàng hoặc hiển thị thông báo thành công
header("Location: giohang.php");
exit;
?>
