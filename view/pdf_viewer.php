<?php
include '../db/db.php';

if (isset($_GET['id'])) {
    $document_id = $_GET['id'];
    
    $sql = "SELECT file FROM document_repository WHERE document_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $document_id);
    $stmt->execute();
    $stmt->bind_result($pdf);
    $stmt->fetch();
    
    if ($pdf) {
        header('Content-Type: application/pdf');
        echo $pdf;
    } else {
        echo "PDF not found.";
    }
}
?>
