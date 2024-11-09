<?php
include '../../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Student') {
    header('Location: ../../view/login.php');
    exit();
}


error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    echo "Invalid document ID.";
    exit();
}

$document_id = intval($_GET['id']);

$sql = "SELECT title, metadata, file FROM Document_Repository WHERE document_id = ?";
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

$metadata = json_decode($row['metadata'], true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error decoding JSON metadata: ' . json_last_error_msg());
}

$abstract = htmlspecialchars($metadata['abstract'] ?? '');
$publication_date = htmlspecialchars($metadata['publication_date'] ?? '');
$keywords = json_decode($metadata['keywords'] ?? '[]', true);
?>

<script>
    history.pushState();
</script>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Read: <?= $title ?></title>
    <link rel="stylesheet" href="../../css/std.scss">
    <link rel="stylesheet" href="../../css/mainpage.scss">
    <link rel="stylesheet" href="../../css/std_control.scss">
    <link rel="stylesheet" href="../../css/std.pdf.scss">
</head>
<body>
    <main>
        <header> 
            <div class="ahh">
                <img src="../../Imgs/DARA.png" alt="">
            </div>
            <?php 
                include "../../controls/pdf_identification.php"; 
            ?>
        </header>
         
        <div class="main" style="height: calc(100% - 121 qpx); overflow: hidden;">
            <div class="left">
                <div class="profile">
                    <h2><?php echo htmlspecialchars($_SESSION['first_name']); ?></h2> <!-- Display student's username -->
                    
                </div>

                <nav class="nav-links">
                    <a href="../" > 
                        <svg
                            style="margin-right: 10px;"
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
                    <a href="/dara/student/document-submission">
                        <svg
                            style="margin-right: 10px;"
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
                            style="margin-right: 10px;"
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

                    <a href="../" class="unq">Search Studies</a>

                    <div class="asd2" style=" width: 100%; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid grey; width: 150px;"></div>
                    </div>

                    <a href="../../view/logout.php" class="../view/logout-btn"> 
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
                        
                        &nbsp; Logout
                    </a>
                </nav>
            </div>
 
            <div class="right" style="overflow: auto;">



                <?php 
                
                    include "pdf.php"; 
                
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
