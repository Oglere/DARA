<?php 
    include "../controls/search material/results_and_control.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/results.scss">
    <link rel="stylesheet" href="../css/mainpage.scss">
    <title>DARA Main Page</title>
</head>
<body>
    <main>
        <header>
            <a href="#">
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
            </a>
            <div class="ahh">
                <p>D A R A</p>
                <?php 
                    include "../controls/search material/search_bar.php";
                ?>
            </div>
        </header>

        <div class="blabla">
            <div class="kilid">
                <div class="tagform">
                    <div class="lefttag">
                        
                    </div>
                    <div class="midtag"></div>
                    <div class="righttag"></div>
                </div>
            </div>

            <div class="cell_container">
                <?php 
                    include "../controls/search material/results_control.php"
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
<script src="../js/results.js"></script>
