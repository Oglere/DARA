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
    <link rel="stylesheet" href="../css/student_nav.scss">
    <title>DARA Main Page</title>
</head>
<body>
    <main>
        <header>
            <?php 
                include "../controls/header_identification.php";
            ?>
            
            <div class="ahh">
                <p>D A R A</p>
                <?php 
                    include "../controls/search material/search_bar.php";
                ?>
            </div>
        </header>

        <div class="blabla">
            <div class="kilid">
                <?php 
                    if ($_SESSION) {
                        if ($_SESSION['role'] == 'Student') {
                                include "../controls/student/student_nav.php";
                            }
                            elseif ($_SESSION['role'] == 'Teacher') {
                                include "../controls/teacher/teacher_nav.php";
                            }
                        }
                    
                ?>
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
