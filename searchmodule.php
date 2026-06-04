<?php

session_start();

$search = "";

if (isset($_POST['btnSearch'])) {
    $search = $_POST['txtSearch'];
}

if (isset($_POST['btnUnpublish'])) {
    $modIndex = $_POST['moduleIndex'];
    $textsource = "modules.txt";
    $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);
    $newcontent = "";

    foreach ($textcontent as $index => $linetext) {
        if ($index == $modIndex + 4) {
            $newcontent .= "unpublished\n";
        } else {
            $newcontent .= $linetext . "\n";
        }
    }

    file_put_contents($textsource, $newcontent);
    echo "<script>alert('Module unpublished.'); window.location='searchmodule.php';</script>";
}

if (isset($_POST['btnPublish'])) {
    $modIndex = $_POST['moduleIndex'];
    $textsource = "modules.txt";
    $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);
    $newcontent = "";

    foreach ($textcontent as $index => $linetext) {
        if ($index == $modIndex + 4) {
            $newcontent .= "published\n";
        } else {
            $newcontent .= $linetext . "\n";
        }
    }

    file_put_contents($textsource, $newcontent);
    echo "<script>alert('Module published.'); window.location='searchmodule.php';</script>";
}

if (isset($_POST['btnDelete'])) {

    $modIndex = $_POST['moduleIndex'];
    $textsource = "modules.txt";
    $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);

    $filepath = $textcontent[$modIndex + 3];

    if (file_exists($filepath)) {
        unlink($filepath);
    }

    $newcontent = "";

    foreach ($textcontent as $index => $linetext) {

        if ($index >= $modIndex && $index <= $modIndex + 4) {
        } else {
            $newcontent .= $linetext . "\n";
        }

    }

    file_put_contents($textsource, $newcontent);

    echo "
    <script>
        alert('Module and file deleted successfully.');
        window.location='searchmodule.php';
    </script>";
}

?>

<html>

<head>
    <title>Learning Materials</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* ── SEARCH MODULE HERO (mirrors student-hero-card) ── */
        .search-hero-card {
            position: relative;
            background: linear-gradient(135deg, #1a0a09 0%, #2d1210 40%, #96281B 100%);
            border-radius: 24px;
            padding: 48px 48px 0;
            margin-bottom: 24px;
            overflow: hidden;
            box-shadow: 0 12px 48px rgba(192,57,43,0.28);
        }

        .search-hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 32px;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }

        .search-hero-text {
            flex: 1;
            min-width: 260px;
        }

        .search-hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 14px;
        }

        .search-hero-sub {
            color: rgba(255,255,255,0.65);
            font-size: 0.95rem;
            line-height: 1.7;
            max-width: 460px;
        }

        .search-hero-badge-wrap {
            flex-shrink: 0;
        }

        /* ── Search form bar inside the hero ── */
        .search-hero-form-wrap {
            position: relative;
            z-index: 1;
            background: rgba(255,255,255,0.07);
            border-top: 1px solid rgba(255,255,255,0.12);
            margin: 0 -48px;
            padding: 22px 48px;
            backdrop-filter: blur(6px);
        }

        .search-hero-form {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .search-hero-input {
            flex: 1;
            padding: 13px 18px;
            border-radius: 10px;
            border: 1.5px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.12);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.93rem;
            transition: border-color 0.25s, background 0.25s;
        }

        .search-hero-input::placeholder {
            color: rgba(255,255,255,0.45);
        }

        .search-hero-input:focus {
            outline: none;
            border-color: rgba(255,255,255,0.55);
            background: rgba(255,255,255,0.18);
        }

        .search-hero-btn {
            background: #fff;
            color: var(--red-dark, #96281B);
            border: none;
            padding: 13px 30px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 700;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
            box-shadow: 0 4px 16px rgba(0,0,0,0.18);
            flex-shrink: 0;
        }

        .search-hero-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(0,0,0,0.25);
            background: #fdf0ef;
        }

        @media (max-width: 768px) {
            .search-hero-card {
                padding: 36px 28px 0;
            }

            .search-hero-form-wrap {
                margin: 0 -28px;
                padding: 18px 28px;
            }

            .search-hero-title {
                font-size: 1.7rem;
            }

            .search-hero-badge-wrap {
                display: none;
            }

            .search-hero-form {
                flex-direction: column;
                align-items: stretch;
            }

            .search-hero-btn {
                text-align: center;
            }
        }
    </style>
</head>

<body class="has-bg">

    <div class="navbar">
        <div class="logo">Scholara</div>

        <ul>
            <li>
                <?php
                if ($_SESSION['sesUserType'] == "Teacher") {
                    echo "<a href='home.php'>Home</a>";
                } else {
                    echo "<a href='studenthome.php'>Home</a>";
                }
                ?>
            </li>

            <?php
            if ($_SESSION['sesUserType'] == "Teacher") {
                echo "<li><a href='uploadmodule.php'>Upload</a></li>";
            }
            ?>

            <li><a href="searchmodule.php" class="nav-active">Browse Modules</a></li>
            <li><a href="logout.php">Logout</a></li>
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

        <!-- Search Hero Card (styled like student-hero-card) -->
        <div class="search-hero-card">
            <div class="student-hero-bg-shapes">
                <span class="shape shape-1"></span>
                <span class="shape shape-2"></span>
                <span class="shape shape-3"></span>
            </div>

            <div class="search-hero-content">
                <div class="search-hero-text">
                    <span class="student-greeting-eyebrow">Scholara Library</span>
                    <h1 class="search-hero-title">Learning Materials</h1>
                    <p class="search-hero-sub">Browse and download modules shared by teachers — organised by subject and category.</p>
                </div>

                <div class="search-hero-badge-wrap">
                    <div class="student-role-badge">
                        <span class="student-role-label">Browsing as</span>
                        <strong class="student-role-name">
                            <?php echo $_SESSION['sesUserType']; ?>
                        </strong>
                    </div>
                </div>
            </div>

            <!-- Search bar embedded in the hero -->
            <div class="search-hero-form-wrap">
                <form method="POST" class="search-hero-form">
                    <input type="text"
                           name="txtSearch"
                           class="search-hero-input"
                           placeholder="Search by subject or category, e.g. Programming, Mathematics…"
                           value="<?php echo htmlspecialchars($search); ?>">
                    <input type="submit"
                           name="btnSearch"
                           value="Search"
                           class="search-hero-btn">
                </form>
            </div>
        </div>

        <!-- Feature strip (styled like student-feature-strip) -->
        <div class="student-feature-strip" style="margin-bottom: 32px;">
            <div class="student-feature-item">
                <div class="student-feature-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                </div>
                <div>
                    <h4>Browse Modules</h4>
                    <p>Access all learning materials by subject</p>
                </div>
            </div>
            <div class="student-feature-divider"></div>
            <div class="student-feature-item">
                <div class="student-feature-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </div>
                <div>
                    <h4>Download Anytime</h4>
                    <p>Save PDFs, documents, and study files</p>
                </div>
            </div>
            <div class="student-feature-divider"></div>
            <div class="student-feature-item">
                <div class="student-feature-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </div>
                <div>
                    <h4>Search by Subject</h4>
                    <p>Filter modules to find exactly what you need</p>
                </div>
            </div>
        </div>
                <!-- ai -->
        <?php
        $textsource = "modules.txt";
        $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);

        $allcategories = [];

        foreach ($textcontent as $index => $linetext) { 

            if ($index % 5 == 0) {

                $category = $textcontent[$index + 1];
                $status = $textcontent[$index + 4];

                if ($_SESSION['sesUserType'] != "Teacher" && $status != "published") {
                    continue;
                }

                if ($search != "" && $search != $textcontent[$index] && $search != $category) {
                    continue;
                }

                $alreadyadded = false;

                foreach ($allcategories as $cat) {
                    if ($cat == $category) {
                        $alreadyadded = true;
                    }
                }

                if ($alreadyadded == false) {
                    $allcategories[] = $category;
                }
            }
        }

        if (count($allcategories) == 0) {
            echo '<div class="empty-state"><p>No modules found.</p></div>';
        }

        foreach ($allcategories as $cat) {

            echo "<div class='subject-section'>";
            echo "<div class='subject-section-header'><h2>" . $cat . "</h2></div>";
            echo "<div class='module-grid'>";

            foreach ($textcontent as $index => $linetext) {

                if ($index % 5 == 0) {

                    $subject = $textcontent[$index];
                    $category = $textcontent[$index + 1];
                    $filetype = $textcontent[$index + 2];
                    $filepath = $textcontent[$index + 3];
                    $status = $textcontent[$index + 4];

                    if ($_SESSION['sesUserType'] != "Teacher" && $status != "published") {
                        continue;
                    }

                    if ($search != "" && $search != $subject && $search != $category) {
                        continue;
                    }

                    if ($category != $cat) {
                        continue;
                    }

        ?>

                    <div class="module-card <?php if ($status == 'unpublished') { echo 'module-card-unpublished'; } ?>">

                        <?php
                        if ($_SESSION['sesUserType'] == "Teacher" && $status == "unpublished") {
                            echo "<span class='module-status-badge'>Unpublished</span>";
                        }
                        ?>

                        <span class="module-card-type"><?php echo $filetype; ?></span>

                        <h3><?php echo $subject; ?></h3>

                        <div class="module-card-spacer"></div>

                        <div class="module-card-footer">

                            <a class="download-btn"
                               href="download.php?file=<?php echo $filepath; ?>">
                                Download Module
                            </a>

                            <?php
                            if ($_SESSION['sesUserType'] == "Teacher") {

                                echo "<div class='teacher-actions'>";

                                if ($status == "published") {

                                    echo "
                                    <form method='POST'>
                                        <input type='hidden'
                                               name='moduleIndex'
                                               value='" . $index . "'>

                                        <input type='submit'
                                               name='btnUnpublish'
                                               value='Unpublish'
                                               class='btn-unpublish'>
                                    </form>";

                                } else {

                                    echo "
                                    <form method='POST'>
                                        <input type='hidden'
                                               name='moduleIndex'
                                               value='" . $index . "'>

                                        <input type='submit'
                                               name='btnPublish'
                                               value='Publish'
                                               class='btn-publish'>
                                    </form>";
                                }

                                echo "
                                <form method='POST'
                                      onsubmit=\"return confirm('Permanently DELETE this module? This cannot be undone.');\">

                                    <input type='hidden'
                                           name='moduleIndex'
                                           value='" . $index . "'>

                                    <input type='submit'
                                           name='btnDelete'
                                           value='Delete'
                                           class='btn-delete'>
                                </form>";

                                echo "</div>";
                            }
                            ?>

                        </div>

                    </div>

        <?php
                }
            }

            echo "</div>";
            echo "</div>";
        }

        ?>

    </div>

    <div class="footer">

        <strong>Scholara</strong> &mdash; Student Portal &copy; 2026

    </div>  

    <!-- //ai -->

</body>

</html>