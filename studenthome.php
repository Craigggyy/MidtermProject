<?php

session_start();

if(
!isset(
$_SESSION['sesUser']
))
{
    die(
    "<script>
    alert('Please Login First');
    window.location='login.php';
    </script>");
}

?>

<html>

<head>

<title>
Student Dashboard
</title>

<link
rel="stylesheet"
href="css/style.css">

</head>

<body>

<div class="navbar">

<div class="logo">
EduVault
</div>

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

<div class="container">

<div class="card card-welcome">

<div class="card-welcome-text">

<h1>
Welcome,
<?php
echo
$_SESSION['sesUser'];
?>
</h1>

<p>
Browse and download learning materials uploaded by your teachers. Find everything you need in one place.
</p>

<br>

<a
href="searchmodule.php">

<button
class="btn">
Browse Modules
</button>

</a>

</div>

<div class="card-welcome-badge">
<span>Logged in as</span>
<strong>Student</strong>
</div>

</div>

</div>

<div class="footer">

<strong>EduVault</strong> &mdash; Student Portal &copy; 2026

</div>

</body>

</html>
