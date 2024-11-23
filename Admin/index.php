<style>
   .right {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Chart Container */
.chart-container, .stat-card {
    background: #f9f9f9;
    padding: 15px;
    border-radius: 8px;
    height: 360px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border: 1px solid #ddd;
}

.chart-container h2 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #04128e;
}

/* Stat Cards */
.stats {
    border-radius: 8px;
    width: 616px;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
}

.stat-card {
    flex: 1;
    padding: 20px;
    background: #ffffff;    
    text-align: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    border: 1px solid #ddd;
}

.stat-card h3 {
    font-size: 16px;
    margin-bottom: 10px;
    color: #04128e;
}

.stat-card p {
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

/* Responsive Adjustments */
@media (max-width: 576px) {
    .chart-container {
        height: 600px;
        padding: 10px;
    }

    .stat-card {
        padding: 10px;
        font-size: 14px;
    }
}

.recent-activity {
    display: flex;
    flex-direction: column;
    border-radius: 8px;
    margin-top: 20px;
    height: 400px;
    border: 1px solid #ddd;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.recent-activity tbody {
    height: 100%;
}

.recent-activity table {
    height: 100%;
    width: 100%;
    border-collapse: collapse;
}
.recent-activity th, .recent-activity td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.recent-activity th {
    background: #f2f2f2;
}

.recent-activity tr:nth-child(even) {
    background-color: rgb(224, 224, 224);
}

.recent-activity tr {
    height: 40px;
}

.recent-activity tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}

.recent-activity tr:nth-child(even):hover {
    background-color: rgb(226, 226, 226);
}

.recent-activity h2 {
    width: 300px;
    padding: 15px;
    font-size: 18px;
    margin-bottom: 10px;
    color: #555;
}

.xdxd {
    display: block;
    box-sizing: border-box;
    height: 293px;
}

svg {
    margin-right: 10px;
}
</style>

<?php
include '../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Admin') {
    header('Location: ../view/login.php');
    exit();
}

$total_documents = $conn->query("
    SELECT COUNT(*) 
    AS total FROM document_repository 
    WHERE status = 'Published'
")->fetch_assoc()['total'];


$study_status_data = $conn->query("
    SELECT status, 
    COUNT(*) 
    AS count FROM document_repository GROUP 
    BY status
")->fetch_all(MYSQLI_ASSOC);

$pending_approvals = $conn->query("
    SELECT COUNT(*) 
    AS total FROM document_repository 
    WHERE status = 'Pending'
")->fetch_assoc()['total'];

$user_roles_data = $conn->query("
    SELECT role, 
    COUNT(*) 
    AS count FROM users GROUP 
    BY role
")->fetch_all(MYSQLI_ASSOC);

$active_users_data = $conn->query("
    SELECT COUNT(*) AS active_users
    FROM users
    WHERE last_login >= DATE_SUB(NOW(), INTERVAL 2 MONTH)
")->fetch_assoc()['active_users'];

$recent_submissions_data = $conn->query("
    SELECT title, date_submitted, status
    FROM document_repository
    ORDER BY date_submitted DESC
    LIMIT 5
")->fetch_all(MYSQLI_ASSOC);

$recent_users_online_data = $conn->query("
    SELECT first_name, last_name, last_login
    FROM users
    WHERE last_login >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
    ORDER BY last_login DESC
    LIMIT 6
")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DARA - Admin Dashboard</title>
    <link rel="stylesheet" href="../css/std.scss">
    <link rel="stylesheet" href="../css/mainpage.scss">
    <link rel="stylesheet" href="../css/std_control.scss">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <main>
        <header> 
            <div class="ahh">
                <img src="../Imgs/DARA.png" alt="DARA Logo" class="ahh">
            </div>
        </header>

        <div class="main" style="height: calc(100% - 121px);">
            <div class="left">
                <div class="profile">
                    <h2><?php echo htmlspecialchars($_SESSION['first_name']); ?></h2>
                </div>

                <nav class="nav-links">
                    <a href="" style="color: #04128e; font-weight: normal;"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="user-control">
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
                            class="feather feather-users"
                            >
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        Manage Users
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
                            class="feather feather-mail"
                            >
                            <path
                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                            />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                        
                        Inbox
                    </a>

                    <div class="divider"></div>

                    <a href="../" class="unq">Search Studies</a>
                    <a href="../../" class="unq">Edit Account</a>
                    
                    <div class="divider"></div>
                    <a href="../view/logout.php" class="logout-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-in">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 1-2 2h-4" />
                            <polyline points="10 17 15 12 10 7" />
                            <line x1="15" y1="12" x2="3" y2="12" />
                        </svg>
                        Logout
                    </a>
                </nav>
            </div>

            <div class="right" style=" overflow: auto;">
                <div class="chart-container">
                    <h2>Study Status Overview</h2>
                    <canvas id="studyStatusChart"></canvas>
                </div>

                <div class="chart-container">
                    <h2>User Roles Distribution</h2>
                    <canvas class="xdxd" id="userRolesChart"></canvas>
                </div>

                <div class="recent-activity">
                    <h2>Recent Users Online</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Last Online</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                date_default_timezone_set('Asia/Manila'); // Set the PHP timezone to match your local timezone

                                foreach ($recent_users_online_data as $user): ?>
                                    <tr>
                                        <td>
                                            <?php 
                                                echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); 
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $lastLogin = new DateTime($user['last_login']); // Database timestamp
                                            $now = new DateTime(); // Current time in the set timezone
                                            $interval = $now->diff($lastLogin);

                                            // Display time ago format
                                            if ($interval->d > 0) {
                                                echo $interval->d . ' day(s) ago';
                                            } elseif ($interval->h > 0) {
                                                echo $interval->h . ' hour(s) ago';
                                            } elseif ($interval->i > 0) {
                                                echo $interval->i . ' minute(s) ago';
                                            } else {
                                                echo 'Just now';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="stats">
                    <div class="stat-card">
                        <h3>Active Users</h3>
                        <p><?php echo $active_users_data; ?></p>
                    </div>
                    <div class="stat-card">
                        <h3>Studies Published to the Public</h3>
                        <p><?php echo $total_documents; ?></p>
                    </div>
                    <div class="stat-card">
                        <h3>Processed Studies</h3>
                        <p><?php echo $pending_approvals; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <footer>
            <a href="#">About DARA</a>
            <p>&nbsp;|&nbsp;</p>
            <a href="#">Contact us</a>
        </footer>
    </main>

    <script>
        const studyStatusData = <?php echo json_encode($study_status_data); ?>;
        const userRolesData = <?php echo json_encode($user_roles_data); ?>;

        // Study Status Chart
        const studyStatusCtx = document.getElementById('studyStatusChart').getContext('2d');
        const studyStatusChart = new Chart(studyStatusCtx, {
            type: 'pie',
            data: {
                labels: studyStatusData.map(item => item.status),
                datasets: [{
                    data: studyStatusData.map(item => item.count),
                    backgroundColor: ['#8e0404', '#04128e', '#FFCE56', '#8AFF64', '#FF9F40'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // User Roles Chart
        const userRolesCtx = document.getElementById('userRolesChart').getContext('2d');
        const userRolesChart = new Chart(userRolesCtx, {
            type: 'bar',
            data: {
                labels: userRolesData.map(item => item.role),
                datasets: [{
                    label: 'User Count',
                    data: userRolesData.map(item => item.count),
                    backgroundColor: ['#04128e', '#8e0404', '#FFCE56', '#8AFF64', '#FF9F40'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>
</html>
