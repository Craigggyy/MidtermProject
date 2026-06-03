<?php

session_start();

if(!isset($_SESSION['sesUser']))
{
    die("<script>alert('Please Login First');window.location='login.php';</script>");
}

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EduVault — Student Dashboard</title>

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

/* ── TOP NAV ── */
.topnav {
  height: 56px;
  background: var(--canvas-navy);
  display: flex;
  align-items: center;
  padding: 0 0 0 0;
  position: sticky;
  top: 0;
  z-index: 100;
  box-shadow: 0 1px 4px rgba(0,0,0,0.18);
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
  gap: 0;
  height: 100%;
  padding-right: 16px;
}

.topnav-user {
  display: flex;
  align-items: center;
  gap: 9px;
  padding: 0 12px;
  height: 100%;
  cursor: default;
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
  letter-spacing: 0.02em;
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
  min-height: calc(100vh - 56px);
}

/* ── LEFT SIDEBAR ── */
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
}

/* Page heading */
.page-heading {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  margin-bottom: 24px;
  gap: 20px;
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

.btn {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  height: 36px;
  padding: 0 16px;
  background: var(--canvas-blue);
  color: #fff;
  border: 1px solid var(--canvas-blue-dk);
  border-radius: var(--canvas-radius);
  font-family: 'Lato', sans-serif;
  font-size: 0.875rem;
  font-weight: 700;
  cursor: pointer;
  text-decoration: none;
  transition: background 0.15s, box-shadow 0.15s;
  white-space: nowrap;
  letter-spacing: 0.01em;
}

.btn svg {
  width: 14px;
  height: 14px;
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

/* Welcome banner */
.welcome-banner {
  background: var(--canvas-navy);
  border-radius: 6px;
  padding: 28px 32px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 24px;
  margin-bottom: 28px;
  position: relative;
  overflow: hidden;
}

.welcome-banner::before {
  content: '';
  position: absolute;
  right: -40px;
  top: -40px;
  width: 200px;
  height: 200px;
  border-radius: 50%;
  border: 1.5px solid rgba(255,255,255,0.07);
  pointer-events: none;
}

.welcome-banner::after {
  content: '';
  position: absolute;
  right: 60px;
  bottom: -60px;
  width: 160px;
  height: 160px;
  border-radius: 50%;
  border: 1px solid rgba(255,255,255,0.05);
  pointer-events: none;
}

.welcome-left h2 {
  font-size: 1.375rem;
  font-weight: 700;
  color: #fff;
  margin-bottom: 8px;
  letter-spacing: -0.01em;
}

.welcome-left p {
  font-size: 0.875rem;
  color: rgba(255,255,255,0.60);
  line-height: 1.6;
  max-width: 480px;
}

.welcome-badge {
  flex-shrink: 0;
  background: rgba(7,112,163,0.35);
  border: 1px solid rgba(7,112,163,0.55);
  border-radius: 4px;
  padding: 10px 18px;
  text-align: center;
  position: relative;
  z-index: 1;
}

.welcome-badge span {
  display: block;
  font-size: 0.70rem;
  color: rgba(255,255,255,0.50);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  margin-bottom: 3px;
}

.welcome-badge strong {
  display: block;
  font-size: 0.95rem;
  color: #fff;
  font-weight: 700;
}

/* Section label */
.section-title {
  font-size: 1rem;
  font-weight: 700;
  color: var(--canvas-text);
  margin-bottom: 14px;
  padding-bottom: 10px;
  border-bottom: 1px solid var(--canvas-border);
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.section-title a {
  font-size: 0.80rem;
  font-weight: 400;
  color: var(--canvas-blue);
  text-decoration: none;
}

.section-title a:hover {
  text-decoration: underline;
}

/* Info cards row */
.info-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
  margin-bottom: 28px;
}

.info-card {
  background: var(--canvas-white);
  border: 1px solid var(--canvas-border);
  border-radius: 6px;
  padding: 18px 20px;
  display: flex;
  align-items: flex-start;
  gap: 14px;
}

.info-card-icon {
  width: 38px;
  height: 38px;
  border-radius: 6px;
  background: var(--canvas-blue-lt);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.info-card-icon svg {
  width: 18px;
  height: 18px;
  stroke: var(--canvas-blue);
  fill: none;
  stroke-width: 1.75;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.info-card-body .card-label {
  font-size: 0.72rem;
  color: var(--canvas-muted);
  text-transform: uppercase;
  letter-spacing: 0.07em;
  margin-bottom: 4px;
}

.info-card-body .card-value {
  font-size: 1.375rem;
  font-weight: 900;
  color: var(--canvas-text);
  letter-spacing: -0.02em;
  line-height: 1;
  margin-bottom: 3px;
}

.info-card-body .card-sub {
  font-size: 0.75rem;
  color: var(--canvas-muted);
}

/* Quick actions */
.actions-card {
  background: var(--canvas-white);
  border: 1px solid var(--canvas-border);
  border-radius: 6px;
  overflow: hidden;
  margin-bottom: 28px;
}

.action-item {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 15px 20px;
  border-bottom: 1px solid var(--canvas-border);
  text-decoration: none;
  transition: background 0.12s;
}

.action-item:last-child {
  border-bottom: none;
}

.action-item:hover {
  background: var(--canvas-blue-lt);
}

.action-icon {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  background: var(--canvas-blue-lt);
  border: 1px solid rgba(7,112,163,0.20);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.action-icon svg {
  width: 15px;
  height: 15px;
  stroke: var(--canvas-blue);
  fill: none;
  stroke-width: 1.75;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.action-text .action-title {
  font-size: 0.875rem;
  font-weight: 700;
  color: var(--canvas-text);
  margin-bottom: 1px;
}

.action-text .action-desc {
  font-size: 0.78rem;
  color: var(--canvas-muted);
}

.action-arrow {
  margin-left: auto;
  width: 18px;
  height: 18px;
  stroke: var(--canvas-border);
  fill: none;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
  flex-shrink: 0;
  transition: stroke 0.12s;
}

.action-item:hover .action-arrow {
  stroke: var(--canvas-blue);
}

/* Notice box */
.notice-box {
  background: var(--canvas-blue-lt);
  border: 1px solid rgba(7,112,163,0.25);
  border-left: 3px solid var(--canvas-blue);
  border-radius: 0 4px 4px 0;
  padding: 13px 16px;
  margin-bottom: 28px;
  font-size: 0.82rem;
  color: var(--canvas-blue-dk);
  line-height: 1.55;
}

.notice-box strong {
  font-weight: 700;
}

/* Two-col layout */
.two-col {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
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
}

@media (max-width: 960px) {
  .sidebar { display: none; }
  .info-grid { grid-template-columns: 1fr 1fr; }
  .two-col { grid-template-columns: 1fr; }
}

@media (max-width: 640px) {
  .main-content { padding: 20px 16px; }
  .info-grid { grid-template-columns: 1fr; }
  .welcome-badge { display: none; }
  .topnav-username { display: none; }
}

</style>
</head>

<body>

  <!-- TOP NAV -->
  <nav class="topnav">
    <a href="studenthome.php" class="topnav-logo">
      <div class="topnav-logo-mark">
        <svg viewBox="0 0 20 20"><path d="M3 3h6a2 2 0 012 2v11a2 2 0 01-2 2H3V3zm14 0h-4a2 2 0 00-2 2v11a2 2 0 002 2h4V3z"/></svg>
      </div>
      <span class="topnav-logo-name">EduVault</span>
    </a>

    <ul class="topnav-links">
      <li>
        <a href="studenthome.php" class="active">
          <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="searchmodule.php">
          <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          Browse Modules
        </a>
      </li>
    </ul>

    <div class="topnav-right">
      <div class="topnav-user">
        <div class="topnav-avatar">
          <?php
            $initials = strtoupper(substr($_SESSION['sesUser'], 0, 2));
            echo htmlspecialchars($initials);
          ?>
        </div>
        <span class="topnav-username"><?php echo htmlspecialchars($_SESSION['sesUser']); ?></span>
      </div>
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
          <a href="studenthome.php" class="active">
            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Dashboard
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

        <!-- Page heading -->
        <div class="page-heading">
          <div class="page-heading-text">
            <h1>Student Dashboard</h1>
            <p>Welcome back, <?php echo htmlspecialchars($_SESSION['sesUser']); ?>. Here's your learning overview.</p>
          </div>
          <a href="searchmodule.php" class="btn">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Browse Modules
          </a>
        </div>

        <!-- Welcome banner -->
        <div class="welcome-banner">
          <div class="welcome-left">
            <h2>Welcome back, <?php echo htmlspecialchars($_SESSION['sesUser']); ?>.</h2>
            <p>Browse and download learning materials uploaded by your teachers. Find modules, files, and resources all in one organized place.</p>
          </div>
          <div class="welcome-badge">
            <span>Logged in as</span>
            <strong>Student</strong>
          </div>
        </div>

        <!-- Notice -->
        <div class="notice-box">
          <strong>Getting started:</strong> Use the Browse Modules page to find materials shared by your teachers. You can search by subject or topic.
        </div>

        <!-- Info cards -->
        <h2 class="section-title">Quick Access</h2>
        <div class="info-grid" style="margin-bottom:28px;">
          <div class="info-card">
            <div class="info-card-icon">
              <svg viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
            </div>
            <div class="info-card-body">
              <div class="card-label">Modules</div>
              <div class="card-value">Browse</div>
              <div class="card-sub">All uploaded materials</div>
            </div>
          </div>
          <div class="info-card">
            <div class="info-card-icon">
              <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
            <div class="info-card-body">
              <div class="card-label">Search</div>
              <div class="card-value">Find</div>
              <div class="card-sub">By subject or keyword</div>
            </div>
          </div>
          <div class="info-card">
            <div class="info-card-icon">
              <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            </div>
            <div class="info-card-body">
              <div class="card-label">Downloads</div>
              <div class="card-value">Ready</div>
              <div class="card-sub">Download anytime</div>
            </div>
          </div>
        </div>

        <!-- Actions -->
        <h2 class="section-title">
          What would you like to do?
        </h2>
        <div class="actions-card">
          <a href="searchmodule.php" class="action-item">
            <div class="action-icon">
              <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
            <div class="action-text">
              <div class="action-title">Browse All Modules</div>
              <div class="action-desc">View and download all learning materials shared by your teachers.</div>
            </div>
            <svg class="action-arrow" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
          </a>
          <a href="logout.php" class="action-item">
            <div class="action-icon">
              <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            </div>
            <div class="action-text">
              <div class="action-title">Log Out</div>
              <div class="action-desc">Sign out of your EduVault student account.</div>
            </div>
            <svg class="action-arrow" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
          </a>
        </div>

      </main>

      <footer class="page-footer">
        <span><strong>EduVault</strong> &mdash; Student Portal</span>
        <span>&copy; <?php echo date('Y'); ?> EduVault. All rights reserved.</span>
      </footer>
    </div>

  </div>

</body>
</html>