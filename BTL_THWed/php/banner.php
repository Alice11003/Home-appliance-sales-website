<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider PHP</title>
    <style>
        /* Container bao quanh slider và container ảnh nhỏ */
        .carousel-container {
            background-color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    max-width: 100%; /* Đặt chiều rộng giới hạn cho container */
    margin: auto; /* Căn giữa container chính */
        }

        /* Container ảnh nhỏ ở bên phải */
        .small-images-container {
            display: flex;
            margin-top: 150px;
            flex-direction: column;
            gap: 15px;
            width: 400px;
        }

        /* Ảnh nhỏ */
        .small-image {
            margin-left: 20px;
            margin-top: 10px;
            width: 360px;
            border-radius: 10px;
            overflow: hidden;
        }

        .small-image img {
            width: 100%;
            height: 190px;
            display: block;
        }

        /* Container của Carousel */
        .carousel {
            margin-top: 200px;
            width: 700px;
            height: 440px;
            overflow: hidden;
            border-radius: 10px 10px 10px 10px;
        }

        /* Phần Slide */
        .slides {
            display: flex;
            height: 400px;
            border-radius: 10px;
            transition: transform 0.5s ease;
        }

        /* Mỗi slide hình ảnh */
        .slide {
            min-width: 100%;
            height: 400px;
            border-radius: 10px;
            box-sizing: border-box;
        }

        /* Dấu chấm để điều hướng */
        .dots {
            text-align: center;
            margin-top: -25px;
            margin-left: -420px;
        }

        .dot {
            cursor: pointer;
            height: 10px;
            width: 10px;
            margin: 0 5px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .active,
        .dot:hover {
            background-color: #717171;
        }
/* Nút điều hướng trái và phải */
.prev, .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    transform: translateY(50%);
    width: 40px;
    height: 40px;
    padding: 0;
    color: white;
    font-weight: bold;
    font-size: 18px;
    border-radius: 50%; /* Tạo nút hình tròn */
    background-color: rgba(0, 0, 0, 0.2); /* Nền mờ cho nút */
    display: flex;
    justify-content: center;
    align-items: center;
    transition: background-color 0.3s ease;
    user-select: none;
    z-index: 900; /* Đảm bảo nút điều hướng nằm trên slide */
}

.prev {
    left: 185px; /* Căn nút trái cách lề trái của slide */
}

.next {
    right: 605px; /* Căn nút phải cách lề phải của slide */
}

/* Hiệu ứng khi di chuột qua nút */
.prev:hover, .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
}



    </style>
</head>
<body>

<?php
    $sliderImages = [
        "../image/anh1.jpg",
        "../image/anh2.jpg",
        "../image/anh3.jpg",
        "../image/anh4.jpg",
        "../image/anh5.jpg",
        "../image/anh6.jpg"
    ];

    $smallImages = [
        "../image/anhnho1.jpg",
        "../image/anhnho2.jpg"
    ];
?>



<div class="carousel-container">
    <!-- Slider chính -->
    <div class="carousel">
        <div class="slides">
            <?php foreach ($sliderImages as $index => $image): ?>
                <div class="slide">
                    <img src="<?php echo $image; ?>" alt="Hình <?php echo $index + 1; ?>" style="width:100%">
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Nút điều hướng -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <!-- Container ảnh nhỏ bên phải -->
    <div class="small-images-container">
        <?php foreach ($smallImages as $index => $smallImage): ?>
            <div class="small-image">
                <img src="<?php echo $smallImage; ?>" alt="Ảnh nhỏ <?php echo $index + 1; ?>">
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Dấu chấm điều hướng -->
<div class="dots">
    <?php for ($i = 1; $i <= count($sliderImages); $i++): ?>
        <span class="dot" onclick="currentSlide(<?php echo $i; ?>)"></span>
    <?php endfor; ?>
</div>

<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    // Tự động chuyển slide sau mỗi 3 giây
    setInterval(() => {
        plusSlides(1);
    }, 3000);

    // Điều khiển nút tới/lui
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Điều khiển bằng dấu chấm
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("slide");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) { slideIndex = 1 }
        if (n < 1) { slideIndex = slides.length }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
</script>

</body>
</html>
