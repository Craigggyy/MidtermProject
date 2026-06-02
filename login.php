<?php

session_start();

function textreader(
$inputname,
$inputpassword,
$inputtype)
{
    $textsource = "users.txt";

    if(file_exists($textsource))
    {
        $textcontent =
        file(
        $textsource,
        FILE_IGNORE_NEW_LINES);

        foreach(
        $textcontent
        as $index => $linetext)
        {
            if($inputname == $linetext)
            {
                if(
                $inputpassword
                ==
                $textcontent[$index+1]
                &&
                $inputtype
                ==
                $textcontent[$index+2]
                )
                {
                    $_SESSION['sesUser']
                    =
                    $textcontent[$index];

                    $_SESSION['sesUserType']
                    =
                    $textcontent[$index+2];

                    return true;
                }
            }
        }
    }

    return false;
}

if(isset($_POST['btnLogin']))
{
    $username =
    $_POST['txtUsername'];

    $password =
    $_POST['txtPassword'];

    $usertype =
    $_POST['txtUserType'];

    $found =
    textreader(
    $username,
    $password,
    $usertype);

    if($found == false)
    {
        die(
        "<script>
        alert('Invalid Account');
        window.location='login.php';
        </script>");
    }

    if(
    $_SESSION['sesUserType']
    ==
    "Teacher")
    {
        echo "<meta
        http-equiv='refresh'
        content='0;
        url=home.php'>";
    }
    else
    {
        echo "<meta
        http-equiv='refresh'
        content='0;
        url=studenthome.php'>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EduVault — Login</title>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Figtree:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

  *, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  :root {
    --cream: #faf8f5;
    --white: #ffffff;
    --panel-border: #e8e2d9;
    --accent: #b5341c;
    --accent-hover: #942b17;
    --accent-light: rgba(181,52,28,0.08);
    --text-primary: #1c1917;
    --text-secondary: #44403c;
    --text-muted: #a8a29e;
    --input-bg: #fdfcfb;
    --input-border: #ddd8d0;
    --input-focus: #b5341c;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    --shadow-md: 0 4px 16px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04);
    --shadow-lg: 0 20px 60px rgba(0,0,0,0.10), 0 8px 24px rgba(0,0,0,0.06);
    --radius: 8px;
  }

  html, body {
    height: 100%;
    font-family: 'Figtree', sans-serif;
    background: var(--cream);
  }

  body {
    display: flex;
    min-height: 100vh;
  }

  /* ── LEFT HERO PANEL ── */
  .hero-left {
    flex: 1;
    position: relative;
    overflow: hidden;
    background: linear-gradient(150deg, #fff8f6 0%, #fdf3ef 40%, #f5ede6 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px;
  }

  .hero-left::before {
    content: '';
    position: absolute;
    width: 520px;
    height: 520px;
    border-radius: 50%;
    border: 1.5px solid rgba(181,52,28,0.12);
    top: -100px;
    left: -100px;
    pointer-events: none;
  }

  .hero-left::after {
    content: '';
    position: absolute;
    width: 360px;
    height: 360px;
    border-radius: 50%;
    border: 1.5px solid rgba(181,52,28,0.08);
    bottom: -80px;
    right: -80px;
    pointer-events: none;
  }

  .hero-decoration {
    position: absolute;
    width: 240px;
    height: 240px;
    border-radius: 50%;
    border: 1px dashed rgba(181,52,28,0.15);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
  }

  .hero-inner {
    position: relative;
    z-index: 1;
    text-align: center;
    max-width: 400px;
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: var(--white);
    border: 1px solid var(--panel-border);
    border-radius: 100px;
    padding: 6px 14px;
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--text-secondary);
    letter-spacing: 0.04em;
    margin-bottom: 28px;
    box-shadow: var(--shadow-sm);
  }

  .hero-badge-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--accent);
  }

  .hero-heading {
    font-family: 'Playfair Display', serif;
    font-size: 2.6rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.2;
    margin-bottom: 18px;
    letter-spacing: -0.02em;
  }

  .hero-heading em {
    font-style: italic;
    color: var(--accent);
  }

  .hero-body {
    font-size: 0.9rem;
    color: var(--text-muted);
    line-height: 1.75;
    margin-bottom: 36px;
  }

  /* Testimonial / quote card */
  .quote-card {
    background: var(--white);
    border: 1px solid var(--panel-border);
    border-radius: 14px;
    padding: 20px 22px;
    text-align: left;
    box-shadow: var(--shadow-md);
    position: relative;
  }

  .quote-mark {
    font-family: 'Playfair Display', serif;
    font-size: 3.5rem;
    color: var(--accent);
    line-height: 0.8;
    margin-bottom: 8px;
    display: block;
    opacity: 0.6;
  }

  .quote-text {
    font-size: 0.86rem;
    color: var(--text-secondary);
    line-height: 1.7;
    margin-bottom: 14px;
    font-style: italic;
  }

  .quote-author {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .quote-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f4a38a, var(--accent));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 700;
    color: white;
    flex-shrink: 0;
  }

  .quote-name {
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--text-primary);
  }

  .quote-role {
    font-size: 0.72rem;
    color: var(--text-muted);
  }

  /* Stats row */
  .stats-row {
    display: flex;
    gap: 0;
    margin-top: 20px;
    background: var(--white);
    border: 1px solid var(--panel-border);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
  }

  .stat-item {
    flex: 1;
    padding: 14px 16px;
    text-align: center;
    border-right: 1px solid var(--panel-border);
  }

  .stat-item:last-child {
    border-right: none;
  }

  .stat-number {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--accent);
    display: block;
  }

  .stat-label {
    font-size: 0.70rem;
    color: var(--text-muted);
    margin-top: 2px;
    display: block;
  }

  /* ── RIGHT FORM PANEL ── */
  .hero-right {
    width: 460px;
    flex-shrink: 0;
    background: var(--white);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 56px 48px;
    position: relative;
    border-left: 1px solid var(--panel-border);
    box-shadow: -8px 0 40px rgba(0,0,0,0.04);
  }

  .panel-logo {
    width: 54px;
    height: 54px;
    border-radius: 14px;
    background: var(--accent);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    box-shadow: 0 4px 14px rgba(181,52,28,0.30);
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem;
    font-weight: 700;
    color: #fff;
    letter-spacing: -0.5px;
    flex-shrink: 0;
  }

  .panel-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.65rem;
    font-weight: 700;
    color: var(--text-primary);
    text-align: center;
    margin-bottom: 6px;
    letter-spacing: -0.02em;
  }

  .panel-subtitle {
    font-size: 0.83rem;
    color: var(--text-muted);
    text-align: center;
    margin-bottom: 32px;
    line-height: 1.6;
  }

  .form-group {
    width: 100%;
    margin-bottom: 16px;
  }

  .form-group label {
    display: block;
    font-size: 0.76rem;
    font-weight: 600;
    color: var(--text-secondary);
    margin-bottom: 7px;
    letter-spacing: 0.05em;
    text-transform: uppercase;
  }

  .input-wrap {
    position: relative;
  }

  .input-icon {
    position: absolute;
    left: 13px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 0.95rem;
    pointer-events: none;
  }

  .form-control {
    width: 100%;
    padding: 11px 14px 11px 38px;
    background: var(--input-bg);
    border: 1.5px solid var(--input-border);
    border-radius: var(--radius);
    color: var(--text-primary);
    font-family: 'Figtree', sans-serif;
    font-size: 0.88rem;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    appearance: none;
    -webkit-appearance: none;
  }

  .form-control::placeholder {
    color: #c5bfb8;
  }

  .form-control:focus {
    border-color: var(--input-focus);
    box-shadow: 0 0 0 3px rgba(181,52,28,0.10);
    background: #fff;
  }

  select.form-control {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23a8a29e' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
    cursor: pointer;
  }

  select.form-control option {
    background: var(--white);
    color: var(--text-primary);
  }

  .forgot-row {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    margin-bottom: 18px;
    margin-top: -6px;
  }

  .forgot-link {
    font-size: 0.78rem;
    color: var(--text-muted);
    text-decoration: none;
    transition: color 0.2s;
  }

  .forgot-link:hover {
    color: var(--accent);
  }

  .btn-submit {
    width: 100%;
    padding: 13px;
    background: var(--accent);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-family: 'Figtree', sans-serif;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    letter-spacing: 0.02em;
    transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
    margin-top: 8px;
    box-shadow: 0 2px 8px rgba(181,52,28,0.22);
  }

  .btn-submit:hover {
    background: var(--accent-hover);
    box-shadow: 0 6px 20px rgba(181,52,28,0.32);
    transform: translateY(-1px);
  }

  .btn-submit:active {
    transform: scale(0.98) translateY(0);
  }

  .divider {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 24px 0;
  }

  .divider::before, .divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--panel-border);
  }

  .divider span {
    font-size: 0.75rem;
    color: var(--text-muted);
    white-space: nowrap;
  }

  .panel-footer {
    font-size: 0.83rem;
    color: var(--text-muted);
    text-align: center;
    line-height: 1.8;
  }

  .panel-footer a {
    color: var(--accent);
    font-weight: 600;
    text-decoration: none;
    border-bottom: 1px solid rgba(181,52,28,0.25);
    transition: border-color 0.2s;
  }

  .panel-footer a:hover {
    border-color: var(--accent);
  }

  @media (max-width: 820px) {
    .hero-left { display: none; }
    .hero-right { width: 100%; padding: 40px 28px; box-shadow: none; }
  }

</style>

</head>

<body>

  <!-- LEFT: hero panel -->
  <div class="hero-left">
    <div class="hero-decoration"></div>
    <div class="hero-inner">

      <div class="hero-badge">
        <span class="hero-badge-dot"></span>
        Trusted by educators
      </div>

      <h2 class="hero-heading">Good to have<br>you <em>back.</em></h2>

      <p class="hero-body">Sign in to pick up right where you left off. Your resources and progress are waiting.</p>

      <div class="quote-card">
        <span class="quote-mark">&ldquo;</span>
        <p class="quote-text">EduVault has completely changed how I share materials with my students. Everything is organized and accessible in one place.</p>
        <div class="quote-author">
          <div class="quote-avatar">MS</div>
          <div>
            <div class="quote-name">Maria Santos</div>
            <div class="quote-role">High School Science Teacher</div>
          </div>
        </div>
      </div>

      <div class="stats-row">
        <div class="stat-item">
          <span class="stat-number">2.4k</span>
          <span class="stat-label">Students</span>
        </div>
        <div class="stat-item">
          <span class="stat-number">180+</span>
          <span class="stat-label">Teachers</span>
        </div>
        <div class="stat-item">
          <span class="stat-number">12k</span>
          <span class="stat-label">Resources</span>
        </div>
      </div>

    </div>
  </div>

  <!-- RIGHT: form panel -->
  <div class="hero-right">

    <div class="panel-logo">EV</div>

    <h1 class="panel-title">Welcome Back</h1>
    <p class="panel-subtitle">Sign in to your portal to continue.</p>

    <form method="POST" style="width:100%;">

      <div class="form-group">
        <label>Username</label>
        <div class="input-wrap">
          <span class="input-icon">👤</span>
          <input
            type="text"
            name="txtUsername"
            class="form-control"
            placeholder="Enter your username"
            required>
        </div>
      </div>

      <div class="form-group">
        <label>Password</label>
        <div class="input-wrap">
          <span class="input-icon">🔑</span>
          <input
            type="password"
            name="txtPassword"
            class="form-control"
            placeholder="Enter your password"
            required>
        </div>
      </div>

      <div class="forgot-row">
        <a href="#" class="forgot-link">Forgot password?</a>
      </div>

      <div class="form-group">
        <label>Login As</label>
        <div class="input-wrap">
          <span class="input-icon">🎓</span>
          <select name="txtUserType" class="form-control">
            <option value="Teacher">Teacher</option>
            <option value="Student">Student</option>
          </select>
        </div>
      </div>

      <input
        type="submit"
        name="btnLogin"
        value="Sign In →"
        class="btn-submit">

    </form>

    <div class="divider"><span>or</span></div>

    <p class="panel-footer">
      Don't have an account?
      <a href="register.php">Create one here</a>
    </p>

  </div>

</body>

</html>