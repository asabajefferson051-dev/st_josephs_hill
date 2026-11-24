<?php
require_once 'includes/db.php';
$message = '';

function save_attachment($base64_field, $file_field, $prefix, $upload_dir) {
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    if (!empty($_POST[$base64_field]) && strpos($_POST[$base64_field], 'data:image/') === 0) {
        $parts = explode(',', $_POST[$base64_field]);
        if (isset($parts[1])) {
            $data = base64_decode($parts[1]);
            $filename = $prefix . '_' . time() . '_' . rand(100, 999) . '.png';
            file_put_contents($upload_dir . $filename, $data);
            return 'assets/uploads/' . $filename;
        }
    }
    if (isset($_FILES[$file_field]) && $_FILES[$file_field]['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES[$file_field]['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'pdf'])) {
            $filename = $prefix . '_' . time() . '_' . rand(100, 999) . '.' . $ext;
            move_uploaded_file($_FILES[$file_field]['tmp_name'], $upload_dir . $filename);
            return 'assets/uploads/' . $filename;
        }
    }
    return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_name = trim($_POST['student_name']);
    $gender = $_POST['gender'];
    $previous_school = trim($_POST['previous_school']);
    $aggregates = trim($_POST['aggregates']);
    $applying_for_class = $_POST['applying_for_class'];
    $parent_phone = trim($_POST['parent_phone']);

    if ($student_name && $previous_school && $aggregates && $parent_phone) {
        $upload_dir = __DIR__ . '/assets/uploads/';
        $photo_path = save_attachment('photo_camera_data', 'student_photo_file', 'photo', $upload_dir);
        $doc_path = save_attachment('doc_camera_data', 'academic_doc_file', 'doc', $upload_dir);

        $stmt = $pdo->prepare("INSERT INTO applications (student_name, gender, previous_school, aggregates, applying_for_class, parent_phone, student_photo, academic_doc) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$student_name, $gender, $previous_school, $aggregates, $applying_for_class, $parent_phone, $photo_path, $doc_path]);
        $message = '<div class="alert-success">Application, photo, and academic document submitted successfully!</div>';
    } else {
        $message = '<div class="alert-error">Please fill in all required fields.</div>';
    }
}
include 'includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <h1>Admissions & Online Enrollment</h1>
        <p>"<?= get_content('school_motto') ?>" — Apply Online with Camera Photo & Document Capture</p>
    </div>
</div>

<section class="section">
    <div class="container grid-2" style="align-items: start;">
        <div>
            <h2>Entry Requirements</h2>
            <div class="card" style="margin: 15px 0;">
                <h4>Senior One (S.1) Entry</h4>
                <p><?= nl2br(get_content('adm_s1_req')) ?></p>
            </div>
            <div class="card" style="margin-bottom: 20px;">
                <h4>Senior Five (S.5) Entry</h4>
                <p><?= nl2br(get_content('adm_s5_req')) ?></p>
            </div>

            <h3>Fees Overview (Per Term)</h3>
            <table>
                <tr><th>Section</th><th>Day Scholar</th><th>Boarding Section</th></tr>
                <tr><td>O-Level (S.1 - S.4)</td><td><?= get_content('fees_olevel_day') ?></td><td><?= get_content('fees_olevel_boarding') ?></td></tr>
                <tr><td>A-Level (S.5 - S.6)</td><td><?= get_content('fees_alevel_day') ?></td><td><?= get_content('fees_alevel_boarding') ?></td></tr>
            </table>

            <div style="margin-top: 25px;">
                <a href="assets/docs/admission_form.pdf" download class="btn">Download Offline Admission Form (PDF)</a>
            </div>
        </div>

        <div class="card">
            <h2>Online Student Application</h2>
            <p style="margin-bottom: 15px; color: var(--grey);">Complete the form and capture or upload your passport photo and PLE/UCE pass slip.</p>
            <?= $message ?>
            <form method="POST" action="admissions.php" enctype="multipart/form-data">
                <div class="form-group"><label>Student Full Name *</label><input type="text" name="student_name" required></div>
                <div class="form-group"><label>Gender *</label><select name="gender" required><option value="Male">Male</option><option value="Female">Female</option></select></div>
                <div class="form-group"><label>Previous School *</label><input type="text" name="previous_school" required></div>
                <div class="form-group"><label>PLE Aggregates or UCE Grades *</label><input type="text" name="aggregates" required placeholder="e.g. PLE Agg 10 or UCE 18 pts"></div>
                <div class="form-group"><label>Class Applying For *</label>
                    <select name="applying_for_class" required>
                        <option value="S.1">Senior One (S.1)</option>
                        <option value="S.2">Senior Two (S.2)</option>
                        <option value="S.3">Senior Three (S.3)</option>
                        <option value="S.5">Senior Five (S.5)</option>
                    </select>
                </div>
                <div class="form-group"><label>Parent / Guardian Phone Number *</label><input type="tel" name="parent_phone" required></div>

                <!-- 1. Applicant Passport Photo -->
                <div class="form-group" style="background: var(--grey-light); padding: 12px; border-radius: 6px; border: 1px solid #ccc;">
                    <label>1. Applicant Passport Photo (Take Photo or Upload)</label>
                    <div style="display: flex; gap: 8px; margin-bottom: 8px;">
                        <button type="button" class="btn" style="padding: 6px 12px; font-size: 0.85rem;" onclick="startCamera('photo')">Open Camera</button>
                        <button type="button" class="btn" id="snap-photo-btn" style="padding: 6px 12px; font-size: 0.85rem; background: #28a745; display:none;" onclick="capturePhoto('photo')">Capture Photo</button>
                    </div>
                    <video id="video-photo" width="100%" autoplay playsinline style="display:none; border-radius: 4px; margin-bottom: 8px;"></video>
                    <canvas id="canvas-photo" style="display:none;"></canvas>
                    <img id="preview-photo" style="display:none; width: 130px; height: 130px; object-fit: cover; border-radius: 4px; border: 2px solid var(--navy); margin-bottom: 8px;">
                    <input type="hidden" name="photo_camera_data" id="data-photo">
                    <small style="display:block; color: var(--grey); margin-bottom: 4px;">Or choose a photo file:</small>
                    <input type="file" name="student_photo_file" accept="image/*">
                </div>

                <!-- 2. Academic Document / Pass Slip -->
                <div class="form-group" style="background: var(--grey-light); padding: 12px; border-radius: 6px; border: 1px solid #ccc;">
                    <label>2. Academic Document / PLE or UCE Pass Slip (Snap or Upload)</label>
                    <div style="display: flex; gap: 8px; margin-bottom: 8px;">
                        <button type="button" class="btn" style="padding: 6px 12px; font-size: 0.85rem;" onclick="startCamera('doc')">Open Document Camera</button>
                        <button type="button" class="btn" id="snap-doc-btn" style="padding: 6px 12px; font-size: 0.85rem; background: #28a745; display:none;" onclick="capturePhoto('doc')">Snap Document</button>
                    </div>
                    <video id="video-doc" width="100%" autoplay playsinline style="display:none; border-radius: 4px; margin-bottom: 8px;"></video>
                    <canvas id="canvas-doc" style="display:none;"></canvas>
                    <img id="preview-doc" style="display:none; width: 100%; max-height: 180px; object-fit: contain; border-radius: 4px; border: 2px solid var(--navy); margin-bottom: 8px;">
                    <input type="hidden" name="doc_camera_data" id="data-doc">
                    <small style="display:block; color: var(--grey); margin-bottom: 4px;">Or upload PDF / Image scan:</small>
                    <input type="file" name="academic_doc_file" accept="image/*,.pdf">
                </div>

                <button type="submit" class="btn" style="width: 100%;">Submit Complete Application</button>
            </form>
        </div>
    </div>
</section>

<script>
let streams = {};

async function startCamera(type) {
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        alert('Browser camera API is unavailable. Ensure you are using https://localhost and click Allow when prompted.');
        return;
    }
    try {
        if (streams[type]) {
            streams[type].getTracks().forEach(track => track.stop());
        }
        const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
        streams[type] = stream;
        const video = document.getElementById('video-' + type);
        video.srcObject = stream;
        video.style.display = 'block';
        document.getElementById('snap-' + type + '-btn').style.display = 'inline-block';
    } catch (err) {
        alert('Camera could not open (' + err.name + ': ' + err.message + '). Check Windows Privacy > Camera settings or use the file upload option below.');
    }
}

function capturePhoto(type) {
    const video = document.getElementById('video-' + type);
    const canvas = document.getElementById('canvas-' + type);
    const preview = document.getElementById('preview-' + type);
    const dataInput = document.getElementById('data-' + type);

    canvas.width = video.videoWidth || 320;
    canvas.height = video.videoHeight || 240;
    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

