<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $authors = json_encode(explode(',', $_POST['authors']));
    $citations = json_encode(explode(',', $_POST['citations']));
    $metadata = json_encode($_POST['metadata']);
    $author_id = 1;

    $pdf = file_get_contents($_FILES['file']['tmp_name']);

    $stmt = $conn->prepare("INSERT INTO Document_Repository (title, author_id, authors, citations, metadata, file, status, date_submitted) VALUES (?, ?, ?, ?, ?, ?, 'Pending', NOW())");
    $stmt->bind_param("sissss", $title, $author_id, $authors, $citations, $metadata, $pdf);

    if ($stmt->execute()) {
        echo "Study submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<form method="post" enctype="multipart/form-data">
    Title: <input type="text" name="title"><br>
    Abstract: <textarea name="abstract"></textarea><br>

    Main Author: <input type="text" name="main_author"><br>
    Co-Authors (comma-separated): <input type="text" name="co_authors"><br>

    Date of Publication: <input type="date" name="publication_date"><br>
    Keywords (comma-separated): <input type="text" name="keywords"><br>
    
    Citations (comma-separated): <input type="text" name="citations"><br>

    PDF File: <input type="file" name="file"><br>
    
    <button type="submit">Submit Study</button>
</form>
