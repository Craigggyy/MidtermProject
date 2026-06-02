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
Dashboard
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

<div class="banner-wrap">
<img
src="images/hero.jpg"
class="banner"
onerror="this.parentElement.className='banner-fallback'">
</div>

<div class="container">

<div class="card card-welcome">

<div class="card-welcome-text">

<h1>
Welcome back,
<?php
echo
$_SESSION['sesUser'];
?>
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

<div
class="dashboard-card">

<span class="dashboard-card-icon">📚</span>

<h3>
Upload Modules
</h3>

<p>
Add learning materials for your students to access and download.
</p>

<a
href="uploadmodule.php">

<button
class="btn">
Open
</button>

</a>

</div>

<div
class="dashboard-card">

<span class="dashboard-card-icon">🔍</span>

<h3>
Browse Modules
</h3>

<p>
Find and manage all uploaded learning resources in one place.
</p>

<a
href="searchmodule.php">

<button
class="btn">
Open
</button>

</a>

</div>

<div
class="dashboard-card">

<span class="dashboard-card-icon">👨‍🏫</span>

<h3>
Teacher Account
</h3>

<p>
Currently logged in to your teacher portal.
</p>

<b>
<?php

echo
$_SESSION['sesUser'];

?>
</b>

</div>

</div>

<div class="card">

<h2>
About EduVault
</h2>

<p>
EduVault is an E-Learning Module Distribution System that allows teachers to upload modules while students can search and download learning materials seamlessly.
</p>

</div>

</div>

<div class="footer">

<strong>EduVault</strong> &mdash; E-Learning Module Distribution System &copy; 2026

</div>

</body>

</html>
