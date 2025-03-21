<?php
// Database connection
include '../db/db.php';

// Fetch total documents
$docQuery = "SELECT COUNT(*) AS total_docs FROM document_repository";
$docResult = $conn->query($docQuery);
$docCount = $docResult->fetch_assoc()['total_docs'];

// Fetch total users
$userQuery = "SELECT COUNT(*) AS total_users FROM users";
$userResult = $conn->query($userQuery);
$userCount = $userResult->fetch_assoc()['total_users'];

// Fetch unread notifications
$notifQuery = "SELECT COUNT(*) AS unread_notifs FROM notification_logs WHERE is_checked = 0";
$notifResult = $conn->query($notifQuery);
$notifCount = $notifResult->fetch_assoc()['unread_notifs'];

$conn->close();

echo '
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>' . $docCount . '</h3>
                <p>Total Documents</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-alt"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>' . $userCount . '</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>' . $notifCount . '</h3>
                <p>Unread Notifications</p>
            </div>
            <div class="icon">
                <i class="fas fa-bell"></i>
            </div>
        </div>
    </div>';
?>
