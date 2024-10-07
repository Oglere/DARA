<?php
include '../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Student') {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM Document_Repository WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<script>
    history.pushState()
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Student Dashboard</title>
    <link rel="stylesheet" href="../css/mainpage.scss">
</head>
<body>
    <main>
        <header> 
            
        </header>
        
        <main>
            <h1>Student Dashboard</h1>
            <p><a href="logout.php">Logout</a></p>
            <p><a href="submit.php">Submit a New Document</a></p>
            <p><a href="../">Search</a></p>
            <h2>Your Submissions</h2>
            <?php if ($result->num_rows > 0): ?>
                <ul>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <li><?= $row['title'] ?> - Status: <?= $row['status'] ?></li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No submissions yet.</p>
            <?php endif; ?>
        </main>

        <footer>
            <a href="#">About DARA</a>
            <p>&nbsp | &nbsp</p>
            <a href="#">Contact us</a>
        </footer>
    </main>
</body>
</html>
<script src="js/index.js"></script>
