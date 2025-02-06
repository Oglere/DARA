<?php
include '../db/db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    echo "Invalid document ID.";
    exit();
}

$document_id = intval($_GET['id']);

// Added `study_type` to the SELECT statement
$sql = "SELECT title, metadata, file, study_type FROM Document_Repository WHERE document_id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}
$stmt->bind_param("i", $document_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Document not found.";
    exit();
}

$row = $result->fetch_assoc();
$pdf_data = $row['file'];
$title = htmlspecialchars($row['title']);

// Safely decode JSON metadata
$metadata = !empty($row['metadata']) ? json_decode($row['metadata'], true) : [];
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error decoding JSON metadata: ' . json_last_error_msg());
}

$abstract = htmlspecialchars($metadata['abstract'] ?? '');
$publication_date = htmlspecialchars($metadata['publication_date'] ?? '');
$keywords = json_decode($metadata['keywords'] ?? '[]', true);

// Safely handle the `study_type` field
$studytypeArray = !empty($row['study_type']) ? json_decode($row['study_type'], true) : [];
if (json_last_error() !== JSON_ERROR_NONE) {
    // If JSON fails, assume it's a plain text string and split by comma
    $studytypeArray = explode(',', $row['study_type']);
}
$studytype = is_array($studytypeArray) ? implode(', ', $studytypeArray) : htmlspecialchars($row['study_type'] ?? '');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Read: <?= $title ?></title>
    <link rel="stylesheet" href="../css/results.scss">
    <link rel="stylesheet" href="../css/std.scss">
    <link rel="stylesheet" href="../css/mainpage.scss">
    <link rel="stylesheet" href="../css/std_control.scss">
    <link rel="stylesheet" href="../css/std.pdf.scss">
</head>
<body>
    <main>
    <header>
            <?php 
                session_start();
                if (isset($_SESSION['role']) && $_SESSION['role'] == "Teacher") {
                    echo '
                    <a href="../teacher/">
                        <div class="loginbutton">
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
                            class="feather feather-user"
                        >
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>

                        <h4>&nbsp' . htmlspecialchars($_SESSION['first_name']) .' </h4>
                        </div>
                    </a>
                    ';
                } elseif (isset($_SESSION['role']) && $_SESSION['role'] == "Student") {
                    echo '
                    <a href="../student/">
                        <div class="loginbutton">
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
                            class="feather feather-user"
                            >
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                            </svg>

                            <h4>&nbsp' . htmlspecialchars($_SESSION['first_name']) .' </h4>
                        </div>
                    </a>
                    ';
                } elseif (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
                    echo '
                    <a href="../admin">
                    <div class="loginbutton">
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
                        class="feather feather-user"
                        >
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                        </svg>

                        <h4>&nbsp' . htmlspecialchars($_SESSION['first_name']) .' </h4>
                    </div>
                    </a>
                    ';
                } else { 
                    echo '
                    <a class="death" href="../view/login.php">
                        <div class="loginbutton">
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
                            <h4> &nbsp Login</h4>
                        </div> 
                    </a>';
                }
                ?>
            
            <div class="ahh">
                    <a href="/dara" class="help">
                        <img src="../Imgs/DARA.png" alt="" style="height: 25px;">
                    </a>
                <?php 
                    include "../controls/search material/search_bar.php";
                ?>
            </div>
        </header>
         
        <div class="main" style="height: 100%; overflow: hidden;">

                <div class="left" style="border: none;"></div>
 
            <div class="right" style="overflow: auto;">
                <?php include "pdf.php" ?>
            </div>
        </div>

        <footer>
        </footer>
    </main>
</body>
</html>
<script src="js/index.js"></script>
