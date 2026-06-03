<?php

session_start();

function textreader($inputname, $inputpassword, $inputtype)
{
    $textsource = "users.txt";

    if(file_exists($textsource))
    {
        $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);

        foreach($textcontent as $index => $linetext)
        {
            if($inputname == $linetext)
            {
                if(
                    $inputpassword == $textcontent[$index+1] &&
                    $inputtype == $textcontent[$index+2]
                )
                {
                    $_SESSION['sesUser']     = $textcontent[$index];
                    $_SESSION['sesUserType'] = $textcontent[$index+2];
                    return true;
                }
            }
        }
    }

    return false;
}

if(isset($_POST['btnLogin']))
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    $usertype = $_POST['txtUserType'];

    $found = textreader($username, $password, $usertype);

    if($found == false)
    {
        die("<script>alert('Invalid Account');window.location='login.php';</script>");
    }

    if($_SESSION['sesUserType'] == "Teacher")
    {
        echo "<meta http-equiv='refresh' content='0;url=home.php'>";
    }
    else
    {
        echo "<meta http-equiv='refresh' content='0;url=studenthome.php'>";
    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EduVault — Log In</title>

<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400&display=swap" rel="stylesheet">

<style>

*, *::before, *::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

:root {
  --canvas-navy:    #394B58;
  --canvas-blue:    #0770A3;
  --canvas-blue-dk: #0A5B80;
  --canvas-blue-lt: #E8F4FA;
  --canvas-border:  #C7CDD1;
  --canvas-bg:      #F5F5F5;
  --canvas-white:   #FFFFFF;
  --canvas-text:    #2D3B45;
  --canvas-muted:   #6B7780;
  --canvas-label:   #394B58;
  --canvas-error:   #D9534F;
  --canvas-input-h: 40px;
  --canvas-radius:  4px;
}

html, body {
  height: 100%;
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--canvas-text);
  background: var(--canvas-bg);
  -webkit-font-smoothing: antialiased;
}

body {
  display: flex;
  min-height: 100vh;
}

/* ── LEFT BRANDED PANEL ── */
.brand-panel {
  width: 380px;
  flex-shrink: 0;
  background: var(--canvas-navy);
  display: flex;
  flex-direction: column;
  position: relative;
  overflow: hidden;
}

.brand-panel::after {
  content: '';
  position: absolute;
  top: 0; right: -40px;
  width: 80px;
  height: 100%;
  background: var(--canvas-bg);
  transform: skewX(-4deg);
  z-index: 2;
}

.brand-top {
  padding: 40px 44px 0;
  position: relative;
  z-index: 1;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.brand-logo-wrap {
  display: flex;
  align-items: center;
  gap: 11px;
  margin-bottom: 52px;
}

.brand-logo-mark {
  width: 36px;
  height: 36px;
  background: var(--canvas-blue);
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.brand-logo-mark svg {
  width: 20px;
  height: 20px;
  fill: #fff;
}

.brand-logo-name {
  font-size: 1.25rem;
  font-weight: 700;
  color: #fff;
  letter-spacing: 0.01em;
}

.brand-headline {
  font-size: 1.75rem;
  font-weight: 300;
  color: #fff;
  line-height: 1.35;
  letter-spacing: -0.01em;
  margin-bottom: 14px;
}

.brand-headline strong {
  font-weight: 700;
  display: block;
}

.brand-sub {
  font-size: 0.875rem;
  color: rgba(255,255,255,0.55);
  line-height: 1.65;
  max-width: 260px;
  margin-bottom: 44px;
}

/* Divider */
.brand-divider {
  width: 48px;
  height: 2px;
  background: var(--canvas-blue);
  margin-bottom: 36px;
  border-radius: 2px;
}

/* Stats */
.stats-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  margin-bottom: auto;
}

.stat-card {
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.10);
  border-radius: 6px;
  padding: 14px 16px;
}

.stat-value {
  font-size: 1.5rem;
  font-weight: 900;
  color: #fff;
  letter-spacing: -0.02em;
  line-height: 1;
  margin-bottom: 4px;
}

.stat-label {
  font-size: 0.72rem;
  font-weight: 400;
  color: rgba(255,255,255,0.45);
  text-transform: uppercase;
  letter-spacing: 0.06em;
}

/* Notice bar */
.brand-notice {
  margin-top: 40px;
  padding: 14px 16px;
  background: rgba(7,112,163,0.25);
  border-left: 3px solid var(--canvas-blue);
  border-radius: 0 4px 4px 0;
  margin-bottom: 32px;
}

.brand-notice p {
  font-size: 0.78rem;
  color: rgba(255,255,255,0.65);
  line-height: 1.5;
  font-style: italic;
}

.brand-notice strong {
  color: rgba(255,255,255,0.85);
  font-style: normal;
}

/* Bottom bar */
.brand-bottom {
  height: 5px;
  background: linear-gradient(90deg, var(--canvas-blue) 0%, #6CC0E5 100%);
  position: relative;
  z-index: 1;
}

/* ── MAIN CONTENT AREA ── */
.content-area {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 48px 60px;
  background: var(--canvas-bg);
}

.form-card {
  background: var(--canvas-white);
  border: 1px solid var(--canvas-border);
  border-radius: 6px;
  width: 100%;
  max-width: 400px;
  overflow: hidden;
}

.form-card-header {
  background: var(--canvas-white);
  border-bottom: 1px solid var(--canvas-border);
  padding: 22px 28px 18px;
}

.form-card-header h1 {
  font-size: 1.375rem;
  font-weight: 700;
  color: var(--canvas-text);
  letter-spacing: -0.01em;
  margin-bottom: 3px;
}

.form-card-header p {
  font-size: 0.82rem;
  color: var(--canvas-muted);
  line-height: 1.5;
}

.form-card-body {
  padding: 24px 28px 28px;
}

.form-row {
  margin-bottom: 18px;
}

.form-row label {
  display: block;
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--canvas-label);
  margin-bottom: 5px;
}

.form-row label .required {
  color: var(--canvas-error);
  margin-left: 2px;
}

.form-control {
  display: block;
  width: 100%;
  height: var(--canvas-input-h);
  padding: 0 10px;
  font-family: 'Lato', sans-serif;
  font-size: 0.88rem;
  color: var(--canvas-text);
  background: var(--canvas-white);
  border: 1px solid var(--canvas-border);
  border-radius: var(--canvas-radius);
  outline: none;
  transition: border-color 0.15s, box-shadow 0.15s;
  appearance: none;
  -webkit-appearance: none;
}

.form-control::placeholder {
  color: #aab0b5;
}

.form-control:focus {
  border-color: var(--canvas-blue);
  box-shadow: 0 0 0 2px rgba(7,112,163,0.20);
}

.form-control:hover:not(:focus) {
  border-color: #a0aaaf;
}

select.form-control {
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%236B7780'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 10px center;
  padding-right: 30px;
  cursor: pointer;
}

select.form-control option {
  background: var(--canvas-white);
  color: var(--canvas-text);
}

.role-group {
  display: flex;
  gap: 8px;
}

.role-option {
  flex: 1;
  position: relative;
}

.role-option input[type="radio"] {
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

.role-option label {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 7px;
  height: 40px;
  border: 1px solid var(--canvas-border);
  border-radius: var(--canvas-radius);
  cursor: pointer;
  font-size: 0.84rem;
  font-weight: 400;
  color: var(--canvas-muted);
  background: var(--canvas-white);
  transition: border-color 0.15s, background 0.15s, color 0.15s;
  margin-bottom: 0;
}

.role-option label svg {
  width: 15px;
  height: 15px;
  stroke: currentColor;
  fill: none;
  stroke-width: 1.75;
  stroke-linecap: round;
  stroke-linejoin: round;
  flex-shrink: 0;
}

.role-option input[type="radio"]:checked + label {
  border-color: var(--canvas-blue);
  background: var(--canvas-blue-lt);
  color: var(--canvas-blue-dk);
  font-weight: 700;
}

.role-option label:hover {
  border-color: #a0aaaf;
  color: var(--canvas-text);
}

/* Label row with forgot link */
.label-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 5px;
}

.label-row label {
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--canvas-label);
  margin-bottom: 0;
}

.label-row label .required {
  color: var(--canvas-error);
  margin-left: 2px;
}

.forgot-link {
  font-size: 0.78rem;
  color: var(--canvas-blue);
  text-decoration: none;
  font-weight: 400;
}

.forgot-link:hover {
  text-decoration: underline;
}

.btn-primary {
  display: block;
  width: 100%;
  height: 40px;
  background: var(--canvas-blue);
  color: #fff;
  border: 1px solid var(--canvas-blue-dk);
  border-radius: var(--canvas-radius);
  font-family: 'Lato', sans-serif;
  font-size: 0.9rem;
  font-weight: 700;
  cursor: pointer;
  transition: background 0.15s, box-shadow 0.15s;
  letter-spacing: 0.01em;
  margin-top: 24px;
}

.btn-primary:hover {
  background: var(--canvas-blue-dk);
  box-shadow: 0 1px 4px rgba(7,112,163,0.30);
}

.btn-primary:active {
  transform: translateY(1px);
}

.form-card-footer {
  border-top: 1px solid var(--canvas-border);
  padding: 14px 28px;
  text-align: center;
  background: #FAFAFA;
}

.form-card-footer p {
  font-size: 0.82rem;
  color: var(--canvas-muted);
}

.form-card-footer a {
  color: var(--canvas-blue);
  font-weight: 700;
  text-decoration: none;
}

.form-card-footer a:hover {
  text-decoration: underline;
}

.page-footer {
  position: fixed;
  bottom: 0;
  left: 380px;
  right: 0;
  padding: 10px 24px;
  text-align: center;
  font-size: 0.72rem;
  color: #AAB0B5;
  background: var(--canvas-bg);
  border-top: 1px solid var(--canvas-border);
}

@media (max-width: 820px) {
  .brand-panel { display: none; }
  .page-footer { left: 0; }
  .content-area { padding: 32px 20px; }
}

</style>
</head>

<body>

  <!-- LEFT BRAND PANEL -->
  <aside class="brand-panel">
    <div class="brand-top">

      <div class="brand-logo-wrap">
        <div class="brand-logo-mark">
          <svg viewBox="0 0 20 20"><path d="M3 3h6a2 2 0 012 2v11a2 2 0 01-2 2H3V3zm14 0h-4a2 2 0 00-2 2v11a2 2 0 002 2h4V3z"/></svg>
        </div>
        <span class="brand-logo-name">EduVault</span>
      </div>

      <h2 class="brand-headline">
        Welcome back
        <strong>to your portal.</strong>
      </h2>

      <p class="brand-sub">Sign in to continue where you left off. Your courses, materials, and progress are ready.</p>

      <div class="brand-divider"></div>

      

      <div class="brand-notice">
        <p><strong>First time here?</strong> Ask your teacher for an invitation or create your account at the registration page.</p>
      </div>

    </div>
    <div class="brand-bottom"></div>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="content-area">
    <div class="form-card">

      <div class="form-card-header">
        <h1>Log in to EduVault</h1>
        <p>Enter your credentials to access your portal.</p>
      </div>

      <div class="form-card-body">
        <form method="POST">

          <div class="form-row">
            <label for="txtUsername">Username <span class="required">*</span></label>
            <input
              type="text"
              id="txtUsername"
              name="txtUsername"
              class="form-control"
              placeholder="Enter your username"
              autocomplete="username"
              required>
          </div>

          <div class="form-row">
            <div class="label-row">
              <label for="txtPassword">Password <span class="required">*</span></label>
              <a href="#" class="forgot-link">Forgot password?</a>
            </div>
            <input
              type="password"
              id="txtPassword"
              name="txtPassword"
              class="form-control"
              placeholder="Enter your password"
              autocomplete="current-password"
              required>
          </div>

          <div class="form-row">
            <label>Log in as <span class="required">*</span></label>
            <div class="role-group">
              <div class="role-option">
                <input type="radio" id="roleTeacher" name="txtUserType" value="Teacher" checked>
                <label for="roleTeacher">
                  <svg viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
                  Teacher
                </label>
              </div>
              <div class="role-option">
                <input type="radio" id="roleStudent" name="txtUserType" value="Student">
                <label for="roleStudent">
                  <svg viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                  Student
                </label>
              </div>
            </div>
          </div>

          <!-- Hidden select for PHP POST compatibility -->
          <select name="txtUserType" id="txtUserTypeHidden" style="display:none;"></select>

          <input
            type="submit"
            name="btnLogin"
            value="Log In"
            class="btn-primary">

        </form>
      </div>

      <div class="form-card-footer">
        <p>Don't have an account? <a href="register.php">Create one now</a></p>
      </div>

    </div>
  </main>

  <footer class="page-footer">
    &copy; <?php echo date('Y'); ?> EduVault &mdash; All rights reserved.
  </footer>

<script>
document.querySelectorAll('input[name="txtUserType"]').forEach(function(radio) {
  radio.addEventListener('change', function() {
    document.getElementById('txtUserTypeHidden').value = this.value;
  });
});
document.getElementById('txtUserTypeHidden').value = document.querySelector('input[name="txtUserType"]:checked').value;
</script>

</body>
</html>