<?php
session_start();
include_once("../../db/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $document_id = $_POST['document_id'];

    // Validate input
    if (empty($action) || empty($document_id)) {
        echo "<script>alert('Invalid request. Please try again.');</script>";
        exit;
    }

    // Update document status
    $sql = "UPDATE document_repository SET status=? WHERE document_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $action, $document_id);

    if ($stmt->execute()) {
        echo "<script>alert('Document status updated to $action successfully!'); window.location.href = '../../teacher/review-studies';</script>";
    } else {
        echo "<script>alert('Error updating document status. Please try again.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
