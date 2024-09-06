<?php
include '../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Teacher') {
    header('Location: login.php');
    exit();
}

$sql = "SELECT * FROM Document_Repository WHERE status = 'Approved'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Approved Studies</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Approved Studies</h1>
    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li><?= $row['title'] ?></li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No approved studies yet.</p>
    <?php endif; ?>
</body>
</html>
