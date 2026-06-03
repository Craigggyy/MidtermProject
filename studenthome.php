<?php

session_start();

if (!isset($_SESSION['sesUser']))
{
    die(
        "<script>
        alert('Please Login First');
        window.location='login.php';
        </script>"
    );
}

?>

<html>

<head>

    <title>Student Dashboard</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body class="has-bg bg-1">

    <div class="navbar">

        <div class="logo">Scholara</div>

        <ul>

            <li>
                <a href="studenthome.php">Home</a>
            </li>

            <li>
                <a href="searchmodule.php">Browse Modules</a>
            </li>

            <li>
                <a href="logout.php">Logout</a>
            </li>

        </ul>

    </div>

    <div class="carousel-container">
        <div class="carousel-slides">
            <img src="images/banner1.jpg" class="carousel-slide" alt="Slide 1">
            <img src="images/banner2.jpg" class="carousel-slide" alt="Slide 2">
            <img src="images/banner3.jpg" class="carousel-slide" alt="Slide 3">
        </div>
        <button class="carousel-prev" onclick="changeSlide(-1)">❮</button>
        <button class="carousel-next" onclick="changeSlide(1)">❯</button>
        <div class="carousel-dots">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>

    <script>
    let slideIndex = 1;
    let slideTimer;

    function changeSlide(n) {
        clearTimeout(slideTimer);
        showSlide(slideIndex += n);
        autoSlide();
    }

    function currentSlide(n) {
        clearTimeout(slideTimer);
        showSlide(slideIndex = n);
        autoSlide();
    }

    function showSlide(n) {
        const slides = document.querySelectorAll('.carousel-slide');
        const dots   = document.querySelectorAll('.dot');

        if (n > slides.length) slideIndex = 1;
        if (n < 1) slideIndex = slides.length;

        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));

        slides[slideIndex - 1].classList.add('active');
        dots[slideIndex - 1].classList.add('active');
    }

    function autoSlide() {
        slideTimer = setTimeout(() => {
            slideIndex++;
            showSlide(slideIndex);
            autoSlide();
        }, 5000);
    }

    document.addEventListener('DOMContentLoaded', () => {
        showSlide(slideIndex);
        autoSlide();
    });
    </script>

    <div class="container">

        <div class="card card-welcome">

            <div class="card-welcome-text">

                <h1>
                    Welcome,
                    <?php echo $_SESSION['sesUser']; ?>
                </h1>

                <p>
                    Browse and download learning materials uploaded by your teachers. Find everything you need in one place.
                </p>

                <br>

                <a href="searchmodule.php">
                    <button class="btn">Browse Modules</button>
                </a>

            </div>

            <div class="card-welcome-badge">
                <span>Logged in as</span>
                <strong>Student</strong>
            </div>

        </div>

    </div>

    <div class="footer">

        <strong>Scholara</strong> &mdash; Student Portal &copy; 2026

    </div>

</body>

</html>