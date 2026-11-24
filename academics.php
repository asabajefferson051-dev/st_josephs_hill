<?php
require_once 'includes/db.php';
include 'includes/header.php';

$calendar = $pdo->query("SELECT * FROM academic_calendar ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
$results = $pdo->query("SELECT * FROM uneb_results ORDER BY exam_year DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="page-header">
    <div class="container">
        <h1>Academics & UNEB Curriculum</h1>
        <p>"<?= get_content('school_motto') ?>" — Competence-Based Lower Secondary & Advanced Level Excellence</p>
    </div>
</div>

<section class="section">
    <div class="container grid-2">
        <div class="card">
            <img src="assets/images/slide5.png" alt="O-Level Students" style="width: 100%; height: 230px; object-fit: cover; border-radius: 4px; margin-bottom: 15px;">
            <h3>O-Level Curriculum (S.1 - S.4)</h3>
            <p style="margin: 10px 0;">We fully implement the NCDC / UNEB Lower Secondary Competence-Based Curriculum focusing on practical skills and project work.</p>
            <ul style="padding-left: 20px;">
                <li><strong>Compulsory:</strong> English, Mathematics, Physics, Chemistry, Biology, Geography, History & Political Education, Kiswahili, Physical Education.</li>
                <li><strong>Electives:</strong> ICT, Agriculture, Entrepreneurship, Christian Religious Education, Fine Art, Literature.</li>
            </ul>
        </div>
        <div class="card">
            <img src="assets/images/slide9.png" alt="A-Level Students" style="width: 100%; height: 230px; object-fit: cover; border-radius: 4px; margin-bottom: 15px;">
            <h3>A-Level Combinations (S.5 - S.6)</h3>
            <p style="margin: 10px 0;">Students specialize in Sciences or Arts alongside General Paper and Sub-ICT / Sub-Mathematics.</p>
            <ul style="padding-left: 20px;">
                <li><strong>Sciences:</strong> PCM, PCB, BCM, PEM, MEG</li>
                <li><strong>Arts & Humanities:</strong> HEG, HEL, DEG, HLD, LEG</li>
            </ul>
        </div>
    </div>
</section>

<section class="section bg-grey">
    <div class="container">
        <h2 class="section-title">Academic Calendar & Past UNEB Highlights</h2>
        <div class="grid-2">
            <div>
                <h3>Academic Term Calendar</h3>
                <table>
                    <tr><th>Term</th><th>Opening Date</th><th>Closing Date</th></tr>
                    <?php foreach ($calendar as $term): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($term['term_name']) ?></strong></td>
                        <td><?= htmlspecialchars($term['opening_date']) ?></td>
                        <td><?= htmlspecialchars($term['closing_date']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div>
                <h3>Past UNEB Performance Highlights</h3>
                <table>
                    <tr><th>Year</th><th>UCE Pass Rate</th><th>UACE 2+ Principal Passes</th></tr>
                    <?php foreach ($results as $res): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($res['exam_year']) ?></strong></td>
                        <td><?= htmlspecialchars($res['uce_pass_rate']) ?></td>
                        <td><?= htmlspecialchars($res['uace_pass_rate']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
