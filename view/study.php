<?php
include '../db/db.php';

$document_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM Document_Repository WHERE document_id = ?");
$stmt->bind_param("i", $document_id);
$stmt->execute();
$result = $stmt->get_result();
$study = $result->fetch_assoc();

echo "<h2>" . htmlspecialchars($study['title']) . "</h2>";
echo "<p>Authors: " . implode(', ', json_decode($study['authors'])) . "</p>";
echo "<p>Citations: " . implode(', ', json_decode($study['citations'])) . "</p>";
echo "<p>Metadata: " . htmlspecialchars($study['metadata']) . "</p>";
echo "<p>Status: " . htmlspecialchars($study['status']) . "</p>";

// Display the PDF
header('Content-type: application/pdf');
echo $study['file'];

$stmt->close();
?>
