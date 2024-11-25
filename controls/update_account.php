<?php
include "../db/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields_to_update = $_POST['edit_fields'] ?? []; // Get selected fields
    $user_id = $_SESSION['user_id']; // Ensure you have user ID

    // Prepare the update query dynamically
    $update_query = "UPDATE users SET ";
    $params = [];
    $types = '';

    if (in_array('first_name', $fields_to_update)) {
        $update_query .= "first_name = ?, ";
        $params[] = trim($_POST['first_name']);
        $types .= 's';
    }
    if (in_array('last_name', $fields_to_update)) {
        $update_query .= "last_name = ?, ";
        $params[] = trim($_POST['last_name']);
        $types .= 's';
    }
    if (in_array('email', $fields_to_update)) {
        $update_query .= "email = ?, ";
        $params[] = trim($_POST['email']);
        $types .= 's';
    }
    if (in_array('password', $fields_to_update)) {
        $hashed_password = password_hash(trim($_POST['pass']), PASSWORD_BCRYPT);
        $update_query .= "password_hash = ?, ";
        $params[] = $hashed_password;
        $types .= 's';
    }

    // Remove trailing comma and add WHERE clause
    $update_query = rtrim($update_query, ', ') . " WHERE user_id = ?";
    $params[] = $user_id;
    $types .= 'i';

    // Execute the query
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        echo "Account updated successfully!";
    } else {
        echo "Error updating account: " . $conn->error;
    }

    $stmt->close();
}
?>
