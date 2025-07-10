<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nút Trở Về Đầu Trang và Liên Hệ Đa Kênh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Định dạng chung cho các nút */
        .contact-button {
            position: fixed;
            width: 50px;
            height: 50px;
            color: white;
            font-size: 24px;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.3s ease;
            z-index: 1000;
            text-decoration: none; /* Bỏ gạch chân */
        }

        .contact-button:hover {
            transform: translateY(-5px) scale(1.1); /* Di chuyển lên và phóng to khi hover */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            opacity: 1; /* Đặt độ mờ 100% khi hover */
        }

        /* Nút trở về đầu trang (bên phải) */
        #backToTopBtn {
            bottom: 20px;
            right: 20px;
            background-color: #B0B0B0;
            opacity: 0.5; /* Đặt độ mờ 50% cho nút trở về đầu trang */
        }

        /* Nút Zalo (bên trái) */
        #zaloBtn {
            bottom: 90px;
            left: 20px;
            background-color: #0084ff;
            opacity: 0.7; /* Đặt độ mờ 70% cho nút Zalo */
        }

        /* Định dạng hình ảnh trong nút Zalo */
        #zaloBtn img {
            width: 60%; /* Điều chỉnh kích thước của logo Zalo */
            height: 60%;
            object-fit: cover;
            border-radius: 50%; /* Đảm bảo logo nằm gọn trong nút tròn */
        }

        /* Nút Facebook (bên trái) */
        #facebookBtn {
            bottom: 20px;
            left: 20px;
            background-color: #3b5998;
            opacity: 0.7; /* Đặt độ mờ 70% cho nút Facebook */
        }
    </style>
</head>
<body>

    <!-- Nút trở về đầu trang -->
    <button onclick="topFunction()" id="backToTopBtn" class="contact-button">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Nút Zalo -->
    <a href="https://zalo.me/0393298532" target="_blank" id="zaloBtn" class="contact-button">
        <img src="../image/zalo.jpg" alt="Zalo">
    </a>

    <!-- Nút Facebook -->
    <a href="https://www.facebook.com/profile.php?id=100081872027592" target="_blank" id="facebookBtn" class="contact-button">
        <i class="fab fa-facebook-f"></i>
    </a>

    <script>
        // Nhận phần tử nút "Trở về đầu trang"
        const backToTopBtn = document.getElementById("backToTopBtn");

        // Hiển thị nút "Trở về đầu trang" khi cuộn xuống 200px
        window.onscroll = function() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                backToTopBtn.style.display = "flex";
            } else {
                backToTopBtn.style.display = "none";
            }
        };

        // Hàm cuộn về đầu trang khi nhấp vào nút "Trở về đầu trang"
        function topFunction() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }
    </script>

</body>
</html>
