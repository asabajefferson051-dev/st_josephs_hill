<footer class="main-footer">
    <div class="container grid-3">
        <div>
            <h3>St. Joseph's Hill SS</h3>
            <p>Nurturing holistic, disciplined, and academically sound leaders grounded in Christian values and service.</p>
            <p style="margin-top: 8px;"><strong>O-Level Uniform:</strong> Crisp White & Slate Grey<br>
               <strong>A-Level Uniform:</strong> Crisp White & Navy Blue</p>
        </div>
        <div>
            <h3>Quick Links</h3>
            <ul class="footer-links">
                <li><a href="about.php">School History & Mission</a></li>
                <li><a href="academics.php">UNEB O & A Level Curriculum</a></li>
                <li><a href="admissions.php">Online Admissions</a></li>
                <li><a href="news.php">Noticeboard & Term Dates</a></li>
            </ul>
        </div>
        <div>
            <h3>Contact Information</h3>
            <p><?= get_content('school_address') ?></p>
            <p>Phone: <?= get_content('school_phone') ?></p>
            <p>Email: <?= get_content('school_email') ?></p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> St. Joseph's Hill Secondary School. All Rights Reserved.</p>
    </div>
</footer>
<script src="assets/js/main.js"></script>
</body>
</html>
