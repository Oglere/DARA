<?php
// Include the database connection
require '../../db/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $document_id = intval($_POST['document_id']);
    $action = $_POST['action'];

    if ($document_id) {
        switch ($action) {
            case 'abandon':
                $status = 'Abandoned';
                $date_column = "abandoned_date";
                break;
            case 'recover':
                $status = 'Pending';
                $date_column = "recovered_date";
                break;
            case 'delete':
                $status = 'LostDoc';
                $date_column = "lost_date";
                break;
            default:
                header("Location: index.php?error=invalid_action_" . urlencode($action));
                exit();
        }

        // Prepare the SQL query with the dynamically selected column
        $sql = "UPDATE document_repository SET status = ?, $date_column = NOW() WHERE document_id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            error_log("Statement preparation failed: " . $conn->error . " | Document ID: " . $document_id);
            header("Location: index.php?error=statement_failed");
            exit();
        }

        $stmt->bind_param("si", $status, $document_id);

        if ($stmt->execute()) {
            header("Location: ../../student/document-status");
        } else {
            error_log("SQL execution failed: " . $stmt->error . " | Document ID: " . $document_id);
            header("Location: index.php?error=execution_failed");
        }

        $stmt->close();
    } else {
        header("Location: index.php?error=invalid_document_id");
    }

    exit();
}

$conn->close();
?>
