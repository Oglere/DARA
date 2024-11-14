<?php
include '../../db/db.php';

$teacher_id = $_SESSION['user_id'];

$sql = "SELECT dr.document_id, dr.title, dr.student_id, dr.teacher_id, dr.authors, dr.citations, dr.metadata, 
               dr.status, dr.date_submitted, dr.study_type, u.first_name, u.last_name
        FROM document_repository dr
        JOIN users u ON dr.student_id = u.user_id
        WHERE dr.status = 'Pending' AND dr.teacher_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();

echo '<div class="studies-container">';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $authors = json_decode($row["authors"], true);
        $authors_list = is_array($authors) ? implode(', ', $authors) : htmlspecialchars($row["authors"]);
        
        $study_types = json_decode($row['study_type'], true);
        $study_types_list = is_array($study_types) ? implode(', ', $study_types) : htmlspecialchars($row['study_type']);

        echo '<div class="study-card">';
        echo '<h3><a href="pdf-reader.php?id=' . $row["document_id"] . '">' . htmlspecialchars($row["title"]) . '</a></h3>';
        echo '<p><strong>Authors:</strong> ' . $row["last_name"] . ', ' . $authors_list . '</p>';
        echo '<p><strong>Date Submitted:</strong> ' . htmlspecialchars($row["date_submitted"]) . '</p>';
        echo '<p><strong>Study Type:</strong> ' . $study_types_list . '</p>';
        echo '</div>';
    }
} else {
    echo '<p class="no-studies">No pending studies found for this teacher (ID: ' . $teacher_id . ').</p>';
}

echo '</div>';

$stmt->close();
$conn->close();
?>
