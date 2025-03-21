<?php
$total_documents = $conn->query("
SELECT COUNT(*) 
AS total FROM document_repository 
WHERE status = 'Approved'
")->fetch_assoc()['total'];


$study_status_data = $conn->query("
SELECT status, 
COUNT(*) 
AS count FROM document_repository GROUP 
BY status
")->fetch_all(MYSQLI_ASSOC);

$pending_approvals = $conn->query("
SELECT COUNT(*) 
AS total FROM document_repository 
WHERE status = 'Pending'
")->fetch_assoc()['total'];

$user_roles_data = $conn->query("
SELECT role, 
COUNT(*) 
AS count FROM users GROUP 
BY role
")->fetch_all(MYSQLI_ASSOC);

$active_users_data = $conn->query("
SELECT COUNT(*) AS active_users
FROM users
WHERE last_login >= DATE_SUB(NOW(), INTERVAL 2 MONTH)
")->fetch_assoc()['active_users'];

$recent_submissions_data = $conn->query("
SELECT title, date_submitted, status
FROM document_repository
ORDER BY date_submitted DESC
LIMIT 5
")->fetch_all(MYSQLI_ASSOC);

$recent_users_online_data = $conn->query("
SELECT first_name, last_name, last_login
FROM users
WHERE last_login >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
ORDER BY last_login DESC
LIMIT 6
")->fetch_all(MYSQLI_ASSOC);

$data = [];

$the_studies = $conn->query("
SELECT MONTH(date_submitted) AS month, COUNT(*) AS total 
FROM document_repository 
WHERE status = 'Approved' 
AND date_submitted >= DATE_SUB(NOW(), INTERVAL 8 MONTH)
GROUP BY MONTH(date_submitted)
");

while ($row = $the_studies->fetch_assoc()) {
$data[] = $row;
}

$published_data = $conn->query("
SELECT MONTH(date_submitted) AS month, COUNT(*) AS total 
FROM document_repository 
WHERE status = 'Approved' 
AND date_submitted >= DATE_SUB(NOW(), INTERVAL 7 MONTH)
GROUP BY MONTH(date_submitted) 
")->fetch_all(MYSQLI_ASSOC);

$unpublished_data = $conn->query("
SELECT MONTH(date_submitted) AS month, COUNT(*) AS total 
FROM document_repository 
WHERE status = 'Pending' 
AND date_submitted >= DATE_SUB(NOW(), INTERVAL 7 MONTH)
GROUP BY MONTH(date_submitted)
")->fetch_all(MYSQLI_ASSOC);

$hugawaba = $conn->query("
SELECT COUNT(*) AS total FROM document_repository
")->fetch_assoc();

$last_month = $conn->query("
SELECT COUNT(*) AS total 
FROM document_repository 
WHERE date_submitted >= DATE_SUB(NOW(), INTERVAL 2 MONTH) 
AND date_submitted < DATE_SUB(NOW(), INTERVAL 1 MONTH)
")->fetch_assoc()['total'];

$current_month = $conn->query("
SELECT COUNT(*) AS total 
FROM document_repository 
WHERE date_submitted >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
")->fetch_assoc()['total'];

if ($last_month > 0) {
$percent_change = (($current_month - $last_month) / $last_month) * 100;
} else {
$percent_change = 0;
}

$totalusers = $conn->query("
SELECT COUNT(*) AS total 
FROM users
")->fetch_assoc()['total'];

$totalmsgs = $conn->query("
SELECT COUNT(*) AS total 
FROM notification_logs
WHERE is_checked = 0
")->fetch_assoc()['total'];
?>