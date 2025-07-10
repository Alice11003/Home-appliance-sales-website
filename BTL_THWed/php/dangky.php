<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
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
            padding: 12px; 
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 320px;
            width: 100%;
            text-align: center;
        }
        h2 {
            color: #EE7600;
            margin-bottom: 12px; 
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
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 7px; 
            margin-bottom: 4px; 
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px; 
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #2c7a7b;
            outline: none;
        }
        input[type="submit"] {
            background-color: #1c1c1c;
            color: white;
            padding: 10px; 
            margin-top: 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
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
        <h2>ĐĂNG KÝ</h2>
        <label for="accountname">Tên tài khoản :</label>
        <input type="text" name="accountname" value="" required><br>
        <label for="username">Tên đăng nhập :</label> 
        <input type="text" name="username" value="" required><br>
        <label for="email">Email :</label>
        <input type="email" name="email" value="" required><br>
        <label for="phone">Số điện thoại :</label>
        <input type="text" name="phone" value="" required><br>
        <label for="address">Địa chỉ :</label>
        <input type="text" name="address" value="" required><br>
        <label for="password">Mật khẩu :</label>
        <input type="password" name="password" value="" required><br>
        <label for="confirm_password">Nhập lại mật khẩu :</label>
        <input type="password" name="confirm_password" value="" required><br>
        <input type="submit" value="Đăng Ký">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = ""; 
            $dbname = "ql_webbanhang";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }
            $message = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $accountname = $_POST['accountname'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];

                if ($password !== $confirm_password) {
                    $message = "Mật khẩu và mật khẩu xác nhận không khớp!";
                } else {
                    $raw_password = $confirm_password;
                    $sql_check = "SELECT * FROM user WHERE username = '$username' OR email = '$email' OR accountname = '$accountname' OR phone = '$phone'";
                    $result_check = $conn->query($sql_check);
                    if ($result_check->num_rows > 0) {
                        $message = "Tên đăng nhập, email, tài khoản, hoặc số điện thoại đã tồn tại!";
                    } else {
                        $sql_insert = "INSERT INTO user (accountname, username, email, phone, address, password)
                                    VALUES ('$accountname', '$username', '$email', '$phone', '$address', '$raw_password')";

                        if ($conn->query($sql_insert) === TRUE) {
                            header("Location: dangnhap.php");
                            exit();
                        } else {
                            $message = "Lỗi: " . $conn->error;
                        }
                    }
                }
            }
            $conn->close();
            ?>
            <?php if (!empty($message)) { ?>
                <p class="message"><?php echo $message; ?></p>
            <?php } 
        ?>
        <p class="dangnhap">Bạn đã có tài khoản? <a href="dangnhap.php">Đăng nhập</a></p>
    </form>
</body>
</html>

