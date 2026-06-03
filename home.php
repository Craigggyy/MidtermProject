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

    <title>Dashboard</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body class="has-bg">

    <div class="navbar">

        <div class="logo">Scholara</div>

        <ul>

            <li>
                <a href="home.php">Home</a>
            </li>

            <li>
                <a href="uploadmodule.php">Upload Module</a>
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
                    Welcome back,
                    <?php echo $_SESSION['sesUser']; ?>
                </h1>

                <p>
                    Manage learning modules, upload materials and help students access educational resources efficiently.
                </p>

            </div>

            <div class="card-welcome-badge">
                <span>Logged in as</span>
                <strong>Teacher</strong>
            </div>

        </div>

        <div class="dashboard">

            <div class="dashboard-card">

                <span class="dashboard-card-icon">📚</span>

                <h3>Upload Modules</h3>

                <p>Add learning materials for your students to access and download.</p>

                <a href="uploadmodule.php">
                    <button class="btn">Open</button>
                </a>

            </div>

            <div class="dashboard-card">

                <span class="dashboard-card-icon">🔍</span>

                <h3>Browse Modules</h3>

                <p>Find and manage all uploaded learning resources in one place.</p>

                <a href="searchmodule.php">
                    <button class="btn">Open</button>
                </a>

            </div>

            <div class="dashboard-card">

                <span class="dashboard-card-icon">👨‍🏫</span>

                <h3>Teacher Account</h3>

                <p>Currently logged in to your teacher portal.</p>

                <b><?php echo $_SESSION['sesUser']; ?></b>

            </div>

        </div>

        <div class="card">

            <h2>About Scholara</h2>

            <p>
                Scholara is an E-Learning Module Distribution System that allows teachers to upload modules while students can search and download learning materials seamlessly.
            </p>

        </div>

    </div>

    <div class="footer">

        <strong>Scholara</strong> &mdash; E-Learning Module Distribution System &copy; 2026

    </div>

</body>

</html>