<?php

session_start();

$search = "";

if (isset($_POST['btnSearch'])) {
    $search = $_POST['txtSearch'];
}

if (isset($_POST['btnUnpublish'])) {
    $modIndex    = $_POST['moduleIndex'];
    $textsource  = "modules.txt";
    $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);
    $newcontent  = "";

    foreach ($textcontent as $index => $linetext) {
        if ($index == $modIndex + 4) {
            $newcontent = $newcontent . "unpublished" . "\n";
        } else {
            $newcontent = $newcontent . $linetext . "\n";
        }
    }

    file_put_contents($textsource, $newcontent);
    echo "<script>alert('Module unpublished.'); window.location='searchmodule.php';</script>";
}

if (isset($_POST['btnPublish'])) {
    $modIndex    = $_POST['moduleIndex'];
    $textsource  = "modules.txt";
    $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);
    $newcontent  = "";

    foreach ($textcontent as $index => $linetext) {
        if ($index == $modIndex + 4) {
            $newcontent = $newcontent . "published" . "\n";
        } else {
            $newcontent = $newcontent . $linetext . "\n";
        }
    }

    file_put_contents($textsource, $newcontent);
    echo "<script>alert('Module published.'); window.location='searchmodule.php';</script>";
}

if (isset($_POST['btnDelete'])) {
    $modIndex    = $_POST['moduleIndex'];
    $textsource  = "modules.txt";
    $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);
    $newcontent  = "";

    foreach ($textcontent as $index => $linetext) {
        if ($index >= $modIndex && $index <= $modIndex + 4) {
            // skip
        } else {
            $newcontent = $newcontent . $linetext . "\n";
        }
    }

    file_put_contents($textsource, $newcontent);
    echo "<script>alert('Module deleted.'); window.location='searchmodule.php';</script>";
}

?>

<html>
<head>
    <title>Learning Materials</title>
    <link rel="stylesheet" href="css/style.css">
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
        <li><a href="searchmodule.php" class="nav-active">Modules</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="container">

    <div class="page-header">
        <div>
            <h1 style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:700; color:#FFFFFF;">Learning Materials</h1>
            <p style="color:#888; font-size:0.88rem; margin-top:4px;">Browse and download modules shared by teachers</p>
        </div>
    </div>

    <div class="card">
        <form method="POST">
            <div class="search-bar">
                <div class="form-group">
                    <label>Search by Subject</label>
                    <input type="text" name="txtSearch" class="form-control" placeholder="e.g. Programming, Mathematics...">
                </div>
                <input type="submit" name="btnSearch" value="Search" class="btn">
            </div>
        </form>
    </div>

    <?php

    $textsource  = "modules.txt";
    $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);

    // step 1 - collect all unique categories
    $allcategories = [];

    foreach ($textcontent as $index => $linetext) {
        if ($index % 5 == 0) {
            $category = $textcontent[$index + 1];
            $status   = $textcontent[$index + 4];

            if ($_SESSION['sesUserType'] != "Teacher" && $status != "published") continue;
            if ($search != "" && $search != $textcontent[$index] && $search != $category) continue;

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

    // step 2 - for each category show its modules
    if (count($allcategories) == 0) {
        echo '<div class="empty-state"><p>No modules found.</p></div>';
    }

    foreach ($allcategories as $cat) {

        echo "<div class='subject-section'>";
        echo "<div class='subject-section-header'><h2>" . $cat . "</h2></div>";
        echo "<div class='module-grid'>";

        foreach ($textcontent as $index => $linetext) {
            if ($index % 5 == 0) {

                $subject  = $textcontent[$index];
                $category = $textcontent[$index + 1];
                $filetype = $textcontent[$index + 2];
                $filepath = $textcontent[$index + 3];
                $status   = $textcontent[$index + 4];

                if ($_SESSION['sesUserType'] != "Teacher" && $status != "published") continue;
                if ($search != "" && $search != $subject && $search != $category) continue;
                if ($category != $cat) continue;

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

                        <a class="download-btn" href="download.php?file=<?php echo $filepath; ?>">Download Module</a>

                        <?php
                        if ($_SESSION['sesUserType'] == "Teacher") {
                            if ($status == "published") {
                                echo "
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='moduleIndex' value='" . $index . "'>
                                    <input type='submit' name='btnUnpublish' value='Unpublish' class='btn-unpublish'>
                                </form>";
                            } else {
                                echo "
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='moduleIndex' value='" . $index . "'>
                                    <input type='submit' name='btnPublish' value='Publish' class='btn-publish'>
                                </form>";
                            }

                            echo "
                            <form method='POST' style='display:inline;' onsubmit=\"return confirm('Permanently DELETE this module? This cannot be undone.');\">
                                <input type='hidden' name='moduleIndex' value='" . $index . "'>
                                <input type='submit' name='btnDelete' value='Delete' class='btn-delete'>
                            </form>";
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
    <strong>Scholara</strong> &mdash; Learning Materials Library &copy; 2026
</div>

</body>
</html>