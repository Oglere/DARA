<?php
require '../../db/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $document_id = intval($_POST['document_id']);
    
    if ($document_id) {
        $stmt = $conn->prepare("UPDATE document_repository SET status = 'Abandoned' WHERE document_id = ?");

        if (!$stmt) {
            die("Statement preparation failed: " . $conn->error . " Document ID: " . $document_id);
        }

        $stmt->bind_param("i", $document_id);

        if ($stmt->execute()) {
            header("Location: ../../student/document-status");
            exit();
        } else {
            header("Location: index.php?abandon_error=1");
            exit();
        }

        $stmt->close();
    } else {
        header("Location: index.php?abandon_error=1");
        exit();
    }
}

$conn->close();
?>
