<?php
include '../../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Teacher') {
    header('Location: ../login.php');
    exit();
}

$teacher_id = $_SESSION['user_id'];


// Fetch document details and file data
$sql = "SELECT dr.*, u.last_name, u.first_name FROM document_repository dr 
        JOIN users u ON dr.student_id = u.user_id 
        WHERE dr.teacher_id = ? AND dr.document_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $teacher_id, $document_id);
$stmt->execute();
$result = $stmt->get_result();
$document = $result->fetch_assoc();

if (!$document) {
    die("Document not found.");
}

// Display document metadata and file
echo "<h2>" . htmlspecialchars($document['title']) . "</h2>";
$student_name = htmlspecialchars($document['last_name']) . ", " . htmlspecialchars($document['first_name']);
$authors = json_decode($document['authors'], true);
$authors[] = $student_name;
echo "<p><strong>Authors:</strong> " . htmlspecialchars(implode(', ', $authors)) . "</p>";
echo "<p><strong>Abstract:</strong> " . htmlspecialchars(json_decode($document['metadata'], true)['abstract']) . "</p>";
echo "<p><strong>Status:</strong> " . htmlspecialchars($document['status']) . "</p>";
echo "<p><strong>Date Submitted:</strong> " . htmlspecialchars($document['date_submitted']) . "</p>";
echo "<hr>";

// PDF viewer iframe
echo "<iframe src='data:application/pdf;base64," . base64_encode($document['file']) . "' width='100%' height='600px'></iframe>";

// Status update buttons
?>
<form method="post" action="update_status.php">
    <input type="hidden" name="document_id" value="<?php echo htmlspecialchars($document_id); ?>">
    <button type="submit" name="status" value="Approved">Approve</button>
    <button type="submit" name="status" value="Rejected">Reject</button>
    <button type="submit" name="status" value="Needs Revision">Needs Revision</button>
</form>
