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

<body class="has-bg">

    <div class="navbar">

        <div class="logo">Scholara</div>

        <ul>

            <li>
                <a href="studenthome.php" class="nav-active">Home</a>
            </li>

            <li>
                <a href="searchmodule.php">Browse Modules</a>
            </li>

            <li>
                <a href="logout.php">Logout</a>
            </li>

        </ul>

    </div>
        <!-- //ai -->
    <div class="carousel-container">
        <div class="carousel-slides">
            <img src="images/banner1.jpg" class="carousel-slide" alt="Slide 1">
            <img src="images/banner2.jpg" class="carousel-slide" alt="Slide 2">
            <img src="images/banner3.jpg" class="carousel-slide" alt="Slide 3">
        </div>
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

        <div class="student-hero-card">

            <div class="student-hero-bg-shapes">
                <span class="shape shape-1"></span>
                <span class="shape shape-2"></span>
                <span class="shape shape-3"></span>
            </div>

            <div class="student-hero-content">

                <div class="student-hero-greeting">
                    <span class="student-greeting-eyebrow">Good to see you</span>
                    <h1 class="student-hero-name">
                        Welcome back, <em><?php echo $_SESSION['sesUser']; ?></em>
                    </h1>
                    <p class="student-hero-sub">
                        Your learning materials are ready. Browse modules shared by your teachers and download what you need — all in one place.
                    </p>
                    <div class="student-hero-actions">
                        <a href="searchmodule.php" class="btn student-cta-btn">Browse Modules</a>
                        <span class="student-hero-hint">All subjects available</span>
                    </div>
                </div>

                <div class="student-hero-badge-wrap">
                    <div class="student-role-badge">
                        <span class="student-role-label">Logged in as</span>
                        <strong class="student-role-name">Student</strong>
                    </div>
                </div>

            </div>

        </div>

        <div class="student-feature-strip">

            <div class="student-feature-item">
                <div class="student-feature-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                </div>
                <div>
                    <h4>Browse Modules</h4>
                    <p>Access all learning materials by subject and category</p>
                </div>
            </div>

            <div class="student-feature-divider"></div>

            <div class="student-feature-item">
                <div class="student-feature-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </div>
                <div>
                    <h4>Download Anytime</h4>
                    <p>Save PDFs, documents, and study files to your device</p>
                </div>
            </div>

            <div class="student-feature-divider"></div>

            <div class="student-feature-item">
                <div class="student-feature-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </div>
                <div>
                    <h4>Search by Subject</h4>
                    <p>Filter modules by category to find exactly what you need</p>
                </div>
            </div>

        </div>

    </div>

    <div class="footer">

        <strong>Scholara</strong> &mdash; Student Portal &copy; 2026

    </div>  

    <!-- //ai -->

</body>

</html>