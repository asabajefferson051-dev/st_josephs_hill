<?php if ($tab == 'overview'): ?>
    <div class="grid-4">
        <div class="stat-box"><h3><?= $pdo->query("SELECT COUNT(*) FROM applications")->fetchColumn() ?></h3><p>Applications</p></div>
        <div class="stat-box"><h3><?= $pdo->query("SELECT COUNT(*) FROM applications WHERE status='Pending'")->fetchColumn() ?></h3><p>Pending</p></div>
        <div class="stat-box"><h3><?= $pdo->query("SELECT COUNT(*) FROM news_posts")->fetchColumn() ?></h3><p>News Posts</p></div>
        <div class="stat-box"><h3><?= $pdo->query("SELECT COUNT(*) FROM inquiries")->fetchColumn() ?></h3><p>Inquiries</p></div>
    </div>

<?php elseif ($tab == 'apps'): ?>
    <div class="card" style="overflow-x:auto;">
        <h3>Student Applications & Camera Attachments</h3>
        <table>
            <tr><th>Photo</th><th>Student</th><th>Class</th><th>School</th><th>Grades</th><th>Doc</th><th>Phone</th><th>Status</th><th>Action</th></tr>
            <?php foreach ($pdo->query("SELECT * FROM applications ORDER BY submitted_at DESC")->fetchAll(PDO::FETCH_ASSOC) as $a): ?>
            <tr>
                <td><?= !empty($a['student_photo']) ? '<a href="'.htmlspecialchars($a['student_photo']).'" target="_blank"><img src="'.htmlspecialchars($a['student_photo']).'" style="width:45px;height:45px;object-fit:cover;"></a>' : '-' ?></td>
                <td><strong><?= htmlspecialchars($a['student_name']) ?></strong> (<?= $a['gender'] ?>)</td>
                <td><?= $a['applying_for_class'] ?></td>
                <td><?= htmlspecialchars($a['previous_school']) ?></td>
                <td><?= htmlspecialchars($a['aggregates']) ?></td>
                <td><?= !empty($a['academic_doc']) ? '<a href="'.htmlspecialchars($a['academic_doc']).'" target="_blank">View Doc</a>' : '-' ?></td>
                <td><?= htmlspecialchars($a['parent_phone']) ?></td>
                <td><strong><?= $a['status'] ?></strong></td>
                <td><a href="admin.php?tab=apps&app_id=<?= $a['id'] ?>&status=Admitted">Admit</a> | <a href="admin.php?tab=apps&app_id=<?= $a['id'] ?>&status=Rejected" style="color:red;">Reject</a> | <a href="admin.php?tab=apps&del_app=<?= $a['id'] ?>" style="color:red;">Del</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

<?php elseif ($tab == 'news'): ?>
    <div class="grid-2" style="align-items:start;">
        <div class="card">
            <h3><?= $edit_post ? 'Edit News' : 'Post News' ?></h3>
            <form method="POST" action="admin.php?tab=news">
                <?php if ($edit_post): ?><input type="hidden" name="post_id" value="<?= $edit_post['id'] ?>"><?php endif; ?>
                <div class="form-group"><label>Title</label><input type="text" name="title" required value="<?= $edit_post ? htmlspecialchars($edit_post['title']) : '' ?>"></div>
                <div class="form-group"><label>Category</label><select name="category"><option>Announcement</option><option>Term Dates</option><option>Events</option><option>Academics</option></select></div>
                <div class="form-group"><label>Content</label><textarea name="content" rows="4" required><?= $edit_post ? htmlspecialchars($edit_post['content']) : '' ?></textarea></div>
                <button type="submit" name="<?= $edit_post ? 'update_news' : 'add_news' ?>" class="btn"><?= $edit_post ? 'Update' : 'Publish' ?></button>
            </form>
        </div>
        <div class="card">
            <h3>Noticeboard Posts</h3>
            <table>
                <tr><th>Title</th><th>Author</th><th>Action</th></tr>
                <?php foreach ($pdo->query("SELECT news_posts.*, users.username FROM news_posts JOIN users ON news_posts.author_id=users.id ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC) as $p): ?>
                <tr><td><?= htmlspecialchars($p['title']) ?></td><td><?= htmlspecialchars($p['username']) ?></td><td><a href="admin.php?edit_news=<?= $p['id'] ?>">Edit</a> | <a href="admin.php?del_news=<?= $p['id'] ?>" style="color:red;">Del</a></td></tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

<?php elseif ($tab == 'pages'): ?>
    <div class="card">
        <h3>Edit Dynamic Website Content</h3>
        <form method="POST" action="admin.php?tab=pages">
            <?php foreach ($pdo->query("SELECT * FROM page_content ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC) as $f): ?>
            <div class="form-group"><label>[<?= strtoupper($f['page_slug']) ?>] <?= htmlspecialchars($f['section_label']) ?></label><textarea name="content[<?= $f['section_key'] ?>]" rows="2"><?= htmlspecialchars($f['content_value']) ?></textarea></div>
            <?php endforeach; ?>
            <button type="submit" name="save_pages" class="btn">Save All Page Changes</button>
        </form>
    </div>

<?php elseif ($tab == 'acad'): ?>
    <div class="grid-2" style="align-items:start;">
        <div class="card">
            <h3>Academic Calendar</h3>
            <form method="POST" action="admin.php?tab=acad">
                <div class="form-group"><label>Term</label><input type="text" name="term_name" required></div>
                <div class="form-group"><label>Opens</label><input type="text" name="opening_date" required></div>
                <div class="form-group"><label>Closes</label><input type="text" name="closing_date" required></div>
                <button type="submit" name="add_term" class="btn">Add Term</button>
            </form>
            <table><tr><th>Term</th><th>Opens</th><th>Closes</th><th></th></tr>
            <?php foreach ($pdo->query("SELECT * FROM academic_calendar")->fetchAll(PDO::FETCH_ASSOC) as $t): ?>
            <tr><td><?= htmlspecialchars($t['term_name']) ?></td><td><?= htmlspecialchars($t['opening_date']) ?></td><td><?= htmlspecialchars($t['closing_date']) ?></td><td><a href="admin.php?del_term=<?= $t['id'] ?>" style="color:red;">Del</a></td></tr>
            <?php endforeach; ?></table>
        </div>
        <div class="card">
            <h3>UNEB Highlights</h3>
            <form method="POST" action="admin.php?tab=acad">
                <div class="form-group"><label>Year</label><input type="text" name="exam_year" required></div>
                <div class="form-group"><label>UCE Rate</label><input type="text" name="uce_pass_rate" required></div>
                <div class="form-group"><label>UACE Rate</label><input type="text" name="uace_pass_rate" required></div>
                <button type="submit" name="add_uneb" class="btn">Add Year</button>
            </form>
            <table><tr><th>Year</th><th>UCE</th><th>UACE</th><th></th></tr>
            <?php foreach ($pdo->query("SELECT * FROM uneb_results ORDER BY exam_year DESC")->fetchAll(PDO::FETCH_ASSOC) as $r): ?>
            <tr><td><?= htmlspecialchars($r['exam_year']) ?></td><td><?= htmlspecialchars($r['uce_pass_rate']) ?></td><td><?= htmlspecialchars($r['uace_pass_rate']) ?></td><td><a href="admin.php?del_uneb=<?= $r['id'] ?>" style="color:red;">Del</a></td></tr>
            <?php endforeach; ?></table>
        </div>
    </div>

<?php elseif ($tab == 'inq'): ?>
    <div class="card" style="margin-bottom:25px;">
        <h3>Contact Inquiries</h3>
        <table><tr><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th></th></tr>
        <?php foreach ($pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC) as $i): ?>
        <tr><td><?= htmlspecialchars($i['sender_name']) ?></td><td><?= htmlspecialchars($i['email']) ?></td><td><?= htmlspecialchars($i['subject']) ?></td><td><?= htmlspecialchars($i['message']) ?></td><td><a href="admin.php?del_inq=<?= $i['id'] ?>" style="color:red;">Del</a></td></tr>
        <?php endforeach; ?></table>
    </div>
    <div class="card" style="max-width:450px;">
        <h3>Add Staff Account</h3>
        <form method="POST" action="admin.php?tab=inq">
            <div class="form-group"><label>Username</label><input type="text" name="new_user" required></div>
            <div class="form-group"><label>Role</label><input type="text" name="new_role" required></div>
            <div class="form-group"><label>Password</label><input type="password" name="new_pass" required></div>
            <button type="submit" name="add_user" class="btn">Create Account</button>
        </form>
    </div>

<?php elseif ($tab == 'sec'): ?>
    <div class="card">
        <h3>Security & File Integrity Audit</h3>
        <table>
            <tr><th>File</th><th>SHA-256 Checksum</th><th>Modified</th></tr>
            <?php foreach (['index.php','about.php','academics.php','admissions.php','student-life.php','news.php','contact.php','admin.php'] as $f): ?>
            <tr><td><code><?= $f ?></code></td><td><small><?= file_exists($f) ? hash_file('sha256', $f) : 'Missing' ?></small></td><td><?= file_exists($f) ? date('Y-m-d H:i', filemtime($f)) : '-' ?></td></tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>
