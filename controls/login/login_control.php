<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    echo "<script> window.location.assign('../../') </script>";
    exit();
}

include '../db/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usn = trim($_POST['usn']);
    $password = trim($_POST['password']);
    
    $sql = "SELECT * FROM users WHERE usn = ? AND status = 'Active'";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $usn);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['first_name'] = $user['first_name'];

        switch ($user['role']) {
            case 'Student':
                header('Location: ../student');
                break;
            case 'Teacher':
                header('Location: ../teacher');
                break;
            case 'Admin':
                header('Location: ../Admin');
                break;
            default:
                $error = "Invalid role.";
                break;
        }
        exit();
    } else {
        $error = "Invalid login credentials.";
    }
}

if (isset($error)) {
    echo "<script>alert('$error');</script>";
}
?>
