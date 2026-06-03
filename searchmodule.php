<?php

session_start();

$search = "";

if(isset($_POST['btnSearch']))
{
    $search = $_POST['txtSearch'];
}

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EduVault — Learning Materials</title>

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

/* Page heading row */
.page-heading {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  margin-bottom: 20px;
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

/* Search card */
.search-card {
  background: var(--canvas-white);
  border: 1px solid var(--canvas-border);
  border-radius: 6px;
  padding: 18px 20px;
  margin-bottom: 24px;
}

.search-form {
  display: flex;
  gap: 10px;
  align-items: flex-end;
}

.search-field {
  flex: 1;
}

.search-field label {
  display: block;
  font-size: 0.78rem;
  font-weight: 700;
  color: var(--canvas-label);
  margin-bottom: 5px;
  letter-spacing: 0.01em;
}

.search-input-wrap {
  position: relative;
}

.search-input-wrap svg {
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
  width: 15px;
  height: 15px;
  stroke: var(--canvas-muted);
  fill: none;
  stroke-width: 1.75;
  stroke-linecap: round;
  stroke-linejoin: round;
  pointer-events: none;
}

.search-input {
  display: block;
  width: 100%;
  height: 36px;
  padding: 0 10px 0 32px;
  font-family: 'Lato', sans-serif;
  font-size: 0.875rem;
  color: var(--canvas-text);
  background: var(--canvas-white);
  border: 1px solid var(--canvas-border);
  border-radius: var(--canvas-radius);
  outline: none;
  transition: border-color 0.15s, box-shadow 0.15s;
}

.search-input::placeholder { color: #aab0b5; }

.search-input:focus {
  border-color: var(--canvas-blue);
  box-shadow: 0 0 0 2px rgba(7,112,163,0.20);
}

.search-input:hover:not(:focus) { border-color: #a0aaaf; }

.btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
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
  flex-shrink: 0;
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

.btn:active { transform: translateY(1px); }

.btn-secondary {
  background: var(--canvas-white);
  color: var(--canvas-text);
  border-color: var(--canvas-border);
}

.btn-secondary:hover {
  background: var(--canvas-bg);
  box-shadow: none;
  border-color: #a0aaaf;
}

/* Results bar */
.results-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 14px;
  gap: 12px;
}

.results-count {
  font-size: 0.82rem;
  color: var(--canvas-muted);
}

.results-count strong {
  color: var(--canvas-text);
  font-weight: 700;
}

.active-search-tag {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: var(--canvas-blue-lt);
  border: 1px solid rgba(7,112,163,0.25);
  border-radius: 100px;
  padding: 3px 10px 3px 8px;
  font-size: 0.75rem;
  color: var(--canvas-blue-dk);
  font-weight: 700;
}

.active-search-tag svg {
  width: 12px;
  height: 12px;
  stroke: var(--canvas-blue);
  fill: none;
  stroke-width: 2;
  stroke-linecap: round;
}

/* Module grid */
.module-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 16px;
  margin-bottom: 32px;
}

/* Module card */
.module-card {
  background: var(--canvas-white);
  border: 1px solid var(--canvas-border);
  border-radius: 6px;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  transition: box-shadow 0.15s, border-color 0.15s;
}

.module-card:hover {
  box-shadow: 0 2px 12px rgba(0,0,0,0.09);
  border-color: #b0b8be;
}

/* Colored top stripe by filetype */
.module-card-stripe {
  height: 4px;
  background: var(--canvas-blue);
  flex-shrink: 0;
}

.module-card-stripe.pdf    { background: #C0392B; }
.module-card-stripe.doc,
.module-card-stripe.docx   { background: #2E6DA4; }
.module-card-stripe.ppt,
.module-card-stripe.pptx   { background: #C66000; }
.module-card-stripe.xls,
.module-card-stripe.xlsx   { background: #2E8247; }
.module-card-stripe.video  { background: #6B3FA0; }
.module-card-stripe.other  { background: var(--canvas-blue); }

.module-card-body {
  padding: 16px 18px;
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 0;
}

.module-card-meta {
  display: flex;
  align-items: center;
  gap: 6px;
  margin-bottom: 10px;
}

.filetype-badge {
  display: inline-flex;
  align-items: center;
  height: 20px;
  padding: 0 7px;
  border-radius: 3px;
  font-size: 0.68rem;
  font-weight: 700;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  background: var(--canvas-blue-lt);
  color: var(--canvas-blue-dk);
  border: 1px solid rgba(7,112,163,0.20);
}

.filetype-badge.pdf    { background: #FDECEA; color: #C0392B; border-color: rgba(192,57,43,0.20); }
.filetype-badge.doc,
.filetype-badge.docx   { background: #EBF2FA; color: #2E6DA4; border-color: rgba(46,109,164,0.20); }
.filetype-badge.ppt,
.filetype-badge.pptx   { background: var(--canvas-orange-lt); color: var(--canvas-orange); border-color: rgba(198,96,0,0.20); }
.filetype-badge.xls,
.filetype-badge.xlsx   { background: var(--canvas-green-lt); color: var(--canvas-green); border-color: rgba(46,130,71,0.20); }
.filetype-badge.video  { background: var(--canvas-purple-lt); color: var(--canvas-purple); border-color: rgba(107,63,160,0.20); }

.module-card-title {
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--canvas-text);
  margin-bottom: 6px;
  line-height: 1.35;
}

.module-card-category {
  font-size: 0.80rem;
  color: var(--canvas-muted);
  display: flex;
  align-items: center;
  gap: 5px;
}

.module-card-category svg {
  width: 13px;
  height: 13px;
  stroke: var(--canvas-border);
  fill: none;
  stroke-width: 1.75;
  stroke-linecap: round;
  stroke-linejoin: round;
  flex-shrink: 0;
}

.module-card-footer {
  padding: 12px 18px;
  border-top: 1px solid var(--canvas-border);
  background: #FAFAFA;
}

.download-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  width: 100%;
  height: 32px;
  background: var(--canvas-blue);
  color: #fff;
  border: 1px solid var(--canvas-blue-dk);
  border-radius: var(--canvas-radius);
  font-family: 'Lato', sans-serif;
  font-size: 0.82rem;
  font-weight: 700;
  cursor: pointer;
  text-decoration: none;
  transition: background 0.15s, box-shadow 0.15s;
  letter-spacing: 0.01em;
}

.download-btn svg {
  width: 13px;
  height: 13px;
  stroke: currentColor;
  fill: none;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.download-btn:hover {
  background: var(--canvas-blue-dk);
  box-shadow: 0 1px 4px rgba(7,112,163,0.28);
}

/* Empty state */
.empty-state {
  grid-column: 1 / -1;
  background: var(--canvas-white);
  border: 1px solid var(--canvas-border);
  border-radius: 6px;
  padding: 48px 32px;
  text-align: center;
}

.empty-state-icon {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: var(--canvas-bg);
  border: 1px solid var(--canvas-border);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 16px;
}

.empty-state-icon svg {
  width: 22px;
  height: 22px;
  stroke: var(--canvas-muted);
  fill: none;
  stroke-width: 1.5;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.empty-state h3 {
  font-size: 1rem;
  font-weight: 700;
  color: var(--canvas-text);
  margin-bottom: 6px;
}

.empty-state p {
  font-size: 0.875rem;
  color: var(--canvas-muted);
  line-height: 1.6;
  max-width: 320px;
  margin: 0 auto;
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
  .module-grid { grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); }
}

@media (max-width: 640px) {
  .main-content { padding: 20px 16px; }
  .search-form { flex-direction: column; align-items: stretch; }
  .module-grid { grid-template-columns: 1fr; }
  .topnav-username { display: none; }
}

</style>
</head>

<body>

  <!-- TOP NAV -->
  <nav class="topnav">
    <a href="<?php echo isset($_SESSION['sesUserType']) && $_SESSION['sesUserType'] == 'Teacher' ? 'home.php' : 'studenthome.php'; ?>" class="topnav-logo">
      <div class="topnav-logo-mark">
        <svg viewBox="0 0 20 20"><path d="M3 3h6a2 2 0 012 2v11a2 2 0 01-2 2H3V3zm14 0h-4a2 2 0 00-2 2v11a2 2 0 002 2h4V3z"/></svg>
      </div>
      <span class="topnav-logo-name">EduVault</span>
    </a>

    <ul class="topnav-links">
      <?php if(isset($_SESSION['sesUserType']) && $_SESSION['sesUserType'] == 'Teacher'): ?>
      <li>
        <a href="home.php">
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
      <?php else: ?>
      <li>
        <a href="studenthome.php">
          <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          Dashboard
        </a>
      </li>
      <?php endif; ?>
      <li>
        <a href="searchmodule.php" class="active">
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
        <?php if(isset($_SESSION['sesUserType']) && $_SESSION['sesUserType'] == 'Teacher'): ?>
        <li>
          <a href="home.php">
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
        <?php else: ?>
        <li>
          <a href="studenthome.php">
            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Dashboard
          </a>
        </li>
        <?php endif; ?>
        <li>
          <a href="searchmodule.php" class="active">
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
          <a href="<?php echo isset($_SESSION['sesUserType']) && $_SESSION['sesUserType'] == 'Teacher' ? 'home.php' : 'studenthome.php'; ?>">Dashboard</a>
          <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
          <span>Learning Materials</span>
        </div>

        <!-- Page heading -->
        <div class="page-heading">
          <div class="page-heading-text">
            <h1>Learning Materials</h1>
            <p>Browse and download modules shared by teachers.</p>
          </div>
        </div>

        <!-- Search card -->
        <div class="search-card">
          <form method="POST" class="search-form">
            <div class="search-field">
              <label for="txtSearch">Search by Subject</label>
              <div class="search-input-wrap">
                <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input
                  type="text"
                  id="txtSearch"
                  name="txtSearch"
                  class="search-input"
                  placeholder="e.g. Programming, Mathematics..."
                  value="<?php echo htmlspecialchars($search); ?>">
              </div>
            </div>
            <input type="submit" name="btnSearch" value="Search" class="btn">
            <?php if($search != ""): ?>
            <a href="searchmodule.php" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
          </form>
        </div>

        <?php

        $textsource = "modules.txt";
        $found_any  = false;
        $total      = 0;
        $matches    = 0;

        // First pass: count totals
        if(file_exists($textsource))
        {
            $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);
            $total = (int)(count($textcontent) / 4);
        }

        ?>

        <!-- Results bar -->
        <div class="results-bar">
          <span class="results-count">
            <?php if($search != ""): ?>
              Showing results for <strong>"<?php echo htmlspecialchars($search); ?>"</strong>
            <?php else: ?>
              All modules
            <?php endif; ?>
          </span>
          <?php if($search != ""): ?>
          <span class="active-search-tag">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <?php echo htmlspecialchars($search); ?>
          </span>
          <?php endif; ?>
        </div>

        <!-- Module grid -->
        <div class="module-grid">

        <?php

        if(file_exists($textsource))
        {
            $textcontent = file($textsource, FILE_IGNORE_NEW_LINES);

            for($i = 0; $i < count($textcontent); $i = $i + 4)
            {
                $subject  = isset($textcontent[$i])   ? $textcontent[$i]   : '';
                $category = isset($textcontent[$i+1]) ? $textcontent[$i+1] : '';
                $filetype = isset($textcontent[$i+2]) ? $textcontent[$i+2] : '';
                $filepath = isset($textcontent[$i+3]) ? $textcontent[$i+3] : '';

                if($search == "" || stripos($subject, $search) !== false)
                {
                    $found_any = true;
                    $matches++;

                    // Determine stripe/badge class from filetype
                    $ft_lower = strtolower($filetype);
                    if(strpos($ft_lower, 'pdf')  !== false)  $ft_class = 'pdf';
                    elseif(strpos($ft_lower, 'docx') !== false) $ft_class = 'docx';
                    elseif(strpos($ft_lower, 'doc')  !== false) $ft_class = 'doc';
                    elseif(strpos($ft_lower, 'pptx') !== false) $ft_class = 'pptx';
                    elseif(strpos($ft_lower, 'ppt')  !== false) $ft_class = 'ppt';
                    elseif(strpos($ft_lower, 'xlsx') !== false) $ft_class = 'xlsx';
                    elseif(strpos($ft_lower, 'xls')  !== false) $ft_class = 'xls';
                    elseif(strpos($ft_lower, 'mp4')  !== false ||
                           strpos($ft_lower, 'video') !== false) $ft_class = 'video';
                    else  $ft_class = 'other';
        ?>

          <div class="module-card">
            <div class="module-card-stripe <?php echo $ft_class; ?>"></div>
            <div class="module-card-body">
              <div class="module-card-meta">
                <span class="filetype-badge <?php echo $ft_class; ?>"><?php echo htmlspecialchars($filetype); ?></span>
              </div>
              <div class="module-card-title"><?php echo htmlspecialchars($subject); ?></div>
              <div class="module-card-category">
                <svg viewBox="0 0 24 24"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg>
                <?php echo htmlspecialchars($category); ?>
              </div>
            </div>
            <div class="module-card-footer">
              <a class="download-btn" href="download.php?file=<?php echo urlencode($filepath); ?>">
                <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Download Module
              </a>
            </div>
          </div>

        <?php
                }
            }

            if(!$found_any)
            {
        ?>
          <div class="empty-state">
            <div class="empty-state-icon">
              <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
            <h3><?php echo $search != "" ? "No results found" : "No modules yet"; ?></h3>
            <p>
              <?php echo $search != ""
                ? "No modules matched \"" . htmlspecialchars($search) . "\". Try a different search term."
                : "No modules have been uploaded yet. Check back later.";
              ?>
            </p>
          </div>
        <?php
            }
        }
        else
        {
        ?>
          <div class="empty-state">
            <div class="empty-state-icon">
              <svg viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
            </div>
            <h3>No modules available</h3>
            <p>No modules have been uploaded yet. Ask your teacher to upload learning materials.</p>
          </div>
        <?php } ?>

        </div><!-- /.module-grid -->

      </main>

      <footer class="page-footer">
        <span><strong>EduVault</strong> &mdash; Learning Materials Library</span>
        <span>&copy; <?php echo date('Y'); ?> EduVault. All rights reserved.</span>
      </footer>
    </div>

  </div>

</body>
</html>