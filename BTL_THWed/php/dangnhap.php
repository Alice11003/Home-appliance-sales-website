<?php
// Xử lý đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Lấy giá trị từ form đăng nhập
    $password = $_POST['password']; // Lấy giá trị mật khẩu từ form

    // Kiểm tra thông tin đăng nhập từ cơ sở dữ liệu
    if ($username === 'admin' && $password === '123456') { // Thay điều kiện bằng logic kiểm tra CSDL
        session_start();
        $_SESSION['username'] = $username; // Gán tên người dùng vào session
        header("Location: home2.php"); // Điều hướng sau khi đăng nhập thành công
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background-color: #9c9c9c;
            font-family: Arial, sans-serif;
        }
        form {
            background-color: #ffffff;
            padding: 20px; 
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 320px;
            width: 100%;
            text-align: center;
        }
        h2 {
            color: #EE7600;
            margin-bottom: 20px; 
            font-size: 30px; 
        }
        label {
            display: block;
            text-align: left;
            margin: 6px 0 3px; 
            color: #333;
            font-size: 14px; 
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 7px; 
            margin-bottom: 7px; 
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px; 
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #2c7a7b;
            outline: none;
        }
        input[type="submit"] {
            background-color: #1c1c1c;
            color: white;
            padding: 10px; 
            font-size: 16px;
            border: none;
            border-radius: 4px;
            margin-top: 20px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #FF7621; 
        }
        input[type="submit"]:active {
            background-color: #276749; 
        }
        .message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form action="" method="post" >
        <h2>ĐĂNG NHẬP</h2>
        <label for="username">Tên đăng nhập :</label>
        <input type="text" name="username" value="" required><br>
        <label for="password">Mật khẩu :</label>
        <input type="password" name="password" value="" required><br>
        <input type="submit" value="Đăng Nhập">
        <?php
        $servername = "localhost";
        $db_username = "root";
        $db_password = ""; 
        $dbname = "ql_webbanhang";

        $conn = new mysqli($servername, $db_username, $db_password, $dbname);
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                header("Location: home2.php"); 
                exit();
            } else {
                echo '<p class="message">Tên đăng nhập hoặc mật khẩu không đúng!</p>';
            }
        }
        $conn->close();
        ?>
        <p class="dangky">Bạn chưa có tài khoản? <a href="dangky.php">Đăng ký ngay</a></p>
    </form>
</body>
</html>
