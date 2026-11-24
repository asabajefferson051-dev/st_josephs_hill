<?php
require_once 'includes/db.php';
include 'includes/header.php';

// Relational JOIN query linking news_posts with users table
$sql = "SELECT news_posts.*, users.username AS author_name, users.role AS author_role 
        FROM news_posts 
        JOIN users ON news_posts.author_id = users.id 
        ORDER BY news_posts.created_at DESC";
$posts = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="page-header">
    <div class="container">
        <h1>News, Events & School Noticeboard</h1>
        <p>Official Announcements, Term Dates & Updates</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="grid-2">
            <?php foreach ($posts as $post): ?>
                <div class="card">
                    <div class="flex-between" style="margin-bottom: 10px;">
                        <span style="background: var(--navy); color: var(--white); padding: 4px 10px; border-radius: 4px; font-size: 0.8rem;">
                            <?= htmlspecialchars($post['category']) ?>
                        </span>
                        <small style="color: var(--grey);"><?= date('F j, Y', strtotime($post['created_at'])) ?></small>
                    </div>
                    <h3><?= htmlspecialchars($post['title']) ?></h3>
                    <p style="margin: 12px 0;"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                    <small style="color: var(--grey);">Posted by: <strong><?= htmlspecialchars($post['author_name']) ?></strong> (<?= htmlspecialchars($post['author_role']) ?>)</small>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
