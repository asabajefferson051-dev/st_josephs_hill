<?php
require_once 'includes/db.php';
$feedback = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_name = trim($_POST['sender_name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if ($sender_name && $email && $subject && $message) {
        $stmt = $pdo->prepare("INSERT INTO inquiries (sender_name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$sender_name, $email, $subject, $message]);
        $feedback = '<div class="alert-success">Thank you! Your message has been received by the school administration.</div>';
    } else {
        $feedback = '<div class="alert-error">Please complete all fields before sending.</div>';
    }
}
include 'includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <h1>Contact Us</h1>
        <p>We Welcome Parents, Guardians, Alumni & Visitors</p>
    </div>
</div>

<section class="section">
    <div class="container grid-2">
        <div>
            <h2>Get in Touch</h2>
            <p style="margin: 15px 0;">Have questions about admissions, fees, or academic programs? Reach out using our contact details or send us a direct inquiry.</p>
            <div class="card" style="margin-bottom: 20px;">
                <p><strong>Location:</strong> St. Joseph's Hill, Western Uganda</p>
                <p style="margin-top: 8px;"><strong>Phone:</strong> +256 772 055 687 / +256 777 605238</p>
                <p style="margin-top: 8px;"><strong>Official Emails:</strong><br>info@stjosephshill.ac.ug<br>admissions@stjosephshill.ac.ug</p>
            </div>
            <!-- Embedded Location Map -->
            <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6928.470905046504!2d30.638599254226733!3d0.6117856981922949!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1763b10d51cade1b%3A0x778baf8e1eae6116!2sSt.%20Joseph%E2%80%99s%20Hill%20ss-%20kyembogo!5e0!3m2!1sen!2sug!4v1794826101466!5m2!1sen!2sug" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" width="100%" height="250" style="border:0; border-radius:6px;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <div class="card">
            <h2>Send an Inquiry</h2>
            <?= $feedback ?>
            <form method="POST" action="contact.php" style="margin-top: 15px;">
                <div class="form-group">
                    <label>Your Name *</label>
                    <input type="text" name="sender_name" required>
                </div>
                <div class="form-group">
                    <label>Email Address *</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Subject *</label>
                    <input type="text" name="subject" required>
                </div>
                <div class="form-group">
                    <label>Message *</label>
                    <textarea name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn" style="width: 100%;">Send Message</button>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
