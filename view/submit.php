<?php
include '../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Student') {
    header('Location: login.php');
    exit();
}

$sql = "SELECT user_id, CONCAT(first_name, ' ', last_name) AS name FROM users WHERE role = 'Teacher'";
$result = $conn->query($sql);
$teachers = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $main_author = $_POST['main_author'];
    $co_authors = json_encode(explode(',', $_POST['co_authors']));
    $publication_date = $_POST['publication_date'];
    $keywords = json_encode(explode(',', $_POST['keywords']));
    $citations = json_encode(explode(',', $_POST['citations']));
    $metadata = json_encode(['abstract' => $abstract, 'publication_date' => $publication_date, 'keywords' => $keywords]);
    $student_id = $_SESSION['user_id'];
    $teacher_id = $_POST['teacher_id'];

    // Reading the PDF file content
    $pdf = file_get_contents($_FILES['file']['tmp_name']);

    // Prepare SQL statement
    $sql = "INSERT INTO document_repository (title, student_id, teacher_id, authors, citations, metadata, file, status, date_submitted) VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending', NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssss", $title, $student_id, $teacher_id, $co_authors, $citations, $metadata, $pdf);

    if ($stmt->execute()) {
        echo "Study submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Submit a Document</title>
</head>
<body>
    <h1>Submit a New Document</h1>
    <form method="post" enctype="multipart/form-data">
        Title: <input type="text" name="title" required><br>
        Abstract: <textarea name="abstract" required></textarea><br>
        Main Author: <input type="text" name="main_author" required><br>
        Co-Authors (comma-separated): <input type="text" name="co_authors"><br>
        Teacher: 
        <select name="teacher_id" required>
            <option value="">Select a Teacher</option>
            <?php foreach ($teachers as $teacher): ?>
                <option value="<?= $teacher['user_id'] ?>"><?= htmlspecialchars($teacher['name']) ?></option>
            <?php endforeach; ?>
        </select><br>
        Publication Date: <input type="date" name="publication_date"><br>
        Keywords (comma-separated): <input type="text" name="keywords"><br>
        Citations (comma-separated): <input type="text" name="citations"><br>
        File: <input type="file" name="file" accept=".pdf" required><br>
        <div class="checkboxes">
            <div class="chkbx">
                <input class="w3-check" type="checkbox" checked="checked">
                <label>Case Study</label>
            </div>
            <div class="chkbx">
                <input class="w3-check" type="checkbox">
                <label>Thesis</label>
            </div>
            <div class="chkbx">
                <input class="w3-check" type="checkbox">
                <label>Proposal</label>
            </div>
            <div class="chkbx">
                <input class="w3-check" type="checkbox">
                <label>Capstone</label>
            </div>
            <div class="chkbx">
                <input class="w3-check" type="checkbox">
                <label>System Studies</label>
            </div>
        </div>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
