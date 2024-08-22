<?php
include '../db/db.php';

$result = $conn->query("SELECT document_id, title, authors, status FROM Document_Repository");

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . htgfmlspecialchars($row['title']) . "</h3>";
    echo "<p>Authors: " . implode(', ', json_decode($row['authors'])) . "</p>";
    echo "<p>Status: " . htmlspecialchars($row['status']) . "</p>";
    echo "<a href='study.php?id=" . $row['document_id'] . "'>View Study</a>";
    echo "</div>";
}
