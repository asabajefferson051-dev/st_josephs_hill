# St. Joseph's Hill Secondary School — Official Website & Admissions Portal

- **Client:** St. Joseph's Hill Secondary School (Fort Portal, Uganda)
- **Motto:** *"Education is Light"*
- **Technology Stack:** Plain PHP 8, MySQL (PDO), HTML5, CSS3, Vanilla JavaScript

## Project Overview
A responsive, database-driven secondary school website and custom CRUD administration portal built to manage student admissions, academic calendars, UNEB exam highlights, news announcements, and parent inquiries.

## Core Features
1. **7 Responsive Public Pages:** `index.php`, `about.php`, `academics.php`, `admissions.php`, `student-life.php`, `news.php`, and `contact.php` styled in the school's uniform palette (Navy Blue, Slate Grey, and Crisp White).
2. **Online S.1–S.5 Admissions with Live Camera Capture:** Applicants can capture live passport photos and academic pass slips via webcam/device camera or file upload.
3. **Custom Staff CRUD Dashboard (`admin.php`):** Password-protected portal featuring full Create/Read/Update/Delete operations, SQL `JOIN` queries linking announcements to staff authors, and a live CMS editor (`page_content`).
4. **Security & Technical SEO:** Forced HTTPS (`.htaccess`), brute-force login lockout (`login_attempts`), SHA-256 file integrity checksums, dynamic meta tags, `robots.txt`, and `sitemap.xml`.

## Setup Instructions
1. Import `database.sql` into MySQL / phpMyAdmin (`st_josephs_hill_db`).
2. Configure database credentials in `includes/db.php`.
3. Access the public site via `index.php` and the staff portal via `admin.php`.
