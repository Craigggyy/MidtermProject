<?php

session_start();

$search = "";

if (isset($_POST['btnSearch']))
{
    $search = $_POST['txtSearch'];
}

// ── Toggle publish/unpublish (Teacher only) ───────────────────────────────────
if ((isset($_POST['btnUnpublish']) || isset($_POST['btnPublish'])) && isset($_SESSION['sesUserType']) && $_SESSION['sesUserType'] == "Teacher")
{
    $modIndex   = (int)$_POST['moduleIndex'];
    $textsource = "modules.txt";

    if (file_exists($textsource))
    {
        $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);

        $newStatus = isset($_POST['btnUnpublish']) ? "unpublished" : "published";
        $textcontent[$modIndex + 4] = $newStatus;

        $file = fopen($textsource, "w");
        foreach ($textcontent as $line)
        {
            fwrite($file, $line . "\n");
        }
        fclose($file);

        $msg = ($newStatus == "unpublished") ? "Module unpublished. Students can no longer see it." : "Module published. Students can now see it.";
        echo "<script>alert('" . $msg . "'); window.location='searchmodule.php';</script>";
        exit();
    }
}

// ── Delete module (Teacher only) ──────────────────────────────────────────────
if (isset($_POST['btnDelete']) && isset($_SESSION['sesUserType']) && $_SESSION['sesUserType'] == "Teacher")
{
    $modIndex   = (int)$_POST['moduleIndex'];
    $textsource = "modules.txt";

    if (file_exists($textsource))
    {
        $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);
        $filepath    = $textcontent[$modIndex + 3];

        // Delete the physical file
        if (file_exists($filepath))
        {
            unlink($filepath);
        }

        // Remove the 5-line block from modules.txt
        array_splice($textcontent, $modIndex, 5);

        $file = fopen($textsource, "w");
        foreach ($textcontent as $line)
        {
            fwrite($file, $line . "\n");
        }
        fclose($file);

        echo "<script>alert('Module deleted successfully.'); window.location='searchmodule.php';</script>";
        exit();
    }
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
                $homeLink = (isset($_SESSION['sesUserType']) && $_SESSION['sesUserType'] == "Teacher") ? "home.php" : "studenthome.php";
                ?>
                <a href="<?php echo $homeLink; ?>">Home</a>
            </li>

            <?php if (isset($_SESSION['sesUserType']) && $_SESSION['sesUserType'] == "Teacher"): ?>
            <li>
                <a href="uploadmodule.php">Upload</a>
            </li>
            <?php endif; ?>

            <li>
                <a href="searchmodule.php" class="nav-active">Modules</a>
            </li>

            <li>
                <a href="logout.php">Logout</a>
            </li>

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
                        <input
                            type="text"
                            name="txtSearch"
                            class="form-control"
                            placeholder="e.g. Programming, Mathematics...">
                    </div>

                    <input
                        type="submit"
                        name="btnSearch"
                        value="Search"
                        class="btn">

                </div>

            </form>

        </div>

        <?php

        $textsource = "modules.txt";

        if (file_exists($textsource))
        {
            $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);

            $isTeacher = isset($_SESSION['sesUserType']) && $_SESSION['sesUserType'] == "Teacher";

            // ── Build grouped structure: category => [ module, ... ] ──────────
            $grouped = [];

            for ($i = 0; $i < count($textcontent); $i = $i + 5)
            {
                if (!isset($textcontent[$i])) continue;

                $subject  = $textcontent[$i];
                $category = $textcontent[$i + 1];
                $filetype = $textcontent[$i + 2];
                $filepath = $textcontent[$i + 3];
                $status   = isset($textcontent[$i + 4]) ? $textcontent[$i + 4] : "published";

                // Students only see published modules; teachers see all
                if (!$isTeacher && $status != "published") continue;

                // Apply search filter on subject or category
                if ($search != "" && stripos($subject, $search) === false && stripos($category, $search) === false) continue;

                if (!isset($grouped[$category])) $grouped[$category] = [];

                $grouped[$category][] = [
                    'subject'  => $subject,
                    'category' => $category,
                    'filetype' => $filetype,
                    'filepath' => $filepath,
                    'status'   => $status,
                    'index'    => $i,
                ];
            }

            if (empty($grouped))
            {
                echo '<div class="empty-state"><p>No modules found. Try a different search term.</p></div>';
            }
            else
            {
                ksort($grouped); // alphabetical category order

                foreach ($grouped as $category => $modules):
        ?>

        <div class="subject-section">

            <div class="subject-section-header">
                <h2><?php echo htmlspecialchars($category); ?></h2>
                <span class="subject-count"><?php echo count($modules); ?> module<?php echo count($modules) != 1 ? 's' : ''; ?></span>
            </div>

            <div class="module-grid">

            <?php foreach ($modules as $mod): ?>

                <div class="module-card <?php echo ($mod['status'] == 'unpublished') ? 'module-card-unpublished' : ''; ?>">

                    <?php if ($isTeacher && $mod['status'] == "unpublished"): ?>
                    <span class="module-status-badge">Unpublished</span>
                    <?php endif; ?>

                    <span class="module-card-type">
                        <?php echo htmlspecialchars($mod['filetype']); ?>
                    </span>

                    <h3><?php echo htmlspecialchars($mod['subject']); ?></h3>

                    <div class="module-card-spacer"></div>

                    <div class="module-card-footer">

                        <a
                            class="download-btn"
                            href="download.php?file=<?php echo htmlspecialchars($mod['filepath']); ?>">
                            Download Module
                        </a>

                        <?php if ($isTeacher): ?>

                        <div class="teacher-actions">

                            <?php if ($mod['status'] == "published"): ?>

                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="moduleIndex" value="<?php echo $mod['index']; ?>">
                                <input type="submit" name="btnUnpublish" value="Unpublish" class="btn-unpublish">
                            </form>

                            <?php else: ?>

                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="moduleIndex" value="<?php echo $mod['index']; ?>">
                                <input type="submit" name="btnPublish" value="Publish" class="btn-publish">
                            </form>

                            <?php endif; ?>

                            <form method="POST" style="display:inline;" onsubmit="return confirm('Permanently DELETE this module and its file? This cannot be undone.');">
                                <input type="hidden" name="moduleIndex" value="<?php echo $mod['index']; ?>">
                                <input type="submit" name="btnDelete" value="Delete" class="btn-delete">
                            </form>

                        </div>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; ?>

            </div>

        </div>

        <?php

                endforeach;
            }
        }
        else
        {
            echo '<div class="empty-state"><p>No modules have been uploaded yet.</p></div>';
        }

        ?>

    </div>

    <div class="footer">

        <strong>Scholara</strong> &mdash; Learning Materials Library &copy; 2026

    </div>

</body>

</html>