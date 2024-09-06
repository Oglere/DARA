<?php
include '../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Teacher') {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $document_id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $status = $_POST['status'];
        $sql = "UPDATE Document_Repository SET status = ?, date_reviewed = NOW() WHERE document_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $document_id);
        $stmt->execute();
        header('Location: teacher_dashboard.php');
    }

    $sql = "SELECT * FROM Document_Repository WHERE document_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $document_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $document = $result->fetch_assoc();
} else {
    header('Location: teacher_dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Review Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Review Document</h1>
    <h2><?= $document['title'] ?></h2>
    <p><strong>Authors:</strong> <?= implode(', ', json_decode($document['authors'], true)) ?></p>
    <p><strong>Abstract:</strong> <?= json_decode($document['metadata'], true)['abstract'] ?></p>
    <p><a href="<?= $document['file_path'] ?>" target="_blank">Download Document</a></p>
    <form method="post">
        <label>Status:</label>
        <select name="status">
            <option value="Approved">Approve</option>
            <option value="Needs Revision">Request Revision</option>
            <option value="Rejected">Reject</option>
        </select><br>
        <button type="submit">Submit Review</button>
    </form>
</body>
</html>
