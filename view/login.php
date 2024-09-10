<?php
include '../db/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usn = $_POST['usn'];
    $password = $_POST['password'];

    // Query to fetch the user details
    $sql = "SELECT * FROM users WHERE usn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usn);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Directly compare the plain-text password with the one stored in the database
    if ($user && $password === $user['password_hash']) { // Assuming the password is stored in 'password_hash' column
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.scss">
</head>
<body>
    <form action="">
asd
    </form>
    
    <footer>
        <a href="">About DARA </a>

        <p>&nbsp | &nbsp</p>

        <a href=""> Contact us</a>
    </footer>
=======
    <title>DARA - Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p><?= $error ?></p>
    <?php endif; ?>
    <form method="post">
        USN: <input type="text" name="usn" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
>>>>>>> 2ecd50c471a6bcb269a75af5eeb05929a51faf79
</body>
</html>
