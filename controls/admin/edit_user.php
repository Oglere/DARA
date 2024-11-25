<?php
include '../../db/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $user_id = intval($_POST['user_id']);

    if ($action === 'edit') {
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $status = $_POST['status'];

        // Update user information
        $query = "UPDATE users SET first_name = ?, last_name = ?, email = ?, role = ?, status = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssi", $first_name, $last_name, $email, $role, $status, $user_id);
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(["status" => "success", "message" => "User updated successfully."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to update user: " . mysqli_error($conn)]);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to prepare the statement: " . mysqli_error($conn)]);
        }
    } elseif ($action === 'delete') {
        // Soft delete user by setting status to 'Deleted'
        $query = "UPDATE users SET status = 'Deleted' WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(["status" => "success", "message" => "User deleted successfully."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to delete user: " . mysqli_error($conn)]);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to prepare the statement: " . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid action."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
