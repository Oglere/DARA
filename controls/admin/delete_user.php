<?php
include '../../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Admin') {
    header('Location: ../../view/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];

    // Update status to "Deleted"
    $query = "UPDATE users SET status = 'Deleted' WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'message' => 'User marked as deleted']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete user']);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error preparing SQL statement']);
    }

    mysqli_close($conn);
}
?>
