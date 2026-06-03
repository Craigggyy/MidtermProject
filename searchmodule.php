<?php

session_start();

$search = "";

if(isset($_POST['btnSearch']))
{
    $search =
    $_POST['txtSearch'];
}

?>

<html>

<head>

<title>
Learning Materials
</title>

<link
rel="stylesheet"
href="css/style.css">

</head>

<body class="has-bg">

<div class="navbar">

<div class="logo">
Scholara
</div>

<ul>

<li>
<a href="home.php">Home</a>
</li>

<li>
<a href="uploadmodule.php">Upload</a>
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
<h1 style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:700; color:#1A1A1A;">Learning Materials</h1>
<p style="color:#888; font-size:0.88rem; margin-top:4px;">Browse and download modules shared by teachers</p>
</div>
</div>

<div class="card">

<form
method="POST">

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

<div class="module-grid">

<?php

$textsource =
"modules.txt";

if(
file_exists(
$textsource))
{
    $textcontent =
    file(
    $textsource,
    FILE_IGNORE_NEW_LINES);

    $found_any = false;

    for(
    $i = 0;
    $i < count($textcontent);
    $i = $i + 4)
    {
        $subject =
        $textcontent[$i];

        $category =
        $textcontent[$i+1];

        $filetype =
        $textcontent[$i+2];

        $filepath =
        $textcontent[$i+3];

        if(
        $search == ""
        ||
        stripos(
        $subject,
        $search)
        !== false
        )
        {
            $found_any = true;
?>

<div class="module-card">

<span class="module-card-type">
<?php
echo $filetype;
?>
</span>

<h3>

<?php
echo $subject;
?>

</h3>

<p>

<b style="color:#444; font-weight:600;">Category:</b>
<?php
echo $category;
?>

</p>

<div class="module-card-spacer"></div>

<div class="module-card-footer">

<a

class="download-btn"

href="download.php?file=<?php echo $filepath; ?>">

Download Module

</a>

</div>

</div>

<?php

        }

    }

    if(!$found_any)
    {
        echo '<div class="empty-state"><p>No modules found. Try a different search term.</p></div>';
    }

}
else
{
    echo '<div class="empty-state"><p>No modules have been uploaded yet.</p></div>';
}

?>

</div>

</div>

<div class="footer">

<strong>EduVault</strong> &mdash; Learning Materials Library &copy; 2026

</div>

</body>

</html>
