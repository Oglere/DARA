<?php
include '../../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $userId = $input['user_id'] ?? null;

    if ($userId) {
        $query = "UPDATE users SET status = 'Active' WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $userId);
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(['success' => true, 'message' => 'User recovered successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to recover user.']);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error preparing statement.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid user ID.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

mysqli_close($conn);
?>
