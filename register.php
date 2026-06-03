<?php

if(isset($_POST['btnRegister']))
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    $usertype = $_POST['txtUserType'];

    $exist = false;

    if(file_exists("users.txt"))
    {
        $textcontent = file("users.txt", FILE_IGNORE_NEW_LINES);

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
        echo "<script>alert('Username Already Exists');</script>";
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

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EduVault — Create Account</title>

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
  --canvas-success: #2E8247;
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

/* Diagonal slice */
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
}

.brand-logo-wrap {
  display: flex;
  align-items: center;
  gap: 11px;
  margin-bottom: 48px;
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
  margin-bottom: 16px;
}

.brand-headline strong {
  font-weight: 700;
  display: block;
}

.brand-sub {
  font-size: 0.875rem;
  color: rgba(255,255,255,0.60);
  line-height: 1.65;
  max-width: 260px;
  margin-bottom: 48px;
}

/* Feature list */
.feature-list {
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: 0;
}

.feature-list li {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  padding: 14px 0;
  border-top: 1px solid rgba(255,255,255,0.08);
  position: relative;
  z-index: 1;
}

.feature-list li:last-child {
  border-bottom: 1px solid rgba(255,255,255,0.08);
}

.feature-icon-wrap {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: rgba(7,112,163,0.35);
  border: 1px solid rgba(7,112,163,0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  margin-top: 1px;
}

.feature-icon-wrap svg {
  width: 14px;
  height: 14px;
  stroke: #6CC0E5;
  fill: none;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.feature-text-wrap .feature-title {
  font-size: 0.83rem;
  font-weight: 700;
  color: #fff;
  margin-bottom: 2px;
}

.feature-text-wrap .feature-desc {
  font-size: 0.78rem;
  color: rgba(255,255,255,0.50);
  line-height: 1.5;
}

/* Bottom accent bar */
.brand-bottom {
  margin-top: auto;
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
  max-width: 420px;
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

/* Canvas-style form elements */
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

/* Role selector — Canvas "pill" style */
.role-group {
  display: flex;
  gap: 8px;
  margin-top: 2px;
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
  letter-spacing: 0;
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

.role-option input[type="radio"]:checked + label:hover {
  border-color: var(--canvas-blue);
  color: var(--canvas-blue-dk);
}

/* Submit button */
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

/* Footer link */
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

/* Helper text */
.form-help {
  font-size: 0.75rem;
  color: var(--canvas-muted);
  margin-top: 4px;
  line-height: 1.4;
}

/* Page footer */
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
          <!-- Book / vault icon -->
          <svg viewBox="0 0 20 20"><path d="M3 3h6a2 2 0 012 2v11a2 2 0 01-2 2H3V3zm14 0h-4a2 2 0 00-2 2v11a2 2 0 002 2h4V3z"/></svg>
        </div>
        <span class="brand-logo-name">EduVault</span>
      </div>

      <h2 class="brand-headline">
        Learning, organized.
        <strong>Always accessible.</strong>
      </h2>

      <p class="brand-sub">One place for every resource, module, and assignment — for teachers and students alike.</p>

      

    </div>
    <div class="brand-bottom"></div>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="content-area">
    <div class="form-card">

      <div class="form-card-header">
        <h1>Create your account</h1>
        <p>Join EduVault to access your learning portal.</p>
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
              placeholder="e.g. jdelacruz"
              autocomplete="username"
              required>
            <p class="form-help">Choose a unique username for your account.</p>
          </div>

          <div class="form-row">
            <label for="txtPassword">Password <span class="required">*</span></label>
            <input
              type="password"
              id="txtPassword"
              name="txtPassword"
              class="form-control"
              placeholder="Create a secure password"
              autocomplete="new-password"
              required>
          </div>

          <div class="form-row">
            <label>I am a <span class="required">*</span></label>
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

          <!-- Hidden select fallback for PHP POST compatibility -->
          <select name="txtUserType" id="txtUserTypeHidden" style="display:none;"></select>

          <input
            type="submit"
            name="btnRegister"
            value="Create Account"
            class="btn-primary">

        </form>
      </div>

      <div class="form-card-footer">
        <p>Already have an account? <a href="login.php">Log in to EduVault</a></p>
      </div>

    </div>
  </main>

  <footer class="page-footer">
    &copy; <?php echo date('Y'); ?> EduVault &mdash; All rights reserved.
  </footer>

<script>
// Sync radio buttons to the hidden select (for PHP POST)
document.querySelectorAll('input[name="txtUserType"]').forEach(function(radio) {
  radio.addEventListener('change', function() {
    document.getElementById('txtUserTypeHidden').value = this.value;
  });
});
// Init
document.getElementById('txtUserTypeHidden').value = document.querySelector('input[name="txtUserType"]:checked').value;
</script>

</body>
</html>