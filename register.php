<?php

if(isset($_POST['btnRegister']))
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    $usertype = $_POST['txtUserType'];

    $exist = false;

    if(file_exists("users.txt"))
    {
        $textcontent = file(
        "users.txt",
        FILE_IGNORE_NEW_LINES);

        foreach($textcontent as $index => $linetext)
        {
            if($username == $linetext)
            {
                $exist = true;
            }
        }
    }

    if($exist == true)
    {
        echo "<script>
        alert('Username Already Exists');
        </script>";
    }
    else
    {
        $file = fopen("users.txt","a");

        fwrite($file,$username."\n");
        fwrite($file,$password."\n");
        fwrite($file,$usertype."\n");

        fclose($file);

        echo "<script>
        alert('Account Created Successfully');
        </script>";
    }
}

?>

<html>

<head>

<title>EduVault — Create Account</title>

<link rel="stylesheet"
href="css/style.css">

</head>

<body>

<div class="auth-container">

<div class="auth-card">

<h2>Create Account</h2>
<p style="color:#888; font-size:0.88rem; margin-bottom:30px; text-align:left;">Join EduVault and access learning resources.</p>

<form method="POST">

<div class="form-group">

<label>Username</label>

<input
type="text"
name="txtUsername"
class="form-control"
placeholder="Choose a username"
required>

</div>

<div class="form-group">

<label>Password</label>

<input
type="password"
name="txtPassword"
class="form-control"
placeholder="Create a password"
required>

</div>

<div class="form-group">

<label>Account Type</label>

<select
name="txtUserType"
class="form-control">

<option value="Teacher">
Teacher
</option>

<option value="Student">
Student
</option>

</select>

</div>

<input
type="submit"
name="btnRegister"
value="Create Account"
class="btn btn-full">

</form>

<p>
Already have an account?
<a href="login.php">Sign in</a>
</p>

</div>

</div>

</body>

</html>
