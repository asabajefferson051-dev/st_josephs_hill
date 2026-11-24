<?php
require_once 'includes/db.php';
include 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM news_posts ORDER BY created_at DESC LIMIT 3");
$latest_news = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="hero-section">
    <div class="container">
        <h2>Welcome to St. Joseph's Hill Secondary School</h2>
        <p class="hero-motto">"<?= get_content('school_motto', 'Education is Light') ?>"</p>
        <div>
            <a href="admissions.php" class="btn">Apply Online Now</a>
            <a href="about.php" class="btn btn-outline">Discover Our Heritage</a>
        </div>

        <div class="slider-container">
            <div class="slide active"><img src="assets/images/slide1.png" alt="Students"><div class="slide-caption">Vibrant Student Community at St. Joseph's Hill SS</div></div>
            <div class="slide"><img src="assets/images/slide2.png" alt="Faith"><div class="slide-caption">Nurturing Discipline, Faith & Moral Values</div></div>
            <div class="slide"><img src="assets/images/slide3.png" alt="Campus"><div class="slide-caption">Serene & Conducive Learning Environment on the Hill</div></div>
            <div class="slide"><img src="assets/images/slide4.png" alt="Sports"><div class="slide-caption">Excellence in Co-Curricular Sports & Athletics</div></div>
            <div class="slide"><img src="assets/images/slide5.png" alt="Uniform"><div class="slide-caption">Smartness & Pride in Our O & A Level Uniforms</div></div>
            <div class="slide"><img src="assets/images/slide6.png" alt="Celebration"><div class="slide-caption">Celebrating Academic & Co-Curricular Achievements</div></div>
            <div class="slide"><img src="assets/images/slide7.png" alt="Night View"><div class="slide-caption">Well-Lit Modern Classrooms & Evening Prep Facilities</div></div>
            <div class="slide"><img src="assets/images/slide8.png" alt="Boarding"><div class="slide-caption">Safe, Secure & Welcoming Boarding Environment</div></div>
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
        </div>
    </div>
</section>

<section class="section bg-grey">
    <div class="container grid-4">
        <div class="stat-box"><h3><?= get_content('stat_pass_rate', '98%') ?></h3><p>UNEB Pass Rate</p></div>
        <div class="stat-box"><h3><?= get_content('stat_students', '1,200+') ?></h3><p>Enrolled Students</p></div>
        <div class="stat-box"><h3><?= get_content('stat_teachers', '65+') ?></h3><p>Qualified Teachers</p></div>
        <div class="stat-box"><h3><?= get_content('stat_years', '25+') ?></h3><p>Years of Excellence</p></div>
    </div>
</section>

<section class="section">
    <div class="container grid-2">
        <div style="text-align: center;">
            <img src="assets/images/headmaster_red.png" alt="Head Teacher of St. Joseph's Hill SS" class="headteacher-img">
            <h4 style="margin-top: 12px;">Office of the Head Teacher</h4>
            <p style="color: var(--grey); font-weight: 600;">St. Joseph's Hill Secondary School</p>
        </div>
        <div>
            <h2>From the Desk of the Head Teacher</h2>
            <p style="margin: 15px 0; text-align: justify;"><?= nl2br(get_content('ht_welcome_p1')) ?></p>
            <p style="margin-bottom: 20px; text-align: justify;"><?= nl2br(get_content('ht_welcome_p2')) ?></p>
            <p style="font-style: italic; color: var(--navy); font-weight: 600; margin-bottom: 20px;">"<?= get_content('school_motto') ?>" — Together in Service and Academic Excellence.</p>
            <a href="about.php" class="btn">Read School Profile & Leadership</a>
        </div>
    </div>
</section>

<section class="section bg-grey">
    <div class="container">
        <h2 class="section-title">Latest Announcements & Upcoming Events</h2>
        <div class="grid-3">
            <?php foreach ($latest_news as $news): ?>
                <div class="card">
                    <small style="color: var(--grey); font-weight: 700;"><?= htmlspecialchars($news['category']) ?> | <?= date('M d, Y', strtotime($news['created_at'])) ?></small>
                    <h3 style="margin: 10px 0;"><?= htmlspecialchars($news['title']) ?></h3>
                    <p><?= htmlspecialchars(substr($news['content'], 0, 130)) ?>...</p>
                </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align: center; margin-top: 30px;">
            <a href="news.php" class="btn">View Full Noticeboard</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
