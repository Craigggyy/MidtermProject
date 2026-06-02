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
        window.location='login.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EduVault — Create Account</title>

<link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

  *, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  :root {
    --dark: #1a1a1a;
    --panel: #222222;
    --panel-border: #2e2e2e;
    --accent: #C0392B;
    --accent-hover: #a93226;
    --text-primary: #f0f0f0;
    --text-muted: #888888;
    --input-bg: #2c2c2c;
    --input-border: #3a3a3a;
    --input-focus: #C0392B;
    --radius: 6px;
  }

  html, body {
    height: 100%;
    font-family: 'DM Sans', sans-serif;
  }

  body {
    display: flex;
    min-height: 100vh;
    background: #111;
  }

  /* ── LEFT HERO PANEL ── */
  .hero-left {
    flex: 1;
    position: relative;
    overflow: hidden;

    /* Beautiful gradient fallback — insert your photo here */
    background:
      radial-gradient(ellipse at 20% 50%, rgba(192,57,43,0.18) 0%, transparent 60%),
      radial-gradient(ellipse at 80% 20%, rgba(192,57,43,0.10) 0%, transparent 50%),
      linear-gradient(135deg, #0d0d0d 0%, #1a1a1a 50%, #111111 100%);
  }

  /* INSERT YOUR BACKGROUND IMAGE HERE */
  /* Uncomment and replace the URL to add your photo: */
  /*
  .hero-left {
    background-image: url('images/your-photo.jpg');
    background-size: cover;
    background-position: center;
  }
  */

  /* Decorative geometric overlay */
  .hero-left::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      repeating-linear-gradient(
        45deg,
        transparent,
        transparent 60px,
        rgba(192,57,43,0.03) 60px,
        rgba(192,57,43,0.03) 61px
      );
    pointer-events: none;
  }

  /* Subtle vignette on right edge to blend into panel */
  .hero-left::after {
    content: '';
    position: absolute;
    top: 0; right: 0;
    width: 120px; height: 100%;
    background: linear-gradient(to right, transparent, #1a1a1a);
    pointer-events: none;
  }

  /* ── RIGHT FORM PANEL ── */
  .hero-right {
    width: 420px;
    flex-shrink: 0;
    background: var(--panel);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 48px 40px;
    position: relative;
    border-left: 1px solid var(--panel-border);
  }

  .panel-logo {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: var(--accent);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
    box-shadow: 0 4px 24px rgba(192,57,43,0.35);
    font-family: 'Crimson Pro', serif;
    font-size: 1.6rem;
    font-weight: 700;
    color: #fff;
    letter-spacing: -1px;
    flex-shrink: 0;
  }

  .panel-title {
    font-family: 'Crimson Pro', serif;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text-primary);
    text-align: center;
    margin-bottom: 6px;
  }

  .panel-subtitle {
    font-size: 0.82rem;
    color: var(--text-muted);
    text-align: center;
    margin-bottom: 32px;
    line-height: 1.5;
  }

  .form-group {
    width: 100%;
    margin-bottom: 18px;
  }

  .form-group label {
    display: block;
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 7px;
    letter-spacing: 0.02em;
  }

  .form-control {
    width: 100%;
    padding: 11px 14px;
    background: var(--input-bg);
    border: 1.5px solid var(--input-border);
    border-radius: var(--radius);
    color: var(--text-primary);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.88rem;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    appearance: none;
    -webkit-appearance: none;
  }

  .form-control::placeholder {
    color: #555;
  }

  .form-control:focus {
    border-color: var(--input-focus);
    box-shadow: 0 0 0 3px rgba(192,57,43,0.15);
  }

  select.form-control {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23888' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
    cursor: pointer;
  }

  select.form-control option {
    background: var(--panel);
    color: var(--text-primary);
  }

  .forgot-row {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    margin-bottom: 20px;
    margin-top: -8px;
  }

  .forgot-link {
    font-size: 0.80rem;
    color: var(--text-muted);
    text-decoration: none;
    transition: color 0.2s;
  }

  .forgot-link:hover {
    color: var(--accent);
  }

  .btn-submit {
    width: 100%;
    padding: 12px;
    background: var(--accent);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    letter-spacing: 0.03em;
    transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
    margin-top: 6px;
  }

  .btn-submit:hover {
    background: var(--accent-hover);
    box-shadow: 0 4px 16px rgba(192,57,43,0.4);
  }

  .btn-submit:active {
    transform: scale(0.98);
  }

  .divider {
    width: 100%;
    height: 1px;
    background: var(--panel-border);
    margin: 24px 0;
  }

  .panel-footer {
    font-size: 0.82rem;
    color: var(--text-muted);
    text-align: center;
    line-height: 1.8;
  }

  .panel-footer a {
    color: var(--accent);
    font-weight: 600;
    text-decoration: none;
  }

  .panel-footer a:hover {
    text-decoration: underline;
  }

  @media (max-width: 700px) {
    .hero-left { display: none; }
    .hero-right { width: 100%; padding: 40px 28px; }
  }

</style>

</head>

<body>

  <!-- LEFT: blank hero area — insert your background image here -->
  <div class="hero-left"></div>

  <!-- RIGHT: form panel -->
  <div class="hero-right">

    <div class="panel-logo">EV</div>

    <h1 class="panel-title">Create Account</h1>
    <p class="panel-subtitle">Join EduVault and access your<br>learning resources.</p>

    <form method="POST" style="width:100%;">

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
        <select name="txtUserType" class="form-control">
          <option value="Teacher">Teacher</option>
          <option value="Student">Student</option>
        </select>
      </div>

      <input
        type="submit"
        name="btnRegister"
        value="Create Account"
        class="btn-submit">

    </form>

    <div class="divider"></div>

    <p class="panel-footer">
      Already have an account?
      <a href="login.php">Sign in</a>
    </p>

  </div>

</body>

</html>