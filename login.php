<?php

session_start();

function textreader($inputname, $inputpassword)
{
    $textsource = "users.txt";

    if (file_exists($textsource))
    {
        $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);

        foreach ($textcontent as $index => $linetext)
        {
            if ($inputname == $linetext)
            {
                if ($inputpassword == $textcontent[$index + 1])
                {
                    $_SESSION['sesUser']     = $textcontent[$index];
                    $_SESSION['sesUserType'] = $textcontent[$index + 2];

                    return true;
                }
            }
        }
    }

    return false;
}

if (isset($_POST['btnLogin']))
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];

    $found = textreader($username, $password);

    if ($found == false)
    {
        die(
            "<script>
            alert('Invalid Account');
            window.location='login.php';
            </script>"
        );
    }

    if ($_SESSION['sesUserType'] == "Teacher")
    {
        echo "<meta http-equiv='refresh' content='0; url=home.php'>";
    }
    else
    {
        echo "<meta http-equiv='refresh' content='0; url=studenthome.php'>";
    }
}

?>

<html>

<head>

    <title>Scholara — Login</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body class="has-bg">

    <div class="hero">

        <div class="hero-left">

            <div class="hero-left-brand">Scholara</div>

            <p class="hero-left-sub">Your centralized platform for learning modules. Teachers upload. Students discover. Education simplified.</p>

            <div class="hero-decor">
                <span></span><span></span><span></span>
            </div>

        </div>

        <div class="hero-right">

            <div class="hero-box">

                <h1>Welcome Back</h1>

                <p>Sign in to your portal to continue.</p>

                <form method="POST">

                    <div class="form-group">

                        <label>Username</label>

                        <input
                            type="text"
                            name="txtUsername"
                            class="form-control"
                            placeholder="Enter your username"
                            required>

                    </div>

                    <div class="form-group">

                        <label>Password</label>

                        <input
                            type="password"
                            name="txtPassword"
                            class="form-control"
                            placeholder="Enter your password"
                            required>

                    </div>

                    <input
                        type="submit"
                        name="btnLogin"
                        value="Sign In"
                        class="btn btn-full">

                </form>

                <p style="text-align:center; margin-top:22px; font-size:0.88rem; color:#888;">
                    Don't have an account?
                    <a href="register.php" style="color:#C0392B; font-weight:600;">Create one</a>
                </p>

            </div>

        </div>

    </div>

</body>

</html>