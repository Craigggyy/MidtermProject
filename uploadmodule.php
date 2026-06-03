<?php

session_start();

if($_SESSION['sesUserType'] != "Teacher")
{
    die("<script>alert('Only Teachers Can Upload Modules'); window.location='studenthome.php';</script>");
}

if(!isset($_SESSION['sesUser']))
{
    die("<script>alert('Please Login First'); window.location='login.php';</script>");
}

function uploadmodule()
{
    $subject  = $_POST['txtSubject'];
    $category = $_POST['txtCategory'];
    $targetDir  = "uploads/";
    $targetFile = $targetDir . basename($_FILES['docFile']['name']);
    $filetype   = pathinfo($targetFile, PATHINFO_EXTENSION);

    if($_FILES['docFile']['error'] !== UPLOAD_ERR_OK)
    {
        die("Upload Error");
    }

    if(move_uploaded_file($_FILES['docFile']['tmp_name'], $targetFile))
    {
        $file = fopen("modules.txt", "a");
        fwrite($file, $subject . "\n");
        fwrite($file, $category . "\n");
        fwrite($file, strtoupper($filetype) . "\n");
        fwrite($file, $targetFile . "\n");
        fclose($file);
        echo "<script>alert('Module Uploaded Successfully');</script>";
    }
    else
    {
        echo "<script>alert('Upload Failed');</script>";
    }
}

if(isset($_POST['btnUpload']))
{
    uploadmodule();
}

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EduVault — Upload Module</title>

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

.sidebar-nav a:hover svg { stroke: var(--canvas-blue); }

.sidebar-nav a.active {
  background: var(--canvas-blue-lt);
  border-left-color: var(--canvas-blue);
  color: var(--canvas-blue-dk);
  font-weight: 700;
}

.sidebar-nav a.active svg { stroke: var(--canvas-blue); }

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

/* Two-column layout */
.upload-layout {
  display: grid;
  grid-template-columns: 1fr 300px;
  gap: 20px;
  align-items: start;
}

/* Form card */
.form-card {
  background: var(--canvas-white);
  border: 1px solid var(--canvas-border);
  border-radius: 6px;
  overflow: hidden;
}

.form-card-header {
  padding: 16px 20px;
  border-bottom: 1px solid var(--canvas-border);
  background: #FAFAFA;
}

.form-card-header h2 {
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--canvas-text);
}

.form-card-body {
  padding: 22px 24px;
  display: flex;
  flex-direction: column;
  gap: 18px;
}

/* Form fields */
.form-group {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.form-group label {
  font-size: 0.78rem;
  font-weight: 700;
  color: var(--canvas-label);
  letter-spacing: 0.01em;
}

.form-group label .required {
  color: #C0392B;
  margin-left: 2px;
}

.form-control {
  display: block;
  width: 100%;
  height: 36px;
  padding: 0 10px;
  font-family: 'Lato', sans-serif;
  font-size: 0.875rem;
  color: var(--canvas-text);
  background: var(--canvas-white);
  border: 1px solid var(--canvas-border);
  border-radius: var(--canvas-radius);
  outline: none;
  transition: border-color 0.15s, box-shadow 0.15s;
  appearance: none;
  -webkit-appearance: none;
}

.form-control::placeholder { color: #aab0b5; }

.form-control:focus {
  border-color: var(--canvas-blue);
  box-shadow: 0 0 0 2px rgba(7,112,163,0.20);
}

.form-control:hover:not(:focus) { border-color: #a0aaaf; }

/* Select arrow */
.select-wrap {
  position: relative;
}

.select-wrap::after {
  content: '';
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  width: 0;
  height: 0;
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 5px solid var(--canvas-muted);
  pointer-events: none;
}

.select-wrap .form-control {
  padding-right: 28px;
  cursor: pointer;
}

/* File upload */
.file-upload-wrap {
  border: 2px dashed var(--canvas-border);
  border-radius: var(--canvas-radius);
  padding: 24px 20px;
  text-align: center;
  transition: border-color 0.15s, background 0.15s;
  cursor: pointer;
  position: relative;
}

.file-upload-wrap:hover {
  border-color: var(--canvas-blue);
  background: var(--canvas-blue-lt);
}

.file-upload-wrap.has-file {
  border-color: var(--canvas-green);
  background: var(--canvas-green-lt);
}

.file-upload-wrap input[type="file"] {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  cursor: pointer;
}

.file-upload-icon {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: var(--canvas-bg);
  border: 1px solid var(--canvas-border);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 10px;
}

.file-upload-icon svg {
  width: 17px;
  height: 17px;
  stroke: var(--canvas-muted);
  fill: none;
  stroke-width: 1.75;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.file-upload-label {
  font-size: 0.875rem;
  font-weight: 700;
  color: var(--canvas-blue);
  display: block;
  margin-bottom: 3px;
}

.file-upload-hint {
  font-size: 0.78rem;
  color: var(--canvas-muted);
}

.file-upload-name {
  display: none;
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--canvas-green);
  margin-top: 6px;
}

.file-upload-wrap.has-file .file-upload-name { display: block; }

/* Form footer */
.form-card-footer {
  padding: 14px 24px;
  border-top: 1px solid var(--canvas-border);
  background: #FAFAFA;
  display: flex;
  align-items: center;
  gap: 10px;
}

.btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  height: 36px;
  padding: 0 18px;
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

/* Side panel cards */
.side-card {
  background: var(--canvas-white);
  border: 1px solid var(--canvas-border);
  border-radius: 6px;
  overflow: hidden;
}

.side-card-header {
  padding: 14px 18px;
  border-bottom: 1px solid var(--canvas-border);
  background: #FAFAFA;
}

.side-card-header h3 {
  font-size: 0.875rem;
  font-weight: 700;
  color: var(--canvas-text);
}

.side-card-body {
  padding: 16px 18px;
}

/* Guidelines list */
.guidelines-list {
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.guidelines-list li {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 0.875rem;
  color: var(--canvas-text);
}

.guidelines-list li::before {
  content: '';
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: var(--canvas-blue);
  flex-shrink: 0;
}

.guidelines-list li .file-ext {
  margin-left: auto;
  font-size: 0.68rem;
  font-weight: 700;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  padding: 2px 6px;
  border-radius: 3px;
}

.ext-pdf   { background: #FDECEA; color: #C0392B; }
.ext-doc   { background: #EBF2FA; color: #2E6DA4; }
.ext-ppt   { background: var(--canvas-orange-lt); color: var(--canvas-orange); }
.ext-zip   { background: #F0EEF8; color: #6B3FA0; }

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
  .upload-layout { grid-template-columns: 1fr; }
}

@media (max-width: 640px) {
  .main-content { padding: 20px 16px; }
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
        <a href="home.php">
          <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="uploadmodule.php" class="active">
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
          <a href="home.php">
            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Dashboard
          </a>
        </li>
        <li>
          <a href="uploadmodule.php" class="active">
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
          <a href="home.php">Dashboard</a>
          <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
          <span>Upload Module</span>
        </div>

        <!-- Page heading -->
        <div class="page-heading">
          <div class="page-heading-text">
            <h1>Upload Learning Module</h1>
            <p>Share educational materials with your students.</p>
          </div>
        </div>

        <!-- Two-column layout -->
        <div class="upload-layout">

          <!-- Upload form card -->
          <div class="form-card">
            <div class="form-card-header">
              <h2>Module Details</h2>
            </div>
            <form method="POST" enctype="multipart/form-data" action="uploadmodule.php">
              <div class="form-card-body">

                <div class="form-group">
                  <label for="txtSubject">Subject Name <span class="required">*</span></label>
                  <input
                    type="text"
                    id="txtSubject"
                    name="txtSubject"
                    class="form-control"
                    placeholder="e.g. Programming 1"
                    required>
                </div>

                <div class="form-group">
                  <label for="txtCategory">Module Category <span class="required">*</span></label>
                  <div class="select-wrap">
                    <select id="txtCategory" name="txtCategory" class="form-control">
                      <option>Information Technology</option>
                      <option>Programming</option>
                      <option>Networking</option>
                      <option>Database</option>
                      <option>Mathematics</option>
                      <option>Science</option>
                      <option>English</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label>Module File <span class="required">*</span></label>
                  <div class="file-upload-wrap" id="fileDropZone">
                    <input
                      type="file"
                      name="docFile"
                      id="docFile"
                      required>
                    <div class="file-upload-icon">
                      <svg viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3"/></svg>
                    </div>
                    <span class="file-upload-label">Click to browse or drag file here</span>
                    <span class="file-upload-hint">PDF, DOC, DOCX, PPT, PPTX, ZIP</span>
                    <span class="file-upload-name" id="fileUploadName"></span>
                  </div>
                </div>

              </div>
              <div class="form-card-footer">
                <button type="submit" name="btnUpload" class="btn">
                  <svg viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3"/></svg>
                  Upload Module
                </button>
                <a href="home.php" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
          </div>

          <!-- Side panel -->
          <div class="side-card">
            <div class="side-card-header">
              <h3>Upload Guidelines</h3>
            </div>
            <div class="side-card-body">
              <ul class="guidelines-list">
                <li>
                  PDF Files
                  <span class="file-ext ext-pdf">PDF</span>
                </li>
                <li>
                  Word Documents
                  <span class="file-ext ext-doc">DOC</span>
                </li>
                <li>
                  PowerPoint Files
                  <span class="file-ext ext-ppt">PPT</span>
                </li>
                <li>
                  ZIP Learning Packages
                  <span class="file-ext ext-zip">ZIP</span>
                </li>
              </ul>
            </div>
          </div>

        </div><!-- /.upload-layout -->

      </main>

      <footer class="page-footer">
        <span><strong>EduVault</strong> &mdash; E-Learning Module Distribution System</span>
        <span>&copy; <?php echo date('Y'); ?> EduVault. All rights reserved.</span>
      </footer>
    </div>

  </div>

  <script>
    // File input: show filename and apply has-file styling
    document.getElementById('docFile').addEventListener('change', function() {
      const zone = document.getElementById('fileDropZone');
      const nameEl = document.getElementById('fileUploadName');
      if(this.files && this.files[0]) {
        zone.classList.add('has-file');
        nameEl.textContent = '✓ ' + this.files[0].name;
      } else {
        zone.classList.remove('has-file');
        nameEl.textContent = '';
      }
    });
  </script>

</body>
</html>