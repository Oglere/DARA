<?php
include '../../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Teacher') {
    header('Location: ../../view/login.php');
    exit();
}
?>

<script>
    history.pushState();
</script>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Review Studies</title>
    <link rel="stylesheet" href="../../css/std.scss">
    <link rel="stylesheet" href="../../css/mainpage.scss">
    <link rel="stylesheet" href="../../css/std_control.scss">
</head>
<body>
    <main>
        <header> 
            <div class="ahh">
                <img src="../../Imgs/DARA.png" alt="">
            </div>
        </header>
         
        <div class="main" style="height: 100%;">
            <div class="left">
                <div class="profile">
                    <h2><?php echo htmlspecialchars($_SESSION['first_name']); ?></h2> <!-- Display student's username -->
                    
                </div>

                <nav class="nav-links">
                    <a href="../""> 
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
                    <a href="/dara/teacher/review-studies" style="color: #04128e; font-weight: normal;">
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
                            class="feather feather-book-open"
                            >
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                        </svg>

                        Review Studies
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

                    <a href="../view/logout.php" class="../view/logout-btn"> 
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
 
            <div class="right">

                <?php include "../../controls/teacher/tchr_results.php" ?>

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
