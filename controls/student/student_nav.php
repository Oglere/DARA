<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    echo "<script> window.location.assign('../../') </script>";
}
?>

<div class="profile">
    <?php 
    

        echo "Hello " . $_SESSION['first_name'];
    ?>
</div>

<div class="navigations">
    <p>Navigations</p>
    <a href="student_dashboard.php">Dashboard</a>
    <a href="submit.php">Submit Document</a>

</div>