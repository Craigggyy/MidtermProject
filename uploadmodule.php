<?php

session_start();

if ($_SESSION['sesUserType'] != "Teacher") {
    die(
    "<script>
    alert('Only Teachers Can Upload Modules');
    window.location='studenthome.php';
    </script>");
}

if (!isset($_SESSION['sesUser'])) {
    die(
    "<script>
    alert('Please Login First');
    window.location='login.php';
    </script>");
}

if (isset($_POST['btnUpload'])) {
    $subject    = $_POST['txtSubject'];
    $category   = $_POST['txtCategory'];
    $targetDir  = "uploads/";
    $filename   = $_FILES['docFile']['name'];
    $targetFile = $targetDir . $filename;

    if (move_uploaded_file($_FILES['docFile']['tmp_name'], $targetFile)) {
        $newcontent = "";
        $newcontent = $newcontent . $subject    . "\n";
        $newcontent = $newcontent . $category   . "\n";
        $newcontent = $newcontent . $filename   . "\n";
        $newcontent = $newcontent . $targetFile . "\n";
        $newcontent = $newcontent . "published" . "\n";

        file_put_contents("modules.txt", $newcontent, FILE_APPEND);

        echo
        "<script>
        alert('Module Uploaded Successfully');
        </script>";
    } else {
        echo
        "<script>
        alert('Upload Failed');
        </script>";
    }
}

?>

<html>

<head>

<title>
Upload Module
</title>

<link
rel="stylesheet"
href="css/style.css">

</head>

<body class="has-bg">

<div class="navbar">

    <div class="logo">Scholara</div>

    <ul>

        <li>
            <a href="home.php">Home</a>
        </li>

        <li>
            <a href="uploadmodule.php" class="nav-active">Upload</a>
        </li>

        <li>
            <a href="searchmodule.php">Modules</a>
        </li>

        <li>
            <a href="logout.php">Logout</a>
        </li>

    </ul>

</div>

<div class="container">

    <div class="page-header">
        <div>
            <h1 style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:700; color:#1A1A1A;">Upload Learning Module</h1>
            <p style="color:#888; font-size:0.88rem; margin-top:4px;">Share educational materials with your students</p>
        </div>
    </div>

    <div class="card">

        <form
            method="POST"
            enctype="multipart/form-data"
            action="uploadmodule.php">

            <div class="form-group">

                <label style="color:#000000; font-weight:900;">Module Name</label>

                <input
                    type="text"
                    name="txtSubject"
                    class="form-control"
                    placeholder="e.g. Programming 1"
                    required>

            </div>

            <div class="form-group">

                <label>Module Category</label>

                <select
                    name="txtCategory"
                    class="form-control">

                    <option>Information Technology</option>
                    <option>Programming</option>
                    <option>Networking</option>
                    <option>Database</option>
                    <option>Mathematics</option>
                    <option>Science</option>
                    <option>English</option>

                </select>

            </div>

            <div class="form-group">

                <label>Upload Module File</label>

                <input
                    type="file"
                    name="docFile"
                    class="form-control"
                    required>

            </div>

            <br>

            <input
                type="submit"
                name="btnUpload"
                value="Upload Module"
                class="btn">

        </form>

    </div>

    <div class="card">

        <h2>Upload Guidelines</h2>

        <ul class="guidelines-list">
            <li>PDF Files</li>
            <li>Word Documents</li>
            <li>PowerPoint Files</li>
            <li>ZIP Learning Packages</li>
        </ul>

    </div>

</div>

<div class="footer">

    <strong>Scholara</strong> &mdash; E-Learning System &copy; 2026

</div>

</body>

</html>