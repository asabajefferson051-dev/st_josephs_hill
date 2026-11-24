<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/db.php';
$current_page = basename($_SERVER['PHP_SELF']);

$seo_meta = [
    'index.php' => ['title' => "St. Joseph's Hill Secondary School Fort Portal | Education is Light", 'desc' => "Official website of St. Joseph's Hill Secondary School in Fort Portal, Uganda.", 'keys' => "St Josephs Hill Secondary School, Fort Portal schools, UNEB O and A level"],
    'about.php' => ['title' => "About Us & Leadership | St. Joseph's Hill Secondary School", 'desc' => "History, vision, mission, uniforms, and Board of Governors of St. Joseph's Hill SS.", 'keys' => "St Josephs Hill history, vision mission, Fort Portal boarding school"],
    'academics.php' => ['title' => "UNEB O & A Level Curriculum | St. Joseph's Hill Secondary School", 'desc' => "UNEB Lower Secondary O-Level subjects, A-Level combinations, calendar, and past results.", 'keys' => "UNEB O level curriculum, A level combinations, academic calendar"],
    'admissions.php' => ['title' => "Online Admissions & Fees (S.1 - S.5) | St. Joseph's Hill SS", 'desc' => "Apply online to St. Joseph's Hill Secondary School for S.1 and S.5 with photo and document upload.", 'keys' => "S1 admissions Uganda, S5 admissions Fort Portal, school fees"],
    'student-life.php' => ['title' => "Student Life, Sports & Boarding | St. Joseph's Hill SS", 'desc' => "Sports, clubs, boarding facilities, and spiritual life at St. Joseph's Hill Secondary School.", 'keys' => "boarding school Fort Portal, school sports, clubs"],
    'news.php' => ['title' => "News, Term Dates & Events | St. Joseph's Hill SS", 'desc' => "Official school noticeboard, term dates, and announcements.", 'keys' => "school noticeboard, reporting dates, St Josephs Hill news"],
    'contact.php' => ['title' => "Contact Us & Location | St. Joseph's Hill Secondary School", 'desc' => "Location map, phone numbers, email addresses, and online inquiry form.", 'keys' => "contact St Josephs Hill SS, Fort Portal location"]
];
$meta = $seo_meta[$current_page] ?? ['title' => "Staff Portal | St. Joseph's Hill SS", 'desc' => "Staff Administration Dashboard", 'keys' => "staff portal"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($meta['title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta['desc']) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta['keys']) ?>">
    <link rel="icon" type="image/png" href="assets/images/school_banner.png">
    <link href="https://googleapis.com" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
    <style>
        body { padding-top: 112px !important; }
        .main-header { position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; z-index: 9999 !important; width: 100% !important; box-shadow: 0 3px 10px rgba(0,0,0,0.15) !important; }
    </style>
</head>
<body>

<header class="main-header">
    <div class="top-bar">
        <div class="container flex-between">
            <span>Motto: <strong>"<?= get_content('school_motto', 'Education is Light') ?>"</strong></span>
            <span>Tel: <?= get_content('school_phone', '+256 772 000 000') ?> | Email: <?= get_content('school_email', 'info@stjosephshill.ac.ug') ?></span>
        </div>
    </div>
    <nav class="navbar">
        <div class="container flex-between">
            <a href="index.php" class="brand">
                <img src="assets/images/school_banner.png" alt="St. Joseph's Hill Logo" class="nav-logo">
                <div>
                    <h1>ST. JOSEPH'S HILL</h1>
                    <small>SECONDARY SCHOOL</small>
                </div>
            </a>
            <button class="menu-toggle" id="menuToggle">&#9776;</button>
            <ul class="nav-links" id="navLinks">
                <li><a href="index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>">Home</a></li>
                <li><a href="about.php" class="<?= $current_page == 'about.php' ? 'active' : '' ?>">About Us</a></li>
                <li><a href="academics.php" class="<?= $current_page == 'academics.php' ? 'active' : '' ?>">Academics</a></li>
                <li><a href="admissions.php" class="<?= $current_page == 'admissions.php' ? 'active' : '' ?>">Admissions</a></li>
                <li><a href="student-life.php" class="<?= $current_page == 'student-life.php' ? 'active' : '' ?>">Student Life</a></li>
                <li><a href="news.php" class="<?= $current_page == 'news.php' ? 'active' : '' ?>">News & Events</a></li>
                <li><a href="contact.php" class="<?= $current_page == 'contact.php' ? 'active' : '' ?>">Contact</a></li>
                <li><a href="admin.php" class="btn-nav">Staff Portal</a></li>
            </ul>
        </div>
    </nav>
</header>
