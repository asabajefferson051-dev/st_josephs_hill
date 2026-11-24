<?php include 'includes/header.php'; ?>

<div class="page-header about-hero">
    <div class="container">
        <h1>About St. Joseph's Hill Secondary School</h1>
        <p>"<?= get_content('school_motto') ?>" — Our History, Identity, and Leadership</p>
    </div>
</div>

<section class="section">
    <div class="container grid-2">
        <div>
            <h2>Our History</h2>
            <p style="margin-top: 15px; text-align: justify;"><?= nl2br(get_content('about_history')) ?></p>
        </div>
        <div class="card">
            <h3>School Identity & Uniforms</h3>
            <p style="margin-top: 10px;"><strong>Motto:</strong> <?= get_content('school_motto') ?></p>
            <p style="margin-top: 8px;"><strong>O-Level Uniform (S.1 - S.4):</strong> Crisp White shirt/blouse paired with Slate Grey trousers/skirts and school necktie.</p>
            <p style="margin-top: 8px;"><strong>A-Level Uniform (S.5 - S.6):</strong> Crisp White shirt/blouse paired with Navy Blue trousers/skirts and senior badge.</p>
        </div>
    </div>
</section>

<section class="section bg-grey">
    <div class="container grid-3">
        <div class="card"><h3>Our Vision</h3><p style="margin-top: 10px;"><?= nl2br(get_content('about_vision')) ?></p></div>
        <div class="card"><h3>Our Mission</h3><p style="margin-top: 10px;"><?= nl2br(get_content('about_mission')) ?></p></div>
        <div class="card">
            <h3>Core Values</h3>
            <ul style="margin-top: 10px; padding-left: 20px;">
                <li>Fear of God & Integrity</li>
                <li>Academic Diligence</li>
                <li>Self-Discipline & Respect</li>
                <li>Service to Humanity</li>
            </ul>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="section-title">Administration & Board of Governors</h2>
        <div class="grid-3">
            <div class="card" style="text-align: center;">
                <img src="assets/images/headmaster_red.png" alt="Head Teacher" style="width: 140px; height: 140px; object-fit: cover; border-radius: 50%; margin-bottom: 12px; border: 3px solid var(--navy);">
                <h4>The Head Teacher</h4>
                <p style="color: var(--grey); font-weight: 600;">Chief Executive & Accounting Officer</p>
            </div>
            <div class="card" style="text-align: center;">
                <h4>Rev. Fr. Chairperson</h4>
                <p style="color: var(--grey); font-weight: 600;">Chairman, Board of Governors</p>
                <p style="margin-top: 8px;">Oversees strategic policy, infrastructure development, and church-school partnership.</p>
            </div>
            <div class="card" style="text-align: center;">
                <h4>Deputy Head Teachers</h4>
                <p style="color: var(--grey); font-weight: 600;">Academics & Administration</p>
                <p style="margin-top: 8px;">Coordinate UNEB curriculum delivery, staff welfare, and student discipline.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
