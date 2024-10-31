<?php
include '../db/db.php';
session_start();

if (!$_SESSION) {
    header('Location: login.php');
    exit();
}

$sql = "SELECT user_id, CONCAT(first_name, ' ', last_name) AS name FROM users WHERE role = 'Teacher'";
$result = $conn->query($sql);
$teachers = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $main_author = $_POST['main_author'];
    $co_authors = json_encode(explode(',', $_POST['co_authors']));
    $publication_date = $_POST['publication_date'];
    $keywords = json_encode(explode(',', $_POST['keywords']));
    $citations = json_encode(explode(',', $_POST['citations']));
    $metadata = json_encode(['abstract' => $abstract, 'publication_date' => $publication_date, 'keywords' => $keywords]);
    $student_id = $_SESSION['user_id'];
    $teacher_id = $_POST['teacher_id'];

    // Ensure file is uploaded
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $pdf = file_get_contents($_FILES['file']['tmp_name']);
    } else {
        echo "Error: File not uploaded or there was an issue with the upload.";
        exit();
    }

    // Prepare SQL statement
    $sql = "INSERT INTO document_repository (title, student_id, teacher_id, authors, citations, metadata, file, status, date_submitted) VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending', NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssss", $title, $student_id, $teacher_id, $co_authors, $citations, $metadata, $pdf);

    if ($stmt->execute()) {
        echo "Study submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Student Dashboard</title>
    <link rel="stylesheet" href="../css/mainpage.scss">
    <link rel="stylesheet" href="../css/std.scss">
    <link rel="stylesheet" href="../css/submit.scss"> 
</head>
<body>
    <main>
        <header> 
            <div class="ahh">
                <img src="../Imgs/DARA.png" alt="" style="height: 50px;">
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
                    <a href="student_dashboard.php"> 
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
                            class="feather feather-home"
                            >
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>

                        Dashboard
                    </a>
                    <a href="submit.php">
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
                            class="feather feather-file-plus"
                            >
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="12" y1="18" x2="12" y2="12" />
                            <line x1="9" y1="15" x2="15" y2="15" />
                        </svg>
                    
                        Submit Studies
                    </a>
                    <a href="status.php">
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
                            class="feather feather-eye"
                            >
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>

                        View Study Status
                    </a>

                    <div class="asd2" style=" width: 100%; margin-top: 10px; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid black; width: 150px;"></div>
                    </div>

                    <a href="../">Search Studies</a>
                </nav>
            </div>

            <div class="right">

                <?php include "../controls/student/std_submit.php" ?>

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
