<?php
include '../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Teacher') {
    header('Location: login.php');
    exit();
}

$teacher_id = $_SESSION['user_id'];

$sql = "SELECT * FROM document_repository WHERE teacher_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Teacher Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Teacher Dashboard</h1>
    <p><a href="logout.php">Logout</a></p>
    <h2>Pending Submissions</h2>
    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li><a href="review.php?id=<?= htmlspecialchars($row['document_id']) ?>"><?= htmlspecialchars($row['title']) ?></a></li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No pending submissions.</p>
    <?php endif; ?>
</body>
</html>
