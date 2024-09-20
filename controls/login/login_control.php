<?php
include '../db/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usn = $_POST['usn'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE usn = ? AND status = 'Active'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usn);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user && $password === $user['password_hash']) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];
        if ($user['role'] == 'Student') {
            header('Location: student_dashboard.php');
        } elseif ($user['role'] == 'Teacher') {
            header('Location: teacher_dashboard.php');
        }
        exit();
    } else {
        $error = "Invalid login credentials.";
    }
}
?>