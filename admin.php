<?php
session_start();
require_once 'includes/db.php';

if (isset($_GET['logout'])) { session_destroy(); header("Location: admin.php"); exit; }

$error = '';
$success = '';
$ip = $_SERVER['REMOTE_ADDR'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $chk = $pdo->prepare("SELECT COUNT(*) FROM login_attempts WHERE ip_address = ? AND attempt_time > (NOW() - INTERVAL 15 MINUTE)");
    $chk->execute([$ip]);
    if ($chk->fetchColumn() >= 5) {
        $error = "Too many failed attempts. Locked for 15 minutes.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([trim($_POST['username'])]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($_POST['password'], $user['password_hash'])) {
            session_regenerate_id(true);
            $pdo->prepare("DELETE FROM login_attempts WHERE ip_address = ?")->execute([$ip]);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: admin.php"); exit;
        } else {
            $pdo->prepare("INSERT INTO login_attempts (ip_address) VALUES (?)")->execute([$ip]);
            $error = "Invalid username or password.";
        }
    }
}

$edit_post = null;
if (isset($_SESSION['user_id'])) {
    if (isset($_POST['save_pages'])) {
        $stmt = $pdo->prepare("UPDATE page_content SET content_value = ? WHERE section_key = ?");
        foreach ($_POST['content'] as $k => $v) { $stmt->execute([trim($v), $k]); }
        $success = "Page content updated!";
    }
    if (isset($_POST['add_news'])) {
        $pdo->prepare("INSERT INTO news_posts (title, content, category, author_id) VALUES (?, ?, ?, ?)")
            ->execute([trim($_POST['title']), trim($_POST['content']), $_POST['category'], $_SESSION['user_id']]);
        $success = "News published!";
    }
    if (isset($_GET['edit_news'])) {
        $st = $pdo->prepare("SELECT * FROM news_posts WHERE id = ?"); $st->execute([$_GET['edit_news']]);
        $edit_post = $st->fetch(PDO::FETCH_ASSOC);
    }
    if (isset($_POST['update_news'])) {
        $pdo->prepare("UPDATE news_posts SET title=?, category=?, content=? WHERE id=?")
            ->execute([trim($_POST['title']), $_POST['category'], trim($_POST['content']), $_POST['post_id']]);
        $success = "News updated!";
    }
    if (isset($_GET['del_news'])) { $pdo->prepare("DELETE FROM news_posts WHERE id=?")->execute([$_GET['del_news']]); header("Location: admin.php?tab=news"); exit; }
    if (isset($_GET['app_id'], $_GET['status'])) { $pdo->prepare("UPDATE applications SET status=? WHERE id=?")->execute([$_GET['status'], $_GET['app_id']]); header("Location: admin.php?tab=apps"); exit; }
    if (isset($_GET['del_app'])) { $pdo->prepare("DELETE FROM applications WHERE id=?")->execute([$_GET['del_app']]); header("Location: admin.php?tab=apps"); exit; }
    if (isset($_POST['add_term'])) { $pdo->prepare("INSERT INTO academic_calendar (term_name, opening_date, closing_date) VALUES (?,?,?)")->execute([$_POST['term_name'], $_POST['opening_date'], $_POST['closing_date']]); $success = "Term added!"; }
    if (isset($_GET['del_term'])) { $pdo->prepare("DELETE FROM academic_calendar WHERE id=?")->execute([$_GET['del_term']]); header("Location: admin.php?tab=acad"); exit; }
    if (isset($_POST['add_uneb'])) { $pdo->prepare("INSERT INTO uneb_results (exam_year, uce_pass_rate, uace_pass_rate) VALUES (?,?,?)")->execute([$_POST['exam_year'], $_POST['uce_pass_rate'], $_POST['uace_pass_rate']]); $success = "UNEB record added!"; }
    if (isset($_GET['del_uneb'])) { $pdo->prepare("DELETE FROM uneb_results WHERE id=?")->execute([$_GET['del_uneb']]); header("Location: admin.php?tab=acad"); exit; }
    if (isset($_GET['del_inq'])) { $pdo->prepare("DELETE FROM inquiries WHERE id=?")->execute([$_GET['del_inq']]); header("Location: admin.php?tab=inq"); exit; }
    if (isset($_POST['add_user'])) {
        try {
            $pdo->prepare("INSERT INTO users (username, password_hash, role) VALUES (?,?,?)")->execute([trim($_POST['new_user']), password_hash($_POST['new_pass'], PASSWORD_DEFAULT), trim($_POST['new_role'])]);
            $success = "Staff account created!";
        } catch (Exception $e) { $error = "Username already exists."; }
    }
}

$tab = $edit_post ? 'news' : ($_GET['tab'] ?? 'overview');
include 'includes/header.php';
?>

<style>
.dash-tabs { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:20px; border-bottom:3px solid var(--navy); padding-bottom:10px; }
.dash-tabs a { padding:8px 14px; background:var(--grey-light); color:var(--navy); text-decoration:none; font-weight:700; border-radius:4px; }
.dash-tabs a.active { background:var(--navy); color:var(--white); }
</style>

<div class="page-header"><div class="container"><h1>Staff Administration Dashboard</h1></div></div>

<section class="section"><div class="container">
<?php if (!isset($_SESSION['user_id'])): ?>
    <div class="card" style="max-width:400px; margin:auto;">
        <h2>Staff Login</h2>
        <p style="color:var(--grey); margin-bottom:12px;">User: <strong>sjh_headteacher</strong> | Pass: <strong>password</strong></p>
        <?php if ($error): ?><div class="alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="POST">
            <div class="form-group"><label>Username</label><input type="text" name="username" required></div>
            <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
            <button type="submit" name="login" class="btn" style="width:100%;">Login</button>
        </form>
    </div>
<?php else: ?>
    <div class="flex-between" style="margin-bottom:20px;">
        <h3>Welcome, <?= htmlspecialchars($_SESSION['username']) ?> (<?= htmlspecialchars($_SESSION['role']) ?>)</h3>
        <a href="admin.php?logout=1" class="btn" style="background:#dc3545;">Logout</a>
    </div>
    <?php if ($success): ?><div class="alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <div class="dash-tabs">
        <a href="admin.php?tab=overview" class="<?= $tab=='overview'?'active':'' ?>">1. Overview</a>
        <a href="admin.php?tab=apps" class="<?= $tab=='apps'?'active':'' ?>">2. Admissions</a>
        <a href="admin.php?tab=news" class="<?= $tab=='news'?'active':'' ?>">3. News</a>
        <a href="admin.php?tab=pages" class="<?= $tab=='pages'?'active':'' ?>">4. Edit Pages</a>
        <a href="admin.php?tab=acad" class="<?= $tab=='acad'?'active':'' ?>">5. Calendar & UNEB</a>
        <a href="admin.php?tab=inq" class="<?= $tab=='inq'?'active':'' ?>">6. Inquiries & Staff</a>
        <a href="admin.php?tab=sec" class="<?= $tab=='sec'?'active':'' ?>">7. Security Scan</a>
    </div>

    <?php include 'includes/admin_tabs.php'; ?>
<?php endif; ?>
</div></section>
<?php include 'includes/footer.php'; ?>
