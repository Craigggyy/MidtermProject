<?php

session_start();

if(!isset($_SESSION['sesUser']))
{
    die("<script>alert('Please Login First'); window.location='login.php';</script>");
}

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EduVault — Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400&display=swap" rel="stylesheet">

<style>

*, *::before, *::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

:root {
  --canvas-navy:    #394B58;
  --canvas-navy-dk: #2C3A45;
  --canvas-blue:    #0770A3;
  --canvas-blue-dk: #0A5B80;
  --canvas-blue-lt: #E8F4FA;
  --canvas-border:  #C7CDD1;
  --canvas-bg:      #F5F5F5;
  --canvas-white:   #FFFFFF;
  --canvas-text:    #2D3B45;
  --canvas-muted:   #6B7780;
  --canvas-label:   #394B58;
  --canvas-green:   #2E8247;
  --canvas-green-lt:#EAF5ED;
  --canvas-orange:  #C66000;
  --canvas-orange-lt:#FEF3E2;
  --canvas-purple:  #6B3FA0;
  --canvas-purple-lt:#F2ECF9;
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
  flex-direction: column;
  min-height: 100vh;
}

/* ── TOP NAV ── */
.topnav {
  height: 56px;
  background: var(--canvas-navy);
  display: flex;
  align-items: center;
  position: sticky;
  top: 0;
  z-index: 100;
  box-shadow: 0 1px 4px rgba(0,0,0,0.18);
  flex-shrink: 0;
}

.topnav-logo {
  width: 220px;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 0 20px;
  border-right: 1px solid rgba(255,255,255,0.10);
  height: 100%;
  text-decoration: none;
}

.topnav-logo-mark {
  width: 30px;
  height: 30px;
  background: var(--canvas-blue);
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.topnav-logo-mark svg {
  width: 16px;
  height: 16px;
  fill: #fff;
}

.topnav-logo-name {
  font-size: 1.1rem;
  font-weight: 700;
  color: #fff;
  letter-spacing: 0.01em;
}

.topnav-links {
  display: flex;
  align-items: center;
  height: 100%;
  flex: 1;
  padding: 0 8px;
  list-style: none;
  gap: 2px;
}

.topnav-links a {
  display: flex;
  align-items: center;
  gap: 7px;
  height: 56px;
  padding: 0 14px;
  font-size: 0.875rem;
  font-weight: 400;
  color: rgba(255,255,255,0.80);
  text-decoration: none;
  border-bottom: 3px solid transparent;
  transition: color 0.15s, border-color 0.15s, background 0.15s;
  white-space: nowrap;
}

.topnav-links a svg {
  width: 15px;
  height: 15px;
  stroke: currentColor;
  fill: none;
  stroke-width: 1.75;
  stroke-linecap: round;
  stroke-linejoin: round;
  flex-shrink: 0;
  opacity: 0.75;
}

.topnav-links a:hover {
  color: #fff;
  background: rgba(255,255,255,0.06);
}

.topnav-links a.active {
  color: #fff;
  border-bottom-color: var(--canvas-blue);
  font-weight: 700;
}

.topnav-right {
  margin-left: auto;
  display: flex;
  align-items: center;
  height: 100%;
  padding-right: 16px;
}

.topnav-user {
  display: flex;
  align-items: center;
  gap: 9px;
  padding: 0 12px;
  height: 100%;
}

.topnav-avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: var(--canvas-blue);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.78rem;
  font-weight: 700;
  color: #fff;
  flex-shrink: 0;
}

.topnav-username {
  font-size: 0.82rem;
  color: rgba(255,255,255,0.75);
  max-width: 120px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.topnav-logout {
  display: flex;
  align-items: center;
  gap: 6px;
  height: 100%;
  padding: 0 14px;
  font-size: 0.82rem;
  color: rgba(255,255,255,0.60);
  text-decoration: none;
  border-left: 1px solid rgba(255,255,255,0.10);
  transition: color 0.15s, background 0.15s;
}

.topnav-logout svg {
  width: 14px;
  height: 14px;
  stroke: currentColor;
  fill: none;
  stroke-width: 1.75;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.topnav-logout:hover {
  color: #fff;
  background: rgba(255,255,255,0.06);
}

/* ── LAYOUT ── */
.page-wrap {
  display: flex;
  flex: 1;
  min-height: 0;
}

/* ── SIDEBAR ── */
.sidebar {
  width: 220px;
  flex-shrink: 0;
  background: var(--canvas-white);
  border-right: 1px solid var(--canvas-border);
  padding: 20px 0;
  position: sticky;
  top: 56px;
  height: calc(100vh - 56px);
  overflow-y: auto;
}

.sidebar-section-label {
  font-size: 0.68rem;
  font-weight: 700;
  color: var(--canvas-muted);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  padding: 0 16px 8px;
  margin-top: 4px;
}

.sidebar-nav {
  list-style: none;
}

.sidebar-nav a {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 9px 16px;
  font-size: 0.875rem;
  color: var(--canvas-text);
  text-decoration: none;
  border-left: 3px solid transparent;
  transition: background 0.12s, border-color 0.12s, color 0.12s;
}

.sidebar-nav a svg {
  width: 16px;
  height: 16px;
  stroke: var(--canvas-muted);
  fill: none;
  stroke-width: 1.75;
  stroke-linecap: round;
  stroke-linejoin: round;
  flex-shrink: 0;
  transition: stroke 0.12s;
}

.sidebar-nav a:hover {
  background: var(--canvas-blue-lt);
  color: var(--canvas-blue-dk);
}

.sidebar-nav a:hover svg {
  stroke: var(--canvas-blue);
}

.sidebar-nav a.active {
  background: var(--canvas-blue-lt);
  border-left-color: var(--canvas-blue);
  color: var(--canvas-blue-dk);
  font-weight: 700;
}

.sidebar-nav a.active svg {
  stroke: var(--canvas-blue);
}

.sidebar-divider {
  height: 1px;
  background: var(--canvas-border);
  margin: 12px 16px;
}

/* ── MAIN CONTENT ── */
.main-content {
  flex: 1;
  padding: 28px 32px;
  min-width: 0;
  display: flex;
  flex-direction: column;
}

/* Breadcrumb */
.breadcrumb {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 0.78rem;
  color: var(--canvas-muted);
  margin-bottom: 16px;
}

.breadcrumb a {
  color: var(--canvas-blue);
  text-decoration: none;
}

.breadcrumb a:hover { text-decoration: underline; }

.breadcrumb svg {
  width: 12px;
  height: 12px;
  stroke: var(--canvas-border);
  fill: none;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
}

/* Page heading */
.page-heading {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  margin-bottom: 24px;
  gap: 20px;
  flex-wrap: wrap;
}

.page-heading-text h1 {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--canvas-text);
  letter-spacing: -0.01em;
  margin-bottom: 3px;
}

.page-heading-text p {
  font-size: 0.875rem;
  color: var(--canvas-muted);
}

/* Welcome banner */
.welcome-banner {
  background: var(--canvas-navy);
  border-radius: 6px;
  padding: 24px 28px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  margin-bottom: 28px;
  position: relative;
  overflow: hidden;
}

.welcome-banner::before {
  content: '';
  position: absolute;
  right: -30px;
  top: -30px;
  width: 180px;
  height: 180px;
  border-radius: 50%;
  background: rgba(7,112,163,0.18);
  pointer-events: none;
}

.welcome-banner::after {
  content: '';
  position: absolute;
  right: 60px;
  bottom: -50px;
  width: 120px;
  height: 120px;
  border-radius: 50%;
  background: rgba(7,112,163,0.10);
  pointer-events: none;
}

.welcome-banner-text h2 {
  font-size: 1.25rem;
  font-weight: 700;
  color: #fff;
  margin-bottom: 6px;
}

.welcome-banner-text p {
  font-size: 0.875rem;
  color: rgba(255,255,255,0.70);
  line-height: 1.6;
  max-width: 520px;
}

.welcome-banner-badge {
  flex-shrink: 0;
  background: rgba(255,255,255,0.10);
  border: 1px solid rgba(255,255,255,0.18);
  border-radius: 6px;
  padding: 12px 18px;
  text-align: center;
  z-index: 1;
}

.welcome-banner-badge span {
  display: block;
  font-size: 0.72rem;
  color: rgba(255,255,255,0.55);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  margin-bottom: 4px;
}

.welcome-banner-badge strong {
  display: block;
  font-size: 0.95rem;
  font-weight: 700;
  color: #fff;
}

/* Dashboard card grid */
.dashboard-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 16px;
  margin-bottom: 28px;
}

.dash-card {
  background: var(--canvas-white);
  border: 1px solid var(--canvas-border);
  border-radius: 6px;
  padding: 22px 22px 20px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  transition: box-shadow 0.15s, border-color 0.15s;
}

.dash-card:hover {
  box-shadow: 0 2px 12px rgba(0,0,0,0.09);
  border-color: #b0b8be;
}

.dash-card-icon {
  width: 40px;
  height: 40px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  margin-bottom: 2px;
}

.dash-card-icon svg {
  width: 20px;
  height: 20px;
  fill: none;
  stroke-width: 1.75;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.dash-card-icon.blue  { background: var(--canvas-blue-lt); }
.dash-card-icon.blue svg  { stroke: var(--canvas-blue); }
.dash-card-icon.green { background: var(--canvas-green-lt); }
.dash-card-icon.green svg { stroke: var(--canvas-green); }
.dash-card-icon.navy  { background: #EEF1F3; }
.dash-card-icon.navy svg  { stroke: var(--canvas-navy); }

.dash-card h3 {
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--canvas-text);
  margin-bottom: 2px;
}

.dash-card p {
  font-size: 0.825rem;
  color: var(--canvas-muted);
  line-height: 1.6;
  flex: 1;
}

.dash-card-user {
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--canvas-navy);
  background: #EEF1F3;
  border-radius: var(--canvas-radius);
  padding: 6px 10px;
  display: inline-block;
  margin-top: 2px;
}

.btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  height: 34px;
  padding: 0 16px;
  background: var(--canvas-blue);
  color: #fff;
  border: 1px solid var(--canvas-blue-dk);
  border-radius: var(--canvas-radius);
  font-family: 'Lato', sans-serif;
  font-size: 0.825rem;
  font-weight: 700;
  cursor: pointer;
  text-decoration: none;
  transition: background 0.15s, box-shadow 0.15s;
  white-space: nowrap;
  letter-spacing: 0.01em;
  align-self: flex-start;
  margin-top: 4px;
}

.btn svg {
  width: 13px;
  height: 13px;
  stroke: currentColor;
  fill: none;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.btn:hover {
  background: var(--canvas-blue-dk);
  box-shadow: 0 1px 4px rgba(7,112,163,0.28);
}

.btn:active { transform: translateY(1px); }

/* About card */
.about-card {
  background: var(--canvas-white);
  border: 1px solid var(--canvas-border);
  border-radius: 6px;
  padding: 22px 24px;
  margin-bottom: 0;
}

.about-card h2 {
  font-size: 1rem;
  font-weight: 700;
  color: var(--canvas-text);
  margin-bottom: 10px;
  padding-bottom: 10px;
  border-bottom: 1px solid var(--canvas-border);
}

.about-card p {
  font-size: 0.875rem;
  color: var(--canvas-muted);
  line-height: 1.7;
}

/* ── FOOTER ── */
.page-footer {
  border-top: 1px solid var(--canvas-border);
  padding: 12px 32px;
  background: var(--canvas-white);
  font-size: 0.72rem;
  color: #AAB0B5;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-shrink: 0;
}

@media (max-width: 960px) {
  .sidebar { display: none; }
  .dashboard-grid { grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); }
}

@media (max-width: 640px) {
  .main-content { padding: 20px 16px; }
  .welcome-banner { flex-direction: column; }
  .dashboard-grid { grid-template-columns: 1fr; }
  .topnav-username { display: none; }
}

</style>
</head>

<body>

  <!-- TOP NAV -->
  <nav class="topnav">
    <a href="home.php" class="topnav-logo">
      <div class="topnav-logo-mark">
        <svg viewBox="0 0 20 20"><path d="M3 3h6a2 2 0 012 2v11a2 2 0 01-2 2H3V3zm14 0h-4a2 2 0 00-2 2v11a2 2 0 002 2h4V3z"/></svg>
      </div>
      <span class="topnav-logo-name">EduVault</span>
    </a>

    <ul class="topnav-links">
      <li>
        <a href="home.php" class="active">
          <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="uploadmodule.php">
          <svg viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3"/></svg>
          Upload
        </a>
      </li>
      <li>
        <a href="searchmodule.php">
          <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          Modules
        </a>
      </li>
    </ul>

    <div class="topnav-right">
      <?php if(isset($_SESSION['sesUser'])): ?>
      <div class="topnav-user">
        <div class="topnav-avatar">
          <?php echo strtoupper(substr($_SESSION['sesUser'], 0, 2)); ?>
        </div>
        <span class="topnav-username"><?php echo htmlspecialchars($_SESSION['sesUser']); ?></span>
      </div>
      <?php endif; ?>
      <a href="logout.php" class="topnav-logout">
        <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Log out
      </a>
    </div>
  </nav>

  <div class="page-wrap">

    <!-- SIDEBAR -->
    <aside class="sidebar">
      <div class="sidebar-section-label">Navigation</div>
      <ul class="sidebar-nav">
        <li>
          <a href="home.php" class="active">
            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Dashboard
          </a>
        </li>
        <li>
          <a href="uploadmodule.php">
            <svg viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3"/></svg>
            Upload Module
          </a>
        </li>
        <li>
          <a href="searchmodule.php">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Browse Modules
          </a>
        </li>
      </ul>

      <div class="sidebar-divider"></div>

      <div class="sidebar-section-label">Account</div>
      <ul class="sidebar-nav">
        <li>
          <a href="logout.php">
            <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            Log Out
          </a>
        </li>
      </ul>
    </aside>

    <!-- MAIN -->
    <div style="flex:1; display:flex; flex-direction:column; min-width:0;">
      <main class="main-content">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
          <a href="home.php">EduVault</a>
          <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
          <span>Dashboard</span>
        </div>

        <!-- Page heading -->
        <div class="page-heading">
          <div class="page-heading-text">
            <h1>Dashboard</h1>
            <p>Manage your modules and learning materials from here.</p>
          </div>
        </div>

        <!-- Welcome banner -->
        <div class="welcome-banner">
          <div class="welcome-banner-text">
            <h2>Welcome back, <?php echo htmlspecialchars($_SESSION['sesUser']); ?>!</h2>
            <p>Manage learning modules, upload materials, and help students access educational resources efficiently.</p>
          </div>
          <div class="welcome-banner-badge">
            <span>Logged in as</span>
            <strong>Teacher</strong>
          </div>
        </div>

        <!-- Dashboard quick-access cards -->
        <div class="dashboard-grid">

          <div class="dash-card">
            <div class="dash-card-icon blue">
              <svg viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3"/></svg>
            </div>
            <h3>Upload Modules</h3>
            <p>Add learning materials for your students to access and download.</p>
            <a href="uploadmodule.php" class="btn">
              <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              Open
            </a>
          </div>

          <div class="dash-card">
            <div class="dash-card-icon green">
              <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
            <h3>Browse Modules</h3>
            <p>Find and manage all uploaded learning resources in one place.</p>
            <a href="searchmodule.php" class="btn">
              <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              Open
            </a>
          </div>

          <div class="dash-card">
            <div class="dash-card-icon navy">
              <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <h3>Teacher Account</h3>
            <p>Currently logged in to your teacher portal.</p>
            <span class="dash-card-user"><?php echo htmlspecialchars($_SESSION['sesUser']); ?></span>
          </div>

        </div>

        <!-- About card -->
        <div class="about-card">
          <h2>About EduVault</h2>
          <p>EduVault is an E-Learning Module Distribution System that allows teachers to upload modules while students can search and download learning materials seamlessly.</p>
        </div>

      </main>

      <footer class="page-footer">
        <span><strong>EduVault</strong> &mdash; E-Learning Module Distribution System</span>
        <span>&copy; <?php echo date('Y'); ?> EduVault. All rights reserved.</span>
      </footer>
    </div>

  </div>

</body>
</html>