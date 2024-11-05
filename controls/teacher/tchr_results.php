<?php
include '../../db/db.php';

$teacher_id = $_SESSION['user_id'];

$sql = "SELECT document_id, title, student_id, teacher_id, authors, citations, metadata, `status`, date_submitted, study_type 
        FROM document_repository 
        WHERE status = 'Pending' AND teacher_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Document ID: " . $row["document_id"] . "<br>";
        echo "Title: <a href='pdf-reader.php?id=" . $row["document_id"] . "'>" . htmlspecialchars($row["title"]) . "</a><br>";
        echo "Student ID: " . $row["student_id"] . "<br>";
        echo "Teacher ID: " . $row["teacher_id"] . "<br>";
        echo "Authors: " . htmlspecialchars($row["authors"]) . "<br>";
        echo "Citations: " . htmlspecialchars($row["citations"]) . "<br>";
        echo "Metadata: " . htmlspecialchars($row["metadata"]) . "<br>";
        echo "Status: " . htmlspecialchars($row["status"]) . "<br>";
        echo "Date Submitted: " . htmlspecialchars($row["date_submitted"]) . "<br>";
        echo "Study Type: " . htmlspecialchars($row["study_type"]) . "<br><br>";
    }
} else {
    echo "No pending studies found for this teacher (ID: $teacher_id).";
}

$stmt->close();
$conn->close();
?>
