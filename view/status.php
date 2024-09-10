<?php
include '../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Student') {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM Document_Repository WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Document Status</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Status of Submitted Documents</h1>
    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li><?= $row['title'] ?> - Status: <?= $row['status'] ?></li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No submissions found.</p>
    <?php endif; ?>
</body>
</html>
