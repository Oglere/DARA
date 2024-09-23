<?php
session_start();
include "../db/db.php";
$user_id = $_SESSION['user_id'];

$conn->query("UPDATE users 
              SET last_login = NOW() 
              WHERE user_id = $user_id");

session_unset();
session_destroy();
header('Location: login.php');
exit();
?>
