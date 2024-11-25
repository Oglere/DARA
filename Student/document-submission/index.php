<?php
include '../../db/db.php';
session_start();

if (!$_SESSION) {
    header('Location: ../../view/login.php');
    exit();
}

// Fetch teachers for dropdown
$sql = "SELECT user_id, CONCAT(first_name, ' ', last_name) AS name FROM users WHERE role = 'Teacher'";
$result = $conn->query($sql);
$teachers = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $co_authors = json_encode(explode(',', $_POST['co_authors']));
    $publication_date = $_POST['publication_date'];
    $keywords = json_encode(explode(',', $_POST['keywords']));
    $citations = json_encode(explode(',', $_POST['citations']));
    $metadata = json_encode([
        'abstract' => $abstract,
        'publication_date' => $publication_date,
        'keywords' => $keywords
    ]);
    $student_id = $_SESSION['user_id'];
    $teacher_id = $_POST['teacher_id'];
    $document_types = json_encode($_POST['document_types']); // Convert document types to JSON

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $pdf = file_get_contents($_FILES['file']['tmp_name']);
    } else {
        echo "Error: File not uploaded or there was an issue with the upload.";
        exit();
    }

    // Prepare SQL statement
    $sql = "INSERT INTO document_repository 
            (title, student_id, teacher_id, authors, citations, metadata, file, status, date_submitted, study_type) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending', NOW(), ?)";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("sissssss", $title, $student_id, $teacher_id, $co_authors, $citations, $metadata, $pdf, $document_types);

    if ($stmt->execute()) {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const frbg = document.querySelector('.frbg');

                    frbg.style.visibility = 'hidden';
                    setTimeout(() => {
                        frbg.classList.add('fade-in');
                        frbg.style.visibility = 'visible';
                    }, 100);

                    setTimeout(() => {
                        frbg.classList.remove('fade-in');
                        frbg.classList.add('fade-out');
                    }, 2000);

                    setTimeout(() => {
                        frbg.style.visibility = 'hidden';
                        frbg.classList.remove('fade-out');
                    }, 2500);
                });
            </script>
        ";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Student Dashboard</title>
    <link rel="stylesheet" href="../../css/mainpage.scss">
    <link rel="stylesheet" href="../../css/std.scss">
    <link rel="stylesheet" href="../../css/submit.scss">
    <link rel="stylesheet" href="../../css/yey.scss">
    <link rel="stylesheet" href="../../css/svg.scss">
</head>
<body>
    <main>
        <header> 
            <div class="ahh">
                <img src="../../Imgs/DARA.png" alt="" class="ahh">
            </div>
        </header>
        
        <div class="main" style="height: calc(100% - 121px); overflow: hidden;">
            <div class="left">
                <div class="profile">
                    <h2><?php echo htmlspecialchars($_SESSION['first_name']); ?></h2>
                </div>

                <nav class="nav-links">
                    <a href="../"> 
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
                    <a href="#" style="color: #04128e; font-weight: normal;">
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
                    <a href="/dara/student/document-status">
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
                        <div class="asd3" style="border-bottom: 1px solid grey; width: 150px;"></div>
                    </div>

                    <a href="../../" class="unq">Search Studies</a>
                    <a href="../edit" class="unq">Edit Account</a>

                    <div class="asd2" style=" width: 100%; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid grey; width: 150px;"></div>
                    </div>

                    <a href="../../view/logout.php" class="logout-btn"> 
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
                        
                        Logout
                    </a>
                </nav>
            </div>

            <div class="right">
                <div class="frbg">
                    <div class="notif">
                        <div class="imghere">
                            <img src="../../imgs/review.png" alt="" />
                        </div>
                        <div
                            class="teksto"
                            style="display: flex; margin-top: -16px; text-align: center"
                        >
                            <p>
                            Submitted <br />
                            Succesfully!
                            </p>
                        </div>
                    </div>
                </div>

                <?php

                    include "../../controls/student/std_submit.php";
                ?>
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
