<?php
include '../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Student') {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$user_n = $_SESSION['first_name'];

// Count studies based on their status
$sql = "SELECT 
            COUNT(CASE WHEN status = 'Pending' THEN 1 END) AS pending_count,
            COUNT(CASE WHEN status = 'Approved' THEN 1 END) AS published_count,
            COUNT(CASE WHEN status = 'Needs Revision' THEN 1 END) AS revision_count,
            COUNT(CASE WHEN status = 'Rejected' THEN 1 END) AS rejected_count,
            COUNT(*) AS total_submitted
        FROM Document_Repository 
        WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute(); 
$result = $stmt->get_result();
$data = $result->fetch_assoc();
?>

<script>
    history.pushState();
</script>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Student Dashboard</title>
    <link rel="stylesheet" href="../css/std.scss">
    <link rel="stylesheet" href="../css/mainpage.scss">
    <link rel="stylesheet" href="../css/std_control.scss">
</head>
<body>
    <main>
        <header> 
            <div class="ahh">
                <img src="../Imgs/DARA.png" alt="">
            </div>
        </header>
        
        <div class="main">
            <div class="left">
                <div class="profile">
                    <h2><?php echo htmlspecialchars($_SESSION['first_name']); ?></h2> <!-- Display student's username -->
                    <a href="logout.php" class="logout-btn"> 
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-log-in"
                            >
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                            <polyline points="10 17 15 12 10 7" />
                            <line x1="15" y1="12" x2="3" y2="12" />
                        </svg>


                        &nbsp; Logout</a>
                </div>

                <nav class="nav-links">
                    <a href="status.php">Dashboard</a>
                    <a href="submit.php">Submit Studies</a>
                    <a href="status.php">View Study Status</a>
                    <a href="../">Search Studies</a>
                </nav>
            </div>
 
            <div class="right">

                <?php include "../controls/student/std_dashboard.php" ?>

            </div>
        </div>

        <footer>
            <a href="#">About DARA</a>
            <p>&nbsp | &nbsp</p>
            <a href="#">Contact us</a>
        </footer>
    </main>
</body>
</html>
<script src="js/index.js"></script>
