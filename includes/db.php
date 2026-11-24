<?php
$host = 'localhost';
$dbname = 'st_josephs_hill_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$site_content = [];
try {
    $stmt = $pdo->query("SELECT section_key, content_value FROM page_content");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $site_content[$row['section_key']] = $row['content_value'];
    }
} catch (Exception $e) {}

function get_content($key, $default = '') {
    global $site_content;
    return isset($site_content[$key]) ? htmlspecialchars($site_content[$key]) : htmlspecialchars($default);
}
?>

